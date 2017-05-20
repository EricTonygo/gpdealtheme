<?php
get_template_part('top-menu', get_post_format());
global $current_user;
$type = wp_get_post_terms(get_the_ID(), 'type_package', array("fields" => "ids"));
$package_content = get_post_meta(get_the_ID(), 'package-content', true);
$length = get_post_meta(get_the_ID(), 'length', true);
$width = get_post_meta(get_the_ID(), 'width', true);
$height = get_post_meta(get_the_ID(), 'height', true);
$weight = get_post_meta(get_the_ID(), 'weight', true);
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
$post_author = get_post_field('post_author', get_the_ID());
?>
<div class="ui large borderless second-nav menu">
    <div class="ui container center aligned">
        <div class="center menu">
            <div class="item <?php if($post_author != $current_user->ID): ?>small_breadcumb<?php endif ?>">
                <a href="<?php echo wp_make_link_relative(home_url('/')); ?>" class="section"><?php echo get_page_by_path(__('home', 'gpdealdomain'))->post_title ?></a>
                <i class="right chevron icon divider"></i>
                <a href="<?php echo wp_make_link_relative(get_permalink(get_page_by_path(__('my-account', 'gpdealdomain')))); ?>" class="section"><?php echo get_page_by_path(__('my-account', 'gpdealdomain'))->post_title ?></a>
                <i class="right chevron icon divider"></i>
                <?php if($post_author == $current_user->ID): ?>
                <a href="<?php echo wp_make_link_relative(get_permalink(get_page_by_path(__('my-account', 'gpdealdomain') . '/' . __('shipments', 'gpdealdomain')))) ?>" class="section"><?php echo __('My shipments', 'gpdealdomain'); ?></a>
                <?php else: ?>
                <a href="<?php echo wp_make_link_relative(get_permalink(get_page_by_path(__('my-account', 'gpdealdomain') . '/' . __('transport-offers', 'gpdealdomain')))) ?>" class="section"><?php echo __('My transport offers', 'gpdealdomain') ?></a>
                <i class="right chevron icon divider"></i>
                <a href="<?php echo wp_make_link_relative(get_the_permalink($transport_offer_id)); ?>" class="section"><?php echo get_post_field('post_title', $transport_offer_id); ?></a>
                <i class="right chevron icon divider"></i>
                <div class="section"><?php echo __('Carried shipments', 'gpdealdomain'); ?></div>
                <?php endif ?>
                <i class="right arrow icon divider"></i>
                <div class="active section"><?php the_title(); ?></div>
            </div>
        </div>
    </div>
