$(document).ready(function() {
    $("#password").on("input", function() {
        let password = $(this).val().trim();

        if(password.length > 0){
            $.ajax({
                url: "validation/password.php",
                method: "POST",
                data: { password: password },
                success: function(data){
                    $("#password_status").html(data);
                }
            });
        } else {
            $("#password_status").html("");
        }
    });

    $("#confirm_`password").on("input", function() {
        let password = $("#password").val().trim();
        let confirmPassword = $(this).val().trim();

        if(confirmPassword.length > 0){
            $.ajax({
                url: "validation/confirm_password.php",
                method: "POST",
                data: { password: password, confirm_password: confirmPassword },
                success: function(data){
                    $("#confirm_status").html(data);
                }
            });
        } else {
            $("#confirm_status").html("");
        }
    });
});
