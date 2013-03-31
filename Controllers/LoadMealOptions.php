<?php

/*
 * Copyright 2013 Justin Walrath & Associates
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

require_once(dirname(__FILE__)."/../db/db.php");
require_once(dirname(__FILE__)."/../Containers/MealTrackingData.php");

/**
 * Controller that calls the db functions and pulls the available meals. 
 * 
 * @author: Justin Walrath <walrathjaw@gmail.com>
 * @since 2/2/2013
 */
class LoadMealOptions
{
	/**
	 * The database connection.
	 */
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
	 * @deprecated No longer used to load the create order page. Use ManipulateOrderLoading.
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
}

?>