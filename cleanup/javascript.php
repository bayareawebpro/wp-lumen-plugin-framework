<?php

/**
 * De-registers WordPress default javascript
 * @link https://codex.wordpress.org/Function_Reference/wp_deregister_script
 */
add_action( 'wp_enqueue_scripts', function () {
   wp_deregister_script( 'jquery' );
   wp_deregister_script( 'wp-embed' );
});

/**
 * De-registers jQuery Migrate & Register jQuery Core
 * @link https://codex.wordpress.org/Plugin_API/Action_Reference
 */
add_filter('wp_default_scripts', function( &$scripts){
    if(!is_admin()){
        $scripts->remove( 'jquery');
        $scripts->add( 'jquery', false, array( 'jquery-core' ), '1.10.2' );
    }
});