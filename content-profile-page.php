<?php
get_template_part('top-menu', get_post_format());

$current_user = wp_get_current_user();
$user_id = $current_user->ID;
//$roles = get_user_meta($user_id, 'wp_capabilities', true);
$roles = $current_user->roles;
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
    $region_province_state = get_user_meta($user_id, 'region-province-state', true);
    $commune_city_locality = get_user_meta($user_id, 'commune-city-locality', true);
    $mobile_phone_number = get_user_meta($user_id, 'mobile-phone-number', true);
    $test_question_ID = get_user_meta($user_id, 'test-question-ID', true);
    $answer_test_question = get_user_meta($user_id, 'answer-test-question', true);
    $receive_notifications = get_user_meta($user_id, 'receive-notifications', true);
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
    $region_province_state_pro = get_user_meta($user_id, 'region-province-state', true);
    $commune_city_locality_pro = get_user_meta($user_id, 'commune-city-locality', true);
    $postal_code_pro = get_user_meta($user_id, 'postal-code', true);
    $home_phone_number_pro = get_user_meta($user_id, 'home-phone-number', true);
    $test_question_ID_pro = get_user_meta($user_id, 'test-question-ID', true);
    $answer_test_question_pro = get_user_meta($user_id, 'answer-test-question', true);
    $receive_notifications_pro = get_user_meta($user_id, 'receive-notifications', true);
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
                    <div class="ui top attached tabular menu">
                        <a class="item <?php if (in_array("particular", $roles)): ?> active <?php endif ?>" data-tab="first">Particulier</a>
                        <a class="item <?php if (in_array("professional", $roles) || in_array("enterprise", $roles)): ?> active <?php endif ?>" data-tab="second">Professionnel/Entreprise</a>
                    </div>
                    <div class="ui bottom attached tab segment <?php if (in_array("particular", $roles)): ?> active <?php endif ?>" data-tab="first">
                        <form id='register_form_particular'  method="POST" action="<?php the_permalink(get_page_by_path(__('inscription', 'gpdealdomain').'/'.__('recapitulatif-du-compte', 'gpdealdomain'))); ?>" class="ui form">

                            <input  type="hidden" name="role" value="particular" >

                            <h4 class="ui dividing header">ETAT CIVIL</h4>
                            <div class="fields">
                                <div class="four wide field">
                                    <label>Civilité <span style="color:red;">*</span> </label>
                                </div>
                                <div class="twelve wide field">
                                    <div class="inline fields">
                                        <div class="field">
                                            <div class="ui radio checkbox">
                                                <input type="radio" name="gender" value="M" <?php if ($gender == "M"): ?> checked='checked' <?php endif ?>>
                                                <label>M</label>
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
                            <h4 class="ui dividing header">ADRESSE</h4>

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
                                    <label>Pays <span style="color:red;">*</span></label>
                                </div>
                                <div class="twelve wide field">
                                    <select name="country" class="ui search fluid dropdown">
                                        <option value="">Selectionner le pays</option>
                                        <?php
                                        $countries = getCountriesList();
                                        foreach ($countries as $my_country) :
                                            ?>
                                            <?php if ($my_country['code'] == $country): ?>
                                                <option value="<?php echo $my_country['code'] ?>" selected="selected"><?php echo $my_country['name'] ?></option>
                                            <?php else: ?>
                                                <option value="<?php echo $my_country['code'] ?>" ><?php echo $my_country['name'] ?></option>
                                            <?php endif ?>
                                        <?php endforeach; ?>
                                    </select>
                                </div>                        
                            </div>

                            <div class="fields">
                                <div class="four wide field">
                                    <label>Region/Province/State <span style="color:red;">*</span></label>
                                </div>
                                <div class="twelve wide field">
                                    <select name="state_country" class="ui search fluid dropdown">
                                        <option value="">Selectionner votre région</option>
                                        <?php
                                        $states = getStatesListOfCountry();
                                        foreach ($states as $state) :
                                            ?>
                                            <?php if ($state['code'] == $region_province_state): ?>
                                                <option value="<?php echo $state['code'] ?>" selected="selected"><?php echo $state['name'] ?></option>
                                            <?php else: ?>
                                                <option value="<?php echo $state['code'] ?>" ><?php echo $state['name'] ?></option>
                                            <?php endif ?>
                                        <?php endforeach; ?>
                                    </select>
                                </div>             
                            </div>

                            <div class="fields">
                                <div class="four wide field">
                                    <label>Commune/Ville/Localité <span style="color:red;">*</span></label>
                                </div>
                                <div class="twelve wide field">
                                    <select name="city_state" class="ui search fluid dropdown">
                                        <option value="">Selectionner votre ville</option>
                                        <?php
                                        $cities = getCitiesListOfState();
                                        foreach ($cities as $city) :
                                            ?>
                                            <?php if ($city['code'] == $commune_city_locality): ?>
                                                <option value="<?php echo $city['code'] ?>" selected="selected"><?php echo $city['name'] ?></option>
                                            <?php else: ?>
                                                <option value="<?php echo $city['code'] ?>" ><?php echo $city['name'] ?></option>
                                            <?php endif ?>
                                        <?php endforeach; ?>
                                    </select>
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
                            <h4 class="ui dividing header">INFORMATIONS DE CONNEXION</h4>

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

                            <h4 class="ui dividing header">INFORMATIONS DE SECURITE</h4>

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

                            

                            <!--<div class="inline field">
                                <div class="ui checkbox">
                                    <input type="checkbox" name="terms"  checked="checked" > 
                                    <label><span style="color:red;">*</span> J'ai reçu les informations sur l'inscription, les <a href="#">conditions d'utilisation</a>, les transactions et la protection des données sur ce site web.</label>
                                </div>
                            </div>-->

                            <div class="inline field">
                                <div class="ui checkbox">
                                    <input type="checkbox" name="receive_notifications" <?php if ($receive_notifications == 'yes'): ?> checked="checked" <?php endif ?>>
                                    <label>Je souhaite être informé(e) des produits et des services du site global parcel deal susceptibles de m'intéresser. Ces informations peuvent être communiquées par email ou SMS. Je peux modifier ce paramètres à tout moment dans les paramètres de la gestion des informations du compte.</label>
                                </div>
                            </div>
