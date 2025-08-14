$(document).ready(function(){
    $("#Username").on("keyup", function(){
        let username = $(this).val().trim();
        if(username.length > 0){
            $.post("includes/usernamecheck.php", {username: username}, function(data){
                if(data === "taken"){
                    $("#Username").css("border", "2px solid red");
                } else {
                    $("#Username").css("border", "2px solid green");
                }
            });
        } else {
            $("#Username").css("border", "");
        }
    });
});
