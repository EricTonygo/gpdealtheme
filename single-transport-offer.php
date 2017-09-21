<?php

session_start();
expire_session();
if (is_user_logged_in()) {
    if (isset($_SERVER['REQUEST_METHOD']) && $_SERVER['REQUEST_METHOD'] == 'POST') {
        if (!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest' && isset($_POST["action"]) && $_POST["action"] == "evaluate") {
            $item_delivred = removeslashes(esc_attr(trim($_POST['item_delivred'])));
            $item_state = removeslashes(esc_attr(trim($_POST['item_state'])));
            $delivry_time = removeslashes(esc_attr(trim($_POST['delivry_time'])));
            $cost = removeslashes(esc_attr(trim($_POST['cost'])));
            $global_evaluation = removeslashes(esc_attr(trim($_POST['global_evaluation'])));
            $comment_content = removeslashes(esc_attr(trim($_POST['comment_content'])));
            $package_id = intval(removeslashes(esc_attr(trim($_POST['package_id']))));
            $action = $_POST['action'];
            $evaluation_data = array(
                "responses" => array($item_delivred, $item_state, $delivry_time, $cost, $global_evaluation),
                'comment_content' => $comment_content,
                'package_id' => $package_id
            );

            $evaluation_id = evaluateTransportOffer($evaluation_data);
            $package_id_result = false;
            if (is_wp_error($evaluation_id)) {
                $json = array("message" => __("Unable to add evaluation. An error has occurred", "gpdealdomain"));
                return wp_send_json_error($json);
            }
//            if ($package_id) {
//                $package_id_result = update_post_meta($package_id, 'package-status', 3);
//            }
            $json = array("message" => __("Offer evaluated and successfully closed", "gpdealdomain"));
            return wp_send_json_success($json);
        } elseif (!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest' && isset($_POST["action"]) && $_POST["action"] == "add-evaluation-comment" && isset($_POST["evaluation_id"])) {
            $evaluation_id = intval(removeslashes(esc_attr(trim($_POST['evaluation_id']))));
            $comment_content = removeslashes(esc_attr(trim($_POST['comment_content'])));
            $action = $_POST['action'];
            $comment_id = add_evaluation_comment($evaluation_id, $comment_content);
            if ($comment_id == null || is_wp_error($comment_id)) {
                $json = array("message" => __("Unable to add comment to this review", "gpdealdomain"));
                return wp_send_json_error($json);
            }
            $json = array("message" => __("Comment added successfully", "gpdealdomain"));
            return wp_send_json_success($json);
        } elseif (!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest' && isset($_POST["action"]) && $_POST["action"] == "add-comment-reply" && isset($_POST["evaluation_id"]) && isset($_POST["comment_parent_id"])) {
            $evaluation_id = intval(removeslashes(esc_attr(trim($_POST['evaluation_id']))));
            $comment_parent_id = intval(removeslashes(esc_attr(trim($_POST['comment_parent_id']))));
            $comment_content = removeslashes(esc_attr(trim($_POST['comment_content'])));
            $action = $_POST['action'];
            $comment_id = add_comment_reply($evaluation_id, $comment_parent_id, $comment_content);
            if ($comment_id == null || is_wp_error($comment_id)) {
                $json = array("message" => __("Unable to add response to this comment", "gpdealdomain"));
                return wp_send_json_error($json);
            }
            $json = array("message" => __("Successfully replied", "gpdealdomain"));
            return wp_send_json_success($json);
        } elseif (!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest' && isset($_POST["action"]) && $_POST["action"] == "close") {
            $transport_offer_id = removeslashes(esc_attr(trim($_POST['transport_offer_id'])));
            $package_id = removeslashes(esc_attr(trim($_POST['package_id'])));
            $action = $_POST['action'];
            $carriers_IDs = get_post_meta($package_id, 'carrier-ID', true);
            $packages_IDs = get_post_meta($transport_offer_id, 'packages-IDs', true);
            if (is_array($carriers_IDs) && !empty($carriers_IDs)) {
                $carriers_IDs = array_diff(array_map('intval', $carriers_IDs), array($transport_offer_id));
                if (empty($carriers_IDs)) {
                    $package_id_result = update_post_meta($package_id, 'carrier-ID', -1);
                    $package_id_result = update_post_meta($package_id, 'package-status', 1);
                } else {
                    $package_id_result = update_post_meta($package_id, 'carrier-ID', $carriers_IDs);
                }
            }

            if ($package_id_result == true && is_array($packages_IDs) && !empty($packages_IDs)) {
                $packages_IDs = array_diff(array_map('intval', $packages_IDs), array($package_id));
                if (empty($packages_IDs)) {
                    $transport_offer_id_result = update_post_meta($transport_offer_id, 'packages-IDs', -1);
                    $transport_offer_id_result = update_post_meta($transport_offer_id, 'transport-status', 1);
                } else {
                    $transport_offer_id_result = update_post_meta($transport_offer_id, 'packages-IDs', $carriers_IDs);
                }
                //if ($transport_offer_id_result == true) {
                $evaluations = new WP_Query(array('post_type' => 'evaluation', 'post_per_page' => -1, "post_status" => 'publish', 'author' => get_current_user_id(), 'meta_query' => array("relation" => "AND", array('key' => 'transport-offer-ID', 'value' => $transport_offer_id, 'compare' => '='), array('key' => 'package-ID', 'value' => $package_id, 'compare' => '='))));
                if ($evaluations->have_posts()) {
                    while ($evaluations->have_posts()) {
                        $evaluations->the_post();
                        $evaluation_data = array(
                            "ID" => get_the_ID(),
                            "post_status" => "trash"
                        );
                        wp_update_post($evaluation_data);
                    }
                    wp_reset_postdata();
                }
                //}
            }
            if ($package_id_result == false) {
                $json = array("message" => __("Unable to close transaction", "gpdealdomain"));
                return wp_send_json_error($json);
            } else {
                $json = array("message" => __("Transaction close successfully", "gpdealdomain"));
                return wp_send_json_success($json);
            }
        } elseif (isset($_POST['transport_offer_package_type']) && isset($_POST['transport_offer_transport_method']) && isset($_POST['start_city']) && isset($_POST['start_date']) && isset($_POST['start_deadline']) && isset($_POST['destination_city']) && isset($_POST['destination_date']) && isset($_POST['terms'])) {
            $package_type = array_map('intval', $_POST['transport_offer_package_type']);
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
                'destination_date' => $destination_date,
                "distance_between_departure_arrival" => gpdealDistanceBetweenTwoCities($start_city, $destination_city)
            );
            $transport_offer_id = updateTransportOffer(get_the_ID(), $transport_offer_data);
            if (!is_wp_error($transport_offer_id)) {
                $_SESSION["success_process"] = __("Your transport offer has been edited and published", "gpdealdomain");
                wp_safe_redirect(get_permalink(get_page_by_path(__('my-account', 'gpdealdomain') . '/' . __('transport-offers', 'gpdealdomain'))));
                exit;
            } else {
                $_SESSION["faillure_process"] = __("An error occurred while editing your transport offer", "gpdealdomain");
            }
        } else {
            $_SESSION["faillure_process"] = __("Some data is missing. Please check and try again", "gpdealdomain");
        }
        get_header();
        include(locate_template('content-single-transport-offer-page.php'));
        get_footer();
    } elseif (isset($_SERVER['REQUEST_METHOD']) && $_SERVER['REQUEST_METHOD'] == 'GET' && isset($_GET['action'])) {
        if ($_GET['action'] == "evaluate" && isset($_GET['package_id'])) {
            $action = $_GET['action'];
            $package_id = intval(removeslashes(esc_attr(trim($_GET['package_id']))));
        }
        get_header();
        include(locate_template('content-single-transport-offer-page.php'));
        get_footer();
    } elseif (isset($_SERVER['REQUEST_METHOD']) && $_SERVER['REQUEST_METHOD'] == 'GET' && isset($_GET['package_id']) && !isset($_GET['action'])) {
        $package_id = intval(removeslashes(esc_attr(trim($_GET['package_id']))));
        get_header();
        include(locate_template('content-single-transport-offer-page.php'));
        get_footer();
    } else {
        get_header();
        get_template_part('content-single-transport-offer-page', get_post_format());
        get_footer();
    }
} else {
    $_SESSION['redirect_to'] = get_the_permalink();
    wp_safe_redirect(get_permalink(get_page_by_path(__('log-in', 'gpdealdomain'))));
}