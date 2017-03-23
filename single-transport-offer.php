<?php
if (is_user_logged_in()) {
    if (isset($_SERVER['REQUEST_METHOD']) && $_SERVER['REQUEST_METHOD'] == 'POST') {
        try {
            updateTransportOffer(get_the_ID());
        } catch (Exception $ex) {
            
        }
        get_header();
        get_template_part('content-single-transport-offer-page', get_post_format());
        get_footer();
    } elseif(isset($_SERVER['REQUEST_METHOD']) && $_SERVER['REQUEST_METHOD'] == 'GET' && isset ($_GET['action'])) {
        get_header();
        get_template_part('content-single-transport-offer-page', get_post_format());
        get_footer();
    }else{
        get_header();
        get_template_part('content-single-transport-offer-page', get_post_format());
        get_footer();
    }
} else {
    wp_safe_redirect(esc_url(add_query_arg(array('redirect_to' => get_the_permalink()), get_permalink(get_page_by_path(__('connexion', 'gpdealdomain'))))));
}