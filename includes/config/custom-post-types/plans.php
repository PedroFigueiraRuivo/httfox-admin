<?php
$args = [
  'plans',
  'Planos',
  'Plano',
  array( 'slug' => 'plans' ),
  'post',
  array( 'title', 'editor', 'thumbnail', 'excerpt', 'custom-fields', 'revisions' ),
  'dashicons-screenoptions'
];

$cpt_plans = new httFox_create_custom_post_types($args);
?>