<?php

/*
 * Remove all native endpoints
 * 
 * Used to remove access to native wordpress api. 
 * Disabled to give freedom to manage internal pages.
 */
// remove_action('rest_api_init', 'create_initial_rest_routes', 99);

/*
 * Remove access to api responsible for general 
 * or specific user data
 *  
 * Not required if previous function is enabled
 */
add_filter('rest_endpoints', function ($endpoints) {
  unset($endpoints['/wp/v2/users']);
  unset($endpoints['/wp/v2/users/(?P<id>[\d]+)']);

  return $endpoints;
});

?>