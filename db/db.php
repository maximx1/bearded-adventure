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
	
	/*
	 * Pulls the meal data from the database for selection.
	 */
	public function PullMealData()
	{
		$users = array();
		$rice = array();
		$meals = array();
		
		$outputPacket;
		try
		{
			$userQuery = "select u.USER_ID as userid, u.USER_NAME as username from USERS u order by username;";
			$riceQuery = "select r.RICE_ID as id, r.RICE_TYPE as type from RICE r";
			
			
			$mealQuery = "select M.MEAL_ID, M.MEAL_NAME, MOB.MOB_ID, MOB.MOB_OPTION, M.MEAL_PRICE from MEALS M ".
					"inner join MEAL_OPTIONS MO on MO.MO_MEAL_ID = M.MEAL_ID ".
					"inner join MEAL_OPTIONS_BASE MOB on MOB.MOB_ID = MO.MO_MOB_ID ".
					"order by M.MEAL_ID, MOB.MOB_ID;";
			
			//Pull the users
			$PStatement = $this->db->prepare($userQuery);
			$PStatement->execute();
			$rows = $PStatement->fetchAll();
			foreach ($rows as $row)
			{
				$users[$row['userid']] = $row['username'];
			}
			
			//Pull the rice information
			$PStatement = $this->db->prepare($riceQuery);
			$PStatement->execute();
			$rows = $PStatement->fetchAll();
			foreach ($rows as $row)
			{
				$rice[$row['id']] = $row['type'];
			}
			
			
			//Pull the meal information
			$PStatement = $this->db->prepare($mealQuery);
			$PStatement->execute();
			$rows = $PStatement->fetchAll();
			foreach ($rows as $row)
			{
				$meals[$row['MEAL_ID']]["name"][0] = $row['MEAL_NAME'];
				$meals[$row['MEAL_ID']]["op"][$row['MOB_ID']] = $row['MOB_OPTION'];
				$meals[$row['MEAL_ID']]["price"][0] = $row['MEAL_PRICE'];
			}
			
			//Close the database connection.
			$PStatement->closeCursor();
			
			$outputPacket = new MealTrackingData($users, $meals, $rice);
			
			return($outputPacket);
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
					if($count != count($meal->MOB_OPTION))
					{
						$mobQuery .= ',';
					}
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
