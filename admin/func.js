// JavaScript Document
function cancelEntry() {
	window.location.href="admin.php";
}
function backToList() {
	window.location.href="admin.php?content=listProd";
}
function chkValsAddCat() {
	var frm = document.forms.newCat;
	var catName = frm.category.value;
	var rtnVal = true;
	if (catName=="") {
		rtnVal = false;
		alert("Please enter a new category.");
	}
	return rtnVal;
}
function chkValsAddProd() {
	var frm = document.forms.newProd;	
	var prodName = frm.prodName.value;
	var prodPrice = frm.price.value;
	var prodID = frm.prodID.value;
	var rtnVal = true;
	var prodChg;
	if (prodName=="" || prodPrice=="" || prodID=="") {
		rtnVal = false;
		if (prodID=="") {
			prodChg = "Product ID";
			frm.prodID.select();
			frm.prodID.focus();
		} else if (prodName=="") {
			prodChg = "Product Name";
			frm.prodName.select();
			frm.prodName.focus();
		} else {
			prodChg = "Product Price";
			frm.price.select();
			frm.price.focus();
		}
		alert ("Forgot to enter a value for "+prodChg);
	} else {
		if (isNaN(prodPrice)) {
			rtnVal = false;
			alert("Invalid product price entered.");
			frm.price.select();
			frm.price.focus();
		} else if (Number(prodPrice) <=0) {
			rtnVal = false;
			alert("Invalid product price entered. Please enter a positive value.");
			frm.price.select();
			frm.price.focus();
		}
	}
	return rtnVal;
}
function chkValsEditProd() {
	//alert("Checking values ");
	var frm = document.forms.editProd;
	var prodName = frm.prodName.value;
	var prodPrice = frm.prodPrice.value;
	var rtnVal = true;
	if (prodName=="" || prodPrice=="") {
		rtnVal = false;
		if (prodName=="") {
			alert("Please enter the product's name");
			frm.prodName.select();
			frm.prodName.focus();
		} else {
			alert("Please enter the product's price.");
			frm.prodPrice.select();
			frm.prodPrice.focus();
			//alert("Return false");
		}		
	}
	if (isNaN(prodPrice)) {
		alert("Price is invalid.  Please enter a numerical value for the price.");
		frm.prodPrice.select();
		frm.prodPrice.focus();
		rtnVal = false;
	} else if (Number(prodPrice) <= 0) {
		alert("Price is either 0 or negative.  Please set a valid price for the product.");
		frm.prodPrice.select();
		frm.prodPrice.focus();
		rtnVal = false;
	}
	//alert("rtnVal="+rtnVal);
	return rtnVal;
}