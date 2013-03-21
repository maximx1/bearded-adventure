<?php

/*
 * "Order.php"
 * Container class that holds the orders placed with their options.
 * Author: Justin Walrath <walrathjaw@gmail.com>
 * Since: 2/1/2013
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
class Order
{
	public $USER_NAME = "";			//The Orderer.
	public $MEAL_NAME = "";			//The meal's name.
	public $MOB_OPTION = array();	//List of meal options.
	public $RICE_TYPE = "";			//The type of rice White|Fried.
	public $MEAL_PRICE = "";		//The Cost of the price on the menu.
	
	/*
	 * Constructor that builds a quick object of the meal.
	 */
	public function __construct($username, $mealName, $mobOption, $riceType, $mealprice)
	{
		$this->USER_NAME = $username;
		$this->MEAL_NAME = $mealName;
		$this->MOB_OPTION = $mobOption;
		$this->RICE_TYPE = $riceType;
		$this->MEAL_PRICE = $mealprice;
	}
	
	/*[deprecated]
	 * Adds a mob option to the object
	 * $mobOption : [String] : A mob option
	 */
	public function AddMobOption($mobOption)
	{
		//array_push($this->MOB_OPTION, $mobOption);
		$this->MOB_OPTION = array_merge((array)$this->MOB_OPTION, (array)$mobOption);
		return;
	}
	
	/*
	 * Determines if the passed in Order is has the same name.
	 * $mealOrder : [Order] : An order to compare.
	 */
	public function IsDuplicateOrder($mealOrder)
	{
		return strcasecmp($mealOrder->USER_NAME, $this->USER_NAME) == 0
				&& strcasecmp($mealOrder->MEAL_NAME, $this->MEAL_NAME) == 0
				? true : false;
	}
	
	/*
	 * Creates a single string listing off the order options.
	 */
	public function CreateMealString()
	{
		$OrderString = '<p>' . $this->USER_NAME . " : " . $this->MEAL_NAME . " with " . $this->RICE_TYPE . ".";
		
		$count = 1;
		foreach ($this->MOB_OPTION as $value)
		{
			if(count($this->MOB_OPTION) == 1)
			{
				$OrderString .= " " . $value . ".";
			}
			else
			{
				if($count == 1)
				{
					$OrderString .= " " . $value;
				}
				else if($count == count($this->MOB_OPTION))
				{
					$OrderString .= ", " . $value . ".";
				}
				else
				{
					$OrderString .= ", " . $value;
				}
			}
			$count++;
		}
		return $OrderString.' - Price: $' . $this->MEAL_PRICE . '</p>';
	}
}

?>