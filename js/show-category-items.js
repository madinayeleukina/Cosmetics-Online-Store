//shows all items
showCategoryItems(-1)

//shows items of certain category or all items
function showCategoryItems(categoryid) {
	var allitems = document.getElementsByClassName("itemsList-item");
	var i;
	
	if (categoryid==-1) {
		for (i=0;i<allitems.length;i++) allitems[i].style.display = "flex";
	} else {
		for (i=0;i<allitems.length;i++) allitems[i].style.display = "none";
		
		var categoryitems = document.getElementsByClassName("category-"+categoryid);
		for (i=0;i<categoryitems.length;i++) categoryitems[i].style.display = "flex";		
	}
}