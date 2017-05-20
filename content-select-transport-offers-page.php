<?php get_template_part('top-menu', get_post_format()); ?>
<div class="ui large borderless second-nav menu">
    <div class="ui container center aligned">
        <div class="center menu">
            <div class="item">
                <a href="<?php echo wp_make_link_relative(home_url('/')); ?>" class="section"><?php echo get_page_by_path(__('home', 'gpdealdomain'))->post_title ?></a>                
                <i class="right arrow icon divider"></i>
                <div class="active section"><?php the_title(); ?></div>
            </div>
        </div>
    </div>
</div>
<div class="ui vertical masthead  segment container">
    <!--div class="ui text container">
    </div-->
    <div class="ui stackable grid">
        <div class="wide column">
            <form id="selected_transport_offers_form" class="" method="POST" action="<?php echo wp_make_link_relative(get_permalink(get_page_by_path(__('my-account', 'gpdealdomain') . '/' . __('show-carriers-contacts', 'gpdealdomain')))); ?>">
                <div  class="ui content_packages_transports fluid card">
                    <div class="content center aligned">
                        <div class="header"><?php echo __('Corresponding offers', 'gpdealdomain'); ?></div>
                    </div>
                    <div class="content content_packages_transports">
                        <?php
                        $transport_offers = new WP_Query(getWPQueryArgsForCarrierSearch($search_data));
                        $exclude_ids = array();
                        if ($transport_offers->have_posts()) {
                            ?>
                            <div id='list_as_grid_content' class="ui three column doubling stackable grid">
                                <?php
                                while ($transport_offers->have_posts()): $transport_offers->the_post();
                                    $transport_offer_id = get_the_ID();
                                    $exclude_ids[] = $transport_offer_id;
                                    ?>
                                    <div class="column">
                                        <div class="ui fluid card">
                                            <?php
                                            $post_author = get_post_field('post_author', $transport_offer_id);
                                            //$evaluations_of_author = getEvaluationsOfCarrier($post_author);
                                            $carrier_name = $current_user->ID == $post_author ? __("You", "gpdealdomain") : get_the_author_meta('user_login');
                                            $profile_picture_id = get_user_meta($post_author, 'profile-picture-ID', true) ? get_user_meta($post_author, 'profile-picture-ID', true) : get_user_meta($post_author, 'company-logo-ID', true);
                                            ?>
                                            <div class="content">
                                                <?php
                                                $statistics = getTotalStatistiticsEvaluationsOfCarrier($post_author);
                                                ?>
                                                <div class="right floated meta">
                                                    <?php if ($statistics["Evaluation globale"]["vote_count"] > 0): ?>
                                                        <?php
                                                        foreach ($statistics as $stat_key => $stat_value):
                                                            ?>
                                                            <div class="ui form">
                                                                <div class="field disable">
                                                                    <span class="ui mini star rating" data-rating="<?php echo $stat_value["weighted_average"]; ?>" data-max-rating="5"></span>
                                                                    <a id="<?php echo $transport_offer_id ?>" href="<?php echo esc_url(add_query_arg(array('carrier_id' => $post_author), wp_make_link_relative(get_permalink(get_page_by_path(__('reviews-and-evaluations', 'gpdealdomain')))))); ?>" class="show_reviews_evaluations">
                                                                        <?php echo $stat_value["vote_count"]; ?> <?php echo __("reviews", "gpdealdomain"); ?>
                                                                    </a>
                                                                </div>
                                                            </div>
                                                        <?php endforeach; ?>
                                                    <?php else: ?>
                                                        <span id="<?php echo $transport_offer_id; ?>"  ><i class="star icon"></i> <?php echo __("No reviews", "gpdealdomain"); ?></span>
                                                    <?php endif ?>
                                                </div>
                                                <img  class="ui avatar image" <?php if ($profile_picture_id): ?> src= "<?php echo wp_make_link_relative(wp_get_attachment_url($profile_picture_id)); ?>" <?php else: ?> src="<?php echo wp_make_link_relative(get_template_directory_uri()) ?>/assets/images/avatar.png"<?php endif ?>> <span class='profile_name'><?php echo $carrier_name; ?></span> (<strong><?php echo get_user_role_by_user_id($post_author) ?></strong>)
                                            </div>
                                            <div class="content">
                                                <div class="ui form description">
                                                    <div class="inline field">
                                                        <span class="span_label"><?php echo __("Departure", "gpdealdomain"); ?> : </span>
                                                        <span class="span_value">
                                                            <?php echo get_post_meta($transport_offer_id, 'departure-city-transport-offer', true) ?> (<?php echo get_post_meta($transport_offer_id, 'departure-country-transport-offer', true) ?>), <?php echo date('d-m-Y', strtotime(get_post_meta($transport_offer_id, 'date-of-departure-transport-offer', true))); ?>
                                                        </span>
                                                    </div>
                                                    <div class="inline field"> 
                                                        <span class="span_label"><?php echo __("Destination", "gpdealdomain"); ?> : </span>
                                                        <span class="span_value">
                                                            <?php echo get_post_meta($transport_offer_id, 'destination-city-transport-offer', true) ?> (<?php echo get_post_meta($transport_offer_id, 'destination-country-transport-offer', true) ?>), <?php echo date('d-m-Y', strtotime(get_post_meta($transport_offer_id, 'arrival-date-transport-offer', true))); ?>
                                                        </span>
                                                    </div>

                                                    <div class="inline field">
                                                        <span class="span_label"><?php echo __("Deadline", "gpdealdomain"); ?><i class="help circle green link icon tooltip">
                                                                <span class="tooltiptext"><?php echo __("Deadline for the validity of the offer", "gpdealdomain") ?></span>
                                                            </i> : </span> 
                                                        <span class="span_value">
                                                            <?php echo date('d-m-Y', strtotime(get_post_meta($transport_offer_id, 'deadline-of-proposition-transport-offer', true))); ?>
                                                        </span>
                                                    </div>

                                                    <div class="inline field">
                                                        <span class="span_label">Objet(s)<i class="help circle green link icon tooltip">
                                                                <span class="tooltiptext"><?php echo __("Types of objects accepted by the carrier", "gpdealdomain") ?></span>
                                                            </i> : </label> 
                                                            <span class="span_value">
                                                                <?php
                                                                $package_type_list = wp_get_post_terms($transport_offer_id, 'type_package', array("fields" => "names"));
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
                                                    <div class="inline field">
                                                        <span class="span_label">Mode de transport : </span> 
                                                        <span class="span_value">
                                                            <?php
                                                            $transport_method_list = wp_get_post_terms($transport_offer_id, 'transport-method', array("fields" => "names"));
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
                                                        <?php echo get_post_meta($transport_offer_id, 'price', true) . " " . get_post_meta($transport_offer_id, 'currency', true); ?><?php if (get_post_meta($transport_offer_id, 'price-type', true) == 1): ?>/kg<?php endif ?>
                                                    </span>
                                                </div>
                                            </div>
                                            <div class="extra content">
                                                <input id='selected_transport_offer_checkbox<?php echo $transport_offer_id; ?>' type="checkbox" name="selected_transport_offers[]" value="<?php echo $transport_offer_id; ?>" style="display: none">
                                                <a id='selected_transport_offer<?php echo $transport_offer_id; ?>' class="ui fluid green button" style="display: none" onclick="unselect_transport_offer(<?php echo $transport_offer_id; ?>)"><i class="checkmark icon"></i></a>
                                                <a id='unselected_transport_offer<?php echo $transport_offer_id; ?>' class="ui fluid grey button" onclick="select_transport_offer(<?php echo $transport_offer_id; ?>)"><?php echo __("Select", "gpdealdomain") ?></a>
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
                                            <?php echo __("No offers match your criteria", "gpdealdomain") ?>. <?php echo __("Your request has been registered", "gpdealdomain") ?>.<br>
                                            <?php _e("You can change it", "gpdealdomain"); ?> <a href="<?php echo esc_url(add_query_arg(array('action' => 'edit'), wp_make_link_relative(get_permalink($package_id)))); ?>"><?php _e("here", "gpdealdomain"); ?></a> <?php _e("or search again later", "gpdealdomain"); ?>.<br>
                                            <?php _e("You will be automatically notified (email or sms) when an offer you may be interested in will be registered", "gpdealdomain"); ?>.
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
                <?php
                $transport_offers_which_can_interest = new WP_Query(getWPQueryArgsCarrierSearchForWhichCanInterest($search_data, $exclude_ids));
                if ($transport_offers_which_can_interest->have_posts()) {
                    ?>
                    <div  class="ui content_packages_transports fluid card">
                        <div class="content center aligned">
                            <div class="header"><?php echo __('Offers that can interest to you'); ?></div>
                        </div>
                        <div class="content content_packages_transports">

                            <div id='list_as_grid_content' class="ui three column doubling stackable grid">
                                <?php
                                while ($transport_offers_which_can_interest->have_posts()): $transport_offers_which_can_interest->the_post();
                                    $transport_offer_wci_id = get_the_ID();
                                    ?>
                                    <div class="column">
                                        <div class="ui fluid card">
                                            <?php
                                            $post_author = get_post_field('post_author', $transport_offer_wci_id);
                                            //$evaluations_of_author = getEvaluationsOfCarrier($post_author);
                                            $carrier_name = $current_user->ID == $post_author ? __("You", "gpdealdomain") : get_the_author_meta('user_login');
                                            $profile_picture_id = get_user_meta($post_author, 'profile-picture-ID', true) ? get_user_meta($post_author, 'profile-picture-ID', true) : get_user_meta($post_author, 'company-logo-ID', true);
                                            ?>
                                            <div class="content">
                                                <?php
                                                $statistics = getTotalStatistiticsEvaluationsOfCarrier($post_author);
                                                ?>
                                                <div class="right floated meta">
                                                    <?php if ($statistics["Evaluation globale"]["vote_count"] > 0): ?>                                                            
                                                        <?php
                                                        foreach ($statistics as $stat_key => $stat_value):
                                                            ?>
                                                            <div class="ui form">
                                                                <div class="field disable">
                                                                    <span class="ui mini star rating" data-rating="<?php echo $stat_value["weighted_average"]; ?>" data-max-rating="5"></span>
                                                                    <a id="<?php echo $transport_offer_wci_id ?>" href="<?php echo esc_url(add_query_arg(array('carrier_id' => $post_author), the_permalink(get_page_by_path(__('reviews-and-evaluations', 'gpdealdomain'))))); ?>" class="show_reviews_evaluations">
                                                                        <?php echo $stat_value["vote_count"]; ?> <?php echo __("reviews", "gpdealdomain"); ?>
                                                                    </a>
                                                                </div>
                                                            </div>
                                                        <?php endforeach; ?>
                                                    <?php else: ?>
                                                        <span id="<?php echo $transport_offer_wci_id; ?>"  ><i class="star icon"></i> <?php echo __("No reviews", "gpdealdomain"); ?></span>
                                                    <?php endif ?>
                                                </div>
                                                <img  class="ui avatar image" <?php if ($profile_picture_id): ?> src= "<?php echo wp_get_attachment_url($profile_picture_id); ?>" <?php else: ?> src="<?php echo get_template_directory_uri() ?>/assets/images/avatar.png"<?php endif ?>> <span class='profile_name'><?php echo $carrier_name; ?></span> (<strong><?php echo get_user_role_by_user_id($post_author) ?></strong>)
                                            </div>
                                            <div class="content">
                                                <div class="ui form description">
                                                    <div class="inline field">
                                                        <span class="span_label"><?php echo __("Departure", "gpdealdomain"); ?> : </span>
                                                        <span class="span_value">
                                                            <?php echo get_post_meta($transport_offer_wci_id, 'departure-city-transport-offer', true) ?> (<?php echo get_post_meta($transport_offer_wci_id, 'departure-country-transport-offer', true) ?>), <?php echo date('d-m-Y', strtotime(get_post_meta($transport_offer_wci_id, 'date-of-departure-transport-offer', true))); ?>
                                                        </span>
                                                    </div>
                                                    <div class="inline field"> 
                                                        <span class="span_label"><?php echo __("Destination", "gpdealdomain"); ?> : </span>
                                                        <span class="span_value">
                                                            <?php echo get_post_meta($transport_offer_wci_id, 'destination-city-transport-offer', true) ?> (<?php echo get_post_meta($transport_offer_wci_id, 'destination-country-transport-offer', true) ?>), <?php echo date('d-m-Y', strtotime(get_post_meta($transport_offer_wci_id, 'arrival-date-transport-offer', true))); ?>
                                                        </span>
                                                    </div>

                                                    <div class="inline field">
                                                        <span class="span_label"><?php echo __("Deadline", "gpdealdomain"); ?><i class="help circle green link icon tooltip">
                                                                <span class="tooltiptext"><?php echo __("Deadline for the validity of the offer", "gpdealdomain") ?></span>
                                                            </i> : </span> 
                                                        <span class="span_value">
                                                            <?php echo date('d-m-Y', strtotime(get_post_meta($transport_offer_wci_id, 'deadline-of-proposition-transport-offer', true))); ?>
                                                        </span>
                                                    </div>


                                                    <div class="inline field">
                                                        <span class="span_label"><?php echo __("Object", "gpdealdomain") ?>(s)<i class="help circle green link icon tooltip">
                                                                <span class="tooltiptext"><?php echo __("Types of objects accepted by the carrier", "gpdealdomain") ?></span>
                                                            </i> : </span> 
                                                        <span class="span_value">
                                                            <?php
                                                            $package_type_list = wp_get_post_terms($transport_offer_wci_id, 'type_package', array("fields" => "names"));
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
                                                    <div class="inline field">
                                                        <span class="span_label"><?php echo __("Mode of transport", "gpdealdomain") ?> : </span> 
                                                        <span class="span_value">
                                                            <?php
                                                            $transport_method_list = wp_get_post_terms($transport_offer_wci_id, 'transport-method', array("fields" => "names"));
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
                                                        <?php echo get_post_meta($transport_offer_wci_id, 'price', true) . " " . get_post_meta($transport_offer_wci_id, 'currency', true); ?><?php if (get_post_meta($transport_offer_wci_id, 'price-type', true) == 1): ?>/kg<?php endif ?>
                                                    </span>
                                                </div>
                                            </div>
                                            <div class="extra content">
                                                <input id='selected_transport_offer_checkbox<?php echo $transport_offer_wci_id; ?>' type="checkbox" name="selected_transport_offers[]" value="<?php echo $transport_offer_wci_id; ?>" style="display: none">
                                                <a id='selected_transport_offer<?php echo $transport_offer_wci_id; ?>' class="ui fluid green button" style="display: none" onclick="unselect_transport_offer(<?php echo $transport_offer_wci_id; ?>)"><i class="checkmark icon"></i></a>
                                                <a id='unselected_transport_offer<?php echo $transport_offer_wci_id; ?>' class="ui fluid grey button" onclick="select_transport_offer(<?php echo $transport_offer_wci_id; ?>)"><?php echo __("Select", "gpdealdomain") ?></a>
                                            </div>
                                        </div>
                                    </div>
                                    <?php
                                endwhile;
                                ?>
                            </div>
                        </div>
                    </div>
                    <?php
                } wp_reset_postdata();
                if ($transport_offers_which_can_interest->have_posts() || $transport_offers->have_posts()):
                    ?>
                    <input type="hidden" name='package_id' value="<?php echo $package_id; ?>">
                    <div align="center">
                        <!--<button id='submit_selected_transport_offers' type='submit' name='submit_selected_transport_offers' class="ui green button" ><?php echo __("Validate selection", "gpdealdomain") ?></button>-->
                        <button id='submit_selected_transport_offers' onclick="confirm_finalisation_transaction_select()" type='submit' name='submit_selected_transport_offers' class="ui green button" value='yes'><?php echo __("Validate selection", "gpdealdomain") ?></button>
                    </div>
                <?php endif ?>
            </form>
        </div>
    </div>
</div>
<div id='main_content_reviews_evaluations'>
</div>
