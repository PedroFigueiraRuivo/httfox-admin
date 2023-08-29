<?php
function httfox_acf_check() {
  if( class_exists('ACF') ){
    return true;
  } else {
    add_action('admin_notices', function() {
      $messageError = 'O plugin Advanced Custom Fields não está ativo. Por favor, ative-o para utilizar todas as funcionalidades da API.';
      echo '<div class="error"><p>' . $messageError . '</p></div>';
    });
  }

  return false;
}
?>