<?php get_template_part('top-menu', get_post_format()); ?>
<div class="ui tiny borderless second-nav menu">
    <div class="ui container center aligned">
        <div class="center menu">
            <div class="item">
                <a href="<?php echo wp_make_link_relative(home_url('/')); ?>" class="section"><?php echo get_page_by_path(__('home', 'gpdealdomain'))->post_title ?></a>
                <i class="small right arrow icon divider"></i>
                <div class="active section"><?php the_title(); ?></div>
            </div>
        </div>
    </div>
</div>
<div class="ui vertical masthead  segment container">
    <!--div class="ui text container">
    </div-->
    <div class="ui signin_contenair basic segment container">
        <div class="ui attached message">
            <span class="header" style="text-align: center"><?php echo __("Log in", 'gpdealdomain') ?> </span>
        </div>
        <div class="ui fluid card">
            <div class="content">

                <form id="login_form2"  method="POST" class="ui form login_form" action="<?php echo wp_make_link_relative(get_permalink(get_page_by_path(__('log-in', 'gpdealdomain')))); ?>" style="margin-bottom: 1em" autocomplete="off">
                    <div class="field">
                        <label><?php _e("Email or username", "gpdealdomain"); ?> <span style="color: red;">*</span></label>
                        <div class="ui input left icon">
                            <i class="user icon"></i>
                            <input type="text" name="_username" placeholder="<?php _e("Email or username", "gpdealdomain"); ?>">
                        </div>
                    </div>
                    <div class="field">
                        <label><?php _e("Password", "gpdealdomain"); ?><span style="color: red;">*</span></label>
                        <div class="ui input left icon">
                            <i class="lock icon"></i>
                            <input type="password" name="_password" placeholder="<?php _e("Password", "gpdealdomain"); ?>">
                        </div>
                    </div>
                    
                    <?php if (isset($_SESSION['redirect_to'])): ?>
                        <input type="hidden" name='redirect_to' value="<?php echo $_SESSION['redirect_to']; //unset($_SESSION['redirect_to']); ?>" >
                    <?php endif ?>
                   <div class="inline field">
                        <div class="ui checkbox">
                            <input type="checkbox" name="_remember" value="true">
                            <label><?php _e("Remember me", "gpdealdomain"); ?></label>
                        </div>
                    </div>
                    <div class="field">
                        <div id="server_error_message2" class="ui negative message" style="display:none">
                            <i class="close icon"></i>
                            <div id="server_error_content2" class="header"><?php _e("Internal server error", "gpdealdomain"); ?></div>
                        </div>
                        <div id="error_name_message2" class="ui error message" style="display: none">
                            <i class="close icon"></i>
                            <ul id="error_name_list2" class="list">

                            </ul>
                        </div>
                    </div>
                    <div class="field center aligned">
                        <button id="submit_login_form2" class="ui green fluid button" type="submit"><?php _e("Sign in", "gpdealdomain"); ?></button>
                    </div> 
                    <div class="field center aligned">
                        <a href="<?php echo wp_make_link_relative(get_permalink(get_page_by_path(__('forgot-your-password', 'gpdealdomain')))); ?>" ><?php echo __("Forgot your password", "gpdealdomain") ?> ?</a>
                    </div>
                    <div class="field center aligned">
                        <span><?php echo __("You do not have an account", "gpdealdomain") ?> ? </span><a href="<?php echo wp_make_link_relative(get_permalink(get_page_by_path(__('registration', 'gpdealdomain')))); ?>" ><?php echo __("Sign up", "gpdealdomain") ?></a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

