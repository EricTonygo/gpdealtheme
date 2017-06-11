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
    $.datetimepicker.setLocale($('html').attr('lang'));
    show_password_particular();
    hide_password_particular();
    show_password_confirm_particular();
    hide_password_confirm_particular();
    show_password_pro();
    hide_password_pro();
    show_password_confirm_pro();
    hide_password_confirm_pro();

    $('#profile_picture_edit').click(function () {
        $('#profile_picture_file').click();
    });

    function previewProfilePicture() {
        var preview = document.getElementById('profile_picture_img');
        var file = document.getElementById('profile_picture_file').files[0];
        var reader = new FileReader();
        reader.addEventListener("loadstart", function () {
            $('#profile_picture_edit').hide();
            $('#profile_picture_loader').show();
            $('#profile_picture_dimmer.image .dimmer').dimmer('show');
        }, false);

        reader.addEventListener("load", function () {
            preview.src = reader.result;
        }, false);

        reader.addEventListener("loadend", function () {
            $('#profile_picture_loader').hide();
            $('#profile_picture_edit').show();
            $('#profile_picture_dimmer.image .dimmer').dimmer('hide');

        }, false);

        if (file) {
            reader.readAsDataURL(file);
        }
    }

    $('#profile_picture_dimmer.image')
            .dimmer({
                on: 'hover'
            })
            ;

    $("#profile_picture_file").change(function () {
        //alert('This file size is: '+this.files[0].type+' ' + this.files[0].size/1024/1024 + "MB");
        previewProfilePicture();
    });


    $('#identity_file_link').click(function () {
        $('#identity_file').click();
    });

    function previewIdentityFile() {
        var preview = document.getElementById('identity_file_bloc');
        var file = document.getElementById('identity_file').files[0];
        var reader = new FileReader();
        if (file) {
            reader.addEventListener("loadstart", function () {
                $('#identity_file_link').addClass("loading");
            }, false);

            reader.addEventListener("load", function () {
                $('#identity_file_bloc').append($('<div id="identity_file_preview" class="ui message"><i class="close icon"></i><a class="header">' + file.name + ' </a></div>'));
                $('#identity_file_preview.message .close')
                        .on('click', function () {
                            $(this)
                                    .closest('.message')
                                    .transition('fade')
                                    ;
                            $('#identity_file').val('');
                            $('#identity_file_link').show();
                        })
                        ;
                $('#identity_file_preview>.close.icon').click(function (e) {
                    $('#identity_file_preview').remove();
                    $('#identity_file_link').show();
                });
                preview.src = reader.result;
            }, false);

            reader.addEventListener("loadend", function () {
                $('#identity_file_link').hide();
                $('#identity_file_link').removeClass("loading");
            }, false);

            reader.readAsDataURL(file);
        }
    }

    $('#identity_file_preview.message .close')
            .on('click', function () {
                $(this)
                        .closest('.message')
                        .transition('fade')
                        ;
                $('#identity_file').val('');
                $('#identity_file_link').show();
            })
            ;


    $("#identity_file").change(function () {
        //alert('This file size is: '+this.files[0].type+' ' + this.files[0].size/1024/1024 + "MB");
        previewIdentityFile();
    });





    $('#company_logo_edit').click(function () {
        $('#company_logo_file').click();
    });

    function previewCompanyLogo() {
        var preview = document.getElementById('company_logo_img');
        var file = document.getElementById('company_logo_file').files[0];
        var reader = new FileReader();
        reader.addEventListener("loadstart", function () {
            $('#company_logo_edit').hide();
            $('#company_logo_loader').show();
            $('#company_logo_dimmer.image .dimmer').dimmer('show');
        }, false);

        reader.addEventListener("load", function () {
            preview.src = reader.result;
        }, false);

        reader.addEventListener("loadend", function () {
            $('#company_logo_loader').hide();
            $('#company_logo_edit').show();
            $('#company_logo_dimmer.image .dimmer').dimmer('hide');

        }, false);

        if (file) {
            reader.readAsDataURL(file);
        }
    }

    $('#company_logo_dimmer.image')
            .dimmer({
                on: 'hover'
            })
            ;

    $("#company_logo_file").change(function () {
        //alert('This file size is: '+this.files[0].type+' ' + this.files[0].size/1024/1024 + "MB");
        previewCompanyLogo();
    });


    $('#identity_file_pro_link').click(function () {
        $('#identity_file_pro').click();
    });

    function previewIdentityFilePro() {
        var preview = document.getElementById('identity_file_pro_bloc');
        var file = document.getElementById('identity_file_pro').files[0];
        var reader = new FileReader();
        if (file) {
            reader.addEventListener("loadstart", function () {
                $('#identity_file_pro_link').addClass("loading");
            }, false);

            reader.addEventListener("load", function () {
                $('#identity_file_pro_bloc').append($('<div id="identity_file_pro_preview" class="ui message"><i class="close icon"></i><a class="header">' + file.name + ' </a></div>'));
                $('#identity_file_pro_preview.message .close')
                        .on('click', function () {
                            $(this)
                                    .closest('.message')
                                    .transition('fade')
                                    ;
                            $('#identity_file_pro').val('');
                            $('#identity_file_pro_link').show();
                        })
                        ;
                $('#identity_file_pro_preview>.close.icon').click(function (e) {
                    $('#identity_file_pro_preview').remove();
                    $('#identity_file_pro_link').show();
                });
                preview.src = reader.result;
            }, false);

            reader.addEventListener("loadend", function () {
                $('#identity_file_pro_link').hide();
                $('#identity_file_pro_link').removeClass("loading");
            }, false);

            reader.readAsDataURL(file);
        }
    }

    $('#identity_file_pro_preview.message .close')
            .on('click', function () {
                $(this)
                        .closest('.message')
                        .transition('fade')
                        ;
                $('#identity_file_pro').val('');
                $('#identity_file_pro_link').show();
            })
            ;


    $("#identity_file_pro").change(function () {
        //alert('This file size is: '+this.files[0].type+' ' + this.files[0].size/1024/1024 + "MB");
        previewIdentityFilePro();
    });


