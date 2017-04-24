<?php
global $current_user;
get_template_part('top-menu', get_post_format());
if (isset($_SERVER['REQUEST_METHOD']) && $_SERVER['REQUEST_METHOD'] == 'POST') {
    $package_type = array_map('intval', isset($_POST['transport_offer_package_type']) ? $_POST['transport_offer_package_type'] : array());
    $transport_method = array_map('intval', array(removeslashes(esc_attr(trim($_POST['transport_offer_transport_method'])))));
    $transport_offer_price = removeslashes(esc_attr(trim($_POST['transport_offer_price'])));
    $transport_offer_currency = removeslashes(esc_attr(trim($_POST['transport_offer_currency'])));
    $start_city = removeslashes(esc_attr(trim($_POST['start_city'])));
    $start_date = removeslashes(esc_attr(trim($_POST['start_date'])));
    $deadline_proposition = removeslashes(esc_attr(trim($_POST['start_deadline'])));
    $destination_city = removeslashes(esc_attr(trim($_POST['destination_city'])));
    $destination_date = removeslashes(esc_attr(trim($_POST['destination_date'])));
    $terms = removeslashes(esc_attr(trim($_POST['terms'])));
    $action = removeslashes(esc_attr(trim($_POST['action'])));
    $echo_start_city = $start_city;
    $echo_destination_city = $destination_city;
} else {
    $package_type = array_map('intval', wp_get_post_terms(get_the_ID(), 'type_package', array("fields" => "ids")));
    $transport_method = array_map('intval', wp_get_post_terms(get_the_ID(), 'transport-method', array("fields" => "ids")));
    $transport_offer_price = get_post_meta(get_the_ID(), 'price', true);
    $transport_offer_currency = get_post_meta(get_the_ID(), 'currency', true);
    $start_country = get_post_meta(get_the_ID(), 'departure-country-transport-offer', true);
    $start_state = get_post_meta(get_the_ID(), 'departure-state-transport-offer', true);
    $start_city = get_post_meta(get_the_ID(), 'departure-city-transport-offer', true);
    $start_date = date_format(date_create_from_format('Y-m-d H:i:s', get_post_meta(get_the_ID(), 'date-of-departure-transport-offer', true)), 'd-m-Y');
    $deadline_proposition = date('d-m-Y', strtotime(get_post_meta(get_the_ID(), 'deadline-of-proposition-transport-offer', true)));
    $destination_country = get_post_meta(get_the_ID(), 'destination-country-transport-offer', true);
    $destination_state = get_post_meta(get_the_ID(), 'destination-state-transport-offer', true);
    $destination_city = get_post_meta(get_the_ID(), 'destination-city-transport-offer', true);
    $destination_date = date('d-m-Y', strtotime(get_post_meta(get_the_ID(), 'arrival-date-transport-offer', true)));
    $action = removeslashes(esc_attr(trim($_GET['action'])));
    $echo_start_city = $start_state != "" ? $start_city . ", " . $start_state . ", " . $start_country : $start_city . ", " . $start_country;
    $echo_destination_city = $destination_state != "" ? $destination_city . ", " . $destination_state . ", " . $destination_country : $destination_city . ", " . $destination_country;
}
?>
<div class="ui large borderless second-nav menu">
    <div class="ui container center aligned">
        <div class="center menu">
            <div class="item">
                <a href="<?php echo home_url('/') ?>" class="section"><?php echo get_page_by_path(__('accueil', 'gpdealdomain'))->post_title ?></a>
                <i class="right chevron icon divider"></i>
                <a href="<?php echo get_permalink(get_page_by_path(__('mon-compte', 'gpdealdomain'))) ?>" class="section"><?php echo get_page_by_path(__('mon-compte', 'gpdealdomain'))->post_title ?></a>
                <i class="right chevron icon divider"></i>
                <a href="<?php echo get_permalink(get_page_by_path(__('mon-compte', 'gpdealdomain') . '/' . __('offres-de-transport', 'gpdealdomain'))) ?>" class="section"><?php echo get_page_by_path(__('mon-compte', 'gpdealdomain') . '/' . __('offres-de-transport', 'gpdealdomain'))->post_title ?></a>
                <i class="right arrow icon divider"></i>
                <div class="active section"><?php the_title(); ?></div>
            </div>
        </div>
    </div>
