<div id='my_mobile_menu' class="ui large borderless top fixed menu" style="height: 4em; display: none" >
    <div class="ui container">
        <div  class="left menu">
            <a id="sidebar_mobile_menu_item" class="ui item"><i class="sidebar icon"></i></a>
            <a id='remove_mobile_menu_item' class="ui item" style="display:none"><i class="remove icon"></i></a>
            <div class="toc item" style="display:none;">
                <i class="sidebar icon"></i>
            </div>
            <a href="<?php echo wp_make_link_relative(home_url('/')) ?>" class="header item">
                <img id='fixed_menu_logo' class="logo" src="<?php echo wp_make_link_relative(get_template_directory_uri()) ?>/assets/images/gpdeal_logo_mobile.png">
            </a>
        </div>

        <div class="center menu">           
        </div>
        <div class="right menu">
            <div id="dropdown_search_mobile" class="ui dropdown item">
                <i class="search icon"></i>
                <div id='dropdown_menu_search_mobile' class="menu" style="padding: 0.3em; border-radius: 0px;">
                    <div class="item" style="display: none">test value</div>
                    <form id="mobile_search_input_top_form" action="<?php echo wp_make_link_relative(get_site_url().'/') ?>" method="GET" >
                        <div class="ui action input">
                            <div class="ui input right icon s_mobile">
                                <i class="remove link icon s_mobile" <?php if (!isset($_GET['s'])): ?> style="display: none;" <?php endif ?> locality_id='s_mobile'></i>
                                <input id='s_mobile' type="text" class="locality" placeholder="<?php _e('Search by city', 'gpdealdomain')?> ..." name="s" value="<?php
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
                <i class="<?php _e("flag_code","gpdealdomain" ); ?> flag"></i>
                <div class="menu">
                    <a href="<?php echo esc_url(add_query_arg(array('lang' => 'en'), wp_make_link_relative(home_url('/')))) ?>" class="item" data-value="gb">
                        <i class="gb flag"></i><?php echo __('English', 'gpdealdomain') ?>
                    </a>
                    <a href="<?php echo esc_url(add_query_arg(array('lang' => 'fr'), wp_make_link_relative(home_url('/')))) ?>" class="item" data-value="fr">
                        <i class="fr flag"></i><?php echo __('French', 'gpdealdomain') ?>
                    </a>
                </div>
            </div>
            <?php
            if (is_user_logged_in()):
                $current_user = wp_get_current_user();
                $profile_picture_id = get_user_meta($current_user->ID, 'profile-picture-ID', true) ? get_user_meta($current_user->ID, 'profile-picture-ID', true) : get_user_meta($current_user->ID, 'company-logo-ID', true);
                ?>                    
                <div class="ui dropdown top right pointing item"> 
                    <img  <?php if ($profile_picture_id): ?> src= "<?php echo wp_make_link_relative(wp_get_attachment_url($profile_picture_id)); ?>" <?php else: ?> src="<?php echo get_template_directory_uri() ?>/assets/images/avatar.png"<?php endif ?> alt="..." class="ui avatar image">
                    <div class="menu">
                        <h2 class="header"><?php echo $current_user->user_login ?></h2>
                        <div class="divider"></div>
                        <a href='<?php echo wp_make_link_relative(get_permalink(get_page_by_path(__('my-account', 'gpdealdomain')))) ?>' class="ui item">
                            <i class="user icon"></i>
                            <?php _e('My account', 'gpdealdomain') ?>                         
                        </a>
