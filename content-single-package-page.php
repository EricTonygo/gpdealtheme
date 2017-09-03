<?php
get_template_part('top-menu', get_post_format());
if (isset($_SERVER['REQUEST_METHOD']) && $_SERVER['REQUEST_METHOD'] == 'GET') {
    global $current_user;
    $type = wp_get_post_terms(get_the_ID(), 'type_package', array("fields" => "ids"));
    $package_content = get_post_meta(get_the_ID(), 'package-content', true);
    $length = get_post_meta(get_the_ID(), 'length', true);
    $width = get_post_meta(get_the_ID(), 'width', true);
    $height = get_post_meta(get_the_ID(), 'height', true);
    $weight = get_post_meta(get_the_ID(), 'weight', true);
    $package_currency = get_post_meta(get_the_ID(), 'package-currency', true);
    $package_insured = get_post_meta(get_the_ID(), 'package-insured', true);
    $property_value = get_post_meta(get_the_ID(), 'property-value', true);
    $insurance_cost = get_post_meta(get_the_ID(), 'insurance-cost', true);
    $start_country = get_post_meta(get_the_ID(), 'departure-country-package', true);
    $start_state = get_post_meta(get_the_ID(), 'departure-state-package', true);
    $start_city = get_post_meta(get_the_ID(), 'departure-city-package', true);
    $start_date = date('d-m-Y', strtotime(get_post_meta(get_the_ID(), 'date-of-departure-package', true)));
    $destination_country = get_post_meta(get_the_ID(), 'destination-country-package', true);
    $destination_state = get_post_meta(get_the_ID(), 'destination-state-package', true);
    $destination_city = get_post_meta(get_the_ID(), 'destination-city-package', true);
    $destination_date = date('d-m-Y', strtotime(get_post_meta(get_the_ID(), 'arrival-date-package', true)));
    $package_picture_id = get_post_meta(get_the_ID(), 'package-picture-ID', true);
    $action = removeslashes(esc_attr(trim($_GET['action'])));
    $echo_start_city = $start_state != "" ? $start_city . ", " . $start_state . ", " . $start_country : $start_city . ", " . $start_country;
    $echo_destination_city = $destination_state != "" ? $destination_city . ", " . $destination_state . ", " . $destination_country : $destination_city . ", " . $destination_country;
    $share_title = __("Transport offer", "gpdealdomain") . " " . __("from", "gpdealdomain") . " " . $start_city . "(" . $start_date . ") " . __("to", "gpdealdomain") . " " . $destination_city . "(" . $destination_date . ")" . " " . __("on", "gpdealdomain") . " Global Parcel Deal";
    $share_link = esc_url(add_query_arg(array('start-city' => $echo_start_city, "start-date" => $start_date, "destination-city" => $echo_destination_city, "destination-date" => $destination_date), get_permalink(get_page_by_path(__('search-for-transport-offers', 'gpdealdomain')))));
}
$post_author = get_post_field('post_author', get_the_ID());
?>
<div class="ui tiny borderless second-nav menu">
    <div class="ui container center aligned">
        <div class="center menu">
            <div class="item <?php if ($post_author != $current_user->ID): ?>small_breadcumb<?php endif ?>">
                <a href="<?php echo wp_make_link_relative(home_url('/')); ?>" class="section"><?php echo get_page_by_path(__('home', 'gpdealdomain'))->post_title ?></a>
                <i class="small right chevron icon divider"></i>
                <a href="<?php echo wp_make_link_relative(get_permalink(get_page_by_path(__('my-account', 'gpdealdomain')))); ?>" class="section"><?php echo get_page_by_path(__('my-account', 'gpdealdomain'))->post_title ?></a>
                <i class="small right chevron icon divider"></i>
                <?php if ($post_author == $current_user->ID): ?>
                    <a href="<?php echo wp_make_link_relative(get_permalink(get_page_by_path(__('my-account', 'gpdealdomain') . '/' . __('shipments', 'gpdealdomain')))) ?>" class="section"><?php echo __('Shipments', 'gpdealdomain'); ?></a>
                <?php else: ?>
                    <a href="<?php echo wp_make_link_relative(get_permalink(get_page_by_path(__('my-account', 'gpdealdomain') . '/' . __('transport-offers', 'gpdealdomain')))) ?>" class="section"><?php echo __('Transport offers', 'gpdealdomain') ?></a>
                    <i class="small right chevron icon divider"></i>
                    <a href="<?php echo wp_make_link_relative(get_the_permalink($transport_offer_id)); ?>" class="section"><?php echo get_post_field('post_title', $transport_offer_id); ?></a>
                    <i class="small right chevron icon divider"></i>
                    <div class="section"><?php echo __('Carried shipments', 'gpdealdomain'); ?></div>
                <?php endif ?>
                <i class="small right arrow icon divider"></i>
                <div class="active section"><?php the_title(); ?></div>
            </div>
        </div>
    </div>
