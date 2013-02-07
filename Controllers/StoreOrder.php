<?php

require 'db/db.php';

/*
 * Controller class that handles storing the order into the database.
 * Author: Justin Walrath <walrathjaw@gmail.com>
 * Since: 2/3/2013
 */
class StoreOrder
{
	public function RecordOrder($order)
	{
		$db = new DB();
		$db->StoreOrder($order);
		return 'The meal was added successfully';
	}
}

?>