<?php
get_template_part('top-menu', get_post_format());
?>
<div class="ui tiny borderless second-nav menu">
    <div class="ui container center aligned">
        <div class="center menu">
            <div class="item">
                <a href="<?php echo wp_make_link_relative(home_url('/')); ?>" class="section"><?php echo get_page_by_path(__('home', 'gpdealdomain'))->post_title ?></a>
                <i class="small right chevron icon divider"></i>
                <a href="<?php echo wp_make_link_relative(esc_url(add_query_arg(array('package-id' => $_SESSION['package_id']), get_permalink(get_page_by_path(__('select-transport-offers', 'gpdealdomain')))))); ?>" class="section"><?php echo get_page_by_path(__('select-transport-offers', 'gpdealdomain'))->post_title ?></a>
                <i class="small right arrow icon divider"></i>
                <div class="active section"><?php the_title(); ?></div>
            </div>
        </div>
    </div>
</div>
<div class="ui vertical masthead segment container review_confirm">
    <?php //if (get_post_meta($package_id, 'package-insured', true) == "yes" && get_post_meta($package_id, 'package-insurance-completed', true) == 1): ?>
<!--        <div class="ui content_steps_select_transport_offer container">
            <div class="ui two top attached steps select_transport_offers">
                <a class="active step"href="<?php echo esc_url(get_permalink(get_page_by_path(__('select-transport-offers', 'gpdealdomain') . '/' . __('review', 'gpdealdomain')))); ?>">
                    <i class="file text outline green icon"></i>
                    <div class="content">
                        <div class="title"><?php echo __("Review", 'gpdealdomain') ?></div>
                    </div>
                </a>
                <a class="disabled step" href="<?php echo esc_url(get_permalink(get_page_by_path(__('select-transport-offers', 'gpdealdomain') . '/' . __('insure', 'gpdealdomain')))); ?>">
                    <i class="payment icon"></i>
                    <div class="content">
                        <div class="title"><?php echo __("Insure your shipment", 'gpdealdomain') ?></div>
                    </div>
                </a>
            </div>
        </div>-->
    <?php //endif ?>
    <div class="ui attached segment select_transport_offers">
        <div class="ui stackable grid">
            <div class="wide column content_without_white">
                <div  class="ui content_packages_transports fluid card">
                    <div class="content center aligned">
                        <div class="header"><?php _e("A carrier selected for your shipment", "gpdealdomain"); ?> <?php _e("from", "gpdealdomain"); ?> <span class="locality_name"><?php echo get_post_meta($package_id, 'departure-city-package', true); ?>(<?php echo date('d-m-Y', strtotime(get_post_meta($package_id, 'date-of-departure-package', true))); ?>)</span> <?php _e("to", "gpdealdomain"); ?> <span class="locality_name"><?php echo get_post_meta($package_id, 'destination-city-package', true); ?>(<?php echo date('d-m-Y', strtotime(get_post_meta($package_id, 'arrival-date-package', true))); ?>)</span></div>
                    </div>
                    <div class="content content_without_white">
                        <?php
                        global $current_user;
                        $transport_offers = new WP_Query(array('post_type' => 'transport-offer', 'post_per_page' => -1, "post_status" => 'publish', 'orderby' => 'post_date', 'order' => 'DESC', 'post__in' => $selected_transport_offers));
                        if ($transport_offers->have_posts()) {
                            ?>
                            <div id='list_as_grid_content' class="stackable grid">
                                <?php
                                while ($transport_offers->have_posts()): $transport_offers->the_post();
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
                                    $transport_offer_id = get_the_ID();
                                    ?>
                                    <div class="wide column">
                                        <div class="ui signup_contenair basic segment container content_without_white">
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
                                                                        <span class="span_value">
                                                                            <?php echo date('d-m-Y', strtotime(get_post_meta($transport_offer_id, 'deadline-of-proposition-transport-offer', true))); ?>
                                                                        </span> 
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
                                                                            $package_type_list = wp_get_post_terms($transport_offer_id, 'type_package', array("fields" => "names"));
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
                                                                            $transport_method_list = wp_get_post_terms($transport_offer_id, 'transport-method', array("fields" => "names"));
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
                                                            </tbody>
                                                        </table>
                                                        <span class="ui blue right ribbon label">
                                                            <?php
                                                            //$price = getCostOfTransportOffer(get_post_meta($transport_offer_id, 'distance-between-departure-arrival', true), $L, $l, $h, $weight, strtolower($name), 0.001844748, $package_currency);
                                                            ?>
                                                            <?php echo get_post_meta($transport_offer_id, 'price', true) . " " . get_post_meta($transport_offer_id, 'currency', true); 
//                                                            echo $price." ".$package_currency;
                                                            ?><?php if (get_post_meta($transport_offer_id, 'price-type', true) == 1): ?>/kg<?php endif ?>
                                                        </span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <?php
                                endwhile;
                                ?>
                            </div>
                        <?php } else { ?>
                            <div class="">
                                <div class="ui warning message">
                                    <div class="content">
                                        <div class="header" style="font-weight: normal;">
                                            <?php echo __("No carrier selected for the moment", "gpdealdomain") ?>.
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <?php
                        }
                        wp_reset_postdata();
                        ?>
                    </div>
                    <div class="extra content">
                        <a id="continue_to_confirm_transaction" href="<?php echo esc_url(get_permalink(get_page_by_path(__('select-transport-offers', 'gpdealdomain') . '/' . __('insure-shipment', 'gpdealdomain')))); ?>" class="ui green button right floated">
                                <?php _e("Validate selection", "gpdealdomain"); ?>
                            </a>
                        
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

