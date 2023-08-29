<?php
$args = [
  'project_steps',
  'Etapas de projeto',
  'Etapa',
  array( 'slug' => 'project_steps' ),
  'post',
  array( 'title', 'editor', 'thumbnail', 'excerpt', 'custom-fields', 'revisions' ),
  'dashicons-editor-ol'
];

$cpt_project_steps = new httFox_create_custom_post_types($args);
?>