<?php
$path_help = '/includes/helps/';
require_once HTTFOX_DIRECTORY . $path_help . 'simple-validation-api-per-http-referer.php';
require_once HTTFOX_DIRECTORY . $path_help . 'check-acf-active.php';

function httfox_api_get_services($request) {
  $can_access = simple_validation_api_per_http_referer();

  if ($can_access !== true) {
    return rest_ensure_response( $can_access );
  }

  $cpt_name_id = 'httfox_services';
  $tax_name_id = 'httfox_category_services';

  $itens_per_page = !empty($request['itens_per_page']) ? $request['itens_per_page'] : 0;
  $category = !empty($request['category']) ? $request['category'] : null;
  $paged = !empty($request['paged']) ? $request['paged'] : 1;

  $args = array(
    'post_type' => $cpt_name_id,
    'posts_per_page' => $itens_per_page,
    'paged' => $paged,
  );

  if ($category) {
    $args['tax_query'] = array(
      array(
        'taxonomy' => $tax_name_id,
        'field' => 'slug',
        'terms' => $category,
      ),
    );
  }

  $terms = get_terms($tax_name_id);
  $term_list = [];
  if (!empty($terms) && !is_wp_error($terms)) {
    $count = 0;
    foreach ($terms as $term) {
      $term_list[$count] = $term->slug;
      $count++;
    }
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

      $response['paged'] = $paged;
      $response['categories'] = $term_list;
      $response['total_pages'] = $total_pages;
      $response['services'][$count] = [
        'id'      => $post_id,
        'slug' => $post->post_name,
        'title' => $post->post_title,
        'attachment_img' => $attachment_img,
      ];
      $count++;
    }

    $response['total_items'] = $query->found_posts;

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