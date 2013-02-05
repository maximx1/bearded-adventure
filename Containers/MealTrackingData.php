<?php

/*
 * "MealData.php"
 * Container class that holds meal names, options, and keys
 * Author: Justin Walrath <walrathjaw@gmail.com>
 * Since: 2/1/2013
 */
class MealTrackingData
{
	public $User = array();
	public $Meal = array();
	public $Rice = array();
	
	/*
	 * Constructor: Takes in arrays of the users, meals, and rice.
	 */
	public function __construct($user, $meal, $rice)
	{
		$this->User = $user;
		$this->Meal = $meal;
		$this->Rice = $rice;
	}
}

?>