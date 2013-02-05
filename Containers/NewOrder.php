<?php

class NewOrder
{
	public $USER_ID = "";			//The Orderer's id.
	public $MEAL_ID = "";			//The meal's id.
	public $MOB_OPTION = array();	//List of meal options as ids.
	public $RICE_ID = "";			//The type of rice White|Fried.
	
	/*
	 * Constructor that builds a quick object of the meal.
	 */
	public function __construct($userId, $mealId, $mobOption, $riceId)
	{
		$this->USER_ID = $userId;
		$this->MEAL_ID = $mealId;
		$this->MOB_OPTION = $mobOption;
		$this->RICE_ID = $riceId;
	}
}

?>