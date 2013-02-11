<?php require_once("Controllers/LoadOrders.php"); ?>
<!DOCTYPE html>
<html>
<head>
	<title>IDI Chinese Friday</title>
	<link href="Styles/index.css" rel="stylesheet">
</head>
<body>
	<div class="container">
		<h1>Here are the orders for today:</h1>
		<a href="index.php">Go Back</a>
		
		<?php
		
		$loader = new LoadOrders();
		$combinedOrders = $loader->LoadDaysMeals();
		
		foreach($combinedOrders as $order)
		{
			print $order->CreateMealString();
		}
		
		?>
	</div>
</body>
</html>
