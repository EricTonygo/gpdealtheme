<?php

/*
  Template Name: Show Transport Offers Package Page
 */

if (is_user_logged_in()) {
    if (isset($_SERVER['REQUEST_METHOD']) && $_SERVER['REQUEST_METHOD'] == 'POST') {
        if (isset($_POST['package_type']) && isset($_POST['portable_objects']) && isset($_POST['package_dimensions_length']) && isset($_POST['package_dimensions_width']) && isset($_POST['package_dimensions_height']) && isset($_POST['package_weight']) && isset($_POST['start_city']) && isset($_POST['start_date']) && isset($_POST['destination_city']) && isset($_POST['destination_date']) && isset($_POST['terms']) && isset($_POST['submit_send_package']) && isset($_POST['confirm_transaction']) && isset($_POST['selected_transport_offers'])) {
            $type = removeslashes(esc_attr(trim($_POST['package_type'])));
            $content = array_map('intval', $_POST['portable_objects']);
            $length = removeslashes(esc_attr(trim($_POST['package_dimensions_length'])));
            $width = removeslashes(esc_attr(trim($_POST['package_dimensions_width'])));
            $height = removeslashes(esc_attr(trim($_POST['package_dimensions_height'])));
            $weight = removeslashes(esc_attr(trim($_POST['package_weight'])));
            $start_city = removeslashes(esc_attr(trim($_POST['start_city'])));
            $start_date = date('Y-m-d H:i:s', strtotime(str_replace('/', '-', removeslashes(esc_attr(trim($_POST['start_date']))))));
            $destination_city = removeslashes(esc_attr(trim($_POST['destination_city'])));
            $destination_date = date('Y-m-d H:i:s', strtotime(str_replace('/', '-', removeslashes(esc_attr(trim($_POST['destination_date']))))));
            $selected_transport_offers = array_map('intval', $_POST['selected_transport_offers']);
            $package_data = array(
                "package_type" => $type,
                "portable_objects" => $content,
                "package_dimensions_length" => $length,
                "package_dimensions_width" => $width,
                "package_dimensions_height" => $height,
                "package_weight" => $weight,
                "start_city" => $start_city,
                "start_date" => $start_date,
                "destination_city" => $destination_city,
                "destination_date" => $destination_date
            );
            $package_id = sendPackage($package_data);
            if (!is_wp_error($package_id) && !empty($selected_transport_offers)) {
                update_post_meta($package_id, 'carrier-ID', $selected_transport_offers);
                foreach ($selected_transport_offers as $transport_offer_id) {
                    $package_ids = get_post_meta($transport_offer_id, 'packages-IDs', true);
                    if (is_array($package_ids) && !empty($package_ids)) {
                        $package_ids = array_map('intval', $package_ids);
                        $package_ids[] = $package_id;
                        update_post_meta($transport_offer_id, 'packages-IDs', $package_ids, -1);
                    } else {
                        update_post_meta($transport_offer_id, 'packages-IDs', array($package_id));
                    }
                }
                update_post_meta($package_id, 'package-status', 2);
                get_header();
                include(locate_template('content-show-transport-offers-package-page.php'));
                get_footer();
            }
        } elseif (isset($_POST['submit_selected_transport_offers']) && $_POST['submit_selected_transport_offers'] == "yes" && $_POST['selected_transport_offers'] && $_POST['package_id']) {
            $selected_transport_offers = array_map('intval', $_POST['selected_transport_offers']);
            $package_id = intval(removeslashes(esc_attr(trim($_POST['package_id']))));
            if ($selected_transport_offers && is_array($selected_transport_offers) && !empty($selected_transport_offers)) {
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
                    if (is_array($package_ids) && !empty($package_ids)) {
                        if ( !in_array($package_id, $package_ids)) {
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
            get_header();
            include(locate_template('content-show-transport-offers-package-page.php'));
            get_footer();
        }
    } elseif (isset($_SERVER['REQUEST_METHOD']) && $_SERVER['REQUEST_METHOD'] == 'GET' && isset($_GET['package-id'])) {
        $package_id = intval(removeslashes(esc_attr(trim($_GET['package-id']))));
        $selected_transport_offers = get_post_meta($package_id, 'carrier-ID', true);
        get_header();
        include(locate_template('content-show-transport-offers-package-page.php'));
        get_footer();
    }
} else {
    wp_safe_redirect(esc_url(add_query_arg(array('redirect_to' => get_the_permalink()), get_permalink(get_page_by_path(__('connexion', 'gpdealdomain'))))));
}
//else {
//    get_header();
//    get_template_part('content-single-package-page', get_post_format());
//    get_footer();
//}