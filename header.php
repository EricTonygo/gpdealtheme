<!DOCTYPE html>
<html lang="fr" xmlns="http://www.w3.org/1999/html">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">
        <?php if(is_page(__("mon-compte", "gpdealdomain"))): ?>
            <META HTTP-EQUIV="CACHE-CONTROL" CONTENT="NO-CACHE">
        <?php endif ?>
        <title><?php if(is_search()) echo __("Recherche des transporteurs", "gpdealdomain"); else the_title() ?> - Global Parcel Deal</title>
        <link rel="shortcut icon" href="<?php echo get_template_directory_uri() ?>/assets/images/favicon.ico">
        <?php if(is_page(__("mon-compte", "gpdealdomain"))){ 
            header('Cache-Control: no-cache, must-revalidate');
            header('Expires: Sat, 26 Jul 1997 05:00:00 GMT');
        }?>
        <?php wp_head(); ?>
        <?php if (is_page(__('inscription', 'gpdealdomain')) || is_page(__('inscription', 'gpdealdomain') . '/' . __('recapitulatif-du-compte', 'gpdealdomain'))): ?>
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
                    $('#submit_create_account_particular').removeClass('disabled');
                };

                var expCallback_particular = function (response) {
                    grecaptcha.reset(widgetId_particular);
                    $('#register_form_particular.ui.form input[name="g-recaptcha-response-register"]').val("");
                    $('#submit_create_account_particular').addClass('disabled');
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
        
        <!-- Following Menu -->
<!--        <div class="ui large borderless top fixed hidden menu" style="height: 4em;">
            <div class="ui container">
                <div  class="left menu">
                    <div class="ui dropdown top left pointing item">
                        <i class="sidebar icon"></i>
                        <div class="menu">
                            <a href="<?php echo home_url('/') ?>" class="ui item"><i class="home icon"></i><?php echo get_page_by_path(__('accueil', 'gpdealdomain'))->post_title ?></a>
                            <a href="<?php echo get_permalink(get_page_by_path(__('mentions-legales', 'gpdealdomain'))) ?>" class="ui <?php if (is_page(__('mentions-legales', 'gpdealdomain'))): ?> active_menu <?php endif ?> item"><i class="info icon"></i><?php echo get_page_by_path(__('mentions-legales', 'gpdealdomain'))->post_title ?></a>
                            <a href="<?php echo get_permalink(get_page_by_path(__('conditions-dutilisation', 'gpdealdomain'))) ?>" class="ui <?php if (is_page(__('conditions-dutilisation', 'gpdealdomain'))): ?> active_menu <?php endif ?> item"><i class="universal access icon"></i><?php echo get_page_by_path(__('conditions-dutilisation', 'gpdealdomain'))->post_title ?></a>
                            <a href="<?php echo get_permalink(get_page_by_path(__('nous-contacter', 'gpdealdomain'))) ?>" class="ui <?php if (is_page(__('nous-contacter', 'gpdealdomain'))): ?> active_menu <?php endif ?> item"><i class="mail icon"></i><?php echo get_page_by_path(__('nous-contacter', 'gpdealdomain'))->post_title ?></a>
                        </div>
                    </div>
                    <div class="toc item" style="display:none;">
                        <i class="sidebar icon"></i>
                    </div>
                    <a href="<?php echo home_url('/') ?>" class="header item">
                        <img id='fixed_menu_logo' class="logo" src="<?php echo get_template_directory_uri() ?>/assets/images/logo_gpdeal.png">
                    </a>
                </div>

                <div class="center menu">
                                        <div class="title_gpdeal item">
                                            GLOBAL DEAL PARCEL
                                        </div>
                </div>
                <div class="right menu">
                    <div class="ui dropdown top right pointing item">
                        <i class="search icon"></i>
                        <span class="wording_header"><?php echo __('Rechercher', 'gpdealdomain') ?></span>
                        <div class="menu">
                            <form action="<?php echo home_url('/') ?>" method="GET">
                            <div class="ui icon input">
                                <i class="search link icon"></i>
                                <input type="text" placeholder="Rechercher..." name="s" value="<?php
                            if (isset($_GET['s'])) {
                                echo $_GET['s'];
                            }
                            ?>">
                            </div>
                            </form>
                            <div class="ui icon input">
                                <i class="search link icon"></i>
                                <input type="text" name="search" placeholder="Recherche...">
                            </div>
                            <div class="item" style="display: none"></div>
                        </div>
                    </div>
                    <div class="ui top right pointing dropdown lang_select item">
                        <i class="world icon"></i>
                        <span class="wording_header"><?php echo __('Français', 'gpdealdomain') ?></span>
                        <div class="menu">
                            <a href="<?php echo esc_url(add_query_arg(array('lang' => 'en'), the_permalink())) ?>" class="item" data-value="gb">
                                <i class="gb flag"></i> <?php echo __('Anglais', 'gpdealdomain') ?>
                            </a>
                            <a href="<?php echo esc_url(add_query_arg(array('lang' => 'fr'), the_permalink())) ?>" class="item" data-value="fr">
                                <i class="fr flag"></i><?php echo __('Français', 'gpdealdomain') ?>
                            </a>
                        </div>
                    </div>
                    <?php
                    if (is_user_logged_in()):
                        $current_user = wp_get_current_user();
                        ?>                    
                        <div class="ui dropdown top right pointing item"> 
                            <img src="<?php echo get_template_directory_uri() ?>/assets/images/avatar.png" alt="..." class="ui avatar image">
                            <span class="wording_header"><?php echo $current_user->user_login ?></span>
                            <div class="menu">
                                <h2 class="header"><?php echo $current_user->user_login ?></h2>
                                <div class="divider"></div>
                                <a href='<?php echo get_permalink(get_page_by_path(__('mon-compte', 'gpdealdomain'))) ?>' class="ui item">
                                    <i class="setting icon"></i>
                                    <?php echo get_page_by_path(__('mon-compte', 'gpdealdomain'))->post_title ?>                         
                                </a>
                                <a href='<?php echo get_permalink(get_page_by_path(__('mon-compte', 'gpdealdomain') . '/' . __('profile', 'gpdealdomain'))) ?>' class="ui item">
                                    <i class="unhide icon"></i>
                                    <?php echo get_page_by_path(__('mon-compte', 'gpdealdomain') . '/' . __('profile', 'gpdealdomain'))->post_title ?>                         
                                </a>
                                <a href='<?php echo get_permalink(get_page_by_path(__('mon-compte', 'gpdealdomain') . '/' . __('courriers-colis', 'gpdealdomain'))) ?>' class="ui item">
                                    <i class="travel icon"></i>
                                    <?php echo get_page_by_path(__('mon-compte', 'gpdealdomain') . '/' . __('courriers-colis', 'gpdealdomain'))->post_title ?>                         
                                </a>
                                <a href='<?php echo get_permalink(get_page_by_path(__('mon-compte', 'gpdealdomain') . '/' . __('offres-de-transport', 'gpdealdomain'))) ?>' class="ui item">
                                    <i class="shipping icon"></i>
                                    <?php echo get_page_by_path(__('mon-compte', 'gpdealdomain') . '/' . __('offres-de-transport', 'gpdealdomain'))->post_title ?>                         
                                </a>
                                <div class="divider"></div>
                                <a href="<?php echo esc_url(add_query_arg(array('logout' => 'true'), home_url('/'))) ?> " class="ui item">
                                    <i class="sign out icon"></i>
                                    <?php echo __('Se déconnecter', 'gpdealdomain') ?>
                                </a>
                            </div>
                        </div>
                    <?php else: ?>
                        <div class="ui dropdown top right pointing item"> 
                            <i class="sign in icon"></i>
                            <span class="wording_header"><?php echo __('Se connecter', 'gpdealdomain'); ?></span>
                            <div class="menu signin_dropdown_menu">
                                <div class="ui fluid card" style="margin-bottom: 0;">
                                    <div class="content">
                                        <form  method="POST" class="ui form login_form" action="<?php echo get_permalink(get_page_by_path(__('connexion', 'gpdealdomain'))) ?>" style="margin-bottom: 1em" >
                                            <p><span style="color: red;">*</span> Informations obligatoires</p>
                                            <div class="field">
                                                <label>Adresse Email ou Pseudo <span style="color: red;">*</span></label>
                                                <input type="text" name="_username" placeholder="Adresse email">
                                            </div>
                                            <div class="field">
                                                <label>Mot de passe <span style="color: red;">*</span></label>
                                                <div class="ui input right icon">
                                                    <i class="unhide link icon show_hide_password_login"></i>
                                                    <input type="password" name="_password" placeholder="Mot de passe">
                                                </div>
                                            </div>
                                            <div class="inline field">
                                                <div class="ui checkbox">
                                                    <input type="checkbox" name="_remember" value="true">
                                                    <label>Se souvenir de moi</label>
                                                </div>
                                            </div>
                                            <div class="field center aligned">
                                                <button id="submit_login_form" class="ui green fluid button" type="submit">Se Connecter</button>
                                            </div> 
                                            <div class="field center aligned">
                                                <a href="<?php echo get_permalink(get_page_by_path(__('mot-de-passe-oublie', 'gpdealdomain'))) ?>" >Mot de passe oublié</a>
                                            </div>
                                        </form>
                                        <a href="<?php echo get_permalink(get_page_by_path(__('inscription', 'gpdealdomain'))) ?>" class="ui green fluid button" type="submit">S'inscrire</a>
                                    </div>
                                </div>
                                <div class="item" style="display: none"></div>
                            </div>
                        </div>
                        <a href="<?php echo get_permalink(get_page_by_path(__('inscription', 'gpdealdomain'))) ?>" class="item">
                            <i class="add user icon"></i><span class="wording_header"><?php echo __("S'inscrire", 'gpdealdomain') ?></span>
                        </a>
                    <?php endif ?>
                </div>
            </div>
        </div>-->

        <!-- Sidebar Menu -->
        <div class="ui vertical accordion following inverted sidebar menu">
            <div class="sidebar_title item" style="background-color: white;">
                <img class="ui tiny image logo" src="<?php echo get_template_directory_uri() ?>/assets/images/logo_gpdeal.png">
            </div>
            <div class="<?php if (is_page(__('accueil', 'gpdealdomain'))): ?>active<?php endif ?> item">
                <div class="title"><a href="<?php echo home_url('/') ?>" ><i class="home icon"></i><?php echo get_page_by_path(__('accueil', 'gpdealdomain'))->post_title ?></a></div>
            </div>
            <div class="<?php if (is_page(__('mentions-legales', 'gpdealdomain'))): ?>active<?php endif ?> item">
                <div class="title"><a href="<?php echo get_permalink(get_page_by_path(__('mentions-legales', 'gpdealdomain'))) ?>"><i class="info icon"></i><?php echo get_page_by_path(__('mentions-legales', 'gpdealdomain'))->post_title ?></a></div>
            </div>
            <div class="<?php if (is_page(__('conditions-dutilisation', 'gpdealdomain'))): ?>active<?php endif ?> item">
                <div class="title"><a href="<?php echo get_permalink(get_page_by_path(__('conditions-dutilisation', 'gpdealdomain'))) ?>"><i class="universal access icon"></i><?php echo get_page_by_path(__('conditions-dutilisation', 'gpdealdomain'))->post_title ?></a></div>
            </div>
            <div class="<?php if (is_page(__('nous-contacter', 'gpdealdomain'))): ?>active<?php endif ?> item">
                <div class="title"><a href="<?php echo get_permalink(get_page_by_path(__('nous-contacter', 'gpdealdomain'))) ?>"><i class="mail icon"></i><?php echo get_page_by_path(__('nous-contacter', 'gpdealdomain'))->post_title ?></a></div>
            </div>
        </div>


        <!-- Page Contents -->
        <div class="pusher">
            <div id="message_success" class="ui success message" style="position: fixed; top: 5em; right: 40em; left: auto; z-index: 5; width: 25em; display: none">
                <i class="close icon"></i>
                <div class="header"></div>
            </div>

            <div id="message_error" class="ui error message" style="position: fixed; top: 5em; right: 40em; left: auto; z-index: 5; width: 25em; display: none">
                <i class="close icon"></i>
                <div class="header"> </div>
            </div>

            <div id="message_loading" class="ui icon message" style="position: fixed; top: 5em; right: 40em; left: auto; z-index: 5; width: 20em; display: none;">
                <i class="notched circle loading icon"></i>
                <div class="content">
                    <div class="header">Traitement encours... </div>
                </div>
            </div>
