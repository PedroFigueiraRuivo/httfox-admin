<?php
/*
 * =======================================================
 * BEGIN -> General security
 */
if ( ! defined( 'ABSPATH' ) ) {
  exit; // Impede o acesso direto ao arquivo
}
// END -> General security


/*
 * =======================================================
 * BEGIN -> Define Consts 
 */
if( ! defined( 'HTTFOX_DIRECTORY' ) ){
  define('HTTFOX_DIRECTORY', $directory = get_stylesheet_directory());
}

if( ! defined( 'HTTFOX_DIRECTORY_URI' ) ){
  define('HTTFOX_DIRECTORY_URI', $directory = get_stylesheet_directory_uri());
}

if( ! defined( 'HTTFOX_API_DEVELOPER' ) ){
  define('HTTFOX_API_DEVELOPER', true);
}

if( ! defined( 'HTTFOX_API_VERSION_V1' ) ){
  define('HTTFOX_API_VERSION_V1', 'v1');
}

if( ! defined( 'HTTFOX_REST_URL_PREFIX' ) ){
  define('HTTFOX_REST_URL_PREFIX', 'httfox_api');
}

if( ! defined( 'HTTFOX_DATABASE_TABLE_NAME' ) ){
  global $wpdb;
  define('HTTFOX_DATABASE_TABLE_NAME', $wpdb->prefix . 'httFox');
}

if( ! defined( 'HTTFOX_API_VALID_URLS' ) ){
  define('HTTFOX_API_VALID_URLS', [
    'http://localhost/adm.httfox.com/',
    'http://127.0.0.1:5173/',
  ]);
}
// END -> Define Consts


/*
 * =======================================================
 * BEGIN -> DB config
 * @Code runner
 */
require_once (HTTFOX_DIRECTORY . '/includes/config/data-base.php');
// END -> DB config


/*
 * =======================================================
 * BEGIN -> ACF Config
 * @Code runner
 */
require_once (HTTFOX_DIRECTORY . '/includes/config/acf.php');
// END -> ACF Config


/*
 * =======================================================
 * BEGIN -> Helps functions Imports
 * @Code static
 */
require_once (HTTFOX_DIRECTORY . '/includes/helps/gerency-debug-logs.php');
// END -> Helps functions Imports


/*
 * =======================================================
 * BEGIN -> Class Imports
 * @Code static
 */
require_once (HTTFOX_DIRECTORY . '/includes/class/add-item-on-table-database.php');
require_once (HTTFOX_DIRECTORY . '/includes/class/register-custom-post-types.php');
require_once (HTTFOX_DIRECTORY . '/includes/class/register-custom-taxonomy.php');
require_once (HTTFOX_DIRECTORY . '/includes/class/register-custom-taxonomy-item.php');
require_once (HTTFOX_DIRECTORY . '/includes/class/register-acf-groups-and-fields.php');
require_once (HTTFOX_DIRECTORY . '/includes/class/create-single-post-in-post-type.php');
// END -> Class Imports


/*
 * =======================================================
 * BEGIN -> Config
 * @Code runner
 */
$path_config = HTTFOX_DIRECTORY . '/includes/config/';

require_once ($path_config  . 'login.php');
require_once ($path_config  . 'clear-wp-dashboard-widget.php');
require_once ($path_config  . 'add-wp-dashboard-widget.php');
require_once ($path_config  . 'clear-wp-admin-menu.php');
require_once ($path_config  . 'remove-wp-native-endpoints.php');
require_once ($path_config  . 'custom-rest-url-prefix.php');
require_once ($path_config  . 'show-admin-bar.php');
require_once ($path_config  . 'disabled-gutenberg.php');
require_once ($path_config  . 'theme-midia.php');
// END -> Config


/*
 * =======================================================
 * BEGIN -> Config CPTs
 * @Code runner
 */
$path_config_cpts = HTTFOX_DIRECTORY . '/includes/config/custom-post-types/';

require_once ($path_config_cpts  . 'general-information/general-information.php');
require_once ($path_config_cpts  . 'services/services.php');
require_once ($path_config_cpts  . 'depositions/depositions.php');
require_once ($path_config_cpts  . 'success-stories/success-stories.php');
require_once ($path_config_cpts  . 'pages/pages.php');
// END -> Config CPTs



/*
 * =======================================================
 * BEGIN -> Register endpoints
 * @Code runner
 */
$path_endpoints = HTTFOX_DIRECTORY . '/includes/endpoints/';
require_once ($path_endpoints . 'register-v1.php');
// END -> Register endpoints

function httfox_get_revisions($post_id) {
  $revisions = wp_get_post_revisions($post_id);
  if (empty($revisions)) return null;

  $output = [];

  foreach ($revisions as $revision) {
    $output[] = $revision;
  }

  return $output;
}

function httfox_compare_post_revisions($post_id, $json_encode = true) {
  $revisions = wp_get_post_revisions($post_id);
  $current_post = get_post($post_id);
  $output = [];

  foreach ($revisions as $revision) {
      $revision_content = apply_filters('the_content', $revision->post_content);
      $current_content = apply_filters('the_content', $current_post->post_content);
      $diff = wp_text_diff($revision_content, $current_content);
      
      $output[] = [
          'revision' => $revision,
          'diff' => $diff,
      ];
  }

  if ($json_encode) return json_encode($output);
  return $output;
}


function httfox_get_posts() {
  $args = array(
    'post_type' => array('httfox_depositions'), // 'any' busca qualquer tipo de postagem
    'posts_per_page' => -1, // Mostra todas as postagens. -1 para mostrar todas ou qualquer número para limitar o número de postagens exibidas.
  );

  $the_query = new WP_Query($args);

  if ($the_query->have_posts()) {
    $output = [];

    while ($the_query->have_posts()) {
      $the_query->the_post();
      $post = $the_query->post;

      $output[] = [
        'post' => $post,
        'post_revisions' => httfox_compare_post_revisions($post->ID),
      ];
    }
    wp_reset_postdata(); // Restaura os dados da postagem original

    httfox_gerency_debug_logs($output);
  } else 
    httfox_gerency_debug_logs('Nenhum post encontrado');

}

add_action( 'init', 'httfox_get_posts' );


  
?>