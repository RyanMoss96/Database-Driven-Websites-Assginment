function checkUser() {
    var username = document.getElementById("username").value;
    // retrieves the username from the HTML form
    var dataString = 'username=' + username;
    // create the datastring we're going to need in our AJAX request, there could be multiple values passed here, but in this case just one
    $.ajax({
        // create the AJAX request using JQuery method
        type: "POST", // method is post
        url: "checkuser.php", // the PHP script we want to communicate with
        data: dataString, // the data we're passing
        success: function (data) {
            if (data.availability === false) { // checkuser.php will send us back a JSON response containing a value named availability
                $("#msg_username").html("Username unavailable. Please choose another."); // send a message to the user
                $("#username").css("background-color", "#f99"); // change the CSS to give user feedback
                $("#submit").prop('disabled', true); // disable the submit button
            }
            else if (data.availability === true) {
                $("#msg_username").html("Username available."); // send a message to the user
                $("#username").css("background-color", "#9f9"); // change the CSS to give user feedback
                $("#submit").prop('disabled', false); // enable the submit button
            }
        },
        dataType: "json" // returned data type is going to be JSON
    });
}

function checkPass() {
    var password = document.getElementById("confirmPassword").value;
    var id = document.getElementById("uid").value;
    // retrieves the username from the HTML form
    var dataString = 'confirmPassword=' + password + '&id=' + id;
    // create the datastring we're going to need in our AJAX request, there could be multiple values passed here, but in this case just one
    $.ajax({
        // create the AJAX request using JQuery method
        type: "POST", // method is post
        url: "checkpass.php", // the PHP script we want to communicate with
        data: dataString, // the data we're passing
        success: function (data) {
            if (data.availability === false) { // checkuser.php will send us back a JSON response containing a value named availability
                $("#msg_password").html("Incorrect Password"); // send a message to the user
                $("#confirmPassword").css("background-color", "#f99"); // change the CSS to give user feedback
                $("#submit-form").prop('disabled', true); // disable the submit button
            }
            else if (data.availability === true) {
                $("#msg_password").html("Correct Password"); // send a message to the user
                $("#confirmPassword").css("background-color", "#9f9"); // change the CSS to give user feedback
                $("#submit-form").prop('disabled', false); // enable the submit button
            }
        },
        dataType: "json" // returned data type is going to be JSON
    });
}

function checkempty() {
    var fname = document.getElementById("firstname").value;
    var sname = document.getElementById("lastname").value;
    var uname = document.getElementById("username").value;
    var pword = document.getElementById("password").value;
    var email = document.getElementById("email").value;
    var retype_password = document.getElementById("retype_password").value;

    if (fname === '' || sname === '' || uname === '' || pword === '' || email === '' || retype_password == '') {
        alert("Please Fill All Fields");
        return false;
    }
    else {
        return true;
    }
}

function checkPasswords() {
    var password = document.getElementById("password").value;
    var retype_password = document.getElementById("retype_password").value;

    if (password != retype_password) {
        $("#msg_password").html("Passwords do not match");
        $("#retype_password").css("background-color", "#f99");
        $("#submit").prop('disabled', true);
    } else {
        $("#msg_password").html("Passwords match.");
        $("#retype_password").css("background-color", "#9f9");
        $("#submit").prop('disabled', false);
    }
}

function checkEmptyLogin() {

    var username = document.getElementById("username").value;
    var password = document.getElementById("password").value;



    if (username === '' || password === '') {
        alert("Please Fill All Fields");
        return false;
    }
    else {
        return true;
    }
}