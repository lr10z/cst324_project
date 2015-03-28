/**
 * validation.js
 *
 * Provides validations for HTML forms
 *
 * @author Dylan Gleason, dgleason8384 -at- gmail -dot- com
 */

$(document).ready(function() {

    // validation for signup page
    $('#signup').validate({
        errorClass: 'error',
        rules: {
            firstname: 'required',
            lastname: 'required',
            email: {
                required: true,
                email: true
            },
            password: {
                required: true,
                minlength: 6
            }
        },
        messages: {
            firstname: 'Please enter your first name',
            lastname: 'Please enter your last name',
            password: {
                required: 'Please provide a password',
                minlength: 'Password must be a minimum of 6 characters long'
            },
            email: 'Please enter a valid email address'
        },
        errorPlacement: function(error, element) {
            error.insertBefore(element);
        },
        submitHandler: function(form) {
            form.submit();
        }
    });

    // validation for login page
    $('#login').validate({
        errorClass: 'error',
        rules: {
            email: {
                required: true,
                email: true
            },
            password: {
                required: true,
                minlength: 6
            }
        },
        messages: {
            password: {
                required: 'Please enter your password'
            },
            email: 'Please enter your email address'
        },
        errorPlacement: function(error, element) {
            error.insertBefore(element);
        },
        submitHandler: function(form) {
            form.submit();
        }
    });
});
