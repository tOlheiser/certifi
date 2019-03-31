var acc = document.getElementsByClassName("accordion");
var exp = document.getElementsByClassName("expire");

// Get the modal
var imgContainer = document.getElementsByClassName('imgModal');

// Get the image and insert it inside the modal - use its "alt" text as a caption
var img = document.getElementsByClassName('ticketImg'); //store the image in a variable.
var modalImg = document.getElementsByClassName("img01"); //store the modal image in a variable
var captionText = document.getElementsByClassName("caption"); // Grab the caption text ---> Will have to find a way to grab the ticket name
var span = document.getElementsByClassName("closeImg"); //Grab the span button

var tickName = document.getElementsByClassName("tickName");

//loop over the accordions and add event listeners. 
for (let i = 0; i < acc.length; i++) {
    
  console.log(tickName);

  acc[i].addEventListener("click", function() {
    /* Toggle between adding and removing the "active" class,
    to highlight the button that controls the panel */
    this.classList.toggle("active");
    //console.log(this.childNodes[3]);
    var expireDate = this.childNodes[1]; //child node WAS 3 before i echoed the data. 
    //console.log(this.childNodes[1]); testing
    
    var panel = this.nextElementSibling;
    //console.log(panel);
    if (panel.style.display === "block") {
      panel.style.display = "none";
      expireDate.style.display = "block";
    } else {
      panel.style.display = "block";
      expireDate.style.display = "none";
    }
  });

  //Create an event listener for each image, so that they expand into a modal on click.
  img[i].addEventListener("click", function() {
    imgContainer[i].style.display = "block"; 
    modalImg[i].src = img[i].src;
    captionText[i].innerHTML = tickName[i].value;
  });

  span[i].addEventListener("click", function() {
    imgContainer[i].style.display = "none"; 
  });

}
