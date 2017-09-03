<?php

/*
  Template Name: Activate Account Page
 */
session_start();
//header("Cache-Control", "no-cache, no-store, must-revalidate");

global $current_user;
if (isset($_SERVER['REQUEST_METHOD']) && $_SERVER['REQUEST_METHOD'] == 'GET' && isset($_GET['id']) && isset($_GET['key'])) {
    $activation_message = __("Activation of your account failed", "gpdealdomain");
    $account_activated = false;
    $user_login = esc_attr(wp_unslash(trim($_GET['id'])));
    $hash = $_GET['key'];
    $user = get_user_by('login', $user_login);
    if (get_user_meta($user->ID, 'hash', true) == $hash) {
        $user_id = update_user_meta($user->ID, 'activate', 2);
        $account_activated = true;
        if (false == $user_id) {
            $activation_message = __("Your account is already activated", "gpdealdomain");
        } else {
//            // Set the global user object
//            $current_user = get_user_by('id', $user->ID);
//
//            // set the WP login cookie
//            $secure_cookie = is_ssl() ? true : false;
//            wp_set_auth_cookie($user->ID, true, $secure_cookie);
            $activation_message = __("Your account has been activated successfully", "gpdealdomain");
            $_SESSION["account_activated"] = $account_activated;
            $_SESSION["success_process"] = __("Your account has been activated successfully", "gpdealdomain").". ".__("Log in now to start using our services", "gpdealdomain");
            wp_safe_redirect(get_permalink(get_page_by_path(__('log-in', 'gpdealdomain'))->ID));
            exit;
        }
    }
    get_header();

    include(locate_template('content-activate-account.php'));

    get_footer();
} else {
    if (!is_user_logged_in()) {
        wp_safe_redirect(get_permalink(get_page_by_path(__('registration', 'gpdealdomain'))->ID));
        exit;
    } else {
        wp_safe_redirect(get_permalink(get_page_by_path(__('my-account', 'gpdealdomain'))->ID));
        exit;
    }
}


