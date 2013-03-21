<?php

/*
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