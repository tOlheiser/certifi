<div class="modal" id="myModal"><!-- Container, provides grey bg -->

    <span style="font-family: 'Poppins', sans-serif; color: #ADADAD">
	<div class="modal-content form" id="register-modal"><!-- Register Div -->

	<button class="close" id="close-register">&times;</button>

    <!-- Register Form -->
	<h2>Welcome!</h2>
    <p>Please enter your information</p>
	
	<form action="<?php htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post" class="register-form" id="registerForm">

        <label for="">Username</label><br>
        <input type="text" id="username" name="username" placeholder="Username" autocomplete="off" onblur="check_username_availability();" required><br>
        <div id="username_error"></div><div id="reg_userFeedback"></div>
                    
        <br><label for="">Password</label><br>
        <input type="password" id="password" name="password" placeholder="Password" autocomplete="off" onblur="check_password_match();" required><br>
                    
        <br><label for="">Confirm Password</label><br>
        <input type="password" id="confirm_password" name="confirm_password" placeholder="Confirm Password" autocomplete="off" onblur="check_password_match();" required>
        <div id="password_error"></div><div id="reg_passFeedback"></div>
                                
        <br><label for="">Email Address</label><br>
        <input type="email" id="email" name="email" placeholder="Email" autocomplete="off" onblur="check_email_availability();" required><br>
        <div id="email_error"></div><div id="reg_emailFeedback"></div>
                                    
        <br><input type="submit" value="Sign Up" name="register" class="submit">
        <br><div id="regFail"><?php writeFailRegister(); ?></div><div id="accountCreated"><?php writeSuccessRegister(); ?></div>
    </form>
	<p class="message">Have an account? <a class="login-message" style="color:#ED5657; cursor: pointer;">Login</a></p>
		
	</div> <!-- End Register Div -->
    </span>

    <!-- Login Div -->
    <span style="font-family: 'Poppins', sans-serif; color: #ADADAD; font-weight:lighter">
	<div class="modal-content form" id="login-modal"> 
	<button class="close" id="close-login">&times;</button>
    
    <!-- Login Form -->
	<h2>Welcome back!</h2>
    <p>Please enter your information</p>
	<form action="<?php htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post" class="login-form" id="loginForm">
                
        <label for="">Username</label><br>
        <input type="text" id="log_username" name="username" placeholder="Username" autocomplete="off" required><br><br>                     

        <label for="">Password</label><br>
        <input type="password" id="log_password" name="password" placeholder="Password" required><br><br>
        
        <input type="submit" value="Login" class="submit" name="login-btn">
        <br><br><div id="logFeedback"><?php writeLoginFeedback(); ?></div>    
	</form>
	<p class="message">No Account? <a class="register-message" style="color:#ED5657; cursor: pointer;">Sign up</a></p>
	</div><!-- End Login Div -->
    </span>

</div> <!-- End Modal Div -->