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
            <div class="header"><?php echo __("Bienvenue sur notre site", 'gpdealdomain') ?> ! </div>
            <p class="promo_text_form"><?php echo __("Inscrivez-vous en quelques minutes et profitez pleinement de nos services !", 'gpdealdomain') ?></p>
        </div>
        <div class="ui fluid card">
            <div class="content">
                <p class="required_infos"><span style="color: red;">*</span> Informations obligatoires</p>
                <div class="ui top attached tabular menu">
                    <div class="item active" data-tab="first">Particulier</div>
                    <div class="item" data-tab="second">Professionnel/<br class="mobile_br" style="display: none;">Entreprise</div>
                </div>
                <div class="ui bottom attached tab segment active" data-tab="first">
                    <form id='register_form_particular'  method="POST" action="<?php the_permalink(get_page_by_path(__('inscription', 'gpdealdomain') . "/" . __('recapitulatif-du-compte', 'gpdealdomain'))); ?>" class="ui form" autocomplete="off" enctype="multipart/form-data">

                        <input  type="hidden" name="role" value="particular" >
                        <div  class="fields">
<!--                            <div class="four wide field">
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
                                    <img id="profile_picture_img" class="ui tiny image" src="<?php echo get_template_directory_uri() ?>/assets/images/avatar.png">
                                </div>
                                <div style="height:0px;overflow:hidden">
                                    <input type="file" id="profile_picture_file" name="profile_picture_file" accept=".jpg,.png,.gif,.jpeg">
                                </div>
                            </div>
                        </div>

                        <h4 class="ui dividing header">Etat civil</h4>
                        <div id='civility_bloc' class="fields">
                            <div class="four wide field">
                                <label>Civilité <span style="color:red;">*</span> </label>
                            </div>
                            <div class="twelve wide field">
                                <label class='mobile_label' style="display:none">Civilité <span style="color:red;">*</span> </label>
                                <div class="inline fields">                                   
                                    <div class="field">
                                        <div class="ui radio checkbox">
                                            <input type="radio" name="gender" value="M">
                                            <label>M.</label>
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
                                <span style="font-size: 12px; font-style: italic"><?php echo __("Il faut être majeur pour utiliser notre service", "gpdealdomain") ?></span>
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
                        

                        <h4 class="ui dividing header">Adresse</h4>

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
                                <label>Localité <span style="color:red;">*</span></label>
                            </div>
                            <div class="twelve wide field">
                                <div class="ui input icon">
                                    <!--<i class="marker icon locality" locality_id='locality'></i>-->
                                    <i class="remove link icon locality" style="display: none;" locality_id='locality'></i>
                                    <input id="locality" type="text" class="locality" name="locality" placeholder="Votre localité">
                                </div>
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
                                <label>Confirmation téléphone mobile <span style="color:red;">*</span></label>
                            </div>
                            <div class="twelve wide field">
                                <input type="tel" name="mobile_phone_number_confirm" placeholder="Confirmation numéro de téléphone mobile">
                            </div>
                        </div>


                        <h4 class="ui dividing header">Informations de connexion</h4>

                        <div class="fields">
                            <div class="four wide field">
                                <label>Email <span style="color:red;">*</span></label>
                            </div>
                            <div class="twelve wide field">
                                <input type="email" name="email" placeholder="Adresse email">
                            </div>
                        </div>

                        <div class="fields">
                            <div class="four wide field">
                                <label>Confirmation email <span style="color:red;">*</span></label>
                            </div>
                            <div class="twelve wide field">
                                <input type="email" name="email_confirm" placeholder="Confirmation de l'adresse email">
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
                                <label>Confirmation mot de passe <span style="color:red;">*</span></label>
                            </div>
                            <div class="twelve wide field">
                                <div class="ui input right icon">
                                    <i id="show_hide_password_confirm_particular" class="unhide link icon"></i>
                                    <input type="password" name="password_confirm" placeholder="Confirmation du mot de passe">
                                </div>
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
                                <label class="label_terms_use"><span style="color:red;">*</span> J'ai reçu les informations sur l'inscription, les <a href="#">conditions d'utilisation</a>, les transactions et la protection des données sur ce site web.</label>
                            </div>
                        </div>

                        <div class="inline field">
                            <div class="ui checkbox">
                                <input type="checkbox" name="receive_notifications">
                                <label class="label_terms_use">Je souhaite être informé(e) des produits et des services du site Global Parcel Deal. Je peux modifier ce paramètre à tout moment dans la gestion des informations de mon profil.</label>
                            </div>
                        </div>
                        <div class="fields"> 
                            <div id="identity_file_bloc" class="seven wide field "> 
                                <a id="identity_file_link" class="ui green basic icon fluid button"><i class="attach icon"></i> Je souhaite faire verifier mon identité</a>
                                <div style="height:0px;overflow:hidden">
                                    <input type="file" id="identity_file" name="identity_file">
                                </div>
                            </div>
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
                    <form id='register_form_enterprise' name="register" method="POST" action="<?php the_permalink(get_page_by_path(__('inscription', 'gpdealdomain') . "/" . __('recapitulatif-du-compte', 'gpdealdomain'))); ?>" class="ui form" enctype="multipart/form-data" autocomplete="off">
                        <div  class="fields">
