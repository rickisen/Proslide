
// get the URI ====================
var ajax = new XMLHttpRequest();
ajax.onreadystatechange = function() {
	if (ajax.readyState == 4 && ajax.status == 200) {
		console.log("OK, fil inladdad");
		parseXML();
	}
}


ajax.open("GET", "/books.xml", true);
ajax.send();

function parseXML() {
	console.log("hej hej ");

	var xml = ajax.responseXML;
	var books = xml.getElementsByTagName("book");
	for (var prop in books) {
		if(books[prop].children){
			console.log(books[prop].children);

			var div = document.createElement("div");
			// div.textContent = books[prop].children
			for (var i = 0, len = books[prop].children.length; i < len; i++) {
				var p = document.createElement("p");
				p.textContent = books[prop].children[i].nodeName + ": " + books[prop].children[i].textContent
				div.appendChild(p);
			}
			document.getElementsByTagName("body")[0].appendChild(div);
		}
	}
}
// var img = document.getElementById("bild");
// img.src = "https://www.google.se/images/branding/googlelogo/2x/googlelogo_color_272x92dp.png";

// Handle keypresses ====================
// document.addEventListener("keydown",handleKeyDown);
// function handleKeyDown(event) {
// 	console.log(event.keyCode);
// }

