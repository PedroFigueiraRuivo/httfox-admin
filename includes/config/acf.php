<?php
// Define path and URL to the ACF plugin.
define( 'MY_ACF_PATH', HTTFOX_DIRECTORY . '/includes/plugins/acf/' );
define( 'MY_ACF_URL', HTTFOX_DIRECTORY_URI . '/includes/plugins/acf/' );

// Include the ACF plugin.
include_once( MY_ACF_PATH . 'acf.php' );

// Customize the url setting to fix incorrect asset URLs.
add_filter('acf/settings/url', 'my_acf_settings_url');
function my_acf_settings_url( $url ) {
    return MY_ACF_URL;
}

// (Optional) Hide the ACF admin menu item.
add_filter('acf/settings/show_admin', '__return_false');

// When including the PRO plugin, hide the ACF Updates menu
add_filter('acf/settings/show_updates', '__return_false', 100);


// add custom script to toggle rows
function httfox_enqueue_custom_admin_scripts() {
    wp_enqueue_script('meu-script', get_template_directory_uri() . '/assets/js/config-acf-toggle-rows.js', array('jquery'), '1.0', true);
}
  
add_action('admin_enqueue_scripts', 'httfox_enqueue_custom_admin_scripts', 9999999999);
?>