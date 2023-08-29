<?php
$cpt_slug_id = 'general_information';

/*
 * =======================================================
 * BEGIN -> Create Single Post
 * @Code runner
 */
// Post: Contato
$args_post_contato = [
  'cpt_slug_id' => $cpt_slug_id,
  'post_title' => 'Contato',
  'post_slug' => 'contato',
];

$create_post_contato = new httfox_create_single_post_in_post_type($args_post_contato);
$id_post_contato = $create_post_contato->create_post();



/*
 * =======================================================
 * BEGIN -> Acf config Group and Fields
 * @Code runner
 */
// Post: Contato
if ($id_post_contato) {
  $acf_general_contact_group_key = 'acf_group_general_information_contact_general';
  
  $args_acf_group_info = [
    'group_key' => $acf_general_contact_group_key, // group key
    'group_title' => 'Informações de contato', // title section
    'group_fields'  => array(
      array(
        'key' => 'field_1_tab',
        'label' => 'Geral',
        'name' => 'general_information_contato_geral',
        'type' => 'tab',
      ),
      array(
        'key' => 'field_2_email',
        'label' => 'E-mail',
        'name' => 'general_information_contato_geral_email',
        'type' => 'email',
        'add_config' => array('placeholder' => 'email_name@empresa.com'),
      ),
      array(
        'key' => 'field_3_phone',
        'label' => 'Telefone',
        'name' => 'general_information_contato_geral_phone',
        'type' => 'number',
        'add_config' => array('placeholder' => '00000000000'),
      ),
      array(
        'key' => 'field_3_addres',
        'label' => 'Endereço',
        'name' => 'general_information_contato_geral_addres',
        'type' => 'number',
        'add_config' => array('placeholder' => 'Rua zero, 0. Av Alí perto - Bairro tal, Cidade - RJ / 00000-000'),
      ),
      array(
        'key' => 'field_2_tab',
        'label' => 'Redes sociais',
        'name' => 'general_information_contato_redes_sociais',
        'type' => 'tab',
      ),
      array(
        'key' => 'field_1_url',
        'label' => 'Facebook',
        'name' => 'general_information_contato_redes_sociais_facebook',
        'type' => 'url',
        'add_config' => array('placeholder' => 'https://'),
      ),
      array(
        'key' => 'field_2_url',
        'label' => 'Instagram',
        'name' => 'general_information_contato_redes_sociais_instagram',
        'type' => 'url',
        'add_config' => array('placeholder' => 'https://'),
      ),
      array(
        'key' => 'field_3_url',
        'label' => 'Linkedin',
        'name' => 'general_information_contato_redes_sociais_linkedin',
        'type' => 'url',
        'add_config' => array('placeholder' => 'https://'),
      ),
      array(
        'key' => 'field_4_url',
        'label' => 'Youtube',
        'name' => 'general_information_contato_redes_sociais_youtube',
        'type' => 'url',
        'add_config' => array('placeholder' => 'https://'),
      ),
    ),
  ];
  
  $args_acf_group_location = [ // rules
    [ // ou
      [ // e
        'param' => 'post',
        'operator' => '==',
        'value' => $id_post_contato,
      ],
    ],
  ];
  
  $acf_register_group_contact_infos = new httfox_register_acf_groups_fields($args_acf_group_info, $args_acf_group_location);
}

?>