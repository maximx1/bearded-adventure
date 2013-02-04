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
				print "<option value='".$key."'>".$value["name"][0]."</option>";
			}
			?>
		</select>
		<div id = 'mealOptions'></div>
		
		<br>
		
		<input type="submit" value="Submit" />
		
	</form>
	
	<script src="Scripts/jquery-1.9.0.min.js"></script>
	<script>
		$(document).ready(function(){
  			$("#mealSelect").change(function(){
  				var id = $("#mealSelect option:selected").val();
    			$("#mealOptions").load("Controllers/LoadMealOptionsFromBase.php?mealId=" + id);
  			});
		});
	</script>
</body>
</html>