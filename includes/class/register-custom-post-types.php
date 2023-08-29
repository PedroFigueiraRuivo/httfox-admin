<?php

if( ! class_exists( 'httFox_create_custom_post_types' ) ){
  class httFox_create_custom_post_types {
    private $id;
    private $plural_name;
    private $singular_name;
    private $arr_rewrite;
    private $capability;
    private $arr_supports;
    private $icon;

    public function __construct( $args ) {
      [
        $this->id,
        $this->plural_name,
        $this->singular_name,
        $this->arr_rewrite,
        $this->capability,
        $this->arr_supports,
        $this->icon
      ] = $args;

      add_action( 'init', [ $this, 'httfox_register_cpt' ] );
    }

    public function httfox_register_cpt() {
      $labels = array(
        'name'               => $this->plural_name,
        'singular_name'      => $this->singular_name,
        'menu_name'          => $this->plural_name,
        'add_new'            => 'Adicionar Novo',
        'add_new_item'       => 'Adicionar Novo ' . $this->singular_name,
        'edit'               => 'Editar',
        'edit_item'          => 'Editar ' . $this->singular_name,
        'new_item'           => 'Novo ' . $this->singular_name,
        'view'               => 'Ver',
        'view_item'          => 'Ver ' . $this->singular_name,
        'search_items'       => 'Buscar ' . $this->plural_name,
        'not_found'          => 'Nenhum ' . $this->singular_name . ' Encontrado',
        'not_found_in_trash' => 'Nenhum ' . $this->singular_name . ' Encontrado na Lixeira',
        'parent'             => $this->singular_name . ' Pai'
      );
    
      $args = array(
        'labels'             => $labels,
        'public'             => true,
        'has_archive'        => true,
        'publicly_queryable' => true,
        'query_var'          => true,
        'rewrite'            => $this->arr_rewrite,
        'capability_type'    => $this->capability,
        'hierarchical'       => false,
        'menu_position'      => 5,
        'supports'           => $this->arr_supports,
        'menu_icon'          => $this->icon
      );

      register_post_type( $this->id, $args );
    }
  }
}

?>