<?php
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
	
	$loader = new LoadHome();
	$combinedOrders = $loader->LoadDaysMeals();
	
	foreach($combinedOrders as $order)
	{
		print $order->CreateMealString();
	}
	
	?>
</body>
</html>