function show_password_login() {
    $('.unhide.link.icon.show_hide_password_login').click(function () {
        $(this).parents('.ui.form.login_form:first-child').find('input[name="_password"]').showPassword();
        $(this).removeClass('unhide');
        $(this).addClass('hide');
        hide_password_login();
    });
}
function hide_password_login() {
    $('.hide.link.icon.show_hide_password_login').click(function () {
        $(this).parents('.ui.form.login_form:first-child').find('input[name="_password"]').hidePassword();
        $(this).removeClass('hide');
        $(this).addClass('unhide');
        show_password_login();
    });
}

$(document).ready(function () {
    $.datetimepicker.setLocale('fr');
    show_password_login();
    hide_password_login();
    /* Navbar animation */
    $(window).bind('mousewheel', function (event) {
        if (event.originalEvent.wheelDelta >= 0) {
            $('.fixed.top.menu').removeClass('slide up');
        } else {
            $('.fixed.top.menu').addClass('slide up');
            $('.vertical.menu.collapse').removeClass('slide down');
        }

    });

//    $("form").bind("keypress", function (e) {
//        if (e.keyCode == 13) {
//            return false;
//        }
//    });


    /* Back to top fade */
    $(window).scroll(function (event) {
        var scroll = $(window).scrollTop();
        $('#toTop').hide();
        if (scroll > 200) {
            $('#toTop').show();
        } else {
            $('#toTop').hide();
        }

        if (scroll == 0) {
            $('.fixed.top.menu').removeClass('slide up');
        }
    });

    /* Scroll Event*/
    $('a[data-slide="slide"]').on('click', function (e) {
        e.preventDefault();

        var target = this.hash;
        var $target = $(target);

        $('html, body').stop().animate({
            'scrollTop': $target.offset().top - 90
        }, 900, 'swing');
    });

    /* Responsive Event */
    var navbarMenu = $('.fixed.top.menu .center.menu').clone();
    $('.vertical.menu.collapse').html(navbarMenu);

    $('#trigger').click(function (e) {
        e.preventDefault();
        $('.vertical.menu.collapse').toggleClass('slide down');
    });

    /* First Slider */
    $('#single-slider').owlCarousel({
        loop: true,
        margin: 10,
        nav: false,
        autoplay: true,
        responsive: {
            0: {
                items: 1
            },
            600: {
                items: 1
            },
            1000: {
                items: 1
            }
        }
    });

    $('#single-second-slider').owlCarousel({
        loop: true,
        margin: 10,
        nav: false,
        autoplay: true,
        responsive: {
            0: {
                items: 1
            },
            600: {
                items: 1
            },
            1000: {
                items: 1
            }
        }
    });

    $('#multiple-slider').owlCarousel({
        loop: true,
        margin: 10,
        nav: false,
        autoplay: true,
        responsive: {
            0: {
                items: 1
            },
            600: {
                items: 3
            },
            1000: {
                items: 4
            }
        }
    });
//    $('#birthday').calendar({
//        type: 'date',
//        monthFirst: false
//    });
    $('.message .close')
            .on('click', function () {
                $(this).parent(".message").hide();
            })
            ;

    $('.ui.sidebar')
            .sidebar({
                //context: $('.bottom.segment'),
                dimPage: false
            })
            .sidebar('setting', 'transition', 'overlay')
            .sidebar('attach events', '.toc.item')
            ;

    $('.main.menu')
            .visibility({
                once: false,
                onBottomPassed: function () {
                    $(this).addClass('.shadow_main_menu');
                },
                onBottomPassedReverse: function () {
                    $(this).removeClass('.shadow_main_menu');
                }
            })
            ;

    // show dropdown on hover
    $('.ui.dropdown').dropdown({
        on: 'click'
    });

    $('.ui.accordion')
            .accordion({

            })
            ;

    $('.ui.top.attached.tabular.menu .item')
            .tab({

            });

    $('a[href^="#"]').click(function () {
        var the_id = $(this).attr("href");

        $('html, body').animate({
            scrollTop: $(the_id).offset().top
        }, 'slow');
        $('a.item').removeClass('active');
        $(this).addClass('active');
        return false;
    });

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

    $('#search_transport_offers_form.ui.form').form({
        fields: {

            start_date: {
                identifier: 'start_date',
                rules: [
                    {
                        type: 'empty',
                        prompt: 'Veuillez renseigner la date de départ'
                    }
                ]
            },
            start_city: {
                identifier: 'start_city',
                rules: [
                    {
                        type: 'empty',
                        prompt: 'Veuillez saisir la ville de départ.'
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
            destionation_city: {
                identifier: 'destination_city',
                rules: [
                    {
                        type: 'empty',
                        prompt: 'Veuillez sasir la ville de destination.'
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
            $('#search_transport_offers_form.ui.form').addClass('loading');
            $('#submit_search_transport_offers').addClass('disabled');
            var today = new Date();
            var valid = true;
            today.setHours(0);
            today.setMinutes(0);
            today.setSeconds(0);
            today.setMilliseconds(0);
            if ($('#search_transport_offers_form.ui.form input[name="start_date"]').val() !== "" && $('#search_transport_offers_form.ui.form input[name="destination_date"]').val() !== "") {
                var start_date = $('#search_transport_offers_form.ui.form input[name="start_date"]').datetimepicker('getValue');
                var destination_date = $('#search_transport_offers_form.ui.form input[name="destination_date"]').datetimepicker('getValue');
                start_date.setHours(0);
                start_date.setMinutes(0);
                start_date.setSeconds(0);
                start_date.setMilliseconds(0);
                destination_date.setHours(0);
                destination_date.setMinutes(0);
                destination_date.setSeconds(0);
                destination_date.setMilliseconds(0);
                if (today.getTime() > start_date.getTime()) {
                    $('#search_transport_offers_form.ui.form').removeClass('loading');
                    $('#submit_search_transport_offers').removeClass('disabled');
                    $('#error_name_header').html("Erreur(s)");
                    $('#error_name_list').html("<li>La date de départ ne peut pas être inférieure à la date du jour</li>");
                    valid = false;
                }
                if (today.getTime() > destination_date.getTime()) {
                    $('#search_transport_offers_form.ui.form').removeClass('loading');
                    $('#submit_search_transport_offers').removeClass('disabled');
                    $('#error_name_header').html("Erreur(s)");
                    $('#error_name_list').append("<li>La date de destination ne peut pas être inférieure à la date du jour</li>");
                    valid = false;
                }
                if (start_date.getTime() > destination_date.getTime()) {
                    $('#search_transport_offers_form.ui.form').removeClass('loading');
                    $('#submit_search_transport_offers').removeClass('disabled');
                    $('#error_name_header').html("Erreur(s)");
                    $('#error_name_list').append("<li>La date de destination ne peut pas être inférieure à la date de départ</li>");
                    valid = false;
                }
            } else {
                if ($('#search_transport_offers_form.ui.form input[name="start_date"]').val() !== "") {
                    var start_date = $('#search_transport_offers_form.ui.form input[name="start_date"]').datetimepicker('getValue');
                    start_date.setHours(0);
                    start_date.setMinutes(0);
                    start_date.setSeconds(0);
                    start_date.setMilliseconds(0);
                    if (today.getTime() > start_date.getTime()) {
                        $('#search_transport_offers_form.ui.form').removeClass('loading');
                        $('#submit_search_transport_offers').removeClass('disabled');
                        $('#error_name_header').html("Erreur");
                        $('#error_name_list').html("<li>La date de départ ne peut pas être inférieure à la date du jour</li>");
                        valid = false;
                    }
                } else if ($('#search_transport_offers_form.ui.form input[name="destination_date"]').val() !== "") {
                    var destination_date = $('#search_transport_offers_form.ui.form input[name="destination_date"]').datetimepicker('getValue');
                    destination_date.setHours(0);
                    destination_date.setMinutes(0);
                    destination_date.setSeconds(0);
                    destination_date.setMilliseconds(0);

                    if (today.getTime() > destination_date.getTime()) {
                        $('#search_transport_offers_form.ui.form').removeClass('loading');
                        $('#submit_search_transport_offers').removeClass('disabled');
                        $('#error_name_header').html("Erreur");
                        $('#error_name_list').html("<li>La date de destination ne peut pas être inférieure à la date du jour</li>");
                        valid = false;
                    }
                }
            }

            if (!valid) {
                $('#error_name_message').show();
                return false;
            }

        }

    });


    $('#search_unsatisfied_packages_form.ui.form').form({
        fields: {

            start_date: {
                identifier: 'start_date',
                rules: [
                    {
                        type: 'empty',
                        prompt: 'Veuillez renseigner la date de départ'
                    }
                ]
            },

            start_city: {
                identifier: 'start_city',
                rules: [
                    {
                        type: 'empty',
                        prompt: 'Veuillez saisir la ville de départ.'
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

            destionation_city: {
                identifier: 'destination_city',
                rules: [
                    {
                        type: 'empty',
                        prompt: 'Veuillez saisir la ville de destination.'
                    }
                ]
            }

        },
        inline: true,
        on: 'change',
        onSuccess: function (event, fields) {
            $('#error_name_message_package').hide();
            $('#error_name_header_package').html("");
            $('#error_name_list_package').html("");
            $('#search_unsatisfied_packages_form.ui.form').addClass('loading');
            $('#submit_search_unsatisfied_packages').addClass('disabled');
            var today = new Date();
            var valid = true;
            today.setHours(0);
            today.setMinutes(0);
            today.setSeconds(0);
            today.setMilliseconds(0);
            if ($('#search_unsatisfied_packages_form.ui.form input[name="start_date"]').val() !== "" && $('#search_transport_offers_form.ui.form input[name="destination_date"]').val() !== "") {
                var start_date = $('#search_unsatisfied_packages_form.ui.form input[name="start_date"]').datetimepicker('getValue');
                var destination_date = $('#search_unsatisfied_packages_form.ui.form input[name="destination_date"]').datetimepicker('getValue');
                start_date.setHours(0);
                start_date.setMinutes(0);
                start_date.setSeconds(0);
                start_date.setMilliseconds(0);
                destination_date.setHours(0);
                destination_date.setMinutes(0);
                destination_date.setSeconds(0);
                destination_date.setMilliseconds(0);
                if (today.getTime() > start_date.getTime()) {
                    $('#search_unsatisfied_packages_form.ui.form').removeClass('loading');
                    $('#submit_search_unsatisfied_packages').removeClass('disabled');
                    $('#error_name_header_package').html("Erreur(s)");
                    $('#error_name_list_package').html("<li>La date de départ ne peut pas être inférieure à la date du jour</li>");
                    valid = false;
                }
                if (today.getTime() > destination_date.getTime()) {
                    $('#search_unsatisfied_packages_form.ui.form').removeClass('loading');
                    $('#submit_search_unsatisfied_packages').removeClass('disabled');
                    $('#error_name_header_package').html("Erreur(s)");
                    $('#error_name_list_package').append("<li>La date de destination ne peut pas être inférieure à la date du jour</li>");
                    valid = false;
                }
                if (start_date.getTime() > destination_date.getTime()) {
                    $('#search_unsatisfied_packages_form.ui.form').removeClass('loading');
                    $('#submit_search_unsatisfied_packages').removeClass('disabled');
                    $('#error_name_header_package').html("Erreur(s)");
                    $('#error_name_list_package').append("<li>La date de destination ne peut pas être inférieure à la date de départ</li>");
                    valid = false;
                }
            } else {
                if ($('#search_unsatisfied_packages_form.ui.form input[name="start_date"]').val() !== "") {
                    var start_date = $('#search_unsatisfied_packages_form.ui.form input[name="start_date"]').datetimepicker('getValue');
                    start_date.setHours(0);
                    start_date.setMinutes(0);
                    start_date.setSeconds(0);
                    start_date.setMilliseconds(0);
                    if (today.getTime() > start_date.getTime()) {
                        $('#search_unsatisfied_packages_form.ui.form').removeClass('loading');
                        $('#submit_search_unsatisfied_packages').removeClass('disabled');
                        $('#error_name_header_package').html("Erreur");
                        $('#error_name_list_package').html("<li>La date de départ ne peut pas être inférieure à la date du jour</li>");
                        valid = false;
                    }
                } else if ($('#search_unsatisfied_packages_form.ui.form input[name="destination_date"]').val() !== "") {
                    var destination_date = $('#search_unsatisfied_packages_form.ui.form input[name="destination_date"]').datetimepicker('getValue');
                    destination_date.setHours(0);
                    destination_date.setMinutes(0);
                    destination_date.setSeconds(0);
                    destination_date.setMilliseconds(0);

                    if (today.getTime() > destination_date.getTime()) {
                        $('#search_unsatisfied_packages_form.ui.form').removeClass('loading');
                        $('#submit_search_unsatisfied_packages').removeClass('disabled');
                        $('#error_name_header_package').html("Erreur");
                        $('#error_name_list_package').html("<li>La date de destination ne peut pas être inférieure à la date du jour</li>");
                        valid = false;
                    }
                }
            }
            if (!valid) {
                $('#error_name_message_package').show();
                return false;
            }
        }

    });

    $(window).on('resize', function () {
        if (window.matchMedia("(max-width: 800px)").matches) {
            $('#submit_search_transport_offers').addClass("fluid");
            $('#submit_create_account_particular').addClass("fluid");
            $('#submit_create_account_enterprise').addClass("fluid");
            $('#submit_search_unsatisfied_packages').addClass("fluid");
            $('#submit_contact_form').addClass('fluid');
            $('#submit_forgot_password').addClass('fluid');
        } else {
            $('#submit_search_transport_offers').removeClass("fluid");
            $('#submit_create_account_particular').removeClass("fluid");
            $('#submit_create_account_enterprise').removeClass("fluid");
            $('#submit_contact_form').removeClass('fluid');
            $('#submit_forgot_password').removeClass('fluid');
            $('#submit_search_unsatisfied_packages').removeClass("fluid");
        }
    });


    if (window.matchMedia("(max-width: 800px)").matches) {
        $('.ui.form .ui.button').addClass("fluid");
    }

    $('#search_input_top_form').submit(function () {
        if ($('#search_input_top_form input[name="s"]').val() === "") {
            return false;
        }
        $('#submit_search_input_top').addClass('loading');
    });

    $('#sidebar_menu_item').click(function (e) {
        e.preventDefault();
        $(this).hide();
        $('#remove_menu_item').show();
        $('#remove_menu_item i').transition('jiggle');
        $('#sub_main_menu').transition('slide down');
    });
    $('#remove_menu_item').click(function (e) {
        e.preventDefault();
        $(this).hide();
        $('#sidebar_menu_item').show();
        $('#sidebar_menu_item i').transition('jiggle');
        $('#sub_main_menu').transition('slide down');
    });

    $('#login_form1.ui.form')
            .form({
                fields: {
                    username: {
                        identifier: '_username',
                        rules: [
                            {
                                type: 'empty',
                                prompt: 'Veuillez saisir votre login'
                            }
                        ]
                    },
                    last_name: {
                        identifier: '_password',
                        rules: [
                            {
                                type: 'empty',
                                prompt: 'Veuillez saisir votre mot de passe'
                            }
                        ]
                    }
                }
                //inline: true,
                //on: 'change'
            });

    $('#submit_login_form1').click(function (e) {
        e.preventDefault();
        $('#server_error_message').hide();
        if ($('#login_form1.ui.form').form('is valid')) {
            $.ajax({
                type: 'post',
                url: $('#login_form1.ui.form').attr('action'),
                data: $('#login_form1.ui.form').serialize(),
                dataType: 'json',
                beforeSend: function () {
                    $('#login_form1.ui.form').addClass('loading');
                    $('#submit_login_form1').addClass('disabled');
                    $('#server_error_message1').hide();
                    $('#error_name_message1').hide();
                },
                statusCode: {
                    500: function (xhr) {
                        $('#login_form1.ui.form').removeClass('loading');
                        $('#submit_login_form1').removeClass('disabled');
                        $('#server_error_message1').show();
                    },
                    400: function (response, textStatus, jqXHR) {
                        $('#login_form1.ui.form').removeClass('loading');
                        $('#submit_login_form1').removeClass('disabled');
                        $('#error_name_header1').html("Echec de la validation");
                        $('#error_name_message1').show();
                    }
                },
                success: function (response, textStatus, jqXHR) {
                    if (response.success === true) {
                        $('#login_form1.ui.form').submit();
                    } else if (response.success === false) {
                        $('#login_form1.ui.form').removeClass('loading');
                        $('#submit_login_form1').removeClass('disabled');
                        $('#error_name_list1').html('<li>' + response.data.message + '</li>');
                        $('#error_name_message1').show();
                    } else {
                        $('#login_form1.ui.form').removeClass('loading');
                        $('#submit_login_form1').removeClass('disabled');
                        $('#error_name_header1').html("Internal server error");
                        $('#error_name_message1').show();
                    }
                },
                error: function (jqXHR, textStatus, errorThrown) {
                    $('#login_form1.ui.form').removeClass('loading');
                    $('#submit_login_form1').removeClass('disabled');
                    $('#server_error_message1').show();
                }
            });
        }
    });


    $('#login_form.ui.form')
            .form({
                fields: {
                    username: {
                        identifier: '_username',
                        rules: [
                            {
                                type: 'empty',
                                prompt: 'Veuillez saisir votre login'
                            }
                        ]
                    },
                    last_name: {
                        identifier: '_password',
                        rules: [
                            {
                                type: 'empty',
                                prompt: 'Veuillez saisir votre mot de passe'
                            }
                        ]
                    }
                }
                //inline: true,
                //on: 'change'
            });

    $('#submit_login_form').click(function (e) {
        e.preventDefault();
        $('#server_error_message').hide();
        if ($('#login_form.ui.form').form('is valid')) {
            $.ajax({
                type: 'post',
                url: $('#login_form.ui.form').attr('action'),
                data: $('#login_form.ui.form').serialize(),
                dataType: 'json',
                beforeSend: function () {
                    $('#login_form.ui.form').addClass('loading');
                    $('#submit_login_form').addClass('disabled');
                    $('#server_error_message').hide();
                    $('#error_name_message').hide();
                },
                statusCode: {
                    500: function (xhr) {
                        $('#login_form.ui.form').removeClass('loading');
                        $('#submit_login_form').removeClass('disabled');
                        $('#server_error_message').show();
                    },
                    400: function (response, textStatus, jqXHR) {
                        $('#login_form.ui.form').removeClass('loading');
                        $('#submit_login_form').removeClass('disabled');
                        $('#error_name_header').html("Echec de la validation");
                        $('#error_name_message').show();
                    }
                },
                success: function (response, textStatus, jqXHR) {
                    if (response.success === true) {
                        $('#login_form.ui.form').submit();
                    } else if (response.success === false) {
                        $('#login_form.ui.form').removeClass('loading');
                        $('#submit_login_form').removeClass('disabled');
                        $('#error_name_list').html('<li>' + response.data.message + '</li>');
                        $('#error_name_message').show();
                    } else {
                        $('#login_form.ui.form').removeClass('loading');
                        $('#submit_login_form').removeClass('disabled');
                        $('#error_name_header').html("Internal server error");
                        $('#error_name_message').show();
                    }
                },
                error: function (jqXHR, textStatus, errorThrown) {
                    $('#login_form.ui.form').removeClass('loading');
                    $('#submit_login_form').removeClass('disabled');
                    $('#server_error_message').show();
                }
            });
        }
    });

    $('#login_form2.ui.form')
            .form({
                fields: {
                    username: {
                        identifier: '_username',
                        rules: [
                            {
                                type: 'empty',
                                prompt: 'Veuillez saisir votre login'
                            }
                        ]
                    },
                    last_name: {
                        identifier: '_password',
                        rules: [
                            {
                                type: 'empty',
                                prompt: 'Veuillez saisir votre mot de passe'
                            }
                        ]
                    }
                }
                //inline: true,
                //on: 'change'
            });

    $('#submit_login_form2').click(function (e) {
        e.preventDefault();
        $('#server_error_message').hide();
        if ($('#login_form2.ui.form').form('is valid')) {
            $.ajax({
                type: 'post',
                url: $('#login_form2.ui.form').attr('action'),
                data: $('#login_form2.ui.form').serialize(),
                dataType: 'json',
                beforeSend: function () {
                    $('#login_form2.ui.form').addClass('loading');
                    $('#submit_login_form2').addClass('disabled');
                    $('#server_error_message2').hide();
                    $('#error_name_message2').hide();
                },
                statusCode: {
                    500: function (xhr) {
                        $('#login_form2.ui.form').removeClass('loading');
                        $('#submit_login_form2').removeClass('disabled');
                        $('#server_error_message2').show();
                    },
                    400: function (response, textStatus, jqXHR) {
                        $('#login_form2.ui.form').removeClass('loading');
                        $('#submit_login_form2').removeClass('disabled');
                        $('#error_name_header2').html("Echec de la validation");
                        $('#error_name_message2').show();
                    }
                },
                success: function (response, textStatus, jqXHR) {
                    if (response.success === true) {
                        $('#login_form2.ui.form').submit();
                    } else if (response.success === false) {
                        $('#login_form2.ui.form').removeClass('loading');
                        $('#submit_login_form2').removeClass('disabled');
                        $('#error_name_list2').html('<li>' + response.data.message + '</li>');
                        $('#error_name_message2').show();
                    } else {
                        $('#login_form2.ui.form').removeClass('loading');
                        $('#submit_login_form2').removeClass('disabled');
                        $('#error_name_header2').html("Internal server error");
                        $('#error_name_message2').show();
                    }
                },
                error: function (jqXHR, textStatus, errorThrown) {
                    $('#login_form2.ui.form').removeClass('loading');
                    $('#submit_login_form2').removeClass('disabled');
                    $('#server_error_message2').show();
                }
            });
        }
    });


    $('#login_form3.ui.form')
            .form({
                fields: {
                    username: {
                        identifier: '_username',
                        rules: [
                            {
                                type: 'empty',
                                prompt: 'Veuillez saisir votre login'
                            }
                        ]
                    },
                    last_name: {
                        identifier: '_password',
                        rules: [
                            {
                                type: 'empty',
                                prompt: 'Veuillez saisir votre mot de passe'
                            }
                        ]
                    }
                }
                //inline: true,
                //on: 'change'
            });

    $('#submit_login_form3').click(function (e) {
        e.preventDefault();
        submit_login_modal();
    });
    $("#login_form3.ui.form").bind("keypress", function (e) {
        if (e.keyCode == 13) {
            submit_login_modal();
            return false;
        }
    });

    //*************************************************ReFresh page every 5 seconds if not focus*******************************
//    var window_focus;
//    $(window).focus(function () {
//        window_focus = true;
//    }).blur(function () {
//        window_focus = false;
//    });
//    function checkReload() {
//        if (!window_focus) {
//            location.reload();  // if not focused, reload
//        }
//    }
//    setInterval(checkReload, 10000);  // check if not focused, every 5 seconds
    
    //*****************************************************************************************************************************
});

function signin() {
    $('#login_modal.ui.modal').modal('setting', {
            autofocus: false,
            inverted: true
            //closable: false
        });
    $('#login_modal.ui.small.modal')
            .modal('show')
            ;
}

function submit_login_modal() {
    $('#server_error_message').hide();
    if ($('#login_form3.ui.form').form('is valid')) {
        $.ajax({
            type: 'post',
            url: $('#login_form3.ui.form').attr('action'),
            data: $('#login_form3.ui.form').serialize(),
            dataType: 'json',
            beforeSend: function () {
                $('#login_form3.ui.form').addClass('loading');
                $('#submit_login_form3').addClass('disabled');
                $('#cancel_login_form3').addClass('disabled');
                $('#server_error_message3').hide();
                $('#error_name_message3').hide();
            },
            statusCode: {
                500: function (xhr) {
                    $('#login_form3.ui.form').removeClass('loading');
                    $('#submit_login_form3').removeClass('disabled');
                    $('#cancel_login_form3').removeClass('disabled');
                    $('#server_error_message3').show();
                },
                400: function (response, textStatus, jqXHR) {
                    $('#login_form3.ui.form').removeClass('loading');
                    $('#submit_login_form3').removeClass('disabled');
                    $('#cancel_login_form3').removeClass('disabled');
                    $('#error_name_header3').html("Echec de la validation");
                    $('#error_name_message3').show();
                }
            },
            success: function (response, textStatus, jqXHR) {
                if (response.success === true) {
                    //$('#login_form3.ui.form').submit();
                    location.reload();
                } else if (response.success === false) {
                    $('#login_form3.ui.form').removeClass('loading');
                    $('#submit_login_form3').removeClass('disabled');
                    $('#error_name_list3').html('<li>' + response.data.message + '</li>');
                    $('#error_name_message3').show();
                } else {
                    $('#login_form3.ui.form').removeClass('loading');
                    $('#submit_login_form3').removeClass('disabled');
                    $('#cancel_login_form3').removeClass('disabled');
                    $('#error_name_header3').html("Internal server error");
                    $('#error_name_message3').show();
                }
            },
            error: function (jqXHR, textStatus, errorThrown) {
                $('#login_form3.ui.form').removeClass('loading');
                $('#submit_login_form3').removeClass('disabled');
                $('#cancel_login_form3').removeClass('disabled');
                $('#server_error_message3').show();
            }
        });
    }
}
