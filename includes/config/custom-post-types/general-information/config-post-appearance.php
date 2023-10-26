<?php
$cpt_slug_id = 'httfox_information';

/*
 * =======================================================
 * BEGIN -> Create Single Post
 * @Code runner
 */
// Post: contact
$args = [
  'cpt_slug_id' => $cpt_slug_id,
  'post_title' => 'Aparência',
  'post_slug' => 'appearance',
  'database_key' => $cpt_slug_id . '_appearance',
];

$create_post = new httfox_create_single_post_in_post_type($args);
$post_id = $create_post->create_post();


/*
 * =======================================================
 * BEGIN -> Acf config Group and Fields
 * @Code runner
 */
// Post: contact
if ($post_id) {
  $group_key_path = 'httfox_acf_group_general_information_appearance';
  $group_name_path = 'general_information_appearance';

  acf_add_local_field_group(array(
    'key' =>  $group_key_path . '_appearance',
    'title' => 'Aparência do site',
    'fields' => array(
      // array(
      //   'key' => $group_key_path . '_appearance' . '_field_0',
      //   'label' => 'Contato',
      //   'name' => '',
      //   'type' => 'tab',
      // ),
      array(
        'key' => $group_key_path . '_appearance' . '_field_1',
        'label' => 'Ícone do site / favicon',
        'name' => $group_name_path . '_appearance_favicon',
        'type' => 'image',
        'return_format' => 'url',
        'preview_size' => 'thumbnail',
      ),
    ),
    'location' => array(
      array(
        array(
          'param' => 'post',
          'operator' => '==',
          'value' => $post_id,
        ),
      ),
    ),
  ));
}

?>