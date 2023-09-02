<?php

if (!class_exists('httfox_add_item-on-table-database')) {
  class httfox_add_item_on_table_database {
    private $key;
    private $name;
    private $value;
    private $table_name;

    public function __construct($args) {
      $this->table_name = HTTFOX_DATABASE_TABLE_NAME ?? null;
      $this->key = $args['key'] ?? null;
      $this->name = $args['name'] ?? null;
      $this->value = $args['value'] ?? null;
    }

    public function add_item() {
      $table_name = $this->table_name;
      if (empty($this->key) || empty($this->name) || empty($this->table_name)) return null;
      global $wpdb;
      // Verifique se o item já existe na tabela
      $item_exists = $wpdb->get_var( $wpdb->prepare( "SELECT COUNT(*) FROM " . $this->table_name . " WHERE httfox_key = %s", $this->key ) );

      if (!$item_exists) {
        // O item ainda não existe, então você pode adicioná-lo
        $data = array(
          'httfox_key' => $this->key,
          'httfox_name' => $this->name,
          'httfox_value' => $this->value,
        );

        $wpdb->insert( $table_name, $data );
        
        return true;
      } else {
        // O item já existe, então atualize-o
        $data = array(
          'httfox_name' => $this->name,
          'httfox_value' => $this->value,
        );

        $where = array(
            'httfox_key' => $this->key,
        );

        $wpdb->update($table_name, $data, $where);

        return true; // Indique que o item foi atualizado com sucesso
      }
      
      return false;
    }

    public function get_item(){
      global $wpdb;
      if (empty($this->key) || empty($this->name) || empty($this->table_name)) return null;

      // Consulta SQL para recuperar o valor
      $query = $wpdb->prepare(
        "SELECT httfox_value FROM " . $this->table_name . " WHERE httfox_key = %s AND httfox_name = %s",
        $this->key,
        $this->name,
      );

      $result = $wpdb->get_var( $query );

      if (!empty($result)) return $result;

      return false;
    }
  }
}

?>