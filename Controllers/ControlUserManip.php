<?php
require 'ManipulateUser.php';
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
	$userManip = new ManipulateUser();
	
	if(strcasecmp($_GET["actionControl"], "loadUser") == 0)
	{
		//Pull all of the users in the database
		createJson($userManip->LoadUsers());
	}
	else if(strcasecmp($_GET["actionControl"], "deleteUser") == 0)
	{
		//Delete a user from the database
		$userManip->DeleteUser((int)$_GET["id"]);
		
		//Pull all of the users in the database
		createJson($userManip->LoadUsers());
		
	}
	else if(strcasecmp($_GET["actionControl"], "addUser") == 0)
	{
		//Add the user to the database.
		$userManip->AddUser($_GET["name"]);
		
		//Pull all of the users in the database
		createJson($userManip->LoadUsers());
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
 * Function to create JSON object that won't be sorted by a browser.
 * 
 * Author: Justin Walrath
 * Since: 2/22/2013
 */
function createJson($rows)
{
	//Encode the output into 2 seperate arrays to avoid browser reordering.
	$jsonWrapper = array();
	$jsonWrapper['key'] = array_keys($rows);
	$jsonWrapper['val'] = array_values($rows);
	
	header('Content-Type:text/json');
	echo json_encode($jsonWrapper);
}
?>
