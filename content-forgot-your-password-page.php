<?php get_template_part('top-menu', get_post_format()); ?>
<div class="ui large borderless second-nav menu">
    <div class="ui container center aligned">
        <div class="center menu">
            <div class="item">
                <a href="<?php echo wp_make_link_relative(home_url('/')) ?>" class="section"><?php echo get_page_by_path(__('home', 'gpdealdomain'))->post_title ?></a>
                <i class="right arrow icon divider"></i>
                <div class="active section"><?php the_title(); ?></div>
            </div>
        </div>
    </div>
</div>
<div class="ui vertical masthead  segment container">
    <!--div class="ui text container">
    </div-->
    <div class="ui signup_contenair basic segment container">
        <div class="ui attached message">
            <div class="header"><?php echo __("Forgot your password", 'gpdealdomain') ?> </div>
            <p class="promo_text_form"><?php echo __("Fill your email below to obtain a password reset link", 'gpdealdomain') ?>.</p>
        </div>
        <div class="ui fluid card">
            <div class="content">
                <form id='forgot_password_form'  method="POST" action="<?php echo wp_make_link_relative(get_permalink(get_page_by_path(__('forgot-your-password', 'gpdealdomain')))); ?>" class="ui form" autocomplete="off">
                    <div class="fields">
                        <div class="four wide field">
                            <label><?php echo __("E-mail address", 'gpdealdomain') ?> <span style="color:red;">*</span></label>
                        </div>
                        <div class="twelve wide field">
                            <input type="email" name="email" placeholder="<?php echo __("E-mail address", 'gpdealdomain') ?>">
                        </div>
                    </div>
                    <div class="field">
                        <div id="server_error_message" class="ui negative message" style="display:none">
                            <i class="close icon"></i>
                            <div id="server_error_content" class="header"><?php _e("Internal server error", 'gpdealdomain'); ?></div>
                        </div>
                        <div id="error_name_message" class="ui error message" style="display: none">
                            <i class="close icon"></i>
                            <div id="error_name_header" class="header"></div>
                            <ul id="error_name_list" class="list">

                            </ul>
                        </div>
                    </div>
                    <button id="submit_forgot_password" class="ui right floated green button" ><i class="send icon"></i><?php _e("Send Password Reset Link", 'gpdealdomain'); ?></button>
                </form>
            </div>
        </div>
    </div>
</div>

