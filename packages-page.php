<?php

/*
  Template Name: Packages Page
 */
session_start();
expire_session();
if (is_user_logged_in()) {
    if (get_user_meta(get_current_user_id(), "registration-completed", true) == 2) {
        if (isset($_SERVER['REQUEST_METHOD']) && $_SERVER['REQUEST_METHOD'] == 'POST') {
            if (isset($_POST['submit_send_package']) && $_POST['submit_send_package'] == "yes" && isset($_POST['package_type']) && isset($_POST['package_content']) && isset($_POST['package_dimensions_length']) && isset($_POST['package_dimensions_width']) && isset($_POST['package_dimensions_height']) && isset($_POST['package_weight']) && isset($_POST['start_city']) && isset($_POST['start_date']) && isset($_POST['destination_city']) && isset($_POST['destination_date']) && isset($_POST['terms'])) {
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
                $package_currency = removeslashes(esc_attr(trim($_POST['package_currency'])));
                $package_insured = removeslashes(esc_attr(trim($_POST['package_insured'])));
                $property_value = removeslashes(esc_attr(trim($_POST['property_value'])));
                $insurance_cost = removeslashes(esc_attr(trim($_POST['insurance_cost'])));
                $echo_start_city = $start_city;
                $echo_destination_city = $destination_city;
                if ($package_insured && $package_insured == "on") {
                    $package_insured = "yes";
                    $property_value = floatval($property_value);
                    $insurance_cost = $property_value / 10;
                } else {
                    $package_insured = "no";
                    $property_value = null;
                    $insurance_cost = null;
                }
                if (!$package_currency || $package_currency == "") {
                    $package_currency = "USD";
                }
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
                    "package_currency" => $package_currency,
                    "package_insured" => $package_insured,
                    "property_value" => $property_value,
                    "insurance_cost" => $insurance_cost,
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
                $package_id = sendPackage($package_data);
                if (!is_wp_error($package_id)) {
                    wp_safe_redirect(esc_url(add_query_arg(array('package-id' => $package_id), get_permalink(get_page_by_path(__('select-transport-offers', 'gpdealdomain'))))));
                    exit;
                } else {
                    $_SESSION['faillure_process'] = __("An error occurred while saving your shipment", "gpdealdomain");
                }
            } else {
                $_SESSION["faillure_process"] = __("Some data is missing. Please check and try again", "gpdealdomain");
            }
            get_header();
            include(locate_template('content-send-package-page.php'));
            get_footer();
        } elseif (isset($_SERVER['REQUEST_METHOD']) && $_SERVER['REQUEST_METHOD'] == 'GET') {
            if (is_page(__('my-account', 'gpdealdomain') . '/' . __('shipments', 'gpdealdomain'))) {
                get_header();
                get_template_part('content-packages-page', get_post_format());
                get_footer();
            } elseif (is_page(__('my-account', 'gpdealdomain') . '/' . __('shipments', 'gpdealdomain') . '/' . __('write', 'gpdealdomain'))) {
                if (get_user_meta(get_current_user_id(), "registration-completed", true) == 2) {
                    get_header();
                    get_template_part('content-send-package-page', get_post_format());
                    get_footer();
                } else {
                    wp_safe_redirect(get_permalink(get_page_by_path(__('my-account', 'gpdealdomain') . '/' . __('shipments', 'gpdealdomain'))));
                    exit;
                }
            }
        }
    } else {
        if (is_page(__('my-account', 'gpdealdomain') . '/' . __('shipments', 'gpdealdomain'))) {
            get_header();
            get_template_part('content-packages-page', get_post_format());
            get_footer();
        } elseif (is_page(__('my-account', 'gpdealdomain') . '/' . __('shipments', 'gpdealdomain') . '/' . __('write', 'gpdealdomain'))) {
            wp_safe_redirect(get_permalink(get_page_by_path(__('my-account', 'gpdealdomain') . '/' . __('shipments', 'gpdealdomain'))));
            exit;
        }
    }
} else {
    $_SESSION['redirect_to'] = get_the_permalink();
    wp_safe_redirect(get_permalink(get_page_by_path(__('log-in', 'gpdealdomain'))));
    exit;
}
