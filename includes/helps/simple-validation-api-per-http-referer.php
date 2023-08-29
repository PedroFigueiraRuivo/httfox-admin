<?php
function simple_validation_api_per_http_referer() {
  if (HTTFOX_API_DEVELOPER) return true;

  if (!isset($_SERVER['HTTP_REFERER'])) {
    return new WP_Error('missing_referer', 'O cabeçalho HTTP_REFERER não está definido.');
  }
  
  $referer = $_SERVER['HTTP_REFERER'];
  
  if (!in_array($referer, HTTFOX_API_VALID_URLS)) {
    return new WP_Error( 'invalid_referer', 'Acesso negado. Origem inválida.', array( 'status' => 403 ) );
  }

  return true;
}
?>