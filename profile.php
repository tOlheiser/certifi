<?php 
//Including the init file and queries file. This handles PHP logic before the page loads.
include('functions/init.php'); 
include('includes/queries.php');

?>

<!doctype html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<title>Certifi</title>
    
    
    <link rel="stylesheet" href="includes/imgModal.css">
    <link rel="stylesheet" href="includes/tooltip.css">

    <link rel="stylesheet" href="includes/profile.css">
    <link rel="stylesheet" href="includes/design.css">
    <link rel="stylesheet" href="includes/layout_profile.css">

    <link rel="stylesheet" href="includes/accordionStyles.css">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"> <!-- this ilink is for the social media icons -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    
    <?php
        //If a profile does not exist, change the styles so that the profile modal displays.
		if ($profile_count == 0) { echo 
		"<style>
			#profileModal {
				display: block;
			}
			#profileForm {
				display: block;
			}
		</style>";
        } 
        
    ?>
</head>
<body>

<header class="p-header">
			<nav>
				<div class="logoContainer"><!-- Insert Logo Here -->
					<img src="images/logowhite.png" alt="logo" class="logo">
				</div>
				<div class="p-NavIconsContainer"><!-- Links Container -->
					<ul>
						<li class="NavIcons"><a href="#"><img class="p-IconLeft" src="images/Certificate.png" alt="icon"></a></li><!-- Add certification icon -->
						<li class="NavIcons"><a href="#"><img class="p-IconMiddle" src="images/NotificationBell.png" alt="icon"></a></li><!-- Notification bell icon -->
						
				<!-- THIS IS WHAT I ADDED. I removed the third list item and replaced it with a button with an image overlay. -->
				<!-- I added some code in the phone media querie as well btw. Its just there to try and prevent icons from showing when it collapses into a hamburger menu. -->
				<!-- It might not look pretty for the mobile if my code doesnt work but I feel like that is the least of our problems ahaha -->		
						<div class="dropdown">
						  <button class="dropbtn"><img class="settingsIcon" src="images/Settings.png" alt="icon"></button>
						  <div class="dropdown-content">
							<a href="">Privacy</a>
							<a href="">Settings</a>
							<a href="logout.php">Log Out</a>
						  </div>
						</div>
						</ul>
						
						
					<img src="images/hamburgermenu.png" alt="menu" class="hamburger">
				</div>
			</nav>
		</header>

<section class="p-profileinfo"><!-- Fundamental Profile Info -->
	<div class="p-profilePic"><!-- Profile Pic -->
        <?php
        // ---------- Displaying the profile picture
        if ($picExists != NULL) {
            //Display the user's profile pic
            //time() was added so that the image is refreshed upon page reload.
            echo '<img class="p-img" src="profilePics/' . $userID . '.' .$fileExt["profileExt"].'?'.time().'" alt="profilepic" style="width:auto;max-height:300px">';
            //echo '<img class="p-img" src="profilePics/' . $userID . '.' .$fileExt["profileExt"].'" alt="profilepic" style="width:auto;max-height:300px">';
        } else {
            //Display the default picture if there is no profile picture
            echo '<img class="p-img" src="images/profile.jpg" alt="profilepic">';
        }   
        ?>
	</div>
	<div class="p-bio">
        <!-- Generate the user's fundamental profile info-->
		<h2><?php echo $firstName." ".$lastName;?></h2>
		<h3><?php echo $jobTitle; ?></h3>
		<p><?php echo $bio; ?></p>
        <!-- <input type="hidden" id="shareCopy" value="Tanner"> -->
        <div class="p-buttons">
            <div class="tooltip">
                <!-- When the share button is clicked, it copies the link of the user's profile to the user's clipboard -->
                <button class="button1 shareBtn shareProfile" id="share" data-clipboard-text="http://localhost/comp204/certifi-unified/_BACKUPS/bulkDev/profile.php?userID=<? echo $userID; ?>">Share My Profile</button>
                <span class="tooltiptext" id="tooltip">Profile copied to clipboard!</span>
            </div>

            <?php
            if ($admin) {

            // If they have a profile, display update button. If not, display Create profile button. 
                if ($profile_count == 1) {
                    echo '<button class="updateProfileBtn button2 editProfile">Edit Profile</button>';
                } else {
                    echo '<button class="profileBtn button2 editProfile">Create Profile</button>';
                }
            }
            ?>
		</div>
	</div>
</section>

