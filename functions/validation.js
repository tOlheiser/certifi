//creating a function which uses XML to check the availability of a username and display a message if the username is taken.
function check_username_availability() {
    //Grabbing the value of the username value the user entered.
    var uname = document.getElementById("username").value;
    
    //creating a new instance of the XMLHttpRequest object.
    var xmlhttp = new XMLHttpRequest(); 
    //opening the request; using the get method and passing the 'username' variable containing the value of the value entered by the user.
    xmlhttp.open("GET", "functions/ajax_validation.php?username=" + uname);
    //sending the request.
    xmlhttp.send();
    //When the state changes, 
    xmlhttp.onreadystatechange = function() {
        //On readyState 4 (responseText has been fully received) | 200 indicates the server response is correct.
        if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
            //echo the response text from ajax_validation.php into the specified element
            document.getElementById("username_error").innerHTML = xmlhttp.responseText;
        }
    }
}

function check_password_match() {
    //Grabbing the password fields
    var password = document.getElementById("password").value;
    var confPassword = document.getElementById("confirm_password").value;

    //Don't run this function if a value for confirm password isn't entered.
    if (confPassword == "") {
        return false;
    }

    //creating a new instance of the XMLHttpRequest object.
    var xmlhttp = new XMLHttpRequest(); 
    //opening the request; using the get method and passing the 'username' variable containing the value of the value entered by the user.
    xmlhttp.open("GET", "functions/ajax_validation.php?password=" + password + "&confirm_password=" + confPassword);
    //sending the request.
    xmlhttp.send();
    //When the state changes, 
    xmlhttp.onreadystatechange = function() {
        //On readyState 4 (responseText has been fully received) | 200 indicates the server response is correct.
        if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
            //echo the response text from ajax_validation.php into the specified element
            document.getElementById("password_error").innerHTML = xmlhttp.responseText;
        }
    }
}

function check_email_availability() {
    //Grab the email value
    var email = document.getElementById("email").value;

    //creating a new instance of the XMLHttpRequest object.
    var xmlhttp = new XMLHttpRequest(); 
    //opening the request; using the get method and passing the 'username' variable containing the value of the value entered by the user.
    xmlhttp.open("GET", "functions/ajax_validation.php?email=" + email);
    //sending the request.
    xmlhttp.send();
    //When the state changes, 
    xmlhttp.onreadystatechange = function() {
        //On readyState 4 (responseText has been fully received) | 200 indicates the server response is correct.
        if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
            //echo the response text from ajax_validation.php into the specified element
            document.getElementById("email_error").innerHTML = xmlhttp.responseText;
        }
    }
}


function check_insExpiryDate() {
    //grabbing the issue and expiry date values
    var ins_issueDate = document.getElementById("ins_issueDate").value;
    var ins_expiryDate = document.getElementById("ins_expiryDate").value;

    //converting the values into a date object
    var issue = new Date(ins_issueDate);
    var expiry = new Date(ins_expiryDate);

    //If the values are null, don't run the function
    if (ins_issueDate == null || ins_issueDate == "" || ins_expiryDate == null || ins_expiryDate == null) {
        return false;
    }

    //If the issue date comes after the expire (or equal to), write a message
    if (issue >= expiry) {
        document.getElementById("ins_expiryFeedback").innerHTML = "Expiry date must come after issue date.";
    }

}

function check_updExpiryDate() {
    //grabbing the issue and expiry date values
    var upd_issueDate = document.getElementById("upd_issueDate").value;
    var upd_expiryDate = document.getElementById("upd_expiryDate").value;

    //converting the values into a date object
    var issue = new Date(upd_issueDate);
    var expiry = new Date(upd_expiryDate);

    //If the values are null, don't run the function
    if (upd_issueDate == null || upd_issueDate == "" || upd_expiryDate == null || upd_expiryDate == null) {
        return false;
    }

    //If the issue date comes after the expire (or equal to), write a message
    if (issue >= expiry) {
        document.getElementById("upd_expiryFeedback").innerHTML = "Expiry date must come after issue date.";
    }
}

