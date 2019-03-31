<!--	//------------------------------//
		//---------- Modals ----------- //
		//------------------------------//	-->

<!------------------- Insert Profile Modal ------------------->
<div class="modal" id="profileModal"><!-- Container, provides grey bg -->
	<div class="modal-content" id="profile-content"><!-- Register Div -->

	<button class="close" id="close-profile">&times;</button>

	<h2>Please set up your profile</h2>
	
	<form action="<?php htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post" class="register-form" enctype="multipart/form-data">

        <label for="">First Name</label><br>
        <input type="text" name="firstName" placeholder="First Name"><br><br>
                    
        <label for="">Last Name</label><br>
        <input type="text" name="lastName" placeholder="Last Name"><br><br>
                    
        <label for="">Address</label><br>
        <input type="text" name="address" placeholder="Address"><br><br>
                                
        <label for="">City</label><br>
		<input type="text" name="city" placeholder="City"><br><br>
		
		<label for="">Province</label><br>
		<!--<input type="text" id="email" name="province" placeholder="Province"><br><br>-->
		<select name="province" id="">
			<option value="">Please select a province</option>
			<option value="AB">AB</option>
			<option value="BC">BC</option>
			<option value="MB">MB</option>
			<option value="NB">NB</option>
			<option value="NL">NL</option>
			<option value="NT">NT</option>
			<option value="NS">NS</option>
			<option value="NU">NU</option>
			<option value="ON">ON</option>
			<option value="PE">PE</option>
			<option value="QC">QC</option>
			<option value="SK">SK</option>
			<option value="YT">YT</option>
		</select><br><br>
		
			   
		<label for="">Postal Code</label><br>
		<input type="text" name="postalCode" placeholder="Postal Code"><br><br>
		
		<label for="">Phone</label><br>
		<input type="text" name="phone" placeholder="Phone"><br><br>

		<label for="">Job Title</label><br>
		<input type="text" name="jobTitle" placeholder="Job Title"><br><br>

        <label for="">Bio</label><br>
		<textarea name="bio" id="bio" cols="50" rows="4" maxlength="200"></textarea><br><br>

		<!-- Dont forget profile picture -->
		<label for="">Add Profile Picture</label><br><!-- If no pic, use a default -->
		<input type="file" name="ins_profilePic" id="ins_profilePic">

        <input type="submit" value="Submit" name="insertProfile" class="submit">
    </form>
		
	</div> <!-- End Register Div -->
</div><!-- End Modal Div -->


<!--------------- Update Profile Modal  ---------------->
<div class="modal" id="updateProfileModal"><!-- Container, provides grey bg -->
	<div class="modal-content" id="updateProfileContent"><!-- Register Div -->

	<button class="close" id="closeUpdateProfile">&times;</button>

	<h2>Please set up your profile</h2>
	
	<form action="<?php htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post" class="register-form" enctype="multipart/form-data" id="updateProfileForm">

        <label for="">First Name</label><br>
        <input type="text" id="username" name="firstName" value="<?php echo $firstName; ?>"><br><br>
                    
        <label for="">Last Name</label><br>
        <input type="text" id="password" name="lastName" value="<?php echo $lastName; ?>"><br><br>
                    
        <label for="">Address</label><br>
        <input type="text" id="confirm_password" name="address" value="<?php echo $address; ?>"><br><br>
                                
        <label for="">City</label><br>
		<input type="text" id="email" name="city" value="<?php echo $city; ?>"><br><br>
		
		<label for="">Province</label><br>
		<!--<input type="text" id="email" name="province" value="<?php //echo $province; ?>" placeholder="Province"><br><br>-->
		<select name="province" id="">
        <? 
			$provinceArr = array("AB", "BC", "MB", "NB", "NL", "NT", "NS", "NU", "ON", "PE", "QC", "SK", "YT");
			//The default option is the users current province data.
			echo '<option value="'.$province.'">'.$province.'</option>';

			//Looping through the provinces, and not displaying a province twice in the select.
			foreach($provinceArr as $p) {
				if ($p != $province) {
					echo '<option value="'.$p.'">'.$p.'</option>';
				}
			}
		?>
		</select><br><br>
			   
		<label for="">Postal Code</label><br>
		<input type="text" id="email" name="postalCode" value="<?php echo $postalCode; ?>"><br><br>
		
		<label for="">Phone</label><br>
		<input type="text" id="email" name="phone" value="<?php echo $phone; ?>"><br><br>

		<label for="">Job Title</label><br>
		<input type="text" id="email" name="jobTitle" value="<?php echo $jobTitle; ?>"><br><br>

        <label for="">Bio</label><br>
		<textarea name="bio" id="bio" cols="50" rows="4" maxlength="200"><?php echo $bio; ?></textarea><br><br>

		<!-- Dont forget profile picture -->
		<label for="">Update Profile Picture</label><br>
		<input type="file" name="upd_profilePic" id="upd_profilePic"><br>
        <div id="upd_proFileMsg"></div>
        
        <br><input type="submit" value="Submit" name="updateProfile" class="submit">
    </form>
		
	</div> <!-- End Register Div -->
</div><!-- End Modal Div -->


