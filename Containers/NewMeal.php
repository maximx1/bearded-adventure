<?php

/*
 * Container class that holds information for making a new Meal.
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
class NewMeal
{
	public $MealName;
	public $Price;
	public $Mobs = array();		//List of all the MOB ids.
	
	public function __construct($mealName, $price, $mobs)
	{
		$this->MealName = $mealName;
		$this->Price = $price;
		$this->Mobs = $mobs;
	}
}

?>