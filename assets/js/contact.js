$(function () {
    $('input[name="member"]').change(function () {
        if ($(this).is(':checked') && $(this).val() === "yes") {
            $('#contact_form div#block_visitor').hide();
            $('#contact_form div.myrole').hide();
        } else {
            $('#contact_form div#block_visitor').show();
            $('#contact_form div.myrole').show();
        }
    });
    
    $('input[name="role"]').change(function () {
        if ($(this).is(':checked') && $(this).val() === "particular") {
            $('#contact_form input[name="function"]').hide();
            $('#contact_form input[name="company_identity_number"]').hide();
        } else {
            $('#contact_form input[name="function"]').show();
            $('#contact_form input[name="company_identity_number"]').show();
        }
    });

    $('#contact_form.ui.form')
            .form({
                fields: {
//                    role: {
//                        identifier: 'role',
//                        rules: [
//                            {
//                                type: 'checked',
//                                prompt: "Veuillez selectionner le type d'utilisateur."
//                            }
//                        ]
//                    },
//                    civility: {
//                        identifier: 'civility',
//                        rules: [
//                            {
//                                type: 'checked',
//                                prompt: "Veuillez selectionner votre civilité."
//                            }
//                        ]
//                    },
//                    last_name: {
//                        identifier: 'lastname',
//                        rules: [
//                            {
//                                type: 'empty',
//                                prompt: "Veuillez saisir votre nom."
//                            }
//                        ]
//                    },
                    email: {
                        identifier: 'email',
                        rules: [
                            {
                                type: 'empty',
                                prompt: gpdeal_translate('Please enter your email address')
                            },
                            {
                                type: 'email',
                                prompt: gpdeal_translate('Please enter a valid email address')
                            }
                        ]
                    },

                    subject: {
                        identifier: 'subject',
                        rules: [
                            {
                                type: 'empty',
                                prompt: gpdeal_translate("Please enter the subject of your message")
                            }
                        ]
                    },
                    message: {
                        identifier: 'message',
                        rules: [
                            {
                                type: 'empty',
                                prompt: gpdeal_translate("Please enter your message")
                            }
                        ]
                    }

                },
                inline: true,
                on: 'change',
                onSuccess: function (event, fields) {
                    $.ajax({
                        type: 'post',
                        url: $('#contact_form.ui.form').attr('action'),
                        data: $('#contact_form.ui.form').serialize(),
                        dataType: 'json',
                        beforeSend: function () {
                            $('#message_error').hide();
                            $('#contact_form.ui.form').addClass('loading');
                            $('#submit_message').addClass('disabled');                           
                        },
                        statusCode: {
                            500: function (xhr) {
                                $('#contact_form.ui.form').removeClass('loading');
                                $('#submit_message').removeClass('disabled');
                                $('#message_error .header').html(gpdeal_translate("Failed to send message"));
                                $('#message_error').show();
                            },
                            400: function (response, textStatus, jqXHR) {
                                $('#contact_form.ui.form').removeClass('loading');
                                $('#submit_message').removeClass('disabled');
                                $('#message_success .header').html(response.data.message);
                                $('#message_success').show();
                            }
                        },
                        success: function (response, textStatus, jqXHR) {
                            if (response.success === true) {
                                $('#contact_form.ui.form').removeClass('loading');
                                $('#submit_message').removeClass('disabled');
                                $('#message_success .header').html(response.data.message);
                                $('#message_success').show();
                                setTimeout(function () {
                                    $('#message_success').hide();
                                }, 4000);
                            } else if (response.success === false) {
                                $('#contact_form.ui.form').removeClass('loading');
                                $('#submit_message').removeClass('disabled');
                                $('#message_error .header').html(response.data.message);
                                $('#message_error').show();
                            } else {
                                $('#contact_form.ui.form').removeClass('loading');
                                $('#submit_message').removeClass('disabled');
                                $('#message_error .header').html(response.data.message);
                                $('#message_error').show();
                            }
                        },
                        error: function (jqXHR, textStatus, errorThrown) {
                            $('#contact_form.ui.form').removeClass('loading');
                            $('#submit_message').removeClass('disabled');
                            $('#message_error .header').html(gpdeal_translate("Failed to send message"));
                            $('#message_error').show();
                        }
                    });
                    return false;
                }
            }
            );
});