<!--                            <div class="four wide field">
                                <label>Logo de l'entreprise </label>
                            </div>-->
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
                                    <img id="company_logo_img" class="ui tiny image" src="<?php echo get_template_directory_uri() ?>/assets/images/default_logo.png">
                                </div>
                               <div style="height:0px;overflow:hidden">
                                    <input type="file" id="company_logo_file" name="company_logo_file" accept=".jpg,.png,.gif,.jpeg">
                                </div>
                            </div>
                        </div>
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
                        <h4 class="ui dividing header">Informations sur l'entreprise </h4>
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

                        

                        <!--                                                <div  class="fields">
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
                                <div class="ui input icon locality_pro">
                                    <!--<i class="marker icon locality_pro" locality_id='locality_pro'></i>-->
                                    <i class="remove link icon locality_pro" style="display: none;" locality_id='locality_pro'></i>
                                    <input id="locality_pro" type="text" class="locality" name="locality_pro" placeholder="Votre localité">
                                </div>
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

                        <h4 class="ui dividing header">Représentant 1 </h4>
                        <div class="fields">
                            <div class="four wide field">
                                <label>Civilité <span style="color:red;">*</span> </label>
                            </div>
                            <div class="twelve wide field">
                                <div class="inline fields">
                                    <div class="field">
                                        <div class="ui radio checkbox">
                                            <input type="radio" name="civility_representative1" value="M">
                                            <label>M.</label>
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
                                <label>Email professionnel <span style="color:red;">*</span></label>
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

                        <h4 class="ui dividing header">Répresentant 2 (Facultatif)</h4>
                        <div class="fields">
                            <div class="four wide field">
                                <label>Civilité </label>
                            </div>
                            <div class="twelve wide field">
                                <div class="inline fields">
                                    <div class="field">
                                        <div class="ui radio checkbox">
                                            <input type="radio" name="civility_representative2" value="M">
                                            <label>M.</label>
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
                                <label>Email professionnel </label>
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

                        <h4 class="ui dividing header">Informations de connexion</h4>

                        <div class="fields">
                            <div class="four wide field">
                                <label>Email de la société <span style="color:red;">*</span></label>
                            </div>
                            <div class="twelve wide field">
                                <input type="email" name="email_pro" placeholder="Adresse email de la société">
                            </div>
                        </div>

                        <div class="fields">
                            <div class="four wide field">
                                <label>Confirmer email de la société <span style="color:red;">*</span></label>
                            </div>
                            <div class="twelve wide field">
                                <input type="email" name="email_confirm_pro" placeholder="Confirmation de l'adresse email de la société">
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
                                    <input type="password" name="password_confirm_pro" placeholder="Confirmation mot de passe">
                                </div>

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
                                <label class="label_terms_use"><span style="color:red;">*</span> J'ai reçu les informations sur l'inscription, les <a href="#">conditions d'utilisation</a>, les transactions et la protection des données sur ce site web.</label>
                            </div>
                        </div>

                        <div class="inline field">
                            <div class="ui checkbox">
                                <input type="checkbox" name="receive_notifications">
                                <label class="label_terms_use">Je souhaite être informé(e) des produits et des services du site Global Parcel Deal. Je peux modifier ce paramètre à tout moment dans la gestion des informations de mon profil.</label>
                            </div>
                        </div>
                        <div class="fields"> 
                            <div id="identity_file_pro_bloc" class="seven wide field "> 
                                <a id="identity_file_pro_link" class="ui green basic icon fluid button"><i class="attach icon"></i> Je souhaite faire verifier mon identité</a>
                                <div style="height:0px;overflow:hidden">
                                    <input type="file" id="identity_file_pro" name="identity_file_pro">
                                </div>
                            </div>
                        </div>
                        

                        <div class="field">
                            <div id="server_error_message_enterprise" class="ui negative message" style="display:none">
                                <i class="close icon"></i>
                                <div id="server_error_content_enterprise" class="header">Internal server error</div>
                            </div>
                            <div id="error_name_message_enterprise" class="ui error message" style="display: none">
                                <i class="close icon"></i>
                                <div id="error_name_header_enterprise" class="header"></div>
                                <ul id="error_name_list_enterprise" class="list">

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

