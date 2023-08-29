<?php
/* 
 * Change url path of api
 */
function httfox_change_rest_url_prefix() {
  return HTTFOX_REST_URL_PREFIX;
}
add_filter('rest_url_prefix', 'httfox_change_rest_url_prefix');

?>