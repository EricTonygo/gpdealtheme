<?php

/*
  Template Name: Home Page
 */
//header("Cache-Control", "no-cache, no-store, must-revalidate");
session_start();
if(is_user_logged_in() && isset($_SERVER['REQUEST_METHOD']) && $_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['logout']) && esc_attr($_POST['logout'])=='true'){
    wp_logout();
    $json = array("message" => "disconnected successfully.");
    return wp_send_json_success($json);
    //wp_safe_redirect(home_url('/'));
}

get_header(); 

get_template_part('content-index', get_post_format()); 

get_footer(); 
