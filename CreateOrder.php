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
	<a href="index.php">Go Back</a><br>
	
	<?php
	
	$loader = new LoadMealOptions();	//Class to populate available meal data
	$meals = $loader->LoadMealData();	//MealData class.
	?>
	
	<form action='SubmitOrder.php'>
		<!--Show users-->
		<h3>Choose User:</h3>
		<select id='userSelect' name='userSelect'>
			<?php
			foreach ($meals->User as $key => $value)
			{
				print "<option value='".$key."'>".$value."</option>";
			}
			?>
		</select>
		
		<br>
		
		<!--Show Meals-->
		<h3>Choose Meal:</h3>
		<select id='mealSelect' name='mealSelect' size=<?php print count($meals->Meal); ?>>
			<?php
			foreach ($meals->Meal as $key => $value)
			{
				print "<option value='".$key."'>".$value["name"]." - ".$value["price"]."</option>";
			}
			?>
		</select>
		<div id = 'mealOptions'></div>
		
		<!--Show Rice Options-->
		<h3>Choose Side:</h3>
		<select id='riceSelect' name='riceSelect'>
			<?php
			foreach ($meals->Rice as $key => $value)
			{
				print "<option value='".$key."'>".$value."</option>";
			}
			?>
		</select>
		<br>
		<input id="submitButton" type="submit" value="Submit" disabled="disabled"/>
		
	</form>
	
	<!--Load scripts at the end so as to not freeze shit up.-->
	<script src="Scripts/jquery-1.9.0.min.js"></script>
	<script src="Scripts/CreateOrder.js"></script>
</body>
</html>