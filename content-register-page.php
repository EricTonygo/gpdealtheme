<?php get_template_part('top-menu', get_post_format()); ?>
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
<div class="ui vertical masthead  segment container">
    <!--div class="ui text container">
    </div-->
    <div class="ui signup_contenair first_signup_contenair basic segment container content_without_white">
        <div class="ui attached message">
            <div class="header"><?php echo __("Welcome to our website", 'gpdealdomain') ?> ! </div>
            <p class="promo_text_form"><?php echo __("Register in a few minutes and take full advantage of our services", 'gpdealdomain') ?> !</p>
        </div>
        <div class="ui fluid card">
            <div class="content">
                <?php include(locate_template("content_success_or_faillure_message.php")); ?>
                <!--<p class="required_infos"><span style="color: red;">*</span> <?php _e("Required information", "gpdealdomain"); ?></p>-->
                <form id='register_form'  method="POST" action="<?php echo wp_make_link_relative(get_permalink(get_page_by_path(__('registration', 'gpdealdomain') . "/" . __('account-summary', 'gpdealdomain')))); ?>" class="ui form" autocomplete="off" enctype="multipart/form-data">
                    <h4 class="ui dividing header"><?php _e("You are a", "gpdealdomain"); ?> ?</h4>
                    <div id='civility_bloc' class="fields">
                        <div class="four wide field">
                        </div>
                        <div class="twelve wide field">
                            <div class="inline fields">                                   
                                <div class="field">
                                    <div class="ui radio checkbox">
                                        <input type="radio" name="role" value="particular">
                                        <label><?php _e("Particular", "gpdealdomain"); ?></label>
                                    </div>
                                </div>
                                <div class="field">
                                    <div class="ui radio checkbox">
                                        <input type="radio" name="role" value="professional">
                                        <label><?php _e("Professional", "gpdealdomain"); ?></label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <h4 class="ui dividing header"><?php _e("Login information", "gpdealdomain"); ?></h4>

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
                            <label><?php _e("E-mail", "gpdealdomain"); ?> <span style="color:red;">*</span></label>
                        </div>
                        <div class="twelve wide field">
                            <input type="email" name="email" placeholder="<?php _e("E-mail address", "gpdealdomain"); ?>">
                        </div>
                    </div>
                    
                    <div class="fields">
                        <div class="four wide field">
                            <label><?php _e("Confirm e-mail", "gpdealdomain"); ?> <span style="color:red;">*</span></label>
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
                            <!--<label>Code de sécurité <span style="color:red;">*</span></label>-->
                        </div>
                        <div class="twelve wide field" id="recaptcha_register">
                        </div>                              
                    </div>

                    <div class="inline field">
                        <div class="ui checkbox">
                            <input type="checkbox" name="terms"> 
                            <label class="label_terms_use"><span style="color:red;">*</span> <?php _e("I received and accepted the registration information", "gpdealdomain"); ?>, <a href="<?php echo wp_make_link_relative(get_permalink(get_page_by_path(__('terms-of-use', 'gpdealdomain')))); ?>" target="_blank"><?php _e("terms of use", "gpdealdomain"); ?></a>, <?php _e("transactions and data protection on the site gpdeal.com", "gpdealdomain") ?>.</label>
                        </div>
                    </div>

                    <div class="inline field">
                        <div class="ui checkbox">
                            <input type="checkbox" name="receive_notifications">
                            <label class="label_terms_use"><?php _e("I would like to be informed about the products and services of Global Parcel Deal. I can change this setting at any time in the management of my profile information", "gpdealdomain"); ?>.</label>
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
                        <input type="hidden" name='save_account' value='yes'>
                        <button id="confirm_save_account" class="ui right floated green disabled button" type="submit"><?php _e("Register now", "gpdealdomain"); ?></button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

