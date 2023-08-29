<?php
/*
 * Remove admin bar for all users
*/
add_filter( 'show_admin_bar', function () {
  return false;
});

?>