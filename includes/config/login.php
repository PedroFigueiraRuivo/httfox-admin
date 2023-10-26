<?php
function my_custom_login_stylesheet() {
  wp_enqueue_style( 'custom-login-style', HTTFOX_DIRECTORY_URI . '/assets/css/wp-login.css' );
}
add_action( 'login_enqueue_scripts', 'my_custom_login_stylesheet' );



function add_icon_login_page() {
  // Obtém a URL do ícone do site configurado no personalizador
  $favicon_url = get_site_icon_url();

  if ($favicon_url) {
    echo '<style>';
    echo 'body.login div#login h1 a { background-image: url(' . $favicon_url . '); }';
    echo '</style>';
  }
}
add_action('login_head', 'add_icon_login_page');



/*Função que altera a URL, trocando pelo endereço do seu site*/
function my_login_logo_url() {
  return get_bloginfo( 'url' );
}
add_filter( 'login_headerurl', 'my_login_logo_url' );



/*Função que adiciona o nome do seu site, no momento que o mouse passa por cima da logo*/
function my_login_logo_url_title() {
  return 'Nome do seu site - Voltar para Home';
}
add_filter( 'login_headertext', 'my_login_logo_url_title' );



// function custom_login_url($login_url) {
//   return home_url('httfox-access-gerency-panel');
// }
// add_filter('login_url', 'custom_login_url');



// function custom_lostpassword_url() {
//   return home_url('esqueci-minha-senha');
// }
// add_filter('lostpassword_url', 'custom_lostpassword_url');



// function custom_registration_url() {
//   return home_url('registre-se');
// }
// add_filter('register', 'custom_registration_url');

?>