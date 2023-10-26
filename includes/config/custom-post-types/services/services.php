<?php
$ctp_slug = 'httfox_services';
$path_services = HTTFOX_DIRECTORY . '/includes/config/custom-post-types/services/';

$args = [
  'cpt_name_id' => $ctp_slug,
  'plural_name' => 'Serviços',
  'singular_name' => 'Serviço',
  'rewrite' => array( 'slug' => $ctp_slug ),
  'capability' => 'post',
  'supports' => array( 'title', 'thumbnail', 'excerpt', 'custom-fields', 'revisions' ),
  'icon' => 'dashicons-hammer'
];

$cpt_services = new httFox_create_custom_post_types($args);

// Add taxonomys
require_once($path_services . 'config-taxonomys.php');

?>