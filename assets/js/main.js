//function show_password_login() {
//    $('.unhide.link.icon.show_hide_password_login').click(function () {
//        $(this).parents('.ui.form.login_form:first-child').find('input[name="_password"]').showPassword();
//        $(this).removeClass('unhide');
//        $(this).addClass('hide');
//        hide_password_login();
//    });
//}
//function hide_password_login() {
//    $('.hide.link.icon.show_hide_password_login').click(function () {
//        $(this).parents('.ui.form.login_form:first-child').find('input[name="_password"]').hidePassword();
//        $(this).removeClass('hide');
//        $(this).addClass('unhide');
//        show_password_login();
//    });
//}

$(document).ready(function () {
    $.datetimepicker.setLocale($('html').attr('lang'));
    // Wont re-appear unless cleared
    $('.cookie.nag')
            .nag('show')
            ;

//    // Clears cookie so nag shows again
//    $('.cookie.nag')
//            .nag('clear')
//            ;

//    // Automatically shows on init if cookie isnt set
//    $('.cookie.nag')
//            .nag({
//                key: 'accepts-cookies',
//                value: true
//            })
//            ;

    $('.cookie.nag').find(".close.icon").click(function (e) {
        $('#alert-cookies').hide();
    });
//    $(this).bind("contextmenu", function (e) {
//        e.preventDefault();
//    });
//    show_password_login();
//    hide_password_login();
//    var mouseX;
//    var mouseY;
//    $(document).mousemove(function (e) {
//        mouseX = e.pageX;
//        mouseY = e.pageY;
//    });
//    $('i.select_type_package_help_link').hover(function () {
//        //alert(mouseX+" "+mouseY);
//        if (window.matchMedia("(max-width: 800px)").matches) {
//            $('#select_type_package_help_content').css({'top': mouseY-100, 'left': mouseX-78}).transition('fade in');
//        }else{
//            $('#select_type_package_help_content').css({'top': mouseY-150, 'left': mouseX-78}).transition('fade in');
//        }
//        
//    }, function () {
//        $('#select_type_package_help_content').transition('fade out');
//    });
//    
//    
//    $('i.deadline_transport_offer_help_link').hover(function () {
//        //alert(mouseX+" "+mouseY);
//        $('#deadline_transport_offer_help_content').css({'top': mouseY-50, 'left': mouseX-85}).transition('fade in');
//    }, function () {
//        $('#deadline_transport_offer_help_content').transition('fade out');
//    });
//    
//    $('i.type_package_transport_offer_help_link').hover(function () {
//        //alert(mouseX+" "+mouseY);
//        $('#type_package_transport_offer_help_content').css({'top': mouseY-50, 'left': mouseX-85}).transition('fade in');
//    }, function () {
//        $('#type_package_transport_offer_help_content').transition('fade out');
//    });

    $('input.locality').on("change paste keyup", function (e) {
        var myclass = $(this).attr('id');
        if ($(this).val() !== "") {
            $('i.remove.link.icon.' + myclass).show();
        } else {
            $('i.remove.link.icon.' + myclass).hide();
        }
    });

    $('input.locality').on("focusout", function (e) {
        var myclass = $(this).attr('id');
        if ($(this).val() === "") {
            $('i.remove.link.icon.' + myclass).hide();
        }
    });

    $('i.remove.link.icon').click(function (e) {
        var myid = $(this).attr('locality_id');
        $('#' + myid).val("");
        $('i.remove.link.icon.' + myid).hide();
    });

    $('input.visible_password').on("change paste keyup", function (e) {
        var myclass = $(this).attr('id');
        if ($(this).val() !== "") {
            $('i.unhide.link.icon.' + myclass).show();
        } else {
            $('i.unhide.link.icon.' + myclass).hide();
        }
    });

    $('input.visible_password').on("focusout", function (e) {
        var myclass = $(this).attr('id');
        if ($(this).val() === "") {
            $('i.unhide.link.icon.' + myclass).hide();
        }
    });

    $('i.unhide.link.icon')
            .mouseup(function () {
                var myid = $(this).attr('input_password_id');
                $('#' + myid).hidePassword();
            })
            .mousedown(function () {
                var myid = $(this).attr('input_password_id');
                $('#' + myid).showPassword();
            });

//    $('i.unhide.link.icon').hover(function () {
//        var myid = $(this).attr('input_password_id');
//        $('#' + myid).showPassword();
//    }, function () {
//        var myid = $(this).attr('input_password_id');
//        $('#' + myid).hidePassword();
//    });

    /* Navbar animation */
    $(window).bind('mousewheel', function (event) {
        if (event.originalEvent.wheelDelta >= 0) {
            $('.fixed.top.menu').removeClass('slide up');
        } else {
            $('.fixed.top.menu').addClass('slide up');
            $('.vertical.menu.collapse').removeClass('slide down');
        }

    });

    $('.ui.rating')
            .rating({
                clearable: true,
                onRate: function (value) {
                    $('input[name="' + $(this).attr('id') + '"]').val(value);
                }
            });


    $('.field.disable .ui.rating').rating('disable');
//    $("form").bind("keypress", function (e) {
//        if (e.keyCode == 13) {
//            return false;
//        }
//    });

//$('.ui.dropdown.item.active.visible>.menu.transition.visible').bind("keypress", function (e) {
//        if (e.keyCode === 13) {
//            alert("ici");
//            e.preventDefault();
//            return false;
//        }
//    });

//    $('.ui.dropdown.item.active.visible>.menu.transition.visible').keydown( function (e) {
//        alert("ici");
//        if (e.keyCode === 13) {
//            e.preventDefault();
//            return false;
//        }
//    });

//    $('.ui.dropdown.item.active.visible>.menu.transition.visible').unbind("keydown");
//    $('.ui.dropdown.item.active.visible').unbind("keydown");
//    $('div.ui.dropdown.item').unbind("keydown", function(){
//        alert("ici");
//    });

//    $('.ui.dropdown.item').keydown( function (e) {
//        if (e.keyCode === 13) {
//            alert("ici");
//            e.preventDefault();
//            return false;
//            $(this).dropdown("show");
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

    $("#dropdown_search_mobile.ui.dropdown.item").dropdown({
        on: 'click',
        onHide: function () {
            if ($('#q_mobile').val() !== "") {
                return false;
            }
        }
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

    $('input[name="start-date"]').datetimepicker({
        timepicker: false,
        minDate: '0',
        format: 'd-m-Y',
        lang: 'fr',
        scrollInput: false
    });
    $('input[name="destination-date"]').datetimepicker({
        timepicker: false,
        minDate: '0',
        format: 'd-m-Y',
        lang: 'fr',
        scrollInput: false
    });

    $('#search_transport_offers_form.ui.form').form({
        fields: {
            start_date: {
                identifier: 'start-date',
                rules: [
                    {
                        type: 'empty',
                        prompt: gpdeal_translate("Please enter the departure date")
                    }
                ]
            },
            start_city: {
                identifier: 'start-city',
                rules: [
                    {
                        type: 'empty',
                        prompt: gpdeal_translate("Please enter the departure city")
                    }
                ]
            },

            destination_city: {
                identifier: 'destination-city',
                rules: [
                    {
                        type: 'empty',
                        prompt: gpdeal_translate("Please enter the destination city")
                    }
                ]
            },
            destination_date: {
                identifier: 'destination-date',
                rules: [
                    {
                        type: 'empty',
                        prompt: gpdeal_translate("Please enter the arrival date")
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
            if ($('#search_transport_offers_form.ui.form input[name="start-date"]').val() !== "" && $('#search_transport_offers_form.ui.form input[name="destination-date"]').val() !== "") {
                var start_date = $('#search_transport_offers_form.ui.form input[name="start-date"]').datetimepicker('getValue');
                var destination_date = $('#search_transport_offers_form.ui.form input[name="destination-date"]').datetimepicker('getValue');
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
                    $('#error_name_header').html(gpdeal_translate("Error"));
                    $('#error_name_list').html("<li>" + gpdeal_translate("The departure date can not be less than the current date") + "</li>");
                    valid = false;
                }
                if (today.getTime() > destination_date.getTime()) {
                    $('#search_transport_offers_form.ui.form').removeClass('loading');
                    $('#submit_search_transport_offers').removeClass('disabled');
                    $('#error_name_header').html(gpdeal_translate("Error"));
                    $('#error_name_list').append("<li>" + gpdeal_translate("The arrival date can not be less than the current date") + "</li>");
                    valid = false;
                }
                if (start_date.getTime() > destination_date.getTime()) {
                    $('#search_transport_offers_form.ui.form').removeClass('loading');
                    $('#submit_search_transport_offers').removeClass('disabled');
                    $('#error_name_header').html(gpdeal_translate("Error"));
                    $('#error_name_list').append("<li>" + gpdeal_translate("The arrival date can not be less than the departure date") + "</li>");
                    valid = false;
                }
            } else {
                if ($('#search_transport_offers_form.ui.form input[name="start-date"]').val() !== "") {
                    var start_date = $('#search_transport_offers_form.ui.form input[name="start-date"]').datetimepicker('getValue');
                    start_date.setHours(0);
                    start_date.setMinutes(0);
                    start_date.setSeconds(0);
                    start_date.setMilliseconds(0);
                    if (today.getTime() > start_date.getTime()) {
                        $('#search_transport_offers_form.ui.form').removeClass('loading');
                        $('#submit_search_transport_offers').removeClass('disabled');
                        $('#error_name_header').html(gpdeal_translate("Error"));
                        $('#error_name_list').html("<li>" + gpdeal_translate("The departure date can not be less than the current date") + "</li>");
                        valid = false;
                    }
                } else if ($('#search_transport_offers_form.ui.form input[name="destination-date"]').val() !== "") {
                    var destination_date = $('#search_transport_offers_form.ui.form input[name="destination-date"]').datetimepicker('getValue');
                    destination_date.setHours(0);
                    destination_date.setMinutes(0);
                    destination_date.setSeconds(0);
                    destination_date.setMilliseconds(0);

                    if (today.getTime() > destination_date.getTime()) {
                        $('#search_transport_offers_form.ui.form').removeClass('loading');
                        $('#submit_search_transport_offers').removeClass('disabled');
                        $('#error_name_header').html(gpdeal_translate("Error"));
                        $('#error_name_list').html("<li>" + gpdeal_translate("The arrival date can not be less than the current date") + "</li>");
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
                identifier: 'start-date',
                rules: [
                    {
                        type: 'empty',
                        prompt: gpdeal_translate("Please enter the departure date")
                    }
                ]
            },

            start_city: {
                identifier: 'start-city',
                rules: [
                    {
                        type: 'empty',
                        prompt: gpdeal_translate("Please enter the departure city")
                    }
                ]
            },

            destination_date: {
                identifier: 'destination-date',
                rules: [
                    {
                        type: 'empty',
                        prompt: gpdeal_translate("Please enter the arrival date")
                    }
                ]
            },

            destination_city: {
                identifier: 'destination-city',
                rules: [
                    {
                        type: 'empty',
                        prompt: gpdeal_translate("Please enter the destination city")
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
            if ($('#search_unsatisfied_packages_form.ui.form input[name="start-date"]').val() !== "" && $('#search_transport_offers_form.ui.form input[name="destination-date"]').val() !== "") {
                var start_date = $('#search_unsatisfied_packages_form.ui.form input[name="start-date"]').datetimepicker('getValue');
                var destination_date = $('#search_unsatisfied_packages_form.ui.form input[name="destination-date"]').datetimepicker('getValue');
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
                    $('#error_name_header_package').html(gpdeal_translate("Error"));
                    $('#error_name_list_package').html("<li>" + gpdeal_translate("The departure date can not be less than the current date") + "</li>");
                    valid = false;
                }
                if (today.getTime() > destination_date.getTime()) {
                    $('#search_unsatisfied_packages_form.ui.form').removeClass('loading');
                    $('#submit_search_unsatisfied_packages').removeClass('disabled');
                    $('#error_name_header_package').html(gpdeal_translate("Error"));
                    $('#error_name_list_package').append("<li>" + gpdeal_translate("The arrival date can not be less than the current date") + "</li>");
                    valid = false;
                }
                if (start_date.getTime() > destination_date.getTime()) {
                    $('#search_unsatisfied_packages_form.ui.form').removeClass('loading');
                    $('#submit_search_unsatisfied_packages').removeClass('disabled');
                    $('#error_name_header_package').html(gpdeal_translate("Error"));
                    $('#error_name_list_package').append("<li>" + gpdeal_translate("The arrival date can not be less than the departure date") + "</li>");
                    valid = false;
                }
            } else {
                if ($('#search_unsatisfied_packages_form.ui.form input[name="start-date"]').val() !== "") {
                    var start_date = $('#search_unsatisfied_packages_form.ui.form input[name="start-date"]').datetimepicker('getValue');
                    start_date.setHours(0);
                    start_date.setMinutes(0);
                    start_date.setSeconds(0);
                    start_date.setMilliseconds(0);
                    if (today.getTime() > start_date.getTime()) {
                        $('#search_unsatisfied_packages_form.ui.form').removeClass('loading');
                        $('#submit_search_unsatisfied_packages').removeClass('disabled');
                        $('#error_name_header_package').html(gpdeal_translate("Error"));
                        $('#error_name_list_package').html("<li>" + gpdeal_translate("The departure date can not be less than the current date") + "</li>");
                        valid = false;
                    }
                } else if ($('#search_unsatisfied_packages_form.ui.form input[name="destination-date"]').val() !== "") {
                    var destination_date = $('#search_unsatisfied_packages_form.ui.form input[name="destination-date"]').datetimepicker('getValue');
                    destination_date.setHours(0);
                    destination_date.setMinutes(0);
                    destination_date.setSeconds(0);
                    destination_date.setMilliseconds(0);

                    if (today.getTime() > destination_date.getTime()) {
                        $('#search_unsatisfied_packages_form.ui.form').removeClass('loading');
                        $('#submit_search_unsatisfied_packages').removeClass('disabled');
                        $('#error_name_header_package').html(gpdeal_translate("Error"));
                        $('#error_name_list_package').html("<li>" + gpdeal_translate("The arrival date can not be less than the current date") + "</li>");
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
        if (window.matchMedia("(max-width: 767px)").matches) {
            $('#insure_shimpent_yes').addClass('fluid');
            $('#insure_shimpent_no').addClass('fluid');
        } else {
            $('#insure_shimpent_yes').removeClass('fluid');
            $('#insure_shimpent_no').removeClass('fluid');
        }
    });

    $(window).on('resize', function () {
        if (window.matchMedia("(max-width: 800px)").matches) {
            $('#submit_search_transport_offers').addClass("fluid");
            $('#submit_create_account_particular').addClass("fluid");
            $('#submit_create_account_enterprise').addClass("fluid");
            $('#submit_search_unsatisfied_packages').addClass("fluid");
            $('#confirm_edit_account_particular').addClass('fluid');
            $('#confirm_save_account_particular').addClass('fluid');
            $('#confirm_edit_account_enterprise').addClass('fluid');
            $('#confirm_save_account_enterprise').addClass('fluid');
            $('#submit_contact_form').addClass('fluid');
            $('#submit_forgot_password').addClass('fluid');
            $('#edit_account').addClass('fluid');
            $('#civility_bloc').addClass('inline');
            $('.block_recap_desktop').hide();
            $('.block_recap_mobile').show();
            $('.float_button.ui.button').show();
        } else {
            $('#submit_search_transport_offers').removeClass("fluid");
            $('#submit_create_account_particular').removeClass("fluid");
            $('#submit_create_account_enterprise').removeClass("fluid");
            $('#confirm_edit_account_particular').removeClass('fluid');
            $('#confirm_save_account_particular').removeClass('fluid');
            $('#confirm_edit_account_enterprise').removeClass('fluid');
            $('#confirm_save_account_enterprise').removeClass('fluid');
            $('#submit_contact_form').removeClass('fluid');
            $('#submit_forgot_password').removeClass('fluid');
            $('#submit_search_unsatisfied_packages').removeClass("fluid");
            $('#edit_account').removeClass('fluid');
            $('.block_recap_mobile').hide();
            $('.block_recap_desktop').show();
            $('.float_button.ui.button').hide();
        }
    });


    if (window.matchMedia("(max-width: 800px)").matches) {
        $('.ui.form .ui.button').addClass("fluid");
        var view_password = 0;
        $('i.unhide.link.icon').click(function (e) {
            e.preventDefault();
            if (view_password === 0) {
                var myid = $(this).attr('input_password_id');
                $('#' + myid).showPassword();
                view_password = 1;
            } else if (view_password === 1) {
                var myid = $(this).attr('input_password_id');
                $('#' + myid).hidePassword();
                view_password = 0;
            }
        });

    }

    if (window.matchMedia("(max-width: 767px)").matches) {
        $('#insure_shimpent_yes').addClass('fluid');
        $('#insure_shimpent_no').addClass('fluid');
    }

    $('#search_input_top_form').submit(function () {
        if ($('#search_input_top_form input[name="q"]').val() === "") {
            return false;
        }
        $('#submit_search_input_top').addClass('loading');
    });

    $('#mobile_search_input_top_form').submit(function () {
        if ($('#mobile_search_input_top_form input[name="q"]').val() === "") {
            return false;
        }
        $('#mobile_submit_search_input_top').addClass('loading');
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

    $('#sidebar_mobile_menu_item').click(function (e) {
        e.preventDefault();
        $(this).hide();
        $('#remove_mobile_menu_item').show();
        $('#remove_mobile_menu_item i').transition('jiggle');
        $('#sub_main_menu').transition('slide down');
    });
    $('#remove_mobile_menu_item').click(function (e) {
        e.preventDefault();
        $(this).hide();
        $('#sidebar_mobile_menu_item').show();
        $('#sidebar_mobile_menu_item i').transition('jiggle');
        $('#sub_main_menu').transition('slide down');
    });

    $('#login_form1.ui.form')
            .form({
                fields: {
                    username: {
                        identifier: '_username',
                        rules: [
                            {
                                type: 'empty'
                                //prompt: gpdeal_translate("Please enter your username or email")
                            }
                        ]
                    },
                    password: {
                        identifier: '_password',
                        rules: [
                            {
                                type: 'empty'
                                //prompt: gpdeal_translate("Please enter your password")
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
                    $('#message_error').hide();
                    $('#error_name_message1').hide();
                },
                statusCode: {
                    500: function (xhr) {
                        $('#login_form1.ui.form').removeClass('loading');
                        $('#message_error>.header').html("Internal server error");
                        $('#message_error').show();
                    },
                    400: function (response, textStatus, jqXHR) {
                        $('#login_form1.ui.form').removeClass('loading');
                        $('#submit_login_form1').removeClass('disabled');
                        $('#message_error>.header').html("Echec de la validation");
                    }
                },
                success: function (response, textStatus, jqXHR) {
                    if (response.success === true) {
                        //$('#login_form1.ui.form').submit();
                        window.location.reload();
                    } else if (response.success === false) {
                        $('#login_form1.ui.form').removeClass('loading');
                        $('#submit_login_form1').removeClass('disabled');
                        $('#message_error>.header').html(response.data.message);
                        $('#message_error').show();
                    } else {
//                        $('#login_form1.ui.form').removeClass('loading');
//                        $('#submit_login_form1').removeClass('disabled');
//                        $('#message_error>.header').html("Internal server error");
//                        $('#message_error').show();
                        window.location.reload();
                    }
                },
                error: function (jqXHR, textStatus, errorThrown) {
                    $('#login_form1.ui.form').removeClass('loading');
                    $('#submit_login_form1').removeClass('disabled');
                    $('#message_error').show();
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
                                type: 'empty'
                                        //prompt: 'Veuillez saisir votre login'
                            }
                        ]
                    },
                    last_name: {
                        identifier: '_password',
                        rules: [
                            {
                                type: 'empty'
                                        //prompt: 'Veuillez saisir votre mot de passe'
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
                    $('#message_error').hide();
                },
                statusCode: {
                    500: function (xhr) {
                        $('#login_form.ui.form').removeClass('loading');
                        $('#message_error>.header').html(gpdeal_translate("Internal server error"));
                        $('#message_error').show();
                    },
                    400: function (response, textStatus, jqXHR) {
                        $('#login_form.ui.form').removeClass('loading');
                        $('#submit_login_form').removeClass('disabled');
                        $('#message_error>.header').html(gpdeal_translate("Failed to validate"));
                    }
                },
                success: function (response, textStatus, jqXHR) {
                    if (response.success === true) {
                        //$('#login_form.ui.form').submit();
                        window.location.reload();
                    } else if (response.success === false) {
                        $('#login_form.ui.form').removeClass('loading');
                        $('#submit_login_form').removeClass('disabled');
                        $('#message_error>.header').html(response.data.message);
                        $('#message_error').show();
                    } else {
//                        $('#login_form1.ui.form').removeClass('loading');
//                        $('#submit_login_form').removeClass('disabled');
//                        $('#message_error>.header').html("Internal server error");
//                        $('#message_error').show();
                        window.location.reload();
                    }
                },
                error: function (jqXHR, textStatus, errorThrown) {
                    $('#login_form.ui.form').removeClass('loading');
                    $('#submit_login_form').removeClass('disabled');
                    $('#message_error').show();
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
                                prompt: gpdeal_translate("Please enter your username or email")
                            }
                        ]
                    },
                    password: {
                        identifier: '_password',
                        rules: [
                            {
                                type: 'empty',
                                prompt: gpdeal_translate("Please enter your password")
                            }
                        ]
                    }
                },
                inline: true,
                on: 'change'
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
                        $('#error_name_header2').html(gpdeal_translate("Failed to validate"));
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
                        $('#error_name_header2').html(gpdeal_translate("Internal server error"));
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
                                type: 'empty'
                                        //prompt: 'Veuillez saisir votre login'
                            }
                        ]
                    },
                    last_name: {
                        identifier: '_password',
                        rules: [
                            {
                                type: 'empty'
                                        //prompt: 'Veuillez saisir votre mot de passe'
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
        if (e.keyCode === 13) {
            submit_login_modal();
            return false;
        }
    });

    $("#login_form1.ui.form").bind("keypress", function (e) {
        if (e.keyCode === 13) {
            submit_login_form1();
            return false;
        }
    });

//    $('.disconnected_btn').click(function (e) {
//        e.preventDefault();
//        $.ajax({
//            type: 'POST',
//            url: $(this).attr('href'),
//            data: {'logout': 'true'},
//            dataType: 'json',
//            beforeSend: function () {
//
//            },
//            statusCode: {
//                500: function (xhr) {
//                    $('#message_error>.header').html("Internal server error");
//                },
//                400: function (response, textStatus, jqXHR) {
//
//                    $('#message_error>.header').html("Echec de la deconnexion");
//                }
//            },
//            success: function (response, textStatus, jqXHR) {
//                if (response.success === true) {
//                    window.location.reload();
//                } else {
//                     window.location.reload();
//                }
//            },
//            error: function (jqXHR, textStatus, errorThrown) {
//                $('#message_error').show();
//            }
//        });
//    });
    //*************************************************ReFresh page every 1 minute if not focus*******************************
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
//    setInterval(checkReload, 360000);  // check if not focused, every 6 minute
    //*****************************************************************************************************************************

    //*************************************************SlideShow background homepage*******************************
//    $("#feature_homepage").backgroundCycle({
//        imageUrls: [
//            '/gpdeal/wp-content/themes/gpdealtheme/assets/images/slide-image-1.jpg',
//            '/gpdeal/wp-content/themes/gpdealtheme/assets/images/slide-image-2.jpg',
//            '/gpdeal/wp-content/themes/gpdealtheme/assets/images/slide-image-3.jpg',
//            '/gpdeal/wp-content/themes/gpdealtheme/assets/images/slide-image-4.jpg'
//        ],
//        fadeSpeed: 2000,
//        duration: 5000,
//        backgroundSize: SCALING_MODE_COVER
//    });

//    var images = new Array('/gpdeal/wp-content/themes/gpdealtheme/assets/images/slide-image-1.jpg', '/gpdeal/wp-content/themes/gpdealtheme/assets/images/slide-image-2.jpg', '/gpdeal/wp-content/themes/gpdealtheme/assets/images/slide-image-3.jpg', '/gpdeal/wp-content/themes/gpdealtheme/assets/images/slide-image-4.jpg');
//    var nextimage = 0;
//    doSlideshow();
//
//    function doSlideshow() {
//        if (nextimage >= images.length) {
//            nextimage = 0;
//        }
//        $('#feature_homepage')
//                .css('background-image', 'url("' + images[nextimage++] + '")')
//                .fadeIn('1000', false,  function () {
//                    setTimeout(doSlideshow, 5000);
//                });
//    }
    //*****************************************************************************************************************************

    var imageIds = new Array("bgImage0", "bgImage1", "bgImage2", "bgImage3");
    setInterval(cycleToNextImage, 5000);
    var currentImageIndex = 0;
    function cycleToNextImage() {
        var previousImageId = imageIds[currentImageIndex];

        currentImageIndex++;

        if (currentImageIndex >= imageIds.length) {
            currentImageIndex = 0;
        }

        var options = {
            duration: 2000,
            queue: false
        };

        $('#' + previousImageId).fadeOut(options);
        $('#' + imageIds[currentImageIndex]).fadeIn(options);
    }
    
    $('#show_search_form>a').click(function(e){
        e.preventDefault();
        $('#show_search_form').hide();
        $('#hide_search_form').show();
        $('#search_transport_offers_content').transition('slide down');
        $('#search_unsatisfied_packages_content').transition('slide down');
    });
    
    $('#hide_search_form>a').click(function(e){
        e.preventDefault();
        $('#hide_search_form').hide();
        $('#show_search_form').show();
        $('#search_transport_offers_content').transition('slide down');
        $('#search_unsatisfied_packages_content').transition('slide down');
    });
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
                    $('#error_name_header3').html(gpdeal_translate("Failed to validate"));
                    $('#error_name_message3').show();
                }
            },
            success: function (response, textStatus, jqXHR) {
                if (response.success === true) {
                    //$('#login_form3.ui.form').submit();
                    window.location.reload();
                } else if (response.success === false) {
                    $('#login_form3.ui.form').removeClass('loading');
                    $('#submit_login_form3').removeClass('disabled');
                    $('#error_name_list3').html('<li>' + response.data.message + '</li>');
                    $('#error_name_message3').show();
                } else {
//                    $('#login_form3.ui.form').removeClass('loading');
//                    $('#submit_login_form3').removeClass('disabled');
//                    $('#cancel_login_form3').removeClass('disabled');
//                    $('#error_name_header3').html("Internal server error");
//                    $('#error_name_message3').show();
                    window.location.reload();
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


function submit_login_form1() {
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
                $('#message_error').hide();
                $('#error_name_message1').hide();
            },
            statusCode: {
                500: function (xhr) {
                    $('#login_form1.ui.form').removeClass('loading');
                    $('#message_error>.header').html(gpdeal_translate("Internal server error"));
                    $('#message_error').show();
                },
                400: function (response, textStatus, jqXHR) {
                    $('#login_form1.ui.form').removeClass('loading');
                    $('#submit_login_form1').removeClass('disabled');
                    $('#message_error>.header').html(gpdeal_translate("Failed to validate"));
                }
            },
            success: function (response, textStatus, jqXHR) {
                if (response.success === true) {
                    //$('#login_form1.ui.form').submit();
                    window.location.reload();
                } else if (response.success === false) {
                    $('#login_form1.ui.form').removeClass('loading');
                    $('#submit_login_form1').removeClass('disabled');
                    $('#message_error>.header').html(response.data.message);
                    $('#message_error').show();
                } else {
                    window.location.reload();
//                    $('#login_form1.ui.form').removeClass('loading');
//                    $('#submit_login_form1').removeClass('disabled');
//                    $('#message_error>.header').html("Internal server error");
//                    $('#message_error').show();
                }
            },
            error: function (jqXHR, textStatus, errorThrown) {
                $('#login_form1.ui.form').removeClass('loading');
                $('#submit_login_form1').removeClass('disabled');
                $('#message_error').show();
            }
        });
    }
}