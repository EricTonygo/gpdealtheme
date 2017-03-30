function unselect_transport_offer(package_id){
    $('#selected_transport_offer'+package_id).hide();
    $('#unselected_transport_offer'+package_id).show();
    $('#selected_transport_offer_checkbox'+package_id).prop('checked', false);
    if($('input[name="selected_transport_offers[]"]:checked').length > 0){
        $('#submit_selected_transport_offers').show();
    }else{
        $('#submit_selected_transport_offers').hide();
    }
}

function select_transport_offer(package_id){
    $('#unselected_transport_offer'+package_id).hide();
    $('#selected_transport_offer'+package_id).show();
    $('#selected_transport_offer_checkbox'+package_id).prop('checked', true);
    if($('input[name="selected_transport_offers[]"]:checked').length > 0){
        $('#submit_selected_transport_offers').show();
    }else{
        $('#submit_selected_transport_offers').hide();
    }
}