<!--                        <a href='<?php echo wp_make_link_relative(get_permalink(get_page_by_path(__('my-account', 'gpdealdomain') . '/' . __('profile', 'gpdealdomain')))); ?>' class="ui item">
                            <i class="user icon"></i>
                            <?php echo __("My profile", "gpdealdomain"); ?>                         
                        </a>-->
                        <div class="divider"></div>
                        <a  href="<?php echo esc_url(add_query_arg(array('logout' => 'true'), wp_make_link_relative(home_url('/')))) ?>" class="ui item disconnected_btn">
                            <i class="sign out icon"></i>
                            <?php echo __('Sign out', 'gpdealdomain') ?>
                        </a>
                    </div>
                </div>
            <?php else: ?>
                <div class="ui dropdown top right pointing item"> 
                    <i class="sign in icon"></i>
                    <div class="menu signin_dropdown_menu">
                        <div class="ui fluid card" style="margin-bottom: 0;">
                            <div class="content">
                                <form id="login_form" method="POST" class="ui form login_form" action="<?php echo wp_make_link_relative(get_permalink(get_page_by_path(__('log-in', 'gpdealdomain')))); ?>" style="margin-bottom: 1em" autocomplete="off">
                                    <!--<p style="font-size: 12px"><span style="color: red;">*</span> Informations obligatoires</p>-->
                                    <div class="field">
                                        <label><?php _e('Email or username', 'gpdealdomain'); ?> <span style="color: red;">*</span></label>
                                        <div class="ui input left icon">
                                            <i class="user icon"></i>
                                            <input type="text" name="_username" placeholder="<?php _e('Email or username', 'gpdealdomain'); ?>">
                                        </div>
                                    </div>
                                    <div class="field">
                                        <label><?php _e('Password', 'gpdealdomain'); ?> <span style="color: red;">*</span></label>
                                        <div class="ui input left icon">
                                            <i class="lock icon"></i>
                                            <input type="password" name="_password" placeholder="<?php _e('Password', 'gpdealdomain'); ?>">
                                        </div>
                                    </div>
                                    <div class="inline field">
                                        <div class="ui checkbox">
                                            <input type="checkbox" name="_remember">
                                            <label><?php _e('Remember me', 'gpdealdomain'); ?></label>
                                        </div>
                                    </div>
                                    
                                    <input type="hidden" name='no_redirect' value="true" >
                                    <div class="field center aligned">
                                        <button id="submit_login_form"  class="ui green fluid button submit_login_form"><?php _e('Sign in', 'gpdealdomain'); ?></button>
                                    </div> 
                                    <div class="field center aligned">
                                        <a href="<?php echo wp_make_link_relative(get_permalink(get_page_by_path(__('forgot-your-password', 'gpdealdomain')))); ?>" ><?php _e('Forgot your password', 'gpdealdomain'); ?> ?</a>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <div class="item" style="display: none">test value</div>
                    </div>
                </div>
                <a href="<?php echo wp_make_link_relative(get_permalink(get_page_by_path(__('registration', 'gpdealdomain')))); ?>" class="item">
                    <i class="add user icon"></i>
                </a>
            <?php endif ?>
        </div>
    </div>
</div>

<div class="ui borderless pointing top fixed main menu">
    <div class="ui container top-nav">
        <div  class="left menu">
            <a id="sidebar_menu_item" class="ui item"><i class="large sidebar icon"></i></a>
            <a id='remove_menu_item' class="ui item" style="display:none"><i class="large remove icon"></i></a>
            <a href="<?php echo wp_make_link_relative(home_url('/')) ?>" class="header item">
                <img class="ui tiny image logo" src="<?php echo get_template_directory_uri() ?>/assets/images/gpdeal_logo.png">
            </a>
        </div>

        <div id="sitename" class="center menu">
            <div class="item">
                <form id="search_input_top_form" action="<?php echo wp_make_link_relative(get_site_url().'/'); ?>" method="GET">
                    <?php if (is_user_logged_in()): ?>
                        <div id="search_input_top" class="ui action input" style="width: 35em">
                            <div class="ui input right icon s" style="width: 35em">
                                <i class="remove link icon s" <?php if (!isset($_GET['s'])): ?> style="display: none;" <?php endif ?> locality_id='s'></i>
                                <input id='s' type="text" class="locality" placeholder="<?php _e('Search by city', 'gpdealdomain')?> ..." name="s" value="<?php
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
                                <i class="remove link icon s" <?php if (!isset($_GET['s'])): ?> style="display: none;" <?php endif ?> locality_id='s'></i>
                                <input id='s' type="text" class="locality" placeholder="<?php _e('Search by city', 'gpdealdomain')?> ..." name="s" value="<?php
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
            <div id="lang_select" class="ui top right pointing dropdown item">
                <i class="<?php _e("flag_code","gpdealdomain" ); ?> flag"></i>
                <span ><?php echo __('Lang title', 'gpdealdomain') ?></span>
                <div class="menu">
                    <a href="<?php echo esc_url(add_query_arg(array('lang' => 'en'), wp_make_link_relative(home_url('/')))); ?>" class="item" data-value="gb">
                        <i class="gb flag"></i><?php echo __('English', 'gpdealdomain') ?>
                    </a>
                    <a href="<?php echo esc_url(add_query_arg(array('lang' => 'fr'), wp_make_link_relative(home_url('/')))); ?>" class="item" data-value="fr">
                        <i class="fr flag"></i><?php echo __('French', 'gpdealdomain') ?>
                    </a>
                </div>
            </div>
            <?php
            if (is_user_logged_in()):
                $current_user = wp_get_current_user();
                $profile_picture_id = get_user_meta($current_user->ID, 'profile-picture-ID', true) ? get_user_meta($current_user->ID, 'profile-picture-ID', true) : get_user_meta($current_user->ID, 'company-logo-ID', true);
                ?>                    
                <div class="ui dropdown top right pointing item"> 
                    <img  <?php if ($profile_picture_id): ?> src= "<?php echo wp_make_link_relative(wp_get_attachment_url($profile_picture_id)); ?>" <?php else: ?> src="<?php echo get_template_directory_uri() ?>/assets/images/avatar.png"<?php endif ?> alt="..." class="ui avatar image">
                    <?php echo $current_user->user_login ?>
                    <div class="menu">
                        <a href='<?php echo wp_make_link_relative(get_permalink(get_page_by_path(__('my-account', 'gpdealdomain')))) ?>' class="ui item">
                            <i class="user icon"></i>
                            <?php echo _e('My account', 'gpdealdomain');?>                         
                        </a>
