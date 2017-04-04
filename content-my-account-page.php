<?php get_template_part('top-menu', get_post_format()); ?>
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

        <div class="twelve wide column">
            <div id="content_search_carrier_form" class="ui fluid card">
                <div class="content center aligned">
                    <div class="header">Expéditions encours</div>
                </div>
                <div class="content">
                    <div id='list_as_grid_content' class="ui three column doubling stackable grid">
                        <?php
                        global $current_user;
                        $packages = new WP_Query(array('post_type' => 'package', 'post_per_page' => -1, "post_status" => 'publish', 'orderby' => 'post_date', 'order' => 'DESC', 'author' => $current_user->ID, 'meta_query' => array(array('key' => 'package-status', 'value' => 2, 'compare' => '='))));
                        if ($packages->have_posts()) {
                            while ($packages->have_posts()): $packages->the_post();
                                $package_type_list = wp_get_post_terms(get_the_ID(), 'type_package', array("fields" => "all"));
                                ?>
                                <div id="single_package_column<?php the_ID() ?>" class="column">
                                    <form id="single_package_content_form<?php the_ID() ?>" method="POST" action="<?php the_permalink() ?>">
                                        <div class="ui fluid card">
                                            <div class="content">
                                                <div class="ui form description">
                                                    <div class="inline field">
                                                        <label>Départ : </label> 

                                                        <span >
                                                            <?php echo get_post_meta(get_the_ID(), 'departure-city-package', true) ?>(<?php echo get_post_meta(get_the_ID(), 'departure-country-package', true) ?>)
                                                        </span>
                                                    </div>
                                                    <div class="inline field">
                                                        <label>Départ : </label> 
                                                        <span>
                                                            <?php echo get_post_meta(get_the_ID(), 'destination-city-package', true) ?>(<?php echo get_post_meta(get_the_ID(), 'destination-country-package', true) ?>)
                                                        </span>
                                                    </div>
                                                    <div class="inline field">
                                                        <label>Date de départ : </label> 
                                                        <span>
                                                            <?php echo date('d-m-Y', strtotime(get_post_meta(get_the_ID(), 'date-of-departure-package', true)));
                                                            ?>
                                                        </span>
                                                    </div>
                                                    <div class="inline field">
                                                        <label>Date d'arrivée : </label> 
                                                        <span>
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
                                                                Détails
                                                            </a>
                                                            <?php if (get_post_meta(get_the_ID(), 'package-status', true) != 3 && get_post_meta(get_the_ID(), 'package-status', true) != 4 && get_post_meta(get_the_ID(), 'package-status', true) != 5): ?>
                                                                <a href="<?php echo esc_url(add_query_arg(array('action' => 'edit'), the_permalink())) ?>" class="item">
                                                                    <i class="edit icon"></i>
                                                                    Modifier
                                                                </a>
            <!--                                                            <a onclick="cancel_send_package(<?php the_ID() ?>)" class="item">
                                                                    <i class="trash icon"></i>
                                                                    Annuler
                                                                </a>-->
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
        <div class="four wide column">
            <div class="ui fluid card">
                <div class="content center aligned">
                    <a href="<?php echo get_permalink(get_page_by_path(__('mon-compte', 'gpdealdomain') . '/' . __('expeditions', 'gpdealdomain') . '/' . __('saisir', 'gpdealdomain'))) ?>" class="ui green fluid button" ><?php echo __('Expédier courrier/colis', 'gpdealdomain') ?></a>
                </div>
            </div>
            <div class="ui fluid card">
                <div class="content center aligned">
                    <a href="<?php echo get_permalink(get_page_by_path(__('mon-compte', 'gpdealdomain') . '/' . __('offres-de-transport', 'gpdealdomain') . '/' . __('saisir', 'gpdealdomain'))) ?>" class="ui green fluid button" ><?php echo __('Transporter courrier/colis', 'gpdealdomain') ?></a>
                </div>
            </div>

            <div id="" class="ui fluid card">
                <div class="content">
                    <div class="ui list">
                        <div class="header"><strong>Transactions en cours</strong></div>
                        <a class="item"><i class="minus icon"></i><div class="content">Expéditions </div></a>
                        <a class="item" href='<?php echo get_permalink(get_page_by_path(__('mon-compte', 'gpdealdomain') . '/' . __('offres-de-transport', 'gpdealdomain'))) ?>'><i class="minus icon"></i><div class="content">Propositions de transport </div></a>
                    </div>
                </div>
            </div>
            <div id="" class="ui fluid card">
                <div class="content">
                    <div class="ui list">
                        <div class="header"><strong>Transactions terminées</strong></div>
                        <a class="item"><i class="minus icon"></i><div class="content">Consulter/Repondre </div></a>
                        <a class="item"><i class="minus icon"></i><div class="content">Evaluation </div></a>
                    </div>
                </div>
            </div>
            <div id="card_pub_left" class="ui fluid card">
                <div class="content">
                    <div class="ui list">
                        <div class="header"><strong>Dernières informations sur le transport</strong></div>
                        <div class="item"><i class="checkmark icon"></i><div class="content">.... </div></div>

                    </div>
                    <div class="ui list">
                        <div class="header"><strong>Outils & Guide pour réussir son expédition ou transport de colis</strong></div>
                        <div class="item"><i class="checkmark icon"></i><div class="content">Guide expédition, guide transport </div></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
include(locate_template('content-modal-confirmation-package.php'));
