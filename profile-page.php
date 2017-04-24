<?php 

/*
  Template Name: Profile Page
 */

session_start();
if (is_user_logged_in()) {
    get_header();

    get_template_part('content-profile-page', get_post_format()); 

    get_footer();
}else{
    $_SESSION['redirect_to'] = get_the_permalink();
    wp_safe_redirect(get_permalink(get_page_by_path(__('connexion', 'gpdealdomain'))));
}