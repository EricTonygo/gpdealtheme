<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/html" lang="<?php echo pll_current_language('slug'); ?>">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">
        <?php
        header('Cache-Control: no-store, private, no-cache, must-revalidate');     // HTTP/1.1
        header('Cache-Control: pre-check=0, post-check=0, max-age=0, max-stale = 0', false);  // HTTP/1.1
        header('Pragma: public');
        header('Expires: Sat, 26 Jul 1997 05:00:00 GMT');                  // Date in the past  
        header('Expires: 0', false);
        header('Last-Modified: ' . gmdate('D, d M Y H:i:s') . ' GMT');
        header('Pragma: no-cache');
        ?>
        <meta content="website" property="og:type">
        <meta content="summary" name="twitter:card">
        <meta content="GPDeal" name="author">
        <meta name="company" itemprop="name" content="GPDeal">
        <meta name="keywords" content="<?php _e("transport, colis, courriers", "booksharedomain"); ?>, <?php _e("Transport de colis entre particuliers", "booksharedomain"); ?>, <?php _e("Envoyer vos courriers et colis dans les delais", "booksharedomain"); ?>, <?php _e("rentabilise tes voyages", "booksharedomain"); ?>, <?php _e("Reduits tes coûts d'expédition", "booksharedomain"); ?>"/>
        <!--<meta name="description" content="<?php _e("Courriers, Colis, Transports, Expéditions, Particuliers, Dealer, Global parcel deal… Trouvez des personnes près de vous qui voyage pour une destination que vous souhaitez et confiez leur vos expéditions", "booksharedomain"); ?> "/>-->

        <meta name="robots" content="index, follow" >
        <meta property="robots" content="index, follow" >
        <meta property="og:site_name" content="GPDeal" >  

        <meta content="<?php the_permalink(); ?>" property="og:url">
        <meta content="<?php home_url(); ?>" name="identifier-url">
        <meta content="GPDeal" name="copyright">
        <meta content="<?php the_permalink(); ?>" name="twitter:url">
        <meta content="GPDeal" property="og:site_name">

        <meta content="GPDeal c'est rapide, fiable et economique." name="description">
        <meta content="GPDeal c'est rapide, fiable et economique." property="og:description">
        <meta content="GPDeal c'est rapide, fiable et economique." name="twitter:description">

        <!--<meta property="og:url" content="<?php the_permalink(); ?>" >-->
        <meta content="GPDeal | Transport de colis entre particuliers." property="og:title">
        <meta content="GPDeal | Transport de colis entre particuliers." name="twitter:title">
        <?php if (is_singular('package') || is_singular('transport-offer')): ?>
    <!--        <meta property="og:title" content="<?php echo $page_title; ?> sur Global Parcel Deal">
            <meta property="twitter:title" content="<?php echo $page_title; ?> sur Global Parcel Deal">-->
        <?php endif ?>
        <?php if (is_single() && has_post_thumbnail()): ?>
            <meta property="og:image" content="<?php the_post_thumbnail_url('full'); ?>">
            <meta property="twitter:image" content="<?php the_post_thumbnail_url('full'); ?>">
        <?php else: ?>
            <meta property="og:image" content="<?php echo get_template_directory_uri(); ?>/assets/images/gpdeal_preview.png">
            <meta property="twitter:image" content="<?php echo get_template_directory_uri(); ?>/assets/images/gpdeal_preview.png">
        <?php endif ?>

        <meta content="<?php echo pll_current_language('slug'); ?>" property="og:locale">
        <!--        <meta content="@GPDeal" name="twitter:site">
                <meta content="152255798321476" property="fb:app_id">-->
        <?php
        if (is_singular('package')) {
            $page_title = __("Shipment", "gpdealdomain");
            //$page_title = __("Shipment", "gpdealdomain") . " " . __("from", "gpdealdomain") . " " . get_post_meta(get_the_ID(), 'departure-city-package', true) . "(" . date('d-m-Y', strtotime(get_post_meta(get_the_ID(), 'date-of-departure-package', true))) . ") " . __("to", "gpdealdomain") . " " . get_post_meta(get_the_ID(), 'destination-city-package', true) . "(" . date('d-m-Y', strtotime(get_post_meta(get_the_ID(), 'arrival-date-package', true))) . ")";
        } elseif (is_singular('transport-offer')) {
            $page_title = __("Transport offer", "gpdealdomain");
            //$page_title = __("Transport offer", "gpdealdomain") . " " . __("from", "gpdealdomain") . " " . get_post_meta(get_the_ID(), 'departure-city-transport-offer', true) . "(" . date('d-m-Y', strtotime(get_post_meta(get_the_ID(), 'date-of-departure-transport-offer', true))) . ") " . __("to", "gpdealdomain") . " " . get_post_meta(get_the_ID(), 'destination-city-transport-offer', true) . "(" . date('d-m-Y', strtotime(get_post_meta(get_the_ID(), 'arrival-date-transport-offer', true))) . ")";
        }
        ?>
        <title><?php
            if (is_search()) {
                echo __("Search information results", "gpdealdomain");
            } elseif (is_category()) {
                echo get_category(get_query_var('cat'))->name;
            } elseif (is_singular('package')) {
                echo $page_title;
            } elseif (is_singular('transport-offer')) {
                echo $page_title;
            } elseif (is_home()) {
                echo __("Blog", "gpdealdomain");
            } elseif (is_front_page() && isset($_GET['q'])) {
                echo __("Search results for transport offers", "gpdealdomain");
            } else {
                the_title();
            }
            ?> - Global Parcel Deal</title>
        <link rel="shortcut icon" href="<?php echo auto_version("/favicon.ico") ?>" type="image/x-icon">

        <?php wp_head(); ?>
        <?php if (!is_user_logged_in() && is_page(__('registration', 'gpdealdomain'))): ?>
            <script type="text/javascript">
                var widgetId_register;

                var verifyCallback_register = function (response) {
                    $('#register_form.ui.form input[name="g-recaptcha-response-register"]').val(grecaptcha.getResponse(widgetId_register));
                    $('#confirm_save_account').removeClass('disabled');
                };
                var expCallback_register = function (response) {
                    grecaptcha.reset(widgetId_register);
                    $('#register_form.ui.form input[name="g-recaptcha-response-register"]').val("");
                    $('#confirm_save_account').addClass('disabled');
                };
                var onloadCallback = function () {
                    widgetId_register = grecaptcha.render('recaptcha_register', {
                        'sitekey': '6LfoxhcUAAAAAL3L_vo5dnG1csXgdaYYf5APUTqn',
                        'callback': verifyCallback_register,
                        'theme': 'light',
                        'expired-callback': expCallback_register,
                        'hl': document.getElementsByTagName('html')[0].getAttribute('lang')
                    });
                };
            </script>
        <?php endif ?>
        <?php if (!is_user_logged_in() && is_page(__('registration', 'gpdealdomain') . '/' . __('account-summary', 'gpdealdomain'))): ?>
            <?php if (isset($_POST['role']) && $_POST['role'] == 'particular'): ?>
                <script type="text/javascript">
                    var widgetId_particular;
                    var verifyCallback_pro = function (response) {
                        $('#register_form_enterprise.ui.form input[name="g-recaptcha-response-register"]').val(grecaptcha.getResponse(widgetId_pro));
                        $('#submit_create_account_enterprise').removeClass('disabled');
                    };
                    var expCallback_pro = function (response) {
                        grecaptcha.reset(widgetId_pro);
                        $('#register_form_enterprise.ui.form input[name="g-recaptcha-response-register"]').val("");
                        $('#submit_create_account_enterprise').addClass('disabled');
                    };
                    var onloadCallback = function () {
                        widgetId_pro = grecaptcha.render('recaptcha_register_pro', {
                            'sitekey': '6LfoxhcUAAAAAL3L_vo5dnG1csXgdaYYf5APUTqn',
                            'callback': verifyCallback_pro,
                            'theme': 'light',
                            'expired-callback': expCallback_pro
                        });
                    };
                </script>
            <?php elseif (isset($_POST['role']) && $_POST['role'] == 'professional'): ?>
                <script type="text/javascript">
                    var widgetId_pro;
                    var verifyCallback_pro = function (response) {
                        $('#register_form_enterprise.ui.form input[name="g-recaptcha-response-register"]').val(grecaptcha.getResponse(widgetId_pro));
                        $('#submit_create_account_enterprise').removeClass('disabled');
                    };
                    var expCallback_pro = function (response) {
                        grecaptcha.reset(widgetId_pro);
                        $('#register_form_enterprise.ui.form input[name="g-recaptcha-response-register"]').val("");
                        $('#submit_create_account_enterprise').addClass('disabled');
                    };

                    var onloadCallback = function () {
                        widgetId_pro = grecaptcha.render('recaptcha_register_pro', {
                            'sitekey': '6LfoxhcUAAAAAL3L_vo5dnG1csXgdaYYf5APUTqn',
                            'callback': verifyCallback_pro,
                            'theme': 'light',
                            'expired-callback': expCallback_pro
                        });
                    };
                </script>
            <?php endif ?>

        <?php endif ?>

    </head>
    <body>

        <!-- Sidebar Menu -->
        <div class="ui vertical accordion following inverted sidebar menu">
            <div class="sidebar_title item" style="background-color: white;">
                <img class="ui tiny image logo" src="<?php echo wp_make_link_relative(get_template_directory_uri()) ?>/assets/images/gpdeal_logo_mobile.png">
            </div>
            <div class="<?php if (is_page(__('home', 'gpdealdomain'))): ?>active<?php endif ?> item">
                <div class="title"><a href="<?php echo wp_make_link_relative(home_url('/')) ?>" ><i class="home icon"></i><?php echo get_page_by_path(__('home', 'gpdealdomain'))->post_title ?></a></div>
            </div>
            <div class="<?php if (is_page(__('my-account', 'gpdealdomain') . '/' . __('transport-offers', 'gpdealdomain') . '/' . __('write', 'gpdealdomain'))): ?>active<?php endif ?> item">
                <div class="title"><a href="<?php echo wp_make_link_relative(get_permalink(get_page_by_path(__('my-account', 'gpdealdomain') . '/' . __('transport-offers', 'gpdealdomain') . '/' . __('write', 'gpdealdomain')))); ?>" ><i class="shipping icon"></i><?php echo __("I carry", "gpdealdomain"); ?></a></div>
            </div>
            <div class="<?php if (is_page(__('my-account', 'gpdealdomain') . '/' . __('shipments', 'gpdealdomain') . '/' . __('write', 'gpdealdomain'))): ?>active<?php endif ?> item">
                <div class="title"><a href="<?php echo wp_make_link_relative(get_permalink(get_page_by_path(__('my-account', 'gpdealdomain') . '/' . __('shipments', 'gpdealdomain') . '/' . __('write', 'gpdealdomain')))); ?>" ><i class="travel icon"></i><?php echo __("I ship", "gpdealdomain"); ?></a></div>
            </div>
            <div class="<?php if (is_page(__('legal-notices', 'gpdealdomain'))): ?>active<?php endif ?> item">
                <div class="title"><a href="<?php echo wp_make_link_relative(get_permalink(get_page_by_path(__('legal-notices', 'gpdealdomain')))) ?>"><i class="info icon"></i><?php echo get_page_by_path(__('legal-notices', 'gpdealdomain'))->post_title ?></a></div>
            </div>
            <div class="<?php if (is_page(__('terms-of-use', 'gpdealdomain'))): ?>active<?php endif ?> item">
                <div class="title"><a href="<?php echo wp_make_link_relative(get_permalink(get_page_by_path(__('terms-of-use', 'gpdealdomain')))) ?>"><i class="universal access icon"></i><?php echo get_page_by_path(__('terms-of-use', 'gpdealdomain'))->post_title ?></a></div>
            </div>
            <div class="<?php if (is_page(__('contact-us', 'gpdealdomain'))): ?>active<?php endif ?> item">
                <div class="title"><a href="<?php echo wp_make_link_relative(get_permalink(get_page_by_path(__('contact-us', 'gpdealdomain')))) ?>"><i class="mail icon"></i><?php echo get_page_by_path(__('contact-us', 'gpdealdomain'))->post_title ?></a></div>
            </div>
        </div>


        <!-- Page Contents -->
        <div class="pusher">
            <div id="message_success" class="ui success message" style="position: fixed; top: 9em; right: 40em; left: auto; z-index: 5; min-width: 25em; display: none">
                <i class="close icon"></i>
                <div class="header"></div>
            </div>

            <div id="message_error" class="ui error message" style="position: fixed; top: 9em; right: 40em; left: auto; z-index: 5; min-width: 25em; display: none">
                <i class="close icon"></i>
                <div class="header"> </div>
            </div>

            <div id="message_loading" class="ui icon message" style="position: fixed; top: 9em; right: 40em; left: auto; z-index: 5; min-width: 20em; display: none;">
                <i class="notched circle loading icon"></i>
                <div class="content">
                    <div class="header">Traitement encours... </div>
                </div>
            </div>
