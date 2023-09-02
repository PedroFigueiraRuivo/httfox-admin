<?php

$tax_name = 'httfox_category_services';

$args = [
  'title' => 'Novos projetos',
  'parent_name' => $tax_name,
  'slug' => 'new-projects',
  'description' => 'Itens que pertencem a um novo projeto',
];

$tax_new_projects = new httFox_create_custom_taxonomy_item($args);



$args = [
  'title' => 'Adicionais',
  'parent_name' => $tax_name,
  'slug' => 'additional',
  'description' => 'Itens que podem ser adicionados a um projeto existente',
];

$tax_new_item = new httFox_create_custom_taxonomy_item($args);



$args = [
  'title' => 'Manutenção',
  'parent_name' => $tax_name,
  'slug' => 'maintenance',
  'description' => 'Itens que podem ser utilizados em processo de manutenção de um projeto',
];

$tax_new_item = new httFox_create_custom_taxonomy_item($args);
?>