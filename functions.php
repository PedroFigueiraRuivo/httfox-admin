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

if( ! defined( 'HTTFOX_API_VALID_URLS' ) ){
  define('HTTFOX_API_VALID_URLS', [
    'http://localhost/adm.httfox.com/',
    'http://127.0.0.1:5173/',
  ]);
}
// END -> Define Consts


/*
 * =======================================================
 * BEGIN -> ACF Config
 * @Code runner
 */
require_once (HTTFOX_DIRECTORY . '/includes/config/acf.php');
// END -> ACF Config



/*
 * =======================================================
 * BEGIN -> Class Imports
 * @Code static
 */
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

require_once ($path_config  . 'remove-wp-native-endpoints.php');
require_once ($path_config  . 'custom-rest-url-prefix.php');
require_once ($path_config  . 'show-admin-bar.php');
require_once ($path_config  . 'disabled-gutenberg.php');
require_once ($path_config  . 'theme-attachment-support.php');
require_once ($path_config  . 'add-duplicate-posts.php');
// END -> Config


/*
 * =======================================================
 * BEGIN -> Config CPTs
 * @Code runner
 */
$path_config_cpts = HTTFOX_DIRECTORY . '/includes/config/custom-post-types/';

require_once ($path_config_cpts  . 'general-information/general-information.php');
// require_once ($path_config_cpts  . 'common-questions.php');
// require_once ($path_config_cpts  . 'depositions.php');
// require_once ($path_config_cpts  . 'plans.php');
require_once ($path_config_cpts  . 'services/services.php');
// require_once ($path_config_cpts  . 'project-steps.php');
// require_once ($path_config_cpts  . 'differentials.php');
// END -> Config CPTs


/*
 * =======================================================
 * BEGIN -> Register endpoints
 * @Code runner
 */
$path_endpoints = HTTFOX_DIRECTORY . '/includes/endpoints/';
require_once ($path_endpoints . 'register-v1.php');
// END -> Register endpoints
?>