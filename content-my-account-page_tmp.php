<?php get_template_part('top-menu', get_post_format()); ?>
<div class="ui tiny borderless second-nav menu">
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

        <div class="twelve wide column">
            <div  class="ui fluid card content_transactions_card">
                <div class="content center aligned">
                    <div class="header"><?php _e("My shipments", "gpdealdomain"); ?></div>
                </div>
                <div class="content">
                    <div class="ui styled fluid accordion">
                        <?php
                        global $current_user;
                        $packages = new WP_Query(array('post_type' => 'package', 'post_per_page' => -1, "post_status" => 'publish', 'orderby' => 'post_date', 'order' => 'DESC', 'author' => $current_user->ID, 'meta_query' => array('relation' => 'OR', array('key' => 'package-status', 'value' => 1, 'compare' => '='), array('key' => 'package-status', 'value' => -1, 'compare' => '='))));
                        if ($packages->have_posts()) {
                            ?>
                            <div class="title"><i class="dropdown icon"></i> <?php _e("Search for carriers", "gpdealdomain"); ?> </div>
                            <div class="content">
                                <div id='list_as_grid_content' class="ui three column doubling stackable grid">
                                    <?php
                                    while ($packages->have_posts()): $packages->the_post();
                                        $package_type_list = wp_get_post_terms(get_the_ID(), 'type_package', array("fields" => "all"));
                                        ?>
                                        <div id="single_package_column<?php the_ID() ?>" class="column">
                                            <form id="single_package_content_form<?php the_ID() ?>" method="POST" action="<?php echo wp_make_link_relative(get_the_permalink()); ?>">
                                                <div class="ui fluid card">
                                                    <div class="content">
                                                        <div class="ui form description">
                                                            <div class="inline field">
                                                                <span class="span_label"><?php _e("Departure", "gpdealdomain"); ?> : </span> 

                                                                <span class="span_value">
                                                                    <?php echo get_post_meta(get_the_ID(), 'departure-city-package', true) ?> (<?php echo get_post_meta(get_the_ID(), 'departure-country-package', true) ?>)
                                                                </span>
                                                            </div>
                                                            <div class="inline field">
                                                                <span class="span_label"><?php _e("Destination", "gpdealdomain"); ?> : </span> 
                                                                <span class="span_value">
                                                                    <?php echo get_post_meta(get_the_ID(), 'destination-city-package', true) ?> (<?php echo get_post_meta(get_the_ID(), 'destination-country-package', true) ?>)
                                                                </span>
                                                            </div>
                                                            <div class="inline field">
                                                                <span class="span_label"><?php _e("Departure date", "gpdealdomain"); ?> : </span> 
                                                                <span class="span_value">
                                                                    <?php echo date('d-m-Y', strtotime(get_post_meta(get_the_ID(), 'date-of-departure-package', true)));
                                                                    ?>
                                                                </span>
                                                            </div>
                                                            <div class="inline field">
                                                                <span class="span_label"><?php _e("Destination date", "gpdealdomain"); ?> : </span> 
                                                                <span class="span_value">
                                                                    <?php echo date('d-m-Y', strtotime(get_post_meta(get_the_ID(), 'arrival-date-package', true)));
                                                                    ?>
                                                                </span>
                                                            </div>

                                                        </div>
                                                    </div>
                                                    <div class="extra content">
                                                        <div class="right floated">
                                                            <div class="ui dropdown top left pointing item">
                                                                <i class="ellipsis vertical icon"></i>
                                                                <div class="menu">
                                                                    <a href="<?php echo esc_url(add_query_arg(array('action' => 'show'), the_permalink())) ?>" class=" item">
                                                                        <i class="unhide icon"></i>
                                                                        <?php _e("View/Edit", "gpdealdomain"); ?>
                                                                    </a>
        <!--                                                                    <a href="<?php echo esc_url(add_query_arg(array('action' => 'cancel'), the_permalink())) ?>" class=" item">
                                                                        <i class="unhide icon"></i>
                                                                    <?php _e("Canceled", "gpdealdomain"); ?>
                                                                    </a>-->
                                                                    <a href="<?php echo esc_url(add_query_arg(array('package-id' => get_the_ID()), wp_make_link_relative(get_permalink(get_page_by_path(__('select-transport-offers', 'gpdealdomain')))))) ?>" class="item">
                                                                        <i class="search icon"></i>
                                                                        <?php _e("Search carriers", "gpdealdomain"); ?>
                                                                    </a>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </form>
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
                        $packages = new WP_Query(array('post_type' => 'package', 'post_per_page' => -1, "post_status" => 'publish', 'orderby' => 'post_date', 'order' => 'DESC', 'author' => $current_user->ID, 'meta_query' => array(array('key' => 'package-status', 'value' => 2, 'compare' => '='))));
                        if ($packages->have_posts()) {
                            ?>
                            <div class="title"><i class="dropdown icon"></i> <?php _e("In progress", "gpdealdomain"); ?> </div>
                            <div class="content">
                                <div id='list_as_grid_content' class="ui three column doubling stackable grid">
                                    <?php
                                    while ($packages->have_posts()): $packages->the_post();
                                        $package_type_list = wp_get_post_terms(get_the_ID(), 'type_package', array("fields" => "all"));
                                        ?>
                                        <div id="single_package_column<?php the_ID() ?>" class="column">
                                            <form id="single_package_content_form<?php the_ID() ?>" method="POST" action="<?php echo wp_make_link_relative(get_the_permalink()); ?>">
                                                <div class="ui fluid card">
                                                    <div class="content">
                                                        <div class="ui form description">
                                                            <div class="inline field">
                                                                <span class="span_label"><?php _e("Departure", "gpdealdomain"); ?> : </span> 

                                                                <span class="span_value">
                                                                    <?php echo get_post_meta(get_the_ID(), 'departure-city-package', true) ?> (<?php echo get_post_meta(get_the_ID(), 'departure-country-package', true) ?>)
                                                                </span>
                                                            </div>
                                                            <div class="inline field">
                                                                <span class="span_label"><?php _e("Destination", "gpdealdomain"); ?> : </span> 
                                                                <span class="span_value">
                                                                    <?php echo get_post_meta(get_the_ID(), 'destination-city-package', true) ?> (<?php echo get_post_meta(get_the_ID(), 'destination-country-package', true) ?>)
                                                                </span>
                                                            </div>
                                                            <div class="inline field">
                                                                <span class="span_label"><?php _e("Departure date", "gpdealdomain"); ?> : </span> 
                                                                <span class="span_value">
                                                                    <?php echo date('d-m-Y', strtotime(get_post_meta(get_the_ID(), 'date-of-departure-package', true)));
                                                                    ?>
                                                                </span>
                                                            </div>
                                                            <div class="inline field">
                                                                <span class="span_label"><?php _e("Destination date", "gpdealdomain"); ?> : </span> 
                                                                <span class="span_value">
                                                                    <?php echo date('d-m-Y', strtotime(get_post_meta(get_the_ID(), 'arrival-date-package', true)));
                                                                    ?>
                                                                </span>
                                                            </div>

                                                        </div>
                                                    </div>
                                                    <div class="extra content">
                                                        <div class="right floated">
                                                            <div class="ui dropdown top left pointing item">
                                                                <i class="ellipsis vertical icon"></i>
                                                                <div class="menu">
                                                                    <a href="<?php echo esc_url(add_query_arg(array('action' => 'show'), the_permalink())) ?>" class=" item">
                                                                        <i class="unhide icon"></i>
                                                                        <?php _e("View/Edit/Close", "gpdealdomain"); ?>
                                                                    </a>

                                                                    <a href="<?php echo esc_url(add_query_arg(array('package-id' => get_the_ID()), wp_make_link_relative(get_the_permalink(get_page_by_path(__('my-account', 'gpdealdomain') . '/' . __('show-carriers-contacts', 'gpdealdomain')))))); ?>" class="item">
                                                                        <i class="shipping icon"></i>
                                                                        <?php _e("Selected carriers", "gpdealdomain"); ?>
                                                                    </a>
                                                                    <a href="<?php echo esc_url(add_query_arg(array('package-id' => get_the_ID()), wp_make_link_relative(get_the_permalink(get_page_by_path(__('select-transport-offers', 'gpdealdomain')))))); ?>" class="item">
                                                                        <i class="search icon"></i>
                                                                        <?php _e("Search carriers", "gpdealdomain"); ?>
                                                                    </a>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </form>
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
                        $packages = new WP_Query(array('post_type' => 'package', 'post_per_page' => -1, "post_status" => 'publish', 'orderby' => 'post_date', 'order' => 'DESC', 'author' => $current_user->ID, 'meta_query' => array(array('key' => 'package-status', 'value' => 3, 'compare' => '='))));
                        if ($packages->have_posts()) {
                            ?>
                            <div class="title"><i class="dropdown icon"></i> <?php _e("Evaluated/Closed", "gpdealdomain") ?> </div>
                            <div class="content">                           
                                <div id='list_as_grid_content' class="ui three column doubling stackable grid">
                                    <?php
                                    while ($packages->have_posts()): $packages->the_post();
                                        $package_type_list = wp_get_post_terms(get_the_ID(), 'type_package', array("fields" => "all"));
                                        ?>
                                        <div id="single_package_column<?php the_ID() ?>" class="column">
                                            <form id="single_package_content_form<?php the_ID() ?>" method="POST" action="<?php echo wp_make_link_relative(get_the_permalink()); ?>">
                                                <div class="ui fluid card">
                                                    <div class="content">
                                                        <div class="ui form description">
                                                            <div class="inline field">
                                                                <span class="span_label"><?php _e("Departure", "gpdealdomain"); ?> : </span> 

                                                                <span class="span_value">
                                                                    <?php echo get_post_meta(get_the_ID(), 'departure-city-package', true) ?> (<?php echo get_post_meta(get_the_ID(), 'departure-country-package', true) ?>)
                                                                </span>
                                                            </div>
                                                            <div class="inline field">
                                                                <span class="span_label"><?php _e("Destination", "gpdealdomain"); ?> : </span> 
                                                                <span class="span_value">
                                                                    <?php echo get_post_meta(get_the_ID(), 'destination-city-package', true) ?> (<?php echo get_post_meta(get_the_ID(), 'destination-country-package', true) ?>)
                                                                </span>
                                                            </div>
                                                            <div class="inline field">
                                                                <span class="span_label"><?php _e("Departure date", "gpdealdomain"); ?> : </span> 
                                                                <span class="span_value">
                                                                    <?php echo date('d-m-Y', strtotime(get_post_meta(get_the_ID(), 'date-of-departure-package', true)));
                                                                    ?>
                                                                </span>
                                                            </div>
                                                            <div class="inline field">
                                                                <span class="span_label"><?php _e("Destination date", "gpdealdomain"); ?> : </span> 
                                                                <span class="span_value">
                                                                    <?php echo date('d-m-Y', strtotime(get_post_meta(get_the_ID(), 'arrival-date-package', true)));
                                                                    ?>
                                                                </span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="extra content">
                                                        <div class="right floated">
                                                            <div class="ui dropdown top left pointing item">
                                                                <i class="ellipsis vertical icon"></i>
                                                                <div class="menu">
                                                                    <a href="<?php echo esc_url(add_query_arg(array('action' => 'show'), the_permalink())) ?>" class=" item">
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
                        $packages = new WP_Query(array('post_type' => 'package', 'post_per_page' => -1, "post_status" => 'publish', 'orderby' => 'post_date', 'order' => 'DESC', 'author' => $current_user->ID, 'meta_query' => array(array('key' => 'package-status', 'value' => 4, 'compare' => '='))));
                        if ($packages->have_posts()) {
                            ?>
                            <div class="title"><i class="dropdown icon"></i> <?php _e("Expired", "gpdealdomain") ?> </div>
                            <div class="content">


                                <div id='list_as_grid_content' class="ui three column doubling stackable grid">
                                    <?php
                                    while ($packages->have_posts()): $packages->the_post();
                                        $package_type_list = wp_get_post_terms(get_the_ID(), 'type_package', array("fields" => "all"));
                                        ?>
                                        <div id="single_package_column<?php the_ID() ?>" class="column">
                                            <form id="single_package_content_form<?php the_ID() ?>" method="POST" action="<?php echo wp_make_link_relative(get_the_permalink()); ?>">
                                                <div class="ui fluid card">
                                                    <div class="content">
                                                        <div class="ui form description">
                                                            <div class="inline field">
                                                                <span class="span_label"><?php _e("Departure", "gpdealdomain"); ?> : </span> 

                                                                <span class="span_value">
                                                                    <?php echo get_post_meta(get_the_ID(), 'departure-city-package', true) ?> (<?php echo get_post_meta(get_the_ID(), 'departure-country-package', true) ?>)
                                                                </span>
                                                            </div>
                                                            <div class="inline field">
                                                                <span class="span_label"><?php _e("Destination", "gpdealdomain"); ?> : </span> 
                                                                <span class="span_value">
                                                                    <?php echo get_post_meta(get_the_ID(), 'destination-city-package', true) ?> (<?php echo get_post_meta(get_the_ID(), 'destination-country-package', true) ?>)
                                                                </span>
                                                            </div>
                                                            <div class="inline field">
                                                                <span class="span_label"><?php _e("Departure date", "gpdealdomain"); ?> : </span> 
                                                                <span class="span_value">
                                                                    <?php echo date('d-m-Y', strtotime(get_post_meta(get_the_ID(), 'date-of-departure-package', true)));
                                                                    ?>
                                                                </span>
                                                            </div>
                                                            <div class="inline field">
                                                                <span class="span_label"><?php _e("Destination date", "gpdealdomain"); ?> : </span> 
                                                                <span class="span_value">
                                                                    <?php echo date('d-m-Y', strtotime(get_post_meta(get_the_ID(), 'arrival-date-package', true)));
                                                                    ?>
                                                                </span>
                                                            </div>

                                                        </div>
                                                    </div>
                                                    <div class="extra content">
                                                        <div class="right floated">
                                                            <div class="ui dropdown top left pointing item">
                                                                <i class="ellipsis vertical icon"></i>
                                                                <div class="menu">

                                                                    <a href="<?php echo esc_url(add_query_arg(array('action' => 'show'), the_permalink())) ?>" class=" item">
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
                        $packages = new WP_Query(array('post_type' => 'package', 'post_per_page' => -1, "post_status" => 'publish', 'orderby' => 'post_date', 'order' => 'DESC', 'author' => $current_user->ID, 'meta_query' => array(array('key' => 'package-status', 'value' => 5, 'compare' => '='))));
                        if ($packages->have_posts()) {
                            ?>
                            <div class="title"><i class="dropdown icon"></i> <?php _e("Canceled", "gpdealdomain") ?> </div>
                            <div class="content">
                                <div id='list_as_grid_content' class="ui three column doubling stackable grid">
                                    <?php
                                    while ($packages->have_posts()): $packages->the_post();
                                        $package_type_list = wp_get_post_terms(get_the_ID(), 'type_package', array("fields" => "all"));
                                        ?>
                                        <div id="single_package_column<?php the_ID() ?>" class="column">
                                            <form id="single_package_content_form<?php the_ID() ?>" method="POST" action="<?php echo wp_make_link_relative(get_the_permalink()); ?>">
                                                <div class="ui fluid card">
                                                    <div class="content">
                                                        <div class="ui form description">
                                                            <div class="inline field">
                                                                <span class="span_label"><?php _e("Departure", "gpdealdomain"); ?> : </span> 

                                                                <span class="span_value">
                                                                    <?php echo get_post_meta(get_the_ID(), 'departure-city-package', true) ?> (<?php echo get_post_meta(get_the_ID(), 'departure-country-package', true) ?>)
                                                                </span>
                                                            </div>
                                                            <div class="inline field">
                                                                <span class="span_label"><?php _e("Destination", "gpdealdomain"); ?> : </span> 
                                                                <span class="span_value">
                                                                    <?php echo get_post_meta(get_the_ID(), 'destination-city-package', true) ?> (<?php echo get_post_meta(get_the_ID(), 'destination-country-package', true) ?>)
                                                                </span>
                                                            </div>
                                                            <div class="inline field">
                                                                <span class="span_label"><?php _e("Departure date", "gpdealdomain"); ?> : </span> 
                                                                <span class="span_value">
                                                                    <?php echo date('d-m-Y', strtotime(get_post_meta(get_the_ID(), 'date-of-departure-package', true)));
                                                                    ?>
                                                                </span>
                                                            </div>
                                                            <div class="inline field">
                                                                <span class="span_label"><?php _e("Destination date", "gpdealdomain"); ?> : </span> 
                                                                <span class="span_value">
                                                                    <?php echo date('d-m-Y', strtotime(get_post_meta(get_the_ID(), 'arrival-date-package', true)));
                                                                    ?>
                                                                </span>
                                                            </div>

                                                        </div>
                                                    </div>
                                                    <div class="extra content">
                                                        <div class="right floated">
                                                            <div class="ui dropdown top left pointing item">
                                                                <i class="ellipsis vertical icon"></i>
                                                                <div class="menu">
                                                                    <a href="<?php echo esc_url(add_query_arg(array('action' => 'show'), the_permalink())) ?>" class=" item">
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

            <div class="ui fluid card content_transactions_card">
                <div class="content center aligned">
                    <div class="header"><?php _e("My transport offers", "gpdealdomain"); ?> </div>
                </div>
                <div class="content">
                    <div class="ui styled fluid accordion">
                        <?php
                        global $current_user;
                        $transport_offers = new WP_Query(array('post_type' => 'transport-offer', 'post_per_page' => -1, "post_status" => 'publish', 'orderby' => 'post_date', 'order' => 'DESC', 'author' => $current_user->ID, 'meta_query' => array('relation' => 'OR', array('key' => 'transport-status', 'value' => 1, 'compare' => '='), array('key' => 'transport-status', 'value' => -1, 'compare' => '='))));
                        if ($transport_offers->have_posts()) {
                            ?>
                            <div class="title"><i class="dropdown icon"></i> <?php _e("In progress", "gpdealdomain"); ?> </div>
                            <div class="content">
                                <div id='list_as_grid_content' class="ui two column doubling stackable grid">
                                    <?php
                                    while ($transport_offers->have_posts()): $transport_offers->the_post();
                                        $transport_offer_id = get_the_ID();
                                        $package_type_list = wp_get_post_terms($transport_offer_id, 'type_package', array("fields" => "all"));
                                        $transport_method_list = wp_get_post_terms($transport_offer_id, 'transport-method', array("fields" => "all"));
                                        ?>
                                        <div class="column">
                                            <div class="ui fluid card">
                                                <?php
                                                $post_author = get_post_field('post_author', $transport_offer_id);
                                                //$carrier_name = $current_user->ID == $post_author ? __("Vous", "gpdealdomain") : get_the_author_meta('user_login');
                                                //$profile_picture_id = get_user_meta($post_author, 'profile-picture-ID', true) ? get_user_meta($post_author, 'profile-picture-ID', true) : get_user_meta($post_author, 'company-logo-ID', true);
                                                ?>
                                                <div class="content">
                                                    <div class="ui form description">
                                                        <div class="inline field">
                                                            <span class="span_label"><?php _e("Departure", "gpdealdomain"); ?> : </span>
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
                                                           <span class="span_label"><?php _e("Deadline", "gpdealdomain"); ?><!-- <i class="help circle green link icon deadline_transport_offer_help_link"></i>--> : </span> 
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
                                                                            <?php echo $stat_value["vote_count"]; ?> reviews
                                                                        </a>
                                                                    </div>
                                                                </div>
                                                            <?php endforeach; ?>
                                                        <?php else: ?>
                                                            <span id="<?php echo $transport_offer_id; ?>"  ><i class="star icon"></i> <?php echo __("No reviews", "gpdealdomain"); ?></span>
                                                        <?php endif ?>
                                                    </div>
                                                    <div class="right floated">
                                                        <div class="ui dropdown top left pointing item">
                                                            <i class="ellipsis vertical icon"></i>
                                                            <div class="menu">
                                                                <?php if ($statistics["Evaluation globale"]["vote_count"] == 0): ?>
                                                                    <a href="<?php echo esc_url(add_query_arg(array('action' => 'show'), wp_make_link_relative(get_permalink($transport_offer_id)))) ?>" class=" item">
                                                                        <i class="unhide icon"></i>
                                                                        <?php _e("View/Edit", "gpdealdomain"); ?>
                                                                    </a>
                                                                <?php else: ?>
                                                                    <a href="<?php echo esc_url(add_query_arg(array('action' => 'show'), wp_make_link_relative(get_permalink($transport_offer_id)))) ?>" class=" item">
                                                                        <i class="unhide icon"></i>
                                                                        <?php _e("View", "gpdealdomain"); ?>
                                                                    </a>
                                                                <?php endif ?>
                                                                <a href="<?php echo esc_url(add_query_arg(array('action' => 'evaluations'), wp_make_link_relative(get_permalink($transport_offer_id)))) ?>" class="item">
                                                                    <i class="star icon"></i>
                                                                    <?php _e("Reviews/Evaluations", "gpdealdomain"); ?>
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
                            <div class="title"><i class="dropdown icon"></i> <?php _e("Expired", "gpdealdomain"); ?></div>
                            <div class="content">
                                <div id='list_as_grid_content' class="ui two column doubling stackable grid">
                                    <?php
                                    while ($transport_offers->have_posts()): $transport_offers->the_post();
                                        $transport_offer_id = get_the_ID();
                                        $package_type_list = wp_get_post_terms($transport_offer_id, 'type_package', array("fields" => "all"));
                                        $transport_method_list = wp_get_post_terms($transport_offer_id, 'transport-method', array("fields" => "all"));
                                        ?>
                                        <div class="column">
                                            <div class="ui fluid card">
                                                <?php
                                                $post_author = get_post_field('post_author', $transport_offer_id);
                                                //$carrier_name = $current_user->ID == $post_author ? __("Vous", "gpdealdomain") : get_the_author_meta('user_login');
                                                //$profile_picture_id = get_user_meta($post_author, 'profile-picture-ID', true) ? get_user_meta($post_author, 'profile-picture-ID', true) : get_user_meta($post_author, 'company-logo-ID', true);
                                                ?>
                                                <div class="content">
                                                    <div class="ui form description">
                                                        <div class="inline field">
                                                            <span class="span_label"><?php _e("Departure", "gpdealdomain"); ?> : </span>
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
                                                           <span class="span_label"><?php _e("Deadline", "gpdealdomain"); ?><!-- <i class="help circle green link icon deadline_transport_offer_help_link"></i>--> : </span> 
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
                                                                            <?php echo $stat_value["vote_count"]; ?> reviews
                                                                        </a>
                                                                    </div>
                                                                </div>
                                                            <?php endforeach; ?>
                                                        <?php else: ?>
                                                            <span id="<?php echo $transport_offer_id; ?>"  ><i class="star icon"></i> <?php echo __("No reviews", "gpdealdomain"); ?></span>
                                                        <?php endif ?>
                                                    </div>
                                                    <div class="right floated">
                                                        <div class="ui dropdown top left pointing item">
                                                            <i class="ellipsis vertical icon"></i>
                                                            <div class="menu">

                                                                <a href="<?php echo esc_url(add_query_arg(array('action' => 'show'), wp_make_link_relative(get_permalink($transport_offer_id)))) ?>" class=" item">
                                                                    <i class="unhide icon"></i>
                                                                    <?php _e("View", "gpdealdomain"); ?>
                                                                </a>

                                                                <a href="<?php echo esc_url(add_query_arg(array('action' => 'evaluations'), wp_make_link_relative(get_permalink($transport_offer_id)))) ?>" class="item">
                                                                    <i class="star icon"></i>
                                                                    <?php _e("Reviews/Evaluations", "gpdealdomain"); ?>
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
        <div class="four wide column">
            <div class="ui fluid card">
                <div class="content center aligned">
                    <a href="<?php echo wp_make_link_relative(get_permalink(get_page_by_path(__('my-account', 'gpdealdomain') . '/' . __('shipments', 'gpdealdomain') . '/' . __('write', 'gpdealdomain')))); ?>" class="ui green fluid button" ><?php echo __('Ship a package', 'gpdealdomain') ?></a>
                </div>
            </div>
            <div class="ui fluid card">
                <div class="content center aligned">
                    <a href="<?php echo wp_make_link_relative(get_permalink(get_page_by_path(__('my-account', 'gpdealdomain') . '/' . __('transport-offers', 'gpdealdomain') . '/' . __('write', 'gpdealdomain')))); ?>" class="ui green fluid button" ><?php echo __('Carry a package', 'gpdealdomain') ?></a>
                </div>
            </div>

            <div class="ui fluid card">
                <div class="content center aligned">
                    <a href="<?php echo wp_make_link_relative(home_url('/#feature_homepage')); ?>" class="ui green fluid button" ><?php echo __('Search carriers/shipments', 'gpdealdomain') ?></a>
                </div>
            </div>

            <div class="ui fluid card">
                <div class="content">
                    <div class="ui list">
                        <div class="header"><strong><?php echo __("My transactions", "gpdealdomain"); ?></strong></div>
                        <div class="item" ><i class="minus icon"></i><a class="content" href="<?php echo wp_make_link_relative(get_permalink(get_page_by_path(__('my-account', 'gpdealdomain') . '/' . __('shipments', 'gpdealdomain')))); ?>"><?php echo __('My shipments', 'gpdealdomain') ?></a></div>
                        <div class="item" ><i class="minus icon"></i><a class="content" href='<?php echo wp_make_link_relative(get_permalink(get_page_by_path(__('my-account', 'gpdealdomain') . '/' . __('transport-offers', 'gpdealdomain')))); ?>'><?php echo __('My transport offers', 'gpdealdomain') ?> </a></div>
                    </div>
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

<?php
include(locate_template('content-modal-confirmation-package.php'));
