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
  $group_key_path = 'httfox_acf_group_general_information_contac_info';
  $group_name_path = 'general_information_contac_info';

  acf_add_local_field_group(array(
    'key' =>  $group_key_path . '_contact',
    'title' => 'Informações gerais de contato',
    'fields' => array(
      array(
        'key' => $group_key_path . '_contact' . '_field_0',
        'label' => 'Contato',
        'name' => '',
        'type' => 'tab',
      ),
      array(
        'key' => $group_key_path . '_contact' . '_field_1',
        'label' => 'E-mail',
        'name' => $group_name_path . '_contact_email',
        'type' => 'email',
        'required' => 1,
        'placeholder' => 'seu_nome@email.com',
      ),
      array(
        'key' => $group_key_path . '_contact' . '_field_2',
        'label' => 'Telefone',
        'name' => $group_name_path . '_contact_phone',
        'type' => 'number',
        'required' => 1,
        'instructions' => 'Adicione apenas o número, sem espaços ou caracteres iniciais. Esse item servirá para gerar o link automático de contato. (adicione o código do país na frente)',
      ),
      array(
        'key' => $group_key_path . '_contact' . '_field_3',
        'label' => 'Telefone - visulização',
        'name' => $group_name_path . '_contact_phone_view',
        'type' => 'text',
        'required' => 1,
        'placeholder' => '(00) 0.0000-0000',
      ),
      array(
        'key' => $group_key_path . '_contact' . '_field_4',
        'label' => 'Endereço',
        'name' => $group_name_path . '_contact_address',
        'type' => 'textarea',
        'required' => 1,
        'rows' => 2,
      ),
      array(
        'key' => $group_key_path . '_contact' . '_field_5',
        'label' => 'Redes sociais',
        'name' => '',
        'type' => 'tab',
      ),
      array(
        'key' => $group_key_path . '_contact' . '_field_6',
        'label' => 'Facebook',
        'name' => $group_name_path . '_contact_facebook',
        'placeholder' => 'https://',
        'type' => 'url',
      ),
      array(
        'key' => $group_key_path . '_contact' . '_field_7',
        'label' => 'Instagram',
        'name' => $group_name_path . '_contact_instagram',
        'placeholder' => 'https://',
        'type' => 'url',
      ),
      array(
        'key' => $group_key_path . '_contact' . '_field_9',
        'label' => 'Youtube',
        'name' => $group_name_path . '_contact_youtube',
        'placeholder' => 'https://',
        'type' => 'url',
      ),
      array(
        'key' => $group_key_path . '_contact' . '_field_10',
        'label' => 'WhatsApp',
        'name' => $group_name_path . '_contact_whatsapp',
        'placeholder' => 'https://',
        'type' => 'url',
      ),
      array(
        'key' => $group_key_path . '_contact' . '_field_11',
        'label' => 'Linkedin',
        'name' => $group_name_path . '_contact_linkedin',
        'placeholder' => 'https://',
        'type' => 'url',
      ),
    ),
    'location' => array(
      array(
        array(
          'param' => 'post',
          'operator' => '==',
          'value' => $id_post_contact,
        ),
      ),
    ),
  ));
}

?>