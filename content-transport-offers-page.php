<?php 
global $current_user;
get_template_part('top-menu', get_post_format()); ?>
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


                    <div id='list_as_grid_content' class="ui three column doubling stackable grid">
                        <?php
                        global $current_user;
                        $transport_offers = new WP_Query(array('post_type' => 'transport-offer', 'post_per_page' => -1, "post_status" => 'publish', 'orderby' => 'post_date', 'order' => 'DESC', 'author' => $current_user->ID));
                        if ($transport_offers->have_posts()) {
                            while ($transport_offers->have_posts()): $transport_offers->the_post();
                                $transport_offer_id = get_the_ID();
                                $package_type_list = wp_get_post_terms($transport_offer_id, 'type_package', array("fields" => "all"));
                                $transport_method_list = wp_get_post_terms($transport_offer_id, 'transport-method', array("fields" => "all"));
                                ?>
                                <div class="column">
                                    <div class="ui fluid card">
                                        <?php
                                        $post_author = get_post_field('post_author', $transport_offer_id);
                                        $carrier_name = $current_user->ID == $post_author ? __("Vous", "gpdealdomain") : get_the_author_meta('user_login');
                                        $profile_picture_id = get_user_meta($post_author, 'profile-picture-ID', true) ? get_user_meta($post_author, 'profile-picture-ID', true) : get_user_meta($post_author, 'company-logo-ID', true);
                                        ?>
<!--                                        <div class="content">
                                            
                                            <img  class="ui avatar image" <?php if ($profile_picture_id): ?> src= "<?php echo wp_get_attachment_url($profile_picture_id); ?>" <?php else: ?> src="<?php echo get_template_directory_uri() ?>/assets/images/avatar.png"<?php endif ?>> <a ><?php echo $carrier_name; ?></a> (<strong><?php echo get_user_role_by_user_id($post_author) ?></strong>)
                                        </div>-->
                                        <div class="content">
                                            <div class="ui form description">
                                                <div class="inline field">
                                                    <span class="span_label">Départ : </span>
                                                    <span class="span_value">
                                                        <?php echo get_post_meta($transport_offer_id, 'departure-city-transport-offer', true) ?> (<?php echo get_post_meta($transport_offer_id, 'departure-country-transport-offer', true) ?>), <?php echo date('d-m-Y', strtotime(get_post_meta($transport_offer_id, 'date-of-departure-transport-offer', true))); ?>
                                                    </span>
                                                </div>
                                                <div class="inline field"> 
                                                    <span class="span_label">Destination : </span>
                                                    <span class="span_value">
                                                        <?php echo get_post_meta($transport_offer_id, 'destination-city-transport-offer', true) ?> (<?php echo get_post_meta($transport_offer_id, 'destination-country-transport-offer', true) ?>), <?php echo date('d-m-Y', strtotime(get_post_meta($transport_offer_id, 'arrival-date-transport-offer', true))); ?>
                                                    </span>
                                                </div>

                                                <div class="inline field">
                                                   <span class="span_label">Date limite<!-- <i class="help circle green link icon deadline_transport_offer_help_link"></i>--> : </span> 
                                                    <span class="span_value">
                                                        <?php echo date('d-m-Y', strtotime(get_post_meta($transport_offer_id, 'deadline-of-proposition-transport-offer', true))); ?>
                                                    </span>
                                                </div>

                                                <div class="inline field">
                                                    <span class="span_label"><?php echo __("Statut", "gpdealdomain"); ?> : </span> 
                                                    <span class="span_value">
                                                        <?php echo getTransportStatus(intval(get_post_meta($transport_offer_id, 'transport-status', true))); ?>
                                                    </span>
                                                </div>
                                                <span class="ui blue right ribbon label">
                                                    <?php echo get_post_meta($transport_offer_id, 'price', true) . " " . get_post_meta($transport_offer_id, 'currency', true); ?>
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
                                                                <a href="<?php echo esc_url(add_query_arg(array('action' => 'evaluations'), get_permalink($transport_offer_id))) ?>">
                                                                    <?php echo $stat_value["vote_count"]; ?> avis
                                                                </a>
                                                            </div>
                                                        </div>
                                                    <?php endforeach; ?>
                                                <?php else: ?>
                                                    <span id="<?php echo $transport_offer_id; ?>"  ><i class="star icon"></i> <?php echo __("Aucun avis", "gpdealdomain"); ?></span>
                                                <?php endif ?>
                                            </div>
                                            <div class="right floated">
                                                <div class="ui dropdown top left pointing item">
                                                    <i class="ellipsis vertical icon"></i>
                                                    <div class="menu">

                                                        <a href="<?php echo esc_url(add_query_arg(array('action' => 'show'), get_permalink($transport_offer_id))) ?>" class=" item">
                                                            <i class="unhide icon"></i>
                                                            Détails
                                                        </a>
                                                        <?php if ($statistics["Evaluation globale"]["vote_count"] == 0 && (get_post_meta($transport_offer_id, 'transport-status', true) != 2 || get_post_meta($transport_offer_id, 'package-status', true) != 3)): ?>
                                                            <a href="<?php echo esc_url(add_query_arg(array('action' => 'edit'), get_permalink($transport_offer_id))) ?>" class="item">
                                                                <i class="edit icon"></i>
                                                                Modifier
                                                            </a>
            <!--                                                        <a onclick="cancel_transport_offer(<?php echo $transport_offer_id; ?>)" class="item">
                                                                <i class="trash icon"></i>
                                                                Annuler
                                                            </a>-->
                                                        <?php endif ?>
                                                        <a href="<?php echo esc_url(add_query_arg(array('action' => 'evaluations'), get_permalink($transport_offer_id))) ?>" class="item">
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

