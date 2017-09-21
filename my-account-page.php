<?php

/*
  Template Name: My Account Page
 */
//header("Cache-Control", "no-cache, no-store, must-revalidate");
session_start();
expire_session();
if (is_user_logged_in()) {
    $current_user = wp_get_current_user();
    $user_id = $current_user->ID;
//$roles = get_user_meta($user_id, 'wp_capabilities', true);
    $roles = $current_user->roles;
    $identity_status = get_user_meta($user_id, 'identity-status', true);
    $card_identity_number = get_user_meta($user_id, 'card-identity-number', true);
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
    get_header();

    include(locate_template('content-my-account-page.php'));

    get_footer();
} else {
    $_SESSION['redirect_to'] = get_the_permalink();
    wp_safe_redirect(get_permalink(get_page_by_path(__('log-in', 'gpdealdomain'))));
    exit;
}