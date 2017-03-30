<div id="confirm_transaction_modal" class="ui small modal">
    <i class="close icon"></i>
    <div class="header">
        <?php echo __("Confirmation de la transaction", "gpdealdomain"); ?>
    </div>
    <div class="content"> 
        
        <p>Voulez vous vraiment éffectuer cette transaction ?</p>
    </div>
    <div class="actions">
        <button id="cancel_confirm_transaction_form" class="ui red deny button">
            Non
        </button>
        <button id="submit_confirm_transaction_form" class="ui green right button button" type="submit">Oui</button>
    </div>
</div>