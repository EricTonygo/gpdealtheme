$(function () {
    $.datetimepicker.setLocale('fr');
    $('input[name="start_date"]').datetimepicker({
        timepicker: false,
        minDate: '0',
        format: 'd-m-Y',
        lang: 'fr',
        scrollInput: false
    });
    $('input[name="destination_date"]').datetimepicker({
        timepicker: false,
        minDate: '0',
        format: 'd-m-Y',
        lang: 'fr',
        scrollInput: false
    });

    $('input[name="start_deadline"]').datetimepicker({
        timepicker: false,
        minDate: '0',
        format: 'd-m-Y',
        lang: 'fr',
        scrollInput: false
    });

    $('#edit_transport_offer_infos_btn').click(function (e) {
        e.preventDefault();
        $('#show_transport_offer_infos').hide();
        $('#edit_transport_offer_infos').show();
    });
    $('#cancel_edit_transport_offer_infos_btn').click(function (e) {
        e.preventDefault();
        $('#edit_transport_offer_infos').hide();
        $('#show_transport_offer_infos').show();
    });

    $('#write_transport_offer_form.ui.form')
            .form({
                fields: {
                    transport_offer_package_type: {
                        identifier: 'transport_offer_package_type',
                        rules: [
                            {
                                type: 'empty',
                                prompt: 'Veuillez préciser le type de courrier/colis'
                            }
                        ]
                    },
                    transport_offer_transport_method: {
                        identifier: 'transport_offer_transport_method',
                        rules: [
                            {
                                type: 'checked',
                                prompt: 'Veuillez préciser le mode de transport'
                            }
                        ]
                    },
                    transport_offer_price: {
                        identifier: 'transport_offer_price',
                        rules: [
                            {
                                type: 'empty',
                                prompt: 'Veuillez saisir le coût du transport.'
                            },
                            {
                                type: 'number',
                                prompt: 'Veuillez saisir un nombre valide.'
                            }
                        ]
                    },
                    transport_offer_currency: {
                        identifier: 'transport_offer_currency',
                        rules: [
                            {
                                type: 'empty',
                                prompt: 'Veuillez préciser la dévise.'
                            }
                        ]
                    },
                    start_date: {
                        identifier: 'start_date',
                        rules: [
                            {
                                type: 'empty',
                                prompt: 'Veuillez renseigner la date de départ'
                            }
                        ]
                    },

                    start_country: {
                        identifier: 'start_country',
                        rules: [
                            {
                                type: 'empty',
                                prompt: 'Veuillez selectionner le pays de départ'
                            }
                        ]
                    },
                    start_state: {
                        identifier: 'start_state',
                        rules: [
                            {
                                type: 'empty',
                                prompt: 'Veuillez selectionner la  Région, Province ou Etat de départ.'
                            }
                        ]
                    },
                    start_city: {
                        identifier: 'start_city',
                        rules: [
                            {
                                type: 'empty',
                                prompt: 'Veuillez selectionner la ville de départ.'
                            }
                        ]
                    },
                    start_deadline: {
                        identifier: 'start_deadline',
                        rules: [
                            {
                                type: 'empty',
                                prompt: 'Veuillez renseigner la date limite de proposition'
                            }
                        ]
                    },
                    destination_date: {
                        identifier: 'destination_date',
                        rules: [
                            {
                                type: 'empty',
                                prompt: "Veuillez renseigner la date d'arrivée"
                            }
                        ]
                    },

                    destination_country: {
                        identifier: 'destination_country',
                        rules: [
                            {
                                type: 'empty',
                                prompt: 'Veuillez selectionner le pays de destination.'
                            }
                        ]
                    },
                    destionation_state: {
                        identifier: 'destination_state',
                        rules: [
                            {
                                type: 'empty',
                                prompt: 'Veuillez selectionner la  Région, Province ou Etat de destionation.'
                            }
                        ]
                    },
                    destionation_city: {
                        identifier: 'destination_city',
                        rules: [
                            {
                                type: 'empty',
                                prompt: 'Veuillez selectionner la ville de destination.'
                            }
                        ]
                    },
                    terms: {
                        identifier: 'terms',
                        rules: [
                            {
                                type: 'checked',
                                prompt: "Vous devez accepter ces conditions d'utilisation."
                            }
                        ]
                    }
                },
                inline: true,
                on: 'change',
                onSuccess: function (event, fields) {
                    $('#error_name_message').hide();
                    $('#error_name_header').html("");
                    $('#error_name_list').html("");
                    $('#write_transport_offer_form.ui.form').addClass('loading');
                    $('#submit_transport_offer').addClass('disabled');
                    var today = new Date();
                    var valid = true;
                    today.setHours(0);
                    today.setMinutes(0);
                    today.setSeconds(0);
                    today.setMilliseconds(0);

                    var start_date = $('#write_transport_offer_form.ui.form input[name="start_date"]').datetimepicker('getValue');
                    var start_deadline = $('#write_transport_offer_form.ui.form input[name="start_deadline"]').datetimepicker('getValue');
                    var destination_date = $('#write_transport_offer_form.ui.form input[name="destination_date"]').datetimepicker('getValue');
                    start_date.setHours(0);
                    start_date.setMinutes(0);
                    start_date.setSeconds(0);
                    start_date.setMilliseconds(0);
                    start_deadline.setHours(0);
                    start_deadline.setMinutes(0);
                    start_deadline.setSeconds(0);
                    start_deadline.setMilliseconds(0);
                    destination_date.setHours(0);
                    destination_date.setMinutes(0);
                    destination_date.setSeconds(0);
                    destination_date.setMilliseconds(0);
                    if (today.getTime() > start_date.getTime()) {
                        $('#write_transport_offer_form.ui.form').removeClass('loading');
                        $('#submit_transport_offer').removeClass('disabled');
                        $('#error_name_header').html("Erreur(s)");
                        $('#error_name_list').html("<li>La date de départ ne peut pas être inférieure à la date du jour</li>");
                        valid = false;
                    }
                    if (today.getTime() > start_deadline.getTime()) {
                        $('#write_transport_offer_form.ui.form').removeClass('loading');
                        $('#submit_transport_offer').removeClass('disabled');
                        $('#error_name_header').html("Erreur(s)");
                        $('#error_name_list').append("<li>La date limite des propositions ne peut pas être inférieure à la date du jour</li>");
                        valid = false;
                    }

                    if (start_deadline.getTime() > start_date.getTime()) {
                        $('#write_transport_offer_form.ui.form').removeClass('loading');
                        $('#submit_transport_offer').removeClass('disabled');
                        $('#error_name_header').html("Erreur(s)");
                        $('#error_name_list').append("<li>La date de départ ne peut pas être inférieure à la date limite des proposition </li>");
                        valid = false;
                    }

                    if (today.getTime() > destination_date.getTime()) {
                        $('#write_transport_offer_form.ui.form').removeClass('loading');
                        $('#submit_transport_offer').removeClass('disabled');
                        $('#error_name_header').html("Erreur(s)");
                        $('#error_name_list').append("<li>La date d'arrivée ne peut pas être inférieure à la date du jour</li>");
                        valid = false;
                    }
                    if (start_date.getTime() > destination_date.getTime()) {
                        $('#write_transport_offer_form.ui.form').removeClass('loading');
                        $('#submit_transport_offer').removeClass('disabled');
                        $('#error_name_header').html("Erreur(s)");
                        $('#error_name_list').append("<li>La date d'arrivée ne peut pas être inférieure à la date de départ</li>");
                        valid = false;
                    }

                    if (!valid) {
                        $('#error_name_message').show();
                        return false;
                    }

                }
            }
            );

//    $('#submit_send_package').click(function (e) {
//        e.preventDefault();
//        $('#server_error_message').hide();
//        //$('#forgot_password_form.ui.form').form('validate form');
//        if ($('#send_package_form.ui.form').form('is valid')) {
//            $.ajax({
//                type: 'post',
//                url: $('#send_package_form.ui.form').attr('action'),
//                data: $('#send_package_form.ui.form').serialize(),
//                dataType: 'json',
//                beforeSend: function () {
//                    $('#send_package_form.ui.form').addClass('loading');
//                    $('#submit_send_package').addClass('disabled');
//                },
//                statusCode: {
//                    500: function (xhr) {
//                        $('#forgot_password_form.ui.form').removeClass('loading');
//                        $('#submit_forgot_password').removeClass('disabled');
//                        $('#server_error_message').show();
//                    },
//                    400: function (response, textStatus, jqXHR) {
//                        $('#forgot_password_form.ui.form').removeClass('loading');
//                        $('#submit_forgot_password').removeClass('disabled');
//                        $('#error_name_header').html("Echec de la validation");
//                        $('#error_name_message').show();
//                    }
//                },
//                success: function (response, textStatus, jqXHR) {
//                    if (response.success === true) {
//                        $('#forgot_password_form.ui.form').submit();
//                    } else if (response.success === false) {
//                        $('#forgot_password_form.ui.form').removeClass('loading');
//                        $('#submit_forgot_password').removeClass('disabled');
//                        $('#error_name_header').html("Echec de la validation");
//                        $('#error_name_list').html('<li>' + response.data.message + '</li>');
//                        $('#error_name_message').show();
//                    } else {
//                        $('#forgot_password_form.ui.form').removeClass('loading');
//                        $('#submit_forgot_password').removeClass('disabled');
//                        $('#error_name_header').html("Internal server error");
//                        $('#error_name_message').show();
//                    }
//                },
//                error: function (jqXHR, textStatus, errorThrown) {
//                    $('#forgot_password_form.ui.form').removeClass('loading');
//                    $('#submit_forgot_password').removeClass('disabled');
//                    $('#server_error_message').show();
//                }
//            });
//        }
//    });



    $('#evaluation_form.ui.form')
            .form({
                fields: {
                    item_delivred: {
                        identifier: 'item_delivred',
                        rules: [
                            {
                                type: 'checked',
                                prompt: "Veuillez s'il vous plait répondre à cette question"
                            }
                        ]
                    },

                    item_state: {
                        identifier: 'item_state',
                        rules: [
                            {
                                type: 'checked',
                                prompt: "Veuillez s'il vous plait répondre à cette question"
                            }
                        ]
                    },
                    delivry_time: {
                        identifier: 'delivry_time',
                        rules: [
                            {
                                type: 'checked',
                                prompt: "Veuillez s'il vous plait répondre à cette question"
                            }
                        ]
                    },
                    cost: {
                        identifier: 'cost',
                        rules: [
                            {
                                type: 'checked',
                                prompt: "Veuillez s'il vous plait répondre à cette question"
                            }
                        ]
                    },
                    recommanded_carrier: {
                        identifier: 'recommended_carrier',
                        rules: [
                            {
                                type: 'checked',
                                prompt: "Veuillez s'il vous plait répondre à cette question"
                            }
                        ]
                    }
                },
                //inline: true,
                on: 'blur',
                onSuccess: function (event, fields) {
                    $('#evaluation_form .ui.error.message').hide();
                    $.ajax({
                        type: 'post',
                        url: $('#evaluation_form.ui.form').attr('action'),
                        data: $('#evaluation_form.ui.form').serialize(),
                        dataType: 'json',
                        beforeSend: function () {
                            $('#evaluation_form.ui.form').addClass('loading');
                            $('#submit_evaluation_form').addClass('disabled');
                        },
                        statusCode: {
                            500: function (xhr) {
                                $('#evaluation_form.ui.form').removeClass('loading');
                                $('#submit_evaluation_form').removeClass('disabled');
                                $('#server_error_message').show();
                            },
                            400: function (response, textStatus, jqXHR) {
                                $('#evaluation_form.ui.form').removeClass('loading');
                                $('#submit_evaluation_form').removeClass('disabled');
                                $('#error_name_header').html("Echec de la validation");
                                $('#error_name_message').show();
                            }
                        },
                        success: function (response, textStatus, jqXHR) {
                            if (response.success === true) {
                                //$('#evaluation_form.ui.form').submit();
                                window.location.reload();
                            } else if (response.success === false) {
                                $('#evaluation_form.ui.form').removeClass('loading');
                                $('#submit_evaluation_form').removeClass('disabled');
                                $('#error_name_header').html("Echec de la validation");
                                $('#error_name_list').html('<li>' + response.data.message + '</li>');
                                $('#error_name_message').show();
                            } else {
                                $('#evaluation_form.ui.form').removeClass('loading');
                                $('#submit_evaluation_form').removeClass('disabled');
                                $('#error_name_header').html("Internal server error");
                                $('#error_name_message').show();
                            }
                        },
                        error: function (jqXHR, textStatus, errorThrown) {
                            $('#evaluation_form.ui.form').removeClass('loading');
                            $('#submit_evaluation_form').removeClass('disabled');
                            $('#server_error_message').show();
                        }
                    });
                    return false;
                }
            }
            );
    $('.add_comment_form')
            .form({
                fields: {
                    comment_content: {
                        identifier: 'comment_content',
                        rules: [
                            {
                                type: 'empty',
                                prompt: "Veuillez s'il vous plait saisir votre commentaire"
                            }
                        ]
                    }
                },
                inline: true,
                on: 'blur'
            }
            );
    
    $('.add_comment_reply_form')
            .form({
                fields: {
                    comment_content: {
                        identifier: 'comment_content',
                        rules: [
                            {
                                type: 'empty',
                                prompt: "Veuillez s'il vous plait saisir votre réponse"
                            }
                        ]
                    }
                },
                inline: true,
                on: 'blur'
            }
            );
    
    $('a.close_transport_offer').click(function(e){
       e.preventDefault();
        $.ajax({
            type: 'post',
            url: $(this).attr('href'),
            data: {"action": "close"},
            dataType: 'json',
            beforeSend: function () {
                $(this).addClass('loading');
            },
            statusCode: {
                500: function (xhr) {
                    $(this).removeClass('loading');
                },
                400: function (response, textStatus, jqXHR) {
                    $(this).removeClass('loading');
                }
            },
            success: function (response, textStatus, jqXHR) {
                if (response.success === true) {
                    window.location.reload();
                } else if (response.success === false) {
                    $(this).removeClass('loading');
                } else {
                    $(this).removeClass('loading');
                }
            },
            error: function (jqXHR, textStatus, errorThrown) {
                $(this).removeClass('loading');
            }
        });
    });
});

