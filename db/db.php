<?php
/*
	You will need to add a "DBI.php" File with a class named "DBI" with 3
	constants to represent the host and database information.
	The const variable names are: host, username, password
*/
require_once('DBI.php');

function ConnectDB()
{
	
	try
	{
		$db= new PDO(DBI::host, DBI::username, DBI::password);
		$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	}
	catch(PDOException $e)
	{
		print $e->getMessage();
		exit;
	}
	return($db);
}
?>
