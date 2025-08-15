$(document).ready(function(){
        $("#username").on("keyup",function(){
            var username =$(this).val();

            if(username.length > 0){
                $.ajax({
                    url: "validation/username.php",
                    method: "POST",
                    data: {username: username},
                    success: function(data){
                        $("#username_status").html(data);
                    }
                
                });

            }else{
                $("#username_status").html("");
            }

        });
});