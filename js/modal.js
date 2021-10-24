	//opens .modal if #openmodal is clicked
	document.getElementById('openmodal').addEventListener("click", function() {
		document.querySelector('.modal').style.display = "flex";
	});

	//closes .modal if .closemodal is clicked
	document.querySelector('.closemodal').addEventListener("click", function() {
		document.querySelector('.modal').style.display = "none";
	});					