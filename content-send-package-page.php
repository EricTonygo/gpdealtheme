<?php
get_template_part('top-menu', get_post_format());
$type = removeslashes(esc_attr(trim($_POST['package_type'])));
$content = array_map('intval', isset($_POST['portable_objects']) ? $_POST['portable_objects'] : array());
$length = removeslashes(esc_attr(trim($_POST['package_dimensions_length'])));
$width = removeslashes(esc_attr(trim($_POST['package_dimensions_width'])));
$height = removeslashes(esc_attr(trim($_POST['package_dimensions_height'])));
$weight = removeslashes(esc_attr(trim($_POST['package_weight'])));
$start_city = removeslashes(esc_attr(trim($_POST['start_city'])));
$start_date_string = removeslashes(esc_attr(trim($_POST['start_date'])));
$destination_city = removeslashes(esc_attr(trim($_POST['destination_city'])));
$destination_date_string = removeslashes(esc_attr(trim($_POST['destination_date'])));
$terms = removeslashes(esc_attr(trim($_POST['terms'])));
if (isset($_POST['selected_transport_offers'])) {
    $selected_transport_offers = array_map('intval', $_POST['selected_transport_offers']);
}
?>
<div class="ui large borderless second-nav menu">
    <div class="ui container center aligned">
        <div class="center menu">
            <div class="item">
                <a href="<?php echo wp_make_link_relative(home_url('/')); ?>" class="section"><?php echo get_page_by_path(__('home', 'gpdealdomain'))->post_title ?></a>
                <i class="right chevron icon divider"></i>
                <a href="<?php echo wp_make_link_relative(get_permalink(get_page_by_path(__('my-account', 'gpdealdomain')))); ?>" class="section"><?php echo get_page_by_path(__('my-account', 'gpdealdomain'))->post_title ?></a>
                <i class="right chevron icon divider"></i>
                <a href="<?php echo wp_make_link_relative(get_permalink(get_page_by_path(__('my-account', 'gpdealdomain') . '/' . __('shipments', 'gpdealdomain')))); ?>" class="section"><?php echo __('Shipments', 'gpdealdomain'); ?></a>
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
            <div class="header"><?php echo __("Publish Shipment", 'gpdealdomain') ?> : </div>
            <?php if (isset($_POST["confirm_transaction"]) && $_POST["confirm_transaction"] == "true"): ?>
                <p class="promo_text_form"><?php echo __("Fill in the information below to complete your transaction", 'gpdealdomain') ?>.</p>
            <?php else: ?>
                <p class="promo_text_form"><?php echo __("Fill in the information below and search for carriers available for your shipment", 'gpdealdomain') ?>.</p>
            <?php endif ?>
        </div>
        <div class="ui fluid card">
            <div class="content">
                <p class="required_infos"><span style="color: red;">*</span> <?php _e("Required informations", "gpdealdomain"); ?></p>
                <div class="ui top attached tabular menu">
                    <div class="item active" data-tab="first"><?php _e("Start", "gpdealdomain");?> <br class="mobile_br" style="display: none;"><?php _e("shipment", "gpdealdomain");?> </div>
                    <div class="item" data-tab="second"><?php _e("How it", "gpdealdomain");?> <br class="mobile_br" style="display: none;"><?php _e("works", "gpdealdomain");?> ?</div>
                </div>
                <div class="ui bottom attached tab segment active" data-tab="first">
                    <?php if (isset($_POST["confirm_transaction"]) && $_POST["confirm_transaction"] == "true"): ?>
                        <form id='send_package_form'  method="POST" action="<?php echo wp_make_link_relative(get_permalink(get_page_by_path(__('my-account', 'gpdealdomain') . '/' . __('show-carriers-contacts', 'gpdealdomain')))); ?>" class="ui form" autocomplete="off" enctype="multipart/form-data">                    
                        <?php else: ?>
                            <form id='send_package_form'  method="POST" action="<?php echo wp_make_link_relative(get_permalink(get_page_by_path(__('select-transport-offers', 'gpdealdomain')))); ?>" class="ui form" autocomplete="off" enctype="multipart/form-data">  
                            <?php endif ?>
                            <h4 class="ui dividing header"><?php _e("Departure", "gpdealdomain");?> <span style="color:red;">*</span></h4>
                            <div class="two wide fields">
                                <div class="field">
                                    <div class="ui input icon start_city">
                                        <!--<i class="marker icon start_city" locality_id='start_city'></i>-->
                                        <i class="remove link icon start_city" style="display: none;" locality_id='start_city'></i>
                                        <input id="start_city" type="text" class="locality" name='start_city' placeholder="<?php _e("Departure city", "gpdealdomain");?>" value="<?php echo $start_city ?>">
                                    </div>
                                </div>             
                                <div class="field">
                                    <div class="ui calendar" >
                                        <div class="ui input left icon">
                                            <i class="calendar icon"></i>
                                            <input type="text" name='start_date' placeholder="<?php _e("Departure date", "gpdealdomain");?>" value="<?php echo $start_date_string ?>">
                                        </div>
                                    </div>
                                </div>      
                            </div>

                            <h4 class="ui dividing header"><?php _e("Destination", "gpdealdomain");?> <span style="color:red;">*</span></h4>
                            <div class="two wide fields">
                                <div class="field">
                                    <div class="ui input icon destination_city">
                                        <!--<i class="marker icon destination_city" locality_id='destination_city'></i>-->
                                        <i class="remove link icon destination_city" style="display: none;" locality_id='destination_city'></i>
                                        <input id="destination_city" type="text" class="locality" name='destination_city' placeholder="<?php _e("Destination city", "gpdealdomain");?>" value="<?php echo $destination_city ?>">
                                    </div>
                                </div>             
                                <div class="field">
                                    <div class="ui calendar" >
                                        <div class="ui input left icon">
                                            <i class="calendar icon"></i>
                                            <input type="text" name='destination_date' placeholder="<?php _e("Destination date", "gpdealdomain");?>" value="<?php echo $destination_date_string ?>">
                                        </div>
                                    </div>
                                </div>      
                            </div>
                            <h4 class="ui dividing header"><?php echo __("Information on the item to be shipped", "gpdealdomain"); ?></h4>
                            <div class="fields">
                                <div class="four wide field">
                                    <label><?php _e("Type", "gpdealdomain"); ?> <span style="color:red;">*</span></label>
                                </div>
                                <div class="twelve wide field">
                                    <select name="package_type" class="ui search fluid dropdown" data-validate="package_type">
                                        <option value=""><?php echo __("Object type to be shipped", "gpdealdomain"); ?></option>
                                        <?php
                                        $type_packages = get_terms(array('taxonomy' => 'type_package', 'hide_empty' => false, 'orderby' => 'ID', 'order' => 'ASC'));
                                        foreach ($type_packages as $type_package):
                                            ?>
                                            <option value="<?php echo $type_package->term_id; ?>" <?php if ($type == $type_package->term_id): ?> selected="selected" <?php endif ?>><?php echo $type_package->name; ?></option>
                                        <?php endforeach ?>
                                    </select>
                                </div>
                            </div>
                            <div class="fields">
                                <div class="four wide field">
                                    <label><?php echo __("Contents", "gpdealdomain"); ?> <span style="color:red;">*</span></label>
                                </div>
                                <div class="twelve wide field">
                                    <textarea placeholder="<?php echo __("Enter the contents of your shipment here", "gpdealdomain"); ?>" name="package_content" cols="50"></textarea>
                                </div>
                            </div>

                            <div class="fields">
                                <div class="four wide field dim_max_label">
                                    <label><?php echo __("Dimensions", "gpdealdomain"); ?> <span style="color:red;">*</span> <i class="help circle green link icon tooltip">
                                            <span class="tooltiptext"><?php echo __("The length, width and height (in cm)", "gpdealdomain") ?></span>
                                        </i></label>
                                </div>
                                <div class="six wide field">
                                    <div class="fields">
                                        <div class="field dim_field_input">
                                            <input type="text" name="package_dimensions_length" placeholder="<?php _e("l(cm)", "gpdealdomain"); ?>"  value="<?php echo $length; ?>">
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
                                            <span class="tooltiptext"><?php echo __("The weight of the item to be shipped (in kg)", "gpdealdomain") ?></span>
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

                            <h4 class="ui dividing header"><?php echo __("Picture", "gpdealdomain"); ?></h4>
                            <div  class="fields">
                                <div class="sixteen wide field center aligned">
                                    <div id="package_picture_dimmer" class="ui small image" style="display: none">
                                        <div class="ui dimmer">
                                            <div class="content">
                                                <div class="center">
                                                    <div id="package_picture_loader" class="ui loader content" style="display:none"></div>
                                                    <div id="package_picture_remove" class="ui red basic icon button" ><i class="remove icon"></i></div>
                                                    <div id="package_picture_edit" class="ui green basic icon button" ><i class="write icon"></i></div>
                                                </div>
                                            </div>
                                        </div>
                                        <img id="package_picture_img" class="ui small image" src="<?php echo wp_make_link_relative(get_template_directory_uri()); ?>/assets/images/default_logo.png">
                                    </div>
                                    <a id="package_picture_link" class="ui green basic icon button"><i class="file image outline icon"></i> <?php echo __("Add an image of your objects", "gpdealdomain"); ?></a>
                                    <div style="height:0px;overflow:hidden">
                                        <input type="file" id="package_picture_file" name="package_picture_file" accept=".jpg,.png,.gif,.jpeg">
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
                                <?php if (isset($_POST["confirm_transaction"]) && $_POST["confirm_transaction"] == "true"): ?> 
                                    <input type="hidden" name="confirm_transaction"  value="true">
                                    <select name="selected_transport_offers[]"  multiple="multiple" style="display: none">

                                        <?php
                                        if (!empty($selected_transport_offers)) {
                                            foreach ($selected_transport_offers as $transport_offer_id):
                                                ?>
                                                <option value="<?php echo $transport_offer_id; ?>"  selected="selected" ><?php echo $transport_offer_id ?></option>

                                            <?php endforeach ?>
                                        <?php } ?>
                                    </select>
                                    <button id="submit_send_package" onclick='confirm_finalisation_transaction_send_package()' class="ui right floated green button" name="submit_send_package" value="yes" type="submit" style="min-width: 12em;"><?php _e("Finalize transaction", "gpdealdomain"); ?></button>
                                <?php else: ?>
                                    <button id="submit_send_package" class="ui right floated green button" name="submit_send_package" value="yes" type="submit" style="min-width: 12em;"><?php _e("Search for carriers", "gpdealdomain"); ?></button>
                                <?php endif ?>
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

