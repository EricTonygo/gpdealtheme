<?php

/*
  Template Name: Show Transport Offers Package Page
 */
session_start();
expire_session();
if (is_user_logged_in()) {
    if (isset($_SERVER['REQUEST_METHOD']) && $_SERVER['REQUEST_METHOD'] == 'POST') {
        if ($_POST['selected_transport_offers'] && $_POST['package_id']) {
            $_SESSION['selected_transport_offers'] = array_map('intval', $_POST['selected_transport_offers']);
            $_SESSION['package_id'] = intval(removeslashes(esc_attr(trim($_POST['package_id']))));
            //$_SESSION['error_cancel_redirect_url'] = esc_url(add_query_arg(array('package-id' => $_POST['package_id']), get_permalink(get_page_by_path(__('select-transport-offers', 'gpdealdomain')))));
            wp_safe_redirect(esc_url(get_permalink(get_page_by_path(__('select-transport-offers', 'gpdealdomain') . '/' . __('review', 'gpdealdomain')))));
            exit;
        }
    } elseif (isset($_SERVER['REQUEST_METHOD']) && $_SERVER['REQUEST_METHOD'] == 'GET') {
        if (isset($_GET['package-id'])) {
            $package_id = intval(removeslashes(esc_attr(trim($_GET['package-id']))));
            $selected_transport_offers = get_post_meta($package_id, 'carrier-ID', true);
            $L = get_post_meta($package_id, 'length', true);
            $l = get_post_meta($package_id, 'width', true);
            $h = get_post_meta($package_id, 'height', true);
            $weight = get_post_meta($package_id, 'weight', true);
            $package_currency = get_post_meta($package_id, 'package-currency', true);
            get_header();
            include(locate_template('content-show-transport-offers-package-page.php'));
            get_footer();
        } elseif (isset($_GET['payment-completed']) && $_GET['payment-completed'] == "true" && isset($_SESSION['selected_transport_offers']) && isset($_SESSION['package_id'])) {
            $selected_transport_offers = $_SESSION['selected_transport_offers'];
            $package_id = $_SESSION['package_id'];
            $package = get_post($package_id);
            if ($selected_transport_offers && is_array($selected_transport_offers) && !empty($selected_transport_offers) && $package) {
                $old_transport_offers = get_post_meta($package_id, 'carrier-ID', true);
                if (is_array($old_transport_offers) && !empty($old_transport_offers)) {
                    foreach ($old_transport_offers as $old_transport_offer_id) {
                        //We have to update parmeter "packages-IDs of this old transport offer to remove this package
                        if (!in_array($old_transport_offer_id, $selected_transport_offers)) {
                            //Get a list of package of this old transport offer 
                            $package_ids = get_post_meta($old_transport_offer_id, 'packages-IDs', true);
                            //Test if it is an array 
                            if (is_array($package_ids) && !empty($package_ids)) {
                                //Remove this package from this list of package
                                $package_ids = array_diff(array_map('intval', $package_ids), array($package_id));
                                //And then update parameter "package-IDs" to set it to a new list of package IDs without this selected package
                                update_post_meta($old_transport_offer_id, 'packages-IDs', $package_ids);
                            }
                        }
                    }
                }
                //***************************Il Faut pensez à verifier si chaque élément selectionner existe toujour comme un post ********************* */
                foreach ($selected_transport_offers as $transport_offer_id) {
                    //Test if $tranport_offer is already saved in database
                    if (get_post($transport_offer_id) == null) {
                        //Remove this package from this list of package
                        $selected_transport_offers = array_diff(array_map('intval', $selected_transport_offers), array($transport_offer_id));
                    }
                }
                //************************************************************************************************************************************** */
                update_post_meta($package_id, 'carrier-ID', $selected_transport_offers);
                update_post_meta($package_id, 'package-status', 2);
                update_post_meta($package_id, 'package-insurance-completed', 2);
                foreach ($selected_transport_offers as $transport_offer_id) {
                    $package_ids = get_post_meta($transport_offer_id, 'packages-IDs', true);
                    if (is_array($package_ids) && !empty($package_ids)) {
                        if (!in_array($package_id, $package_ids) && get_post($package_id)) {
                            $package_ids = array_map('intval', $package_ids);
                            $package_ids[] = $package_id;
                            update_post_meta($transport_offer_id, 'packages-IDs', $package_ids);
                        }
                    } else {
                        update_post_meta($transport_offer_id, 'packages-IDs', array($package_id));
                    }
                    $packages_users_ids = get_post_meta($transport_offer_id, 'packages-users-IDs', true);
                    $package_post_author = get_post_field('post_author', $package_id);
                    if (is_array($packages_users_ids) && !empty($packages_users_ids)) {
                        if (!in_array($package_post_author, $packages_users_ids)) {
                            $packages_users_ids[] = $package_post_author;
                            update_post_meta($transport_offer_id, 'packages-users-IDs', $packages_users_ids);
                        }
                    } else {
                        update_post_meta($transport_offer_id, 'packages-users-IDs', array($package_post_author));
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
            unset($_SESSION['selected_transport_offers']);
            unset($_SESSION['package_id']);
            wp_safe_redirect(esc_url(add_query_arg(array('package-id' => $package_id), get_permalink())));
            exit;
        } else {
            wp_safe_redirect(get_permalink(get_page_by_path(__('my-account', 'gpdealdomain') . '/' . __('shipments', 'gpdealdomain'))));
            exit;
        }
    }
} else {
    $_SESSION['redirect_to'] = get_the_permalink();
    wp_safe_redirect(get_permalink(get_page_by_path(__('log-in', 'gpdealdomain'))));
    exit;
}