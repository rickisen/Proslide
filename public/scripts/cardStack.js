"use strict"
var cardHeight = 0; // should preffably be higher than the highest card
var cardHeadHeightMax = 32;
var cardHeadHeightMin = 5; 
var cardHeadHeight = ( cardHeadHeightMax + cardHeadHeightMin ) / 2 ;

setupPos(); // sets the correct position prop on all relevant elements
addKeyEvents();
stackAll(); // Shows the head of all the cards in the stack, and adds eventlisteners to the cards 

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

// Stack all cards in all stacks, and add relevant listeners to the cards.
// Used when seting up the script, and when the user clicks a card that is already revieled
function stackAll() {
	var stacks = document.getElementsByClassName("stack");
	for (var i = 0, len = stacks.length; i < len; i++) {
		// Get all cards in this stack
		var cards = stacks[i].getElementsByClassName("card"); 

		// calculate the optimal card height
		cardHeight = calcOptCardHieght(cards.length, 90); 

		// calculate this stacks height
		var stackHeight = cardHeight - cardHeadHeightMax + (cardHeadHeightMax * stacks[i].children.length ); 
		stacks[i].style.height = "" + stackHeight + "px"; 
		
		// // loop through all cards and stack them, and add listeners to reviel them
		// for (var i = 0, len = cards.length; i < len; i++) {
		// 	cards[i].style.top = "" + (cardHeadHeight * i ) + "px";

		// 	// replace the listeners, 
		// 	cards[i].getElementsByTagName("header")[0].removeEventListener("click", reVeilListener);
		// 	cards[i].getElementsByTagName("header")[0].removeEventListener("click", stackAll);
		// 	cards[i].getElementsByTagName("header")[0].addEventListener("click", reVeilListener);

		// 	// Unmark the card as revield in css
		// 	cards[i].className = cards[i].className.replace( new RegExp('(?:^|\\s)reVeiledCard(?!\\S)') ,'');

		// 	// minimize it, and make sure its scroll is reset
		// 	cards[i].style.height = "" + Math.round(cardHeadHeight) + "px";
		// 	cards[i].scrollTop = 0;
		// 	cards[i].style.overflowY = "hidden";
		// }

		// reveil the last card in the stack
		reVielCard(cards[cards.length - 1]); 
	}
}

function reVielCard1(cardToReveil) {
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

		// allways reset the scroll
		siblings[i].scrollTop = 0;

		if (siblings[i] == cardToReveil) {
			foundElem = true; // so that the next card will be moved down
			// class the card as the currently reveiled card, give it the correct height, add suitable listener
			siblings[i].className += " reVeiledCard"
			siblings[i].style.height = "" + cardHeight + "px";
			siblings[i].getElementsByTagName("header")[0].removeEventListener("click", reVeilListener); 
			siblings[i].getElementsByTagName("header")[0].addEventListener("click", stackAll);
			siblings[i].style.overflowY = "auto"; // show scrollbars if need be
		} else {
			// Unmark the card as revield
			siblings[i].className = siblings[i].className.replace( new RegExp('(?:^|\\s)reVeiledCard(?!\\S)') ,'');
			siblings[i].style.height = "" + Math.round(cardHeadHeight) + "px";
			siblings[i].getElementsByTagName("header")[0].removeEventListener("click", stackAll); 
			siblings[i].getElementsByTagName("header")[0].addEventListener("click", reVeilListener);
			siblings[i].style.overflowY = "hidden";// never show scrollbars on hidden cards
		}
	}

	// set the new height of the parent stack
	var activeStackHeight = ( cardHeight - cardHeadHeight ) + ( cardHeadHeight * ( cardToReveil.parentNode.children.length )) ; 
	cardToReveil.parentNode.style.height = "" + activeStackHeight + "px"; 
}

function reVielCard(cardToReveil) {
	var siblings = cardToReveil.parentNode.children;
	// find the cards position amongs his sibblings
	for (var i = 0, len = siblings.length; i < len; i++) {
		if (siblings[i] == cardToReveil) {
			var ctrPos = i ; 
			break;
		}
	}

	// first move all cards that are "beneth" our Card To Reviel (CTR).
	// and change those element's "settings"
	for (var i = 0; i < ctrPos; i++ ) {
		siblings[i].style.top = "" + i * cardHeadHeightMax + "px";
		// siblings[i].style.top = "" + calcHeadHeight(i , ctrPos) + "px";
		handleStackedCardSettings(siblings[i]); 
	}

	// our CTR also needs to move down so that the card directly beneth it is seen
	siblings[ctrPos].style.top = "" + i * cardHeadHeightMax + "px";
	handleCtrSettings(siblings[ctrPos]); 

	// if the CTR was the the last card in the stack (the one on top)
	// our work here is done
	if (ctrPos == siblings.length - 1){
		return; 
	}

	// then move the next card down enough so that the whole CTR is seen
	siblings[ctrPos + 1].style.top = "" + cardHeight + "px";

	for (var i = siblings.length - 1 ; i > ctrPos ; i-- ) {
		// siblings[i].style.top = "" + calcHeadHeight(i , sibblings.length) + "px";
		var top = cardHeight - cardHeadHeightMax +  ( i * cardHeadHeightMax ); 
		siblings[i].style.top = "" + top + "px";
		handleStackedCardSettings(siblings[i]); 
	}
}

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

// Unmarks the card as revield
function handleStackedCardSettings(stackedCard) {
	stackedCard.className = stackedCard.className.replace( new RegExp('(?:^|\\s)reVeiledCard(?!\\S)') ,'');
	stackedCard.style.height = "" + cardHeadHeightMax + "px"; 
	stackedCard.getElementsByTagName("header")[0].removeEventListener("click", stackAll); 
	stackedCard.getElementsByTagName("header")[0].addEventListener("click", reVeilListener);
	stackedCard.style.overflowY = "hidden";// never show scrollbars on stacked cards
}

// Marks a card as revield, CTR = Card To Reviele
function handleCtrSettings(cardToReveil) {
	cardToReveil.className += " reVeiledCard"
	cardToReveil.style.height = "" + cardHeight + "px";
	cardToReveil.getElementsByTagName("header")[0].removeEventListener("click", reVeilListener); 
	cardToReveil.getElementsByTagName("header")[0].addEventListener("click", stackAll);
	cardToReveil.style.overflowY = "auto"; // show scrollbars if need be
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

// function for calculating how much of a cards 
// head to be visible in a stack, 
// the fruther away a card is from the revieled 
// card the less we should see of its head
function calcHeadHeight(currentPos, LastPos ) {
	var rangeMax = cardHeadHeight - cardHeadHeightMin; 
	var rangeMin = rangeMax / LastPos;
	return rangeMin * currentPos + cardHeadHeightMin; 
}

function calcOptCardHieght(siblings, aboveBellow = 0) {
	var windowHeight = "innerHeight" in window 
		? window.innerHeight
		: document.documentElement.offsetHeight; 

	return windowHeight - aboveBellow - (siblings * cardHeadHeight); 
}

