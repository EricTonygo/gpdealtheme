<?php
get_template_part('top-menu', get_post_format());
$type = removeslashes(esc_attr(trim($_POST['package_type'])));
$content = array_map('intval', isset($_POST['portable_objects']) ? $_POST['portable_objects'] : array());
$length = removeslashes(esc_attr(trim($_POST['package_dimensions_length'])));
$width = removeslashes(esc_attr(trim($_POST['package_dimensions_width'])));
$height = removeslashes(esc_attr(trim($_POST['package_dimensions_height'])));
$weight = removeslashes(esc_attr(trim($_POST['package_weight'])));
$start_city = removeslashes(esc_attr(trim($_POST['start_city'])));
$start_date_string = removeslashes(esc_attr(trim($_POST['start_date'])));
$destination_city = removeslashes(esc_attr(trim($_POST['destination_city'])));
$destination_date_string = removeslashes(esc_attr(trim($_POST['destination_date'])));
$terms = removeslashes(esc_attr(trim($_POST['terms'])));
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
    <!--div class="ui text container">
    </div-->
    <div class="ui signup_contenair basic segment container">
        <div class="ui attached message">
            <div class="header"><?php echo __("Saisir une expédition", 'gpdealdomain') ?> : </div>
            <p><?php echo __("Remplissez ci-dessous les informations de votre courrier/colis puis rechercher les transporteurs disponibles.", 'gpdealdomain') ?></p>
        </div>
        <div class="ui fluid card">
            <div class="content">
                <div class="ui top attached tabular menu">
                    <a class="item active" data-tab="first">Commencer l'expédition</a>
                    <a class="item" data-tab="second">Comment ça fonctionnne ?</a>
                </div>
                <div class="ui bottom attached tab segment active" data-tab="first">
                    <form id='send_package_form'  method="POST" action="<?php the_permalink(get_page_by_path(__('mon-compte', 'gpdealdomain') . '/' . __('expeditions', 'gpdealdomain'))); ?>" class="ui form" autocomplete="off">
                        
                        <h4 class="ui dividing header">DEPART <span style="color:red;">*</span></h4>
                        <div class="two wide fields">
                            <div class="field">
                                <div class="ui input left icon">
                                    <i class="marker icon"></i>
                                    <input id="start_city" type="text" name='start_city' placeholder="Ville de départ" value="<?php echo $start_city ?>">
                                </div>
                            </div>             
                            <div class="field">
                                <div class="ui calendar" >
                                    <div class="ui input left icon">
                                        <i class="calendar icon"></i>
                                        <input type="text" name='start_date' placeholder="Date" value="<?php echo $start_date_string ?>">
                                    </div>
                                </div>
                            </div>      
                        </div>

                        <h4 class="ui dividing header">DESTINATION <span style="color:red;">*</span></h4>
                        <div class="two wide fields">
                            <div class="field">
                                <div class="ui input left icon">
                                    <i class="marker icon"></i>
                                    <input id="destination_city" type="text" name='destination_city' placeholder="Ville de destination" value="<?php echo $destination_city ?>">
                                </div>
                            </div>             
                            <div class="field">
                                <div class="ui calendar" >
                                    <div class="ui input left icon">
                                        <i class="calendar icon"></i>
                                        <input type="text" name='destination_date' placeholder="Date" value="<?php echo $destination_date_string ?>">
                                    </div>
                                </div>
                            </div>      
                        </div>
                        <h4 class="ui dividing header">INFORMATIONS SUR LE COURRIER/COLIS</h4>
                        <div class="fields">
                            <div class="four wide field">
                                <label>Type <span style="color:red;">*</span></label>
                            </div>
                            <div class="twelve wide field">
                                <select name="package_type" class="ui search fluid dropdown" data-validate="package_type">
                                    <option value="">Type de courrier/colis</option>
                                    <?php
                                    $type_packages = get_terms(array('taxonomy' => 'type_package', 'hide_empty' => false, 'orderby' => 'ID', 'order' => 'ASC'));
                                    foreach ($type_packages as $type_package):
                                        ?>
                                        <option value="<?php echo $type_package->term_id; ?>" <?php if ($type == $type_package->term_id): ?> selected="selected" <?php endif ?>><?php echo $type_package->name; ?></option>
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
                                    <option value="">Contenu du courrier/colis</option>
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
                                <input type="checkbox" name="terms" <?php if ($terms == 'on'): ?> checked="checked" <?php endif ?>> 
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
                            <button id="submit_send_package" class="ui right floated green button" type="submit">Enregistrer l'expédition</button>
                        </div>
                    </form>
                </div>
                <div class="ui bottom attached tab segment" data-tab="second"> 
                    Comment ça fonctionne
                </div>

            </div>
        </div>
    </div>
</div>

