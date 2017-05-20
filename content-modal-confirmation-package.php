<div id="confirm_cancel_send_package" class="ui small modal">
    <i class="close icon"></i>
    <div class="header">
        <?php _e('Confirmation of cancellation of the shipment', 'gpdealdomain'); ?>
    </div>
    <div class="content">
        <p><?php _e('You are about to cancel your shipment', 'gpdealdomain'); ?>.</p>
        <p><?php _e('Do you really want to continue', 'gpdealdomain'); ?> ?</p>
    </div>
    <div class="actions">
        <div class="ui red deny button">
            <?php _e('No', 'gpdealdomain'); ?>
        </div>
        <div id="execute_cancel_send_package"  class="ui green right labeled icon button">
            <?php _e('Yes', 'gpdealdomain'); ?>
            <i class="checkmark icon"></i>
        </div>
    </div>
</div>

<div id="confirm_fence_send_package" class="ui small modal">
    <i class="close icon"></i>
    <div class="header">
        <?php _e('Confirmation of Expedition Closing', 'gpdealdomain'); ?>
    </div>
    <div class="content">
        <p><?php _e('You are about to close this expedition', 'gpdealdomain'); ?>. </p>
        <p><?php _e('Do you really want to continue', 'gpdealdomain'); ?> ?</p>
    </div>
    <div class="actions">
        <div class="ui red deny button">
            <?php _e('No', 'gpdealdomain'); ?>
        </div>
        <div id="execute_fence_send_package"  class="ui green right labeled icon button">
            <?php _e('Yes', 'gpdealdomain'); ?>
            <i class="checkmark icon"></i>
        </div>
    </div>
</div>