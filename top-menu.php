
<div id='my_mobile_menu' class="ui large borderless top fixed menu" style="height: 4em; display: none" >
    <div class="ui container">
        <div  class="left menu">
            <a id="sidebar_mobile_menu_item" class="ui item"><i class="sidebar icon"></i></a>
            <a id='remove_mobile_menu_item' class="ui item" style="display:none"><i class="remove icon"></i></a>
            <!--            <div class="ui dropdown top left pointing item">
                            <i class="sidebar icon"></i>
                            <div class="menu">
                                <a href="<?php echo home_url('/') ?>" class="ui item"><i class="home icon"></i><?php echo __("Accueil", "gpdealdomain") ?></a>
                                <a href="<?php echo get_permalink(get_page_by_path(__('mentions-legales', 'gpdealdomain'))) ?>" class="ui <?php if (is_page(__('mentions-legales', 'gpdealdomain'))): ?> active_menu <?php endif ?> item"><i class="info icon"></i><?php echo get_page_by_path(__('mentions-legales', 'gpdealdomain'))->post_title ?></a>
                                <a href="<?php echo get_permalink(get_page_by_path(__('conditions-dutilisation', 'gpdealdomain'))) ?>" class="ui <?php if (is_page(__('conditions-dutilisation', 'gpdealdomain'))): ?> active_menu <?php endif ?> item"><i class="universal access icon"></i><?php echo get_page_by_path(__('conditions-dutilisation', 'gpdealdomain'))->post_title ?></a>
                                <a href="<?php echo get_permalink(get_page_by_path(__('nous-contacter', 'gpdealdomain'))) ?>" class="ui <?php if (is_page(__('nous-contacter', 'gpdealdomain'))): ?> active_menu <?php endif ?> item"><i class="mail icon"></i><?php echo get_page_by_path(__('nous-contacter', 'gpdealdomain'))->post_title ?></a>
                            </div>
                        </div>-->
            <div class="toc item" style="display:none;">
                <i class="sidebar icon"></i>
            </div>
            <a href="<?php echo home_url('/') ?>" class="header item">
                <img id='fixed_menu_logo' class="logo" src="<?php echo get_template_directory_uri() ?>/assets/images/logo_gpdeal.png">
            </a>
        </div>

        <div class="center menu">
            <!--            <div class="title_gpdeal item">
                            GLOBAL DEAL PARCEL
                        </div>-->
        </div>
        <div class="right menu">
            <div id="dropdow_search_mobile" class="ui dropdown item">
                <i class="search icon"></i>
                <div id='dropdow_menu_search_mobile' class="menu" style="padding: 0.3em; border-radius: 0px;">
                    <div class="item" style="display: none">test value</div>
                    <form id="mobile_search_input_top_form" action="<?php echo home_url('/') ?>" method="GET" >
                        <div class="ui action input" style="">
                            <div class="ui input right icon s_mobile" style="">
                                <i class="remove link icon s_mobile" <?php if (!isset($_GET['s'])): ?> style="display: none;" <?php endif ?> locality_id='s_mobile'></i>
                                <input id='s_mobile' type="text" class="locality" placeholder="Rechercher en fonction d'une ville ..." name="s" value="<?php
                                if (isset($_GET['s'])) {
                                    echo stripslashes($_GET['s']);
                                }
                                ?>" autocomplete="off">
                            </div>
                            <button id="mobile_submit_search_input_top" type="submit" class="ui green button"><i class="search icon"></i></button>
                        </div>
                    </form>
                    <div class="item" style="display: none">test value</div>
                </div>
            </div>
            <div  class="ui top right pointing dropdown item lang_select">
                <i class="world icon"></i>
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
                $profile_picture_id = get_user_meta($current_user->ID, 'profile-picture-ID', true) ? get_user_meta($current_user->ID, 'profile-picture-ID', true) : get_user_meta($current_user->ID, 'company-logo-ID', true);
                ?>                    
                <div class="ui dropdown top right pointing item"> 
                    <img  <?php if ($profile_picture_id): ?> src= "<?php echo wp_get_attachment_url($profile_picture_id); ?>" <?php else: ?> src="<?php echo get_template_directory_uri() ?>/assets/images/avatar.png"<?php endif ?> alt="..." class="ui avatar image">
                    <div class="menu">
                        <h2 class="header"><?php echo $current_user->user_login ?></h2>
                        <div class="divider"></div>
                        <a href='<?php echo get_permalink(get_page_by_path(__('mon-compte', 'gpdealdomain'))) ?>' class="ui item">
                            <i class="setting icon"></i>
                            <?php echo get_page_by_path(__('mon-compte', 'gpdealdomain'))->post_title ?>                         
                        </a>
                        <a href='<?php echo get_permalink(get_page_by_path(__('mon-compte', 'gpdealdomain') . '/' . __('profil', 'gpdealdomain'))) ?>' class="ui item">
                            <i class="user icon"></i>
                            <?php echo get_page_by_path(__('mon-compte', 'gpdealdomain') . '/' . __('profil', 'gpdealdomain'))->post_title ?>                         
                        </a>
                        <a href='<?php echo get_permalink(get_page_by_path(__('mon-compte', 'gpdealdomain') . '/' . __('expeditions', 'gpdealdomain'))) ?>' class="ui item">
                            <i class="travel icon"></i>
                            <?php echo get_page_by_path(__('mon-compte', 'gpdealdomain') . '/' . __('expeditions', 'gpdealdomain'))->post_title ?>                         
                        </a>
                        <a href='<?php echo get_permalink(get_page_by_path(__('mon-compte', 'gpdealdomain') . '/' . __('offres-de-transport', 'gpdealdomain'))) ?>' class="ui item">
                            <i class="shipping icon"></i>
                            <?php echo get_page_by_path(__('mon-compte', 'gpdealdomain') . '/' . __('offres-de-transport', 'gpdealdomain'))->post_title ?>                         
                        </a>
                        <div class="divider"></div>
                        <a  href="<?php echo home_url('/'); ?> " class="ui item disconnected_btn">
                            <i class="sign out icon"></i>
                            <?php echo __('Se déconnecter', 'gpdealdomain') ?>
                        </a>
                    </div>
                </div>
            <?php else: ?>
                <div class="ui dropdown top right pointing item"> 
                    <i class="sign in icon"></i>
                    <div class="menu signin_dropdown_menu">
                        <div class="ui fluid card" style="margin-bottom: 0;">
                            <div class="content">
                                <form id="login_form" method="POST" class="ui form login_form" action="<?php echo get_permalink(get_page_by_path(__('connexion', 'gpdealdomain'))) ?>" style="margin-bottom: 1em" autocomplete="off">
                                    <!--<p style="font-size: 12px"><span style="color: red;">*</span> Informations obligatoires</p>-->
                                    <div class="field">
                                        <label>Email ou pseudo <span style="color: red;">*</span></label>
                                        <div class="ui input left icon">
                                            <i class="user icon"></i>
                                            <input type="text" name="_username" placeholder="Email ou pseudo">
                                        </div>
                                    </div>
                                    <div class="field">
                                        <label>Mot de passe <span style="color: red;">*</span></label>
                                        <div class="ui input left icon">
                                            <i class="lock icon"></i>
                                            <input type="password" name="_password" placeholder="Mot de passe">
                                        </div>
                                    </div>
                                    <div class="inline field">
                                        <div class="ui checkbox">
                                            <input type="checkbox" name="_remember" value="true">
                                            <label>Se souvenir de moi</label>
                                        </div>
                                    </div>
                                    
                                    <input type="hidden" name='no_redirect' value="true" >
                                    <div class="field center aligned">
                                        <button id="submit_login_form"  class="ui green fluid button submit_login_form">Se connecter</button>
                                    </div> 
                                    <div class="field center aligned">
                                        <a href="<?php echo get_permalink(get_page_by_path(__('mot-de-passe-oublie', 'gpdealdomain'))) ?>" >Mot de passe oublié ?</a>
                                    </div>
                                </form>
    <!--                                <a href="<?php echo get_permalink(get_page_by_path(__('inscription', 'gpdealdomain'))) ?>" class="ui green fluid button" type="submit">Inscrivez-vous</a>-->
                            </div>
                        </div>
                        <div class="item" style="display: none">test value</div>
                    </div>
                </div>
                <a href="<?php echo get_permalink(get_page_by_path(__('inscription', 'gpdealdomain'))) ?>" class="item">
                    <i class="add user icon"></i>
                </a>
            <?php endif ?>
        </div>
    </div>
