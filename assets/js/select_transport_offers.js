function unselect_transport_offer(package_id) {
    $('#selected_transport_offer' + package_id).hide();
    $('#unselected_transport_offer' + package_id).show();
    $('#selected_transport_offer_checkbox' + package_id).prop('checked', false);
    if ($('input[name="selected_transport_offers[]"]:checked').length > 0) {
        $('#submit_selected_transport_offers').show();
    } else {
        $('#submit_selected_transport_offers').hide();
    }
}

function select_transport_offer(package_id) {
    $('#unselected_transport_offer' + package_id).hide();
    $('#selected_transport_offer' + package_id).show();
    $('#selected_transport_offer_checkbox' + package_id).prop('checked', true);
    if ($('input[name="selected_transport_offers[]"]:checked').length > 0) {
        $('#submit_selected_transport_offers').show();
    } else {
        $('#submit_selected_transport_offers').hide();
    }
}

function close_transport_offer(id) {
    $('#confirm_close_transport_offer.ui.small.modal')
            .modal('show')
            ;

    $('#execute_close_transport_offer').click(function (e) {
        e.preventDefault();
        $('#confirm_close_transport_offer.ui.small.modal')
            .modal('hide')
            ;
        $.ajax({
            type: $('#close_transport_offer_form' + id).attr('method'),
            url: $('#close_transport_offer_form' + id).attr('action'),
            data: $('#close_transport_offer_form' + id).serialize(),
            dataType: 'json',
            beforeSend: function () {
                $('#close_transport_offer_btn'+ id).addClass("loading");
                $('#evaluate_transport_offer_btn'+ id).addClass("disabled");
            },
            statusCode: {
                500: function (xhr) {
                    $('#message_error>div.header').html("Erreur s'est produite au niveau du serveur");
                    $('#message_error').show();

                },
                404: function (response, textStatus, jqXHR) {
                    $('#message_error>div.header').html("Echec de la validation");
                    $('#message_error').show();
                }
            },
            success: function (response, textStatus, jqXHR) {
                if (response.success === true) {
                    $('#selected_transport_offer_column'+id).remove();
                    $('#message_success>div.header').html(response.data.message);
                    $('#message_success').show();
                    setTimeout(function () {
                    $('#message_success').hide();
                }, 4000);
                } else if (response.success === false) {
                    $('#message_error>div.header').html(response.data.message);
                    $('#message_error').show();
                } else {
                    $('#message_error>div.header').html("Erreur s'est produite au niveau du serveur");
                    $('#message_error').show();
                }
                $('#close_transport_offer_btn'+ id).removeClass("loading");
                $('#evaluate_transport_offer_btn'+ id).removeClass("disabled");
            },
            error: function (jqXHR, textStatus, errorThrown) {
                $('#close_transport_offer_btn'+ id).removeClass("loading");
                $('#evaluate_transport_offer_btn'+ id).removeClass("disabled");

            }
        });
    });
}


function show_reviews_evaluations(event, id){
    event.preventDefault();
    $('#show_reviews_evaluations_btn'+id).addClass('loading');
    $('#main_content_reviews_evaluations').load($('#show_reviews_evaluations_btn'+id).attr('href'), function(){
        $('#show_reviews_evaluations_btn'+id).removeClass('loading');
        $('#show-reviews-evaluations-carrier').modal('show');
    });
    
}

$(function () {
    $('#selected_transport_offers_form').submit(function () {
        $('#selected_transport_offers_form').addClass('ui form loading');
    });
});