</div>
<div class="ui vertical masthead segment container">
    <div id='edit_package_infos' class="ui signup_contenair basic segment container content_without_white" <?php if ($action == null || $action != 'edit'): ?> style="display: none;" <?php endif ?>>
        <div class="ui attached message">
            <div class="header"><?php _e("Edit your shipment informations", 'gpdealdomain') ?> </div>
            <!--<p class="promo_text_form"><?php _e("Modify the information below and then search again for the carriers available for your shipment", 'gpdealdomain') ?>.</p>-->
            <p class="promo_text_form"><span style="color: red;">*</span> <?php echo __("Required information", 'gpdealdomain') ?></p>
        </div>
        <div class="ui fluid card">
            <div class="content">
                <?php include(locate_template("content_success_or_faillure_message.php")); ?>
                <div class="ui top attached tabular menu">
                    <div class="item active" data-tab="first"><?php _e("Start", 'gpdealdomain') ?> <br class="mobile_br" style="display: none;"><?php _e("shipment", 'gpdealdomain') ?></div>
                    <div class="item" data-tab="second"><?php _e("How it", "gpdealdomain"); ?> <br class="mobile_br" style="display: none;"><?php _e("works", "gpdealdomain"); ?> ?</div>
                </div>
                <div class="ui bottom attached tab segment active" data-tab="first">
                    <form id='send_package_form'  method="POST" action="<?php echo wp_make_link_relative(get_permalink()); ?>" class="ui form" autocomplete="off" enctype="multipart/form-data">
                        <h4 class="ui dividing header"><?php _e("Departure", "gpdealdomain"); ?> <span style="color:red;">*</span></h4>
                        <div class="two wide fields">
                            <div class="field">
                                <div class="ui input icon start_city">
                                    <!--<i class="marker icon start_city" locality_id='start_city'></i>-->
                                    <i class="remove link icon start_city" style="display: none;" locality_id='start_city'></i>
                                    <input id="start_city" type="text" class="locality" name='start_city' placeholder="<?php _e("Departure city", "gpdealdomain"); ?>" value="<?php echo $echo_start_city; ?>">
                                </div>
                            </div>             
                            <div class="field">
                                <div class="ui calendar" >
                                    <div class="ui input left icon">
                                        <i class="calendar icon"></i>
                                        <input type="text" name='start_date' placeholder="<?php _e("Departure date", "gpdealdomain"); ?>" value="<?php echo $start_date ?>">
                                    </div>
                                </div>
                            </div>      
                        </div>

                        <h4 class="ui dividing header"><?php _e("Destination", "gpdealdomain"); ?> <span style="color:red;">*</span></h4>
                        <div class="two wide fields">
                            <div class="field">
                                <div class="ui input icon destination_city">
                                    <!--<i class="marker icon destination_city" locality_id='destination_city'></i>-->
                                    <i class="remove link icon destination_city" style="display: none;" locality_id='destination_city'></i>
                                    <input id="destination_city" type="text" class="locality" name='destination_city' placeholder="<?php _e("Destination city", "gpdealdomain"); ?>" value="<?php echo $echo_destination_city; ?>">
                                </div>
                            </div>             
                            <div class="field">
                                <div class="ui calendar" >
                                    <div class="ui input left icon">
                                        <i class="calendar icon"></i>
                                        <input type="text" name='destination_date' placeholder="<?php _e("Destination date", "gpdealdomain"); ?>" value="<?php echo $destination_date ?>">
                                    </div>
                                </div>
                            </div>      
                        </div>
                        <h4 class="ui dividing header"><?php echo __("Object to be shipped", "gpdealdomain"); ?></h4>
                        <div class="fields">
                            <div class="four wide field">
                                <label><?php _e("Type", "gpdealdomain"); ?> <span style="color:red;">*</span></label>
                            </div>
                            <div class="twelve wide field">
