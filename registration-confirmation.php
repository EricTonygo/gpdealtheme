<?php

/*
  Template Name: Registration confirmation Page
 */
session_start();

if (!is_user_logged_in() && isset($_SESSION['success_registration_message_title']) && $_SESSION['success_registration_message_content'] != "") {
    $success_registration_message_title = $_SESSION['success_registration_message_title'];
    $success_registration_message_content = $_SESSION['success_registration_message_content'];
    //unset($_SESSION['success_registration_message_title']);
    get_header();

    include(locate_template('content-registration-confirmation.php'));

    get_footer();
}else {
    if (!is_user_logged_in()) {
        wp_safe_redirect(get_permalink(get_page_by_path(__('registration', 'gpdealdomain'))));
    } else {
        wp_safe_redirect(get_permalink(get_page_by_path(__('my-account', 'gpdealdomain'))));
    }
}

