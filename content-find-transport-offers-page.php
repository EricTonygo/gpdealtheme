<?php
global $current_user;
get_template_part('top-menu', get_post_format());
$today = new \DateTime('today');
$start_date_DT = new \DateTime($start_date);
$destination_date_DT = new \DateTime($destination_date);
?>
<div class="ui tiny borderless second-nav menu">
    <div class="ui container center aligned">
        <div class="center menu">
            <div class="item">
                <a href="<?php echo wp_make_link_relative(home_url('/')) ?>" class="section"><?php echo get_page_by_path(__('home', 'gpdealdomain'))->post_title ?></a>                
                <i class="small right arrow icon divider"></i>
                <div class="active section"><?php the_title(); ?></div>
            </div>
        </div>
    </div>
</div>
<div class="ui vertical masthead  segment container">
    <!--div class="ui text container">
    </div-->
    <div id="content_search_carrier_form" class="ui fluid card">
        <div class="content center aligned">
            <div class="header"  style="font-size: 10.5pt;">
                <span id="show_search_form"><a><?php _e('Show search details', 'gpdealdomain'); ?></a> <i class="chevron down icon"></i></span><span id="hide_search_form" style="display:none;"><a><?php _e('Hide search details', 'gpdealdomain'); ?></a> <i class="chevron up icon"></i></span>
            </div>
        </div>
        <div id='search_transport_offers_content' class="content" style="display: none;">
            <form id='search_transport_offers_form'  method="GET" action="<?php echo wp_make_link_relative(get_permalink(get_page_by_path(__('search-for-transport-offers', 'gpdealdomain')))); ?>" class="ui form" autocomplete="off">
                <div class="two wide fields">
                    <div class="field">
                        <div class="ui input icon start_city_transport">
                            <i class="remove link icon start_city_transport" style="display: none;" locality_id='start_city_transport'></i>
                            <input id="start_city_transport" class="locality" type="text" name='start-city' placeholder="<?php _e('Departure city', 'gpdealdomain'); ?>" value="<?php echo $start_city ?>">
                        </div>
                    </div>             
                    <div class="field">
                        <div class="ui calendar" >
                            <div class="ui input left icon">
                                <i class="calendar icon"></i>
                                <input type="text" name='start-date' placeholder="<?php _e('Departure date', 'gpdealdomain'); ?>" value="<?php echo $start_date ?>">
                            </div>
                        </div>
                    </div>      
                </div>

                <div class="two wide fields">
                    <div class="field">
                        <div class="ui input icon destination_city_transport">
                            <i class="remove link icon destination_city_transport" style="display: none;" locality_id='destination_city_transport'></i>
                            <input id="destination_city_transport" class="locality" type="text" name='destination-city' placeholder="<?php _e('Destination city', 'gpdealdomain') ?>" value="<?php echo $destination_city ?>">
                        </div>
                    </div>             
                    <div class="field">
                        <div class="ui calendar" >
                            <div class="ui input left icon">
                                <i class="calendar icon"></i>
                                <input type="text" name='destination-date' placeholder="<?php _e("Destination date", 'gpdealdomain') ?>" value="<?php echo $destination_date ?>">
                            </div>
                        </div>
                    </div>     
                </div>
                <div class="fields" style="margin-bottom: 0;">
                    <div id="package_type_fields_find_offers" style="margin-left: 0.6em" class="inline fields">
                        <span class="span_label" style="margin-right: 1.3em;"><?php echo __("Object", 'gpdealdomain') ?>(s)<i class="help circle green link icon tooltip">
                                <span class="tooltiptext"><?php echo __("Several possible choices", "gpdealdomain") ?></span>
                            </i>
                        </span>
                        <?php
                        $typePackages = get_terms(array('taxonomy' => 'type_package', 'hide_empty' => false, 'orderby' => 'ID', 'order' => 'ASC'));
                        foreach ($typePackages as $typePackage):
                            ?>
                            <div class="field">
                                <div class="ui checkbox">
                                    <input type="checkbox" name="package-type[]" value="<?php echo $typePackage->term_id; ?>" <?php if (in_array($typePackage->term_id, $package_type, true)): ?> checked="checked" <?php endif ?>>
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
                <div class="field" style="margin-bottom: 0;">
                    <div id="server_error_message" class="ui negative message" style="display:none">
                        <i class="close icon"></i>
                        <div id="server_error_content" class="header">Internal server error</div>
                    </div>
                    <div id="error_name_message" class="ui error message" style="display: none">
                        <i class="close icon"></i>
                        <div id="error_name_header" class="header"></div>
                        <ul id="error_name_list" class="list">

                        </ul>
                    </div>
                </div>

                <div class="field">
                    <button id="submit_search_transport_offers" class="ui right floated green button" type="submit"><?php echo __("Search carriers", "gpdealdomain") ?></button>
                </div>
            </form>
        </div>
    </div>
    <div class="ui stackable grid">
        <div class="wide column">
            <!--<form id="selected_transport_offers_form" class="" method="POST" action="<?php echo wp_make_link_relative(get_permalink(get_page_by_path(__('mon-compte', 'gpdealdomain') . '/' . __('expeditions', 'gpdealdomain') . '/' . __('saisir', 'gpdealdomain')))); ?>">-->

            <div  class="ui content_packages_transports fluid card">
                <?php //var_dump(gpdealDistanceBetweenTwoCities($start_city, $destination_city)); ?>
                <div class="content center aligned">
                    <div class="header"><?php _e("Corresponding transport offers for", "gpdealdomain"); ?> <span class="locality_name"><?php echo $search_data['start_city']; ?>(<?php echo $search_data['start_date']; ?>)</span> <?php _e("to", "gpdealdomain"); ?> <span class="locality_name"><?php echo $search_data['destination_city']; ?>(<?php echo $search_data['destination_date']; ?>)</span></div>
                </div>
                <?php if ($today > $start_date_DT || $today > $destination_date_DT): ?>
                    <div class="content content_packages_transports content_without_white">
                        <div class="ui warning message">
                            <div class="content">
                                <div class="header" style="font-weight: normal;">
                                    <?php echo __("The dates of your shipment are exceeded", "gpdealdomain") ?>.                                        
                                </div>
                            </div>
                        </div>
                    </div>
                <?php else: ?>
                    <div class="content content_packages_transports content_without_white">
                        <?php
                        $transport_offers_corresponding = new WP_Query(getWPQueryArgsForCarrierSearch($search_data_corresponding));
                        //$exclude_ids = array();
                        $total_corresponding_post_pages = $transport_offers_corresponding->max_num_pages;
                        if ($transport_offers_corresponding->have_posts()) {
                            ?>
                            <div id='list_as_grid_content' class="ui three column doubling stackable grid">
                                <?php
                                while ($transport_offers_corresponding->have_posts()): $transport_offers_corresponding->the_post();
                                    $transport_offer_id = get_the_ID();
                                    $exclude_ids[] = $transport_offer_id;
                                    ?>
                                    <div class="column">
                                        <div class="ui fluid card transport_offer_card">
                                            <?php
                                            $post_author = get_post_field('post_author', $transport_offer_id);
                                            $carrier_name = $current_user->ID == $post_author ? __("You", "gpdealdomain") : get_the_author_meta('user_login');
                                            $profile_picture_id = get_user_meta($post_author, 'profile-picture-ID', true) ? get_user_meta($post_author, 'profile-picture-ID', true) : get_user_meta($post_author, 'company-logo-ID', true);
                                            $max_length = get_post_meta($transport_offer_id, 'package-length-max', true);
                                            $max_width = get_post_meta($transport_offer_id, 'package-width-max', true);
                                            $max_height = get_post_meta($transport_offer_id, 'package-height-max', true);
                                            $max_weight = get_post_meta($transport_offer_id, 'package-weight-max', true);
                                            ?>
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
                                                                        <a id="<?php echo $transport_offer_id ?>" href="<?php echo esc_url(add_query_arg(array('carrier_id' => $post_author), wp_make_link_relative(get_permalink(get_page_by_path(__('reviews-and-evaluations', 'gpdealdomain')))))); ?>" class="show_reviews_evaluations">
                                                                            <?php echo $stat_value["vote_count"]; ?> <?php _e("reviews", "gpdealdomain"); ?>
                                                                        </a>
                                                                    </div>
                                                                </div>
                                                            <?php endforeach; ?>
                                                        <?php else: ?>
                                                            <span id="<?php echo $transport_offer_id; ?>"  ><i class="star icon"></i> <?php echo __("No reviews", "gpdealdomain"); ?></span>
                                                        <?php endif ?>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="content">
                                                <div class="ui form description">
                                                    <div class="field">
                                                        <div class="ui grid">
                                                            <div class="seven wide column">
                                                                <i class="large blue marker icon"></i>
                                                                <div class="inline field">
                                                                    <span class="span_value">
                                                                        <?php echo get_post_meta($transport_offer_id, 'departure-city-transport-offer', true) ?> 
                                                                    </span><br>
                                                                    <span class="span_value">
                                                                        (<?php echo get_post_meta($transport_offer_id, 'departure-country-transport-offer', true) ?>)
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
                                                                        <?php echo get_post_meta($transport_offer_id, 'destination-city-transport-offer', true) ?>
                                                                    </span><br>
                                                                    <span class="span_value">
                                                                        (<?php echo get_post_meta($transport_offer_id, 'destination-country-transport-offer', true) ?>)
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
                                                                        <?php echo date('d-m-Y', strtotime(get_post_meta($transport_offer_id, 'date-of-departure-transport-offer', true))); ?>
                                                                    </span>
                                                                </div>
                                                            </div>
                                                            <div class="two wide column">
                                                                <i class="large blue long arrow right icon"></i>
                                                                <div class="inline field"> 
                                                                    <span class="span_value">
                                                                        <?php echo gpdeal_date_diff(date('d-m-Y', strtotime(get_post_meta($transport_offer_id, 'date-of-departure-transport-offer', true))), date('d-m-Y', strtotime(get_post_meta($transport_offer_id, 'arrival-date-transport-offer', true)))) ?>j
                                                                    </span>
                                                                </div>
                                                            </div>
                                                            <div class="seven wide column">
                                                                <i class="large blue calendar icon"></i>
                                                                <div class="inline field"> 
                                                                    <span class="span_value">
                                                                        <?php echo date('d-m-Y', strtotime(get_post_meta($transport_offer_id, 'arrival-date-transport-offer', true))); ?>
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
                                                        <?php echo get_post_meta($transport_offer_id, 'price', true) . " " . get_post_meta($transport_offer_id, 'currency', true); ?><?php if (get_post_meta($transport_offer_id, 'price-type', true) == 1): ?>/kg<?php endif ?>
                                                    </span>
                                                </div>
                                            </div>
                                            <div class="extra content">
                                                <div class="extra content">
                                                    <a  class="ui green button" href="<?php echo wp_make_link_relative(get_permalink($transport_offer_id)); ?>"><?php echo __("Details", "gpdealdomain") ?></a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <?php
                                endwhile;
                                ?>
                            </div>
                            <?php
                            if ($total_corresponding_post_pages > 1):
                                $start = 1;
                                $end = $total_corresponding_post_pages;
                                if ($total_corresponding_post_pages > 5 && $num_page_corresponding > 3) {
                                    $end = $num_page_corresponding + 2 < $total_corresponding_post_pages ? $num_page_corresponding + 2 : $total_corresponding_post_pages;
                                    $start = $end - 4 > 1 ? $end - 4 : 1;
                                } elseif ($total_corresponding_post_pages > 5) {
                                    $end = 5;
                                }
                                ?>
                                <div class="fluid card" style="margin-top: 1.5em; text-align: center;">
                                    <div class="content">
                                        <div class="ui small icon buttons">
                                            <?php if ($num_page_corresponding > 1): ?>
                                                <?php
                                                $params_arg_corresponding["num-page"] = $num_page_corresponding - 1;
                                                ?>
                                                <a class="ui button" href="<?php echo esc_url(add_query_arg($params_arg_corresponding, wp_make_link_relative($page_link))); ?>"><i class="chevron left icon"></i></a>
                                            <?php endif ?>
                                            <?php for ($i = $start; $i <= $end; $i++): ?>
                                                <?php
                                                $params_arg_corresponding["num-page"] = $i;
                                                ?>
                                                <a class="ui <?php if ($num_page_corresponding == $i): ?>green<?php else: ?>basic<?php endif ?> button" href="<?php echo esc_url(add_query_arg($params_arg_corresponding, wp_make_link_relative($page_link))); ?>"><?php echo $i; ?></a>
                                            <?php endfor; ?>
                                            <?php if ($num_page_corresponding < $total_corresponding_post_pages): ?>
                                                <?php
                                                $params_arg_corresponding["num-page"] = $num_page_corresponding + 1;
                                                ?>
                                                <a class="ui button" href="<?php echo esc_url(add_query_arg($params_arg_corresponding, wp_make_link_relative($page_link))); ?>"><i class="chevron right icon"></i></a>
                                            <?php endif ?>
                                        </div>
                                    </div>
                                </div>
                            <?php endif ?>
                        <?php } else { ?>
                            <div class="">
                                <div class="ui warning message">
                                    <div class="content">
                                        <div class="header" style="font-weight: normal;">
                                            <?php _e("No valid offer match your criteria", "gpdealdomain"); ?>.
                                            <?php echo __("If you wish to be notified when a corresponding offer is published", "gpdealdomain") ?>, <a href="<?php echo wp_make_link_relative(get_permalink(get_page_by_path(__('my-account', 'gpdealdomain') . '/' . __('shipments', 'gpdealdomain') . '/' . __('write', 'gpdealdomain')))); ?>"><?php _e("Publish a shipment here", "gpdealdomain"); ?></a>.
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <?php
                        }
                        wp_reset_postdata();
                        ?>
                    </div>
                <?php endif ?>
            </div>
            <?php if ($today <= $start_date_DT && $today <= $destination_date_DT): ?>
                <?php
                $search_data_corresponding["posts_per_page"] = -1;
                $transport_offers_corresponding = new WP_Query(getWPQueryArgsForCarrierSearch($search_data_corresponding));
                $exclude_ids = wp_list_pluck($transport_offers_corresponding->posts, "ID");
                $transport_offers_which_can_interest = new WP_Query(getWPQueryArgsCarrierSearchForWhichCanInterest($search_data_can_interest, $exclude_ids));
                $total_can_interest_post_pages = $transport_offers_which_can_interest->max_num_pages;
                if ($transport_offers_which_can_interest->have_posts()) {
                    ?>
                    <div  class="ui content_packages_transports fluid card">
                        <div class="content center aligned">
                            <div class="header"><?php _e("Transport offers that can interest you for", "gpdealdomain"); ?> <?php _e("from", "gpdealdomain"); ?> <span class="locality_name"><?php echo $search_data['start_city']; ?>(<?php echo $search_data['start_date']; ?>)</span> <?php _e("to", "gpdealdomain"); ?> <span class="locality_name"><?php echo $search_data['destination_city']; ?>(<?php echo $search_data['destination_date']; ?>)</span></div>
                        </div>
                        <div class="content content_packages_transports content_without_white">
                            <div id='list_as_grid_content' class="ui three column doubling stackable grid">
                                <?php
                                while ($transport_offers_which_can_interest->have_posts()): $transport_offers_which_can_interest->the_post();
                                    $transport_offer_wci_id = get_the_ID();
                                    ?>
                                    <div class="column">
                                        <div class="ui fluid card transport_offer_card">
                                            <?php
                                            $post_author = get_post_field('post_author', $transport_offer_wci_id);
                                            $carrier_name = $current_user->ID == $post_author ? __("You", "gpdealdomain") : get_the_author_meta('user_login');
                                            $profile_picture_id = get_user_meta($post_author, 'profile-picture-ID', true) ? get_user_meta($post_author, 'profile-picture-ID', true) : get_user_meta($post_author, 'company-logo-ID', true);
                                            $max_length = get_post_meta($transport_offer_wci_id, 'package-length-max', true);
                                            $max_width = get_post_meta($transport_offer_wci_id, 'package-width-max', true);
                                            $max_height = get_post_meta($transport_offer_wci_id, 'package-height-max', true);
                                            $max_weight = get_post_meta($transport_offer_wci_id, 'package-weight-max', true);
                                            ?>
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
                                                                <i class="large blue marker icon"></i>
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
                                                                <i class="large blue long arrow right icon"></i>
                                                            </div>
                                                            <div class="seven wide column">
                                                                <i class="large blue flag checkered icon"></i>
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
                                                                <i class="large blue calendar icon"></i>
                                                                <div class="inline field">
                                                                    <span class="span_value">
                                                                        <?php echo date('d-m-Y', strtotime(get_post_meta($transport_offer_wci_id, 'date-of-departure-transport-offer', true))); ?>
                                                                    </span>
                                                                </div>
                                                            </div>
                                                            <div class="two wide column">
                                                                <i class="large blue long arrow right icon"></i>
                                                                <div class="inline field"> 
                                                                    <span class="span_value">
                                                                        <?php echo gpdeal_date_diff(date('d-m-Y', strtotime(get_post_meta($transport_offer_wci_id, 'date-of-departure-transport-offer', true))), date('d-m-Y', strtotime(get_post_meta($transport_offer_wci_id, 'arrival-date-transport-offer', true)))) ?>j
                                                                    </span>
                                                                </div>
                                                            </div>
                                                            <div class="seven wide column">
                                                                <i class="large blue calendar icon"></i>
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
                                                                        <?php echo date('d-m-Y', strtotime(get_post_meta($transport_offer_wci_id, 'deadline-of-proposition-transport-offer', true))); ?>
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
                                                                        $package_type_list = wp_get_post_terms($transport_offer_wci_id, 'type_package', array("fields" => "names"));
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
                                                                        $transport_method_list = wp_get_post_terms($transport_offer_wci_id, 'transport-method', array("fields" => "names"));
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
                                                        <?php echo get_post_meta($transport_offer_wci_id, 'price', true) . " " . get_post_meta($transport_offer_wci_id, 'currency', true); ?><?php if (get_post_meta($transport_offer_wci_id, 'price-type', true) == 1): ?>/kg<?php endif ?>
                                                    </span>
                                                </div>
                                            </div>
                                            <div class="extra content">
                                                <div class="extra content">
                                                    <a  class="ui green button" href="<?php echo wp_make_link_relative(get_permalink($transport_offer_wci_id)); ?>"><?php echo __("Details", "gpdealdomain") ?></a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <?php
                                endwhile;
                                ?>
                            </div>
                            <?php
                            if ($total_can_interest_post_pages > 1):
                                $start = 1;
                                $end = $total_can_interest_post_pages;
                                if ($total_destination_post_pages > 5 && $num_page_can_interest > 3) {
                                    $end = $num_page_can_interest + 2 < $total_can_interest_post_pages ? $num_page_can_interest + 2 : $total_can_interest_post_pages;
                                    $start = $end - 4 > 1 ? $end - 4 : 1;
                                } elseif ($total_can_interest_post_pages > 5) {
                                    $end = 5;
                                }
                                ?>
                                <div style="margin-top: 1.5em; text-align: center;">
                                    <div class="ui small icon buttons">
                                        <?php if ($num_page_can_interest > 1): ?>
                                            <?php
                                            $params_arg_can_interest["num-page"] = $num_page_can_interest - 1;
                                            ?>
                                            <a class="ui button" href="<?php echo esc_url(add_query_arg($params_arg_can_interest, wp_make_link_relative($page_link))); ?>"><i class="chevron left icon"></i></a>
                                        <?php endif ?>
                                        <?php for ($i = $start; $i <= $end; $i++): ?>
                                            <?php
                                            $params_arg_can_interest["num-page"] = $i;
                                            ?>
                                            <a class="ui <?php if ($num_page_can_interest == $i): ?>green<?php else: ?>basic<?php endif ?> button" href="<?php echo esc_url(add_query_arg($params_arg_can_interest, wp_make_link_relative($page_link))); ?>"><?php echo $i; ?></a>
                                        <?php endfor; ?>
                                        <?php if ($num_page_can_interest < $total_can_interest_post_pages): ?>
                                            <?php
                                            $params_arg_can_interest["num-page"] = $num_page_can_interest + 1;
                                            ?>
                                            <a class="ui button" href="<?php echo esc_url(add_query_arg($params_arg_can_interest, wp_make_link_relative($page_link))); ?>"><i class="chevron right icon"></i></a>
                                        <?php endif ?>
                                    </div>
                                </div>
                            <?php endif ?>
                        </div>
                    </div>
                <?php } wp_reset_postdata(); ?>
                <?php if ($transport_offers_which_can_interest->have_posts() || $transport_offers_corresponding->have_posts()): ?>
                    <input type="hidden" name='package_id' value="<?php echo $package_id; ?>">
                    <input type="hidden" name='confirm_transaction' value='true' >
                    <div align="center" >
                        <!--<button id='submit_selected_transport_offers' type='submit' name='submit_selected_transport_offers' class="ui green button" ><?php echo __("Validate selection", "gpdealdomain") ?></button>-->
                        <button id='submit_selected_transport_offers' type='submit' name='submit_selected_transport_offers' class="ui green button" value='yes' style="display: none"><?php echo __("Validate selection", "gpdealdomain") ?></button>
                    </div>
                <?php endif ?>
            <?php endif ?> 
            <!--</form>-->
        </div>
    </div>
</div>
<?php include(locate_template('content-login-modal-page.php')); ?>
<div id='main_content_reviews_evaluations'>
</div>