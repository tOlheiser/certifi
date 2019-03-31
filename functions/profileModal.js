
//Grabbing the tooltip and share button elements
var tooltip = document.getElementById("tooltip");
var share = document.getElementById("share");

//when the share button is clicked, display the tool tip, and hide it after a short amount of time.
share.onclick = function() {
	tooltip.classList.add("reveal");
    tooltip.style.display = "block";
    hideTooltip();
}

//hide the tooltip
function hideTooltip() {
  	setTimeout(function() {
        tooltip.style.display = "none";
	}, 1500);
}


// ------------- clipboard.js
let clipboard = new ClipboardJS('.shareBtn');

clipboard.on('success', function(e) {

  console.info('Action:', e.action);
  console.info('Text:', e.text);
  console.info('Trigger:', e.trigger);

  e.clearSelection();
})

clipboard.on('error', function(e) {

  console.error('Action:', e.action);
  console.error('Trigger:', e.trigger);
});

// ------------- INITIALIZING VARIABLES

  // Get the modal containers
  let ins_profileModal = document.getElementById("profileModal"); // Insert Profile
  let upd_profileModal = document.getElementById("updateProfileModal"); // Update Profile
  let ins_ticketModal = document.getElementById("ins_ticketModal");  // Insert Ticket
  let upd_ticketModal = document.getElementById("upd_ticketModal"); // Update Ticket
  let del_ticketModal = document.getElementById("del_ticketModal"); // Delete Ticket

  //Get the nested forms
  let ins_profileForm = document.getElementById("profile-content"); // Insert Profile
  let upd_profileForm = document.getElementById("updateProfileContent"); // Update Profile

    // Insert Ticket
    let ins_ticketForm1 = document.getElementById("ins_step1"); 
    let ins_ticketForm2 = document.getElementById("ins_step2"); 

    // Update Ticket
    let upd_ticketForm1 = document.getElementById("upd_step1"); 
    let upd_ticketForm2 = document.getElementById("upd_step2");

  let del_ticketForm = document.getElementById("del_form"); // Delete Ticket

  // Get the buttons that open the modals
  let ins_profileBtn = document.querySelector(".profileBtn"); // Insert Profile
  let upd_profileBtn = document.querySelector(".updateProfileBtn"); // Update Profile 

    // Insert Ticket
    let ins_ticketBtn = document.querySelector(".addTicketsBtn"); 
    let ins_step1Msg = document.querySelector(".ins_next"); 
    let ins_step2Msg = document.querySelector(".ins_previous");

    // Update Ticket
    let upd_ticketBtns = document.getElementsByClassName("updTicketsBtn"); 
    let upd_ticketMsg1 = document.querySelector(".upd_next");
    let upd_ticketMsg2 = document.querySelector(".upd_previous");

  let del_ticketBtns = document.getElementsByClassName("delTicketBtns"); // Delete Ticket

  // Get the buttons that close the modals
  let ins_closeProfile = document.getElementById("close-profile"); // Create Profile
  let upd_closeProfile = document.getElementById("closeUpdateProfile"); // Update Profile
  let closeUpdateProfile

    // Insert Ticket
    let ins_closeStep1 = document.getElementById("close_insStep1"); 
    let ins_closeStep2 = document.getElementById("close_insStep2");

    // Update Ticket
    let upd_closeStep1 = document.getElementById("close_updStep1"); 
    let upd_closeStep2 = document.getElementById("close_updStep2");

    // Delete Ticket
    let close_delModal = document.getElementById("close_delModal"); 
    let cancel = document.querySelector(".cancel");


// -------------- Passing Values

  //These are the values I need to pass to the form. |  Look into displaying current ticket content
  let upd_ticketID = document.getElementsByClassName("upd_ticketID");
  let upd_ticketName = document.getElementsByClassName("upd_ticketName");
  let upd_issueDate = document.getElementsByClassName("upd_issueDate");
  let upd_expiryDate = document.getElementsByClassName("upd_expiryDate");
  let upd_ticketNum = document.getElementsByClassName("upd_ticketNum");

  let del_ticketID = document.getElementsByClassName("upd_ticketID");

  //These are the form elements which take in the passed in value into the value attribute.
  let modal_updticketID = document.getElementById("upd_ticketID");
  let modal_updticketName = document.getElementById("upd_ticketName");
  let modal_updissueDate = document.getElementById("upd_issueDate");
  let modal_updexpDate = document.getElementById("upd_expiryDate");
  let modal_updticketNum = document.getElementById("upd_ticketNum");

  let modal_delticketID = document.getElementById("del_ticketID");



