<?php

function httfox_clear_debug_log() {
  $archive_path = ABSPATH . 'wp-content/debug.log'; // Caminho para o arquivo debug.log

  // Abre o arquivo em modo de escrita
  $archive = fopen($archive_path, 'w');

  if ($archive) {
    fwrite($archive, '');
    fclose($archive);

    return true;
  }
  
  return false;
}


function httfox_gerency_debug_logs($data, $clear_before_data = true) {
  if ($clear_before_data) httfox_clear_debug_log();

  error_log(print_r($data, true));
}

?>