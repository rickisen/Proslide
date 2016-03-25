"use strict"

// first get the XML-file ====================
var ajax = new XMLHttpRequest();
ajax.onreadystatechange = recieveXml() ;
ajax.open("GET", "/xml/Projects.xml", false); // make a syncronos call
ajax.send();
// xml = ajax.responseXML;

function recieveXml() {
	if (!ajax.readyState == 4 || !ajax.status == 200) {
		throw new Error("XML file not recieved"); 
	}
}

// Add listners to all the buttons ====================
var buttons = document.getElementsByClassName("sliderBtn"); 
for (var i = 0, len = buttons.length; i < len; i++) {
	buttons[i].addEventListener("click", function(event){
		var projId = event.target.getAttribute("projId");
		var direction = event.target.getAttribute("direction");

		slideImage(projId, direction);
	}); 
	
}

function slideImage(projId, direction = "next") {
	// function that loads the next image in a slider.
	// direction can be next, prev, first and last.
	var slider = getProjSlider(projId);
	var images = getProjImagesFromXml(projId);
	var currentImage = getProjCurrentImage(projId);

	switch (direction) {
		case 'next':
			var nextImageId = parseInt(currentImage.getAttribute("xmlId")) + 1;
			break;
		case 'prev':
			var nextImageId = parseInt(currentImage.getAttribute("xmlId")) - 1;
			break;
		default:
			var nextImageId = parseInt(currentImage.getAttribute("xmlId")) + 1;
	}

	// fetch the next image
	for (var i = 0, len = images.length; i < len; i++) {
		if (images[i].id == nextImageId) {
			var nextImage = images[i];
		} 
	}

	console.log(nextImageId); 
	// replace the current image
	currentImage.src = nextImage.getElementsByTagName("src")[0].innerHTML;
}

// Project related functions ====================
// Should probably be rewritten more OOP-style

function getProjCurrentImage(projId) {
	var proj = document.getElementById(projId) ;
	if (proj) {
		var image = proj.getElementsByTagName("img")[0];
	}

	if ( proj && image ){
		return image;
	}

	return false;
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

function getProjSlider(projId) {
	var projectElem = document.getElementById(projId);

	if (projectElem.children) {
		for (var i = 0, len = projectElem.children.length; i < len; i++) {
			if( projectElem.children[i].class == "slider"){
				return projectElem.children[i]; 
			}
		}
	}

	return false;
}
