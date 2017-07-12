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
    }
    get_header();
    include(locate_template('content-find-unsatisfied-send-packages-page.php'));
    get_footer();
} else {
    wp_safe_redirect(home_url('/'));
    exit();
}

