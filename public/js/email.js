$("#email").on("keyup", function() {
    var email = $(this).val();

    
    var emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    if (!emailRegex.test(email)) {
        $("#email_status").html("<span class='status-message taken'>❌ Invalid email format</span>");
        emailAvailable = false;
        $(".signup").prop("disabled", true);
        return; 
    }

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
