<?php

/**
 * "MealData.php"
 * Container class that holds meal names, options, and keys
 * Author: Justin Walrath <walrathjaw@gmail.com>
 * Since: 2/1/2013
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
class MealTrackingData
{
	/**
	 * List of users, information is mapped as $user[user id][user name]
	 */
	public $User = array();
	
	/**
	 * List of meals, information mapped as $meals[meal id]["name" or "price" or "group"]
	 */
	public $Meal = array();
	
	/**
	 * List of rices/sides, information mapped as $rice[rice id][rice type]
	 */
	public $Rice = array();
	
	/**
	 * List of meal groups, information mapped as $optgroups[group id][group name]
	 */
	public $Optgroups = array();
	
	/**
	 * Constructor: Takes in arrays of the users, meals, and rice.
	 * @param: $user List of users, information is mapped as $user[user id][user name]
	 * @param: $meal List of meals, information mapped as $meals[meal id]["name" or "price" or "group"]
	 * @param: $rice List of rices, information mapped as $rice[rice id][rice type]
	 * @param: $optgroups List of meal groups, information mapped as $optgroups[group id][group name]
	 */
	public function __construct($user, $meal, $rice, $optgroups)
	{
		$this->User = $user;
		$this->Meal = $meal;
		$this->Rice = $rice;
		$this->Optgroups = $optgroups;
	}
}

?>