function add_evaluation_comment(event, id) {
    event.preventDefault();
    if ($('#evaluation_comment_form' + id).form("is valid")) {
        $.ajax({
            type: 'post',
            url: $('#evaluation_comment_form' + id).attr('action'),
            data: $('#evaluation_comment_form' + id).serialize(),
            dataType: 'json',
            beforeSend: function () {
                $('#error_server_message' + id).hide();
                $('#error_name_message').show();
                $('#evaluation_comment_form' + id).addClass('loading');
            },
            statusCode: {
                500: function (xhr) {
                    $('#evaluation_comment_form' + id).removeClass('loading');
                    $('#error_server_message' + id).show();
                },
                400: function (response, textStatus, jqXHR) {
                    $('#evaluation_comment_form' + id).removeClass('loading');
                    $('#error_name_header' + id).html("Echec de la validation");
                    $('#error_name_message' + id).show();
                }
            },
            success: function (response, textStatus, jqXHR) {
                if (response.success === true) {
                    window.location.reload();
                } else if (response.success === false) {
                    $('#evaluation_comment_form' + id).removeClass('loading');
                    $('#error_name_header' + id).html("Echec de la validation");
                    $('#error_name_list' + id).html('<li>' + response.data.message + '</li>');
                    $('#error_name_message' + id).show();
                } else {
                    $('#evaluation_comment_form' + id).removeClass('loading');
                    $('#error_name_header' + id).html("Internal server error");
                    $('#error_name_message' + id).show();
                }
            },
            error: function (jqXHR, textStatus, errorThrown) {
                $('#evaluation_comment_form' + id).removeClass('loading');
            }
        });
    }
    return false;
}


