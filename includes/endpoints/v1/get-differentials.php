<?php
$path_help = '/includes/helps/';
require_once HTTFOX_DIRECTORY . $path_help . 'simple-validation-api-per-http-referer.php';
require_once HTTFOX_DIRECTORY . $path_help . 'check-acf-active.php';
require_once HTTFOX_DIRECTORY . $path_help . 'define-init-and-limit-for-loops.php';

function httfox_api_get_differentials($request) {
  $can_access = simple_validation_api_per_http_referer();

  if ($can_access !== true) {
    return rest_ensure_response( $can_access );
  }

  // Verifica se o post responsável por essas configurações
  // existe e retorna seu id do banco de dados. 
  // Os valores para a pesquisa foram definidos com a 
  // configuração do post;
  $args = [
    'key' => 'httfox_information_differentials',
    'name' => 'register_post_id',
  ];

  $set_param_search = new httfox_add_item_on_table_database($args);
  $post_id_database = $set_param_search->get_item();

  if (empty($post_id_database)) {
    return new WP_Error( 'not_found', 'Config not defined', array( 'status' => 404 ) );
  }
  
  $post_id = intval($post_id_database);
  $repeater_items = get_field('general_information_differential_repeater', $post_id);
  
  if (empty($repeater_items)) {
    return new WP_Error( 'not_found', 'There are no registered posts', array( 'status' => 404 ) );
  }

  // Gerwnciamento de parâmetros para a listagem
  $total_items = sizeof($repeater_items);
  $itens_per_page = !empty($request['itens_per_page']) ? $request['itens_per_page'] : 0;
  $total_pages = $itens_per_page ? ceil($total_items / $itens_per_page) : 0;
  $paged = $request['paged'];
  
  if (!empty($paged)){
    if ($paged > $total_pages) $paged = $total_pages;
  }
  else $paged = 1;

  list($init, $limit) = define_init_and_limits_for_loops($paged, $total_items, $total_pages, $itens_per_page);
  
  $reponse = [
    'total_items' => $total_items,
    'total_pages' => $total_pages,
    'paged' => $paged,
  ];
  
  $count = 0;
  for ($i = $init; $i <= $limit; $i++) {
    $item = $repeater_items[$i];
    $note = empty(!$item['general_information_differential_note']) ? $item['general_information_differential_note'] : false;
    
    $reponse['differentials'][$count] = [
      'id_on_page' => $i,
      'title' => $item['general_information_differential_title'],
      'excerpt' => $item['general_information_differential_excerpt'],
      'thumbnail' => $item['general_information_differential_thumbnail']['url'],
      'note' => $note,
    ];
  
    $count++;
  }

  return rest_ensure_response( $reponse );
}

function httfox_register_route_api_get_differentials() {
  $configRoutes = [
    'methods' => WP_REST_Server::READABLE,
    'callback' => 'httfox_api_get_differentials'
  ];

  register_rest_route(HTTFOX_API_VERSION_V1, '/differentials', $configRoutes);
}

if (httfox_acf_check()) {
  add_action('rest_api_init', 'httfox_register_route_api_get_differentials');
}

?>