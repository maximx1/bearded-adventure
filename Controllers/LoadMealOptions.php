<?php
/*
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

require_once("db/db.php");
require_once("Containers/MealTrackingData.php");

class LoadMealOptions
{
	public function LoadMealData()
	{
		$db = new DB();
		return($db->PullMealData());
	}
}

?>