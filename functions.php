<?php

//add_action( 'after_setup_theme', 'woocommerce_support' );
//function woocommerce_support() {
//    add_theme_support( 'woocommerce' );
//}
if (get_magic_quotes_gpc()) {
    $_GET = stripslashes_deep($_GET);
    $_POST = stripslashes_deep($_POST);
    $_COOKIE = stripslashes_deep($_COOKIE);
}

//define('WOOCOMMERCE_USE_CSS', false);
define( 'WP_CONTENT_URL', '/');

add_action('wp_print_scripts', 'theme_slug_dequeue_footer_jquery');

function theme_slug_dequeue_footer_jquery() {
    if (!is_admin()) {
        wp_dequeue_script('jquery');
        wp_deregister_script('jquery');
    }
}

function wpdocs_dequeue_dashicon() {
    if (current_user_can('update_core')) {
        return;
    }
    if (!is_admin()) {
        wp_deregister_style('dashicons');
        wp_deregister_style('admin-bar');
    }
}

add_action('wp_enqueue_scripts', 'wpdocs_dequeue_dashicon');

function hide_admin_bar_from_front_end() {
    if (is_blog_admin()) {
        return true;
    }
    return false;
}

add_filter('show_admin_bar', 'hide_admin_bar_from_front_end');

function gpdeal_scripts() {
    wp_register_style('semantic_ui_css', 'https://cdn.jsdelivr.net/semantic-ui/2.2.10/semantic.min.css', array(), '2.2.10');
    //wp_register_style( 'semantic_ui_css', 'https://cdn.rawgit.com/mdehoog/Semantic-UI/6e6d051d47b598ebab05857545f242caf2b4b48c/dist/semantic.min.css');
    wp_enqueue_style('semantic_ui_css');
    wp_register_style('font-awesone', '//netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.min.css');
    wp_enqueue_style('font-awesone');
    wp_enqueue_style('reset', get_template_directory_uri() . '/assets/css/reset.css');
    wp_enqueue_style('owl.carousel.css', get_template_directory_uri() . '/assets/css/owl.carousel.css');
    wp_register_style('datetimepicker_css', get_template_directory_uri() . '/assets/css/jquery.datetimepicker.min.css');
//    wp_enqueue_script('jquery-3.1.1.min', 'https://code.jquery.com/jquery-3.1.1.min.js', array(), false, true);
    wp_enqueue_script('jquery.cookie.min', 'https://cdnjs.cloudflare.com/ajax/libs/jquery-cookie/1.4.1/jquery.cookie.min.js', array(), false, true);
    wp_enqueue_script('jquery.min', get_template_directory_uri() . '/assets/js/jquery.min.js', array(), false);
    wp_enqueue_script('vue_js', 'https://unpkg.com/vue', array(), false);
    wp_register_script('semantic_ui_js', 'https://cdn.jsdelivr.net/semantic-ui/2.2.10/semantic.min.js', array(), '2.2.10', true);
//    wp_register_script('semantic_ui_js', 'https://cdn.jsdelivr.net/semantic-ui/2.2.6/semantic.min.js', array(), '2.2.6', true);
    //wp_register_script( 'google_map_places_js', 'https://maps.googleapis.com/maps/api/js?key=AIzaSyCsKRohVxC2BavLF5MeV93AKVDkkJaE0mU&libraries=places', array(), false, true );
    //wp_register_script( 'semantic_ui_js', 'https://cdn.rawgit.com/mdehoog/Semantic-UI/6e6d051d47b598ebab05857545f242caf2b4b48c/dist/semantic.min.js', array(), false, true);
    wp_enqueue_script('semantic_ui_js');
    //wp_enqueue_script('google_map_places_js');
    wp_enqueue_script('owl.carousel.js', get_template_directory_uri() . '/assets/js/owl.carousel.js', array(), false, true);
    wp_register_script('hideShowPassword_js', get_template_directory_uri() . '/assets/js/hideShowPassword.min.js', array(), false, true);
    wp_enqueue_script('main', get_template_directory_uri() . '/assets/js/main.js', array(), false, true);
    wp_enqueue_script('translations_js', get_template_directory_uri() . '/assets/js/translations.js', array(), false, true);
    wp_register_script('register_js', get_template_directory_uri() . '/assets/js/register.js', array(), false, true);
    wp_register_script('contact_js', get_template_directory_uri() . '/assets/js/contact.js', array(), false, true);
    wp_register_script('package_js', get_template_directory_uri() . '/assets/js/package.js', array(), false, true);
    wp_register_script('transport_offer_js', get_template_directory_uri() . '/assets/js/transport_offer.js', array(), false, true);
    wp_register_script('select_transport_offers_js', get_template_directory_uri() . '/assets/js/select_transport_offers.js', array(), false, true);
    wp_register_script('home_js', get_template_directory_uri() . '/assets/js/home.js', array(), false, true);
    wp_register_script('datetimepicker_js', get_template_directory_uri() . '/assets/js/jquery.datetimepicker.full.min.js', array(), false, true);
    wp_register_script('background_cycle_js', get_template_directory_uri() . '/assets/js/background.cycle.js', array(), false, true);
    wp_enqueue_script('datetimepicker_js');
    wp_enqueue_script('hideShowPassword_js');
    wp_enqueue_style('datetimepicker_css');
    if (is_page(__('registration', 'gpdealdomain')) || is_page(__('registration', 'gpdealdomain') . '/' . __('account-summary', 'gpdealdomain')) || is_page(__('my-account', 'gpdealdomain') . '/' .__('profile', 'gpdealdomain')) || is_page(__('forgot-your-password', 'gpdealdomain'))|| is_page(__('change-the-password', 'gpdealdomain')))
    {
        wp_enqueue_script('register_js');
        //wp_enqueue_script('recaptcha_api');
    }

    if (is_page(__('my-account', 'gpdealdomain')) || is_page(__('my-account', 'gpdealdomain') . '/' . __('shipments', 'gpdealdomain') . '/' . __('write', 'gpdealdomain')) || is_page(__('my-account', 'gpdealdomain') . '/' . __('shipments', 'gpdealdomain')) || is_singular('package')) {
        wp_enqueue_script('package_js');
    }

    if (is_page(__('my-account', 'gpdealdomain') . '/' . __('transport-offers', 'gpdealdomain') . '/' . __('write', 'gpdealdomain')) || is_singular('transport-offer')) {
        wp_enqueue_script('transport_offer_js');
    }

    if (is_page(__('contact-us', 'gpdealdomain'))) {
        wp_enqueue_script('contact_js');
    }
    
    //if (is_page(__('select-transport-offers', 'gpdealdomain'))) {
        wp_enqueue_script('select_transport_offers_js');
    //}
    if (is_home() || is_front_page()) {
        wp_enqueue_script('home_js');
        wp_enqueue_script('background_cycle_js');
    }
}

add_action('wp_enqueue_scripts', 'gpdeal_scripts');