function invalidDate() {
    
    //Grabbing the date values
    var ins_issueDate = document.getElementById("ins_issueDate").value;
    var ins_expiryDate = document.getElementById("ins_expiryDate").value;
    var upd_issueDate = document.getElementById("upd_issueDate").value;
    var upd_expiryDate = document.getElementById("upd_expiryDate").value;
    
    //Pattern to check for YYYY-MM-DD format (which is returned by the HTML date picker)
    var pattern = /[0-9]{4}-(0[1-9]|1[0-2])-(0[1-9]|[1-2][0-9]|3[0-1])/;

    //If a value is entered, check to see if they match the pattern
    if (ins_issueDate.trim().length > 0) {//first checking to see if it holds a value via trim + length
        if (!ins_issueDate.match(pattern)) {
            //Write a message if it doesn't match.
            document.getElementById("ins_invalidIssueDate").innerHTML = "Invalid date, please use the YYYY-MM-DD format.";
        } else {
            //Clear the message after it is fixed.
            document.getElementById("ins_invalidIssueDate").innerHTML = "";
        }
    }

    //Same explanation above. If I had more time I'd like to figure out how to loop through these rather than write 4 similar statements
    if (ins_expiryDate.trim().length > 0) {
        if (!ins_expiryDate.match(pattern)) {
            document.getElementById("ins_invalidExpiryDate").innerHTML = "Invalid date, please use the YYYY-MM-DD format.";
        } else {
            document.getElementById("ins_invalidExpiryDate").innerHTML = "";
        }
    }

    if (upd_issueDate.trim().length > 0) {
        if (!upd_issueDate.match(pattern)) {
            document.getElementById("upd_invalidIssueDate").innerHTML = "Invalid date, please use the YYYY-MM-DD format.";
        } else {
            document.getElementById("upd_invalidIssueDate").innerHTML = "";
        }
    }

    if (upd_expiryDate.trim().length > 0) {
        if (!upd_expiryDate.match(pattern)) {
            document.getElementById("upd_invalidExpiryDate").innerHTML = "Invalid date, please use the YYYY-MM-DD format.";
        } else {
            document.getElementById("upd_invalidExpiryDate").innerHTML = "";
        }
    }

    // If the user enters a value, then chooses to delete that value, this clears the message.

    if (upd_expiryDate.trim().length == 0) {
        document.getElementById("upd_invalidExpiryDate").innerHTML = "";
    } 

    if (upd_issueDate.trim().length == 0) {
        document.getElementById("upd_invalidIssueDate").innerHTML = "";
    }

    if (ins_issueDate.trim().length == 0) {
        document.getElementById("ins_invalidIssueDate").innerHTML = "";
    }

    if (ins_expiryDate.trim().length == 0) {
        document.getElementById("ins_invalidExpiryDate").innerHTML = "";
    }
}

//Adding an event listening to the register form that is triggered on submit
document.querySelector("#registerForm").addEventListener("submit", function(e) {

    //grab the form values
    $username = document.getElementById("username").value;
    $password = document.getElementById("password").value;
    $confPassword = document.getElementById("confirm_password").value;

    //If the length of the username is less than 3, prevent submission
    if ($username.trim().length < 3) {
        e.preventDefault();
    }

    //if the passwords dont match, prevent the form from submitting
    if ($password !== $confPassword) {
        e.preventDefault();
    }

    //If the length of the password is less than 3, prevent submission
    if ($password.trim().length < 3) {
        e.preventDefault();
    }
})



// ----- Prevent the Add / Update Ticket Forms from Submitting if ticket name is empty. 

