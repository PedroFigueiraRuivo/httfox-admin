<?php
function add_support_attachment() {
  add_theme_support('post-thumbnails');
}

add_action('after_setup_theme', 'add_support_attachment');

?>