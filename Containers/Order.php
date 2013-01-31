<?php

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
		array_push($this->MOB_OPTION, $mobOption);
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
		$OrderString = $this->USER_NAME . " : " . $this->MEAL_NAME . " with " . $this->RICE_TYPE . ".";
		foreach ($this->MOB_OPTION as $value)
		{
			$OrderString .= " " . $value;	
		}
		return $OrderString;
	}
}

?>