<?php
get_template_part('top-menu', get_post_format());
    global $current_user;
    $type = wp_get_post_terms(get_the_ID(), 'type_package', array("fields" => "ids"));
    $content = wp_get_post_terms(get_the_ID(), 'portable-object', array("fields" => "ids"));
    $length = get_post_meta(get_the_ID(), 'length', true);
    $width = get_post_meta(get_the_ID(), 'width', true);
    $height = get_post_meta(get_the_ID(), 'height', true);
    $weight = get_post_meta(get_the_ID(), 'weight', true);
    $start_country = get_post_meta(get_the_ID(), 'departure-country-package', true);
    $start_state = get_post_meta(get_the_ID(), 'departure-state-package', true);
    $start_city = get_post_meta(get_the_ID(), 'departure-city-package', true);
    $start_date = date('d-m-Y', strtotime(get_post_meta(get_the_ID(), 'date-of-departure-package', true)));
    $destination_country = get_post_meta(get_the_ID(), 'destination-country-package', true);
    $destination_state = get_post_meta(get_the_ID(), 'destination-state-package', true);
    $destination_city = get_post_meta(get_the_ID(), 'destination-city-package', true);
    $destination_date = date('d-m-Y', strtotime(get_post_meta(get_the_ID(), 'arrival-date-package', true)));
    $action = removeslashes(esc_attr(trim($_GET['action'])));

?>
<div class="ui large borderless second-nav menu">
    <div class="ui container center aligned">
        <div class="center menu">
            <div class="item">
                <a href="<?php echo home_url('/') ?>" class="section"><?php echo get_page_by_path(__('accueil', 'gpdealdomain'))->post_title ?></a>
                <i class="right chevron icon divider"></i>
                <a href="<?php echo get_permalink(get_page_by_path(__('mon-compte', 'gpdealdomain'))) ?>" class="section"><?php echo get_page_by_path(__('mon-compte', 'gpdealdomain'))->post_title ?></a>
                <i class="right chevron icon divider"></i>
                <a href="<?php echo get_permalink(get_page_by_path(__('mon-compte', 'gpdealdomain') . '/' . __('expeditions', 'gpdealdomain'))) ?>" class="section"><?php echo get_page_by_path(__('mon-compte', 'gpdealdomain') . '/' . __('expeditions', 'gpdealdomain'))->post_title ?></a>
                <i class="right arrow icon divider"></i>
                <div class="active section"><?php the_title(); ?></div>
            </div>
        </div>
    </div>
