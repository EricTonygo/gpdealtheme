<?php
get_template_part('top-menu', get_post_format());
?>
<div class="ui tiny borderless second-nav menu">
    <div class="ui container center aligned">
        <div class="center menu">
            <div class="item">
                <a href="<?php echo wp_make_link_relative(home_url('/')); ?>" class="section"><?php echo get_page_by_path(__('home', 'gpdealdomain'))->post_title ?></a>
                <i class="small right chevron icon divider"></i>
                <a href="<?php echo wp_make_link_relative(esc_url(add_query_arg(array('package-id' => $package_id), get_permalink(get_page_by_path(__('select-transport-offers', 'gpdealdomain')))))); ?>" class="section"><?php echo get_page_by_path(__('select-transport-offers', 'gpdealdomain'))->post_title ?></a>
                <i class="small right arrow icon divider"></i>
                <div class="active section"><?php the_title(); ?></div>
            </div>
        </div>
    </div>
</div>
<div class="ui vertical masthead segment container review_confirm">
    <div class="ui signup_contenair basic segment container content_without_white">
        <div class="ui two top attached steps select_transport_offers">
            <a class="step"href="<?php echo esc_url(get_permalink(get_page_by_path(__('select-transport-offers', 'gpdealdomain') . '/' . __('review', 'gpdealdomain')))); ?>">
                <i class="file text outline icon"></i>
                <div class="content">
                    <div class="title"><?php echo __("Review", 'gpdealdomain') ?></div>
                </div>
            </a>
            <a class="active step" href="<?php echo esc_url(get_permalink(get_page_by_path(__('select-transport-offers', 'gpdealdomain') . '/' . __('payment', 'gpdealdomain')))); ?>">
                <i class="umbrella green icon"></i>
                <div class="content">
                    <div class="title"><?php echo __("Insurance", 'gpdealdomain') ?></div>
                </div>
            </a>
        </div>
        <div class="ui attached segment select_transport_offers content_without_white" style="padding-left: 0; padding-right: 0;">
            <div class="ui attached message">
                <div class="header"><?php echo __("Do you want to insure your shipment", 'gpdealdomain') ?> ?</div>
                <p class="promo_text_form"><?php echo __("Enter the value of your property then get the cost of insurance", 'gpdealdomain') ?>.</p>
            </div>
            <div class="ui fluid card">
                <div class="content">
                    <form id="insure_shipment_form"  method="POST" class="ui form insure_shipment_form" action="<?php echo wp_make_link_relative(get_permalink()); ?>" style="margin-bottom: 1em" autocomplete="off">
                        <!--                        <div class="fields fields_bottom_space">
                                                    <div class="four wide field">
                                                        <label><?php echo __("Currency", "gpdealdomain"); ?> <i class="help circle green link icon tooltip">
                                                                <span class="tooltiptext"><?php echo __("The currency to use for display the cost of insurance", "gpdealdomain") ?></span>
                                                            </i> :</label>
                                                    </div>
                                                    <div class="twelve wide field">
                                                        <select id="package_currency" name="package_currency" class="ui search fluid dropdown">
                                                            <option value=""><?php echo __("Currency", 'gpdealdomain') ?></option>
                        <?php
                        $currencies = getCurrenciesList();
                        foreach ($currencies as $currency) :
                            ?>
                                                                                                                <option value="<?php echo $currency['code'] ?>" ><?php echo $currency['name'] . " - " . $currency['code']; ?></option>
                        <?php endforeach; ?>
                                                        </select>
                                                    </div>
                                                </div>-->
                        <div class="sixteen wide field center aligned">
                            <div class="ui tiny image">
                                <img src="<?php echo wp_make_link_relative(get_template_directory_uri()); ?>/assets/images/insurance_logo.jpg">
                            </div>
                        </div>
                        <div class="fields">
                            <div class="six wide field field_bottom_space">
                                <input id="property_value" type="text" name='property_value' placeholder="<?php _e("Enter the value of your property", "gpdealdomain"); ?>">
                            </div>
                            <div class="six wide field field_bottom_space">
                                <select id="package_currency" name="package_currency" class="ui selection dropdown">
                                    <option value=""><?php echo __("Currency", 'gpdealdomain') ?></option>
                                    <?php
                                    $currencies = getCurrenciesList();
                                    foreach ($currencies as $currency) :
                                        ?>
                                        <option value="<?php echo $currency['code'] ?>" <?php if ($currency['code'] == $package_currency): ?> selected="selected" <?php endif ?>><?php echo $currency['name'] . " - " . $currency['code']; ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <div class="four wide field field_bottom_space">
                                <div id="calculate_insurance_cost" class="ui primary button" name="calculate_ensurance_cost" ><?php _e("Get insurance cost", "gpdealdomain"); ?></div>
                            </div>
                        </div>

                        <!--                        <div class="fields">
                                                    <div class="ui action input">
                                                        <input id="property_value" type="text" name='property_value' placeholder="<?php _e("Enter the value of your property", "gpdealdomain"); ?>" style="width: 50%">
                                                        <select id="package_currency" name="package_currency" class="ui selection dropdown">
                                                            <option value=""><?php echo __("Currency", 'gpdealdomain') ?></option>
                        <?php
                        $currencies = getCurrenciesList();
                        foreach ($currencies as $currency) :
                            ?>
                                                                                        <option value="<?php echo $currency['code'] ?>" ><?php echo $currency['name'] . " - " . $currency['code']; ?></option>
                        <?php endforeach; ?>
                                                        </select>
                                                        <div id="calculate_insurance_cost" class="ui primary button" name="calculate_ensurance_cost" ><?php _e("Get insurance cost", "gpdealdomain"); ?></div>
                                                    </div>
                                                </div>-->
                        <!--                        <div id="property_value_fields" class="fields">
                                                    <div class="four wide field">
                                                        <label><?php echo __("Value of your property", "gpdealdomain"); ?> :</label>
                                                    </div>
                                                    <div class="eight wide field">
                                                        <div class="ui right labeled input">
                                                            <input id="property_value" type="text" name='property_value' placeholder="<?php _e("Enter the value of your property", "gpdealdomain"); ?>" value="<?php echo $property_value; ?>">
                                                            <div id="property_value_currency" class="ui basic label">
                                                                USD
                                                            </div>
                                                        </div>                                     
                                                    </div>
                                                    <div class="four wide field">
                                                        <div id="calculate_insurance_cost" class="ui primary button" name="calculate_ensurance_cost" ><?php _e("Get insurance cost", "gpdealdomain"); ?></div>
                                                    </div>
                                                </div>-->
                        <div id="insurance_cost_fields" class="fields" style="display: none;">
