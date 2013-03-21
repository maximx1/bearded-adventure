<?php
/*
 * This is a container for a new meal.
 * Author: Justin Walrath <walrathjaw@gmail.com>
 * Since: 3/1/2013
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

class NewOrder
{
	public $USER_ID = "";			//The Orderer's id.
	public $MEAL_ID = "";			//The meal's id.
	public $MOB_OPTION = array();	//List of meal options as ids.
	public $RICE_ID = "";			//The type of rice White|Fried.
	
	/*
	 * Constructor that builds a quick object of the meal.
	 */
	public function __construct($userId, $mealId, $mobOption, $riceId)
	{
		$this->USER_ID = $userId;
		$this->MEAL_ID = $mealId;
		$this->MOB_OPTION = $mobOption;
		$this->RICE_ID = $riceId;
	}
}

?>