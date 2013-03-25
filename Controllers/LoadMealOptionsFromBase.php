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

require_once('../db/db.php');

/**
 * Loads the meal options for the meals once selected in the ordering page.
 * @author: Justin Walrath
 * @since: 3/1/2013
 * @param $_GET["mealId"] The meal id to pull the MOBS for.
 */

if(isset($_GET["mealId"]))
{
	$mealId = $_GET["mealId"];
	$db = new DB();
	$result = $db->PullMealOptions((int)$mealId);
	
	?><h3>Choose Meal Options:</h3><?php
	foreach($result as $id => $mob)
	{
		print '<input type="checkbox" name="mealOptionsSelect[]" value="'.$id.'">'.$mob.'<br>';
	}
}
else
{
	?>
	<h1>You need to have have the mealId set</h1>
	<?php
}

?>