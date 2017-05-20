<?php
session_start();
expire_session();
get_header();
$search_query = null;
$country_region_city = array();
$locality_name = "";
if (isset($_SERVER['REQUEST_METHOD']) && $_SERVER['REQUEST_METHOD'] == 'GET' && isset($_GET['s'])) {
    $search_query = removeslashes(esc_attr(trim($_GET['s'])));
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
include(locate_template('content-search-transport-offers-page.php'));
get_footer();
