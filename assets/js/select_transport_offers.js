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
                $('#close_transport_offer_btn' + id).addClass("loading");
                $('#evaluate_transport_offer_btn' + id).addClass("disabled");
            },
            statusCode: {
                500: function (xhr) {
                    $('#message_error>div.header').html(gpdeal_translate("Internal server error"));
                    $('#message_error').show();

                },
                404: function (response, textStatus, jqXHR) {
                    $('#message_error>div.header').html(gpdeal_translate("Failed to validate"));
                    $('#message_error').show();
                }
            },
            success: function (response, textStatus, jqXHR) {
                if (response.success === true) {
                    $('#selected_transport_offer_column' + id).remove();
                    $('#message_success>div.header').html(response.data.message);
                    $('#message_success').show();
                    setTimeout(function () {
                        $('#message_success').hide();
                    }, 4000);
                    window.location.reload();
                } else if (response.success === false) {
                    $('#message_error>div.header').html(response.data.message);
                    $('#message_error').show();
                } else {
                    $('#message_error>div.header').html(gpdeal_translate("Internal server error"));
                    $('#message_error').show();
                }
                $('#close_transport_offer_btn' + id).removeClass("loading");
                $('#evaluate_transport_offer_btn' + id).removeClass("disabled");
            },
            error: function (jqXHR, textStatus, errorThrown) {
                $('#close_transport_offer_btn' + id).removeClass("loading");
                $('#evaluate_transport_offer_btn' + id).removeClass("disabled");

            }
        });
    });
}


function show_reviews_evaluations(event, id) {
    event.preventDefault();
    $('#show_reviews_evaluations_btn' + id).addClass('loading');
    $('#main_content_reviews_evaluations').load($('#show_reviews_evaluations_btn' + id).attr('href'), function () {
        $('#show_reviews_evaluations_btn' + id).removeClass('loading');
        $('#show-reviews-evaluations-carrier').modal('show');
    });

}

