<?php

/*
  Template Name: Insure-shipment Page
 */
//header("Cache-Control", "no-cache, no-store, must-revalidate");
session_start();
expire_session();
if (is_user_logged_in()) {
    if (isset($_SERVER['REQUEST_METHOD']) && $_SERVER['REQUEST_METHOD'] == 'POST' && isset($_SESSION['selected_transport_offers']) && isset($_SESSION['package_id'])) {
        $selected_transport_offers = $_SESSION['selected_transport_offers'];
        $package_id = $_SESSION['package_id'];
        if (isset($_POST['property_value']) && isset($_POST['shipment-insured']) && $_POST['shipment-insured'] == "yes") {
            $package_currency = removeslashes(esc_attr(trim($_POST['package_currency'])));
            $property_value = floatval(removeslashes(esc_attr(trim($_POST['property_value']))));
            $package_insured = "yes";
            $insurance_cost = $property_value / 10;
            if (!$package_currency || $package_currency == "") {
                $package_currency = "USD";
            }
            $post = get_post($package_id);
            if ($post) {
                update_post_meta($package_id, 'package-currency', $package_currency);
                update_post_meta($package_id, 'property-value', $property_value);
                update_post_meta($package_id, 'package-insured', $package_insured);
                update_post_meta($package_id, 'insurance-cost', $insurance_cost);
                update_post_meta($package_id, 'package-insurance-completed', 2);
                wp_safe_redirect(esc_url(get_permalink(get_page_by_path(__('select-transport-offers', 'gpdealdomain') . '/' . __('insure-shipment', 'gpdealdomain') . '/' . __('payment', 'gpdealdomain')))));
                exit;
            } else {
                $_SESSION["faillure_process"] = __("This shipment doesn't exist. Please Select a right shipment", "gpdealdomain");
                wp_safe_redirect(get_permalink(get_page_by_path(__('my-account', 'gpdealdomain') . '/' . __('shipments', 'gpdealdomain'))));
                exit;
            }
        } elseif (isset($_POST['shipment-insured']) && $_POST['shipment-insured'] == "no") {
            wp_safe_redirect(esc_url(add_query_arg(array('payment-completed' => 'true'), get_permalink(get_page_by_path(__('my-account', 'gpdealdomain') . '/' . __('show-carriers-contacts', 'gpdealdomain'))))));
            exit;
        } else {
            $_SESSION["faillure_process"] = __("Some data is missing", "gpdealdomain");
            wp_safe_redirect(esc_url(get_permalink()));
            exit;
        }
    } elseif (isset($_SERVER['REQUEST_METHOD']) && $_SERVER['REQUEST_METHOD'] == 'GET' && isset($_SESSION['selected_transport_offers']) && isset($_SESSION['package_id'])) {

        $selected_transport_offers = $_SESSION['selected_transport_offers'];
        $package_id = $_SESSION['package_id'];
        $ip_visitor_data = ip_visitor_data();
        if ($ip_visitor_data) {
            if($ip_visitor_data["geoplugin_currencyCode"] == "XAF" || $ip_visitor_data["geoplugin_currencyCode"] == "XOF"){
                $package_currency = "EUR";
            }elseif($ip_visitor_data["geoplugin_currencyCode"]== "NGR"){
                $package_currency = "USD";
            }else{
                $package_currency = $ip_visitor_data["geoplugin_currencyCode"];
            }
        }else{
            $package_currency = "USD";
        }
        get_header();
        include(locate_template('content-insure-shipment-page.php'));
        get_footer();
    } else {
        wp_safe_redirect(get_permalink(get_page_by_path(__('my-account', 'gpdealdomain') . '/' . __('shipments', 'gpdealdomain'))));
        exit;
    }
} else {
    $_SESSION['redirect_to'] = get_the_permalink();
    wp_safe_redirect(get_permalink(get_page_by_path(__('log-in', 'gpdealdomain'))));
    exit;
}    