document.querySelector("#insTicketForm").addEventListener("submit", function(e) {

    //grab the values
    var ticketName = document.getElementById("ins_ticketName").value;
    var issueDate = document.getElementById("ins_issueDate").value;
    var expiryDate = document.getElementById("ins_expiryDate").value;

    //convert date values to date objects
    var issue = new Date(issueDate);
    var expiry = new Date(expiryDate);

    //quality check value. if it remains at 1, the form may submit    
    var check = 1;

    //If the ticket name has no value, write a message and change check to 0
    if (ticketName.trim() == null || ticketName.trim() == "") {
        check = 0;
        document.getElementById("ins_emptyTickName").innerHTML += "Ticket name must not be empty. ";
    }

    //If the issue date has a value, check to see if it's in the proper format
    if (issueDate.trim().length > 0) {
        if ( !issueDate.match(pattern) ) {
            check = 0;
            document.getElementById("ins_emptyTickName").innerHTML += `Invalid date format: issue date. `;
        }
    }

    //If the expiry date has a value, check to see if it's in the proper format
    if (expiryDate.trim().length > 0) {
        if ( !expiryDate.match(pattern) ) {
            check = 0;
            document.getElementById("ins_emptyTickName").innerHTML += `Invalid date format: expiry date. `;
        }
    }

    //If the issue date AND the expiry date has a value, compare the dates.
    if (issueDate.trim().length > 0 && expiryDate.trim().length > 0) {
        
        //Issue can't come at a later date than expiry. 
        if (issue >= expiry) {
            check = 0;
            document.getElementById("ins_emptyTickName").innerHTML += `The expiry date must come after the issue date.`;
        }
    }

    //If check remains at 1, remove the error message | otherwise, prevent the form submission
    if (check == 1) {
        document.getElementById("ins_emptyTickName").innerHTML = "";
    } else {
        e.preventDefault();
    }


})

//Same logic as the add ticket form
document.querySelector("#updTicketForm").addEventListener("submit", function(e) {

    var ticketName = document.getElementById("upd_ticketName").value;
    var issueDate = document.getElementById("upd_issueDate").value;
    var expiryDate = document.getElementById("upd_expiryDate").value;

    var issue = new Date(issueDate);
    var expiry = new Date(expiryDate);

    var pattern = /[0-9]{4}-(0[1-9]|1[0-2])-(0[1-9]|[1-2][0-9]|3[0-1])/;
    var check = 1;

    //If the issue date has a value, check to see if it's in the proper format
    if (issueDate.trim().length > 0) {
        if ( !issueDate.match(pattern) ) {
            check = 0;
            document.getElementById("upd_emptyTickName").innerHTML = `Invalid date format: issue date`;
            e.preventDefault();
        }
    }

    //If the expiry date has a value, check to see if it's in the proper format
    if (expiryDate.trim().length > 0) {
        if ( !expiryDate.match(pattern) ) {
            check = 0;
            document.getElementById("upd_emptyTickName").innerHTML = `Invalid date format: expiry date`;
            e.preventDefault();
        }
    }
    
    //If the issue date AND the expiry date has a value, compare the dates.
    if (issueDate.trim().length > 0 && expiryDate.trim().length > 0) {
        
        //Issue can't come at a later date than expiry. 
        if (issue >= expiry) {
            check = 0;
            document.getElementById("upd_emptyTickName").innerHTML = `The expiry date must come after the issue date.`;
            e.preventDefault();
        }
    }

    //Ticket name cannot be empty.
    if (ticketName.trim() == null || ticketName.trim() == "") {
        check = 0;
        document.getElementById("upd_emptyTickName").innerHTML = "Ticket name must not be empty.";
        e.preventDefault();
    }

    if (check == 1) {
        document.getElementById("upd_emptyTickName").innerHTML = "";
    }

})

// ------ Remove the feedback when a ticket name is entered

function ins_removeFeedback() {
    var ticketName = document.getElementById("ins_ticketName").value;

    if (ticketName.trim() != null && ticketName.trim() != "") {
        document.getElementById("ins_emptyTickName").innerHTML = "";
    }
}

function upd_removeFeedback() {
    var ticketName = document.getElementById("upd_ticketName").value;

    if (ticketName.trim() != null && ticketName.trim() != "") {
        document.getElementById("upd_emptyTickName").innerHTML = "";
    }
}

// In the live version, it seems that every image triggers an error message
function validateProfileImg() {
    //grabbing the file data
    var fileData = document.getElementById("upd_profilePic");
    //storing the upload path in a variable
    var fileUploadPath = fileData.value;

    if (fileUploadPath == '') {
        document.getElementById("upd_proFileMsg").innerHTML = "Please upload an image.";
    } else {
        var extension = fileUploadPath.substring(fileUploadPath.lastIndexOf('.') + 1).toLowerCase();

        //if the extension doesn't match any one of these 3, write an error message.
        if (extension != "png" || extension != "jpeg" || extension != "jpg") {
            document.getElementById("upd_proFileMsg").innerHTML = "PNG, JPG, and JPEG are the only formats acceptable.";
        } 
    }

}