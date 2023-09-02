<?php
$cpt_slug_id = 'httfox_depositions';


/*
 * =======================================================
 * BEGIN -> Acf config Group and Fields
 * @Code runner
 */
// Post: httfox_depositions
$httfox_acf_depositions_group_key = 'acf_group_cpt_httfox_depositions';

$httfox_args_acf_group_info_depositions = [
  'group_key' => $httfox_acf_depositions_group_key, // group key
  'group_title' => 'Depoimento', // title section
  'group_fields'  => array(
    array(
      'key' => 'field_1_deposition',
      'label' => 'Conteúdo',
      'name' => 'httfox_depositions_deposition',
      'type' => 'textarea',
      'rows' => 10,
      'required' => 1,
    ),
    array(
      'key' => 'field_1_author',
      'label' => 'Autor',
      'name' => 'httfox_depositions_author',
      'type' => 'text',
      'required' => 1,
    ),
    array(
      'key' => 'field_1_company',
      'label' => 'Empresa',
      'name' => 'httfox_depositions_company',
      'type' => 'text',
      'required' => 1,
    ),
    array(
      'key' => 'field_1_website',
      'label' => 'Website',
      'name' => 'httfox_depositions_website',
      'type' => 'url',
      'placeholder' => 'https://'
    ),
  ),
];

$httfox_args_acf_group_location_depositions = [ // rules
  [ // ou
    [ // e
      'param' => 'post_type',
      'operator' => '==',
      'value' => $cpt_slug_id,
    ],
  ],
];

$httfox_acf_register_group_depositions_infos = new httfox_register_acf_groups_fields($httfox_args_acf_group_info_depositions, $httfox_args_acf_group_location_depositions);

?>