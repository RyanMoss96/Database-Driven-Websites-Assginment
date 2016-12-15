function updateUser() {
    var uid = document.getElementById("uid").value;
    var username = document.getElementById("username").value;
    var firstname = document.getElementById("firstname").value;
    var lastname = document.getElementById("lastname").value;
    var email = document.getElementById("email").value;
    var confirmPassword = document.getElementById("confirmPassword").value;
    // retrieves the username from the HTML form
    var dataString = 'username=' + username + '&firstname=' + firstname + '&lastname=' + lastname + '&email=' + email + '&confirmPassword=' + confirmPassword + '&uid=' + uid;
    // create the datastring we're going to need in our AJAX request, there could be multiple values passed here, but in this case just one
    $.ajax({
        // create the AJAX request using JQuery method
        type: "POST", // method is post
        url: "update_user.php", // the PHP script we want to communicate with
        data: dataString, // the data we're passing
        success: function (data) {
            if (data.success === true) { // checkuser.php will send us back a JSON response containing a value named availability
              
                $('#myModal').modal('show');
                document.getElementById("uid").value = data.uid;
                document.getElementById("username").value = data.username;
                document.getElementById("firstname").value = data.firstname;
                document.getElementById("lastname").value = data.lastname;
                document.getElementById("email").value = data.email;
                 $("#msg_password").html(data.email); // send a message to the user

            } else if(data.success === false)
            {
                $("#msg_password").html("Incorrect Password!"); // send a message to the user
                $("#confirmPassword").css("background-color", "#f99"); // change the CSS to give user feedback
            }
            
        },
        dataType: "json" // returned data type is going to be JSON
    });
}
