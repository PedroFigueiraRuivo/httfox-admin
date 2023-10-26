<?php
$ctp_slug = 'httfox_stories';
$path_success_stories = HTTFOX_DIRECTORY . '/includes/config/custom-post-types/success-stories/';

$args = [
  'cpt_name_id' => $ctp_slug,
  'plural_name' => 'Casos de sucesso',
  'singular_name' => 'Caso de sucesso',
  'rewrite' => array('slug' => $ctp_slug),
  'capability' => 'post',
  'supports' => array('title', 'thumbnail', 'custom-fields', 'revisions'),
  'icon' => 'dashicons-star-filled'
];

$cpt_success_stories = new httFox_create_custom_post_types($args);


// acf fields
require_once($path_success_stories . 'config-acf-fiels-success-stories.php');
?>