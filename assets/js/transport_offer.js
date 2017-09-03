$(function () {
    $.datetimepicker.setLocale($('html').attr('lang'));
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

    $('#evaluations_transport_offer_btn').click(function (e) {
        e.preventDefault();
        $('#show_transport_offer_infos').hide();
        $('#edit_transport_offer_infos').hide();
        $('#evaluations').show();
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
                                type: 'checked',
                                prompt: gpdeal_translate("Please specify the type of shipments")
                            }
                        ]
                    },
                    transport_offer_transport_method: {
                        identifier: 'transport_offer_transport_method',
                        rules: [
                            {
                                type: 'checked',
                                prompt: gpdeal_translate("Please specify the mode of transport")
                            }
                        ]
                    },
                    transport_offer_price_type: {
                        identifier: 'transport_offer_price_type',
                        rules: [
                            {
                                type: 'checked',
                                prompt: gpdeal_translate("Please specify a type of transport cost")
                            }
                        ]
                    },
                    transport_offer_price: {
                        identifier: 'transport_offer_price',
                        rules: [
                            {
                                type: 'empty',
                                prompt: gpdeal_translate("Please enter the cost of transport")
                            },
                            {
                                type: 'number',
                                prompt: gpdeal_translate("Please enter a valid number")
                            }
                        ]
                    },
                    transport_offer_currency: {
                        identifier: 'transport_offer_currency',
                        rules: [
                            {
                                type: 'empty',
                                prompt: gpdeal_translate("Please specify the currency")
                            }
                        ]
                    },
                    start_date: {
                        identifier: 'start_date',
                        rules: [
                            {
                                type: 'empty',
                                prompt: gpdeal_translate("Please enter the departure date")
                            }
                        ]
                    },

                    start_city: {
                        identifier: 'start_city',
                        rules: [
                            {
                                type: 'empty',
                                prompt: gpdeal_translate("Please enter the departure city")
                            }
                        ]
                    },
                    start_deadline: {
                        identifier: 'start_deadline',
                        rules: [
                            {
                                type: 'empty',
                                prompt: gpdeal_translate("Please enter the deadline of the offer")
                            }
                        ]
                    },
                    destination_date: {
                        identifier: 'destination_date',
                        rules: [
                            {
                                type: 'empty',
                                prompt: gpdeal_translate("Please enter the arrival date")
                            }
                        ]
                    },
                    destionation_city: {
                        identifier: 'destination_city',
                        rules: [
                            {
                                type: 'empty',
                                prompt: gpdeal_translate("Please enter the destination city")
                            }
                        ]
                    },
                    terms: {
                        identifier: 'terms',
                        rules: [
                            {
                                type: 'checked',
                                prompt: gpdeal_translate("You must agree to these Terms of Use")
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
                    $('#submit_send_transport_offer').addClass('disabled');
                    $('#cancel_edit_transport_offer_infos_btn').addClass('disabled');
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
                        $('#error_name_list').html("<li>"+gpdeal_translate("The departure date can not be less than the current date")+"</li>");
                        valid = false;
                    }
                    if (today.getTime() > start_deadline.getTime()) {
                        $('#error_name_list').append("<li>"+gpdeal_translate("The deadline of the offer can not be less than the current date")+"</li>");
                        valid = false;
                    }

                    if (start_deadline.getTime() > start_date.getTime()) {
                        $('#error_name_list').append("<li>"+gpdeal_translate("The departure date can not be less than the deadline of the offer")+"</li>");
                        valid = false;
                    }

                    if (today.getTime() > destination_date.getTime()) {
                        $('#error_name_list').append("<li>"+gpdeal_translate("The arrival date can not be less than the current date")+"</li>");
                        valid = false;
                    }
                    if (start_date.getTime() > destination_date.getTime()) {
                        $('#error_name_list').append("<li>"+gpdeal_translate("The arrival date can not be less than the departure date")+"</li>");
                        valid = false;
                    }

                    if (!valid) {
                        $('#write_transport_offer_form.ui.form').removeClass('loading');
                        $('#submit_transport_offer').removeClass('disabled');
                        $('#submit_send_transport_offer').removeClass('disabled');
                        $('#cancel_edit_transport_offer_infos_btn').removeClass('disabled');
                        $('#error_name_header').html("Erreur(s)");
                        $('#error_name_message').show();
                        return false;
                    }

                }
            }
            );


    $('#evaluation_form.ui.form').submit(function (e) {
        e.preventDefault();
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
                    $('#error_name_header').html(gpdeal_translate("Failed to validate"));
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
                    $('#error_name_header').html(gpdeal_translate("Failed to validate"));
                    $('#error_name_list').html('<li>' + response.data.message + '</li>');
                    $('#error_name_message').show();
                } else {
                    $('#evaluation_form.ui.form').removeClass('loading');
                    $('#submit_evaluation_form').removeClass('disabled');
                    $('#error_name_header').html(gpdeal_translate("Internal server error"));
                    $('#error_name_message').show();
                }
            },
            error: function (jqXHR, textStatus, errorThrown) {
                $('#evaluation_form.ui.form').removeClass('loading');
                $('#submit_evaluation_form').removeClass('disabled');
                $('#server_error_message').show();
            }
        });

    });
    $('.add_comment_form')
            .form({
                fields: {
                    comment_content: {
                        identifier: 'comment_content',
                        rules: [
                            {
                                type: 'empty',
                                prompt: gpdeal_translate("Please enter your comment")
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
                                prompt: gpdeal_translate("Please enter your reply")
                            }
                        ]
                    }
                },
                inline: true,
                on: 'blur'
            }
            );

    $('a.close_transport_offer').click(function (e) {
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
    
    $('#show_more_details_evaluations_link').click(function (e){
        $(this).hide();
        $('#hide_more_details_evaluations_link').show();
        $('#content_details_evaluations_form').show();
    });
    
    $('#hide_more_details_evaluations_link').click(function (e){
        $(this).hide();
        $('#show_more_details_evaluations_link').show();
        $('#content_details_evaluations_form').hide();
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
                    $('#error_name_header' + id).html(gpdeal_translate("Failed to validate"));
                    $('#error_name_message' + id).show();
                }
            },
            success: function (response, textStatus, jqXHR) {
                if (response.success === true) {
                    window.location.reload();
                } else if (response.success === false) {
                    $('#evaluation_comment_form' + id).removeClass('loading');
                    $('#error_name_header' + id).html(gpdeal_translate("Failed to validate"));
                    $('#error_name_list' + id).html('<li>' + response.data.message + '</li>');
                    $('#error_name_message' + id).show();
                } else {
                    $('#evaluation_comment_form' + id).removeClass('loading');
                    $('#error_name_header' + id).html(gpdeal_translate("Internal server error"));
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
                    $('#error_name_header' + id).html(gpdeal_translate("Failed to validate"));
                    $('#error_name_message' + id).show();
                }
            },
            success: function (response, textStatus, jqXHR) {
                if (response.success === true) {
                    window.location.reload();
                } else if (response.success === false) {
                    $('#comment_reply_form' + id).removeClass('loading');
                    $('#error_name_header' + id).html(gpdeal_translate("Failed to validate"));
                    $('#error_name_list' + id).html('<li>' + response.data.message + '</li>');
                    $('#error_name_message' + id).show();
                } else {
                    $('#comment_reply_form' + id).removeClass('loading');
                    $('#error_name_header' + id).html(gpdeal_translate("Internal server error"));
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

function show_comment_reply_form(id) {
    $('#show_comment_reply_form' + id).hide();
    $('#hide_comment_reply_form' + id).show();
    $('#comment_reply_form' + id).show();
}
function hide_comment_reply_form(id) {
    $('#hide_comment_reply_form' + id).hide();
    $('#show_comment_reply_form' + id).show();
    $('#comment_reply_form' + id).hide();
}

function show_evaluation_comment_form(id) {
    $('#show_evaluation_comment_form' + id).hide();
    $('#hide_evaluation_comment_form' + id).show();
    $('#evaluation_comment_form' + id).show();
}
function hide_evaluation_comment_form(id) {
    $('#hide_evaluation_comment_form' + id).hide();
    $('#show_evaluation_comment_form' + id).show();
    $('#evaluation_comment_form' + id).hide();
}

function show_block_evaluation_form() {
    $('#show_block_evaluation_form').hide();
    $('#block_evaluation_form').show();
}
function show_block_evaluation_form_top() {
    $('#show_block_evaluation_form').hide();
    $('#block_evaluation_form').show();
}
function hide_block_evaluation_form() {
    $('#show_block_evaluation_form').show();
    $('#block_evaluation_form').hide();
}


function show_user_evaluation(id){
    if($('#content_evaluation_'+id).css('display')==="none"){
        $('#content_evaluation_'+id).show();
        
    }else{
        $('#content_evaluation_'+id).hide();
    }
}