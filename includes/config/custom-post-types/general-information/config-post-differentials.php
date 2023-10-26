<?php
$cpt_slug_id = 'httfox_information';

/*
 * =======================================================
 * BEGIN -> Create Single Post
 * @Code runner
 */
// Post: Differentials
$args_new_post_differentials = [
  'cpt_slug_id' => $cpt_slug_id,
  'post_title' => 'Diferenciais',
  'post_slug' => 'differentials',
  'database_key' => $cpt_slug_id . '_differentials',
];

$create_new_post_differentials = new httfox_create_single_post_in_post_type($args_new_post_differentials);
$id_new_post_differentials = $create_new_post_differentials->create_post();


/*
 * =======================================================
 * BEGIN -> Acf config Group and Fields
 * @Code runner
 */
// Post: Differentials
if ($id_new_post_differentials) {
  $group_key_path = 'httfox_acf_group_general_information_differentials';
  $group_name_path = 'general_information_differentials';

  // Section - Results
  acf_add_local_field_group(array(
    'key' => $group_key_path . '_differential',
    'title' => 'Cadastro geral de diferenciais',
    'fields' => array(
      array(
        'key' => $group_key_path . '_differential' . '_field_0',
        'label' => 'Diferenciais',
        'name' => $group_name_path . 'commom_questions_list',
        'type' => 'repeater',
        'layout' => 'row',
        'collapsed' => $group_key_path . '_differential' . '_field_1',
        'min' => 4,
        'max' => 6,
        'sub_fields' => array(
          array(
            'key' => $group_key_path . '_differential' . '_field_1',
            'label' => 'Título',
            'name' => $group_name_path . '_differential_title',
            'type' => 'text',
            'required' => 1,
          ),
          array(
            'key' => $group_key_path . '_differential' . '_field_2',
            'label' => 'Descrição',
            'name' => $group_name_path . '_differential_description',
            'type' => 'textarea',
            'rows' => 2,
            'required' => 1,
          ),
          array(
            'key' => $group_key_path . '_differential' . '_field_3',
            'label' => 'Anotação',
            'name' => $group_name_path . '_differential_note',
            'type' => 'text',
          ),
          array(
            'key' => $group_key_path . '_differential' . '_field_4',
            'label' => 'Imagem',
            'name' => $group_name_path . '_differential_image',
            'type' => 'file',
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
          'value' => $id_new_post_differentials,
        ),
      ),
    ),
  ));
}

?>