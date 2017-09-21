<?php
get_template_part('top-menu', get_post_format());
?>
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
<div id="content_account" class="ui vertical masthead  segment container">
    <!--div class="ui text container">
    </div-->
    <div class="ui stackable grid">
        <div id="left_content_account" class="four wide column">
            <?php include(locate_template('content-vertical-menu-account-page.php')); ?>
        </div>
        <div id="right_content_account" class="twelve wide stretched column">
            <div class="ui stackable grid">
                <div class="sixteen wide column">
                    <div class="ui fluid card main_right_content">
                        <div class="content">
                            <div class="header" style="text-transform: uppercase; font-weight: normal"><?php _e("My account", "gpdealdomain"); ?></div>
                        </div>
                        <div class="content">
                            <?php include(locate_template("content_success_or_faillure_message.php")); ?>
                            <div class="ui form">
                                <h4 class="ui dividing header"><?php _e("Account Information", "gpdealdomain"); ?></h4>
                                <?php if (in_array("particular", $roles)): ?>                            
                                    <div id="desktop_account_type_fields">
                                        <div class="fields">
                                            <div class="four wide field">
                                                <label><?php _e("Name", "gpdealdomain"); ?> : </label>
                                            </div>
                                            <div class="twelve wide field">
                                                <div class="ui grid">
                                                    <div class="three wide column">
                                                        <div class="ui tiny image">
                                                            <img  <?php if ($profile_picture_id): ?> src= "<?php echo wp_make_link_relative(wp_get_attachment_url($profile_picture_id)); ?>" <?php else: ?> src="<?php echo wp_make_link_relative(get_template_directory_uri()); ?>/assets/images/avatar.png"<?php endif ?>>
                                                        </div>
                                                    </div>
                                                    <div class="thirteen wide column">
                                                        <?php if ($first_name): ?>
                                                            <p style="margin-bottom: 0;">
                                                                <?php if ($first_name): ?> <span class="blue_identity"> <?php echo $first_name; ?></span> <?php endif ?><span class="blue_identity"> <?php echo $last_name; ?></span>
                                                            </p>
                                                        <?php endif ?>
                                                        <p style="margin-bottom: 0;">
                                                            <span class="span_value"> <?php echo $user_email; ?></span>
                                                        </p>
                                                        <?php if ($mobile_phone_country_code && $mobile_phone_number): ?>
                                                            <p style="margin-bottom: 0;">
                                                                <span class="span_value"> <?php echo "$mobile_phone_country_code$mobile_phone_number"; ?></span>
                                                            </p>
                                                        <?php endif ?>
                                                        <?php if ($number_street): ?>
                                                            <p >
                                                                <span class="span_value"> <?php echo $number_street; ?></span>
                                                            </p>
                                                        <?php endif ?>
                                                        <?php if (get_user_meta(get_current_user_id(), "registration-completed", true) == 2): ?>
                                                            <p>
                                                                <a href='<?php echo wp_make_link_relative(get_permalink(get_page_by_path(__('my-account', 'gpdealdomain') . '/' . __('profile', 'gpdealdomain')))); ?>'> <?php _e("View/Edit Profile", "gpdealdomain"); ?></a>
                                                            </p>
                                                        <?php else: ?>
                                                            <p>
                                                                <a href='<?php echo wp_make_link_relative(get_permalink(get_page_by_path(__('my-account', 'gpdealdomain') . '/' . __('profile', 'gpdealdomain')))); ?>'> <?php _e("Finalize Registration", "gpdealdomain"); ?></a>
                                                            </p>
                                                        <?php endif ?>
                                                        <p>
                                                            <a href="<?php echo wp_make_link_relative(get_permalink(get_page_by_path(__('change-the-password', 'gpdealdomain')))); ?>" ><?php _e('Change your password', 'gpdealdomain'); ?></a>
                                                        </p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="fields">
                                            <div class="four wide field">
                                                <span class="span_label"><?php _e("Account Type", "gpdealdomain"); ?> : </span>
                                            </div>
                                            <div class="twelve wide field">
                                                <span class="span_value"> <?php _e("Particular", "gpdealdomain") ?></span>
                                            </div>
                                        </div>
                                        <div class="fields">
                                            <div class="four wide field">
                                                <span class="span_label"><?php _e("Identity status", "gpdealdomain"); ?> :</span>
                                            </div>
                                            <div class="twelve wide field">
                                                <?php include(locate_template("content_identity_status_ui.php")); ?>
                                            </div>
                                        </div>
                                        <?php if ($identity_status == 3): ?>
                                            <div class="fields">
                                                <div class="four wide field">
                                                    <span class="span_label"><?php _e("Card Identity Number", "gpdealdomain"); ?> :</span>
                                                </div>
                                                <div class="twelve wide field">
                                                    <span class="span_value"> <?php echo $card_identity_number ?></span>
                                                </div>
                                            </div>
                                        <?php endif ?>
                                    </div>
                                    <div id="mobile_account_type_fields" class="hidden">
                                        <div class="fields">
                                            <div class="twelve wide field">
                                                <div class="ui grid">
                                                    <div class="seven wide column">
                                                        <div class="ui tiny image">
                                                            <img  <?php if ($profile_picture_id): ?> src= "<?php echo wp_make_link_relative(wp_get_attachment_url($profile_picture_id)); ?>" <?php else: ?> src="<?php echo wp_make_link_relative(get_template_directory_uri()); ?>/assets/images/avatar.png"<?php endif ?>>
                                                        </div>
                                                    </div>
                                                    <div class="nine wide column">
                                                        <?php if ($first_name): ?>
                                                            <p style="margin-bottom: 0;">
                                                                <?php if ($first_name): ?> <span class="blue_identity"> <?php echo $first_name; ?></span> <?php endif ?><span class="blue_identity"> <?php echo $last_name; ?></span>
                                                            </p>
                                                        <?php endif ?>
                                                        <p style="margin-bottom: 0;">
                                                            <span class="span_value"> <?php echo $user_email; ?></span>
                                                        </p>
                                                        <?php if ($mobile_phone_country_code && $mobile_phone_number): ?>
                                                            <p style="margin-bottom: 0;">
                                                                <span class="span_value"> <?php echo "$mobile_phone_country_code$mobile_phone_number"; ?></span>
                                                            </p>
                                                        <?php endif ?>
                                                        <?php if ($number_street): ?>
                                                            <p >
                                                                <span class="span_value"> <?php echo $number_street; ?></span>
                                                            </p>
                                                        <?php endif ?>
                                                        <?php if (get_user_meta(get_current_user_id(), "registration-completed", true) == 2): ?>
                                                            <p>
                                                                <a href='<?php echo wp_make_link_relative(get_permalink(get_page_by_path(__('my-account', 'gpdealdomain') . '/' . __('profile', 'gpdealdomain')))); ?>'> <?php _e("View/Edit Profile", "gpdealdomain"); ?></a>
                                                            </p>
                                                        <?php else: ?>
                                                            <p>
                                                                <a href='<?php echo wp_make_link_relative(get_permalink(get_page_by_path(__('my-account', 'gpdealdomain') . '/' . __('profile', 'gpdealdomain')))); ?>'> <?php _e("Finalize Registration", "gpdealdomain"); ?></a>
                                                            </p>
                                                        <?php endif ?>
                                                        <p>
                                                            <a href="<?php echo wp_make_link_relative(get_permalink(get_page_by_path(__('change-the-password', 'gpdealdomain')))); ?>" ><?php _e('Change your password', 'gpdealdomain'); ?></a>
                                                        </p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="inline field">
                                            <span class="span_label"><?php _e("Account Type", "gpdealdomain"); ?> : </span> 
                                            <span class="span_value"> <?php _e("Particular", "gpdealdomain") ?></span>
                                        </div>
                                        <div class="inline field">
                                            <span class="span_label"><?php _e("Identity status", "gpdealdomain"); ?> :</span>
                                            <?php include(locate_template("content_identity_status_ui.php")); ?>
                                        </div>
                                        <?php if ($identity_status == 3): ?>
                                            <div class="inline field">
                                                <span class="span_label"><?php _e("Card Identity Number", "gpdealdomain"); ?> :</span>
                                                <span class="span_value"> <?php echo $card_identity_number ?></span>
                                            </div>
                                        <?php endif ?>
                                    </div>

                                <?php endif ?>
                                <?php if (in_array("professional", $roles) || in_array("enterprise", $roles)): ?>
                                    <div id="desktop_account_type_fields">
                                        <div class="fields">
                                            <div class="four wide field">
                                                <label><?php _e("Name", "gpdealdomain"); ?> : </label>
                                            </div>
                                            <div class="twelve wide field">
                                                <div class="ui grid">
                                                    <div class="three wide column">
                                                        <div class="ui tiny image">
                                                            <img  <?php if ($company_logo_id): ?> src= "<?php echo wp_make_link_relative(wp_get_attachment_url($company_logo_id)); ?>" <?php else: ?> src="<?php echo wp_make_link_relative(get_template_directory_uri()); ?>/assets/images/avatar.png"<?php endif ?>>
                                                        </div>
                                                    </div>
                                                    <div class="thirteen wide column">
                                                        <?php if ($company_name_pro): ?>
                                                            <p style="margin-bottom: 0;">
                                                                <span class="blue_identity"> <?php echo $company_name_pro; ?></span>
                                                            </p>
                                                        <?php endif ?>
                                                        <p style="margin-bottom: 0;">
                                                            <span class="span_value"> <?php echo $user_email_pro; ?></span>
                                                        </p>
                                                        <?php if ($home_phone_country_code && $home_phone_number_pro): ?>
                                                            <p style="margin-bottom: 0;">
                                                                <span class="span_value"> <?php echo "$home_phone_country_code$home_phone_number_pro"; ?></span>
                                                            </p>
                                                        <?php endif ?>
                                                        <?php if ($number_street_pro): ?>
                                                            <p>
                                                                <span class="span_value"> <?php echo $number_street_pro; ?></span>
                                                            </p>
                                                        <?php endif ?>
                                                        <?php if (get_user_meta(get_current_user_id(), "registration-completed", true) == 2): ?>
                                                            <p>
                                                                <a href='<?php echo wp_make_link_relative(get_permalink(get_page_by_path(__('my-account', 'gpdealdomain') . '/' . __('profile', 'gpdealdomain')))); ?>'> <?php _e("View/Edit Profile", "gpdealdomain"); ?></a>
                                                            </p>
                                                        <?php else: ?>
                                                            <p>
                                                                <a href='<?php echo wp_make_link_relative(get_permalink(get_page_by_path(__('my-account', 'gpdealdomain') . '/' . __('profile', 'gpdealdomain')))); ?>'> <?php _e("Finalize Registration", "gpdealdomain"); ?></a>
                                                            </p>
                                                        <?php endif ?>
                                                        <p>
                                                            <a href="<?php echo wp_make_link_relative(get_permalink(get_page_by_path(__('change-the-password', 'gpdealdomain')))); ?>" ><?php _e('Change your password', 'gpdealdomain'); ?></a>
                                                        </p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="fields">
                                            <div class="four wide field">
                                                <span class="span_label"><?php _e("Account Type", "gpdealdomain"); ?> :</span>
                                            </div>
                                            <div class="twelve wide field">
                                                <span class="span_value"> <?php _e("Professional", "gpdealdomain") ?></span>
                                            </div>
                                        </div>
                                        <div class="fields">
                                            <div class="four wide field">
                                                <span class="span_label"><?php _e("Identity status", "gpdealdomain"); ?> :</span>
                                            </div>
                                            <div class="twelve wide field">
                                                <?php include(locate_template("content_identity_status_ui.php")); ?>
                                            </div>
                                        </div>
                                        <?php if ($identity_status == 3): ?>
                                            <div class="fields">
                                                <div class="four wide field">
                                                    <span class="span_label"><?php _e("Card Identity Number", "gpdealdomain"); ?> :</span>
                                                </div>
                                                <div class="twelve wide field">
                                                    <span class="span_value"> <?php echo $card_identity_number ?></span>
                                                </div>
                                            </div>
                                        <?php endif ?>
                                    </div>
                                    <div id="mobile_account_type_fields" class="hidden">
                                        <div class="fields">
                                            <div class="thirteen wide field">
                                                <div class="ui grid">
                                                    <div class="seven wide column">
                                                        <div class="ui tiny image">
                                                            <img  <?php if ($company_logo_id): ?> src= "<?php echo wp_make_link_relative(wp_get_attachment_url($company_logo_id)); ?>" <?php else: ?> src="<?php echo wp_make_link_relative(get_template_directory_uri()); ?>/assets/images/avatar.png"<?php endif ?>>
                                                        </div>
                                                    </div>
                                                    <div class="nine wide column">
                                                        <?php if ($company_name_pro): ?>
                                                            <p style="margin-bottom: 0;">
                                                                <span class="blue_identity"> <?php echo $company_name_pro; ?></span>
                                                            </p>
                                                        <?php endif ?>
                                                        <p style="margin-bottom: 0;">
                                                            <span class="span_value"> <?php echo $user_email_pro; ?></span>
                                                        </p>
                                                        <?php if ($home_phone_country_code && $home_phone_number_pro): ?>
                                                            <p style="margin-bottom: 0;">
                                                                <span class="span_value"> <?php echo "$home_phone_country_code$home_phone_number_pro"; ?></span>
                                                            </p>
                                                        <?php endif ?>
                                                        <?php if ($number_street_pro): ?>
                                                            <p >
                                                                <span class="span_value"> <?php echo $number_street_pro; ?></span>
                                                            </p>
                                                        <?php endif ?>
                                                        <?php if (get_user_meta(get_current_user_id(), "registration-completed", true) == 2): ?>
                                                            <p>
                                                                <a href='<?php echo wp_make_link_relative(get_permalink(get_page_by_path(__('my-account', 'gpdealdomain') . '/' . __('profile', 'gpdealdomain')))); ?>'> <?php _e("View/Edit Profile", "gpdealdomain"); ?></a>
                                                            </p>
                                                        <?php else: ?>
                                                            <p>
                                                                <a href='<?php echo wp_make_link_relative(get_permalink(get_page_by_path(__('my-account', 'gpdealdomain') . '/' . __('profile', 'gpdealdomain')))); ?>'> <?php _e("Finalize Registration", "gpdealdomain"); ?></a>
                                                            </p>
                                                        <?php endif ?>
                                                        <p>
                                                            <a href="<?php echo wp_make_link_relative(get_permalink(get_page_by_path(__('change-the-password', 'gpdealdomain')))); ?>" ><?php _e('Change your password', 'gpdealdomain'); ?></a>
                                                        </p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="inline field">
                                            <span class="span_label"><?php _e("Account Type", "gpdealdomain"); ?> :</span>
                                            <span class="span_value"> <?php _e("Professional", "gpdealdomain") ?></span>
                                        </div>
                                        <div class="inline field">
                                            <span class="span_label"><?php _e("Identity status", "gpdealdomain"); ?> :</span>
                                            <?php include(locate_template("content_identity_status_ui.php")); ?>
                                        </div>

                                        <?php if ($identity_status == 3): ?>
                                            <div class="inline field">
                                                <span class="span_label"><?php _e("Card Identity Number", "gpdealdomain"); ?> :</span>
                                                <span class="span_value"> <?php echo $card_identity_number ?></span>
                                            </div>
                                        <?php endif ?>
                                    </div>
                                <?php endif ?>
                                <h4 class="ui dividing header"><?php _e("Transactions", "gpdealdomain"); ?></h4>
                                <div class="ui list">
                                    <a class="item" href="<?php echo wp_make_link_relative(get_permalink(get_page_by_path(__('my-account', 'gpdealdomain') . '/' . __('shipments', 'gpdealdomain')))); ?>"><?php _e("View my shipments", "gpdealdomain"); ?></a>
                                    <!--<a class="item" href="<?php echo wp_make_link_relative(get_permalink(get_page_by_path(__('my-account', 'gpdealdomain') . '/' . __('shipments', 'gpdealdomain') . '/' . __('write', 'gpdealdomain')))); ?>"><?php _e("Publish a shipment", "gpdealdomain"); ?></a>-->
                                    <a class="item" href='<?php echo wp_make_link_relative(get_permalink(get_page_by_path(__('my-account', 'gpdealdomain') . '/' . __('transport-offers', 'gpdealdomain')))); ?>'><?php _e("View my transport offers", "gpdealdomain"); ?></a>
                                    <!--<a class="item" href="<?php echo wp_make_link_relative(get_permalink(get_page_by_path(__('my-account', 'gpdealdomain') . '/' . __('transport-offers', 'gpdealdomain') . '/' . __('write', 'gpdealdomain')))); ?>"><?php _e("Publish a transport offer", "gpdealdomain"); ?></a>-->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php
include(locate_template('content-modal-confirmation-package.php'));
