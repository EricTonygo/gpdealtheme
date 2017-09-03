$(function () {

    $('#package_picture_link').click(function () {
        $('#package_picture_file').click();
    });

    $('#package_picture_edit').click(function () {
        $('#package_picture_file').click();
    });

    $('#package_picture_remove').click(function () {
        $('#package_picture_dimmer').hide();
        $('#package_picture_link').show();
        $('#package_picture_file').val('');
    });

    $('#package_picture_dimmer.image')
            .dimmer({
                on: 'hover'
            })
            ;

    function previewPackagePicture() {
        var preview = document.getElementById('package_picture_img');
        var file = document.getElementById('package_picture_file').files[0];
        var reader = new FileReader();
        if (file) {
            reader.addEventListener("loadstart", function () {
                $('#package_picture_edit').hide();
                $('#package_picture_remove').hide();
                $('#package_picture_loader').show();
                $('#package_picture_dimmer.image .dimmer').dimmer('show');
                $('#package_picture_link').addClass("loading");
            }, false);

            reader.addEventListener("load", function () {

                preview.src = reader.result;
            }, false);

            reader.addEventListener("loadend", function () {

                $('#package_picture_loader').hide();
                $('#package_picture_link').hide();
                $('#package_picture_dimmer.image .dimmer').dimmer('hide');
                $('#package_picture_link').removeClass("loading");
                $('#package_picture_dimmer').show();
                $('#package_picture_edit').show();
                $('#package_picture_remove').show();

            }, false);

            reader.readAsDataURL(file);
        }
    }

    $("#package_picture_file").change(function () {
        //alert('This file size is: '+this.files[0].type+' ' + this.files[0].size/1024/1024 + "MB");
        previewPackagePicture();
    });

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

    $('#edit_package_infos_btn').click(function (e) {
        e.preventDefault();
        $('#show_package_infos').hide();
        $('#edit_package_infos').show();
    });
    $('#cancel_edit_package_infos_btn').click(function (e) {
        e.preventDefault();
        $('#edit_package_infos').hide();
        $('#show_package_infos').show();
    });

    $('#package_insured').change(function () {
        if ($(this).is(':checked')) {
            $('#property_value_fields').show();
            if($('#insurance_cost').val() !== ""){
                $('#insurance_cost_fields').show();
            }
        } else {
            $('#property_value_fields').hide();            
            $('#insurance_cost_fields').hide();
        }
    });

    $('#calculate_insurance_cost').click(function (e) {
        e.preventDefault();
        if ($('#property_value').val() !== "") {
            $('#insurance_cost').val('');
            $(this).addClass("loading");
            setTimeout(function () {
                $('#insurance_cost').val(parseInt($('#property_value').val())/10);
                $('#calculate_insurance_cost').removeClass("loading");
                $('#insurance_cost_fields').show();
            }, 1000);
        }
    });

    $('#package_currency').change(function(){
        var currency = $('select#package_currency option:selected').val();
        if(currency !== ""){
            $('#property_value_currency').text(currency);
            $('#insurance_cost_currency').text(currency);
        }
    });
    
    $('#send_package_form.ui.form')
            .form({
                fields: {
                    type: {
                        identifier: 'package_type',
                        rules: [
                            {
                                type: 'checked',
                                prompt: gpdeal_translate("Please specify the item type of your shipment")
                            }
                        ]
                    },
                    content: {
                        identifier: 'package_content',
                        rules: [
                            {
                                type: 'empty',
                                prompt: gpdeal_translate("Please specify the contents of your shipment")
                            }
                        ]
                    },
                    width: {
                        identifier: 'package_dimensions_width',
                        rules: [
                            {
                                type: 'empty',
                                prompt: gpdeal_translate("Please specify width")
                            },
                            {
                                type: 'number',
                                prompt: gpdeal_translate("Please enter a valid number")
                            }
                        ]
                    },
                    length: {
                        identifier: 'package_dimensions_length',
                        rules: [
                            {
                                type: 'empty',
                                prompt: gpdeal_translate("Please specify length")
                            },
                            {
                                type: 'number',
                                prompt: gpdeal_translate("Please enter a valid number")
                            }
                        ]
                    },
                    height: {
                        identifier: 'package_dimensions_height',
                        rules: [
                            {
                                type: 'empty',
                                prompt: gpdeal_translate("Please specify height")
                            },
                            {
                                type: 'number',
                                prompt: gpdeal_translate("Please enter a valid number")
                            }
                        ]
                    },
                    weight: {
                        identifier: 'package_weight',
                        rules: [
                            {
                                type: 'empty',
                                prompt: gpdeal_translate("Please specify weight")
                            },
                            {
                                type: 'number',
                                prompt: gpdeal_translate("Please enter a valid number")
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
                    $('#send_package_form.ui.form').addClass('loading');
                    $('#submit_send_package').addClass('disabled');
                    var today = new Date();
                    var valid = true;
                    today.setHours(0);
                    today.setMinutes(0);
                    today.setSeconds(0);
                    today.setMilliseconds(0);

                    var start_date = $('#send_package_form.ui.form input[name="start_date"]').datetimepicker('getValue');
                    var destination_date = $('#send_package_form.ui.form input[name="destination_date"]').datetimepicker('getValue');
                    start_date.setHours(0);
                    start_date.setMinutes(0);
                    start_date.setSeconds(0);
                    start_date.setMilliseconds(0);
                    destination_date.setHours(0);
                    destination_date.setMinutes(0);
                    destination_date.setSeconds(0);
                    destination_date.setMilliseconds(0);
                    if (today.getTime() > start_date.getTime()) {
                        $('#send_package_form.ui.form').removeClass('loading');
                        $('#submit_send_package').removeClass('disabled');
                        $('#error_name_header').html(gpdeal_translate("Error"));
                        $('#error_name_list').html("<li>" + gpdeal_translate("The departure date can not be less than the current date") + "</li>");
                        valid = false;
                    }

                    if (today.getTime() > destination_date.getTime()) {
                        $('#send_package_form.ui.form').removeClass('loading');
                        $('#submit_send_package').removeClass('disabled');
                        $('#error_name_header').html(gpdeal_translate("Error"));
                        $('#error_name_list').append("<li>" + gpdeal_translate("The arrival date can not be less than the current date") + "</li>");
                        valid = false;
                    }
                    if (start_date.getTime() > destination_date.getTime()) {
                        $('#send_package_form.ui.form').removeClass('loading');
                        $('#submit_send_package').removeClass('disabled');
                        $('#error_name_header').html(gpdeal_translate("Error"));
                        $('#error_name_list').append("<li>" + gpdeal_translate("The arrival date can not be less than the departure date") + "</li>");
                        valid = false;
                    }

                    if (!valid) {
                        $('#error_name_message').show();
                        return false;
                    } else {
                        $('#confirm_transaction_modal.ui.small.modal')
                                .modal('show');
                    }
                }
            }
            );
});

function cancel_send_package(id) {
    $('#confirm_cancel_send_package.ui.small.modal')
            .modal('show')
            ;

    $('#execute_cancel_send_package').click(function (e) {
        e.preventDefault();
        $('#confirm_cancel_send_package.ui.small.modal')
                .modal('hide')
                ;
        $.ajax({
            type: $('#single_package_content_form' + id).attr('method'),
            url: $('#single_package_content_form' + id).attr('action'),
            data: {"action": "cancel", "package_id": id},
            dataType: 'json',
            beforeSend: function () {
                $('#single_package_content_form' + id).addClass("ui form loading");
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
                    //$('#single_package_column'+id).remove();
                    window.location.reload();
                    $('#message_success>div.header').html(response.data.message);
                    $('#message_success').show();
                    setTimeout(function () {
                        $('#message_success').hide();
                    }, 4000);
                } else if (response.success === false) {
                    $('#message_error>div.header').html(response.data.message);
                    $('#message_error').show();
                } else {
                    $('#message_error>div.header').html(gpdeal_translate("Internal server error"));
                    $('#message_error').show();
                }
                $('#single_package_content_form' + id).removeClass("ui form loading");
            },
            error: function (jqXHR, textStatus, errorThrown) {
                $('#single_package_content_form' + id).removeClass("ui form loading");

            }
        });
    });
}


function fence_send_package(id) {
    $('#confirm_fence_send_package.ui.small.modal')
            .modal('show')
            ;

    $('#execute_fence_send_package').click(function (e) {
        e.preventDefault();
        $('#confirm_fence_send_package.ui.small.modal')
                .modal('hide')
                ;
        $.ajax({
            type: $('#single_package_content_form' + id).attr('method'),
            url: $('#single_package_content_form' + id).attr('action'),
            data: {"action": "fence", "package_id": id},
            dataType: 'json',
            beforeSend: function () {
                $('#single_package_content_form' + id).addClass("ui form loading");
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
                    //$('#single_package_column'+id).remove();
                    window.location.reload();
                    $('#message_success>div.header').html(response.data.message);
                    $('#message_success').show();
                    setTimeout(function () {
                        $('#message_success').hide();
                    }, 4000);
                } else if (response.success === false) {
                    $('#message_error>div.header').html(response.data.message);
                    $('#message_error').show();
                } else {
                    $('#message_error>div.header').html(gpdeal_translate("Internal server error"));
                    $('#message_error').show();
                }
                $('#single_package_content_form' + id).removeClass("ui form loading");
            },
            error: function (jqXHR, textStatus, errorThrown) {
                $('#single_package_content_form' + id).removeClass("ui form loading");

            }
        });
    });
}


function fence_send_package_on_single_page(id) {
    $('#confirm_fence_send_package.ui.small.modal')
            .modal('show')
            ;

    $('#execute_fence_send_package').click(function (e) {
        e.preventDefault();
        $('#confirm_fence_send_package.ui.small.modal')
                .modal('hide')
                ;
        $.ajax({
            type: 'POST',
            url: $('#fence_package_url').val(),
            data: {"action": "fence", "package_id": id},
            dataType: 'json',
            beforeSend: function () {
                $('#fence_package_btn').addClass("loading");
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
                    window.location.reload();
                    $('#message_success>div.header').html(response.data.message);
                    $('#message_success').show();
                    setTimeout(function () {
                        $('#message_success').hide();
                    }, 4000);
                } else if (response.success === false) {
                    $('#message_error>div.header').html(response.data.message);
                    $('#message_error').show();
                } else {
                    $('#message_error>div.header').html(gpdeal_translate("Internal server error"));
                    $('#message_error').show();
                }
                $('#fence_package_btn').removeClass("loading");
            },
            error: function (jqXHR, textStatus, errorThrown) {
                $('#fence_package_btn').removeClass("loading");

            }
        });
    });
}
