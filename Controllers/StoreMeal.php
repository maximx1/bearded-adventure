<?php

require 'db/db.php';

/*
 * Controller class that handles storing the order into the database.
 * Author: Justin Walrath <walrathjaw@gmail.com>
 * Since: 2/5/2013
 */
class StoreMeal
{
	public function RecordMeal($newMeal)
	{
		$db = new DB();
		$db->StoreMeal($newMeal);
		return 'The meal was added successfully';
	}
}

?>