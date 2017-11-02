<div id="account_left_sidebar" class="ui vertical fluid tabular menu">
    <a class="<?php if (is_page(__('my-account', 'gpdealdomain'))): ?>active<?php endif ?> item" href='<?php echo wp_make_link_relative(get_permalink(get_page_by_path(__('my-account', 'gpdealdomain')))); ?>' class="ui item">
        <?php echo __("My account", "gpdealdomain"); ?>  
    </a>
    <a class="<?php if (is_page(__('my-account', 'gpdealdomain') . '/' . __('profile', 'gpdealdomain'))): ?>active <?php endif ?>item" href='<?php echo wp_make_link_relative(get_permalink(get_page_by_path(__('my-account', 'gpdealdomain') . '/' . __('profile', 'gpdealdomain')))); ?>' class="ui item">
        <?php echo __("Profile", "gpdealdomain"); ?>  
    </a>
    <a class="<?php if (is_page(__('my-account', 'gpdealdomain') . '/' . __('shipments', 'gpdealdomain'))): ?>active <?php endif ?>item" href="<?php echo wp_make_link_relative(get_permalink(get_page_by_path(__('my-account', 'gpdealdomain') . '/' . __('shipments', 'gpdealdomain')))); ?>">
        <?php 
        $all_user_shipments = new WP_Query(array('post_type' => 'package', 'posts_per_page' => -1, "post_status" => array('publish'), 'author' => get_current_user_id()));
        ?>
         <div class="ui small green label"><?php if($all_user_shipments->have_posts()): ?> <?php echo $all_user_shipments->post_count; ?> <?php else : ?> 0 <?php endif ?></div>
        <?php echo __('Shipments', 'gpdealdomain') ?>
    </a>
    <a class="<?php if (is_page(__('my-account', 'gpdealdomain') . '/' . __('transport-offers', 'gpdealdomain'))): ?>active <?php endif ?>item" href='<?php echo wp_make_link_relative(get_permalink(get_page_by_path(__('my-account', 'gpdealdomain') . '/' . __('transport-offers', 'gpdealdomain')))); ?>'>
        <?php 
        $all_user_transport_offers = new WP_Query(array('post_type' => 'transport-offer', 'posts_per_page' => -1, "post_status" => array('publish'), 'author' => get_current_user_id()));
        ?>
         <div class="ui small green label"><?php if($all_user_transport_offers->have_posts()): ?> <?php echo $all_user_transport_offers->post_count; ?> <?php else : ?> 0 <?php endif ?></div>
        <?php echo __('Transport offers', 'gpdealdomain') ?>
    </a>
</div>


