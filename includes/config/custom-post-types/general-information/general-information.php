<?php
/*
* =======================================================
* BEGIN -> Create Custom post Type
* @Code runner
*/
$cpt_slug_id = 'general_information';
$path_general_information = HTTFOX_DIRECTORY . '/includes/config/custom-post-types/general-information/';

$args_cpt = [
  $cpt_slug_id,
  'Informações gerais',
  'Informação geral',
  array( 'slug' => 'general_information' ),
  'post',
  array( 'title', 'custom-fields', 'revisions' ),
  'dashicons-info'
];

$cpt_general_information = new httFox_create_custom_post_types($args_cpt);
// END -> Create Custom post Type

// Add single posts
require_once($path_general_information . 'config-post-contato.php');
require_once($path_general_information . 'config-post-perguntas-frequentes.php');

?>