</div>
<div class="ui vertical masthead  segment container">
    <div id='edit_package_infos' class="ui signup_contenair basic segment container" <?php if ($action == null || $action == 'show' || $action == 'evaluate_close'): ?> style="display: none;" <?php endif ?>>
        <div class="ui attached message">
            <div class="header"><?php echo __("Modification de l'expédition", 'gpdealdomain') ?> : </div>
            <p><?php echo __("Remplissez les informations ci-dessous de votre expédition puis rechercher à nouveau les transporteurs disponibles.", 'gpdealdomain') ?></p>
        </div>
        <div class="ui fluid card">
            <div class="content">
                <div class="ui top attached tabular menu">
                    <a class="item active" data-tab="first">Commencer l'expédition</a>
                    <a class="item" data-tab="second">Comment ça fonctionnne ?</a>
                </div>
                <div class="ui bottom attached tab segment active" data-tab="first">
                    <form id='send_package_form'  method="POST" action="<?php the_permalink(get_page_by_path(__('selectionner-les-offres-de-transport', 'gpdealdomain'))); ?>" class="ui form" autocomplete="off">

                        <h4 class="ui dividing header">DEPART <span style="color:red;">*</span></h4>
                        <div class="two wide fields">
                            <div class="field">
                                <div class="ui input left icon">
                                    <i class="marker icon"></i>
                                    <input id="start_city" type="text" name='start_city' placeholder="Ville de départ" value="<?php echo $start_city . ", " . $start_state . ", " . $start_country ?>">
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

                        <h4 class="ui dividing header">DESTINATION <span style="color:red;">*</span></h4>
                        <div class="two wide fields">
                            <div class="field">
                                <div class="ui input left icon">
                                    <i class="marker icon"></i>
                                    <input id="destination_city" type="text" name='destination_city' placeholder="Ville de destination" value="<?php echo $destination_city . ", " . $destination_state . ", " . $destination_country ?>">
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
                        <h4 class="ui dividing header">INFORMATIONS SUR LE COURRIER/COLIS</h4>
                        <div class="fields">
                            <div class="four wide field">
                                <label>Objet <span style="color:red;">*</span></label>
                            </div>
                            <div class="twelve wide field">
                                <select name="package_type" class="ui search fluid dropdown" data-validate="package_type">
                                    <option value="">Objet à expédier</option>
                                    <?php
                                    $type_packages = get_terms(array('taxonomy' => 'type_package', 'hide_empty' => false, 'orderby' => 'ID', 'order' => 'ASC'));
                                    foreach ($type_packages as $type_package):
                                        ?>
                                        <option value="<?php echo $type_package->term_id; ?>" <?php if (in_array($type_package->term_id, $type, true)): ?> selected="selected" <?php endif ?>><?php echo $type_package->name; ?></option>
                                    <?php endforeach ?>
                                </select>
                            </div>
                        </div>
                        <div class="fields">
                            <div class="four wide field">
                                <label>Contenu <span style="color:red;">*</span></label>
                            </div>
                            <div class="twelve wide field">
                                <select name="portable_objects[]" class="ui search dropdown" multiple="multiple" data-validate="portable_objects">
                                    <option value="">Contenu</option>
                                    <?php
                                    $portable_objects = get_terms(array('taxonomy' => 'portable-object', 'hide_empty' => false, 'orderby' => 'ID', 'order' => 'ASC'));
                                    foreach ($portable_objects as $portable_object):
                                        ?>
                                        <option value="<?php echo $portable_object->term_id; ?>" <?php if (is_array($content) && in_array($portable_object->term_id, $content, true)): ?> selected="selected" <?php endif ?>><?php echo $portable_object->name; ?></option>
                                    <?php endforeach ?>
                                </select>
                            </div>
                        </div>

                        <div class="fields">
                            <div class="four wide field">
                                <label>Dimensions/Poids <span style="color:red;">*</span></label>
                            </div>
                            <div class="twelve wide field">
                                <div class="four wide fields">
                                    <div class="field">
                                        <input type="text" name="package_dimensions_length" placeholder="Longueur" value="<?php echo $length; ?>">
                                    </div>
                                    <div class="field">
                                        <input type="text" name="package_dimensions_width" placeholder="Largeur" value="<?php echo $width; ?>">
                                    </div>
                                    <div class="field">
                                        <input type="text" name="package_dimensions_height" placeholder="Hauteur" value="<?php echo $height; ?>">
                                    </div>
                                    <div class="field">
                                        <input type="text" name="package_weight" placeholder="Poids" value="<?php echo $weight; ?>">
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
                            <input type="hidden" name='package_id' value='<?php the_ID()?>'>
                            <button id="cancel_edit_package_infos_btn" class="ui green button" >Annuler la modification</button>
                            <button id="submit_send_package" class="ui right floated green button" name="submit_update_send_package" value="yes" type="submit">Rechercher transporteur</button>
                        </div>
                    </form>
                </div>
                <div class="ui bottom attached tab segment" data-tab="second"> 
                    Comment ça fonctionne
                </div>
            </div>
        </div>
    </div>
    <div id='show_package_infos' class="ui signup_contenair basic segment container" <?php if ($action && $action == 'edit'): ?> style="display: none;" <?php endif ?> >
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
                    <h4 class="ui dividing header">INFORMATIONS SUR LE COURRIER/COLIS</h4>
                    <div class="fields">
                        <div class="four wide field">
                            <label>Type :</label>
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
                                    $portable_object_list = wp_get_post_terms(get_the_ID(), 'portable-object', array("fields" => "names"));
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
                                    <span><?php echo $length; ?></span>
                                </div>
                                <div class="field">
                                    <label>Largeur </label>
                                    <span><?php echo $width; ?></span>
                                </div>
                                <div class="field">
                                    <label>Hauteur </label>
                                    <span><?php echo $height; ?></span>
                                </div>
                                <div class="field">
                                    <label>Poids</label>
                                    <span><?php echo $weight; ?></span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php
                    $carrier_ids = get_post_meta(get_the_ID(), 'carrier-ID', true);
                    if ($carrier_ids != -1 && is_array($carrier_ids)) {
                        $carrier_ids = array_map('intval', $carrier_ids);
                    } else {
                        $carrier_ids = null;
                    }
                    ?>
                    <?php if ($carrier_ids): ?>
                        <h4 class="ui dividing header">TRANSPORTEUR(S) </h4>
                        <div class="fields">
                            <!--                            <div class="four wide field">
                                                            <label>Numéros de courriers :</label>
                                                        </div>-->
                            <div class="sixteen wide field">
                                <div class="inline fields">
                                    <div class="field">
                                        <?php
                                        $carrier_ids_count = count($carrier_ids);
                                        $i = 0;
                                        foreach ($carrier_ids as $id) :
                                            $post_author = get_post_field('post_author', $id);
                                            $carrier_name = $current_user->ID == $post_author ? __("Vous", "gpdealdomain"): get_the_author_meta('user_login', $post_author);
                                            ?>
                                            <?php 
                                            if ($i < $carrier_ids_count - 1) : ?>
                                                <span><a href="<?php the_permalink($id) ?>"><?php echo $carrier_name." (".__("Transporteur", "gpdealdomain")." ".get_user_role_by_user_id($post_author).")"; ?></a>, </span>
                                            <?php else: ?>
                                                <span><a href="<?php the_permalink($id) ?>"><?php echo $carrier_name." (".__("Transporteur", "gpdealdomain")." ".get_user_role_by_user_id($post_author).")"; ?></a> </span>
                                            <?php endif ?>
                                            <?php
                                            $i++;
                                        endforeach
                                        ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endif ?>
                    <div class="field" style="margin-top: 4em">
                        <button id="edit_package_infos_btn" class="ui green button">Modifier l'expédition</button>
                        <?php if(get_post_meta(get_the_ID(), 'carrier-ID', true) == -1): ?>
                        <a class="ui right floated green button" name="search_transport_offers" href="<?php echo esc_url(add_query_arg(array('package-id' => get_the_ID()), the_permalink(get_page_by_path(__('selectionner-les-offres-de-transport', 'gpdealdomain')))))?>" type="submit">Rechercher transporteurs</a>
                        <?php else: ?>
                        <!--<a class="ui right floated green button" name="search_transport_offers" href="<?php echo esc_url(add_query_arg(array('package-id' => get_the_ID()), the_permalink(get_page_by_path(__('selectionner-les-offres-de-transport', 'gpdealdomain')))))?>" type="submit">Enregistrer la transaction</a>-->
                        <?php endif ?>
                        <?php if(get_post_meta(get_the_ID(), 'package-status', true) == 2): ?>
                        <button id="evaluate_close_send_package_btn" class="ui right floated red button">Evaluer / Fermer</button>
                        <?php endif ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

