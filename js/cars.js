function checkcar() {
    var make = document.getElementById("make").value;
    var model = document.getElementById("model").value;
   
    
    var dataString = 'make=' + make + '&model=' + model;
    // create the datastring we're going to need in our AJAX request, there could be multiple values passed here, but in this case just one
    $.ajax({
        // create the AJAX request using JQuery method
        type: "POST", // method is post
        url: "checkcar.php", // the PHP script we want to communicate with
        data: dataString, // the data we're passing
        success: function (data) {
            if (data.availability === true) { // checkuser.php will send us back a JSON response containing a value named availability
              
                $("#msg_carmake").html("Car already exists"); // send a message to the user
                $("#make").css("background-color", "#f99"); // change the CSS to give user feedback

                $("#msg_carmodel").html("Car already exists"); // send a message to the user
                $("#model").css("background-color", "#f99"); // change the CSS to give user feedback
                
                $("#submit-car").prop('disabled', true); // enable the submit button
                

            } else if(data.availability === false)
            {
                 $("#submit-car").prop('disabled', false); // enable the submit button
                 $("#msg_carmodel").html("Car already exists");
            }
            
        },
        dataType: "json" // returned data type is going to be JSON
    });
}