<!----------------- Insert Ticket Modal Form -------------------->
<div class="modal" id="ins_ticketModal"><!-- Container, provides grey bg -->

    <form action="<?php htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post" class="register-form" enctype="multipart/form-data" id="insTicketForm">
    <div class="modal-content" id="ins_step1"><!-- Register Div -->

		<p class="close" id="close_insStep1">&times;</p>

		<h2>Step One: </h2>
		<p>Enter certification information</p>

		<label for="">Ticket Name</label><br>
		<input type="text" name="ticketName" placeholder="Ticket Name" id="ins_ticketName" onblur="ins_removeFeedback();"><br><br>
						
		<label for="">Issue Date</label><br>
        <input type="date" id="ins_issueDate" name="issueDate" placeholder="YYYY-MM-DD" onblur="invalidDate();"><br>
        <div id="ins_invalidIssueDate"></div>
						
		<br><label for="">Expiry Date</label><br>
        <input type="date" id="ins_expiryDate" name="expDate" placeholder="YYYY-MM-DD" onblur="check_insExpiryDate(); invalidDate();"><br>
        <div id="ins_expiryFeedback"></div><div id="ins_invalidExpiryDate"></div>
									
		<br><label for="">Certification ID/Number</label><br>
		<input type="text" name="ticketNum" placeholder="Certification ID/Number"><br><br>		
        <div id="ins_ticketMsg"></div>
			<!-- Dont forget ticket picture -->
            <!-- <button class="ins_next">Next</button> -->
        <br><span class="ins_next">
        <p>Next</p><!-- Do NOT use a button tag here. It fucks up the form for some reason. 
                                took me too long to figure this out. Just style the span so it looks
                                like a button -->
        </span>
    </div> <!-- End Ticket Info Div -->

    <div class="modal-content" id="ins_step2">
		<p class="close" id="close_insStep2">&times;</p>

		<h2>Step Two: </h2>
		<p>Upload picture of certificate</p>

			<!-- Dont forget ticket picture -->
			<label for="">Insert Ticket Photo</label><br><!-- This must exist -->
			<input type="file" name="ins_ticketPic" id="ins_ticketPic" required>
			
            <span class="ins_previous">
                <p>Back</p><!-- Do NOT use a button tag here. It fucks up the form for some reason. 
                                took me too long to figure this out. Just style the span so it looks
                                like a button -->
            </span>

            <input type="submit" value="Add" name="insertTicket" class="submit"><br>
            <div id="ins_emptyTickName"></div>
	</div><!-- End Ticket Picture Div -->
    </form>	
</div><!-- End Modal Div -->


<!----------------- Update Ticket Modal --------------------->
<div class="modal" id="upd_ticketModal"><!-- Container, provides grey bg -->

    <form action="<?php htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post" class="register-form" enctype="multipart/form-data" id="updTicketForm">
    <div class="modal-content" id="upd_step1"><!-- Register Div -->

		<span class="close" id="close_updStep1">
			<p>&times;</p>
		</span>
		
		<h2>Step One: </h2>
		<p>Enter certification information</p>

		<label for="">Ticket Name</label><br>
		<input type="text" name="ticketName" placeholder="" id="upd_ticketName" onblur="upd_removeFeedback();"><br><br>
						
		<label for="">Issue Date</label><br>
        <input type="date" name="issueDate" placeholder="YYYY-MM-DD" id="upd_issueDate" onblur="invalidDate();"><br>
        <div id="upd_invalidIssueDate"></div>
						
		<br><label for="">Expiry Date</label><br>
        <input type="date" name="expDate" placeholder="YYYY-MM-DD" id="upd_expiryDate" onblur="check_updExpiryDate(); invalidDate();"><br>
        <div id="upd_expiryFeedback"></div><div id="upd_invalidExpiryDate"></div>
									
		<br><label for="">Certification ID/Number</label><br>
		<input type="text" name="ticketNum" placeholder="Certification ID/Number" id="upd_ticketNum"><br><br>		
        <div id="upd_ticketMsg"></div>
			<!-- Dont forget ticket picture -->
            <!-- <button class="ins_next">Next</button> -->
        <br><span class="upd_next">
        <p>Next</p><!-- Do NOT use a button tag here. It fucks up the form for some reason. 
                                took me too long to figure this out. Just style the span so it looks
                                like a button -->
        </span>
    </div> <!-- End Ticket Info Div -->

    <div class="modal-content" id="upd_step2">
		<span class="close" id="close_updStep2">
			<p>&times;</p>
		</span>

		<h2>Step Two: </h2>
		<p>Upload picture of certificate</p>

			<!-- Dont forget ticket picture -->
			<label for="">Update Ticket Photo</label><br>
			<input type="file" name="upd_ticketPic" id="upd_ticketPic">

            <span class="upd_previous">
                <p>Back</p><!-- Do NOT use a button tag here. It fucks up the form for some reason. 
                                took me too long to figure this out. Just style the span so it looks
                                like a button -->
            </span>
            <input type="hidden" value="" name="upd_ticketName" id="upd_ticketName">
            <input type="hidden" value="" name="upd_issueDate" id="upd_issueDate">
            <input type="hidden" value="" name="upd_expiryDate" id="upd_expiryDate">
            <input type="hidden" value="" name="upd_ticketNum" id="upd_ticketNum">

			<input type="hidden" value="" name="ticketID" id="upd_ticketID">
            <input type="submit" value="Add" name="updateTicket" class="submit"><br>
            <div id="upd_emptyTickName"></div>
	</div><!-- End Ticket Picture Div -->
    </form>	
</div><!-- End Modal Div -->


<!----------------- Delete Ticket Modal --------------------->
<div class="modal" id="del_ticketModal"><!-- Container, provides grey bg -->

	<div class="modal-content" id="del_form"><!-- Delete Ticket Div -->
    <form action="<?php htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post" class="register-form">

		<span class="close" id="close_delModal">
			<p>&times;</p>
		</span>

		<h2>Are you sure?</h2>
		<!-- Buttons are giving me issues, not sure why. Prefer that you style these span tags as if they were buttons. -->
		<span class="cancel">
			<p>Cancel</p>
		</span>
		<input type="hidden" value="" name="ticketID" id="del_ticketID">
        <input type="submit" value="Delete" name="deleteTicket">
	</form>	
    </div> <!-- End Content Div -->
</div>