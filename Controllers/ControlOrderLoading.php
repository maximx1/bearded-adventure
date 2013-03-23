<?php

require_once 'ManipulateOrderLoading.php';

/*
 * Controller class to be called by ajax to load new information.
 * Author: Justin Walrath
 * Since: 2/5/2013
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

if(isset($_GET["actionControl"]))
{
	$loader = new ManipulateOrderLoading();

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
}
else
{
	?>
	
	<h3>Error</h3>
	<p>There was an issue with loading the page. Please refresh the page.</p>
	
	<?php
}

/*
 * Create the JSON that 
 */
function createJson($combinedOrders)
{
	//Encode the output into 2 seperate arrays to avoid browser reordering.
	$jsonWrapper = array();
	$count = 0;
	
	foreach($combinedOrders as $order)
	{
		array_push($jsonWrapper, $order->CreateMealString());
	}
	
	header('Content-Type:text/json');
	echo json_encode($jsonWrapper);
}

?>