<?php
session_start();
/*
  Template Name: Recapitulative Page
 */
if (!is_user_logged_in()) {
    if (!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
        register_user();
        
    } elseif (isset($_SERVER['REQUEST_METHOD']) && $_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['save_account']) && removeslashes(esc_attr($_POST['save_account'])) == 'no') {

        get_header();

        get_template_part('content-recapitulative-page', get_post_format());

        get_footer();
    } elseif (isset($_SERVER['REQUEST_METHOD']) && $_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['save_account']) && removeslashes(esc_attr($_POST['save_account'])) == 'yes') {
        register_user();
        get_header();

        get_template_part('content-recapitulative-page', get_post_format());

        get_footer();
    } else {
        wp_safe_redirect(get_permalink(get_page_by_path(__('inscription', 'gpdealdomain'))));
    }
} else {
    $current_user = wp_get_current_user();
    if (!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
        update_user($current_user->ID);
    } elseif (isset($_SERVER['REQUEST_METHOD']) && $_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['edit_account']) && removeslashes(esc_attr($_POST['edit_account'])) == 'no') {
        get_header();

        get_template_part('content-recapitulative-page', get_post_format());

        get_footer();
    } elseif (isset($_SERVER['REQUEST_METHOD']) && $_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['edit_account']) && removeslashes(esc_attr($_POST['edit_account'])) == 'yes') {
        update_user($current_user->ID);
    } else {
        wp_safe_redirect(get_permalink(get_page_by_path(__('mon-compte', 'gpdealdomain'))));
        exit;
    }
}

