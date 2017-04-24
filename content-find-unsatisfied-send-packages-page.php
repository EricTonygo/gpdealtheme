<?php 

get_template_part('top-menu', get_post_format()); ?>
<div class="ui large borderless second-nav menu">
    <div class="ui container center aligned">
        <div class="center menu">
            <div class="item">
                <a href="<?php echo home_url('/') ?>" class="section"><?php echo get_page_by_path(__('accueil', 'gpdealdomain'))->post_title ?></a>                
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
            <div class="ui content_packages_transports fluid card">
                <div class="content center aligned">
                    <div class="header"><?php echo __('Les expéditions non satisfaites correspondantes'); ?></div>
                </div>
                <div class="content content_packages_transports">
                    <?php
                    $packages = new WP_Query(getWPQueryArgsForUnsatifiedSendPackages($search_data));
                    $exclude_ids = array();
                    if ($packages->have_posts()) {
                        ?>
                        <div id='list_as_grid_content' class="ui three column doubling stackable grid">
                            <?php
                            while ($packages->have_posts()): $packages->the_post();
                                $exclude_ids[] = get_the_ID();
                                $post_author = get_post_field('post_author', get_the_ID());
                                $carrier_name = $current_user->ID == $post_author ? __("Vous", "gpdealdomain") : get_the_author_meta('user_login');
                                $profile_picture_id = get_user_meta($post_author, 'profile-picture-ID', true) ? get_user_meta($post_author, 'profile-picture-ID', true) : get_user_meta($post_author, 'company-logo-ID', true);
                                ?>
                                <div class="column">
                                    <div class="ui fluid card">
                <!--                        <i class="huge travel icon center aligned"></i>-->
                                        <div class="content">
                                            <img  class="ui avatar image" <?php if ($profile_picture_id): ?> src= "<?php echo wp_get_attachment_url($profile_picture_id); ?>" <?php else: ?> src="<?php echo get_template_directory_uri() ?>/assets/images/avatar.png"<?php endif ?>> <span class='profile_name'><?php echo $carrier_name; ?></span>
                                        </div>
                                        <div class="content">
                                            <div class="ui form description">
                                                <div class="inline field">
                                                    <span class="span_label">Départ : </span> 
                                                    <span class="span_value">
                                                        <?php echo get_post_meta(get_the_ID(), 'departure-city-package', true) ?>(<?php echo get_post_meta(get_the_ID(), 'departure-country-package', true) ?>) <?php echo date('d-m-Y', strtotime(get_post_meta(get_the_ID(), 'date-of-departure-package', true))); ?>
                                                    </span>
                                                </div>
                                                <div class="inline field">
                                                    <span class="span_label">Destination : </span> 
                                                    <span class="span_value">
                                                        <?php echo get_post_meta(get_the_ID(), 'destination-city-package', true) ?>(<?php echo get_post_meta(get_the_ID(), 'destination-country-package', true) ?>) <?php echo date('d-m-Y', strtotime(get_post_meta(get_the_ID(), 'arrival-date-package', true))); ?>
                                                    </span>
                                                </div>

                                                <div class="inline field">
                                                    <span class="span_label">Objet : </span> 
                                                    <span class="span_value">
                                                        <?php
                                                        $package_type_list = wp_get_post_terms(get_the_ID(), 'type_package', array("fields" => "names"));
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
                                       Aucune expédition non satisfaite ne correspond à vos critères.
                                    </div>
                                </div>
                            </div>
                            <!--<h2 class="header">Aucun expédition non satisfaite ne correspond à vos critères de recherches.</h2>-->
                        </div>
                        <?php
                    }
                    wp_reset_postdata();
                    ?>
                </div>
            </div>
            <?php
            $packages_wci = new WP_Query(getWPQueryArgsForUnsatifiedSendPackagesWithCanInterest($search_data, $exclude_ids));
            if ($packages_wci->have_posts()) {
                ?>
                <div class="ui content_packages_transports fluid card">
                    <div class="content center aligned">
                        <div class="header"><?php echo __('Les expéditions non satisfaites pouvant vous intéresser'); ?></div>
                    </div>
                    <div class="content content_packages_transports">

                        <div id='list_as_grid_content' class="ui three column doubling stackable grid">
                            <?php
                            while ($packages_wci->have_posts()): $packages_wci->the_post();
                            
                                ?>
                                <div class="column">
                                    <div class="ui fluid card">
                                        <?php
                                            $post_author = get_post_field('post_author', get_the_ID());
                                            $carrier_name = $current_user->ID == $post_author ? __("Vous", "gpdealdomain") : get_the_author_meta('user_login');
                                            $profile_picture_id = get_user_meta($post_author, 'profile-picture-ID', true) ? get_user_meta($post_author, 'profile-picture-ID', true) : get_user_meta($post_author, 'company-logo-ID', true);
                                            ?>
                                        <div class="content">
                                            <img  class="ui avatar image" <?php if ($profile_picture_id): ?> src= "<?php echo wp_get_attachment_url($profile_picture_id); ?>" <?php else: ?> src="<?php echo get_template_directory_uri() ?>/assets/images/avatar.png"<?php endif ?>> <span class='profile_name'><?php echo $carrier_name; ?></span>
                                        </div>
                                        <div class="content">
                                            <div class="ui form description">
                                                <div class="inline field">
                                                    <span class="span_label">Départ : </span> 
                                                    <span class="span_value">
                                                        <?php echo get_post_meta(get_the_ID(), 'departure-city-package', true) ?> (<?php echo get_post_meta(get_the_ID(), 'departure-country-package', true) ?>), <?php echo date('d-m-Y', strtotime(get_post_meta(get_the_ID(), 'date-of-departure-package', true))); ?>
                                                    </span>
                                                </div>
                                                <div class="inline field">
                                                    <span class="span_label">Destination : </span> 
                                                    <span class="span_value">
                                                        <?php echo get_post_meta(get_the_ID(), 'destination-city-package', true) ?> (<?php echo get_post_meta(get_the_ID(), 'destination-country-package', true) ?>), <?php echo date('d-m-Y', strtotime(get_post_meta(get_the_ID(), 'arrival-date-package', true))); ?>
                                                    </span>
                                                </div>

                                                <div class="inline field">
                                                    <span class="span_label">Objet : </span> 
                                                    <span class="span_value">
                                                        <?php
                                                        $package_type_list = wp_get_post_terms(get_the_ID(), 'type_package', array("fields" => "names"));
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
                                            </div>
                                        </div>

                                    </div>
                                </div>
                                <?php
                            endwhile;
                            ?>
                        </div>                   
                    </div>
                </div>
            <?php } wp_reset_postdata(); ?>
        </div>
    </div>
</div>