<!--                                <select name="package_type" class="ui search fluid dropdown" data-validate="package_type">
                                    <option value=""><?php //echo __("Object type to be shipped", "gpdealdomain");   ?></option>
                                <?php
                                //$type_packages = get_terms(array('taxonomy' => 'type_package', 'hide_empty' => false, 'orderby' => 'ID', 'order' => 'ASC'));
                                //foreach ($type_packages as $type_package):
                                ?>
                                        <option value="<?php //echo $type_package->term_id;   ?>" <?php //if (in_array($type_package->term_id, $type, true)):   ?> selected="selected" <?php //endif   ?>><?php //echo __($type_package->name, "gpdealdomain");   ?></option>
                                <?php //endforeach ?>
                                </select>-->
                                <div class="inline fields checkbox_with_icones">
                                    <?php
                                    $type_packages = get_terms(array('taxonomy' => 'type_package', 'hide_empty' => false, 'orderby' => 'ID', 'order' => 'ASC'));
                                    foreach ($type_packages as $type_package):
                                        ?>
                                        <div class="field">
                                            <div class="ui radio checkbox">
                                                <input type="radio" name="package_type" value="<?php echo $type_package->term_id; ?>" <?php if (in_array($type_package->term_id, $type, true)): ?> checked="checked" <?php endif ?>>
                                                <label><?php echo __($type_package->name, "gpdealdomain"); ?>
                                                    <?php if ($type_package->slug == "colis"): ?>
                                                        <i class="big green icon"><img class="ui mini image" src="<?php echo wp_make_link_relative(get_template_directory_uri()) ?>/assets/images/icone_colis.png"></i>
                                                    <?php elseif ($type_package->slug == "autre"): ?>
                                                        <i class="big green icon"><img class="ui mini image" src="<?php echo wp_make_link_relative(get_template_directory_uri()) ?>/assets/images/icone_autre_colis.png"></i>
                                                    <?php elseif ($type_package->slug == "mail"): ?>
                                                        <i class="big green icon"><img class="ui mini image" src="<?php echo wp_make_link_relative(get_template_directory_uri()) ?>/assets/images/icone_courrier.png"></i>
                                                    <?php endif ?>
                                                </label>
                                            </div>
                                        </div>
                                    <?php endforeach ?>
                                </div>
                            </div>
                        </div>
                        <div class="fields">
                            <div class="four wide field">
                                <label><?php echo __("Description", "gpdealdomain"); ?> <span style="color:red;">*</span></label>
                            </div>
                            <div class="twelve wide field">
                                <textarea placeholder="<?php echo __("Describe a content of your shipment here", "gpdealdomain"); ?>" name="package_content" cols="50"><?php echo $package_content; ?></textarea>
                            </div>
                        </div>

                        <div class="fields">
                            <div class="four wide field dim_max_label">
                                <label><?php echo __("Dimensions", "gpdealdomain"); ?> <span style="color:red;">*</span> <i class="help circle green link icon tooltip">
                                        <span class="tooltiptext"><?php echo __("The length, width and height (in cm)", "gpdealdomain") ?>.<br> <?php echo __("Use \".\" For decimal numbers. Ex: 1.5", "gpdealdomain") ?></span>
                                    </i></label>
                            </div>
                            <div class="six wide field">
                                <div class="fields">
                                    <div class="field dim_field_input">
                                        <input type="text" name="package_dimensions_length" placeholder="<?php _e("l(cm)", "gpdealdomain"); ?>" value="<?php echo $length; ?>">
                                    </div>
                                    <div class="field center aligned dim_field_time">
                                        x
                                    </div>
                                    <div class="field dim_field_input">
                                        <input type="text" name="package_dimensions_width" placeholder="<?php _e("w(cm)", "gpdealdomain"); ?>" value="<?php echo $width; ?>">
                                    </div>
                                    <div class="field center aligned dim_field_time">
                                        x
                                    </div>
                                    <div class="field dim_field_input">
                                        <input type="text" name="package_dimensions_height" placeholder="<?php _e("h(cm)", "gpdealdomain"); ?>" value="<?php echo $height; ?>">
                                    </div>

                                </div>
                            </div>
                        </div>

                        <div class="fields">
                            <div class="four wide field">
                                <label><?php echo __("Weight", "gpdealdomain"); ?> <span style="color:red;">*</span> <i class="help circle green link icon tooltip">
                                        <span class="tooltiptext"><?php echo __("The weight of the item to be shipped (in kg)", "gpdealdomain") ?>.<br>
                                            <?php echo __("Use \".\" For decimal numbers. Ex: 1.5", "gpdealdomain") ?></span>
                                    </i> </label>
                            </div>
                            <div class="two wide field">
                                <div class="fields">
                                    <div class="field dim_field_input">
                                        <input type="text" name="package_weight" placeholder="kg" value="<?php echo $weight; ?>">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!--                        <div class="fields fields_bottom_space">
                                                    <div class="four wide field">
                                                        <label><?php echo __("Currency", "gpdealdomain"); ?> <i class="help circle green link icon tooltip">
                                                                <span class="tooltiptext"><?php echo __("The currency to use for display the cost of transport offer", "gpdealdomain") ?></span>
                                                            </i> </label>
                                                    </div>
                                                    <div class="twelve wide field">
                                                        <select id="package_currency" name="package_currency" class="ui search fluid dropdown">
                                                            <option value=""><?php echo __("Currency", 'gpdealdomain') ?></option>
                        <?php
                        $currencies = getCurrenciesList();
                        foreach ($currencies as $currency) :
                            ?>
                                                                        <option value="<?php echo $currency['code'] ?>" <?php if ($currency['code'] == $package_currency): ?> selected="selected" <?php endif ?>><?php echo $currency['name'] . " - " . $currency['code']; ?></option>
                        <?php endforeach; ?>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="fields fields_bottom_space">
                                                    <div class="four wide field">
                                                    </div>
                                                    <div class="twelve wide field">
                                                        <div class="inline field">
                                                            <div class="ui checkbox">
                                                                <input id="package_insured" type="checkbox" name="package_insured" <?php if ($package_insured == 'yes'): ?> checked="checked" <?php endif ?>> 
                                                                <label> <img class="ui mini image insurance_logo" src="<?php echo wp_make_link_relative(get_template_directory_uri()) ?>/assets/images/insurance_logo.jpg"><?php _e("I would like to ensure my shipment", "gpdealdomain"); ?>.</label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                        
                                                <div id="property_value_fields" class="fields" <?php if (!$package_insured || $package_insured == 'no'): ?> style="display: none;" <?php endif ?>>
                                                    <div class="four wide field">
                                                        <label><?php echo __("Value of your property", "gpdealdomain"); ?> </label>
                                                    </div>
                                                    <div class="eight wide field">
                                                        <div class="ui right labeled input">
                                                            <input id="property_value" type="text" name='property_value' placeholder="<?php _e("Enter the value of your property", "gpdealdomain"); ?>" value="<?php echo $property_value; ?>">
                                                            <div id="property_value_currency" class="ui basic label">
                        <?php if ($package_currency): ?> <?php echo $package_currency; ?> <?php else: ?> USD <?php endif ?>
                                                            </div>
                                                        </div>                                     
                                                    </div>
                                                    <div class="four wide field">
                                                        <button id="calculate_insurance_cost" class="ui primary button" name="calculate_ensurance_cost" ><?php _e("Get insurance cost", "gpdealdomain"); ?></button>
                                                    </div>
                                                </div>
                                                <div id="insurance_cost_fields" class="fields" <?php if (!$package_insured || $package_insured == 'no'): ?> style="display: none;" <?php endif ?>>
                                                    <div class="four wide field">
                                                        <label><?php echo __("Insurance cost", "gpdealdomain"); ?> </label>
                                                    </div>
                                                    <div class="eight disabled wide field">
                                                        <div class="ui right labeled input">
                                                            <input id="insurance_cost" type="text" name='insurance_cost' placeholder="<?php _e("Get insurance cost", "gpdealdomain"); ?>" value="<?php echo $insurance_cost; ?>">
                                                            <div id="insurance_cost_currency" class="ui basic label">
                        <?php if ($package_currency): ?> <?php echo $package_currency; ?> <?php else: ?> USD <?php endif ?>
                                                            </div>
                                                        </div>                     
                                                    </div>
                                                    <div class="four wide field">
                                                    </div>
                                                </div>-->

                        <h4 class="ui dividing header"><?php echo __("Picture", "gpdealdomain"); ?></h4>
                        <div  class="fields">
                            <div class="sixteen wide field center aligned">
                                <div id="package_picture_dimmer" class="ui small image" <?php if (!$package_picture_id): ?>style="display: none"<?php endif ?>>
                                    <div class="ui dimmer">
                                        <div class="content">
                                            <div class="center">
                                                <div id="package_picture_loader" class="ui loader content" style="display:none"></div>
                                                <div id="package_picture_remove" class="ui red basic icon button" ><i class="remove icon"></i></div>
                                                <div id="package_picture_edit" class="ui green basic icon button" ><i class="write icon"></i></div>
                                            </div>
                                        </div>
                                    </div>
                                    <img id="package_picture_img" class="ui small image" <?php if ($package_picture_id): ?> src= "<?php echo wp_make_link_relative(wp_get_attachment_url($package_picture_id)); ?>" <?php else: ?> src=""<?php endif ?>>
                                </div>
                                <a id="package_picture_link" class="ui green basic icon button" <?php if ($package_picture_id): ?> style="display: none" <?php endif ?>><i class="file image outline icon"></i> <?php echo __("Add an image of your objects", "gpdealdomain"); ?></a>
                                <div style="height:0px;overflow:hidden">
                                    <input type="file" id="package_picture_file" name="package_picture_file" accept=".jpg,.png,.gif,.jpeg">
                                </div>
                            </div>
                        </div>
                        <?php if ($package_picture_id): ?>
                            <input type="hidden" name="package_picture_id" value="<?php echo $package_picture_id; ?>">
                        <?php endif ?>


                        <div class="inline field">
                            <div class="ui checkbox">
                                <input type="checkbox" name="terms" <?php if ($terms == 'on' || is_user_logged_in()): ?> checked="checked" <?php endif ?>> 
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
                            <input type="hidden" name='action' value='edit'>
                            <input type="hidden" name='package_id' value='<?php the_ID() ?>'>
                            <button id="submit_send_package" class="ui right floated green button" name="submit_update_send_package" value="yes" type="submit" style="min-width: 12em;"><?php _e("Search carriers", "gpdealdomain"); ?></button>
                            <button id="cancel_edit_package_infos_btn" class="ui right floated black button" style="min-width: 12em;"><?php _e("Cancel change", "gpdealdomain"); ?></button>
                        </div>
                    </form>
                </div>
                <div class="ui bottom attached tab segment how_it_works" data-tab="second"> 
                    <?php include(locate_template("content-how-it-works-shipment.php")); ?>
                </div>
            </div>
        </div>
    </div>
    <div id='show_package_infos' class="ui basic segment container" <?php if ($action && $action != 'show'): ?> style="display: none;" <?php endif ?> >
        <div class="ui stackable grid">
            <div class="eleven wide column">
                <div  class="ui fluid card package_card">
                    <?php if ($current_user->ID != $post_author): ?>
                        <div class="image">
                            <div class="content_image_profilename">
                                <?php
                                $carrier_name = get_the_author_meta('user_login');
                                $profile_picture_id = get_user_meta($post_author, 'profile-picture-ID', true) ? get_user_meta($post_author, 'profile-picture-ID', true) : get_user_meta($post_author, 'company-logo-ID', true);
                                ?>
                                <div class="content_image" <?php if ($profile_picture_id): ?> style="background-image: url(<?php echo wp_make_link_relative(wp_get_attachment_url($profile_picture_id)); ?>);" <?php else: ?> style="background-image: url(<?php echo wp_make_link_relative(get_template_directory_uri()) ?>/assets/images/avatar.png);" <?php endif ?>>

                                </div>
                                <div><span class='profile_name'><?php echo get_the_author_meta('user_login', $post_author); ?></span></div>                        
                            </div>
                        </div>
                    <?php endif ?>
                    <div class="content block_recap_desktop">
                        <div class="ui form description">
                            <div class="field">
                                <div class="ui grid">
                                    <div class="six wide column">
                                        <i class="blue big marker icon"></i>
                                        <div class="inline field">
                                            <span class="span_value">
                                                <?php echo $start_city; ?>
                                            </span><br>
                                            <span class="span_value">
                                                (<?php if ($start_state != ""): ?><?php echo $start_state; ?>, <?php endif ?><?php echo $start_country; ?>)
                                            </span>
                                        </div>
                                    </div>
                                    <div class="four wide column">
                                        <i class="blue big long arrow right icon"></i>
                                    </div>
                                    <div class="six wide column">
                                        <i class="blue big flag checkered icon"></i>
                                        <div class="inline field"> 
                                            <span class="span_value">
                                                <?php echo $destination_city; ?>
                                            </span><br>
                                            <span class="span_value">
                                                (<?php if ($destination_state != ""): ?><?php echo $destination_state; ?>, <?php endif; ?><?php echo $destination_country; ?>)
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="field">
                                <div class="ui grid">
                                    <div class="six wide column">
                                        <i class="blue big calendar icon"></i>
                                        <div class="inline field">
                                            <span class="span_value">
                                                <?php echo date('d-m-Y', strtotime($start_date)); ?>
                                            </span>
                                        </div>
                                    </div>
                                    <div class="four wide column">
                                        <i class="blue big long arrow right icon"></i>
                                        <div class="inline field"> 
                                            <span class="span_value">
                                                <?php echo gpdeal_date_diff(date('d-m-Y', strtotime($start_date)), date('d-m-Y', strtotime($destination_date))) ?>j
                                            </span>
                                        </div>
                                    </div>
                                    <div class="six wide column">
                                        <i class="blue big calendar icon"></i>
                                        <div class="inline field"> 
                                            <span class="span_value">
                                                <?php echo date('d-m-Y', strtotime($destination_date)); ?>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="content block_recap_mobile" style="display: none;">
                        <div class="ui form description">
                            <div class="field">
                                <div class="ui grid">
                                    <div class="seven wide column">
                                        <i class="large blue marker icon"></i>
                                        <div class="inline field">
                                            <span class="span_value">
                                                <?php echo $start_city; ?>
                                            </span><br>
                                            <span class="span_value">
                                                (<?php if ($start_state != ""): ?><?php echo $start_state; ?>, <?php endif ?><?php echo $start_country; ?>)
                                            </span>
                                        </div>
                                    </div>
                                    <div class="two wide column">
                                        <i class="large blue long arrow right icon"></i>
                                    </div>
                                    <div class="seven wide column">
                                        <i class="large blue flag checkered icon"></i>
                                        <div class="inline field"> 
                                            <span class="span_value">
                                                <?php echo $destination_city; ?>
                                            </span><br>
                                            <span class="span_value">
                                                (<?php if ($destination_state != ""): ?><?php echo $destination_state; ?>, <?php endif; ?><?php echo $destination_country; ?>)
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="field">
                                <div class="ui grid">
                                    <div class="seven wide column">
                                        <i class="large blue calendar icon"></i>
                                        <div class="inline field">
                                            <span class="span_value">
                                                <?php echo date('d-m-Y', strtotime($start_date)); ?>
                                            </span>
                                        </div>
                                    </div>
                                    <div class="two wide column">
                                        <i class="large blue long arrow right icon"></i>
                                        <div class="inline field"> 
                                            <span class="span_value">
                                                <?php echo gpdeal_date_diff(date('d-m-Y', strtotime($start_date)), date('d-m-Y', strtotime($destination_date))) ?>j
                                            </span>
                                        </div>
                                    </div>
                                    <div class="seven wide column">
                                        <i class="large blue calendar icon"></i>
                                        <div class="inline field"> 
                                            <span class="span_value">
                                                <?php echo date('d-m-Y', strtotime($destination_date)); ?>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="content">
                        <div class="ui form description">
                            <table class="ui celled unstackable table package_table">
                                <tbody>
                                    <tr>
                                        <td>
                                            <span class="span_label"><?php _e("Type", "gpdealdomain"); ?> </span>
                                        </td>
                                        <td>
                                            <span class="span_value">
                                                <?php
                                                $package_type_list = wp_get_post_terms(get_the_ID(), 'type_package', array("fields" => "names"));
                                                $package_type_list_count = count($package_type_list);
                                                $j = 0;
                                                foreach ($package_type_list as $name) :
                                                    ?>
                                                    <?php if ($j < $package_type_list_count - 1) : ?>
                                                        <span><?php echo __($name, "gpdealdomain"); ?>, </span>
                                                    <?php else: ?>
                                                        <span><?php echo __($name, "gpdealdomain"); ?></span>
                                                    <?php endif ?>
                                                    <?php
                                                    $j++;
                                                endforeach
                                                ?>
                                            </span>                                 
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <span class="span_label"><?php echo __("Contents", "gpdealdomain"); ?> </span>
                                        </td>
                                        <td>
                                            <span class="span_value">
                                                <span class="span_value"><?php echo $package_content; ?></span>
                                            </span>
                                        </td>
                                    </tr>
                                    <?php if ($length || $width || $height || $weight) : ?>
                                        <tr>
                                            <td>
                                                <span class="span_label"><?php echo __("Dimensions", 'gpdealdomain') ?>(cm) </span> 
                                            </td>
                                            <td>
                                                <span class="span_value">
                                                    <?php if ($length) : ?><?php _e("abrev_length", "gpdealdomain"); ?>= <?php echo $length; ?>,<?php endif ?>  <?php if ($width) : ?><?php _e("abrev_width", "gpdealdomain"); ?>= <?php echo $width; ?>,<?php endif ?>  <?php if ($height) : ?><?php _e("abrev_height", "gpdealdomain"); ?>= <?php echo $height; ?><?php endif ?>
                                                </span>
                                            </td>
                                        </tr>
                                        <?php if ($weight) : ?>
                                            <tr>
                                                <td>
                                                    <span class="span_label"><?php echo __("Weight", 'gpdealdomain') ?>(kg) </span> 
                                                </td>
                                                <td>
                                                    <span class="span_value">
                                                        <?php echo $weight; ?>
                                                    </span>
                                                </td>
                                            </tr>
                                        <?php endif ?>
                                    <?php endif ?>
                                </tbody>
                            </table>                   

                            <?php if ($package_picture_id): ?>
                                <h4 class="ui dividing header"><?php echo __("Picture", "gpdealdomain"); ?></h4>
                                <div  class="fields">                                
                                    <div class="sixteen wide field center aligned">
                                        <img  class="ui small image"  src= "<?php echo wp_make_link_relative(wp_get_attachment_url($package_picture_id)); ?>">
                                    </div>
                                </div>
                            <?php endif ?>

                            <?php if (get_post_field('post_author', get_the_ID()) == $current_user->ID): ?>
                                <div class="field" style="margin-top: 2em">

                                    <?php if (get_post_meta(get_the_ID(), 'package-status', true) != 3): ?>
                                        <a class="ui right floated basic green button" name="search_transport_offers" href="<?php echo esc_url(add_query_arg(array('package-id' => get_the_ID()), wp_make_link_relative(get_permalink(get_page_by_path(__('select-transport-offers', 'gpdealdomain')))))) ?>" type="submit"><?php _e("Search carriers", "gpdealdomain"); ?></a>
                                    <?php endif ?>
                                    <?php if (get_post_meta(get_the_ID(), 'package-status', true) == 2): ?>
                                        <input type='hidden' id='fence_package_url' value="<?php echo wp_make_link_relative(get_the_permalink()); ?>" >
                                        <button id='fence_package_btn' onclick="fence_send_package_on_single_page(<?php the_ID() ?>)" class="ui right floated green icon button" style="min-width: 12em;"><i class="checkmark icon"></i> <?php echo __("Fence", "gpdealdomain"); ?></button>
                                    <?php endif ?>
                                    <?php if (get_post_meta(get_the_ID(), 'package-status', true) != 3 && get_post_meta(get_the_ID(), 'package-status', true) != 4 && get_post_meta(get_the_ID(), 'package-status', true) != 5): ?>
                                        <button id="edit_package_infos_btn" class="ui right floated green button"><?php echo __("Edit shipment", "gpdealdomain"); ?></button>
                                    <?php endif ?>
                                </div>
                            <?php endif ?>
                        </div>
                    </div>
                </div>
                <?php if ($post_author == $current_user->ID): ?>
                    <div class="ui signup_contenair basic segment container">
                        <div class="ui top attached tabular menu">            
                            <div class="active item" data-tab="carriers-tab"><?php echo __("Carriers", 'gpdealdomain') ?></div>                
                        </div>
                        <div class="ui bottom attached active tab segment" data-tab="carriers-tab" style="border:none;">
                            <?php
                            $carrier_ids = get_post_meta(get_the_ID(), 'carrier-ID', true);
                            if ($carrier_ids != -1 && is_array($carrier_ids)) {
                                $carrier_ids = array_map('intval', $carrier_ids);
                            } else {
                                $carrier_ids = null;
                            }
                            ?>
                            <?php if ($carrier_ids): ?>
                                <div id='list_as_grid_content' class="ui two column doubling stackable grid">
                                    <?php
                                    $carrier_ids_count = count($carrier_ids);
                                    $i = 0;
                                    foreach ($carrier_ids as $id) :
                                        $post_author = get_post_field('post_author', $id);
                                        $carrier_name = $current_user->ID == $post_author ? __("You", "gpdealdomain") : get_the_author_meta('user_login', $post_author);
                                        ?>
                                        <div class="column">
                                            <div class="ui fluid card transport_offer_card">
                                                <div class="content">
                                                    <div class="ui form description">
                                                        <div class="field">
                                                            <div class="ui grid">
                                                                <div class="seven wide column">
                                                                    <i class="blue marker icon"></i>
                                                                    <div class="inline field">
                                                                        <span class="span_value">
                                                                            <?php echo get_post_meta($id, 'departure-city-transport-offer', true) ?>
                                                                        </span><br>
                                                                        <span class="span_value">
                                                                            (<?php echo get_post_meta($id, 'departure-country-transport-offer', true) ?>)
                                                                        </span>
                                                                    </div>
                                                                </div>
                                                                <div class="two wide column">
                                                                    <i class="blue long arrow right icon"></i>
                                                                </div>
                                                                <div class="seven wide column">
                                                                    <i class="blue flag checkered icon"></i>
                                                                    <div class="inline field"> 
                                                                        <span class="span_value">
                                                                            <?php echo get_post_meta($id, 'destination-city-transport-offer', true) ?>
                                                                        </span><br>
                                                                        <span class="span_value">
                                                                            (<?php echo get_post_meta($id, 'destination-country-transport-offer', true) ?>)
                                                                        </span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="field">
                                                            <div class="ui grid">
                                                                <div class="seven wide column">
                                                                    <i class="blue calendar icon"></i>
                                                                    <div class="inline field">
                                                                        <span class="span_value">
                                                                            <?php echo date('d-m-Y', strtotime(get_post_meta($id, 'date-of-departure-transport-offer', true))); ?>
                                                                        </span>
                                                                    </div>
                                                                </div>
                                                                <div class="two wide column">
                                                                    <i class="blue long arrow right icon"></i>
                                                                    <div class="inline field"> 
                                                                        <span class="span_value">
                                                                            <?php echo gpdeal_date_diff(date('d-m-Y', strtotime(get_post_meta($id, 'date-of-departure-transport-offer', true))), date('d-m-Y', strtotime(get_post_meta($id, 'arrival-date-transport-offer', true)))) ?>j
                                                                        </span>
                                                                    </div>
                                                                </div>
                                                                <div class="seven wide column">
                                                                    <i class="blue calendar icon"></i>
                                                                    <div class="inline field"> 
                                                                        <span class="span_value">
                                                                            <?php echo date('d-m-Y', strtotime(get_post_meta($id, 'arrival-date-transport-offer', true))); ?>
                                                                        </span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="content">
                                                    <div class="ui form description">
                                                        <div class="inline field">
                                                           <span class="span_label"><?php echo __("Deadline", "gpdealdomain"); ?><!-- <i class="help circle green link icon deadline_transport_offer_help_link"></i>--> : </span> 
                                                            <span class="span_value">
                                                                <?php echo date('d-m-Y', strtotime(get_post_meta($id, 'deadline-of-proposition-transport-offer', true))); ?>
                                                            </span>
                                                        </div>
                                                        <span class="ui blue right ribbon label">
                                                            <?php
