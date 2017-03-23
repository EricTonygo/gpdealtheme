<?php
get_template_part('top-menu', get_post_format());
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
    <!--div class="ui text container">
    </div-->
    <div class="ui signup_contenair basic segment container">
        <div class="ui attached message">
            <div class="header"><?php echo __("Saisir une offre de transport", 'gpdealdomain') ?> : </div>
            <p><?php echo __("Remplissez ci-dessous les informations de votre offre de transport puis enregistrer.", 'gpdealdomain') ?></p>
        </div>
        <div class="ui fluid card">
            <div class="content">
                <div class="ui top attached tabular menu">
                    <a class="item active" data-tab="first">Offre de transport</a>
                    <a class="item" data-tab="second">Comment ça fonctionnne ?</a>
                </div>
                <div class="ui bottom attached tab segment active" data-tab="first">
                    <form id='write_transport_offer_form'  method="POST" action="<?php the_permalink(get_page_by_path(__('mon-compte', 'gpdealdomain') . '/' . __('offres-de-transport', 'gpdealdomain'))); ?>" class="ui form">
                        
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
                                    <input id="destination_city" type="text" name='destination_city' placeholder="Ville de destination" value="<?php echo $destination_city ?>">
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
                                <label><?php echo __("Type de courrier/colis", 'gpdealdomain') ?> <span style="color:red;">*</span></label>
                            </div>
                            <div class="twelve wide field">
                                <select name="transport_offer_package_type[]" class="ui fluid multiple search normal selection dropdown" multiple="" data-validate='transport_offer_package_type'>
                                    <option value="">Objets à envoyer </option>
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
                                <input type="checkbox" name="terms" <?php if ($terms == 'on'): ?> checked="checked" <?php endif ?>> 
                                <label><span style="color:red;">*</span> Je reconnais avoir pris de la liste des <a href="#">objets prohibés au transport</a>.</label>
                            </div

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
                                <button id="submit_transport_offer" class="ui right floated green button" type="submit">Enregistrer l'offre</button>
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

