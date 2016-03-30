var cardHeight = 500;
var cardHeadHeight = 50;

setupPos(); // sets the correct position prop on all relevant elements
spreadAll(); // Shows the head of all the cards in the stack, and adds eventlisteners to the cards

function reVeilListener(event) {
	elem = event.target;

	// loop through elem's sibblings and reviel 
	// elem by moving the sibling after him down.
	var siblings = elem.parentNode.children;
	var foundElem = false;
	for (var i = 0, len = siblings.length; i < len; i++) {
		if (foundElem) {
			siblings[i].style.top = "" + ((cardHeadHeight * i ) + cardHeight - cardHeadHeight ) + "px";
		} else {
			siblings[i].style.top = "" + (cardHeadHeight * i ) + "px";
		}

		if (siblings[i] == elem) {
			foundElem = true;
		}
	}

	// set the new height of the parent
	var activeStackHeight = ( cardHeight - cardHeadHeight ) * 2 + ( cardHeadHeight * ( elem.parentNode.children.length )) ; 
	elem.parentNode.style.height = "" + activeStackHeight + "px"; 

	elem.removeEventListener("click", reVeilListener); 
	elem.addEventListener("click", spreadAll);
}

// add event listners to the cards, and reviel the head of them
function spreadAll() {
	stacks = document.getElementsByClassName("stack");
	for (var i = 0, len = stacks.length; i < len; i++) {
		cards = stacks[i].getElementsByClassName("card"); 
		for (var i = 0, len = cards.length; i < len; i++) {
			cards[i].style.top = "" + (cardHeadHeight * i ) + "px";

			if (i < len - 1) {
				cards[i].addEventListener("click", reVeilListener);
			} else {
				cards[i].addEventListener("click", spreadAll);
			}
		}
	}

	var normalStackHeight = ( cardHeight - cardHeadHeight ) + ( cardHeadHeight * ( elem.parentNode.children.length )) ; 
	elem.parentNode.style.height = "" + normalStackHeight + "px"; 
}

function setupPos() {
	stacks = document.getElementsByClassName("stack");
	for (var i = 0, len = stacks.length; i < len; i++) {
		var stackHeight = cardHeight + ( cardHeadHeight * ( stacks[i].children.length - 1)); 

		stacks[i].style.position = "relative";
		stacks[i].style.height = "" + stackHeight + "px";

		cards = stacks[i].getElementsByClassName("card");
		for (var i = 0, len = cards.length; i < len; i++) {
			cards[i].style.position = "absolute";
		}
	}
}