</div>
<div class="ui vertical masthead  segment container">

    <div id='edit_transport_offer_infos' class="ui signup_contenair basic segment container" <?php if ($action == null || $action != 'edit'): ?> style="display: none" <?php endif ?>>
        <div class="ui attached message">
            <div class="header"><?php echo __("Mofication de l' offre de transport", 'gpdealdomain') ?> : </div>
            <p class="promo_text_form"><?php echo __("Modifier les informations ci-dessous pour mettre à jour votre offre de transport.", 'gpdealdomain') ?></p>
        </div>
        <div class="ui fluid card">
            <div class="content">
                <p class="required_infos"><span style="color: red;">*</span> Informations obligatoires</p>
                <div class="ui top attached tabular menu">
                    <div class="item active" data-tab="first">Offre de <br class="mobile_br" style="display: none;">transport</div>
                    <div class="item" data-tab="second">Comment ça <br class="mobile_br" style="display: none;">fonctionnne ?</div>
                </div>
                <div class="ui bottom attached tab segment active" data-tab="first">
                    <form id='write_transport_offer_form'  method="POST" action="<?php the_permalink(); ?>" class="ui form" autocomplete="off">

                        <h4 class="ui dividing header">Départ <span style="color:red;">*</span></h4>
                        <div class="two wide fields">
                            <div class="field">
                                <div class="ui input icon start_city">
                                    <!--<i class="marker icon start_city" locality_id='start_city'></i>-->
                                    <i class="remove link icon start_city" style="display: none;" locality_id='start_city'></i>
                                    <input id="start_city" type="text" class="locality" name='start_city' placeholder="Ville de départ" value="<?php echo $echo_start_city; ?>">
                                </div>
                            </div>                 
                            <div class="field">
                                <div class="ui calendar" >
                                    <div class="ui input left icon">
                                        <i class="calendar icon"></i>
                                        <input type="text" name='start_date' placeholder="Date" value="<?php echo $start_date ?>">
                                    </div>
                                </div>
                            </div>      
                        </div>

                        <h4 class="ui dividing header">Destination <span style="color:red;">*</span></h4>
                        <div class="two wide fields">
                            <div class="field">
                                <div class="ui input icon destination_city">
                                    <!--<i class="marker icon destination_city" locality_id='destination_city'></i>-->
                                    <i class="remove link icon destination_city" style="display: none;" locality_id='destination_city'></i>
                                    <input id="destination_city" type="text" class="locality" name='destination_city' placeholder="Ville de destination" value="<?php echo $echo_destination_city; ?>">
                                </div>
                            </div>                 
                            <div class="field">
                                <div class="ui calendar" >
                                    <div class="ui input left icon">
                                        <i class="calendar icon"></i>
                                        <input type="text" name='destination_date' placeholder="Date" value="<?php echo $destination_date ?>">
                                    </div>
                                </div>
                            </div>      
                        </div>
                        <h4 class="ui dividing header">Date limite de proposition <span style="color:red;">*</span></h4>
                        <div class="field">
                            <div class="ui calendar" >
                                <div class="ui input left icon">
                                    <i class="calendar icon"></i>
                                    <input type="text" name='start_deadline' placeholder="Date limite de proposition" value="<?php echo $deadline_proposition ?>">
                                </div>
                            </div>
                        </div>      
                        <h4 class="ui dividing header"><?php echo __("Informations sur l'offre de transport", 'gpdealdomain') ?></h4>
                        <div class="fields">
                            <div class="four wide field">
                                <label><?php echo __("Objet(s)", 'gpdealdomain') ?> <span style="color:red;">*</span></label>
                            </div>
                            <div class="twelve wide field">
                                <select name="transport_offer_package_type[]" class="ui search fluid dropdown" multiple="multiple" data-validate='transport_offer_package_type'>
                                    <option value="">Objets à transporter </option>
                                    <?php
                                    $typePackages = get_terms(array('taxonomy' => 'type_package', 'hide_empty' => false, 'orderby' => 'ID', 'order' => 'ASC'));
                                    foreach ($typePackages as $typePackage):
                                        ?>
                                        <option value="<?php echo $typePackage->term_id; ?>" <?php if (in_array($typePackage->term_id, $package_type, true)): ?> selected="selected" <?php endif ?>><?php echo $typePackage->name; ?></option>
                                    <?php endforeach ?>
                                </select>
                            </div>
                        </div>
                        <div class="fields">
                            <div class="four wide field">
                                <label><?php echo __("Mode de transport", 'gpdealdomain') ?> <span style="color:red;">*</span></label>
                            </div>
                            <div class="twelve wide field">
                                <div class="inline fields">
                                    <?php
                                    $transportMethods = get_terms(array('taxonomy' => 'transport-method', 'hide_empty' => false, 'orderby' => 'ID', 'order' => 'ASC'));
                                    foreach ($transportMethods as $transportMethod):
                                        ?>
                                        <div class="field">
                                            <div class="ui radio checkbox">
                                                <input type="radio" name="transport_offer_transport_method" value="<?php echo $transportMethod->term_id; ?>" <?php if (in_array($transportMethod->term_id, $transport_method, true)): ?> checked="checked" <?php endif ?>>
                                                <label><?php echo $transportMethod->name; ?></label>
                                            </div>
                                        </div>
                                    <?php endforeach ?>
                                </div>
                            </div>
                        </div>

                        <div class="fields">
                            <div class="four wide field">
                                <label><?php echo __('Coût du transport', 'gpdealdomain'); ?> <span style="color:red;">*</span></label>
                            </div>
                            <div class="twelve wide field">

                                <div class="two wide fields">
                                    <div class="field">
                                        <input type="text" name="transport_offer_price" placeholder="Montant" value="<?php echo $transport_offer_price; ?>">
                                    </div>
                                    <div class="field">
                                        <select name="transport_offer_currency" class="ui search fluid dropdown">
                                            <option value="">Dévise</option>
                                            <?php
                                            $currencies = getCurrenciesList();
                                            foreach ($currencies as $currency) :
                                                ?>
                                                <option value="<?php echo $currency['code'] ?>" <?php if ($currency['code'] == $transport_offer_currency): ?> selected="selected" <?php endif ?>><?php echo $currency['name'] ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="inline field">
                            <div class="ui checkbox">
                                <input type="checkbox" name="terms" <?php if ($terms == 'on' || is_user_logged_in()): ?> checked="checked" <?php endif ?>> 
                                <label class="label_terms_use"><span style="color:red;">*</span> Je reconnais avoir pris de la liste des <a href="#">objets prohibés au transport</a>.</label>
                            </div>
                        </div>
                        <div class="field">
                            <div id="server_error_message" class="ui negative message" style="display:none">
                                <i class="close icon"></i>
                                <div id="server_error_content" class="header">Internal server error</div>
                            </div>
                            <div id="error_name_message" class="ui error message" style="display: none">
                                <i class="close icon"></i>
                                <div id="error_name_header" class="header"></div>
                                <ul id="error_name_list" class="list">

                                </ul>
                            </div>
                        </div>
                        <?php if (get_post_meta(get_the_ID(), 'transport-status', true) != 2 || get_post_meta(get_the_ID(), 'package-status', true) != 3): ?>
                            <div class="field">
                                <input type="hidden" name='action' value='edit'>
                                <button id="cancel_edit_transport_offer_infos_btn" class="ui green button" >Annuler la modification</button>
                                <button id="submit_send_transport_offer" class="ui right floated green button" type="submit">Mettre à jour</button>
                            </div>
                        <?php endif ?>
                    </form>
                </div>
                <div class="ui bottom attached tab segment" data-tab="second"> 
                    Comment ça fonctionne
                </div>
            </div>
        </div>
    </div>

    <div id='show_transport_offer_infos' class="ui signup_contenair basic segment container" <?php if ($action != null && $action != 'evaluate' && $action != 'evaluations' && $action != 'show'): ?> style="display: none" <?php endif ?> >
        <div  class="ui fluid card">
            <div class="content">
                <div class="ui form">
                    <div id="block_recap_desktop">
                        <h4 class="ui dividing header">Départ </h4>
                        <div class="four wide fields">
                            <div class="field">
                                <label class="span_label">Pays </label>
                                <span class="span_value"><?php echo $start_country; ?></span>
                            </div>
                            <div class="field">
                                <label class="span_label">Région/Etat </label>
                                <span class="span_value"><?php echo $start_state; ?></span>
                            </div>
                            <div class="field">
                                <label class="span_label">Ville </label>
                                <span><?php echo $start_city; ?></span>
                            </div>
                            <div class="field">
                                <label class="span_label">Date</label>
                                <span class="span_value"><?php echo $start_date; ?></span>
                            </div>   
                        </div>

                        <h4 class="ui dividing header">Destination </h4>
                        <div class="four wide fields">
                            <div class="field">
                                <label class="span_label">Pays </label>
                                <span class="span_value"><?php echo $destination_country; ?></span>
                            </div>
                            <div class="field">
                                <label class="span_label">Région/Etat </label>
                                <span class="span_value"><?php echo $destination_state; ?></span>
                            </div>
                            <div class="field">
                                <label class="span_label">Ville </label>
                                <span class="span_value"><?php echo $destination_city; ?></span>
                            </div>
                            <div class="field">
                                <label class="span_label">Date</label>
                                <span class="span_value"><?php echo $destination_date; ?></span>
                            </div>   
                        </div>
                        <h4 class="ui dividing header">Date limite des propositions </h4>
                        <div class="fields">
                            <div class="field">
                                <span class="span_value"><?php echo $deadline_proposition; ?></span>
                            </div>   
                        </div>
                        <h4 class="ui dividing header">Informations sur le courrier/colis</h4>
                        <div class="fields">
                            <div class="four wide field">
                                <span class="span_label">Objet(s) :</span>
                            </div>
                            <div class="twelve wide field">
                                <div class="inline fields">
                                    <div class="field">
                                        <?php
                                        $package_type_list = wp_get_post_terms(get_the_ID(), 'type_package', array("fields" => "names"));
                                        $package_type_list_count = count($package_type_list);
                                        $j = 0;
                                        foreach ($package_type_list as $name) :
                                            ?>
                                            <?php if ($j < $package_type_list_count - 1) : ?>
                                                <span class="span_value"><?php echo $name; ?>, </span>
                                            <?php else: ?>
                                                <span class="span_value"><?php echo $name; ?></span>
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
                                <span class="span_label">Mode de transport :</span>
                            </div>
                            <div class="twelve wide field">
                                <div class="inline fields">
                                    <div class="field">
                                        <?php
                                        $transport_method_list = wp_get_post_terms(get_the_ID(), 'transport-method', array("fields" => "names"));
                                        $transport_method_list_count = count($transport_method_list);
                                        $i = 0;
                                        foreach ($transport_method_list as $name) :
                                            ?>
                                            <?php if ($i < $transport_method_list_count - 1) : ?>
                                                <span class="span_value"><?php echo $name; ?>, </span>
                                            <?php else: ?>
                                                <span class="span_value"><?php echo $name; ?></span>
                                            <?php endif ?>
                                            <?php
                                            $i++;
                                        endforeach
                                        ?>
                                    </div>
                                </div>
                            </div>
                        </div>


                        <h4 class="ui dividing header">Informations sur le transport</h4>
                        <div class="fields">
                            <div class="four wide field">
                                <span class="span_label">Statut :</span>
                            </div>
                            <div class="twelve wide field">
                                <div class="inline fields">
                                    <div class="field">
                                        <span class="span_value"><?php echo getTransportStatus(intval(get_post_meta(get_the_ID(), 'transport-state', true))); ?></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php
                        $package_ids = get_post_meta(get_the_ID(), 'packages-IDs', true);
                        if (is_array($package_ids)) {
                            $package_ids = array_map('intval', $package_ids);
                        } else {
                            $package_ids = null;
                        }
                        ?>
                        <h4 class="ui dividing header">Courries/colis transportés</h4>
                        <div class="fields">
                            <?php if ($package_ids): ?>
                                <div class="four wide field">
                                    <span class="span_label">Numéros de courriers :</span>
                                </div>
                                <div class="twelve wide field">
                                    <div class="inline fields">
                                        <div class="field">
                                            <?php
                                            $package_ids_count = count($package_ids);
                                            $i = 0;
                                            foreach ($package_ids as $id) :
                                                $post_author = get_post_field('post_author', $id);
                                                ?>                                        
                                                <?php if ($i < $package_ids_count - 1) : ?>
                                                    <span><a href="<?php the_permalink($id) ?>"><?php
                                                            echo get_post_meta($id, 'package-number', true);
                                                            ?></a>, </span>
                                                <?php else: ?>
                                                    <span><a href="<?php the_permalink($id) ?>"><span><?php
                                                                echo get_post_meta($id, 'package-number', true);
                                                                ?></a></span>
                                                    <?php endif ?>
                                                    <?php
                                                    $i++;
                                                endforeach
                                                ?>
                                        </div>
                                    </div>
                                </div>
                            <?php endif ?>
                        </div>
                    </div>
                    <div id="block_recap_mobile" style="display: none">
                        <h4 class="ui dividing header">Départ </h4>
                        <div class="inline field">
                            <span class="span_label">Pays : </span>
                            <span class="span_value"><?php echo $start_country; ?></span>
                        </div>
                        <div class="inline field">
                            <span class="span_label">Région/Etat : </span>
                            <span class="span_value"><?php echo $start_state; ?></span>
                        </div>
                        <div class="inline field">
                            <span class="span_label">Ville : </span>
                            <span class="span_value"><?php echo $start_city; ?></span>
                        </div>
                        <div class="inline field">
                            <span class="span_label">Date : </span>
                            <span class="span_value"><?php echo $start_date; ?></span>
                        </div>   

                        <h4 class="ui dividing header">Destination </h4>
                        <div class="inline field">
                            <span class="span_label">Pays : </span>
                            <span class="span_value"><?php echo $destination_country; ?></span>
                        </div>
                        <div class="inline field">
                            <span class="span_label">Région/Etat : </span>
                            <span class="span_value"><?php echo $destination_state; ?></span>
                        </div>
                        <div class="inline field">
                            <span class="span_label">Ville : </span>
                            <span class="span_value"><?php echo $destination_city; ?></span>
                        </div>
                        <div class="inline field">
                            <span class="span_label">Date : </span>
                            <span class="span_value"><?php echo $destination_date; ?></span>
                        </div>   
                        <h4 class="ui dividing header">Date limite des propositions </h4>
                        <div class="fields">
                            <div class="field">
                                <span class="span_value"><?php echo $deadline_proposition; ?></span>
                            </div>   
                        </div>
                        <h4 class="ui dividing header">Informations sur le courrier/colis</h4>
                        <div class="inline field">
                            <span class="span_label">Objet(s) :</span>
                            <?php
                            $package_type_list = wp_get_post_terms(get_the_ID(), 'type_package', array("fields" => "names"));
                            $package_type_list_count = count($package_type_list);
                            $j = 0;
                            foreach ($package_type_list as $name) :
                                ?>
                                <?php if ($j < $package_type_list_count - 1) : ?>
                                    <span class="span_value"><?php echo $name; ?>, </span>
                                <?php else: ?>
                                    <span class="span_value"><?php echo $name; ?></span>
                                <?php endif ?>
                                <?php
                                $j++;
                            endforeach
                            ?>
                        </div>
                        <div class="inline field">
                            <span class="span_label">Mode de transport :</span>
                            <?php
                            $transport_method_list = wp_get_post_terms(get_the_ID(), 'transport-method', array("fields" => "names"));
                            $transport_method_list_count = count($transport_method_list);
                            $i = 0;
                            foreach ($transport_method_list as $name) :
                                ?>
                                <?php if ($i < $transport_method_list_count - 1) : ?>
                                    <span class="span_value"><?php echo $name; ?>, </span>
                                <?php else: ?>
                                    <span class="span_value"><?php echo $name; ?></span>
                                <?php endif ?>
                                <?php
                                $i++;
                            endforeach
                            ?>
                        </div>
                        <h4 class="ui dividing header">Informations sur le transport</h4>
                        <div class="inline field">
                            <span class="span_label">Statut :</span>

                            <span class="span_value"><?php echo getTransportStatus(intval(get_post_meta(get_the_ID(), 'transport-state', true))); ?></span>

                        </div>
                        <?php
                        $package_ids = get_post_meta(get_the_ID(), 'packages-IDs', true);
                        if (is_array($package_ids)) {
                            $package_ids = array_map('intval', $package_ids);
                        } else {
                            $package_ids = null;
                        }
                        ?>
                        <h4 class="ui dividing header">Courries/colis transportés</h4>
                        <div class="inline field">
                            <?php if ($package_ids): ?>
                                <span class="span_label">Numéros de courriers :</span>
                                <?php
                                $package_ids_count = count($package_ids);
                                $i = 0;
                                foreach ($package_ids as $id) :
                                    $post_author = get_post_field('post_author', $id);
                                    ?>                                        
                                    <?php if ($i < $package_ids_count - 1) : ?>
                                        <span><a href="<?php the_permalink($id) ?>"><?php
                                                echo get_post_meta($id, 'package-number', true);
                                                ?></a>, </span>
                                    <?php else: ?>
                                        <span><a href="<?php the_permalink($id) ?>"><span><?php
                                                    echo get_post_meta($id, 'package-number', true);
                                                    ?></a></span>
                                        <?php endif ?>
                                        <?php
                                        $i++;
                                    endforeach
                                    ?>
                            <?php endif ?>
                        </div>
                    </div>
                    <?php
                    $evaluations = new WP_Query(array('post_type' => 'evaluation', 'post_per_page' => -1, "post_status" => 'publish', 'orderby' => 'post_date', 'order' => 'DESC', 'meta_query' => array(array('key' => 'transport-offer-ID', 'value' => get_the_ID(), 'compare' => '='))));
                    ?>
                    <div class="field" style="margin-top: 4em">
                        <?php if (get_post_field('post_author', get_the_ID()) == $current_user->ID && !$evaluations->have_posts()): ?>
                            <button id="edit_transport_offer_infos_btn" class="ui right floated green button" >Modifier l'offre</button>
                        <?php endif ?>
                        <?php if (get_post_field('post_author', get_the_ID()) != $current_user->ID && !$evaluations->have_posts() && !$current_user_evaluations->have_posts()): ?>
                            <a id="show_block_evaluation_form_top" <?php if ($current_user_evaluations->have_posts()): ?> href="#action_evaluate_down"<?php else: ?> href="#block_evaluation_form" <?php endif ?> onclick="show_block_evaluation_form_top()" class="ui green basic button right floated"><?php echo __("Donner un avis", "gpdealdomain") ?></a>
                        <?php endif ?>
                        <?php
                        $statistics = getTotalStatistiticsEvaluation(get_the_ID());
                        wp_reset_postdata();
                        ?>
                        <div class="left floated">
                            <?php if ($statistics["Evaluation globale"]["vote_count"] > 0): ?>
                                <?php
                                foreach ($statistics as $stat_key => $stat_value):
                                    ?>
                                    <div class="ui form">
                                        <div class="field disable">
                                            <span class="ui mini star rating" data-rating="<?php echo $stat_value["weighted_average"]; ?>" data-max-rating="5"></span>
                                            <a href="#evaluations">
                                                <?php echo $stat_value["vote_count"]; ?> avis
                                            </a>
                                        </div>
                                    </div>
                                <?php endforeach; ?>
                            <?php else: ?>
                            <span><i class="star icon"></i><a href="#evaluations" > <?php echo __("Aucun avis", "gpdealdomain"); ?></a></span>
                            <?php endif ?>
                        </div>
                    </div>

                </div>
            </div>
        </div>
        <!--        <div id="action_evaluate_top" class="ui fluid card" style="margin-bottom: 1em; box-shadow: none">
                    <div class="field">
        <?php if (get_post_field('post_author', get_the_ID()) != $current_user->ID && !$evaluations->have_posts() && !$current_user_evaluations->have_posts()): ?>
                                <a id="show_block_evaluation_form_top" <?php if ($current_user_evaluations->have_posts()): ?> href="#action_evaluate_down"<?php else: ?> href="#block_evaluation_form" <?php endif ?> onclick="show_block_evaluation_form_top()" class="ui green basic button right floated"><?php echo __("Donner un avis", "gpdealdomain") ?></a>
        <?php endif ?>
                    </div>
                </div>-->
    </div>

    <div id='evaluations' class="ui signup_contenair basic segment container" <?php if ($action != null && $action != 'evaluate' && $action != 'evaluations' && $action != 'show'): ?> style="display: none" <?php endif ?>>
        <?php
        $transport_offer_link = get_the_permalink();
        //$evaluations = new WP_Query(array('post_type' => 'evaluation', 'post_per_page' => -1, "post_status" => 'publish', 'orderby' => 'post_date', 'order' => 'DESC', 'meta_query' => array(array('key' => 'transport-offer-ID', 'value' => get_the_ID(), 'compare' => '='))));
        if ($package_id) {
            $current_user_evaluations = new WP_Query(array('post_type' => 'evaluation', 'post_per_page' => 1, "post_status" => 'publish', 'author' => $current_user->ID, 'meta_query' => array('relation' => 'AND', array('key' => 'transport-offer-ID', 'value' => get_the_ID(), 'compare' => '='), array('key' => 'package-ID', 'value' => $package_id, 'compare' => '='))));
        } else {
            $current_user_evaluations = new WP_Query(array('post_type' => 'evaluation', 'post_per_page' => 1, "post_status" => 'publish', 'author' => $current_user->ID, 'meta_query' => array(array('key' => 'transport-offer-ID', 'value' => get_the_ID(), 'compare' => '='))));
        }
        ?>
        <div id="content_evaluations" class="ui fluid card">
            <div class="content center aligned">
                <div class="header"><?php echo __("Evaluations de l'offre", "gpdealdomain"); ?></div>
            </div>
            <div class="content">
                <?php if ($evaluations->have_posts()) { ?>
                    <div class="ui fluid card">
                        <div class="content">
                            <div  class="ui form" >
                                <?php
                                $statistics = getTotalStatistiticsEvaluation(get_the_ID());
                                foreach ($statistics as $stat_key => $stat_value):
                                    ?>

                                    <div class="three fields">
                                        <div class="four wide field"><span style=" font-weight: bold"><?php echo $stat_key; ?> <span style="color:blue;"><?php echo $stat_value["vote_count"]; ?> avis</span> :</span></div>
                                        <div class="eight wide field disable">
                                            <div class="ui huge star rating" data-rating="<?php echo $stat_value["weighted_average"]; ?>" data-max-rating="5"></div>
                                            <div class="sub-title-rating"><span class="left-sub-title-rating">Insatisfait</span> <span class="right-sub-title-rating">Très satisfait</span></div>
                                        </div>
                                        <?php if (get_post_field('post_author', get_the_ID()) != $current_user->ID && !$current_user_evaluations->have_posts()): ?>
                                            <div class="four wide field">
                                                <a id="show_block_evaluation_form_top" <?php if (!$current_user_evaluations->have_posts()): ?> href="#action_evaluate_down"<?php else: ?> href="#block_evaluation_form" <?php endif ?> onclick="show_block_evaluation_form_top()" class="ui green basic button right floated"><?php echo __("Donner un avis", "gpdealdomain") ?></a>
                                            </div>
                                        <?php endif ?>
                                    </div>
                                <?php endforeach; ?>
                            </div>
                        </div>
                    </div>
                    <?php
                    while ($evaluations->have_posts()): $evaluations->the_post();
                        $post_author = get_post_field('post_author', get_the_ID());
                        $evaluate_user = get_userdata($post_author);
                        $comments_list = get_comments(array('post_id' => get_the_ID(), "parent" => 0, "orderby" => "comment_date", "order" => "asc"));
                        $questions = get_post_meta(get_the_ID(), 'questions', true);
                        $responses = get_post_meta(get_the_ID(), 'responses', true);
                        $current_user_comments_count = get_comments(array('post_id' => get_the_ID(), "user_id" => $current_user->ID, 'count' => true));
                        $profile_picture_id = get_user_meta($post_author, 'profile-picture-ID', true) ? get_user_meta($post_author, 'profile-picture-ID', true) : get_user_meta($post_author, 'company-logo-ID', true);
                        ?>
                        <div class="ui form">
                            <div class="ui fluid card">
                                <div class="content">
                                    <div class=""><img  class="ui avatar image" <?php if ($profile_picture_id): ?> src= "<?php echo wp_get_attachment_url($profile_picture_id); ?>" <?php else: ?> src="<?php echo get_template_directory_uri() ?>/assets/images/avatar.png"<?php endif ?>><a onclick="show_user_evaluation(<?php the_ID(); ?>)"><?php echo $evaluate_user->user_login ?></a>

                                        <span class="meta"><?php echo "a évalué il y a " . human_time_diff(get_the_time('U'), current_time('timestamp')); ?></span>

                                    </div>
                                </div>
                                <?php
                                if (is_array($questions) && is_array($responses) && count($questions) == 5 && count($responses) == 5):
                                    ?>
                                    <div id="content_evaluation_<?php the_ID(); ?>" class="content ui form" style="display: none;">
                                        <?php for ($i = 0; $i < 2; $i++): ?>
                                            <div class="two fields" >
                                                <div class="four wide field"><label><?php echo $questions[$i]; ?> :</label></div>
                                                <div class="twelve wide field">
                                                    <label style="margin-left: 7em;"><?php echo $responses[$i]; ?></label>
                                                </div>
                                            </div>
                                        <?php endfor ?>

                                        <div class="fields">
                                            <div class="four wide field"><label><?php echo $questions[2]; ?> :</label></div>
                                            <div class="twelve wide field disable">
                                                <div class="ui huge star rating" data-rating="<?php echo $responses[2]; ?>" data-max-rating="5"></div>
                                                <div class="sub-title-rating"><span class="left-sub-title-rating">Insatisfait</span> <span class="right-sub-title-rating">Très satisfait</span></div>
                                            </div>
                                        </div>

                                        <div class="fields">
                                            <div class="four wide field"><label><?php echo $questions[3]; ?> :</label></div>
                                            <div class="twelve wide field disable">
                                                <div class="ui huge star rating" data-rating="<?php echo $responses[3]; ?>" data-max-rating="5"></div>
                                                <div class="sub-title-rating"><span class="left-sub-title-rating">Onéreux</span> <span class="right-sub-title-rating">Economique</span></div>
                                            </div>
                                        </div>

                                        <div class="fields">
                                            <div class="four wide field"><label><?php echo $questions[4]; ?> :</label></div>
                                            <div class="twelve wide field disable">
                                                <div class="ui huge star rating" data-rating="<?php echo $responses[4]; ?>" data-max-rating="5"></div>
                                                <div class="sub-title-rating"><span class="left-sub-title-rating">Insatisfait</span> <span class="right-sub-title-rating">Très satisfait</span></div>
                                            </div>
                                        </div>
                                    </div>
                                <?php endif ?>
                            </div>

                            <h4 class="ui dividing header">Commentaires </h4>
                            <div class="ui comments">
                                <?php if ($comments_list): ?>
                                    <?php
                                    foreach ($comments_list as $comment):
                                        $comment_user = get_userdata($comment->user_id);
//                                    $comments_children = get_comments(array('post_id' => get_the_ID(), "parent" => $comment->comment_ID));
//                                    var_dump($comments_children);
                                        $comment_profile_picture_id = get_user_meta($comment->user_id, 'profile-picture-ID', true) ? get_user_meta($comment->user_id, 'profile-picture-ID', true) : get_user_meta($comment->user_id, 'company-logo-ID', true);
                                        ?>

                                        <div class="comment">
                                            <a class="avatar">
                                                <img class="ui avatar image" <?php if ($comment_profile_picture_id): ?> src= "<?php echo wp_get_attachment_url($comment_profile_picture_id); ?>" <?php else: ?> src="<?php echo get_template_directory_uri() ?>/assets/images/avatar.png"<?php endif ?>>
                                            </a>
                                            <div class="content">
                                                <a class="author"><?php echo $comment_user->user_login; ?></a>
                                                <div class="metadata">
                                                    <div class="date"><?php
                                                        $date = apply_filters('get_comment_time', $comment->comment_date, 'U', false, true, $comment);
                                                        echo "a commenté il y a " . human_time_diff(strtotime($date), current_time('timestamp'));
                                                        ?></div>
                                                </div>
                                                <div class="text">
                                                    <p><?php echo $comment->comment_content; ?></p>
                                                </div>
                                                <?php if ($current_user_comments_count == 0): ?>
                                                    <div class="actions">
                                                        <a id="show_comment_reply_form<?php echo $comment->comment_ID; ?>" onclick="show_comment_reply_form(<?php echo $comment->comment_ID; ?>)" class="reply"><?php echo __("Répondre", "gpdealdomain") ?></a>
                                                        <a id="hide_comment_reply_form<?php echo $comment->comment_ID; ?>" onclick="hide_comment_reply_form(<?php echo $comment->comment_ID; ?>)" class="reply" style="display: none"><?php echo __("Annuler", "gpdealdomain") ?></a>
                                                    </div>
                                                <?php endif ?>
                                            </div>
                                            <?php echo getAndechoAllReply(get_the_ID(), $comment->comment_ID, $transport_offer_link); ?>
                                        </div>
                                        <?php if ($current_user_comments_count == 0): ?>
                                            <form id="comment_reply_form<?php echo $comment->comment_ID; ?>" class="ui reply form add_comment_reply_form" method="POST" action="<?php echo $transport_offer_link; ?>" onsubmit="add_comment_reply(event, <?php echo $comment->comment_ID; ?>)" style="display:none">
                                                <div class="field">
                                                    <textarea name="comment_content"></textarea>
                                                </div>
                                                <input type="hidden" name="action" value="add-comment-reply">
                                                <input type="hidden" name="evaluation_id" value="<?php the_ID(); ?>">
                                                <input type="hidden" name="comment_parent_id" value="<?php echo $comment->comment_ID; ?>">
                                                <div class="field">
                                                    <div id="server_error_message<?php echo $comment->comment_ID; ?>" class="ui negative message" style="display:none">
                                                        <i class="close icon"></i>
                                                        <div id="server_error_content<?php echo $comment->comment_ID; ?>" class="header">Internal server error</div>
                                                    </div>
                                                    <div id="error_name_message<?php echo $comment->comment_ID; ?>" class="ui error message" style="display: none">
                                                        <i class="close icon"></i>
                                                        <div id="error_name_header<?php echo $comment->comment_ID; ?>" class="header"></div>
                                                        <ul id="error_name_list<?php echo $comment->comment_ID; ?>" class="list">

                                                        </ul>
                                                    </div>
                                                </div>
                                                <button class="ui blue submit icon button">
                                                    <i class="icon edit"></i> Repondre
                                                </button>
                                            </form>
                                        <?php endif ?>
                                    <?php endforeach; ?>
                                <?php endif ?>
                                <?php if ($current_user_comments_count == 0): ?>
                                    <form id="evaluation_comment_form<?php the_ID(); ?>" class="ui reply form add_comment_form" method="POST" action="<?php echo $transport_offer_link; ?>" onsubmit="add_evaluation_comment(event, <?php the_ID(); ?>)" style="display:none">
                                        <div class="field">
                                            <textarea name="comment_content"></textarea>
                                        </div>
                                        <input type="hidden" name="action" value="add-evaluation-comment">
                                        <input type="hidden" name="evaluation_id" value="<?php the_ID(); ?>">
                                        <div class="field">
                                            <div id="server_error_message<?php the_ID(); ?>" class="ui negative message" style="display:none">
                                                <i class="close icon"></i>
                                                <div id="server_error_content<?php the_ID(); ?>" class="header">Internal server error</div>
                                            </div>
                                            <div id="error_name_message<?php the_ID(); ?>" class="ui error message" style="display: none">
                                                <i class="close icon"></i>
                                                <div id="error_name_header<?php the_ID(); ?>" class="header"></div>
                                                <ul id="error_name_list<?php the_ID(); ?>" class="list">

                                                </ul>
                                            </div>
                                        </div>
                                        <button type="submit" class="ui primary submit icon button">
                                            <i class="icon edit"></i>
                                            Ajouter un commentaire
                                        </button>
                                        <div id="hide_evaluation_comment_form<?php the_ID(); ?>" onclick="hide_evaluation_comment_form(<?php echo the_ID(); ?>)" class="ui black button"><?php echo __("Annuler", "gpdealdomain") ?></div>
                                    </form>
                                </div>
                                <div class="actions" style="margin-bottom: 1em">
                                    <a id="show_evaluation_comment_form<?php the_ID(); ?>" onclick="show_evaluation_comment_form(<?php echo the_ID(); ?>)" class="ui green button"><?php echo __("Commenter l'évaluation", "gpdealdomain") ?></a>
                                </div>
                            <?php endif ?>
                        </div>
                        <?php
                    endwhile;
                } else {
                    ?>
                    <div class="">
                        <div class="ui warning message">
                            <div class="content">
                                <div class="header" style="font-weight: normal;">
                                    Aucune évaluation de cette offre est disponible pour l'instant.
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
        <?php if ($package_id): ?>           
            <?php if (get_post_field('post_author', get_the_ID()) != $current_user->ID && !$current_user_evaluations->have_posts()): ?>
                <div id="block_evaluation_form" class="ui fluid card" style="display: none">
                    <div class="content">
                        <form id="evaluation_form" class="ui form" action="<?php the_permalink() ?>" method="POST">
                            <div class="fields">
                                <div class="four wide field"><label>Objets livrés :</label></div>
                                <div class="twelve wide field">
                                    <div class="inline fields">
                                        <div class="field">
                                            <div class="ui radio checkbox">
                                                <input type="radio" name="item_delivred" value="Oui">
                                                <label>Oui</label>
                                            </div>
                                        </div>
                                        <div class="field">
                                            <div class="ui radio checkbox">
                                                <input type="radio" name="item_delivred" value="Non">
                                                <label>Non</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="fields">
                                <div class="four wide field"><label>Etat des objets :</label></div>
                                <div class="twelve wide field">
                                    <div class="inline fields">                        
                                        <div class="field">
                                            <div class="ui radio checkbox">
                                                <input type="radio" name="item_state" value="Conforme">
                                                <label>Conforme</label>
                                            </div>
                                        </div>
                                        <div class="field">
                                            <div class="ui radio checkbox">
                                                <input type="radio" name="item_state" value="Non conforme">
                                                <label>Non conforme</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="fields">
                                <div class="four wide field"><label>Délais livraison  :</label></div>
                                <div class="twelve wide field">
                                    <input type="hidden" name="delivry_time" value="0">
                                    <div id="delivry_time" class="ui huge star rating" data-max-rating="5"></div>
                                    <div class="sub-title-rating"><span class="left-sub-title-rating">Insatisfait</span> <span class="right-sub-title-rating">Très satisfait</span></div>
                                </div>
                            </div>

                            <div class="fields">
                                <div class="four wide field"><label>Coût :</label></div>
                                <div class="twelve wide field">
                                    <input type="hidden" name="cost" value="0">
                                    <div id="cost" class="ui huge star rating" data-max-rating="5"></div>
                                    <div class="sub-title-rating"><span class="left-sub-title-rating">Onéreux</span> <span class="right-sub-title-rating">Economique</span></div>
                                </div>
                            </div>

                            <div class="fields">
                                <div class="four wide field"><label>Evaluation globale :</label></div>
                                <div class="twelve wide field">
                                    <input type="hidden" name="global_evaluation" value="0">
                                    <div id="global_evaluation" class="ui huge star rating" data-max-rating="5"></div>
                                    <div class="sub-title-rating"><span class="left-sub-title-rating">Insatisfait</span> <span class="right-sub-title-rating">Très satisfait</span></div>
                                </div>
                            </div>

                            <h4 class="ui dividing header">Laisser un commentaire </h4>
                            <div class="field">
                                <textarea name="comment_content"></textarea>
                            </div>
                            <input type="hidden" name="action" value="evaluate" >
                            <input type="hidden" name="package_id" value="<?php echo $package_id; ?>">
                            <div class="ui error message"><ul class="list"><li><?php echo __("Veuillez s'il vous plait répondre à toutes les questions", "gpdealdomain"); ?></li></ul></div>
                            <div class="field">                       
                                <div id="hide_block_evaluation_form" onclick="hide_block_evaluation_form()" class="ui black button right floated"><?php echo __("Annuler", "gpdealdomain") ?></div>
                                <button id="submit_evaluation_form" type="submit" class="ui submit primary button right floated">Evaluer</button>
                            </div>
                        </form>
                    </div>
                </div>
            <?php endif ?>
        <?php endif ?>
    </div>
</div>

