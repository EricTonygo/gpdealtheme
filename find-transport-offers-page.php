<?php

/*
  Template Name: Search Transport Offer Page
 */

    if (isset($_SERVER['REQUEST_METHOD']) && ($_SERVER['REQUEST_METHOD'] == 'POST' || $_SERVER['REQUEST_METHOD'] == 'GET')) {
        get_header();
        get_template_part('content-find-transport-offers-page', get_post_format());
        get_footer();
    }else{
        wp_safe_redirect(home_url('/'));
    }

