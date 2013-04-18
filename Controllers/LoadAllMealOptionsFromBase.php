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

//TODO get rid of this controller eventually.

require_once('db/db.php');

/**
 * Controller that loads all of the meals and options.
 * @author: Justin Walrath <walrathjaw@gmail.com>
 * @since: 2/5/2013
 */
class LoadAllMealOptionsFromBase
{
	/**
	 * The database connection.
	 */
	private $db;
	
	/**
	 * Constructor opens the database connection.
	 */
	public function __construct()
	{
		$this->db = new DB();
	}
	
	/**
	 * Pulls the MOBS from the database.
	 * @return List of available MOBs from the database.
	 */
	public function LoadMob()
	{
		return($this->db->PullAllMobs());
	}

	/** [deprecated]
	 * Pulls the rice from the database.
	 */
	public function LoadRice()
	{
		return($this->db->PullRiceTypes());
	}
}

?>
