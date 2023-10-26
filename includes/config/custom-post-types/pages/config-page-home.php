<?php
$cpt_name_id = 'page';

$args_page_home = [
  'cpt_slug_id' => $cpt_name_id,
  'post_title' => 'Página inicial',
  'post_slug' => 'main-page',
  'database_key' => $cpt_name_id . '_main_page',
];

$create_page_home = new httfox_create_single_post_in_post_type($args_page_home);
$id_page_home = $create_page_home->create_post();





if ($id_page_home) {
  $group_key_path = 'httfox_acf_group_page_homepage';
  $group_name_path = 'page_homepage';

  // Section - Main banner
  acf_add_local_field_group(array(
    'key' => $group_key_path . '_main_banner',
    'title' => 'Seção - Banner principal',
    'fields' => array(
      array(
        'key' => $group_key_path . '_main_banner' . '_field_0',
        'label' => 'Título',
        'name' => $group_name_path . '_main_banner_title',
        'type' => 'text',
        'instructions' => 'Adicione o item em detaque dentro da tag strong',
        'required' => 1,
      ),
      array(
        'key' => $group_key_path . '_main_banner' . '_field_1',
        'label' => 'Texto de apoio',
        'name' => $group_name_path . '_main_banner_support_text',
        'type' => 'text',
        'required' => 1,
      ),
      array(
        'key' => $group_key_path . '_main_banner' . '_field_2',
        'label' => 'Imagem de destaque',
        'name' => $group_name_path . '_main_banner_attachment',
        'type' => 'file',
        'required' => 1,
      ),
    ),
    'location' => array(
      array(
        array(
          'param' => 'post',
          'operator' => '==',
          'value' => $id_page_home,
        ),
      ),
    ),
  ));
  

  // Section - Results
  acf_add_local_field_group(array(
    'key' => $group_key_path . '_results',
    'title' => 'Seção - Resultados',
    'fields' => array(
      array(
        'key' => $group_key_path . '_results' . '_field_0',
        'label' => 'Números',
        'name' => $group_name_path . 'numbers_list',
        'type' => 'repeater',
        'required' => 1,
        'layout' => 'table',
        'min' => 2,
        'max' => 3,
        'instructions' => 'Min: 2/ Max: 3',
        'wrapper' => array(
          'class' => 'httfox_no_toggle_all',
        ),
        'sub_fields' => array(
          array(
            'key' => $group_key_path . '_results' . '_field_2',
            'label' => 'Prefixo',
            'name' => $group_name_path . '_results_pre_number',
            'type' => 'text',
            'maxlength' => 1,
            'wrapper' => array(
              'width' => '100%',
              'style' => 'width: 90px;',
            ),
          ),
          array(
            'key' => $group_key_path . '_results' . '_field_1',
            'label' => 'Número',
            'name' => $group_name_path . '_results_number',
            'type' => 'number',
            'required' => 1,
            'wrapper' => array(
              'width' => '100%',
              'style' => 'width: 150px;',
            ),
          ),
          array(
            'key' => $group_key_path . '_results' . '_field_3',
            'label' => 'Descrição',
            'name' => $group_name_path . '_results_pre_description',
            'type' => 'text',
            'required' => 1,
          ),
        ),
      ),
    ),
    'location' => array(
      array(
        array(
          'param' => 'post',
          'operator' => '==',
          'value' => $id_page_home,
        ),
      ),
    ),
  ));
}

?>