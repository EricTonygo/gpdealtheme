<div id="confirm_transaction_modal" class="ui small modal">
    <i class="close icon"></i>
    <div class="header">
        <?php echo __("Confirmation of transaction", "gpdealdomain"); ?>
    </div>
    <div class="content"> 
        
        <p><?php _e("Do you really want to perform this transaction", "gpdealdomain"); ?> ?</p>
    </div>
    <div class="actions">
        <button id="cancel_confirm_transaction_form" class="ui red deny button">
            <?php _e("No", "gpdealdomain"); ?>
        </button>
        <button id="submit_confirm_transaction_form" class="ui green right button button" type="submit"><?php _e("Yes", "gpdealdomain"); ?></button>
    </div>
</div>