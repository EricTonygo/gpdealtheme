<?php
global $current_user;
get_template_part('top-menu', get_post_format());
?>
<div class="ui large borderless second-nav menu">
    <div class="ui container center aligned">
        <div class="center menu">
            <div class="item">
                <a href="<?php echo wp_make_link_relative(home_url('/')) ?>" class="section"><?php echo get_page_by_path(__('home', 'gpdealdomain'))->post_title ?></a>                
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
            <form id="selected_transport_offers_form" class="" method="POST" action="<?php echo wp_make_link_relative(get_permalink(get_page_by_path(__('mon-compte', 'gpdealdomain') . '/' . __('expeditions', 'gpdealdomain') . '/' . __('saisir', 'gpdealdomain')))); ?>">
                <?php if (is_user_logged_in()): ?>
                    <div style="display: none">
                        <div class="two wide fields">
                            <div class="field">
                                <div class="ui input left icon">
                                    <i class="marker icon"></i>
                                    <input id="start_city_transport" type="text" name='start_city' placeholder="<?php _e("Departure city", "gpdealdomain"); ?>" value="<?php echo $start_city ?>">
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

                        <div class="two wide fields">
                            <div class="field">
                                <div class="ui input left icon">
                                    <i class="marker icon"></i>
                                    <input id="destination_city_transport" type="text" name='destination_city' placeholder="<?php _e("Destination city", "gpdealdomain"); ?>" value="<?php echo $destination_city ?>">
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
                        <div class="fields">
                            <div class="twelve wide field">
                                <div class="inline fields">
                                    <?php
                                    $typePackages = get_terms(array('taxonomy' => 'type_package', 'hide_empty' => false, 'orderby' => 'ID', 'order' => 'ASC'));
                                    foreach ($typePackages as $typePackage):
                                        ?>
                                        <div class="field">
                                            <div class="ui checkbox">
                                                <input type="checkbox" name="package_type[]" value="<?php echo $typePackage->term_id; ?>" <?php if (in_array($typePackage->term_id, $package_type, true)): ?> checked="checked" <?php endif ?>>
                                                <label><?php echo $typePackage->name; ?></label>
                                            </div>
                                        </div>
                                    <?php endforeach ?>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endif ?>

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
                                            $carrier_name = $current_user->ID == $post_author ? __("You", "gpdealdomain") : get_the_author_meta('user_login');
                                            $profile_picture_id = get_user_meta($post_author, 'profile-picture-ID', true) ? get_user_meta($post_author, 'profile-picture-ID', true) : get_user_meta($post_author, 'company-logo-ID', true);
                                            $max_length = get_post_meta($transport_offer_id, 'package-length-max', true);
                                            $max_width = get_post_meta($transport_offer_id, 'package-width-max', true);
                                            $max_height = get_post_meta($transport_offer_id, 'package-height-max', true);
                                            $max_weight = get_post_meta($transport_offer_id, 'package-weight-max', true);
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
                                                        <span class="span_label"><?php _e("Departur", "gpdealdomain"); ?> : </span>
                                                        <span class="span_value">
                                                            <?php echo get_post_meta($transport_offer_id, 'departure-city-transport-offer', true) ?> (<?php echo get_post_meta($transport_offer_id, 'departure-country-transport-offer', true) ?>), <?php echo date('d-m-Y', strtotime(get_post_meta($transport_offer_id, 'date-of-departure-transport-offer', true))); ?>
                                                        </span>
                                                    </div>
                                                    <div class="inline field"> 
                                                        <span class="span_label"><?php _e("Destination", "gpdealdomain"); ?> : </span>
                                                        <span class="span_value">
                                                            <?php echo get_post_meta($transport_offer_id, 'destination-city-transport-offer', true) ?> (<?php echo get_post_meta($transport_offer_id, 'destination-country-transport-offer', true) ?>), <?php echo date('d-m-Y', strtotime(get_post_meta($transport_offer_id, 'arrival-date-transport-offer', true))); ?>
                                                        </span>
                                                    </div>

                                                    <div class="inline field">
                                                        <span class="span_label"><?php _e("Deadline", "gpdealdomain"); ?><i class="help circle green link icon tooltip">
                                                                <span class="tooltiptext"><?php echo __("Date limite de validité de l'offre", "gpdealdomain") ?></span>
                                                            </i> : </span> 
                                                        <span class="span_value">
                                                            <?php echo date('d-m-Y', strtotime(get_post_meta($transport_offer_id, 'deadline-of-proposition-transport-offer', true))); ?>
                                                        </span>
                                                    </div>


                                                    <div class="inline field">
                                                        <span class="span_label"><?php _e("Object", "gpdealdomain"); ?>(s)<i class="help circle green link icon tooltip">
                                                                <span class="tooltiptext"><?php echo __("Types of objects accepted by the carrier", "gpdealdomain") ?></span>
                                                            </i> : </span> 
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
                                                    <?php if ($max_length || $max_width || $max_height || $max_weight) : ?>
                                                        <div class="inline field">
                                                            <span class="span_label"><?php _e("Max dimensions", "gpdealdomain"); ?>(cm) : </span> 
                                                            <span class="span_value">
                                                                <?php if ($max_length) : ?>L= <?php echo $max_length; ?>,<?php endif ?>  <?php if ($max_width) : ?>l= <?php echo $max_width; ?>,<?php endif ?>  <?php if ($max_height) : ?>h= <?php echo $max_height; ?><?php endif ?>
                                                            </span>
                                                        </div>
                                                        <?php if ($max_weight) : ?>
                                                            <div class="inline field">
                                                                <span class="span_label"><?php _e("Max weight", "gpdealdomain"); ?>(kg) : </span> 
                                                                <span class="span_value">
                                                                    <?php echo $max_weight; ?>
                                                                </span>
                                                            </div>
                                                        <?php endif ?>
                                                    <?php endif ?>
                                                    <div class="inline field">
                                                        <span class="span_label"><?php _e("Mode of transport", "gpdealdomain"); ?> : </span> 
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
                                            <!--                                            <div class="extra content">
                                            <?php if (is_user_logged_in()) : ?>
                                                                                                                        <input id='selected_transport_offer_checkbox<?php echo $transport_offer_id; ?>' type="checkbox" name="selected_transport_offers[]" value="<?php echo $transport_offer_id; ?>" style="display: none">
                                                                                                                        <a id='selected_transport_offer<?php echo $transport_offer_id; ?>' class="ui fluid green button" style="display: none" onclick="unselect_transport_offer(<?php echo $transport_offer_id; ?>)"><i class="checkmark icon"></i></a>
                                                                                                                        <a id='unselected_transport_offer<?php echo $transport_offer_id; ?>' class="ui fluid grey button" onclick="select_transport_offer(<?php echo $transport_offer_id; ?>)"><?php echo __("Selectionner", "gpdealdomain") ?></a>
                                            <?php else: ?>
                                                                                                                        <a class="ui fluid grey button" onclick="signin();"><?php echo __("Selectionner", "gpdealdomain") ?></a>
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
                                            <?php _e("No valid offer match your criteria", "gpdealdomain"); ?>.
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
                            <div class="header"><?php echo __('Offers that can interest you', 'gpdealdomain'); ?></div>
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
                                            $carrier_name = $current_user->ID == $post_author ? __("You", "gpdealdomain") : get_the_author_meta('user_login');
                                            $profile_picture_id = get_user_meta($post_author, 'profile-picture-ID', true) ? get_user_meta($post_author, 'profile-picture-ID', true) : get_user_meta($post_author, 'company-logo-ID', true);
                                            $max_length = get_post_meta($transport_offer_wci_id, 'package-length-max', true);
                                            $max_width = get_post_meta($transport_offer_wci_id, 'package-width-max', true);
                                            $max_height = get_post_meta($transport_offer_wci_id, 'package-height-max', true);
                                            $max_weight = get_post_meta($transport_offer_wci_id, 'package-weight-max', true);
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
                                                                    <a id="<?php echo $transport_offer_wci_id ?>" href="<?php echo esc_url(add_query_arg(array('carrier_id' => $post_author), the_permalink(get_page_by_path(__('reviews-and-evaluations', 'gpdealdomain'))))); ?>" class="show_reviews_evaluations">
                                                                        <?php echo $stat_value["vote_count"]; ?> <?php _e("reviews", "gpdealdomain"); ?>
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
                                                        <span class="span_label"><?php _e("Departure", "gpdealdomain"); ?> : </span>
                                                        <span class="span_value">
                                                            <?php echo get_post_meta($transport_offer_wci_id, 'departure-city-transport-offer', true) ?> (<?php echo get_post_meta($transport_offer_wci_id, 'departure-country-transport-offer', true) ?>), <?php echo date('d-m-Y', strtotime(get_post_meta($transport_offer_wci_id, 'date-of-departure-transport-offer', true))); ?>
                                                        </span>
                                                    </div>
                                                    <div class="inline field"> 
                                                        <span class="span_label"><?php _e("Destination", "gpdealdomain"); ?> : </span>
                                                        <span class="span_value">
                                                            <?php echo get_post_meta($transport_offer_wci_id, 'destination-city-transport-offer', true) ?> (<?php echo get_post_meta($transport_offer_wci_id, 'destination-country-transport-offer', true) ?>), <?php echo date('d-m-Y', strtotime(get_post_meta($transport_offer_wci_id, 'arrival-date-transport-offer', true))); ?>
                                                        </span>
                                                    </div>

                                                    <div class="inline field">
                                                        <span class="span_label"><?php _e("Deadline", "gpdealdomain"); ?><i class="help circle green link icon tooltip">
                                                                <span class="tooltiptext"><?php echo __("Date limite de validité de l'offre", "gpdealdomain") ?></span>
                                                            </i> : </span> 
                                                        <span class="span_value">
                                                            <?php echo date('d-m-Y', strtotime(get_post_meta($transport_offer_wci_id, 'deadline-of-proposition-transport-offer', true))); ?>
                                                        </span>
                                                    </div>


                                                    <div class="inline field">
                                                        <span class="span_label"><?php _e("Object", "gpdealdomain"); ?>(s)<i class="help circle green link icon tooltip">
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
                                                    <?php if ($max_length || $max_width || $max_height || $max_weight) : ?>
                                                        <div class="inline field">
                                                            <span class="span_label"><?php _e("Max dimensions", "gpdealdomain"); ?>(cm) : </span> 
                                                            <span class="span_value">
                                                                <?php if ($max_length) : ?>L= <?php echo $max_length; ?>,<?php endif ?>  <?php if ($max_width) : ?>l= <?php echo $max_width; ?>,<?php endif ?>  <?php if ($max_height) : ?>h= <?php echo $max_height; ?><?php endif ?>
                                                            </span>
                                                        </div>
                                                        <?php if ($max_weight) : ?>
                                                            <div class="inline field">
                                                                <span class="span_label"><?php _e("Max weight", "gpdealdomain"); ?>(kg) : </span> 
                                                                <span class="span_value">
                                                                    <?php echo $max_weight; ?>
                                                                </span>
                                                            </div>
                                                        <?php endif ?>
                                                    <?php endif ?>
                                                    <div class="inline field">
                                                        <span class="span_label"><?php _e("Mode of transport", "gpdealdomain"); ?> : </span> 
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
                                            <!--                                            <div class="extra content">
                                            <?php if (is_user_logged_in()) : ?>
                                                                                                                        <input id='selected_transport_offer_checkbox<?php echo $transport_offer_wci_id; ?>' type="checkbox" name="selected_transport_offers[]" value="<?php echo $transport_offer_wci_id; ?>" style="display: none">
                                                                                                                        <a id='selected_transport_offer<?php echo $transport_offer_wci_id; ?>' class="ui fluid green button" style="display: none" onclick="unselect_transport_offer(<?php echo $transport_offer_wci_id; ?>)"><i class="checkmark icon"></i></a>
                                                                                                                        <a id='unselected_transport_offer<?php echo $transport_offer_wci_id; ?>' class="ui fluid grey button" onclick="select_transport_offer(<?php echo $transport_offer_wci_id; ?>)"><?php echo __("Selectionner", "gpdealdomain") ?></a>
                                            <?php else: ?>
                                                                                                                        <a class="ui fluid grey button" onclick="signin();"><?php echo __("Selectionner", "gpdealdomain") ?></a>
                                            <?php endif ?>
                                                                                        </div>-->
                                        </div>
                                    </div>
                                    <?php
                                endwhile;
                                ?>
                            </div>
                        </div>
                    </div>
                <?php } wp_reset_postdata(); ?>
                <?php if ($transport_offers_which_can_interest->have_posts() || $transport_offers->have_posts()): ?>
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