<?php
$path_help = '/includes/helps/';
require_once HTTFOX_DIRECTORY . $path_help . 'simple-validation-api-per-http-referer.php';
require_once HTTFOX_DIRECTORY . $path_help . 'check-acf-active.php';

function httfox_api_get_portfolio($request) {
  $can_access = simple_validation_api_per_http_referer();

  if ($can_access !== true) {
    return rest_ensure_response( $can_access );
  }

  $cpt_name_id = 'httfox_portfolio';
  $tax_name_id = 'httfox_category_portfolio';

  $paged = !empty($request['paged']) ? $request['paged'] : 1;
  $category = !empty($request['category']) ? $request['category'] : null;

  $args = array(
    'post_type' => $cpt_name_id,
    'posts_per_page' => 6,
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
    var_dump(0);
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

      $response['categories'] = $term_list;
      $response['total_pages'] = $total_pages;
      $response['portfolio'][$count] = [
        'id'      => $post_id,
        'slug' => $post->post_name,
        'title' => $post->post_title,
        'attachment_img' => $attachment_img,
      ];
      $count++;
    }

    wp_reset_postdata();
  } else {
    return new WP_Error( 'not_found', 'Nenhum item encontrado', array( 'status' => 404 ) );
  }

  return rest_ensure_response( $response );
}

function httfox_register_route_api_get_portfolio() {
  $configRoutes = [
    'methods' => WP_REST_Server::READABLE,
    'callback' => 'httfox_api_get_portfolio'
  ];

  register_rest_route(HTTFOX_API_VERSION_V1, '/portfolio', $configRoutes);
}

if (httfox_acf_check()) {
  add_action('rest_api_init', 'httfox_register_route_api_get_portfolio');
}

?>