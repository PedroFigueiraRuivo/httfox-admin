<?php
$table_name = HTTFOX_DATABASE_TABLE_NAME;
$charset_collate = $wpdb->get_charset_collate();

$sql = "CREATE TABLE $table_name (
  id mediumint(9) NOT NULL AUTO_INCREMENT,
  httfox_key varchar(50) NOT NULL,
  httfox_name varchar(50) NOT NULL,
  httfox_value varchar(900) NOT NULL,
  PRIMARY KEY  (id)
) $charset_collate;";

require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
dbDelta( $sql );



?>