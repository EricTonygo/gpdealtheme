<?php
get_template_part('top-menu', get_post_format());
if (isset($_SERVER['REQUEST_METHOD']) && $_SERVER['REQUEST_METHOD'] == 'POST') {
    $package_type = array_map('intval', isset($_POST['transport_offer_package_type']) ? $_POST['transport_offer_package_type']: array());
    $transport_method = array_map('intval', array(removeslashes(esc_attr(trim($_POST['transport_offer_transport_method'])))));
    $transport_offer_price = removeslashes(esc_attr(trim($_POST['transport_offer_price'])));
    $transport_offer_currency = removeslashes(esc_attr(trim($_POST['transport_offer_currency'])));
    $start_city = removeslashes(esc_attr(trim($_POST['start_city'])));
    $start_date = removeslashes(esc_attr(trim($_POST['start_date'])));
    $deadline_proposition = removeslashes(esc_attr(trim($_POST['start_deadline'])));
    $destination_country = removeslashes(esc_attr(trim($_POST['destination_country'])));
    $destination_state = removeslashes(esc_attr(trim($_POST['destination_state'])));
    $destination_city = removeslashes(esc_attr(trim($_POST['destination_city'])));
    $destination_date = removeslashes(esc_attr(trim($_POST['destination_date'])));
    $terms = removeslashes(esc_attr(trim($_POST['terms'])));
    $action = removeslashes(esc_attr(trim($_POST['action'])));
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
    
    <div id='edit_transport_offer_infos' class="ui signup_contenair basic segment container" <?php if ($action == null || $action == 'show' || $action == 'evaluate_close'): ?> style="display: none;" <?php endif ?>>
        <div class="ui attached message">
            <div class="header"><?php echo __("Mofication de l' offre de transport", 'gpdealdomain') ?> : </div>
            <p><?php echo __("Modifier les informations ci-dessous de votre offre de transport puis enregistrer à nouveau.", 'gpdealdomain') ?></p>
        </div>
        <div class="ui fluid card">
            <div class="content">
                <div class="ui top attached tabular menu">
                    <a class="item active" data-tab="first">Offre de transport</a>
                    <a class="item" data-tab="second">Comment ça fonctionnne ?</a>
                </div>
                <div class="ui bottom attached tab segment active" data-tab="first">
                    <form id='write_transport_offer_form'  method="POST" action="<?php the_permalink(); ?>" class="ui form">
                        
                        <h4 class="ui dividing header">DEPART <span style="color:red;">*</span></h4>
                        <div class="two wide fields">
                            <div class="field">
                                <input id="start_city" type="text" name='start_city' placeholder="Ville de départ" value="<?php echo $start_city.", ".$start_state.", ".$start_country ?>">
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

                        <h4 class="ui dividing header">DESTINATION <span style="color:red;">*</span></h4>
                        <div class="two wide fields">
                            <div class="field">
                                <input id="destination_city" type="text" name='destination_city' placeholder="Ville de destination" value="<?php echo $destination_city.", ".$destination_state.", ".$destination_country ?>">
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
                        <h4 class="ui dividing header">DATE LIMITE DE PROPOSITION <span style="color:red;">*</span></h4>
                        <div class="field">
                            <div class="ui calendar" >
                                <div class="ui input left icon">
                                    <i class="calendar icon"></i>
                                    <input type="text" name='start_deadline' placeholder="Date limite de proposition" value="<?php echo $deadline_proposition ?>">
                                </div>
                            </div>
                        </div>      
                        <h4 class="ui dividing header"><?php echo __("INFORMATIONS SUR L'OFFRE DE TRANSPORT", 'gpdealdomain') ?></h4>
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
                                <label><span style="color:red;">*</span> Je reconnais avoir pris de la liste des <a href="#">objets prohibés au transport</a>.</label>
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
                        <div class="field">
                            <input type="hidden" name='action' value='edit'>
                            <button id="cancel_edit_transport_offer_infos_btn" class="ui green button" >Annuler la modification</button>
                            <button id="submit_send_transport_offer" class="ui right floated green button" type="submit">Enregistrer l'offre</button>
                        </div>
                    </form>
                </div>
                <div class="ui bottom attached tab segment" data-tab="second"> 
                    Comment ça fonctionne
                </div>
            </div>
        </div>
    </div>
    <div id='show_transport_offer_infos' class="ui signup_contenair basic segment container" <?php if ($action && $action == 'edit'): ?> style="display: none;" <?php endif ?> >
        <div  class="ui fluid card">
            <div class="content">
                <div class="ui form">
                    
                    <h4 class="ui dividing header">DEPART </h4>
                    <div class="four wide fields">
                        <div class="field">
                            <label>Pays </label>
                            <span><?php echo $start_country; ?></span>
                        </div>
                        <div class="field">
                            <label>Région/Etat </label>
                            <span><?php echo $start_state; ?></span>
                        </div>
                        <div class="field">
                            <label>Ville </label>
                            <span><?php echo $start_city; ?></span>
                        </div>
                        <div class="field">
                            <label>Date</label>
                            <span><?php echo $start_date; ?></span>
                        </div>   
                    </div>

                    <h4 class="ui dividing header">DESTINATION </h4>
                    <div class="four wide fields">
                        <div class="field">
                            <label>Pays </label>
                            <span><?php echo $destination_country; ?></span>
                        </div>
                        <div class="field">
                            <label>Région/Etat </label>
                            <span><?php echo $destination_state; ?></span>
                        </div>
                        <div class="field">
                            <label>Ville </label>
                            <span><?php echo $destination_city; ?></span>
                        </div>
                        <div class="field">
                            <label>Date</label>
                            <span><?php echo $destination_date; ?></span>
                        </div>   
                    </div>
                    <h4 class="ui dividing header">DATE LIMITE DES PROPOSITIONS </h4>
                    <div class="fields">
                        <div class="field">
                            <span><?php echo $deadline_proposition; ?></span>
                        </div>   
                    </div>
                    <h4 class="ui dividing header">INFORMATIONS SUR LE COURRIER/COLIS</h4>
                    <div class="fields">
                        <div class="four wide field">
                            <label>Objet(s) :</label>
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
                                            <span><?php echo $name; ?>, </span>
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
                            <label>Mode de transport :</label>
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
                                            <span><?php echo $name; ?>, </span>
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

                    <?php
                    $package_ids = get_post_meta(get_the_ID(), 'carrier-ID', true);
                    if (is_array($package_ids)) {
                        $package_ids = array_map('intval', $package_ids);
                    } else {
                        $package_ids = null;
                    }
                    ?>
                    <h4 class="ui dividing header">COURRIERS/COLIS</h4>
                    <div class="fields">
                        <?php if ($package_ids): ?>
                            <div class="four wide field">
                                <label>Numéros de courriers :</label>
                            </div>
                            <div class="twelve wide field">
                                <div class="inline fields">
                                    <div class="field">
                                        <?php
                                        $package_ids_count = count($package_ids);
                                        $i = 0;
                                        foreach ($package_ids as $id) :
                                            ?>
                                            <?php if ($i < $package_ids_count - 1) : ?>
                                                <span><?php echo get_post_met($id, 'package-number', true); ?>, </span>
                                            <?php else: ?>
                                                <span><?php echo get_post_met($id, 'package-number', true); ?></span>
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
                    <h4 class="ui dividing header">INFORMATIONS SUR LE TRANSPORT</h4>
                    <div class="fields">
                        <div class="four wide field">
                            <label>Statut :</label>
                        </div>
                        <div class="twelve wide field">
                            <div class="inline fields">
                                <div class="field">
                                    <span><?php echo getTransportStatus(intval(get_post_meta(get_the_ID(), 'transport-state', true))); ?></span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="field" style="margin-top: 4em">
                        <button id="edit_transport_offer_infos_btn" class="ui right floated green button" >Modifier l'offre</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

