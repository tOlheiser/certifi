<?php 

/************  HELPER FUNCTIONS *************/

//Cleans garbage from user input (like $@&($(@)!))(:><)
function clean($string) {
    $string = trim($string);
    $string = htmlentities($string);
    return $string;
}

//redirecting the user somewhere else. 
function redirect($location){
return header("Location: {$location}");
}

//Set the message in the session
//Eventually i'd like to display a cool tooltip on page refresh displaying this message.
function set_message($message) {
    if(!empty($message)) {
        $_SESSION['message'] = $message;
    } else {
        $message = "";
    }
}

//Display the message then unset the session variable. 
function display_message() {
    if(isset($_SESSION['message'])) {
        echo $_SESSION['message'];
        unset($_SESSION['message']);
    }
}

//Checks if a variable is null, echoes it if it's not.
function isNull($value) {
    if ($value !== NULL) {
        echo $value;
    }
}

//Creates a unique id with a random number as a prefix - more secure than a static prefix. 
// ----- Was to be used for email verification.
function token_generator(){
    $token = $_SESSION['token'] =  md5(uniqid(mt_rand(), true));
    return $token;
}

function uploadImg($imgDir, $imgNameAttr, $tablePK){

    //Set Variables
	$target_dir = $imgDir;
	$target_file = $target_dir . basename($_FILES["$imgNameAttr"]["name"]);
	//$target_file = $target_dir . "tanner";
	$uploadOk = 1;
	$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
	// Check if image file is a actual image or fake image

	//validating the image before uploading.
	$validate = validateImg($imgNameAttr, $imageFileType);

	$extension = explode("/", $_FILES["$imgNameAttr"]["type"]); 

    //If validate returns false, redirect to the profile.
	if ($validate == 0) {
		redirect("profile.php"); 
	// if everything is ok, try to upload file
	} else {
		//if (move_uploaded_file($_FILES["upd_ticketPic"]["tmp_name"], $target_file)) {
		if (move_uploaded_file($_FILES["$imgNameAttr"]["tmp_name"], $target_dir . $tablePK . "." . $extension[1])) {
            echo "The file ". basename( $_FILES["$imgNameAttr"]["name"]). " has been uploaded.";
            redirect("profile.php"); 
            return $extension;
		} else {
			redirect("profile.php"); 
		}
	}

}

/***** REGISTER | LOGIN *****/

// checks log-in status
function checkLogin() {
    //if not logged in, redirect to the front page.
    if (!logged_in()) {
        header("Location: index.php");
    //otherwise, grab the values attached to the userID variable.
    } else {
        //Grab Session Values and Store into Variables.
        $username = $_SESSION['username'];
        $userID = $_SESSION['userID'];
        
        //Query to select user data
        $sql = "SELECT firstName, lastName, address, city, province, postalCode, phone, jobTitle, bio, users_userID FROM profile WHERE users_userID = '$userID'";
        
        //Storing the result of the query inside a variable.
        $result = query($sql);
        confirm($result);
        
        //Creating an array of the result object and passing its contents to $row
        $row = fetch_array($result);
        
        //Storing values inside variables. 
        $firstName = $row['firstName'];
        $lastName = $row['lastName'];
        $address = $row['address'];
        $city = $row['city'];
        $province = $row['province'];
        $postalCode = $row['postalCode'];
        $phone = $row['phone'];
        $jobTitle = $row['jobTitle'];
        $bio = $row['bio'];
        $profileID = $row['users_userID'];
    }
}

//checks to see if the user is logged in.
function logged_in() {
    if(isset($_SESSION['userID'])) {
        return true;
    } else {
        return false;
    }
}

