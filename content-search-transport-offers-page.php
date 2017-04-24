<?php
global $current_user;
get_template_part('top-menu', get_post_format());
?>
<div class="ui large borderless second-nav menu">
    <div class="ui container center aligned">
        <div class="center menu">
            <div class="item">
                <a href="<?php echo home_url('/') ?>" class="section"><?php echo get_page_by_path(__('accueil', 'gpdealdomain'))->post_title ?></a>                
                <i class="right arrow icon divider"></i>
                <div class="active section"><?php echo __('Resultats de la recherche des offres de transport'); ?></div>
            </div>
        </div>
    </div>
</div>
<div class="ui vertical masthead  segment container">
    <!--div class="ui text container">
    </div-->
    <div class="ui stackable grid">

        <div class="wide column">
            <form id="selected_transport_offers_form" class="" method="POST" action="<?php echo get_permalink(get_page_by_path(__('mon-compte', 'gpdealdomain') . '/' . __('expeditions', 'gpdealdomain') . '/' . __('saisir', 'gpdealdomain'))) ?>">
                <div  class="ui content_packages_transports fluid card">
                    <div class="content center aligned">
                        <div class="header"><?php echo __('Transporteurs au départ de'); ?> <span class="locality_name"><?php echo $locality_name ?></span></div>
                    </div>
                    <div class="content">
                        <?php
                        $transport_offers_start = new WP_Query(getWPQueryArgsForMainCarrierSearchWithStartParameters($search_query));
                        if ($transport_offers_start->have_posts()) {
                            ?>
                            <div id='list_as_grid_content' class="ui three column doubling stackable grid">
                                <?php
                                while ($transport_offers_start->have_posts()): $transport_offers_start->the_post();
                                    $transport_offer_start_id = get_the_ID();
                                    ?>
                                    <div class="column">
                                        <div class="ui fluid card">
                                            <?php
                                            $post_author = get_post_field('post_author', $transport_offer_start_id);
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
                                                                    <a id="<?php echo $transport_offer_start_id ?>" href="<?php echo esc_url(add_query_arg(array('carrier_id' => $post_author), the_permalink(get_page_by_path(__('avis-et-evaluations', 'gpdealdomain'))))); ?>" class="show_reviews_evaluations">
                                                                        <?php echo $stat_value["vote_count"]; ?> avis
                                                                    </a>
                                                                </div>
                                                            </div>
                                                        <?php endforeach; ?>
                                                    <?php else: ?>
                                                        <span id="<?php echo $transport_offer_start_id; ?>"  ><i class="star icon"></i> <?php echo __("Aucun avis", "gpdealdomain"); ?></span>
                                                    <?php endif ?>
                                                </div>
                                                <img  class="ui avatar image" <?php if ($profile_picture_id): ?> src= "<?php echo wp_get_attachment_url($profile_picture_id); ?>" <?php else: ?> src="<?php echo get_template_directory_uri() ?>/assets/images/avatar.png"<?php endif ?>><span class='profile_name'><?php echo $carrier_name; ?></span> (<strong><?php echo get_user_role_by_user_id($post_author) ?></strong>)
                                            </div>
                                            <div class="content">
                                                <div class="ui form description">
                                                    <div class="inline field">
                                                        <span class="span_label">Départ : </span>
                                                        <span class="span_value">
                                                            <?php echo get_post_meta($transport_offer_start_id, 'departure-city-transport-offer', true) ?> (<?php echo get_post_meta($transport_offer_start_id, 'departure-country-transport-offer', true) ?>), <?php echo date('d-m-Y', strtotime(get_post_meta($transport_offer_start_id, 'date-of-departure-transport-offer', true))); ?>
                                                        </span>
                                                    </div>
                                                    <div class="inline field"> 
                                                        <span class="span_label">Destination : </span>
                                                        <span class="span_value">
                                                            <?php echo get_post_meta($transport_offer_start_id, 'destination-city-transport-offer', true) ?> (<?php echo get_post_meta($transport_offer_start_id, 'destination-country-transport-offer', true) ?>), <?php echo date('d-m-Y', strtotime(get_post_meta($transport_offer_start_id, 'arrival-date-transport-offer', true))); ?>
                                                        </span>
                                                    </div>

                                                    <div class="inline field">
                                                        <span class="span_label">Date limite<i class="help circle green link icon deadline_transport_offer_help_link"></i> : </span> 
                                                        <span class="span_value">
                                                            <?php echo date('d-m-Y', strtotime(get_post_meta($transport_offer_start_id, 'deadline-of-proposition-transport-offer', true))); ?>
                                                        </span>

                                                    </div>
                                                    <div class="inline field">
                                                        <span class="span_label">Objet(s)<i class="help circle green link icon type_package_transport_offer_help_link"></i> : </span> 
                                                        <span class="span_value">
                                                            <?php
                                                            $package_type_list = wp_get_post_terms($transport_offer_start_id, 'type_package', array("fields" => "names"));
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
                                                            $transport_method_list = wp_get_post_terms($transport_offer_start_id, 'transport-method', array("fields" => "names"));
                                                            $transport_method_list_count = count($transport_method_list);
                                                            $i = 0;
                                                            foreach ($transport_method_list as $name) :
                                                                ?>
                                                                <?php if ($i < $transport_method_list_count - 1) : ?>
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

                                                    <span class="ui blue right ribbon label">
                                                        <?php echo get_post_meta($transport_offer_start_id, 'price', true) . " " . get_post_meta($transport_offer_start_id, 'currency', true); ?>
                                                    </span>
                                                </div>
                                            </div>
                                            <!--                                            <div class="extra content">
                                            <?php if (is_user_logged_in()) : ?>
                                                                                                    <input id='selected_transport_offer_checkbox<?php echo $transport_offer_start_id; ?>' type="checkbox" name="selected_transport_offers[]" value="<?php echo $transport_offer_start_id; ?>" style="display: none">
                                                                                                    <a id='selected_transport_offer<?php echo $transport_offer_start_id; ?>' class="ui fluid green button" style="display: none" onclick="unselect_transport_offer(<?php echo $transport_offer_start_id; ?>)"><i class="checkmark icon"></i></a>
                                                                                                    <a id='unselected_transport_offer<?php echo $transport_offer_start_id; ?>' class="ui fluid green button" onclick="select_transport_offer(<?php echo $transport_offer_start_id; ?>)"><?php echo __("Selectionner", "gpdealdomain") ?></a>
                                            <?php else: ?>
                                                                                                    <a class="ui fluid green button" onclick="signin();"><?php echo __("Selectionner", "gpdealdomain") ?></a>
                                            <?php endif ?>
                                                                                        </div>-->
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
                                            Aucune offre valide au départ de <?php echo $country_region_city['city']; ?>.
                                        </div>

                                    </div>
                                </div>
                                <!--<h2 class="header">Aucune offre de transport pour le départ ne correspond à vos mots clés de recherches.</h2>-->
                            </div>
                            <?php
                        }
                        wp_reset_postdata();
                        ?>
                    </div>
                </div>

                <div  class="ui content_packages_transports fluid card">
                    <div class="content center aligned">
                        <div class="header"><?php echo __('Transporteurs à destination de'); ?> <span class="locality_name"><?php echo $locality_name ?></span></div>
                    </div>
                    <div class="content">
                        <?php
                        $transport_offers_destination = new WP_Query(getWPQueryArgsForMainCarrierSearchWithDestinationParameters($search_query));
                        if ($transport_offers_destination->have_posts()) {
                            ?>
                            <div id='list_as_grid_content' class="ui three column doubling stackable grid">
                                <?php
                                while ($transport_offers_destination->have_posts()): $transport_offers_destination->the_post();
                                    $transport_offer_dest_id = get_the_ID();
                                    ?>
                                    <div class="column">

                                        <div class="ui fluid card">
                    <!--                        <i class="huge travel icon center aligned"></i>-->
                                            <?php
                                            $post_author = get_post_field('post_author', $transport_offer_dest_id);
                                            //$evaluations_of_author = getEvaluationsOfCarrier($post_author);
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
                                                                    <a id="<?php echo $transport_offer_dest_id ?>" href="<?php echo esc_url(add_query_arg(array('carrier_id' => $post_author), the_permalink(get_page_by_path(__('avis-et-evaluations', 'gpdealdomain'))))); ?>" class="show_reviews_evaluations">
                                                                        <?php echo $stat_value["vote_count"]; ?> avis
                                                                    </a>
                                                                </div>
                                                            </div>
                                                        <?php endforeach; ?>
                                                    <?php else: ?>
                                                        <span id="<?php echo $transport_offer_dest_id; ?>"  ><i class="star icon"></i> <?php echo __("Aucun avis", "gpdealdomain"); ?></span>
                                                    <?php endif ?>
                                                </div>
                                                <img  class="ui avatar image" <?php if ($profile_picture_id): ?> src= "<?php echo wp_get_attachment_url($profile_picture_id); ?>" <?php else: ?> src="<?php echo get_template_directory_uri() ?>/assets/images/avatar.png"<?php endif ?>> <span class='profile_name'><?php echo $carrier_name; ?></span> (<strong><?php echo get_user_role_by_user_id($post_author) ?></strong>)
                                            </div>
                                            <div class="content">
                                                <div class="ui form description">
                                                    <div class="inline field">
                                                        <span class="span_label">Départ : </span>
                                                        <span class="span_value">
                                                            <?php echo get_post_meta($transport_offer_dest_id, 'departure-city-transport-offer', true) ?> (<?php echo get_post_meta($transport_offer_dest_id, 'departure-country-transport-offer', true) ?>), <?php echo date('d-m-Y', strtotime(get_post_meta($transport_offer_dest_id, 'date-of-departure-transport-offer', true))); ?>
                                                        </span>
                                                    </div>
                                                    <div class="inline field"> 
                                                        <span class="span_label">Destination : </span>
                                                        <span class="span_value">
                                                            <?php echo get_post_meta($transport_offer_dest_id, 'destination-city-transport-offer', true) ?> (<?php echo get_post_meta($transport_offer_dest_id, 'destination-country-transport-offer', true) ?>), <?php echo date('d-m-Y', strtotime(get_post_meta($transport_offer_dest_id, 'arrival-date-transport-offer', true))); ?>
                                                        </span>
                                                    </div>

                                                    <div class="inline field">
                                                        <span class="span_label">Date limite<i class="help circle green link icon deadline_transport_offer_help_link"></i> : </span> 
                                                        <span class="span_value">
                                                            <?php echo date('d-m-Y', strtotime(get_post_meta($transport_offer_dest_id, 'deadline-of-proposition-transport-offer', true))); ?>
                                                        </span>
                                                    </div>

                                                    <div class="inline field">
                                                        <span class="span_label">Objet(s)<i class="help circle green link icon type_package_transport_offer_help_link"></i> : </span> 
                                                        <span class="span_value">
                                                            <?php
                                                            $package_type_list = wp_get_post_terms($transport_offer_dest_id, 'type_package', array("fields" => "names"));
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
                                                            $transport_method_list = wp_get_post_terms($transport_offer_dest_id, 'transport-method', array("fields" => "names"));
                                                            $transport_method_list_count = count($transport_method_list);
                                                            $i = 0;
                                                            foreach ($transport_method_list as $name) :
                                                                ?>
                                                                <?php if ($i < $transport_method_list_count - 1) : ?>
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

                                                    <span class="ui blue right ribbon label">
                                                        <?php echo get_post_meta($transport_offer_dest_id, 'price', true) . " " . get_post_meta($transport_offer_dest_id, 'currency', true); ?>
                                                    </span>
                                                </div>
                                            </div>
                                            <!--                                            <div class="extra content">
                                            <?php if (is_user_logged_in()) : ?>
                                                                                                    <input id='selected_transport_offer_checkbox<?php echo $transport_offer_dest_id; ?>' type="checkbox" name="selected_transport_offers[]" value="<?php echo $transport_offer_dest_id; ?>" style="display: none">
                                                                                                    <a id='selected_transport_offer<?php echo $transport_offer_dest_id; ?>' class="ui fluid green button" style="display: none" onclick="unselect_transport_offer(<?php echo $transport_offer_dest_id; ?>)"><i class="checkmark icon"></i></a>
                                                                                                    <a id='unselected_transport_offer<?php echo $transport_offer_dest_id; ?>' class="ui fluid green button" onclick="select_transport_offer(<?php echo $transport_offer_dest_id; ?>)"><?php echo __("Selectionner", "gpdealdomain") ?></a>
                                            <?php else: ?>
                                                                                                    <a class="ui fluid green button" onclick="signin();"><?php echo __("Selectionner", "gpdealdomain") ?></a>
                                            <?php endif ?>
                                                                                        </div>-->
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
                                            Aucune offre valide à destination de <?php echo $country_region_city['city']; ?>.
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
                <?php if ($transport_offers_start->have_posts() || $transport_offers_destination->have_posts()): ?>
                    <input type="hidden" name='package_id' value="<?php echo $package_id; ?>">
                    <input type="hidden" name='confirm_transaction' value='true' >
                    <div align="center" >
                        <!--<button id='submit_selected_transport_offers' type='submit' name='submit_selected_transport_offers' class="ui green button" ><?php echo __("Valider la selection", "gpdealdomain") ?></button>-->
                        <button id='submit_selected_transport_offers' type='submit' name='submit_selected_transport_offers' class="ui green button" value='yes' style="display: none"><?php echo __("Valider la selection", "gpdealdomain") ?></button>
                    </div>
                <?php endif ?>
            </form>
        </div>
    </div>
</div>
<?php include(locate_template('content-login-modal-page.php')); ?>
<div id='main_content_reviews_evaluations'>
</div>

