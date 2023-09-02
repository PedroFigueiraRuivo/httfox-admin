<?php
$ctp_slug = 'httfox_portfolio';

$args_tax_category = [
  'tax_name_id' => 'httfox_category_portfolio',
  'cpt_name_id' => $ctp_slug,
  'plural_name' => 'Categorias',
  'singular_name' => 'Categoria',
  'hierarchical' => true,
  'rewrite' => array( 'slug' => 'category-portfolio-' . $ctp_slug ),
];

$tax_portfolio = new httFox_create_custom_taxonomy($args_tax_category);
?>