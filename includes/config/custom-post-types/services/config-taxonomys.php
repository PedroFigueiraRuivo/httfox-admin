<?php
$ctp_slug = 'services';

$args_tax_category = [
  'category_services',
  $ctp_slug,
  'Categorias',
  'Categoria',
  true,
  array( 'slug' => 'category-services-' . $ctp_slug ),
];

$tax_services = new httFox_create_custom_taxonomy($args_tax_category);
?>