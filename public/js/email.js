let emailAvailable = false;

$("#email").on("keyup", function() {
    var email = $(this).val();

    if (email.length > 0) {
        $.ajax({
            url: "validation/email.php",
            method: "POST",
            data: { email: email },
            success: function(data) {
                $("#email_status").html(data);

                if (data.includes("available")) {
                    emailAvailable = true;
                    $(".signup").prop("disabled", false);
                } else {
                    emailAvailable = false;
                    $(".signup").prop("disabled", true);
                }
            }
        });
    } else {
        $("#email_status").html("");
        emailAvailable = false;
        $(".signup").prop("disabled", true);
    }
});

$("#signupForm").on("submit", function(e) {
    if (!emailAvailable) {
        e.preventDefault();
        $("#email").focus();
    }
});
