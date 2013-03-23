<?php

require_once("db/db.php");
require_once("Containers/MealTrackingData.php");

/**
 * "LoadMealOptions.php"
 * Controller that calls the db functions and pulls the available meals. 
 * 
 * Author: Justin Walrath <walrathjaw@gmail.com>
 * Since 2/2/2013
 * 
 	This program is free software: you can redistribute it and/or modify
    it under the terms of the GNU General Public License as published by
    the Free Software Foundation, either version 3 of the License, or
    (at your option) any later version.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with this program.  If not, see <http://www.gnu.org/licenses/>.
 */
class LoadMealOptions
{
	private $db;
	
	/**
	 * Function that opens up the connection to the database.
	 */
	public function __construct()
	{
		$this->db = new DB();
	}
	
	/**
	 * Loads the meal data from the database.
	 * @return A MealTrackingData Container object built from the database.
	 */
	public function LoadMealData()
	{
		return($this->db->PullMealData());
	}
	
	/**
	 * Pulls all of the MOBS from the database.
	 * @return List of available MOBs from the database.
	 */
	public function LoadAllMobs()
	{
		return($this->db->PullAllMobs());
	}
	
	/**
	 * Load historical meals from the orders.
	 * @param $userid The user id to pull the meal history for.
	 * @return List of historical meals, information mapped as $meals[meal id]["name" or "price" or "group"]
	 */
	public function LoadHistoricalMealData($userid)
	{
		return($this->db->PullRecentMealHistory($userid));
	}
}

?>