<?php
$args = [
  'differentials',
  'Diferenciais',
  'Diferencial',
  array( 'slug' => 'differentials' ),
  'post',
  array( 'title', 'editor', 'thumbnail', 'excerpt', 'custom-fields', 'revisions' ),
  'dashicons-star-filled'
];

$cpt_differentials = new httFox_create_custom_post_types($args);
?>