</div>

<div class="ui borderless pointing top fixed main menu">
    <div class="ui container top-nav">
        <div  class="left menu">
            <!--        <div class="ui dropdown item">
                        <i class="large sidebar icon"></i>
                        <div id='main_dropdown_menu' class="menu">
                            <a href="<?php echo home_url('/') ?>" class="ui item"><i class="home icon"></i><?php echo get_page_by_path(__('accueil', 'gpdealdomain'))->post_title ?></a>
                            <a href="<?php echo get_permalink(get_page_by_path(__('mentions-legales', 'gpdealdomain'))) ?>" class="ui <?php if (is_page(__('mentions-legales', 'gpdealdomain'))): ?> active_menu <?php endif ?> item"><i class="info icon"></i><?php echo get_page_by_path(__('mentions-legales', 'gpdealdomain'))->post_title ?></a>
                            <a href="<?php echo get_permalink(get_page_by_path(__('conditions-dutilisation', 'gpdealdomain'))) ?>" class="ui <?php if (is_page(__('conditions-dutilisation', 'gpdealdomain'))): ?> active_menu <?php endif ?> item"><i class="universal access icon"></i><?php echo get_page_by_path(__('conditions-dutilisation', 'gpdealdomain'))->post_title ?></a>
                            <a href="<?php echo get_permalink(get_page_by_path(__('nous-contacter', 'gpdealdomain'))) ?>" class="ui <?php if (is_page(__('nous-contacter', 'gpdealdomain'))): ?> active_menu <?php endif ?> item"><i class="mail icon"></i><?php echo get_page_by_path(__('nous-contacter', 'gpdealdomain'))->post_title ?></a>
                        </div>
                    </div>-->
            <a id="sidebar_menu_item" class="ui item"><i class="large sidebar icon"></i></a>
            <a id='remove_menu_item' class="ui item" style="display:none"><i class="large remove icon"></i></a>
            <!--            <div class="toc item" style="display: none;">
                            <i class="big sidebar icon"></i>
                        </div>-->
            <a href="<?php echo home_url('/') ?>" class="header item">
                <img class="ui tiny image logo" src="<?php echo get_template_directory_uri() ?>/assets/images/logo_gpdeal.png">
            </a>
        </div>

        <div id="sitename" class="center menu">
            <div class="item">
                <form id="search_input_top_form" action="<?php echo home_url('/') ?>" method="GET">
                    <?php if (is_user_logged_in()): ?>
                        <div id="search_input_top" class="ui action input" style="width: 35em">
                            <div class="ui input right icon s" style="width: 35em">
                                <!--<i class="marker icon s" locality_id='s'></i>-->
                                <i class="remove link icon s" <?php if (!isset($_GET['s'])): ?> style="display: none;" <?php endif ?> locality_id='s'></i>
                                <input id='s' type="text" class="locality" placeholder="Rechercher en fonction d'une ville ..." name="s" value="<?php
                                if (isset($_GET['s'])) {
                                    echo stripslashes($_GET['s']);
                                }
                                ?>" autocomplete="off">
                            </div>
                            <button id="submit_search_input_top" type="submit" class="ui green button"><i class="search icon"></i></button>
                        </div>
                    <?php else: ?>
                        <div id="search_input_top" class="ui action input" style="width: 29em">
                            <div class="ui input right icon s" style="width: 29em">
                                <!--<i class="marker icon s" locality_id='s'></i>-->
                                <i class="remove link icon s" <?php if (!isset($_GET['s'])): ?> style="display: none;" <?php endif ?> locality_id='s'></i>
                                <input id='s' type="text" class="locality" placeholder="Rechercher en fonction d'une ville ..." name="s" value="<?php
                                if (isset($_GET['s'])) {
                                    echo stripslashes($_GET['s']);
                                }
                                ?>" autocomplete="off">
                            </div>
                            <button id="submit_search_input_top" type="submit" class="ui green button"><i class="search icon"></i></button>
                        </div>
                    <?php endif ?>
                </form>
            </div>
        </div>

        <div  class="right menu">

            <!--            <div id="lang_select" class="ui top right pointing dropdown icon item">
                            <i class="large world icon"></i>
                            <div class="menu">
                                <a href="<?php echo esc_url(add_query_arg(array('lang' => 'en'), the_permalink())) ?>" class="ui item">
                                    <i class="gb flag"></i><?php echo __('Anglais', 'gpdealdomain') ?>
                                </a>
                                <a href="<?php echo esc_url(add_query_arg(array('lang' => 'fr'), the_permalink())) ?>" class="ui item">
                                    <i class="fr flag"></i><?php echo __('Français', 'gpdealdomain') ?>
                                </a>
                            </div>
                        </div>-->
            <div id="lang_select" class="ui top right pointing dropdown item">
                <i class="world icon"></i>
                <span ><?php echo __('Français', 'gpdealdomain') ?></span>
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
                $profile_picture_id = get_user_meta($current_user->ID, 'profile-picture-ID', true) ? get_user_meta($current_user->ID, 'profile-picture-ID', true) : get_user_meta($current_user->ID, 'company-logo-ID', true);
                ?>                    
                <div class="ui dropdown top right pointing item"> 
                    <img  <?php if ($profile_picture_id): ?> src= "<?php echo wp_get_attachment_url($profile_picture_id); ?>" <?php else: ?> src="<?php echo get_template_directory_uri() ?>/assets/images/avatar.png"<?php endif ?> alt="..." class="ui avatar image">
                    <?php echo $current_user->user_login ?>
                    <div class="menu">
                        <a href='<?php echo get_permalink(get_page_by_path(__('mon-compte', 'gpdealdomain'))) ?>' class="ui item">
                            <i class="setting icon"></i>
                            <?php echo get_page_by_path(__('mon-compte', 'gpdealdomain'))->post_title ?>                         
                        </a>
                        <a href='<?php echo get_permalink(get_page_by_path(__('mon-compte', 'gpdealdomain') . '/' . __('profil', 'gpdealdomain'))) ?>' class="ui item">
                            <i class="user icon"></i>
                            <?php echo get_page_by_path(__('mon-compte', 'gpdealdomain') . '/' . __('profil', 'gpdealdomain'))->post_title ?>                         
                        </a>
                        <a href='<?php echo get_permalink(get_page_by_path(__('mon-compte', 'gpdealdomain') . '/' . __('expeditions', 'gpdealdomain'))) ?>' class="ui item">
                            <i class="travel icon"></i>
                            <?php echo get_page_by_path(__('mon-compte', 'gpdealdomain') . '/' . __('expeditions', 'gpdealdomain'))->post_title ?>                         
                        </a>
                        <a href='<?php echo get_permalink(get_page_by_path(__('mon-compte', 'gpdealdomain') . '/' . __('offres-de-transport', 'gpdealdomain'))) ?>' class="ui item">
                            <i class="shipping icon"></i>
                            <?php echo get_page_by_path(__('mon-compte', 'gpdealdomain') . '/' . __('offres-de-transport', 'gpdealdomain'))->post_title ?>                         
                        </a>
                        <div class="divider"></div>
                        <a href="<?php echo home_url('/'); ?> " class="ui item disconnected_btn">
                            <i class="sign out icon"></i>
                            <?php echo __('Se déconnecter', 'gpdealdomain') ?>
                        </a>
                    </div>
                </div>
            <?php else: ?>
                <div class="ui dropdown top right pointing item"> 
                    <i class="sign in icon"></i>
                    <?php echo __('Se connecter', 'gpdealdomain'); ?>
                    <div class="menu signin_dropdown_menu">
                        <div class="ui fluid card" style="margin-bottom: 0;">
                            <div class="content">
                                <form id="login_form1"  method="POST" class="ui form" action="<?php echo get_permalink(get_page_by_path(__('connexion', 'gpdealdomain'))) ?>" style="margin-bottom: 1em" autocomplete="off">
                                    <!--<p style="font-size: 12px"><span style="color: red;">*</span> Informations obligatoires</p>-->
                                    <div class="field">
                                        <label>Email ou pseudo <span style="color: red;">*</span></label>
                                        <div class="ui input left icon">
                                            <i class="user icon"></i>
                                            <input type="text" name="_username" placeholder="Email ou pseudo">
                                        </div>
                                    </div>
                                    <div class="field">
                                        <label>Mot de passe <span style="color: red;">*</span></label>
                                        <div class="ui input left icon">
                                            <i class="lock icon"></i>
                                            <input type="password" name="_password" placeholder="Mot de passe">
                                        </div>
                                    </div>
                                    <div class="inline field">
                                        <div class="ui checkbox">
                                            <input type="checkbox" name="_remember" value="true">
                                            <label>Se souvenir de moi</label>
                                        </div>
                                    </div>
                                    <input type="hidden" name='no_redirect' value="true" >
                                    
                                    <div class="field center aligned">
                                        <button id="submit_login_form1" class="ui green fluid button submit_login_form" type="submit"><?php echo __('Se connecter', 'gpdealdomain'); ?></button>
                                    </div> 
                                    <div class="field center aligned">
                                        <a href="<?php echo get_permalink(get_page_by_path(__('mot-de-passe-oublie', 'gpdealdomain'))) ?>" >Mot de passe oublié ?</a>
                                    </div>
                                </form>
    <!--                                <a href="<?php echo get_permalink(get_page_by_path(__('inscription', 'gpdealdomain'))) ?>" class="ui green fluid button" type="submit"><?php echo __("S'inscrire", 'gpdealdomain') ?></a>-->
                            </div>
                        </div>
                        <div class="item" style="display: none">test value</div>
                    </div>
                </div>
                <a href="<?php echo get_permalink(get_page_by_path(__('inscription', 'gpdealdomain'))) ?>" class="item">
                    <i class="add user icon"></i><?php echo __("S'inscrire", 'gpdealdomain') ?>
                </a>
            <?php endif ?>
        </div>
    </div>
