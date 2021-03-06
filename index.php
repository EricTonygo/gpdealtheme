<?php

/*
  Template Name: Home Page
 */
session_start();
//header("Cache-Control", "no-cache, no-store, must-revalidate");
if (is_user_logged_in() && isset($_SERVER['REQUEST_METHOD']) && $_SERVER['REQUEST_METHOD'] == 'GET' && isset($_GET['logout']) && esc_attr($_GET['logout']) == 'true') {
    wp_logout();
    //$json = array("message" => "disconnected successfully.");
    //return wp_send_json_success($json);
    //Delete all selected transport offers store in session after logout
    if (isset($_SESSION['selected_transport_offers'])) {
        unset($_SESSION['selected_transport_offers']);
    }
    //Delete id of package store in session after logout
    if (isset($_SESSION['package_id'])) {
        unset($_SESSION['package_id']);
    }
    //Delete redirect link after login in website
    if(isset($_SESSION['redirect_to'])){
        unset($_SESSION['redirect_to']);
    }
    //Delete last time activity of the current connexion
    if(isset($_SESSION['LAST_ACTIVITY'])){
        unset($_SESSION['LAST_ACTIVITY']);
    }
    
    //Delete a parameter remember_me  of the current connexion
    if(isset($_SESSION['REMEMBER_ME'])){
        unset($_SESSION['REMEMBER_ME']);
    }
    wp_safe_redirect(home_url('/'));
    exit;
}

if (isset($_SERVER['REQUEST_METHOD']) && $_SERVER['REQUEST_METHOD'] == 'GET' && isset($_GET['lang'])) {
    wp_safe_redirect(home_url('/'));
    exit;
}

if (isset($_SERVER['REQUEST_METHOD']) && $_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['action']) && esc_attr($_POST['action']) == 'update-status-expired-offers') {
    $result = updateStatusAllExpiredOffers();
    return wp_send_json_success(array('result' => $result));
}

if (isset($_SERVER['REQUEST_METHOD']) && $_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['action']) && esc_attr($_POST['action']) == 'update-status-ended-offers') {
    $result = updateStatusAllEndedOffers();
    return wp_send_json_success(array('result' => $result));
}
expire_session();
get_header();

if (isset($_SERVER['REQUEST_METHOD']) && $_SERVER['REQUEST_METHOD'] == 'GET' && isset($_GET['q'])) {
    $locality_name = "";
    $num_page_start = 1;
    $num_page_destination = 1;
    $params_arg_start = array();
    $params_arg_destination = array();
        $search_query = removeslashes(esc_attr(trim($_GET['q'])));
        $params_arg_start['q'] = $search_query;
        $params_arg_destination['q'] = $search_query;
        $country_region_city = getCountryRegionCityInformations($search_query);
        $search_query_data_start = array(
            "start_country" => $country_region_city['country'],
            "start_state" => $country_region_city['region'],
            "start_city" => $country_region_city['city']
        );
        $search_query_data_destination = array(
            "destination_country" => $country_region_city['country'],
            "destination_state" => $country_region_city['region'],
            "destination_city" => $country_region_city['city']
        );
        if ($country_region_city['country'] != "" && $country_region_city['region'] != "" && $country_region_city['city'] != "") {
            $locality_name = $country_region_city['city'] . " (" . $country_region_city['region'] . ", " . $country_region_city['country'] . ")";
        } elseif ($country_region_city['country'] != "" && $country_region_city['region'] == "" && $country_region_city['city'] != "") {
            $locality_name = $country_region_city['city'] . " (" . $country_region_city['country'] . ")";
        } elseif ($country_region_city['country'] == "" && $country_region_city['region'] == "" && $country_region_city['city'] != "") {
            $locality_name = $country_region_city['city'];
        }
    $params_arg_start["position"] = "form";
    $params_arg_destination["position"] = "to";
    if (isset($_GET["position"]) && $_GET["position"] == "form") {
        $position = removeslashes(esc_attr(trim($_GET["position"])));
        $params_arg_start["position"] = $position;
        if (isset($_GET["num-page"])) {
            $num_page_start = intval(removeslashes(esc_attr(trim($_GET["num-page"]))));
        }
    } elseif (isset($_GET["position"]) && $_GET["position"] == "to") {
        $position = removeslashes(esc_attr(trim($_GET["position"])));
        $params_arg_destination["position"] = $position;
        if (isset($_GET["num-page"])) {
            $num_page_destination = intval(removeslashes(esc_attr(trim($_GET["num-page"]))));
        }
    }
    $search_query_data_start["posts_per_page"] = 6;
    $search_query_data_destination["posts_per_page"] = 6;
    $search_query_data_start["page"] = $num_page_start;
    $search_query_data_destination["page"] = $num_page_destination;


    $transport_offers_start = new WP_Query(getWPQueryArgsForMainCarrierSearchWithStartParameters($search_query_data_start));
    $transport_offers_destination = new WP_Query(getWPQueryArgsForMainCarrierSearchWithDestinationParameters($search_query_data_destination));


    $total_start_post_pages = $transport_offers_start->max_num_pages;
    $total_destination_post_pages = $transport_offers_destination->max_num_pages;
    $page_link = get_permalink();
    include(locate_template('content-search-transport-offers-page.php'));
}else{
    get_template_part('content-index', get_post_format());
}


get_footer();
