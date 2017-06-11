<?php get_template_part('top-menu', get_post_format()); ?>
<div class="ui large borderless second-nav menu">
    <div class="ui container center aligned">
        <div class="center menu">
            <div class="item">
                <a href="<?php echo wp_make_link_relative(home_url('/')); ?>" class="section"><?php echo get_page_by_path(__('home', 'gpdealdomain'))->post_title ?></a>
                <i class="right arrow icon divider"></i>
                <div class="active section"><?php the_title(); ?></div>
            </div>
        </div>
    </div>
</div>
<div class="ui vertical masthead  segment container">
    <div class="ui signup_contenair basic segment container">
        <?php if (isset($_SESSION['success_send_password']) && $_SESSION['success_send_password'] == true): unset($_SESSION['success_send_password']); ?>
            <div id="forgot_password_response_card" class="ui fluid centered card">
            <div class="content">
                <div class="header"><?php echo __("We sent you a link", "gpdealdomain") ?></div>
                <div class="description">
                    <p style="text-align: center; margin-bottom: 2em;">
                        <?php echo __("Please check your inbox and click on the secure link", "gpdealdomain") ?>.
                    </p>
                    <div id="forgot_password_action" class="ui two column stackable grid">
                        <div class="column">
                            <form id='resend_reset_password_link_form'  method="POST" action="<?php echo wp_make_link_relative(get_permalink(get_page_by_path(__('forgot-your-password', 'gpdealdomain')))); ?>" autocomplete="off">
                                <input type="hidden" name="email" value="<?php echo $user_email ?>">
                            </form>
                            <button id="submit_resend_reset_password_link" class="ui fluid green button"><?php _e("Resend the link", "gpdealdomain"); ?></button>
                        </div>
                        <div class="column">
                            <a href="<?php echo wp_make_link_relative(get_permalink(get_page_by_path(__('forgot-your-password', 'gpdealdomain')))); ?>" class="ui fluid basic green button"><?php _e("Try different email", "gpdealdomain"); ?></a>
                        </div>
                    </div>
                </div>
                <p style="text-align: center;">
                        <?php echo __("If you don't see our email, check your spam folder", "gpdealdomain") ?>.
                    </p>
            </div>
        </div>
<!--            <div class="ui success message">
                <div class="header"><?php echo __("Password reset link sent successfully", "gpdealdomain"); ?> !</div>
                <p style="font-size: 12.8px; font-style: italic;">
                    <?php echo __("We have taken your request for password resetting", "gpdealdomain"); ?>. <?php echo __("Password reset link have been sent to the e-mail address of your account", "gpdealdomain"); ?>.
                </p>
            </div>-->
        <?php elseif (isset($_SESSION['error_send_password']) && $_SESSION['error_send_password'] == true): unset($_SESSION['error_send_password']); ?>
            <div class="ui error message">
                <div class="header"><?php echo __("Send error", "gpdealdomain"); ?> !</div>
                <p style="font-size: 12.8px; font-style: italic;">
                    <?php echo __("We could not send you your information by e-mail because an error occurred during the process", "gpdealdomain"); ?>.
                </p>
            </div>
            <div id="forgot_password_response_card" class="ui fluid centered card">
                <div class="content">
                    <div class="description">
                        <div id="forgot_password_action" class="ui two column stackable grid">
                            <div class="column">
                                <form id='resend_reset_password_link_form'  method="POST" action="<?php echo wp_make_link_relative(get_permalink(get_page_by_path(__('forgot-your-password', 'gpdealdomain')))); ?>" autocomplete="off">
                                    <input type="hidden" name="email" value="<?php echo $user_email; ?>">
                                </form>
                                <button id="submit_resend_reset_password_link" class="ui fluid green button"><?php _e("Try again", "gpdealdomain"); ?></button>
                            </div>
                            <div class="column">
                                <a href="<?php echo wp_make_link_relative(get_permalink(get_page_by_path(__('forgot-your-password', 'gpdealdomain')))); ?>" class="ui fluid basic green button"><?php _e("Try different email", "gpdealdomain"); ?></a>
                            </div>
                        </div>
                    </div>
                    <p style="text-align: center;">
                        <?php echo __("If you don't see our email, check your spam folder", "gpdealdomain") ?>.
                    </p>
                </div>
            </div>
        <?php endif ?>
    </div>
</div>

