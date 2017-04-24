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
    $birthdate = date('d-m-Y', strtotime(get_user_meta($user_id, 'birthdate', true)));
    $gender = get_user_meta($user_id, 'gender', true);
    $number_street = get_user_meta($user_id, 'number-street', true);
    $complement_address = get_user_meta($user_id, 'complement-address', true);
    $country = get_user_meta($user_id, 'country', true);
    $region = get_user_meta($user_id, 'region-province-state', true);
    $city = get_user_meta($user_id, 'commune-city-locality', true);
    $mobile_phone_number = get_user_meta($user_id, 'mobile-phone-number', true);
    $test_question_ID = get_user_meta($user_id, 'test-question-ID', true);
    $answer_test_question = get_user_meta($user_id, 'answer-test-question', true);
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
    $mobile_phone_number_representative1_pro = get_user_meta($user_id, 'mobile-phone-number-representative1', true);
    $civility_representative2_pro = get_user_meta($user_id, 'civility-representative2', true);
    $first_name_representative2_pro = get_user_meta($user_id, 'first-name-representative2', true);
    $last_name_representative2_pro = get_user_meta($user_id, 'last-name-representative2', true);
    $email_representative2_pro = get_user_meta($user_id, 'email-representative2', true);
    $function_representative2_pro = get_user_meta($user_id, 'company-function-representative2', true);
    $mobile_phone_number_representative2_pro = get_user_meta($user_id, 'mobile-phone-number-representative2', true);
    $company_name_pro = get_user_meta($user_id, 'company-name', true);
    $company_legal_form_pro = get_user_meta($user_id, 'company-legal-form', true);
    $company_identity_number_pro = get_user_meta($user_id, 'company-identity-number', true);
    $company_identity_tva_number_pro = get_user_meta($user_id, 'company-identity-tva-number', true);
    $number_street_pro = get_user_meta($user_id, 'number-street', true);
    $complement_address_pro = get_user_meta($user_id, 'complement-address', true);
    $country_pro = get_user_meta($user_id, 'country', true);
    $region_pro = get_user_meta($user_id, 'region-province-state', true);
    $city_pro = get_user_meta($user_id, 'commune-city-locality', true);
    $postal_code_pro = get_user_meta($user_id, 'postal-code', true);
    $home_phone_number_pro = get_user_meta($user_id, 'home-phone-number', true);
    $test_question_ID_pro = get_user_meta($user_id, 'test-question-ID', true);
    $answer_test_question_pro = get_user_meta($user_id, 'answer-test-question', true);
    $receive_notifications_pro = get_user_meta($user_id, 'receive-notifications', true);
    $company_logo_id = get_user_meta($user_id, 'company-logo-ID', true);
    $identity_file_pro_id = get_user_meta($user_id, 'identity-file-ID', true);
    $echo_locality_pro = $region_pro != "" ? $city_pro . ", " . $region_pro . ", " . $country_pro : $city_pro . ", " . $country_pro;
}
?>