<!--                        <a href='<?php echo wp_make_link_relative(get_permalink(get_page_by_path(__('my-account', 'gpdealdomain') . '/' . __('profile', 'gpdealdomain')))); ?>' class="ui item">
                            <i class="user icon"></i>
                            <?php echo __("My profile", "gpdealdomain"); ?>                         
                        </a>-->
                        <div class="divider"></div>
                        <a href="<?php echo esc_url(add_query_arg(array('logout' => 'true'), wp_make_link_relative(home_url('/')))) ?>" class="ui item disconnected_btn">
                            <i class="sign out icon"></i>
                            <?php echo __('Sign out', 'gpdealdomain') ?>
                        </a>
                    </div>
                </div>
            <?php else: ?>
                <div class="ui dropdown top right pointing item"> 
                    <i class="sign in icon"></i>
                    <?php echo __('Sign in', 'gpdealdomain'); ?>
                    <div class="menu signin_dropdown_menu">
                        <div class="ui fluid card" style="margin-bottom: 0;">
                            <div class="content">
                                <form id="login_form1"  method="POST" class="ui form" action="<?php echo wp_make_link_relative(get_permalink(get_page_by_path(__('log-in', 'gpdealdomain')))); ?>" style="margin-bottom: 1em" autocomplete="off">
                                    <!--<p style="font-size: 12px"><span style="color: red;">*</span> Informations obligatoires</p>-->
                                    <div class="field">
                                        <label><?php _e('Email or username', 'gpdealdomain'); ?> <span style="color: red;">*</span></label>
                                        <div class="ui input left icon">
                                            <i class="user icon"></i>
                                            <input type="text" name="_username" placeholder="<?php _e('Email or username', 'gpdealdomain'); ?>">
                                        </div>
                                    </div>
                                    <div class="field">
                                        <label><?php _e('Password', 'gpdealdomain') ?> <span style="color: red;">*</span></label>
                                        <div class="ui input left icon">
                                            <i class="lock icon"></i>
                                            <input type="password" name="_password" placeholder="<?php _e('Password', 'gpdealdomain') ?>">
                                        </div>
                                    </div>
                                    <div class="inline field">
                                        <div class="ui checkbox">
                                            <input type="checkbox" name="_remember">
                                            <label><?php _e('Remember me', 'gpdealdomain') ?></label>
                                        </div>
                                    </div>
                                    <input type="hidden" name='no_redirect' value="true" >
                                    
                                    <div class="field center aligned">
                                        <button id="submit_login_form1" class="ui green fluid button submit_login_form" type="submit"><?php echo __('Sign in', 'gpdealdomain'); ?></button>
                                    </div> 
                                    <div class="field center aligned">
                                        <a href="<?php echo wp_make_link_relative(get_permalink(get_page_by_path(__('forgot-your-password', 'gpdealdomain')))); ?>" ><?php _e('Forgot your password', 'gpdealdomain') ?> ?</a>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <div class="item" style="display: none">test value</div>
                    </div>
                </div>
                <a href="<?php echo wp_make_link_relative(get_permalink(get_page_by_path(__('registration', 'gpdealdomain')))) ?>" class="item">
                    <i class="add user icon"></i><?php echo __("Sign up", 'gpdealdomain') ?>
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
                    <a href="<?php echo wp_make_link_relative(home_url('/')); ?>" class="item"><?php echo _e('Home', 'gpdealdomain') ?></a>
                    <?php if (!is_user_logged_in()): ?>       
                        <a href="<?php echo wp_make_link_relative(get_permalink(get_page_by_path(__('log-in', 'gpdealdomain')))); ?>" class="item"><?php echo __("Sign in", 'gpdealdomain') ?></a>
                        <a href="<?php echo wp_make_link_relative(get_permalink(get_page_by_path(__('registration', 'gpdealdomain')))); ?>" class="item"><?php echo __("Sign up", 'gpdealdomain') ?></a>
                    <?php else : ?>
                        <a href='<?php echo wp_make_link_relative(get_permalink(get_page_by_path(__('my-account', 'gpdealdomain')))); ?>' class="item">
                            <?php _e('My account', 'gpdealdomain') ?>                         
                        </a>
                        <a href='<?php echo wp_make_link_relative(get_permalink(get_page_by_path(__('my-account', 'gpdealdomain') . '/' . __('profile', 'gpdealdomain')))); ?>' class="item">
                            <?php _e('My profile', 'gpdealdomain') ?>                         
                        </a>
                        <a href="<?php echo esc_url(add_query_arg(array('logout' => 'true'), wp_make_link_relative(home_url('/')))) ?>" class="item">
                            <?php echo __('Sign out', 'gpdealdomain') ?>
                        </a>
                    <?php endif ?>
                </div>
            </div>

            <div class="column">
                <div class="ui link list">
                    <a  href="<?php echo wp_make_link_relative(get_permalink(get_page_by_path(__('my-account', 'gpdealdomain') . '/' . __('shipments', 'gpdealdomain') . '/' . __('write', 'gpdealdomain')))); ?>"  class="item" >
                        <?php echo __('Ship a package', 'gpdealdomain'); ?>
                    </a>
                    <a  href="<?php echo wp_make_link_relative(get_permalink(get_page_by_path(__('my-account', 'gpdealdomain') . '/' . __('transport-offers', 'gpdealdomain') . '/' . __('write', 'gpdealdomain')))); ?>"  class="item" >
                        <?php echo __('Carry a package', 'gpdealdomain'); ?>
                    </a>
                    <?php if (is_user_logged_in()): ?>
                        <a href='<?php echo wp_make_link_relative(get_permalink(get_page_by_path(__('my-account', 'gpdealdomain') . '/' . __('shipments', 'gpdealdomain')))); ?>' class="item">
                            <?php echo __('My shipments', 'gpdealdomain') ?>                         
                        </a>
                        <a href='<?php echo wp_make_link_relative(get_permalink(get_page_by_path(__('my-account', 'gpdealdomain') . '/' . __('transport-offers', 'gpdealdomain')))); ?>' class="item">
                            <?php echo __('My transport offers', 'gpdealdomain') ?>                         
                        </a>
                    <?php endif ?>
                </div>
            </div>

            <div class="column">
                <div class="ui link list">
                    <a href="<?php echo wp_make_link_relative(get_permalink(get_page_by_path(__('legal-notices', 'gpdealdomain')))); ?>" class="item"><?php echo get_page_by_path(__('legal-notices', 'gpdealdomain'))->post_title ?></a>
                    <a href="<?php echo wp_make_link_relative(get_permalink(get_page_by_path(__('terms-of-use', 'gpdealdomain')))); ?>" class="item"><?php echo get_page_by_path(__('terms-of-use', 'gpdealdomain'))->post_title ?></a>
                    <a href="<?php echo wp_make_link_relative(get_permalink(get_page_by_path(__('contact-us', 'gpdealdomain')))); ?>" class="item"><?php echo get_page_by_path(__('contact-us', 'gpdealdomain'))->post_title ?></a>
                </div>
            </div>

        </div>
    </div>
</div>