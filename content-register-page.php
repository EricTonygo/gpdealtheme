<?php get_template_part('top-menu', get_post_format()); ?>
<div class="ui large borderless second-nav menu">
    <div class="ui container center aligned">
        <div class="center menu">
            <div class="item">
                <a href="<?php echo home_url('/') ?>" class="section"><?php echo get_page_by_path(__('accueil', 'gpdealdomain'))->post_title ?></a>
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
        <div class="ui attached message">
            <div class="header"><?php echo __("Bienvenu dans notre site!", 'gpdealdomain') ?> </div>
            <p><?php echo __("Remplissez le formulaire ci-dessus pour créer un nouveau compte", 'gpdealdomain') ?></p>
        </div>
        <div class="ui fluid card">
            <div class="content">
                <div class="ui top attached tabular menu">
                    <a class="item active" data-tab="first">Particulier</a>
                    <a class="item" data-tab="second">Professionnel / Entreprise</a>
                </div>
                <div class="ui bottom attached tab segment active" data-tab="first">
                    <form id='register_form_particular'  method="POST" action="<?php the_permalink(get_page_by_path(__('inscription', 'gpdealdomain') . "/" . __('recapitulatif-du-compte', 'gpdealdomain'))); ?>" class="ui form">

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
                                            <input type="radio" name="gender" value="M">
                                            <label>M</label>
                                        </div>
                                    </div>
                                    <div class="field">
                                        <div class="ui radio checkbox">
                                            <input type="radio" name="gender" value="Mme">
                                            <label>Mme</label>
                                        </div>
                                    </div>
                                    <div class="field">
                                        <div class="ui radio checkbox">
                                            <input type="radio" name="gender" value="Mlle">
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
                                <input type="text" name="first_name" placeholder="Prénom">
                            </div>
                        </div>

                        <div class="fields">
                            <div class="four wide field">
                                <label>Nom <span style="color:red;">*</span></label>
                            </div>
                            <div class="twelve wide field">
                                <input type="text" name="last_name" placeholder="Nom">
                            </div>
                        </div>

                        <div class="fields">
                            <div class="four wide field">
                                <label>Pseudo <span style="color:red;">*</span></label>
                            </div>
                            <div class="twelve wide field">
                                <input type="text" name="username" placeholder="Pseudo">
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
                                        <input id="birthdate" type="text" name='birthdate' placeholder="Date de naissance">
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
                                <input type="text" name="number_street" placeholder="Rue et numéro de votre adresse">
                            </div>
                        </div>

                        <div class="fields">
                            <div class="four wide field">
                                <label>Complément adresse </label>
                            </div>
                            <div class="twelve wide field">
                                <input type="text" name="complement_address" placeholder="Complément adresse">
                            </div>
                        </div>

                        <div class="fields">
                            <div class="four wide field">
                                <label>Pays <span style="color:red;">*</span></label>
                            </div>
                            <div class="twelve wide field">
                                <select name="country" class="ui search fluid dropdown">
                                    <option value="">Selectionner votre pays</option>
                                    <?php
                                    $countries = getCountriesList();
                                    foreach ($countries as $my_country) :
                                        ?>
                                        <option value="<?php echo $my_country['code'] ?>" ><?php echo $my_country['name'] ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>                        
                        </div>

                        <div class="fields">
                            <div class="four wide field">
                                <label>Region/Province/Etat <span style="color:red;">*</span></label>
                            </div>
                            <div class="twelve wide field">
                                <select name="state_country" class="ui search fluid dropdown">
                                    <option value="">Selectionner votre région</option>
                                    <?php
                                    $states = getStatesListOfCountry();
                                    foreach ($states as $state) :
                                        ?>
                                        <option value="<?php echo $state['code'] ?>" ><?php echo $state['name'] ?></option>
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
                                        <option value="<?php echo $city['code'] ?>" ><?php echo $city['name'] ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>             
                        </div>

                        <div class="fields">
                            <div class="four wide field">
                                <label>Téléphone mobile <span style="color:red;">*</span></label>
                            </div>
                            <div class="twelve wide field">
                                <input type="tel" name="mobile_phone_number" placeholder="Numéro de téléphone mobile">
                            </div>
                        </div>

                        <div  class="fields">
                            <div class="four wide field">
                                <label>Confirmation Téléphone mobile <span style="color:red;">*</span></label>
                            </div>
                            <div class="twelve wide field">
                                <input type="tel" name="mobile_phone_number_confirm" placeholder="Confirmation Numéro de téléphone mobile">
                            </div>
                        </div>


                        <h4 class="ui dividing header">INFORMATIONS DE CONNEXION</h4>

                        <div class="fields">
                            <div class="four wide field">
                                <label>Adresse email <span style="color:red;">*</span></label>
                            </div>
                            <div class="twelve wide field">
                                <input type="email" name="email" placeholder="Adresse email">
                            </div>
                        </div>

                        <div class="fields">
                            <div class="four wide field">
                                <label>Confirmation Adresse email <span style="color:red;">*</span></label>
                            </div>
                            <div class="twelve wide field">
                                <input type="email" name="email_confirm" placeholder="Adresse email">
                            </div>
                        </div>

                        <div class="fields">
                            <div class="four wide field">
                                <label>Mot de passe <span style="color:red;">*</span></label>
                            </div>
                            <div class="twelve wide field">
                                <div class="ui input right icon">
                                    <i id="show_hide_password_particular" class="unhide link icon"></i>
                                    <input type="password" name="password" placeholder="Mot de passe">
                                </div>
                            </div>
                        </div>

                        <div class="fields">
                            <div class="four wide field">
                                <label>Confirmation Mot de passe <span style="color:red;">*</span></label>
                            </div>
                            <div class="twelve wide field">
                                <div class="ui input right icon">
                                    <i id="show_hide_password_confirm_particular" class="unhide link icon"></i>
                                    <input type="password" name="password_confirm" placeholder="Confirmation Mot de passe">
                                </div>
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
                                            <option value="<?php the_ID() ?>"><?php the_title() ?></option>
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
                                <input type="text" name="answer_test_question" placeholder="Reponse à la question test">
                            </div>                              
                        </div>

                        <div class="fields">
                            <div class="four wide field">
                                <label>Code de sécurité <span style="color:red;">*</span></label>
                            </div>
                            <div class="twelve wide field" id="recaptcha_register_particular">
                            </div>                              
                        </div>

                        <div class="inline field">
                            <div class="ui checkbox">
                                <input type="checkbox" name="terms"> 
                                <label><span style="color:red;">*</span> J'ai reçu les informations sur l'inscription, les <a href="#">conditions d'utilisation</a>, les transactions et la protection des données sur ce site web.</label>
                            </div>
                        </div>

                        <div class="inline field">
                            <div class="ui checkbox">
                                <input type="checkbox" name="receive_notifications">
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
                            <input type="hidden" name='g-recaptcha-response-register'>
                            <input type="hidden" name='save_account' value='no'>
                            <button id="submit_create_account_particular" class="ui right floated green disabled button" type="submit">S'inscrire maintenant</button>
                        </div>
                    </form>
                </div>
                <div class="ui bottom attached tab segment" data-tab="second"> 
                    <form id='register_form_enterprise' name="register" method="POST" action="<?php the_permalink(get_page_by_path(__('inscription', 'gpdealdomain') . "/" . __('recapitulatif-du-compte', 'gpdealdomain'))); ?>" class="ui form" enctype="multipart/form-data">
                        <div class="fields">
                            <div class="four wide field"></div>
                            <div class="twelve wide field">
                                <div class="inline fields">
                                    <div class="field">
                                        <div class="ui radio checkbox">
                                            <input id="checkbox_professional" type="radio" name="role" value="professional">
                                            <label>Professionnel</label>
                                        </div>
                                    </div>
                                    <div class="field">
                                        <div class="ui radio checkbox">
                                            <input id="checkbox_enterprise" type="radio" name="role" value="enterprise">
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
                                <input type="text" name="company_name" placeholder="Nom de la société">
                            </div>                              
                        </div>

                        <div  class="fields">
                            <div class="four wide field">
                                <label>Forme juridique <span style="color:red;">*</span></label>
                            </div>
                            <div class="twelve wide field">
                                <input type="text" name="company_legal_form" placeholder="Forme juridique de la société">
                            </div>                              
                        </div>

                        <div  class="fields">
                            <div class="four wide field">
                                <label>Numéro d'identification de la société <span style="color:red;">*</span></label>
                            </div>
                            <div class="twelve wide field">
                                <input type="text" name="company_identity_number" placeholder="Numéro d'identification de la société">
                            </div>
                        </div>

                        <div  class="fields">
                            <div class="four wide field">
                                <label>Numéro individuel d'identification de la TVA <span style="color:red;">*</span></label>
                            </div>
                            <div class="twelve wide field">
                                <input type="text" name="company_identity_tva_number" placeholder="Numéro individuel d'identification de la TVA">
                            </div>
                        </div>

                        <!--                        <div  class="fields">
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
                                <input type="text" name="number_street" placeholder="Rue et numéro de votre adresse">
                            </div>
                        </div>

                        <div class="fields">
                            <div class="four wide field">
                                <label>Complément adresse </label>
                            </div>
                            <div class="twelve wide field">
                                <input type="text" name="complement_address" placeholder="Complément adresse">
                            </div>
                        </div>

                        <div class="fields">
                            <div class="four wide field">
                                <label>Pays <span style="color:red;">*</span></label>
                            </div>
                            <div class="twelve wide field">
                                <select name="country" class="ui search fluid dropdown">
                                    <option value="">Selectionner votre pays</option>
                                    <?php
                                    $countries = getCountriesList();
                                    foreach ($countries as $my_country) :
                                        ?>
                                        <option value="<?php echo $my_country['code'] ?>" ><?php echo $my_country['name'] ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>                        
                        </div>

                        <div class="fields">
                            <div class="four wide field">
                                <label>Region/Province/Etat <span style="color:red;">*</span></label>
                            </div>
                            <div class="twelve wide field">
                                <select name="state_country" class="ui search fluid dropdown">
                                    <option value="">Selectionner votre région</option>
                                    <?php
                                    $states = getStatesListOfCountry();
                                    foreach ($states as $state) :
                                        ?>
                                        <option value="<?php echo $state['code'] ?>" ><?php echo $state['name'] ?></option>
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
                                        <option value="<?php echo $city['code'] ?>" ><?php echo $city['name'] ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>             
                        </div>

                        <div class="fields">
                            <div class="four wide field">
                                <label>Code postal <span style="color:red;">*</span></label>
                            </div>
                            <div class="twelve wide field">
                                <input type="text" name="postal_code" placeholder="Code postal">
                            </div>                              
                        </div>


                        <div id="fields_home_phone_number" class="fields">
                            <div class="four wide field">
                                <label>Téléphone fixe </label>
                            </div>
                            <div class="twelve wide field">
                                <input type="tel" name="home_phone_number" placeholder="Numéro de téléphone fixe">
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
                                            <input type="radio" name="civility_representative1" value="M">
                                            <label>M</label>
                                        </div>
                                    </div>
                                    <div class="field">
                                        <div class="ui radio checkbox">
                                            <input type="radio" name="civility_representative1" value="F">
                                            <label>Mme</label>
                                        </div>
                                    </div>
                                    <div class="field">
                                        <div class="ui radio checkbox">
                                            <input type="radio" name="civility_representative1" value="F">
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
                                <input type="text" name="first_name_representative1" placeholder="Prénom">
                            </div>
                        </div>

                        <div class="fields">
                            <div class="four wide field">
                                <label>Nom <span style="color:red;">*</span></label>
                            </div>
                            <div class="twelve wide field">
                                <input type="text" name="last_name_representative1" placeholder="Nom">
                            </div>
                        </div>

                        <div class="fields">
                            <div class="four wide field">
                                <label>Fonction dans l'entreprise <span style="color:red;">*</span></label>
                            </div>
                            <div class="twelve wide field">
                                <input type="text" name="function_representative1" placeholder="Fonction dans l'entreprise">
                            </div>                        
                        </div>

                        <div class="fields">
                            <div class="four wide field">
                                <label>Adresse email professionnelle <span style="color:red;">*</span></label>
                            </div>
                            <div class="twelve wide field">
                                <input type="email" name="email_representative1" placeholder="Adresse email professionnelle">
                            </div>
                        </div>

                        <div class="fields">
                            <div class="four wide field">
                                <label>Téléphone mobile </label>
                            </div>
                            <div class="twelve wide field">
                                <input type="tel" name="mobile_phone_number_representative1" placeholder="Numéro de téléphone mobile">
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
                                            <input type="radio" name="civility_representative2" value="M">
                                            <label>M</label>
                                        </div>
                                    </div>
                                    <div class="field">
                                        <div class="ui radio checkbox">
                                            <input type="radio" name="civility_representative2" value="F">
                                            <label>Mme</label>
                                        </div>
                                    </div>
                                    <div class="field">
                                        <div class="ui radio checkbox">
                                            <input type="radio" name="civility_representative2" value="F">
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
                                <input type="text" name="first_name_representative2" placeholder="Prénom">
                            </div>
                        </div>

                        <div class="fields">
                            <div class="four wide field">
                                <label>Nom </label>
                            </div>
                            <div class="twelve wide field">
                                <input type="text" name="last_name_representative2" placeholder="Nom">
                            </div>
                        </div>

                        <div class="fields">
                            <div class="four wide field">
                                <label>Fonction dans la société </label>
                            </div>
                            <div class="twelve wide field">
                                <input type="text" name="function_representative2" placeholder="Fonction dans la société">
                            </div>                        
                        </div>

                        <div class="fields">
                            <div class="four wide field">
                                <label>Adresse email professionnelle </label>
                            </div>
                            <div class="twelve wide field">
                                <input type="email" name="email_representative2" placeholder="Adresse email professionnelle">
                            </div>
                        </div>

                        <div class="fields">
                            <div class="four wide field">
                                <label>Téléphone mobile</label>
                            </div>
                            <div class="twelve wide field">
                                <input type="tel" name="mobile_phone_number_representative2" placeholder="Numéro de téléphone mobile">
                            </div>
                        </div>

                        <h4 class="ui dividing header">INFORMATIONS DE CONNEXION</h4>

                        <div class="fields">
                            <div class="four wide field">
                                <label>Adresse email de la société <span style="color:red;">*</span></label>
                            </div>
                            <div class="twelve wide field">
                                <input type="email" name="email_pro" placeholder="Adresse email de la société">
                            </div>
                        </div>

                        <div class="fields">
                            <div class="four wide field">
                                <label>Confirmer adresse email de la société <span style="color:red;">*</span></label>
                            </div>
                            <div class="twelve wide field">
                                <input type="email" name="email_confirm_pro" placeholder="Adresse email">
                            </div>
                        </div>

                        <div class="fields">
                            <div class="four wide field">
                                <label>Mot de passe <span style="color:red;">*</span></label>
                            </div>
                            <div class="twelve wide field">
                                <div class="ui input right icon">
                                    <i id="show_hide_password_pro" class="unhide link icon"></i>
                                    <input type="password" name="password_pro" placeholder="Mot de passe">
                                </div>
                                
                            </div>
                        </div>

                        <div class="fields">
                            <div class="four wide field">
                                <label>Confirmer mot de passe <span style="color:red;">*</span></label>
                            </div>
                            <div class="twelve wide field">
                                <div class="ui input right icon">
                                    <i id="show_hide_password_confirm_pro" class="unhide link icon"></i>
                                    <input type="password" name="password_confirm_pro" placeholder="Confirmation Mot de passe">
                                </div>
                                
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
                                    $questions = new WP_Query(array('post_type' => 'question', 'post_per_page' => -1, "post_status" => 'publish', 'orderby' => 'post_date', 'order' => 'ASC'));
                                    if ($questions->have_posts()) {
                                        while ($questions->have_posts()): $questions->the_post();
                                            ?>
                                            <option value="<?php the_ID() ?>"><?php the_title() ?></option>
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
                                <input type="text" name="answer_test_question_pro" placeholder="Reponse à la question test">
                            </div>                              
                        </div>

                        <div class="fields">
                            <div class="four wide field">
                                <label>Code de sécurité <span style="color:red;">*</span></label>
                            </div>
                            <div class="twelve wide field" id="recaptcha_register_pro">
                            </div>                              
                        </div>


                        <div class="inline field">
                            <div class="ui checkbox">
                                <input type="checkbox" name="terms"> 
                                <label><span style="color:red;">*</span> J'ai reçu les informations sur l'inscription, les <a href="#">conditions d'utilisation</a>, les transactions et la protection des données sur ce site web.</label>
                            </div>
                        </div>

                        <div class="inline field">
                            <div class="ui checkbox">
                                <input type="checkbox" name="receive_notifications">
                                <label>Je souhaite être informé(e) des produits et des services du site global parcel deal susceptibles de m'intéresser. Ces informations peuvent être communiquées par email ou SMS. Je peux modifier ce paramètres à tout moment dans les paramètres de la gestion des informations du compte.</label>
                            </div>
                        </div>
<!--                        <div class="inline field">                           
                            <label><a href="#">Je souhaite faire verifier mon identité</a></label>
                        </div>-->

                        <div class="field">
                            <div id="server_error_message_enterprise" class="ui negative message" style="display:none">
                                <i class="close icon"></i>
                                <div id="server_error_content_enterprise" class="header">Internal server error</div>
                            </div>
                            <div id="error_name_message_enterprise" class="ui error message" style="display: none">
                                <i class="close icon"></i>
                                <div id="error_name_header_enterprise" class="header"></div>
                                <ul id="error_name_list" class="list">

                                </ul>
                            </div>
                        </div
                        <input type="hidden" name='g-recaptcha-response-register'>
                        <input type="hidden" name='save_account' value='no'>
                        <button id="submit_create_account_enterprise" class="ui right floated green disabled button" type="submit">S'inscrire maintenant</button>
                    </form>
                </div>

            </div>
        </div>
    </div>
</div>

