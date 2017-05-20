<div id="login_modal" class="ui small modal">
    <i class="close icon"></i>
    <div class="header">
        <?php echo __("Log in", "gpdealdomain"); ?>
    </div>
    <div class="content">
        <div id='menu_grid_column_container' class="ui two column stackable relaxed equal divided height grid">
            <div class="column">
                <form id="login_form3"  method="POST" class="ui form login_form" action="<?php echo wp_make_link_relative(get_permalink(get_page_by_path(__('log-in', 'gpdealdomain')))); ?>" style="margin-bottom: 1em" autocomplete="off" onkeydown="submit_modal_login_form();">
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
                    <input type="hidden" name='no_redirect' value="true" >
                    <div class="inline field">
                        <div class="ui checkbox">
                            <input type="checkbox" name="_remember" value="true">
                            <label><?php _e("Remember me", "gpdealdomain"); ?></label>
                        </div>
                    </div>
                    <div class="field">
                        <div id="server_error_message3" class="ui negative message" style="display:none">
                            <i class="close icon"></i>
                            <div id="server_error_content3" class="header"><?php _e("Internal server error", "gpdealdomain"); ?></div>
                        </div>
                        <div id="error_name_message3" class="ui error message" style="display: none">
                            <i class="close icon"></i>
                            <ul id="error_name_list3" class="list">

                            </ul>
                        </div>
                    </div>
                    
                    <div class="field center aligned">
                        <button id="submit_login_form3" class="ui green fluid button" type="submit"><?php _e("Sign in", "gpdealdomain"); ?></button>
                    </div>
                    <div class="field" align="center">
                        <a href="<?php echo wp_make_link_relative(get_permalink(get_page_by_path(__('forgot-your-password', 'gpdealdomain')))); ?>" ><?php echo __("Forgot your password", "gpdealdomain") ?> ?</a> 
                    </div>
                </form>
            </div>
            <div class="column">
                <div class="ui form" class="column_signup_login_modal">
                    <div class="field" align="center">
                        <span><?php echo __("You do not have an account yet", "gpdealdomain") ?> ? </span>
                    </div>
                    <div class="field center aligned">
                        <a href="<?php echo wp_make_link_relative(get_permalink(get_page_by_path(__('registration', 'gpdealdomain')))); ?>" class="ui blue fluid button"><?php echo __("Sign up", "gpdealdomain") ?></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>