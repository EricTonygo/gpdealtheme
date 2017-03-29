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

        <div class="wide column">
<!--            <div id='show_package_infos' class="ui signup_contenair basic segment container">
                <div  class="ui fluid card">
                    <div class="content center aligned">
                        <div class="header"><?php echo __("Les informations sur l'éxpédition"); ?></div>
                    </div>
                    <div class="content">
                        <div class="ui form">
                            <h4 class="ui dividing header">DEPART </h4>
                            <div class="four wide fields">
                                <div class="field">
                                    <label>Pays </label>
                                    <span><?php echo get_post_meta($package_id, 'departure-country-package', true); ?></span>
                                </div>
                                <div class="field">
                                    <label>Région/Etat </label>
                                    <span><?php echo get_post_meta($package_id, 'departure-state-package', true); ?></span>
                                </div>
                                <div class="field">
                                    <label>Ville </label>
                                    <span><?php echo get_post_meta($package_id, 'departure-city-package', true); ?></span>
                                </div>
                                <div class="field">
                                    <label>Date</label>
                                    <span><?php echo date('d-m-Y', strtotime(get_post_meta($package_id, 'date-of-departure-package', true))); ?></span>
                                </div>   
                            </div>

                            <h4 class="ui dividing header">DESTINATION </h4>
                            <div class="four wide fields">
                                <div class="field">
                                    <label>Pays </label>
                                    <span><?php echo get_post_meta($package_id, 'destination-country-package', true); ?></span>
                                </div>
                                <div class="field">
                                    <label>Région/Etat </label>
                                    <span><?php echo get_post_meta($package_id, 'destination-state-package', true); ?></span>
                                </div>
                                <div class="field">
                                    <label>Ville </label>
                                    <span><?php echo get_post_meta($package_id, 'destination-city-package', true); ?></span>
                                </div>
                                <div class="field">
                                    <label>Date</label>
                                    <span><?php echo date('d-m-Y', strtotime(get_post_meta($package_id, 'arrival-date-package', true))); ?></span>
                                </div>   
                            </div>
                            <h4 class="ui dividing header">INFORMATIONS SUR LE COURRIER/COLIS</h4>
                            <div class="fields">
                                <div class="four wide field">
                                    <label>Type :</label>
                                </div>
                                <div class="twelve wide field">
                                    <div class="inline fields">
                                        <div class="field">
                                            <?php
                                            $package_type_list = wp_get_post_terms($package_id, 'type_package', array("fields" => "names"));
                                            $package_type_list_count = count($package_type_list);
                                            $j = 0;
                                            foreach ($package_type_list as $name) :
                                                ?>
                                                <?php if ($j < $package_type_list_count - 1) : ?>
                                                    <span><?php echo $name; ?>,</span>
                                                <?php else: ?>
                                                    <span><?php echo $name; ?></span>
                                                <?php endif ?>
                                                <?php
                                                $j++;
                                            endforeach
                                            ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="fields">
                                <div class="four wide field">
                                    <label>Contenu :</label>
                                </div>
                                <div class="twelve wide field">
                                    <div class="inline fields">
                                        <div class="field">
                                            <?php
                                            $portable_object_list = wp_get_post_terms($package_id, 'portable-object', array("fields" => "names"));
                                            $portable_object_list_count = count($portable_object_list);
                                            $i = 0;
                                            foreach ($portable_object_list as $name) :
                                                ?>
                                                <?php if ($i < $portable_object_list_count - 1) : ?>
                                                    <span><?php echo $name; ?>,</span>
                                                <?php else: ?>
                                                    <span><?php echo $name; ?></span>
                                                <?php endif ?>
                                                <?php
                                                $i++;
                                            endforeach
                                            ?>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="fields">
                                <div class="four wide field">
                                    <label>Dimensions/Poids :</label>
                                </div>
                                <div class="twelve wide field">
                                    <div class="four wide fields">
                                        <div class="field">
                                            <label>Longueur </label>
                                            <span><?php echo get_post_meta($package_id, 'length', true); ?></span>
                                        </div>
                                        <div class="field">
                                            <label>Largeur </label>
                                            <span><?php echo get_post_meta($package_id, 'width', true); ?></span>
                                        </div>
                                        <div class="field">
                                            <label>Hauteur </label>
                                            <span><?php echo get_post_meta($package_id, 'height', true); ?></span>
                                        </div>
                                        <div class="field">
                                            <label>Poids</label>
                                            <span><?php echo get_post_meta($package_id, 'weight', true); ?></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <?php
                            $carrier_id = get_post_meta($package_id, 'carrier-ID', true);
                            if ($carrier_id && $carrier_id > -1):
                                ?>
                                <h4 class="ui dividing header">TRANSPORT </h4>
                                <div class="three wide fields">
                                    <div class="field">
                                        <label>Trasporteur </label>
                                        <span><?php echo get_user_by('id', $carrier_id)->user_firstname; ?></span>
                                    </div>
                                    <div class="field">
                                        <label>Type de transporteur </label>
                                        <span><?php echo get_user_role_by_user_id($carrier_id); ?></span>
                                    </div>
                                    <div class="field">
                                        <label>Statut </label>
                                        <span><?php echo getTransportStatus(intval(get_post_meta($package_id, 'transport-state', true))); ?></span>
                                    </div>
                                </div>
                            <?php endif ?>
                            <div class="field" style="margin-top: 4em">
                                <a id="edit_package_infos_btn" class="ui green button" href="<?php echo esc_url(add_query_arg(array('action' => 'edit'), get_the_permalink($package_id))) ?>" >Modifier l'expédition</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>-->
            <form method="POST" action="<?php the_permalink($package_id) ?>">
                <div  class="ui content_packages_transports fluid card">
                    <div class="content center aligned">
                        <div class="header"><?php echo __('Les offres correspondantes'); ?></div>
                    </div>
                    <div class="content content_packages_transports">
                        <?php
                        $transport_offers = new WP_Query(getWPQueryArgsForCarrierSearch($search_data));
                        $exclude_ids = array();
                        if ($transport_offers->have_posts()) {
                            ?>
                            <div id='list_as_grid_content' class="ui three column doubling stackable grid">
                                <?php
                                while ($transport_offers->have_posts()): $transport_offers->the_post();
                                    $exclude_ids[] = get_the_ID();
                                    ?>
                                    <div class="column">
                                        <div class="ui fluid card">
                    <!--                        <i class="huge travel icon center aligned"></i>-->
                                            <div class="content">
                                                <img class="ui avatar image" src="<?php echo get_template_directory_uri() ?>/assets/images/avatar.png"> <strong>Transporteur : </strong><a ><?php echo get_the_author_meta('user_login'); ?></a>
                                            </div>
                                            <div class="content">
                                                <div class="ui form description">
                                                    <div class="inline field">
                                                        <label>Départ : </label>
                                                        <span>
                                                            <?php echo get_post_meta(get_the_ID(), 'departure-city-transport-offer', true) ?>(<?php echo get_post_meta(get_the_ID(), 'departure-country-transport-offer', true) ?>) <?php echo date('d-m-Y', strtotime(get_post_meta(get_the_ID(), 'date-of-departure-transport-offer', true))); ?>
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

                                                    <div class="inline field">
                                                        <label>Coût du transport : </label> 
                                                        <span>
                                                            <?php echo get_post_meta(get_the_ID(), 'price', true) . " " . get_post_meta(get_the_ID(), 'currency', true); ?>
                                                        </span>
                                                    </div>
                                                    <div class="inline field">
                                                        <label>Objet(s) : </label> 
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
                                                    <div class="inline field">
                                                        <label>Mode de transport : </label> 
                                                        <span>
                                                            <?php
                                                            $tranport_method_list = wp_get_post_terms(get_the_ID(), 'transport-method', array("fields" => "names"));
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
                                                <input id='selected_transport_offer_checkbox<?php the_ID(); ?>' type="checkbox" name="selected_transport_offers[]" value="<?php the_ID(); ?>" style="display: none">
                                                <a id='selected_transport_offer<?php the_ID(); ?>' class="ui fluid green button" style="display: none" onclick="unselect_transport_offer(<?php the_ID(); ?>)"><i class="checkmark icon"></i></a>
                                                <a id='unselected_transport_offer<?php the_ID(); ?>' class="ui fluid green button" onclick="select_transport_offer(<?php the_ID(); ?>)"><?php echo __("Selectionner", "gpdealdomain") ?></a>
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
                                            Nous n'avons trouvé aucune offre non expirée correspondant à vos critères de recherche. Nous avons enregistré votre éxpédition. Vous pourrez éffectuer la recherche 
                                            ultérieurement ou la modifier <a href="<?php echo esc_url(add_query_arg(array('action' => 'edit'), the_permalink($package_id)))?>">ici</a> pour explorer d'autres offres disponibles. Vous serez notifié par email lorsqu'une nouvelle offre correspondant à vos critère sera disponible chez nous.
                                        </div>
                                    </div>
                                </div>
                                <!--<h2 class="header">Aucune offre ne correspond à vos critères de recherches.</h2>-->
                            </div>
                            <?php
                        }
                        wp_reset_postdata();
                        ?>
                    </div>
                    <div class="extra content">

                    </div>
                </div>
                <?php
                $transport_offers_which_can_interest = new WP_Query(getWPQueryArgsCarrierSearchForWhichCanInterest($search_data, $exclude_ids));
                if ($transport_offers_which_can_interest->have_posts()) {
                    ?>
                    <div  class="ui content_packages_transports fluid card">
                        <div class="content center aligned">
                            <div class="header"><?php echo __('Les offres pouvant vous intéresser'); ?></div>
                        </div>
                        <div class="content content_packages_transports">

                            <div id='list_as_grid_content' class="ui three column doubling stackable grid">
                                <?php
                                while ($transport_offers_which_can_interest->have_posts()): $transport_offers_which_can_interest->the_post();
                                    ?>
                                    <div class="column">
                                        <div class="ui fluid card">
                    <!--                        <i class="huge travel icon center aligned"></i>-->
                                            <div class="content">
                                                <img class="ui avatar image" src="<?php echo get_template_directory_uri() ?>/assets/images/avatar.png"> <strong>Transporteur : </strong><a ><?php echo get_the_author_meta('user_login'); ?></a>
                                            </div>
                                            <div class="content">
                                                <div class="ui form description">
                                                    <div class="inline field">
                                                        <label>Départ : </label>
                                                        <span>
                                                            <?php echo get_post_meta(get_the_ID(), 'departure-city-transport-offer', true) ?>(<?php echo get_post_meta(get_the_ID(), 'departure-country-transport-offer', true) ?>) <?php echo date('d-m-Y', strtotime(get_post_meta(get_the_ID(), 'date-of-departure-transport-offer', true))); ?>
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

                                                    <div class="inline field">
                                                        <label>Coût du transport : </label> 
                                                        <span>
                                                            <?php echo get_post_meta(get_the_ID(), 'price', true) . " " . get_post_meta(get_the_ID(), 'currency', true); ?>
                                                        </span>
                                                    </div>
                                                    <div class="inline field">
                                                        <label>Objet(s) : </label> 
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
                                                    <div class="inline field">
                                                        <label>Mode de transport : </label> 
                                                        <span>
                                                            <?php
                                                            $tranport_method_list = wp_get_post_terms(get_the_ID(), 'transport-method', array("fields" => "names"));
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
                                                <input id='selected_transport_offer_checkbox<?php the_ID(); ?>' type="checkbox" name="selected_transport_offers[]" value="<?php the_ID(); ?>" style="display: none">
                                                <a id='selected_transport_offer<?php the_ID(); ?>' class="ui fluid green button" style="display: none" onclick="unselect_transport_offer(<?php the_ID(); ?>)"><i class="checkmark icon"></i></a>
                                                <a id='unselected_transport_offer<?php the_ID(); ?>' class="ui fluid green button" onclick="select_transport_offer(<?php the_ID(); ?>)"><?php echo __("Selectionner", "gpdealdomain") ?></a>
                                            </div>
                                        </div>
                                    </div>
                                    <?php
                                endwhile;
                                ?>
                            </div>
                        </div>
                    </div>
                <?php } wp_reset_postdata();
                if ($transport_offers_which_can_interest->have_posts() || $transport_offers->have_posts()):  ?>
                <input type="hidden" name='package_id' value="<?php echo $package_id; ?>">
                <div align="center">
                    <button id='submit_selected_transport_offers' type='submit' name='submit_selected_transport_offers' class="ui green button" value='yes'><?php echo __("Valider la selection", "gpdealdomain") ?></button>
                </div>
                <?php endif ?>
            </form>
        </div>
    </div>
</div>

