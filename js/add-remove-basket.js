//adds item to basket, prints result message
function addToBasket(itemid) {
	var url = "basket-insert.php?itemid=" + itemid;
	var request = new XMLHttpRequest();
	request.open("GET",url);
	request.onload = function() {
		if (request.status === 200 && request.responseText == "true") {
			alert("Added to basket");
			location.reload();
		}
		else {
			alert("Not added to basket");
		}
	};
	request.send();
}

//adds given number of item to basket, prints result message
function addToBasketNumber(itemid) {
	var url = "basket-insert.php?itemid=" + itemid + "&number=" + document.getElementById("number").value;
	var request = new XMLHttpRequest();
	request.open("GET",url);
	request.onload = function() {
		if (request.status === 200 && request.responseText == "true") {
			alert("Added to basket");
			location.reload();
		}
		else {
			alert("Not added to basket");
		}
	};
	request.send();
}

//removes item from basket
function removeFromBasket(itemid) {
	var url = "basket-delete.php?itemid=" + itemid;
	var request = new XMLHttpRequest();
	request.open("GET",url);
	request.onload = function() {
		if (request.status === 200 && request.responseText == "true") {
			location.reload();
		}
		else {
			alert("Not removed to basket");
		}
	};
	request.send();
}