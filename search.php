<?php

session_start();
expire_session();
get_header();
$search_query = null;
$country_region_city = array();
$locality_name = "";
$search_query_data_start = array();
$search_query_data_destination = array();
$num_page_start = 1;
$num_page_destination = 1;
$params_arg_start = array();
$params_arg_destination = array();
if (isset($_SERVER['REQUEST_METHOD']) && $_SERVER['REQUEST_METHOD'] == 'GET') {
    if (isset($_GET['s'])) {
        $search_query = removeslashes(esc_attr(trim($_GET['s'])));
        $params_arg_start["s"] = $search_query;
        $params_arg_destination["s"] = $search_query;
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
}

get_footer();
