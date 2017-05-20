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
        <?php if(isset($_SESSION['success_send_password']) && $_SESSION['success_send_password'] == true): unset($_SESSION['success_send_password']);?>
                <div class="ui success message">
                    <div class="header"><?php echo __("Password sent successfully !", "gpdealdomain"); ?></div>
                    <p style="font-size: 12.8px; font-style: italic;">
                        <?php echo __("We have taken your request for password communication into account", "gpdealdomain"); ?>. <?php echo __("Your login credentials have been sent to you by e-mail to the e-mail address of your account", "gpdealdomain"); ?>.
                    </p>
                </div>
        <?php elseif(isset($_SESSION['error_send_password']) && $_SESSION['error_send_password'] == true): unset($_SESSION['error_send_password']);?>
            <div class="ui error message">
                    <div class="header"><?php echo __("Send error !", "gpdealdomain"); ?></div>
                    <p style="font-size: 12.8px; font-style: italic;">
                        <?php echo __("We could not send you your information by e-mail because an error occurred during the process", "gpdealdomain"); ?>.
                    </p>
                </div>
        <?php endif  ?>
       <?php echo $_SESSION['body']; ?>
    </div>
</div>

