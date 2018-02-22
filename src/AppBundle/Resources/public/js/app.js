function sendContactForm() {
    $.ajax({
        url: '/api/contact/send',
        type: "post",
        data: {
            email: $("#contact_email_input").val(),
            title: $("#contact_title_input").val(),
            content: $("#contact_content_input").val()
        },
        success: function (data) {
            $(".contact_form_errors").addClass("hidden");
            //todo: use BanzingaJSBundle to translate message
            $("#contact_form_success_message").removeClass("hidden").html("Dziękujemy za wysłanie formularza");

        },
        error: function(response) {
            $("#contact_form_error_message").removeClass("hidden");
            var errors = JSON.parse(response.responseText).errors.children;
            for (var key in errors){
                if(errors[key].errors){
                    $("#contact_form_error_" + key).removeClass("hidden").html(errors[key].errors);
                }
            };
        }
    })
}

function validateContactForm() {
    var emailValidation = validateEmail();
    var contentValidation = validateContent();
    if (!emailValidation|| !contentValidation) {
        $("#contact_form_success_message").addClass("hidden");
        return false;
    }
    return true;

}

function validateEmail () {
    var email = $("#contact_email_input").val();
    if(email.length == 0) {
        $("#contact_form_error_email").removeClass("hidden").html("Podaj adres email");
        return false;
    }
    if(!email.match(/^[A-Za-z\._\-[0-9]*[@][A-Za-z]*[\.][a-z]{2,4}$/)) {
        $("#contact_form_error_email").removeClass("hidden").html("Niepoprawny adres email");
        return false;
    }
    $("#contact_form_error_email").addClass("hidden");
    return true;
}

function validateContent() {
    var content = $("#contact_content_input").val();
    var required = 30;
    var left = required - content.length;
    if (left > 0) {
        $("#contact_form_error_content").removeClass("hidden").html("Wiadomość powinna być dłuższa niż 30 znaków");
        return false;
    }
    $("#contact_form_error_content").addClass("hidden");
    return true;
}

$(document).ready(function() {
    $("#contact_form_submit").click(function(e) {
        e.preventDefault();
        if(validateContactForm()){
            sendContactForm()
        }
    });
});