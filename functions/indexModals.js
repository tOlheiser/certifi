// Get the modal
var modal = document.getElementById('myModal');

//Get the nested forms
var registerForm = document.getElementById("register-modal");
var loginForm = document.getElementById("login-modal");

// Get the buttons that open the modals
var registerMsg = document.querySelector(".register-message");
var loginMsg = document.querySelector(".login-message"); 
var loginButtons = document.getElementsByClassName("openLogin"); 
var registerButtons = document.getElementsByClassName("openRegister");

// Get the buttons that close the modal
var closeReg = document.getElementById("close-register");
var closeLog = document.getElementById("close-login");

registerMsg.onclick = function(){
    loginForm.style.display = "none";
    registerForm.style.display= "block";
}

loginMsg.onclick = function(){
    registerForm.style.display = "none";
    loginForm.style.display = "block";
}

// When the user clicks on <span> (x), close the modal
closeLog.onclick = function() {
  modal.style.display = "none";
}

closeReg.onclick = function() {
    modal.style.display = "none";
  }

// When the user clicks anywhere outside of the modal, close it
window.onclick = function(event) {
  if (event.target == modal) {
    modal.style.display = "none";
  }
}

//Loop through Update ticket buttons and create event listeners for each.
for (let i = 0; i < loginButtons.length; i++) {

  loginButtons[i].addEventListener("click", function() {
      //Display the modal on click. 
      modal.style.display = "block";
      loginForm.style.display= "block";
      registerForm.style.display = "none";
  });
}

//Loop through Update ticket buttons and create event listeners for each.
for (let i = 0; i < registerButtons.length; i++) {

  registerButtons[i].addEventListener("click", function() {
      //Display the modal on click. 
      modal.style.display = "block";
      registerForm.style.display = "block";
      loginForm.style.display= "none";
  });
}