<?php
global $current_user;
get_template_part('top-menu', get_post_format());
?>
<div class="ui large borderless second-nav menu">
    <div class="ui container center aligned">
        <div class="center menu">
            <div class="item">
                <a href="<?php echo wp_make_link_relative(home_url('/')); ?>" class="section"><?php echo get_page_by_path(__('home', 'gpdealdomain'))->post_title ?></a>                
                <i class="right arrow icon divider"></i>
                <div class="active section"><?php echo __('Search results for transport offers'); ?></div>
            </div>
        </div>
    </div>
</div>
<div class="ui vertical masthead  segment container">
    <!--div class="ui text container">
    </div-->
    <div class="ui stackable grid">

        <div class="wide column">
            <form id="selected_transport_offers_form" class="" method="POST" action="<?php echo wp_make_link_relative(get_permalink(get_page_by_path(__('my-account', 'gpdealdomain') . '/' . __('shipments', 'gpdealdomain') . '/' . __('write', 'gpdealdomain')))); ?>">
                <div  class="ui content_packages_transports fluid card">
                    <div class="content center aligned">
                        <div class="header"><?php echo __('Carriers departing from', 'gpdealdomain'); ?> <span class="locality_name"><?php echo $locality_name ?></span></div>
                    </div>
                    <div class="content">
                        <?php
                        $transport_offers_start = new WP_Query(getWPQueryArgsForMainCarrierSearchWithStartParameters($search_query_data_start));
                        if ($transport_offers_start->have_posts()) {
                            ?>
                            <div id='list_as_grid_content' class="ui three column doubling stackable grid">
                                <?php
                                while ($transport_offers_start->have_posts()): $transport_offers_start->the_post();
                                    $transport_offer_start_id = get_the_ID();
                                    ?>
                                    <div class="column">
                                        <div class="ui fluid card">
                                            <?php
                                            $post_author = get_post_field('post_author', $transport_offer_start_id);
                                            $carrier_name = $current_user->ID == $post_author ? __("You", "gpdealdomain") : get_the_author_meta('user_login');
                                            $profile_picture_id = get_user_meta($post_author, 'profile-picture-ID', true) ? get_user_meta($post_author, 'profile-picture-ID', true) : get_user_meta($post_author, 'company-logo-ID', true);
                                            $max_length = get_post_meta($transport_offer_start_id, 'package-length-max', true);
                                            $max_width = get_post_meta($transport_offer_start_id, 'package-width-max', true);
                                            $max_height = get_post_meta($transport_offer_start_id, 'package-height-max', true);
                                            $max_weight = get_post_meta($transport_offer_start_id, 'package-weight-max', true);
                                            ?>
                                            <div class="content">
                                                <?php
                                                $statistics = getTotalStatistiticsEvaluationsOfCarrier($post_author);
                                                wp_reset_postdata();
                                                ?>
                                                <div class="right floated meta">
                                                    <?php if ($statistics["Evaluation globale"]["vote_count"] > 0): ?>
                                                        <?php
                                                        foreach ($statistics as $stat_key => $stat_value):
                                                            ?>
                                                            <div class="ui form">
                                                                <div class="field disable">
                                                                    <span class="ui mini star rating" data-rating="<?php echo $stat_value["weighted_average"]; ?>" data-max-rating="5"></span>
                                                                    <a id="<?php echo $transport_offer_start_id ?>" href="<?php echo esc_url(add_query_arg(array('carrier_id' => $post_author), wp_make_link_relative(get_permalink(get_page_by_path(__('reviews-and-evaluations', 'gpdealdomain')))))); ?>" class="show_reviews_evaluations">
                                                                        <?php echo $stat_value["vote_count"]; ?> reviews
                                                                    </a>
                                                                </div>
                                                            </div>
                                                        <?php endforeach; ?>
                                                    <?php else: ?>
                                                        <span id="<?php echo $transport_offer_start_id; ?>"  ><i class="star icon"></i> <?php echo __("No reviews", "gpdealdomain"); ?></span>
                                                    <?php endif ?>
                                                </div>
                                                <img  class="ui avatar image" <?php if ($profile_picture_id): ?> src= "<?php echo wp_make_link_relative(wp_get_attachment_url($profile_picture_id)); ?>" <?php else: ?> src="<?php echo wp_make_link_relative(get_template_directory_uri()) ?>/assets/images/avatar.png"<?php endif ?>><span class='profile_name'><?php echo $carrier_name; ?></span> (<strong><?php echo get_user_role_by_user_id($post_author) ?></strong>)
                                            </div>
                                            <div class="content">
                                                <div class="ui form description">
                                                    <div class="inline field">
                                                        <span class="span_label"><?php echo __("Departure", 'gpdealdomain') ?> : </span>
                                                        <span class="span_value">
                                                            <?php echo get_post_meta($transport_offer_start_id, 'departure-city-transport-offer', true) ?> (<?php echo get_post_meta($transport_offer_start_id, 'departure-country-transport-offer', true) ?>), <?php echo date('d-m-Y', strtotime(get_post_meta($transport_offer_start_id, 'date-of-departure-transport-offer', true))); ?>
                                                        </span>
                                                    </div>
                                                    <div class="inline field"> 
                                                        <span class="span_label"><?php echo __("Destination", 'gpdealdomain') ?> : </span>
                                                        <span class="span_value">
                                                            <?php echo get_post_meta($transport_offer_start_id, 'destination-city-transport-offer', true) ?> (<?php echo get_post_meta($transport_offer_start_id, 'destination-country-transport-offer', true) ?>), <?php echo date('d-m-Y', strtotime(get_post_meta($transport_offer_start_id, 'arrival-date-transport-offer', true))); ?>
                                                        </span>
                                                    </div>

                                                    <div class="inline field">
                                                        <span class="span_label"><?php echo __("Deadline", 'gpdealdomain') ?><i class="help circle green link icon tooltip">
                                                                <span class="tooltiptext"><?php echo __("Deadline for the validity of the offer", "gpdealdomain") ?></span>
                                                            </i> : </span> 
                                                        <span class="span_value">
                                                            <?php echo date('d-m-Y', strtotime(get_post_meta($transport_offer_start_id, 'deadline-of-proposition-transport-offer', true))); ?>
                                                        </span>

                                                    </div>
                                                    <div class="inline field">
                                                        <span class="span_label"><?php echo __("Object", 'gpdealdomain') ?>(s)<i class="help circle green link icon tooltip">
                                                                <span class="tooltiptext"><?php echo __("Types of objects accepted by the carrier", "gpdealdomain") ?></span>
                                                            </i> : </span> 
                                                        <span class="span_value">
                                                            <?php
                                                            $package_type_list = wp_get_post_terms($transport_offer_start_id, 'type_package', array("fields" => "names"));
                                                            $package_type_list_count = count($package_type_list);
                                                            $j = 0;
                                                            foreach ($package_type_list as $name) :
                                                                ?>
                                                                <?php if ($j < $package_type_list_count - 1) : ?>
                                                                    <span><?php echo $name; ?>, </span>
                                                                <?php else: ?>
                                                                    <span><?php echo $name; ?></span>
                                                                <?php endif ?>
                                                                <?php
                                                                $j++;
                                                            endforeach
                                                            ?>
                                                        </span>
                                                    </div>
                                                    <?php if ($max_length || $max_width || $max_height || $max_weight) : ?>
                                                        <div class="inline field">
                                                            <span class="span_label"><?php echo __("Max dimensions", 'gpdealdomain') ?>(cm) : </span> 
                                                            <span class="span_value">
                                                                <?php if ($max_length) : ?>L= <?php echo $max_length; ?>,<?php endif ?>  <?php if ($max_width) : ?>l= <?php echo $max_width; ?>,<?php endif ?>  <?php if ($max_height) : ?>h= <?php echo $max_height; ?><?php endif ?>
                                                            </span>
                                                        </div>
                                                        <?php if ($max_weight) : ?>
                                                            <div class="inline field">
                                                                <span class="span_label"><?php echo __("Max weight", 'gpdealdomain') ?>(kg) : </span> 
                                                                <span class="span_value">
                                                                    <?php echo $max_weight; ?>
                                                                </span>
                                                            </div>
                                                        <?php endif ?>
                                                    <?php endif ?>
                                                    <div class="inline field">
                                                        <span class="span_label"><?php echo __("Mode of transport", 'gpdealdomain') ?> : </span> 
                                                        <span class="span_value">
                                                            <?php
                                                            $transport_method_list = wp_get_post_terms($transport_offer_start_id, 'transport-method', array("fields" => "names"));
                                                            $transport_method_list_count = count($transport_method_list);
                                                            $i = 0;
                                                            foreach ($transport_method_list as $name) :
                                                                ?>
                                                                <?php if ($i < $transport_method_list_count - 1) : ?>
                                                                    <span><?php echo $name; ?>, </span>
                                                                <?php else: ?>
                                                                    <span><?php echo $name; ?></span>
                                                                <?php endif ?>
                                                                <?php
                                                                $i++;
                                                            endforeach
                                                            ?>
                                                        </span>
                                                    </div>

                                                    <span class="ui blue right ribbon label">
                                                        <?php echo get_post_meta($transport_offer_start_id, 'price', true) . " " . get_post_meta($transport_offer_start_id, 'currency', true); ?><?php if (get_post_meta($transport_offer_start_id, 'price-type', true) == 1): ?>/kg<?php endif ?>
                                                    </span>
                                                </div>
                                            </div>
                                            <!--                                            <div class="extra content">
                                            <?php if (is_user_logged_in()) : ?>
                                                                                                        <input id='selected_transport_offer_checkbox<?php echo $transport_offer_start_id; ?>' type="checkbox" name="selected_transport_offers[]" value="<?php echo $transport_offer_start_id; ?>" style="display: none">
                                                                                                        <a id='selected_transport_offer<?php echo $transport_offer_start_id; ?>' class="ui fluid green button" style="display: none" onclick="unselect_transport_offer(<?php echo $transport_offer_start_id; ?>)"><i class="checkmark icon"></i></a>
                                                                                                        <a id='unselected_transport_offer<?php echo $transport_offer_start_id; ?>' class="ui fluid green button" onclick="select_transport_offer(<?php echo $transport_offer_start_id; ?>)"><?php echo __("Selectionner", "gpdealdomain") ?></a>
                                            <?php else: ?>
                                                                                                        <a class="ui fluid green button" onclick="signin();"><?php echo __("Selectionner", "gpdealdomain") ?></a>
                                            <?php endif ?>
                                                                                        </div>-->
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
                                            <?php echo __("No offers valid from", 'gpdealdomain') ?> <?php echo $country_region_city['city']; ?>.
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

                <div  class="ui content_packages_transports fluid card">
                    <div class="content center aligned">
                        <div class="header"><?php echo __('Carriers to'); ?> <span class="locality_name"><?php echo $locality_name ?></span></div>
                    </div>
                    <div class="content">
                        <?php
                        $transport_offers_destination = new WP_Query(getWPQueryArgsForMainCarrierSearchWithDestinationParameters($search_query_data_destination));
                        if ($transport_offers_destination->have_posts()) {
                            ?>
                            <div id='list_as_grid_content' class="ui three column doubling stackable grid">
                                <?php
                                while ($transport_offers_destination->have_posts()): $transport_offers_destination->the_post();
                                    $transport_offer_dest_id = get_the_ID();
                                    ?>
                                    <div class="column">

                                        <div class="ui fluid card">
                                            <?php
                                            $post_author = get_post_field('post_author', $transport_offer_dest_id);
                                            $carrier_name = $current_user->ID == $post_author ? __("You", "gpdealdomain") : get_the_author_meta('user_login');
                                            $profile_picture_id = get_user_meta($post_author, 'profile-picture-ID', true) ? get_user_meta($post_author, 'profile-picture-ID', true) : get_user_meta($post_author, 'company-logo-ID', true);
                                            $max_length = get_post_meta($transport_offer_dest_id, 'package-length-max', true);
                                            $max_width = get_post_meta($transport_offer_dest_id, 'package-width-max', true);
                                            $max_height = get_post_meta($transport_offer_dest_id, 'package-height-max', true);
                                            $max_weight = get_post_meta($transport_offer_dest_id, 'package-weight-max', true);
                                            ?>
                                            <div class="content">
                                                <?php
                                                $statistics = getTotalStatistiticsEvaluationsOfCarrier($post_author);
                                                wp_reset_postdata();
                                                ?>
                                                <div class="right floated meta">
                                                    <?php if ($statistics["Evaluation globale"]["vote_count"] > 0): ?>
                                                        <?php
                                                        foreach ($statistics as $stat_key => $stat_value):
                                                            ?>
                                                            <div class="ui form">
                                                                <div class="field disable">
                                                                    <span class="ui mini star rating" data-rating="<?php echo $stat_value["weighted_average"]; ?>" data-max-rating="5"></span>
                                                                    <a id="<?php echo $transport_offer_dest_id ?>" href="<?php echo esc_url(add_query_arg(array('carrier_id' => $post_author), wp_make_link_relative(get_permalink(get_page_by_path(__('reviews-et-evaluations', 'gpdealdomain')))))); ?>" class="show_reviews_evaluations">
                                                                        <?php echo $stat_value["vote_count"]; ?> reviews
                                                                    </a>
                                                                </div>
                                                            </div>
                                                        <?php endforeach; ?>
                                                    <?php else: ?>
                                                        <span id="<?php echo $transport_offer_dest_id; ?>"  ><i class="star icon"></i> <?php echo __("No reviews", "gpdealdomain"); ?></span>
                                                    <?php endif ?>
                                                </div>
                                                <img  class="ui avatar image" <?php if ($profile_picture_id): ?> src= "<?php echo wp_make_link_relative(wp_get_attachment_url($profile_picture_id)); ?>" <?php else: ?> src="<?php echo wp_make_link_relative(get_template_directory_uri()) ?>/assets/images/avatar.png"<?php endif ?>> <span class='profile_name'><?php echo $carrier_name; ?></span> (<strong><?php echo get_user_role_by_user_id($post_author) ?></strong>)
                                            </div>
                                            <div class="content">
                                                <div class="ui form description">
                                                    <div class="inline field">
                                                        <span class="span_label"><?php echo __("Departure", 'gpdealdomain') ?> : </span>
                                                        <span class="span_value">
                                                            <?php echo get_post_meta($transport_offer_dest_id, 'departure-city-transport-offer', true) ?> (<?php echo get_post_meta($transport_offer_dest_id, 'departure-country-transport-offer', true) ?>), <?php echo date('d-m-Y', strtotime(get_post_meta($transport_offer_dest_id, 'date-of-departure-transport-offer', true))); ?>
                                                        </span>
                                                    </div>
                                                    <div class="inline field"> 
                                                        <span class="span_label"><?php echo __("Destination", 'gpdealdomain') ?> : </span>
                                                        <span class="span_value">
                                                            <?php echo get_post_meta($transport_offer_dest_id, 'destination-city-transport-offer', true) ?> (<?php echo get_post_meta($transport_offer_dest_id, 'destination-country-transport-offer', true) ?>), <?php echo date('d-m-Y', strtotime(get_post_meta($transport_offer_dest_id, 'arrival-date-transport-offer', true))); ?>
                                                        </span>
                                                    </div>

                                                    <div class="inline field">
                                                        <span class="span_label"><?php echo __("Deadline", 'gpdealdomain') ?><i class="help circle green link icon tooltip">
                                                                <span class="tooltiptext"><?php echo __("Deadline for the validity of the offer", "gpdealdomain") ?></span>
                                                            </i> : </span> 
                                                        <span class="span_value">
                                                            <?php echo date('d-m-Y', strtotime(get_post_meta($transport_offer_dest_id, 'deadline-of-proposition-transport-offer', true))); ?>
                                                        </span>
                                                    </div>

                                                    <div class="inline field">
                                                        <span class="span_label"><?php echo __("Object", 'gpdealdomain') ?>(s)<i class="help circle green link icon tooltip">
                                                                <span class="tooltiptext"><?php echo __("Types of objects accepted by the carrier", "gpdealdomain") ?></span>
                                                            </i> : </span> 
                                                        <span class="span_value">
                                                            <?php
                                                            $package_type_list = wp_get_post_terms($transport_offer_dest_id, 'type_package', array("fields" => "names"));
                                                            $package_type_list_count = count($package_type_list);
                                                            $j = 0;
                                                            foreach ($package_type_list as $name) :
                                                                ?>
                                                                <?php if ($j < $package_type_list_count - 1) : ?>
                                                                    <span><?php echo $name; ?>, </span>
                                                                <?php else: ?>
                                                                    <span><?php echo $name; ?></span>
                                                                <?php endif ?>
                                                                <?php
                                                                $j++;
                                                            endforeach
                                                            ?>
                                                        </span>
                                                    </div>
                                                    <?php if ($max_length || $max_width || $max_height || $max_weight) : ?>
                                                        <div class="inline field">
                                                            <span class="span_label"><?php echo __("Max dimensions", 'gpdealdomain') ?>(cm) : </span> 
                                                            <span class="span_value">
                                                                <?php if ($max_length) : ?>L= <?php echo $max_length; ?>,<?php endif ?>  <?php if ($max_width) : ?>l= <?php echo $max_width; ?>,<?php endif ?>  <?php if ($max_height) : ?>h= <?php echo $max_height; ?><?php endif ?>
                                                            </span>
                                                        </div>
                                                        <?php if ($max_weight) : ?>
                                                            <div class="inline field">
                                                                <span class="span_label"><?php echo __("Max weight", 'gpdealdomain') ?>(kg) : </span> 
                                                                <span class="span_value">
                                                                    <?php echo $max_weight; ?>
                                                                </span>
                                                            </div>
                                                        <?php endif ?>
                                                    <?php endif ?>
                                                    <div class="inline field">
                                                        <span class="span_label"><?php echo __("Mode of transport", 'gpdealdomain') ?> : </span> 
                                                        <span class="span_value">
                                                            <?php
                                                            $transport_method_list = wp_get_post_terms($transport_offer_dest_id, 'transport-method', array("fields" => "names"));
                                                            $transport_method_list_count = count($transport_method_list);
                                                            $i = 0;
                                                            foreach ($transport_method_list as $name) :
                                                                ?>
                                                                <?php if ($i < $transport_method_list_count - 1) : ?>
                                                                    <span><?php echo $name; ?>, </span>
                                                                <?php else: ?>
                                                                    <span><?php echo $name; ?></span>
                                                                <?php endif ?>
                                                                <?php
                                                                $i++;
                                                            endforeach
                                                            ?>
                                                        </span>
                                                    </div>

                                                    <span class="ui blue right ribbon label">
                                                        <?php echo get_post_meta($transport_offer_dest_id, 'price', true) . " " . get_post_meta($transport_offer_dest_id, 'currency', true); ?><?php if (get_post_meta($transport_offer_dest_id, 'price-type', true) == 1): ?>/kg<?php endif ?>
                                                    </span>
                                                </div>
                                            </div>
                                            <!--                                            <div class="extra content">
                                            <?php if (is_user_logged_in()) : ?>
                                                                                                        <input id='selected_transport_offer_checkbox<?php echo $transport_offer_dest_id; ?>' type="checkbox" name="selected_transport_offers[]" value="<?php echo $transport_offer_dest_id; ?>" style="display: none">
                                                                                                        <a id='selected_transport_offer<?php echo $transport_offer_dest_id; ?>' class="ui fluid green button" style="display: none" onclick="unselect_transport_offer(<?php echo $transport_offer_dest_id; ?>)"><i class="checkmark icon"></i></a>
                                                                                                        <a id='unselected_transport_offer<?php echo $transport_offer_dest_id; ?>' class="ui fluid green button" onclick="select_transport_offer(<?php echo $transport_offer_dest_id; ?>)"><?php echo __("Selectionner", "gpdealdomain") ?></a>
                                            <?php else: ?>
                                                                                                        <a class="ui fluid green button" onclick="signin();"><?php echo __("Selectionner", "gpdealdomain") ?></a>
                                            <?php endif ?>
                                                                                        </div>-->
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
                                            <?php echo __("No valid offer to", 'gpdealdomain') ?> <?php echo $country_region_city['city']; ?>.
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
                <?php if ($transport_offers_start->have_posts() || $transport_offers_destination->have_posts()): ?>
                    <input type="hidden" name='package_id' value="<?php echo $package_id; ?>">
                    <input type="hidden" name='confirm_transaction' value='true' >
                    <div align="center" >
                        <!--<button id='submit_selected_transport_offers' type='submit' name='submit_selected_transport_offers' class="ui green button" ><?php echo __("Validate selection", "gpdealdomain") ?></button>-->
                        <button id='submit_selected_transport_offers' type='submit' name='submit_selected_transport_offers' class="ui green button" value='yes' style="display: none"><?php echo __("Validate selection", "gpdealdomain") ?></button>
                    </div>
                <?php endif ?>
            </form>
        </div>
    </div>
</div>
<?php include(locate_template('content-login-modal-page.php')); ?>
<div id='main_content_reviews_evaluations'>
</div>

