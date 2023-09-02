<?php
$cpt_slug_id = 'httfox_information';

/*
 * =======================================================
 * BEGIN -> Create Single Post
 * @Code runner
 */
// Post: contact
$args_post_contact = [
  'cpt_slug_id' => $cpt_slug_id,
  'post_title' => 'Contato',
  'post_slug' => 'contact',
  'database_key' => $cpt_slug_id . '_contact',
];

$create_post_contact = new httfox_create_single_post_in_post_type($args_post_contact);
$id_post_contact = $create_post_contact->create_post();


/*
 * =======================================================
 * BEGIN -> Acf config Group and Fields
 * @Code runner
 */
// Post: contact
if ($id_post_contact) {
  $acf_general_contact_group_key = 'acf_group_cpt_general_information_contact';
  
  $args_acf_group_info = [
    'group_key' => $acf_general_contact_group_key, // group key
    'group_title' => 'Informações de contato', // title section
    'group_fields'  => array(
      array(
        'key' => 'field_1_tab',
        'label' => 'Geral',
        'name' => 'general_information_contact_geral_tab',
        'type' => 'tab',
      ),
      array(
        'key' => 'field_1_email',
        'label' => 'E-mail',
        'name' => 'general_information_contact_geral_email',
        'type' => 'email',
        'add_config' => array('placeholder' => 'email_name@empresa.com'),
      ),
      array(
        'key' => 'field_1_phone',
        'label' => 'Telefone',
        'name' => 'general_information_contact_geral_phone',
        'type' => 'number',
        'add_config' => array('placeholder' => '00000000000'),
      ),
      array(
        'key' => 'field_1_addres',
        'label' => 'Endereço',
        'name' => 'general_information_contact_geral_addres',
        'type' => 'number',
        'add_config' => array('placeholder' => 'Rua zero, 0. Av Alí perto - Bairro tal, Cidade - RJ / 00000-000'),
      ),
      array(
        'key' => 'field_2_tab',
        'label' => 'Redes sociais',
        'name' => 'general_information_contact_redes_sociais_tab',
        'type' => 'tab',
      ),
      array(
        'key' => 'field_2_url_1',
        'label' => 'Facebook',
        'name' => 'general_information_contact_redes_sociais_facebook',
        'type' => 'url',
        'add_config' => array('placeholder' => 'https://'),
      ),
      array(
        'key' => 'field_2_url_2',
        'label' => 'Instagram',
        'name' => 'general_information_contact_redes_sociais_instagram',
        'type' => 'url',
        'add_config' => array('placeholder' => 'https://'),
      ),
      array(
        'key' => 'field_2_url_3',
        'label' => 'Linkedin',
        'name' => 'general_information_contact_redes_sociais_linkedin',
        'type' => 'url',
        'add_config' => array('placeholder' => 'https://'),
      ),
      array(
        'key' => 'field_2_url_4',
        'label' => 'Youtube',
        'name' => 'general_information_contact_redes_sociais_youtube',
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
        'value' => $id_post_contact,
      ],
    ],
  ];
  
  $acf_register_group_contact_infos = new httfox_register_acf_groups_fields($args_acf_group_info, $args_acf_group_location);
}

?>