<?php

function httfox_dashboard_main_widget() {
  wp_add_dashboard_widget(
      'httfox_dashboard_widget', // ID do widget (deve ser exclusivo)
      'httFox Web Devloper', // Título do widget
      'conteudo_widget_personalizado' // Função que exibe o conteúdo do widget
  );
}
add_action('wp_dashboard_setup', 'httfox_dashboard_main_widget');

function conteudo_widget_personalizado() {
  // Conteúdo do seu widget personalizado
  echo 'Um sistema adaptado por <a href="https://httfox.com/" target="_blank">httFox Web Developer</a>';
}


?>