$(function () {

    $('#login_form.ui.form')
            .form({
                fields: {
                    _username: {
                        identifier: '_username',
                        rules: [
                            {
                                type: 'empty',
                                prompt: gpdeal_translate('Please enter your username or email')
                            }
                        ]
                    },
                    _password: {
                        identifier: '_password',
                        rules: [
                            {
                                type: 'empty',
                                prompt: 'Please enter your password'
                            }
                        ]
                    }
                },
                inline: true,
                on: 'blur',
                onSuccess: function (event, fields) {
                    $('#submit_login_form').addClass('loading');
                }
            }
    );
});



