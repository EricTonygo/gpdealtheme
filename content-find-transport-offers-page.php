<?php
global $current_user;
$search_data = null;
if (isset($_SERVER['REQUEST_METHOD']) && $_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST["submit_search_transport_offers"]) && removeslashes(esc_attr(trim($_POST["submit_search_transport_offers"] = "yes")))) {
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
get_template_part('top-menu', get_post_format());
?>
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
            <form id="selected_transport_offers_form" class="" method="POST" action="<?php echo get_permalink(get_page_by_path(__('mon-compte', 'gpdealdomain') . '/' . __('expeditions', 'gpdealdomain') . '/' . __('saisir', 'gpdealdomain'))) ?>">
                <?php if (is_user_logged_in()): ?>
                    <div style="display: none">
                        <div class="two wide fields">
                            <div class="field">
                                <div class="ui input left icon">
                                    <i class="marker icon"></i>
                                    <input id="start_city_transport" type="text" name='start_city' placeholder="Ville de départ" value="<?php echo $start_city ?>">
                                </div>
                            </div>             
                            <div class="field">
                                <div class="ui calendar" >
                                    <div class="ui input left icon">
                                        <i class="calendar icon"></i>
                                        <input type="text" name='start_date' placeholder="Date de départ" value="<?php echo $start_date ?>">
                                    </div>
                                </div>
                            </div>      
                        </div>

                        <div class="two wide fields">
                            <div class="field">
                                <div class="ui input left icon">
                                    <i class="marker icon"></i>
                                    <input id="destination_city_transport" type="text" name='destination_city' placeholder="Ville de destination" value="<?php echo $destination_city ?>">
                                </div>
                            </div>             
                            <div class="field">
                                <div class="ui calendar" >
                                    <div class="ui input left icon">
                                        <i class="calendar icon"></i>
                                        <input type="text" name='destination_date' placeholder="Date d'arrivée" value="<?php echo $destination_date ?>">
                                    </div>
                                </div>
                            </div>     
                        </div>
                        <div class="fields">
                            <div class="twelve wide field">
                                <div class="inline fields">
                                    <?php
                                    $typePackages = get_terms(array('taxonomy' => 'type_package', 'hide_empty' => false, 'orderby' => 'ID', 'order' => 'ASC'));
                                    foreach ($typePackages as $typePackage):
                                        ?>
                                        <div class="field">
                                            <div class="ui checkbox">
                                                <input type="checkbox" name="package_type[]" value="<?php echo $typePackage->term_id; ?>" <?php if (in_array($typePackage->term_id, $package_type, true)): ?> checked="checked" <?php endif ?>>
                                                <label><?php echo $typePackage->name; ?></label>
                                            </div>
                                        </div>
                                    <?php endforeach ?>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endif ?>
                
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
                                                <?php
                                                $post_author = get_post_field('post_author', get_the_ID());
                                                $carrier_name = $current_user->ID == $post_author ? __("Vous", "gpdealdomain") : get_the_author_meta('user_login');
                                                ?>
                                                <img class="ui avatar image" src="<?php echo get_template_directory_uri() ?>/assets/images/avatar.png"> <strong><?php echo __("Transporteur", "gpdealdomain") . " " . get_user_role_by_user_id($post_author) ?> : </strong><a ><?php echo $carrier_name; ?></a>
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
                                                <?php if (is_user_logged_in()) : ?>
                                                    <input id='selected_transport_offer_checkbox<?php the_ID(); ?>' type="checkbox" name="selected_transport_offers[]" value="<?php the_ID(); ?>" style="display: none">
                                                    <a id='selected_transport_offer<?php the_ID(); ?>' class="ui fluid green button" style="display: none" onclick="unselect_transport_offer(<?php the_ID(); ?>)"><i class="checkmark icon"></i></a>
                                                    <a id='unselected_transport_offer<?php the_ID(); ?>' class="ui fluid grey button" onclick="select_transport_offer(<?php the_ID(); ?>)"><?php echo __("Selectionner", "gpdealdomain") ?></a>
                                                <?php else: ?>
                                                <a class="ui fluid grey button" onclick="signin();"><?php echo __("Selectionner", "gpdealdomain") ?></a>
                                                <?php endif ?>
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
                                            Nous n'avons trouvé aucune offre valide correspondant à vos critères de recherche.
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
                                            <?php
                                            $post_author = get_post_field('post_author', get_the_ID());
                                            $carrier_name = $current_user->ID == $post_author ? __("Vous", "gpdealdomain") : get_the_author_meta('user_login');
                                            ?>
                                            <div class="content">
                                                <img class="ui avatar image" src="<?php echo get_template_directory_uri() ?>/assets/images/avatar.png"> <strong><?php echo __("Transporteur", "gpdealdomain") . " " . get_user_role_by_user_id($post_author) ?> : </strong><a ><?php echo $carrier_name; ?></a>
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
                                                <?php if (is_user_logged_in()) : ?>
                                                    <input id='selected_transport_offer_checkbox<?php the_ID(); ?>' type="checkbox" name="selected_transport_offers[]" value="<?php the_ID(); ?>" style="display: none">
                                                    <a id='selected_transport_offer<?php the_ID(); ?>' class="ui fluid green button" style="display: none" onclick="unselect_transport_offer(<?php the_ID(); ?>)"><i class="checkmark icon"></i></a>
                                                    <a id='unselected_transport_offer<?php the_ID(); ?>' class="ui fluid grey button" onclick="select_transport_offer(<?php the_ID(); ?>)"><?php echo __("Selectionner", "gpdealdomain") ?></a>
                                                <?php else: ?>
                                                <a class="ui fluid grey button" onclick="signin();"><?php echo __("Selectionner", "gpdealdomain") ?></a>
                                                <?php endif ?>
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
                <?php if ($transport_offers_which_can_interest->have_posts() || $transport_offers->have_posts()): ?>
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
<?php
include(locate_template('content-login-modal-page.php'));
