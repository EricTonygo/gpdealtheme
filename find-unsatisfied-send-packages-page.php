<?php

/*
  Template Name: Search Unsatisfied Send Packages Page
 */

    if (isset($_SERVER['REQUEST_METHOD']) && ($_SERVER['REQUEST_METHOD'] == 'POST')) {
        get_header();
        get_template_part('content-find-unsatisfied-send-packages-page', get_post_format());
        get_footer();
    }else{
        wp_safe_redirect(home_url('/'));
        exit();
    }

