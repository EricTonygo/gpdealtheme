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
            // Set the global user object
            $current_user = get_user_by('id', $user_id);

            // set the WP login cookie
            $secure_cookie = is_ssl() ? true : false;
            wp_set_auth_cookie($user_id, true, $secure_cookie);
            $activation_message = __("Your account have been succefully activated", "gpdealdomain");
        }
    }
    get_header();

    include(locate_template('content-activate-account.php'));

    get_footer();
} else {
    if (!is_user_logged_in()) {
        wp_safe_redirect(get_permalink(get_page_by_path(__('registration', 'gpdealdomain'))));
    } else {
        wp_safe_redirect(get_permalink(get_page_by_path(__('my-account', 'gpdealdomain'))));
    }
}


