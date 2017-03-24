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

//    $('.top-nav')
//            .visibility({
//                once: false,
//                onBottomPassed: function () {
//                    $('.fixed.menu').transition('fade in');
//                },
//                onBottomPassedReverse: function () {
//                    $('.fixed.menu').transition('fade out');
//                }
//            })
//            ;

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
                        prompt: 'Veuillez selectionner la ville de destination.'
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
                        prompt: 'Veuillez selectionner la ville de destination.'
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

    $('.ui.form.login_form')
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

});