//registers the user
function register_user($username, $password, $confirm_password, $email) {
    
    //grabs the variables passes in
    $username = escape($username);
    $password = escape($password);
    $confirm_password = escape($confirm_password);
    $email = escape($email);
    
    //quality check of the registration form, should checkRecords hit '0', don't register the user.
    $checkRecords = 1;

    //checking to see if the email and username exist
    if(email_exists($email)) {
        $checkRecords = 0;
    } elseif (username_exists($username)) {
        $checkRecords = 0;
    //checking for empty inputs
    } elseif( empty($username) || empty($password) || empty($email) || empty($confirm_password) ) {
        $checkRecords = 0;
        //checking for a valid email
    } elseif (!validateEmail($email)) {
        $checkRecords = 0;
        //checking for password match
    } elseif ($password != $confirm_password) {
        $checkRecords = 0;
        //checking for input length
    } elseif ( strlen($username) < 3 || strlen($password) < 3) {
        $checkRecords = 0;
    }
    
    if ($checkRecords == 0) {
        return false;
    } else {
        //md5 encrypts the password
        $password = md5($password);
        //meant to be used for email validation, which I didn't have time to implement
        $validation = md5($username + microtime());

        //insert he new user record
        $sql = "INSERT INTO users(username, password, email, validation_code, status) VALUES('$username', '$password', '$email', '$validation', 'active')";

        $result = query($sql);
        confirm($result);

        /* ---- // Meant to be used for email verification
        $subject = "Activate your Certifi account";
        $msg = "Please click the link below to activate your Account

        http://localhost/login/activate.php?email=$email&code=$validation"; //This will need to be change when uploaded. 
        $headers = "From: noreply@yourwebsite.com";


        send_email($email, $subject, $msg, $headers);
        */
        return true;
    }
}

//logs in the user
function login_user($username, $password) {
    //grab their password and userID if they match the username
    $sql = "SELECT password, userID FROM users WHERE username = '$username'";

    $result = query($sql);
    confirm($result);

    //if the record exists...
    if(row_count($result) == 1) {

        $row = fetch_array($result); //might throw an error
        //store the password and userID into variables
        $db_password = $row['password'];
        $userID = $row['userID'];
        
        //checking to see if the passwords match
        if(md5($password) === $db_password) {
            //if they do, set the session variables.
            $_SESSION['userID'] = $userID;
            $_SESSION['username'] = $username;

            return true;
        } else {
            return false;
        }
        
        return true;
    } else {
        return false;
    }
}

/***** VALIDATION FUNCTIONS *****/

function validate_user_registration() {
    if ($_SERVER['REQUEST_METHOD'] == "POST" && isset($_POST['register'])) {
        //grab & clean the inputs
        $username = clean($_POST['username']);
        $password = clean($_POST['password']);
        $email = clean($_POST['email']);
        $confirm_password = clean($_POST['confirm_password']);

        //if the user was successfully registered, display a success message.
        if(register_user($username, $password, $confirm_password, $email)) {
            //set_message("<p>Please check your email or spam folder.</p>");
            unset($_SESSION['invalidRegister']);
            $_SESSION['registered'] = "Account created! Please login.";
            redirect("index.php");
        // if they weren't registered, display an error message
        } else {
            unset($_SESSION['registered']);
            $_SESSION['invalidRegister'] = "Account not created, please fill out form correctly.";
            redirect("index.php");
        }
    }
}

//validates the email using a filter
function validateEmail($email) {
    return filter_var($email, FILTER_VALIDATE_EMAIL);
}

// checks to see if the email exists
function email_exists($email) {
    $sql = "SELECT userID FROM users WHERE email = '$email'";

    $result = query($sql);

    if (row_count($result == 1)) {
        return true;
    } else {
        return false;
    }
}

//checks to see if the username exists
function username_exists($username) {
    $sql = "SELECT userID FROM users WHERE username = '$username'";

    $result = query($sql);

    if (row_count($result == 1)) {
        return true;
    } else {
        return false;
    }
}

/*
function send_email($email, $subject, $msg, $headers){

    return mail($email, $subject, $msg, $headers);
        
}*/

function validate_user_login(){

    if($_SERVER['REQUEST_METHOD'] == "POST" && isset($_POST['login-btn']))  {
        //grab and clean the inputs
        $username = clean($_POST['username']);
        $password = clean($_POST['password']);
        
        //clear the invalid login session variable if it exists 
        unset($_SESSION['invalidLogin']);

        //checking for empty inputs
        if( empty(trim($username)) && empty(trim($password)) ) {
            $_SESSION['invalidLogin'] = "Incorrect Login Credentials";
        }

        //if the invalidLogin session variable is set, redirect to the front page
        if(isset($_SESSION['invalidLogin'])){
            redirect("index.php");
        } else {
    
            //if there was a successful login...
            if (login_user($username, $password)) {
                //Destroy error Session Data which may exist
                unset($_SESSION['invalidLogin']);

                //Pass Session Data
                $_SESSION['username'] = $username;
                redirect("profile.php");

            } else {
                //set the error message
                $_SESSION['invalidLogin'] = "Incorrect Login Credentials";
                redirect("index.php");
            } 
        }
    }
}


