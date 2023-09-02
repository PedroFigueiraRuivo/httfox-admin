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


/*
 * =======================================================
 * BEGIN -> Acf config Group and Fields
 * @Code runner
 */
// Post: Peruntas questions
if ($id_post_Common_questions) {
  $acf_general_Common_questions_group_key = 'acf_group_cpt_general_information_common_questions';
  
  $args_acf_group_info = [
    'group_key' => $acf_general_Common_questions_group_key, // group key
    'group_title' => 'Perguntas frequentes', // title section
    'group_fields'  => array(
      array(
        'key' => 'field_0_repeater',
        'label' => 'Lista',
        'name' => 'general_information_common_questions_repeater',
        'type' => 'repeater',
        'add_config' => array(
          'sub_fields' => array(
            array(
              'key' => 'field_1_question', // Um ID único para o campo secundário
              'label' => 'Pergunta', // Rótulo do campo secundário
              'name' => 'general_information_common_questions_question', // Nome do campo secundário
              'type' => 'text', // Tipo de campo (por exemplo, texto)
              'required' => 1,
            ),
            array(
              'key' => 'field_2_enswere', // Um ID único para o campo secundário
              'label' => 'Resposta', // Rótulo do campo secundário
              'name' => 'general_information_common_questions_enswere', // Nome do campo secundário
              'type' => 'textarea', // Tipo de campo (por exemplo, texto)
              'rows' => 5,
              'required' => 1,
            ),
            // Adicione mais campos secundários conforme necessário
          ),
          'collapsed' => 'field_1_question', // Campo que será exibido como título para cada repetição
          'min' => 1, // Número mínimo de repetições
          'layout' => 'table', // Layout das repetições (table ou block)
        ),
      ),
    ),
  ];
  
  $args_acf_group_location = [ // rules
    [ // ou
      [ // e
        'param' => 'post',
        'operator' => '==',
        'value' => $id_post_Common_questions,
      ],
    ],
  ];
  
  $acf_register_group_Common_questions_infos = new httfox_register_acf_groups_fields($args_acf_group_info, $args_acf_group_location);
}
// END -> Acf config Group and Fields

?>