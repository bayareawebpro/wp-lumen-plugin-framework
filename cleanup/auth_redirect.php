<?php

add_action('wp_logout',function(){
    wp_redirect(home_url());
    exit;
});