<?php

require_once 'db/db.php';
require_once 'Containers/Order.php';

class LoadOrders
{
	function LoadDaysMeals()
	{
		$combinedOrders = array();
		$db = new DB();
		$OrderRows = $db->PullDaysMeals();
		
		//Combine the orders
		foreach ($OrderRows as $row)
		{
			$mobOptions = $db->PullMobForOrder($row['ORDER_ID']);
			$nextOrder = new Order($row['USER_NAME'], $row['MEAL_NAME'], 
					$mobOptions, $row['RICE_TYPE'], $row['MEAL_PRICE']);
			array_push($combinedOrders, $nextOrder);
		}
		
		return($combinedOrders);
	}
}

?>
