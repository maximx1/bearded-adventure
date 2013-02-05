<?php
/*
 * Controller that loads all of the meals and options.
 * Author: Justin Walrath <walrathjaw@gmail.com>
 * Since: 2/5/2013
 */

require 'db/db.php';	//Load the database functions

class LoadAllMealOptionsFromBase
{
	public $db;
	
	/*
	 * Constructor opens the database connection.
	 */
	public function __construct()
	{
		$this->db = new DB();
	}
	
	/*
	 * Pulls the MOBS from the database.
	 */
	public function LoadMob()
	{
		return($this->db->PullAllMobs());
	}
	
	/* [deprecated]
	 * Pulls the rice from the database.
	 */
	public function LoadRice()
	{
		return($this->db->PullRiceTypes());
	}
}

?>