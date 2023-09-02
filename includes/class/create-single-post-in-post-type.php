<?php

if (!class_exists('httfox_create_single_post_in_post_type')) {
  class httfox_create_single_post_in_post_type {
    private $cpt_slug_id;

    private $post_title;
    private $post_slug;
    private $post_status;

    private $mark_control_slug;
    private $mark_control_title;

    private $database_key;
    private $database_name;

    public function __construct($args) {
      $this->cpt_slug_id = $args['cpt_slug_id'];

      $this->post_title = $args['post_title'];
      $this->post_slug = $args['post_slug'];
      $this->post_status = $args['post_status'] ?? 'publish';

      $this->mark_control_key = '_' . $args['cpt_slug_id'] . '_' . $args['post_slug'];
      $this->mark_control_value = $args['cpt_slug_id'] . '_' . $args['post_slug'];

      $this->database_key = !empty($args['database_key']) ? $args['database_key'] : null;
      $this->database_name = 'register_post_id';
    }

    public function is_post_exist() {
      $post = get_posts([
        'post_type' => $this->cpt_slug_id,
        'meta_key' => $this->mark_control_key,
        'meta_value' => $this->mark_control_value,
      ]);

      if (empty($post)) return false;
      return $post[0]->ID;
    }

    public function create_post() {
      $post_id = $this->is_post_exist();
      
      if ($post_id) return $post_id;
      
      $new_post = array(
        'post_title' => $this->post_title,
        'post_type' => $this->cpt_slug_id,
        'post_status' => $this->post_status,
        'post_name' => $this->post_slug,
      );
      
      $new_post_id = wp_insert_post($new_post);
      
      if ($new_post_id && $this->database_key) {
        $args_database = [
          'key' => $this->database_key,
          'name' => $this->database_name,
          'value' => $new_post_id,
        ];
        
        $gerency_database = new httfox_add_item_on_table_database($args_database);
        $isAddedDatabase = $gerency_database->add_item();

        update_post_meta($new_post_id, $this->mark_control_key, $this->mark_control_value);
        return $new_post_id;
      }

      return null;
    }

    public function listener_delet_post($post_id) {
      // Verifique se o post que está sendo excluído é o tipo de post específico que você deseja monitorar
      if (get_post_type($post_id) == $this->cpt_slug_id) {    
          // Obtenha o objeto da sua classe ou crie uma instância dela
          $item_remover = new httfox_add_item_on_table_database(array(
              'key' => $this->database_key,
              'name' => $this->database_name, // Nome associado ao item
          ));
    
          // Remova o item da tabela
          $item_remover->remove_item();
      }
    }
  }
}

?>