<!--                            <div class="inline field">
                                <label><a href="#">Je souhaite faire verifier mon identité</a></label>
                            </div>-->

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
                        <form id='register_form_enterprise' name="register" method="POST" action="<?php the_permalink(get_page_by_path(__('inscription', 'gpdealdomain').'/'.__('recapitulatif-du-compte', 'gpdealdomain'))); ?>" class="ui form">
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
                            <h4 class="ui dividing header">INFORMATIONS SUR L'ENTREPRISE </h4>
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

<!--                            <div  class="fields">
                                <div class="four wide field">
                                    <label>Logo de l'entreprise </label>
                                </div>
                                <div class="twelve wide field">
                                    <input type="file" name="company_logo" >
                                </div>
                            </div>

                            <div  class="fields">
                                <div class="four wide field">
                                    <label>Pièces Jointes </label>
                                </div>
                                <div class="twelve wide field">
                                    <input type="file" name="company_attachements"  multiple="multiple">
                                </div>
                            </div>-->

                            <h4 class="ui dividing header">ADRESSE</h4>

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
                                    <label>Pays <span style="color:red;">*</span></label>
                                </div>
                                <div class="twelve wide field">
                                    <select name="country" class="ui search fluid dropdown">
                                        <option value="">Selectionner le pays</option>
                                        <?php
                                        $countries = getCountriesList();
                                        foreach ($countries as $my_country) :
                                            ?>
                                            <?php if ($my_country['code'] == $country_pro): ?>
                                                <option value="<?php echo $my_country['code'] ?>" selected="selected"><?php echo $my_country['name'] ?></option>
                                            <?php else: ?>
                                                <option value="<?php echo $my_country['code'] ?>" ><?php echo $my_country['name'] ?></option>
                                            <?php endif ?>
                                        <?php endforeach; ?>
                                    </select>
                                </div>                        
                            </div>

                            <div class="fields">
                                <div class="four wide field">
                                    <label>Region/Province/State <span style="color:red;">*</span></label>
                                </div>
                                <div class="twelve wide field">
                                    <select name="state_country" class="ui search fluid dropdown">
                                        <option value="">Selectionner votre région</option>
                                        <?php
                                        $states = getStatesListOfCountry();
                                        foreach ($states as $state) :
                                            ?>
                                            <?php if ($state['code'] == $region_province_state_pro): ?>
                                                <option value="<?php echo $state['code'] ?>" selected="selected"><?php echo $state['name'] ?></option>
                                            <?php else: ?>
                                                <option value="<?php echo $state['code'] ?>" ><?php echo $state['name'] ?></option>
                                            <?php endif ?>
                                        <?php endforeach; ?>
                                    </select>
                                </div>             
                            </div>

                            <div class="fields">
                                <div class="four wide field">
                                    <label>Commune/Ville/Localité <span style="color:red;">*</span></label>
                                </div>
                                <div class="twelve wide field">
                                    <select name="city_state" class="ui search fluid dropdown">
                                        <option value="">Selectionner votre ville</option>
                                        <?php
                                        $cities = getCitiesListOfState();
                                        foreach ($cities as $city) :
                                            ?>
                                            <?php if ($city['code'] == $commune_city_locality_pro): ?>
                                                <option value="<?php echo $city['code'] ?>" selected="selected"><?php echo $city['name'] ?></option>
                                            <?php else: ?>
                                                <option value="<?php echo $city['code'] ?>" ><?php echo $city['name'] ?></option>
                                            <?php endif ?>
                                        <?php endforeach; ?>
                                    </select>
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

                            <h4 class="ui dividing header">REPRESENTANT 1 </h4>
                            <div class="fields">
                                <div class="four wide field">
                                    <label>Civilité <span style="color:red;">*</span> </label>
                                </div>
                                <div class="twelve wide field">
                                    <div class="inline fields">
                                        <div class="field">
                                            <div class="ui radio checkbox">
                                                <input type="radio" name="civility_representative1" value="M" <?php if ($civility_representative1_pro == "M"): ?> checked='checked' <?php endif ?>>
                                                <label>M</label>
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
                                    <label>Adresse email professionnelle <span style="color:red;">*</span></label>
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

                            <h4 class="ui dividing header">REPRESENTANT 2 (Facultatif)</h4>
                            <div class="fields">
                                <div class="four wide field">
                                    <label>Civilité </label>
                                </div>
                                <div class="twelve wide field">
                                    <div class="inline fields">
                                        <div class="field">
                                            <div class="ui radio checkbox">
                                                <input type="radio" name="civility_representative1" value="M" <?php if ($civility_representative2_pro == "M"): ?> checked='checked' <?php endif ?>>
                                                <label>M</label>
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
                                    <label>Adresse email professionnelle <span style="color:red;">*</span></label>
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

                            <h4 class="ui dividing header">INFORMATIONS DE CONNEXION</h4>

                            <div class="fields">
                                <div class="four wide field">
                                    <label>Adresse email de la société <span style="color:red;">*</span></label>
                                </div>
                                <div class="twelve wide field">
                                    <input type="email" name="email_pro" placeholder="Adresse email de la société" value="<?php echo $user_email_pro ?>">
                                </div>
                            </div>

                            <div class="fields">
                                <div class="four wide field">
                                    <label>Confirmer adresse email de la société <span style="color:red;">*</span></label>
                                </div>
                                <div class="twelve wide field">
                                    <input type="email" name="email_confirm_pro" placeholder="Adresse email" value="<?php echo $user_email_pro; ?>">
                                </div>
                            </div>

                            <h4 class="ui dividing header">INFORMATIONS DE SECURITE</h4>

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
                                    <input type="checkbox" name="terms" <?php if ($terms_pro == 'on'|| is_user_logged_in()): ?> checked="checked" <?php endif ?>> 
                                    <label><span style="color:red;">*</span> J'ai reçu les informations sur l'inscription, les <a href="#">conditions d'utilisation</a>, les transactions et la protection des données sur ce site web.</label>
                                </div>
                            </div>

                            <div class="inline field">
                                <div class="ui checkbox">
                                    <input type="checkbox" name="receive_notifications" <?php if ($receive_notifications_pro == 'on'): ?> checked="checked" <?php endif ?>>
                                    <label>Je souhaite être informé(e) des produits et des services du site global parcel deal susceptibles de m'intéresser. Ces informations peuvent être communiquées par email ou SMS. Je peux modifier ce paramètres à tout moment dans les paramètres de la gestion des informations du compte.</label>
                                </div>
                            </div>
                            <div class="inline field">
                                <label><a href="#">Je souhaite faire verifier mon identité</a></label>
                            </div>

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
                            <h4 class="ui dividing header">ETAT CIVIL</h4>
                            <div class="fields">
                                <div class="five wide field center aligned">
                                    <label>Civilité : </label>
                                </div>
                                <div class="eleven wide field center aligned">
                                    <span> <?php echo $gender ?></span>
                                </div>
                            </div>
                            <div class="fields">
                                <div class="five wide field center aligned">
                                    <label>Prénom : </label>
                                </div>
                                <div class="eleven wide field center aligned">
                                    <span> <?php echo $first_name; ?></span>
                                </div>
                            </div>

                            <div class="fields">
                                <div class="five wide field center aligned">
                                    <label>Nom :</label>
                                </div>
                                <div class="eleven wide field center aligned">
                                    <span> <?php echo $last_name; ?></span>
                                </div>
                            </div>

                            <div class="fields">
                                <div class="five wide field center aligned">
                                    <label>Pseudo : </label>
                                </div>
                                <div class="eleven wide field center aligned">
                                    <span><?php echo $user_login; ?></span>
                                </div>                        
                            </div>

                            <div class="fields">
                                <div class="five wide field center aligned">
                                    <label>Date de naissance : </label>
                                </div>
                                <div class="eleven wide field center aligned">
                                    <span><?php echo $birthdate ?></span>
                                </div>      
                            </div>
                            <h4 class="ui dividing header">ADRESSE</h4>

                            <div class="fields">
                                <div class="five wide field center aligned">
                                    <label>Numéro et rue : </label>
                                </div>
                                <div class="eleven wide field center aligned">
                                    <span><?php echo $number_street; ?></span>
                                </div>
                            </div>

                            <div class="fields">
                                <div class="five wide field center aligned">
                                    <label>Complément adresse </label>
                                </div>
                                <div class="eleven wide field center aligned">
                                    <span><?php echo $complement_address ?></span>
                                </div>
                            </div>

                            <div class="fields">
                                <div class="five wide field center aligned">
                                    <label>Pays : </label>
                                </div>
                                <div class="eleven wide field center aligned">
                                    <span><?php echo $country ?></span>
                                </div>                        
                            </div>

                            <div class="fields">
                                <div class="five wide field center aligned">
                                    <label>Region/Province/State : </label>
                                </div>
                                <div class="eleven wide field center aligned">
                                    <span><?php echo $region_province_state; ?></span>
                                </div>                    
                            </div>

                            <div class="fields">
                                <div class="five wide field center aligned">
                                    <label>Commune/Ville/Localité : </label>
                                </div>
                                <div class="eleven wide field center aligned">
                                    <span><?php echo $commune_city_locality; ?></span>
                                </div>                    
                            </div>
                            <div class="fields">
                                <div class="five wide field center aligned">
                                    <label>Numéro téléphone mobile : </label>
                                </div>
                                <div class="eleven wide field center aligned">
                                    <span><?php echo $mobile_phone_number; ?></span>
                                </div>       
                            </div>

                            <h4 class="ui dividing header">INFORMATIONS DE CONNEXION</h4>

                            <div class="fields">
                                <div class="five wide field center aligned">
                                    <label>Adresse email : </label>
                                </div>
                                <div class="eleven wide field center aligned">
                                    <span><?php echo $user_email; ?></span>
                                </div> 
                            </div>

                            <div class="fields">
                                <div class="five wide field center aligned">
                                    <label>Mot de passe : </label>
                                </div>
                                <div class="eleven wide field center aligned">
                                    <span>*********</span>
                                </div>
                            </div>

                            <h4 class="ui dividing header">INFORMATIONS DE SECURITE</h4>

                            <div class="fields">
                                <div class="five wide field center aligned">
                                    <label>Question test : </label>
                                </div>
                                <div class="eleven wide field center aligned">
                                    <span><?php
                                        $test_question = get_post((int) $test_question_ID);
                                        echo $test_question->post_title
                                        ?></span>
                                </div>                        
                            </div>
                            <div class="fields">
                                <div class="five wide field center aligned">
                                    <label>Reponse à la question test : </label>
                                </div>
                                <div class="eleven wide field center aligned">
                                    <span><?php echo $answer_test_question; ?></span>
                                </div>                              
                            </div>

                            <!--div class="fields"-->
                            <button id="edit_account" class="ui right floated green icon button"  style="width: 12em;" ><i class="edit icon"></i> Modifier</button>
                        </div>
                    <?php elseif (in_array('professional', $roles) || in_array('enterprise', $roles)): ?>
                        <div class='ui form recap'>
                            <div class="fields">
                                <div class="wide field">
                                    <div class="inline fields">
                                        <div class="field">
                                            <div class="ui radio checkbox">
                                                <input id="checkbox_professional" type="radio" name="role" value="professional" <?php if (in_array('professional', $roles) && !in_array('enterprise', $roles)): ?> checked='checked' <?php endif ?>>
                                                <label>Professionnel</label>
                                            </div>
                                        </div>
                                        <div class="field">
                                            <div class="ui radio checkbox">
                                                <input id="checkbox_enterprise" type="radio" name="role" value="enterprise" <?php if (in_array('enterprise', $roles) && !in_array('enterprise', $roles)): ?> checked='checked' <?php endif ?>>
                                                <label>Entreprise</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <h4 class="ui dividing header">INFORMATIONS SUR L'ENTREPRISE </h4>
                            <div  class="fields">
                                <div class="five wide field center aligned">
                                    <label>Nom de la société </label>
                                </div>
                                <div class="eleven wide field center aligned">
                                    <span><?php echo $company_name_pro ?></span>
                                </div>                              
                            </div>

                            <div  class="fields">
                                <div class="five wide field center aligned">
                                    <label>Forme juridique </label>
                                </div>
                                <div class="eleven wide field center aligned">
                                    <span><?php echo $company_legal_form_pro ?></span>
                                </div>                              
                            </div>

                            <div  class="fields">
                                <div class="five wide field center aligned">
                                    <label>Numéro d'identification de la société </label>
                                </div>
                                <div class="eleven wide field center aligned">
                                    <span><?php echo $company_identity_number_pro ?></span>
                                </div>
                            </div>

                            <div  class="fields">
                                <div class="five wide field center aligned">
                                    <label>Numéro individuel d'identification de la TVA </label>
                                </div>
                                <div class="eleven wide field center aligned">
                                    <span><?php echo $company_identity_tva_number_pro ?></span>
                                </div>
                            </div>

