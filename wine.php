 <?php
 session_start();
  
 ?> 

<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Wine Search</title>
<!-- 	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/css/bootstrap.min.css">
 --><link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet" href="wine.css">

</head>
<body>

	  <?php 
      include 'nav.php'; 
      ?> 
          <?php
         	$error="";
         	$txt="";

		   if(!isset($_SESSION['logged_in']) || !$_SESSION['logged_in']) {
  	 		  header('Location: wine-login.php');
		  } 
		  else {
 		      $txt = "Welcome to the member's area";
		       }
	      ?> 
   	    
	<div class="container-fluid">

		<div class="row">
			<h1 class="col-12 mt-4">Wine Recommendation</h1>

 			<div style="padding:15px"><?php echo $txt;?></div>

		</div> <!-- .row -->

		<div class="row">

			<form action="" method="" class="col-12" id="search-form">
				<div class="form-row">

					<div class="col-12 mt-4 col-sm-4 col-lg-2 autocomplete" >
						<label for="search-id" class="sr-only">Name Of the Wine</label>
						<input type="text" name="" class="form-control" id="search-id" placeholder="Name of The Wine" required="">
					</div>

					<div class="col-12 mt-4 col-sm-4 col-lg-2">
						<label for="limit-id" class="sr-only">Max price</label>
						 
						<input type="number" name="" class="form-control" id="limit-id" placeholder="Max Price" required="">

    					</div>

					<div class="col-12 mt-4 col-sm-4 col-lg-2">
						<label for="number-id" class="sr-only">Numbers</label>
						<input type="number" name="" class="form-control" id="number-id" placeholder="Number Of Recommend" required="">
					</div>

					<div class="col-12 mt-4 col-sm-auto">
						<button type="submit" class="btn btn-block">Search</button>
					</div>

				</div> <!-- .form-row -->
			</form>

		</div> <!-- .row -->

		<div class="row">

			<table class="table table-responsive table-striped col-12 mt-4">
				<thead>
					<tr>
						<th>Image</th>
						<th>Title</th>
						<th>Price</th>
						<th>Description</th>	 
					</tr>
				</thead>
				<tbody>
					<tr>
						<td>
					    <img src="https://spoonacular.com/productImages/430475-312x231.jpg">
						</td>
						<td>NV The Big Kahuna Merlot</td>
						<td>6.99</td>
						<td>A ripe and rounded Merlot with notes of plum, blackberry, and hint of spice .</td>
						 
					</tr>
				</tbody>
			</table>
		</div> <!-- .row -->

		<div>
			<span style="color:red" id ="divid"></span> 
		</div>

	</div> <!-- .container-fluid -->

<script>
// When the form is submitted, the magic happens
document.querySelector("#search-form").onsubmit = function() {
	let searchTermInput = document.querySelector("#search-id").value.trim();
	let limitInput = document.querySelector("#limit-id").value;
	let numRec = document.querySelector("#number-id").value;

	console.log(searchTermInput);
	console.log(limitInput);
	console.log(numRec);

	var data = null;

	var xhr = new XMLHttpRequest();
	 
	xhr.addEventListener("readystatechange", function () {
		if (this.readyState === this.DONE) {
			console.log(this.responseText);
		}
});

xhr.open("GET", "https://spoonacular-recipe-food-nutrition-v1.p.rapidapi.com/food/wine/recommendation?maxPrice=" + limitInput + "&number=" + numRec + "&wine=" + searchTermInput);

// xhr.open("GET", "https://spoonacular-recipe-food-nutrition-v1.p.rapidapi.com/food/wine/recommendation?maxPrice=50&number=3&wine=merlot");

xhr.setRequestHeader("x-rapidapi-host", "spoonacular-recipe-food-nutrition-v1.p.rapidapi.com");
xhr.setRequestHeader("x-rapidapi-key", "3847382bf9msh90bc9f162a76b0dp1491d8jsn1838a07ff787");

xhr.send(data);

xhr.onreadystatechange = function() {
	if(this.readyState == this.DONE) {
		// Received some kind of response
		if(xhr.status == 200) {
			// Got a succesful response
			console.log(xhr.responseText);
			// Convert the responsText JSON string to JS objects
			let responseObjects = JSON.parse(xhr.responseText);
			console.log(responseObjects);
			displayResults(responseObjects);

		}
		else {
			// Got a response, but it's an error
			console.log("Error!!!");
			console.log(xhr.status);

			let tbody = document.querySelector("tbody");
			while( tbody.hasChildNodes() ) {
				tbody.removeChild( tbody.lastChild );
			}
		
            let tid = document.querySelector("#divid");
            while (tid.hasChildNodes()){
            	tid.removeChild(tid.lastChild);
            }
			 
				var x = document.createElement("p"); 
            var t =  document.createTextNode("Wine not recognized"); 
            x.appendChild(t); 
            document.getElementById("divid").appendChild(x); 
		}
	}
}
// prevent form from being submitted
return false;
}



