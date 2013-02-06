<?php

/*
 * Container class that holds information for making a new Meal.
 */
class NewMeal
{
	public $MealName;
	public $Price;
	public $Mobs = array();		//List of all the MOB ids.
	
	public function __construct($mealName, $price, $mobs)
	{
		$this->MealName = $mealName;
		$this->Price = $price;
		$this->Mobs = $Mobs;
	}
}

?>