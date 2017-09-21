<?php

/*
  Template Name: Home Page
 */
session_start();
//header("Cache-Control", "no-cache, no-store, must-revalidate");
if (is_user_logged_in() && isset($_SERVER['REQUEST_METHOD']) && $_SERVER['REQUEST_METHOD'] == 'GET' && isset($_GET['logout']) && esc_attr($_GET['logout']) == 'true') {
    wp_logout();
    //$json = array("message" => "disconnected successfully.");
    //return wp_send_json_success($json);
    //Delete all selected transport offers store in session after logout
    if (isset($_SESSION['selected_transport_offers'])) {
        unset($_SESSION['selected_transport_offers']);
    }
    //Delete id of package store in session after logout
    if (isset($_SESSION['package_id'])) {
        unset($_SESSION['package_id']);
    }
    //Delete redirect link after login in website
    if(isset($_SESSION['redirect_to'])){
        unset($_SESSION['redirect_to']);
    }
    //Delete last time activity of the current connexion
    if(isset($_SESSION['LAST_ACTIVITY'])){
        unset($_SESSION['LAST_ACTIVITY']);
    }
    
    //Delete a parameter remember_me  of the current connexion
    if(isset($_SESSION['REMEMBER_ME'])){
        unset($_SESSION['REMEMBER_ME']);
    }
    wp_safe_redirect(home_url('/'));
    exit;
}

if (isset($_SERVER['REQUEST_METHOD']) && $_SERVER['REQUEST_METHOD'] == 'GET' && isset($_GET['lang'])) {
    wp_safe_redirect(home_url('/'));
}

if (isset($_SERVER['REQUEST_METHOD']) && $_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['action']) && esc_attr($_POST['action']) == 'update-status-expired-offers') {
    $result = updateStatusAllExpiredOffers();
    return wp_send_json_success(array('result' => $result));
}

if (isset($_SERVER['REQUEST_METHOD']) && $_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['action']) && esc_attr($_POST['action']) == 'update-status-ended-offers') {
    $result = updateStatusAllEndedOffers();
    return wp_send_json_success(array('result' => $result));
}
expire_session();
get_header();

get_template_part('content-index', get_post_format());

get_footer();
