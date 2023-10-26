<?php
// Defina default dimensions
update_option('large_size_w', 1000);
update_option('large_size_h', 1000);
update_option('large_crop', 0);



// Add post thumbnails support
function add_support_attachment() {
  add_theme_support('post-thumbnails');
}

add_action('after_setup_theme', 'add_support_attachment');



// limit upload size
function limit_image_upload_size($file) {
  $max_kb = 400;
  $max_file_size = $max_kb * 1024; // 900 KB em bytes

  if ($file['size'] > $max_file_size) {
    $file['error'] = 'O tamanho da imagem excede o limite máximo de ' . $max_kb . 'KB. Reduza a sua imagem para poder adiciona-la ao site. Essa é uma medida para preservar os índices de desempenho';
  }

  return $file;
}

add_filter('wp_handle_upload_prefilter', 'limit_image_upload_size');



// limit dimensions sizes
function bfc_validate_image_size( $file ) {
  $image = getimagesize($file['tmp_name']);
  $maximum = array(
    'width' => '1000',
    'height' => '1000'
  );
  $image_width = $image[0];
  $image_height = $image[1];

   $too_large = "O tamanho da imagem é maior que o permitido. O tamanho máximo é {$maximum['width']} por {$maximum['height']} pixels. A imagem atual possui: $image_width por $image_height pixels.";


  if ( $image_width > $maximum['width'] || $image_height > $maximum['height'] ) {
    //adiciona o erro caso a imagem seja maior que o definido
    $file['error'] = $too_large; 
    return $file;
  }
  else return $file;
}
add_filter('wp_handle_upload_prefilter','bfc_validate_image_size');

?>