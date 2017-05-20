<?php

/*
  Template Name: Home Page
 */

//header("Cache-Control", "no-cache, no-store, must-revalidate");
if(is_user_logged_in() && isset($_SERVER['REQUEST_METHOD']) && $_SERVER['REQUEST_METHOD'] == 'GET' && isset($_GET['logout']) && esc_attr($_GET['logout'])=='true'){
    wp_logout();
    //$json = array("message" => "disconnected successfully.");
    //return wp_send_json_success($json);
    wp_safe_redirect(home_url('/'));
}

if(isset($_SERVER['REQUEST_METHOD']) && $_SERVER['REQUEST_METHOD'] == 'GET' && isset($_GET['lang'])){
    wp_safe_redirect(home_url('/'));
}

if(isset($_SERVER['REQUEST_METHOD']) && $_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['action']) && esc_attr($_POST['action'])=='update-status-expired-offers'){
    $result = updateStatusAllExpiredOffers();
    return wp_send_json_success(array('result'=>$result));
}

if(isset($_SERVER['REQUEST_METHOD']) && $_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['action']) && esc_attr($_POST['action'])=='update-status-ended-offers'){
    $result = updateStatusAllEndedOffers();
    return wp_send_json_success(array('result'=>$result));
}
session_start();
expire_session(); 
get_header(); 

get_template_part('content-index', get_post_format()); 

get_footer(); 