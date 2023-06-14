$(document).ready(function() {
    // Add an event listener to the password field
    $('#add_admin_pass').keyup(function() {
        var password = $(this).val();
        var hasUppercase = /[A-Z]/.test(password); // Check for uppercase letter
        var hasNumber = /\d/.test(password); // Check for number

        // Check password length and display appropriate error message
        if (password.length < 8 ){
            $('#pass_admin_error').text('The password must be at least 8 characters.').show();
            $('#add_admin_account_submit').hide();
        } else if (!hasUppercase) {
            $('#pass_admin_error').text('Your password must contain an uppercase letter.').show();
            $('#add_admin_account_submit').hide();
        } else if (!hasNumber) {
            $('#pass_admin_error').text('Your password must contain a number.').show();
            $('#add_admin_account_submit').hide();
        } else {
        // Clear error message and show submit button
            $('#pass_admin_error').hide();
            $('#add_admin_account_submit').show();
        }
    });

    $('#edit_admin_pass').keyup(function() {
        var password = $(this).val();
        var hasUppercase = /[A-Z]/.test(password); // Check for uppercase letter
        var hasNumber = /\d/.test(password); // Check for number

        // Check password length and display appropriate error message
        if (password.length < 8 ){
            $('#edit_pass_admin_error').text('The password must be at least 8 characters.').show();
            $('#edit_admin_account_submit').hide();
        } else if (!hasUppercase) {
            $('#edit_pass_admin_error').text('Your password must contain an uppercase letter.').show();
            $('#edit_admin_account_submit').hide();
        } else if (!hasNumber) {
            $('#edit_pass_admin_error').text('Your password must contain a number.').show();
            $('#edit_admin_account_submit').hide();
        } else {
        // Clear error message and show submit button
            $('#edit_pass_admin_error').hide();
            $('#edit_admin_account_submit').show();
        }
    });
});