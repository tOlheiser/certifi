<?php include("functions/init.php"); ?>
<!doctype html>
<html>
	<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<title>Certifi</title>

    <link rel="stylesheet" href="includes/modals.css">
    <link rel="stylesheet" href="includes/layout_index.css">
	<link rel="stylesheet" href="includes/design.css">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"> <!-- this ilink is for the social media icons -->
<?php
    //When the page loads, these functions check for conditions based on what is set in the $_SESSION variable.
    //For example, if there was a failed login, displayLoginModal() would be could. 
    validate_user_registration();
    validate_user_login();
    displayLoginModal();
    displayRegisterModal();
    hideSuccessRegister();
    hideFailRegister();
?>

</head>
    <body>
	
	<header class="header"><!-- heading -->
		<div class="logo">
			<img src="images/logo.png" alt="logo" width="130" class="logo" height="auto">
		  <input class="menu-btn" type="checkbox" id="menu-btn"/>
  					<label class="menu-icon" for="menu-btn"><span class="navicon"></span></label>
 		
		  <ul class="menu">
		  		<li><a href="">How It Works</a></li>
		  		<li>&nbsp;</li>
		  		<li><a class="open-login openLogin" id="open-login">Log In</a></li>
  				<li><a class="open-register openRegister" id="open-register">Sign Up</a></li>
  			</ul>
			&nbsp;</div>
	</header>
		
    
    <br>
	<br>
	<br>
	<br>
	<br>
	<br> <!-- this was giving me problems with the spacing was an easy solution feel free to change -->
		
		
    <section class="row rowone">
		  <article class="column columnone">
				<h2>Organize your certifications.</h2>
				<h3>All in one place.</h3>
				<p>Keeping track of all your certifications can be a hassle,<br> but it doesn't <br>have to be. Certifi allows you to keep track of all your<br> certifications, anywhere, anytime.</p>
			  	<br>
			  	<br>
			  	<button class="button openRegister">Get started - It's Free!</button>
				<p class="subtext">Have an account? <a class="openLogin" style="color:#ED5657;">Log In</a></p>
			  
		  </article>
		 
		  <div class="column columntwo">
				    <img src="images/Section_one.png" alt="" class="responsive">
			</div>
		</section>





		<div style="background-color:#F8F8F8;"> <!-- div class to change the background --->
		    <section class="row rowone">
				<div class="column columnone">
					<img src="images/Section_two.png" alt="" class="responsive2">
                </div>
                
                <div class="columntwo">	
		  <h2>All in one place. All the time.</h2>
					<h3>Set up in seconds, ready whenever.</h3>
					<img src="images/icon1.png" alt="" style="width:25px; height:25px">
					<p>Add and edit your tickets and certificates.</p>
					<p class="subtext">Stay on top of your current tickets or add new ones!</p>
					<img src="images/icon2.png" alt="" style="width:25px; height:25px">
					<p>Get notified when a ticket is about to expire.</p>
					<p class="subtext">Certifi will notify you when you're needing to renew a certification.</p>
					<img src="images/icon3.png" alt="" style="width:25px; height:25px">
					<p>Share with your boss or potential employers.</p>
					<p class="subtext">An easy and quick way to digitally share your credentials.</p>
		</div>
	    </section>
	</div>	





    <section class="buttonsection">
			<h2>Be organized. Be Certifi'd.</h2>
			<button class="button openRegister">Get started - It's Free!</button>
			<p class="subtext">Have an account? <a class="openLogin" style="color:#ED5657;">Log In</a></p>
		</section>
		

        
		<div style="background-color:#F8F8F8;"> <!-- div class to change the background --->
		
        <section class="rowone">
		  <div class="columnone">
				<h2>Have some more questions?</h2>
				<h3>Message us and we'll get back to you!</h3>
			
			
				  <span style="font-family: 'Poppins', sans-serif; color: #ADADAD;">
				<form action="">
					<label for="">Name</label>
					<br>
					<input type="text">
					<br>
					<label for="">Email Address</label>
					<br>
					<input type="text">
					<br>
					<label for="">Phone Number</label>
					<br>
					<input type="text">
					<br>
					<label for="">Message</label>
					<br>
					<input type="text" cols="30" rows="10"></textarea>
					<br>
					<input type="submit">
				</form>
			   </span>
			</div>
			
		  <div class="columnotwo">
				<img src="images/section_three.png" alt="" class="responsive3">
			</div>
		</section>
</div>

<!-- Grabs the login and register modals and includes them here -->
<?php include("includes/indexModals.php"); ?>

<footer>
	
	<div class="footer">
		<div class="footerlogo">
			<img src="images/logo.png" alt="logo" width="130" class="logo" height="auto"></div>
		<p class="subtext">Copyright 2019 - Certifi</p><!-- Logo -->
		 <div class="footer-content-wrapper">
    <div class="footer-col large-25 small-50 tiny-100">
      
		<ul class="menu">
			<li><a href="">About Us</a></li>
			<li><a href="">How It Works</a></li>
		    <li><a href="">Features</a></li>
		</ul>
			</div>
   
    <div class="footer-col large-25 small-50 tiny-100">
		<ul>
		<li> <a href="">Follow Us</a></li>	
		<li><a href="">Keep in Touch</a></li>
		<li><a href="">Contact Us</a></li>
      </ul>
    </div>
    
    <div class="footer-col large-25 small-50 tiny-100">
     
		<ul>
			<li><a href="#" class="fa fa-facebook"></a></li>
			<li><a href="#" class="fa fa-linkedin"></a></li>
		</ul>
			 </div>

</footer>

<script type="text/javascript" src="functions/validation.js"></script>
<script type="text/javascript" src="functions/indexModals.js"></script>
<script type="text/javascript" src="functions/jquery-3.3.1.min.js"></script>
<script type="text/javascript" src="functions/jquery.form.js"></script>
</body>
</html>