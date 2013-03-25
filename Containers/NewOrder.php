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
 * This is a container for a new meal.
 * @author: Justin Walrath <walrathjaw@gmail.com>
 * @since: 3/1/2013
 */

class NewOrder
{
	/**
	 * The Orderer's id.
	 */
	public $USER_ID = "";
	
	/**
	 * The meal's id.
	 */
	public $MEAL_ID = "";
	
	/**
	 * List of meal options as ids.
	 */
	public $MOB_OPTION = array();
	
	/**
	 * The type sides like rice/roast pork.
	 */
	public $RICE_ID = "";
	
	/**
	 * The Session ID of the current Ordering session.
	 */
	public $SESSION_ID = "";
	
	/**
	 * Constructor that builds a quick object of the meal.
	 * @param $userId The user's id number.
	 * @param $mealId The meal id number.
	 * @param $mobOption List of meal options as ids.
	 * @param $riceId The type of sides as id's
	 * @param $sessionId The Session ID of the current Ordering session.
	 */
	public function __construct($userId, $mealId, $mobOption, $riceId, $sessionId)
	{
		$this->USER_ID = $userId;
		$this->MEAL_ID = $mealId;
		$this->MOB_OPTION = $mobOption;
		$this->RICE_ID = $riceId;
		$this->SESSION_ID = $sessionId;
	}
}

?>