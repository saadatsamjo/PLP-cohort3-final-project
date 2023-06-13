function validatePassword(){
        const pass = $('#pass1').val();
        const confirm = $('#pass2').val();
        if (pass!=confirm){
            $('#pass2').addClass('is-invalid');
            $('#confirm_status').html("The passwords do not match");
            $('#change').prop('disabled', true);
        }else{
            $('#pass2').removeClass('is-invalid');
            $('#pass2').addClass('is-valid');
            $('#confirm_status').html("");
            $('#password_status').html("");
            $('#change').prop('disabled', false);
        }
    }
function passwordChecker(){
    let number = /([0-9])/;
    let alphas = /([a-zA-Z])/;
    let specialChars = /([~,!,@,#,$,%,^,&,*,-,_,+,=,?,>,<])/;
    let pass = $('#pass1').val().trim();
    if (pass.length < 8){
        $('#pass1').removeClass('is-valid');
        $('#pass1').removeClass('is-invalid');
        $('#pass1').addClass('is-warning');
        $('#password_status').html("Weak (Should be atleast 8 characters.)");
        $('#change').prop('disabled', true);
    }else{
        if (pass.match(number) && pass.match(alphas) && pass.match(specialChars)) {
            $('#pass1').removeClass('is-warning');
            $('#pass1').removeClass('is-invalid');
            $('#pass1').addClass('is-valid');
            $('#password_status').html("Strong");
        }else{
            $('#pass1').removeClass('is-valid');
             $('#pass1').removeClass('is-warning');
            $('#pass1').addClass('is-invalid');
            $('#password_status').html("Medium (Should contain letters, numbers and special characters.)");

        }
    }
}