<?php
$cpt_slug_id = 'httfox_stories';
$group_key_path = 'httfox_acf_group_success_stories';
$group_name_path = 'success_stories';

// Section - Main banner
acf_add_local_field_group(array(
  'key' => $group_key_path . '_success_storries',
  'title' => 'Cadastro de caso de sucesso',
  'fields' => array(
    array(
      'key' => $group_key_path . '_success_storries' . '_field_0',
      'label' => 'Conteúdo',
      'name' => $group_name_path . '_success_storries_content',
      'type' => 'textarea',
      'rows' => 10,
      'required' => 1,
    ),
    array(
      'key' => $group_key_path . '_success_storries' . '_field_1',
      'label' => 'Número destaque',
      'name' => $group_name_path . '_success_storries_number',
      'type' => 'number',
      'required' => 1,
    ),
    array(
      'key' => $group_key_path . '_success_storries' . '_field_2',
      'label' => 'Prefixo do número',
      'name' => $group_name_path . '_success_storries_pre_number',
      'type' => 'text',
    ),
    array(
      'key' => $group_key_path . '_success_storries' . '_field_3',
      'label' => 'Dado apresentado',
      'name' => $group_name_path . '_success_storries_data',
      'type' => 'text',
      'required' => 1,
    ),
    array(
      'key' => $group_key_path . '_success_storries' . '_field_4',
      'label' => 'Arquivo para visualização',
      'name' => $group_name_path . '_success_storries_url_archive',
      'type' => 'url',
      'placeholder' => 'https://',
    ),
  ),
  'location' => array(
    array(
      array(
        'param' => 'post_type',
        'operator' => '==',
        'value' => $cpt_slug_id,
      ),
    ),
  ),
));
?>