<?php

/*
  Template Name: Packages Page
 */
session_start();
expire_session();
if (is_user_logged_in()) {
    if (isset($_SERVER['REQUEST_METHOD']) && $_SERVER['REQUEST_METHOD'] == 'POST') {
        if (isset($_POST['package_type']) && isset($_POST['portable_objects']) && isset($_POST['package_dimensions_length']) && isset($_POST['package_dimensions_width']) && isset($_POST['package_dimensions_height']) && isset($_POST['package_weight']) && isset($_POST['start_city']) && isset($_POST['start_date']) && isset($_POST['destination_city']) && isset($_POST['destination_date']) && isset($_POST['terms'])) {
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
            $package_picture_id = null;
            if (!empty($package_picture)) {
                $package_picture_id = upload_file($package_picture);
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
            $package_id = sendPackage($package_data);
            if (!is_wp_error($package_id)) {
                wp_safe_redirect(get_permalink(get_page_by_path(__('my-account', 'gpdealdomain') . '/' . __('shipments', 'gpdealdomain'))));
                exit;
            }
        } else {
            
        }
        get_header();
        get_template_part('content-send-package-page', get_post_format());
        get_footer();
    } else {
        get_header();
        if (is_page(__('my-account', 'gpdealdomain') . '/' . __('shipments', 'gpdealdomain'))) {

            get_template_part('content-packages-page', get_post_format());
        } elseif (is_page(__('my-account', 'gpdealdomain') . '/' . __('shipments', 'gpdealdomain') . '/' . __('write', 'gpdealdomain'))) {
            get_template_part('content-send-package-page', get_post_format());
        }
        get_footer();
    }
} else {
    $_SESSION['redirect_to'] = get_the_permalink();
    wp_safe_redirect(get_permalink(get_page_by_path(__('log-in', 'gpdealdomain'))));
}
