<?php

/*
  Template Name: Reset Password Page
 */
session_start();
expire_session();
if (!is_user_logged_in()) {
    if (!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
        gp_reset_password();
    } elseif (isset($_SERVER['REQUEST_METHOD']) && $_SERVER['REQUEST_METHOD'] == 'POST') {
        gp_reset_password();
    } elseif (isset($_SERVER['REQUEST_METHOD']) && $_SERVER['REQUEST_METHOD'] == 'GET' && isset($_GET['id']) && isset($_GET['key'])) {
        $user_login = esc_attr(wp_unslash(trim($_GET['id'])));
        $hash_reset_password = $_GET['key'];
        $user = get_user_by('login', $user_login);
        $reset_password_possible = false;
        if (get_user_meta($user->ID, 'hash-reset-password', true) == $hash_reset_password) {
            // last request reset password was more than 90 minutes ago
            if ((time() - get_user_meta($user->ID, 'last-reset-password-time', true) < 24 * 60 * 60)) {
                $reset_password_possible = true;
                $reset_password_message = "";
            } else {
                $reset_password_message = __("This link is expired", "gpdealdomain");
            }
        } else {
            $reset_password_message = __("This reseted password link is invalid", "gpdealdomain");
        }
        get_header();

        include(locate_template('content-reset-password-page.php'));

        get_footer();
    }
} else {
    wp_safe_redirect(get_permalink(get_page_by_path(__('my-account', 'gpdealdomain'))));
}


