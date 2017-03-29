<?php 
$search_data = null;
if (isset($_SERVER['REQUEST_METHOD']) && $_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST["submit_search_unsatisfied_packages"]) && removeslashes(esc_attr(trim($_POST["submit_search_unsatisfied_packages"] = "yes")))) {
        $package_type = array_map('intval', isset($_POST['package_type']) ? $_POST['package_type'] : array());
        $start_city = removeslashes(esc_attr(trim($_POST['start_city'])));
        $start_date = removeslashes(esc_attr(trim($_POST['start_date'])));
        $destination_city = removeslashes(esc_attr(trim($_POST['destination_city'])));
        $destination_date = removeslashes(esc_attr(trim($_POST['destination_date'])));
        $search_data = array(
            'package_type' => $package_type,
            'start_city' => $start_city,
            'start_date' => $start_date,
            'destination_city' => $destination_city,
            'destination_date' => $destination_date
        );
}
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
                                ?>
                                <div class="column">
                                    <div class="ui fluid card">
                <!--                        <i class="huge travel icon center aligned"></i>-->
                                        <div class="content">
                                            <img class="ui avatar image" src="<?php echo get_template_directory_uri() ?>/assets/images/avatar.png"> <strong>Expéditeur : </strong><a ><?php echo get_the_author_meta('user_login'); ?></a>
                                        </div>
                                        <div class="content">
                                            <div class="ui form description">
                                                <div class="inline field">
                                                    <label>Départ : </label> 
                                                    <span>
                                                        <?php echo get_post_meta(get_the_ID(), 'departure-city-package', true) ?>(<?php echo get_post_meta(get_the_ID(), 'departure-country-package', true) ?>) <?php echo date('d-m-Y', strtotime(get_post_meta(get_the_ID(), 'date-of-departure-package', true))); ?>
                                                    </span>
                                                </div>
                                                <div class="inline field">
                                                    <label>Destination : </label> 
                                                    <span>
                                                        <?php echo get_post_meta(get_the_ID(), 'destination-city-package', true) ?>(<?php echo get_post_meta(get_the_ID(), 'destination-country-package', true) ?>) <?php echo date('d-m-Y', strtotime(get_post_meta(get_the_ID(), 'arrival-date-package', true))); ?>
                                                    </span>
                                                </div>

                                                <div class="inline field">
                                                    <label>Objet : </label> 
                                                    <span>
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
                                        <div class="extra content">
                                            <a class="ui fluid green button"><?php echo __("Selectionner", "gpdealdomain") ?></a>
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
                                       Nous n'avons trouvé aucune expédition valide correspondant à vos critères de recherche.
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
            $packages = new WP_Query(getWPQueryArgsForUnsatifiedSendPackagesWithCanInterest($search_data, $exclude_ids));
            if ($packages->have_posts()) {
                ?>
                <div class="ui content_packages_transports fluid card">
                    <div class="content center aligned">
                        <div class="header"><?php echo __('Les expéditions non satisfaites pouvant vous intéresser'); ?></div>
                    </div>
                    <div class="content content_packages_transports">

                        <div id='list_as_grid_content' class="ui three column doubling stackable grid">
                            <?php
                            while ($packages->have_posts()): $packages->the_post();
                                ?>
                                <div class="column">
                                    <div class="ui fluid card">
                <!--                        <i class="huge travel icon center aligned"></i>-->
                                        <div class="content">
                                            <img class="ui avatar image" src="<?php echo get_template_directory_uri() ?>/assets/images/avatar.png"> <strong>Expéditeur : </strong><a ><?php echo get_the_author_meta('user_login'); ?></a>
                                        </div>
                                        <div class="content">
                                            <div class="ui form description">
                                                <div class="inline field">
                                                    <label>Départ : </label> 
                                                    <span>
                                                        <?php echo get_post_meta(get_the_ID(), 'departure-city-package', true) ?>(<?php echo get_post_meta(get_the_ID(), 'departure-country-package', true) ?>) <?php echo date('d-m-Y', strtotime(get_post_meta(get_the_ID(), 'date-of-departure-package', true))); ?>
                                                    </span>
                                                </div>
                                                <div class="inline field">
                                                    <label>Destination : </label> 
                                                    <span>
                                                        <?php echo get_post_meta(get_the_ID(), 'destination-city-package', true) ?>(<?php echo get_post_meta(get_the_ID(), 'destination-country-package', true) ?>) <?php echo date('d-m-Y', strtotime(get_post_meta(get_the_ID(), 'arrival-date-package', true))); ?>
                                                    </span>
                                                </div>

                                                <div class="inline field">
                                                    <label>Objet : </label> 
                                                    <span>
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
                                        <div class="extra content">
                                            <a class="ui fluid green button"><?php echo __("Selectionner", "gpdealdomain") ?></a>
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

