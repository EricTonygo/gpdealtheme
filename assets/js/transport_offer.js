$(function () {
    $.datetimepicker.setLocale('fr');
    $('input[name="start_date"]').datetimepicker({
        timepicker: false,
        minDate:'0',
        format: 'd-m-Y',
        lang: 'fr',
        scrollInput: false
    });
    $('input[name="destination_date"]').datetimepicker({
        timepicker: false,
        minDate:'0',
        format: 'd-m-Y',
        lang: 'fr',
        scrollInput: false
    });

    $('input[name="start_deadline"]').datetimepicker({
        timepicker: false,
        minDate:'0',
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

});



