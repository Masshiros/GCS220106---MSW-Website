$('form').submit(function (e) {
    //remove eror
    $('label.error').remove();
    var isError = false;

    const email = $('#email').val();

    const regexEmail =
        /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
    if (!email) {
        isError = true;
        $('#email').after('<label style="color:red; margin-top:10px" class="error">Input email please</label>');
        e.preventDefault();
    }
    if (!regexEmail.test(email.trim())) {
        isError = true;
        $('#email').after('<label style="color:red; margin-top:10px" class="error">Invalid Email!! Input email in right format please</label>');
        e.preventDefault();

    }

    const password = $('#password').val();
    if (!password) {
        isError = true;
        $('#password').after('<label style="color:red; margin-top:10px" class="error">Input password please</label>');
        e.preventDefault();
    }

    if (password && password.length < 8) {
        isError = true;
        $('#password').after('<label style="color:red; margin-top:10px" class="error">Input password with more than 8 character please</label>');
        e.preventDefault();
    }
    if (isError) {
        return false;
    }
    else {
        return true;
    }
});
