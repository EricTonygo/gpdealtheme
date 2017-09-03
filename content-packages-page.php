<?php get_template_part('top-menu', get_post_format()); ?>
<div class="ui tiny borderless second-nav menu">
    <div class="ui container center aligned">
        <div class="center menu">
            <div class="item">
                <a href="<?php echo wp_make_link_relative(home_url('/')) ?>" class="section"><?php echo get_page_by_path(__('home', 'gpdealdomain'))->post_title ?></a>
                <i class="small right arrow icon divider"></i>
                <div class="active section"><?php echo get_page_by_path(__('my-account', 'gpdealdomain'))->post_title ?></div>
<!--                <i class="right chevron icon divider"></i>
                <a href="<?php echo wp_make_link_relative(get_permalink(get_page_by_path(__('my-account', 'gpdealdomain')))); ?>" class="section"><?php echo get_page_by_path(__('my-account', 'gpdealdomain'))->post_title ?></a>
                <i class="right arrow icon divider"></i>
                <div class="active section"><?php _e('Shipments', "gpdealdomain"); ?></div>-->
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
                            <span class="header left floated" style="text-transform: uppercase; font-weight: normal; margin-top: 0.5em;"><?php echo __('My shipments', 'gpdealdomain') ?></span>
                            <?php //if (get_user_meta(get_current_user_id(), "registration-completed", true) == 2):  ?>    
                            <a href="<?php echo wp_make_link_relative(get_permalink(get_page_by_path(__('my-account', 'gpdealdomain') . '/' . __('shipments', 'gpdealdomain') . '/' . __('write', 'gpdealdomain')))); ?>" class="ui right floated green button" ><?php echo __('New Shipment', 'gpdealdomain') ?></a>
                            <?php //endif  ?>
                        </div>
                        <div class="content content_packages_transports">
                            <?php include(locate_template("content_success_or_faillure_message.php")); ?>
                            <?php if (get_user_meta(get_current_user_id(), "registration-completed", true) != 2): ?>
                                <div class="ui warning message">
                                    <div class="header">
                                        <?php _e("Incomplete registration", "gpdealdomain"); ?>
                                    </div>
                                    <p>
                                        <?php _e("You must complete the missing information in your profile in order to be able to search for carriers", "gpdealdomain"); ?>.
                                    </p>
                                </div>
                            <?php endif ?>
                            <div class="ui styled fluid accordion">
                                <?php
                                global $current_user;
                                $packages = new WP_Query(array('post_type' => 'package', 'posts_per_page' => -1, "post_status" => 'publish', 'orderby' => 'post_date', 'order' => 'DESC', 'author' => $current_user->ID, 'meta_query' => array('relation' => 'OR', array('key' => 'package-status', 'value' => 1, 'compare' => '='), array('key' => 'package-status', 'value' => -1, 'compare' => '='))));
                                if ($packages->have_posts()) {
                                    ?>
                                    <div class="title"><i class="dropdown icon"></i> <?php _e("Search for carriers", "gpdealdomain"); ?> </div>
                                    <div class="content">
                                        <div id='list_as_grid_content' class="ui two column doubling stackable grid">
                                            <?php
                                            while ($packages->have_posts()): $packages->the_post();
                                                $package_type_list = wp_get_post_terms(get_the_ID(), 'type_package', array("fields" => "all"));
                                                ?>
                                                <div id="single_package_column<?php the_ID() ?>" class="column">
                                                    <form id="single_package_content_form<?php the_ID() ?>" method="POST" action="<?php echo wp_make_link_relative(get_the_permalink()); ?>">
                                                        <div class="ui fluid card package_card">
                                                            <div class="content">
                                                                <div class="ui form description">
                                                                    <div class="field">
                                                                        <div class="ui grid">
                                                                            <div class="seven wide column">
                                                                                <i class="blue large marker icon"></i>
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
                                                                                <i class="blue large long arrow right icon"></i>
                                                                            </div>
                                                                            <div class="seven wide column">
                                                                                <i class="blue large flag checkered icon"></i>
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
                                                                                <i class="blue large calendar icon"></i>
                                                                                <div class="inline field">
                                                                                    <span class="span_value">
                                                                                        <?php echo date('d-m-Y', strtotime(get_post_meta(get_the_ID(), 'date-of-departure-package', true))); ?>
                                                                                    </span>
                                                                                </div>
                                                                            </div>
                                                                            <div class="two wide column">
                                                                                <i class="blue large long arrow right icon"></i>
                                                                                <div class="inline field"> 
                                                                                    <span class="span_value">
                                                                                        <?php echo gpdeal_date_diff(date('d-m-Y', strtotime(get_post_meta(get_the_ID(), 'date-of-departure-package', true))), date('d-m-Y', strtotime(get_post_meta(get_the_ID(), 'arrival-date-package', true)))) ?>j
                                                                                    </span>
                                                                                </div>
                                                                            </div>
                                                                            <div class="seven wide column">
                                                                                <i class="blue large calendar icon"></i>
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
                                                            <div class="extra content">
                                                                <?php if (get_post_meta(get_the_ID(), 'transport-offer-alert', true) == 2): ?>
                                                                    <span class="left floated like">
                                                                        <i class="alarm green link icon tooltip">
                                                                            <span class="tooltiptext"><?php _e("An alert has been activated for this shipment", "gpdealdomain") ?></span>
                                                                        </i>
                                                                    </span>
                                                                <?php endif ?>
                                                                <div class="right floated">
                                                                    <div class="ui right pointing dropdown item">
                                                                        <i class="ellipsis vertical icon"></i>
                                                                        <div class="menu">
                                                                            <a href="<?php echo esc_url(add_query_arg(array('action' => 'show'), the_permalink())) ?>" class=" item">
                                                                                <i class="unhide icon"></i>
                                                                                <?php _e("View/Edit", "gpdealdomain"); ?>
                                                                            </a>
        <!--                                                                    <a href="<?php echo esc_url(add_query_arg(array('action' => 'cancel'), the_permalink())) ?>" class=" item">
                                                                                <i class="unhide icon"></i>
                                                                            <?php _e("Cancel", "gpdealdomain"); ?>
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
                                $packages = new WP_Query(array('post_type' => 'package', 'posts_per_page' => -1, "post_status" => 'publish', 'orderby' => 'post_date', 'order' => 'DESC', 'author' => $current_user->ID, 'meta_query' => array(array('key' => 'package-status', 'value' => 2, 'compare' => '='))));
                                if ($packages->have_posts()) {
                                    ?>
                                    <div class="title"><i class="dropdown icon"></i> <?php _e("In progress", "gpdealdomain"); ?> </div>
                                    <div class="content">
                                        <div id='list_as_grid_content' class="ui two column doubling stackable grid">
                                            <?php
                                            while ($packages->have_posts()): $packages->the_post();
                                                $package_type_list = wp_get_post_terms(get_the_ID(), 'type_package', array("fields" => "all"));
                                                ?>
                                                <div id="single_package_column<?php the_ID() ?>" class="column">
                                                    <form id="single_package_content_form<?php the_ID() ?>" method="POST" action="<?php echo wp_make_link_relative(get_the_permalink()); ?>">
                                                        <div class="ui fluid card package_card">
                                                            <div class="content">
                                                                <div class="ui form description">
                                                                    <div class="field">
                                                                        <div class="ui grid">
                                                                            <div class="seven wide column">
                                                                                <i class="large blue marker icon"></i>
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
                                                                                <i class="large blue long arrow right icon"></i>
                                                                            </div>
                                                                            <div class="seven wide column">
                                                                                <i class="large blue flag checkered icon"></i>
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
                                                                                <i class="large blue calendar icon"></i>
                                                                                <div class="inline field">
                                                                                    <span class="span_value">
                                                                                        <?php echo date('d-m-Y', strtotime(get_post_meta(get_the_ID(), 'date-of-departure-package', true))); ?>
                                                                                    </span>
                                                                                </div>
                                                                            </div>
                                                                            <div class="two wide column">
                                                                                <i class="large blue long arrow right icon"></i>
                                                                                <div class="inline field"> 
                                                                                    <span class="span_value">
                                                                                        <?php echo gpdeal_date_diff(date('d-m-Y', strtotime(get_post_meta(get_the_ID(), 'date-of-departure-package', true))), date('d-m-Y', strtotime(get_post_meta(get_the_ID(), 'arrival-date-package', true)))) ?>j
                                                                                    </span>
                                                                                </div>
                                                                            </div>
                                                                            <div class="seven wide column">
                                                                                <i class="large blue calendar icon"></i>
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
                                                            <div class="extra content">
                                                                <div class="right floated">
                                                                    <div class="ui right pointing dropdown item">
                                                                        <i class="ellipsis vertical icon"></i>
                                                                        <div class="menu">
                                                                            <a href="<?php echo esc_url(add_query_arg(array('action' => 'show'), the_permalink())) ?>" class=" item">
                                                                                <i class="unhide icon"></i>
                                                                                <?php _e("View/Edit/Close", "gpdealdomain"); ?>
                                                                            </a>

                                                                            <a href="<?php echo esc_url(add_query_arg(array('package-id' => get_the_ID()), wp_make_link_relative(get_the_permalink(get_page_by_path(__('my-account', 'gpdealdomain') . '/' . __('show-carriers-contacts', 'gpdealdomain')))))); ?>" class="item">
                                                                                <i class="shipping icon"></i>
                                                                                <?php _e("Selected carrier", "gpdealdomain"); ?>
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
                                $packages = new WP_Query(array('post_type' => 'package', 'posts_per_page' => -1, "post_status" => 'publish', 'orderby' => 'post_date', 'order' => 'DESC', 'author' => $current_user->ID, 'meta_query' => array(array('key' => 'package-status', 'value' => 3, 'compare' => '='))));
                                if ($packages->have_posts()) {
                                    ?>
                                    <div class="title"><i class="dropdown icon"></i> <?php _e("Evaluated/Closed", "gpdealdomain"); ?> </div>
                                    <div class="content">                           
                                        <div id='list_as_grid_content' class="ui two column doubling stackable grid">
                                            <?php
                                            while ($packages->have_posts()): $packages->the_post();
                                                $package_type_list = wp_get_post_terms(get_the_ID(), 'type_package', array("fields" => "all"));
                                                ?>
                                                <div id="single_package_column<?php the_ID() ?>" class="column">
                                                    <form id="single_package_content_form<?php the_ID() ?>" method="POST" action="<?php echo wp_make_link_relative(get_the_permalink()); ?>">
                                                        <div class="ui fluid card package_card">
                                                            <div class="content">
                                                                <div class="ui form description">
                                                                    <div class="field">
                                                                        <div class="ui grid">
                                                                            <div class="seven wide column">
                                                                                <i class="large blue marker icon"></i>
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
                                                                                <i class="large blue long arrow right icon"></i>
                                                                            </div>
                                                                            <div class="seven wide column">
                                                                                <i class="large blue flag checkered icon"></i>
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
                                                                                <i class="large blue calendar icon"></i>
                                                                                <div class="inline field">
                                                                                    <span class="span_value">
                                                                                        <?php echo date('d-m-Y', strtotime(get_post_meta(get_the_ID(), 'date-of-departure-package', true))); ?>
                                                                                    </span>
                                                                                </div>
                                                                            </div>
                                                                            <div class="two wide column">
                                                                                <i class="large blue long arrow right icon"></i>
                                                                                <div class="inline field"> 
                                                                                    <span class="span_value">
                                                                                        <?php echo gpdeal_date_diff(date('d-m-Y', strtotime(get_post_meta(get_the_ID(), 'date-of-departure-package', true))), date('d-m-Y', strtotime(get_post_meta(get_the_ID(), 'arrival-date-package', true)))) ?>j
                                                                                    </span>
                                                                                </div>
                                                                            </div>
                                                                            <div class="seven wide column">
                                                                                <i class="large blue calendar icon"></i>
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
                                                            <div class="extra content">
                                                                <div class="right floated">
                                                                    <div class="ui right pointing dropdown item">
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
                                $packages = new WP_Query(array('post_type' => 'package', 'posts_per_page' => -1, "post_status" => 'publish', 'orderby' => 'post_date', 'order' => 'DESC', 'author' => $current_user->ID, 'meta_query' => array(array('key' => 'package-status', 'value' => 4, 'compare' => '='))));
                                if ($packages->have_posts()) {
                                    ?>
                                    <div class="title"><i class="dropdown icon"></i> <?php _e("Expired", "gpdealdomain"); ?> </div>
                                    <div class="content">


                                        <div id='list_as_grid_content' class="ui two column doubling stackable grid">
                                            <?php
                                            while ($packages->have_posts()): $packages->the_post();
                                                $package_type_list = wp_get_post_terms(get_the_ID(), 'type_package', array("fields" => "all"));
                                                ?>
                                                <div id="single_package_column<?php the_ID() ?>" class="column">
                                                    <form id="single_package_content_form<?php the_ID() ?>" method="POST" action="<?php echo wp_make_link_relative(get_the_permalink()); ?>">
                                                        <div class="ui fluid card package_card">
                                                            <div class="content">
                                                                <div class="ui form description">
                                                                    <div class="field">
                                                                        <div class="ui grid">
                                                                            <div class="seven wide column">
                                                                                <i class="large blue marker icon"></i>
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
                                                                                <i class="large blue long arrow right icon"></i>
                                                                            </div>
                                                                            <div class="seven wide column">
                                                                                <i class="large blue flag checkered icon"></i>
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
                                                                                <i class="large blue calendar icon"></i>
                                                                                <div class="inline field">
                                                                                    <span class="span_value">
                                                                                        <?php echo date('d-m-Y', strtotime(get_post_meta(get_the_ID(), 'date-of-departure-package', true))); ?>
                                                                                    </span>
                                                                                </div>
                                                                            </div>
                                                                            <div class="two wide column">
                                                                                <i class="large blue long arrow right icon"></i>
                                                                                <div class="inline field"> 
                                                                                    <span class="span_value">
                                                                                        <?php echo gpdeal_date_diff(date('d-m-Y', strtotime(get_post_meta(get_the_ID(), 'date-of-departure-package', true))), date('d-m-Y', strtotime(get_post_meta(get_the_ID(), 'arrival-date-package', true)))) ?>j
                                                                                    </span>
                                                                                </div>
                                                                            </div>
                                                                            <div class="seven wide column">
                                                                                <i class="large blue calendar icon"></i>
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
                                                            <div class="extra content">
                                                                <div class="right floated">
                                                                    <div class="ui right pointing dropdown item">
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
                                $packages = new WP_Query(array('post_type' => 'package', 'posts_per_page' => -1, "post_status" => 'publish', 'orderby' => 'post_date', 'order' => 'DESC', 'author' => $current_user->ID, 'meta_query' => array(array('key' => 'package-status', 'value' => 5, 'compare' => '='))));
                                if ($packages->have_posts()) {
                                    ?>
                                    <div class="title"><i class="dropdown icon"></i> <?php _e("Canceled", "gpdealdomain"); ?> </div>
                                    <div class="content">
                                        <div id='list_as_grid_content' class="ui two column doubling stackable grid">
                                            <?php
                                            while ($packages->have_posts()): $packages->the_post();
                                                $package_type_list = wp_get_post_terms(get_the_ID(), 'type_package', array("fields" => "all"));
                                                ?>
                                                <div id="single_package_column<?php the_ID() ?>" class="column">
                                                    <form id="single_package_content_form<?php the_ID() ?>" method="POST" action="<?php echo wp_make_link_relative(get_the_permalink()); ?>">
                                                        <div class="ui fluid card package_card">
                                                            <div class="content">
                                                                <div class="ui form description">
                                                                    <div class="field">
                                                                        <div class="ui grid">
                                                                            <div class="seven wide column">
                                                                                <i class="large blue marker icon"></i>
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
                                                                                <i class="large blue long arrow right icon"></i>
                                                                            </div>
                                                                            <div class="seven wide column">
                                                                                <i class="large blue flag checkered icon"></i>
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
                                                                                <i class="large blue calendar icon"></i>
                                                                                <div class="inline field">
                                                                                    <span class="span_value">
                                                                                        <?php echo date('d-m-Y', strtotime(get_post_meta(get_the_ID(), 'date-of-departure-package', true))); ?>
                                                                                    </span>
                                                                                </div>
                                                                            </div>
                                                                            <div class="two wide column">
                                                                                <i class="large blue long arrow right icon"></i>
                                                                                <div class="inline field"> 
                                                                                    <span class="span_value">
                                                                                        <?php echo gpdeal_date_diff(date('d-m-Y', strtotime(get_post_meta(get_the_ID(), 'date-of-departure-package', true))), date('d-m-Y', strtotime(get_post_meta(get_the_ID(), 'arrival-date-package', true)))) ?>j
                                                                                    </span>
                                                                                </div>
                                                                            </div>
                                                                            <div class="seven wide column">
                                                                                <i class="large blue calendar icon"></i>
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
                                                            <div class="extra content">
                                                                <div class="right floated">
                                                                    <div class="ui right pointing dropdown item">
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
                </div>
            </div>
        </div>
    </div>
</div>

<?php
include(locate_template('content-modal-confirmation-package.php'));
