<?php
add_filter('wp_mail_content_type',function(){
    return "text/html";
});

//add_action('wp_loaded', function(){
//    wp_mail('test@test.com', 'TEST', view('admin-intro')->render(), array('Content-Type: text/html; charset=UTF-8'));
//});