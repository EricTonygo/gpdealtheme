<?php

/*
  Template Name: Packages Page
 */
session_start();
expire_session();
if (is_user_logged_in()) {
    if (isset($_SERVER['REQUEST_METHOD']) && $_SERVER['REQUEST_METHOD'] == 'GET') {
        $params_arg = array();
        $num_page_search_for_carriers = 1;
        $num_page_in_progress = 1;
        $num_page_evaluated_closed = 1;
        $num_page_expired = 1;
        $num_page_canceled = 1;
        $params_arg_search_for_carriers = array("shipment-status" => "search-for-carriers");
        $params_arg_in_progress = array("shipment-status" => "in-progress");
        $params_arg_evaluated_closed = array("shipment-status" => "evaluated-closed");
        $params_arg_expired = array("shipment-status" => "expired");
        $params_arg_canceled = array("shipment-status" => "canceled");
        if (isset($_GET["shipment-status"]) && $_GET["shipment-status"] == "search-for-carriers") {
            $shipments_status = removeslashes(esc_attr(trim($_GET["shipment-status"])));
            $params_arg_search_for_carriers["shipment-status"] = $shipments_status;
            if (isset($_GET["num-page"])) {
                $num_page_search_for_carriers = intval(removeslashes(esc_attr(trim($_GET["num-page"]))));
            }
        } elseif (isset($_GET["shipment-status"]) && $_GET["shipment-status"] == "in-progress") {
            $shipments_status = removeslashes(esc_attr(trim($_GET["shipment-status"])));
            $params_arg_in_progress["shipment-status"] = $shipments_status;
            if (isset($_GET["num-page"])) {
                $num_page_in_progress = intval(removeslashes(esc_attr(trim($_GET["num-page"]))));
            }
        } elseif (isset($_GET["shipment-status"]) && $_GET["shipment-status"] == "evaluated-closed") {
            $shipments_status = removeslashes(esc_attr(trim($_GET["shipment-status"])));
            $params_arg_evaluated_closed["shipment-status"] = $shipments_status;
            if (isset($_GET["num-page"])) {
                $num_page_evaluated_closed = intval(removeslashes(esc_attr(trim($_GET["num-page"]))));
            }
        } elseif (isset($_GET["shipment-status"]) && $_GET["shipment-status"] == "expired") {
            $shipments_status = removeslashes(esc_attr(trim($_GET["shipment-status"])));
            $params_arg_expired["shipment-status"] = $shipments_status;
            if (isset($_GET["num-page"])) {
                $num_page_expired = intval(removeslashes(esc_attr(trim($_GET["num-page"]))));
            }
        } elseif (isset($_GET["shipment-status"]) && $_GET["shipment-status"] == "canceled") {
            $shipments_status = removeslashes(esc_attr(trim($_GET["shipment-status"])));
            $params_arg_canceled["shipment-status"] = $shipments_status;
            if (isset($_GET["num-page"])) {
                $num_page_canceled = intval(removeslashes(esc_attr(trim($_GET["num-page"]))));
            }
        }
        $packages_search_for_carriers = new WP_Query(array('post_type' => 'package', 'posts_per_page' => 4, 'paged' => $num_page_search_for_carriers, "post_status" => 'publish', 'orderby' => 'post_date', 'order' => 'DESC', 'author' => get_current_user_id(), 'meta_query' => array('relation' => 'OR', array('key' => 'package-status', 'value' => 1, 'compare' => '='), array('key' => 'package-status', 'value' => -1, 'compare' => '='))));
        $packages_in_progress = new WP_Query(array('post_type' => 'package', 'posts_per_page' => 4, 'paged' => $num_page_in_progress, "post_status" => 'publish', 'orderby' => 'post_date', 'order' => 'DESC', 'author' => get_current_user_id(), 'meta_query' => array(array('key' => 'package-status', 'value' => 2, 'compare' => '='))));
        $packages_evaluated_closed = new WP_Query(array('post_type' => 'package', 'posts_per_page' => 4, 'paged' => $num_page_evaluated_closed, "post_status" => 'publish', 'orderby' => 'post_date', 'order' => 'DESC', 'author' => get_current_user_id(), 'meta_query' => array(array('key' => 'package-status', 'value' => 3, 'compare' => '='))));
        $packages_expired = new WP_Query(array('post_type' => 'package', 'posts_per_page' => 4, 'paged' => $num_page_expired, "post_status" => 'publish', 'orderby' => 'post_date', 'order' => 'DESC', 'author' => get_current_user_id(), 'meta_query' => array(array('key' => 'package-status', 'value' => 4, 'compare' => '='))));
        $packages_canceled = new WP_Query(array('post_type' => 'package', 'posts_per_page' => 4, 'paged' => $num_page_canceled, "post_status" => 'publish', 'orderby' => 'post_date', 'order' => 'DESC', 'author' => get_current_user_id(), 'meta_query' => array(array('key' => 'package-status', 'value' => 5, 'compare' => '='))));
        $total_search_for_carriers_post_pages = $packages_search_for_carriers->max_num_pages;
        $total_in_progress_post_pages = $packages_in_progress->max_num_pages;
        $total_evaluated_closed_post_pages = $packages_evaluated_closed->max_num_pages;
        $total_expired_post_pages = $packages_expired->max_num_pages;
        $total_canceled_post_pages = $packages_canceled->max_num_pages;
        $page_link = get_permalink();
    }
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

                include(locate_template('content-packages-page.php'));
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
    } elseif (isset($_SERVER['REQUEST_METHOD']) && $_SERVER['REQUEST_METHOD'] == 'GET') {
        if (is_page(__('my-account', 'gpdealdomain') . '/' . __('shipments', 'gpdealdomain'))) {
            get_header();
            include(locate_template('content-packages-page.php'));
            get_footer();
        } elseif (is_page(__('my-account', 'gpdealdomain') . '/' . __('shipments', 'gpdealdomain') . '/' . __('write', 'gpdealdomain'))) {
            wp_safe_redirect(get_permalink(get_page_by_path(__('my-account', 'gpdealdomain') . '/' . __('shipments', 'gpdealdomain'))));
            exit;
        }
    }
} else {
    $_SESSION["warning_process"] = __("You must be logged in to pusblish a shipment", "gpdealdomain");
    $_SESSION['redirect_to'] = get_the_permalink();
    wp_safe_redirect(get_permalink(get_page_by_path(__('log-in', 'gpdealdomain'))));
    exit;
}
