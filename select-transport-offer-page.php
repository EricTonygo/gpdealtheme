<?php

/*
  Template Name: Select Transport Offers Page
 */
session_start();
expire_session();
if (is_user_logged_in()) {    
    if (isset($_SERVER['REQUEST_METHOD']) && $_SERVER['REQUEST_METHOD'] == 'POST') {
        if (isset($_POST['package_type']) && isset($_POST['package_content']) && isset($_POST['package_dimensions_length']) && isset($_POST['package_dimensions_width']) && isset($_POST['package_dimensions_height']) && isset($_POST['package_weight']) && isset($_POST['start_city']) && isset($_POST['start_date']) && isset($_POST['destination_city']) && isset($_POST['destination_date']) && isset($_POST['terms'])) {
            $type = removeslashes(esc_attr(trim($_POST['package_type'])));
            $package_content = removeslashes(esc_attr(trim($_POST['package_content'])));
            $length = removeslashes(esc_attr(trim($_POST['package_dimensions_length'])));
            $width = removeslashes(esc_attr(trim($_POST['package_dimensions_width'])));
            $height = removeslashes(esc_attr(trim($_POST['package_dimensions_height'])));
            $weight = removeslashes(esc_attr(trim($_POST['package_weight'])));
            $start_city = removeslashes(esc_attr(trim($_POST['start_city'])));
            $start_date = date('Y-m-d H:i:s', strtotime(str_replace('/', '-', removeslashes(esc_attr(trim($_POST['start_date']))))));
            $destination_city = removeslashes(esc_attr(trim($_POST['destination_city'])));
            $destination_date = date('Y-m-d H:i:s', strtotime(str_replace('/', '-', removeslashes(esc_attr(trim($_POST['destination_date']))))));
            $package_picture = $_FILES['package_picture_file'];
            if (!empty($package_picture)) {
                $package_picture_id = upload_file($package_picture);
            } else {
                $package_picture_id = removeslashes(esc_attr(trim($_POST['package_picture_id'])));
            }
            $country_region_city_start = getCountryRegionCityInformations($start_city);
            $country_region_city_destination = getCountryRegionCityInformations($destination_city);
            $package_data = array(
                "package_type" => $type,
                "package_content" => $package_content,
                "package_dimensions_length" => $length,
                "package_dimensions_width" => $width,
                "package_dimensions_height" => $height,
                "package_weight" => $weight,
                "start_country" => $country_region_city_start['country'],
                "start_state" => $country_region_city_start['region'],
                "start_city" => $country_region_city_start['city'],
                "start_date" => $start_date,
                "destination_country" => $country_region_city_destination['country'],
                "destination_state" => $country_region_city_destination['region'],
                "destination_city" => $country_region_city_destination['city'],
                "destination_date" => $destination_date,
                "package_picture_id" => $package_picture_id
            );
            $package_id = intval(removeslashes(esc_attr(trim($_POST['package_id']))));
            if (isset($_POST['submit_send_package']) && $_POST['submit_send_package'] == "yes") {
                $package_id = sendPackage($package_data);
            } elseif (isset($_POST['submit_update_send_package']) && $_POST['submit_update_send_package'] == "yes" && $package_id) {
                $package_id = updateSendPackage($package_id, $package_data);
            }

            $search_data = null;
            if (!is_wp_error($package_id)) {
//                $country_region_city_start = getCountryRegionCityInformations($start_city);
//                $country_region_city_destination = getCountryRegionCityInformations($destination_city);
//                $search_data = array(
//                    'package_type' => $type,
//                    "start_country" => $country_region_city_start['country'],
//                    "start_state" => $country_region_city_start['region'],
//                    "start_city" => $country_region_city_start['city'],
//                    'start_date' => $start_date,
//                    "destination_country" => $country_region_city_destination['country'],
//                    "destination_state" => $country_region_city_destination['region'],
//                    "destination_city" => $country_region_city_destination['city'],
//                    'destination_date' => $destination_date
//                );
//                get_header();
//                include(locate_template('content-select-transport-offers-page.php'));
//                get_footer();
                wp_safe_redirect(esc_url(add_query_arg(array('package-id' => $package_id), get_permalink(get_page_by_path(__('select-transport-offers', 'gpdealdomain'))))));
                exit;
            }
        } else {
            wp_safe_redirect(get_permalink(get_page_by_path(__('my-account', 'gpdealdomain') . '/' . __('shipments', 'gpdealdomain'))));
            exit;
        }
    } elseif (isset($_SERVER['REQUEST_METHOD']) && $_SERVER['REQUEST_METHOD'] == 'GET' && isset($_GET['package-id'])) {
        $package_id = intval(removeslashes(esc_attr(trim($_GET['package-id']))));
        $old_transport_offers = is_array(get_post_meta($package_id, 'carrier-ID', true)) ? array_map('intval', get_post_meta($package_id, 'carrier-ID', true)): array();
        $type = wp_get_post_terms($package_id, 'type_package', array("fields" => "ids"));
        $start_country = get_post_meta($package_id, 'departure-country-package', true);
        $start_state = get_post_meta($package_id, 'departure-state-package', true);
        $start_city = get_post_meta($package_id, 'departure-city-package', true);
        $start_date = date('d-m-Y', strtotime(get_post_meta($package_id, 'date-of-departure-package', true)));
        $destination_country = get_post_meta($package_id, 'destination-country-package', true);
        $destination_state = get_post_meta($package_id, 'destination-state-package', true);
        $destination_city = get_post_meta($package_id, 'destination-city-package', true);
        $destination_date = date('d-m-Y', strtotime(get_post_meta($package_id, 'arrival-date-package', true)));
        $search_data = array(
            "package_type" => $type,
            "start_country" => $start_country,
            "start_state" => $start_state,
            "start_city" => $start_city,
            "start_date" => $start_date,
            "destination_country" => $destination_country,
            "destination_state" => $destination_state,
            "destination_city" => $destination_city,
            "destination_date" => $destination_date,
            "excluded_transport_offers" => $old_transport_offers
        );
        get_header();
        include(locate_template('content-select-transport-offers-page.php'));
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
