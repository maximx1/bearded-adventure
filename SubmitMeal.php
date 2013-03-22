<?php
/*
 * View to show successful submition of the meal insertions.
 * Author: Justin Walrath
 * Since: 2/5/2013
 * 
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
 
require_once("Controllers/StoreMeal.php");
require_once("Containers/NewMeal.php");
?>

<!DOCTYPE html>
<html>
	<head>
		<title>
			IDI - Chinese Friday
		</title>
		<link href="Styles/index.css" rel="stylesheet">
	</head>
	<body>
		<div class="container">
			<a href="CreateOrder.php">Make An Order</a>
			<a href="DisplayOrders.php">View Todays Orders</a>
			<a href="CreateMeal.php">Add Another Meal</a>
			<?php
			
			if(isset($_GET['MealName']) && isset($_GET['MealPrice']))
			{
				$newMeal = new NewMeal($_GET['MealName'], $_GET['MealPrice'], $_GET['mealOptionsSelect'], $_GET['optSelect']);
				$mealSubmitter = new StoreMeal();
				$successMessage = $mealSubmitter->RecordMeal($newMeal);
				print "<h1>".$successMessage."</h1>";
			}
			else
			{
				?>
					
				<h1>Error:</h1>
				<p>
					No meal data was found. You must enter the meal data.
				</p>
					
				<?php
			}
			
			?>
		
		</div>
	</body>
</html>