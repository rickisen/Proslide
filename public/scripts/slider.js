"use strict"

// First get the XML-file ====================
var ajax = new XMLHttpRequest();
ajax.onreadystatechange = recieveXml() ;
ajax.open("GET", "/xml/Projects.xml", true); 
ajax.send();

// Add listners to all the buttons ====================
var buttons = document.getElementsByClassName("sliderBtn"); 
for (var i = 0, len = buttons.length; i < len; i++) {
	buttons[i].addEventListener("click", function(event){
		var projId = event.target.getAttribute("projId");
		var direction = event.target.getAttribute("direction");

		slideImage(projId, direction);
	}); 
	
}

// FUNCTIONS ========================================
//
function slideImage(projId, direction = "next") {
	// function that loads the next image in a slider.
	// direction can be next or prev.
	var proj         = document.getElementById("proj-" + projId) ;
	var slider       = proj.getElementsByClassName("slider")[0];
	var currentImage = slider.getElementsByTagName("img")[0];
	var images       = getProjImagesFromXml(projId);

	var currentImageId = currentImage.getAttribute("xmlId")

	// find the current-image's array index in the images array
	for (var i = 0, len = images.length; i < len; i++) {
		if( images[i].id ==  currentImageId ){
			var currentImageIndex = i ;
 		}
	}

	if ( direction == "next" ) {
		var nextImageIndex = currentImageIndex + 1;
		nextImageIndex = nextImageIndex > images.length - 1 ? 0 : nextImageIndex;
	} else if ( direction == "prev" ) {
		var nextImageIndex = currentImageIndex - 1;
		nextImageIndex = nextImageIndex < 0 ? nextImageIndex = images.length - 1: nextImageIndex ;
	} else {
		return; 
	}

	var nextImage = images[nextImageIndex];

	// replace the current Images attributes to the next image
	currentImage.src = nextImage.getElementsByTagName("src")[0].innerHTML;
	currentImage.setAttribute("xmlid", nextImage.id); 
	slider.getElementsByClassName("title")[0].textContent = nextImage.getElementsByTagName("title")[0].innerHTML;
	slider.getElementsByClassName("caption")[0].textContent = nextImage.getElementsByTagName("caption")[0].innerHTML;

}

function getProjImagesFromXml(projId) {
	var projects = ajax.responseXML.getElementsByTagName("project"); 

	// maybe replace with getElementById
	for (var project in projects) {
		if(projects[project].id == projId){
			var foundProject = projects[project];
			break;
		}
	}

	return foundProject.getElementsByTagName("image"); 
}

function recieveXml() {
	if (!ajax.readyState == 4 || !ajax.status == 200) {
		throw new Error("XML file not recieved"); 
	}
}
