<?php ob_start();

session_start();

//reporting(E_ALL ^ E_NOTICE); (error message i needed to look into later)
//include the necessary files
include("functions/db.php");
include("functions/functions.php");
include("functions/queries.php");

//--------------- Initiate the user. 
//admin until proven otherwise.
$admin = 1;
//there's a distinction that will be made as the project evolves. data in the nav bar like user settings belongs to the logged in user, who may be viewing someone elses profile.
$profileID = $_SESSION['userID'];

if (isset($_GET['userID'])) {
    //userID, which generates profile and ticket data, is set to the ID passed in the get request.
	$userID = $_GET['userID'];
    
    //if the userID doesn't match the logged in user's userID, admin is set to 0. 
    //If admin is set to 0, the user won't be able to change any data.
	if ($userID !== $profileID) {
		$admin = 0;
    } 
    //username is set when the user logs in.
} elseif (isset($_SESSION['username'])) {
    //Grab Session Values and Store into Variables.
    $username = $_SESSION['username'];
    $userID = $_SESSION['userID'];
}

if (isset($_GET['userID']) || isset($_SESSION['username'])) {
    //Query to select user data
    $sql = "SELECT firstName, lastName, address, city, province, postalCode, phone, jobTitle, users_userID FROM profile WHERE users_userID = $userID";
    
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


?>