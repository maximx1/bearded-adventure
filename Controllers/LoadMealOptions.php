<?php
/*
 * "LoadMealOptions.php"
 * Controller that calls the db functions and pulls the available meals. 
 * 
 * Author: Justin Walrath <walrathjaw@gmail.com>
 * Since 2/2/2013
 */

require_once("db/db.php");
require_once("Containers/MealTrackingData.php");

class LoadMealOptions
{
	public function LoadMealData()
	{
		$db = new DB();
		return($db->PullMealData());
	}
}

?>