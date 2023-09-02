<?php
$ctp_slug = 'httfox_services';

$args_tax_category = [
  'tax_name_id' => 'httfox_category_services',
  'cpt_name_id' => $ctp_slug,
  'plural_name' => 'Categorias',
  'singular_name' => 'Categoria',
  'hierarchical' => true,
  'rewrite' => array( 'slug' => 'category-services-' . $ctp_slug ),
];

$tax_services = new httFox_create_custom_taxonomy($args_tax_category);
?>