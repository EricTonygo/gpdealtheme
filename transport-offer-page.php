<?php

/*
  Template Name: Transport Offer Page
 */
session_start();
if (is_user_logged_in()) {
    if (isset($_SERVER['REQUEST_METHOD']) && $_SERVER['REQUEST_METHOD'] == 'POST') {
        if (isset($_POST['transport_offer_package_type']) && isset($_POST['transport_offer_transport_method']) && isset($_POST['transport_offer_price']) && isset($_POST['transport_offer_currency']) && isset($_POST['start_city']) && isset($_POST['start_date']) && isset($_POST['start_deadline']) && isset($_POST['destination_city']) && isset($_POST['destination_date']) && isset($_POST['terms'])) {
            $package_type = array_map('intval', $_POST['transport_offer_package_type']);
            $transport_method = removeslashes(esc_attr(trim($_POST['transport_offer_transport_method'])));
            $transport_offer_price = removeslashes(esc_attr(trim($_POST['transport_offer_price'])));
            $transport_offer_currency = removeslashes(esc_attr(trim($_POST['transport_offer_currency'])));
            $start_city = removeslashes(esc_attr(trim($_POST['start_city'])));
            $start_date = date('Y-m-d H:i:s', strtotime(str_replace('/', '-', removeslashes(esc_attr(trim($_POST['start_date']))))));
            $start_deadline = date('Y-m-d H:i:s', strtotime(str_replace('/', '-', removeslashes(esc_attr(trim($_POST['start_deadline']))))));
            $destination_city = removeslashes(esc_attr(trim($_POST['destination_city'])));
            $destination_date = date('Y-m-d H:i:s', strtotime(str_replace('/', '-', removeslashes(esc_attr(trim($_POST['destination_date']))))));
            $transport_offer_data = array(
                'transport_offer_package_type' => $package_type,
                'transport_offer_transport_method' => $transport_method,
                'transport_offer_price' => $transport_offer_price,
                'transport_offer_currency' => $transport_offer_currency,
                'start_city' => $start_city,
                'start_date' => $start_date,
                'start_deadline' => $start_deadline,
                'destination_city' => $destination_city,
                'destination_date' => $destination_date
            );
            $transport_offer_id = saveTransportOffer($transport_offer_data);
            if (!is_wp_error($transport_offer_id)) {
                wp_safe_redirect(get_permalink(get_page_by_path(__('mon-compte', 'gpdealdomain') . '/' . __('offres-de-transport', 'gpdealdomain'))));
                exit;
            }
        } else {
            
        }
        get_header();
        get_template_part('content-write-transport-offer-page', get_post_format());
        get_footer();
    } else {
        get_header();
        if (is_page(__('mon-compte', 'gpdealdomain') . '/' . __('offres-de-transport', 'gpdealdomain'))) {
            get_template_part('content-transport-offers-page', get_post_format());
        } elseif (is_page(__('mon-compte', 'gpdealdomain') . '/' . __('offres-de-transport', 'gpdealdomain') . '/' . __('saisir', 'gpdealdomain'))) {
            get_template_part('content-write-transport-offer-page', get_post_format());
        }
        get_footer();
    }
} else {
    $_SESSION['redirect_to'] = get_the_permalink();
    wp_safe_redirect(get_permalink(get_page_by_path(__('connexion', 'gpdealdomain'))));
}
