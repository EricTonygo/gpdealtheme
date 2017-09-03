<?php

/*
  Template Name: Review Selected Transport Offers Page
 */
//header("Cache-Control", "no-cache, no-store, must-revalidate");
session_start();
expire_session();
if (is_user_logged_in()) {
    if (isset($_SERVER['REQUEST_METHOD']) && $_SERVER['REQUEST_METHOD'] == 'GET' && isset($_SESSION['selected_transport_offers']) && isset($_SESSION['package_id'])) {
        $selected_transport_offers = $_SESSION['selected_transport_offers'];
        $package_id = $_SESSION['package_id'];
        $L = get_post_meta($package_id, 'length', true);
        $l = get_post_meta($package_id, 'width', true);
        $h = get_post_meta($package_id, 'height', true);
        $weight = get_post_meta($package_id, 'weight', true);
        $package_currency = get_post_meta($package_id, 'package-currency', true);
        get_header();
        include(locate_template('content-review-page.php'));
        get_footer();
    } else {
        wp_safe_redirect(get_permalink(get_page_by_path(__('my-account', 'gpdealdomain') . '/' . __('shipments', 'gpdealdomain'))));
        exit;
    }
} else {
    $_SESSION['redirect_to'] = get_the_permalink();
    wp_safe_redirect(get_permalink(get_page_by_path(__('log-in', 'gpdealdomain'))));
}