function displayResults(results) {

	 // document.querySelector("#num-results").innerHTML = results.totalFound;

	let id = document.querySelector("#divid");
    while (id.hasChildNodes()){
    	id.removeChild(id.lastChild);
    }
	let tbody = document.querySelector("tbody");
	while( tbody.hasChildNodes() ) {
		tbody.removeChild( tbody.lastChild );
	}
// console.log(results);
for(let i = 0; i < results.recommendedWines.length; i++) { 

	let trElement = document.createElement("tr");
	document.querySelector("tbody").appendChild(trElement);
	// Create <td> for  cover
	let coverElement = document.createElement("td");
	// Create <img> for  cover image
	let imageElement = document.createElement("img");
	imageElement.src = results.recommendedWines[i].imageUrl;
	// Append image to <td>
	coverElement.appendChild(imageElement);
	// Append cover to <tr>
	trElement.appendChild(coverElement);

	 // Create <td> for title
	let titleElement = document.createElement("td");
	titleElement.innerHTML = results.recommendedWines[i].title;
	// // Append title to <tr>
	trElement.appendChild(titleElement);

	 // Create <td> for price
	let priceElement = document.createElement("td");
	priceElement.innerHTML = results.recommendedWines[i].price;
	// // Append price to <tr>
	trElement.appendChild(priceElement);

	 // Create <td> for Description
	let desElement = document.createElement("td");
	desElement.innerHTML = results.recommendedWines[i].description;
	// // Append descrip to <tr>
	trElement.appendChild(desElement);

  }

	}


// autocompelete
function autocomplete(inp, arr) {
  /*the autocomplete function takes two arguments,
  the text field element and an array of possible autocompleted values:*/
  var currentFocus;
  /*execute a function when someone writes in the text field:*/
  inp.addEventListener("input", function(e) {
      var a, b, i, val = this.value;
      /*close any already open lists of autocompleted values*/
      closeAllLists();
      if (!val) { return false;}
      currentFocus = -1;
      /*create a DIV element that will contain the items (values):*/
      a = document.createElement("DIV");
      a.setAttribute("id", this.id + "autocomplete-list");
      a.setAttribute("class", "autocomplete-items");
      /*append the DIV element as a child of the autocomplete container:*/
      this.parentNode.appendChild(a);
      /*for each item in the array...*/
      for (i = 0; i < arr.length; i++) {
        /*check if the item starts with the same letters as the text field value:*/
        if (arr[i].substr(0, val.length).toUpperCase() == val.toUpperCase()) {
          /*create a DIV element for each matching element:*/
          b = document.createElement("DIV");
          /*make the matching letters bold:*/
          b.innerHTML = "<strong>" + arr[i].substr(0, val.length) + "</strong>";
          b.innerHTML += arr[i].substr(val.length);
          /*insert a input field that will hold the current array item's value:*/
          b.innerHTML += "<input type='hidden' value='" + arr[i] + "'>";
          /*execute a function when someone clicks on the item value (DIV element):*/
          b.addEventListener("click", function(e) {
              /*insert the value for the autocomplete text field:*/
              inp.value = this.getElementsByTagName("input")[0].value;
              /*close the list of autocompleted values,
              (or any other open lists of autocompleted values:*/
              closeAllLists();
          });
          a.appendChild(b);
        }
      }
  });
  /*execute a function presses a key on the keyboard:*/
  inp.addEventListener("keydown", function(e) {
      var x = document.getElementById(this.id + "autocomplete-list");
      if (x) x = x.getElementsByTagName("div");
      if (e.keyCode == 40) {
        /*If the arrow DOWN key is pressed,
        increase the currentFocus variable:*/
        currentFocus++;
        /*and and make the current item more visible:*/
        addActive(x);
      } else if (e.keyCode == 38) { //up
        /*If the arrow UP key is pressed,
        decrease the currentFocus variable:*/
        currentFocus--;
        /*and and make the current item more visible:*/
        addActive(x);
      } else if (e.keyCode == 13) {
        /*If the ENTER key is pressed, prevent the form from being submitted,*/
        e.preventDefault();
        if (currentFocus > -1) {
          /*and simulate a click on the "active" item:*/
          if (x) x[currentFocus].click();
        }
      }
  });
  function addActive(x) {
    /*a function to classify an item as "active":*/
    if (!x) return false;
    /*start by removing the "active" class on all items:*/
    removeActive(x);
    if (currentFocus >= x.length) currentFocus = 0;
    if (currentFocus < 0) currentFocus = (x.length - 1);
    /*add class "autocomplete-active":*/
    x[currentFocus].classList.add("autocomplete-active");
  }
  function removeActive(x) {
    /*a function to remove the "active" class from all autocomplete items:*/
    for (var i = 0; i < x.length; i++) {
      x[i].classList.remove("autocomplete-active");
    }
  }
  function closeAllLists(elmnt) {
    /*close all autocomplete lists in the document,
    except the one passed as an argument:*/
    var x = document.getElementsByClassName("autocomplete-items");
    for (var i = 0; i < x.length; i++) {
      if (elmnt != x[i] && elmnt != inp) {
        x[i].parentNode.removeChild(x[i]);
      }
    }
  }
  /*execute a function when someone clicks in the document:*/
  document.addEventListener("click", function (e) {
      closeAllLists(e.target);
  });
}

/*An array containing all the wine names in the world:*/
var wines = ["Chardonnay","Merlot","White Zinfandel","Pinot Grigio","Cabernet Sauvignon","Pinot Noir","Riesling","Shiraz","Tempranillo","Sangiovese","Gewürztraminer","Moscato","Grenche"];

/*initiate the autocomplete function on the "myInput" element, and pass along the wines array as possible autocomplete values:*/
autocomplete(document.getElementById("search-id"), wines);


</script>

</body>
</html>
