<?php

if( ! class_exists( 'httFox_create_custom_taxonomy' ) ){
  class httFox_create_custom_taxonomy {
    private $id;
    private $post_type_id;
    private $plural_name;
    private $singular_name;
    private $hierarchical;
    private $arr_rewrite;

    public function __construct( $args ) {
      [
        $this->id,
        $this->post_type_id,
        $this->plural_name,
        $this->singular_name,
        $this->hierarchical,
        $this->arr_rewrite,
      ] = $args;

      add_action( 'init', [ $this, 'httfox_create_custom_taxonomia' ] );
    }

    public function httfox_create_custom_taxonomia() {
      $labels = array(
          'name'                       => $this->singular_name,
          'singular_name'              => $this->singular_name,
          'search_items'               => 'Buscar ' . $this->plural_name,
          'all_items'                  => 'Todas os ' . $this->plural_name,
          'parent_item'                => $this->singular_name . ' Pai',
          'parent_item_colon'          => $this->singular_name . ' Pai:',
          'edit_item'                  => 'Editar ' . $this->singular_name,
          'update_item'                => 'Atualizar ' . $this->singular_name,
          'add_new_item'               => 'Adicionar Novo ' . $this->singular_name,
          'new_item_name'              => 'Nome do Novo ' . $this->singular_name,
          'menu_name'                  => $this->plural_name
      );
    
      $args = array(
          'labels'                    => $labels,
          'hierarchical'              => $this->hierarchical,
          'show_ui'                   => true,
          'show_admin_column'         => true,
          'query_var'                 => true,
          'rewrite'                   => $this->arr_rewrite
      );
    
      register_taxonomy( $this->id, $this->post_type_id, $args );
    }
  }
}
?>
