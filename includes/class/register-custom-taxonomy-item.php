<?php

if( ! class_exists( 'httFox_create_custom_taxonomy_item' ) ){
  class httFox_create_custom_taxonomy_item {
    private $item_name;
    private $parent_tax;
    private $slug;
    private $description;

    public function __construct($args) {
      $this->item_name = $args['title']; //:string
      $this->parent_tax = $args['parent_name']; //:string ('tax_name')
      $this->slug = $args['slug']; //:string / path url
      $this->description = $args['description']; //:string

      add_action( 'init', [ $this, 'httfox_create_custom_taxonomia_item' ] );
    }

    public function httfox_create_custom_taxonomia_item() {
      // Primeiro, verifique se a função wp_insert_term() está disponível
      if (!function_exists('wp_insert_term')) return null;

      $term_args = array(
        'description' => empty($this->description) ? '' : $this->description,
        'slug' => empty($this->slug) ? '' : $this->slug,
      );

      $result = wp_insert_term($this->item_name, $this->parent_tax, $term_args);
    }
  }
}
?>