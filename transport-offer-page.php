<?php

/*
  Template Name: Transport Offer Page
 */
session_start();
expire_session();
if (is_user_logged_in()) {
    if (isset($_SERVER['REQUEST_METHOD']) && $_SERVER['REQUEST_METHOD'] == 'GET') {
        $num_page_in_progress = 1;
        $num_page_expired = 1;
        $params_arg_in_progress = array("transport-offer-status" => "in-progress");
        $params_arg_expired = array("transport-offer-status" => "expired");
        if (isset($_GET["transport-offer-status"]) && $_GET["transport-offer-status"] == "in-progress") {
            $transport_offer_status = removeslashes(esc_attr(trim($_GET["transport-offer-status"])));
            $params_arg_in_progress["transport-offer-status"] = $transport_offer_status;
            if (isset($_GET["num-page"])) {
                $num_page_in_progress = intval(removeslashes(esc_attr(trim($_GET["num-page"]))));
            }
        } elseif (isset($_GET["transport-offer-status"]) && $_GET["transport-offer-status"] == "expired") {
            $transport_offer_status = removeslashes(esc_attr(trim($_GET["transport-offer-status"])));
            $params_arg_expired["transport-offer-status"] = $transport_offer_status;
            if (isset($_GET["num-page"])) {
                $num_page_expired = intval(removeslashes(esc_attr(trim($_GET["num-page"]))));
            }
        }
        $transport_offers_in_progress = new WP_Query(array('post_type' => 'transport-offer', 'posts_per_page' => 4, 'paged' => $num_page_in_progress, "post_status" => 'publish', 'orderby' => 'post_date', 'order' => 'DESC', 'author' => get_current_user_id(), 'meta_query' => array('relation' => 'OR', array('key' => 'transport-status', 'value' => 1, 'compare' => '='), array('key' => 'transport-status', 'value' => -1, 'compare' => '='))));
        $transport_offers_expired = new WP_Query(array('post_type' => 'transport-offer', 'posts_per_page' => 4, 'paged' => $num_page_expired, "post_status" => 'publish', 'orderby' => 'post_date', 'order' => 'DESC', 'author' => get_current_user_id(), 'meta_query' => array('relation' => 'OR', array('key' => 'transport-status', 'value' => 2, 'compare' => '='), array('key' => 'transport-status', 'value' => 4, 'compare' => '='))));
        $total_in_progress_post_pages = $transport_offers_in_progress->max_num_pages;
        $total_expired_post_pages = $transport_offers_expired->max_num_pages;
        $page_link = get_permalink();
    }
    if (get_user_meta(get_current_user_id(), "registration-completed", true) == 2) {
        if (isset($_SERVER['REQUEST_METHOD']) && $_SERVER['REQUEST_METHOD'] == 'POST') {
            if (isset($_POST['transport_offer_package_type']) && isset($_POST['transport_offer_transport_method']) && isset($_POST['start_city']) && isset($_POST['start_date']) && isset($_POST['start_deadline']) && isset($_POST['destination_city']) && isset($_POST['destination_date']) && isset($_POST['terms'])) {
                $package_type = array_map('intval', $_POST['transport_offer_package_type']);
                $contact_voices = array_map('intval', $_POST['contact_voices']);
                $transport_method = removeslashes(esc_attr(trim($_POST['transport_offer_transport_method'])));
                $transport_offer_price = removeslashes(esc_attr(trim($_POST['transport_offer_price'])));
                $transport_offer_currency = removeslashes(esc_attr(trim($_POST['transport_offer_currency'])));
                $transport_offer_price_type = removeslashes(esc_attr(trim($_POST['transport_offer_price_type'])));
                $transport_offer_portable_objects = removeslashes(esc_attr(trim($_POST['transport_offer_portable_objects'])));
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
                $echo_start_city = $start_city;
                $echo_destination_city = $destination_city;
                $transport_offer_data = array(
                    'transport_offer_package_type' => $package_type,
                    'transport_offer_transport_method' => $transport_method,
                    'transport_offer_price' => $transport_offer_price,
                    'transport_offer_currency' => $transport_offer_currency,
                    'transport_offer_price_type' => $transport_offer_price_type,
                    'transport_offer_portable_objects' => $transport_offer_portable_objects,
                    'package_length_max' => $max_length,
                    'package_width_max' => $max_width,
                    'package_height_max' => $max_height,
                    'package_weight_max' => $max_weight,
                    "start_country" => $country_region_city_start['country'],
                    "start_state" => $country_region_city_start['region'],
                    "start_city" => $country_region_city_start['city'],
                    "start_city_as_gmap" => $start_city,
                    'start_date' => $start_date,
                    'start_deadline' => $start_deadline,
                    "destination_country" => $country_region_city_destination['country'],
                    "destination_state" => $country_region_city_destination['region'],
                    "destination_city" => $country_region_city_destination['city'],
                    "destination_city_as_gmap" => $destination_city,
                    "destination_date" => $destination_date,
                    "distance_between_departure_arrival" => gpdealDistanceBetweenTwoCities($start_city, $destination_city),
                    "contact_voices" => $contact_voices
                );
                $transport_offer_id = saveTransportOffer($transport_offer_data);
                if (!is_wp_error($transport_offer_id)) {
                    $_SESSION["success_process"] = __("Your transport offer has been saved and published", "gpdealdomain");
                    wp_safe_redirect(get_permalink(get_page_by_path(__('my-account', 'gpdealdomain') . '/' . __('transport-offers', 'gpdealdomain'))));
                    exit;
                } else {
                    $_SESSION["faillure_process"] = __("An error occurred while saving your transport offer", "gpdealdomain");
                }
            } else {
                $_SESSION["faillure_process"] = __("Some data is missing. Please check and try again", "gpdealdomain");
            }
            get_header();
            include(locate_template('content-write-transport-offer-page.php'));
            get_footer();
        } elseif (isset($_SERVER['REQUEST_METHOD']) && $_SERVER['REQUEST_METHOD'] == 'GET') {
            if (is_page(__('my-account', 'gpdealdomain') . '/' . __('transport-offers', 'gpdealdomain'))) {
                get_header();
                include(locate_template('content-transport-offers-page.php'));
                get_footer();
            } elseif (is_page(__('my-account', 'gpdealdomain') . '/' . __('transport-offers', 'gpdealdomain') . '/' . __('write', 'gpdealdomain'))) {
                get_header();
                $ip_visitor_data = ip_visitor_data();
                if ($ip_visitor_data) {
                    $transport_offer_currency = $ip_visitor_data["geoplugin_currencyCode"];
                } else {
                    $transport_offer_currency = "USD";
                }
                include(locate_template('content-write-transport-offer-page.php'));
                get_footer();
            }
        }
    } else {
        if (is_page(__('my-account', 'gpdealdomain') . '/' . __('transport-offers', 'gpdealdomain'))) {
            get_header();
            include(locate_template('content-transport-offers-page.php'));
            get_footer();
        } elseif (is_page(__('my-account', 'gpdealdomain') . '/' . __('transport-offers', 'gpdealdomain') . '/' . __('write', 'gpdealdomain'))) {
            wp_safe_redirect(get_permalink(get_page_by_path(__('my-account', 'gpdealdomain') . '/' . __('transport-offers', 'gpdealdomain'))));
            exit;
        }
    }
} else {
    $_SESSION["warning_process"] = __("You must be logged in to pusblish a transport offer", "gpdealdomain");
    $_SESSION['redirect_to'] = get_the_permalink();
    wp_safe_redirect(get_permalink(get_page_by_path(__('log-in', 'gpdealdomain'))));
}
