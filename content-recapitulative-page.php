<?php get_template_part('top-menu', get_post_format()); ?>
<?php ?>  
<div class="ui large borderless second-nav menu">
    <div class="ui container center aligned">
        <div class="center menu">
            <div class="item">
                <a href="<?php echo wp_make_link_relative(home_url('/')) ?>" class="section"><?php echo get_page_by_path(__('home', 'gpdealdomain'))->post_title ?></a>
                <i class="right chevron icon divider"></i>
                <a href="<?php echo wp_make_link_relative(get_permalink(get_page_by_path(__('registration', 'gpdealdomain')))) ?>" class="section"><?php echo get_page_by_path(__('registration', 'gpdealdomain'))->post_title ?></a>
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
                <div id="block_form_edit" <?php if (!isset($_SESSION['error_message'])): ?> style="display: none"<?php endif ?>>  
                    <p class="required_infos"><span style="color: red;">*</span> <?php _e("Required informations", "gpdealdomain"); ?></p>
                    <div class="ui top attached tabular menu">
                        <div class="item <?php if ($role == "particular"): ?> active <?php endif ?>" data-tab="first">Particulier</div>
                        <div class="item <?php if ($role == "professional" || $role == "enterprise"): ?> active <?php endif ?>" data-tab="second">Professionnel/<br class="mobile_br" style="display: none;">Entreprise</div>
                    </div>
                    <div class="ui bottom attached tab segment <?php if ($role == 'particular'): ?> active <?php endif ?>" data-tab="first">
                        <form id='register_form_particular'  method="POST" action="<?php the_permalink(get_page_by_path(__('account-summary', 'gpdealdomain'))); ?>" class="ui form" enctype="multipart/form-data">
                            <input  type="hidden" name="role" value="particular" >
                            <div  class="fields">                               
                                <div class="sixteen wide field center aligned">
                                    <div><i class="help circle green link icon tooltip"><span class="tooltiptext"><?php echo __("Change your profile picture", "gpdealdomain") ?></span></i></div>
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
                                        <img id="profile_picture_img" class="ui tiny image" <?php if ($profile_picture_id): ?> src= "<?php echo wp_make_link_relative(wp_get_attachment_url($profile_picture_id)); ?>" <?php else: ?> src="<?php echo wp_make_link_relative(get_template_directory_uri()); ?>/assets/images/avatar.png"<?php endif ?>>
                                    </div>
                                    <div style="height:0px;overflow:hidden">
                                        <input type="file" id="profile_picture_file" name="profile_picture_file" accept=".jpg,.png,.gif,.jpeg">
                                    </div>
                                </div>
                            </div>
                            <?php if ($profile_picture_id): ?>
                                <input type="hidden" name="profile_picture_id" value="<?php echo $profile_picture_id; ?>">
                            <?php endif ?>
                            <h4 class="ui dividing header"><?php _e("Civil status", "gpdealdomain"); ?></h4>
                            <div class="fields">
                                <div class="four wide field">
                                    <label><?php _e("Civility", "gpdealdomain"); ?> <span style="color:red;">*</span> </label>
                                </div>
                                <div class="twelve wide field">
                                    <div class="inline fields">
                                        <div class="field">
                                            <div class="ui radio checkbox">
                                                <input type="radio" name="gender" value="Mr." <?php if ($gender == "Mr."): ?> checked='checked' <?php endif ?>>
                                                <label><?php _e("Mr.", "gpdealdomain"); ?></label>
                                            </div>
                                        </div>
                                        <div class="field">
                                            <div class="ui radio checkbox">
                                                <input type="radio" name="gender" value="Mrs" <?php if ($gender == "Mrs" || $gender == "Mme"): ?> checked='checked' <?php endif ?>>
                                                <label><?php _e("Mrs", "gpdealdomain"); ?></label>
                                            </div>
                                        </div>
                                        <div class="field">
                                            <div class="ui radio checkbox">
                                                <input type="radio" name="gender" value="Ms" <?php if ($gender == "Ms" || $gender == "Mlle"): ?> checked='checked' <?php endif ?>>
                                                <label><?php _e("Ms", "gpdealdomain"); ?></label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="fields">
                                <div class="four wide field">
                                    <label><?php _e("First name", "gpdealdomain"); ?> <span style="color:red;">*</span></label>
                                </div>
                                <div class="twelve wide field">
                                    <input type="text" name="first_name" placeholder="<?php _e("First name", "gpdealdomain"); ?>" value="<?php echo $first_name ?>">
                                </div>
                            </div>

                            <div class="fields">
                                <div class="four wide field">
                                    <label><?php _e("Last name", "gpdealdomain"); ?> <span style="color:red;">*</span></label>
                                </div>
                                <div class="twelve wide field">
                                    <input type="text" name="last_name" placeholder="<?php _e("Last name", "gpdealdomain"); ?>" value="<?php echo $last_name ?>">
                                </div>
                            </div>

                            <div class="fields">
                                <div class="four wide field">
                                    <label><?php _e("Username", "gpdealdomain"); ?> <span style="color:red;">*</span></label>
                                </div>
                                <div class="twelve wide field">
                                    <input type="text" name="username" placeholder="<?php _e("Username", "gpdealdomain"); ?>" value="<?php echo $user_login ?>">
                                </div>                        
                            </div>

                            <div class="fields">
                                <div class="four wide field">
                                    <label><?php _e("Birth date", "gpdealdomain"); ?><i class="help circle green link icon tooltip">
                                            <span class="tooltiptext"><?php echo __("You must be major to use our services", "gpdealdomain") ?></span>
                                        </i> <span style="color:red;">*</span></label>
                                </div>
                                <div class="twelve wide field">
                                    <div class="ui calendar" >
                                        <div class="ui input left icon">
                                            <i class="calendar icon"></i>
                                            <input id="birthdate" type="text" name='birthdate' placeholder="<?php _e("Birth date", "gpdealdomain"); ?>" value="<?php echo $birthdate ?>">
                                        </div>
                                    </div>
                                </div>      
                            </div>

                            <h4 class="ui dividing header"><?php _e("Address", "gpdealdomain"); ?></h4>

                            <div class="fields">
                                <div class="four wide field">
                                    <label><?php _e("Number and Street", "gpdealdomain"); ?> <span style="color:red;">*</span></label>
                                </div>
                                <div class="twelve wide field">
                                    <input type="text" name="number_street" placeholder="<?php _e("Street and number of your address", "gpdealdomain"); ?>" value="<?php echo $number_street ?>">
                                </div>
                            </div>

                            <div class="fields">
                                <div class="four wide field">
                                    <label><?php _e("Additional address", "gpdealdomain"); ?> </label>
                                </div>
                                <div class="twelve wide field">
                                    <input type="text" name="complement_address" placeholder="<?php _e("Additional address", "gpdealdomain"); ?>" value="<?php echo $complement_address ?>">
                                </div>
                            </div>

                            <div class="fields">
                                <div class="four wide field">
                                    <label><?php _e("Locality", "gpdealdomain"); ?> <span style="color:red;">*</span></label>
                                </div>
                                <div class="twelve wide field">
                                    <div class="ui input icon locality">
                                        <!--<i class="marker icon locality" locality_id='locality'></i>-->
                                        <i class="remove link icon locality" style="display: none;" locality_id='locality'></i>
                                        <input id="locality" type="text" class="locality" name='locality' placeholder="<?php _e("Your locality", "gpdealdomain"); ?>" value="<?php echo $locality ?>">
                                    </div>
                                </div>                        
                            </div>                            
                            <div class="fields">
                                <div class="four wide field">
                                    <label><?php _e("Mobile phone", "gpdealdomain"); ?><i class="help circle green link icon tooltip">
                                            <span class="tooltiptext"><?php echo __("Number in international format with country code", "gpdealdomain") ?></span>
                                        </i> <span style="color:red;">*</span></label>
                                </div>
                                <div class="twelve wide field">
                                    <input type="tel" name="mobile_phone_number" placeholder="<?php _e("Mobile phone number", "gpdealdomain"); ?>" value="<?php echo $mobile_phone_number ?>">
                                </div>
                            </div>

                            <div  class="fields">
                                <div class="four wide field">
                                    <label><?php _e("Confirm mobile phone", "gpdealdomain"); ?> <span style="color:red;">*</span></label>
                                </div>
                                <div class="twelve wide field">
                                    <input type="tel" name="mobile_phone_number_confirm" placeholder="<?php _e("Mobile phone confirmation", "gpdealdomain"); ?>" value="<?php echo $mobile_phone_number ?>">
                                </div>
                            </div>
                            <h4 class="ui dividing header"><?php _e("Login information", "gpdealdomain"); ?></h4>

                            <div class="fields">
                                <div class="four wide field">
                                    <label><?php _e("E-mail", "gpdealdomain"); ?> <span style="color:red;">*</span></label>
                                </div>
                                <div class="twelve wide field">
                                    <input type="email" name="email" placeholder="<?php _e("E-mail address", "gpdealdomain"); ?>" value="<?php echo $user_email ?>">
                                </div>
                            </div>

                            <div class="fields">
                                <div class="four wide field">
                                    <label><?php _e("E-mail confirmation", "gpdealdomain"); ?> <span style="color:red;">*</span></label>
                                </div>
                                <div class="twelve wide field">
                                    <input type="email" name="email_confirm" placeholder="<?php _e("E-mail address confirmation", "gpdealdomain"); ?>" value="<?php echo $user_email ?>">
                                </div>
                            </div>

                            <?php if (!is_user_logged_in()): ?>
                                <div class="fields">
                                    <div class="four wide field">
                                        <label><?php _e("Password", "gpdealdomain"); ?> <span style="color:red;">*</span></label>
                                    </div>
                                    <div class="twelve wide field">
                                        <div class="ui input right icon password_particular">
                                            <i class="unhide link icon password_particular" style="display: none;" input_password_id="password_particular"></i>
                                            <input id="password_particular" type="password" name="password" placeholder="Mot de passe" class="visible_password" value="<?php echo $user_pass ?>">
                                        </div>
                                    </div>
                                </div>

                                <div class="fields">
                                    <div class="four wide field">
                                        <label><?php _e("Confirm password", "gpdealdomain"); ?> <span style="color:red;">*</span></label>
                                    </div>
                                    <div class="twelve wide field password_confirm_particular">
                                        <div class="ui input right icon password_confirm_particular">
                                            <i class="unhide link icon password_confirm_particular" style="display: none;" input_password_id="password_confirm_particular"></i>
                                            <input id="password_confirm_particular" type="password"  name="password_confirm" placeholder="<?php _e("Password confirmation", "gpdealdomain"); ?>" class="visible_password" value="<?php echo $user_pass_confirm ?>">
                                        </div>
                                    </div>
                                </div>

                            <?php endif ?>
                            <h4 class="ui dividing header"><?php _e("Security information", "gpdealdomain"); ?></h4>

                            <div class="fields">
                                <div class="four wide field">
                                    <label><?php _e("Test question", "gpdealdomain"); ?> <span style="color:red;">*</span></label>
                                </div>
                                <div class="twelve wide field">
                                    <select name="test_question" class="ui search fluid dropdown">
                                        <option value=""><?php _e("Select a test question", "gpdealdomain"); ?> </option>
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
                                    <label><?php _e("Answer to test question", "gpdealdomain"); ?> <span style="color:red;">*</span></label>
                                </div>
                                <div class="twelve wide field">
                                    <input type="text" name="answer_test_question" placeholder="<?php _e("Answer to test question", "gpdealdomain"); ?>" value="<?php echo $answer_test_question ?>">
                                </div>                              
                            </div>
                            <?php if (!is_user_logged_in()): ?>
                                <div class="fields">
                                    <div class="four wide field">
                                        <!--<label>Code de sécurité <span style="color:red;">*</span></label>-->
                                    </div>

                                    <div class="twelve wide field" id="recaptcha_register_particular">
                                    </div>     
                                </div>
                            <?php endif ?>

                            <div class="inline field" <?php if (is_user_logged_in()): ?> style="display: none" <?php endif ?>>
                                <div class="ui checkbox">
                                    <input type="checkbox" name="terms" <?php if ($terms == 'on' || is_user_logged_in()): ?> checked="checked" <?php endif ?>> 
                                    <label><span style="color:red;">*</span>  <?php _e("I received the registration information", "gpdealdomain"); ?>, <a href="<?php echo wp_make_link_relative(get_permalink(get_page_by_path(__('terms-of-use', 'gpdealdomain')))); ?>"><?php _e("terms of use", "gpdealdomain"); ?></a>, <?php _e("transactions and data protection on this website", "gpdealdomain") ?>.</label>
                                </div>
                            </div>

                            <div class="inline field">
                                <div class="ui checkbox">
                                    <input type="checkbox" name="receive_notifications" <?php if ($receive_notifications == 'on'): ?> checked="checked" <?php endif ?>>
                                    <label class="label_terms_use"><?php _e("I would like to be informed about the products and services of Global Parcel Deal. I can change this setting at any time in the management of my profile information", "gpdealdomain"); ?>.</label>
                                </div>
                            </div>
                            <div class="fields"> 
                                <div id="identity_file_bloc" class="field ">
                                    <?php if ($identity_file_id): ?>
                                        <div id="identity_file_preview" class="ui message"><i class="close icon"></i><a  href="<?php echo wp_make_link_relative(wp_get_attachment_url($identity_file_id)); ?>" class="header"><?php echo basename(get_attached_file($identity_file_id)); ?> </a></div>
                                        <div id="identity_file_link" class="ui green basic icon fluid button" style="display: none"><i class="attach icon"></i> <?php _e("I want to check my identity", "gpdealdomain"); ?> <i class="help circle green link icon tooltip"><span class="tooltiptext"><?php echo __("Download a document to verify your identity", "gpdealdomain") ?></span></i></div>
                                    <?php else: ?>
                                        <div id="identity_file_link" class="ui green basic icon fluid button" ><i class="attach icon"></i> <?php _e("I want to check my identity", "gpdealdomain"); ?> <i class="help circle green link icon tooltip"><span class="tooltiptext"><?php echo __("Download a document to verify your identity", "gpdealdomain") ?></span></i></div>
                                    <?php endif ?>
                                    <div style="height:0px;overflow:hidden">
                                        <input type="file" id="identity_file" name="identity_file">
                                    </div>
                                </div>
                            </div>
                            <?php if ($identity_file_id): ?>
                                <input type="hidden" name="identity_file_id"  value="<?php echo $identity_file_id; ?>">
                            <?php endif ?>
                            <?php if ($role == "particular"): ?>
                                <div class="field">
                                    <div id="server_error_message" class="ui negative message" <?php if (!isset($_SESSION['error_message'])): ?>style="display:none" <?php endif ?>>
                                        <i class="close icon"></i>
                                        <div id="server_error_content" class="header">Internal server error</div>
                                    </div>
                                    <div id="error_name_message" class="ui negative message" <?php if (isset($_SESSION['error_message'])): ?>style="display:block" <?php else: ?> style="display:none" <?php endif ?>>
                                        <i class="close icon"></i>
                                        <div id="error_name_header" class="header"><?php if (isset($_SESSION['error_message'])): ?> <?php _e("Error", "gpdealdomain") ?><?php endif ?></div>
                                        <ul id="error_name_list" class="list">
                                            <?php if (isset($_SESSION['error_message'])): ?>
                                                <li> <?php
                                                    echo $_SESSION['error_message'];
                                                    ?></li>
                                            <?php endif ?>
                                        </ul>
                                    </div>
                                </div>
                            <?php endif; ?>
                            <div class="field">
                                <input type="hidden" name='g-recaptcha-response-register' value='<?php echo $g_recaptcha_response; ?>'>
                                <?php if (is_user_logged_in()): ?>
                                    <input type="hidden" name='edit_account' value='no'>
                                <?php else: ?>
                                    <input type="hidden" name='save_account' value='no'>
                                <?php endif ?>
                                <?php if (is_user_logged_in()): ?>
                                    <button id="submit_edit_account_particular" class="ui right floated green button" type="submit"><?php _e("Edit my account", "gpdealdomain") ?></button>
                                <?php else: ?>
                                    <button id="submit_create_account_particular" class="ui right floated green disabled button" type="submit"><?php _e("Register now", "gpdealdomain") ?></button>
                                <?php endif ?>
                            </div>
                        </form>
                    </div>
                    <div class="ui bottom attached tab segment <?php if ($role == 'enterprise' || $role == "professional"): ?> active <?php endif ?>" data-tab="second"> 
                        <form id='register_form_enterprise' name="register" method="POST" action="<?php the_permalink(get_page_by_path(__('account-summary', 'gpdealdomain'))); ?>" class="ui form" enctype="multipart/form-data">
                            <div  class="fields">
                                <div class="sixteen wide field center aligned">
                                    <div><i class="help circle green link icon tooltip"><span class="tooltiptext"><?php echo __("Download your company logo", "gpdealdomain") ?></span></i></div>
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
                                        <img id="company_logo_img" class="ui tiny image" <?php if ($company_logo_id): ?> src= "<?php echo wp_make_link_relative(wp_get_attachment_url($company_logo_id)); ?>" <?php else: ?> src="<?php echo wp_make_link_relative(get_template_directory_uri()); ?>/assets/images/default_logo.png" <?php endif ?>>
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
                                                <label><?php _e("Professional", "gpdealdomain"); ?></label>
                                            </div>
                                        </div>
                                        <div class="field">
                                            <div class="ui radio checkbox">
                                                <input id="checkbox_enterprise" type="radio" name="role" value="enterprise" <?php if (!in_array("professional", $roles) && in_array("enterprise", $roles)): ?> checked='checked' <?php endif ?>>
                                                <label><?php _e("Enterprise", "gpdealdomain"); ?></label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <h4 class="ui dividing header"><?php _e("Company information", "gpdealdomain"); ?> </h4>
                            <div  class="fields">
                                <div class="four wide field">
                                    <label><?php _e("Company name", "gpdealdomain"); ?> <span style="color:red;">*</span></label>
                                </div>
                                <div class="twelve wide field">
                                    <input type="text" name="company_name" placeholder="<?php _e("Company name", "gpdealdomain"); ?>" value="<?php echo $company_name_pro ?>">
                                </div>                              
                            </div>

                            <div  class="fields">
                                <div class="four wide field">
                                    <label><?php _e("Legal form", "gpdealdomain"); ?> <span style="color:red;">*</span></label>
                                </div>
                                <div class="twelve wide field">
                                    <input type="text" name="company_legal_form" placeholder="<?php _e("Legal form of the company", "gpdealdomain"); ?>" value="<?php echo $company_legal_form_pro ?>">
                                </div>                              
                            </div>

                            <div  class="fields">
                                <div class="four wide field">
                                    <label><?php _e("Company Identification Number", "gpdealdomain"); ?> </label>
                                </div>
                                <div class="twelve wide field">
                                    <input type="text" name="company_identity_number" placeholder="<?php _e("Company Identification Number", "gpdealdomain"); ?>" value="<?php echo $company_identity_number_pro ?>">
                                </div>
                            </div>

                            <div  class="fields">
                                <div class="four wide field">
                                    <label><?php _e("Individual VAT identification number", "gpdealdomain"); ?> </label>
                                </div>
                                <div class="twelve wide field">
                                    <input type="text" name="company_identity_tva_number" placeholder="<?php _e("Individual VAT identification number", "gpdealdomain"); ?>" value="<?php echo $company_identity_tva_number_pro ?>">
                                </div>
                            </div>
                            <h4 class="ui dividing header"><?php _e("Address", "gpdealdomain"); ?></h4>

                            <div class="fields">
                                <div class="four wide field">
                                    <label><?php _e("Number and Street", "gpdealdomain"); ?> <span style="color:red;">*</span></label>
                                </div>
                                <div class="twelve wide field">
                                    <input type="text" name="number_street" placeholder="<?php _e("Street and number of your address", "gpdealdomain"); ?>" value="<?php echo $number_street_pro ?>">
                                </div>
                            </div>

                            <div class="fields">
                                <div class="four wide field">
                                    <label><?php _e("Additional address", "gpdealdomain"); ?> </label>
                                </div>
                                <div class="twelve wide field">
                                    <input type="text" name="complement_address" placeholder="<?php _e("Additional address", "gpdealdomain"); ?>" value="<?php echo $complement_address_pro ?>">
                                </div>
                            </div>

                            <div class="fields">
                                <div class="four wide field">
                                    <label><?php _e("Locality", "gpdealdomain"); ?> <span style="color:red;">*</span></label>
                                </div>
                                <div class="twelve wide field">
                                    <div class="ui input icon locality_pro">
                                        <!--<i class="marker icon locality_pro" locality_id='locality_pro'></i>-->
                                        <i class="remove link icon locality_pro" style="display: none;" locality_id='locality_pro'></i>
                                        <input id="locality_pro" type="text" class="locality" name='locality_pro' placeholder="<?php _e("Your locality", "gpdealdomain"); ?>" value="<?php echo $locality_pro ?>">
                                    </div>
                                </div>                        
                            </div>

                            <div class="fields">
                                <div class="four wide field">
                                    <label><?php _e("Zip code", "gpdealdomain"); ?> <span style="color:red;">*</span></label>
                                </div>
                                <div class="twelve wide field">
                                    <input type="text" name="postal_code" placeholder="<?php _e("Zip code", "gpdealdomain"); ?>" value="<?php echo $postal_code_pro ?>">
                                </div>                              
                            </div>

                            <div id="fields_home_phone_number" class="fields">
                                <div class="four wide field">
                                    <label><?php _e("Phone", "gpdealdomain"); ?><i class="help circle green link icon tooltip">
                                            <span class="tooltiptext"><?php echo __("Number in international format with country code", "gpdealdomain") ?></span>
                                        </i> <span style="color:red;">*</span></label>
                                </div>
                                <div class="twelve wide field">
                                    <input type="tel" name="home_phone_number" placeholder="<?php _e("Phone number", "gpdealdomain"); ?>" value="<?php echo $home_phone_number_pro ?>">
                                </div>                        
                            </div>

                            <h4 class="ui dividing header"><?php _e("Representative", "gpdealdomain"); ?> 1 </h4>
                            <div class="fields">
                                <div class="four wide field">
                                    <label>Civilité <span style="color:red;">*</span> </label>
                                </div>
                                <div class="twelve wide field">
                                    <div class="inline fields">
                                        <div class="field">
                                            <div class="ui radio checkbox">
                                                <input type="radio" name="civility_representative1" value="Mr." <?php if ($civility_representative1_pro == "Mr."): ?> checked='checked' <?php endif ?>>
                                                <label><?php _e("Mr.", "gpdealdomain"); ?>.</label>
                                            </div>
                                        </div>
                                        <div class="field">
                                            <div class="ui radio checkbox">
                                                <input type="radio" name="civility_representative1" value="Mrs" <?php if ($civility_representative1_pro == "Mrs" || $civility_representative1_pro == "Mme"): ?> checked='checked' <?php endif ?>>
                                                <label><?php _e("Mrs", "gpdealdomain"); ?></label>
                                            </div>
                                        </div>
                                        <div class="field">
                                            <div class="ui radio checkbox">
                                                <input type="radio" name="civility_representative1" value="Ms" <?php if ($civility_representative1_pro == "Ms" || $civility_representative1_pro == "Mlle"): ?> checked='checked' <?php endif ?>>
                                                <label><?php _e("Ms", "gpdealdomain"); ?></label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="fields">
                                <div class="four wide field">
                                    <label><?php _e("First name", "gpdealdomain"); ?> </label>
                                </div>
                                <div class="twelve wide field">
                                    <input type="text" name="first_name_representative1" placeholder="<?php _e("First name", "gpdealdomain"); ?>" value="<?php echo $first_name_representative1_pro ?>">
                                </div>
                            </div>

                            <div class="fields">
                                <div class="four wide field">
                                    <label><?php _e("Last name", "gpdealdomain"); ?> <span style="color:red;">*</span></label>
                                </div>
                                <div class="twelve wide field">
                                    <input type="text" name="last_name_representative1" placeholder="<?php _e("Last name", "gpdealdomain"); ?>" value="<?php echo $last_name_representative1_pro ?>">
                                </div>
                            </div>

                            <div class="fields">
                                <div class="four wide field">
                                    <label><?php _e("Position in the company", "gpdealdomain"); ?> <span style="color:red;">*</span></label>
                                </div>
                                <div class="twelve wide field">
                                    <input type="text" name="function_representative1" placeholder="F<?php _e("Position in the company", "gpdealdomain"); ?>" value="<?php echo $function_representative1_pro ?>">
                                </div>                        
                            </div>

                            <div class="fields">
                                <div class="four wide field">
                                    <label><?php _e("Professional email", "gpdealdomain"); ?> <span style="color:red;">*</span></label>
                                </div>
                                <div class="twelve wide field">
                                    <input type="email" name="email_representative1" placeholder="<?php _e("Professional email professional", "gpdealdomain"); ?>" value="<?php echo $email_representative1_pro ?>">
                                </div>
                            </div>

                            <div class="fields">
                                <div class="four wide field">
                                    <label><?php _e("Mobile phone", "gpdealdomain"); ?><i class="help circle green link icon tooltip">
                                            <span class="tooltiptext"><?php echo __("Number in international format with country code", "gpdealdomain") ?></span>
                                        </i> </label>
                                </div>
                                <div class="twelve wide field">
                                    <input type="tel" name="mobile_phone_number_representative1" placeholder="<?php _e("Mobile phone number", "gpdealdomain"); ?>" value="<?php echo $mobile_phone_number_representative1_pro ?>">
                                </div>
                            </div>

                            <h4 class="ui dividing header"><?php _e("Representative", "gpdealdomain"); ?> 2 (<?php _e("Optional", "gpdealdomain"); ?>)</h4>
                            <div class="fields">
                                <div class="four wide field">
                                    <label><?php _e("Civility", "gpdealdomain"); ?> </label>
                                </div>
                                <div class="twelve wide field">
                                    <div class="inline fields">
                                        <div class="field">
                                            <div class="ui radio checkbox">
                                                <input type="radio" name="civility_representative1" value="Mr." <?php if ($civility_representative2_pro == "Mr."): ?> checked='checked' <?php endif ?>>
                                                <label><?php _e("Mr.", "gpdealdomain"); ?>.</label>
                                            </div>
                                        </div>
                                        <div class="field">
                                            <div class="ui radio checkbox">
                                                <input type="radio" name="civility_representative1" value="Mrs" <?php if ($civility_representative2_pro == "Mrs" || $civility_representative2_pro == "Mme"): ?> checked='checked' <?php endif ?>>
                                                <label><?php _e("Mrs", "gpdealdomain"); ?></label>
                                            </div>
                                        </div>
                                        <div class="field">
                                            <div class="ui radio checkbox">
                                                <input type="radio" name="civility_representative1" value="Ms" <?php if ($civility_representative2_pro == "Mrs" || $civility_representative2_pro == "Mlle"): ?> checked='checked' <?php endif ?>>
                                                <label><?php _e("Ms", "gpdealdomain"); ?></label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="fields">
                                <div class="four wide field">
                                    <label><?php _e("First name", "gpdealdomain"); ?> </label>
                                </div>
                                <div class="twelve wide field">
                                    <input type="text" name="first_name_representative2" placeholder="<?php _e("First name", "gpdealdomain"); ?>" value="<?php echo $first_name_representative2_pro ?>">
                                </div>
                            </div>

                            <div class="fields">
                                <div class="four wide field">
                                    <label><?php _e("Last name", "gpdealdomain"); ?> </label>
                                </div>
                                <div class="twelve wide field">
                                    <input type="text" name="last_name_representative2" placeholder="<?php _e("Last name", "gpdealdomain"); ?>" value="<?php echo $last_name_representative2_pro ?>">
                                </div>
                            </div>

                            <div class="fields">
                                <div class="four wide field">
                                    <label><?php _e("Position in the company", "gpdealdomain"); ?> </label>
                                </div>
                                <div class="twelve wide field">
                                    <input type="text" name="function_representative2" placeholder="<?php _e("Position in the company", "gpdealdomain"); ?>" value="<?php echo $function_representative2_pro ?>">
                                </div>                        
                            </div>

                            <div class="fields">
                                <div class="four wide field">
                                    <label><?php _e("Professional email", "gpdealdomain"); ?> <span style="color:red;">*</span></label>
                                </div>
                                <div class="twelve wide field">
                                    <input type="email" name="email_representative2" placeholder="<?php _e("Professional email address", "gpdealdomain"); ?>" value="<?php echo $email_representative2_pro ?>">
                                </div>
                            </div>

                            <div class="fields">
                                <div class="four wide field">
                                    <label><?php _e("Mobile phone", "gpdealdomain"); ?><i class="help circle green link icon tooltip">
                                            <span class="tooltiptext"><?php echo __("Number in international format with country code", "gpdealdomain") ?></span>
                                        </i></label>
                                </div>
                                <div class="twelve wide field">
                                    <input type="tel" name="mobile_phone_number_representative2" placeholder="<?php _e("Mobile phone number", "gpdealdomain"); ?>" value="<?php echo $mobile_phone_number_representative2_pro ?>">
                                </div>
                            </div>

                            <h4 class="ui dividing header"><?php _e("Login information", "gpdealdomain"); ?></h4>

                            <div class="fields">
                                <div class="four wide field">
                                    <label><?php _e("Company email", "gpdealdomain"); ?> <span style="color:red;">*</span></label>
                                </div>
                                <div class="twelve wide field">
                                    <input type="email" name="email_pro" placeholder="<?php _e("Company email address", "gpdealdomain"); ?>" value="<?php echo $user_email_pro ?>">
                                </div>
                            </div>

                            <div class="fields">
                                <div class="four wide field">
                                    <label><?php _e("Confirm company email", "gpdealdomain"); ?> <span style="color:red;">*</span></label>
                                </div>
                                <div class="twelve wide field">
                                    <input type="email" name="email_confirm_pro" placeholder="<?php _e("Confirm company email address", "gpdealdomain"); ?>" value="<?php echo $user_email_pro; ?>">
                                </div>
                            </div>

                            <?php if (!is_user_logged_in()): ?>

                                <div class="fields">
                                    <div class="four wide field">
                                        <label><?php _e("Password", "gpdealdomain"); ?> <span style="color:red;">*</span></label>
                                    </div>
                                    <div class="twelve wide field">
                                        <div class="ui input right icon show_hide_password_pro">
                                            <i  class="unhide link icon show_hide_password_pro" style="display: none;" input_password_id="show_hide_password_pro"></i>
                                            <input id="show_hide_password_pro" type="password" name="password_pro" placeholder="<?php _e("Password", "gpdealdomain"); ?>" class="visible_password" value="<?php echo $user_pass_pro ?>">
                                        </div>
                                    </div>
                                </div>

                                <div class="fields">
                                    <div class="four wide field">
                                        <label><?php _e("Confirm password", "gpdealdomain"); ?> <span style="color:red;">*</span></label>
                                    </div>
                                    <div class="twelve wide field">
                                        <div class="ui input right icon show_hide_password_confirm_pro">
                                            <i class="unhide link icon show_hide_password_confirm_pro" style="display: none;" input_password_id="show_hide_password_confirm_pro"></i>
                                            <input id="show_hide_password_confirm_pro" type="password" name="password_confirm_pro" placeholder="<?php _e("Password confirmation", "gpdealdomain"); ?>" class="visible_password" value="<?php echo $user_pass_confirm_pro ?>">
                                        </div>

                                    </div>
                                </div>
                            <?php endif ?>
                            <h4 class="ui dividing header"><?php _e("Security information", "gpdealdomain"); ?></h4>

                            <div class="fields">
                                <div class="four wide field">
                                    <label><?php _e("Test question", "gpdealdomain"); ?> <span style="color:red;">*</span></label>
                                </div>
                                <div class="twelve wide field">
                                    <select name="test_question_pro" class="ui search fluid dropdown">
                                        <option value=""><?php _e("Select a test question", "gpdealdomain"); ?>  </option>
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
                                    <label><?php _e("Answer to test question", "gpdealdomain"); ?> <span style="color:red;">*</span></label>
                                </div>
                                <div class="twelve wide field">
                                    <input type="text" name="answer_test_question_pro" placeholder="<?php _e("Answer to test question", "gpdealdomain"); ?>" value="<?php echo $answer_test_question_pro ?>">
                                </div>                              
                            </div>

                            <?php if (!is_user_logged_in()): ?>
                                <div class="fields">
                                    <div class="four wide field">
                                        <!--<label>Code de sécurité <span style="color:red;">*</span></label>-->
                                    </div>                               
                                    <div class="twelve wide field" id="recaptcha_register_pro">
                                    </div>                                
                                </div>
                            <?php endif ?>

                            <div class="inline field" <?php if (is_user_logged_in()): ?> style="display: none" <?php endif ?>>
                                <div class="ui checkbox">
                                    <input type="checkbox" name="terms" <?php if ($terms_pro == 'on' || is_user_logged_in()): ?> checked="checked" <?php endif ?>  > 
                                    <label class="label_terms_use"><span style="color:red;">*</span> <?php _e("I received the registration information", "gpdealdomain"); ?>, <a href="<?php echo wp_make_link_relative(get_permalink(get_page_by_path(__('terms-of-use', 'gpdealdomain')))); ?>"><?php _e("terms of use", "gpdealdomain"); ?></a>, <?php _e("transactions and data protection on this website", "gpdealdomain") ?>.</label>
                                </div>
                            </div>

                            <div class="inline field">
                                <div class="ui checkbox">
                                    <input type="checkbox" name="receive_notifications" <?php if ($receive_notifications_pro == 'on'): ?> checked="checked" <?php endif ?>>
                                    <label class="label_terms_use"><?php _e("I would like to be informed about the products and services of Global Parcel Deal. I can change this setting at any time in the management of my profile information", "gpdealdomain"); ?>.</label>
                                </div>
                            </div>
                            <div class="fields"> 
                                <div id="identity_file_pro_bloc" class="field ">
                                    <?php if ($identity_file_pro_id): ?>
                                        <div id="identity_file_pro_preview" class="ui message"><i class="close icon"></i><a  href="<?php echo wp_make_link_relative(wp_get_attachment_url($identity_file_pro_id)); ?>" class="header"><?php echo basename(get_attached_file($identity_file_pro_id)); ?> </a></div>
                                        <div id="identity_file_pro_link" class="ui green basic icon fluid button" style="display: none"><i class="attach icon"></i> <?php _e("I want to check my identity", "gpdealdomain"); ?> <i class="help circle green link icon tooltip"><span class="tooltiptext"><?php echo __("Download a document to verify your identity", "gpdealdomain") ?></span></i></div>
                                    <?php else: ?>
                                        <div id="identity_file_pro_link" class="ui green basic icon fluid button" ><i class="attach icon"></i> <?php _e("I want to check my identity", "gpdealdomain"); ?> <i class="help circle green link icon tooltip"><span class="tooltiptext"><?php echo __("Download a document to verify your identity", "gpdealdomain") ?></span></i></div>
                                    <?php endif ?>
                                    <div style="height:0px;overflow:hidden">
                                        <input type="file" id="identity_file_pro" name="identity_file_pro">
                                    </div>
                                </div>
                            </div>
                            <?php if ($identity_file_pro_id): ?>
                                <input type="hidden" name="identity_file_pro_id"  value="<?php echo $identity_file_pro_id; ?>">
                            <?php endif ?>
                            <?php if ($role == "professional" || $role == "enterprise"): ?>
                                <div class="field">
                                    <div id="server_error_message" class="ui negative message" style="display:none">
                                        <i class="close icon"></i>
                                        <div id="server_error_content" class="header">Internal server error</div>
                                    </div>
                                    <div id="error_name_message" class="ui negative message" <?php if (isset($_SESSION['error_message'])): ?>style="display:block" <?php else: ?> style="display:none" <?php endif ?>>
                                        <i class="close icon"></i>
                                        <div id="error_name_header" class="header"><?php if (isset($_SESSION['error_message'])): ?> <?php echo __("Error", "gpdealdomain") ?> <?php endif ?></div>
                                        <ul id="error_name_list" class="list">
                                            <?php if (isset($_SESSION['error_message'])): ?>
                                                <li> <?php
                                                    echo $_SESSION['error_message'];
                                                    ?></li>
                                            <?php endif ?>
                                        </ul>
                                    </div>
                                </div>
                            <?php endif ?>
                            <input type="hidden" name='g-recaptcha-response-register' value='<?php echo $g_recaptcha_response; ?>'>
                            <?php if (is_user_logged_in()): ?>
                                <input type="hidden" name='edit_account' value='no'>
                            <?php else: ?>
                                <input type="hidden" name='save_account' value='no'>
                            <?php endif ?>
                            <?php if (is_user_logged_in()): ?>
                                <button id="submit_edit_account_enterprise" class="ui right floated green button" type="submit"<?php _e("Edit my account", "gpdealdomain"); ?></button>
                            <?php else: ?>
                                <button id="submit_create_account_enterprise" class="ui right floated green disabled button" type="submit"><?php _e("Register now", "gpdealdomain"); ?></button>
                            <?php endif ?>        
                        </form>
                    </div>
                </div>

                <div id="block_recap" <?php if (isset($_SESSION['error_message'])): ?>style="display: none" <?php endif ?>> 
                    <?php if ($role == "particular"): ?>
                        <div class='ui form recap'>
                            <div  class="fields"> 
                                <?php //var_dump($profile_picture); ?>
                                <div class="sixteen wide field center aligned">
                                    <img  class="ui tiny image" <?php if ($profile_picture_id): ?> src= "<?php echo wp_get_attachment_url($profile_picture_id); ?>" <?php else: ?> src="<?php echo get_template_directory_uri() ?>/assets/images/avatar.png"<?php endif ?>>
                                </div>
                            </div>
                            <div id="block_recap_desktop">
                                <h4 class="ui dividing header"><?php _e("Civil status", "gpdealdomain"); ?></h4>
                                <div class="fields">
                                    <div class="five wide field">
                                        <span class="span_label"><?php _e("Civility", "gpdealdomain"); ?> : </span>
                                    </div>
                                    <div class="eleven wide field">
                                        <span class="span_value"> <?php _e($gender, "gpdealdomain"); ?></span>
                                    </div>
                                </div>
                                <div class="fields">
                                    <div class="five wide field">
                                        <span class="span_label"><?php _e("First name", "gpdealdomain"); ?> : </span>
                                    </div>
                                    <div class="eleven wide field">
                                        <span class="span_value"> <?php echo $first_name; ?></span>
                                    </div>
                                </div>

                                <div class="fields">
                                    <div class="five wide field">
                                        <span class="span_label"><?php _e("Last name", "gpdealdomain"); ?> :</span>
                                    </div>
                                    <div class="eleven wide field">
                                        <span class="span_value"> <?php echo $last_name; ?></span>
                                    </div>
                                </div>

                                <div class="fields">
                                    <div class="five wide field">
                                        <span class="span_label"><?php _e("Username", "gpdealdomain"); ?> : </span>
                                    </div>
                                    <div class="eleven wide field">
                                        <span class="span_value"><?php echo $user_login; ?></span>
                                    </div>                        
                                </div>

                                <div class="fields">
                                    <div class="five wide field">
                                        <span class="span_label"><?php _e("Birth date", "gpdealdomain"); ?> : </span>
                                    </div>
                                    <div class="eleven wide field">
                                        <span class="span_value"><?php echo $birthdate ?></span>
                                    </div>      
                                </div>

                                <h4 class="ui dividing header"><?php _e("Address", "gpdealdomain"); ?></h4>

                                <div class="fields">
                                    <div class="five wide field">
                                        <span class="span_label"><?php _e("Number and Street", "gpdealdomain"); ?> : </span>
                                    </div>
                                    <div class="eleven wide field">
                                        <span class="span_value"><?php echo $number_street; ?></span>
                                    </div>
                                </div>

                                <div class="fields">
                                    <div class="five wide field">
                                        <span class="span_label"><?php _e("Additional address", "gpdealdomain"); ?> : </span>
                                    </div>
                                    <div class="eleven wide field">
                                        <span class="span_value"><?php echo $complement_address ?></span>
                                    </div>
                                </div>

                                <div class="fields">
                                    <div class="five wide field">
                                        <span class="span_label"><?php _e("Country", "gpdealdomain"); ?> : </span>
                                    </div>
                                    <div class="eleven wide field">
                                        <span class="span_value"><?php echo $country ?></span>
                                    </div>                        
                                </div>

                                <div class="fields">
                                    <div class="five wide field">
                                        <span class="span_label"><?php _e("Region", "gpdealdomain"); ?> : </span>
                                    </div>
                                    <div class="eleven wide field">
                                        <span class="span_value"><?php echo $region; ?></span>
                                    </div>                    
                                </div>

                                <div class="fields">
                                    <div class="five wide field">
                                        <span class="span_label"><?php _e("City", "gpdealdomain"); ?> : </span>
                                    </div>
                                    <div class="eleven wide field">
                                        <span class="span_value"><?php echo $city; ?></span>
                                    </div>                    
                                </div>
                                <div class="fields">
                                    <div class="five wide field">
                                        <span class="span_label"><?php _e("Mobile phone number", "gpdealdomain"); ?> : </span>
                                    </div>
                                    <div class="eleven wide field">
                                        <span class="span_value"><?php echo $mobile_phone_number; ?></span>
                                    </div>       
                                </div>

                                <h4 class="ui dividing header"><?php _e("Login information", "gpdealdomain"); ?> </h4>

                                <div class="fields">
                                    <div class="five wide field">
                                        <span class="span_label"><?php _e("Email", "gpdealdomain"); ?> : </span>
                                    </div>
                                    <div class="eleven wide field">
                                        <span class="span_value"><?php echo $user_email; ?></span>
                                    </div> 
                                </div>

                                <div class="fields">
                                    <div class="five wide field">
                                        <span class="span_label"><?php _e("Password", "gpdealdomain"); ?> : </span>
                                    </div>
                                    <div class="eleven wide field">
                                        <span class="span_value">*********</span>
                                    </div>
                                </div>

                                <h4 class="ui dividing header"><?php _e("Security information", "gpdealdomain"); ?></h4>

                                <div class="fields">
                                    <div class="five wide field">
                                        <span class="span_label"><?php _e("Test question", "gpdealdomain"); ?> : </span>
                                    </div>
                                    <div class="eleven wide field">
                                        <span class="span_value"><?php
                                            $test_question = get_post(intval($test_question_ID));
                                            echo $test_question->post_title
                                            ?></span>
                                    </div>                        
                                </div>
                                <div class="fields">
                                    <div class="five wide field">
                                        <span class="span_label"><?php _e("Answer to test question", "gpdealdomain"); ?> : </span>
                                    </div>
                                    <div class="eleven wide field">
                                        <span class="span_value"><?php echo $answer_test_question; ?></span>
                                    </div>                              
                                </div>
                            </div>


                            <div id="block_recap_mobile" style="display: none;">
                                <h4 class="ui dividing header"><?php _e("Civil status", "gpdealdomain"); ?></h4>
                                <div class="inline field">
                                    <span class="span_label"><?php _e("civility", "gpdealdomain"); ?> : </span>
                                    <span class="span_value"> <?php _e($gender, "gpdealdomain"); ?></span>
                                </div>
                                <div class="inline field">
                                    <span class="span_label"><?php _e("First name", "gpdealdomain"); ?> : </span>

                                    <span class="span_value"> <?php echo $first_name; ?></span>
                                </div>

                                <div class="inline field">
                                    <span class="span_label"><?php _e("Last name", "gpdealdomain"); ?> :</span>

                                    <span class="span_value"> <?php echo $last_name; ?></span>
                                </div>

                                <div class="inline field">
                                    <span class="span_label"><?php _e("Username", "gpdealdomain"); ?> : </span>

                                    <span class="span_value"><?php echo $user_login; ?></span>
                                </div>

                                <div class="inline field">
                                    <span class="span_label"><?php _e("Birth date", "gpdealdomain"); ?> : </span>

                                    <span class="span_value"><?php echo $birthdate ?></span>
                                </div>

                                <h4 class="ui dividing header"><?php _e("Address", "gpdealdomain"); ?></h4>

                                <div class="inline field">
                                    <span class="span_label"><?php _e("Number and Street", "gpdealdomain"); ?> : </span>

                                    <span class="span_value"><?php echo $number_street; ?></span>
                                </div>

                                <div class="inline field">
                                    <span class="span_label"><?php _e("Additional address", "gpdealdomain"); ?> : </span>

                                    <span class="span_value"><?php echo $complement_address ?></span>
                                </div>

                                <div class="inline field">
                                    <span class="span_label"><?php _e("Country", "gpdealdomain"); ?> : </span>

                                    <span class="span_value"><?php echo $country ?></span>
                                </div>

                                <div class="inline field">
                                    <span class="span_label"><?php _e("Region", "gpdealdomain"); ?> : </span>

                                    <span class="span_value"><?php echo $region; ?></span>
                                </div>

                                <div class="inline field">
                                    <span class="span_label"><?php _e("City", "gpdealdomain"); ?> : </span>

                                    <span class="span_value"><?php echo $city; ?></span>
                                </div>
                                <div class="inline field">
                                    <span class="span_label"><?php _e("Mobile phone number", "gpdealdomain"); ?> : </span>

                                    <span class="span_value"><?php echo $mobile_phone_number; ?></span>
                                </div>

                                <h4 class="ui dividing header"><?php _e("Login information", "gpdealdomain"); ?></h4>

                                <div class="inline field">
                                    <span class="span_label"><?php _e("Email", "gpdealdomain"); ?> : </span>

                                    <span class="span_value"><?php echo $user_email; ?></span>
                                </div>

                                <div class="inline field">
                                    <span class="span_label"><?php _e("Password", "gpdealdomain"); ?> : </span>

                                    <span class="span_value">*********</span>
                                </div>

                                <h4 class="ui dividing header"><?php _e("Security information", "gpdealdomain"); ?></h4>

                                <div class="inline field">
                                    <span class="span_label"><?php _e("Test question", "gpdealdomain"); ?> : </span>

                                    <span class="span_value"><?php
                                        $test_question = get_post(intval($test_question_ID));
                                        echo $test_question->post_title
                                        ?></span>
                                </div>
                                <div class="inline field">
                                    <span class="span_label"><?php _e("Answer to test question", "gpdealdomain"); ?> : </span>

                                    <span class="span_value"><?php echo $answer_test_question; ?></span>
                                </div>
                            </div>

                            <!--div class="fields"-->
                            <div class="inline disabled field" <?php if (is_user_logged_in()): ?> style="display: none;" <?php endif ?>>
                                <div class="ui checkbox">
                                    <input type="checkbox" name="terms" <?php if ($terms == 'on' || is_user_logged_in()): ?> checked="checked" <?php endif ?> disabled="disabled"> 
                                    <label class="label_terms_use"><span style="color:red;">*</span> <?php _e("I received the registration information", "gpdealdomain"); ?>, <a href="<?php echo wp_make_link_relative(get_permalink(get_page_by_path(__('terms-of-use', 'gpdealdomain')))); ?>"><?php _e("terms of use", "gpdealdomain"); ?></a>, <?php _e("transactions and data protection on this website", "gpdealdomain") ?>.</label>
                                </div>
                            </div>

                            <div class="inline field">
                                <div class="ui disabled checkbox">
                                    <input type="checkbox" name="receive_notifications" <?php if ($receive_notifications == 'on'): ?> checked="checked" <?php endif ?> disabled='disabled'>
                                    <label class="label_terms_use"><?php _e("I would like to be informed about the products and services of Global Parcel Deal. I can change this setting at any time in the management of my profile information", "gpdealdomain"); ?>.</label>
                                </div>
                            </div>
                            <?php if ($identity_file_id): ?>
                                <div class="fields"> 
                                    <div  class="seven wide field ">
                                        <div class="ui message"><a  href="<?php echo wp_make_link_relative(wp_get_attachment_url($identity_file_id)); ?>" class="header"><?php echo basename(get_attached_file($identity_file_id)); ?> </a></div>
                                    </div>
                                </div>
                            <?php endif ?>
                            <div class="field">
                                <?php if (is_user_logged_in()): ?>
                                    <button id="confirm_edit_account_particular" class="ui right floated green icon button" style="min-width: 12em;"><i class="save icon"></i> <?php _e("Save", "gpdealdomain"); ?></button>
                                <?php else: ?>
                                    <button id="confirm_save_account_particular" class="ui right floated green icon button" style="min-width: 12em;"><i class="save icon"></i> <?php _e("Save", "gpdealdomain"); ?></button>
                                <?php endif ?>

                                <button id="edit_account" class="ui green icon button"  style="min-width: 12em;" ><i class="edit icon"></i> <?php _e("Edit", "gpdealdomain"); ?></button>
                            </div>
                        </div>
                    <?php elseif ($role == "professional" || $role = 'enterprise'): ?>
                        <div class='ui form recap'>
                            <div  class="fields">                               
                                <div class="sixteen wide field center aligned">
                                    <img  class="ui tiny image" <?php if ($company_logo_id): ?> src= "<?php echo wp_get_attachment_url($company_logo_id); ?>" <?php else: ?> src="<?php echo get_template_directory_uri() ?>/assets/images/default_logo.png" <?php endif ?>>
                                </div>
                            </div>
                            <div class="fields">
                                <div class="sixteen wide field center aligned">
                                    <span><?php echo getUserRoleName($role) ?></span>
                                </div>
                            </div>
                            <div id="block_recap_desktop">
                                <h4 class="ui dividing header"><?php _e("Company information", "gpdealdomain"); ?> </h4>
                                <div  class="fields">
                                    <div class="five wide field">
                                        <span class="span_label"><?php _e("Company name", "gpdealdomain"); ?> </span>
                                    </div>
                                    <div class="eleven wide field">
                                        <span class="span_value"><?php echo $company_name_pro ?></span>
                                    </div>                              
                                </div>

                                <div  class="fields">
                                    <div class="five wide field">
                                        <span class="span_label"><?php _e("Legal form", "gpdealdomain"); ?> </span>
                                    </div>
                                    <div class="eleven wide field">
                                        <span class="span_value"><?php echo $company_legal_form_pro ?></span>
                                    </div>                              
                                </div>

                                <div  class="fields">
                                    <div class="five wide field">
                                        <span class="span_label"><?php _e("Company Identification Number", "gpdealdomain"); ?> </span>
                                    </div>
                                    <div class="eleven wide field">
                                        <span class="span_value"><?php echo $company_identity_number_pro ?></span>
                                    </div>
                                </div>

                                <div  class="fields">
                                    <div class="five wide field">
                                        <span class="span_label"><?php _e("Individual VAT identification number", "gpdealdomain"); ?> </label>
                                    </div>
                                    <div class="eleven wide field">
                                        <span class="span_value"><?php echo $company_identity_tva_number_pro ?></span>
                                    </div>
                                </div>


                                <h4 class="ui dividing header"><?php _e("Address", "gpdealdomain"); ?></h4>

                                <div class="fields">
                                    <div class="five wide field">
                                        <span class="span_label"><?php _e("Numero and Street", "gpdealdomain"); ?> </span>
                                    </div>
                                    <div class="eleven wide field">
                                        <span class="span_value"><?php echo $number_street_pro ?></span>
                                    </div>
                                </div>

                                <div class="fields">
                                    <div class="five wide field">
                                        <span class="span_label"><?php _e("Additional address", "gpdealdomain"); ?> : </span>
                                    </div>
                                    <div class="eleven wide field">
                                        <span class="span_value"><?php echo $complement_address_pro ?></span>
                                    </div>
                                </div>

                                <div class="fields">
                                    <div class="five wide field">
                                        <span class="span_label"><?php _e("Country", "gpdealdomain"); ?> : </span>
                                    </div>
                                    <div class="eleven wide field">
                                        <span class="span_value"> <?php echo $country_pro ?></span>
                                    </div>                        
                                </div>

                                <div class="fields">
                                    <div class="five wide field">
                                        <span class="span_label"><?php _e("Region", "gpdealdomain"); ?> :</span>
                                    </div>
                                    <div class="twelve wide field">
                                        <span class="span_value"><?php echo $region_pro ?></span>
                                    </div>             
                                </div>

                                <div class="fields">
                                    <div class="five wide field">
                                        <span class="span_label"><?php _e("City", "gpdealdomain"); ?> : </span>
                                    </div>
                                    <div class="eleven wide field">
                                        <span class="span_value"><?php echo $city_pro ?></span>
                                    </div>             
                                </div>

                                <div class="fields">
                                    <div class="five wide field">
                                        <span class="span_label"><?php _e("Zip code", "gpdealdomain"); ?> : </span>
                                    </div>
                                    <div class="eleven wide field">
                                        <span class="span_value"><?php echo $postal_code_pro ?></span>
                                    </div>                              
                                </div>


                                <div id="fields_home_phone_number" class="fields">
                                    <div class="five wide field">
                                        <span class="span_label"><?php _e("Phone number", "gpdealdomain"); ?> : </span>
                                    </div>
                                    <div class="eleven wide field">
                                        <span class="span_value"><?php echo $home_phone_number_pro ?></span>
                                    </div>                        
                                </div>

                                <h4 class="ui dividing header"><?php _e("Representative", "gpdealdomain"); ?> 1 </h4>
                                <div class="fields">
                                    <div class="five wide field">
                                        <span class="span_label"><?php _e("Civility", "gpdealdomain"); ?> : </span>
                                    </div>
                                    <div class="eleven wide field">
                                        <span class="span_value"><?php _e($civility_representative1_pro, "gpdealdomain"); ?></span>

                                    </div>
                                </div>
                                <div class="fields">
                                    <div class="five wide field">
                                        <span class="span_label"><?php _e("First name", "gpdealdomain"); ?> :</label>
                                    </div>
                                    <div class="eleven wide field">
                                        <span class="span_value"><?php echo $first_name_representative1_pro ?></span>
                                    </div>
                                </div>

                                <div class="fields">
                                    <div class="five wide field">
                                        <span class="span_label"><?php _e("Last name", "gpdealdomain"); ?> :</span>
                                    </div>
                                    <div class="eleven wide field">
                                        <span class="span_value"><?php echo $last_name_representative1_pro ?></span>
                                    </div>
                                </div>

                                <div class="fields">
                                    <div class="five wide field">
                                        <span class="span_label"><?php _e("Position in the company", "gpdealdomain"); ?> : </span>
                                    </div>
                                    <div class="eleven wide field">
                                        <span class="span_value"><?php echo $function_representative1_pro ?></span>
                                    </div>                        
                                </div>

                                <div class="fields">
                                    <div class="five wide field">
                                        <span class="span_label"><?php _e("Professional email", "gpdealdomain"); ?> : </span>
                                    </div>
                                    <div class="eleven wide field">
                                        <span class="span_value"><?php echo $email_representative1_pro ?></span>
                                    </div>
                                </div>

                                <div class="fields">
                                    <div class="five wide field">
                                        <span class="span_label"><?php _e("Mobile phone", "gpdealdomain"); ?> : </span>
                                    </div>
                                    <div class="eleven wide field">
                                        <span class="span_value"><?php echo $mobile_phone_number_representative1_pro ?></span>
                                    </div>
                                </div>

                                <h4 class="ui dividing header"><?php _e("Representative", "gpdealdomain"); ?> 2 (<?php _e("Optional", "gpdealdomain"); ?>)</h4>
                                <div class="fields">
                                    <div class="five wide field">
                                        <span class="span_label"><?php _e("Civility", "gpdealdomain"); ?> :</span>
                                    </div>
                                    <div class="eleven wide field">
                                        <span class="span_value"><?php _e($civility_representative2_pro, "gpdealdomain"); ?></span>
                                    </div>
                                </div>
                                <div class="fields">
                                    <div class="five wide field">
                                        <span class="span_label"><?php _e("First name", "gpdealdomain"); ?> :</span>
                                    </div>
                                    <div class="eleven wide field">
                                        <span class="span_value"><?php echo $first_name_representative2_pro ?></span>
                                    </div>
                                </div>

                                <div class="fields">
                                    <div class="five wide field">
                                        <span class="span_label"><?php _e("Last name", "gpdealdomain"); ?> :</span>
                                    </div>
                                    <div class="eleven wide field">
                                        <span class="span_value"><?php echo $last_name_representative2_pro ?></span>
                                    </div>
                                </div>

                                <div class="fields">
                                    <div class="five wide field">
                                        <span class="span_label"><?php _e("Position in the company", "gpdealdomain"); ?> :</span>
                                    </div>
                                    <div class="eleven wide field">
                                        <span class="span_value"><?php echo $function_representative2_pro ?></span>
                                    </div>                        
                                </div>

                                <div class="fields">
                                    <div class="five wide field">
                                        <span class="span_label"><?php _e("Professional email", "gpdealdomain"); ?> :</span>
                                    </div>
                                    <div class="eleven wide field">
                                        <span class="span_value"><?php echo $email_representative2_pro ?></span>
                                    </div>
                                </div>

                                <div class="fields">
                                    <div class="five wide field">
                                        <span class="span_label"><?php _e("Mobile phone", "gpdealdomain"); ?> :</span>
                                    </div>
                                    <div class="eleven wide field">
                                        <span class="span_value"><?php echo $mobile_phone_number_representative2_pro ?></span>
                                    </div>
                                </div>

                                <h4 class="ui dividing header"><?php _e("Login informations", "gpdealdomain"); ?></h4>

                                <div class="fields">
                                    <div class="five wide field">
                                        <span class="span_label"><?php _e("Company email", "gpdealdomain"); ?> :</span>
                                    </div>
                                    <div class="eleven wide field">
                                        <span class="span_value"><?php echo $user_email_pro ?></span>
                                    </div>
                                </div>

                                <div class="fields">
                                    <div class="five wide field">
                                        <span class="span_label"><?php _e("Password", "gpdealdomain"); ?> :</span>
                                    </div>
                                    <div class="eleven wide field">
                                        <span class="span_value">*******</span>
                                    </div>
                                </div>

                                <h4 class="ui dividing header"><?php _e("Security informations", "gpdealdomain"); ?>é</h4>

                                <div class="fields">
                                    <div class="five wide field">
                                        <span class="span_label"><?php _e("Test question", "gpdealdomain"); ?> :</span>
                                    </div>
                                    <div class="eleven wide field">
                                        <span class="span_value"><?php
                                            $test_question = get_post(intval($test_question_ID_pro));
                                            echo $test_question->post_title
                                            ?></span>
                                    </div>                        
                                </div>
                                <div class="fields">
                                    <div class="five wide field">
                                        <span class="span_label"><?php _e("Answer to test question", "gpdealdomain"); ?> :</span>
                                    </div>
                                    <div class="eleven wide field">
                                        <span class="span_value"> <?php echo $answer_test_question_pro ?> </span>
                                    </div>                              
                                </div>
                            </div>
                            <div id="block_recap_mobile" style="display: none">
                                <h4 class="ui dividing header"><?php _e("Company information", "gpdealdomain"); ?> </h4>
                                <div  class="inline field">
                                    <span class="span_label"><?php _e("Company name", "gpdealdomain"); ?> :</span>

                                    <span class="span_value"><?php echo $company_name_pro ?></span>
                                </div>

                                <div  class="inline field">
                                    <span class="span_label"><?php _e("Legal form", "gpdealdomain"); ?> :</span>

                                    <span class="span_value"><?php echo $company_legal_form_pro ?></span>
                                </div>

                                <div  class="inline field">
                                    <span class="span_label"><?php _e("Company Identification Number", "gpdealdomain"); ?> :</span>

                                    <span class="span_value"><?php echo $company_identity_number_pro ?></span>
                                </div>

                                <div  class="inline field">
                                    <span class="span_label"><?php _e("Individual VAT identification number", "gpdealdomain"); ?> :</span>

                                    <span class="span_value"><?php echo $company_identity_tva_number_pro ?></span>
                                </div>

                                <h4 class="ui dividing header"><?php _e("Address", "gpdealdomain"); ?> :</h4>

                                <div class="inline field">
                                    <span class="span_label"><?php _e("Number and Street", "gpdealdomain"); ?> </span>

                                    <span class="span_value"><?php echo $number_street_pro ?></span>
                                </div>

                                <div class="inline field">
                                    <span class="span_label"><?php _e("Additional address", "gpdealdomain"); ?> : </span>

                                    <span class="span_value"><?php echo $complement_address_pro ?></span>
                                </div>

                                <div class="inline field">
                                    <span class="span_label"><?php _e("Country", "gpdealdomain"); ?> : </span>

                                    <span class="span_value"> <?php echo $country_pro ?></span>
                                </div>

                                <div class="inline field">
                                    <span class="span_label"><?php _e("Region", "gpdealdomain"); ?> :</span>

                                    <span class="span_value"><?php echo $region_pro ?></span>
                                </div>

                                <div class="inline field">
                                    <span class="span_label"><?php _e("City", "gpdealdomain"); ?> : </span>

                                    <span class="span_value"><?php echo $city_pro ?></span>
                                </div>

                                <div class="inline field">
                                    <span class="span_label"><?php _e("Zip code", "gpdealdomain"); ?> : </span>

                                    <span class="span_value"><?php echo $postal_code_pro ?></span>
                                </div>

                                <div id="fields_home_phone_number" class="inline field">
                                    <span class="span_label">Téléphone fixe : </span>

                                    <span class="span_value"><?php echo $home_phone_number_pro ?></span>
                                </div>

                                <h4 class="ui dividing header"><?php _e("Representative", "gpdealdomain"); ?> 1 </h4>
                                <div class="inline field">
                                    <span class="span_label"><?php _e("Civility", "gpdealdomain"); ?> : </span>

                                    <span class="span_value"><?php echo $civility_representative1_pro ?></span>
                                </div>
                                <div class="inline field">
                                    <span class="span_label"><?php _e("First name", "gpdealdomain"); ?> :</label>

                                        <span class="span_value"><?php echo $first_name_representative1_pro ?></span>
                                </div>

                                <div class="inline field">
                                    <span class="span_label"><?php _e("Last name", "gpdealdomain"); ?> :</span>

                                    <span class="span_value"><?php echo $last_name_representative1_pro ?></span>
                                </div>

                                <div class="inline field">
                                    <span class="span_label"><?php _e("Position in the company", "gpdealdomain"); ?> : </span>

                                    <span class="span_value"><?php echo $function_representative1_pro ?></span>
                                </div>

                                <div class="inline field">
                                    <span class="span_label"><?php _e("Professional email", "gpdealdomain"); ?> : </span>

                                    <span class="span_value"><?php echo $email_representative1_pro ?></span>
                                </div>

                                <div class="inline field">
                                    <span class="span_label"><?php _e("Mobile phone", "gpdealdomain"); ?> : </span>

                                    <span class="span_value"><?php echo $mobile_phone_number_representative1_pro ?></span>
                                </div>

                                <h4 class="ui dividing header"><?php _e("Representative", "gpdealdomain"); ?> 2 (<?php _e("Optional", "gpdealdomain"); ?>)</h4>
                                <div class="inline field">
                                    <span class="span_label"><?php _e("Civility", "gpdealdomain"); ?> :</span>

                                    <span class="span_value"><?php echo $civility_representative2_pro ?></span>
                                </div>

                                <div class="inline field">
                                    <span class="span_label"><?php _e("First name", "gpdealdomain"); ?> :</span>

                                    <span class="span_value"><?php echo $first_name_representative2_pro ?></span>
                                </div>

                                <div class="inline field">
                                    <span class="span_label"><?php _e("Last name", "gpdealdomain"); ?> :</span>

                                    <span class="span_value"><?php echo $last_name_representative2_pro ?></span>
                                </div>

                                <div class="inline field">
                                    <span class="span_label"><?php _e("Position in the company", "gpdealdomain"); ?> :</span>

                                    <span class="span_value"><?php echo $function_representative2_pro ?></span>
                                </div>

                                <div class="inline field">
                                    <span class="span_label"><?php _e("Professional email", "gpdealdomain"); ?>l :</span>

                                    <span class="span_value"><?php echo $email_representative2_pro ?></span>
                                </div>

                                <div class="inline field">
                                    <span class="span_label"><?php _e("Mobile phone", "gpdealdomain"); ?> :</span>

                                    <span class="span_value"><?php echo $mobile_phone_number_representative2_pro ?></span>
                                </div>

                                <h4 class="ui dividing header"><?php _e("Login information", "gpdealdomain"); ?></h4>

                                <div class="inline field">
                                    <span class="span_label"><?php _e("Company email", "gpdealdomain"); ?> :</span>

                                    <span class="span_value"><?php echo $user_email_pro ?></span>
                                </div>

                                <div class="inline field">
                                    <span class="span_label"><?php _e("Password", "gpdealdomain"); ?> :</span>

                                    <span class="span_value">*******</span>
                                </div>

                                <h4 class="ui dividing header"><?php _e("Security information", "gpdealdomain"); ?></h4>

                                <div class="inline field">
                                    <span class="span_label"><?php _e("Test question", "gpdealdomain"); ?> :</span>

                                    <span class="span_value"><?php
                                        $test_question = get_post(intval($test_question_ID_pro));
                                        echo $test_question->post_title
                                        ?></span>
                                </div>
                                <div class="inline field">
                                    <span class="span_label"><?php _e("Answer to test question", "gpdealdomain"); ?> :</span>

                                    <span class="span_value"> <?php echo $answer_test_question_pro ?> </span>
                                </div>
                            </div>
                            <div class="inline field" <?php if (is_user_logged_in()): ?> style="display: none" <?php endif ?>>
                                <div class="ui disabled checkbox">
                                    <input type="checkbox" name="terms" <?php if ($terms_pro == 'on' || is_user_logged_in()): ?> checked="checked" <?php endif ?> disabled="disabled"> 
                                    <label class="label_terms_use"><span style="color:red;">*</span> <?php _e("I received the registration information", "gpdealdomain"); ?>, <a href="<?php echo wp_make_link_relative(get_permalink(get_page_by_path(__('terms-of-use', 'gpdealdomain')))); ?>"><?php _e("terms of use", "gpdealdomain"); ?></a>, <?php _e("transactions and data protection on this website", "gpdealdomain") ?>.</label>
                                </div>
                            </div>

                            <div class="inline field">
                                <div class="ui disabled checkbox">
                                    <input type="checkbox" name="receive_notifications" <?php if ($receive_notifications_pro == 'on'): ?> checked="checked" <?php endif ?> disabled="disabled">
                                    <label class="label_terms_use"><?php _e("I would like to be informed about the products and services of Global Parcel Deal. I can change this setting at any time in the management of my profile information", "gpdealdomain"); ?>.</label>
                                </div>
                            </div>
                            <?php if ($identity_file_pro_id): ?>
                                <div class="fields"> 
                                    <div  class="field ">                                   
                                        <div class="ui message"><a  href="<?php echo wp_make_link_relative(wp_get_attachment_url($identity_file_pro_id)); ?>" class="header"><?php echo basename(get_attached_file($identity_file_pro_id)); ?> </a></div>                                  
                                    </div>
                                </div>
                            <?php endif ?>
                            <div class="field">
                                <?php if (is_user_logged_in()): ?>
                                    <button id="confirm_edit_account_enterprise" class="ui right floated green icon button" style="min-width: 12em;"><i class="save icon"></i> <?php _e("Save", "gpdealdomain"); ?></button>
                                <?php else: ?>
                                    <button id="confirm_save_account_enterprise" class="ui right floated green icon button" style="min-width: 12em;"><i class="save icon"></i> <?php _e("Save", "gpdealdomain"); ?></button>
                                <?php endif ?>
                                <button id="edit_account" class="ui green icon button"  style="min-width: 12em;" ><i class="edit icon"></i> <?php _e("Edit", "gpdealdomain"); ?></button>
                            </div>
                        </div>
                        <?php
                    endif;
                    unset($_SESSION['error_message']);
                    ?>
                </div>
            </div>
        </div>
    </div>
</div>