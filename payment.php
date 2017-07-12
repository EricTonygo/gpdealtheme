<?php

/*
  Template Name: Payment Page
 */
//header("Cache-Control", "no-cache, no-store, must-revalidate");
session_start();
expire_session();
if (is_user_logged_in()) {
    if (isset($_SERVER['REQUEST_METHOD']) && $_SERVER['REQUEST_METHOD'] == 'POST' && isset($_SESSION['selected_transport_offers']) && isset($_SESSION['package_id'])) {
        if (isset($_POST['card-type']) && isset($_POST['card-number']) && isset($_POST['card-cvc']) && isset($_POST['card-expire-month']) && isset($_POST['card-expire-year']) && isset($_POST['first-name']) && isset($_POST['last-name']) && isset($_POST['billing-country-code'])) {
            $card_type = removeslashes(esc_attr(trim($_POST['card-type'])));
            $card_number = removeslashes(esc_attr(trim($_POST['card-number'])));
            $card_cvc = removeslashes(esc_attr(trim($_POST['card-cvc'])));
            $card_expire_month = removeslashes(esc_attr(trim($_POST['card-expire-month'])));
            $card_expire_year = removeslashes(esc_attr(trim($_POST['card-expire-year'])));
            $billing_country_code = removeslashes(esc_attr(trim($_POST['billing-country-code'])));
            $first_name = removeslashes(esc_attr(trim($_POST['first-name'])));
            $last_name = removeslashes(esc_attr(trim($_POST['last-name'])));
            $result = executePaypalPaymentWithCreditCard($card_type, $card_number, $card_cvc, $card_expire_month, $card_expire_year, $billing_country_code, $first_name, $last_name);
            if ($result) {
                wp_safe_redirect(esc_url(add_query_arg(array('payment-completed' => 'true'), get_permalink(get_page_by_path(__('my-account', 'gpdealdomain') . '/' . __('show-carriers-contacts', 'gpdealdomain'))))));
                exit;
            } else {
                /****************************Pensez à changer cette redirection en cas d'echec du paiement par carte de credit renvoyer à la page payement avec une erreur definie en session***********************************************************/
                wp_safe_redirect(esc_url(add_query_arg(array('payment-completed' => 'true'), get_permalink(get_page_by_path(__('my-account', 'gpdealdomain') . '/' . __('show-carriers-contacts', 'gpdealdomain'))))));
                exit;
//                wp_safe_redirect(get_permalink());
//                exit;
            }
        } else {
            $_SESSION["faillure_process"] = __("Some data is missing", "gpdealdomain");
            wp_safe_redirect(esc_url(get_permalink(get_page_by_path(__('select-transport-offers', 'gpdealdomain') . '/' . __('review', 'gpdealdomain')))));
            exit;
        }
    } elseif (isset($_SERVER['REQUEST_METHOD']) && $_SERVER['REQUEST_METHOD'] == 'GET' && isset($_SESSION['selected_transport_offers']) && isset($_SESSION['package_id'])) {
        if (isset($_GET['success']) && $_GET['success'] == "true") {
            $paymentId = $_GET['paymentId'];
            $payerId = $_GET['PayerID'];
            $result = executePaypalPayment($paymentId, $payerId);
            if ($result) {
                wp_safe_redirect(esc_url(add_query_arg(array('payment-completed' => 'true'), get_permalink(get_page_by_path(__('my-account', 'gpdealdomain') . '/' . __('show-carriers-contacts', 'gpdealdomain'))))));
                exit;
            }
        } elseif (isset($_GET['success']) && $_GET['success'] == "false") {
            $cancel_redirect_urls = $_SESSION['error_cancel_redirect_url'] != null ? $_SESSION['error_cancel_redirect_url'] : home_url('/');
            $_SESSION['faillure_process'] = __("Payment process was cancelled", "gpdealdomain");
            wp_safe_redirect($cancel_redirect_urls);
            exit;
        } elseif (isset($_GET['payment-method']) && $_GET['payment-method'] == "paypal") {
            executePaypalPaymentUsingPaypalAccount();
        } else {
            get_header();
            get_template_part('content-payment-page', get_post_format());
            get_footer();
        }
    }else{
        wp_safe_redirect(get_permalink(get_page_by_path(__('my-account', 'gpdealdomain') . '/' . __('shipments', 'gpdealdomain'))));
        exit;
    }
} else {
    $_SESSION['redirect_to'] = get_the_permalink();
    wp_safe_redirect(get_permalink(get_page_by_path(__('log-in', 'gpdealdomain'))));
}