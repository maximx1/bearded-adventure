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

/**
 * Container class that holds information for making a new Meal.
 * @author: Justin Walrath <walrathjaw@gmail.com>
 * @since: 3/1/2013
 */
class NewMeal
{
	/**
	 * The name of the meal.
	 */
	public $MealName;
	
	/**
	 * The current price of the meal.
	 */
	public $Price;
	
	/**
	 * A list of all the mob options selected for the meal.
	 */
	public $Mobs = array();
	
	/**
	 * The optgroup that this meal will be going under.
	 */
	public $OptgroupClass;
	
	/**
	 * A constructor that makes this meal object.
	 * @param $mealName The Name of the meal.
	 * @param $price The price of the meal.
	 * @param $mobs List of mob options that are chosen for the meal.
	 * @param $optgroupClass The optgroup that the meal will be under.
	 */
	public function __construct($mealName, $price, $mobs, $optgroupClass)
	{
		$this->MealName = $mealName;
		$this->Price = $price;
		$this->Mobs = $mobs;
		$this->OptgroupClass = $optgroupClass;
	}
}

?>