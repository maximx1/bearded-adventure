<?php

require_once '../Controllers/ManipulateOrderLoading.php';

$loader = new ManipulateOrderLoading();

		//Delete a user from the database
		$loader->DeleteOrder(3);
		
		//Pull all of the users in the database
		createJson($loader->LoadDaysMealsByUser());

/*
 * Create the JSON that 
 */
function createJson($combinedOrders)
{
	//Encode the output into 2 seperate arrays to avoid browser reordering.
	$jsonWrapper = array();
	$count = 0;
	
	foreach($combinedOrders as $order)
	{
		array_push($jsonWrapper, $order->CreateMealString());
	}
	
	header('Content-Type:text/json');
	echo json_encode($jsonWrapper);
}
?>