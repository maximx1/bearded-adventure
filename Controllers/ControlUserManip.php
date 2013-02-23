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
		?>
		<table>
		<?php
		$rows = $userManip->LoadUsers();
		foreach ($rows as $key => $value)
		{
			print "<tr><td>$value</td><td><input class='delete' id='$key' type='button' value='Delete' /></td></tr>";
		}
		?>
			<tr><td>&nbsp;</td><td>&nbsp;</td></tr>
			<tr>
				<td>
					<input id='usernameBox' type="text" />
				</td>
				<td>
					<input class='add' type="button" value="Add User" />
				</td>
			</tr>
		</table>
		<?php



	}
	else if(strcasecmp($_GET["actionControl"], "deleteUser") == 0)
	{
		
		$userManip->DeleteUser((int)$_GET["id"]);
		?>
		<table>
		<?php
		$rows = $userManip->LoadUsers();
		foreach ($rows as $key => $value)
		{
			print "<tr><td>$value</td><td><input class='delete' id='$key' type='button' value='Delete' /></td></tr>";
		}
		?>
			<tr><td>&nbsp;</td><td>&nbsp;</td></tr>
			<tr>
				<td>
					<input id='usernameBox' type="text" />
				</td>
				<td>
					<input class='add' type="button" value="Add User" />
				</td>
			</tr>
		</table>
		<?php
	}
	else if(strcasecmp($_GET["actionControl"], "addUser") == 0)
	{
		//Add the user to the database.
		$userManip->AddUser($_GET["name"]);
		
		//Pull all of the users in the database
		$rows = $userManip->LoadUsers();
		header('Content-Type:text/json');
		echo json_encode($rows);
		return;
	}
	print '<script src="Scripts/jquery-1.9.0.min.js"></script><script src="Scripts/ManageUsers.js"></script>';
}
else
{
	?>
	
	<h3>Error</h3>
	<p>There was an issue with loading the page. Please refresh the page.</p>
	
	<?php
}
?>
