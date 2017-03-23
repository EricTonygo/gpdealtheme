<?php

/*
  Template Name: Transport Offer Page
 */

if (is_user_logged_in()) {
    if (isset($_SERVER['REQUEST_METHOD']) && $_SERVER['REQUEST_METHOD'] == 'POST') {
        saveTransportOffer();
        get_header();
        get_template_part('content-write-transport-offer-page', get_post_format());
        get_footer();
    } else {
        get_header();
        if (is_page(__('mon-compte', 'gpdealdomain').'/'.__('offres-de-transport', 'gpdealdomain'))) {
            get_template_part('content-transport-offers-page', get_post_format());
        } elseif (is_page( __('mon-compte', 'gpdealdomain').'/'.__('offres-de-transport', 'gpdealdomain').'/'.__('saisir', 'gpdealdomain'))) {
            get_template_part('content-write-transport-offer-page', get_post_format());
        }
        get_footer();
    }
} else {
    wp_safe_redirect(esc_url(add_query_arg(array('redirect_to' => get_the_permalink()), get_permalink(get_page_by_path(__('connexion', 'gpdealdomain'))))));
}
