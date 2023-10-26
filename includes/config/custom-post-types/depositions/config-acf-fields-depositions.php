<?php
$cpt_slug_id = 'httfox_depositions';
$group_key_path = 'httfox_acf_group_depositions';
$group_name_path = 'depositions';


// Section - Main banner
acf_add_local_field_group(array(
  'key' => $group_key_path . '_deposition',
  'title' => 'Cadastro de depoimento',
  'fields' => array(
    array(
      'key' => $group_key_path . '_deposition' . '_field_0',
      'label' => 'Depoimento',
      'name' => $group_name_path . '_deposition_deposition',
      'type' => 'textarea',
      'rows' => 10,
      'required' => 1,
    ),
    array(
      'key' => $group_key_path . '_deposition' . '_field_1',
      'label' => 'Autor',
      'name' => $group_name_path . '_deposition_author',
      'type' => 'text',
      'required' => 1,
    ),
    array(
      'key' => $group_key_path . '_deposition' . '_field_2',
      'label' => 'Empresa',
      'name' => $group_name_path . '_deposition_company',
      'type' => 'text',
      'required' => 1,
    ),
    array(
      'key' => $group_key_path . '_deposition' . '_field_3',
      'label' => 'Website',
      'name' => $group_name_path . '_deposition_website_url',
      'placeholder' => 'https://',
      'type' => 'url',
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