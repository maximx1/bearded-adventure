<?php
/*
 * View to show successful submition of the meal insertions.
 * Author: Justin Walrath
 * Since: 2/5/2013
 */
 
require("Controllers/StoreMeal.php");
require("Containers/NewMeal.php");
?>

<!DOCTYPE html>
<html>
	<head>
		<title>
			IDI - Chinese Friday
		</title>
	</head>
	<body>
		<a href="CreateOrder.php">Make An Order</a>
		<a href="DisplayOrders.php">View Todays Orders</a>
		<a href="CreateMeal.php">Add Another Meal</a>
		<?php
		
		if(isset($_GET['MealName']) && isset($_GET['MealPrice']))
		{
			$newMeal = new NewMeal($_GET['MealName'], $_GET['MealPrice'], $_GET['mealOptionsSelect']);
			$mealSubmitter = new StoreMeal();
			$successMessage = $orderer->RecordOrder($newMeal);
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

	</body>
</html>