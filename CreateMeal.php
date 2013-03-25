<?php

/*
 * Copyright 2013 Justin Walrath & Associates
 	This program is free software: you can redistribute it and/or modify
    it under the terms of the GNU General Public License as published by
    the Free Software Foundation, either version 3 of the License, or
    (at your option) any later version.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with this program.  If not, see <http://www.gnu.org/licenses/>.
 */

require_once('Controllers/LoadAllMealOptionsFromBase.php');
require_once('Controllers/LoadAllOptgroups.php');

/**
 * View that allows the user to create a new meal.
 * @author: Justin Walrath <walrathjaw@gmail.com>
 * @since: 2/5/2013
 */

$mobLoader = new LoadAllMealOptionsFromBase();
$optLoader = new LoadAllOptgroups();
$mobs = $mobLoader->LoadMob();
$optgroups =$optLoader->LoadOptgroups();

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
				<h3>What Optgroup shoud this be under?</h3>
				<select id='OptSelect' name='optSelect'>
					<option value="nil" selected="selected"></option>
					<?php
					foreach($optgroups as $key => $value)
					{
						print "<option value='".$key."'>".$value."</option>";
					}
					?>
				</select>
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