<?php

/*
 * "Order.php"
 * Container class that holds the orders placed with their options.
 * Author: Justin Walrath <walrathjaw@gmail.com>
 * Since: 2/1/2013
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
		if(isset($mobOption))
		{
			$this->AddMobOption($mobOption);
		}
		$this->RICE_TYPE = $riceType;
		$this->MEAL_PRICE = $mealprice;
	}
	
	/*
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
		$OrderString = '<p>' . $this->USER_NAME . " : " . $this->MEAL_NAME . " with " . $this->RICE_TYPE . " rice.";
		
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