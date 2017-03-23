<?php
get_template_part('top-menu', get_post_format());
$package_type = array_map('intval', isset($_POST['package_type']) ? $_POST['package_type'] : array());
$transport_method = array_map('intval', isset($_POST['transport_method']) ? $_POST['transport_method'] : array());
$start_city = removeslashes(esc_attr(trim($_POST['start_city'])));
$start_date = removeslashes(esc_attr(trim($_POST['start_date'])));
$destination_city = removeslashes(esc_attr(trim($_POST['destination_city'])));
$destination_date = removeslashes(esc_attr(trim($_POST['destination_date'])));
$submit_search_transport_offers = $_POST["submit_search_transport_offers"];
$submit_search_unsatisfied_packages = $_POST["submit_search_unsatisfied_packages"];
?>
<?php

use Themosis\Metabox\Meta;

$slider = Meta::get(get_the_ID(), 'my-featured-image');
$promotional_text = Meta::get(get_the_ID(), 'promotional-text');
$button_text = Meta::get(get_the_ID(), 'button-text');
if ($slider):
    ?>
    <div id='feature_homepage' class="ui vertical feature_homepage masthead  segment" style="background-image: url(<?php echo wp_get_attachment_image_src($slider, 'my-featured-image')[0] ?>); ">
        <div class="ui container">
            <!--            <h1 class="ui inverted header">
            <?php echo $promotional_text; ?>
                        </h1>
                        <h3></h3>
                        <a href="#block_search_carriers" class="ui huge green button"><i class="search icon"></i> <?php echo $button_text; ?> </a>-->
            <div class="ui top attached tabular menu">
                <a class="<?php if( $submit_search_transport_offers == "yes" || ($submit_search_transport_offers != "yes" && $submit_search_unsatisfied_packages != "yes")): ?> active <?php endif ?> item" data-tab="search_carriers">Offres transports</a>
                <a class="<?php if($submit_search_unsatisfied_packages == "yes"): ?> active <?php endif ?>item" data-tab="search_packages_unsatisfied">Demandes transports</a>
            </div>
            <div class="ui bottom attached active tab segment" data-tab="search_carriers">
                <div id="content_search_carrier_form" class="ui fluid card">
                    <div class="content">
                        <form id='search_transport_offers_form'  method="POST" action="<?php the_permalink(get_page_by_path(__('rechercher-les-offres-de-transport', 'gpdealdomain'))); ?>" class="ui form">
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
                                <div class="four wide field">
                                    <label><?php echo __("OBJET(S)", 'gpdealdomain') ?> :</label>
                                    <span style="font-size: 12px"><?php echo "(" . __("Plusieurs choix possibles", "gpdealdomain") . ")" ?></span>
                                </div>
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
                                <input type="hidden" name='save_account' value='no'>
                                <button id="submit_search_transport_offers" name="submit_search_transport_offers" value="yes" class="ui right floated green button" type="submit"><?php echo __("Rechercher transporteurs", "gpdealdomain") ?></button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="ui bottom attached tab segment" data-tab="search_packages_unsatisfied"> 
                <div id="content_search_packages_form" class="ui fluid card">
                    <div class="content">
                        <form id='search_unsatisfied_packages_form'  method="POST" action="<?php the_permalink(get_page_by_path(__('rechercher-les-expeditions-non-satisfaites', 'gpdealdomain'))); ?>" class="ui form">
                            <div class="two wide fields">
                                <div class="field">
                                    <div class="ui input left icon">
                                        <i class="marker icon"></i>
                                        <input id="start_city_package" type="text" name='start_city' placeholder="Ville de départ" value="<?php echo $start_city ?>">
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
                                        <input id="destination_city_package" type="text" name='destination_city' placeholder="Ville de destination" value="<?php echo $destination_city ?>">
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
                                <div class="four wide field">
                                    <label><?php echo __("OBJET(S)", 'gpdealdomain') ?> :</label>
                                    <span style="font-size: 12px"><?php echo "(" . __("Plusieurs choix possibles", "gpdealdomain") . ")" ?></span>
                                </div>
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


                            <div class="field">
                                <div id="server_error_message_package" class="ui negative message" style="display:none">
                                    <i class="close icon"></i>
                                    <div id="server_error_content_package" class="header">Internal server error</div>
                                </div>
                                <div id="error_name_message_package" class="ui error message" style="display: none">
                                    <i class="close icon"></i>
                                    <div id="error_name_header_package" class="header"></div>
                                    <ul id="error_name_list_package" class="list">

                                    </ul>
                                </div>
                            </div>

                            <div class="field">
                                <input type="hidden" name='save_account' value='no'>
                                <button id="submit_search_unsatisfied_packages" name="submit_search_unsatisfied_packages" value="yes"  class="ui right floated green button" type="submit"><?php echo __("Rechercher expéditeurs", "gpdealdomain") ?></button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php endif ?>
<!--<div  class="ui vertical masthead  segment container">
    div class="ui text container">
    </div
    <div class="ui stackable grid">
        <div class="four wide column">
            <p><strong><i>Information pratiques & publicités sur les transports (texte défilant veticalement)</i></strong></p>
            <div class="ui segment">
                <div class="owl-carousel" id="single-slider">
                    <div class="item">
                        <p><img class="ui rounded image" src="<?php echo get_template_directory_uri() ?>/assets/images/400x400.png"></p>
                    </div>
                    <div class="item">
                        <p><img class="ui rounded image" src="<?php echo get_template_directory_uri() ?>/assets/images/400x400.png"></p>
                    </div>
                </div>
            </div>
            <div id="card_pub_left" class="ui fluid card">
                <div class="content">
                    <div class="ui list">
                        <div class="header"><strong>Professionels du transport</strong></div>
                        <div class="item"><i class="checkmark icon"></i><div class="content">Developper votre activité partout dans le monde </div></div>

                    </div>
                    <div class="ui list">
                        <div class="header"><strong>Particuliers</strong></div>
                        <div class="item"><i class="checkmark icon"></i><div class="content">Trouvez une solution economique, simple, rapide, pratique et éfficace à vos excédents de bagage, vos envois de courriers/colis </div></div>
                        <div class="item"><i class="checkmark icon"></i><div class="content">Gagnez de l'argent en négociant kilos non utilisés lors de vos voyages.</div></div>
                    </div>
                    <div class="ui list">
                        <div class="header"><strong>Dernière informations sur le transport</strong></div>
                        <div class="item"><i class="checkmark icon"></i><div class="content"> ... </div></div>
                    </div>
                    <div class="ui list">
                        <div class="header"><strong>Outil et guide pour reussir son envoi ou transport de colis</strong></div>
                        <div class="item"><i class="checkmark icon"></i><div class="content"> ... </div></div>
                    </div>
                </div>
            </div>
        </div>
        <div id='block_search_carriers' class="eight wide column">
            <div id="content_search_carrier_form" class="ui fluid card">
                                <div class="content center aligned">
                                    <div class="header">Rechercher des transporteurs</div>
                                </div>
                <div class="content">            
                </div>
            </div>
        </div>
        <div class="four wide column">
<?php if (!is_user_logged_in()): ?>

<?php endif ?>
            <div class="ui segment">
                <div class="owl-carousel" id="single-second-slider">
                    <div class="item">
                        <p><img class="ui rounded image" src="<?php echo get_template_directory_uri() ?>/assets/images/400x400.png"></p>
                    </div>
                    <div class="item">
                        <p><img class="ui rounded image" src="<?php echo get_template_directory_uri() ?>/assets/images/400x400.png"></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>-->

