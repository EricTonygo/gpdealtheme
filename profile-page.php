<?php 

/*
  Template Name: Profile Page
 */

session_start();
expire_session();
if (is_user_logged_in()) {
    get_header();
    $registration_complete = get_user_meta(get_current_user_id(), "registration-completed", true);
    include(locate_template('content-profile-page.php')); 
    get_footer();
}else{
    $_SESSION['redirect_to'] = get_the_permalink();
    wp_safe_redirect(get_permalink(get_page_by_path(__('log-in', 'gpdealdomain'))));
    exit;
}