function getAge(birthDate) {
    var today = new Date();
    var age = today.getFullYear() - birthDate.getFullYear();
    var m = today.getMonth() - birthDate.getMonth();
    if (m < 0 || (m === 0 && today.getDate() < birthDate.getDate()))
    {
        age--;
    }
    //alert(today + " " + age + " " + today.getDate() + " " + birthDate.getDate() + " " + birthDate);
    return age;
}
function show_password_particular() {
    $('#show_hide_password_particular.unhide.link.icon').click(function () {
        $('#register_form_particular.ui.form input[name="password"]').showPassword();
        $(this).removeClass('unhide');
        $(this).addClass('hide');
        hide_password_particular();
    });
}
function show_password_pro() {
    $('#show_hide_password_pro.unhide.link.icon').click(function () {
        $('#register_form_enterprise.ui.form input[name="password_pro"]').showPassword();
        $(this).removeClass('unhide');
        $(this).addClass('hide');
        hide_password_pro();
    });
}

function hide_password_particular() {
    $('#show_hide_password_particular.hide.link.icon').click(function () {
        $('#register_form_particular.ui.form input[name="password"]').hidePassword();
        $(this).removeClass('hide');
        $(this).addClass('unhide');
        show_password_particular();
    });
}
function hide_password_pro() {
    $('#show_hide_password_pro.hide.link.icon').click(function () {
        $('#register_form_enterprise.ui.form input[name="password_pro"]').hidePassword();
        $(this).removeClass('hide');
        $(this).addClass('unhide');
        show_password_pro();
    });
}

function show_password_confirm_particular() {
    $('#show_hide_password_confirm_particular.unhide.link.icon').click(function () {
        $('#register_form_particular.ui.form input[name="password_confirm"]').showPassword();
        $(this).removeClass('unhide');
        $(this).addClass('hide');
        hide_password_confirm_particular();
    });
}
function show_password_confirm_pro() {
    $('#show_hide_password_confirm_pro.unhide.link.icon').click(function () {
        $('#register_form_enterprise.ui.form input[name="password_confirm_pro"]').showPassword();
        $(this).removeClass('unhide');
        $(this).addClass('hide');
        hide_password_confirm_pro();
    });
}

function hide_password_confirm_particular() {
    $('#show_hide_password_confirm_particular.hide.link.icon').click(function () {
        $('#register_form_particular.ui.form input[name="password_confirm"]').hidePassword();
        $(this).removeClass('hide');
        $(this).addClass('unhide');
        show_password_confirm_particular();
    });
}
function hide_password_confirm_pro() {
    $('#show_hide_password_confirm_pro.hide.link.icon').click(function () {
        $('#register_form_enterprise.ui.form input[name="password_confirm_pro"]').hidePassword();
        $(this).removeClass('hide');
        $(this).addClass('unhide');
        show_password_confirm_pro();
    });
}

