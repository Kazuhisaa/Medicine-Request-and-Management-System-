let strongPass = false;
let passMatch = false;

$(document).ready(function () {
    function toggleSignup() {
        if (strongPass && passMatch) {
            $(".signup").prop("disabled", false);
        } else {
            $(".signup").prop("disabled", true);
        }
    }

    $("#password").on("input", function () {
        let password = $(this).val().trim();

        if (password.length > 0) {
            $.ajax({
                url: "validation/password.php",
                method: "POST",
                data: { password: password },
                success: function (data) {
                    $("#password_status").html(data);
                    strongPass = data.includes("Strong password");
                    toggleSignup();
                }
            });
        } else {
            $("#password_status").html("");
            strongPass = false;
            toggleSignup();
        }

        $("#confirm_password").trigger("input");
    });

    $("#confirm_password").on("input", function () {
        let password = $("#password").val().trim();
        let confirmPassword = $(this).val().trim();

        if (confirmPassword.length > 0) {
            if (password === confirmPassword) {
                $("#confirm_status").html("<span style='color:green'>Password match</span>");
                passMatch = true;
            } else {
                $("#confirm_status").html("<span style='color:red'>Passwords do not match</span>");
                passMatch = false;
            }
        } else {
            $("#confirm_status").html("");
            passMatch = false;
        }

        toggleSignup();
    });
});
