<?php
require 'ManipulateUser.php';
/*
 * Controller class to be called by ajax to load new information.
 * Author: Justin Walrath
 * Since: 2/5/2013
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
