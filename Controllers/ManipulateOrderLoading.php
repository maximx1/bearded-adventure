<?php

/*
 * Copyright 2013 Justin Walrath & Associates
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

require_once(dirname(__FILE__).'/../db/db.php');
require_once(dirname(__FILE__).'/../Containers/Order.php');

/**
 * Loads the orders for the display page.
 * @author: Justin Walrath
 * @since: 3/1/2013
 */
class ManipulateOrderLoading
{
	/**
	 * The database connection.
	 */
	private $db;
	
	/**
	 * Starts up the database 
	 * @author Justin Walrath
	 * @since 3/22/2013 
	 */
	public function __construct()
	{
		$this->db = new DB();
	}
	
	/**
	 * Loads the meals by users's name
	 * @author Justin Walrath
	 * @since 3/22/2013
	 * @return List of Orders for the day. 
	 */
	public function LoadDaysMealsByUser()
	{
		$combinedOrders = array();
		$OrderRows = $this->db->PullDaysMeals();
		
		//Combine the orders
		foreach ($OrderRows as $row)
		{
			$mobOptions = $this->db->PullMobForOrder($row['ORDER_ID']);
			$nextOrder = new Order($row['ORDER_ID'],
								$row['USER_NAME'], 
								$row['MEAL_NAME'], 
								$mobOptions, 
								$row['RICE_TYPE'], 
								$row['MEAL_PRICE'],
								$row['ORDER_SESSION_ID']
							 );
			array_push($combinedOrders, $nextOrder);
		}
		
		return($combinedOrders);
	}
	
	/**
	 * This calls the database to delete the order.
	 * @author Justin Walrath <walrathjaw@gmail.com>
	 * @since 3/23/2013
	 * @param The Order's Id number to delete
	 */
	public function DeleteOrder($orderId)
	{
		$this->db->DeleteOrder($orderId);
	}
	
	/**
	 * Load historical meals from the orders.
	 * @param $userid The user id to pull the meal history for.
	 * @return List of historical meals, information mapped as $meals[meal id]["name" or "price" or "group"]
	 */
	public function LoadHistoricalMealData($userid)
	{
		return($this->db->PullRecentMealHistory($userid));
	}
	
	/**
	 * Loads an order by it's Id number.
	 * @param $orderid The orders Id number to load.
	 * @return An Order object that contains a single historical object.
	 */
	public function LoadOrderById($orderid)
	{
		return($this->db->PullSingleOrder($orderid));
	}
}

?>