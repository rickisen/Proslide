"use strict"

// first get the XML-file ====================
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

	if (direction = "next") {
		var nextImageId = parseInt(currentImage.getAttribute("xmlId")) + 1;
		if (nextImageId > images.length - 1) {
			nextImageId = 0;
		}
	}else if (direction = "prev") {
		var nextImageId = parseInt(currentImage.getAttribute("xmlId")) - 1;
		if (nextImageId <  0 ) {
			nextImageId = images.length - 1;
		}
	} else {
		return; 
	}

	// fetch the next image
	for (var i = 0, len = images.length; i < len; i++) {
		if (images[i].id == nextImageId) {
			var nextImage = images[i];
		} 
	}

	// replace the current Image/slide
	currentImage.src = nextImage.getElementsByTagName("src")[0].innerHTML;
	currentImage.setAttribute("xmlid", nextImage.id); 
	slider.getElementsByClassName("caption")[0].textContent = nextImage.getElementsByTagName("caption")[0].innerHTML;

}

function getProjImagesFromXml(projId) {
	var projects = ajax.responseXML.getElementsByTagName("project"); 

	// maybe replace with getElementById
	for (var project in projects) {
		if(projects[project].id = projId){
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
