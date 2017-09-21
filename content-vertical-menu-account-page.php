<div id="account_left_sidebar" class="ui vertical fluid tabular menu">
    <a class="<?php if (is_page(__('my-account', 'gpdealdomain'))): ?>active<?php endif ?> item" href='<?php echo wp_make_link_relative(get_permalink(get_page_by_path(__('my-account', 'gpdealdomain')))); ?>' class="ui item">
        <?php echo __("My account", "gpdealdomain"); ?>  
    </a>
    <a class="<?php if (is_page(__('my-account', 'gpdealdomain') . '/' . __('profile', 'gpdealdomain'))): ?>active <?php endif ?>item" href='<?php echo wp_make_link_relative(get_permalink(get_page_by_path(__('my-account', 'gpdealdomain') . '/' . __('profile', 'gpdealdomain')))); ?>' class="ui item">
        <?php echo __("Profile", "gpdealdomain"); ?>  
    </a>
    <a class="<?php if (is_page(__('my-account', 'gpdealdomain') . '/' . __('shipments', 'gpdealdomain'))): ?>active <?php endif ?>item" href="<?php echo wp_make_link_relative(get_permalink(get_page_by_path(__('my-account', 'gpdealdomain') . '/' . __('shipments', 'gpdealdomain')))); ?>">
        <?php echo __('Shipments', 'gpdealdomain') ?>
    </a>
    <a class="<?php if (is_page(__('my-account', 'gpdealdomain') . '/' . __('transport-offers', 'gpdealdomain'))): ?>active <?php endif ?>item" href='<?php echo wp_make_link_relative(get_permalink(get_page_by_path(__('my-account', 'gpdealdomain') . '/' . __('transport-offers', 'gpdealdomain')))); ?>'>
        <?php echo __('Transport offers', 'gpdealdomain') ?>
    </a>
</div>


