<?php
/*
 * "CreateOrder.php"
 * View that loads and displays the available meal options and will allow user
 * to choose options and save them.
 * 
 * Author: Justin Walrath <walrathjaw@gmail.com>
 * Since 2/1/2013
 */

require_once("Controllers/LoadMealOptions.php");
require_once("Controllers/SaveMeal.php");
?>
<!DOCTYPE html>
<html>
<head>
	<title>IDI Chinese Friday</title>
</head>
<body>
	<h1>Create an order</h1>
	<a href="index.php">Go Back</a>
	
	<?php
	
	$loader = new LoadMealOptions();	//Class to populate available meal data
	$meals = $loader->LoadMeals();		//MealData class
	
	?>
</body>
</html>