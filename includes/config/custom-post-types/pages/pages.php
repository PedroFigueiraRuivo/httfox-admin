<?php
$path_pages = HTTFOX_DIRECTORY . '/includes/config/custom-post-types/pages/';
$cpt_name_id = 'page';

function remover_editor_de_blocos() {
  remove_post_type_support('page', 'editor');
}
add_action('init', 'remover_editor_de_blocos');


require_once($path_pages . 'config-page-home.php');

?>