//                                                            $transport_method_list = wp_get_post_terms($id, 'transport-method', array("fields" => "names"));
//                                                            $transport_method = $transport_method_list[0];                                                            
//                                                            $price = getCostOfTransportOffer(get_post_meta($id, 'distance-between-departure-arrival', true), $length, $width, $height, $weight, strtolower($transport_method), 0.001844748, $package_currency);
                                                            ?>
                                                            <?php
                                                            echo get_post_meta($id, 'price', true) . " " . get_post_meta($id, 'currency', true);
//                                                                          echo $price." ".$package_currency;
                                                            ?><?php if (get_post_meta($id, 'price-type', true) == 1): ?>/kg<?php endif ?>
                                                        </span>
                                                    </div>
                                                </div>
                                                <div class="extra content">
                                                    <div class="right floated">
                                                        <div class="ui right pointing dropdown item">
                                                            <i class="ellipsis vertical icon"></i>
                                                            <div class="menu">
                                                                <a href="<?php echo esc_url(add_query_arg(array('action' => 'evaluations'), wp_make_link_relative(get_permalink($id)))) ?>" class=" item">
                                                                    <i class="unhide icon"></i>
                                                                    <?php echo __("View/Evaluate", "gpdealdomain"); ?>
                                                                </a>

                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <?php
                                        $i++;
                                    endforeach
                                    ?>
                                </div>
                            <?php else: ?>
                                <div class="ui warning message">
                                    <div class="content">
                                        <div class="header" style="font-weight: normal;">
                                            <?php echo __("No selected carrier", "gpdealdomain") ?>.
                                        </div>
                                    </div>
                                </div>
                            <?php endif ?>
                        </div>
                    </div>
                <?php endif ?>
            </div>
            <div class="five wide column">
                <div class="ui fluid card">
                    <div class="content">
                        <a class="ui fluid facebook button" href="https://www.facebook.com/sharer/sharer.php?u=<?php print(urlencode($share_link)) ?>&title=<?php print(urlencode($share_title)) ?>" target="_blank" onclick="javascript:window.open(this.href, '_blank', 'location=yes,height=570,width=520,scrollbars=yes,status=yes');">
                            <i class="facebook icon"></i>
                            <?php _e("Share on Facebook", "gpdealdomain"); ?>
                        </a>
                        <a href="https://twitter.com/intent/tweet?status=<?php print(urlencode($share_title)) ?>+<?php print(urlencode($share_link)) ?>" target="_blank" onclick="javascript:window.open(this.href, '_blank', 'location=yes,height=570,width=520,scrollbars=yes,status=yes');" class="ui fluid twitter button">
                            <i class="twitter icon"></i>
                            <?php _e("Share on Twitter", "gpdealdomain"); ?>
                        </a>
                    </div>
                </div>
                <?php
                $search_data = array(
                    "package_type" => $type,
                    "start_country" => $start_country,
                    "start_state" => $start_state,
                    "start_city" => $start_city,
                    'start_date' => $start_date,
                    "destination_country" => $destination_country,
                    "destination_state" => $destination_state,
                    "destination_city" => $destination_city,
                    "destination_date" => $destination_date
                );
                $transport_offers_which_can_interest = new WP_Query(getWPQueryArgsCarrierSearchForWhichCanInterest($search_data, array_map('intval', get_post_meta(get_the_ID(), "carrier-ID", true))));
                if ($transport_offers_which_can_interest->have_posts()):
                    ?>
                    <div class="ui fluid card right_content_unsatisfied_shipments">
                        <div class="content">
                            <div class="header"><?php _e("Transport offers", "gpdealdomain"); ?></div>
                        </div>
                        <?php
                        while ($transport_offers_which_can_interest->have_posts()): $transport_offers_which_can_interest->the_post();
                            $transport_offer_wci_id = get_the_ID();
                            ?>
                            <?php
                            $post_author = get_post_field('post_author', $transport_offer_wci_id);
                            $carrier_name = $current_user->ID == $post_author ? __("You", "gpdealdomain") : get_the_author_meta('user_login');
                            $profile_picture_id = get_user_meta($post_author, 'profile-picture-ID', true) ? get_user_meta($post_author, 'profile-picture-ID', true) : get_user_meta($post_author, 'company-logo-ID', true);
                            $max_length = get_post_meta($transport_offer_wci_id, 'package-length-max', true);
                            $max_width = get_post_meta($transport_offer_wci_id, 'package-width-max', true);
                            $max_height = get_post_meta($transport_offer_wci_id, 'package-height-max', true);
                            $max_weight = get_post_meta($transport_offer_wci_id, 'package-weight-max', true);
                            ?>
                            <div class="item">
                                <div class="ui fluid card package_card">
                                    <div class="image">
                                        <div class="content_image_profilename">
        <!--                                                    <div class="content_image" <?php if ($profile_picture_id): ?> style="background-image: url(<?php echo wp_make_link_relative(wp_get_attachment_url($profile_picture_id)); ?>);" <?php else: ?> style="background-image: url(<?php echo wp_make_link_relative(get_template_directory_uri()) ?>/assets/images/avatar.png);" <?php endif ?>>

                                            </div>-->
                                            <div><span class='profile_name'><?php echo $carrier_name; ?></span></div>
                                            <div class="meta">
                                                <?php
                                                $statistics = getTotalStatistiticsEvaluationsOfCarrier($post_author);
                                                wp_reset_postdata();
                                                ?>
                                                <?php if ($statistics["Evaluation globale"]["vote_count"] > 0): ?>
                                                    <?php
                                                    foreach ($statistics as $stat_key => $stat_value):
                                                        ?>
                                                        <div class="ui form">
                                                            <div class="field disable">
                                                                <span class="ui mini star rating" data-rating="<?php echo $stat_value["weighted_average"]; ?>" data-max-rating="5"></span>
                                                                <a id="<?php echo $transport_offer_wci_id ?>" href="<?php echo esc_url(add_query_arg(array('carrier_id' => $post_author), wp_make_link_relative(get_permalink(get_page_by_path(__('reviews-and-evaluations', 'gpdealdomain')))))); ?>" class="show_reviews_evaluations">
                                                                    <?php echo $stat_value["vote_count"]; ?> <?php _e("reviews", "gpdealdomain"); ?>
                                                                </a>
                                                            </div>
                                                        </div>
                                                    <?php endforeach; ?>
                                                <?php else: ?>
                                                    <span id="<?php echo $transport_offer_wci_id; ?>"  ><i class="star icon"></i> <?php echo __("No reviews", "gpdealdomain"); ?></span>
                                                <?php endif ?>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="content">
                                        <div class="ui form description">
                                            <div class="field">
                                                <div class="ui grid">
                                                    <div class="seven wide column">
                                                        <i class="blue marker icon"></i>
                                                        <div class="inline field">
                                                            <span class="span_value">
                                                                <?php echo get_post_meta($transport_offer_wci_id, 'departure-city-transport-offer', true) ?>
                                                            </span><br>
                                                            <span class="span_value">
                                                                (<?php echo get_post_meta($transport_offer_wci_id, 'departure-country-transport-offer', true) ?>)
                                                            </span>
                                                        </div>
                                                    </div>
                                                    <div class="two wide column">
                                                        <i class="blue long arrow right icon"></i>
                                                    </div>
                                                    <div class="seven wide column">
                                                        <i class="blue flag checkered icon"></i>
                                                        <div class="inline field"> 
                                                            <span class="span_value">
                                                                <?php echo get_post_meta($transport_offer_wci_id, 'destination-city-transport-offer', true) ?>
                                                            </span><br>
                                                            <span class="span_value">
                                                                (<?php echo get_post_meta($transport_offer_wci_id, 'destination-country-transport-offer', true) ?>)
                                                            </span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="field">
                                                <div class="ui grid">
                                                    <div class="seven wide column">
                                                        <i class="blue calendar icon"></i>
                                                        <div class="inline field">
                                                            <span class="span_value">
                                                                <?php echo date('d-m-Y', strtotime(get_post_meta($transport_offer_wci_id, 'date-of-departure-transport-offer', true))); ?>
                                                            </span>
                                                        </div>
                                                    </div>
                                                    <div class="two wide column">
                                                        <i class="blue long arrow right icon"></i>
                                                        <div class="inline field"> 
                                                            <span class="span_value">
                                                                <?php echo gpdeal_date_diff(date('d-m-Y', strtotime(get_post_meta($transport_offer_wci_id, 'date-of-departure-transport-offer', true))), date('d-m-Y', strtotime(get_post_meta($transport_offer_wci_id, 'arrival-date-transport-offer', true)))) ?>j
                                                            </span>
                                                        </div>
                                                    </div>
                                                    <div class="seven wide column">
                                                        <i class="blue calendar icon"></i>
                                                        <div class="inline field"> 
                                                            <span class="span_value">
                                                                <?php echo date('d-m-Y', strtotime(get_post_meta($transport_offer_wci_id, 'arrival-date-transport-offer', true))); ?>
                                                            </span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <?php
                        endwhile;
                        wp_reset_postdata();
                        ?>
                    </div>
                <?php endif ?>
                <?php include(locate_template("content-aside-news.php")); ?>
            </div>
        </div>
    </div>
</div>
<?php
include(locate_template('content-modal-confirmation-package.php'));
