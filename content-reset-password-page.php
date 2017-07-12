<?php get_template_part('top-menu', get_post_format()); ?>
<div class="ui tiny borderless second-nav menu">
    <div class="ui container center aligned">
        <div class="center menu">
            <div class="item">
                <a href="<?php echo wp_make_link_relative(home_url('/')); ?>" class="section"><?php echo get_page_by_path(__('home', 'gpdealdomain'))->post_title ?></a>
                <i class="small right chevron icon divider"></i>
                <a href="<?php echo wp_make_link_relative(get_permalink(get_page_by_path(__('my-account', 'gpdealdomain')))); ?>" class="section"><?php echo get_page_by_path(__('my-account', 'gpdealdomain'))->post_title ?></a>
                <i class="small right arrow icon divider"></i>
                <div class="active section"><?php the_title(); ?></div>
            </div>
        </div>
    </div>
</div>
<div class="ui vertical masthead  segment container">
    <!--div class="ui text container">
    </div-->
    <div class="ui signup_contenair basic segment container">
        <?php if ($reset_password_possible && $reset_password_message == ""): ?>
            <div class="ui attached message">
                <div class="header"><?php echo __("Reset your password", 'gpdealdomain') ?> </div>
                <p class="promo_text_form"><?php echo __("Fill in the information below to change your password", 'gpdealdomain') ?></p>
            </div>
            <div class="ui fluid card">
                <div class="content">
                    <form id='reset_password_form'  method="POST" action="<?php echo wp_make_link_relative(get_permalink(get_page_by_path(__('change-the-password', 'gpdealdomain')))); ?>" class="ui form" autocomplete="off">
                        <input type="hidden" name="username" value="<?php echo $user_login; ?>">
                        <div class="fields">
                            <div class="four wide field">
                                <label><?php echo __("New Password", 'gpdealdomain') ?> <span style="color:red;">*</span></label>
                            </div>
                            <div class="twelve wide field">
                                <div class="ui input right icon new_password">
                                    <i class="unhide link icon new_password" style="display: none;" input_password_id="new_password"></i>
                                    <input id='new_password' type="password" name="new_password" placeholder="<?php echo __("New Password", 'gpdealdomain') ?>" class="visible_password">
                                </div>
                            </div>
                        </div>

                        <div class="fields">
                            <div class="four wide field">
                                <label><?php echo __("Confirm New Password", 'gpdealdomain') ?> <span style="color:red;">*</span></label>
                            </div>
                            <div class="twelve wide field">
                                <div class="ui input right icon">
                                    <i class="unhide link icon confirm_new_password" style="display: none;" input_password_id="confirm_new_password"></i>
                                    <input id='confirm_new_password' type="password" name="confirm_new_password" placeholder="<?php echo __("Confirm New Password", 'gpdealdomain') ?>" class="visible_password">
                                </div>
                            </div>
                        </div>

                        <div class="field">
                            <div id="server_error_message" class="ui negative message" style="display:none">
                                <i class="close icon"></i>
                                <div id="server_error_content" class="header"><?php _e("Internal server error", "gpdealdomain"); ?></div>
                            </div>
                            <div id="error_name_message" class="ui error message" style="display: none">
                                <i class="close icon"></i>
                                <div id="error_name_header" class="header"></div>
                                <ul id="error_name_list" class="list">

                                </ul>
                            </div>
                        </div>
                        <button id="submit_reset_password" class="ui right floated green button" style="min-width: 12px"><i class="edit icon"></i><?php echo __("Edit", 'gpdealdomain') ?></button>
                    </form>
                </div>
            </div>
        <?php else: ?>
            <div class="ui error message">
                <div class="content">
                    <div class="header" style="font-weight: normal;">
                        <?php echo $reset_password_message; ?>.
                    </div>
                </div>
            </div>                       
        <?php endif ?>
    </div>
</div>

