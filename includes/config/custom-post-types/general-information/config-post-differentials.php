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
  $acf_differentials_group_key = 'acf_group_cpt_general_information_differentials';
  
  $args_acf_group_info_differentials = [
    'group_key' => $acf_differentials_group_key, // group key
    'group_title' => 'Diferenciais', // title section
    'group_fields'  => array(
      array(
        'key' => 'field_1_repeater',
        'label' => 'Lista de diferenciais',
        'name' => 'general_information_differential_repeater',
        'type' => 'repeater',
        'add_config' => array(
          'sub_fields' => array(
            array(
              'key' => 'field_1_title',
              'label' => 'título',
              'name' => 'general_information_differential_title',
              'type' => 'text',
              'required' => 1,
            ),
            array(
              'key' => 'field_1_excerpt',
              'label' => 'Resumo',
              'name' => 'general_information_differential_excerpt',
              'type' => 'textarea',
              'rows' => 2,
              'required' => 1,
            ),
            array(
              'key' => 'field_1_image',
              'label' => 'Imagem destacada',
              'name' => 'general_information_differential_thumbnail',
              'type' => 'image',
              'required' => 1,
            ),
            array(
              'key' => 'field_1_note',
              'label' => 'Nota',
              'name' => 'general_information_differential_note',
              'type' => 'text',
            ),
          ),
          'collapsed' => 'field_1_title', // Campo que será exibido como título para cada repetição
          'min' => 1, // Número mínimo de repetições
          'layout' => 'block', // Layout das repetições (table ou block)
        ),
      ),
    ),
  ];
  
  $args_acf_group_location_differentials = [ // rules
    [ // ou
      [ // e
        'param' => 'post',
        'operator' => '==',
        'value' => $id_new_post_differentials,
      ],
    ],
  ];
  
  $acf_register_group_differentials_infos = new httfox_register_acf_groups_fields($args_acf_group_info_differentials, $args_acf_group_location_differentials);
}

?>