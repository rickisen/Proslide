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
		var projId    = findParent(event.target, "slider").getAttribute("projId");
		var direction = findParent(event.target, "sliderBtn").getAttribute("direction");

		slideImage(projId, direction);
	}); 
	
}

// recursive function that tries to return the first 
// parentNode that has a given class 
function findParent(suspect, parentClass) {
	if (suspect.classList.contains(parentClass)) {
		return suspect;
	} else if (suspect != document) {
		return findParent(suspect.parentNode, parentClass);
	} else {
		return null;
	}
}

// add listeners to the arrow keys
window.addEventListener("keyup", function(event){
	var projId = activeProj(); 
	switch (event.keyCode) {
		case 39 :
			if (projId) {
				slideImage(projId, "next"); 
			}
			break;
		case 37 :
			if (projId) {
				slideImage(projId, "prev"); 
			}
			break;
	}
}, false); 

function activeProj() {
	var activeCard = document.getElementsByClassName("reVeiledCard")[0]; 
	var slider = activeCard.getElementsByClassName("slider"); 
	if (slider.length > 0 ){
		return slider[0].getAttribute("projId") ; 
	} else {
		return null;
	}
}

function slideImage(projId, direction = "next") {
	// function that loads the next image in a slider.
	// direction can be next or prev.
	var proj         = document.getElementById("proj-" + projId) ;
	var slider       = proj.getElementsByClassName("slider")[0];
	var currentImage = slider.getElementsByClassName("sliderImage")[0];
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
	currentImage.style.backgroundImage = "url(" + nextImage.getElementsByTagName("src")[0].innerHTML + ")";
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