function add_comment_reply(event, id) {
    event.preventDefault();
    if ($('#comment_reply_form' + id).form("is valid")) {
        $.ajax({
            type: 'post',
            url: $('#comment_reply_form' + id).attr('action'),
            data: $('#comment_reply_form' + id).serialize(),
            dataType: 'json',
            beforeSend: function () {
                $('#error_server_message' + id).hide();
                $('#error_name_message').show();
                $('#comment_reply_form' + id).addClass('loading');
            },
            statusCode: {
                500: function (xhr) {
                    $('#comment_reply_form' + id).removeClass('loading');
                    $('#error_server_message' + id).show();
                },
                400: function (response, textStatus, jqXHR) {
                    $('#comment_reply_form' + id).removeClass('loading');
                    $('#error_name_header' + id).html("Echec de la validation");
                    $('#error_name_message' + id).show();
                }
            },
            success: function (response, textStatus, jqXHR) {
                if (response.success === true) {
                    window.location.reload();
                } else if (response.success === false) {
                    $('#comment_reply_form' + id).removeClass('loading');
                    $('#error_name_header' + id).html("Echec de la validation");
                    $('#error_name_list' + id).html('<li>' + response.data.message + '</li>');
                    $('#error_name_message' + id).show();
                } else {
                    $('#comment_reply_form' + id).removeClass('loading');
                    $('#error_name_header' + id).html("Internal server error");
                    $('#error_name_message' + id).show();
                }
            },
            error: function (jqXHR, textStatus, errorThrown) {
                $('#comment_reply_form' + id).removeClass('loading');
            }
        });
    }
    return false;
}

function show_comment_reply_form(id){
    $('#show_comment_reply_form' + id).hide();
    $('#hide_comment_reply_form' + id).show();
    $('#comment_reply_form' + id).show();
}
function hide_comment_reply_form(id){
    $('#hide_comment_reply_form' + id).hide();
    $('#show_comment_reply_form' + id).show();
    $('#comment_reply_form' + id).hide();
}

function show_evaluation_comment_form(id){
    $('#show_evaluation_comment_form' + id).hide();
    $('#hide_evaluation_comment_form' + id).show();
    $('#evaluation_comment_form' + id).show();
}
function hide_evaluation_comment_form(id){
    $('#hide_evaluation_comment_form' + id).hide();
    $('#show_evaluation_comment_form' + id).show();
    $('#evaluation_comment_form' + id).hide();
}

function show_block_evaluation_form(){
    $('#show_block_evaluation_form').hide();
    $('#block_evaluation_form').show();
}
function show_block_evaluation_form_top(){
    $('#show_block_evaluation_form').hide();
    $('#block_evaluation_form').show();
}
function hide_block_evaluation_form(){
    $('#show_block_evaluation_form').show();
    $('#block_evaluation_form').hide();
}