$(function () {
    $.datetimepicker.setLocale('fr');
    show_password_particular();
    hide_password_particular();
    show_password_confirm_particular();
    hide_password_confirm_particular();
    show_password_pro();
    hide_password_pro();
    show_password_confirm_pro();
    hide_password_confirm_pro();
    $('#birthdate').datetimepicker({
        timepicker: false,
        format: 'd-m-Y',
        lang: 'fr',
//        scrollTime: false,
//        scrollMonth: false,
        scrollInput: false
    });

    $('#register_form_particular.ui.form')
            .form({
                fields: {
                    gender: {
                        identifier: 'gender',
                        rules: [
                            {
                                type: 'checked',
                                prompt: 'Veuillez préciser votre sexe'
                            }
                        ]
                    },
                    last_name: {
                        identifier: 'last_name',
                        rules: [
                            {
                                type: 'empty',
                                prompt: 'Veuillez saisir votre nom'
                            }
                        ]
                    },
                    username: {
                        identifier: 'username',
                        rules: [
                            {
                                type: 'empty',
                                prompt: 'Veuillez saisir votre pseudo'
                            }
                        ]
                    },
                    birthdate: {
                        identifier: 'birthdate',
                        rules: [
                            {
                                type: 'empty',
                                prompt: 'Veuillez renseigner votre date de naissance'
                            }
                        ]
                    },
                    number_street: {
                        identifier: 'number_street',
                        rules: [
                            {
                                type: 'empty',
                                prompt: 'Veuillez saisir la rue et le numéro de votre adresse'
                            }
                        ]
                    },
                    country: {
                        identifier: 'country',
                        rules: [
                            {
                                type: 'empty',
                                prompt: 'Veuillez selectionner votre pays'
                            }
                        ]
                    },
                    state: {
                        identifier: 'state_country',
                        rules: [
                            {
                                type: 'empty',
                                prompt: 'Veuillez selectionner votre Région, Province ou Etat.'
                            }
                        ]
                    },
                    city: {
                        identifier: 'city_state',
                        rules: [
                            {
                                type: 'empty',
                                prompt: 'Veuillez selectionner votre Commune, Ville ou Localité.'
                            }
                        ]
                    },
                    mobile_phone_number: {
                        identifier: 'mobile_phone_number',
                        rules: [
                            {
                                type: 'empty',
                                prompt: "Veuillez saisir le numéro de téléphone mobile"
                            },
                            {
                                type: 'regExp[/^([\+,00]{1}[0-9]{2,}?)$/]',
                                prompt: "Veuillez saisir le numéro de téléphone valide"
                            }
                        ]
                    },

                    mobile_phone_number_confirm: {
                        identifier: 'mobile_phone_number_confirm',
                        rules: [
                            {
                                type: 'match[mobile_phone_number]',
                                prompt: 'Les numéros de téléphone saisis ne correspondent pas'
                            }
                        ]
                    },
                    email: {
                        identifier: 'email',
                        rules: [
                            {
                                type: 'email',
                                prompt: 'Veuillez saisir une adresse email valide'
                            }
                        ]
                    },
                    email_confirm: {
                        identifier: 'email_confirm',
                        rules: [
                            {
                                type: 'match[email]',
                                prompt: 'Les adresses email saisis ne correspondent pas'
                            }
                        ]
                    },
                    password: {
                        identifier: 'password',
                        rules: [
                            {
                                type: 'empty',
                                prompt: 'Veuillez saisir un mot de passe'
                            }
                        ]
                    },
                    passwordConfirm: {
                        identifier: 'password_confirm',
                        rules: [
                            {
                                type: 'match[password]',
                                prompt: 'Les mots de passe saisis ne correspondent pas'
                            }
                        ]
                    },
                    test_question: {
                        identifier: 'test_question',
                        rules: [
                            {
                                type: 'empty',
                                prompt: 'Veuillez selectionner une question test.'
                            }
                        ]
                    },
                    answer_test_question: {
                        identifier: 'answer_test_question',
                        depends: 'test_question',
                        rules: [
                            {
                                type: 'empty',
                                prompt: 'Veuillez saisir une reponse à la question test.'
                            }
                        ]
                    },
                    terms: {
                        identifier: 'terms',
                        rules: [
                            {
                                type: 'checked',
                                prompt: "Vous devez accepter les termes et conditions d'utilisation."
                            }
                        ]
                    }
                },
                //inline: true,
                on: 'change',
                onSuccess: function (event, fields) {
                    $('#error_name_message').hide();
                    $('#error_name_header').html("");
                    $('#error_name_list').html("");
                    if (getAge($('#register_form_particular.ui.form input[name="birthdate"]').datetimepicker('getValue')) >= 18) {
                        $('#register_form_particular.ui.form').addClass('loading');
                        $('#submit_create_account_particular').addClass('disabled');
                        $('#submit_edit_account_particular').addClass('disabled');
                    } else {
                        $('#register_form_particular.ui.form').removeClass('loading');
                        $('#submit_create_account_particular').removeClass('disabled');
                        $('#error_name_header').html("Echec de la validation");
                        $('#error_name_list').html("<li>L'âge d'un utilisateur doit être supérieur ou égal à 18 ans</li>");
                        $('#error_name_message').show();
                        return false;
                    }
                }
            }
            );


    $('#register_form_enterprise.ui.form')
            .form({
                fields: {
                    role: {
                        identifier: 'role',
                        rules: [
                            {
                                type: 'checked',
                                prompt: 'Veuillez choisir le type de compte'
                            }
                        ]
                    },
                    civility: {
                        identifier: 'civility_representative1',
                        rules: [
                            {
                                type: 'checked',
                                prompt: 'Veuillez préciser votre la civilité du représentant'
                            }
                        ]
                    },
                    last_name: {
                        identifier: 'last_name_representative1',
                        rules: [
                            {
                                type: 'empty',
                                prompt: 'Veuillez saisir le nom du représentant'
                            }
                        ]
                    },
                    company_name: {
                        identifier: 'company_name',
                        rules: [
                            {
                                type: 'empty',
                                prompt: 'Veuillez saisir le nom de votre entreprise'
                            }
                        ]
                    },

                    company_legal_form: {
                        identifier: 'company_legal_form',
                        rules: [
                            {
                                type: 'empty',
                                prompt: 'Veuillez saisir le nom de votre entreprise'
                            }
                        ]
                    },
                    company_number: {
                        identifier: 'company_number',
                        rules: [
                            {
                                type: 'empty',
                                prompt: 'Veuillez saisir votre numéro siren'
                            }
                        ]
                    },
                    company_identity_number: {
                        identifier: 'company_identity_number',
                        rules: [
                            {
                                type: 'empty',
                                prompt: 'Veuillez saisir votre numéro siren'
                            }
                        ]
                    },
                    company_identity_tva_number: {
                        identifier: 'company_identity_tva_number',
                        rules: [
                            {
                                type: 'empty',
                                prompt: 'Veuillez saisir votre numéro siren'
                            }
                        ]
                    },
                    function_representative1: {
                        identifier: 'function_representative1',
                        rules: [
                            {
                                type: 'empty',
                                prompt: 'Veuillez saisir votre fonction'
                            }
                        ]
                    },
                    number_street: {
                        identifier: 'number_street',
                        rules: [
                            {
                                type: 'empty',
                                prompt: 'Veuillez saisir numéro et la rue de votre adresse'
                            }
                        ]
                    },
                    country: {
                        identifier: 'country',
                        rules: [
                            {
                                type: 'empty',
                                prompt: 'Veuillez selectionner votre pays'
                            }
                        ]
                    },
                    state: {
                        identifier: 'state_country',
                        rules: [
                            {
                                type: 'empty',
                                prompt: 'Veuillez selectionner votre region, province ou etat.'
                            }
                        ]
                    },
                    city: {
                        identifier: 'city_state',
                        rules: [
                            {
                                type: 'empty',
                                prompt: 'Veuillez selectionner votre commune, ville ou localité.'
                            }
                        ]
                    },
                    postal_code: {
                        identifier: 'postal_code',
                        rules: [
                            {
                                type: 'empty',
                                prompt: 'Veuillez saisir votre code postal.'
                            }
                        ]
                    },
                    mobile_phone_number_representative1: {
                        identifier: 'mobile_phone_number_representationve1',
                        rules: [
                            {
                                type: 'empty',
                                prompt: "Veuillez saisir le numéro de téléphone mobile"
                            },
                            {
                                type: 'regExp[/^([\+,00]{1}[0-9]{2,}?)$/]',
                                prompt: "Veuillez saisir le numéro de téléphone valide"
                            }
                        ]
                    },
                    home_phone_number: {
                        identifier: 'home_phone_number',
                        rules: [
                            {
                                type: 'empty',
                                prompt: "Veuillez saisir le numéro de téléphone fixe"
                            },
                            {
                                type: 'regExp[/^([\+,00]{1}[0-9]{2,}?)$/]',
                                prompt: "Veuillez saisir le numéro de téléphone valide"
                            }
                        ]
                    },

                    email_representative1: {
                        identifier: 'email_representative1',
                        rules: [
                            {
                                type: 'email',
                                prompt: 'Veuillez saisir une adresse email valide'
                            }
                        ]
                    },

                    email_pro: {
                        identifier: 'email_pro',
                        rules: [
                            {
                                type: 'email',
                                prompt: 'Veuillez saisir une adresse email valide'
                            }
                        ]
                    },
                    email_confirm_pro: {
                        identifier: 'email_confirm_pro',
                        rules: [

                            {
                                type: 'match[email_pro]',
                                prompt: 'Les adresses email saisis ne correspondent pas'
                            }
                        ]
                    },
                    password_pro: {
                        identifier: 'password_pro',
                        rules: [
                            {
                                type: 'empty',
                                prompt: 'Veuillez saisir un mot de passe'
                            }
                        ]
                    },
                    passwordConfirm_pro: {
                        identifier: 'password_confirm_pro',
                        rules: [
                            {
                                type: 'match[password_pro]',
                                prompt: 'Les mots de passe saisis ne correspondent pas'
                            }
                        ]
                    },
                    test_question_pro: {
                        identifier: 'test_question_pro',
                        rules: [
                            {
                                type: 'empty',
                                prompt: 'Veuillez selectionner une question test.'
                            }
                        ]
                    },
                    answer_test_question_pro: {
                        identifier: 'answer_test_question_pro',
                        depends: 'test_question_pro',
                        rules: [
                            {
                                type: 'empty',
                                prompt: 'Veuillez saisir une reponse à la question test.'
                            }
                        ]
                    },
                    terms: {
                        identifier: 'terms',
                        rules: [
                            {
                                type: 'checked',
                                prompt: "Vous devez accepter les termes et conditions d'utilisation."
                            }
                        ]
                    }
                },
                inline: true,
                on: 'change',
                onSuccess: function (event, fields) {
                    $('#register_form_enterprise.ui.form').addClass('loading');
                    $('#submit_create_account_enterprise').addClass('disabled');
                    $('#submit_edit_account_enterprise').addClass('disabled');

                }
            }
            );


    $('#forgot_password_form.ui.form')
            .form({
                fields: {
                    email: {
                        identifier: 'email',
                        rules: [
                            {
                                type: 'email',
                                prompt: 'Veuillez saisir une adresse email valide'
                            }
                        ]
                    },

                    test_question: {
                        identifier: 'test_question',
                        rules: [
                            {
                                type: 'empty',
                                prompt: "Veuillez selectionner votre question test de l'inscription."
                            }
                        ]
                    },
                    answer_test_question: {
                        identifier: 'answer_test_question',
                        depends: 'test_question',
                        rules: [
                            {
                                type: 'empty',
                                prompt: "Veuillez saisir votre reponse à la question test de l'inscription."
                            }
                        ]
                    }

                },
                inline: true,
                on: 'change'
            }
            );

    $('#submit_forgot_password').click(function (e) {
        e.preventDefault();
        $('#server_error_message').hide();
        //$('#forgot_password_form.ui.form').form('validate form');
        if ($('#forgot_password_form.ui.form').form('is valid')) {
            $.ajax({
                type: 'post',
                url: $('#forgot_password_form.ui.form').attr('action'),
                data: $('#forgot_password_form.ui.form').serialize(),
                dataType: 'json',
                beforeSend: function () {
                    $('#forgot_password_form.ui.form').addClass('loading');
                    $('#submit_forgot_password').addClass('disabled');
                },
                statusCode: {
                    500: function (xhr) {
                        $('#forgot_password_form.ui.form').removeClass('loading');
                        $('#submit_forgot_password').removeClass('disabled');
                        $('#server_error_message').show();
                    },
                    400: function (response, textStatus, jqXHR) {
                        $('#forgot_password_form.ui.form').removeClass('loading');
                        $('#submit_forgot_password').removeClass('disabled');
                        $('#error_name_header').html("Echec de la validation");
                        $('#error_name_message').show();
                    }
                },
                success: function (response, textStatus, jqXHR) {
                    if (response.success === true) {
                        $('#forgot_password_form.ui.form').submit();
                    } else if (response.success === false) {
                        $('#forgot_password_form.ui.form').removeClass('loading');
                        $('#submit_forgot_password').removeClass('disabled');
                        $('#error_name_header').html("Echec de la validation");
                        $('#error_name_list').html('<li>' + response.data.message + '</li>');
                        $('#error_name_message').show();
                    } else {
                        $('#forgot_password_form.ui.form').removeClass('loading');
                        $('#submit_forgot_password').removeClass('disabled');
                        $('#error_name_header').html("Internal server error");
                        $('#error_name_message').show();
                    }
                },
                error: function (jqXHR, textStatus, errorThrown) {
                    $('#forgot_password_form.ui.form').removeClass('loading');
                    $('#submit_forgot_password').removeClass('disabled');
                    $('#server_error_message').show();
                }
            });
        }
    });


    $('#confirm_save_account_enterprise').click(function (e) {
        e.preventDefault();
        $('#server_error_message').hide();
        $("#register_form_enterprise.ui.form input[name='save_account']").val('yes');
        $.ajax({
            type: 'post',
            url: $('#register_form_enterprise.ui.form').attr('action'),
            data: {'testunicity': 'yes', 'username': $('#register_form_enterprise.ui.form input[name="company_name"]').val(), 'email': $('#register_form_enterprise.ui.form input[name="email_pro"]').val(),
                'g-recaptcha-response': $('#register_form_enterprise.ui.form input[name="g-recaptcha-response-register"]').val()},
            dataType: 'json',
            beforeSend: function () {
                $('#block_recap').hide();
                $('#block_form_edit').show();
                $('#submit_create_account_enterprise').addClass('disabled');
                $('#confirm_save_account_enterprise').addClass('disabled');
                $('#edit_account').addClass('disabled');
                $('#register_form_enterprise.ui.form').addClass('loading');
            },
            statusCode: {
                500: function (xhr) {
                    $("#register_form_enterprise.ui.form input[name='save_account']").val('no');
                    $('#register_form_enterprise.ui.form').removeClass('loading');
                    grecaptcha.reset(widgetId_pro);
                    $('#server_error_message').show();
                },
                400: function (response, textStatus, jqXHR) {
                    $("#register_form_enterprise.ui.form input[name='save_account']").val('no');
                    $('#register_form_enterprise.ui.form').removeClass('loading');
                    $('#error_name_header').html("Echec de la validation");
                    $('#error_name_message').show();
                    grecaptcha.reset(widgetId_pro);

                }
            },
            success: function (response, textStatus, jqXHR) {
                if (response.success === true) {
                    $('#register_form_enterprise.ui.form').submit();
                } else if (response.success === false) {
                    $("#register_form_enterprise.ui.form input[name='save_account']").val('no');
                    $('#register_form_enterprise.ui.form').removeClass('loading');
                    grecaptcha.reset(widgetId_pro);
                    $('#error_name_header').html("Echec de la validation");
                    $('#error_name_list').html('<li>' + response.data.message + '</li>');
                    $('#error_name_message').show();
                } else {
                    $("#register_form_enterprise.ui.form input[name='save_account']").val('no');
                    $('#register_form_enterprise.ui.form').removeClass('loading');
                    grecaptcha.reset(widgetId_pro);
                    $('#error_name_header').html("Internal server error");
                    $('#error_name_message').show();
                }
            },
            error: function (jqXHR, textStatus, errorThrown) {
                $("#register_form_enterprise.ui.form input[name='save_account']").val('no');
                $('#register_form_enterprise.ui.form').removeClass('loading');
                grecaptcha.reset(widgetId_pro);
                $('#server_error_message').show();
            }
        });
    });

    $('#confirm_edit_account_enterprise').click(function (e) {
        e.preventDefault();
        $('#server_error_message').hide();
        $("#register_form_enterprise.ui.form input[name='edit_account']").val('yes');
        $.ajax({
            type: 'post',
            url: $('#register_form_enterprise.ui.form').attr('action'),
            data: {'testunicity': 'yes', 'username': $('#register_form_enterprise.ui.form input[name="company_name"]').val(), 'email': $('#register_form_enterprise.ui.form input[name="email_pro"]').val()},
            dataType: 'json',
            beforeSend: function () {
                $('#block_recap').hide();
                $('#block_form_edit').show();
                $('#submit_edit_account_enterprise').addClass('disabled');
                $('#confirm_edit_account_enterprise').addClass('disabled');
                $('#edit_account').addClass('disabled');
                $('#register_form_enterprise.ui.form').addClass('loading');
            },
            statusCode: {
                500: function (xhr) {
                    $("#register_form_enterprise.ui.form input[name='edit_account']").val('no');
                    $('#register_form_enterprise.ui.form').removeClass('loading');
                    $('#confirm_edit_account_enterprise').removeClass('disabled');
                    $('#server_error_message').show();
                },
                400: function (response, textStatus, jqXHR) {
                    $("#register_form_enterprise.ui.form input[name='edit_account']").val('no');
                    $('#register_form_enterprise.ui.form').removeClass('loading');
                    $('#error_name_header').html("Echec de la validation");
                    $('#error_name_message').show();
                    $('#confirm_edit_account_enterprise').removeClass('disabled');

                }
            },
            success: function (response, textStatus, jqXHR) {
                if (response.success === true) {
                    $('#register_form_enterprise.ui.form').submit();
                } else if (response.success === false) {
                    $("#register_form_enterprise.ui.form input[name='edit_account']").val('no');
                    $('#register_form_enterprise.ui.form').removeClass('loading');
                    $('#submit_edit_account_enterprise').removeClass('disabled');
                    $('#error_name_header').html("Echec de la validation");
                    $('#error_name_list').html('<li>' + response.data.message + '</li>');
                    $('#error_name_message').show();
                } else {
                    $("#register_form_enterprise.ui.form input[name='edit_account']").val('no');
                    $('#register_form_enterprise.ui.form').removeClass('loading');
                    $('#submit_edit_account_enterprise').removeClass('disabled');
                    $('#error_name_header').html("Internal server error");
                    $('#error_name_message').show();
                }
            },
            error: function (jqXHR, textStatus, errorThrown) {
                $("#register_form_enterprise.ui.form input[name='edit_account']").val('no');
                $('#register_form_enterprise.ui.form').removeClass('loading');
                $('#submit_edit_account_enterprise').removeClass('disabled');
                $('#server_error_message').show();
            }
        });
    });

    $('#confirm_save_account_particular').click(function (e) {
        e.preventDefault();
        if (getAge($('#register_form_particular.ui.form input[name="birthdate"]').datetimepicker('getValue')) >= 18) {
            $("#register_form_particular.ui.form input[name='save_account']").val('yes');
            $.ajax({
                type: 'post',
                url: $('#register_form_particular.ui.form').attr('action'),
                data: {'testunicity': 'yes', 'username': $('#register_form_particular.ui.form input[name="username"]').val(), 'email': $('#register_form_particular.ui.form input[name="email"]').val(),
                    'g-recaptcha-response': $('#register_form_particular.ui.form input[name="g-recaptcha-response-register"]').val()},
                dataType: 'json',
                beforeSend: function () {
                    $('#block_recap').hide();
                    $('#block_form_edit').show();
                    $('#submit_create_account_particular').addClass('disabled');
                    $('#edit_account').addClass('disabled');
                    $('#confirm_create_account').addClass('disabled');
                    $('#register_form_particular.ui.form').addClass('loading');
                },
                statusCode: {
                    500: function (xhr) {
                        $("#register_form_particular.ui.form input[name='save_account']").val('no');
                        $('#register_form_particular.ui.form').removeClass('loading');
                        grecaptcha.reset(widgetId_particular);
                        $('#server_error_message').show();
                    },
                    400: function (response, textStatus, jqXHR) {
                        $("#register_form_particular.ui.form input[name='save_account']").val('no');
                        $('#register_form_particular.ui.form').removeClass('loading');
                        $('#error_name_header').html("Echec de la validation");
                        $('#error_name_message').show();
                        grecaptcha.reset(widgetId_particular);

                    }
                },
                success: function (response, textStatus, jqXHR) {
                    if (response.success === true) {
                        $('#register_form_particular.ui.form').submit();
                    } else if (response.success === false) {
                        $("#register_form_particular.ui.form input[name='save_account']").val('no');
                        $('#register_form_particular.ui.form').removeClass('loading');
                        grecaptcha.reset(widgetId_particular);
                        $('#error_name_header').html("Echec de la validation");
                        $('#error_name_list').html('<li>' + response.data.message + '</li>');
                        $('#error_name_message').show();
                    } else {
                        $("#register_form_particular.ui.form input[name='save_account']").val('no');
                        $('#register_form_particular.ui.form').removeClass('loading');
                        grecaptcha.reset(widgetId_particular);
                        $('#error_name_header').html("Internal server error");
                        $('#error_name_message').show();
                    }
                },
                error: function (jqXHR, textStatus, errorThrown) {
                    $("#register_form_particular.ui.form input[name='save_account']").val('no');
                    $('#register_form_particular.ui.form').removeClass('loading');
                    grecaptcha.reset(widgetId_particular);
                    $('#server_error_message').show();
                }
            });
        } else {
            $('#register_form_particular.ui.form').removeClass('loading');
            grecaptcha.reset(widgetId_particular);
            $('#error_name_header').html("Echec de la validation");
            $('#error_name_list').html("<li>L'âge d'un utilisateur doit être supérieur ou égal à 18 ans</li>");
            $('#error_name_message').show();
            return false;
        }
    });

    $('#confirm_edit_account_particular').click(function (e) {
        e.preventDefault();
        if (getAge($('#register_form_particular.ui.form input[name="birthdate"]').datetimepicker('getValue')) >= 18) {
            $("#register_form_particular.ui.form input[name='edit_account']").val('yes');
            $.ajax({
                type: 'post',
                url: $('#register_form_particular.ui.form').attr('action'),
                data: {'testunicity': 'yes', 'username': $('#register_form_particular.ui.form input[name="username"]').val(), 'email': $('#register_form_particular.ui.form input[name="email"]').val()},
                dataType: 'json',
                beforeSend: function () {
                    $('#block_recap').hide();
                    $('#block_form_edit').show();
                    $('#submit_edit_account_particular').addClass('disabled');
                    $('#confirm_edit_account_particular').addClass('disabled');
                    $('#edit_account').addClass('disabled');
                    $('#register_form_particular.ui.form').addClass('loading');
                },
                statusCode: {
                    500: function (xhr) {
                        $("#register_form_particular.ui.form input[name='edit_account']").val('no');
                        $('#register_form_particular.ui.form').removeClass('loading');
                        $('#confirm_edit_account_particular').removeClass('disabled');
                        $('#server_error_message').show();
                    },
                    400: function (response, textStatus, jqXHR) {
                        $("#register_form_particular.ui.form input[name='edit_account']").val('no');
                        $('#error_name_header').html("Echec de la validation");
                        $('#error_name_message').show();
                        $('#confirm_edit_account_particular').removeClass('disabled');
                        $('#register_form_particular.ui.form').removeClass('loading');

                    }
                },
                success: function (response, textStatus, jqXHR) {
                    if (response.success === true) {
                        $('#register_form_particular.ui.form').submit();
                    } else if (response.success === false) {
                        $("#register_form_particular.ui.form input[name='edit_account']").val('no');
                        $('#submit_edit_account_particular').removeClass('disabled');
                        $('#error_name_header').html("Echec de la validation");
                        $('#error_name_list').html('<li>' + response.data.message + '</li>');
                        $('#error_name_message').show();
                        $('#register_form_particular.ui.form').removeClass('loading');
                    } else {
                        $("#register_form_particular.ui.form input[name='edit_account']").val('no');
                        $('#confirm_edit_account_particular').removeClass('disabled');
                        $('#error_name_header').html("Internal server error");
                        $('#error_name_message').show();
                        $('#register_form_particular.ui.form').removeClass('loading');
                    }
                },
                error: function (jqXHR, textStatus, errorThrown) {
                    $("#register_form_particular.ui.form input[name='edit_account']").val('no');
                    $('#register_form_particular.ui.form').removeClass('loading');
                    $('#submit_edit_account_particular').removeClass('disabled');
                    $('#server_error_message').show();
                }
            });
        } else {
            $('#register_form_particular.ui.form').removeClass('loading');
            $('#submit_edit_account_particular').removeClass('disabled');
            $('#error_name_header').html("Echec de la validation");
            $('#error_name_list').html("<li>L'âge d'un utilisateur doit être supérieur ou égal à 18 ans</li>");
            $('#error_name_message').show();
            return false;
        }
    });

    $('#edit_account').click(function (e) {
        e.preventDefault();
        $('#block_form_edit').show();
        $('#block_recap').hide();
    });
});



