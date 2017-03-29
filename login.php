<?php

/*
  Template Name: Login Page
 */
header("Cache-Control", "no-cache, no-store, must-revalidate");
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
                $json = array("message" => "Utilisateur inexistant ");
                return wp_send_json_error($json);
            } elseif ($user_login && !$check_password) {
                $json = array("message" => "Mot de passe incorrect");
                return wp_send_json_error($json);
            } else {
                $json = array("message" => "Ajout possible");
                return wp_send_json_success($json);
            }
        } else {
            $json = array("message" => "Saisir le nom et le mot de passe");
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
