<?php
global $current_user;
get_template_part('top-menu', get_post_format());
?>
<div class="ui tiny borderless second-nav menu">
    <div class="ui container center aligned">
        <div class="center menu">
            <div class="item">
                <a href="<?php echo wp_make_link_relative(home_url('/')); ?>" class="section"><?php echo get_page_by_path(__('home', 'gpdealdomain'))->post_title ?></a>
                <i class="small right arrow icon divider"></i>
                <div class="active section"><?php echo get_page_by_path(__('my-account', 'gpdealdomain'))->post_title ?></div>
<!--                <i class="right chevron icon divider"></i>
                <a href="<?php echo wp_make_link_relative(get_permalink(get_page_by_path(__('my-account', 'gpdealdomain')))) ?>" class="section"><?php echo get_page_by_path(__('my-account', 'gpdealdomain'))->post_title ?></a>
                <i class="right arrow icon divider"></i>
                <div class="active section"><?php _e('Transport offers', 'gpdealdomain'); ?></div>-->
            </div>
        </div>
    </div>
</div>
<div class="ui vertical masthead segment container">
    <div class="ui stackable grid">
        <div id="left_content_account" class="four wide column">
            <?php get_template_part('content-vertical-menu-account-page', get_post_format()); ?>
        </div>
        <div id="right_content_account" class="twelve wide stretched column">
            <div class="ui stackable grid">
                <div class="sixteen wide column">
                    <div class="ui content_packages_transports main_right_content fluid card">
                        <div class="content">
                            <span class="header left floated" style="text-transform: uppercase; font-weight: normal; margin-top: 0.5em;"><?php _e('My transport offers', 'gpdealdomain'); ?></span>
                            <?php if (get_user_meta(get_current_user_id(), "registration-completed", true) == 2): ?>
                                <a href="<?php echo wp_make_link_relative(get_permalink(get_page_by_path(__('my-account', 'gpdealdomain') . '/' . __('transport-offers', 'gpdealdomain') . '/' . __('write', 'gpdealdomain')))); ?>" class="ui green right floated button" ><?php echo __('New Transport Offer', 'gpdealdomain') ?></a>
                            <?php endif ?>
                        </div>
                        <div class="content content_packages_transports">
                            <?php if (get_user_meta(get_current_user_id(), "registration-completed", true) != 2): ?>
                                <div class="ui warning message">
                                    <div class="header">
                                        <?php _e("Incomplete registration", "gpdealdomain"); ?>
                                    </div>
                                    <p>
                                        <?php _e("You must complete your registration to be able to add a transport offer", "gpdealdomain"); ?>
                                    </p>
                                </div>
                            <?php endif ?>
                            <div class="ui styled fluid accordion">
                                <?php
                                global $current_user;
                                $transport_offers = new WP_Query(array('post_type' => 'transport-offer', 'post_per_page' => -1, "post_status" => 'publish', 'orderby' => 'post_date', 'order' => 'DESC', 'author' => $current_user->ID, 'meta_query' => array('relation' => 'OR', array('key' => 'transport-status', 'value' => 1, 'compare' => '='), array('key' => 'transport-status', 'value' => -1, 'compare' => '='))));
                                if ($transport_offers->have_posts()) {
                                    ?>
                                    <div class="title"><i class="dropdown icon"></i> <?php echo __('In progress', 'gpdealdomain') ?> </div>
                                    <div class="content">
                                        <div id='list_as_grid_content' class="ui two column doubling stackable grid">
                                            <?php
                                            while ($transport_offers->have_posts()): $transport_offers->the_post();
                                                $transport_offer_id = get_the_ID();
                                                $package_type_list = wp_get_post_terms($transport_offer_id, 'type_package', array("fields" => "all"));
                                                $transport_method_list = wp_get_post_terms($transport_offer_id, 'transport-method', array("fields" => "all"));
                                                ?>
                                                <div class="column">
                                                    <div class="ui fluid card transport_offer_card">
                                                        <?php
                                                        $post_author = get_post_field('post_author', $transport_offer_id);
                                                        //$carrier_name = $current_user->ID == $post_author ? __("Vous", "gpdealdomain") : get_the_author_meta('user_login');
                                                        //$profile_picture_id = get_user_meta($post_author, 'profile-picture-ID', true) ? get_user_meta($post_author, 'profile-picture-ID', true) : get_user_meta($post_author, 'company-logo-ID', true);
                                                        ?>
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
                                                                <div class="inline field">
                                                                   <span class="span_label"><?php echo __("Deadline", "gpdealdomain"); ?> : </span> 
                                                                    <span class="span_value">
                                                                        <?php echo date('d-m-Y', strtotime(get_post_meta($transport_offer_id, 'deadline-of-proposition-transport-offer', true))); ?>
                                                                    </span>
                                                                </div>
                                                                <span class="ui blue right ribbon label">
                                                                    <?php echo get_post_meta($transport_offer_id, 'price', true) . " " . get_post_meta($transport_offer_id, 'currency', true); ?><?php if (get_post_meta($transport_offer_id, 'price-type', true) == 1): ?>/kg<?php endif ?>
                                                                </span>
                                                            </div>
                                                        </div>
                                                        <div class="extra content">
                                                            <?php
                                                            $statistics = getTotalStatistiticsEvaluation($transport_offer_id);
                                                            wp_reset_postdata();
                                                            ?>
                                                            <div class="left floated meta">
                                                                <?php if ($statistics["Evaluation globale"]["vote_count"] > 0): ?>
                                                                    <?php
                                                                    foreach ($statistics as $stat_key => $stat_value):
                                                                        ?>
                                                                        <div class="ui form">
                                                                            <div class="field disable">
                                                                                <span class="ui mini star rating" data-rating="<?php echo $stat_value["weighted_average"]; ?>" data-max-rating="5"></span>
                                                                                <a href="<?php echo esc_url(add_query_arg(array('action' => 'evaluations'), wp_make_link_relative(get_permalink($transport_offer_id)))) ?>">
                                                                                    <?php echo $stat_value["vote_count"]; ?> <?php _e("reviews", "gpdealdomain"); ?>
                                                                                </a>
                                                                            </div>
                                                                        </div>
                                                                    <?php endforeach; ?>
                                                                <?php else: ?>
                                                                    <span id="<?php echo $transport_offer_id; ?>"  ><i class="star icon"></i> <?php echo __("No reviews", "gpdealdomain"); ?></span>
                                                                <?php endif ?>
                                                            </div>
                                                            <div class="right floated">
                                                                <div class="ui right pointing dropdown item">
                                                                    <i class="ellipsis vertical icon"></i>
                                                                    <div class="menu">
                                                                        <?php if ($statistics["Evaluation globale"]["vote_count"] == 0): ?>
                                                                            <a href="<?php echo esc_url(add_query_arg(array('action' => 'show'), wp_make_link_relative(get_permalink($transport_offer_id)))) ?>" class=" item">
                                                                                <i class="unhide icon"></i>
                                                                                <?php echo __("View/Edit", "gpdealdomain"); ?>
                                                                            </a>
                                                                        <?php else: ?>
                                                                            <a href="<?php echo esc_url(add_query_arg(array('action' => 'show'), wp_make_link_relative(get_permalink($transport_offer_id)))) ?>" class=" item">
                                                                                <i class="unhide icon"></i>
                                                                                <?php echo __("View", "gpdealdomain"); ?>
                                                                            </a>
                                                                        <?php endif ?>
                                                                        <a href="<?php echo esc_url(add_query_arg(array('action' => 'evaluations'), wp_make_link_relative(get_permalink($transport_offer_id)))) ?>" class="item">
                                                                            <i class="star icon"></i>
                                                                            <?php echo __("Reviews/Evaluations", "gpdealdomain"); ?>
                                                                        </a>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <?php
                                            endwhile;
                                            ?>
                                        </div>
                                    </div>
                                    <?php
                                }
                                wp_reset_postdata();
                                ?>

                                <?php
                                global $current_user;
                                $transport_offers = new WP_Query(array('post_type' => 'transport-offer', 'post_per_page' => -1, "post_status" => 'publish', 'orderby' => 'post_date', 'order' => 'DESC', 'author' => $current_user->ID, 'meta_query' => array('relation' => 'OR', array('key' => 'transport-status', 'value' => 2, 'compare' => '='), array('key' => 'transport-status', 'value' => 4, 'compare' => '='))));
                                if ($transport_offers->have_posts()) {
                                    ?>
                                    <div class="title"><i class="dropdown icon"></i> <?php echo __('Expired', 'gpdealdomain') ?> </div>
                                    <div class="content">
                                        <div id='list_as_grid_content' class="ui two column doubling stackable grid">
                                            <?php
                                            while ($transport_offers->have_posts()): $transport_offers->the_post();
                                                $transport_offer_id = get_the_ID();
                                                $package_type_list = wp_get_post_terms($transport_offer_id, 'type_package', array("fields" => "all"));
                                                $transport_method_list = wp_get_post_terms($transport_offer_id, 'transport-method', array("fields" => "all"));
                                                ?>
                                                <div class="column">
                                                    <div class="ui fluid card transport_offer_card">
                                                        <?php
                                                        $post_author = get_post_field('post_author', $transport_offer_id);
                                                        //$carrier_name = $current_user->ID == $post_author ? __("Vous", "gpdealdomain") : get_the_author_meta('user_login');
                                                        //$profile_picture_id = get_user_meta($post_author, 'profile-picture-ID', true) ? get_user_meta($post_author, 'profile-picture-ID', true) : get_user_meta($post_author, 'company-logo-ID', true);
                                                        ?>
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

                                                                <div class="inline field">
                                                                   <span class="span_label"><?php echo __("Deadline", "gpdealdomain"); ?><!-- <i class="help circle green link icon deadline_transport_offer_help_link"></i>--> : </span> 
                                                                    <span class="span_value">
                                                                        <?php echo date('d-m-Y', strtotime(get_post_meta($transport_offer_id, 'deadline-of-proposition-transport-offer', true))); ?>
                                                                    </span>
                                                                </div>
                                                                <span class="ui blue right ribbon label">
                                                                    <?php echo get_post_meta($transport_offer_id, 'price', true) . " " . get_post_meta($transport_offer_id, 'currency', true); ?><?php if (get_post_meta($transport_offer_id, 'price-type', true) == 1): ?>/kg<?php endif ?>
                                                                </span>
                                                            </div>
                                                        </div>
                                                        <div class="extra content">
                                                            <?php
                                                            $statistics = getTotalStatistiticsEvaluation($transport_offer_id);
                                                            wp_reset_postdata();
                                                            ?>
                                                            <div class="left floated meta">
                                                                <?php if ($statistics["Evaluation globale"]["vote_count"] > 0): ?>
                                                                    <?php
                                                                    foreach ($statistics as $stat_key => $stat_value):
                                                                        ?>
                                                                        <div class="ui form">
                                                                            <div class="field disable">
                                                                                <span class="ui mini star rating" data-rating="<?php echo $stat_value["weighted_average"]; ?>" data-max-rating="5"></span>
                                                                                <a href="<?php echo esc_url(add_query_arg(array('action' => 'evaluations'), wp_make_link_relative(get_permalink($transport_offer_id)))) ?>">
                                                                                    <?php echo $stat_value["vote_count"]; ?> <?php _e("reviews", "gpdealdomain"); ?>
                                                                                </a>
                                                                            </div>
                                                                        </div>
                                                                    <?php endforeach; ?>
                                                                <?php else: ?>
                                                                    <span id="<?php echo $transport_offer_id; ?>"  ><i class="star icon"></i> <?php echo __("No reviews", "gpdealdomain"); ?></span>
                                                                <?php endif ?>
                                                            </div>
                                                            <div class="right floated">
                                                                <div class="ui right pointing dropdown item">
                                                                    <i class="ellipsis vertical icon"></i>
                                                                    <div class="menu">
                                                                        <a href="<?php echo esc_url(add_query_arg(array('action' => 'show'), wp_make_link_relative(get_permalink($transport_offer_id)))) ?>" class=" item">
                                                                            <i class="unhide icon"></i>
                                                                            <?php echo __("View", "gpdealdomain"); ?>
                                                                        </a>
                                                                        <a href="<?php echo esc_url(add_query_arg(array('action' => 'evaluations'), wp_make_link_relative(get_permalink($transport_offer_id)))) ?>" class="item">
                                                                            <i class="star icon"></i>
                                                                            <?php echo __("Reviews/Evaluations", "gpdealdomain"); ?>
                                                                        </a>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <?php
                                            endwhile;
                                            ?>
                                        </div>
                                    </div>
                                    <?php
                                }
                                wp_reset_postdata();
                                ?>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

