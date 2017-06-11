<?php

/*
  Template Name: Forget Password Page
 */
session_start();
expire_session();
if (!is_user_logged_in()) {
    if (isset($_SERVER['REQUEST_METHOD']) && $_SERVER['REQUEST_METHOD'] == 'POST') {
        $user_email = removeslashes(esc_attr(trim($_POST['email'])));
        if (!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
            get_password($user_email);
        } else {
            get_password($user_email);
            get_header();
            include(locate_template('content-forgot-your-password-response-page.php'));
            get_footer();
        }
    } else {
        get_header();

        include(locate_template('content-forgot-your-password-page.php'));

        get_footer();
    }
} else {
    wp_safe_redirect(get_permalink(get_page_by_path(__('my-account', 'gpdealdomain'))));
}


