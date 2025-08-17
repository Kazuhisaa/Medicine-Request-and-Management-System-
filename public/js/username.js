let usernameAvailable = false;

$("#username").on("keyup", function() {
    var username = $(this).val();

    if (username.length > 0) {
        $.ajax({
            url: "validation/username.php",
            method: "POST",
            data: { username: username },
            success: function(data) {
                $("#username_status").html(data);

                if (data.includes("available")) {
                    usernameAvailable = true;
                    $(".signup").prop("disabled", false);
                } else {
                    usernameAvailable = false;
                    $(".signup").prop("disabled", true);
                }
            }
        });
    } else {        
        $("#username_status").html("");
        usernameAvailable = false;
        $(".signup").prop("disabled", true);
    }
});

$("#signupForm").on("submit", function(e) {
    if (!usernameAvailable) {
        e.preventDefault();
        $("#username").focus();
    }
});
