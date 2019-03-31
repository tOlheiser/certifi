<? 

// I was conflicted about including my entire db and functions files into this. Would it slow down the request? I kept it simple and wrote stuff from scratch.

//Linking to the DB
$link = mysqli_connect('192.185.39.248', 'immuneeh_comp205', 'comp205', 'immuneeh_certifi');    //Testing
//$link = mysqli_connect('localhost', 'immuneeh_comp205', 'comp205', 'immuneeh_certifi');    //LIVE

// checks to see if a username already exists.
if ( isset($_GET['username']) ) {
    //Grab GET value
    $username = $_GET['username'];

    //length must be greater than 2 characters
    if (strlen(trim($username)) < 3) { 
        echo "Username must be at least 3 characters.";
    }

    //Assembling a query
    $sql = "SELECT count(*) FROM users WHERE username = '$username'";
    //store the result of the query into a variable.
    $result = mysqli_query($link, $sql);
    //fetch the rows.
    $row = mysqli_fetch_row($result);
    //Store the number of matches into the count variable.
    $count = $row[0];

    //If count holds a value greater than 0, this means the username already exists in the database.
    if ($count > 0) {
        echo "Username already exists!";
    }
}

//checks for a password match and if there is adequate length
if ( isset($_GET['password']) && isset($_GET['confirm_password']) ) {
    //Grab GET values
    $password = $_GET['password'];
    $confPassword = $_GET['confirm_password'];

    if ($password != $confPassword) {
        echo "Your passwords must match!";
    } elseif (strlen(trim($password)) < 3 || strlen(trim($confPassword)) < 3) {
        echo "Password must be at least 3 characters.";
    }
}

//check the email value
if ( isset($_GET['email']) ) {
    //Grab GET value
    $email = $_GET['email'];
 
    //checks to see if it's a valid email
    if (!validEmail($email)) {
        echo "Please enter a valid email.";
    }

    //run the query to check if the email already exists
    $sql = "SELECT count(*) FROM users WHERE email = '$email'";
    $result = mysqli_query($link, $sql);
    $row = mysqli_fetch_row($result);
    $count = $row[0];

    //If it does, write a message
    if ($count > 0) {
        echo "Email already exists!";
    }
}

//returns true if it's a valid email
function validEmail($email) {
    return filter_var($email, FILTER_VALIDATE_EMAIL);
}
?>