// ------------- OPEN MODAL
  // When the user clicks the button, open the modal 

  ins_profileBtn.onclick = function() {
    ins_profileModal.style.display = "block";
    ins_profileForm.style.display= "block";
  }

  upd_profileBtn.onclick = function() {
    upd_profileModal.style.display = "block";
    upd_profileForm.style.display= "block";
  }

  // Open Insert Tickets Modal 
    ins_ticketBtn.onclick = function() {
      ins_ticketModal.style.display = "block";
      ins_ticketForm1.style.display = "block";
      ins_ticketForm2.style.display = "none";
    }

    ins_step1Msg.onclick = function(){
      ins_ticketForm1.style.display = "none";
      ins_ticketForm2.style.display = "block"; 
    }
  
    ins_step2Msg.onclick = function(){
      ins_ticketForm2.style.display = "none";
      ins_ticketForm1.style.display = "block";
    }
  
  // Open Update Tickets Modal  
    upd_ticketMsg1.onclick = function(){
      upd_ticketForm1.style.display = "none";
      upd_ticketForm2.style.display = "block";
    }

    upd_ticketMsg2.onclick = function(){
        upd_ticketForm2.style.display = "none";
        upd_ticketForm1.style.display = "block";
    }

// ------------- CLOSE MODAL w/ Button
  // When the user clicks on <span> (x), close the modal

  ins_closeProfile.onclick = function() {
      ins_profileModal.style.display = "none";
      ins_profileForm.style.display= "none";
  }

  upd_closeProfile.onclick = function() {
    upd_profileModal.style.display = "none";
  }

  // Close Insert Ticket Modal
    ins_closeStep1.onclick = function() {
      ins_ticketModal.style.display = "none";
    }

    ins_closeStep2.onclick = function() {
      ins_ticketModal.style.display = "none";
    }

  //Close Update Ticket Modal
    upd_closeStep1.onclick = function() {
      upd_ticketModal.style.display = "none";
    }

    upd_closeStep2.onclick = function() {
        upd_ticketModal.style.display = "none";
    }

  //Close Delete Ticket Modal
    close_delModal.onclick = function() {
      del_ticketModal.style.display = "none";
    }

    cancel.onclick = function() {
      del_ticketModal.style.display = "none";
    }

// ------------- CLOSE MODAL w/ Window
  // When the user clicks anywhere outside of the modal, close it
  
  window.onclick = function(event) {
    if ( 
      event.target == ins_profileModal || 
      event.target == upd_profileModal || 
      event.target == ins_ticketModal || 
      event.target == upd_ticketModal || 
      event.target == del_ticketModal ) {

      ins_profileModal.style.display = "none";
      upd_profileModal.style.display = "none";
      ins_ticketModal.style.display = "none";
      upd_ticketModal.style.display = "none";
      del_ticketModal.style.display = "none";
    }
  }

// ----- Generating Event Listeners for my accordion buttons

//Loop through Update ticket buttons and create event listeners for each.
for (let i = 0; i < upd_ticketBtns.length; i++) {

  upd_ticketBtns[i].addEventListener("click", function() {
      //Display the modal on click. 
      upd_ticketModal.style.display = "block";
      upd_ticketForm1.style.display = "block";
      upd_ticketForm2.style.display = "none";

      //Setting the value attribute 
      modal_updticketID.setAttribute("value", `${upd_ticketID[i].value}`);
      modal_updticketName.setAttribute("value", `${upd_ticketName[i].value}`);
      modal_updissueDate.setAttribute("value", `${upd_issueDate[i].value}`);
      modal_updexpDate.setAttribute("value", `${upd_expiryDate[i].value}`);
      modal_updticketNum.setAttribute("value", `${upd_ticketNum[i].value}`);
  });
}

// Loop through Delete Ticket buttons and create event listeners for each. 
for (let i = 0; i < del_ticketBtns.length; i++) {

  del_ticketBtns[i].addEventListener("click", function() {
      //Display the modal on click. 
      del_ticketModal.style.display = "block";
      del_ticketForm.style.display = "block";

      //Setting the value attribute
      modal_delticketID.setAttribute("value", `${del_ticketID[i].value}`);
  });
}