<?php

/*
  Template Name: Select Transport Offers Page
 */

if (is_user_logged_in()) {
    if (isset($_SERVER['REQUEST_METHOD']) && $_SERVER['REQUEST_METHOD'] == 'POST') {
        if (isset($_POST['package_type']) && isset($_POST['portable_objects']) && isset($_POST['package_dimensions_length']) && isset($_POST['package_dimensions_width']) && isset($_POST['package_dimensions_height']) && isset($_POST['package_weight']) && isset($_POST['start_city']) && isset($_POST['start_date']) && isset($_POST['destination_city']) && isset($_POST['destination_date']) && isset($_POST['terms'])) {
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
            $package_id = intval(removeslashes(esc_attr(trim($_POST['package_id']))));
            if (isset($_POST['submit_send_package']) && $_POST['submit_send_package'] == "yes") {
                $package_id = sendPackage($package_data);
            } elseif (isset($_POST['submit_update_send_package']) && $_POST['submit_update_send_package'] == "yes" && $package_id) {
                $package_id = updateSendPackage($package_id, $package_data);
            }

            $search_data = null;
            if (!is_wp_error($package_id)) {
                $search_data = array(
                    'package_type' => $type,
                    'start_city' => $start_city,
                    'start_date' => $start_date,
                    'destination_country' => $destination_city,
                    'destination_date' => $destination_date
                );
                get_header();
                include(locate_template('content-select-transport-offers-page.php'));
                get_footer();
            }
        } else {
            wp_safe_redirect(get_permalink(get_page_by_path(wp_safe_redirect(get_permalink(get_page_by_path(__('mon-compte', 'gpdealdomain') . '/' . __('expeditions', 'gpdealdomain')))))));
            exit;
        }
    } elseif (isset($_SERVER['REQUEST_METHOD']) && $_SERVER['REQUEST_METHOD'] == 'GET' && isset($_GET['package-id'])) {
        $package_id = intval(removeslashes(esc_attr(trim($_GET['package-id']))));
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
            "start_city" => $start_city . ', ' . $start_state . ', ' . $start_country,
            "start_date" => $start_date,
            "destination_city" => $destination_city . ', ' . $destination_state . ', ' . $destination_country,
            "destination_date" => $destination_date
        );
        get_header();
        include(locate_template('content-select-transport-offers-page.php'));
        get_footer();
    } else {
        
    }
} else {
    wp_safe_redirect(esc_url(add_query_arg(array('redirect_to' => get_the_permalink()), get_permalink(get_page_by_path(__('connexion', 'gpdealdomain'))))));
}