$(function () {
    $('a.show_reviews_evaluations').click(function (e) {
        e.preventDefault();
        $(this).children('i.icon').removeClass('yellow');
        $(this).addClass('loading');
        $('#show-reviews-evaluations-carrier').remove();
        $('#main_content_reviews_evaluations').load($(this).attr('href'), function () {
            $('.ui.rating')
                    .rating('disable')
                    ;
            //show_user_evaluation($(this).attr('id'));
            $('a.show_reviews_evaluations').removeClass('loading');
            $('a.show_reviews_evaluations>i').addClass('yellow');
            $('#show-reviews-evaluations-carrier').modal('show');
        });
    });

    $('#selected_transport_offers_form').submit(function (e) {        
        $('#selected_transport_offers_form').addClass('ui form loading');
    });
    $('#submit_selected_transport_offers').click(function(e){
        $('#selected_transport_offers_form').submit();
    });
    
    $('#payment_gateway_visa').change(function(){
        if ($(this).is(':checked')) {
            $('#paypal_process').hide();
            $('#stripe_process').hide();
            $('#creditcard_process').show();
            $('#creditCard_payment_form').show();
            $('#creditCard_payment_form input[name="card_type"]').val($(this).val());
        }
    });
    $('#payment_gateway_mastercard').change(function(){
        if ($(this).is(':checked')) {
            $('#paypal_process').hide();
            $('#stripe_process').hide();
            $('#creditcard_process').show();
            $('#creditCard_payment_form').show();
            $('#creditCard_payment_form input[name="card_type"]').val($(this).val());
        }
    });
    $('#payment_gateway_paypal').change(function(){
        if ($(this).is(':checked')) {            
            $('#stripe_process').hide();
            $('#creditcard_process').hide();
            $('#creditCard_payment_form').hide();
            $('#paypal_process').show();
        }
    });
    $('#payment_gateway_stripe').change(function(){
        if ($(this).is(':checked')) {            
            $('#creditcard_process').hide();
            $('#creditCard_payment_form').hide();
            $('#paypal_process').hide();
            $('#stripe_process').show();
        }
    });
    $('#creditCard_payment_form.ui.form')
            .form({
                fields: {
                    card_number: {
                        identifier: 'card-number',
                        rules: [
                            {
                                type: 'creditCard',
                                prompt: gpdeal_translate("Please enter a correct card number")
                            }
                        ]
                    },
                    cvc: {
                        identifier: 'card-cvc',
                        rules: [
                            {
                                type: 'integer',
                                prompt: gpdeal_translate("Please enter a correct card verification code")
                            }
                        ]
                    },
                    card_expiration_month: {
                        identifier: 'card-expire-month',
                        rules: [
                            {
                                type: 'empty',
                                prompt: gpdeal_translate("Please select month of your card expiration date")
                            }
                        ]
                    },
                    card_expiration_year: {
                        identifier: 'card-expire-year',
                        rules: [
                            {
                                type: 'empty',
                                prompt: gpdeal_translate("Please enter your card expiration year")
                            }
                        ]
                    },
                    first_name: {
                        identifier: 'first-name',
                        rules: [
                            {
                                type: 'empty',
                                prompt: gpdeal_translate("Please enter a first name of card owner")
                            }
                        ]
                    },
                    last_name: {
                        identifier: 'last-name',
                        rules: [
                            {
                                type: 'empty',
                                prompt: gpdeal_translate("Please enter a last name of card owner")
                            }
                        ]
                    },
                    billing_country_code: {
                        identifier: 'billing-country-code',
                        rules: [
                            {
                                type: 'empty',
                                prompt: gpdeal_translate("Please select a billing country of your card")
                            }
                        ]
                    }
                },
                inline: true,
                on: 'blur'
            }
            );
    
    $('#creditCard_payment_form').submit(function(e){
        $('#creditCard_payment_form').addClass("loading");
        $('#creditcard_process').addClass('disabled');
    });
    
    $('#creditcard_process').click(function (e) {
        e.preventDefault();
        $('#server_error_message').hide();
        if ($('#creditCard_payment_form').form('is valid')) {
            $('#creditCard_payment_form').submit();
//            $.ajax({
//                type: 'post',
//                url: $('#payment_form').attr('action'),
//                data: $('#payment_form').serialize(),
//                dataType: 'json',
//                beforeSend: function () {
//                    $('#payment_form').addClass('loading');
//                    $(this).addClass('disabled');
//                    $('#cancel_payment').addClass('disabled');
//                },
//                statusCode: {
//                    500: function (xhr) {
//                        $('#payment_form').removeClass('loading');
//                        $(this).removeClass('disabled');
//                        $('#cancel_payment').removeClass('disabled');
//                        $('#server_error_message').show();
//                    },
//                    400: function (response, textStatus, jqXHR) {
//                        $('#payment_form').removeClass('loading');
//                        $(this).removeClass('disabled');
//                        $('#cancel_payment').removeClass('disabled');
//                        $('#error_name_header').html(gpdeal_translate("Failed to validate"));
//                        $('#error_name_message').show();
//                    }
//                },
//                success: function (response, textStatus, jqXHR) {
//                    if (response.success === true) {
//                        //$('#payment_form').submit();
//                        $('#selected_transport_offers_form input[name="payment_completed"]').val("true");
//                        $('#selected_transport_offers_form input[name="payment_method"]').val("creditCard");
//                        $('#payment_form').removeClass('loading');
//                        $(this).removeClass('disabled');
//                        $('#cancel_payment').removeClass('disabled');
//                        $('#payment_modal').modal('hide');
//                        $('#selected_transport_offers_form').addClass('ui form loading');
//                        $('#selected_transport_offers_form').submit();
//                        alert(response.data.message);
//                    } else if (response.success === false) {
//                        $('#payment_form').removeClass('loading');
//                        $(this).removeClass('disabled');
//                        $('#cancel_payment').removeClass('disabled');
//                        $('#error_name_header').html(gpdeal_translate("Failed to validate"));
//                        $('#error_name_list').html('<li>' + response.data.message + '</li>');
//                        $('#error_name_message').show();
//                    } else {
//                        $('#payment_form').removeClass('loading');
//                        $(this).removeClass('disabled');
//                        $('#cancel_payment').removeClass('disabled');
//                        $('#error_name_header').html(gpdeal_translate("Internal server error"));
//                        $('#error_name_message').show();
//                    }
//                },
//                error: function (jqXHR, textStatus, errorThrown) {
//                    $('#payment_form').removeClass('loading');
//                    $(this).removeClass('disabled');
//                    $('#cancel_payment').removeClass('disabled');
//                    $('#server_error_message').show();
//                }
//            });
        }
    });
    
    $('#paypal_process').click(function(){
        $(this).addClass('loading');
    });
    
    $('#continue_to_confirm_transaction').click(function (){
        $(this).addClass('loading');
    });
    
});

function show_user_evaluation(id){
    if($('#content_evaluation_'+id).css('display')==="none"){
        $('#content_evaluation_'+id).show();
        
    }else{
        $('#content_evaluation_'+id).hide();
    }
}

function show_user_evaluation_single(id){
    if($('#content_evaluation_single_'+id).css('display')==="none"){
        $('#content_evaluation_single_'+id).show();
        
    }else{
        $('#content_evaluation_single_'+id).hide();
    }
}


