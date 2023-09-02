<?php
$path_endpoints = HTTFOX_DIRECTORY . '/includes/endpoints/';
$endpoint_version = 'v1';
$path = $path_endpoints . $endpoint_version . '/';

require_once ($path . 'get-services.php');
require_once ($path . 'get-differentials.php');
require_once ($path . 'get-common-questions.php');
require_once ($path . 'get-depositions.php');
require_once ($path . 'get-portfolio.php');
?>