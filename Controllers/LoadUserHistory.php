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
 * Loads the Historical meal data for the user.
 * @author Justin Walrath <walrathjaw@gmail.com>
 * @since 3/1/2013
 * @param $_GET["userId"] The user id to pull the history for.
 */

if(isset($_GET["userId"]))
{
	$userId = $_GET["userId"];
	$db = new DB();
	$result = $db->PullRecentMealHistory($userId);
	
	?>
	
	<!--Show recent Meals-->
	<h3>Recent Meals:</h3>
	<select id='mealHistorySelect' name='mealSelect' size=5>
		<?php
		foreach ($result as $key => $value)
		{
			print "<option value='".$key."'>".$value["name"]." - ".$value["price"]."</option>";
		}
		?>
	</select>
	<script src="Scripts/CreateOrder.js"></script>
	<?php
}
else
{
	?>
	<h1>You need to have have the mealId set</h1>
	<?php
}
?>