<?php

/*
  Template Name: Transport Offer Page
 */
session_start();
expire_session();
if (is_user_logged_in()) {
    if (get_user_meta(get_current_user_id(), "registration-completed", true) == 2) {
        if (isset($_SERVER['REQUEST_METHOD']) && $_SERVER['REQUEST_METHOD'] == 'POST') {
            if (isset($_POST['transport_offer_package_type']) && isset($_POST['transport_offer_transport_method']) && isset($_POST['transport_offer_price']) && isset($_POST['transport_offer_currency']) && isset($_POST['start_city']) && isset($_POST['start_date']) && isset($_POST['start_deadline']) && isset($_POST['destination_city']) && isset($_POST['destination_date']) && isset($_POST['terms'])) {
                $package_type = array_map('intval', $_POST['transport_offer_package_type']);
                $transport_method = removeslashes(esc_attr(trim($_POST['transport_offer_transport_method'])));
                $transport_offer_price = removeslashes(esc_attr(trim($_POST['transport_offer_price'])));
                $transport_offer_currency = removeslashes(esc_attr(trim($_POST['transport_offer_currency'])));
                $transport_offer_price_type = removeslashes(esc_attr(trim($_POST['transport_offer_price_type'])));
                $max_length = removeslashes(esc_attr(trim($_POST['package_length_max'])));
                $max_width = removeslashes(esc_attr(trim($_POST['package_width_max'])));
                $max_height = removeslashes(esc_attr(trim($_POST['package_height_max'])));
                $max_weight = removeslashes(esc_attr(trim($_POST['package_weight_max'])));
                $start_city = removeslashes(esc_attr(trim($_POST['start_city'])));
                $start_date = date('Y-m-d H:i:s', strtotime(str_replace('/', '-', removeslashes(esc_attr(trim($_POST['start_date']))))));
                $start_deadline = date('Y-m-d H:i:s', strtotime(str_replace('/', '-', removeslashes(esc_attr(trim($_POST['start_deadline']))))));
                $destination_city = removeslashes(esc_attr(trim($_POST['destination_city'])));
                $destination_date = date('Y-m-d H:i:s', strtotime(str_replace('/', '-', removeslashes(esc_attr(trim($_POST['destination_date']))))));
                $country_region_city_start = getCountryRegionCityInformations($start_city);
                $country_region_city_destination = getCountryRegionCityInformations($destination_city);
                $transport_offer_data = array(
                    'transport_offer_package_type' => $package_type,
                    'transport_offer_transport_method' => $transport_method,
                    'transport_offer_price' => $transport_offer_price,
                    'transport_offer_currency' => $transport_offer_currency,
                    'transport_offer_price_type' => $transport_offer_price_type,
                    'package_length_max' => $max_length,
                    'package_width_max' => $max_width,
                    'package_height_max' => $max_height,
                    'package_weight_max' => $max_weight,
                    "start_country" => $country_region_city_start['country'],
                    "start_state" => $country_region_city_start['region'],
                    "start_city" => $country_region_city_start['city'],
                    'start_date' => $start_date,
                    'start_deadline' => $start_deadline,
                    "destination_country" => $country_region_city_destination['country'],
                    "destination_state" => $country_region_city_destination['region'],
                    "destination_city" => $country_region_city_destination['city'],
                    'destination_date' => $destination_date
                );
                $transport_offer_id = saveTransportOffer($transport_offer_data);
                if (!is_wp_error($transport_offer_id)) {
                    wp_safe_redirect(get_permalink(get_page_by_path(__('my-account', 'gpdealdomain') . '/' . __('transport-offers', 'gpdealdomain'))));
                    exit;
                }
            } else {
                
            }
            get_header();
            get_template_part('content-write-transport-offer-page', get_post_format());
            get_footer();
        } else {
            get_header();
            if (is_page(__('my-account', 'gpdealdomain') . '/' . __('transport-offers', 'gpdealdomain'))) {
                get_template_part('content-transport-offers-page', get_post_format());
            } elseif (is_page(__('my-account', 'gpdealdomain') . '/' . __('transport-offers', 'gpdealdomain') . '/' . __('write', 'gpdealdomain'))) {
                if (get_user_meta(get_current_user_id(), "registration-completed", true) == 2) {
                    get_template_part('content-write-transport-offer-page', get_post_format());
                } else {
                    wp_safe_redirect(get_permalink(get_page_by_path(__('my-account', 'gpdealdomain') . '/' . __('transport-offers', 'gpdealdomain'))));
                    exit;
                }
            }
            get_footer();
        }
    } else {
        get_header();
        get_template_part('content-transport-offers-page', get_post_format());
        get_footer();
    }
} else {
    $_SESSION['redirect_to'] = get_the_permalink();
    wp_safe_redirect(get_permalink(get_page_by_path(__('log-in', 'gpdealdomain'))));
}
