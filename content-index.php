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
<div id="bgImage0" class="cycle_bg_image"  style="background-image: url('/gpdeal/wp-content/themes/gpdealtheme/assets/images/slide-image-1.jpg');"></div>
<div id="bgImage1" class="cycle_bg_image" style="background-image: url('/gpdeal/wp-content/themes/gpdealtheme/assets/images/slide-image-2.jpg'); display: none;"></div>
<div id="bgImage2" class="cycle_bg_image" style="background-image: url('/gpdeal/wp-content/themes/gpdealtheme/assets/images/slide-image-3.jpg'); display: none;"></div>
<div id="bgImage3" class="cycle_bg_image" style="background-image: url('/gpdeal/wp-content/themes/gpdealtheme/assets/images/slide-image-4.jpg'); display: none;"></div>
<div id='feature_homepage' class="ui vertical feature_homepage masthead segment" >
    <div  class="ui container">
        <div class="ui top attached tabular menu">
            <a class="<?php if ($submit_search_transport_offers == "yes" || ($submit_search_transport_offers != "yes" && $submit_search_unsatisfied_packages != "yes")): ?> active <?php endif ?> item" data-tab="search_carriers"><?php _e('find_TO_form_title', 'gpdealdomain') ?></a>
            <a class="<?php if ($submit_search_unsatisfied_packages == "yes"): ?> active <?php endif ?>item" data-tab="search_packages_unsatisfied"><?php _e('find_package_form_title', 'gpdealdomain'); ?></a>
        </div>
        <div class="ui bottom attached active tab segment" data-tab="search_carriers">
            <div id="content_search_carrier_form" class="ui fluid card">
                <div class="content">
                    <form id='search_transport_offers_form'  method="GET" action="<?php echo wp_make_link_relative(get_permalink(get_page_by_path(__('search-for-transport-offers', 'gpdealdomain')))); ?>" class="ui form" autocomplete="off">
                        <div class="two wide fields">
                            <div class="field">
                                <div class="ui input icon start_city_transport">
                                    <i class="remove link icon start_city_transport" style="display: none;" locality_id='start_city_transport'></i>
                                    <input id="start_city_transport" class="locality" type="text" name='start-city' placeholder="<?php _e('Departure city', 'gpdealdomain'); ?>" value="<?php echo $start_city ?>">
                                </div>
                            </div>             
                            <div class="field">
                                <div class="ui calendar" >
                                    <div class="ui input left icon">
                                        <i class="calendar icon"></i>
                                        <input type="text" name='start-date' placeholder="<?php _e('Departure date', 'gpdealdomain'); ?> " value="<?php echo $start_date ?>">
                                    </div>
                                </div>
                            </div>      
                        </div>

                        <div class="two wide fields">
                            <div class="field">
                                <div class="ui input icon destination_city_transport">
                                    <i class="remove link icon destination_city_transport" style="display: none;" locality_id='destination_city_transport'></i>
                                    <input id="destination_city_transport" class="locality" type="text" name='destination-city' placeholder="<?php _e('Destination city', 'gpdealdomain') ?>" value="<?php echo $destination_city ?>">
                                </div>
                            </div>             
                            <div class="field">
                                <div class="ui calendar" >
                                    <div class="ui input left icon">
                                        <i class="calendar icon"></i>
                                        <input type="text" name='destination-date' placeholder="<?php _e("Destination date", 'gpdealdomain') ?>" value="<?php echo $destination_date ?>">
                                    </div>
                                </div>
                            </div>     
                        </div>
                        <div class="fields">
                            <div style="margin-left: 0.6em" class="inline fields">
                                <span class="span_label" style="margin-right: 1.3em;"><?php echo __("Object", 'gpdealdomain') ?>(s)<i class="help circle green link icon tooltip">
                                        <span class="tooltiptext"><?php echo __("Several possible choices", "gpdealdomain") ?></span>
                                    </i>
                                </span>
                                <?php
                                $typePackages = get_terms(array('taxonomy' => 'type_package', 'hide_empty' => false, 'orderby' => 'ID', 'order' => 'ASC'));
                                foreach ($typePackages as $typePackage):
                                    ?>
                                    <div class="field">
                                        <div class="ui checkbox">
                                            <input type="checkbox" name="package-type[]" value="<?php echo $typePackage->term_id; ?>" <?php if (in_array($typePackage->term_id, $package_type, true)): ?> checked="checked" <?php endif ?>>
                                            <label><?php echo __($typePackage->name, "gpdealdomain"); ?> <i class="big green <?php echo getIconNameByLabelName($typePackage->name);?> icon"></i></label>
                                        </div>
                                    </div>
                                <?php endforeach ?>
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
                            <button id="submit_search_transport_offers" class="ui right floated green button" type="submit"><?php echo __("Search carriers", "gpdealdomain") ?></button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="ui bottom attached tab segment" data-tab="search_packages_unsatisfied"> 
            <div id="content_search_packages_form" class="ui fluid card">
                <div class="content">
                    <form id='search_unsatisfied_packages_form'  method="GET" action="<?php echo wp_make_link_relative(get_permalink(get_page_by_path(__('search-for-unsatisfied-shipments', 'gpdealdomain')))); ?>" class="ui form" autocomplete="off">
                        <div class="two wide fields">
                            <div class="field">
                                <div class="ui input  icon start_city_package">
                                    <i class="remove link icon start_city_package" style="display: none;" locality_id='start_city_package'></i>
                                    <input id="start_city_package" type="text" class="locality" name='start-city' placeholder="<?php _e('Departure city', 'gpdealdomain'); ?>" value="<?php echo $start_city ?>">
                                </div>
                            </div>             
                            <div class="field">
                                <div class="ui calendar" >
                                    <div class="ui input left icon">
                                        <i class="calendar icon"></i>
                                        <input type="text" name='start-date' placeholder="<?php _e('Departure date', 'gpdealdomain'); ?>" value="<?php echo $start_date ?>">
                                    </div>
                                </div>
                            </div>      
                        </div>

                        <div class="two wide fields">
                            <div class="field">
                                <div class="ui input icon destination_city_package">
                                    <i class="remove link icon destination_city_package" style="display: none;" locality_id='destination_city_package'></i>
                                    <input id="destination_city_package" type="text" class="locality" name='destination-city' placeholder="<?php _e('Destination city', 'gpdealdomain'); ?>" value="<?php echo $destination_city ?>">
                                </div>
                            </div>             
                            <div class="field">
                                <div class="ui calendar" >
                                    <div class="ui input left icon">
                                        <i class="calendar icon"></i>
                                        <input type="text" name='destination-date' placeholder="<?php _e('Destination date', 'gpdealdomain'); ?>" value="<?php echo $destination_date ?>">
                                    </div>
                                </div>
                            </div>     
                        </div>
                        <div class="fields">
                            <div style="margin-left: 0.6em" class="inline fields">
                                <span class="span_label" style="margin-right: 1.3em;"><?php echo __("Object", 'gpdealdomain') ?>(s)<i class="help circle green link icon tooltip">
                                        <span class="tooltiptext"><?php echo __("Several possible choices", "gpdealdomain") ?></span>
                                    </i>
                                </span>
                                <?php
                                $typePackages = get_terms(array('taxonomy' => 'type_package', 'hide_empty' => false, 'orderby' => 'ID', 'order' => 'ASC'));
                                foreach ($typePackages as $typePackage):
                                    ?>
                                    <div class="field">
                                        <div class="ui checkbox">
                                            <input type="checkbox" name="package-type[]" value="<?php echo $typePackage->term_id; ?>" <?php if (in_array($typePackage->term_id, $package_type, true)): ?> checked="checked" <?php endif ?>>
                                            <label><?php echo __($typePackage->name, "gpdealdomain"); ?> <i class="big green <?php echo getIconNameByLabelName($typePackage->name);?> icon"></i></label>
                                        </div>
                                    </div>
                                <?php endforeach ?>
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
                            <button id="submit_search_unsatisfied_packages" class="ui right floated green button" type="submit"><?php echo __("Search shippers", "gpdealdomain") ?></button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

