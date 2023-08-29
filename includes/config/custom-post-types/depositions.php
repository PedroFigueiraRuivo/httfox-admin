<?php
$args = [
  'depositions',
  'Depoimentos',
  'Depoimento',
  array( 'slug' => 'depositions' ),
  'post',
  array( 'title', 'editor', 'thumbnail', 'excerpt', 'custom-fields', 'revisions' ),
  'dashicons-format-quote'
];

$cpt_depositions = new httFox_create_custom_post_types($args);
?>