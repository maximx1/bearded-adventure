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
	
	/*
	 * Constructor to connect to the database.
	 */
	public function __construct()
	{
		try
		{
			$this->db = new PDO(DBI::host, DBI::username, DBI::password);
			$this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			
		}
		catch(PDOException $e)
		{
			print $e->getMessage();
			exit;
		}
	}
	
	/*
	 * Pulls all of the orders for the day.
	 */
	public function PullDaysMeals()
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
			$PStatement = $this->db->prepare($query);
			$PStatement->execute();
			$OrderRows = $PStatement->fetchAll();
			$PStatement->closeCursor();
			
			return($OrderRows);
		}
		catch(PDOException $er)
		{
			print "Error: " + $er;
			exit;
		}
	}
	
	public function StoreMeal($meal)
	{
		try
		{
			//id, date, user id, meal id, rice
			//INSERT INTO ORDERS VALUES(null, NOW(), 1, 1, 2), (null, NOW(), 2, 1, 1);
			//mobid, orderid
			//INSERT INTO SELECTED_MEAL_OPTIONS VALUES(1, 1), (2, 1), (1, 2);
			
			$query = "INSERT INTO ORDERS VALUES(null, NOW(), :userid, :mealid, :riceid);";
			
			$PStatement = $this->db->prepare($query);
			$PStatement->bindValue(':userid', $meal->USER_ID);
			$PStatement->bindValue(':mealid', $meal->MEAL_ID);
			$PStatement->bindValue(':riceid', $meal->RICE_ID);
			$PStatement->execute();
			$newId = $this->db->lastInsertId();
			
			if(count($meal->MOB_OPTION > 0))
			{
				$mobQuery = "INSERT INTO SELECTED_MEAL_OPTIONS VALUES";
				
				$count = 1;
				foreach ($meal->MOB_OPTION as $option)
				{
					$mobQuery .= '(:mobid'.$count.', :orderid)';
					$count++;
				}
				$mobQuery.= ';';
				$PStatement = $this->db->prepare($mobQuery);
				foreach($meal->MOB_OPTION as $option)
				{
					$PStatement->bindValue('::mobid'.$count, $option->MOB_ID);
				}
				$PStatement->execute();
			}
			
			$PStatement->closeCursor();
			return;
		}
		catch(PDOException $er)
		{
			print "Error: " + $er;
			exit;
		}
	}
}


?>
