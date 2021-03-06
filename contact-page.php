<?php

/*
  Template Name: Contact Page
 */
session_start();
expire_session();
if (!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
    if (isset($_SERVER['REQUEST_METHOD']) && $_SERVER['REQUEST_METHOD'] == 'POST'){
        try {
            contactus();
        } catch (Exception $ex) {
            $json = array("message" => __("Echec d'envoi du message", 'gpdealdomain'));
            return wp_send_json_error($json);
        }
    }else{
        wp_safe_redirect(get_the_permalink());
        exit;
    }
}
get_header();

get_template_part('content-contact-page');

get_footer();

