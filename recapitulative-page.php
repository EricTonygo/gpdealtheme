<?php

/*
  Template Name: Recapitulative Page
 */
session_start();
expire_session();
if (!is_user_logged_in()) {
    if (!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
        register_user();
    } elseif (isset($_SERVER['REQUEST_METHOD']) && $_SERVER['REQUEST_METHOD'] == 'POST') {
        $role = removeslashes(esc_attr(trim($_POST['role'])));
        $g_recaptcha_response = $_POST["g-recaptcha-response"];
        if ($role == "particular") {
            $user_login = removeslashes(esc_attr(trim($_POST['username'])));
            $user_pass = esc_attr($_POST['password']);
            $user_pass_confirm = removeslashes(esc_attr($_POST['password_confirm']));
            $user_email = removeslashes(esc_attr(trim($_POST['email'])));
            $user_email_confirm = removeslashes(esc_attr(trim($_POST['email_confirm'])));
            $first_name = removeslashes(esc_attr(trim($_POST['first_name'])));
            $last_name = removeslashes(esc_attr(trim($_POST['last_name'])));
            $birthdate = removeslashes(esc_attr(trim($_POST['birthdate'])));
            $gender = removeslashes(esc_attr(trim($_POST['gender'])));
            $number_street = removeslashes(esc_attr(trim($_POST['number_street'])));
            $complement_address = removeslashes(esc_attr(trim($_POST['complement_address'])));
            $locality = removeslashes(esc_attr(trim($_POST['locality'])));
            $mobile_phone_number = removeslashes(esc_attr(trim($_POST['mobile_phone_number'])));
            $mobile_phone_number_confirm = removeslashes(esc_attr(trim($_POST['mobile_phone_number_confirm'])));
            $test_question_ID = removeslashes(esc_attr(trim($_POST['test_question'])));
            $answer_test_question = removeslashes(esc_attr(trim($_POST['answer_test_question'])));
            $terms = removeslashes(esc_attr(trim($_POST['terms'])));
            $receive_notifications = removeslashes(esc_attr(trim($_POST['receive_notifications'])));
            //$company_attachements = $_FILES['company_attachments'];
            $profile_picture = $_FILES['profile_picture_file'];
            if (is_array($profile_picture) && $_FILES['profile_picture_file']['error']==0) {
                $profile_picture_id = upload_file($profile_picture);
            } else {
                $profile_picture_id = removeslashes(esc_attr(trim($_POST['profile_picture_id'])));
            }
            $identity_file = $_FILES['identity_file'];
            if (is_array($identity_file) && $_FILES['identity_file']['error'] ==0) {
                $identity_file_id = upload_file($identity_file);
            } else {
                $identity_file_id = removeslashes(esc_attr(trim($_POST['identity_file_id'])));
            }

            $country_region_city = getCountryRegionCityInformations($locality);
            $country = $country_region_city["country"];
            $region = $country_region_city["region"];
            $city = $country_region_city["city"];
        } elseif ($role == "professional" || $role == "enterprise") {
            $user_login_pro = removeslashes(esc_attr(trim($_POST['email_pro'])));
            $user_pass_pro = $_POST['password_pro'];
            $user_pass_confirm_pro = removeslashes(esc_attr($_POST['password_confirm_pro']));
            $user_email_pro = removeslashes(esc_attr(trim($_POST['email_pro'])));
            $user_email_confirm_pro = removeslashes(esc_attr(trim($_POST['email_confirm_pro'])));
            $civility_representative1_pro = removeslashes(esc_attr(trim($_POST['civility_representative1'])));
            $first_name_representative1_pro = removeslashes(esc_attr(trim($_POST['first_name_representative1'])));
            $last_name_representative1_pro = removeslashes(esc_attr(trim($_POST['last_name_representative1'])));
            $email_representative1_pro = removeslashes(esc_attr(trim($_POST['email_representative1'])));
            $function_representative1_pro = removeslashes(esc_attr(trim($_POST['function_representative1'])));
            $mobile_phone_number_representative1_pro = removeslashes(esc_attr(trim($_POST['mobile_phone_number_representative1'])));
            $civility_representative2_pro = removeslashes(esc_attr(trim($_POST['civility_representative2'])));
            $first_name_representative2_pro = removeslashes(esc_attr(trim($_POST['first_name_representative2'])));
            $last_name_representative2_pro = removeslashes(esc_attr(trim($_POST['last_name_representative2'])));
            $email_representative2_pro = removeslashes(esc_attr(trim($_POST['email_representative2'])));
            $function_representative2_pro = removeslashes(esc_attr(trim($_POST['function_representative2'])));
            $mobile_phone_number_representative2_pro = removeslashes(esc_attr(trim($_POST['mobile_phone_number_representative2'])));
            $company_name_pro = removeslashes(esc_attr(trim($_POST['company_name'])));
            $company_legal_form_pro = removeslashes(esc_attr(trim($_POST['company_legal_form'])));
            $company_identity_number_pro = removeslashes(esc_attr(trim($_POST['company_identity_number'])));
            $company_identity_tva_number_pro = removeslashes(esc_attr(trim($_POST['company_identity_tva_number'])));
            $number_street_pro = removeslashes(esc_attr(trim($_POST['number_street'])));
            $complement_address_pro = removeslashes(esc_attr(trim($_POST['complement_address'])));
            $locality_pro = removeslashes(esc_attr(trim($_POST['locality_pro'])));
            $postal_code_pro = removeslashes(esc_attr(trim($_POST['postal_code'])));
            $home_phone_number_pro = removeslashes(esc_attr(trim($_POST['home_phone_number'])));
            $test_question_ID_pro = removeslashes(esc_attr(trim($_POST['test_question_pro'])));
            $answer_test_question_pro = removeslashes(esc_attr(trim($_POST['answer_test_question_pro'])));
            $terms_pro = removeslashes(esc_attr(trim($_POST['terms'])));
            $receive_notifications_pro = removeslashes(esc_attr(trim($_POST['receive_notifications'])));
            $company_logo = $_FILES['company_logo_file'];
            if (is_array($company_logo) && $_FILES['company_logo_file']['error'] == 0) {
                $company_logo_id = upload_file($company_logo);
            } else {
                $company_logo_id = removeslashes(esc_attr(trim($_POST['company_logo_id'])));
            }
            //$company_attachements = $_FILES['company_attachments'];
            $identity_file_pro = $_FILES['identity_file_pro'];
            if (is_array($identity_file_pro) && $_FILES['identity_file_pro']['error'] == 0) {
                $identity_file_pro_id = upload_file($identity_file_pro);
            } else {
                $identity_file_pro_id = removeslashes(esc_attr(trim($_POST['identity_file_pro_id'])));
            }
            $country_region_city_pro = getCountryRegionCityInformations($locality_pro);
            $country_pro = $country_region_city_pro["country"];
            $region_pro = $country_region_city_pro["region"];
            $city_pro = $country_region_city_pro["city"];
        }
        if (isset($_POST['save_account']) && removeslashes(esc_attr($_POST['save_account'])) == 'no') {

            get_header();

            include(locate_template('content-recapitulative-page.php'));

            get_footer();
        } elseif (isset($_POST['save_account']) && removeslashes(esc_attr($_POST['save_account'])) == 'yes') {
            register_user();
            get_header();

            include(locate_template('content-recapitulative-page.php'));

            get_footer();
        }
    } else {
        wp_safe_redirect(get_permalink(get_page_by_path(__('registration', 'gpdealdomain'))));
    }
} else {
    $current_user = wp_get_current_user();
    if (!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
        update_user($current_user->ID);
    } elseif (isset($_SERVER['REQUEST_METHOD']) && $_SERVER['REQUEST_METHOD'] == 'POST') {
        $role = removeslashes(esc_attr(trim($_POST['role'])));
        $g_recaptcha_response = $_POST["g-recaptcha-response"];
        if ($role == "particular") {
            $user_login = removeslashes(esc_attr(trim($_POST['username'])));
            $user_pass = esc_attr($_POST['password']);
            $user_pass_confirm = removeslashes(esc_attr($_POST['password_confirm']));
            $user_email = removeslashes(esc_attr(trim($_POST['email'])));
            $user_email_confirm = removeslashes(esc_attr(trim($_POST['email_confirm'])));
            $first_name = removeslashes(esc_attr(trim($_POST['first_name'])));
            $last_name = removeslashes(esc_attr(trim($_POST['last_name'])));
            $birthdate = removeslashes(esc_attr(trim($_POST['birthdate'])));
            $gender = removeslashes(esc_attr(trim($_POST['gender'])));
            $number_street = removeslashes(esc_attr(trim($_POST['number_street'])));
            $complement_address = removeslashes(esc_attr(trim($_POST['complement_address'])));
            $locality = removeslashes(esc_attr(trim($_POST['locality'])));
            $mobile_phone_number = removeslashes(esc_attr(trim($_POST['mobile_phone_number'])));
            $mobile_phone_number_confirm = removeslashes(esc_attr(trim($_POST['mobile_phone_number_confirm'])));
            $test_question_ID = removeslashes(esc_attr(trim($_POST['test_question'])));
            $answer_test_question = removeslashes(esc_attr(trim($_POST['answer_test_question'])));
            $terms = removeslashes(esc_attr(trim($_POST['terms'])));
            $receive_notifications = removeslashes(esc_attr(trim($_POST['receive_notifications'])));
            //$company_attachements = $_FILES['company_attachments'];
            $profile_picture = $_FILES['profile_picture_file'];
            if (is_array($profile_picture) && $_FILES['profile_picture_file']['error']==0) {
                $profile_picture_id = upload_file($profile_picture);
            } else {
                $profile_picture_id = removeslashes(esc_attr(trim($_POST['profile_picture_id'])));
            }
            $identity_file = $_FILES['identity_file'];
            if (is_array($identity_file) && $_FILES['identity_file']['error'] ==0) {
                $identity_file_id = upload_file($identity_file);
            } else {
                $identity_file_id = removeslashes(esc_attr(trim($_POST['identity_file_id'])));
            }

            $country_region_city = getCountryRegionCityInformations($locality);
            $country = $country_region_city["country"];
            $region = $country_region_city["region"];
            $city = $country_region_city["city"];
        } elseif ($role == "professional" || $role == "enterprise") {
            $user_login_pro = removeslashes(esc_attr(trim($_POST['email_pro'])));
            $user_pass_pro = $_POST['password_pro'];
            $user_pass_confirm_pro = removeslashes(esc_attr($_POST['password_confirm_pro']));
            $user_email_pro = removeslashes(esc_attr(trim($_POST['email_pro'])));
            $user_email_confirm_pro = removeslashes(esc_attr(trim($_POST['email_confirm_pro'])));
            $civility_representative1_pro = removeslashes(esc_attr(trim($_POST['civility_representative1'])));
            $first_name_representative1_pro = removeslashes(esc_attr(trim($_POST['first_name_representative1'])));
            $last_name_representative1_pro = removeslashes(esc_attr(trim($_POST['last_name_representative1'])));
            $email_representative1_pro = removeslashes(esc_attr(trim($_POST['email_representative1'])));
            $function_representative1_pro = removeslashes(esc_attr(trim($_POST['function_representative1'])));
            $mobile_phone_number_representative1_pro = removeslashes(esc_attr(trim($_POST['mobile_phone_number_representative1'])));
            $civility_representative2_pro = removeslashes(esc_attr(trim($_POST['civility_representative2'])));
            $first_name_representative2_pro = removeslashes(esc_attr(trim($_POST['first_name_representative2'])));
            $last_name_representative2_pro = removeslashes(esc_attr(trim($_POST['last_name_representative2'])));
            $email_representative2_pro = removeslashes(esc_attr(trim($_POST['email_representative2'])));
            $function_representative2_pro = removeslashes(esc_attr(trim($_POST['function_representative2'])));
            $mobile_phone_number_representative2_pro = removeslashes(esc_attr(trim($_POST['mobile_phone_number_representative2'])));
            $company_name_pro = removeslashes(esc_attr(trim($_POST['company_name'])));
            $company_legal_form_pro = removeslashes(esc_attr(trim($_POST['company_legal_form'])));
            $company_identity_number_pro = removeslashes(esc_attr(trim($_POST['company_identity_number'])));
            $company_identity_tva_number_pro = removeslashes(esc_attr(trim($_POST['company_identity_tva_number'])));
            $number_street_pro = removeslashes(esc_attr(trim($_POST['number_street'])));
            $complement_address_pro = removeslashes(esc_attr(trim($_POST['complement_address'])));
            $locality_pro = removeslashes(esc_attr(trim($_POST['locality_pro'])));
            $postal_code_pro = removeslashes(esc_attr(trim($_POST['postal_code'])));
            $home_phone_number_pro = removeslashes(esc_attr(trim($_POST['home_phone_number'])));
            $test_question_ID_pro = removeslashes(esc_attr(trim($_POST['test_question_pro'])));
            $answer_test_question_pro = removeslashes(esc_attr(trim($_POST['answer_test_question_pro'])));
            $terms_pro = removeslashes(esc_attr(trim($_POST['terms'])));
            $receive_notifications_pro = removeslashes(esc_attr(trim($_POST['receive_notifications'])));
            $company_logo = $_FILES['company_logo_file'];
            if (is_array($company_logo) && $_FILES['company_logo_file']['error'] == 0) {
                $company_logo_id = upload_file($company_logo);
            } else {
                $company_logo_id = removeslashes(esc_attr(trim($_POST['company_logo_id'])));
            }
            //$company_attachements = $_FILES['company_attachments'];
            $identity_file_pro = $_FILES['identity_file_pro'];
            if (is_array($identity_file_pro) && $_FILES['identity_file_pro']['error'] == 0) {
                $identity_file_pro_id = upload_file($identity_file_pro);
            } else {
                $identity_file_pro_id = removeslashes(esc_attr(trim($_POST['identity_file_pro_id'])));
            }
            $country_region_city_pro = getCountryRegionCityInformations($locality_pro);
            $country_pro = $country_region_city_pro["country"];
            $region_pro = $country_region_city_pro["region"];
            $city_pro = $country_region_city_pro["city"];
        }
        if (isset($_POST['edit_account']) && removeslashes(esc_attr($_POST['edit_account'])) == 'no') {
            get_header();

            include(locate_template('content-recapitulative-page.php'));

            get_footer();
        } elseif (isset($_POST['edit_account']) && removeslashes(esc_attr($_POST['edit_account'])) == 'yes') {
            update_user($current_user->ID);
        } else {
            wp_safe_redirect(get_permalink(get_page_by_path(__('my-account', 'gpdealdomain'))));
            exit;
        }
    }
}

