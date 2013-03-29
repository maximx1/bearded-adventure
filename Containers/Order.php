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

/**
 * Container class that holds the orders placed with their options.
 * @author: Justin Walrath <walrathjaw@gmail.com>
 * @since: 2/1/2013
 */
class Order
{
	/**
	 * The Order ID number.
	 */
	public $ORDER_ID = "";
	
	/**
	 * The Orderer's name
	 */
	public $USER_NAME = "";
	
	/**
	 * The meal's name.
	 */
	public $MEAL_NAME = "";
	
	/**
	 * List of meal options as descriptions.
	 */
	public $MOB_OPTION = array();
	
	/**
	 * The type sides like rice/roast pork.
	 */
	public $RICE_TYPE = "";
	
	/**
	 * The Cost of the price on the menu.
	 */
	public $MEAL_PRICE = "";
	
	/**
	 * The session ID of the order that was placed.
	 */
	public $SESSION_ID = "";
	
	/**
	 * Constructor that builds a quick object of the meal.
	 * @param $orderId The id number of the order.
	 * @param $username The user's name.
	 * @param $mealName The meal's name.
	 * @param $mobOption List of meal options as descriptions.
	 * @param $riceType The type of sides as description.
	 * @param mealPrice The price of the meal.
	 * @param $sessionId The Session ID of the current Ordering session.
	 */
	public function __construct($orderId, $username, $mealName, $mobOption, $riceType, $mealprice, $sessionId)
	{
		$this->ORDER_ID = $orderId;
		$this->USER_NAME = $username;
		$this->MEAL_NAME = $mealName;
		$this->MOB_OPTION = $mobOption;
		$this->RICE_TYPE = $riceType;
		$this->MEAL_PRICE = $mealprice;
		$this->SESSION_ID = $sessionId;
		
		//Reset the session lifetime
		$lifetime = 36000;
		session_set_cookie_params($lifetime);
		session_start();
	}
	
	/**
	 * Adds a mob option to the object
	 * @param $mobOption A mob option as a string
	 * @deprecated
	 */
	public function AddMobOption($mobOption)
	{
		//Merges the 2 arrays together
		$this->MOB_OPTION = array_merge((array)$this->MOB_OPTION, (array)$mobOption);
	}
	
	/**
	 * Determines if the passed in Order is the same order by the id number.
	 * @param $mealOrder An order to compare with as another Order object.
	 * @return true if the order id's are the same and false otherwise.
	 */
	public function IsDuplicateOrder($mealOrder)
	{
		return($this->ORDER_ID == $mealOrder->ORDER_ID ? true : false);
	}
	
	/**
	 * Determines if the passed in Order is has the same name.
	 * @param $mealOrder An order to compare with as another Order object.
	 * @return true if the order meal names are the same and false otherwise.
	 */
	public function IsDuplicateMeal($mealOrder)
	{
		return(strcasecmp($mealOrder->MEAL_NAME, $this->MEAL_NAME) == 0 ? true : false);
	}
	
	/**
	 * Creates a single string listing off the order options.
	 * @return A string of the order as html.
	 */
	public function CreateMealString()
	{
		//Add the username and the meal name with the side.
		$OrderString = "<tr><td>" . $this->USER_NAME . "</td><td>&nbsp;</td><td>&nbsp;</td></tr>";
		$OrderString .= $this->CreateFirstPartOfOrder();
		
		//If there is a session available then check if the order's session ID is the same. If so then generate a delete button.
		if(isset($_SESSION))
		{
			if(strcasecmp($_SESSION['sessionId'], $this->SESSION_ID) == 0)
			{
				$OrderString .= '<td><input class="delete" id="' . $this->ORDER_ID . '" type="button" value="Delete"></td>';
			}
			else
			{
				$OrderString .= "<td>&nbsp;</td>";
			}
		}
		else
		{
			$OrderString .= "<td>&nbsp;</td>";
		}
		
		return $OrderString.'</tr>';
	}
	
	/**
	 * Prints out the table format for the historical data.
	 */
	public function CreateHistoryString()
	{
		$historyString = $this->CreateFirstPartOfOrder();
		$historyString .= "<td><input class='addHistoryItem' id='" . $this->ORDER_ID . "' type='button' value='Add' /></td></tr>";
		
		return $historyString;
	}
	
	/**
	 * Combines the beginning string of the order output
	 * @return First part of the order string. 
	 */
	private function CreateFirstPartOfOrder()
	{
		//Add the username and the meal name with the side.
		$OrderString = "<tr><td><h3>" . $this->MEAL_NAME . "</h3></td><td>&nbsp;</td><td>$" . $this->MEAL_PRICE . "</td></tr>".
					   "<tr><td>" . (empty($this->MOB_OPTION) ? "" : "<b>Meal Options:</b>") . "</td><td>&nbsp;</td><td>&nbsp;</td></tr>";
		
		foreach($this->MOB_OPTION as $option)
		{
			$OrderString .= "<tr><td>&emsp;&emsp;" . $option . "</td><td>&nbsp;</td><td>&nbsp;</td></tr>";
		}
		
		$OrderString .= "<tr><td>Rice: " . $this->RICE_TYPE . "</td><td>&nbsp;</td><td>&nbsp;</td></tr>";
		$OrderString .= "<tr><td>&nbsp;</td><td>&nbsp;</td>";
		
		return($OrderString);
	}
}

?>