//    $('#company_logo_img').click(function () {
//        $('#company_logo_file').click();
//    });
//
//    function readURLCompanyLogo(input) {
//        if (input.files && input.files[0]) {
//            var reader = new FileReader();
//
//            reader.onload = function (e) {
//                $('#company_logo_img').attr('src', e.target.result);
//            };
//            reader.readAsDataURL(input.files[0]);
//        }
//    }
//
//    $("#company_logo_file").change(function () {
//        //alert('This file size is: '+this.files[0].type+' ' + this.files[0].size/1024/1024 + "MB");
//        readURLCompanyLogo(this);
//    });

$('#register_form')
            .form({
                fields: {
                    role: {
                        identifier: 'role',
                        rules: [
                            {
                                type: 'checked',
                                prompt: gpdeal_translate("Please select your account type")
                            }
                        ]
                    },                 
                    username: {
                        identifier: 'username',
                        rules: [
                            {
                                type: 'empty',
                                prompt: gpdeal_translate("Please enter your username")
                            }
                        ]
                    },

                    email: {
                        identifier: 'email',
                        rules: [
                            {
                                type: 'email',
                                prompt: gpdeal_translate("Please enter a valid email address")
                            }
                        ]
                    },
                    password: {
                        identifier: 'password',
                        rules: [
                            {
                                type: 'empty',
                                prompt: gpdeal_translate("Please enter your password")
                            }
                        ]
                    },
                    passwordConfirm: {
                        identifier: 'password_confirm',
                        rules: [
                            {
                                type: 'match[password]',
                                prompt: gpdeal_translate("The entered passwords do not match")
                            }
                        ]
                    },
                    terms: {
                        identifier: 'terms',
                        rules: [
                            {
                                type: 'checked',
                                prompt: gpdeal_translate("You must accept the terms of use")
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
                    $('#register_form').addClass('loading');
                    $('#confirm_save_account').addClass('disabled');

                }
            }
            );
    $("#register_form").bind("keypress", function (e) {
        if (e.keyCode === 13) {
            e.preventDefault();
            return false;
        }
    });


    $('#register_form_particular.ui.form')
            .form({
                fields: {
                    gender: {
                        identifier: 'gender',
                        rules: [
                            {
                                type: 'checked',
                                prompt: gpdeal_translate("Please enter your civility")
                            }
                        ]
                    },
                    last_name: {
                        identifier: 'last_name',
                        rules: [
                            {
                                type: 'empty',
                                prompt: gpdeal_translate("Please enter your last name")
                            }
                        ]
                    },
//                    username: {
//                        identifier: 'username',
//                        rules: [
//                            {
//                                type: 'empty',
//                                prompt: gpdeal_translate("Please enter your username")
//                            }
//                        ]
//                    },

                    number_street: {
                        identifier: 'number_street',
                        rules: [
                            {
                                type: 'empty',
                                prompt: gpdeal_translate("Please enter the street and number of your address")
                            }
                        ]
                    },
                    country: {
                        identifier: 'locality',
                        rules: [
                            {
                                type: 'empty',
                                prompt: gpdeal_translate("Please enter your locality")
                            }
                        ]
                    },
                    mobile_phone_country_code: {
                        identifier: 'mobile_phone_country_code',
                        rules: [
                            {
                                type: 'empty',
                                prompt: gpdeal_translate("Please select your country of phone number")
                            }
                        ]
                    },
                    mobile_phone_number: {
                        identifier: 'mobile_phone_number',
                        rules: [
                            {
                                type: 'empty',
                                prompt: gpdeal_translate("Please enter your mobile phone number")
                            },
                            {
                                type: 'integer',
                                prompt: gpdeal_translate("Please enter a valid phone number")
                            }
                        ]
                    },
                    email: {
                        identifier: 'email',
                        rules: [
                            {
                                type: 'email',
                                prompt: gpdeal_translate("Please enter a valid email address")
                            }
                        ]
                    },
                    email_confirm: {
                        identifier: 'email_confirm',
                        rules: [
                            {
                                type: 'match[email]',
                                prompt: gpdeal_translate("The entered email addresses do not match")
                            }
                        ]
                    },
                    password: {
                        identifier: 'password',
                        rules: [
                            {
                                type: 'empty',
                                prompt: gpdeal_translate("Please enter your password")
                            }
                        ]
                    },
                    passwordConfirm: {
                        identifier: 'password_confirm',
                        rules: [
                            {
                                type: 'match[password]',
                                prompt: gpdeal_translate("The entered passwords do not match")
                            }
                        ]
                    },
                    terms: {
                        identifier: 'terms',
                        rules: [
                            {
                                type: 'checked',
                                prompt: gpdeal_translate("You must accept the terms of use")
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
                    $('#register_form_particular.ui.form').addClass('loading');
                    $('#confirm_save_account_particular').addClass('disabled');
                    $('#submit_create_account_particular').addClass('disabled');
                    $('#submit_edit_account_particular').addClass('disabled');

                }
            }
            );

    $("#register_form_particular.ui.form").bind("keypress", function (e) {
        if (e.keyCode === 13) {
            e.preventDefault();
            return false;
        }
    });


    $('#register_form_enterprise.ui.form')
            .form({
                fields: {
                    civility: {
                        identifier: 'civility_representative1',
                        rules: [
                            {
                                type: 'checked',
                                prompt: gpdeal_translate("Please specify your representative's civility")
                            }
                        ]
                    },
                    last_name: {
                        identifier: 'last_name_representative1',
                        rules: [
                            {
                                type: 'empty',
                                prompt: gpdeal_translate("Please enter the name of the representative")
                            }
                        ]
                    },
                    company_name: {
                        identifier: 'company_name',
                        rules: [
                            {
                                type: 'empty',
                                prompt: gpdeal_translate("Please enter your company name")
                            }
                        ]
                    },

                    company_identity_number: {
                        identifier: 'company_identity_number',
                        rules: [
                            {
                                type: 'empty',
                                prompt: gpdeal_translate("Please enter your identification number")
                            }
                        ]
                    },
                    function_representative1: {
                        identifier: 'function_representative1',
                        rules: [
                            {
                                type: 'empty',
                                prompt: gpdeal_translate("Please enter your position in the company")
                            }
                        ]
                    },
                    number_street: {
                        identifier: 'number_street',
                        rules: [
                            {
                                type: 'empty',
                                prompt: gpdeal_translate("Please enter the street and number of your address")
                            }
                        ]
                    },
                    country: {
                        identifier: 'locality_pro',
                        rules: [
                            {
                                type: 'empty',
                                prompt: gpdeal_translate("Please enter your locality")
                            }
                        ]
                    },
                    postal_code: {
                        identifier: 'postal_code',
                        rules: [
                            {
                                type: 'empty',
                                prompt: gpdeal_translate("Please enter your postal code")
                            }
                        ]
                    },

                    mobile_phone_country_code_representative1: {
                        identifier: 'mobile_phone_country_code_representative1',
                        rules: [
                            {
                                type: 'empty',
                                prompt: gpdeal_translate("Please select your country of phone number")
                            }
                        ]
                    },

                    mobile_phone_number_representative1: {
                        identifier: 'mobile_phone_number_representationve1',
                        rules: [
                            {
                                type: 'empty',
                                prompt: gpdeal_translate("Please enter representative's mobile phone number")
                            },
                            {
                                type: 'integer',
                                prompt: gpdeal_translate("Please enter a valid phone number")
                            }
                        ]
                    },
                    home_phone_country_code: {
                        identifier: 'home_phone_country_code',
                        rules: [
                            {
                                type: 'empty',
                                prompt: gpdeal_translate("Please select your country of phone number")
                            }
                        ]
                    },
                    home_phone_number: {
                        identifier: 'home_phone_number',
                        rules: [
                            {
                                type: 'empty',
                                prompt: gpdeal_translate("Please enter company's phone number")
                            },
                            {
                                type: 'integer',
                                prompt: gpdeal_translate("Please enter a valid phone number")
                            }
                        ]
                    },

                    email_representative1: {
                        identifier: 'email_representative1',
                        rules: [
                            {
                                type: 'email',
                                prompt: gpdeal_translate("Please enter representative's email address")
                            }
                        ]
                    },

                    email_pro: {
                        identifier: 'email_pro',
                        rules: [
                            {
                                type: 'email',
                                prompt: gpdeal_translate("Please enter company's email address")
                            }
                        ]
                    },
                    email_confirm_pro: {
                        identifier: 'email_confirm_pro',
                        rules: [

                            {
                                type: 'match[email_pro]',
                                prompt: gpdeal_translate("The entered email addresses do not match")
                            }
                        ]
                    },
                    password_pro: {
                        identifier: 'password_pro',
                        rules: [
                            {
                                type: 'empty',
                                prompt: gpdeal_translate("Please enter your password")
                            }
                        ]
                    },
                    passwordConfirm_pro: {
                        identifier: 'password_confirm_pro',
                        rules: [
                            {
                                type: 'match[password_pro]',
                                prompt: gpdeal_translate("The entered passwords do not match")
                            }
                        ]
                    },
                    terms: {
                        identifier: 'terms',
                        rules: [
                            {
                                type: 'checked',
                                prompt: gpdeal_translate("You must accept the terms of use")
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

    $("#register_form_enterprise.ui.form").bind("keypress", function (e) {
        if (e.keyCode === 13) {
            e.preventDefault();
            return false;
        }
    });

    $('#forgot_password_form.ui.form')
            .form({
                fields: {
                    email: {
                        identifier: 'email',
                        rules: [
                            {
                                type: 'email',
                                prompt: gpdeal_translate("Please enter a valid email address")
                            }
                        ]
                    }
                },
                inline: true,
                on: 'blur'
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
                        $('#error_name_header').html(gpdeal_translate("Failed to validate"));
                        $('#error_name_message').show();
                    }
                },
                success: function (response, textStatus, jqXHR) {
                    if (response.success === true) {
                        $('#forgot_password_form.ui.form').submit();
                    } else if (response.success === false) {
                        $('#forgot_password_form.ui.form').removeClass('loading');
                        $('#submit_forgot_password').removeClass('disabled');
                        $('#error_name_header').html(gpdeal_translate("Failed to validate"));
                        $('#error_name_list').html('<li>' + response.data.message + '</li>');
                        $('#error_name_message').show();
                    } else {
                        $('#forgot_password_form.ui.form').removeClass('loading');
                        $('#submit_forgot_password').removeClass('disabled');
                        $('#error_name_header').html(gpdeal_translate("Internal server error"));
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

    $('#resend_reset_password_link_form')
            .form({
                fields: {
                    email: {
                        identifier: 'email',
                        rules: [
                            {
                                type: 'email',
                                prompt: gpdeal_translate("Please enter a valid email address")
                            }
                        ]
                    }
                },
                inline: false,
                on: 'blur'
            }
            );

    $('#submit_resend_reset_password_link').click(function (e) {
        e.preventDefault();
        $('#server_error_message').hide();
        $('#message_error').hide();
        //$('#forgot_password_form.ui.form').form('validate form');
        if ($('#resend_reset_password_link_form').form('is valid')) {
            $.ajax({
                type: 'post',
                url: $('#resend_reset_password_link_form').attr('action'),
                data: $('#resend_reset_password_link_form').serialize(),
                dataType: 'json',
                beforeSend: function () {
                    $('#submit_resend_reset_password_link').addClass('loading');
                },
                statusCode: {
                    500: function (xhr) {
                        $('#submit_resend_reset_password_link').removeClass('loading');
                        $('#server_error_message').show();
                    },
                    400: function (response, textStatus, jqXHR) {
                        $('#submit_resend_reset_password_link').removeClass('loading');
                        $('#message_error>.header').html(gpdeal_translate("Failed to validate"));
                        $('#message_error').show();
                    }
                },
                success: function (response, textStatus, jqXHR) {
                    if (response.success === true) {
                        $('#resend_reset_password_link_form').submit();
                    } else if (response.success === false) {
                        $('#submit_resend_reset_password_link').removeClass('disabled');
                        $('#message_error>.header').html('<li>' + response.data.message + '</li>');
                        $('#message_error').show();
                    } else {
                        $('#submit_resend_reset_password_link').removeClass('loading');
                        $('#message_error>.header').html(gpdeal_translate("Internal server error"));
                        $('#message_error').show();
                    }
                },
                error: function (jqXHR, textStatus, errorThrown) {
                    $('#submit_resend_reset_password_link').removeClass('loading');
                    $('#server_error_message').show();
                }
            });
        } else {
            $('#message_error>.header').html(gpdeal_translate("Invalid email address"));
            $('#message_error').show();
        }
    });


    //Reset a password
    $('#reset_password_form.ui.form')
            .form({
                fields: {
                    new_password: {
                        identifier: 'new_password',
                        rules: [
                            {
                                type: 'empty',
                                prompt: gpdeal_translate("Please enter the new password")
                            }
                        ]
                    },
                    confirm_new_password: {
                        identifier: 'confirm_new_password',
                        rules: [
                            {
                                type: 'match[new_password]',
                                prompt: gpdeal_translate("The entered passwords do not match")
                            }
                        ]
                    }
                },
                inline: true,
                on: 'blur'
            }
            );

    $('#submit_reset_password').click(function (e) {
        e.preventDefault();
        $('#server_error_message').hide();
        //$('#reset_password_form.ui.form').form('validate form');
        if ($('#reset_password_form.ui.form').form('is valid')) {
            $('#reset_password_form.ui.form').addClass('loading');
            $('#submit_reset_password').addClass('disabled');
            $('#reset_password_form.ui.form').submit();
        }
    });


    $('#confirm_save_account_enterprise').click(function (e) {
        e.preventDefault();
        if ($('#register_form_enterprise').form('is valid')) {
            confirm_save_account_enterprise();
        }
    });

    $("#confirm_save_account_enterprise").bind("keypress", function (e) {
        if (e.keyCode === 13) {
            if ($('#register_form_enterprise').form('is valid')) {
                confirm_save_account_enterprise();
            }
            return false;
        }
    });

    $('#confirm_edit_account_enterprise').click(function (e) {
        e.preventDefault();
        if ($('#register_form_enterprise').form('is valid')) {
            confirm_edit_account_enterprise();
        }
    });

    $("#confirm_edit_account_enterprise").bind("keypress", function (e) {
        if (e.keyCode === 13) {
            if ($('#register_form_enterprise').form('is valid')) {
                confirm_edit_account_enterprise();
            }
            return false;
        }
    });
    
    $('#confirm_save_account').click(function (e) {
        e.preventDefault();
        if ($('#register_form').form('is valid')) {
            confirm_save_account();
        }
    });

    $("#confirm_save_account").bind("keypress", function (e) {
        if (e.keyCode === 13) {
            if ($('#register_form').form('is valid')) {
                confirm_save_account();
            }
            return false;
        }
    });

    $('#confirm_save_account_particular').click(function (e) {
        e.preventDefault();
        if ($('#register_form_particular').form('is valid')) {
            confirm_save_account_particular();
        }
    });

    $("#confirm_save_account_particular").bind("keypress", function (e) {
        if (e.keyCode === 13) {
            if ($('#register_form_particular').form('is valid')) {
                confirm_save_account_particular();
            }
            return false;
        }
    });

    $('#confirm_edit_account_particular').click(function (e) {
        e.preventDefault();
        if ($('#register_form_particular').form('is valid')) {
            confirm_edit_account_particular();
        }
    });

    $("#confirm_edit_account_particular").bind("keypress", function (e) {
        if (e.keyCode === 13) {
            if ($('#register_form_particular').form('is valid')) {
                confirm_edit_account_particular();
            }
            return false;
        }
    });

    $('#edit_account').click(function (e) {
        e.preventDefault();
        $('#block_form_edit').show();
        $('#block_recap').hide();
    });
});


function confirm_edit_account_particular() {
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
                $('#error_name_header').html(gpdeal_translate("Failed to validate"));
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
                $('#error_name_header').html(gpdeal_translate("Failed to validate"));
                $('#error_name_list').html('<li>' + response.data.message + '</li>');
                $('#error_name_message').show();
                $('#register_form_particular.ui.form').removeClass('loading');
            } else {
                $("#register_form_particular.ui.form input[name='edit_account']").val('no');
                $('#confirm_edit_account_particular').removeClass('disabled');
                $('#error_name_header').html(gpdeal_translate("Internal server error"));
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

}

function confirm_save_account() {
    $("#register_form input[name='save_account']").val('yes');
    $.ajax({
        type: 'post',
        url: $('#register_form').attr('action'),
        data: {'testunicity': 'yes', 'username': $('#register_form input[name="username"]').val(), 'email': $('#register_form input[name="email"]').val(),
            'g-recaptcha-response': $('#register_form input[name="g-recaptcha-response-register"]').val()},
        dataType: 'json',
        beforeSend: function () {
            $('#block_recap').hide();
            $('#block_form_edit').show();
            $('#submit_create_account').addClass('disabled');
            $('#confirm_create_account').addClass('disabled');
            $('#register_form').addClass('loading');
        },
        statusCode: {
            500: function (xhr) {
                $('#register_form').removeClass('loading');
                grecaptcha.reset(widgetId_particular);
                $('#server_error_message').show();
            },
            400: function (response, textStatus, jqXHR) {
                $('#register_form').removeClass('loading');
                $('#error_name_header').html(gpdeal_translate("Failed to validate"));
                $('#error_name_message').show();
                grecaptcha.reset(widgetId_particular);

            }
        },
        success: function (response, textStatus, jqXHR) {
            if (response.success === true) {
                $('#register_form').submit();
            } else if (response.success === false) {
                $('#register_form').removeClass('loading');
                $('#error_name_header').html(gpdeal_translate("Failed to validate"));
                $('#error_name_list').html('<li>' + response.data.message + '</li>');
                $('#error_name_message').show();
                grecaptcha.reset(widgetId_particular);

            } else {
                $('#register_form').removeClass('loading');
                $('#error_name_header').html(gpdeal_translate("Internal server error"));
                $('#error_name_message').show();
                grecaptcha.reset(widgetId_particular);

            }
        },
        error: function (jqXHR, textStatus, errorThrown) {
            $('#register_form').removeClass('loading');
            $('#server_error_message').show();
            grecaptcha.reset(widgetId_particular);

        }
    });
}



function confirm_save_account_particular() {
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
                $('#error_name_header').html(gpdeal_translate("Failed to validate"));
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
                $('#error_name_header').html(gpdeal_translate("Failed to validate"));
                $('#error_name_list').html('<li>' + response.data.message + '</li>');
                $('#error_name_message').show();
                grecaptcha.reset(widgetId_particular);

            } else {
                $("#register_form_particular.ui.form input[name='save_account']").val('no');
                $('#register_form_particular.ui.form').removeClass('loading');
                $('#error_name_header').html(gpdeal_translate("Internal server error"));
                $('#error_name_message').show();
                grecaptcha.reset(widgetId_particular);

            }
        },
        error: function (jqXHR, textStatus, errorThrown) {
            $("#register_form_particular.ui.form input[name='save_account']").val('no');
            $('#register_form_particular.ui.form').removeClass('loading');
            $('#server_error_message').show();
            grecaptcha.reset(widgetId_particular);

        }
    });
}

function confirm_edit_account_enterprise() {
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
                $('#error_name_header').html(gpdeal_translate("Failed to validate"));
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
                $('#error_name_header').html(gpdeal_translate("Failed to validate"));
                $('#error_name_list').html('<li>' + response.data.message + '</li>');
                $('#error_name_message').show();
            } else {
                $("#register_form_enterprise.ui.form input[name='edit_account']").val('no');
                $('#register_form_enterprise.ui.form').removeClass('loading');
                $('#submit_edit_account_enterprise').removeClass('disabled');
                $('#error_name_header').html(gpdeal_translate("Internal server error"));
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
}

function confirm_save_account_enterprise() {
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
                $('#error_name_header').html(gpdeal_translate("Failed to validate"));
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
                $('#error_name_header').html(gpdeal_translate("Failed to validate"));
                $('#error_name_list').html('<li>' + response.data.message + '</li>');
                $('#error_name_message').show();
            } else {
                $("#register_form_enterprise.ui.form input[name='save_account']").val('no');
                $('#register_form_enterprise.ui.form').removeClass('loading');
                grecaptcha.reset(widgetId_pro);
                $('#error_name_header').html(gpdeal_translate("Internal server error"));
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
}