<!--                            <label class="span_label"><?php echo __("Insurance cost", "gpdealdomain"); ?> :</label>
                            <div class="eight disabled wide field">                                
                                <div class="ui right labeled input">
                                    <input id="insurance_cost" type="text" name='insurance_cost' placeholder="<?php _e("Get insurance cost", "gpdealdomain"); ?>" value="<?php echo $insurance_cost; ?>">
                                    <div id="insurance_cost_currency" class="ui basic label">
                                         USD
                                </div>                     
                            </div>
                            <div class="four wide field">
                            </div>-->
                            <div class="sixteen wide field center aligned">
                                <div  class="ui tiny horizontal statistic">
                                    <div class="value">
                                        <span id="insurance_cost"></span> <span id="insurance_cost_currency"><?php echo $package_currency; ?></span>
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
                        <input type='hidden' name='shipment-insured' value="yes">
<!--                        <p>
                        <?php _e("Having trouble making a payment? Please contact us at", "gpdealdomain"); ?> <a href="mailto:contact@gpdeal.com">contact@gpdeal.com</a>
</p>-->
                    </form>
                    <form id="not_insure_shipment_form"  method="POST" class="ui form insure_shipment_form" action="<?php echo wp_make_link_relative(get_permalink()); ?>" style="margin-bottom: 1em" autocomplete="off">
                        <input type='hidden' name='shipment-insured' value="no">
                    </form>
                </div>
                <div class="extra content">
                    <div class="action right aligned">
                        <button id='insure_shimpent_no' class="ui black button">
                            <?php _e("No", "gpdealdomain"); ?>
                        </button>
                        <button id='insure_shimpent_yes' class="ui green button right labeled icon field_bottom_space">
                            <?php _e("Yes", "gpdealdomain"); ?>
                            <i class="checkmark icon"></i>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

