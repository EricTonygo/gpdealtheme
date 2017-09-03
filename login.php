<?php

/*
  Template Name: Login Page
 */
session_start();
expire_session();
//header("Cache-Control", "no-cache, no-store, must-revalidate");
if (!is_user_logged_in()) {
    if (isset($_SERVER['REQUEST_METHOD']) && $_SERVER['REQUEST_METHOD'] == 'POST') {
        if (!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
            if (isset($_POST['_username']) && isset($_POST['_password'])) {
                $user_login = null;
                $login = esc_attr(trim($_POST['_username']));
                $password = $_POST['_password'];
                if (filter_var($login, FILTER_VALIDATE_EMAIL) && get_user_by('email', $login)) {
                    $user_login = get_user_by('email', $login);
                    $check_password = wp_check_password($password, $user_login->data->user_pass, $user_login->ID);
                } elseif (get_user_by('login', $login)) {
                    $user_login = get_user_by('login', $login);
                    $check_password = wp_check_password($password, $user_login->data->user_pass, $user_login->ID);
                }

                if ($user_login == null) {
                    $json = array("message" => __("Unknown user", "gpdealdomain"));
                    return wp_send_json_error($json);
                } elseif ($user_login && !$check_password) {
                    $json = array("message" => __("Incorrect password", "gpdealdomain"));
                    return wp_send_json_error($json);
                } else {
                    if (get_user_meta($user_login->ID, 'activate', true) == 1) {
                        $json = array("message" => __("You have not activated your account yet", "gpdealdomain")." !<br>".__("To sign in, please activate it via the link sent in your email address", "gpdealdomain").".");
                        return wp_send_json_error($json);
                    } else {
                        if (isset($_POST['no_redirect']) && $_POST['no_redirect'] == "true") {
                            $remember = removeslashes(esc_attr(trim($_POST['_remember'])));
                            if ($remember == 'on') {
                                $remember = true;
                            } else {
                                $remember = false;
                            }
                            $creds = array('user_login' => $user_login->data->user_login, 'user_password' => $password, 'remember' => $remember);
                            $secure_cookie = is_ssl() ? true : false;
                            $user = wp_signon($creds, $secure_cookie);
                            $_SESSION['REMEMBER_ME'] = $remember;
                            if (!$remember) {
                                $_SESSION['LAST_ACTIVITY'] = time();
                            }
                        } 
                        $json = array("message" => "Connect is possible");
                        return wp_send_json_success($json);
                    }
                }
            } else {
                $json = array("message" => __("Enter your username and your password", "gpdealdomain"));
                return wp_send_json_error($json);
            }
        } elseif (isset($_POST['_username']) && isset($_POST['_password'])) {
            $username = removeslashes(esc_attr(trim($_POST['_username'])));
            $password = $_POST['_password'];
            $remember = removeslashes(esc_attr(trim($_POST['_remember'])));
            $redirect_to = $_POST['redirect_to'];
            signin($username, $password, $remember, $redirect_to);
        }
    } else {
        get_header();

        get_template_part('content-login-page', get_post_format());

        get_footer();
    }
} else {
    wp_safe_redirect(get_permalink(get_page_by_path(__('my-account', 'gpdealdomain'))));
}