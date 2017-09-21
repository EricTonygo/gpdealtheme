<?php get_template_part('top-menu', get_post_format()); ?>
<div class="ui tiny borderless second-nav menu">
    <div class="ui container center aligned">
        <div class="center menu">
            <div class="item">
                <a href="<?php echo wp_make_link_relative(home_url('/')); ?>" class="section"><?php echo get_page_by_path(__('accueil', 'gpdealdomain'))->post_title ?></a>                
                <i class="small right arrow icon divider"></i>
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
            <div class="ui content_packages_transports fluid card">
                <div class="content center aligned">
                    <div class="header"><?php echo __('Shipments in search of carriers', 'gpdealdomain'); ?> <?php _e("from", "gpdealdomain"); ?> <span class="locality_name"><?php echo $search_data['start_city']; ?>(<?php echo $search_data['start_date']; ?>)</span> <?php _e("to", "gpdealdomain"); ?> <span class="locality_name"><?php echo $search_data['destination_city']; ?>(<?php echo $search_data['destination_date']; ?>)</span></div>
                </div>
                <div class="content content_packages_transports content_without_white">
                    <?php
                    $packages_corresponding = new WP_Query(getWPQueryArgsForUnsatifiedSendPackages($search_data_corresponding));
                    //$exclude_ids = array();
                    if ($packages_corresponding->have_posts()) {
                        ?>
                        <div id='list_as_grid_content' class="ui three column doubling stackable grid">
                            <?php
                            while ($packages_corresponding->have_posts()): $packages_corresponding->the_post();
                                //$exclude_ids[] = get_the_ID();
                                $total_corresponding_post_pages = $packages_corresponding->max_num_pages;
                                $post_author = get_post_field('post_author', get_the_ID());
                                $carrier_name = $current_user->ID == $post_author ? __("You", "gpdealdomain") : get_the_author_meta('user_login');
                                $profile_picture_id = get_user_meta($post_author, 'profile-picture-ID', true) ? get_user_meta($post_author, 'profile-picture-ID', true) : get_user_meta($post_author, 'company-logo-ID', true);
                                $package_picture_id = get_post_meta(get_the_ID(), 'package-picture-ID', true);
                                ?>
                                <div class="column">
                                    <div class="ui fluid card package_card">

                                        <?php if ($package_picture_id > 0): ?>
                                            <div class="image">
                                                <img  class="ui small image"  src= "<?php echo wp_make_link_relative(wp_get_attachment_url($package_picture_id)); ?>">
                                            </div>
                                        <?php endif ?>
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
                                                            <i class="large blue marker icon"></i>
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
                                        <div class="content">
                                            <div class="ui form description">
                                                <table class="ui celled unstackable table package_table">
                                                    <tr>
                                                        <td>
                                                            <span class="span_label"><?php _e("Object", "gpdealdomain"); ?> : </span> 
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
                                                    <tr>
                                                        <td>
                                                            <span class="span_label"><?php _e("Dimensions", "gpdealdomain"); ?>(cm) : </span> 
                                                        </td>
                                                        <td>
                                                            <span class="span_value">
                                                                <?php _e("abrev_length", "gpdealdomain"); ?>= <?php echo get_post_meta(get_the_ID(), 'length', true) ?>, <?php _e("abrev_width", "gpdealdomain"); ?>= <?php echo get_post_meta(get_the_ID(), 'width', true) ?>, <?php _e("abrev_height", "gpdealdomain"); ?>= <?php echo get_post_meta(get_the_ID(), 'height', true); ?>
                                                            </span>
                                                        </td>
                                                    </tr>

                                                    <tr>
                                                        <td>
                                                            <span class="span_label"><?php _e("Weight", "gpdealdomain"); ?>(kg) : </span> 
                                                        </td>
                                                        <td>
                                                            <span class="span_value">
                                                                <?php echo get_post_meta(get_the_ID(), 'weight', true) ?>
                                                            </span>
                                                        </td>
                                                    </tr>
                                                </table>
                                            </div>
                                        </div>
                                        <?php if (is_user_logged_in()): ?>
                                            <div class="extra content">
                                                <a  class="ui green button" href="<?php the_permalink(); ?>"><?php echo __("Details", "gpdealdomain") ?></a>
                                            </div>
                                        <?php endif ?>
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
                                        <?php _e("No unsatisfied shipment matches your criteria", "gpdealdomain"); ?>.
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
            $search_data_corresponding["posts_per_page"] = -1;
            $packages_corresponding_all = new WP_Query(getWPQueryArgsForUnsatifiedSendPackages($search_data_corresponding));
            $exclude_ids = wp_list_pluck($packages_corresponding_all->posts, "ID");
            $packages_wci = new WP_Query(getWPQueryArgsForUnsatifiedSendPackagesWithCanInterest($search_data_can_interest, $exclude_ids));
            $total_can_interest_post_pages = $packages_wci->max_num_pages;
            if ($packages_wci->have_posts()) {
                ?>
                <div class="ui content_packages_transports fluid card">
                    <div class="content center aligned">
                        <div class="header"><?php echo __('Shipments in search of carriers that may interest you', "gpdealdomain"); ?> <?php _e("from", "gpdealdomain"); ?> <span class="locality_name"><?php echo $search_data['start_city']; ?>(<?php echo $search_data['start_date']; ?>)</span> <?php _e("to", "gpdealdomain"); ?> <span class="locality_name"><?php echo $search_data['destination_city']; ?>(<?php echo $search_data['destination_date']; ?>)</span></div>
                    </div>
                    <div class="content content_packages_transports content_without_white">
                        <div id='list_as_grid_content' class="ui three column doubling stackable grid">
                            <?php
                            while ($packages_wci->have_posts()): $packages_wci->the_post();
                                ?>
                                <div class="column">
                                    <div class="ui fluid card package_card">
                                        <?php
                                        $post_author = get_post_field('post_author', get_the_ID());
                                        $carrier_name = $current_user->ID == $post_author ? __("You", "gpdealdomain") : get_the_author_meta('user_login');
                                        $profile_picture_id = get_user_meta($post_author, 'profile-picture-ID', true) ? get_user_meta($post_author, 'profile-picture-ID', true) : get_user_meta($post_author, 'company-logo-ID', true);
                                        $package_picture_id = get_post_meta(get_the_ID(), 'package-picture-ID', true);
                                        ?>
                                        <!--                                        <div class="content">
                                                                                    <img  class="ui avatar image" <?php if ($profile_picture_id): ?> src= "<?php echo wp_get_attachment_url($profile_picture_id); ?>" <?php else: ?> src="<?php echo get_template_directory_uri() ?>/assets/images/avatar.png"<?php endif ?>> <span class='profile_name'><?php echo $carrier_name; ?></span>
                                                                                </div>-->
                                        <?php if ($package_picture_id > 0): ?>
                                            <div class="image">
                                                <img  class="ui small image"  src= "<?php echo wp_make_link_relative(wp_get_attachment_url($package_picture_id)); ?>">
                                            </div>
                                        <?php endif ?>
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
                                        <div class="content">
                                            <div class="ui form description">
                                                <table class="ui celled unstackable table package_table">
                                                    <tr>
                                                        <td>
                                                            <span class="span_label"><?php _e("Object", "gpdealdomain"); ?> : </span> 
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
                                                    <tr>
                                                        <td>
                                                            <span class="span_label"><?php _e("Dimensions", "gpdealdomain"); ?>(cm) : </span> 
                                                        </td>
                                                        <td>
                                                            <span class="span_value">
                                                                <?php _e("abrev_length", "gpdealdomain"); ?>= <?php echo get_post_meta(get_the_ID(), 'length', true) ?>, <?php _e("abrev_width", "gpdealdomain"); ?>= <?php echo get_post_meta(get_the_ID(), 'width', true) ?>, <?php _e("abrev_height", "gpdealdomain"); ?>= <?php echo get_post_meta(get_the_ID(), 'height', true); ?>
                                                            </span>
                                                        </td>
                                                    </tr>

                                                    <tr>
                                                        <td>
                                                            <span class="span_label"><?php _e("Weight", "gpdealdomain"); ?>(kg) : </span> 
                                                        </td>
                                                        <td>
                                                            <span class="span_value">
                                                                <?php echo get_post_meta(get_the_ID(), 'weight', true) ?>
                                                            </span>
                                                        </td>
                                                    </tr>
                                                </table>
                                            </div>
                                        </div>
                                        <?php if (is_user_logged_in()): ?>
                                            <div class="extra content">
                                                <a  class="ui green button" href="<?php the_permalink(); ?>"><?php echo __("Details", "gpdealdomain") ?></a>
                                            </div>
                                        <?php endif ?>
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
        </div>
    </div>
</div>