<?php
    //If no tickets exist, display a message and photo | it's tailored to a visitor vs owner of the profile.
	if ($ticket_count == 0) {
        // admin checks to see if the current user is the owner of the profile
		if ($admin) {
            echo '<div style="background-color:#F8F8F8">';
            echo '<section>';
            echo '<div class="add">';
            echo "<br><br><h3>You have no certifications added!</h3><br><br>";
            echo '<img src="images/large_icon.png" width="400" height="450" alt=""/><br>';
            echo '</div>';
            echo '</section>';
            echo '</div>';
            //
		} else {
            echo '<div style="background-color:#F8F8F8">';
            echo '<section>';
            echo '<div class="add">';
            echo "<br><br><h3>This user has no certifications to display.</h3><br><br>";
            echo '<img src="images/large_icon.png" width="400" height="450" alt=""/><br>';
            echo '</div>';
            echo '</section>';
            echo '</div>';
		}
	//------------- Displaying Tickets ----------------->
	} else {
		//Select all tickets belonging to that user's profile
		$sql = "SELECT * FROM tickets WHERE users_userID = '$userID'";
		$result = query($sql);
		confirm($result);
		//$display_ticketrow = fetch_row($display_ticketresult);
        echo "<br>";
        
        echo '<div class="accordionContainer">';
        echo '<div class="flexCenter">';

        //Create accordions as you loop through the tickets
        // each iteration of this loop contains data about the ticket. $row[ticketName] holds the ticket name for example
		while ($row = fetch_array($result)) {

			echo '<div class="accordion">';
            
            echo '<h3>'.$row["ticketName"].'</h3>';

            //If a user hadn't entered an expiry date, the default returned from the database is "0000-00-00", which I would rather not display. 
            if ($row["expDate"] != "0000-00-00") {
            echo '<p class="expire hide-expire">Expires: '.$row["expDate"].'</p>';
            }

			echo '</div>'; // End accordion div
            
            // The panel is the data revealed when the accordion is expanded
            echo '<div class="panel">'; // panel div
			echo '<div>'; //ticket info div

			if ($row["issueDate"] != "0000-00-00") {
				echo '<p><b>Issue Date:</b> '.$row["issueDate"].'</p>';
			}

            if ($row["expDate"] != "0000-00-00") {
                echo '<p><b>Expiry Date:</b> '.$row["expDate"].'</p>';
            }
			
			//if ($row["ticketNum"] !== NULL || $row["ticketNum"] != 0 || $row["ticketNum"] > 1) {
            if ($row["ticketNum"] != "0") {
				echo '<p><b>Ticket Number:</b> '.$row["ticketNum"].'</p>';
            }
            echo '</div>'; // end ticket info div

            // thumbnail
            echo '<img class="ticketImg" src="ticketPics/'.$row["ticketID"].'.'.$row["ticketExt"].'?'.time().'" style="width:auto;max-height:220px">';
            //echo '<img class="ticketImg" src="ticketPics/'.$row["ticketID"].'.'.$row["ticketExt"].'" style="width:auto;max-height:220px">';

            //modal container for the image
            echo '<div class="modal imgModal">';
            echo '<span class="closeImg">&times;</span>';
            echo '<img class="modalContent img01">';
            
            echo '<div class="caption"></div>';
            echo '</div>'; // end imgModal Div

        	echo '<div>'; // button div

            //Passing the values of the ticket data so that when you 'update ticket', the inputs contain the current data.
            echo '<input type="hidden" value="'.$row["ticketName"].'" class="tickName">';
			echo '<input type="hidden" value="'.$row["ticketName"].'" class="upd_ticketName">';
			echo '<input type="hidden" value="'.$row["issueDate"].'" class="upd_issueDate">';
			echo '<input type="hidden" value="'.$row["expDate"].'" class="upd_expiryDate">';
			echo '<input type="hidden" value="'.$row["ticketNum"].'" class="upd_ticketNum">';

			echo '<input type="hidden" value="'.$row["ticketID"].'" class="upd_ticketID">';

            //If admin, display update and delete ticket buttons.
			if ($admin) {
			echo '<button class="updTicketsBtn">Update</button>';
			echo '<button class="delTicketBtns">Delete</button>';
			}

			echo '</div>'; // end button div
			echo '</div><br>'; // end panel div
		}
    }
    
    echo '</div>'; //nested div
    echo '</div>'; //accordion container

    //If admin, display the add ticket button
	if ($admin) {
        echo '<div class="accordionContainer">';
        echo '<div class="flexChild">';
        echo '<button class="addTicketsBtn button1 shareProfile">Add Certification</button>';
        echo '</div>';
        echo '</div>';
	}
?>

<!--------------- Personal Info //-->
<?php 
echo '<section class="p-PersonalInfo">
        <div class="p-side"><!--Should we display this info? Or only make it available to employers? 
                City and Contact info is probably fine.-->
            <h4>Address</h4>
            <ul class="p-list">
                <li>'.$address.'</li>
                <li>'.$city.'</li>
                <li>'.$province.'</li>
                <li>'.$postalCode.'</li>
            </ul>
        </div>
        <div class="p-side">
            <h4>Contact Information</h4>
            <ul class="p-list"><!-- In the future we could link other social media profiles here -->
                <li>'.$phone.'</li>
                <li>'.@$email.'</li>
            </ul>
        </div>
    </section>';
?>

<!-- Page behaved unpredictably if I deleted this. -->
<button class="profileBtn" id="downwardDog">Create Profile</button><!-- Must not delete. -->

<!-- including the profile modals into the page. -->
<?php include('includes/profileModals.php'); ?>

<footer style="width: 100%;">
	<div class="FooterContainer">
		<div>
			<ul class="AboutUs">
				<li class="footer"><a href="#" style="text-decoration: none; color: white;">About Us | </a></li>
				<li class="footer"><a href="#" style="text-decoration: none; color: white;">How It Works | </a></li>
				<li class="footer"><a href="#" style="text-decoration: none; color: white;">Features | </a></li>
				<li class="footer"><a href="#" style="text-decoration: none; color: white;">Keep in Touch | </a></li>
				<li class="footer"><a href="#" style="text-decoration: none; color: white;">Contact Us</a></li>
			</ul>
		</div>
		<div>
			<ul>
				<li class="NavIcons"><a href="#"><img src="images/facebook.png" alt="facebook" class="socialmedia"></a></li>
				<li class="NavIcons"><a href="#"><img src="images/Linkedin.png" alt="linkedin" class="socialmedia"></a></li>
				<li class="NavIcons"><a href="#"><img src="images/insta.png" alt="instagram" class="socialmedia"></a></li>
			</ul>
		</div>
	</div>
</footer>

<script type="text/javascript" src="functions/validation.js"></script>
<script type="text/javascript" src="functions/clipboard.min.js"></script>
<script type="text/javascript" src="functions/accordion.js"></script>
<script type="text/javascript" src="functions/profileModal.js"></script>
</body>
</html>