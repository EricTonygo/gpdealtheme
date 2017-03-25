<?php get_template_part('top-menu', get_post_format()); ?>
<?php
$role = esc_attr(trim($_POST['role']));
if ($role == "particular") {
    $user_login = esc_attr(trim($_POST['username']));
    $user_pass = esc_attr($_POST['password']);
    $user_pass_confirm = esc_attr($_POST['password_confirm']);
    $user_email = esc_attr(trim($_POST['email']));
    $user_email_confirm = esc_attr(trim($_POST['email_confirm']));
    $first_name = esc_attr(trim($_POST['first_name']));
    $last_name = esc_attr(trim($_POST['last_name']));
    $birthday = esc_attr(trim($_POST['birthday']));
    $gender = esc_attr(trim($_POST['gender']));
    $number_street = esc_attr(trim($_POST['number_street']));
    $complement_address = esc_attr(trim($_POST['complement_address']));
    $country = esc_attr(trim($_POST['country']));
    $region_province_state = esc_attr(trim($_POST['state_country']));
    $commune_city_locality = esc_attr(trim($_POST['city_state']));
    $mobile_phone_number = esc_attr(trim($_POST['mobile_phone_number']));
    $mobile_phone_number_confirm = esc_attr(trim($_POST['mobile_phone_number_confirm']));
    $test_question_ID = esc_attr(trim($_POST['test_question']));
    $answer_test_question = esc_attr(trim($_POST['answer_test_question']));
    $terms = esc_attr(trim($_POST['terms']));
    $receive_notifications = esc_attr(trim($_POST['receive_notifications']));
} elseif ($role == "professional" || $role == "enterprise") {
    $user_login_pro = esc_attr(trim($_POST['email']));
    $user_pass_pro = esc_attr($_POST['password']);
    $user_pass_confirm_pro = esc_attr($_POST['password_confirm']);
    $user_email_pro = esc_attr(trim($_POST['email']));
    $user_email_confirm_pro = esc_attr(trim($_POST['email_confirm']));
    $civility_represntative1_pro = esc_attr(trim($_POST['civility_represntative1']));
    $first_name_representative1_pro = esc_attr(trim($_POST['first_name_representative1']));
    $last_name_representative1_pro = esc_attr(trim($_POST['last_name_representative1']));
    $email_representative1_pro = esc_attr(trim($_POST['email_representative1']));
    $function_representative1_pro = esc_attr(trim($_POST['function_representative1']));
    $mobile_phone_number_representative1_pro = esc_attr(trim($_POST['mobile_phone_number_representative1']));
    $civility_represntative2_pro = esc_attr(trim($_POST['civility_represntative2']));
    $first_name_representative2_pro = esc_attr(trim($_POST['first_name_representative2']));
    $last_name_representative2_pro = esc_attr(trim($_POST['last_name_representative2']));
    $email_representative2_pro = esc_attr(trim($_POST['email_representative2']));
    $function_representative2_pro = esc_attr(trim($_POST['function_representative2']));
    $mobile_phone_number_representative2_pro = esc_attr(trim($_POST['mobile_phone_number_representative2']));
    $company_name_pro = esc_attr(trim($_POST['company_name']));
    $company_legal_form_pro = esc_attr(trim($_POST['company_legal_form']));
    $company_identity_number_pro = esc_attr(trim($_POST['company_identity_number']));
    $company_identity_tva_number_pro = esc_attr(trim($_POST['company_identity_tva_number']));
    $number_street_pro = esc_attr(trim($_POST['number_street']));
    $complement_address_pro = esc_attr(trim($_POST['complement_address']));
    $country_pro = esc_attr(trim($_POST['country']));
    $region_province_state_pro = esc_attr(trim($_POST['state_country']));
    $commune_city_locality_pro = esc_attr(trim($_POST['city_state']));
    $postal_code_pro = esc_attr(trim($_POST['postal_code']));
    $home_phone_number_pro = esc_attr(trim($_POST['mobile_phone_number']));
    $test_question_ID_pro = esc_attr(trim($_POST['test_question']));
    $answer_test_question_pro = esc_attr(trim($_POST['answer_test_question']));
    $terms_pro = esc_attr(trim($_POST['terms']));
    $receive_notifications_pro = esc_attr(trim($_POST['receive_notifications']));
}
?>  
<div class="ui large borderless second-nav menu">
    <div class="ui container center aligned">
        <div class="center menu">
            <div class="item">
                <a class="section">ACCUEIL</a>
                <i class="right arrow icon divider"></i>
                <div class="active section">RECAPITULATIF INSCRIPTION NOUVEAU MEMBRE</div>
            </div>
        </div>
    </div>
