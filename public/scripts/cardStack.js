"use strict"
var cardHeight = 900; // should preffably be higher than the hogest card
var cardHeadHeight = 60;

setupPos(); // sets the correct position prop on all relevant elements
addKeyEvents();
stackAll(); // Shows the head of all the cards in the stack, and adds eventlisteners to the cards 

function reVeilListener(event) {
	reVielCard(findParentCard(event.target));
}

// recursive function that tries to return the first 
// parentNode that has the class "card"
function findParentCard(suspect) {
	for (var i = 0, len = suspect.classList.length; i < len; i++) {
		if (suspect.classList.contains("card")) {
			return suspect;
		} else {
			return findParentCard(suspect.parentNode);
		}
	}

	return findParentCard(suspect.parentNode);
}

// Stack all cards in all stacks, and add relevant listeners to the cards.
// Used when seting up the script, and when the user clicks a card that is already revieled
function stackAll() {
	var stacks = document.getElementsByClassName("stack");
	for (var i = 0, len = stacks.length; i < len; i++) {
		// calculate this stacks height, or what height it should have
		var normalStackHeight = cardHeadHeight * ( stacks[i].children.length ); 
		stacks[i].style.height = "" + normalStackHeight + "px"; 

		// add listeners on the cards, and move the cards so that they stack
		var cards = stacks[i].getElementsByClassName("card"); 
		for (var i = 0, len = cards.length; i < len; i++) {
			cards[i].style.top = "" + (cardHeadHeight * i ) + "px";

			// replace the listeners, 
			cards[i].getElementsByTagName("header")[0].removeEventListener("click", reVeilListener);
			cards[i].getElementsByTagName("header")[0].removeEventListener("click", stackAll);
			cards[i].getElementsByTagName("header")[0].addEventListener("click", reVeilListener);

			// Unmark the card as revield in css
			cards[i].className = cards[i].className.replace( new RegExp('(?:^|\\s)reVeiledCard(?!\\S)') ,'');

			cards[i].style.height = "" + cardHeadHeight + "px";
		}
	}
}

function setupPos() {
	var stacks = document.getElementsByClassName("stack");
	for (var i = 0, len = stacks.length; i < len; i++) {
		stacks[i].style.position = "relative";

		var zIndex = 1;
		var cards = stacks[i].getElementsByClassName("card");
		for (var i = 0, len = cards.length; i < len; i++) {
			cards[i].style.position = "absolute";
			cards[i].style.zIndex = zIndex++;
		}
	}
}

function reVielCard(cardToReveil) {
	// loop through cardToReveil's siblings and reviel 
	// "cardToReveil" by moving its sibling after him 
	// down the correct amount of pixles
	var siblings = cardToReveil.parentNode.children;
	var foundElem = false;
	for (var i = 0, len = siblings.length; i < len; i++) {
		if (foundElem) {
			siblings[i].style.top = "" + ((cardHeadHeight * i ) + cardHeight - cardHeadHeight ) + "px";
		} else {
			siblings[i].style.top = "" + (cardHeadHeight * i ) + "px";
		}

		if (siblings[i] == cardToReveil) {
			foundElem = true;
			// mark the card as the currently reveiled card 
			siblings[i].className += " reVeiledCard"
			siblings[i].style.height = "" + cardHeight + "px";
			siblings[i].getElementsByTagName("header")[0].removeEventListener("click", reVeilListener); 
			siblings[i].getElementsByTagName("header")[0].addEventListener("click", stackAll);
		} else {
			// Unmark the card as revield
			siblings[i].className = siblings[i].className.replace( new RegExp('(?:^|\\s)reVeiledCard(?!\\S)') ,'');
			siblings[i].style.height = "" + cardHeadHeight + "px";
			siblings[i].getElementsByTagName("header")[0].removeEventListener("click", stackAll); 
			siblings[i].getElementsByTagName("header")[0].addEventListener("click", reVeilListener);
		}
	}

	// set the new height of the parent stack
	var activeStackHeight = ( cardHeight - cardHeadHeight ) + ( cardHeadHeight * ( cardToReveil.parentNode.children.length )) ; 
	cardToReveil.parentNode.style.height = "" + activeStackHeight + "px"; 
}

function reVielNextCard(direction) {
	var reVeiledCard = document.getElementsByClassName("reVeiledCard")[0];
	var siblings = reVeiledCard.parentNode.children; 

	for (var i = 0, len = siblings.length; i < len; i++) {
		if (siblings[i] == reVeiledCard) {
			if (direction == "down" && len > i + 1 ) {
				reVielCard(siblings[i + 1]); 
			} else if (direction == "up" && i - 1 >= 0 ){
				reVielCard(siblings[i - 1]); 
			}
		}
	}
}

function addKeyEvents() {
	window.addEventListener("keyup", function(event){
		// adds arrows, and vi-key bindings
		switch (event.keyCode) {
			case 38 :
			case 75 :
				reVielNextCard("up"); 
				break;
			case 40 :
			case 74 :
				reVielNextCard("down"); 
				break;
			
			default:
				
		}
	}, false); 
}
