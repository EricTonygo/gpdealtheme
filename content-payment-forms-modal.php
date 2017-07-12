<div id="payment_modal" class="ui small modal">
    <i class="close icon"></i>
    <div class="header">
        <?php echo __("Select Your Payment Type", "gpdealdomain"); ?>
    </div>
    <div class="content">
        <div class="description">
            <div class="ui form">
                <div class="inline field" style="text-align: center">
                    <span class="span_label"><?php _e("Amount Transaction", "gpdealdomain"); ?> : </span>

                    <span class="span_value"> <?php echo "2,00€"; ?></span>
                </div>
                <div class="inline fields">
                    <div class="field">
                        <div class="ui radio checkbox">
                            <input id="payment_gateway_visa" type="radio" name="payment-gateway" checked value="visa">
                            <label><i class="big visa icon"></i> Visa</label>
                        </div>
                    </div>
                    <div class="field">
                        <div class="ui radio checkbox">
                            <input id="payment_gateway_mastercard" type="radio" name="payment-gateway" value="mastercard">
                            <label><i class="big mastercard icon"></i> Mastercard</label>
                        </div>
                    </div>
                    <div class="field">
                        <div class="ui radio checkbox">
                            <input id="payment_gateway_paypal" type="radio" name="payment-gateway" value="paypal">
                            <label><i class="big paypal icon"></i> Paypal</label>
                        </div>
                    </div>
                    <div class="field">
                        <div class="ui radio checkbox">
                            <input id="payment_gateway_stripe" type="radio" name="payment-gateway" value="stripe">
                            <label><i class="big stripe icon"></i> Stripe</label>
                        </div>
                    </div>
                </div>
            </div>
            <form id="payment_form"  method="POST" class="ui form payment_form" action="<?php echo wp_make_link_relative(get_permalink(get_page_by_path(__('payment', 'gpdealdomain')))); ?>" style="margin-bottom: 1em" autocomplete="off" onkeydown="submit_modal_login_form();">
                <h4 class="ui dividing header">Billing Information</h4>
                <input type="hidden" name="card-type" value="visa">
                
                <div class="fields">
                    <div class="seven wide field">
                        <label>Card Number</label>
                        <input type="text" name="card-number" maxlength="16" placeholder="Card number">
                    </div>
                    <div class="three wide field">
                        <label>CVC</label>
                        <input type="text" name="card-cvc" maxlength="3" placeholder="CVC">
                    </div>
                    <div class="six wide field">
                        <label>Expiration</label>
                        <div class="two fields">
                            <div class="field">
                                <select class="ui fluid search dropdown" name="card-expire-month">
                                    <option value="">Month</option>
                                    <option value="1">January</option>
                                    <option value="2">February</option>
                                    <option value="3">March</option>
                                    <option value="4">April</option>
                                    <option value="5">May</option>
                                    <option value="6">June</option>
                                    <option value="7">July</option>
                                    <option value="8">August</option>
                                    <option value="9">September</option>
                                    <option value="10">October</option>
                                    <option value="11">November</option>
                                    <option value="12">December</option>
                                </select>
                            </div>
                            <div class="field">
                                <input type="text" name="card-expire-year" maxlength="4" placeholder="Year">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="field">                    
                    <div class="two fields">
                        <div class="field">
                            <label>First Name</label>
                            <input type="text" name="first-name" placeholder="First Name">
                        </div>
                        <div class="field">
                            <label>Last Name</label>
                            <input type="text" name="last-name" placeholder="Last Name">
                        </div>
                    </div>
                </div>
                <div class="field">
                    <label>Billing Country</label>
                    <div class="fields">
                        <div class="eight wide field">
                            <div class="ui fluid search selection dropdown">
                                <input type="hidden" name="billing-country-code">
                                <i class="dropdown icon"></i>
                                <div class="default text">Select Country</div>
                                <div class="menu">
                                    <div class="item" data-value="af"><i class="af flag"></i>Afghanistan</div>
                                    <div class="item" data-value="ax"><i class="ax flag"></i>Aland Islands</div>
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
        </div>
    </div>
    <div class="actions">
        <div id='cancel_payment' class="ui red cancel button">
            Cancel
        </div>
        <div id='creditcard_process' class="ui green button">
            Process
        </div>
        <div id='paypal_process'  class="ui green button" style="display: none;">
            Process
        </div>
<!--        <div id='stripe_process' class="ui green button" style="display: none;">
            Process
        </div>-->
    </div>
</div>