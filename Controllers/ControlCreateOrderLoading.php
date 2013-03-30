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

require_once(dirname(__FILE__).'/ManipulateOrderLoading.php');

/**
 * Controller class to be called by ajax to load new information.
 * @author: Justin Walrath
 * @since: 3/27/2013
 * @param $_GET["actionControl"] Switch to determine what to do with the script.
 * @param $_GET["id"] Order id number.
 * @return Prints out JSON to be picked up by the javascript.
 */

if(isset($_GET["actionControl"]))
{
	$loader = new ManipulateOrderLoading();	//Class to populate available meal data
	if(strcasecmp($_GET["actionControl"], "loadOrders") == 0)
	{
		//Pull all of the users in the database
		createJson($loader->LoadDaysMealsByUser());
	}
	else if(strcasecmp($_GET["actionControl"], "deleteOrder") == 0)
	{
		//Delete a user from the database
		$loader->DeleteOrder($_GET["id"]);
		
		//Pull all of the users in the database
		createJson($loader->LoadDaysMealsByUser());
	}
	else if(strcasecmp($_GET["actionControl"], "loadHistory") == 0)
	{
		createHistoricalJson($loader->LoadHistoricalMealData($_GET["id"]));
	}
}
else
{
	?>
	
	<h3>Error</h3>
	<p>There was an issue with loading the page. Please refresh the page.</p>
	
	<?php
}

/**
 * Create the JSON string to be picked up by the javascript
 * @param $combinedOrders List of orders to be converted to JSON.
 */
function createJson($combinedOrders)
{
	//Encode the output into 2 seperate arrays to avoid browser reordering.
	$jsonWrapper = array();
	
	//Run through the orders and generate meal strings from them.
	foreach($combinedOrders as $order)
	{
		array_push($jsonWrapper, $order->CreateMealString());
	}
	
	//Specify that it is returning some JSON data for the ajax.
	header('Content-Type:text/json');
	
	//Encode the array as JSON.
	echo json_encode($jsonWrapper);
}

/**
 * Create a JSON string of the user's history data. 
 */
function createHistoricalJson($history)
{
	$jsonwrapper = array();
	
	foreach($history as $value)
	{
		//"<table class='mealHistorySelect'>";
		array_push($jsonwrapper, $value->CreateHistoryString());
		//print "</table>";
		//(count($result) > $count) ? print "<hr>" : print "";
		//$count++;
	}
	
	//Specify that it is returning some JSON data for the ajax.
	header('Content-Type:text/json');
	
	echo json_encode($jsonwrapper);
}

?>