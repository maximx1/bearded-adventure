<?php
/*
 * A view class that displays a successful logging of a meal.
 * Author: Justin Walrath <walrathjaw@gmail.com>
 * Since: 2/3/2013
 */
require_once("Controllers/StoreOrder.php");
require_once("Containers/NewOrder.php");
?>
<!DOCTYPE html>
<html>
	<head>
		<title>IDI Chinese Friday</title>
	</head>
	<body>
	<a href="CreateOrder.php">Make An Order</a>
	<a href="DisplayOrders.php">View Todays Orders</a>
<?php

if(isset($_GET['userSelect']) && isset($_GET['mealSelect']) && isset($_GET['riceSelect']))
{
	$order = new NewOrder((int)$_GET['userSelect'], (int)$_GET['mealSelect'], $_GET['mealOptionsSelect'], (int)$_GET['riceSelect']);
	$orderer = new StoreOrder();
	$successMessage = $orderer->RecordOrder($order);
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