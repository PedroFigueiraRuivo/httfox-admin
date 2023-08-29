<?php

if(!class_exists('httfox_register_acf_groups_fields')) {
  class httfox_register_acf_groups_fields {
    private $group_key; //string
    private $group_title; //string
    private $group_fields; //string
    private $group_location; //array of arrays of arrays

    public function __construct($args, $location) {
      $this->group_key = $args['group_key'] ?? null;
      $this->group_title = $args['group_title'] ?? null;
      $this->group_fields = $args['group_fields'] ?? null;
      $this->group_location = $location ?? null;

      add_action('acf/init', [$this, 'register_group']);
    }

    private function validate_array_keys($key, $arr, $default_return = null) {
      if (array_key_exists($key, $arr)) {
        if (empty($arr[$key])) return $default_return ?? false;
        else if (!empty($arr[$key])) return $arr[$key];

        return $default_return ?? true;
      }
      
      return $default_return ?? null;
    }

    private function merge_array_with_subarray($arr_parent, $arr_child_key, $default_return = null) {
      $arr_trat = $this->validate_array_keys($arr_child_key, $arr_parent, $default_return);

      if ($arr_trat) {
        $subArray = $arr_parent[$arr_child_key];

        unset($arr_parent[$arr_child_key]);

        $mergedArray = array_merge($arr_parent, $subArray);
    
        return $mergedArray;
      }

      return $arr_trat;
    }

    public function validate_fields($fields) {
      $register = 0;
      $arrReturn = [];
      for ($i = 0; $i < count($fields); $i++) {
        $field = $fields[$i];

        $key = !empty($field['key']) ? $this->group_key . '_' . $field['key'] : null;
        $name = $field['name'] ?? null;
        $type = $field['type'] ?? null;
        $field['label'] = $this->validate_array_keys('label', $field, $name);

        if ($key && $name && $type && !$this->is_acf_field_registered($key, $name)) {
          $arr_merged = $this->merge_array_with_subarray($field, 'add_config');

          if ($arr_merged) $arrReturn[$i] = $arr_merged;
          else $arrReturn[$i] = $field;

          $register++;
        }
      }

      if ($register) return $arrReturn;
      return null;
    }

    public function is_acf_field_registered($field_key, $field_name) {
      if (empty($field_key) || empty($field_name)) return null;

      $existing_field_key = acf_get_field($field_key);
      $existing_field_name = acf_get_field($field_name);

      if ($existing_field_key || $existing_field_name) return true;
      return false;
    }

    public function is_acf_group_key_registered($group_key) {
      if (empty($group_key)) return null;

      $existing_group = acf_get_field_groups(array('key' => $group_key));

      if ($existing_group) return true;
      return false;
    }

    public function register_group() {
      if ($this->is_acf_group_key_registered($this->group_key)) return null;

      $group_fields = $this->validate_fields($this->group_fields);
      $new_group_fields = $group_fields ?? [];
      

      acf_add_local_field_group(array(
        'key' => $this->group_key,
        'title' => $this->group_title,
        'fields' => $new_group_fields,
        'location' => $this->group_location,
      ));
    }
  }
}
?>