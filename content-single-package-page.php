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
$share_title = __("Transport offer", "gpdealdomain")." ".__("from", "gpdealdomain")." ".$start_city."(".$start_date.") ".__("to", "gpdealdomain")." ".$destination_city."(".$destination_date.")"." ".__("on", "gpdealdomain")." Global Parcel Deal";
$share_link = esc_url(add_query_arg(array('start-city' => $echo_start_city, "start-date"=> $start_date, "destination-city" => $echo_destination_city, "destination-date"=> $destination_date), get_permalink(get_page_by_path(__('search-for-transport-offers', 'gpdealdomain')))));
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
    <div id='edit_package_infos' class="ui signup_contenair basic segment container" <?php if ($action == null || $action != 'edit'): ?> style="display: none;" <?php endif ?>>
        <div class="ui attached message">
            <div class="header"><?php _e("Edit Shipment", 'gpdealdomain') ?> </div>
            <p class="promo_text_form"><?php _e("Modify the information below and then search again for the carriers available for your shipment", 'gpdealdomain') ?>.</p>
        </div>
        <div class="ui fluid card">
            <div class="content">
                <p class="required_infos"><span style="color: red;">*</span> Informations obligatoires</p>
                <div class="ui top attached tabular menu">
                    <div class="item active" data-tab="first"><?php _e("Start", 'gpdealdomain') ?> <br class="mobile_br" style="display: none;"><?php _e("shipment", 'gpdealdomain') ?></div>
                    <div class="item" data-tab="second"><?php _e("How it", "gpdealdomain"); ?> <br class="mobile_br" style="display: none;"><?php _e("works", "gpdealdomain"); ?> ?</div>
                </div>
                <div class="ui bottom attached tab segment active" data-tab="first">
                    <form id='send_package_form'  method="POST" action="<?php echo wp_make_link_relative(get_permalink(get_page_by_path(__('select-transport-offers', 'gpdealdomain')))); ?>" class="ui form" autocomplete="off" enctype="multipart/form-data">
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
                                        <option value="<?php echo $type_package->term_id; ?>" <?php if (in_array($type_package->term_id, $type, true)): ?> selected="selected" <?php endif ?>><?php echo __($type_package->name, "gpdealdomain"); ?></option>
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
                                <label><?php echo __("Dimensions", "gpdealdomain"); ?> <span style="color:red;">*</span> <i class="help circle green link icon tooltip">
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
                            <button id="cancel_edit_package_infos_btn" class="ui right floated red button" style="min-width: 12em;"><?php _e("Cancel", "gpdealdomain"); ?></button>
                        </div>
                    </form>
                </div>
                <div class="ui bottom attached tab segment" data-tab="second"> 
                    <?php _e("How it works", "gpdealdomain"); ?>
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

                                    <?php //if (get_post_meta(get_the_ID(), 'carrier-ID', true) == -1): ?>
                                    <a class="ui right floated basic green button" name="search_transport_offers" href="<?php echo esc_url(add_query_arg(array('package-id' => get_the_ID()), wp_make_link_relative(get_permalink(get_page_by_path(__('select-transport-offers', 'gpdealdomain')))))) ?>" type="submit"><?php _e("Search carriers", "gpdealdomain"); ?></a>
                                    <?php //else: ?>
                                    <!--<a class="ui right floated green button" name="search_transport_offers" href="<?php echo esc_url(add_query_arg(array('package-id' => get_the_ID()), wp_make_link_relative(get_permalink(get_page_by_path(__('select-transport-offers', 'gpdealdomain')))))) ?>" type="submit">Enregistrer la transaction</a>-->
                                    <?php //endif ?>
                                    <?php if (get_post_meta(get_the_ID(), 'package-status', true) == 2): ?>
                                        <input type='hidden' id='fence_package_url' value="<?php echo wp_make_link_relative(get_the_permalink()); ?>" >
                                        <button id='fence_package_btn' onclick="fence_send_package_on_single_page(<?php the_ID() ?>)" class="ui right floated basic red icon button" style="min-width: 12em;"><i class="checkmark icon"></i> <?php echo __("Fence", "gpdealdomain"); ?></button>
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
                                                            <?php echo get_post_meta($id, 'price', true) . " " . get_post_meta($id, 'currency', true); ?><?php if (get_post_meta($id, 'price-type', true) == 1): ?>/kg<?php endif ?>
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
                                            <?php echo __("No carrier for the moment", "gpdealdomain") ?>.
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
                $latest_news = new WP_Query(array('post_type' => 'post', 'post_per_page' => 5, "post_status" => 'publish', 'category_name' => __('news', 'gpdealdomain'), 'orderby' => 'post_date', 'order' => 'DESC'));
                if ($latest_news->have_posts()) :
                    ?>
                    <div class="ui segment">
                        <div class="owl-carousel" id="single-second-slider">
                            <?php
                            while ($latest_news->have_posts()): $latest_news->the_post()
                                ?>
                                <div class="item">
                                    <p>
                                        <?php if (has_post_thumbnail()): ?>
                                            <img class="ui rounded image" src="<?php the_post_thumbnail_url('full'); ?>">
                                        <?php endif ?>
                                    </p>
                                    <div align="center">
                                        <div class="ui header"><?php the_title() ?></div>
                                        <p><?php the_content() ?></p>
                                    </div>
                                </div>
                                <?php
                            endwhile;
                            wp_reset_postdata();
                            ?>
                        </div>
                    </div>
                <?php endif ?>
            </div>
        </div>
    </div>
</div>
<?php
include(locate_template('content-modal-confirmation-package.php'));
