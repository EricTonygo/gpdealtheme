<?php

/*
  Template Name: Login Page
 */
header("Cache-Control", "no-cache, no-store, must-revalidate");
if (isset($_SERVER['REQUEST_METHOD']) && $_SERVER['REQUEST_METHOD'] == 'POST') {
    signin();
} else{ 
    get_header();

    get_template_part('content-login-page', get_post_format());

    get_footer();
}
