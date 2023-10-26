<?php
$path_help = '/includes/helps/';
require_once HTTFOX_DIRECTORY . $path_help . 'simple-validation-api-per-http-referer.php';
require_once HTTFOX_DIRECTORY . $path_help . 'check-acf-active.php';

function httfox_api_post_sandmail($request) {
  $can_access = simple_validation_api_per_http_referer();

  if ($can_access !== true) {
    return rest_ensure_response( $can_access );
  }

  $sender = !empty($request['sender']) ? $request['sender'] : null;
  $subject = !empty($request['subject']) ? $request['subject'] : null;
  $message = !empty($request['message']) ? $request['message'] : null;
  $from = !empty($request['from']) ? $request['from'] : null;
  $cc = !empty($request['cc']) ? $request['cc'] : null;
  $bcc = !empty($request['bcc']) ? $request['bcc'] : null;
  $headers = [];

  if (!$sender || !$subject || !$message){
    return new WP_Error('dados_incompletos', 'Os dados fornecidos estão incompletos ou ausentes.', array('status' => 400));
  }


  $from ? $headers[0] = 'From:' . $from : $headers[0] = 'From:' . $sender;
  $cc ? $headers[1] = 'Cc:' . $cc : null;
  $bcc ? $headers[2] = 'Bcc:' . $bcc : null;

  $sent = wp_mail($sender, $subject, $message, $headers);
  
  if ($sent) return rest_ensure_response('Email enviado!');
  
  return new WP_Error('email_send_error', 'Erro ao enviar o e-mail.', array( 'status' => 500 ));
}

function httfox_register_route_api_post_sendmail() {
  $configRoutes = [
    'methods' => WP_REST_Server::CREATABLE,
    'callback' => 'httfox_api_post_sandmail'
  ];

  register_rest_route(HTTFOX_API_VERSION_V1, '/sendmail', $configRoutes);
}

add_action('rest_api_init', 'httfox_register_route_api_post_sendmail');

?>