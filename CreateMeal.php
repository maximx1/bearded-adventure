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
	</head>
	<body>
		<h1>Create A New Meal</h1>
		<form>
			<?php
			foreach($mobs as $id => $mob)
			{
				print '<input type="checkbox" name="mealOptionsSelect[]" value="'.$id.'">'.$mob.'<br>';
			}
			?>
		</form>
		<script src="Scripts/jquery-1.9.0.min.js"></script>
		<script src="Scripts/CreateMeal.js"></script>
	</body>
</html>

