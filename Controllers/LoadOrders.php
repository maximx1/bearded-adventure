<?php

/*
 * Loads the orders for the display page.
 * Author: Justin Walrath
 * Since: 3/1/2013
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
