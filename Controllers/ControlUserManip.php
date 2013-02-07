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
		$rows = $userManip->LoadUsers();
		foreach ($rows as $key => $value)
		{
			print "<td>$key</td><td>$value</td><td><input type='button' value='Delete' /></td>";
		}
	}
	else if(strcasecmp($_GET["actionControl"], "deleteUser") == 0)
	{
		$userManip->DeleteUser((int)$_GET["id"]);
		$rows = $userManip->LoadUsers();
		foreach ($rows as $key => $value)
		{
			print "<td>$key</td><td>$value</td><td><input type='button' value='Delete' /></td>";
		}
	}
	else if(strcasecmp($_GET["actionControl"], "addUser") == 0)
	{
		$userManip->AddUser($_GET["name"]);
		$rows = $userManip->LoadUsers();
		foreach ($rows as $key => $value)
		{
			print "<td>$key</td><td>$value</td><td><input type='button' value='Delete' /></td>";
		}
	}
}
else
{
	?>
	
	<h3>Error</h3>
	<p>There was an issue with loading the page. Please refresh the page.</p>
	
	<?php
}
?>