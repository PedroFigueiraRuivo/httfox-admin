<?php
$args = [
  'common_questions',
  'Perguntas frequntes',
  'Pergunta',
  array( 'slug' => 'common_questions' ),
  'post',
  array( 'title', 'editor', 'thumbnail', 'excerpt', 'custom-fields', 'revisions' ),
  'dashicons-testimonial'
];

$cpt_common_questions = new httFox_create_custom_post_types($args);
?>