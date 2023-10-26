<?php
$cpt_slug_id = 'httfox_information';

/*
 * =======================================================
 * BEGIN -> Create Single Post
 * @Code runner
 */
// Post: Common questions
$args_post_Common_questions = [
  'cpt_slug_id' => $cpt_slug_id,
  'post_title' => 'Perguntas frequentes',
  'post_slug' => 'Common-questions',
  'database_key' => $cpt_slug_id . '_common_questions',
];

$create_post_Common_questions = new httfox_create_single_post_in_post_type($args_post_Common_questions);
$id_post_Common_questions = $create_post_Common_questions->create_post();
// END -> Create Single Post




// Post: Peruntas questions
if ($id_post_Common_questions) {
  $group_key_path = 'httfox_acf_group_general_information_common_questions';
  $group_name_path = 'general_information_common_questions';

  // Section - Results
  acf_add_local_field_group(array(
    'key' => $group_key_path . '_commom_question',
    'title' => 'Informações gerais - Perguntas frequentes',
    'fields' => array(
      array(
        'key' => $group_key_path . '_commom_question' . '_field_0',
        'label' => 'Perguntas frequentes',
        'name' => $group_name_path . 'commom_questions_list',
        'type' => 'repeater',
        'required' => 1,
        'layout' => 'row',
        'collapsed' => $group_key_path . '_commom_question' . '_field_1',
        'min' => 2,
        'sub_fields' => array(
          array(
            'key' => $group_key_path . '_commom_question' . '_field_1',
            'label' => 'Pergunta',
            'name' => $group_name_path . '_commom_question_question',
            'type' => 'text',
            'required' => 1,
          ),
          array(
            'key' => $group_key_path . '_commom_question' . '_field_2',
            'label' => 'Respoosta',
            'name' => $group_name_path . '_commom_question_enswere',
            'type' => 'textarea',
          ),
        ),
      ),
    ),
    'location' => array(
      array(
        array(
          'param' => 'post',
          'operator' => '==',
          'value' => $id_post_Common_questions,
        ),
      ),
    ),
  ));
}
?>