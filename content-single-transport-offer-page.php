<?php
global $current_user;
$transport_offer_id = get_the_ID();
get_template_part('top-menu', get_post_format());
if (isset($_SERVER['REQUEST_METHOD']) && $_SERVER['REQUEST_METHOD'] == 'GET') {
    $package_type = array_map('intval', wp_get_post_terms(get_the_ID(), 'type_package', array("fields" => "ids")));
    $transport_method = array_map('intval', wp_get_post_terms(get_the_ID(), 'transport-method', array("fields" => "ids")));
    $transport_offer_price = get_post_meta(get_the_ID(), 'price', true);
    $transport_offer_currency = get_post_meta(get_the_ID(), 'currency', true);
    $transport_offer_price_type = get_post_meta(get_the_ID(), 'price-type', true);
    $portable_objects = get_post_meta(get_the_ID(), 'portable-objects', true);
    $max_length = get_post_meta(get_the_ID(), 'package-length-max', true);
    $max_width = get_post_meta(get_the_ID(), 'package-width-max', true);
    $max_height = get_post_meta(get_the_ID(), 'package-height-max', true);
    $max_weight = get_post_meta(get_the_ID(), 'package-weight-max', true);
    $start_country = get_post_meta(get_the_ID(), 'departure-country-transport-offer', true);
    $start_state = get_post_meta(get_the_ID(), 'departure-state-transport-offer', true);
    $start_city = get_post_meta(get_the_ID(), 'departure-city-transport-offer', true);
    $start_date = date_format(date_create_from_format('Y-m-d H:i:s', get_post_meta(get_the_ID(), 'date-of-departure-transport-offer', true)), 'd-m-Y');
    $deadline_proposition = date('d-m-Y', strtotime(get_post_meta(get_the_ID(), 'deadline-of-proposition-transport-offer', true)));
    $destination_country = get_post_meta(get_the_ID(), 'destination-country-transport-offer', true);
    $destination_state = get_post_meta(get_the_ID(), 'destination-state-transport-offer', true);
    $destination_city = get_post_meta(get_the_ID(), 'destination-city-transport-offer', true);
    $destination_date = date('d-m-Y', strtotime(get_post_meta(get_the_ID(), 'arrival-date-transport-offer', true)));
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
                <a href="<?php echo wp_make_link_relative(home_url('/')) ?>" class="section"><?php echo get_page_by_path(__('home', 'gpdealdomain'))->post_title ?></a>
                <i class="small right chevron icon divider"></i>
                <a href="<?php echo wp_make_link_relative(get_permalink(get_page_by_path(__('my-account', 'gpdealdomain')))); ?>" class="section"><?php echo get_page_by_path(__('my-account', 'gpdealdomain'))->post_title ?></a>
                <i class="small right chevron icon divider"></i>
                <?php if ($post_author == $current_user->ID): ?>
                    <a href="<?php echo wp_make_link_relative(get_permalink(get_page_by_path(__('my-account', 'gpdealdomain') . '/' . __('transport-offers', 'gpdealdomain')))) ?>" class="section"><?php echo __('Transport offers', 'gpdealdomain') ?></a>
                <?php else: ?>
                    <a href="<?php echo wp_make_link_relative(get_permalink(get_page_by_path(__('my-account', 'gpdealdomain') . '/' . __('shipments', 'gpdealdomain')))) ?>" class="section"><?php echo __('Shipments', 'gpdealdomain'); ?></a>
                    <i class="small right chevron icon divider"></i>
                    <a href="<?php echo wp_make_link_relative(get_the_permalink($package_id)); ?>" class="section"><?php echo get_post_field('post_title', $package_id); ?></a>
                    <i class="small right chevron icon divider"></i>
                    <a href="<?php echo esc_url(add_query_arg(array('package-id' => $package_id), wp_make_link_relative(get_the_permalink(get_page_by_path(__('my-account', 'gpdealdomain') . '/' . __('show-carriers-contacts', 'gpdealdomain')))))); ?>" class="section"><?php echo __('Selected carriers', 'gpdealdomain'); ?></a>
                <?php endif ?>
                <i class="small right arrow icon divider"></i>
                <div class="active section"><?php the_title(); ?></div>
            </div>
        </div>
    </div>
</div>
<div class="ui vertical masthead  segment container">
    <div id='edit_transport_offer_infos' class="ui signup_contenair basic segment container content_without_white" <?php if ($action == null || $action != 'edit'): ?> style="display: none;" <?php endif ?>>
        <div class="ui attached message">
            <div class="header"><?php echo __("Edit your transport offer informations", 'gpdealdomain') ?> </div>
            <!--<p class="promo_text_form"><?php echo __("Edit the information below to update your transport offer", 'gpdealdomain') ?>.</p>-->
            <p class="promo_text_form"><span style="color: red;">*</span> <?php echo __("Required information", 'gpdealdomain') ?></p>
        </div>
        <div class="ui fluid card">
            <div class="content">
                <?php include(locate_template("content_success_or_faillure_message.php")); ?>
                <div class="ui top attached tabular menu">
                    <div class="item active" data-tab="first"><?php echo __("transport_offer_str_start", 'gpdealdomain') ?> <br class="mobile_br" style="display: none;"><?php echo __("transport_offer_str_end", 'gpdealdomain') ?></div>
                    <div class="item" data-tab="second"><?php echo __("How it", 'gpdealdomain') ?> <br class="mobile_br" style="display: none;"><?php echo __("works", 'gpdealdomain') ?> ?</div>
                </div>
                <div class="ui bottom attached tab segment active" data-tab="first">
                    <form id='write_transport_offer_form'  method="POST" action="<?php echo wp_make_link_relative(get_the_permalink()); ?>" class="ui form" autocomplete="off">

                        <h4 class="ui dividing header"><?php echo __("Départure", 'gpdealdomain') ?> <span style="color:red;">*</span></h4>
                        <div class="two wide fields">
                            <div class="field">
                                <div class="ui input icon start_city">
                                    <!--<i class="marker icon start_city" locality_id='start_city'></i>-->
                                    <i class="remove link icon start_city" style="display: none;" locality_id='start_city'></i>
                                    <input id="start_city" type="text" class="locality" name='start_city' placeholder="<?php echo __("Departure city", 'gpdealdomain') ?>" value="<?php echo $echo_start_city; ?>">
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
                                    <input id="destination_city" type="text" class="locality" name='destination_city' placeholder="<?php echo __("Destination city", 'gpdealdomain') ?>" value="<?php echo $echo_destination_city; ?>">
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
                        <h4 class="ui dividing header"><?php echo __("Object(s) transported", 'gpdealdomain') ?></h4>
                        <div class="fields">
                            <div class="four wide field">
                                <label><?php echo __("Type", 'gpdealdomain') ?>(s) <span style="color:red;">*</span></label>
                            </div>
                            <div class="twelve wide field">
                                <div style="margin-left: 0.6em" class="inline fields checkbox_with_icones">
                                    <?php
                                    $typePackages = get_terms(array('taxonomy' => 'type_package', 'hide_empty' => false, 'orderby' => 'ID', 'order' => 'ASC'));
                                    foreach ($typePackages as $typePackage):
                                        ?>
                                        <div class="field">
                                            <div class="ui checkbox">
                                                <input type="checkbox" name="transport_offer_package_type[]" value="<?php echo $typePackage->term_id; ?>" <?php if (in_array($typePackage->term_id, $package_type, true)): ?> checked="checked" <?php endif ?>>
                                                <label><?php echo __($typePackage->name, "gpdealdomain"); ?>
                                                    <?php if ($typePackage->slug == "colis"): ?>
                                                        <i class="big green icon"><img class="ui mini image" src="<?php echo wp_make_link_relative(get_template_directory_uri()) ?>/assets/images/icone_colis.png"></i>
                                                    <?php elseif ($typePackage->slug == "autre"): ?>
                                                        <i class="big green icon"><img class="ui mini image" src="<?php echo wp_make_link_relative(get_template_directory_uri()) ?>/assets/images/icone_autre_colis.png"></i>
                                                    <?php elseif ($typePackage->slug == "mail"): ?>
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
                                <label><?php echo __("Description", "gpdealdomain"); ?> <i class="help circle green link icon tooltip">
                                        <span class="tooltiptext"><?php echo __("Example of object that you can to carry", "gpdealdomain") ?></span>
                                    </i></label>
                            </div>
                            <div class="twelve wide field">
                                <textarea placeholder="<?php echo __("Enter the description of object that you can to carry", "gpdealdomain"); ?>" name="transport_offer_portable_objects" cols="30" rows="5"><?php echo $portable_objects; ?></textarea>
                            </div>
                        </div>

                        <div class="fields">
                            <div class="four wide field dim_max_label">
                                <label><?php echo __("Max dimensions", 'gpdealdomain') ?> <i class="help circle green link icon tooltip">
                                        <span class="tooltiptext"><?php echo __("Max length, width and height (in cm)", "gpdealdomain") ?>.<br>
                                            <?php echo __("Use \".\" For decimal numbers. Ex: 1.5", "gpdealdomain") ?></span>
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
                                                    <input type="radio" name="transport_offer_price_type" value="1" <?php if ($transport_offer_price_type == 1): ?> checked="checked"<?php endif ?>>
                                                    <label><?php echo __("Cost", "gpdealdomain"); ?>/kg</label>
                                                </div>
                                            </div>
                                            <div class="field">
                                                <div class="ui radio checkbox">
                                                    <input type="radio" name="transport_offer_price_type" value="2" <?php if ($transport_offer_price_type == 2): ?> checked="checked"<?php endif ?>>
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
                                                <label><?php echo __($transportMethod->name, "gpdealdomain"); ?>
                                                    <i class="big green icon"><img class="ui mini image" src="<?php echo wp_make_link_relative(get_template_directory_uri()) ?>/assets/images/icone_<?php echo __($transportMethod->slug, "gpdealdomain"); ?>.png"></i>
                                                </label>
                                            </div>
                                        </div>
                                    <?php endforeach ?>
                                </div>
                            </div>
                        </div>

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
                        <?php if (get_post_meta(get_the_ID(), 'transport-status', true) != 2 || get_post_meta(get_the_ID(), 'package-status', true) != 3): ?>
                            <div class="field">
                                <input type="hidden" name='action' value='edit'>
                                <button id="submit_send_transport_offer" class="ui right floated green button" type="submit" style="min-width: 12em;"><?php _e("Edit", "gpdealdomain"); ?></button>
                                <button id="cancel_edit_transport_offer_infos_btn" class="ui right floated red button" style="min-width: 12em;" ><?php _e("Cancel", "gpdealdomain"); ?></button>
                            </div>
                        <?php endif ?>
                    </form>
                </div>
                <div class="ui bottom attached tab segment" data-tab="second"> 
                    <?php include(locate_template("content-how-it-works-transport-offer.php")); ?>
                </div>
            </div>
        </div>
    </div>

    <div id='show_transport_offer_infos' class="ui basic segment container" <?php if ($action != null && $action != 'evaluate' && $action != 'evaluations' && $action != 'show'): ?> style="display: none;" <?php endif ?> >
        <div class="ui stackable grid">
            <div class="eleven wide column">
                <div  class="ui fluid card transport_offer_card">
                    <?php if ($current_user->ID != $post_author): ?>
                        <div class="image">
                            <div class="content_image_profilename">
                                <?php
                                $carrier_name = get_the_author_meta('user_login', $post_author);
                                $profile_picture_id = get_user_meta($post_author, 'profile-picture-ID', true) ? get_user_meta($post_author, 'profile-picture-ID', true) : get_user_meta($post_author, 'company-logo-ID', true);
                                ?>
                                <div class="content_image" <?php if ($profile_picture_id): ?> style="background-image: url(<?php echo wp_make_link_relative(wp_get_attachment_url($profile_picture_id)); ?>);" <?php else: ?> style="background-image: url(<?php echo wp_make_link_relative(get_template_directory_uri()) ?>/assets/images/avatar.png);" <?php endif ?>>
                                </div>
                                <div><span class='profile_name'><?php echo $carrier_name; ?></span></div>
                                <div class="meta">
                                    <?php
                                    $user_statistics = getTotalStatistiticsEvaluationsOfCarrier($post_author);
                                    wp_reset_postdata();
                                    ?>
                                    <?php if ($user_statistics["Evaluation globale"]["vote_count"] > 0): ?>
                                        <?php
                                        foreach ($user_statistics as $stat_key => $stat_value):
                                            ?>
                                            <div class="ui form">
                                                <div class="field disable">
                                                    <span class="ui mini star rating" data-rating="<?php echo $stat_value["weighted_average"]; ?>" data-max-rating="5"></span>
                                                    <a id="<?php echo $transport_offer_start_id ?>" href="<?php echo esc_url(add_query_arg(array('carrier_id' => $post_author), wp_make_link_relative(get_permalink(get_page_by_path(__('reviews-and-evaluations', 'gpdealdomain')))))); ?>" class="show_reviews_evaluations">
                                                        <?php echo $stat_value["vote_count"]; ?> <?php _e("reviews", "gpdealdomain"); ?>
                                                    </a>
                                                </div>
                                            </div>
                                        <?php endforeach; ?>
                                    <?php else: ?>
                                        <span id="<?php echo $transport_offer_start_id; ?>"  ><i class="star icon"></i> <?php echo __("No reviews", "gpdealdomain"); ?></span>
                                    <?php endif ?>
                                </div>
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

                    <div class="content block_recap_mobile" style="display: none">
                        <div class="ui form description">
                            <div class="field">
                                <div class="ui grid">
                                    <div class="six wide column">
                                        <i class="blue large marker icon"></i>
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
                                        <i class="blue large long arrow right icon"></i>
                                    </div>
                                    <div class="six wide column">
                                        <i class="blue large flag checkered icon"></i>
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
                                        <i class="blue large calendar icon"></i>
                                        <div class="inline field">
                                            <span class="span_value">
                                                <?php echo date('d-m-Y', strtotime($start_date)); ?>
                                            </span>
                                        </div>
                                    </div>
                                    <div class="four wide column">
                                        <i class="blue large long arrow right icon"></i>
                                        <div class="inline field"> 
                                            <span class="span_value">
                                                <?php echo gpdeal_date_diff(date('d-m-Y', strtotime($start_date)), date('d-m-Y', strtotime($destination_date))) ?>j
                                            </span>
                                        </div>
                                    </div>
                                    <div class="six wide column">
                                        <i class="blue large calendar icon"></i>
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
                            <table class="ui celled unstackable table transport_offer_table">
                                <tbody>
                                    <tr>
                                        <td>
                                            <span class="span_label"><?php echo __("Deadline", 'gpdealdomain') ?><i class="help circle green link icon tooltip">
                                                    <span class="tooltiptext"><?php echo __("Deadline for the validity of the offer", "gpdealdomain") ?></span>
                                                </i> </span>
                                        </td>
                                        <td>
                                            <span class="span_value"> <?php echo $deadline_proposition; ?></span>                                 
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <span class="span_label"><?php echo __("Object", 'gpdealdomain') ?>(s)<i class="help circle green link icon tooltip">
                                                    <span class="tooltiptext"><?php echo __("Types of objects accepted by the carrier", "gpdealdomain") ?></span>
                                                </i> </span>
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
                                    <?php if ($max_length || $max_width || $max_height || $max_weight) : ?>
                                        <tr>
                                            <td>
                                                <span class="span_label"><?php echo __("Max dimensions", 'gpdealdomain') ?>(cm) </span> 
                                            </td>
                                            <td>
                                                <span class="span_value">
                                                    <?php if ($max_length) : ?><?php _e("abrev_length", "gpdealdomain"); ?>= <?php echo $max_length; ?>,<?php endif ?>  <?php if ($max_width) : ?><?php _e("abrev_width", "gpdealdomain"); ?>= <?php echo $max_width; ?>,<?php endif ?>  <?php if ($max_height) : ?><?php _e("abrev_height", "gpdealdomain"); ?>= <?php echo $max_height; ?><?php endif ?>
                                                </span>
                                            </td>
                                        </tr>
                                        <?php if ($max_weight) : ?>
                                            <tr>
                                                <td>
                                                    <span class="span_label"><?php echo __("Max weight", 'gpdealdomain') ?>(kg) </span> 
                                                </td>
                                                <td>
                                                    <span class="span_value">
                                                        <?php echo $max_weight; ?>
                                                    </span>
                                                </td>
                                            </tr>
                                        <?php endif ?>
                                    <?php endif ?>

                                    <tr>
                                        <td>
                                            <span class="span_label"><?php echo __("Mode of transport", 'gpdealdomain') ?> </span>
                                        </td>
                                        <td>
                                            <span class="span_value">
                                                <?php
                                                $transport_method_list = wp_get_post_terms(get_the_ID(), 'transport-method', array("fields" => "names"));
                                                $transport_method_list_count = count($transport_method_list);
                                                $i = 0;
                                                foreach ($transport_method_list as $name) :
                                                    ?>
                                                    <?php if ($i < $transport_method_list_count - 1) : ?>
                                                        <span><?php echo __($name, "gpdealdomain"); ?>, </span>
                                                    <?php else: ?>
                                                        <span><?php echo __($name, "gpdealdomain"); ?></span>
                                                    <?php endif ?>
                                                    <?php
                                                    $i++;
                                                endforeach
                                                ?>
                                            </span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <span class="span_label"><?php echo __("Cost of transport", 'gpdealdomain') ?>
                                        </td>
                                        <td>
                                            <span class="span_value">

                                                <?php
                                                echo get_post_meta($transport_offer_id, 'price', true) . " " . get_post_meta($transport_offer_id, 'currency', true);
                                                ?><?php if (get_post_meta($transport_offer_id, 'price-type', true) == 1): ?>/kg<?php endif ?>
                                            </span> 
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <span class="span_label"><?php _e("Status", "gpdealdomain"); ?> </span>
                                        </td>
                                        <td>                            
                                            <span class="span_value"><?php echo getTransportStatus(intval(get_post_meta(get_the_ID(), 'transport-status', true))); ?></span>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>

                            <?php
                            $evaluations = new WP_Query(array('post_type' => 'evaluation', 'post_per_page' => -1, "post_status" => 'publish', 'orderby' => 'post_date', 'order' => 'DESC', 'meta_query' => array(array('key' => 'transport-offer-ID', 'value' => get_the_ID(), 'compare' => '='))));
                            if ($package_id) {
                                $current_user_evaluations = new WP_Query(array('post_type' => 'evaluation', 'post_per_page' => 1, "post_status" => 'publish', 'author' => $current_user->ID, 'meta_query' => array('relation' => 'AND', array('key' => 'transport-offer-ID', 'value' => get_the_ID(), 'compare' => '='), array('key' => 'package-ID', 'value' => $package_id, 'compare' => '='))));
                            } else {
                                $current_user_evaluations = new WP_Query(array('post_type' => 'evaluation', 'post_per_page' => 1, "post_status" => 'publish', 'author' => $current_user->ID, 'meta_query' => array(array('key' => 'transport-offer-ID', 'value' => get_the_ID(), 'compare' => '='))));
                            }
                            ?>

                            <div class="field" style="margin-top: 2em">
                                <?php if (get_post_field('post_author', get_the_ID()) != $current_user->ID && !$evaluations->have_posts() && !$current_user_evaluations->have_posts() && $action != null && $action == "evaluate" && $package_id && get_post_meta($package_id, 'package-status', true) == 2): ?>
                                    <a id="show_block_evaluation_form_top" <?php if ($current_user_evaluations->have_posts()): ?> href="#action_evaluate_down"<?php else: ?> href="#block_evaluation_form" <?php endif ?> onclick="show_block_evaluation_form_top()" class="ui right floated green basic button"><?php echo __("Give an reviews", "gpdealdomain") ?></a>
                                <?php endif ?>
                                <?php if (get_post_field('post_author', get_the_ID()) == $current_user->ID && !$evaluations->have_posts() && get_post_meta(get_the_ID(), 'transport-status', true) == 1): ?>
                                    <button id="edit_transport_offer_infos_btn" class="ui right floated green button" ><?php echo __("Edit offer", "gpdealdomain"); ?></button>
                                <?php endif ?>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="ui signup_contenair basic segment container">
                    <div class="ui top attached tabular menu">
                        <div class="active item" data-tab="evaluations-tab">
                            <?php
                            $statistics = getTotalStatistiticsEvaluation(get_the_ID());
                            wp_reset_postdata();
                            ?>
                            <?php if ($statistics["Evaluation globale"]["vote_count"] > 0): ?>
                                <?php
                                foreach ($statistics as $stat_key => $stat_value):
                                    ?>
                                    <div class="ui form">
                                        <div class="field disable">
                                            <span class="ui mini star rating" data-rating="<?php echo __($stat_value["weighted_average"], "gpdealdomain"); ?>" data-max-rating="5"></span>
                                            <span style="color:#4183C4;">
                                                <?php echo $stat_value["vote_count"]; ?> <?php echo __("reviews", "gpdealdomain"); ?>
                                            </span>
                                        </div>
                                    </div>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <span><i class="star icon"></i> <?php echo __("No reviews", "gpdealdomain"); ?></span>
                            <?php endif ?>
                        </div>
                        <?php if ($post_author == $current_user->ID): ?>
                            <div class="item" data-tab="carried-shipments-tab"><?php echo __("Shipments", 'gpdealdomain') ?></div>
                        <?php endif ?>
                    </div>
                    <?php if ($post_author == $current_user->ID): ?>
                        <div class="ui bottom attached tab segment" data-tab="carried-shipments-tab" style="border:none;">
                            <?php
                            $package_ids = get_post_meta($transport_offer_id, 'packages-IDs', true);
                            if (is_array($package_ids)) {
                                $package_ids = array_map('intval', $package_ids);
                            } else {
                                $package_ids = null;
                            }
                            ?>
                            <?php if ($package_ids): ?>

                                <div id='list_as_grid_content' class="ui two column doubling stackable grid">
                                    <?php
                                    $package_ids_count = count($package_ids);
                                    $i = 0;
                                    foreach ($package_ids as $id) :
                                        $post_author = get_post_field('post_author', $id);
                                        ?> 
                                        <div id="single_package_column<?php echo $id ?>" class="column">
                                            <form id="single_package_content_form<?php echo $id ?>" method="POST" action="<?php echo wp_make_link_relative(get_the_permalink($id)); ?>">
                                                <div class="ui fluid card package_card">
                                                    <div class="content">
                                                        <div class="ui form description">
                                                            <div class="field">
                                                                <div class="ui grid">
                                                                    <div class="six wide column">
                                                                        <i class="blue marker icon"></i>
                                                                        <div class="inline field">
                                                                            <span class="span_value">
                                                                                <?php echo get_post_meta($id, 'departure-city-package', true) ?>
                                                                            </span><br>
                                                                            <span class="span_value">
                                                                                (<?php echo get_post_meta($id, 'departure-country-package', true) ?>)
                                                                            </span>
                                                                        </div>
                                                                    </div>
                                                                    <div class="four wide column">
                                                                        <i class="blue long arrow right icon"></i>
                                                                    </div>
                                                                    <div class="six wide column">
                                                                        <i class="blue flag checkered icon"></i>
                                                                        <div class="inline field"> 
                                                                            <span class="span_value">
                                                                                <?php echo get_post_meta($id, 'destination-city-package', true) ?>
                                                                            </span><br>
                                                                            <span class="span_value">
                                                                                (<?php echo get_post_meta($id, 'destination-country-package', true) ?>)
                                                                            </span>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="field">
                                                                <div class="ui grid">
                                                                    <div class="six wide column">
                                                                        <i class="blue calendar icon"></i>
                                                                        <div class="inline field">
                                                                            <span class="span_value">
                                                                                <?php echo date('d-m-Y', strtotime(get_post_meta($id, 'date-of-departure-package', true))); ?>
                                                                            </span>
                                                                        </div>
                                                                    </div>
                                                                    <div class="four wide column">
                                                                        <i class="blue long arrow right icon"></i>
                                                                        <div class="inline field"> 
                                                                            <span class="span_value">
                                                                                <?php echo gpdeal_date_diff(date('d-m-Y', strtotime(get_post_meta($id, 'date-of-departure-package', true))), date('d-m-Y', strtotime(get_post_meta($id, 'arrival-date-package', true)))) ?>j
                                                                            </span>
                                                                        </div>
                                                                    </div>
                                                                    <div class="six wide column">
                                                                        <i class="blue calendar icon"></i>
                                                                        <div class="inline field"> 
                                                                            <span class="span_value">
                                                                                <?php echo date('d-m-Y', strtotime(get_post_meta($id, 'arrival-date-package', true))); ?>
                                                                            </span>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="extra content">
                                                        <div class="right floated">
                                                            <div class="ui right pointing dropdown item">
                                                                <i class="ellipsis vertical icon"></i>
                                                                <div class="menu">
                                                                    <a href="<?php echo esc_url(add_query_arg(array('transport-offer-id' => $transport_offer_id), wp_make_link_relative(get_permalink($id)))); ?>" class=" item">
                                                                        <i class="unhide icon"></i>
                                                                        <?php _e("View", "gpdealdomain"); ?>
                                                                    </a>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </form>
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
                                            <?php echo __("No shipment for the moment", "gpdealdomain") ?>.
                                        </div>
                                    </div>
                                </div>
                            <?php endif ?>
                        </div>
                    <?php endif ?>
                    <div class="ui bottom attached active tab segment" data-tab="evaluations-tab" style="border:none;">
                        <div id='evaluations' class="ui basic segment container" <?php if ($action != null && $action != 'evaluate' && $action != 'evaluations' && $action != 'show'): ?> style="display: none" <?php endif ?>>
                            <?php
                            $transport_offer_link = wp_make_link_relative(get_the_permalink());
                            //$evaluations = new WP_Query(array('post_type' => 'evaluation', 'post_per_page' => -1, "post_status" => 'publish', 'orderby' => 'post_date', 'order' => 'DESC', 'meta_query' => array(array('key' => 'transport-offer-ID', 'value' => get_the_ID(), 'compare' => '='))));
                            ?>
                            <div id="content_evaluations" class="ui fluid card">
                                <div class="content center aligned">
                                    <div class="header"><?php echo __("Evaluations of the offer", "gpdealdomain"); ?></div>
                                </div>
                                <div class="content">
                                    <?php if ($evaluations->have_posts()) { ?>
                                        <div class="ui fluid card">
                                            <div class="content">
                                                <div  class="ui form" >
                                                    <?php
                                                    $statistics = getTotalStatistiticsEvaluation(get_the_ID());
                                                    foreach ($statistics as $stat_key => $stat_value):
                                                        ?>
                                                        <div class="three fields">
                                                            <div class="five wide field"><span style=" font-weight: bold"><?php echo __($stat_key, "gpdealdomain"); ?> <span style="color:#4183C4;"><?php echo $stat_value["vote_count"]; ?> <?php echo __("reviews", "gpdealdomain") ?></span> :</span></div>
                                                            <div class="seven wide field disable">
                                                                <div class="ui huge star rating" data-rating="<?php echo $stat_value["weighted_average"]; ?>" data-max-rating="5"></div>
                                                                <div class="sub-title-rating"><span class="left-sub-title-rating"><?php echo __("Unsatisfied", "gpdealdomain") ?></span> <span class="right-sub-title-rating"><?php echo __("Very satisfied", "gpdealdomain") ?></span></div>
                                                            </div>
                                                            <?php if (get_post_field('post_author', get_the_ID()) != $current_user->ID && !$current_user_evaluations->have_posts() && $package_id && get_post_meta($package_id, 'package-status', true) == 2): ?>
                                                                <div class="four wide field">
                                                                    <a id="show_block_evaluation_form_top"  href="#block_evaluation_form"  onclick="show_block_evaluation_form_top()" class="ui green basic button right floated"><?php echo __("Evaluate/Close", "gpdealdomain") ?></a>
                                                                </div>
                                                            <?php endif ?>
                                                        </div>
                                                    <?php endforeach; ?>
                                                </div>
                                            </div>
                                        </div>
                                        <?php
                                        while ($evaluations->have_posts()): $evaluations->the_post();
                                            $post_author = get_post_field('post_author', get_the_ID());
                                            $evaluate_user = get_userdata($post_author);
                                            $comments_list = get_comments(array('post_id' => get_the_ID(), "parent" => 0, "orderby" => "comment_date", "order" => "asc"));
                                            $questions = get_post_meta(get_the_ID(), 'questions', true);
                                            $responses = get_post_meta(get_the_ID(), 'responses', true);
                                            $current_user_comments_count = get_comments(array('post_id' => get_the_ID(), "user_id" => $current_user->ID, 'count' => true));
                                            $profile_picture_id = get_user_meta($post_author, 'profile-picture-ID', true) ? get_user_meta($post_author, 'profile-picture-ID', true) : get_user_meta($post_author, 'company-logo-ID', true);
                                            ?>
                                            <div class="ui form">
                                                <div class="ui fluid card">
                                                    <div onclick="show_user_evaluation_single(<?php the_ID(); ?>)" class="content" style="cursor: pointer;">
                                                        <div class=""><img  class="ui avatar image" <?php if ($profile_picture_id): ?> src= "<?php echo wp_get_attachment_url($profile_picture_id); ?>" <?php else: ?> src="<?php echo get_template_directory_uri() ?>/assets/images/avatar.png"<?php endif ?>><span style="font-weight: bold"><a><?php echo $evaluate_user->user_login ?></a></span>
                                                            <span class="meta"><?php echo __("has evaluated", "gpdealdomain") . " " . human_time_diff(get_the_time('U'), current_time('timestamp')); ?> <?php _e("ago", "gpdealdomain"); ?></span>
                                                        </div>
                                                    </div>
                                                    <?php
                                                    if (is_array($questions) && is_array($responses) && count($questions) == 5 && count($responses) == 5):
                                                        ?>
                                                        <div id="content_evaluation_single_<?php the_ID(); ?>" class="content ui form" style="display: none;">
                                                            <table class="ui celled unstackable table evaluation_table">
                                                                <tbody>
                                                                    <?php for ($i = 0; $i < 2; $i++): ?>
                                                                        <tr >
                                                                            <td><label class="span_label"><?php _e($questions[$i], "gpdealdomain"); ?></label></td>
                                                                            <td>
                                                                                <label class="answer_eval_question"><?php _e($responses[$i], "gpdealdomain"); ?></label>
                                                                            </td>
                                                                        </tr>
                                                                    <?php endfor ?>

                                                                    <tr>
                                                                        <td ><label class="span_label"><?php _e($questions[2], "gpdealdomain"); ?></label></td>
                                                                        <td class="field disable">
                                                                            <div class="ui huge star rating ratint_image" data-rating="<?php _e($responses[2], "gpdealdomain"); ?>" data-max-rating="5"></div>
                                                                            <div class="sub-title-rating"><span class="left-sub-title-rating"><?php _e("Unsatisfied", "gpdealdomain"); ?></span> <span class="right-sub-title-rating"><?php _e("Very satisfied", "gpdealdomain"); ?></span></div>
                                                                        </td>
                                                                    </tr>

                                                                    <tr>
                                                                        <td><label class="span_label"><?php _e($questions[3], "gpdealdomain"); ?></label></td>
                                                                        <td class="field disable">
                                                                            <div class="ui huge star rating ratint_image" data-rating="<?php _e($responses[3], "gpdealdomain"); ?>" data-max-rating="5"></div>
                                                                            <div class="sub-title-rating"><span class="left-sub-title-rating"><?php _e("Expensive", "gpdealdomain"); ?></span> <span class="right-sub-title-rating"><?php _e("Economic", "gpdealdomain"); ?></span></div>
                                                                        </td>
                                                                    </tr>

                                                                    <tr>
                                                                        <td><label class="span_label"><?php echo __($questions[4], "gpdealdomain"); ?></label></td>
                                                                        <td class="field disable">
                                                                            <div class="ui huge star rating ratint_image" data-rating="<?php echo __($responses[4], "gpdealdomain"); ?>" data-max-rating="5"></div>
                                                                            <div class="sub-title-rating"><span class="left-sub-title-rating"><?php _e("Unsatisfied", "gpdealdomain"); ?></span> <span class="right-sub-title-rating"><?php _e("Very satisfied", "gpdealdomain"); ?></span></div>
                                                                        </td>
                                                                    </tr>
                                                                </tbody>
                                                            </table>
                                                        </div>
                                                    <?php endif ?>
                                                </div>

                                                <h4 class="ui dividing header"><?php _e("Comments", "gpdealdomain"); ?> </h4>
                                                <div class="ui comments">
                                                    <?php if ($comments_list): ?>
                                                        <?php
                                                        foreach ($comments_list as $comment):
                                                            $comment_user = get_userdata($comment->user_id);
                                                            $comment_profile_picture_id = get_user_meta($comment->user_id, 'profile-picture-ID', true) ? get_user_meta($comment->user_id, 'profile-picture-ID', true) : get_user_meta($comment->user_id, 'company-logo-ID', true);
                                                            ?>
                                                            <div class="comment">
                                                                <a class="avatar">
                                                                    <img class="ui avatar image" <?php if ($comment_profile_picture_id): ?> src= "<?php echo wp_make_link_relative(wp_get_attachment_url($comment_profile_picture_id)); ?>" <?php else: ?> src="<?php echo wp_make_link_relative(get_template_directory_uri()) ?>/assets/images/avatar.png"<?php endif ?>>
                                                                </a>
                                                                <div class="content">
                                                                    <a class="author"><?php echo $comment_user->user_login; ?></a>
                                                                    <div class="metadata">
                                                                        <div class="date"><?php
                                                                            $date = apply_filters('get_comment_time', $comment->comment_date, 'U', false, true, $comment);
                                                                            echo __("has commented", "gpdealdomain") . " " . human_time_diff(strtotime($date), current_time('timestamp'));
                                                                            ?> <?php _e("ago", "gpdealdomain"); ?></div>
                                                                    </div>
                                                                    <div class="text">
                                                                        <p><?php echo $comment->comment_content; ?></p>
                                                                    </div>
                                                                    <?php if ($current_user_comments_count == 0): ?>
                                                                        <div class="actions">
                                                                            <a id="show_comment_reply_form<?php echo $comment->comment_ID; ?>" onclick="show_comment_reply_form(<?php echo $comment->comment_ID; ?>)" class="reply"><?php echo __("Answer", "gpdealdomain") ?></a>
                                                                            <a id="hide_comment_reply_form<?php echo $comment->comment_ID; ?>" onclick="hide_comment_reply_form(<?php echo $comment->comment_ID; ?>)" class="reply" style="display: none"><?php echo __("Cancel", "gpdealdomain") ?></a>
                                                                        </div>
                                                                    <?php endif ?>
                                                                </div>
                                                                <?php echo getAndechoAllReply(get_the_ID(), $comment->comment_ID, $transport_offer_link); ?>
                                                            </div>
                                                            <?php if ($current_user_comments_count == 0): ?>
                                                                <form id="comment_reply_form<?php echo $comment->comment_ID; ?>" class="ui reply form add_comment_reply_form" method="POST" action="<?php echo $transport_offer_link; ?>" onsubmit="add_comment_reply(event, <?php echo $comment->comment_ID; ?>)" style="display:none">
                                                                    <div class="field">
                                                                        <textarea name="comment_content" placeholder="<?php _e("Enter your answer here", "gpdealdomain"); ?>"></textarea>
                                                                    </div>
                                                                    <input type="hidden" name="action" value="add-comment-reply">
                                                                    <input type="hidden" name="evaluation_id" value="<?php the_ID(); ?>">
                                                                    <input type="hidden" name="comment_parent_id" value="<?php echo $comment->comment_ID; ?>">
                                                                    <div class="field">
                                                                        <div id="server_error_message<?php echo $comment->comment_ID; ?>" class="ui negative message" style="display:none">
                                                                            <i class="close icon"></i>
                                                                            <div id="server_error_content<?php echo $comment->comment_ID; ?>" class="header"><?php _e("Internal server error", "gpdealdomain"); ?></div>
                                                                        </div>
                                                                        <div id="error_name_message<?php echo $comment->comment_ID; ?>" class="ui error message" style="display: none">
                                                                            <i class="close icon"></i>
                                                                            <div id="error_name_header<?php echo $comment->comment_ID; ?>" class="header"></div>
                                                                            <ul id="error_name_list<?php echo $comment->comment_ID; ?>" class="list">

                                                                            </ul>
                                                                        </div>
                                                                    </div>
                                                                    <button class="ui blue submit icon button">
                                                                        <i class="icon edit"></i> <?php _e("Answer", "gpdealdomain"); ?>
                                                                    </button>
                                                                </form>
                                                            <?php endif ?>
                                                        <?php endforeach; ?>
                                                    <?php endif ?>
                                                    <?php if ($current_user_comments_count == 0): ?>
                                                        <form id="evaluation_comment_form<?php the_ID(); ?>" class="ui reply form add_comment_form" method="POST" action="<?php echo $transport_offer_link; ?>" onsubmit="add_evaluation_comment(event, <?php the_ID(); ?>)" style="display:none">
                                                            <div class="field">
                                                                <textarea name="comment_content" placeholder="<?php _e("Enter your comment here", "gpdealdomain"); ?>"></textarea>
                                                            </div>
                                                            <input type="hidden" name="action" value="add-evaluation-comment">
                                                            <input type="hidden" name="evaluation_id" value="<?php the_ID(); ?>">
                                                            <div class="field">
                                                                <div id="server_error_message<?php the_ID(); ?>" class="ui negative message" style="display:none">
                                                                    <i class="close icon"></i>
                                                                    <div id="server_error_content<?php the_ID(); ?>" class="header"><?php _e("Internal server error", "gpdealdomain"); ?></div>
                                                                </div>
                                                                <div id="error_name_message<?php the_ID(); ?>" class="ui error message" style="display: none">
                                                                    <i class="close icon"></i>
                                                                    <div id="error_name_header<?php the_ID(); ?>" class="header"></div>
                                                                    <ul id="error_name_list<?php the_ID(); ?>" class="list">

                                                                    </ul>
                                                                </div>
                                                            </div>                                                           
                                                            <div id="hide_evaluation_comment_form<?php the_ID(); ?>" onclick="hide_evaluation_comment_form(<?php echo the_ID(); ?>)" class="ui black button"><?php echo __("Cancel", "gpdealdomain") ?></div>
                                                            <button type="submit" class="ui primary submit icon button">
                                                                <i class="icon edit"></i>
                                                                <?php _e("Add a comment", "gpdealdomain") ?>
                                                            </button>
                                                        </form>
                                                    <?php endif ?>
                                                </div>
                                                <?php if ($current_user_comments_count == 0): ?>
                                                    <div class="actions" style="margin-bottom: 1em">
                                                        <a id="show_evaluation_comment_form<?php the_ID(); ?>" onclick="show_evaluation_comment_form(<?php echo the_ID(); ?>)" class="ui green button"><?php echo __("Comment evaluation", "gpdealdomain") ?></a>
                                                    </div>
                                                <?php endif ?>

                                            </div>
                                            <?php
                                        endwhile;
                                    } else {
                                        ?>
                                        <div class="">
                                            <div class="ui warning message">
                                                <div class="content">
                                                    <div class="header" style="font-weight: normal;">
                                                        <?php _e("No evaluation", "gpdealdomain") ?>.
                                                    </div>

                                                </div>
                                            </div>
                                        </div>
                                        <?php
                                    }
                                    wp_reset_postdata();
                                    ?>
                                </div>
                            </div>
                            <?php if ($package_id): ?>           
                                <?php if (get_post_field('post_author', $transport_offer_id) != $current_user->ID && !$current_user_evaluations->have_posts()): ?>
                                    <div id="block_evaluation_form" class="ui fluid card" style="display: none">
                                        <div class="content">                                            
                                            <form id="evaluation_form" class="ui form" action="<?php echo wp_make_link_relative(get_the_permalink($transport_offer_id)) ?>" method="POST">

                                                <div class="fields">
                                                    <div class="four wide field"><label><?php echo __("Global evaluation", "gpdealdomain") ?> :</label></div>
                                                    <div class="twelve wide field">
                                                        <input type="hidden" name="global_evaluation" value="0">
                                                        <div id="global_evaluation" class="ui huge star rating" data-max-rating="5"></div>
                                                        <div class="sub-title-rating"><span class="left-sub-title-rating"><?php echo __("Unsatisfied", "gpdealdomain") ?></span> <span class="right-sub-title-rating"><?php echo __("Very satisfied", "gpdealdomain") ?></span></div>
                                                    </div>
                                                </div>
                                                <div class="fields">
                                                    <div class="sixteen wide field">
                                                        <a id="show_more_details_evaluations_link"><?php _e("Give more details for your review", "gpdealdomain") ?></a>
                                                        <a id="hide_more_details_evaluations_link" style="display: none"><?php _e("Cancel details for review", "gpdealdomain") ?></a>
                                                    </div>
                                                </div>
                                                <div id="content_details_evaluations_form" style="display:none;">
                                                    <div class="fields">
                                                        <div class="four wide field"><label><?php _e("Item delivered", "gpdealdomain") ?> ? :</label></div>
                                                        <div class="twelve wide field">
                                                            <div class="inline fields">
                                                                <div class="field">
                                                                    <div class="ui radio checkbox">
                                                                        <input type="radio" name="item_delivred" value="Yes">
                                                                        <label><?php echo __("Yes", "gpdealdomain") ?></label>
                                                                    </div>
                                                                </div>
                                                                <div class="field">
                                                                    <div class="ui radio checkbox">
                                                                        <input type="radio" name="item_delivred" value="No">
                                                                        <label><?php echo __("No", "gpdealdomain") ?></label>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="fields">
                                                        <div class="four wide field"><label><?php echo __("State of objects", "gpdealdomain") ?> :</label></div>
                                                        <div class="twelve wide field">
                                                            <div class="inline fields">                        
                                                                <div class="field">
                                                                    <div class="ui radio checkbox">
                                                                        <input type="radio" name="item_state" value="Proper">
                                                                        <label><?php echo __("Proper", "gpdealdomain") ?></label>
                                                                    </div>
                                                                </div>
                                                                <div class="field">
                                                                    <div class="ui radio checkbox">
                                                                        <input type="radio" name="item_state" value="Improper">
                                                                        <label><?php echo __("Improper", "gpdealdomain") ?></label>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="fields">
                                                        <div class="four wide field"><label><?php echo __("Delivery time", "gpdealdomain") ?>  :</label></div>
                                                        <div class="twelve wide field">
                                                            <input type="hidden" name="delivry_time" value="0">
                                                            <div id="delivry_time" class="ui huge star rating" data-max-rating="5"></div>
                                                            <div class="sub-title-rating"><span class="left-sub-title-rating"><?php echo __("Unsatisfied", "gpdealdomain") ?></span> <span class="right-sub-title-rating"><?php echo __("Very satisfied", "gpdealdomain") ?></span></div>
                                                        </div>
                                                    </div>

                                                    <div class="fields">
                                                        <div class="four wide field"><label><?php echo __("Cost", "gpdealdomain") ?> :</label></div>
                                                        <div class="twelve wide field">
                                                            <input type="hidden" name="cost" value="0">
                                                            <div id="cost" class="ui huge star rating" data-max-rating="5"></div>
                                                            <div class="sub-title-rating"><span class="left-sub-title-rating"><?php echo __("Expensive", "gpdealdomain") ?></span> <span class="right-sub-title-rating"><?php echo __("Economic", "gpdealdomain") ?></span></div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <h4 class="ui dividing header"><?php echo __("Leave a comment", "gpdealdomain") ?> </h4>
                                                <div class="field">
                                                    <textarea name="comment_content" placeholder="<?php _e("Enter your comment here", "gpdealdomain"); ?>"></textarea>
                                                </div>
                                                <input type="hidden" name="action" value="evaluate" >
                                                <input type="hidden" name="package_id" value="<?php echo $package_id; ?>">
                                                <div class="ui error message"><ul class="list"><li><?php echo __("Please answer all questions", "gpdealdomain"); ?></li></ul></div>
                                                <div class="field">                               
                                                    <button id="submit_evaluation_form" type="submit" class="ui submit primary button right floated"><?php echo __("Publish your reviews", "gpdealdomain") ?></button>
                                                    <div id="hide_block_evaluation_form" onclick="hide_block_evaluation_form()" class="ui black button right floated"><?php echo __("Cancel", "gpdealdomain") ?></div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                <?php endif ?>
                            <?php endif ?>
                        </div>
                    </div>
                </div>
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
                    "package_type" => $package_type,
                    "start_country" => $start_country,
                    "start_state" => $start_state,
                    "start_city" => $start_city,
                    'start_date' => $start_date,
                    "destination_country" => $destination_country,
                    "destination_state" => $destination_state,
                    "destination_city" => $destination_city,
                    "destination_date" => $destination_date,
                    "posts_per_page" => 3
                );
                $packages = new WP_Query(getWPQueryArgsForUnsatifiedSendPackagesWithCanInterest($search_data, array_map('intval', get_post_meta(get_the_ID(), "packages-IDs", true))));
                if ($packages->have_posts()):
                    ?>
                    <div class="ui fluid card right_content_unsatisfied_shipments">
                        <div class="content">
                            <div class="header"><?php _e("Unsatisfied Shipments", "gpdealdomain"); ?></div>
                        </div>
                        <?php
                        while ($packages->have_posts()): $packages->the_post()
                            ?>
                            <div class="item">
                                <div class="ui fluid card package_card">
                                    <div class="content">
                                        <div class="ui form description">
                                            <div class="field">
                                                <div class="ui grid">
                                                    <div class="seven wide column">
                                                        <i class="blue marker icon"></i>
                                                        <div class="inline field">
                                                            <span class="span_value">
                                                                <?php echo get_post_meta(get_the_ID(), 'departure-city-package', true) ?>
                                                            </span><br>
                                                            <span class="span_value">
                                                                (<?php echo get_post_meta(get_the_ID(), 'departure-country-package', true) ?>)
                                                            </span>
                                                        </div>
                                                    </div>
                                                    <div class="two wide column">
                                                        <i class="blue long arrow right icon"></i>
                                                    </div>
                                                    <div class="seven wide column">
                                                        <i class="blue marker icon"></i>
                                                        <div class="inline field"> 
                                                            <span class="span_value">
                                                                <?php echo get_post_meta(get_the_ID(), 'destination-city-package', true) ?>
                                                            </span><br>
                                                            <span class="span_value">
                                                                (<?php echo get_post_meta(get_the_ID(), 'destination-country-package', true) ?>)
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
                                                                <?php echo date('d-m-Y', strtotime(get_post_meta(get_the_ID(), 'date-of-departure-package', true))); ?>
                                                            </span>
                                                        </div>
                                                    </div>
                                                    <div class="two wide column">
                                                        <i class="blue long arrow right icon"></i>
                                                        <div class="inline field"> 
                                                            <span class="span_value">
                                                                <?php echo gpdeal_date_diff(date('d-m-Y', strtotime(get_post_meta(get_the_ID(), 'date-of-departure-package', true))), date('d-m-Y', strtotime(get_post_meta(get_the_ID(), 'arrival-date-package', true)))) ?>j
                                                            </span>
                                                        </div>
                                                    </div>
                                                    <div class="seven wide column">
                                                        <i class="blue calendar icon"></i>
                                                        <div class="inline field"> 
                                                            <span class="span_value">
                                                                <?php echo date('d-m-Y', strtotime(get_post_meta(get_the_ID(), 'arrival-date-package', true))); ?>
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
<div id='main_content_reviews_evaluations'>
</div>