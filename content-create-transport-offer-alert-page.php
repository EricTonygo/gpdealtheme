<?php
get_template_part('top-menu', get_post_format());
?>
<div class="ui tiny borderless second-nav menu">
    <div class="ui container center aligned">
        <div class="center menu">
            <div class="item">
                <a href="<?php echo wp_make_link_relative(home_url('/')); ?>" class="section"><?php echo get_page_by_path(__('home', 'gpdealdomain'))->post_title ?></a>
                <i class="small right arrow icon divider"></i>
                <div class="active section"><?php the_title(); ?></div>
            </div>
        </div>
    </div>
</div>
<div class="ui vertical masthead segment container review_confirm">
    <div class="ui signup_contenair basic segment container content_without_white">
        <div class="ui attached segment select_transport_offers content_without_white" style="padding-left: 0; padding-right: 0;">
            <div class="ui attached message">
                <div class="header"><?php _e("Create an SMS and E-mail alert for your shipment", "gpdealdomain"); ?> <?php _e("from", "gpdealdomain"); ?> <span class="locality_name"><?php echo get_post_meta($package_id, 'departure-city-package', true); ?>(<?php echo date('d-m-Y', strtotime(get_post_meta($package_id, 'date-of-departure-package', true))); ?>)</span> <?php _e("to", "gpdealdomain"); ?> <span class="locality_name"><?php echo get_post_meta($package_id, 'destination-city-package', true); ?>(<?php echo date('d-m-Y', strtotime(get_post_meta($package_id, 'arrival-date-package', true))); ?>)</span></div>
                <p class="promo_text_form"><?php echo __("To be informed by SMS and E-mail when an corresponding transport offer is published", 'gpdealdomain') ?>.</p>
            </div>
            <div class="ui fluid card">
                <div class="content">
                    <form id="create_alert_form"  method="POST" class="ui form insure_shipment_form" action="<?php echo wp_make_link_relative(get_permalink()); ?>" style="margin-bottom: 1em" autocomplete="off">
                        <div class="fields">
                            <div class="sixteen wide field center aligned">
                                <span class="span_label"><?php _e("Cost of SMS and E-mail Alert", "gpdealdomain"); ?></span> : <span class="span_value"><?php echo $alert_cost; ?> <?php echo $alert_currency; ?></span>
                            </div>
                        </div>
                        <div class="field">
                            <div id="server_error_message" class="ui negative message" style="display:none">
                                <i class="close icon"></i>
                                <div id="server_error_content" class="header"><?php _e("Internal server error", "gpdealdomain"); ?></div>
                            </div>
                            <div id="error_name_message" class="ui error message" style="display: none">
                                <i class="close icon"></i>
                                <div id="error_name_header" class="header"></div>
                                <ul id="error_name_list" class="list">

                                </ul>
                            </div>
                        </div>
                        <input type='hidden' name='package_id' value="<?php echo $package_id; ?>">
                    </form>
                </div>
                <div class="extra content">
                    <div class="action right aligned">
                        <a class="ui black button icon field_bottom_space" href="<?php echo wp_make_link_relative(get_permalink(get_page_by_path(__('my-account', 'gpdealdomain') . '/' . __('shipments', 'gpdealdomain'))));?>">
                            <?php _e("Cancel", "gpdealdomain"); ?>
                        </a>
                        <button id='submit_confirm_create_alert_btn' class="ui green button right labeled icon field_bottom_space">
                            <?php _e("Pay & create alert", "gpdealdomain"); ?>
                            <i class="checkmark icon"></i>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

