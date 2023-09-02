<?php
$ctp_slug = 'httfox_portfolio';
$path_services = HTTFOX_DIRECTORY . '/includes/config/custom-post-types/portfolio/';

$args = [
  'cpt_name_id' => $ctp_slug,
  'plural_name' => 'Portfólio',
  'singular_name' => 'Portfólio',
  'rewrite' => array( 'slug' => $ctp_slug ),
  'capability' => 'post',
  'supports' => array( 'title', 'thumbnail', 'excerpt', 'custom-fields', 'revisions' ),
  'icon' => 'dashicons-portfolio'
];

$cpt_services = new httFox_create_custom_post_types($args);

// Add taxonomys
require_once($path_services . 'config-taxonomys.php');
?>