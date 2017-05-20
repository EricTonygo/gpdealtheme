<?php
get_template_part('top-menu', get_post_format());
$package_type = array_map('intval', isset($_POST['transport_offer_package_type']) ? $_POST['transport_offer_package_type'] : array());
$transport_method = array_map('intval', array(removeslashes(esc_attr(trim($_POST['transport_offer_transport_method'])))));
$transport_offer_price = removeslashes(esc_attr(trim($_POST['transport_offer_price'])));
$transport_offer_price_type = removeslashes(esc_attr(trim($_POST['transport_offer_price_type'])));
$transport_offer_currency = removeslashes(esc_attr(trim($_POST['transport_offer_currency'])));
$max_length = removeslashes(esc_attr(trim($_POST['package_length_max'])));
$max_width = removeslashes(esc_attr(trim($_POST['package_width_max'])));
$max_height = removeslashes(esc_attr(trim($_POST['package_height_max'])));
$max_weight = removeslashes(esc_attr(trim($_POST['package_weight_max'])));
$start_city = removeslashes(esc_attr(trim($_POST['start_city'])));
$start_date = removeslashes(esc_attr(trim($_POST['start_date'])));
$deadline_proposition = removeslashes(esc_attr(trim($_POST['start_deadline'])));
$destination_city = removeslashes(esc_attr(trim($_POST['destination_city'])));
$destination_date = removeslashes(esc_attr(trim($_POST['destination_date'])));
$terms = removeslashes(esc_attr(trim($_POST['terms'])));
?>
<div class="ui large borderless second-nav menu">
    <div class="ui container center aligned">
        <div class="center menu">
            <div class="item">
                <a href="<?php echo wp_make_link_relative(home_url('/')); ?>" class="section"><?php echo get_page_by_path(__('home', 'gpdealdomain'))->post_title ?></a>
                <i class="right chevron icon divider"></i>
                <a href="<?php echo wp_make_link_relative(get_permalink(get_page_by_path(__('my-account', 'gpdealdomain')))) ?>" class="section"><?php echo get_page_by_path(__('my-account', 'gpdealdomain'))->post_title ?></a>
                <i class="right chevron icon divider"></i>
                <a href="<?php echo wp_make_link_relative(get_permalink(get_page_by_path(__('my-account', 'gpdealdomain') . '/' . __('transport-offers', 'gpdealdomain')))) ?>" class="section"><?php echo __("Mes offres de transport", "gpdealdomain"); ?></a>
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
            <div class="header"><?php echo __("Enter a transport offer", 'gpdealdomain') ?> : </div>
            <p class="promo_text_form"><?php echo __("Fill in the information below and then publish your transport offer", 'gpdealdomain') ?>.</p>
        </div>
        <div class="ui fluid card">
            <div class="content">
                <p class="required_infos"><span style="color: red;">*</span> <?php echo __("Required informations", 'gpdealdomain') ?></p>
                <div class="ui top attached tabular menu">
                    <div class="item active" data-tab="first"><?php echo __("transport_offer_str_start", 'gpdealdomain') ?> <br class="mobile_br" style="display: none;"><?php echo __("transport_offer_str_end", 'gpdealdomain') ?></div>
                    <div class="item" data-tab="second"><?php echo __("How it", 'gpdealdomain') ?> <br class="mobile_br" style="display: none;"><?php echo __("works", 'gpdealdomain') ?> ?</div>
                </div>
                <div class="ui bottom attached tab segment active" data-tab="first">
                    <form id='write_transport_offer_form'  method="POST" action="<?php echo wp_make_link_relative(get_permalink(get_page_by_path(__('my-account', 'gpdealdomain') . '/' . __('transport-offers', 'gpdealdomain')))); ?>" class="ui form" autocomplete="off">

                        <h4 class="ui dividing header"><?php echo __("Departure", 'gpdealdomain') ?> <span style="color:red;">*</span></h4>
                        <div class="two wide fields">
                            <div class="field">
                                <div class="ui input icon start_city">
                                    <!--<i class="marker icon start_city" locality_id='start_city'></i>-->
                                    <i class="remove link icon start_city" style="display: none;" locality_id='start_city'></i>
                                    <input id="start_city" type="text" class="locality" name='start_city' placeholder="<?php echo __("Departure city", 'gpdealdomain') ?>" value="<?php echo $start_city ?>">
                                </div>
                            </div>             
                            <div class="field">
                                <div class="ui calendar" >
                                    <div class="ui input left icon">
                                        <i class="calendar icon"></i>
                                        <input type="text" name='start_date' placeholder="<?php echo __("Departure date", 'gpdealdomain') ?>" value="<?php echo $start_date ?>">
                                    </div>
                                </div>
                            </div>      
                        </div>

                        <h4 class="ui dividing header"><?php echo __("Destination", 'gpdealdomain') ?> <span style="color:red;">*</span></h4>
                        <div class="two wide fields">
                            <div class="field">
                                <div class="ui input icon destination_city">
                                    <!--<i class="marker icon destination_city" locality_id='destination_city'></i>-->
                                    <i class="remove link icon destination_city" style="display: none;" locality_id='destination_city'></i>
                                    <input id="destination_city" type="text" class="locality" name='destination_city' placeholder="<?php echo __("Destination city", 'gpdealdomain') ?>" value="<?php echo $destination_city ?>">
                                </div>
                            </div>             
                            <div class="field">
                                <div class="ui calendar" >
                                    <div class="ui input left icon">
                                        <i class="calendar icon"></i>
                                        <input type="text" name='destination_date' placeholder="<?php echo __("Destination date", 'gpdealdomain') ?>" value="<?php echo $destination_date ?>">
                                    </div>
                                </div>
                            </div>      
                        </div>
                        <h4 class="ui dividing header"><?php echo __("Offer deadline", 'gpdealdomain') ?> <span style="color:red;">*</span></h4>
                        <div class="field">
                            <div class="ui calendar" >
                                <div class="ui input left icon">
                                    <i class="calendar icon"></i>
                                    <input type="text" name='start_deadline' placeholder="<?php echo __("Offer deadline", 'gpdealdomain') ?>" value="<?php echo $deadline_proposition ?>">
                                </div>
                            </div>
                        </div>      

                        <h4 class="ui dividing header"><?php echo __("Type(s) of object(s) being transported", 'gpdealdomain') ?></h4>
                        <div class="fields">
                            <div class="four wide field">
                                <label><?php echo __("Object", 'gpdealdomain') ?>(s) <span style="color:red;">*</span></label>
                            </div>
                            <div class="twelve wide field">
                                <select name="transport_offer_package_type[]" class="ui fluid multiple normal selection dropdown" multiple="" data-validate='transport_offer_package_type'>
                                    <option value=""><?php echo __("Type(s) of object(s) being transported", 'gpdealdomain') ?> </option>
                                    <?php
                                    $typePackages = get_terms(array('taxonomy' => 'type_package', 'hide_empty' => false, 'orderby' => 'ID', 'order' => 'ASC'));
                                    foreach ($typePackages as $typePackage):
                                        ?>
                                        <option value="<?php echo $typePackage->term_id; ?>" <?php if (in_array($typePackage->term_id, $package_type, true)): ?> selected="selected" <?php endif ?>><?php echo $typePackage->name; ?></option>
                                    <?php endforeach ?>
                                </select>
                            </div>
                        </div>


                        <div class="fields">
                            <div class="four wide field dim_max_label">
                                <label><?php echo __("Max dimensions", 'gpdealdomain') ?> <i class="help circle green link icon tooltip">
                                        <span class="tooltiptext"><?php echo __("Max length, width and height (in cm)", "gpdealdomain") ?></span>
                                    </i></label>
                            </div>
                            <div class="six wide field">
                                <div class="fields">
                                    <div class="field dim_field_input">
                                        <input type="text" name="package_length_max" placeholder="<?php _e("l(cm)", "gpdealdomain"); ?>" value="<?php echo $max_length; ?>">
                                    </div>
                                    <div class="field center aligned dim_field_time">
                                        x
                                    </div>
                                    <div class="field dim_field_input" >
                                        <input type="text" name="package_width_max" placeholder="<?php _e("w(cm)", "gpdealdomain"); ?>" value="<?php echo $max_width; ?>">
                                    </div>
                                    <div class="field center aligned dim_field_time">
                                        x
                                    </div>
                                    <div class="field dim_field_input">
                                        <input type="text" name="package_height_max" placeholder="<?php _e("h(cm)", "gpdealdomain"); ?>" value="<?php echo $max_height; ?>">
                                    </div>

                                </div>
                            </div>
                        </div>

                        <div class="fields">
                            <div class="four wide field">
                                <label><?php echo __("Max weight", 'gpdealdomain') ?><i class="help circle green link icon tooltip">
                                        <span class="tooltiptext"><?php echo __("The maximum weight (in kg)", "gpdealdomain") ?></span>
                                    </i> </label>
                            </div>
                            <div class="two wide field">
                                <div class="fields">
                                    <div class="field dim_field_input">
                                        <input type="text" name="package_weight_max" placeholder="kg" value="<?php echo $max_weight; ?>">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <h4 class="ui dividing header"><?php echo __("Transport information", 'gpdealdomain') ?></h4>
                        <div class="fields">
                            <div class="four wide field">
                                <label><?php echo __('Cost', 'gpdealdomain'); ?> <span style="color:red;">*</span></label>
                            </div>
                            <div class="twelve wide field">
                                <div class="three wide fields">
                                    <div class="field">
                                        <div class="inline fields">                                   
                                            <div class="field">
                                                <div class="ui radio checkbox">
                                                    <input type="radio" name="transport_offer_price_type" value="1">
                                                    <label><?php echo __("Cost", "gpdealdomain"); ?>/kg</label>
                                                </div>
                                            </div>
                                            <div class="field">
                                                <div class="ui radio checkbox">
                                                    <input type="radio" name="transport_offer_price_type" value="2">
                                                    <label><?php echo __("Package_cost", "gpdealdomain"); ?></label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="field">
                                        <input type="text" name="transport_offer_price" placeholder="<?php echo __("Amount", 'gpdealdomain') ?>" value="<?php echo $transport_offer_price; ?>">
                                    </div>
                                    <div class="field">
                                        <select name="transport_offer_currency" class="ui search fluid dropdown">
                                            <option value=""><?php echo __("Currency", 'gpdealdomain') ?></option>
                                            <?php
                                            $currencies = getCurrenciesList();
                                            foreach ($currencies as $currency) :
                                                ?>
                                                <option value="<?php echo $currency['code'] ?>" <?php if ($currency['code'] == $transport_offer_currency): ?> selected="selected" <?php endif ?>><?php echo $currency['name'] . " - " . $currency['code']; ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="fields">
                            <div class="four wide field">
                                <label><?php echo __("Mode", 'gpdealdomain') ?> <span style="color:red;">*</span></label>
                            </div>
                            <div class="twelve wide field">
                                <div class="inline fields">
                                    <?php
                                    $transportMethods = get_terms(array('taxonomy' => 'transport-method', 'hide_empty' => false, 'orderby' => 'ID', 'order' => 'ASC'));
                                    foreach ($transportMethods as $transportMethod):
                                        ?>
                                        <div class="field">
                                            <div class="ui radio checkbox">
                                                <input type="radio" name="transport_offer_transport_method" value="<?php echo $transportMethod->term_id; ?>" <?php if (in_array($transportMethod->term_id, $transport_method, true)): ?> checked="checked" <?php endif ?>>
                                                <label><?php echo $transportMethod->name; ?></label>
                                            </div>
                                        </div>
                                    <?php endforeach ?>
                                </div>
                            </div>
                        </div>

                        <div class="inline field">
                            <div class="ui checkbox">
                                <input type="checkbox" name="terms" <?php if ($terms == 'on'): ?> checked="checked" <?php endif ?>> 
                                <label class="label_terms_use"><span style="color:red;">*</span> <?php _e("I acknowledge having taken the list of", "gpdealdomain"); ?> <a href="#"><?php _e("objects prohibited for transport", "gpdealdomain"); ?></a>.</label>
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
                            <button id="submit_transport_offer" class="ui right floated green button" type="submit" style="min-width: 12em;"><?php _e("Publish offer", "gpdealdomain"); ?></button>
                        </div>
                    </form>
                </div>
                <div class="ui bottom attached tab segment" data-tab="second"> 
                    <?php _e("How it works", "gpdealdomain"); ?>
                </div>

            </div>
        </div>
    </div>
</div>

