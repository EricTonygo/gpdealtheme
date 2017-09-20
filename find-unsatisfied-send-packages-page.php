<?php

/*
  Template Name: Search Unsatisfied Send Packages Page
 */
session_start();
expire_session();
if (isset($_SERVER['REQUEST_METHOD']) && ($_SERVER['REQUEST_METHOD'] == 'GET')) {
    $search_data = null;
    if (isset($_GET['start-city']) && isset($_GET['start-date']) && isset($_GET['destination-city']) && isset($_GET['destination-date'])) {
        $package_type = array_map('intval', isset($_GET['package-type']) ? $_GET['package-type'] : array());
        $start_city = removeslashes(esc_attr(trim($_GET['start-city'])));
        $start_date = removeslashes(esc_attr(trim($_GET['start-date'])));
        $destination_city = removeslashes(esc_attr(trim($_GET['destination-city'])));
        $destination_date = removeslashes(esc_attr(trim($_GET['destination-date'])));
        $country_region_city_start = getCountryRegionCityInformations($start_city);
        $country_region_city_destination = getCountryRegionCityInformations($destination_city);
        $search_data = array(
            "package_type" => $package_type,
            "start_country" => $country_region_city_start['country'],
            "start_state" => $country_region_city_start['region'],
            "start_city" => $country_region_city_start['city'],
            'start_date' => $start_date,
            "destination_country" => $country_region_city_destination['country'],
            "destination_state" => $country_region_city_destination['region'],
            "destination_city" => $country_region_city_destination['city'],
            "destination_date" => $destination_date
        );
        $num_page_corresponding = 1;
        $num_page_can_interest = 1;
        $params_arg_corresponding = array();
        $params_arg_can_interest = array();
        $params_arg_corresponding["start-city"] = $start_city;
        $params_arg_can_interest["start-city"] = $start_city;
        $params_arg_corresponding["start-date"] = $start_date;
        $params_arg_can_interest["start-date"] = $start_date;
        $params_arg_corresponding["destination-city"] = $destination_city;
        $params_arg_can_interest["destination-city"] = $destination_city;
        $params_arg_corresponding["destination-date"] = $destination_date;
        $params_arg_can_interest["destination-date"] = $destination_date;
        if($package_type){
        $params_arg_corresponding["package-type"] = $package_type;
        $params_arg_can_interest["package-type"] = $package_type;
        }
        $params_arg_corresponding["result-type"] = "corresponding";
        $params_arg_can_interest["result-type"] = "can-interest";
        if (isset($_GET["result-type"]) && $_GET["result-type"] == "corresponding") {
            $result_type = removeslashes(esc_attr(trim($_GET["result-type"])));
            $params_arg_corresponding["result-type"] = $result_type;
            if (isset($_GET["num-page"])) {
                $num_page_corresponding = intval(removeslashes(esc_attr(trim($_GET["num-page"]))));
            }
        } elseif (isset($_GET["result-type"]) && $_GET["result-type"] == "can-interest") {
            $result_type = removeslashes(esc_attr(trim($_GET["result-type"])));
            $params_arg_can_interest["result-type"] = $result_type;
            if (isset($_GET["num-page"])) {
                $num_page_can_interest = intval(removeslashes(esc_attr(trim($_GET["num-page"]))));
            }
        }
        $search_data_corresponding = $search_data;
        $search_data_can_interest = $search_data;
        $search_data_corresponding["posts_per_page"] = 6;
        $search_data_corresponding["page"] = $num_page_corresponding;
        $search_data_can_interest["posts_per_page"] = 6;
        $search_data_can_interest["page"] = $num_page_can_interest;
        $page_link = get_permalink();
    }
    get_header();
    include(locate_template('content-find-unsatisfied-send-packages-page.php'));
    get_footer();
} else {
    wp_safe_redirect(home_url('/'));
    exit();
}