function validateImg($imgNameAttr, $imgFileType) {
    $uploadOk = 1;
    
    $_SESSION['file'] = $imgFileType;

    //On form submit.
    if($check !== false) {
        //checks to see if the file is an image
        $check = getimagesize($_FILES["$imgNameAttr"]["tmp_name"]);
            $uploadOk = 1;
    } else {
        $_SESSON['imgError'] = "Your file is not an image.";
        $uploadOk = 0;
        
    }

    //checks for file size (200KB)
    if ($_FILES["$imgNameAttr"]["size"] > 200000) {
        $_SESSON['imgError'] = "Your file is too large; max file size is 200 KB.";
        $uploadOk = 0;
        
    }

    //checks for file type
    if ($imgFileType != "jpg" && $imgFileType != "png" && $imgFileType != "jpeg" && $imgFileType != "JPG" && $imgFileType != "PNG" && $imgFileType != "JPEG") {
        //echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed."; //Could set as session message. 
        $_SESSON['imgError'] = "Sorry, only JPG, JPEG, and PNG files are accepted.";
        $uploadOk = 0;
    }

    return $uploadOk;
}

function validateTicket() {
    //grab and escape the input values
    $ticketName = escape($_POST['ticketName']);
    $issueDate = escape($_POST['issueDate']);
    $expDate = escape($_POST['expDate']);

    //Ticket name must be set
    if (!isset($ticketName) || $ticketName == "") {
        return false;
    } 
    
    //Making sure the date is in the proper YYYY-MM-DD format
    if (isset($issueDate) && $issueDate != "") {
        if (!preg_match("/^[0-9]{4}-(0[1-9]|1[0-2])-(0[1-9]|[1-2][0-9]|3[0-1])$/",$issueDate)) {
            return false;
        }
    }  //turn this into an 'elseif'
    
    
    //Making sure the date is in the proper YYYY-MM-DD format
    if (isset($expDate) && $expDate != "") {
        if (!preg_match("/^[0-9]{4}-(0[1-9]|1[0-2])-(0[1-9]|[1-2][0-9]|3[0-1])$/",$expDate)) {
            return false;
        }
    }

    //Issue date must not be greater/come at a later date than the expiry date. 
    if ( isset($issueDate) && isset($expDate) && $issueDate != "" && $expDate != "") {
        if ($issueDate > $expDate) {
            return false;
        }
    }

    return true;
}

/***** FEEDBACK FUNCTIONS *****/

function writeLoginFeedback() {
    if (isset($_SESSION['invalidLogin'])) {
        $loginError = $_SESSION['invalidLogin'];
        echo $loginError;
    }
}

function writeFailRegister() {
    if (isset($_SESSION['invalidRegister'])) {
        $registerError = $_SESSION['invalidRegister'];
        echo $registerError;
    }
}

function writeSuccessRegister() {
    if (isset($_SESSION['registered'])) {
        $registerSuccess = $_SESSION['registered'];
        echo $registerSuccess; 
    }
}

//hide and display modals based on what $_SESSION variables are set
function hideFailRegister() {
    
    if (isset($_SESSION['registered'])) {
        echo "
        <style>
        #regFail {
            display: none;
        }
        #accountCreated {
            display: block;
        }
        </style>";
    }
}

function hideSuccessRegister() {
    if (isset($_SESSION['invalidRegister'])) {
        echo "
        <style>
        #accountCreated {
            display: none;
        }
        #regFail {
            display: block;
        }
        </style>";
    }
}

function displayLoginModal() {
    if (isset($_SESSION['invalidLogin'])) {
        echo "<style>
        #myModal {
            display: block;
        }
        
        #login-modal {
        display: block;
        }
        </style>";
    }
}

function displayRegisterModal() {
    if ( isset($_SESSION['invalidRegister']) || isset($_SESSION['registered']) ) {
        echo "
        <style>
        #myModal {
            display: block;
        }

        #register-modal {
            display: block;
        }
        </style>";
    }
}

?>