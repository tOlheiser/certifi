<?
// Checks to see if a request to insert a profile, update profile, insert ticket, update ticket, and delete ticket has been submitted. 
if (isset($_POST['insertProfile']) || isset($_POST['updateProfile']) || isset($_POST['insertTicket']) || isset($_POST['updateTicket']) || isset($_POST['deleteTicket'])) {
    //If it has, grabs $_POST values.
    @$_firstName = escape($_POST['firstName']);
    @$_lastName = escape($_POST['lastName']);
    @$_address = escape($_POST['address']);
    @$_city = escape($_POST['city']);
    @$_province = escape($_POST['province']);
    @$_postalCode = escape($_POST['postalCode']);
    @$_phone = escape($_POST['phone']);
    @$_jobTitle = escape($_POST['jobTitle']);
    @$_bio = escape($_POST['bio']);
    
    // --------- Ticket Table
    @$ticketName = escape($_POST['ticketName']);
    @$issueDate = escape($_POST['issueDate']);
    @$expDate = escape($_POST['expDate']);
    @$ticketNum = escape($_POST['ticketNum']);
    @$ticketID = escape($_POST['ticketID']);

    //-----------------------------------------------//
    //---------- PROFILE & TICKET QUERIES ---------- //
    //-----------------------------------------------//

    //--------------- Executing the Insert Profile Query
    if (isset($_POST['insertProfile'])) {
        
       //Uploads the picture and stores the extension value of the picture | $extension[1]
       $extension = uploadImg("profilePics/", "ins_profilePic", $userID);
        
       //Insert Query
       if ($extension == NULL) {
           $sql = "INSERT INTO profile (firstName, lastName, address, city, province, postalCode, phone, jobTitle, bio, users_userID)
           VALUES ('$_firstName', '$_lastName', '$_address', '$_city', '$_province', '$_postalCode', '$_phone', '$_jobTitle', '$_bio', '$userID')";
       } else {
           $sql = "INSERT INTO profile (firstName, lastName, address, city, province, postalCode, phone, jobTitle, bio, profileExt, users_userID)
           VALUES ('$_firstName', '$_lastName', '$_address', '$_city', '$_province', '$_postalCode', '$_phone', '$_jobTitle', '$_bio', '$extension[1]', '$userID')";
       }
       
       $result = query($sql);
       confirm($result); 

       redirect("profile.php");
    }
    //--------------- Executing the Update Profile Query
    if (isset($_POST['updateProfile'])) {
            
        //Uploads the picture and stores the extension value of the picture | $extension[1]
        $extension = uploadImg("profilePics/", "upd_profilePic", $userID);
            
        //set message to 'profile updated'. Grab the message from the session and do something with it.
            
        if ($extension == NULL) {
            $sql = "UPDATE profile SET firstName = '$_firstName', lastName = '$_lastName', address = '$_address', city = '$_city', province = '$_province', postalCode = '$_postalCode', phone = '$_phone', jobTitle = '$_jobTitle', bio = '$_bio'
            WHERE users_userID = '$userID'";
        } else {
            $sql = "UPDATE profile SET firstName = '$_firstName', lastName = '$_lastName', address = '$_address', city = '$_city', province = '$_province', postalCode = '$_postalCode', phone = '$_phone', jobTitle = '$_jobTitle', bio = '$_bio', profileExt = '$extension[1]'
            WHERE users_userID = '$userID'";
        }

        $result = query($sql);
        confirm($result); 

        redirect("profile.php");
    } 

    //--------------- Executing the Insert Ticket Query
    if (isset($_POST['insertTicket'])) {

        if ( validateTicket() ) {

            //-------------- Assemble query to grab max ticket ID + 1
            $sql = "SELECT MAX(ticketID) + 1 AS maxTicketID FROM tickets";
            $result = query($sql);
            confirm($result);
            $maxTicket = fetch_array($result);
    
            // Grabbing the image extension
            $extension = uploadImg("ticketPics/", "ins_ticketPic", $maxTicket[0]);
            // !! Check that it's a valid image
    
            //Assembling the insert query
            $sql = "INSERT INTO tickets (ticketName, issueDate, expDate, ticketNum, ticketExt, users_userID)
            VALUES ('$ticketName', '$issueDate', '$expDate', '$ticketNum', '$extension[1]', '$userID')";
            
            //submitting the query
            $result = query($sql);
            confirm($result);
    
            //redirecting to the profile
            unset($_SESSION['ins_ticketError']);
            unset($_SESSION['upd_ticketError']);
            redirect("profile.php");    
        } else {
            $_SESSION['ins_ticketError'] = "Error. Please check the form and try again.";
            redirect("profile.php");
        }
    }

    //--------------- Executing the Update Ticket Query
    if (isset($_POST['updateTicket'])) {
        
        if ( validateTicket() ) {
            $extension = uploadImg("ticketPics/", "upd_ticketPic", $ticketID);
            // !! Check that it's a valid image
    
            // Img extension may remain null. 
            if ($extension == NULL) {
                $sql = "UPDATE tickets SET ticketName = '$ticketName', issueDate = '$issueDate', expDate = '$expDate', ticketNum = '$ticketNum'
                WHERE ticketID = '$ticketID'";
            } else {
                $sql = "UPDATE tickets SET ticketName = '$ticketName', issueDate = '$issueDate', expDate = '$expDate', ticketNum = '$ticketNum', ticketExt = '$extension[1]'
                WHERE ticketID = '$ticketID'";
            }
    
            $result = query($sql);
            confirm($result);	
    
            unset($_SESSION['upd_ticketError']);
    
            redirect("profile.php");
        } else {
            $_SESSION['upd_ticketError'] = "Error. Please check the form and try again.";
            redirect("profile.php");
        }

    }

    //--------------- Executing the Delete Ticket Query
    if (isset($_POST['deleteTicket'])) {

        $sql = "SELECT MAX(ticketID) AS maxTicketID FROM tickets";
        $result = query($sql);
        confirm($result);
        $maxTicket = fetch_array($result);

        $sql = "DELETE FROM tickets WHERE ticketID = '$ticketID'";

        $result = query($sql);
        confirm($result);

        $sql2 = "ALTER TABLE tickets AUTO_INCREMENT = $maxTicket[0]";
        $result2 = query($sql2);
        confirm($result2);

        redirect("profile.php");
    }
}

//------------------------------------//
//---------- OTHER QUERIES ---------- //
//------------------------------------//

    //--------- Checking if a profile record exists for the logged in user (which wouldn't upon first login after creating an account). 
    // If it doesn't, the 'insert profile' modal is displayed. 
	$sql = "SELECT COUNT(*) FROM profile WHERE users_userID = '$userID'"; 
	$result = query($sql);
	confirm($result);
	$row = fetch_array($result);

	$profile_count = $row[0];

	//--------- Checking if any ticket records exist for the logged in user. 
	$sql = "SELECT COUNT(*) FROM tickets WHERE users_userID = '$userID'"; 
	$result = query($sql);
	confirm($result);
	$row = fetch_array($result);
    
	$ticket_count = $row[0];

	//------------- Grabbing the file extension for the profile pic, to be inserted in the img src.
	$sql = "SELECT profileExt FROM profile WHERE users_userID = '$userID'";
	$result = query($sql);
	confirm($result);
    $fileExt = fetch_array($result);

    // ------------- Checking to see if the user has a profile pic
    $sql = "SELECT profileExt from profile WHERE users_userID = '$userID'";
    $result = query($sql);
    confirm($result);
    $row = fetch_array($result);
    $picExists = $row[0];
    ?>