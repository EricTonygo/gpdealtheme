<?php

/*
  Template Name: Search Unsatisfied Send Packages Page
 */

if (isset($_SERVER['REQUEST_METHOD']) && ($_SERVER['REQUEST_METHOD'] == 'POST')) {
    $search_data = null;
    if (isset($_POST["submit_search_unsatisfied_packages"]) && removeslashes(esc_attr(trim($_POST["submit_search_unsatisfied_packages"] = "yes")))) {
        $package_type = array_map('intval', isset($_POST['package_type']) ? $_POST['package_type'] : array());
        $start_city = removeslashes(esc_attr(trim($_POST['start_city'])));
        $start_date = removeslashes(esc_attr(trim($_POST['start_date'])));
        $destination_city = removeslashes(esc_attr(trim($_POST['destination_city'])));
        $destination_date = removeslashes(esc_attr(trim($_POST['destination_date'])));
        $search_data = array(
            'package_type' => $package_type,
            'start_city' => $start_city,
            'start_date' => $start_date,
            'destination_city' => $destination_city,
            'destination_date' => $destination_date
        );
    }
    get_header();
    include(locate_template('content-find-unsatisfied-send-packages-page.php'));
    get_footer();
} else {
    wp_safe_redirect(home_url('/'));
    exit();
}

