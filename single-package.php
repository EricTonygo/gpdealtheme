<?php

session_start();
expire_session();
if (is_user_logged_in()) {
    if (isset($_SERVER['REQUEST_METHOD']) && $_SERVER['REQUEST_METHOD'] == 'POST') {
        if (!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest' && isset($_POST["action"]) && $_POST["action"] == "cancel") {
            $package_id = intval(removeslashes(esc_attr(trim($_POST['package_id']))));
//        $transport_offers = get_post_meta($package_id, 'carrier-ID', true);
//        if (is_array($transport_offers) && !empty($transport_offers)) {
//            $transport_offers = array_map('intval', $transport_offers);
//            foreach ($transport_offers as $transport_offer_id) {
//                $package_ids = get_post_meta($transport_offer_id, 'packages-IDs', true);
//                if (is_array($package_ids) && !empty($package_ids)) {
//                    $package_ids = array_diff(array_map('intval', $package_ids), array($package_id));
//                    if (is_array($package_ids) && !empty($package_ids)) {
//                        update_post_meta($transport_offer_id, 'packages-IDs', $package_ids);
//                        update_post_meta($transport_offer_id, 'transport-status', 1);
//                    } else {
//                        update_post_meta($transport_offer_id, 'packages-IDs', -1);
//                        update_post_meta($transport_offer_id, 'transport-status', 1);
//                    }
//                }
//            }
//        }

            if ($package_id) {
                //$package_id_result = update_post_meta($package_id, 'carrier-ID', -1);
                $package_id_result = update_post_meta($package_id, 'package-status', 5);
            }
            if ($package_id_result == false) {
                $json = array("message" => __("Unable to cancel your shipment", "gpdealdomain"));
                return wp_send_json_error($json);
            } else {
                $json = array("message" => __("Shipping canceled successfully", "gpdealdomain"));
                return wp_send_json_success($json);
            }
        }if (!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest' && isset($_POST["action"]) && $_POST["action"] == "fence") {
            $package_id = intval(removeslashes(esc_attr(trim($_POST['package_id']))));
            //$transport_offers = get_post_meta($package_id, 'carrier-ID', true);
            $package_id_result = false;
            if ($package_id) {
                $package_id_result = update_post_meta($package_id, 'package-status', 3);
            }
            if ($package_id_result == false) {
                $json = array("message" => __("Unable to close your shipment", "gpdealdomain"));
                return wp_send_json_error($json);
            } else {
                $json = array("message" => __("Shipping successfully closed", "gpdealdomain"));
                return wp_send_json_success($json);
            }
        } elseif (isset($_POST['package_type']) && isset($_POST['portable_objects']) && isset($_POST['package_dimensions_length']) && isset($_POST['package_dimensions_width']) && isset($_POST['package_dimensions_height']) && isset($_POST['package_weight']) && isset($_POST['start_city']) && isset($_POST['start_date']) && isset($_POST['destination_city']) && isset($_POST['destination_date']) && isset($_POST['terms'])) {
            if (is_user_logged_in()) {
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
                $package_id = updateSendPackage(get_the_ID(), $package_data);
                if (!is_wp_error($package_id)) {
                    wp_safe_redirect(get_permalink(get_page_by_path(__('my-account', 'gpdealdomain') . '/' . __('shipments', 'gpdealdomain'))));
                    exit;
                }
            } else {
                wp_safe_redirect(esc_url(add_query_arg(array('redirect_to' => get_the_permalink()), get_permalink(get_page_by_path(__('log-in', 'gpdealdomain'))))));
            }
        } elseif (isset($_POST['submit_selected_transport_offers']) && $_POST['submit_selected_transport_offers'] == "yes" && $_POST['selected_transport_offers'] && $_POST['package_id']) {
            $selected_transport_offers = array_map('intval', $_POST['selected_transport_offers']);
            $package_id = intval(removeslashes(esc_attr(trim($_POST['package_id']))));
            if ($selected_transport_offers) {
                //update_post_meta($package_id, 'transports-IDs', $selected_transport_offers);
                $old_transport_offers = get_post_meta($transport_offer_id, 'carrier-ID', true);
                if (is_array($old_transport_offers) && !empty($old_transport_offers)) {
                    foreach ($old_transport_offers as $old_transport_offer_id) {
                        if (!in_array($old_transport_offer_id, $selected_transport_offers)) {
                            $package_ids = get_post_meta($old_transport_offer_id, 'packages-IDs', true);
                            if (is_array($package_ids) && !empty($package_ids)) {
                                $package_ids = array_diff(array_map('intval', $package_ids), array($package_id));
                                update_post_meta($old_transport_offer_id, 'packages-IDs', $package_ids);
                            }
                        }
                    }
                }
                update_post_meta($package_id, 'carrier-ID', $selected_transport_offers);
                update_post_meta($package_id, 'package-status', 2);
                foreach ($selected_transport_offers as $transport_offer_id) {

                    $package_ids = get_post_meta($transport_offer_id, 'packages-IDs', true);
                    if (is_array($package_ids) && !empty($package_ids) && !in_array($package_id, $package_ids)) {
                        if (!in_array($transport_offer_id, $old_transport_offer_id)) {
                            $package_ids = array_map('intval', $package_ids);
                            $package_ids[] = $package_id;
                            update_post_meta($transport_offer_id, 'packages-IDs', $package_ids);
                        }
                    } else {
                        update_post_meta($transport_offer_id, 'packages-IDs', array($package_id));
                    }
                }
            } else {
//            $old_transport_offers = get_post_meta($package_id, 'carrier-ID', true);
//            if (is_array($old_transport_offers) && !empty($old_transport_offers)) {
//                $old_transport_offers = array_map('intval', $old_transport_offers);
//                foreach ($old_transport_offers as $transport_offer_id) {
//                    $package_ids = get_post_meta($transport_offer_id, 'packages-IDs', true);
//                    if (is_array($package_ids) && !empty($package_ids)) {
//                        $package_ids = array_diff(array_map('intval', $package_ids), array($package_id));
//                        update_post_meta($transport_offer_id, 'packages-IDs', $package_ids);
//                    } else {
//                        update_post_meta($transport_offer_id, 'packages-IDs', array($package_id));
//                    }
//                }
//            }
//            //update_post_met($package_id, 'transports-IDs', array());
//            update_post_meta($package_id, 'carrier-ID', -1);
            }
        }
        get_header();
        include(locate_template('content-single-package-page.php'));
        get_footer();
    } 
//    elseif (isset($_SERVER['REQUEST_METHOD']) && $_SERVER['REQUEST_METHOD'] == 'GET' && isset($_GET['action']) && is_user_logged_in()) {
//        get_header();
//        include(locate_template('content-single-package-page.php'));
//        get_footer();
//    } 
    elseif (is_user_logged_in()) {
        if(isset($_SERVER['REQUEST_METHOD']) && $_SERVER['REQUEST_METHOD'] == 'GET' && isset($_GET['transport-offer-id'])){
            $transport_offer_id = intval(removeslashes(esc_attr(trim($_GET['transport-offer-id']))));
        }
        get_header();
        include(locate_template('content-single-package-page.php'));
        get_footer();
    }
} else {
    $_SESSION['redirect_to'] = get_the_permalink();
    wp_safe_redirect(get_permalink(get_page_by_path(__('log-in', 'gpdealdomain'))));
}