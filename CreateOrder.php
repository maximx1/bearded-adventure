<?php
/*
 * "CreateOrder.php"
 * View that loads and displays the available meal options and will allow user
 * to choose options and save them.
 * 
 * Author: Justin Walrath <walrathjaw@gmail.com>
 * Since 2/1/2013
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

?>
<!DOCTYPE html>
<html>
<head>
	<title>IDI Chinese Friday</title>
	<link href="Styles/index.css" rel="stylesheet">
</head>
<body>
	<div class="container">
		<h1>Create an order</h1>
		<a href="index.php">Go Back</a><br>
		
		<div id="leftPane">
			<form action='SubmitOrder.php' onsubmit="return validations()">
				<!--Show users-->
				<div id='userSpace'></div>
				
				<br>
				
				<!--Show the historical items-->
				<div id='mealHistorySpace'></div>
				
				<br>
				
				<!--Show Meals-->
				<div id="mealSpace"></div>
				<!--<h3>Choose Meal:</h3>
				<select id='mealSelect' name='mealSelect' size=25>
					<?php
					foreach ($meals->Optgroups as $optKey => $optValue)
					{
						print "<optgroup label='".$optValue."'>";
						
						foreach ($meals->Meal as $key => $value)
						{
							if($optKey == $value["group"])
							{
								print "<option value='".$key."'>".$value["name"]." - ".$value["price"]."</option>";
							}
						}
						
						print "</optgroup>";
					}
					?>
				</select>-->
				
				<!--Show Meal options for the meal.-->
				<div id = 'mealOptions'></div>
				
				<!--Show Rice Options-->
				<div id="riceSpace"></div>
				<!--
				<input id="submitButton" type="submit" value="Submit" disabled="disabled"/>
				<!--<input class='addNewOrder' id='" . $this->ORDER_ID . "' type='button' value='Add' />-->
			</form>
		</div>
		<div id="rightPane">
			<div id='mealCartSpace'></div>
		</div>	
	</div>
	
	<!--Load scripts at the end so as to not freeze shit up.-->
	<script src="Scripts/jquery-1.9.0.min.js"></script>
	<script src="Scripts/LoadCreateOrder.js"></script>
	<div id="scripts"></div>
</body>
</html>
