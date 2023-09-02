<?php
$path_depositions = HTTFOX_DIRECTORY . '/includes/config/custom-post-types/depositions/';

/*
* =======================================================
* BEGIN -> Create Custom post Type
* @Code runner
*/
$args = [
  'cpt_name_id' => 'httfox_depositions',
  'plural_name' => 'Depoimentos',
  'singular_name' => 'Depoimento',
  'rewrite' => array( 'slug' => 'httfox_depositions' ),
  'capability' => 'post',
  'supports' => array( 'title', 'custom-fields', 'revisions' ),
  'icon' => 'dashicons-format-quote'
];

$cpt_depositions = new httFox_create_custom_post_types($args);
// END -> Create Custom post Type


// Add single posts
require_once($path_depositions . 'config-acf-fields-depositions.php');

?>