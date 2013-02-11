<?php

/*
 * View that allows the user to create a new meal.
 * Author: Justin Walrath <walrathjaw@gmail.com>
 * Since: 2/5/2013
 */

require 'Controllers/LoadAllMealOptionsFromBase.php';

$mobLoader = new LoadAllMealOptionsFromBase();
$mobs = $mobLoader->LoadMob();

?>

<!DOCTYPE html>
<html>
	<head>
		<title>IDI - Chinese Friday</title>
		<link href="Styles/index.css" rel="stylesheet">
	</head>
	<body>
		<div class="container">
			<h1>Create A New Meal</h1>
			<a href="index.php">Go Back</a>
			<form action="SubmitMeal.php" method="get">
				<h3>Enter Meal Data</h3>
				Meal name: 
				<input id="MealName" type="text" name="MealName"/><!--Need to add the .js to blur-->
				&emsp;
				Price: $
				<input id="MealPrice" type="text" name="MealPrice"/><!--Need to add the .js to blur-->
				<h3>Select Meal Options to include: </h3>
				<?php
				foreach($mobs as $id => $mob)
				{
					print '<input type="checkbox" name="mealOptionsSelect[]" value="'.$id.'">'.$mob.'<br>';
				}
				?>
				<input type="submit" value="Submit" />
			</form>
		</div>
		<script src="Scripts/jquery-1.9.0.min.js"></script>
		<script src="Scripts/CreateMeal.js"></script>
	</body>
</html>

