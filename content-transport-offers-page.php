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
                    <div class="header"><?php echo __('Vos offres de transport'); ?></div>
                </div>
                <div class="content content_packages_transports">
                    <table class="ui sortable celled table" style="display: none">
                        <thead>
                            <tr>
                                <th>Numéro</th>
                                <th>Type de courrier</th>
                                <th>Mode de transport </th>
                                <th>Depart</th>
                                <th>Destination</th>
                                <th>Date de depart </th>
                                <th>Date limite de proposition</th>
                                <th>Date d'arrivée</th>
                                <th>Coût</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            global $current_user;
                            $transport_offers = new WP_Query(array('post_type' => 'transport-offer', 'post_per_page' => -1, "post_status" => 'publish', 'orderby' => 'post_date', 'order' => 'DESC', 'author' => $current_user->ID));
                            if ($transport_offers->have_posts()) {
                                while ($transport_offers->have_posts()): $transport_offers->the_post();
                                    $package_type_list = wp_get_post_terms(get_the_ID(), 'type_package', array("fields" => "all"));
                                    $transport_method_list = wp_get_post_terms(get_the_ID(), 'transport-method', array("fields" => "all"));
                                    ?>
                                    <tr>
                                        <td><a href="<?php the_permalink() ?>"><?php the_title() ?></a></td>
                                        <td><?php
                                            $package_type_list_count = count($package_type_list);
                                            $i = 0;
                                            foreach ($package_type_list as $value) {
                                                if ($i < $count - 1) {
                                                    $val = $value->name . ', ';
                                                } else {
                                                    $val = $value->name;
                                                }
                                                echo $val;
                                            }
                                            ?></td>
                                        <td><?php
                                            $transport_method_list_count = count($transport_method_list);
                                            $j = 0;
                                            foreach ($transport_method_list as $value) {
                                                if ($j < $count - 1) {
                                                    $val = $value->name . ', ';
                                                } else {
                                                    $val = $value->name;
                                                }
                                                echo $val;
                                            }
                                            ?></td>
                                        <td><?php echo get_post_meta(get_the_ID(), 'departure-city-transport-offer', true) ?>(<?php echo get_post_meta(get_the_ID(), 'departure-country-transport-offer', true) ?>)</td>
                                        <td><?php echo get_post_meta(get_the_ID(), 'destination-city-transport-offer', true) ?>(<?php echo get_post_meta(get_the_ID(), 'destination-country-transport-offer', true) ?>)</td>
                                        <td><?php echo get_post_meta(get_the_ID(), 'date-of-departure-transport-offer', true) ?></td>
                                        <td><?php echo get_post_meta(get_the_ID(), 'deadline-of-proposition-transport-offer', true) ?></td>
                                        <td><?php echo get_post_meta(get_the_ID(), 'arrival-date-transport-offer', true) ?></td>
                                        <td><?php echo get_post_meta(get_the_ID(), 'price', true) ?><?php echo get_post_meta(get_the_ID(), 'currency', true) ?></td>
                                        <td>
                                            <div class="ui dropdown top left pointing item">
                                                <i class="ellipsis vertical icon"></i>
                                                <div class="menu">

                                                    <a href="<?php echo esc_url(add_query_arg(array('action' => 'show'), the_permalink())) ?>" class=" item">
                                                        <i class="unhide icon"></i>
                                                        Détails
                                                    </a>
                                                    <a href="<?php echo esc_url(add_query_arg(array('action' => 'edit'), the_permalink())) ?>" class="item">
                                                        <i class="edit icon"></i>
                                                        Modifier
                                                    </a>
                                                    <a href="<?php echo esc_url(add_query_arg(array('action' => 'evaluations'), the_permalink())) ?>" class="item">
                                                        <i class="star icon"></i>
                                                        Evaluations
                                                    </a>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                    <?php
                                endwhile;
                            }
                            wp_reset_postdata();
                            ?>
                        </tbody>
                    </table>

                    <div id='list_as_grid_content' class="ui three column doubling stackable grid">
                        <?php
                        global $current_user;
                        $transport_offers = new WP_Query(array('post_type' => 'transport-offer', 'post_per_page' => -1, "post_status" => 'publish', 'orderby' => 'post_date', 'order' => 'DESC', 'author' => $current_user->ID));
                        if ($transport_offers->have_posts()) {
                            while ($transport_offers->have_posts()): $transport_offers->the_post();
                                $package_type_list = wp_get_post_terms(get_the_ID(), 'type_package', array("fields" => "all"));
                                $transport_method_list = wp_get_post_terms(get_the_ID(), 'transport-method', array("fields" => "all"));
                                ?>
                                <div class="column">
                                    <div class="ui fluid card">
                <!--                        <i class="huge travel icon center aligned"></i>-->
                                        <!--                                        <div class="content">
                                                                                    <a href="<?php the_permalink() ?>" class="header"><?php the_title() ?></a>
                                                                                </div>-->
                                        <div class="content">
                                            <div class="ui form description">
                                                <div class="inline field">
                                                    <label>Départ : </label> 
                                                    <span>
                                                        <?php echo get_post_meta(get_the_ID(), 'departure-city-transport-offer', true) ?>(<?php echo get_post_meta(get_the_ID(), 'departure-country-transport-offer', true) ?>) <?php echo date('d-m-Y', strtotime(get_post_meta(get_the_ID(), 'date-of-departure-transport-offer', true)));
                                                        ?>
                                                    </span>
                                                </div>
                                                <div class="inline field">
                                                    <label>Destination : </label> 
                                                    <span>
                                                        <?php echo get_post_meta(get_the_ID(), 'destination-city-transport-offer', true) ?>(<?php echo get_post_meta(get_the_ID(), 'destination-country-transport-offer', true) ?>) <?php echo date('d-m-Y', strtotime(get_post_meta(get_the_ID(), 'arrival-date-transport-offer', true))); ?>
                                                    </span>
                                                </div>

                                                <div class="inline field">
                                                    <label>Date de limite : </label> 
                                                    <span>
                                                        <?php echo date('d-m-Y', strtotime(get_post_meta(get_the_ID(), 'deadline-of-proposition-transport-offer', true))); ?>
                                                    </span>
                                                </div>

                                                <!--                                                <div class="inline field">
                                                                                                    <label>Transporteur : </label> 
                                                                                                    <span>
                                                <?php echo get_the_author_meta('user_email'); ?>
                                                                                                    </span>
                                                                                                </div>-->
                                                <!--                                                <div class="inline field">
                                                                                                    <label>Type de transporteur : </label> 
                                                                                                    <span>
                                                <?php
                                                echo get_user_role_by_user_id(get_the_author_meta('ID'));
                                                ?>
                                                                                                    </span>
                                                                                                </div>-->
                                                <div class="inline field">
                                                    <label><?php echo __("Statut", "gpdealdomain"); ?> : </label> 
                                                    <span>
                                                        <?php echo getTransportStatus(intval(get_post_meta(get_the_ID(), 'transport-status', true))); ?>
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
                                                        <?php if (get_post_meta(get_the_ID(), 'transport-status', true) != 2 || get_post_meta(get_the_ID(), 'package-status', true) != 3): ?>
                                                        <a href="<?php echo esc_url(add_query_arg(array('action' => 'edit'), the_permalink())) ?>" class="item">
                                                            <i class="edit icon"></i>
                                                            Modifier
                                                        </a>
<!--                                                        <a onclick="cancel_transport_offer(<?php the_ID() ?>)" class="item">
                                                            <i class="trash icon"></i>
                                                            Annuler
                                                        </a>-->
                                                        <?php endif ?>
                                                        <a href="<?php echo esc_url(add_query_arg(array('action' => 'evaluations'), the_permalink())) ?>" class="item">
                                                            <i class="star icon"></i>
                                                            Avis/Evaluations
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
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
    <a  href="<?php echo get_permalink(get_page_by_path(__('mon-compte', 'gpdealdomain') . '/' . __('offres-de-transport', 'gpdealdomain') . '/' . __('saisir', 'gpdealdomain'))) ?>" id="add_transport_send_offer_btn" class="float_button circular ui huge green icon button" data-tooltip="Nouvel offre de transport" data-position="top center" data-inverted="">
        <i class="write icon"></i>
    </a>
</div>

