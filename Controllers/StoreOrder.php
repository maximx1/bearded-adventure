<?php

require_once 'db/db.php';

/*
 * Controller class that handles storing the order into the database.
 */
class StoreOrder
{
	public function RecordOrder($order)
	{
		$db = new DB();
		$db->StoreMeal($order);
		return 'The meal was added successfully';
	}
}

?>