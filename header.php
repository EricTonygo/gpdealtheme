<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/html" lang="<?php echo pll_current_language('slug'); ?>">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">
        <?php if (is_page(__("my-account", "gpdealdomain"))): ?>
            <META HTTP-EQUIV="CACHE-CONTROL" CONTENT="NO-CACHE">
        <?php endif ?>
        <title><?php if (is_search()) echo __("Recherche des transporteurs", "gpdealdomain");
        else the_title(); ?> - Global Parcel Deal</title>
        <link rel="shortcut icon" href="<?php echo auto_version("/favicon.ico") ?>">
        <!--<link href="https://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet">-->

        <?php
        if (is_page(__("my-account", "gpdealdomain"))) {
            header('Cache-Control: no-cache, must-revalidate');
            header('Expires: Sat, 26 Jul 1997 05:00:00 GMT');
        }
        ?>
<?php wp_head(); ?>
<?php if (!is_user_logged_in() && (is_page(__('registration', 'gpdealdomain')) || is_page(__('registration', 'gpdealdomain') . '/' . __('account-summary', 'gpdealdomain')))): ?>
            <script type="text/javascript">
                var widgetId_particular;
                var widgetId_pro;
                var verifyCallback_pro = function (response) {
                    //alert(grecaptcha.getResponse(widgetId_pro));
                    $('#register_form_enterprise.ui.form input[name="g-recaptcha-response-register"]').val(grecaptcha.getResponse(widgetId_pro));
                    $('#submit_create_account_enterprise').removeClass('disabled');
                };
                var expCallback_pro = function (response) {
                    grecaptcha.reset(widgetId_pro);
                    $('#register_form_enterprise.ui.form input[name="g-recaptcha-response-register"]').val("");
                    $('#submit_create_account_enterprise').addClass('disabled');
                };

                var verifyCallback_particular = function (response) {
                    //alert(grecaptcha.getResponse(widgetId_particular));
                    $('#register_form_particular.ui.form input[name="g-recaptcha-response-register"]').val(grecaptcha.getResponse(widgetId_particular));
                    $('#confirm_save_account_particular').removeClass('disabled');
                };

                var expCallback_particular = function (response) {
                    grecaptcha.reset(widgetId_particular);
                    $('#register_form_particular.ui.form input[name="g-recaptcha-response-register"]').val("");
                    $('#confirm_save_account_particular').addClass('disabled');
                };
                var onloadCallback = function () {
                    widgetId_particular = grecaptcha.render('recaptcha_register_particular', {
                        'sitekey': '6LfoxhcUAAAAAL3L_vo5dnG1csXgdaYYf5APUTqn',
                        'callback': verifyCallback_particular,
                        'theme': 'light',
                        'expired-callback': expCallback_particular
                    });
                    widgetId_pro = grecaptcha.render('recaptcha_register_pro', {
                        'sitekey': '6LfoxhcUAAAAAL3L_vo5dnG1csXgdaYYf5APUTqn',
                        'callback': verifyCallback_pro,
                        'theme': 'light',
                        'expired-callback': expCallback_pro
                    });
                };
            </script>
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