</div>
<div id='sub_main_menu' class="ui fixed menu hidden">
    <div class="ui container">
        <div id='menu_grid_column_container' class="ui four column relaxed equal height grid">
            <div class="column">
                <div class="ui link list">
                    <a href="<?php echo home_url('/') ?>" class="item"><?php echo get_page_by_path(__('accueil', 'gpdealdomain'))->post_title ?></a>
                    <?php if (!is_user_logged_in()): ?>       
                        <a href="<?php echo get_permalink(get_page_by_path(__('connexion', 'gpdealdomain'))) ?>" class="item"><?php echo __("Se connecter", 'gpdealdomain') ?></a>
                        <a href="<?php echo get_permalink(get_page_by_path(__('inscription', 'gpdealdomain'))) ?>" class="item"><?php echo __("S'inscrire", 'gpdealdomain') ?></a>
                    <?php else : ?>
                        <a href='<?php echo get_permalink(get_page_by_path(__('mon-compte', 'gpdealdomain'))) ?>' class="item">
                            <?php echo get_page_by_path(__('mon-compte', 'gpdealdomain'))->post_title ?>                         
                        </a>
                        <a href='<?php echo get_permalink(get_page_by_path(__('mon-compte', 'gpdealdomain') . '/' . __('profil', 'gpdealdomain'))) ?>' class="item">
                            <?php echo get_page_by_path(__('mon-compte', 'gpdealdomain') . '/' . __('profil', 'gpdealdomain'))->post_title ?>                         
                        </a>
                        <a href="<?php echo esc_url(add_query_arg(array('logout' => 'true'), home_url('/'))) ?> " class="item">
                            <?php echo __('Se déconnecter', 'gpdealdomain') ?>
                        </a>
                    <?php endif ?>
                </div>
            </div>

            <div class="column">
                <div class="ui link list">
                    <a  href="<?php echo get_permalink(get_page_by_path(__('mon-compte', 'gpdealdomain') . '/' . __('expeditions', 'gpdealdomain') . '/' . __('saisir', 'gpdealdomain'))) ?>"  class="item" >
                        <?php echo __('Expédier un courrier/colis'); ?>
                    </a>
                    <a  href="<?php echo get_permalink(get_page_by_path(__('mon-compte', 'gpdealdomain') . '/' . __('offres-de-transport', 'gpdealdomain') . '/' . __('saisir', 'gpdealdomain'))) ?>"  class="item" >
                        <?php echo __('Proposer un transport'); ?>
                    </a>
                    <?php if (is_user_logged_in()): ?>
                        <a href='<?php echo get_permalink(get_page_by_path(__('mon-compte', 'gpdealdomain') . '/' . __('expeditions', 'gpdealdomain'))) ?>' class="item">
                            <?php echo get_page_by_path(__('mon-compte', 'gpdealdomain') . '/' . __('expeditions', 'gpdealdomain'))->post_title ?>                         
                        </a>
                        <a href='<?php echo get_permalink(get_page_by_path(__('mon-compte', 'gpdealdomain') . '/' . __('offres-de-transport', 'gpdealdomain'))) ?>' class="item">
                            <?php echo get_page_by_path(__('mon-compte', 'gpdealdomain') . '/' . __('offres-de-transport', 'gpdealdomain'))->post_title ?>                         
                        </a>
                    <?php endif ?>
                </div>
            </div>

            <div class="column">
                <div class="ui link list">
                    <a href="<?php echo get_permalink(get_page_by_path(__('mentions-legales', 'gpdealdomain'))) ?>" class="item"><?php echo get_page_by_path(__('mentions-legales', 'gpdealdomain'))->post_title ?></a>
                    <a href="<?php echo get_permalink(get_page_by_path(__('conditions-dutilisation', 'gpdealdomain'))) ?>" class="item"><?php echo get_page_by_path(__('conditions-dutilisation', 'gpdealdomain'))->post_title ?></a>
                    <a href="<?php echo get_permalink(get_page_by_path(__('nous-contacter', 'gpdealdomain'))) ?>" class="item"><?php echo get_page_by_path(__('nous-contacter', 'gpdealdomain'))->post_title ?></a>
                </div>
            </div>

        </div>
    </div>
</div>