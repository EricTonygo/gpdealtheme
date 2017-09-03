<?php
get_template_part('top-menu', get_post_format());
?>
<div class="ui tiny borderless second-nav menu">
    <div class="ui container center aligned">
        <div class="center menu">
            <div class="item">
                <a href="<?php echo wp_make_link_relative(home_url('/')); ?>" class="section"><?php echo get_page_by_path(__('home', 'gpdealdomain'))->post_title ?></a>
                <i class="small right chevron icon divider"></i>
                <a href="<?php echo wp_make_link_relative(esc_url(add_query_arg(array('package-id' => $package_id), get_permalink(get_page_by_path(__('my-account', 'gpdealdomain'). '/' . __('create-alert-for-transport-offers', 'gpdealdomain')))))); ?>" class="section"><?php echo get_page_by_path(__('my-account', 'gpdealdomain'). '/' . __('create-alert-for-transport-offers', 'gpdealdomain'))->post_title ?></a>
                <i class="small right arrow icon divider"></i>
                <div class="active section"><?php the_title(); ?></div>
            </div>
        </div>
    </div>
</div>
<div class="ui vertical masthead segment container review_confirm">
    <div class="ui signup_contenair basic segment container content_without_white">
        <div class="ui attached segment select_transport_offers content_without_white" style="padding-left: 0; padding-right: 0;">
            <div class="ui attached message">
                <div class="header"><?php echo __("Transport offers alerts fees", 'gpdealdomain') ?> </div>
                <p class="promo_text_form"><?php echo __("Choose your payment method then pay your transport offers alerts fees", 'gpdealdomain') ?>.</p>
            </div>
            <div class="ui fluid card">
                <div class="content">
                    <?php include(locate_template("content_success_or_faillure_message.php")); ?>
                    <div class="ui form">
                        <div class="inline field" style="text-align: center">
                            <span class="span_label"><?php _e("Cost of SMS and E-mail Alert", "gpdealdomain"); ?> : </span><span class="span_value">2 USD</span>
                        </div>
                        <div class="inline fields">
                            <div class="field">
                                <div class="ui radio checkbox">
                                    <input id="payment_gateway_visa" type="radio" name="payment-gateway" checked value="visa">
                                    <label><img class="ui mini image" src="<?php echo wp_make_link_relative(get_template_directory_uri()) ?>/assets/images/visa-logo.jpg"> Visa</label>
                                </div>
                            </div>
                            <div class="field">
                                <div class="ui radio checkbox">
                                    <input id="payment_gateway_mastercard" type="radio" name="payment-gateway" value="mastercard">
                                    <label><img class="ui mini image" src="<?php echo wp_make_link_relative(get_template_directory_uri()) ?>/assets/images/mastercard-logo.png"> MasterCard</label>
                                </div>
                            </div>
                            <div class="field">
                                <div class="ui radio checkbox">
                                    <input id="payment_gateway_paypal" type="radio" name="payment-gateway" value="paypal">
                                    <label><img class="ui mini image" src="<?php echo wp_make_link_relative(get_template_directory_uri()) ?>/assets/images/paypal-logo.png" style="width: 22px; height: 22px;"> PayPal</label>
                                </div>
                            </div>
                            <div class="field">
                                <div class="ui radio checkbox">
                                    <input id="payment_gateway_stripe" type="radio" name="payment-gateway" value="stripe">
                                    <label><img class="ui mini image" src="<?php echo wp_make_link_relative(get_template_directory_uri()) ?>/assets/images/stripe-logo.png"> Stripe</label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <form id="creditCard_payment_form"  method="POST" class="ui form creditCard_payment_form" action="<?php echo wp_make_link_relative(get_permalink(get_page_by_path(__('my-account', 'gpdealdomain'). '/' . __('create-alert-for-transport-offers', 'gpdealdomain'). '/' . __('payment', 'gpdealdomain')))); ?>" style="margin-bottom: 1em" autocomplete="off">
                        <h4 class="ui dividing header"><?php _e("Billing Information", "gpdealdomain"); ?></h4>
                        <input type="hidden" name="card-type" value="visa">
                        <div class="fields">
                            <div class="seven wide field">
                                <label><?php _e("Card Number", "gpdealdomain"); ?></label>
                                <input type="text" name="card-number" maxlength="16" placeholder="<?php _e("Credit Card Number", "gpdealdomain"); ?>">
                            </div>
                            <div class="three wide field">
                                <label><?php _e("CVC", "gpdealdomain"); ?></label>
                                <input type="text" name="card-cvc" maxlength="3" placeholder="<?php _e("CVC", "gpdealdomain"); ?>">
                            </div>
                            <div class="six wide field">
                                <label><?php _e("Expiration", "gpdealdomain"); ?></label>
                                <div class="two fields">
                                    <div class="field">
                                        <select class="ui fluid search dropdown" name="card-expire-month">
                                            <option value=""><?php _e("Month", "gpdealdomain"); ?></option>
                                            <option value="1"><?php _e("January", "gpdealdomain"); ?></option>
                                            <option value="2"><?php _e("February", "gpdealdomain"); ?></option>
                                            <option value="3"><?php _e("March", "gpdealdomain"); ?></option>
                                            <option value="4"><?php _e("April", "gpdealdomain"); ?></option>
                                            <option value="5"><?php _e("May", "gpdealdomain"); ?></option>
                                            <option value="6"><?php _e("June", "gpdealdomain"); ?></option>
                                            <option value="7"><?php _e("July", "gpdealdomain"); ?></option>
                                            <option value="8"><?php _e("August", "gpdealdomain"); ?></option>
                                            <option value="9"><?php _e("September", "gpdealdomain"); ?></option>
                                            <option value="10"><?php _e("October", "gpdealdomain"); ?></option>
                                            <option value="11"><?php _e("November", "gpdealdomain"); ?></option>
                                            <option value="12"><?php _e("December", "gpdealdomain"); ?></option>
                                        </select>
                                    </div>
                                    <div class="field">
                                        <input type="text" name="card-expire-year" maxlength="4" placeholder="<?php _e("Year", "gpdealdomain"); ?>">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="field">                    
                            <div class="two fields">
                                <div class="field">
                                    <label><?php _e("First Name", "gpdealdomain"); ?></label>
                                    <input type="text" name="first-name" placeholder="<?php _e("First Name", "gpdealdomain"); ?>">
                                </div>
                                <div class="field">
                                    <label><?php _e("Last Name", "gpdealdomain"); ?></label>
                                    <input type="text" name="last-name" placeholder="<?php _e("Last Name", "gpdealdomain"); ?>">
                                </div>
                            </div>
                        </div>
                        <div class="field">
                            <label><?php _e("Billing Country", "gpdealdomain"); ?></label>
                            <div class="fields">
                                <div class="eight wide field">
                                    <div class="ui fluid search selection dropdown">
                                        <input type="hidden" name="billing-country-code">
                                        <i class="dropdown icon"></i>
                                        <div class="default text"><?php _e("Select Country", "gpdealdomain"); ?></div>
                                        <div class="menu">
                                            <div class="item" data-value="af"><i class="af flag"></i>Afghanistan</div>
                                            <div class="item" data-value="ax"><i class="ax flag"></i>Aland Islands</div>
                                            <div class="item" data-value="cm"><i class="cm flag"></i>Cameroon</div>
                                            <div class="item" data-value="us"><i class="us flag"></i>United States</div>
                                        </div>
                                    </div>
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
                    </form>
                    <p>
                        <?php _e("Having trouble making a payment? Please contact us at", "gpdealdomain"); ?> <a href="mailto:contact@gpdeal.com">contact@gpdeal.com</a>
                    </p>
                </div>
                <div class="extra content">
                    <div id='creditcard_process' class="ui green button right floated">
                        <?php _e("Pay with Credit Card", "gpdealdomain"); ?>
                    </div>
                    <a id='paypal_process' href="<?php echo esc_url(add_query_arg(array('payment-method' => "paypal"), get_permalink(get_page_by_path(__('my-account', 'gpdealdomain'). '/' . __('create-alert-for-transport-offers', 'gpdealdomain') . '/' . __('payment', 'gpdealdomain'))))); ?>" class="ui green button right floated" style="display: none;">
                        <?php _e("Pay with PayPal", "gpdealdomain"); ?>
                    </a>
                </div>
            </div>
        </div>
    </div>

</div>

