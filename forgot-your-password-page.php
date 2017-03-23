<?php

/*
  Template Name: Forget Password Page
 */

if (!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
    get_password();
} elseif (isset($_SERVER['REQUEST_METHOD']) && $_SERVER['REQUEST_METHOD'] == 'POST') {
    get_password();
    get_header();
   get_template_part('content-forgot-your-password-response-page', get_post_format());
    get_footer();
}else {
     get_header();

    get_template_part('content-forgot-your-password-page', get_post_format());

    get_footer();
}