</div>
<div class="ui vertical masthead  segment container">
    <!--div class="ui text container">
    </div-->
    <div class="ui singup_contenair basic segment container">
        <div class="ui fluid card">
            <div class="content">
                <div id="block_form_edit" style="display: none">  
                    <div class="ui top attached tabular menu">
                        <a class="item active" data-tab="first">Particulier</a>
                        <a class="item" data-tab="second">Professionnel/Entreprise</a>
                    </div>
                    <div class="ui bottom attached tab segment <?php if ($role == 'particular'): ?> active <?php endif ?>" data-tab="first">
                        <form id='register_form_particular'  method="POST" action="<?php the_permalink(get_page_by_path(__('recapitulatif-du-compte', 'gpdealdomain'))); ?>" class="ui form" autocomplete="off">

                            <input  type="hidden" name="role" value="particular" >

                            <h4 class="ui dividing header">ETAT CIVIL</h4>
                            <div class="fields">
                                <div class="four wide field">
                                    <label>Sexe <span style="color:red;">*</span> </label>
                                </div>
                                <div class="twelve wide field">
                                    <div class="inline fields">
                                        <div class="field">
                                            <div class="ui radio checkbox">
                                                <input type="radio" name="gender" value="M" <?php if ($gender == "M"): ?> checked='checked' <?php endif ?>>
                                                <label>Masculin</label>
                                            </div>
                                        </div>
                                        <div class="field">
                                            <div class="ui radio checkbox">
                                                <input type="radio" name="gender" value="F" <?php if ($gender == "F"): ?> checked='checked' <?php endif ?>>
                                                <label>Feminin</label>
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
                                            <input id="birthday" type="text" name='birthday' placeholder="Date de naissance" value="<?php echo $birthday ?>">
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
                                    <select name="country" class="ui fluid dropdown">
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
                                    <select name="state_country" class="ui fluid dropdown">
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
                                    <select name="city_state" class="ui fluid dropdown">
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
                                    <input type="tel" name="mobile_phone_number_confirm" placeholder="Confirmation Numéro de téléphone mobile" value="<?php echo $mobile_phone_number_confirm ?>">
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
                                    <input type="email" name="email_confirm" placeholder="Confirmation de l'adresse email" value="<?php echo $user_email_confirm ?>">
                                </div>
                            </div>

                            <div class="fields">
                                <div class="four wide field">
                                    <label>Mot de passe <span style="color:red;">*</span></label>
                                </div>
                                <div class="twelve wide field">
                                    <input type="password" name="password" placeholder="Mot de passe" value="<?php echo $user_pass ?>">
                                </div>
                            </div>

                            <div class="fields">
                                <div class="four wide field">
                                    <label>Confirmation Mot de passe <span style="color:red;">*</span></label>
                                </div>
                                <div class="twelve wide field">
                                    <input type="password" name="password_confirm" placeholder="Confirmation Mot de passe" value="<?php echo $user_pass_confirm ?>">
                                </div>
                            </div>

                            <h4 class="ui dividing header">INFORMATIONS DE SECURITE</h4>

                            <div class="fields">
                                <div class="four wide field">
                                    <label>Question test <span style="color:red;">*</span></label>
                                </div>
                                <div class="twelve wide field">
                                    <select name="test_question" class="ui fluid dropdown">
                                        <option value="">Selectionner une question </option>
                                        <?php
                                        wp_reset_postdata();
                                        query_posts(array('post_type' => 'question', 'post_per_page' => -1, "post_status" => 'publish'));
                                        while (have_posts()): the_post()
                                            ?>
                                            <?php if (get_the_ID() == $test_question_ID): ?>
                                                <option value="<?php the_ID() ?>" selected="selected"><?php the_title() ?></option>
                                            <?php else: ?>
                                                <option value="<?php the_ID() ?>" ><?php the_title() ?></option>
                                            <?php endif ?>
                                        <?php endwhile; ?>
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

                            <div class="fields">
                                <div class="four wide field">
                                    <label>Code de sécurité <span style="color:red;">*</span></label>
                                </div>
                                <div class="twelve wide field">

                                </div>                              
                            </div>

                            <div class="fields">
                                <div class="four wide field">
                                    <label>Confirmation du code de sécurité <span style="color:red;">*</span></label>
                                </div>
                                <div class="twelve wide field">
                                    <input type="text" name="security_code_confirm" placeholder="Confirmation du code de sécurité">
                                </div>                              
                            </div>

                            <div class="inline field">
                                <div class="ui checkbox">
                                    <input type="checkbox" name="terms" <?php if ($terms == 'on'): ?> checked="checked" <?php endif ?>> 
                                    <label><span style="color:red;">*</span> J'ai reçu les informations sur l'inscription, les <a href="#">conditions d'utilisation</a>, les transactions et la protection des données sur ce site web.</label>
                                </div>
                            </div>

                            <div class="inline field">
                                <div class="ui checkbox">
                                    <input type="checkbox" name="receive_notifications" <?php if ($receive_notifications == 'on'): ?> checked="checked" <?php endif ?>>
                                    <label>Je souhaite être informé(e) des produits et des services du site global parcel deal susceptibles de m'intéresser. Ces informations peuvent être communiquées par email ou SMS. Je peux modifier ce paramètres à tout moment dans les paramètres de la gestion des informations du compte.</label>
                                </div>
                            </div>
                            <div class="inline field">
                                <label><a href="#">Je souhaite faire verifier mon identité</a></label>
                            </div>

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
                            <div class="field">
                                <input type="hidden" name='save_account' value='no'>
                                <button id="submit_create_account_particular" class="ui right floated green button" type="submit">S'inscrire maintenant</button>
                            </div>
                        </form>
                    </div>
                    <div class="ui bottom attached tab segment <?php if ($role == 'enterprise' || $role == "professional"): ?> active <?php endif ?>" data-tab="second"> 
                        <form id='register_form_enterprise' name="register" method="POST" action="<?php the_permalink(get_page_by_path(__('recapitulatif-du-compte', 'gpdealdomain'))); ?>" class="ui form" autocomplete="off">
                            <div class="fields">
                                <div class="four wide field"></div>
                                <div class="twelve wide field">
                                    <div class="inline fields">
                                        <div class="field">
                                            <div class="ui radio checkbox">
                                                <input id="checkbox_professional" type="radio" name="role" value="professional" <?php if ($role == "professinal"): ?> checked='checked' <?php endif ?>>
                                                <label>Professionnel</label>
                                            </div>
                                        </div>
                                        <div class="field">
                                            <div class="ui radio checkbox">
                                                <input id="checkbox_enterprise" type="radio" name="role" value="enterprise" <?php if ($role == "enterprise"): ?> checked='checked' <?php endif ?>>
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
                                    <label>Forme juridique de la société <span style="color:red;">*</span></label>
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

                            <div  class="fields">
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
                            </div>

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
                                    <select name="country" class="ui fluid dropdown">
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
                                    <select name="state_country" class="ui fluid dropdown">
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
                                    <select name="city_state" class="ui fluid dropdown">
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
                                    <label>Téléphone fixe </label>
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
                                                <input type="radio" name="civility_representative1" value="M" <?php if ($civility_represntative1_pro == "M"): ?> checked='checked' <?php endif ?>>
                                                <label>M</label>
                                            </div>
                                        </div>
                                        <div class="field">
                                            <div class="ui radio checkbox">
                                                <input type="radio" name="civility_representative1" value="Mme" <?php if ($civility_represntative1_pro == "Mme"): ?> checked='checked' <?php endif ?>>
                                                <label>Mme</label>
                                            </div>
                                        </div>
                                        <div class="field">
                                            <div class="ui radio checkbox">
                                                <input type="radio" name="civility_representative1" value="Mlle" <?php if ($civility_represntative1_pro == "Mlle"): ?> checked='checked' <?php endif ?>>
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
                                    <label>Téléphone mobile <span style="color:red;">*</span></label>
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
                                                <input type="radio" name="civility_representative1" value="M" <?php if ($civility_represntative2_pro == "M"): ?> checked='checked' <?php endif ?>>
                                                <label>M</label>
                                            </div>
                                        </div>
                                        <div class="field">
                                            <div class="ui radio checkbox">
                                                <input type="radio" name="civility_representative1" value="Mme" <?php if ($civility_represntative2_pro == "Mme"): ?> checked='checked' <?php endif ?>>
                                                <label>Mme</label>
                                            </div>
                                        </div>
                                        <div class="field">
                                            <div class="ui radio checkbox">
                                                <input type="radio" name="civility_representative1" value="Mlle" <?php if ($civility_represntative2_pro == "Mlle"): ?> checked='checked' <?php endif ?>>
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
                                    <input type="email" name="email" placeholder="Adresse email de la société" value="<?php echo $user_email_pro ?>">
                                </div>
                            </div>

                            <div class="fields">
                                <div class="four wide field">
                                    <label>Confirmer adresse email de la société <span style="color:red;">*</span></label>
                                </div>
                                <div class="twelve wide field">
                                    <input type="email" name="email_confirm" placeholder="Adresse email" value="<?php echo $user_email_confirm_pro; ?>">
                                </div>
                            </div>

                            <div class="fields">
                                <div class="four wide field">
                                    <label>Mot de passe <span style="color:red;">*</span></label>
                                </div>
                                <div class="twelve wide field">
                                    <input type="password" name="password" placeholder="Mot de passe" value="<?php echo $user_pass_pro ?>">
                                </div>
                            </div>

                            <div class="fields">
                                <div class="four wide field">
                                    <label>Confirmer mot de passe <span style="color:red;">*</span></label>
                                </div>
                                <div class="twelve wide field">
                                    <input type="password" name="password_confirm" placeholder="Confirmation Mot de passe" value="<?php echo $user_pass_confirm_pro ?>">
                                </div>
                            </div>

                            <h4 class="ui dividing header">INFORMATIONS DE SECURITE</h4>

                            <div class="fields">
                                <div class="four wide field">
                                    <label>Question test <span style="color:red;">*</span></label>
                                </div>
                                <div class="twelve wide field">
                                    <select name="test_question" class="ui fluid dropdown">
                                        <option value="">Selectionner une question </option>
                                        <?php
                                        wp_reset_postdata();
                                        query_posts(array('post_type' => 'question', 'post_per_page' => -1, "post_status" => 'publish'));
                                        while (have_posts()): the_post()
                                            ?>
                                            <?php if (get_the_ID() == $test_question_ID_pro): ?>
                                                <option value="<?php the_ID() ?>" selected="selected"><?php the_title() ?></option>
                                            <?php else: ?>
                                                <option value="<?php the_ID() ?>" ><?php the_title() ?></option>
                                            <?php endif ?>
                                        <?php endwhile; ?>
                                    </select>
                                </div>                        
                            </div>
                            <div class="fields">
                                <div class="four wide field">
                                    <label>Reponse à la question test <span style="color:red;">*</span></label>
                                </div>
                                <div class="twelve wide field">
                                    <input type="text" name="answer_test_question" placeholder="Reponse à la question test" value="<?php echo $answer_test_question_pro ?>">
                                </div>                              
                            </div>

                            <div class="fields">
                                <div class="four wide field">
                                    <label>Code de sécurité </label>
                                </div>
                                <div class="twelve wide field">

                                </div>                              
                            </div>

                            <div class="fields">
                                <div class="four wide field">
                                    <label>Confirmation du code de sécurité <span style="color:red;">*</span></label>
                                </div>
                                <div class="twelve wide field">
                                    <input type="text" name="security_code_confirm" placeholder="Confirmation du code de sécurité">
                                </div>                              
                            </div>

                            <div class="inline field">
                                <div class="ui checkbox">
                                    <input type="checkbox" name="terms" <?php if ($terms_pro == 'on'): ?> checked="checked" <?php endif ?>> 
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
                            <input type="hidden" name='save_account' value='no'>
                            <button id="submit_create_account_enterprise" class="ui right floated green button" type="submit">S'inscrire maintenant</button>
                        </form>
                    </div>
                </div>

                <div id="block_recap"> 
                    <?php if ($role == "particular"): ?>
                        <div class='ui form recap'>
                            <h4 class="ui dividing header">ETAT CIVIL</h4>
                            <div class="fields">
                                <div class="five wide field center aligned">
                                    <label>Sexe : </label>
                                </div>
                                <div class="eleven wide field">
                                    <div class="inline fields">
                                        <div class="field">
                                            <div class="ui radio checkbox">
                                                <input type="radio" value="M" <?php if ($gender == "M"): ?> checked='checked' <?php endif ?>>
                                                <label>Masculin</label>
                                            </div>
                                        </div>
                                        <div class="field">
                                            <div class="ui radio checkbox">
                                                <input type="radio"  value="F" <?php if ($gender == "F"): ?> checked='checked' <?php endif ?>>
                                                <label>Feminin</label>
                                            </div>
                                        </div>
                                    </div>
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
                                    <span><?php echo $birthday ?></span>
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

                            <div class="fields">
                                <div class="five wide field center aligned">
                                    <label>Confirmation téléphone mobile : </label>
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
                                    <label>Confirmation adresse email : </label>
                                </div>
                                <div class="eleven wide field center aligned">
                                    <span><?php echo $user_email_confirm; ?></span>
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

                            <div class="fields">
                                <div class="five wide field center aligned">
                                    <label>Confirmation mot de passe : </label>
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
                            <div class="inline field">
                                <div class="ui checkbox">
                                    <input type="checkbox" name="terms" <?php if ($terms == 'on'): ?> checked="checked" <?php endif ?>> 
                                    <label><span style="color:red;">*</span> J'ai reçu les informations sur l'inscription, les <a href="#">conditions d'utilisation</a>, les transactions et la protection des données sur ce site web.</label>
                                </div>
                            </div>

                            <div class="inline field">
                                <div class="ui checkbox">
                                    <input type="checkbox" name="receive_notifications" <?php if ($receive_notifications == 'on'): ?> checked="checked" <?php endif ?>>
                                    <label>Je souhaite être informé(e) des produits et des services du site global parcel deal susceptibles de m'intéresser. Ces informations peuvent être communiquées par email ou SMS. Je peux modifier ce paramètres à tout moment dans les paramètres de la gestion des informations du compte.</label>
                                </div>
                            </div>
                            <button id="confirm_save_account_particular" class="ui right floated green icon button" ><i class="save icon"></i> Enregistrer inscription</button>
                            <button id="edit_account" class="ui green icon button"  style="width: 12em;" ><i class="edit icon"></i> Modifier</button>
                        </div>
                    <?php elseif ($role == "professional" || $role = 'enterprise'): ?>
                        <div class='ui form recap'>
                            <div class="fields">
                                <div class="wide field">
                                    <div class="inline fields">
                                        <div class="field">
                                            <div class="ui radio checkbox">
                                                <input id="checkbox_professional" type="radio" name="role" value="professional" <?php if ($role == "professinal"): ?> checked='checked' <?php endif ?>>
                                                <label>Professionnel</label>
                                            </div>
                                        </div>
                                        <div class="field">
                                            <div class="ui radio checkbox">
                                                <input id="checkbox_enterprise" type="radio" name="role" value="enterprise" <?php if ($role == "enterprise"): ?> checked='checked' <?php endif ?>>
                                                <label>Entreprise</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <h4 class="ui dividing header">INFORMATIONS SUR L'ENTREPRISE </h4>
                            <div  class="fields">
                                <div class="five wide field center aligned">
                                    <label>Nom de la société <span style="color:red;">*</span></label>
                                </div>
                                <div class="eleven wide field center aligned">
                                    <span><?php echo $company_name_pro ?></span>
                                </div>                              
                            </div>

                            <div  class="fields">
                                <div class="five wide field center aligned">
                                    <label>Forme juridique de la société </label>
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

                            <div  class="fields">
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
                            </div>

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
                                <div class="four wide field center aligned">
                                    <label>Pays <span style="color:red;">*</span></label>
                                </div>
                                <div class="eleven wide field center aligned">
                                    <span> <?php $country_pro ?></span>
                                </div>                        
                            </div>

                            <div class="fields">
                                <div class="five wide field center aligned">
                                    <label>Region/Province/State <span style="color:red;">*</span></label>
                                </div>
                                <div class="twelve wide field center aligned">
                                    <span><?php $region_province_state_pro?></span>
                                </div>             
                            </div>

                            <div class="fields">
                                <div class="five wide field center aligned">
                                    <label>Commune/Ville/Localité <span style="color:red;">*</span></label>
                                </div>
                                <div class="eleven wide field center aligned">
                                    <span><?php $commune_city_locality_pro?></span>
                                </div>             
                            </div>

                            <div class="fields">
                                <div class="five wide field center aligned">
                                    <label>Code postal</label>
                                </div>
                                <div class="eleven wide field center aligned">
                                    <span><?php echo $postal_code_pro ?></span>
                                </div>                              
                            </div>


                            <div id="fields_home_phone_number" class="fields">
                                <div class="five wide field center aligned">
                                    <label>Téléphone fixe </label>
                                </div>
                                <div class="eleven wide field center aligned">
                                    <span><?php echo $home_phone_number_pro ?></span>
                                </div>                        
                            </div>

                            <h4 class="ui dividing header">REPRESENTANT 1 </h4>
                            <div class="fields">
                                <div class="five wide field center aligned">
                                    <label>Civilité <span style="color:red;">*</span> </label>
                                </div>
                                <div class="eleven wide field center aligned">
                                    <div class="inline fields">
                                        <div class="field">
                                            <div class="ui radio checkbox">
                                                <input type="radio" name="civility_representative1" value="M" <?php if ($civility_represntative1_pro == "M"): ?> checked='checked' <?php endif ?>>
                                                <label>M</label>
                                            </div>
                                        </div>
                                        <div class="field">
                                            <div class="ui radio checkbox">
                                                <input type="radio" name="civility_representative1" value="Mme" <?php if ($civility_represntative1_pro == "Mme"): ?> checked='checked' <?php endif ?>>
                                                <label>Mme</label>
                                            </div>
                                        </div>
                                        <div class="field">
                                            <div class="ui radio checkbox">
                                                <input type="radio" name="civility_representative1" value="Mlle" <?php if ($civility_represntative1_pro == "Mlle"): ?> checked='checked' <?php endif ?>>
                                                <label>Mlle</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="fields">
                                <div class="five wide field center aligned">
                                    <label>Prénom </label>
                                </div>
                                <div class="eleven wide field center aligned">
                                    <span><?php echo $first_name_representative1_pro ?></span>
                                </div>
                            </div>

                            <div class="fields">
                                <div class="five wide field center aligned">
                                    <label>Nom </label>
                                </div>
                                <div class="eleven wide field center aligned">
                                    <span><?php echo $last_name_representative1_pro ?></span>
                                </div>
                            </div>

                            <div class="fields">
                                <div class="five wide field center aligned">
                                    <label>Fonction dans l'entreprise </label>
                                </div>
                                <div class="eleven wide field center aligned">
                                    <span><?php echo $function_representative1_pro ?></span>
                                </div>                        
                            </div>

                            <div class="fields">
                                <div class="five wide field center aligned">
                                    <label>Adresse email professionnelle </label>
                                </div>
                                <div class="eleven wide field center aligned">
                                    <span><?php echo $email_representative1_pro ?></span>
                                </div>
                            </div>

                            <div class="fields">
                                <div class="five wide field center aligned">
                                    <label>Téléphone mobile </label>
                                </div>
                                <div class="eleven wide field center aligned">
                                    <span><?php echo $mobile_phone_number_representative1_pro ?></span>
                                </div>
                            </div>

                            <h4 class="ui dividing header">REPRESENTANT 2 (Facultatif)</h4>
                            <div class="fields">
                                <div class="five wide field center aligned">
                                    <label>Civilité </label>
                                </div>
                                <div class="eleven wide field center aligned">
                                    <div class="inline fields">
                                        <div class="field">
                                            <div class="ui radio checkbox">
                                                <input type="radio" name="civility_representative1" value="M" <?php if ($civility_represntative2_pro == "M"): ?> checked='checked' <?php endif ?>>
                                                <label>M</label>
                                            </div>
                                        </div>
                                        <div class="field">
                                            <div class="ui radio checkbox">
                                                <input type="radio" name="civility_representative1" value="Mme" <?php if ($civility_represntative2_pro == "Mme"): ?> checked='checked' <?php endif ?>>
                                                <label>Mme</label>
                                            </div>
                                        </div>
                                        <div class="field">
                                            <div class="ui radio checkbox">
                                                <input type="radio" name="civility_representative1" value="Mlle" <?php if ($civility_represntative2_pro == "Mlle"): ?> checked='checked' <?php endif ?>>
                                                <label>Mlle</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="fields">
                                <div class="five wide field center aligned">
                                    <label>Prénom </label>
                                </div>
                                <div class="eleven wide field center aligned">
                                    <span><?php echo $first_name_representative2_pro ?></span>
                                </div>
                            </div>

                            <div class="fields">
                                <div class="five wide field center aligned">
                                    <label>Nom </label>
                                </div>
                                <div class="eleven wide field center aligned">
                                    <span><?php echo $last_name_representative2_pro ?></span>
                                </div>
                            </div>

                            <div class="fields">
                                <div class="five wide field center aligned">
                                    <label>Fonction dans la société </label>
                                </div>
                                <div class="eleven wide field center aligned">
                                    <span><?php echo $function_representative2_pro ?></span>
                                </div>                        
                            </div>

                            <div class="fields">
                                <div class="five wide field center aligned">
                                    <label>Adresse email professionnelle </label>
                                </div>
                                <div class="eleven wide field center aligned">
                                    <span><?php echo $email_representative2_pro ?></span>
                                </div>
                            </div>

                            <div class="fields">
                                <div class="five wide field center aligned">
                                    <label>Téléphone mobile</label>
                                </div>
                                <div class="eleven wide field center aligned">
                                    <span><?php echo $mobile_phone_number_representative2_pro ?></span>
                                </div>
                            </div>

                            <h4 class="ui dividing header">INFORMATIONS DE CONNEXION</h4>

                            <div class="fields">
                                <div class="five wide field center aligned">
                                    <label>Adresse email de la société </label>
                                </div>
                                <div class="eleven wide field center aligned">
                                    <span><?php echo $user_email_pro ?></span>
                                </div>
                            </div>

                            <div class="fields">
                                <div class="five wide field center aligned">
                                    <label>Confirmer adresse email de la société </label>
                                </div>
                                <div class="eleven wide field center aligned">
                                    <span><?php echo $user_email_confirm_pro; ?></span>
                                </div>
                            </div>

                            <div class="fields">
                                <div class="five wide field center aligned">
                                    <label>Mot de passe </label>
                                </div>
                                <div class="eleven wide field center aligned">
                                    <span>*******</span>
                                </div>
                            </div>

                            <div class="fields">
                                <div class="five wide field center aligned">
                                    <label>Confirmer mot de passe </label>
                                </div>
                                <div class="eleven wide field center aligned">
                                    <span>*******</span>
                                </div>
                            </div>

                            <h4 class="ui dividing header">INFORMATIONS DE SECURITE</h4>

                            <div class="fields">
                                <div class="five wide field center aligned">
                                    <label>Question test </label>
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
                                    <label>Reponse à la question test <span style="color:red;">*</span></label>
                                </div>
                                <div class="eleven wide field center aligned">
                                    <span> <?php echo $answer_test_question_pro ?> </span>
                                </div>                              
                            </div>

                            <div class="inline field">
                                <div class="ui checkbox">
                                    <input type="checkbox" name="terms" <?php if ($terms_pro == 'on'): ?> checked="checked" <?php endif ?>> 
                                    <label><span style="color:red;">*</span> J'ai reçu les informations sur l'inscription, les <a href="#">conditions d'utilisation</a>, les transactions et la protection des données sur ce site web.</label>
                                </div>
                            </div>

                            <div class="inline field">
                                <div class="ui checkbox">
                                    <input type="checkbox" name="receive_notifications" <?php if ($receive_notifications_pro == 'on'): ?> checked="checked" <?php endif ?>>
                                    <label>Je souhaite être informé(e) des produits et des services du site global parcel deal susceptibles de m'intéresser. Ces informations peuvent être communiquées par email ou SMS. Je peux modifier ce paramètres à tout moment dans les paramètres de la gestion des informations du compte.</label>
                                </div>
                            </div>
                            <button id="confirm_save_account_enterprise" class="ui right floated green icon button" ><i class="save icon"></i> Enregistrer inscription</button>
                            <button id="edit_account" class="ui green icon button"  style="width: 12em;" ><i class="edit icon"></i> Modifier</button>
                        </div>
                    <?php endif ?>
            </div>
        </div>
    </div>
</div>