<!--                            <div  class="fields">
                                <div class="five wide field center aligned">
                                    <label>Logo de l'entreprise </label>
                                </div>
                                <div class="eleven wide field center aligned">
                                    <input type="file" name="company_logo" >
                                </div>
                            </div>

                            <div  class="fields">
                                <div class="five wide field center aligned">
                                    <label>Pièces Jointes </label>
                                </div>
                                <div class="eleven wide field center aligned">
                                    <input type="file" name="company_attachements"  multiple="multiple">
                                </div>
                            </div>-->

                            <h4 class="ui dividing header">ADRESSE</h4>

                            <div class="fields">
                                <div class="five wide field center aligned">
                                    <label>Numéro et rue </label>
                                </div>
                                <div class="eleven wide field center aligned">
                                    <span><?php echo $number_street_pro ?></span>
                                </div>
                            </div>

                            <div class="fields">
                                <div class="five wide field center aligned">
                                    <label>Complément adresse </label>
                                </div>
                                <div class="eleven wide field center aligned">
                                    <span><?php echo $complement_address_pro ?></span>
                                </div>
                            </div>

                            <div class="fields">
                                <div class="five wide field center aligned">
                                    <label>Pays : </label>
                                </div>
                                <div class="eleven wide field center aligned">
                                    <span> <?php echo $country_pro ?></span>
                                </div>                        
                            </div>

                            <div class="fields">
                                <div class="five wide field center aligned">
                                    <label>Region/Province/State :</label>
                                </div>
                                <div class="twelve wide field center aligned">
                                    <span><?php echo $region_province_state_pro ?></span>
                                </div>             
                            </div>

                            <div class="fields">
                                <div class="five wide field center aligned">
                                    <label>Commune/Ville/Localité : </label>
                                </div>
                                <div class="eleven wide field center aligned">
                                    <span><?php echo $commune_city_locality_pro ?></span>
                                </div>             
                            </div>

                            <div class="fields">
                                <div class="five wide field center aligned">
                                    <label>Code postal : </label>
                                </div>
                                <div class="eleven wide field center aligned">
                                    <span><?php echo $postal_code_pro ?></span>
                                </div>                              
                            </div>


                            <div id="fields_home_phone_number" class="fields">
                                <div class="five wide field center aligned">
                                    <label>Téléphone fixe : </label>
                                </div>
                                <div class="eleven wide field center aligned">
                                    <span><?php echo $home_phone_number_pro ?></span>
                                </div>                        
                            </div>

                            <h4 class="ui dividing header">REPRESENTANT 1 </h4>
                            <div class="fields">
                                <div class="five wide field center aligned">
                                    <label>Civilité : </label>
                                </div>
                                <div class="eleven wide field center aligned">
                                    <div class="inline fields">
                                        <div class="field">
                                            <div class="ui radio checkbox">
                                                <input type="radio" name="civility_representative1" value="M" <?php if ($civility_representative1_pro == "M"): ?> checked='checked' <?php endif ?>>
                                                <label>M</label>
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
                                <div class="five wide field center aligned">
                                    <label>Prénom :</label>
                                </div>
                                <div class="eleven wide field center aligned">
                                    <span><?php echo $first_name_representative1_pro ?></span>
                                </div>
                            </div>

                            <div class="fields">
                                <div class="five wide field center aligned">
                                    <label>Nom :</label>
                                </div>
                                <div class="eleven wide field center aligned">
                                    <span><?php echo $last_name_representative1_pro ?></span>
                                </div>
                            </div>

                            <div class="fields">
                                <div class="five wide field center aligned">
                                    <label>Fonction dans l'entreprise : </label>
                                </div>
                                <div class="eleven wide field center aligned">
                                    <span><?php echo $function_representative1_pro ?></span>
                                </div>                        
                            </div>

                            <div class="fields">
                                <div class="five wide field center aligned">
                                    <label>Adresse email professionnelle : </label>
                                </div>
                                <div class="eleven wide field center aligned">
                                    <span><?php echo $email_representative1_pro ?></span>
                                </div>
                            </div>

                            <div class="fields">
                                <div class="five wide field center aligned">
                                    <label>Téléphone mobile : </label>
                                </div>
                                <div class="eleven wide field center aligned">
                                    <span><?php echo $mobile_phone_number_representative1_pro ?></span>
                                </div>
                            </div>

                            <h4 class="ui dividing header">REPRESENTANT 2 (Facultatif)</h4>
                            <div class="fields">
                                <div class="five wide field center aligned">
                                    <label>Civilité :</label>
                                </div>
                                <div class="eleven wide field center aligned">
                                    <div class="inline fields">
                                        <div class="field">
                                            <div class="ui radio checkbox">
                                                <input type="radio" name="civility_representative1" value="M" <?php if ($civility_representative2_pro == "M"): ?> checked='checked' <?php endif ?>>
                                                <label>M</label>
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
                                <div class="five wide field center aligned">
                                    <label>Prénom :</label>
                                </div>
                                <div class="eleven wide field center aligned">
                                    <span><?php echo $first_name_representative2_pro ?></span>
                                </div>
                            </div>

                            <div class="fields">
                                <div class="five wide field center aligned">
                                    <label>Nom :</label>
                                </div>
                                <div class="eleven wide field center aligned">
                                    <span><?php echo $last_name_representative2_pro ?></span>
                                </div>
                            </div>

                            <div class="fields">
                                <div class="five wide field center aligned">
                                    <label>Fonction dans la société :</label>
                                </div>
                                <div class="eleven wide field center aligned">
                                    <span><?php echo $function_representative2_pro ?></span>
                                </div>                        
                            </div>

                            <div class="fields">
                                <div class="five wide field center aligned">
                                    <label>Adresse email professionnelle :</label>
                                </div>
                                <div class="eleven wide field center aligned">
                                    <span><?php echo $email_representative2_pro ?></span>
                                </div>
                            </div>

                            <div class="fields">
                                <div class="five wide field center aligned">
                                    <label>Téléphone mobile :</label>
                                </div>
                                <div class="eleven wide field center aligned">
                                    <span><?php echo $mobile_phone_number_representative2_pro ?></span>
                                </div>
                            </div>

                            <h4 class="ui dividing header">INFORMATIONS DE CONNEXION</h4>

                            <div class="fields">
                                <div class="five wide field center aligned">
                                    <label>Adresse email de la société :</label>
                                </div>
                                <div class="eleven wide field center aligned">
                                    <span><?php echo $user_email_pro ?></span>
                                </div>
                            </div>

                            <div class="fields">
                                <div class="five wide field center aligned">
                                    <label>Mot de passe :</label>
                                </div>
                                <div class="eleven wide field center aligned">
                                    <span>*******</span>
                                </div>
                            </div>

                            <h4 class="ui dividing header">INFORMATIONS DE SECURITE</h4>

                            <div class="fields">
                                <div class="five wide field center aligned">
                                    <label>Question test :</label>
                                </div>
                                <div class="eleven wide field center aligned">
                                    <span><?php
                                        $test_question = get_post((int) $test_question_ID_pro);
                                        echo $test_question->post_title
                                        ?></span>
                                </div>                        
                            </div>
                            <div class="fields">
                                <div class="five wide field center aligned">
                                    <label>Reponse à la question test :</label>
                                </div>
                                <div class="eleven wide field center aligned">
                                    <span> <?php echo $answer_test_question_pro ?> </span>
                                </div>                              
                            </div>

                            <div class="inline field">
                                <div class="ui checkbox">
                                    <input type="checkbox" name="receive_notifications" <?php if ($receive_notifications_pro == 'yes'): ?> checked="checked" <?php endif ?>>
                                    <label>Je souhaite être informé(e) des produits et des services du site global parcel deal susceptibles de m'intéresser. Ces informations peuvent être communiquées par email ou SMS. Je peux modifier ce paramètres à tout moment dans les paramètres de la gestion des informations du compte.</label>
                                </div>
                            </div>
                            <button id="edit_account" class="ui right floated green icon button"  style="width: 12em;" ><i class="edit icon"></i> Modifier</button>
                        </div>
                    <?php endif ?>
                </div>
            </div>
        </div>
    </div>
