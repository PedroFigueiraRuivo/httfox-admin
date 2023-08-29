<?php
$cpt_slug_id = 'general_information';


/*
 * =======================================================
 * BEGIN -> Create Single Post
 * @Code runner
 */
// Post: Perguntas frequentes
$args_post_perguntas_frequentes = [
  'cpt_slug_id' => $cpt_slug_id,
  'post_title' => 'Perguntas frequentes',
  'post_slug' => 'perguntas-frequentes',
];

$create_post_perguntas_frequentes = new httfox_create_single_post_in_post_type($args_post_perguntas_frequentes);
$id_post_perguntas_frequentes = $create_post_perguntas_frequentes->create_post();
// END -> Create Single Post


/*
 * =======================================================
 * BEGIN -> Acf config Group and Fields
 * @Code runner
 */
// Post: Peruntas frequentes
if ($id_post_perguntas_frequentes) {
  $acf_general_PERGUNTAS_FREQUENTES_group_key = 'acf_group_common_questions';
  
  $args_acf_group_info = [
    'group_key' => $acf_general_PERGUNTAS_FREQUENTES_group_key, // group key
    'group_title' => 'Perguntas frequentes', // title section
    'group_fields'  => array(
      array(
        'key' => 'common_questions_repeater',
        'label' => 'Lista',
        'name' => 'common_questions_repeater',
        'type' => 'repeater',
        'add_config' => array(
          'sub_fields' => array(
            array(
              'key' => 'field_5f5d74e91b404', // Um ID único para o campo secundário
              'label' => 'Pergunta', // Rótulo do campo secundário
              'name' => 'question', // Nome do campo secundário
              'type' => 'text', // Tipo de campo (por exemplo, texto)
            ),
            array(
              'key' => 'field_5f5d74e91b404s', // Um ID único para o campo secundário
              'label' => 'Resposta', // Rótulo do campo secundário
              'name' => 'enswere', // Nome do campo secundário
              'type' => 'text', // Tipo de campo (por exemplo, texto)
            ),
            // Adicione mais campos secundários conforme necessário
          ),
          'collapsed' => 'field_5f5d74e91b404', // Campo que será exibido como título para cada repetição
          'min' => 0, // Número mínimo de repetições
          'layout' => 'block', // Layout das repetições (table ou block)
        ),
      ),
    ),
  ];
  
  $args_acf_group_location = [ // rules
    [ // ou
      [ // e
        'param' => 'post',
        'operator' => '==',
        'value' => $id_post_perguntas_frequentes,
      ],
    ],
  ];
  
  $acf_register_group_perguntas_frequentes_infos = new httfox_register_acf_groups_fields($args_acf_group_info, $args_acf_group_location);
}
// END -> Acf config Group and Fields

?>