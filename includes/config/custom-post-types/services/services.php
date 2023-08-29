<?php
$ctp_slug = 'services';
$path_services = HTTFOX_DIRECTORY . '/includes/config/custom-post-types/services/';

$args = [
  $ctp_slug,
  'Serviços',
  'Serviço',
  array( 'slug' => $ctp_slug ),
  'post',
  array( 'title', 'thumbnail', 'excerpt', 'custom-fields', 'revisions' ),
  'dashicons-hammer'
];

$cpt_services = new httFox_create_custom_post_types($args);

// Add taxonomys
require_once($path_services . 'config-taxonomys.php');

// Add single taxonomies
require_once($path_services . 'config-tax-items.php');
?>