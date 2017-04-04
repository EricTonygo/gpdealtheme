<?php

/*
  Template Name: Reviews and Evaluations Page
 */
    if (isset($_SERVER['REQUEST_METHOD']) && $_SERVER['REQUEST_METHOD'] == 'GET' && isset($_GET['carrier_id'])) {
        $carrier_id = intval(removeslashes(esc_attr(trim($_GET['carrier_id']))));
        include(locate_template('content-show-reviews-evaluations-carrier-page.php'));
    }