</div>
<div class="ui vertical masthead  segment container">
    <div id='edit_package_infos' class="ui signup_contenair basic segment container" <?php if ($action == null || $action != 'edit'): ?> style="display: none;" <?php endif ?>>
        <div class="ui attached message">
            <div class="header"><?php  _e("Modification of the shipment", 'gpdealdomain') ?> : </div>
            <p class="promo_text_form"><?php _e("Modify the information below and then search again for the carriers available for your shipment", 'gpdealdomain') ?>.</p>
        </div>
        <div class="ui fluid card">
            <div class="content">
                <p class="required_infos"><span style="color: red;">*</span> Informations obligatoires</p>
                <div class="ui top attached tabular menu">
                    <div class="item active" data-tab="first"><?php  _e("Start", 'gpdealdomain') ?> <br class="mobile_br" style="display: none;"><?php  _e("shipment", 'gpdealdomain') ?></div>
                    <div class="item" data-tab="second"><?php _e("How it", "gpdealdomain");?> <br class="mobile_br" style="display: none;"><?php _e("works", "gpdealdomain");?> ?</div>
                </div>
                <div class="ui bottom attached tab segment active" data-tab="first">
                    <form id='send_package_form'  method="POST" action="<?php echo wp_make_link_relative(get_permalink(get_page_by_path(__('select-transport-offers', 'gpdealdomain')))); ?>" class="ui form" autocomplete="off" enctype="multipart/form-data">
                        <h4 class="ui dividing header"><?php _e("Departure", "gpdealdomain");?> <span style="color:red;">*</span></h4>
                        <div class="two wide fields">
                            <div class="field">
                                <div class="ui input icon start_city">
                                    <!--<i class="marker icon start_city" locality_id='start_city'></i>-->
                                    <i class="remove link icon start_city" style="display: none;" locality_id='start_city'></i>
                                    <input id="start_city" type="text" class="locality" name='start_city' placeholder="<?php _e("Departure city", "gpdealdomain");?>" value="<?php echo $echo_start_city; ?>">
                                </div>
                            </div>             
                            <div class="field">
                                <div class="ui calendar" >
                                    <div class="ui input left icon">
                                        <i class="calendar icon"></i>
                                        <input type="text" name='start_date' placeholder="<?php _e("Departure date", "gpdealdomain");?>" value="<?php echo $start_date ?>">
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
                                    <input id="destination_city" type="text" class="locality" name='destination_city' placeholder="<?php _e("Destination city", "gpdealdomain");?>" value="<?php echo $echo_destination_city; ?>">
                                </div>
                            </div>             
                            <div class="field">
                                <div class="ui calendar" >
                                    <div class="ui input left icon">
                                        <i class="calendar icon"></i>
                                        <input type="text" name='destination_date' placeholder="<?php _e("Destination date", "gpdealdomain");?>" value="<?php echo $destination_date ?>">
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
                                        <option value="<?php echo $type_package->term_id; ?>" <?php if (in_array($type_package->term_id, $type, true)): ?> selected="selected" <?php endif ?>><?php echo $type_package->name; ?></option>
                                    <?php endforeach ?>
                                </select>
                            </div>
                        </div>
                        <div class="fields">
                            <div class="four wide field">
                                <label><?php echo __("Contents", "gpdealdomain"); ?> <span style="color:red;">*</span></label>
                            </div>
                            <div class="twelve wide field">
                                <textarea placeholder="<?php echo __("Enter the contents of your shipment here", "gpdealdomain"); ?>" name="package_content" cols="50"><?php echo $package_content; ?></textarea>
                            </div>
                        </div>

                        <div class="fields">
                            <div class="four wide field dim_max_label">
                                <label><?php echo __("Dimensions", "gpdealdomain"); ?> <i class="help circle green link icon tooltip">
                                        <span class="tooltiptext"><?php echo __("The length, width and height (in cm)", "gpdealdomain") ?></span>
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
                                <label><?php echo __("Weight", "gpdealdomain"); ?> <i class="help circle green link icon tooltip">
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
                            <button id="submit_send_package" class="ui right floated green button" name="submit_update_send_package" value="yes" type="submit" style="min-width: 12em;">Rechercher transporteur</button>
                            <button id="cancel_edit_package_infos_btn" class="ui right floated red button" style="min-width: 12em;"><?php _e("Cancel change", "gpdealdomain"); ?></button>
                        </div>
                    </form>
                </div>
                <div class="ui bottom attached tab segment" data-tab="second"> 
                    <?php _e("How it works", "gpdealdomain"); ?>
                </div>
            </div>
        </div>
    </div>
    <div id='show_package_infos' class="ui signup_contenair basic segment container" <?php if ($action && $action != 'show'): ?> style="display: none;" <?php endif ?> >
        <div  class="ui fluid card">
            <div class="content">
                <div class="ui form">
                    <div id="block_recap_desktop">
                        <h4 class="ui dividing header"><?php echo __("Departure", 'gpdealdomain') ?> </h4>
                        <div class="fields">
                            <div class="field">
                                <span class="span_value"><?php echo $start_city; ?></span> (<span class="span_value"><?php echo $start_state; ?></span>, <span class="span_value"><?php echo $start_country; ?></span>), <span class="span_value"><?php echo $start_date; ?></span>
                            </div>   
                        </div>


                        <h4 class="ui dividing header"><?php echo __("Destination", 'gpdealdomain') ?> </h4>
                        <div class="fields">
                            <div class="field">
                                <span class="span_value"><?php echo $destination_city; ?></span> (<span class="span_value"><?php echo $destination_state; ?></span>, <span class="span_value"><?php echo $destination_country; ?></span>), <span class="span_value"><?php echo $destination_date; ?></span>
                            </div>   
                        </div>
                        <h4 class="ui dividing header"><?php echo __("Information on the item to be shipped", "gpdealdomain"); ?></h4>
                        <div class="fields">
                            <div class="four wide field">
                                <span class="span_label">Type :</span>
                            </div>
                            <div class="twelve wide field">
                                <div class="inline fields">
                                    <div class="field">
                                        <?php
                                        $package_type_list = wp_get_post_terms(get_the_ID(), 'type_package', array("fields" => "names"));
                                        $package_type_list_count = count($package_type_list);
                                        $j = 0;
                                        foreach ($package_type_list as $name) :
                                            ?>
                                            <?php if ($j < $package_type_list_count - 1) : ?>
                                                <span class="span_value"><?php echo $name; ?>,</span>
                                            <?php else: ?>
                                                <span class="span_value"><?php echo $name; ?></span>
                                            <?php endif ?>
                                            <?php
                                            $j++;
                                        endforeach
                                        ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="fields">
                            <div class="four wide field">
                                <span class="span_label"><?php echo __("Contents", "gpdealdomain"); ?> :</span>
                            </div>
                            <div class="twelve wide field">
                                <span class="span_value"><?php echo $package_content; ?></span>
                            </div>
                        </div>

                        <div class="fields">
                            <div class="four wide field">
                                <span class="span_label"><?php echo __("Dimensions", "gpdealdomain"); ?>/<?php echo __("Weight", "gpdealdomain"); ?> :</span>
                            </div>
                            <div class="twelve wide field">
                                <div class="four wide fields">
                                    <div class="field">
                                        <label class="span_label"><?php echo __("Length", "gpdealdomain"); ?>(cm) </label>
                                        <span class="span_value"><?php echo $length; ?></span>
                                    </div>
                                    <div class="field">
                                        <label class="span_label"><?php echo __("Width", "gpdealdomain"); ?>(cm) </label>
                                        <span class="span_value"><?php echo $width; ?></span>
                                    </div>
                                    <div class="field">
                                        <label class="span_label"><?php echo __("Height", "gpdealdomain"); ?>(cm) </label>
                                        <span class="span_value"><?php echo $height; ?></span>
                                    </div>
                                    <div class="field">
                                        <label class="span_label"><?php echo __("Weight", "gpdealdomain"); ?>(kg)</label>
                                        <span class="span_value"><?php echo $weight; ?></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div id="block_recap_mobile" style="display: none">
                        <h4 class="ui dividing header"><?php echo __("Departure", 'gpdealdomain') ?> </h4>
                        <div class="inline field">
                            <span class="span_value"><?php echo $start_city; ?></span> (<span class="span_value"><?php echo $start_state; ?></span>, <span class="span_value"><?php echo $start_country; ?></span>), <span class="span_value"><?php echo $start_date; ?></span>
                        </div>

                        <h4 class="ui dividing header"><?php echo __("Destination", 'gpdealdomain') ?> </h4>
                        <div class="inline field">
                            <span class="span_value"><?php echo $destination_city; ?></span> (<span class="span_value"><?php echo $destination_state; ?></span>, <span class="span_value"><?php echo $destination_country; ?></span>), <span class="span_value"><?php echo $destination_date; ?></span>
                        </div>
                        <div class="inline field">
                            <span class="span_label">Date : </span>
                            <span class="span_value"><?php echo $destination_date; ?></span>
                        </div>   
                        <h4 class="ui dividing header"><?php echo __("Information on the item to be shipped", "gpdealdomain"); ?></h4>
                        <div class="inline field">                            
                            <span class="span_label">Type : </span>
                            <?php
                            $package_type_list = wp_get_post_terms(get_the_ID(), 'type_package', array("fields" => "names"));
                            $package_type_list_count = count($package_type_list);
                            $j = 0;
                            foreach ($package_type_list as $name) :
                                ?>
                                <?php if ($j < $package_type_list_count - 1) : ?>
                                    <span class="span_value"><?php echo $name; ?>,</span>
                                <?php else: ?>
                                    <span class="span_value"><?php echo $name; ?></span>
                                <?php endif ?>
                                <?php
                                $j++;
                            endforeach
                            ?>

                        </div>
                        <div class="inline field">
                            <span class="span_label"><?php echo __("Contents", "gpdealdomain"); ?> : </span>
                            <span class="span_value"><?php echo $package_content; ?></span>                       
                        </div>

                        <div class="inline field">
                            <span class="span_label"><?php echo __("Length", "gpdealdomain"); ?>(cm) : </span>
                            <span class="span_value"><?php echo $length; ?></span>
                        </div>
                        <div class="inline field">
                            <span class="span_label"><?php echo __("Width", "gpdealdomain"); ?>(cm) : </span>
                            <span class="span_value"><?php echo $width; ?></span>
                        </div>
                        <div class="inline field">
                            <span class="span_label"><?php echo __("Heigh", "gpdealdomain"); ?>(cm) : </span>
                            <span class="span_value"><?php echo $height; ?></span>
                        </div>
                        <div class="inline field">
                            <span class="span_label"><?php echo __("Weigh", "gpdealdomain"); ?>(kg) : </span>
                            <span class="span_value"><?php echo $weight; ?></span>
                        </div>
                    </div>
                    <?php if ($package_picture_id): ?>
                        <h4 class="ui dividing header"><?php echo __("Picture", "gpdealdomain"); ?></h4>
                        <div  class="fields">                                
                            <div class="sixteen wide field center aligned">
                                <img  class="ui small image"  src= "<?php echo wp_make_link_relative(wp_get_attachment_url($package_picture_id)); ?>">
                            </div>
                        </div>
                    <?php endif ?>
                    <?php
                    $carrier_ids = get_post_meta(get_the_ID(), 'carrier-ID', true);
                    if ($carrier_ids != -1 && is_array($carrier_ids)) {
                        $carrier_ids = array_map('intval', $carrier_ids);
                    } else {
                        $carrier_ids = null;
                    }
                    ?>
                    <?php if ($carrier_ids): ?>
                        <h4 class="ui dividing header"><?php echo __("Carrier", "gpdealdomain"); ?>(s) </h4>
                        <div class="fields">
                            <div class="sixteen wide field">
                                <div class="inline fields">
                                    <div class="field">
                                        <?php
                                        $carrier_ids_count = count($carrier_ids);
                                        $i = 0;
                                        foreach ($carrier_ids as $id) :
                                            $post_author = get_post_field('post_author', $id);
                                            $carrier_name = $current_user->ID == $post_author ? __("You", "gpdealdomain") : get_the_author_meta('user_login', $post_author);
                                            ?>
                                            <?php if ($i < $carrier_ids_count - 1) : ?>
                                                <span><a href="<?php the_permalink($id) ?>"><?php echo $carrier_name; ?></a> (<?php echo get_user_role_by_user_id($post_author); ?>), </span>
                                            <?php else: ?>
                                                <span><a href="<?php the_permalink($id) ?>"><?php echo $carrier_name; ?></a> (<?php echo get_user_role_by_user_id($post_author); ?>)</span>
                                            <?php endif ?>
                                            <?php
                                            $i++;
                                        endforeach
                                        ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endif ?>
                    <?php if (get_post_field('post_author', get_the_ID()) == $current_user->ID): ?>
                        <div class="field" style="margin-top: 4em">
                            <?php if (get_post_meta(get_the_ID(), 'package-status', true) != 3 && get_post_meta(get_the_ID(), 'package-status', true) != 4 && get_post_meta(get_the_ID(), 'package-status', true) != 5): ?>
                                <button id="edit_package_infos_btn" class="ui green button"><?php echo __("Edit shipment", "gpdealdomain"); ?></button>
                            <?php endif ?>
                            <?php if (get_post_meta(get_the_ID(), 'carrier-ID', true) == -1): ?>
                                <a class="ui right floated green button" name="search_transport_offers" href="<?php echo esc_url(add_query_arg(array('package-id' => get_the_ID()), wp_make_link_relative(get_permalink(get_page_by_path(__('select-transport-offers', 'gpdealdomain')))))) ?>" type="submit"><?php _e("Search carriers", "gpdealdomain"); ?></a>
                            <?php else: ?>
                                <!--<a class="ui right floated green button" name="search_transport_offers" href="<?php echo esc_url(add_query_arg(array('package-id' => get_the_ID()), wp_make_link_relative(get_permalink(get_page_by_path(__('select-transport-offers', 'gpdealdomain')))))) ?>" type="submit">Enregistrer la transaction</a>-->
                            <?php endif ?>
                            <?php if (get_post_meta(get_the_ID(), 'package-status', true) == 2): ?>
                                <input type='hidden' id='fence_package_url' value="<?php echo wp_make_link_relative(get_the_permalink()); ?>" >
                                <button id='fence_package_btn' onclick="fence_send_package_on_single_page(<?php the_ID() ?>)" class="ui right floated red icon button" style="min-width: 12em;"><i class="checkmark icon"></i> <?php echo __("Fence", "gpdealdomain"); ?></button>
                            <?php endif ?>
                        </div>
                    <?php endif ?>
                </div>
            </div>
        </div>
    </div>
</div>
<?php
include(locate_template('content-modal-confirmation-package.php'));
