<?php
/*
	You will need to add a "DBI.php" File with a class named "DBI" with 3
	constants to represent the host and database information.
	The const variable names are: host, username, password
*/
require_once('DBI.php');

//Declare a plain variable to use.

/*
 * DB class that handles connecting, querying, and updating the database.
 * Author: Justin Walrath <walrathjaw@gmail.com>
 */
class DB
{
	private $db;	//The database connection.
	
	function ConnectDB()
	{
		try
		{
			$db = new PDO(DBI::host, DBI::username, DBI::password);
			$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		}
		catch(PDOException $e)
		{
			print $e->getMessage();
			exit;
		}
	}
	
	function PullDaysMeals()
	{
		try
		{
			$query = "select U.USER_NAME, M.MEAL_NAME, MOB.MOB_OPTION, R.RICE_TYPE, M.MEAL_PRICE from ORDERS O ".
					"inner join SELECTED_MEAL_OPTIONS SMO on O.ORDER_ID = SMO.SMO_ORDER_ID ".
					"inner join MEAL_OPTIONS_BASE MOB on MOB.MOB_ID = SMO.SMO_MOB_ID ".
					"inner join MEALS M on M.MEAL_ID = O.ORDER_MEAL_ID ".
					"inner join USERS U on U.USER_ID = O.ORDER_USER_ID ".
					"inner join RICE R on R.RICE_ID = O.ORDER_RICE ".
					"WHERE O.ORDER_DATE = CURDATE() ".
					"order by U.USER_NAME, M.MEAL_NAME, MOB.MOB_OPTION, R.RICE_TYPE, M.MEAL_PRICE;";
			$PStatement = $db->prepare($query);
			$PStatement->execute();
			$OrderRows = $PStatement->fetchAll();
			$PStatement->closeCursor();
			
			return($OrderRows);
		}
		catch(PDOException $er)
		{
			print "Error: " + $er; 
		}
	}
}


?>
