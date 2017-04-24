<?php get_template_part('top-menu', get_post_format()); ?>
<div class="ui large borderless second-nav menu">
    <div class="ui container center aligned">
        <div class="center menu">
            <div class="item">
                <a href="<?php echo home_url('/') ?>" class="section"><?php echo get_page_by_path(__('accueil', 'gpdealdomain'))->post_title ?></a>
                <i class="right chevron icon divider"></i>
                <a href="<?php echo get_permalink(get_page_by_path(__('mon-compte', 'gpdealdomain'))) ?>" class="section"><?php echo get_page_by_path(__('mon-compte', 'gpdealdomain'))->post_title ?></a>
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
                    <div class="header"><?php echo __('Vos expéditions', 'gpdealdomain') ?></div>
                </div>
                <div class="content content_packages_transports">
                    <div id='list_as_grid_content' class="ui three column doubling stackable grid">
                        <?php
                        global $current_user;
                        $packages = new WP_Query(array('post_type' => 'package', 'post_per_page' => -1, "post_status" => 'publish', 'orderby' => 'post_date', 'order' => 'DESC', 'author' => $current_user->ID));
                        if ($packages->have_posts()) {
                            while ($packages->have_posts()): $packages->the_post();
                                $package_type_list = wp_get_post_terms(get_the_ID(), 'type_package', array("fields" => "all"));
                                //$carrier_id = get_post_meta(get_the_ID(), 'carrier-ID', true);
                                ?>
                                <div id="single_package_column<?php the_ID() ?>" class="column">
                                    <form id="single_package_content_form<?php the_ID() ?>" method="POST" action="<?php the_permalink() ?>">
                                        <div id="single_package_card<?php the_ID() ?>" class="ui fluid card">
                   
                                            <div class="content">
                                                <div class="ui form description">
                                                    <div class="inline field">
                                                        <span class="span_label">Départ : </span> 
                                                        <span class="span_value">
                                                            <?php echo get_post_meta(get_the_ID(), 'departure-city-package', true) ?> (<?php echo get_post_meta(get_the_ID(), 'departure-country-package', true) ?>), <?php echo date('d-m-Y', strtotime(get_post_meta(get_the_ID(), 'date-of-departure-package', true)));
                                                            ?>
                                                        </span>
                                                    </div>
                                                    <div class="inline field">
                                                        <span class="span_label">Destination : </span> 
                                                        <span class="span_value">
                                                            <?php echo get_post_meta(get_the_ID(), 'destination-city-package', true) ?> (<?php echo get_post_meta(get_the_ID(), 'destination-country-package', true) ?>), <?php echo date('d-m-Y', strtotime(get_post_meta(get_the_ID(), 'arrival-date-package', true)));
                                                            ?>
                                                        </span>
                                                    </div>

                                                    <?php if ($carrier_id): ?>
                                                        <!--                                                <div class="inline field">
                                                                                                                <label>Transporteur : </label> 
                                                                                                            <span>
                                                        <?php
                                                        echo get_user_by('id', $carrier_id)->user_firstname;
                                                        ?>
                                                                                                            </span>
                                                                                                        </div>
                                                                                                        <div class="inline field">
                                                                                                                <label>Type de transporteur : </label> 
                                                                                                            <span>
                                                        <?php
                                                        echo get_user_role_by_user_id($carrier_id);
                                                        ?>
                                                                                                            </span>
                                                                                                        </div>-->
                                                    <?php endif; ?>
                                                    <div class="inline field">
                                                        <span class="span_label"><?php echo __("Statut", "gpdealdomain"); ?> : </span> 
                                                        <span class="span_value">
                                                            <?php echo getPackageStatus(intval(get_post_meta(get_the_ID(), 'package-status', true))); ?>
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
                                                                Détails
                                                            </a>
                                                            <?php if (get_post_meta(get_the_ID(), 'package-status', true) != 3 && get_post_meta(get_the_ID(), 'package-status', true) != 4 && get_post_meta(get_the_ID(), 'package-status', true) != 5): ?>
                                                                <a href="<?php echo esc_url(add_query_arg(array('action' => 'edit'), the_permalink())) ?>" class="item">
                                                                    <i class="edit icon"></i>
                                                                    Modifier
                                                                </a>
<!--                                                                <a onclick="cancel_send_package(<?php the_ID() ?>)" class="item">
                                                                    <i class="trash icon"></i>
                                                                    Annuler
                                                                </a>-->
                                                            <?php endif ?>
                                                            <?php if (get_post_meta(get_the_ID(), 'carrier-ID', true) == -1 && get_post_meta(get_the_ID(), 'package-status', true) == 1): ?>
                                                                <a href="<?php echo esc_url(add_query_arg(array('package-id' => get_the_ID()), the_permalink(get_page_by_path(__('selectionner-les-offres-de-transport', 'gpdealdomain'))))) ?>" class="item">
                                                                    <i class="search icon"></i>
                                                                    Rechercher transporteurs
                                                                </a>
                                                            <?php endif ?>
                                                            <?php if (get_post_meta(get_the_ID(), 'package-status', true) == 2): ?>
                                                                <a onclick="fence_send_package(<?php the_ID() ?>)" class="item">
                                                                    <i class="checkmark icon"></i>
                                                                    Cloturer
                                                                </a>
                                                                <a href="<?php echo esc_url(add_query_arg(array('package-id' => get_the_ID()), the_permalink(get_page_by_path(__('mon-compte', 'gpdealdomain') . '/' . __('visualiser-les-contacts-des-transporteurs', 'gpdealdomain'))))) ?>" class="item">
                                                                    <i class="shipping icon"></i>
                                                                    Transporteurs en attente
                                                                </a>
                                                                <a href="<?php echo esc_url(add_query_arg(array('package-id' => get_the_ID()), the_permalink(get_page_by_path(__('selectionner-les-offres-de-transport', 'gpdealdomain'))))) ?>" class="item">
                                                                    <i class="search icon"></i>
                                                                    Rechercher à nouveau transporteurs
                                                                </a>
                                                            <?php endif ?>

                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                                <?php
                            endwhile;
                        }
                        wp_reset_postdata();
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <a  href="<?php echo get_permalink(get_page_by_path(__('mon-compte', 'gpdealdomain') . '/' . __('expeditions', 'gpdealdomain') . '/' . __('saisir', 'gpdealdomain'))) ?>" id="send_new_package_btn" class="float_button circular ui huge green icon button" data-tooltip="Expédier" data-position="top center" data-inverted="">
        <i class="write icon"></i>
    </a>
</div>

<?php include(locate_template('content-modal-confirmation-package.php'));