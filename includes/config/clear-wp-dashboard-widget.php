<?php
/*
 * BEGIN -> Clear dashboard wp
 * (adm panel)
 */

// Remove diagnosis widget
function remover_status_diagnosis() {
  global $wp_meta_boxes;
  unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_site_health']);
}
add_action('wp_dashboard_setup', 'remover_status_diagnosis');



// Remove welcome widget
function remover_widget_welcome() {
  remove_action('welcome_panel', 'wp_welcome_panel');
}
add_action('wp_dashboard_setup', 'remover_widget_welcome');



// Remove now widget
function remover_widget_now() {
  remove_meta_box('dashboard_right_now', 'dashboard', 'normal');
}
add_action('wp_dashboard_setup', 'remover_widget_now');



// Remove activity widget
function remover_widget_activity() {
  remove_meta_box('dashboard_activity', 'dashboard', 'normal');
}
add_action('wp_dashboard_setup', 'remover_widget_activity');



// Remove quick press widget
function remover_quick_press() {
  remove_meta_box('dashboard_quick_press', 'dashboard', 'side');
}
add_action('wp_dashboard_setup', 'remover_quick_press');



// Remove news and events widget
function remover_widget_news_and_events() {
  remove_meta_box('dashboard_primary', 'dashboard', 'side');
}
add_action('wp_dashboard_setup', 'remover_widget_news_and_events');



// Remove tiny widget
function remover_widget_tiny_plugin() {
  remove_meta_box('tinypng_dashboard_widget', 'dashboard', 'side');
}
add_action('wp_dashboard_setup', 'remover_widget_tiny_plugin');



// Remove wp mail smtp widget
function remover_widget_wp_mail_smtp_plugin() {
  remove_meta_box('wp_mail_smtp_reports_widget_lite', 'dashboard', 'normal');
}
add_action('wp_dashboard_setup', 'remover_widget_wp_mail_smtp_plugin');

?>