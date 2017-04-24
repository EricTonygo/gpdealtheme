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
                    <div class="header"><?php echo __("Les transporteurs de votre expédition N°: ", "gpdealdomain") . " "; ?><a href="<?php the_permalink($package_id) ?>"><?php echo get_post_field('post_title', $package_id); ?></a></div>
                </div>
                <div class="content content_packages_transports">
                    <?php if (is_array($selected_transport_offers) && !empty($selected_transport_offers)) : ?>
                        <div id='list_as_grid_content' class="ui three column doubling stackable grid">
                            <?php
                            global $current_user;
                            $transport_offers = new WP_Query(array('post_type' => 'transport-offer', 'post_per_page' => -1, "post_status" => 'publish', 'orderby' => 'post_date', 'order' => 'DESC', 'post__in' => $selected_transport_offers));
                            if ($transport_offers->have_posts()) {
                                while ($transport_offers->have_posts()): $transport_offers->the_post();
                                    $transport_offer_id = get_the_ID();
                                    ?>
                                    <div id="selected_transport_offer_column<?php echo $transport_offer_id; ?>" class="column">
                                        <div id="selected_transport_offer_card<?php echo $transport_offer_id; ?>" class="ui fluid card">
                                            <?php
                                            $post_author = get_post_field('post_author', $transport_offer_id);
                                            $carrier_name = $current_user->ID == $post_author ? __("Vous", "gpdealdomain") : get_the_author_meta('user_login');
                                            $profile_picture_id = get_user_meta($post_author, 'profile-picture-ID', true) ? get_user_meta($post_author, 'profile-picture-ID', true) : get_user_meta($post_author, 'company-logo-ID', true);
                                            ?>
                                            <div class="content">
                                                <?php
                                                $statistics = getTotalStatistiticsEvaluationsOfCarrier($post_author);
                                                wp_reset_postdata();
                                                ?>
                                                <div class="right floated meta">
                                                    <?php if ($statistics["Evaluation globale"]["vote_count"] > 0): ?>
                                                        <?php
                                                        foreach ($statistics as $stat_key => $stat_value):
                                                            ?>
                                                            <div class="ui form">
                                                                <div class="field disable">
                                                                    <span class="ui mini star rating" data-rating="<?php echo $stat_value["weighted_average"]; ?>" data-max-rating="5"></span>
                                                                    <a id="<?php echo $transport_offer_id ?>" href="<?php echo esc_url(add_query_arg(array('carrier_id' => $post_author), the_permalink(get_page_by_path(__('avis-et-evaluations', 'gpdealdomain'))))); ?>" class="show_reviews_evaluations">
                                                                        <?php echo $stat_value["vote_count"]; ?> avis
                                                                    </a>
                                                                </div>
                                                            </div>
                                                        <?php endforeach; ?>
                                                    <?php else: ?>
                                                        <span id="<?php echo $transport_offer_id; ?>"  ><i class="star icon"></i> <?php echo __("Aucun avis", "gpdealdomain"); ?></span>
                                                    <?php endif ?>
                                                </div>
                                                <img  class="ui avatar image" <?php if ($profile_picture_id): ?> src= "<?php echo wp_get_attachment_url($profile_picture_id); ?>" <?php else: ?> src="<?php echo get_template_directory_uri() ?>/assets/images/avatar.png"<?php endif ?>><span class='profile_name'><?php echo $carrier_name; ?></span> (<strong><?php echo get_user_role_by_user_id($post_author) ?></strong>)
                                            </div>
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
                                                        <span class="span_label">Date de limite : </span> 
                                                        <span class="span_value">
                                                            <?php echo date('d-m-Y', strtotime(get_post_meta($transport_offer_id, 'deadline-of-proposition-transport-offer', true))); ?>
                                                        </span>
                                                    </div>

                                                    <div class="inline field">
                                                        <span class="span_label">Coût du transport : </span> 
                                                        <span class="span_value">
                                                            <?php echo get_post_meta($transport_offer_id, 'price', true) . " " . get_post_meta($transport_offer_id, 'currency', true); ?>
                                                        </span>
                                                    </div>
                                                    <div class="inline field">
                                                        <span class="span_label">Email : </span> 
                                                        <span class="span_value">
                                                            <?php echo get_the_author_meta('user_email') ?>
                                                        </span>
                                                    </div>
                                                    <?php $roles = get_user_roles_by_user_id($post_author); ?>
                                                    <?php if (in_array("particular", $roles)): ?>
                                                        <div class="inline field">
                                                            <span class="span_label">Téléphone : </span> 
                                                            <span class="span_value">
                                                                <?php echo get_user_meta($post_author, 'mobile-phone-number', true); ?>
                                                            </span>
                                                        </div>
                                                        <div class="inline field">
                                                            <span class="span_label">Nom : </span> 
                                                            <span class="span_value">
                                                                <?php echo get_the_author_meta('user_lastname'); ?>
                                                            </span>
                                                        </div>
                                                        <div class="inline field">
                                                            <span class="span_label">Prénom : </span> 
                                                            <span class="span_value">
                                                                <?php echo get_the_author_meta('user_firstname'); ?>
                                                            </span>
                                                        </div>
                                                    <?php elseif (in_array("enterprise", $roles) || in_array("professional", $roles)): ?>
                                                        <div class="inline field">
                                                            <span class="span_label">Téléphone : </span> 
                                                            <span class="span_value">
                                                                <?php echo get_user_meta($user_id, 'home-phone-number', true); ?>
                                                            </span>
                                                        </div>
                                                        <div class="inline field">
                                                            <span class="span_label">Nom de l'entreprise : </span> 
                                                            <span class="span_value">
                                                                <?php echo get_user_meta($post_author, 'company-name', true); ?>
                                                            </span>
                                                        </div>
                                                    <?php endif ?>
                                                    <div class="inline field">
                                                        <span class="span_label">Objet(s) : </span> 
                                                        <span class="span_value">
                                                            <?php
                                                            $package_type_list = wp_get_post_terms($transport_offer_id, 'type_package', array("fields" => "names"));
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
                                                    <div class="inline field">
                                                        <span class="span_label">Mode de transport : </span> 
                                                        <span class="span_value">
                                                            <?php
                                                            $tranport_method_list = wp_get_post_terms($transport_offer_id, 'transport-method', array("fields" => "names"));
                                                            $tranport_method_list_count = count($tranport_method_list);
                                                            $i = 0;
                                                            foreach ($tranport_method_list as $name) :
                                                                ?>
                                                                <?php if ($i < $tranport_method_list_count - 1) : ?>
                                                                    <span><?php echo $name; ?>, </span>
                                                                <?php else: ?>
                                                                    <span><?php echo $name; ?></span>
                                                                <?php endif ?>
                                                                <?php
                                                                $i++;
                                                            endforeach
                                                            ?>
                                                        </span>
                                                    </div>

                                                </div>
                                            </div>
                                            <div class="extra content">

                                                <div class="ui two column wide doubling stackable grid">
                                                    <div class="column">
                                                        <form id="close_transport_offer_form<?php echo $transport_offer_id; ?>"  method="POST" action="<?php echo get_permalink($transport_offer_id) ?> ">
                                                            <input type="hidden" value="close" name="action" >
                                                            <input type="hidden" value="<?php echo $transport_offer_id; ?>" name="transport_offer_id" >
                                                            <input type="hidden" value="<?php echo $package_id; ?>" name="package_id" >
                                                            <a id="close_transport_offer_btn<?php echo $transport_offer_id; ?>" onclick="close_transport_offer(<?php echo $transport_offer_id; ?>)" class="ui icon fluid red button">
                                                                <i class="close icon"></i>
                                                                Fermer
                                                            </a>
                                                        </form>
                                                    </div>
                                                    <div class="column">
                                                        <a id="evaluate_transport_offer_btn<?php echo $transport_offer_id; ?>" href="<?php echo esc_url(add_query_arg(array('action' => 'evaluate', 'package_id' => $package_id), get_permalink($transport_offer_id))) ?>" class="ui icon fluid blue button">
                                                            <i class="star icon"></i>
                                                            Evaluer
                                                        </a>
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
                    <?php else: ?>
                        <div class="">
                            <div class="ui warning message">
                                <div class="content">
                                    <div class="header" style="font-weight: normal;">
                                        Aucun transporteur selectionné pour le moment.
                                    </div>
                                </div>
                            </div>
                            <!--<h2 class="header">Aucune offre ne correspond à vos critères de recherches.</h2>-->
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</div>

<div id="confirm_close_transport_offer" class="ui small modal">
    <i class="close icon"></i>
    <div class="header">
        Confirmation de la fermeture de la transaction
    </div>
    <div class="content">
        <p>Vous êtes sur le point de mettre un terme à la transaction avec ce transporteur. </p>
        <p>Voulez-vous vraiment continuer ?</p>
    </div>
    <div class="actions">
        <div class="ui red deny button">
            Non
        </div>
        <div id="execute_close_transport_offer"  class="ui green right labeled icon button">
            Oui
            <i class="checkmark icon"></i>
        </div>
    </div>
</div>

