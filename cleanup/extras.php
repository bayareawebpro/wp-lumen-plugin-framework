<?php

/**
 * Get pages using a specific template
 * @param $template string
 * @return mixed
 */
function get_pages_with_template( $template ) {
  return get_pages(array(
    'meta_key' => '_wp_page_template',
    'meta_value' => $template
  ));
}
/**
 * Stay logged in for longer
 * @link https://developer.wordpress.org/reference/hooks/auth_cookie_expiration/
 */
add_filter( 'auth_cookie_expiration', function () {
  return 31556926; // 1 year
});
