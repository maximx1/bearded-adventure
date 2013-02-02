<?php

require_once '../db/db.php';
require_once '../Containers/Order.php';

function PullDaysMealsTest()
{
	$combinedOrders = array();
	$db = new DB();
	$OrderRows = $db->PullDaysMeals();
	
	//Combine the orders
	foreach ($OrderRows as $row)
	{
		$nextOrder = new Order($row['USER_NAME'], $row['MEAL_NAME'], 
				$row['MOB_OPTION'], $row['RICE_TYPE'], $row['MEAL_PRICE']);
		
		if(count($combinedOrders) == 0)
		{
			array_push($combinedOrders, $nextOrder);
		}
		else
		{
			$notFound = TRUE;
			foreach ($combinedOrders as $order)
			{
				if($order->IsDuplicateOrder($nextOrder))
				{
					$notFound = FALSE;
					$order->AddMobOption($nextOrder->MOB_OPTION);
				}
			}
			
			if($notFound)
			{
				array_push($combinedOrders, $nextOrder);
			}
		}
	}
	
	foreach($combinedOrders as $order)
	{
		print $order->CreateMealString();
	}
}

function StoreMealsTest()
{
	$db = new DB();
	
}

?>