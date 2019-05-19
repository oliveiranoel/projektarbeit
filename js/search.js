function search() {
	var input = document.getElementById('myInput');
	var filter = input.value.toUpperCase();

	var accordion = document.getElementById("accordion");
	var cards = accordion.getElementsByClassName('card');

	// Loop through all items, and hide those who don't match the search
	for (i = 0; i < cards.length; i++) {
		var cardHeader = cards[i].getElementsByClassName("card-header")[0];
		var cardTitle = cardHeader.getElementsByClassName("card-title")[0];
		var button = cardTitle.getElementsByClassName("search")[0];

		var txtValue = button.textContent || button.innerText;

		if (txtValue.toUpperCase().indexOf(filter) > -1) {
			cards[i].style.display = "";
		} else {
			cards[i].style.display = "none";
		}
	}
}