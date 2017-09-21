<?php

/*
  Template Name: Create Transport Offer Alert Page
 */
//header("Cache-Control", "no-cache, no-store, must-revalidate");
session_start();
expire_session();
if (is_user_logged_in()) {
    if (isset($_SERVER['REQUEST_METHOD']) && $_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['package_id'])) {
        if (isset($_POST['package_id'])) {
            $package_id = intval(removeslashes(esc_attr(trim($_POST['package_id']))));
            $post = get_post($package_id);
            if ($post) {
                $_SESSION['package_id'] = $package_id;
                wp_safe_redirect(esc_url(get_permalink(get_page_by_path(__('my-account', 'gpdealdomain') . '/' . __('create-alert-for-transport-offers', 'gpdealdomain') . '/' . __('payment', 'gpdealdomain')))));
                exit;
            } else {
                $_SESSION["faillure_process"] = __("This shipment doesn't exist. Please Select a right shipment", "gpdealdomain");
                wp_safe_redirect(get_permalink(get_page_by_path(__('my-account', 'gpdealdomain') . '/' . __('shipments', 'gpdealdomain'))));
                exit;
            }
        } else {
            $_SESSION["faillure_process"] = __("Some data is missing", "gpdealdomain");
            wp_safe_redirect(esc_url(get_permalink()));
            exit;
        }
    } elseif (isset($_SERVER['REQUEST_METHOD']) && $_SERVER['REQUEST_METHOD'] == 'GET' && isset($_GET['package-id'])) {
        $package_id = intval(removeslashes(esc_attr(trim($_GET['package-id']))));
        if (isset($_GET['payment-completed']) && $_GET['payment-completed'] == "true") {
            $_SESSION["success_process"] = __("Your payment was successfully registered. Your alert is active until", "gpdealdomain") . " " . date('d-m-Y', strtotime(get_post_meta($package_id, 'date-of-departure-package', true)));
            update_post_meta($package_id, 'transport-offer-alert', 2);
            wp_safe_redirect(get_permalink(get_page_by_path(__('my-account', 'gpdealdomain') . '/' . __('shipments', 'gpdealdomain'))));
            exit;
        } else {
            get_header();
            $ip_visitor_data = ip_visitor_data();
            $alert_cost = "";
            $alert_currency = "";
            if ($ip_visitor_data) {
                $alert_currency = $ip_visitor_data["geoplugin_currencyCode"];
                if($ip_visitor_data["geoplugin_currencyConverter"]){
                    $alert_cost = round($ip_visitor_data["geoplugin_currencyConverter"]*2, 2);
                }                 
            }
            if($alert_cost == null || $alert_cost == "" || $alert_currency == null || $alert_currency == ""){
                $alert_cost = 2;
                $alert_currency = "USD";
            }
            include(locate_template('content-create-transport-offer-alert-page.php'));
            get_footer();
        }
    } else {
        wp_safe_redirect(get_permalink(get_page_by_path(__('my-account', 'gpdealdomain') . '/' . __('shipments', 'gpdealdomain'))));
        exit;
    }
} else {
    $_SESSION['redirect_to'] = get_the_permalink();
    wp_safe_redirect(get_permalink(get_page_by_path(__('log-in', 'gpdealdomain'))));
    exit;
}    