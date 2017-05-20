<?php get_template_part('top-menu', get_post_format()); ?>
<div class="ui large borderless second-nav menu">
    <div class="ui container center aligned">
        <div class="center menu">
            <div class="item">
                <a href="<?php echo wp_make_link_relative(home_url('/')); ?>" class="section"><?php echo get_page_by_path(__('home', 'gpdealdomain'))->post_title ?></a>
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
            <div class="header"><?php echo __("Welcome to our website", 'gpdealdomain') ?> ! </div>
            <p class="promo_text_form"><?php echo __("Inscrivez-vous en quelques minutes et profitez pleinement de nos services", 'gpdealdomain') ?> !</p>
        </div>
        <div class="ui fluid card">
            <div class="content">
                <p class="required_infos"><span style="color: red;">*</span> <?php _e("Required informations", "gpdealdomain"); ?></p>
                <div class="ui top attached tabular menu">
                    <div class="item active" data-tab="first"><?php _e("Particular", "gpdealdomain"); ?></div>
                    <div class="item" data-tab="second"><?php _e("Professional", "gpdealdomain"); ?>/<br class="mobile_br" style="display: none;"><?php _e("Enterprise", "gpdealdomain"); ?></div>
                </div>
                <div class="ui bottom attached tab segment active" data-tab="first">
                    <form id='register_form_particular'  method="POST" action="<?php echo wp_make_link_relative(get_permalink(get_page_by_path(__('registration', 'gpdealdomain') . "/" . __('account-summary', 'gpdealdomain')))); ?>" class="ui form" autocomplete="off" enctype="multipart/form-data">
                        <input  type="hidden" name="role" value="particular" >
                        <div  class="fields">
                            <div class="sixteen wide field center aligned">
                                <div><i class="help circle green link icon tooltip"><span class="tooltiptext"><?php echo __("Change your profile picture", "gpdealdomain") ?></span></i></div>
                                <div id="profile_picture_dimmer" class="ui tiny image">
                                    <div class="ui dimmer">
                                        <div class="content">
                                            <div class="center">
                                                <div id="profile_picture_loader" class="ui loader content" style="display:none"></div>
                                                <div id="profile_picture_edit" class="ui green basic icon button" ><i class="write icon"></i></div>
                                            </div>
                                        </div>
                                    </div>
                                    <img id="profile_picture_img" class="ui tiny image" src="<?php echo wp_make_link_relative(get_template_directory_uri()) ?>/assets/images/avatar.png">
                                </div>
                                <div style="height:0px;overflow:hidden">
                                    <input type="file" id="profile_picture_file" name="profile_picture_file" accept=".jpg,.png,.gif,.jpeg">
                                </div>
                            </div>
                        </div>

                        <h4 class="ui dividing header"><?php _e("Civil status", "gpdealdomain"); ?></h4>
                        <div id='civility_bloc' class="fields">
                            <div class="four wide field">
                                <label><?php _e("Civility", "gpdealdomain"); ?> <span style="color:red;">*</span> </label>
                            </div>
                            <div class="twelve wide field">
                                <label class='mobile_label' style="display:none"><?php _e("Civility", "gpdealdomain"); ?> <span style="color:red;">*</span> </label>
                                <div class="inline fields">                                   
                                    <div class="field">
                                        <div class="ui radio checkbox">
                                            <input type="radio" name="gender" value="Mr.">
                                            <label><?php _e("Mr.", "gpdealdomain"); ?></label>
                                        </div>
                                    </div>
                                    <div class="field">
                                        <div class="ui radio checkbox">
                                            <input type="radio" name="gender" value="Mrs">
                                            <label><?php _e("Mrs", "gpdealdomain"); ?></label>
                                        </div>
                                    </div>
                                    <div class="field">
                                        <div class="ui radio checkbox">
                                            <input type="radio" name="gender" value="Ms">
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
                                <input type="text" name="first_name" placeholder="<?php _e("First name", "gpdealdomain"); ?>">
                            </div>
                        </div>

                        <div class="fields">
                            <div class="four wide field">
                                <label><?php _e("Last name", "gpdealdomain"); ?> <span style="color:red;">*</span></label>
                            </div>
                            <div class="twelve wide field">
                                <input type="text" name="last_name" placeholder="<?php _e("Last name", "gpdealdomain"); ?>">
                            </div>
                        </div>

                        <div class="fields">
                            <div class="four wide field">
                                <label><?php _e("Username", "gpdealdomain"); ?> <span style="color:red;">*</span></label>
                            </div>
                            <div class="twelve wide field">
                                <input type="text" name="username" placeholder="<?php _e("Username", "gpdealdomain"); ?>">
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
                                        <input id="birthdate" type="text" name='birthdate' placeholder="<?php _e("Birth date", "gpdealdomain"); ?>">
                                    </div>
                                </div>
                            </div>      
                        </div>
                        

                        <h4 class="ui dividing header"><?php _e("Address", "gpdealdomain"); ?></h4>

                        <div class="fields">
                            <div class="four wide field">
                                <label><?php _e("Number and Street", "gpdealdomain"); ?><span style="color:red;">*</span></label>
                            </div>
                            <div class="twelve wide field">
                                <input type="text" name="number_street" placeholder="<?php _e("Street and number of your address", "gpdealdomain"); ?>">
                            </div>
                        </div>

                        <div class="fields">
                            <div class="four wide field">
                                <label><?php _e("Additional address", "gpdealdomain"); ?> </label>
                            </div>
                            <div class="twelve wide field">
                                <input type="text" name="complement_address" placeholder="<?php _e("Additional address", "gpdealdomain"); ?>">
                            </div>
                        </div>

                        <div class="fields">
                            <div class="four wide field">
                                <label><?php _e("Locality", "gpdealdomain"); ?> <span style="color:red;">*</span></label>
                            </div>
                            <div class="twelve wide field">
                                <div class="ui input icon">
                                    <!--<i class="marker icon locality" locality_id='locality'></i>-->
                                    <i class="remove link icon locality" style="display: none;" locality_id='locality'></i>
                                    <input id="locality" type="text" class="locality" name="locality" placeholder="<?php _e("Your locality", "gpdealdomain"); ?>">
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
                                <input type="tel" name="mobile_phone_number" placeholder="<?php _e("Phone number", "gpdealdomain"); ?>">
                            </div>
                        </div>

                        <div  class="fields">
                            <div class="four wide field">
                                <label><?php _e("Confirm mobile phone", "gpdealdomain"); ?> <span style="color:red;">*</span></label>
                            </div>
                            <div class="twelve wide field">
                                <input type="tel" name="mobile_phone_number_confirm" placeholder="<?php _e("Mobile phone confirmation", "gpdealdomain"); ?>">
                            </div>
                        </div>


                        <h4 class="ui dividing header"><?php _e("Login information", "gpdealdomain"); ?></h4>

                        <div class="fields">
                            <div class="four wide field">
                                <label><?php _e("E-mail", "gpdealdomain"); ?> <span style="color:red;">*</span></label>
                            </div>
                            <div class="twelve wide field">
                                <input type="email" name="email" placeholder="<?php _e("E-mail address", "gpdealdomain"); ?>">
                            </div>
                        </div>

                        <div class="fields">
                            <div class="four wide field">
                                <label><?php _e("E-mail confirmation", "gpdealdomain"); ?> <span style="color:red;">*</span></label>
                            </div>
                            <div class="twelve wide field">
                                <input type="email" name="email_confirm" placeholder="<?php _e("E-mail address confirmation", "gpdealdomain"); ?>">
                            </div>
                        </div>

                        <div class="fields">
                            <div class="four wide field">
                                <label><?php _e("Password", "gpdealdomain"); ?> <span style="color:red;">*</span></label>
                            </div>
                            <div class="twelve wide field">
                                <div class="ui input right icon password_particular">
                                    <i class="unhide link icon password_particular" style="display: none;" input_password_id="password_particular"></i>
                                    <input id="password_particular" type="password" name="password" placeholder="<?php _e("Password", "gpdealdomain"); ?>" class="visible_password">
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
                                    <input id="password_confirm_particular" type="password"  name="password_confirm" placeholder="<?php _e("Password confirmation", "gpdealdomain"); ?> " class="visible_password">
                                </div>
                            </div>
                        </div>

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
                                <label><?php _e("Answer to test question", "gpdealdomain"); ?><span style="color:red;">*</span></label>
                            </div>
                            <div class="twelve wide field">
                                <input type="text" name="answer_test_question" placeholder="<?php _e("Answer to test question", "gpdealdomain"); ?>">
                            </div>                              
                        </div>

                        <div class="fields">
                            <div class="four wide field">
                                <!--<label>Code de sécurité <span style="color:red;">*</span></label>-->
                            </div>
                            <div class="twelve wide field" id="recaptcha_register_particular">
                            </div>                              
                        </div>

                        <div class="inline field">
                            <div class="ui checkbox">
                                <input type="checkbox" name="terms"> 
                                <label class="label_terms_use"><span style="color:red;">*</span> <?php _e("I received the registration information", "gpdealdomain"); ?>, <a href="<?php echo wp_make_link_relative(get_permalink(get_page_by_path(__('terms-of-use', 'gpdealdomain')))); ?>"><?php _e("terms of use", "gpdealdomain"); ?></a>, <?php _e("transactions and data protection on this website", "gpdealdomain") ?>.</label>
                            </div>
                        </div>

                        <div class="inline field">
                            <div class="ui checkbox">
                                <input type="checkbox" name="receive_notifications">
                                <label class="label_terms_use"><?php _e("I would like to be informed about the products and services of Global Parcel Deal. I can change this setting at any time in the management of my profile information", "gpdealdomain"); ?>.</label>
                            </div>
                        </div>
                        <div class="fields"> 
                            <div id="identity_file_bloc" class="seven wide field "> 
                                <a id="identity_file_link" class="ui green basic icon fluid button"><i class="attach icon"></i> <?php _e("I want to check my identity", "gpdealdomain"); ?> <i class="help circle green link icon tooltip"><span class="tooltiptext"><?php echo __("Download a document to verify your identity", "gpdealdomain") ?></span></i></a>
                                <div style="height:0px;overflow:hidden">
                                    <input type="file" id="identity_file" name="identity_file">
                                </div>
                            </div>
                        </div>
                        <div class="field">
                            <div id="server_error_message" class="ui negative message" style="display:none">
                                <i class="close icon"></i>
                                <div id="server_error_content" class="header"><?php _e("Internal server error", "gpdealdomain"); ?></div>
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
                            <button id="submit_create_account_particular" class="ui right floated green disabled button" type="submit"><?php _e("Register now", "gpdealdomain"); ?></button>
                        </div>
                    </form>
                </div>
                <div class="ui bottom attached tab segment" data-tab="second"> 
                    <form id='register_form_enterprise' name="register" method="POST" action="<?php echo wp_make_link_relative(get_permalink(get_page_by_path(__('registration', 'gpdealdomain') . "/" . __('account-summary', 'gpdealdomain')))); ?>" class="ui form" enctype="multipart/form-data" autocomplete="off">
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
                                            <label><?php _e("Professional", "gpdealdomain"); ?></label>
                                        </div>
                                    </div>
                                    <div class="field">
                                        <div class="ui radio checkbox">
                                            <input id="checkbox_enterprise" type="radio" name="role" value="enterprise">
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
                                <input type="text" name="company_name" placeholder="<?php _e("Company name", "gpdealdomain"); ?>">
                            </div>                              
                        </div>

                        <div  class="fields">
                            <div class="four wide field">
                                <label><?php _e("Legal form", "gpdealdomain"); ?> <span style="color:red;">*</span></label>
                            </div>
                            <div class="twelve wide field">
                                <input type="text" name="company_legal_form" placeholder="<?php _e("Legal form of the company", "gpdealdomain"); ?>">
                            </div>                              
                        </div>

                        <div  class="fields">
                            <div class="four wide field">
                                <label><?php _e("Company Identification Number", "gpdealdomain"); ?> <span style="color:red;">*</span></label>
                            </div>
                            <div class="twelve wide field">
                                <input type="text" name="company_identity_number" placeholder="<?php _e("Company Identification Number", "gpdealdomain"); ?>">
                            </div>
                        </div>

                        <div  class="fields">
                            <div class="four wide field">
                                <label><?php _e("Individual VAT identification number", "gpdealdomain"); ?></label>
                            </div>
                            <div class="twelve wide field">
                                <input type="text" name="company_identity_tva_number" placeholder="<?php _e("Individual VAT identification number", "gpdealdomain"); ?>">
                            </div>
                        </div>

                        <h4 class="ui dividing header"><?php _e("Address", "gpdealdomain"); ?></h4>

                        <div class="fields">
                            <div class="four wide field">
                                <label><?php _e("Number and Street", "gpdealdomain"); ?> <span style="color:red;">*</span></label>
                            </div>
                            <div class="twelve wide field">
                                <input type="text" name="number_street" placeholder="<?php _e("Street and number of your address", "gpdealdomain"); ?>">
                            </div>
                        </div>

                        <div class="fields">
                            <div class="four wide field">
                                <label><?php _e("Additional address", "gpdealdomain"); ?> </label>
                            </div>
                            <div class="twelve wide field">
                                <input type="text" name="complement_address" placeholder="<?php _e("Additional address", "gpdealdomain"); ?>">
                            </div>
                        </div>

                        <div class="fields">
                            <div class="four wide field">
                                <label><?php _e("Locality", "gpdealdomain"); ?><span style="color:red;">*</span></label>
                            </div>
                            <div class="twelve wide field">
                                <div class="ui input icon locality_pro">
                                    <i class="remove link icon locality_pro" style="display: none;" locality_id='locality_pro'></i>
                                    <input id="locality_pro" type="text" class="locality" name="locality_pro" placeholder="<?php _e("Your locality", "gpdealdomain"); ?>">
                                </div>
                            </div>                        
                        </div>
                        <div class="fields">
                            <div class="four wide field">
                                <label><?php _e("Zip code", "gpdealdomain"); ?> <span style="color:red;">*</span></label>
                            </div>
                            <div class="twelve wide field">
                                <input type="text" name="postal_code" placeholder="<?php _e("Zip code", "gpdealdomain"); ?>">
                            </div>                              
                        </div>


                        <div id="fields_home_phone_number" class="fields">
                            <div class="four wide field">
                                <label><?php _e("Phone", "gpdealdomain"); ?><i class="help circle green link icon tooltip">
                                            <span class="tooltiptext"><?php echo __("Number in international format with country code", "gpdealdomain") ?></span>
                                        </i> </label>
                            </div>
                            <div class="twelve wide field">
                                <input type="tel" name="home_phone_number" placeholder="<?php _e("Phone number", "gpdealdomain"); ?>">
                            </div>                        
                        </div>

                        <h4 class="ui dividing header"><?php _e("Representative", "gpdealdomain"); ?> 1 </h4>
                        <div class="fields">
                            <div class="four wide field">
                                <label><?php _e("Civility", "gpdealdomain"); ?>  <span style="color:red;">*</span> </label>
                            </div>
                            <div class="twelve wide field">
                                <div class="inline fields">
                                    <div class="field">
                                        <div class="ui radio checkbox">
                                            <input type="radio" name="civility_representative1" value="Mr">
                                            <label><?php _e("Mr", "gpdealdomain"); ?> .</label>
                                        </div>
                                    </div>
                                    <div class="field">
                                        <div class="ui radio checkbox">
                                            <input type="radio" name="civility_representative1" value="Mrs">
                                            <label><?php _e("Mrs", "gpdealdomain"); ?> </label>
                                        </div>
                                    </div>
                                    <div class="field">
                                        <div class="ui radio checkbox">
                                            <input type="radio" name="civility_representative1" value="Ms">
                                            <label><?php _e("Ms", "gpdealdomain"); ?> </label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="fields">
                            <div class="four wide field">
                                <label><?php _e("First name", "gpdealdomain"); ?>  </label>
                            </div>
                            <div class="twelve wide field">
                                <input type="text" name="first_name_representative1" placeholder="<?php _e("First name", "gpdealdomain"); ?>">
                            </div>
                        </div>

                        <div class="fields">
                            <div class="four wide field">
                                <label><?php _e("Last name", "gpdealdomain"); ?> <span style="color:red;">*</span></label>
                            </div>
                            <div class="twelve wide field">
                                <input type="text" name="last_name_representative1" placeholder="<?php _e("Last name", "gpdealdomain"); ?>">
                            </div>
                        </div>

                        <div class="fields">
                            <div class="four wide field">
                                <label><?php _e("Position in the company", "gpdealdomain"); ?> <span style="color:red;">*</span></label>
                            </div>
                            <div class="twelve wide field">
                                <input type="text" name="function_representative1" placeholder="<?php _e("Position in the company", "gpdealdomain"); ?>">
                            </div>                        
                        </div>

                        <div class="fields">
                            <div class="four wide field">
                                <label><?php _e("Professional email", "gpdealdomain"); ?><span style="color:red;">*</span></label>
                            </div>
                            <div class="twelve wide field">
                                <input type="email" name="email_representative1" placeholder="<?php _e("Professional email address", "gpdealdomain"); ?>">
                            </div>
                        </div>

                        <div class="fields">
                            <div class="four wide field">
                                <label><?php _e("Mobile phone", "gpdealdomain"); ?><i class="help circle green link icon tooltip">
                                            <span class="tooltiptext"><?php echo __("Number in international format with country code", "gpdealdomain") ?></span>
                                        </i> </label>
                            </div>
                            <div class="twelve wide field">
                                <input type="tel" name="mobile_phone_number_representative1" placeholder="<?php _e("Mobile phone number", "gpdealdomain"); ?>">
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
                                            <input type="radio" name="civility_representative2" value="Mr">
                                            <label><?php _e("Mr", "gpdealdomain"); ?>.</label>
                                        </div>
                                    </div>
                                    <div class="field">
                                        <div class="ui radio checkbox">
                                            <input type="radio" name="civility_representative2" value="Mrs">
                                            <label><?php _e("Mrs", "gpdealdomain"); ?></label>
                                        </div>
                                    </div>
                                    <div class="field">
                                        <div class="ui radio checkbox">
                                            <input type="radio" name="civility_representative2" value="Ms">
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
                                <input type="text" name="first_name_representative2" placeholder="<?php _e("First name", "gpdealdomain"); ?>">
                            </div>
                        </div>

                        <div class="fields">
                            <div class="four wide field">
                                <label><?php _e("Last name", "gpdealdomain"); ?> </label>
                            </div>
                            <div class="twelve wide field">
                                <input type="text" name="last_name_representative2" placeholder="<?php _e("Last name", "gpdealdomain"); ?>">
                            </div>
                        </div>

                        <div class="fields">
                            <div class="four wide field">
                                <label><?php _e("Position in the company", "gpdealdomain"); ?> </label>
                            </div>
                            <div class="twelve wide field">
                                <input type="text" name="function_representative2" placeholder="<?php _e("Position in the company", "gpdealdomain"); ?>">
                            </div>                        
                        </div>

                        <div class="fields">
                            <div class="four wide field">
                                <label><?php _e("Professional email", "gpdealdomain"); ?> </label>
                            </div>
                            <div class="twelve wide field">
                                <input type="email" name="email_representative2" placeholder="<?php _e("Professional email address", "gpdealdomain"); ?>">
                            </div>
                        </div>

                        <div class="fields">
                            <div class="four wide field">
                                <label><?php _e("Mobile phone", "gpdealdomain"); ?><i class="help circle green link icon tooltip">
                                            <span class="tooltiptext"><?php echo __("Number in international format with country code", "gpdealdomain") ?></span>
                                        </i></label>
                            </div>
                            <div class="twelve wide field">
                                <input type="tel" name="mobile_phone_number_representative2" placeholder="<?php _e("Mobile phone number", "gpdealdomain"); ?>">
                            </div>
                        </div>

                        <h4 class="ui dividing header"><?php _e("Login information", "gpdealdomain"); ?></h4>

                        <div class="fields">
                            <div class="four wide field">
                                <label><?php _e("Company email", "gpdealdomain"); ?> <span style="color:red;">*</span></label>
                            </div>
                            <div class="twelve wide field">
                                <input type="email" name="email_pro" placeholder="<?php _e("Company email address", "gpdealdomain"); ?>">
                            </div>
                        </div>

                        <div class="fields">
                            <div class="four wide field">
                                <label><?php _e("Confirm company email", "gpdealdomain"); ?> <span style="color:red;">*</span></label>
                            </div>
                            <div class="twelve wide field">
                                <input type="email" name="email_confirm_pro" placeholder="<?php _e("Confirm company email address", "gpdealdomain"); ?>">
                            </div>
                        </div>

                        <div class="fields">
                            <div class="four wide field">
                                <label><?php _e("Password", "gpdealdomain"); ?> <span style="color:red;">*</span></label>
                            </div>
                            <div class="twelve wide field">
                                <div class="ui input right icon show_hide_password_pro">
                                    <i  class="unhide link icon show_hide_password_pro" style="display: none;" input_password_id="show_hide_password_pro"></i>
                                    <input id="show_hide_password_pro" type="password" name="password_pro" placeholder="<?php _e("Password", "gpdealdomain"); ?>" class="visible_password">
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
                                    <input id="show_hide_password_confirm_pro" type="password" name="password_confirm_pro" placeholder="<?php _e("Password confirmation", "gpdealdomain"); ?>" class="visible_password">
                                </div>

                            </div>
                        </div>

                        <h4 class="ui dividing header"><?php _e("Security information", "gpdealdomain"); ?></h4>

                        <div class="fields">
                            <div class="four wide field">
                                <label><?php _e("Test question", "gpdealdomain"); ?> <span style="color:red;">*</span></label>
                            </div>
                            <div class="twelve wide field">
                                <select name="test_question_pro" class="ui search fluid dropdown">
                                    <option value=""><?php _e("Select a test question", "gpdealdomain"); ?> </option>
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
                                <label><?php _e("Answer to test question", "gpdealdomain"); ?> <span style="color:red;">*</span></label>
                            </div>
                            <div class="twelve wide field">
                                <input type="text" name="answer_test_question_pro" placeholder="<?php _e("Answer to test question", "gpdealdomain"); ?>">
                            </div>                              
                        </div>

                        <div class="fields">
                            <div class="four wide field">
                                <!--<label>Code de sécurité <span style="color:red;">*</span></label>-->
                            </div>
                            <div class="twelve wide field" id="recaptcha_register_pro">
                            </div>                              
                        </div>


                        <div class="inline field">
                            <div class="ui checkbox">
                                <input type="checkbox" name="terms"> 
                                <label class="label_terms_use"><span style="color:red;">*</span> <?php _e("I received the registration information", "gpdealdomain"); ?>, <a href="<?php echo wp_make_link_relative(get_permalink(get_page_by_path(__('terms-of-use', 'gpdealdomain')))); ?>"><?php _e("terms of use", "gpdealdomain"); ?></a>, <?php _e("transactions and data protection on this website", "gpdealdomain") ?>.</label>
                            </div>
                        </div>

                        <div class="inline field">
                            <div class="ui checkbox">
                                <input type="checkbox" name="receive_notifications">
                                <label class="label_terms_use"><?php _e("I would like to be informed about the products and services of Global Parcel Deal. I can change this setting at any time in the management of my profile information", "gpdealdomain"); ?>.</label>
                            </div>
                        </div>
                        <div class="fields"> 
                            <div id="identity_file_pro_bloc" class="seven wide field "> 
                                <a id="identity_file_pro_link" class="ui green basic icon fluid button"><i class="attach icon"></i> <?php _e("I want to check my identity", "gpdealdomain"); ?> <i class="help circle green link icon tooltip"><span class="tooltiptext"><?php echo __("Download a document to verify your identity", "gpdealdomain") ?></span></i></a>
                                <div style="height:0px;overflow:hidden">
                                    <input type="file" id="identity_file_pro" name="identity_file_pro">
                                </div>
                            </div>
                        </div>
                        

                        <div class="field">
                            <div id="server_error_message_enterprise" class="ui negative message" style="display:none">
                                <i class="close icon"></i>
                                <div id="server_error_content_enterprise" class="header"><?php _e("Internal server error", "gpdealdomain"); ?></div>
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
                        <button id="submit_create_account_enterprise" class="ui right floated green disabled button" type="submit"><?php _e("Register now", "gpdealdomain"); ?></button>
                    </form>
                </div>

            </div>
        </div>
    </div>
</div>

