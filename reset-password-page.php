<?php

/*
  Template Name: Reset Password Page
 */
session_start();
expire_session();
if (!is_user_logged_in()) {
    if (isset($_SERVER['REQUEST_METHOD']) && $_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['username']) && isset($_POST['new_password'])) {
        $login = esc_attr($_POST['username']);
        $new_password = esc_attr($_POST['new_password']);
        gp_reset_password($login, $new_password);
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
                $reset_password_message = __("This password reset link is expired", "gpdealdomain");
            }
        } else {
            $reset_password_message = __("This password reset link is invalid", "gpdealdomain");
        }
        get_header();

        include(locate_template('content-reset-password-page.php'));

        get_footer();
    }
} else {
    if (isset($_SERVER['REQUEST_METHOD']) && $_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['new_password']) && isset($_POST['new_password'])) {
        $user = get_user_by('id', get_current_user_id());
        $login = $current_user->data->user_login;
        $old_password = esc_attr($_POST['old_password']);
        $new_password = esc_attr($_POST['new_password']);
        if ($user && wp_check_password($old_password, $user->data->user_pass, $user->ID)) {
            gp_reset_password($login, $new_password);
        } else {
            $_SESSION["faillure_process"] = __("The current password provided is not correct. Please check it out and try again", "gpdealdomain");
            get_header();

            include(locate_template('content-reset-password-page.php'));

            get_footer();
        }
    } elseif (isset($_SERVER['REQUEST_METHOD']) && $_SERVER['REQUEST_METHOD'] == 'GET') {
        $reset_password_possible = true;
        $reset_password_message = "";
        get_header();

        include(locate_template('content-reset-password-page.php'));

        get_footer();
    }
}


