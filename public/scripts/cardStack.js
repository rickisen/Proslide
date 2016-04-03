"use strict"
var cardHeight = 750; 
var cardHeadHeightMax = 32;
var cardHeadHeightMin = 5; 
var cardHeadHeight = ( cardHeadHeightMax + cardHeadHeightMin ) / 2 ;

init(); // sets the correct position prop on all relevant elements
addKeyEvents();

function init() {
	var stacks = document.getElementsByClassName("stack");
	for (var i = 0, len = stacks.length; i < len; i++) {
		stacks[i].style.position = "relative";

		// get all cards in this stack, needed for calculating its height
		var cards = stacks[i].getElementsByClassName("card");

		// calculate this stacks height
		var stackHeight = cardHeight - cardHeadHeightMax + (cardHeadHeightMax * stacks[i].children.length ); 
		stacks[i].style.height = "" + stackHeight + "px"; 

		// loop throough all cards and give them an incrmenting z-index, and event listeners
		var zIndex = 1;
		for (var i = 0, len = cards.length; i < len; i++) {
			cards[i].style.position = "absolute";
			cards[i].style.zIndex = zIndex++;
			cards[i].getElementsByTagName("header")[0].addEventListener("click", reVeilListener);
		}

		// finaly stack all cards by calling the reveil card 
		// function on the last card in the stack
		reVielCard(cards[cards.length - 1]); 
	}
}

function reVielCard(cardToReveil) {
	var siblings = cardToReveil.parentNode.children;

	// if this card already is revieled, the user 
	// probably pushed the head of the revieled card in 
	// an attempt to minimize it, so we reviel the 
	// last card in the stack instead
	if (cardToReveil.classList.contains("reVeiledCard")) {
		cardToReveil = siblings[siblings.length - 1]; 
	}

	// find the cards position amongs his siblings
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
	siblings[ctrPos + 1].style.top = "" + cardHeight - cardHeadHeight + "px";
	for (var i = ctrPos + 1 ; i < siblings.length; i++ ) {
		let top = cardHeight - cardHeadHeightMax +  ( i * cardHeadHeightMax ); 
		siblings[i].style.top = "" + top + "px";
		handleStackedCardSettings(siblings[i]); 
	}

}

function reVeilListener(event) {
	// the target could be any element inside the 
	// element that had the listener attached to it.
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

// Marks and styles a card as revield, CTR = Card To Reviele
function handleCtrSettings(cardToReveil) {
	cardToReveil.className += " reVeiledCard"
	cardToReveil.style.height = "" + cardHeight + "px";
	cardToReveil.style.overflowY = "auto"; // show scrollbars if need be
}

// Unmarks and styles the card as revield
function handleStackedCardSettings(stackedCard) {
	stackedCard.className = stackedCard.className.replace( new RegExp('(?:^|\\s)reVeiledCard(?!\\S)') ,'');
	stackedCard.style.height = "" + cardHeadHeightMax + "px"; 
	stackedCard.style.overflowY = "hidden";// never show scrollbars on stacked cards
	stackedCard.scrollTop = 0;// allways reset the scroll
}

function reVielNextCard(direction) {
	var reVeiledCard = document.getElementsByClassName("reVeiledCard")[0];
	var siblings = reVeiledCard.parentNode.children; 

	// find the currently revieled card and reviel his nieghbor
	// in a direction.
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
		// adds arrows
		switch (event.keyCode) {
			case 38 :
				reVielNextCard("up"); 
				break;
			case 40 :
				reVielNextCard("down"); 
				break;
		}
	}, false); 
}

// calculates a "fitting" height of a card based on the 
// current window height and a specified offset
function calcOptCardHieght(siblings, aboveBellow = 0) {
	var windowHeight = "innerHeight" in window 
		? window.innerHeight
		: document.documentElement.offsetHeight; 

		return windowHeight - aboveBellow - (siblings * cardHeadHeight); 
}

