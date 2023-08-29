<?php
/**
 * Endpoint para obter serviços.
 *
 * Este endpoint permite obter uma lista de serviços.
 *
 * @route GET /httfox-api/v1/services
 * @param int $paged Página da lista de serviços (opcional).
 * @param string $category Slug da categoria de serviços (opcional).
 * @return WP_REST_Response|array Retorna um array com informações sobre os serviços ou um erro caso não haja serviços encontrados.
 */

 
$path_help = '/includes/helps/';
require_once HTTFOX_DIRECTORY . $path_help . 'simple-validation-api-per-http-referer.php';
require_once HTTFOX_DIRECTORY . $path_help . 'check-acf-active.php';

function httfox_api_get_services($request) {
  $can_access = simple_validation_api_per_http_referer();

  if ($can_access !== true) {
    return rest_ensure_response( $can_access );
  }

  $paged = !empty($request['paged']) ? $request['paged'] : 1;
  $category = !empty($request['category']) ? $request['category'] : null;

  $args = array(
    'post_type' => 'services',
    'posts_per_page' => 6,
    'paged' => $paged,
  );

  if ($category) {
    $args['tax_query'] = array(
      array(
        'taxonomy' => 'category_services',
        'field' => 'slug',
        'terms' => $category,
      ),
    );
  }

  $query = new WP_Query($args);

  $count = 0;
  $response = [];
  if ($query->have_posts()) {
    while ($query->have_posts()) {
      $query->the_post();
      $post = $query->post;
      
      $post_id = $post->ID;
      $attachment_img = get_the_post_thumbnail_url($post_id, 'full');
      $total_pages = $query->max_num_pages;

      $response['total_pages'] = $total_pages;
      $response['services'][$count] = [
        'id'      => $post_id,
        'slug' => $post->post_name,
        'title' => $post->post_title,
        'attachment_img' => $attachment_img,
      ];
      $count++;
    }

    wp_reset_postdata();
  } else {
    return new WP_Error( 'not_found', 'Nenhum serviço encontrado', array( 'status' => 404 ) );
  }

  return rest_ensure_response( $response );
}

function httfox_register_route_api_get_services() {
  $configRoutes = [
    'methods' => WP_REST_Server::READABLE,
    'callback' => 'httfox_api_get_services'
  ];

  register_rest_route(HTTFOX_API_VERSION_V1, '/services', $configRoutes);
}

if (httfox_acf_check()) {
  add_action('rest_api_init', 'httfox_register_route_api_get_services');
}

?>