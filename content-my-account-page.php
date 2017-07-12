<?php
get_template_part('top-menu', get_post_format());

$current_user = wp_get_current_user();
$user_id = $current_user->ID;
//$roles = get_user_meta($user_id, 'wp_capabilities', true);
$roles = $current_user->roles;
$identity_status = get_user_meta($user_id, 'identity-status', true);
if (in_array("particular", $roles)) {
    $user_login = $current_user->user_login;
    //$user_pass = $current_user->user_pass;
    $user_email = $current_user->user_email;
    $first_name = $current_user->user_firstname;
    $last_name = $current_user->user_lastname;
    $gender = get_user_meta($user_id, 'gender', true);
    $postal_code = get_user_meta($user_id, 'postal-code', true);
    $number_street = get_user_meta($user_id, 'number-street', true);
    $complement_address = get_user_meta($user_id, 'complement-address', true);
    $country = get_user_meta($user_id, 'country', true);
    $region = get_user_meta($user_id, 'region-province-state', true);
    $city = get_user_meta($user_id, 'commune-city-locality', true);
    $mobile_phone_country_code = get_user_meta($user_id, 'mobile-phone-country-code', true);
    $mobile_phone_number = get_user_meta($user_id, 'mobile-phone-number', true);
    $receive_notifications = get_user_meta($user_id, 'receive-notifications', true);
    $profile_picture_id = get_user_meta($user_id, 'profile-picture-ID', true);
    $identity_file_id = get_user_meta($user_id, 'identity-file-ID', true);
    $echo_locality = $region != "" ? $city . ", " . $region . ", " . $country : $city . ", " . $country;
} elseif (in_array("enterprise", $roles) || in_array("professional", $roles)) {
    $user_login_pro = $current_user->user_login;
    //$user_pass_pro = $current_user->user_pass;
    $user_email_pro = $current_user->user_email;
    $civility_representative1_pro = get_user_meta($user_id, 'civility-representative1', true);
    $first_name_representative1_pro = get_user_meta($user_id, 'first-name-representative1', true);
    $last_name_representative1_pro = get_user_meta($user_id, 'last-name-representative1', true);
    $email_representative1_pro = get_user_meta($user_id, 'email-representative1', true);
    $function_representative1_pro = get_user_meta($user_id, 'company-function-representative1', true);
    $mobile_phone_country_code_representative1 = get_user_meta($user_id, 'mobile-phone-country-code-representative1', true);
    $mobile_phone_number_representative1_pro = get_user_meta($user_id, 'mobile-phone-number-representative1', true);
    $civility_representative2_pro = get_user_meta($user_id, 'civility-representative2', true);
    $first_name_representative2_pro = get_user_meta($user_id, 'first-name-representative2', true);
    $last_name_representative2_pro = get_user_meta($user_id, 'last-name-representative2', true);
    $email_representative2_pro = get_user_meta($user_id, 'email-representative2', true);
    $function_representative2_pro = get_user_meta($user_id, 'company-function-representative2', true);
    $mobile_phone_country_code_representative2 = get_user_meta($user_id, 'mobile-phone-country-code-representative2', true);
    $mobile_phone_number_representative2_pro = get_user_meta($user_id, 'mobile-phone-number-representative2', true);
    $company_name_pro = get_user_meta($user_id, 'company-name', true);
    $company_identity_number_pro = get_user_meta($user_id, 'company-identity-number', true);
    $company_identity_tva_number_pro = get_user_meta($user_id, 'company-identity-tva-number', true);
    $number_street_pro = get_user_meta($user_id, 'number-street', true);
    $complement_address_pro = get_user_meta($user_id, 'complement-address', true);
    $country_pro = get_user_meta($user_id, 'country', true);
    $region_pro = get_user_meta($user_id, 'region-province-state', true);
    $city_pro = get_user_meta($user_id, 'commune-city-locality', true);
    $postal_code_pro = get_user_meta($user_id, 'postal-code', true);
    $home_phone_country_code = get_user_meta($user_id, 'home-phone-country-code', true);
    $home_phone_number_pro = get_user_meta($user_id, 'home-phone-number', true);
    $receive_notifications_pro = get_user_meta($user_id, 'receive-notifications', true);
    $company_logo_id = get_user_meta($user_id, 'company-logo-ID', true);
    $identity_file_pro_id = get_user_meta($user_id, 'identity-file-ID', true);
    $echo_locality_pro = $region_pro != "" ? $city_pro . ", " . $region_pro . ", " . $country_pro : $city_pro . ", " . $country_pro;
}
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
            <?php get_template_part('content-vertical-menu-account-page', get_post_format()); ?>
        </div>
        <div id="right_content_account" class="twelve wide stretched column">
            <div class="ui stackable grid">
                <div class="sixteen wide column">
                    <div class="ui fluid card main_right_content">
                        <?php if (in_array("particular", $roles)): ?>
                            <div class="content">
                                <div class="header" style="text-transform: uppercase; font-weight: normal"><?php _e("Overview", "gpdealdomain"); ?></div>
                            </div>
                            <div class="content">
                                <div class="ui form">
                                    <h4 class="ui dividing header"><?php _e("Account Information", "gpdealdomain"); ?></h4>
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
                                                        <p >
                                                            <a href='<?php echo wp_make_link_relative(get_permalink(get_page_by_path(__('my-account', 'gpdealdomain') . '/' . __('profile', 'gpdealdomain')))); ?>'> <?php _e("View/Edit Profile", "gpdealdomain"); ?></a>
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
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="inline field">
                                            <span class="span_label"><?php _e("Account Type", "gpdealdomain"); ?> : </span> 

                                            <span class="span_value"> <?php _e("Particular", "gpdealdomain") ?></span>
                                        </div>
                                    </div>
                                    <h4 class="ui dividing header"><?php _e("Transactions", "gpdealdomain"); ?></h4>
                                    <div class="ui list">
                                        <a class="item" href="<?php echo wp_make_link_relative(get_permalink(get_page_by_path(__('my-account', 'gpdealdomain') . '/' . __('shipments', 'gpdealdomain')))); ?>"><?php _e("View my shipments", "gpdealdomain"); ?></a>
                                        <!--<a class="item" href="<?php echo wp_make_link_relative(get_permalink(get_page_by_path(__('my-account', 'gpdealdomain') . '/' . __('shipments', 'gpdealdomain') . '/' . __('write', 'gpdealdomain')))); ?>"><?php _e("Publish a shipment", "gpdealdomain"); ?></a>-->
                                        <a class="item" href='<?php echo wp_make_link_relative(get_permalink(get_page_by_path(__('my-account', 'gpdealdomain') . '/' . __('transport-offers', 'gpdealdomain')))); ?>'><?php _e("View my transport offers", "gpdealdomain"); ?></a>
                                        <!--<a class="item" href="<?php echo wp_make_link_relative(get_permalink(get_page_by_path(__('my-account', 'gpdealdomain') . '/' . __('transport-offers', 'gpdealdomain') . '/' . __('write', 'gpdealdomain')))); ?>"><?php _e("Publish a transport offer", "gpdealdomain"); ?></a>-->
                                    </div>
                                </div>
                            </div>
                        <?php endif ?>
                        <?php if (in_array("professional", $roles) || in_array("enterprise", $roles)): ?>
                            <div class="content">
                                <div class="header" style="text-transform: uppercase; font-weight: normal"><?php _e("Overview", "gpdealdomain"); ?></div>
                            </div>
                            <div class="content">
                                <div class="ui form">
                                    <h4 class="ui dividing header"><?php _e("Account Information", "gpdealdomain"); ?></h4>
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
                                                    <p >
                                                        <a href='<?php echo wp_make_link_relative(get_permalink(get_page_by_path(__('my-account', 'gpdealdomain') . '/' . __('profile', 'gpdealdomain')))); ?>'> <?php _e("View/Edit Profile", "gpdealdomain"); ?></a>
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
                                    <h4 class="ui dividing header"><?php _e("Transactions", "gpdealdomain"); ?></h4>
                                    <div class="ui list">
                                        <a class="item" href="<?php echo wp_make_link_relative(get_permalink(get_page_by_path(__('my-account', 'gpdealdomain') . '/' . __('shipments', 'gpdealdomain')))); ?>"><?php _e("View my shipments", "gpdealdomain"); ?></a>
                                        <!--<a class="item" href="<?php echo wp_make_link_relative(get_permalink(get_page_by_path(__('my-account', 'gpdealdomain') . '/' . __('shipments', 'gpdealdomain') . '/' . __('write', 'gpdealdomain')))); ?>"><?php _e("Publish a shipment", "gpdealdomain"); ?></a>-->
                                        <a class="item" href='<?php echo wp_make_link_relative(get_permalink(get_page_by_path(__('my-account', 'gpdealdomain') . '/' . __('transport-offers', 'gpdealdomain')))); ?>'><?php _e("View my transport offers", "gpdealdomain"); ?></a>
                                        <!--<a class="item" href="<?php echo wp_make_link_relative(get_permalink(get_page_by_path(__('my-account', 'gpdealdomain') . '/' . __('transport-offers', 'gpdealdomain') . '/' . __('write', 'gpdealdomain')))); ?>"><?php _e("Publish a transport offer", "gpdealdomain"); ?></a>-->
                                    </div>
                                </div>
                            </div>
                        <?php endif ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php
include(locate_template('content-modal-confirmation-package.php'));