<div class="ui large borderless second-nav menu">
    <div class="ui container center aligned">
        <div class="center menu">
            <div class="item">
                <a href="<?php echo home_url('/') ?>" class="section"><?php echo get_page_by_path(__('accueil', 'gpdealdomain'))->post_title ?></a>
                <i class="right chevron icon divider"></i>
                <a href="<?php echo get_permalink(get_page_by_path(__('mon-compte', 'gpdealdomain'))) ?>" class="section"><?php echo get_page_by_path(__('mon-compte', 'gpdealdomain'))->post_title ?></a>
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
        <div class="ui fluid card">
            <div class="content">
                <div id="block_form_edit" style="display: none">
                    <p class="required_infos"><span style="color: red;">*</span> Informations obligatoires</p>
                    <div class="ui top attached tabular menu">
                        <div class="item <?php if (in_array("particular", $roles)): ?> active <?php endif ?>" data-tab="first">Particulier</div>
                        <div class="item <?php if (in_array("professional", $roles) || in_array("enterprise", $roles)): ?> active <?php endif ?>" data-tab="second">Professionnel/<br class="mobile_br" style="display: none;">Entreprise</div>
                    </div>
                    <div class="ui bottom attached tab segment <?php if (in_array("particular", $roles)): ?> active <?php endif ?>" data-tab="first">
                        <form id='register_form_particular'  method="POST" action="<?php the_permalink(get_page_by_path(__('inscription', 'gpdealdomain') . '/' . __('recapitulatif-du-compte', 'gpdealdomain'))); ?>" class="ui form" autocomplete="off" enctype="multipart/form-data">

                            <input  type="hidden" name="role" value="particular" >
                            <div  class="fields">
                                <!--                                <div class="four wide field">
                                                                    <label>Photo de profil </label>
                                                                </div>-->
                                <div class="sixteen wide field center aligned">
                                    <div id="profile_picture_dimmer" class="ui tiny image">
                                        <div class="ui dimmer">
                                            <div class="content">
                                                <div class="center">
                                                    <div id="profile_picture_loader" class="ui loader content" style="display:none"></div>
                                                    <!--<div id="profile_picture_remove" class="ui red icon button"><i class="remove icon"></i></div>-->
                                                    <div id="profile_picture_edit" class="ui green basic icon button" ><i class="write icon"></i></div>
                                                </div>
                                            </div>
                                        </div>
                                        <img id="profile_picture_img" class="ui tiny image" <?php if ($profile_picture_id): ?> src= "<?php echo wp_get_attachment_url($profile_picture_id); ?>" <?php else: ?> src="<?php echo get_template_directory_uri() ?>/assets/images/avatar.png"<?php endif ?>>
                                    </div>
                                    <div style="height:0px;overflow:hidden">
                                        <input type="file" id="profile_picture_file" name="profile_picture_file" accept=".jpg,.png,.gif,.jpeg">
                                    </div>
                                </div>
                            </div>
                            <?php if ($profile_picture_id): ?>
                                <input type="hidden" name="profile_picture_id" value="<?php echo $profile_picture_id; ?>">
                            <?php endif ?>
                            <h4 class="ui dividing header">Etat civil</h4>
                            <div class="fields">
                                <div class="four wide field">
                                    <label>Civilité <span style="color:red;">*</span> </label>
                                </div>
                                <div class="twelve wide field">
                                    <div class="inline fields">
                                        <div class="field">
                                            <div class="ui radio checkbox">
                                                <input type="radio" name="gender" value="M" <?php if ($gender == "M"): ?> checked='checked' <?php endif ?>>
                                                <label>M.</label>
                                            </div>
                                        </div>
                                        <div class="field">
                                            <div class="ui radio checkbox">
                                                <input type="radio" name="gender" value="Mme" <?php if ($gender == "Mme"): ?> checked='checked' <?php endif ?>>
                                                <label>Mme</label>
                                            </div>
                                        </div>
                                        <div class="field">
                                            <div class="ui radio checkbox">
                                                <input type="radio" name="gender" value="Mlle" <?php if ($gender == "Mlle"): ?> checked='checked' <?php endif ?>>
                                                <label>Mlle</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="fields">
                                <div class="four wide field">
                                    <label>Prénom <span style="color:red;">*</span></label>
                                </div>
                                <div class="twelve wide field">
                                    <input type="text" name="first_name" placeholder="Prénom" value="<?php echo $first_name ?>">
                                </div>
                            </div>

                            <div class="fields">
                                <div class="four wide field">
                                    <label>Nom <span style="color:red;">*</span></label>
                                </div>
                                <div class="twelve wide field">
                                    <input type="text" name="last_name" placeholder="Nom" value="<?php echo $last_name ?>">
                                </div>
                            </div>

                            <div class="fields">
                                <div class="four wide field">
                                    <label>Pseudo <span style="color:red;">*</span></label>
                                </div>
                                <div class="twelve wide field">
                                    <input type="text" name="username" placeholder="Pseudo" value="<?php echo $user_login ?>">
                                </div>                        
                            </div>

                            <div class="fields">
                                <div class="four wide field">
                                    <label>Date de naissance <span style="color:red;">*</span></label>
                                    <span style="font-size: 12px; font-style: italic"><?php echo __("Il faut être majeur pour utiliser notre service", "gpdealdomain") ?></span>
                                </div>
                                <div class="twelve wide field">
                                    <div class="ui calendar" >
                                        <div class="ui input left icon">
                                            <i class="calendar icon"></i>
                                            <input id="birthdate" type="text" name='birthdate' placeholder="Date de naissance" value="<?php echo $birthdate ?>">
                                        </div>
                                    </div>
                                </div>      
                            </div>

                            <h4 class="ui dividing header">Adresse</h4>

                            <div class="fields">
                                <div class="four wide field">
                                    <label>Numéro et rue <span style="color:red;">*</span></label>
                                </div>
                                <div class="twelve wide field">
                                    <input type="text" name="number_street" placeholder="Rue et numéro de votre adresse" value="<?php echo $number_street ?>">
                                </div>
                            </div>

                            <div class="fields">
                                <div class="four wide field">
                                    <label>Complément adresse </label>
                                </div>
                                <div class="twelve wide field">
                                    <input type="text" name="complement_address" placeholder="Complément adresse" value="<?php echo $complement_address ?>">
                                </div>
                            </div>

                            <div class="fields">
                                <div class="four wide field">
                                    <label>Localité <span style="color:red;">*</span></label>
                                </div>
                                <div class="twelve wide field">
                                    <div class="ui input icon locality">
                                        <!--<i class="marker icon locality" locality_id='locality'></i>-->
                                        <i class="remove link icon locality" style="display: none;" locality_id='locality'></i>
                                        <input id="locality" type="text" class="locality" name='locality' placeholder="Votre localité" value="<?php echo $echo_locality ?>">
                                    </div>
                                </div>                        
                            </div>                            
                            <div class="fields">
                                <div class="four wide field">
                                    <label>Téléphone mobile <span style="color:red;">*</span></label>
                                </div>
                                <div class="twelve wide field">
                                    <input type="tel" name="mobile_phone_number" placeholder="Numéro de téléphone mobile" value="<?php echo $mobile_phone_number ?>">
                                </div>
                            </div>

                            <div  class="fields">
                                <div class="four wide field">
                                    <label>Confirmation téléphone mobile <span style="color:red;">*</span></label>
                                </div>
                                <div class="twelve wide field">
                                    <input type="tel" name="mobile_phone_number_confirm" placeholder="Confirmation Numéro de téléphone mobile" value="<?php echo $mobile_phone_number ?>">
                                </div>
                            </div>
                            <h4 class="ui dividing header">Informations de connexion</h4>

                            <div class="fields">
                                <div class="four wide field">
                                    <label>Adresse email <span style="color:red;">*</span></label>
                                </div>
                                <div class="twelve wide field">
                                    <input type="email" name="email" placeholder="Adresse email" value="<?php echo $user_email ?>">
                                </div>
                            </div>

                            <div class="fields">
                                <div class="four wide field">
                                    <label>Confirmation adresse email <span style="color:red;">*</span></label>
                                </div>
                                <div class="twelve wide field">
                                    <input type="email" name="email_confirm" placeholder="Confirmation de l'adresse email" value="<?php echo $user_email ?>">
                                </div>
                            </div>

                            <h4 class="ui dividing header">Informations de sécurité</h4>

                            <div class="fields">
                                <div class="four wide field">
                                    <label>Question test <span style="color:red;">*</span></label>
                                </div>
                                <div class="twelve wide field">
                                    <select name="test_question" class="ui search fluid dropdown">
                                        <option value="">Selectionner une question </option>
                                        <?php
                                        $question1s = new WP_Query(array('post_type' => 'question', 'post_per_page' => -1, "post_status" => 'publish', 'orderby' => 'post_date', 'order' => 'ASC'));
                                        if ($question1s->have_posts()) {
                                            while ($question1s->have_posts()): $question1s->the_post();
                                                ?>
                                                <?php if (get_the_ID() == $test_question_ID): ?>
                                                    <option value="<?php the_ID() ?>" selected="selected"><?php the_title() ?></option>
                                                <?php else: ?>
                                                    <option value="<?php the_ID() ?>" ><?php the_title() ?></option>
                                                <?php endif ?>
                                                <?php
                                            endwhile;
                                        }
                                        wp_reset_postdata();
                                        ?>
                                    </select>
                                </div>                        
                            </div>
                            <div class="fields">
                                <div class="four wide field">
                                    <label>Reponse à la question test <span style="color:red;">*</span></label>
                                </div>
                                <div class="twelve wide field">
                                    <input type="text" name="answer_test_question" placeholder="Reponse à la question test" value="<?php echo $answer_test_question ?>">
                                </div>                              
                            </div>

                            <div class="inline field">
                                <div class="ui checkbox">
                                    <input type="checkbox" name="receive_notifications" <?php if ($receive_notifications == 'yes'): ?> checked="checked" <?php endif ?>>
                                    <label class="label_terms_use">Je souhaite être informé(e) des produits et des services du site Global Parcel Deal. Je peux modifier ce paramètre à tout moment dans la gestion des informations de mon profil.</label>
                                </div>
                            </div>
                            <div class="fields"> 
                                <div id="identity_file_bloc" class="seven wide field ">
                                    <?php if ($identity_file_id): ?>
                                        <div id="identity_file_preview" class="ui message"><i class="close icon"></i><a  href="<?php echo wp_get_attachment_url($identity_file_id); ?>" class="header"><?php echo basename(get_attached_file($identity_file_id)); ?> </a></div>
                                        <div id="identity_file_link" class="ui green basic icon fluid button" style="display: none"><i class="attach icon"></i> Je souhaite faire verifier mon identité</div>
                                    <?php else: ?>
                                        <div id="identity_file_link" class="ui green basic icon fluid button" ><i class="attach icon"></i> Je souhaite faire verifier mon identité</div>
                                    <?php endif ?>
                                    <div style="height:0px;overflow:hidden">
                                        <input type="file" id="identity_file" name="identity_file">
                                    </div>
                                </div>
                            </div>
                            <?php if ($identity_file_id): ?>
                                <input type="hidden" name="identity_file_id"  value="<?php echo $identity_file_id; ?>">
                            <?php endif ?>

                            <?php if (in_array('particular', $roles)): ?>
                                <div class="field">
                                    <div id="server_error_message" class="ui negative message" style="display:none">
                                        <i class="close icon"></i>
                                        <div id="server_error_content" class="header">Internal server error</div>
                                    </div>
                                    <div id="error_name_message" class="ui error message" style="display: none">
                                        <i class="close icon"></i>
                                        <div id="error_name_header" class="header"></div>
                                        <ul id="error_name_list" class="list">

                                        </ul>
                                    </div>
                                </div>
                            <?php endif ?>
                            <div class="field">                                
                                <input type="hidden" name='edit_account' value='no'>
                                <button id="submit_edit_account_particular" class="ui right floated green button" type="submit">Modifier maintenant</button>
                            </div>
                        </form>
                    </div>
                    <div class="ui bottom attached tab segment <?php if (in_array("professional", $roles) || in_array("enterprise", $roles)): ?> active <?php endif ?>" data-tab="second"> 
                        <form id='register_form_enterprise' name="register" method="POST" action="<?php the_permalink(get_page_by_path(__('inscription', 'gpdealdomain') . '/' . __('recapitulatif-du-compte', 'gpdealdomain'))); ?>" class="ui form" enctype="multipart/form-data">
                            <div  class="fields">
                                
                                <div class="sixteen wide field center aligned">
                                    <div id="company_logo_dimmer" class="ui tiny image">
                                        <div class="ui dimmer">
                                            <div class="content">
                                                <div class="center">
                                                    <div id="company_logo_loader" class="ui loader content" style="display:none"></div>
                                                    <!--<div id="profile_picture_remove" class="ui red icon button"><i class="remove icon"></i></div>-->
                                                    <div id="company_logo_edit" class="ui green basic icon button" ><i class="write icon"></i></div>
                                                </div>
                                            </div>
                                        </div>
                                        <img id="company_logo_img" class="ui tiny image" <?php if ($company_logo_id): ?> src= "<?php echo wp_get_attachment_url($company_logo_id); ?>" <?php else: ?> src="<?php echo get_template_directory_uri() ?>/assets/images/default_logo.png" <?php endif ?>>
                                    </div>
                                    <div style="height:0px;overflow:hidden">
                                        <input type="file" id="company_logo_file" name="company_logo_file" accept=".jpg,.png,.gif,.jpeg">
                                    </div>
                                </div>
                            </div>
                            <?php if ($company_logo_id): ?>
                                <input type="hidden" name="company_logo_id" value="<?php echo $company_logo_id; ?>">
                            <?php endif ?>
                            <div class="fields">
                                <div class="four wide field"></div>
                                <div class="twelve wide field">
                                    <div class="inline fields">
                                        <div class="field">
                                            <div class="ui radio checkbox">
                                                <input id="checkbox_professional" type="radio" name="role" value="professional" <?php if (in_array("professional", $roles) && !in_array("enterprise", $roles)): ?> checked='checked' <?php endif ?>>
                                                <label>Professionnel</label>
                                            </div>
                                        </div>
                                        <div class="field">
                                            <div class="ui radio checkbox">
                                                <input id="checkbox_enterprise" type="radio" name="role" value="enterprise" <?php if (!in_array("professional", $roles) && in_array("enterprise", $roles)): ?> checked='checked' <?php endif ?>>
                                                <label>Entreprise</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <h4 class="ui dividing header">Informations sur l'entreprise </h4>
                            <div  class="fields">
                                <div class="four wide field">
                                    <label>Nom de la société <span style="color:red;">*</span></label>
                                </div>
                                <div class="twelve wide field">
                                    <input type="text" name="company_name" placeholder="Nom de la société" value="<?php echo $company_name_pro ?>">
                                </div>                              
                            </div>

                            <div  class="fields">
                                <div class="four wide field">
                                    <label>Forme juridique <span style="color:red;">*</span></label>
                                </div>
                                <div class="twelve wide field">
                                    <input type="text" name="company_legal_form" placeholder="Forme juridique de la société" value="<?php echo $company_legal_form_pro ?>">
                                </div>                              
                            </div>

                            <div  class="fields">
                                <div class="four wide field">
                                    <label>Numéro d'identification de la société </label>
                                </div>
                                <div class="twelve wide field">
                                    <input type="text" name="company_identity_number" placeholder="Numéro d'identification de la société" value="<?php echo $company_identity_number_pro ?>">
                                </div>
                            </div>

                            <div  class="fields">
                                <div class="four wide field">
                                    <label>Numéro individuel d'identification de la TVA </label>
                                </div>
                                <div class="twelve wide field">
                                    <input type="text" name="company_identity_tva_number" placeholder="Numéro individuel d'identification de la TVA" value="<?php echo $company_identity_tva_number_pro ?>">
                                </div>
                            </div>


                            <!--                                                        <div  class="fields">
                                                                                        <div class="four wide field">
                                                                                            <label>Pièces Jointes </label>
                                                                                        </div>
                                                                                        <div class="twelve wide field">
                                                                                            <input type="file" name="company_attachements"  multiple="multiple">
                                                                                        </div>
                                                                                    </div>-->

                            <h4 class="ui dividing header">Adresse</h4>

                            <div class="fields">
                                <div class="four wide field">
                                    <label>Numéro et rue <span style="color:red;">*</span></label>
                                </div>
                                <div class="twelve wide field">
                                    <input type="text" name="number_street" placeholder="Rue et numéro de votre adresse" value="<?php echo $number_street_pro ?>">
                                </div>
                            </div>

                            <div class="fields">
                                <div class="four wide field">
                                    <label>Complément adresse </label>
                                </div>
                                <div class="twelve wide field">
                                    <input type="text" name="complement_address" placeholder="Complément adresse" value="<?php echo $complement_address_pro ?>">
                                </div>
                            </div>

                            <div class="fields">
                                <div class="four wide field">
                                    <label>Localité <span style="color:red;">*</span></label>
                                </div>
                                <div class="twelve wide field">
                                    <div class="ui input icon locality_pro">
                                        <!--<i class="marker icon locality_pro" locality_id='locality_pro'></i>-->
                                        <i class="remove link icon locality_pro" style="display: none;" locality_id='locality_pro'></i>
                                        <input id="locality_pro" type="text" class="locality" name='locality_pro' placeholder="Votre localité" value="<?php echo $echo_locality_pro ?>">
                                    </div>
                                </div>                        
                            </div>

                            <div class="fields">
                                <div class="four wide field">
                                    <label>Code postal <span style="color:red;">*</span></label>
                                </div>
                                <div class="twelve wide field">
                                    <input type="text" name="postal_code" placeholder="Code postal" value="<?php echo $postal_code_pro ?>">
                                </div>                              
                            </div>


                            <div id="fields_home_phone_number" class="fields">
                                <div class="four wide field">
                                    <label>Téléphone fixe <span style="color:red;">*</span></label>
                                </div>
                                <div class="twelve wide field">
                                    <input type="tel" name="home_phone_number" placeholder="Numéro de téléphone fixe" value="<?php echo $home_phone_number_pro ?>">
                                </div>                        
                            </div>

                            <h4 class="ui dividing header">Représentant 1 </h4>
                            <div class="fields">
                                <div class="four wide field">
                                    <label>Civilité <span style="color:red;">*</span> </label>
                                </div>
                                <div class="twelve wide field">
                                    <div class="inline fields">
                                        <div class="field">
                                            <div class="ui radio checkbox">
                                                <input type="radio" name="civility_representative1" value="M" <?php if ($civility_representative1_pro == "M"): ?> checked='checked' <?php endif ?>>
                                                <label>M.</label>
                                            </div>
                                        </div>
                                        <div class="field">
                                            <div class="ui radio checkbox">
                                                <input type="radio" name="civility_representative1" value="Mme" <?php if ($civility_representative1_pro == "Mme"): ?> checked='checked' <?php endif ?>>
                                                <label>Mme</label>
                                            </div>
                                        </div>
                                        <div class="field">
                                            <div class="ui radio checkbox">
                                                <input type="radio" name="civility_representative1" value="Mlle" <?php if ($civility_representative1_pro == "Mlle"): ?> checked='checked' <?php endif ?>>
                                                <label>Mlle</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="fields">
                                <div class="four wide field">
                                    <label>Prénom </label>
                                </div>
                                <div class="twelve wide field">
                                    <input type="text" name="first_name_representative1" placeholder="Prénom" value="<?php echo $first_name_representative1_pro ?>">
                                </div>
                            </div>

                            <div class="fields">
                                <div class="four wide field">
                                    <label>Nom <span style="color:red;">*</span></label>
                                </div>
                                <div class="twelve wide field">
                                    <input type="text" name="last_name_representative1" placeholder="Nom" value="<?php echo $last_name_representative1_pro ?>">
                                </div>
                            </div>

                            <div class="fields">
                                <div class="four wide field">
                                    <label>Fonction dans l'entreprise <span style="color:red;">*</span></label>
                                </div>
                                <div class="twelve wide field">
                                    <input type="text" name="function_representative1" placeholder="Fonction dans l'entreprise" value="<?php echo $function_representative1_pro ?>">
                                </div>                        
                            </div>

                            <div class="fields">
                                <div class="four wide field">
                                    <label>Email professionnel <span style="color:red;">*</span></label>
                                </div>
                                <div class="twelve wide field">
                                    <input type="email" name="email_representative1" placeholder="Adresse email professionnelle" value="<?php echo $email_representative1_pro ?>">
                                </div>
                            </div>

                            <div class="fields">
                                <div class="four wide field">
                                    <label>Téléphone mobile </label>
                                </div>
                                <div class="twelve wide field">
                                    <input type="tel" name="mobile_phone_number_representative1" placeholder="Numéro de téléphone mobile" value="<?php echo $mobile_phone_number_representative1_pro ?>">
                                </div>
                            </div>

                            <h4 class="ui dividing header">Représentant 2 (Facultatif)</h4>
                            <div class="fields">
                                <div class="four wide field">
                                    <label>Civilité </label>
                                </div>
                                <div class="twelve wide field">
                                    <div class="inline fields">
                                        <div class="field">
                                            <div class="ui radio checkbox">
                                                <input type="radio" name="civility_representative1" value="M" <?php if ($civility_representative2_pro == "M"): ?> checked='checked' <?php endif ?>>
                                                <label>M.</label>
                                            </div>
                                        </div>
                                        <div class="field">
                                            <div class="ui radio checkbox">
                                                <input type="radio" name="civility_representative1" value="Mme" <?php if ($civility_representative2_pro == "Mme"): ?> checked='checked' <?php endif ?>>
                                                <label>Mme</label>
                                            </div>
                                        </div>
                                        <div class="field">
                                            <div class="ui radio checkbox">
                                                <input type="radio" name="civility_representative1" value="Mlle" <?php if ($civility_representative2_pro == "Mlle"): ?> checked='checked' <?php endif ?>>
                                                <label>Mlle</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="fields">
                                <div class="four wide field">
                                    <label>Prénom </label>
                                </div>
                                <div class="twelve wide field">
                                    <input type="text" name="first_name_representative2" placeholder="Prénom" value="<?php echo $first_name_representative2_pro ?>">
                                </div>
                            </div>

                            <div class="fields">
                                <div class="four wide field">
                                    <label>Nom </label>
                                </div>
                                <div class="twelve wide field">
                                    <input type="text" name="last_name_representative2" placeholder="Nom" value="<?php echo $last_name_representative2_pro ?>">
                                </div>
                            </div>

                            <div class="fields">
                                <div class="four wide field">
                                    <label>Fonction dans la société </label>
                                </div>
                                <div class="twelve wide field">
                                    <input type="text" name="function_representative2" placeholder="Fonction dans la société" value="<?php echo $function_representative2_pro ?>">
                                </div>                        
                            </div>

                            <div class="fields">
                                <div class="four wide field">
                                    <label>Email professionnel <span style="color:red;">*</span></label>
                                </div>
                                <div class="twelve wide field">
                                    <input type="email" name="email_representative2" placeholder="Adresse email professionnelle" value="<?php echo $email_representative2_pro ?>">
                                </div>
                            </div>

                            <div class="fields">
                                <div class="four wide field">
                                    <label>Téléphone mobile</label>
                                </div>
                                <div class="twelve wide field">
                                    <input type="tel" name="mobile_phone_number_representative2" placeholder="Numéro de téléphone mobile" value="<?php echo $mobile_phone_number_representative2_pro ?>">
                                </div>
                            </div>

                            <h4 class="ui dividing header">Informations de connexion</h4>

                            <div class="fields">
                                <div class="four wide field">
                                    <label>Email de la société <span style="color:red;">*</span></label>
                                </div>
                                <div class="twelve wide field">
                                    <input type="email" name="email_pro" placeholder="Adresse email de la société" value="<?php echo $user_email_pro ?>">
                                </div>
                            </div>

                            <div class="fields">
                                <div class="four wide field">
                                    <label>Confirmer email de la société <span style="color:red;">*</span></label>
                                </div>
                                <div class="twelve wide field">
                                    <input type="email" name="email_confirm_pro" placeholder="Adresse email" value="<?php echo $user_email_pro; ?>">
                                </div>
                            </div>

                            <h4 class="ui dividing header">Informations de sécurité</h4>

                            <div class="fields">
                                <div class="four wide field">
                                    <label>Question test <span style="color:red;">*</span></label>
                                </div>
                                <div class="twelve wide field">
                                    <select name="test_question_pro" class="ui search fluid dropdown">
                                        <option value="">Selectionner une question </option>
                                        <?php
                                        $question2s = new WP_Query(array('post_type' => 'question', 'post_per_page' => -1, "post_status" => 'publish', 'orderby' => 'post_date', 'order' => 'ASC'));
                                        if ($question2s->have_posts()) {
                                            while ($question2s->have_posts()): $question2s->the_post();
                                                ?>
                                                <?php if (get_the_ID() == $test_question_ID_pro): ?>
                                                    <option value="<?php the_ID() ?>" selected="selected"><?php the_title() ?></option>
                                                <?php else: ?>
                                                    <option value="<?php the_ID() ?>" ><?php the_title() ?></option>
                                                <?php endif ?>
                                                <?php
                                            endwhile;
                                        }
                                        wp_reset_postdata();
                                        ?>
                                    </select>
                                </div>                        
                            </div>
                            <div class="fields">
                                <div class="four wide field">
                                    <label>Reponse à la question test <span style="color:red;">*</span></label>
                                </div>
                                <div class="twelve wide field">
                                    <input type="text" name="answer_test_question_pro" placeholder="Reponse à la question test" value="<?php echo $answer_test_question_pro ?>">
                                </div>                              
                            </div>

                            <div class="inline field">
                                <div class="ui checkbox">
                                    <input type="checkbox" name="terms" <?php if ($terms_pro == 'on' || is_user_logged_in()): ?> checked="checked" <?php endif ?>> 
                                    <label class="label_terms_use"><span style="color:red;">*</span> J'ai reçu les informations sur l'inscription, les <a href="#">conditions d'utilisation</a>, les transactions et la protection des données sur ce site web.</label>
                                </div>
                            </div>

                            <div class="inline field">
                                <div class="ui checkbox">
                                    <input type="checkbox" name="receive_notifications" <?php if ($receive_notifications_pro == 'yes'): ?> checked="checked" <?php endif ?>>
                                    <label class="label_terms_use">Je souhaite être informé(e) des produits et des services du site Global Parcel Deal. Je peux modifier ce paramètre à tout moment dans la gestion des informations de mon profil.</label>
                                </div>
                            </div>
                            <div class="fields"> 
                                <div id="identity_file_pro_bloc" class="field ">
                                    <?php if ($identity_file_pro_id): ?>
                                        <div id="identity_file_pro_preview" class="ui message"><i class="close icon"></i><a  href="<?php echo wp_get_attachment_url($identity_file_pro_id); ?>" class="header"><?php echo basename(get_attached_file($identity_file_pro_id)); ?> </a></div>
                                        <div id="identity_file_pro_link" class="ui green basic icon fluid button" style="display: none"><i class="attach icon"></i> Je souhaite faire verifier mon identité</div>
                                    <?php else: ?>
                                        <div id="identity_file_pro_link" class="ui green basic icon fluid button" ><i class="attach icon"></i> Je souhaite faire verifier mon identité</div>
                                    <?php endif ?>
                                    <div style="height:0px;overflow:hidden">
                                        <input type="file" id="identity_file_pro" name="identity_file_pro">
                                    </div>
                                </div>
                            </div>
                            <?php if ($identity_file_pro_id): ?>
                                <input type="hidden" name="identity_file_pro_id"  value="<?php echo $identity_file_pro_id; ?>">
                            <?php endif ?>

                            <?php if (in_array('professional', $roles) || in_array('enterprise', $roles)): ?>
                                <div class="field">
                                    <div id="server_error_message" class="ui negative message" style="display:none">
                                        <i class="close icon"></i>
                                        <div id="server_error_content" class="header">Internal server error</div>
                                    </div>
                                    <div id="error_name_message" class="ui error message" style="display: none">
                                        <i class="close icon"></i>
                                        <div id="error_name_header" class="header"></div>
                                        <ul id="error_name_list" class="list">

                                        </ul>
                                    </div>
                                </div>
                            <?php endif ?>
                            <input type="hidden" name='edit_account' value='no'>
                            <button id="submit_edit_account_enterprise" class="ui right floated green button" type="submit">Modifier maintenant</button>
                        </form>
                    </div>
                </div>

                <div id="block_recap"> 
                    <?php if (in_array('particular', $roles)): ?>
                        <div class='ui form recap'>
                            <div  class="fields">
                                <div class="sixteen wide field center aligned">
                                    <img  class="ui tiny image" <?php if ($profile_picture_id): ?> src= "<?php echo wp_get_attachment_url($profile_picture_id); ?>" <?php else: ?> src="<?php echo get_template_directory_uri() ?>/assets/images/avatar.png"<?php endif ?>>
                                </div>
                            </div>
                            <div id="block_recap_desktop">
                                <h4 class="ui dividing header">Etat civil</h4>
                                <div class="fields">
                                    <div class="five wide field">
                                        <span class="span_label">Civilité : </span>
                                    </div>
                                    <div class="eleven wide field">
                                        <span class="span_value"> <?php echo $gender ?></span>
                                    </div>
                                </div>
                                <div class="fields">
                                    <div class="five wide field">
                                        <span class="span_label">Prénom : </span>
                                    </div>
                                    <div class="eleven wide field">
                                        <span class="span_value"> <?php echo $first_name; ?></span>
                                    </div>
                                </div>

                                <div class="fields">
                                    <div class="five wide field">
                                        <span class="span_label">Nom :</span>
                                    </div>
                                    <div class="eleven wide field">
                                        <span class="span_value"> <?php echo $last_name; ?></span>
                                    </div>
                                </div>

                                <div class="fields">
                                    <div class="five wide field">
                                        <span class="span_label">Pseudo : </span>
                                    </div>
                                    <div class="eleven wide field">
                                        <span class="span_value"><?php echo $user_login; ?></span>
                                    </div>                        
                                </div>

                                <div class="fields">
                                    <div class="five wide field">
                                        <span class="span_label">Date de naissance : </span>
                                    </div>
                                    <div class="eleven wide field">
                                        <span class="span_value"><?php echo $birthdate ?></span>
                                    </div>      
                                </div>

                                <h4 class="ui dividing header">Adresse</h4>

                                <div class="fields">
                                    <div class="five wide field">
                                        <span class="span_label">Numéro et rue : </span>
                                    </div>
                                    <div class="eleven wide field">
                                        <span class="span_value"><?php echo $number_street; ?></span>
                                    </div>
                                </div>

                                <div class="fields">
                                    <div class="five wide field">
                                        <span class="span_label">Complément adresse : </span>
                                    </div>
                                    <div class="eleven wide field">
                                        <span class="span_value"><?php echo $complement_address ?></span>
                                    </div>
                                </div>

                                <div class="fields">
                                    <div class="five wide field">
                                        <span class="span_label">Pays : </span>
                                    </div>
                                    <div class="eleven wide field">
                                        <span class="span_value"><?php echo $country ?></span>
                                    </div>                        
                                </div>

                                <div class="fields">
                                    <div class="five wide field">
                                        <span class="span_label">Region : </span>
                                    </div>
                                    <div class="eleven wide field">
                                        <span class="span_value"><?php echo $region; ?></span>
                                    </div>                    
                                </div>

                                <div class="fields">
                                    <div class="five wide field">
                                        <span class="span_label">Ville : </span>
                                    </div>
                                    <div class="eleven wide field">
                                        <span class="span_value"><?php echo $city; ?></span>
                                    </div>                    
                                </div>
                                <div class="fields">
                                    <div class="five wide field">
                                        <span class="span_label">Numéro téléphone mobile : </span>
                                    </div>
                                    <div class="eleven wide field">
                                        <span class="span_value"><?php echo $mobile_phone_number; ?></span>
                                    </div>       
                                </div>

                                <h4 class="ui dividing header">Informations de connexion</h4>

                                <div class="fields">
                                    <div class="five wide field">
                                        <span class="span_label">Email : </span>
                                    </div>
                                    <div class="eleven wide field">
                                        <span class="span_value"><?php echo $user_email; ?></span>
                                    </div> 
                                </div>

                                <div class="fields">
                                    <div class="five wide field">
                                        <span class="span_label">Mot de passe : </span>
                                    </div>
                                    <div class="eleven wide field">
                                        <span class="span_value">*********</span>
                                    </div>
                                </div>

                                <h4 class="ui dividing header">Informations de sécurité</h4>

                                <div class="fields">
                                    <div class="five wide field">
                                        <span class="span_label">Question test : </span>
                                    </div>
                                    <div class="eleven wide field">
                                        <span class="span_value"><?php
                                            $test_question = get_post((int) $test_question_ID);
                                            echo $test_question->post_title
                                            ?></span>
                                    </div>                        
                                </div>
                                <div class="fields">
                                    <div class="five wide field">
                                        <span class="span_label">Reponse à la question test : </span>
                                    </div>
                                    <div class="eleven wide field">
                                        <span class="span_value"><?php echo $answer_test_question; ?></span>
                                    </div>                              
                                </div>
                            </div>

                            <div id="block_recap_mobile" style="display: none">
                                <h4 class="ui dividing header">Etat civil</h4>
                                <div class="inline field">
                                    <span class="span_label">Civilité : </span>
                                    <span class="span_value"> <?php echo $gender ?></span>
                                </div>
                                <div class="inline field">
                                    <span class="span_label">Prénom : </span>

                                    <span class="span_value"> <?php echo $first_name; ?></span>
                                </div>

                                <div class="inline field">
                                    <span class="span_label">Nom :</span>

                                    <span class="span_value"> <?php echo $last_name; ?></span>
                                </div>

                                <div class="inline field">
                                    <span class="span_label">Pseudo : </span>

                                    <span class="span_value"><?php echo $user_login; ?></span>
                                </div>

                                <div class="inline field">
                                    <span class="span_label">Date de naissance : </span>

                                    <span class="span_value"><?php echo $birthdate ?></span>
                                </div>

                                <h4 class="ui dividing header">Adresse</h4>

                                <div class="inline field">
                                    <span class="span_label">Numéro et rue : </span>

                                    <span class="span_value"><?php echo $number_street; ?></span>
                                </div>

                                <div class="inline field">
                                    <span class="span_label">Complément adresse : </span>

                                    <span class="span_value"><?php echo $complement_address ?></span>
                                </div>

                                <div class="inline field">
                                    <span class="span_label">Pays : </span>

                                    <span class="span_value"><?php echo $country ?></span>
                                </div>

                                <div class="inline field">
                                    <span class="span_label">Region : </span>

                                    <span class="span_value"><?php echo $region; ?></span>
                                </div>

                                <div class="inline field">
                                    <span class="span_label">Ville : </span>

                                    <span class="span_value"><?php echo $city; ?></span>
                                </div>
                                <div class="inline field">
                                    <span class="span_label">Numéro téléphone mobile : </span>

                                    <span class="span_value"><?php echo $mobile_phone_number; ?></span>
                                </div>

                                <h4 class="ui dividing header">Informations de connexion</h4>

                                <div class="inline field">
                                    <span class="span_label">Email : </span>

                                    <span class="span_value"><?php echo $user_email; ?></span>
                                </div>

                                <div class="inline field">
                                    <span class="span_label">Mot de passe : </span>

                                    <span class="span_value">*********</span>
                                </div>

                                <h4 class="ui dividing header">Informations de sécurité</h4>

                                <div class="inline field">
                                    <span class="span_label">Question test : </span>

                                    <span class="span_value"><?php
                                        $test_question = get_post((int) $test_question_ID);
                                        echo $test_question->post_title
                                        ?></span>
                                </div>
                                <div class="inline field">
                                    <span class="span_label">Reponse à la question test : </span>

                                    <span class="span_value"><?php echo $answer_test_question; ?></span>
                                </div>
                            </div>

                            <div class="inline field">
                                <div class="ui disabled checkbox">
                                    <input type="checkbox" name="receive_notifications" <?php if ($receive_notifications == 'yes'): ?> checked="checked" <?php endif ?> disabled="disabled">
                                    <label class="label_terms_use">Je souhaite être informé(e) des produits et des services du site Global Parcel Deal. Je peux modifier ce paramètre à tout moment dans la gestion des informations de mon profil.</label>
                                </div>
                            </div>
                            <div class="fields">
                                <div class="sixteen wide field center aligned">
                                    <?php if ($identity_status == 0): ?> 
                                        <span ><i class="refresh large blue icon"></i> <span class="blue_identity"><?php echo getUserIdentityStatus($identity_status); ?></span></span>
                                    <?php elseif ($identity_status == 1): ?> 
                                        <span ><i class="remove large circle red icon"></i> <span class="red_identity"><?php echo getUserIdentityStatus($identity_status); ?></span></span>
                                    <?php else: ?> 
                                        <span><i class="check large circle green icon"></i> <span class="green_identity"><?php echo getUserIdentityStatus($identity_status); ?></span></span>
                                    <?php endif ?>
                                </div>
                            </div>
                            <?php if ($identity_file_id): ?>
                                <div class="fields"> 
                                    <div  class="field">
                                        <div class="ui message"><a  href="<?php echo wp_get_attachment_url($identity_file_id); ?>" class="header"><?php echo basename(get_attached_file($identity_file_id)); ?> </a></div>
                                    </div>
                                </div>
                            <?php endif ?>

                            <div class="field">
                                <button id="edit_account" class="ui right floated green icon button"  style="min-width: 12em;" ><i class="edit icon"></i> Modifier le profil</button>
                                <a  class="ui right floated green icon button"  style="min-width: 12em;" href="<?php echo get_permalink(get_page_by_path(__('mon-compte', 'gpdealdomain') . '/' . __('modifier-le-mot-de-passe', 'gpdealdomain'))); ?>"><i class="edit icon"></i> Modifier le mot de passe</a>
                            </div>
                        </div>
                    <?php elseif (in_array('professional', $roles) || in_array('enterprise', $roles)): ?>
                        <div class='ui form recap'>
                            <div  class="fields">
                                <div class="sixteen wide field center aligned">
                                    <img  class="ui tiny image" <?php if ($company_logo_id): ?> src= "<?php echo wp_get_attachment_url($company_logo_id); ?>" <?php else: ?> src="<?php echo get_template_directory_uri() ?>/assets/images/default_logo.png" <?php endif ?>>
                                </div>
                            </div>
                            <div class="fields">
                                <div class="sixteen wide field center aligned">
                                    <span><?php
                                        $role = (in_array('professional', $roles) && !in_array('enterprise', $roles)) ? "professional" : "enterprise";
                                        echo getUserRoleName($role)
                                        ?></span>
                                </div>
                            </div>

                            <div id="block_recap_desktop">
                                <h4 class="ui dividing header">Informations sur l'entreprise </h4>
                                <div  class="fields">
                                    <div class="five wide field">
                                        <span class="span_label">Nom de la société </span>
                                    </div>
                                    <div class="eleven wide field">
                                        <span class="span_value"><?php echo $company_name_pro ?></span>
                                    </div>                              
                                </div>

                                <div  class="fields">
                                    <div class="five wide field">
                                        <span class="span_label">Forme juridique </span>
                                    </div>
                                    <div class="eleven wide field">
                                        <span class="span_value"><?php echo $company_legal_form_pro ?></span>
                                    </div>                              
                                </div>

                                <div  class="fields">
                                    <div class="five wide field">
                                        <span class="span_label">Numéro d'identification de la société </span>
                                    </div>
                                    <div class="eleven wide field">
                                        <span class="span_value"><?php echo $company_identity_number_pro ?></span>
                                    </div>
                                </div>

                                <div  class="fields">
                                    <div class="five wide field">
                                        <span class="span_label">Numéro individuel d'identification de la TVA </label>
                                    </div>
                                    <div class="eleven wide field">
                                        <span class="span_value"><?php echo $company_identity_tva_number_pro ?></span>
                                    </div>
                                </div>


                                <h4 class="ui dividing header">Adresse</h4>

                                <div class="fields">
                                    <div class="five wide field">
                                        <span class="span_label">Numéro et rue </span>
                                    </div>
                                    <div class="eleven wide field">
                                        <span class="span_value"><?php echo $number_street_pro ?></span>
                                    </div>
                                </div>

                                <div class="fields">
                                    <div class="five wide field">
                                        <span class="span_label">Complément adresse : </span>
                                    </div>
                                    <div class="eleven wide field">
                                        <span class="span_value"><?php echo $complement_address_pro ?></span>
                                    </div>
                                </div>

                                <div class="fields">
                                    <div class="five wide field">
                                        <span class="span_label">Pays : </span>
                                    </div>
                                    <div class="eleven wide field">
                                        <span class="span_value"> <?php echo $country_pro ?></span>
                                    </div>                        
                                </div>

                                <div class="fields">
                                    <div class="five wide field">
                                        <span class="span_label">Region :</span>
                                    </div>
                                    <div class="twelve wide field">
                                        <span class="span_value"><?php echo $region_pro ?></span>
                                    </div>             
                                </div>

                                <div class="fields">
                                    <div class="five wide field">
                                        <span class="span_label">Ville : </span>
                                    </div>
                                    <div class="eleven wide field">
                                        <span class="span_value"><?php echo $city_pro ?></span>
                                    </div>             
                                </div>

                                <div class="fields">
                                    <div class="five wide field">
                                        <span class="span_label">Code postal : </span>
                                    </div>
                                    <div class="eleven wide field">
                                        <span class="span_value"><?php echo $postal_code_pro ?></span>
                                    </div>                              
                                </div>


                                <div id="fields_home_phone_number" class="fields">
                                    <div class="five wide field">
                                        <span class="span_label">Téléphone fixe : </span>
                                    </div>
                                    <div class="eleven wide field">
                                        <span class="span_value"><?php echo $home_phone_number_pro ?></span>
                                    </div>                        
                                </div>

                                <h4 class="ui dividing header">Représentant 1 </h4>
                                <div class="fields">
                                    <div class="five wide field">
                                        <span class="span_label">Civilité : </span>
                                    </div>
                                    <div class="eleven wide field">
                                        <span class="span_value"><?php echo $civility_representative1_pro ?></span>

                                    </div>
                                </div>
                                <div class="fields">
                                    <div class="five wide field">
                                        <span class="span_label">Prénom :</label>
                                    </div>
                                    <div class="eleven wide field">
                                        <span class="span_value"><?php echo $first_name_representative1_pro ?></span>
                                    </div>
                                </div>

                                <div class="fields">
                                    <div class="five wide field">
                                        <span class="span_label">Nom :</span>
                                    </div>
                                    <div class="eleven wide field">
                                        <span class="span_value"><?php echo $last_name_representative1_pro ?></span>
                                    </div>
                                </div>

                                <div class="fields">
                                    <div class="five wide field">
                                        <span class="span_label">Fonction dans l'entreprise : </span>
                                    </div>
                                    <div class="eleven wide field">
                                        <span class="span_value"><?php echo $function_representative1_pro ?></span>
                                    </div>                        
                                </div>

                                <div class="fields">
                                    <div class="five wide field">
                                        <span class="span_label">Email professionnel : </span>
                                    </div>
                                    <div class="eleven wide field">
                                        <span class="span_value"><?php echo $email_representative1_pro ?></span>
                                    </div>
                                </div>

                                <div class="fields">
                                    <div class="five wide field">
                                        <span class="span_label">Téléphone mobile : </span>
                                    </div>
                                    <div class="eleven wide field">
                                        <span class="span_value"><?php echo $mobile_phone_number_representative1_pro ?></span>
                                    </div>
                                </div>

                                <h4 class="ui dividing header">Représentant 2 (Facultatif)</h4>
                                <div class="fields">
                                    <div class="five wide field">
                                        <span class="span_label">Civilité :</span>
                                    </div>
                                    <div class="eleven wide field">
                                        <span class="span_value"><?php echo $civility_representative2_pro ?></span>
                                    </div>
                                </div>
                                <div class="fields">
                                    <div class="five wide field">
                                        <span class="span_label">Prénom :</span>
                                    </div>
                                    <div class="eleven wide field">
                                        <span class="span_value"><?php echo $first_name_representative2_pro ?></span>
                                    </div>
                                </div>

                                <div class="fields">
                                    <div class="five wide field">
                                        <span class="span_label">Nom :</span>
                                    </div>
                                    <div class="eleven wide field">
                                        <span class="span_value"><?php echo $last_name_representative2_pro ?></span>
                                    </div>
                                </div>

                                <div class="fields">
                                    <div class="five wide field">
                                        <span class="span_label">Fonction dans la société :</span>
                                    </div>
                                    <div class="eleven wide field">
                                        <span class="span_value"><?php echo $function_representative2_pro ?></span>
                                    </div>                        
                                </div>

                                <div class="fields">
                                    <div class="five wide field">
                                        <span class="span_label">Email professionnel :</span>
                                    </div>
                                    <div class="eleven wide field">
                                        <span class="span_value"><?php echo $email_representative2_pro ?></span>
                                    </div>
                                </div>

                                <div class="fields">
                                    <div class="five wide field">
                                        <span class="span_label">Téléphone mobile :</span>
                                    </div>
                                    <div class="eleven wide field">
                                        <span class="span_value"><?php echo $mobile_phone_number_representative2_pro ?></span>
                                    </div>
                                </div>

                                <h4 class="ui dividing header">Informations de connexion</h4>

                                <div class="fields">
                                    <div class="five wide field">
                                        <span class="span_label">Email de la société :</span>
                                    </div>
                                    <div class="eleven wide field">
                                        <span class="span_value"><?php echo $user_email_pro ?></span>
                                    </div>
                                </div>

                                <div class="fields">
                                    <div class="five wide field">
                                        <span class="span_label">Mot de passe :</span>
                                    </div>
                                    <div class="eleven wide field">
                                        <span class="span_value">*******</span>
                                    </div>
                                </div>

                                <h4 class="ui dividing header">Informations de sécurité</h4>

                                <div class="fields">
                                    <div class="five wide field">
                                        <span class="span_label">Question test :</span>
                                    </div>
                                    <div class="eleven wide field">
                                        <span class="span_value"><?php
                                            $test_question = get_post((int) $test_question_ID_pro);
                                            echo $test_question->post_title
                                            ?></span>
                                    </div>                        
                                </div>
                                <div class="fields">
                                    <div class="five wide field">
                                        <span class="span_label">Reponse à la question test :</span>
                                    </div>
                                    <div class="eleven wide field">
                                        <span class="span_value"> <?php echo $answer_test_question_pro ?> </span>
                                    </div>                              
                                </div>
                            </div>
                            <div id="block_recap_mobile" style="display: none">
                                <h4 class="ui dividing header">Informations sur l'entreprise </h4>
                                <div  class="inline field">
                                    <span class="span_label">Nom de la société </span>

                                    <span class="span_value"><?php echo $company_name_pro ?></span>
                                </div>

                                <div  class="inline field">
                                    <span class="span_label">Forme juridique </span>

                                    <span class="span_value"><?php echo $company_legal_form_pro ?></span>
                                </div>

                                <div  class="inline field">
                                    <span class="span_label">Numéro d'identification de la société </span>

                                    <span class="span_value"><?php echo $company_identity_number_pro ?></span>
                                </div>

                                <div  class="inline field">
                                    <span class="span_label">Numéro individuel d'identification de la TVA </label>

                                        <span class="span_value"><?php echo $company_identity_tva_number_pro ?></span>
                                </div>

                                <h4 class="ui dividing header">Adresse</h4>

                                <div class="inline field">
                                    <span class="span_label">Numéro et rue </span>

                                    <span class="span_value"><?php echo $number_street_pro ?></span>
                                </div>

                                <div class="inline field">
                                    <span class="span_label">Complément adresse : </span>

                                    <span class="span_value"><?php echo $complement_address_pro ?></span>
                                </div>

                                <div class="inline field">
                                    <span class="span_label">Pays : </span>

                                    <span class="span_value"> <?php echo $country_pro ?></span>
                                </div>

                                <div class="inline field">
                                    <span class="span_label">Region :</span>

                                    <span class="span_value"><?php echo $region_pro ?></span>
                                </div>

                                <div class="inline field">
                                    <span class="span_label">Ville : </span>

                                    <span class="span_value"><?php echo $city_pro ?></span>
                                </div>

                                <div class="inline field">
                                    <span class="span_label">Code postal : </span>

                                    <span class="span_value"><?php echo $postal_code_pro ?></span>
                                </div>

                                <div id="fields_home_phone_number" class="inline field">
                                    <span class="span_label">Téléphone fixe : </span>

                                    <span class="span_value"><?php echo $home_phone_number_pro ?></span>
                                </div>

                                <h4 class="ui dividing header">Représentant 1 </h4>
                                <div class="inline field">
                                    <span class="span_label">Civilité : </span>

                                    <span class="span_value"><?php echo $civility_representative1_pro ?></span>
                                </div>
                                <div class="inline field">
                                    <span class="span_label">Prénom :</label>

                                        <span class="span_value"><?php echo $first_name_representative1_pro ?></span>
                                </div>

                                <div class="inline field">
                                    <span class="span_label">Nom :</span>

                                    <span class="span_value"><?php echo $last_name_representative1_pro ?></span>
                                </div>

                                <div class="inline field">
                                    <span class="span_label">Fonction dans l'entreprise : </span>

                                    <span class="span_value"><?php echo $function_representative1_pro ?></span>
                                </div>

                                <div class="inline field">
                                    <span class="span_label">Email professionnel : </span>

                                    <span class="span_value"><?php echo $email_representative1_pro ?></span>
                                </div>

                                <div class="inline field">
                                    <span class="span_label">Téléphone mobile : </span>

                                    <span class="span_value"><?php echo $mobile_phone_number_representative1_pro ?></span>
                                </div>

                                <h4 class="ui dividing header">Représentant 2 (Facultatif)</h4>
                                <div class="inline field">
                                    <span class="span_label">Civilité :</span>

                                    <span class="span_value"><?php echo $civility_representative2_pro ?></span>
                                </div>

                                <div class="inline field">
                                    <span class="span_label">Prénom :</span>

                                    <span class="span_value"><?php echo $first_name_representative2_pro ?></span>
                                </div>

                                <div class="inline field">
                                    <span class="span_label">Nom :</span>

                                    <span class="span_value"><?php echo $last_name_representative2_pro ?></span>
                                </div>

                                <div class="inline field">
                                    <span class="span_label">Fonction dans la société :</span>

                                    <span class="span_value"><?php echo $function_representative2_pro ?></span>
                                </div>

                                <div class="inline field">
                                    <span class="span_label">Email professionnel :</span>

                                    <span class="span_value"><?php echo $email_representative2_pro ?></span>
                                </div>

                                <div class="inline field">
                                    <span class="span_label">Téléphone mobile :</span>

                                    <span class="span_value"><?php echo $mobile_phone_number_representative2_pro ?></span>
                                </div>

                                <h4 class="ui dividing header">Informations de connexion</h4>

                                <div class="inline field">
                                    <span class="span_label">Email de la société :</span>

                                    <span class="span_value"><?php echo $user_email_pro ?></span>
                                </div>

                                <div class="inline field">
                                    <span class="span_label">Mot de passe :</span>

                                    <span class="span_value">*******</span>
                                </div>

                                <h4 class="ui dividing header">Informations de sécurité</h4>

                                <div class="inline field">
                                    <span class="span_label">Question test :</span>

                                    <span class="span_value"><?php
                                        $test_question = get_post((int) $test_question_ID_pro);
                                        echo $test_question->post_title
                                        ?></span>
                                </div>
                                <div class="inline field">
                                    <span class="span_label">Reponse à la question test :</span>

                                    <span class="span_value"> <?php echo $answer_test_question_pro ?> </span>
                                </div>
                            </div>
                            <div class="inline field">
                                <div class="ui disabled checkbox">
                                    <input type="checkbox" name="receive_notifications" <?php if ($receive_notifications_pro == 'yes'): ?> checked="checked" <?php endif ?> disabled="disabled">
                                    <label class="label_terms_use">Je souhaite être informé(e) des produits et des services du site Global Parcel Deal. Je peux modifier ce paramètre à tout moment dans la gestion des informations de mon profil.</label>
                                </div>
                            </div>
                            <div class="fields">
                                <div class="sixteen wide field center aligned">
                                    <?php if ($identity_status == 0): ?> 
                                        <span ><i class="refresh large blue icon"></i> <span class="blue_identity"><?php echo getUserIdentityStatus($identity_status); ?></span></span>
                                    <?php elseif ($identity_status == 1): ?> 
                                        <span ><i class="remove large circle red icon"></i> <span class="red_identity"><?php echo getUserIdentityStatus($identity_status); ?></span></span>
                                    <?php else: ?> 
                                        <span><i class="check large circle green icon"></i> <span class="green_identity"><?php echo getUserIdentityStatus($identity_status); ?></span></span>
                                    <?php endif ?>
                                </div>
                            </div>
                            <?php if ($identity_file_pro_id): ?>
                                <div class="fields"> 
                                    <div  class="field">                                   
                                        <div class="ui message"><a  href="<?php echo wp_get_attachment_url($identity_file_pro_id); ?>" class="header"><?php echo basename(get_attached_file($identity_file_pro_id)); ?> </a></div>                                  
                                    </div>
                                </div>
                            <?php endif ?>
                            
                                <div class="field "> 
                                    <button id="edit_account" class="ui right floated green button"  style="min-width: 12em;" ><i class="edit icon"></i> Modifier</button>
                                    <a  class="ui right floated green icon button"  style="min-width: 12em;" href="<?php echo get_permalink(get_page_by_path(__('mon-compte', 'gpdealdomain') . '/' . __('modifier-le-mot-de-passe', 'gpdealdomain'))); ?>"><i class="edit icon"></i> Modifier le mot de passe</a>
                                </div>
                        </div>
                    <?php endif ?>
                </div>
            </div>
        </div>
    </div>
</div>
