<?php
function remove_admin_tabs_menu() {
  
  // if (!current_user_can('administrator')) {
    remove_menu_page('options-general.php'); // Configurações
    remove_menu_page('tools.php'); // Ferramentas
    remove_menu_page('plugins.php'); // Plugins
    remove_menu_page('users.php'); // Usuários
    remove_menu_page('themes.php'); // Aparência
    remove_menu_page('profile.php'); // Perfil

    remove_menu_page('activity_log_page'); // remove activity log - plugin
    remove_menu_page('wp-mail-smtp'); // remove wp-mail-smtp - plugin
  // }
}
add_action('admin_menu', 'remove_admin_tabs_menu', 999999);

?>