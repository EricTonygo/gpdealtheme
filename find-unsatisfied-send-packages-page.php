<?php

/*
  Template Name: Search Unsatisfied Send Packages Page
 */
session_start();
expire_session();
if (isset($_SERVER['REQUEST_METHOD']) && ($_SERVER['REQUEST_METHOD'] == 'POST')) {
    $search_data = null;
    if (isset($_POST["submit_search_unsatisfied_packages"]) && removeslashes(esc_attr(trim($_POST["submit_search_unsatisfied_packages"] = "yes")))) {
        $package_type = array_map('intval', isset($_POST['package_type']) ? $_POST['package_type'] : array());
        $start_city = removeslashes(esc_attr(trim($_POST['start_city'])));
        $start_date = removeslashes(esc_attr(trim($_POST['start_date'])));
        $destination_city = removeslashes(esc_attr(trim($_POST['destination_city'])));
        $destination_date = removeslashes(esc_attr(trim($_POST['destination_date'])));
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

