<?php

/*
  Template Name: Home Page
 */
//header("Cache-Control", "no-cache, no-store, must-revalidate");
if(is_user_logged_in() && isset($_GET['logout']) && esc_attr($_GET['logout'])=='true'){
    wp_logout();
    wp_safe_redirect(home_url('/'));
}

get_header(); 

get_template_part('content-index', get_post_format()); 

get_footer(); 
