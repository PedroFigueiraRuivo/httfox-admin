<?php
$path_help = '/includes/helps/';
require_once HTTFOX_DIRECTORY . $path_help . 'simple-validation-api-per-http-referer.php';
require_once HTTFOX_DIRECTORY . $path_help . 'check-acf-active.php';

function httfox_api_get_depositions($request) {
  $can_access = simple_validation_api_per_http_referer();

  if ($can_access !== true) {
    return rest_ensure_response( $can_access );
  }

  $paged = !empty($request['paged']) ? $request['paged'] : 1;
  $itens_per_page = !empty($request['itens_per_page']) ? $request['itens_per_page'] : 0;

  $args = array(
    'post_type' => 'httfox_depositions',
    'posts_per_page' => $itens_per_page,
    'paged' => $paged,
  );

  $query = new WP_Query($args);

  $count = 0;
  $response = [];
  if ($query->have_posts()) {
    while ($query->have_posts()) {
      $query->the_post();
      $post = $query->post;
      
      $post_id = $post->ID;
      $total_pages = $query->max_num_pages;

      $response['paged'] = $paged;
      $response['total_pages'] = $total_pages;
      $response['depositions'][$count] = [
        'id'      => $post_id,
        'slug' => $post->post_name,
        'title' => $post->post_title,
        'content' => get_field('depositions_deposition_deposition', $post_id),
        'author' => get_field('depositions_deposition_author', $post_id),
        'company' => get_field('depositions_deposition_company', $post_id),
        'website_url' => get_field('depositions_deposition_website_url', $post_id),
      ];
      $count++;
    }

    $response['total_items'] = $query->found_posts;
    wp_reset_postdata();
  } else {
    return new WP_Error( 'not_found', 'Nenhum depoimento encontrado', array( 'status' => 404 ) );
  }

  return rest_ensure_response( $response );
}

function httfox_register_route_api_get_depositions() {
  $configRoutes = [
    'methods' => WP_REST_Server::READABLE,
    'callback' => 'httfox_api_get_depositions'
  ];

  register_rest_route(HTTFOX_API_VERSION_V1, '/depositions', $configRoutes);
}

if (httfox_acf_check()) {
  add_action('rest_api_init', 'httfox_register_route_api_get_depositions');
}

?>