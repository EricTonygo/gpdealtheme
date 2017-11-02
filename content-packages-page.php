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
                                        <?php _e("You must complete the missing information in your profile in order to be able to contact carriers", "gpdealdomain"); ?>.
                                    </p>
                                </div>
                            <?php endif ?>
                            <div class="ui styled fluid accordion">
                                <?php
                                global $current_user;
                                if ($packages_search_for_carriers->have_posts()) {
                                    ?>
                                    <div class="title <?php if($shipments_status && $shipments_status == "search-for-carriers"): ?>active<?php endif ?>"><i class="dropdown icon"></i> <?php _e("Search for carriers", "gpdealdomain"); ?> </div>
                                    <div class="content <?php if($shipments_status && $shipments_status == "search-for-carriers"): ?>active<?php endif ?>">
                                        <div id='list_as_grid_content' class="ui two column doubling stackable grid">
                                            <?php
                                            while ($packages_search_for_carriers->have_posts()): $packages_search_for_carriers->the_post();
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
                                        <?php
                                        if ($total_search_for_carriers_post_pages > 1):
                                            $start = 1;
                                            $end = $total_search_for_carriers_post_pages;
                                            if ($total_search_for_carriers_post_pages > 5 && $num_page_search_for_carriers > 3) {
                                                $end = $num_page_search_for_carriers + 2 < $total_search_for_carriers_post_pages ? $num_page_search_for_carriers + 2 : $total_search_for_carriers_post_pages;
                                                $start = $end - 4 > 1 ? $end - 4 : 1;
                                            }elseif($total_search_for_carriers_post_pages > 5){
                                                $end = 5;
                                            }
                                            ?>
                                            <div class="fluid card" style="margin-top: 1.5em; text-align: center;">
                                                <div class="content">
                                                    <div class="ui small icon buttons right floated">
                                                        <?php if ($num_page_search_for_carriers > 1): ?>
                                                            <?php
                                                            $params_arg_search_for_carriers["num-page"] = $num_page_search_for_carriers - 1;
                                                            ?>
                                                            <a class="ui button" href="<?php echo esc_url(add_query_arg($params_arg_search_for_carriers, wp_make_link_relative($page_link))); ?>"><i class="chevron left icon"></i></a>
                                                        <?php endif ?>
                                                        <?php for ($i = $start; $i <= $end; $i++): ?>
                                                            <?php
                                                            $params_arg_search_for_carriers["num-page"] = $i;
                                                            ?>
                                                            <a class="ui <?php if ($num_page_search_for_carriers == $i): ?>green<?php else: ?>basic<?php endif ?> button" href="<?php echo esc_url(add_query_arg($params_arg_search_for_carriers, wp_make_link_relative($page_link))); ?>"><?php echo $i; ?></a>
                                                        <?php endfor; ?>
                                                        <?php if ($num_page_search_for_carriers < $total_search_for_carriers_post_pages): ?>
                                                            <?php
                                                            $params_arg_search_for_carriers["num-page"] = $num_page_search_for_carriers + 1;
                                                            ?>
                                                            <a class="ui button" href="<?php echo esc_url(add_query_arg($params_arg_search_for_carriers, wp_make_link_relative($page_link))); ?>"><i class="chevron right icon"></i></a>
                                                        <?php endif ?>
                                                    </div>
                                                </div>
                                            </div>
                                        <?php endif ?>
                                    </div>
                                    <?php
                                }
                                wp_reset_postdata();
                                ?>

                                <?php
                                global $current_user;

                                if ($packages_in_progress->have_posts()) {
                                    ?>
                                    <div class="title <?php if($shipments_status && $shipments_status == "in-progress"): ?>active<?php endif ?>"><i class="dropdown icon"></i> <?php _e("In progress", "gpdealdomain"); ?> </div>
                                    <div class="content <?php if($shipments_status && $shipments_status == "in-progress"): ?>active<?php endif ?>">
                                        <div id='list_as_grid_content' class="ui two column doubling stackable grid">
                                            <?php
                                            while ($packages_in_progress->have_posts()): $packages_in_progress->the_post();
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
                                        <?php
                                        if ($total_in_progress_post_pages > 1):
                                            $start = 1;
                                            $end = $total_in_progress_post_pages;
                                            if ($total_in_progress_post_pages > 5 && $num_page_in_progress > 3) {
                                                $end = $num_page_in_progress + 2 < $total_in_progress_post_pages ? $num_page_in_progress + 2 : $total_in_progress_post_pages;
                                                $start = $end - 4 > 1 ? $end - 4 : 1;
                                            }elseif($total_in_progress_post_pages > 5){
                                                $end = 5;
                                            }
                                            ?>
                                            <div class="fluid card" style="margin-top: 1.5em; text-align: center;">
                                                <div class="content">
                                                    <div class="ui small icon buttons right floated">
                                                        <?php if ($num_page_in_progress > 1): ?>
                                                            <?php
                                                            $params_arg_in_progress["num-page"] = $num_page_in_progress - 1;
                                                            ?>
                                                            <a class="ui button" href="<?php echo esc_url(add_query_arg($params_arg_in_progress, wp_make_link_relative($page_link))); ?>"><i class="chevron left icon"></i></a>
                                                        <?php endif ?>
                                                        <?php for ($i = $start; $i <= $end; $i++): ?>
                                                            <?php
                                                            $params_arg_in_progress["num-page"] = $i;
                                                            ?>
                                                            <a class="ui <?php if ($num_page_in_progress == $i): ?>green<?php else: ?>basic<?php endif ?> button" href="<?php echo esc_url(add_query_arg($params_arg_in_progress, wp_make_link_relative($page_link))); ?>"><?php echo $i; ?></a>
                                                        <?php endfor; ?>
                                                        <?php if ($num_page_in_progress < $total_in_progress_post_pages): ?>
                                                            <?php
                                                            $params_arg_in_progress["num-page"] = $num_page_in_progress + 1;
                                                            ?>
                                                            <a class="ui button" href="<?php echo esc_url(add_query_arg($params_arg_in_progress, wp_make_link_relative($page_link))); ?>"><i class="chevron right icon"></i></a>
                                                        <?php endif ?>
                                                    </div>
                                                </div>
                                            </div>
                                        <?php endif ?>
                                    </div>
                                    <?php
                                }
                                wp_reset_postdata();
                                ?>

                                <?php
                                global $current_user;

                                if ($packages_evaluated_closed->have_posts()) {
                                    ?>
                                    <div class="title <?php if($shipments_status && $shipments_status == "evaluated-closed"): ?>active<?php endif ?>"><i class="dropdown icon"></i> <?php _e("Evaluated/Closed", "gpdealdomain"); ?> </div>
                                    <div class="content <?php if($shipments_status && $shipments_status == "evaluated-closed"): ?>active<?php endif ?>">                           
                                        <div id='list_as_grid_content' class="ui two column doubling stackable grid">
                                            <?php
                                            while ($packages_evaluated_closed->have_posts()): $packages_evaluated_closed->the_post();
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
                                        <?php
                                        if ($total_evaluated_closed_post_pages > 1):
                                            $start = 1;
                                            $end = $total_evaluated_closed_post_pages;
                                            if ($total_evaluated_closed_post_pages > 5 && $num_page_evaluated_closed > 3) {
                                                $end = $num_page_evaluated_closed + 2 < $total_evaluated_closed_post_pages ? $num_page_evaluated_closed + 2 : $total_evaluated_closed_post_pages;
                                                $start = $end - 4 > 1 ? $end - 4 : 1;
                                            }elseif($total_evaluated_closed_post_pages > 5){
                                                $end = 5;
                                            }
                                            ?>
                                            <div class="fluid card" style="margin-top: 1.5em; text-align: center;">
                                                <div class="content">
                                                    <div class="ui small icon buttons right floated">
                                                        <?php if ($num_page_evaluated_closed > 1): ?>
                                                            <?php
                                                            $params_arg_evaluated_closed["num-page"] = $num_page_evaluated_closed - 1;
                                                            ?>
                                                            <a class="ui button" href="<?php echo esc_url(add_query_arg($params_arg_evaluated_closed, wp_make_link_relative($page_link))); ?>"><i class="chevron left icon"></i></a>
                                                        <?php endif ?>
                                                        <?php for ($i = $start; $i <= $end; $i++): ?>
                                                            <?php
                                                            $params_arg_evaluated_closed["num-page"] = $i;
                                                            ?>
                                                            <a class="ui <?php if ($num_page_evaluated_closed == $i): ?>green<?php else: ?>basic<?php endif ?> button" href="<?php echo esc_url(add_query_arg($params_arg_evaluated_closed, wp_make_link_relative($page_link))); ?>"><?php echo $i; ?></a>
                                                        <?php endfor; ?>
                                                        <?php if ($num_page_evaluated_closed < $total_evaluated_closed_post_pages): ?>
                                                            <?php
                                                            $params_arg_evaluated_closed["num-page"] = $num_page_evaluated_closed + 1;
                                                            ?>
                                                            <a class="ui button" href="<?php echo esc_url(add_query_arg($params_arg_evaluated_closed, wp_make_link_relative($page_link))); ?>"><i class="chevron right icon"></i></a>
                                                        <?php endif ?>
                                                    </div>
                                                </div>
                                            </div>
                                        <?php endif ?>
                                    </div>
                                    <?php
                                }
                                wp_reset_postdata();
                                ?>

                                <?php
                                global $current_user;

                                if ($packages_expired->have_posts()) {
                                    ?>
                                    <div class="title <?php if($shipments_status && $shipments_status == "expired"): ?>active<?php endif ?>"><i class="dropdown icon"></i> <?php _e("Expired", "gpdealdomain"); ?> </div>
                                    <div class="content <?php if($shipments_status && $shipments_status == "expired"): ?>active<?php endif ?>">
                                        <div id='list_as_grid_content' class="ui two column doubling stackable grid">
                                            <?php
                                            while ($packages_expired->have_posts()): $packages_expired->the_post();
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
                                        <?php
                                        if ($total_expired_post_pages > 1):
                                            $start = 1;
                                            $end = $total_expired_post_pages;
                                            if ($total_expired_post_pages > 5 && $num_page_expired > 3) {
                                                $end = $num_page_expired + 2 < $total_expired_post_pages ? $num_page_expired + 2 : $total_expired_post_pages;
                                                $start = $end - 4 > 1 ? $end - 4 : 1;
                                            }elseif($total_expired_post_pages > 5){
                                                $end = 5;
                                            }
                                            ?>
                                            <div class="fluid card" style="margin-top: 1.5em; text-align: center;">
                                                <div class="content">
                                                    <div class="ui small icon buttons right floated">
                                                        <?php if ($num_page_expired > 1): ?>
                                                            <?php
                                                            $params_arg_expired["num-page"] = $num_page_expired - 1;
                                                            ?>
                                                            <a class="ui button" href="<?php echo esc_url(add_query_arg($params_arg_expired, wp_make_link_relative($page_link))); ?>"><i class="chevron left icon"></i></a>
                                                        <?php endif ?>
                                                        <?php for ($i = $start; $i <= $end; $i++): ?>
                                                            <?php
                                                            $params_arg_expired["num-page"] = $i;
                                                            ?>
                                                            <a class="ui <?php if ($num_page_expired == $i): ?>green<?php else: ?>basic<?php endif ?> button" href="<?php echo esc_url(add_query_arg($params_arg_expired, wp_make_link_relative($page_link))); ?>"><?php echo $i; ?></a>
                                                        <?php endfor; ?>
                                                        <?php if ($num_page_expired < $total_expired_post_pages): ?>
                                                            <?php
                                                            $params_arg_expired["num-page"] = $num_page_expired + 1;
                                                            ?>
                                                            <a class="ui button" href="<?php echo esc_url(add_query_arg($params_arg_expired, wp_make_link_relative($page_link))); ?>"><i class="chevron right icon"></i></a>
                                                        <?php endif ?>
                                                    </div>
                                                </div>
                                            </div>
                                        <?php endif ?>
                                    </div>
                                    <?php
                                }
                                wp_reset_postdata();
                                ?>

                                <?php
                                global $current_user;

                                if ($packages_canceled->have_posts()) {
                                    ?>
                                    <div class="title <?php if($shipments_status && $shipments_status == "canceled"): ?>active<?php endif ?>"><i class="dropdown icon"></i> <?php _e("Canceled", "gpdealdomain"); ?> </div>
                                    <div class="content <?php if($shipments_status && $shipments_status == "canceled"): ?>active<?php endif ?>">
                                        <div id='list_as_grid_content' class="ui two column doubling stackable grid">
                                            <?php
                                            while ($packages_canceled->have_posts()): $packages_canceled->the_post();
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
                                        <?php
                                        if ($total_canceled_post_pages > 1):
                                            $start = 1;
                                            $end = $total_canceled_post_pages;
                                            if ($total_canceled_post_pages > 5 && $num_page_canceled > 3) {
                                                $end = $num_page_canceled + 2 < $total_canceled_post_pages ? $num_page_canceled + 2 : $total_canceled_post_pages;
                                                $start = $end - 4 > 1 ? $end - 4 : 1;
                                            }elseif($total_canceled_post_pages > 5){
                                                $end = 5;
                                            }
                                            ?>
                                            <div class="fluid card" style="margin-top: 1.5em; text-align: center;">
                                                <div class="content">
                                                    <div class="ui small icon buttons right floated">
                                                        <?php if ($num_page_canceled > 1): ?>
                                                            <?php
                                                            $params_arg_canceled["num-page"] = $num_page_canceled - 1;
                                                            ?>
                                                            <a class="ui button" href="<?php echo esc_url(add_query_arg($params_arg_canceled, wp_make_link_relative($page_link))); ?>"><i class="chevron left icon"></i></a>
                                                        <?php endif ?>
                                                        <?php for ($i = $start; $i <= $end; $i++): ?>
                                                            <?php
                                                            $params_arg_canceled["num-page"] = $i;
                                                            ?>
                                                            <a class="ui <?php if ($num_page_canceled == $i): ?>green<?php else: ?>basic<?php endif ?> button" href="<?php echo esc_url(add_query_arg($params_arg_canceled, wp_make_link_relative($page_link))); ?>"><?php echo $i; ?></a>
                                                        <?php endfor; ?>
                                                        <?php if ($num_page_canceled < $total_canceled_post_pages): ?>
                                                            <?php
                                                            $params_arg_canceled["num-page"] = $num_page_canceled + 1;
                                                            ?>
                                                            <a class="ui button" href="<?php echo esc_url(add_query_arg($params_arg_canceled, wp_make_link_relative($page_link))); ?>"><i class="chevron right icon"></i></a>
                                                        <?php endif ?>
                                                    </div>
                                                </div>
                                            </div>
                                        <?php endif ?>
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
