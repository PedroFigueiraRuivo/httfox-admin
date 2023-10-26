<?php
/*
* =======================================================
* BEGIN -> Create Custom post Type
* @Code runner
*/
$cpt_slug_id = 'httfox_information';
$path_general_information = HTTFOX_DIRECTORY . '/includes/config/custom-post-types/general-information/';

$args_cpt = [
  'cpt_name_id' => $cpt_slug_id,
  'plural_name' => 'Informações gerais',
  'singular_name' => 'Informação geral',
  'rewrite' => array( 'slug' => 'general_information' ),
  'capability' => 'post',
  'supports' => array( 'title', 'custom-fields', 'revisions' ),
  'icon' => 'dashicons-info'
];

$cpt_general_information = new httFox_create_custom_post_types($args_cpt);
// END -> Create Custom post Type

// // Add single posts
require_once($path_general_information . 'config-post-contact.php');
require_once($path_general_information . 'config-post-common-questions.php');
require_once($path_general_information . 'config-post-differentials.php');
// require_once($path_general_information . 'config-post-appearance.php');

?>