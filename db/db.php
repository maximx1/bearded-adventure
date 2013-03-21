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
 * Since: 2/1/2013
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
			$mealQuery = "select O.ORDER_ID, U.USER_NAME, M.MEAL_NAME, R.RICE_TYPE, M.MEAL_PRICE from ORDERS O ".
					"inner join MEALS M on O.ORDER_MEAL_ID = M.MEAL_ID ".
					"inner join USERS U on U.USER_ID = O.ORDER_USER_ID ".
					"inner join RICE R on R.RICE_ID = O.ORDER_RICE ".
					"where O.ORDER_DATE = CURDATE() order by O.ORDER_ID;";
					
			$PStatement = $this->db->prepare($mealQuery);
			$PStatement->execute();
			$OrderRows = $PStatement->fetchAll();
			$PStatement->closeCursor();
			
			
			
			return($OrderRows);
		}
		catch(PDOException $er)
		{
			print "Error: ".$er;
			exit;
		}
	}
	
	/*
	 * Pulls the meal Options for the the Order
	 * Param: The Order Id
	 */
	 public function PullMobForOrder($orderId)
	 {
	 	$mobOptions = array();
		$query = "select MOB.MOB_OPTION from ORDERS O ".
				"inner join SELECTED_MEAL_OPTIONS SMO on O.ORDER_ID = SMO.SMO_ORDER_ID ".
				"inner join MEAL_OPTIONS_BASE MOB on MOB.MOB_ID = SMO.SMO_MOB_ID ".
				"where O.ORDER_ID = :orderId;";
		
		$PStatement = $this->db->prepare($query);
		$PStatement->bindValue(":orderId", $orderId);
		$PStatement->execute();
		$rows = $PStatement->fetchAll();
		
		foreach($rows as $row)
		{
			array_push($mobOptions, $row['MOB_OPTION']);
		}
		
		return($mobOptions);
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
			$mealQuery = "select M.MEAL_ID, M.MEAL_NAME, M.MEAL_PRICE from MEALS M ".
					"order by M.MEAL_NAME;";
			
			//Pull the users
			$users = $this->PullAllUsers();
			
			//Pull the rice information
			$rice = $this->PullRiceTypes();
			
			
			//Pull the meal information
			$PStatement = $this->db->prepare($mealQuery);
			$PStatement->execute();
			$rows = $PStatement->fetchAll();
			foreach ($rows as $row)
			{
				$meals[$row['MEAL_ID']]["name"] = $row['MEAL_NAME'];
				$meals[$row['MEAL_ID']]["price"] = $row['MEAL_PRICE'];
			}
			
			//Close the database connection.
			$PStatement->closeCursor();
			
			$outputPacket = new MealTrackingData($users, $meals, $rice);
			
			return($outputPacket);
		}
		catch(PDOException $er)
		{
			print "Error: ".$er;
			exit;
		}
	}

	/*
	 * Pulls the meals options based on the key id.
	 */
	public function PullMealOptions($mealId)
	{
		try
		{
			$mob = array();
			
			$mealQuery = "select MOB.MOB_ID, MOB.MOB_OPTION from MEALS M ".
						"inner join MEAL_OPTIONS MO on MO.MO_MEAL_ID = M.MEAL_ID ".
						"inner join MEAL_OPTIONS_BASE MOB on MOB.MOB_ID = MO.MO_MOB_ID ".
						"where M.MEAL_ID = :mealId;".
						"order by MOB.MOB_ID ";
						
			$PStatement = $this->db->prepare($mealQuery);
			$PStatement->bindValue(':mealId', (int)$mealId);
			$PStatement->execute();
			$rows = $PStatement->fetchAll();
			$PStatement->closeCursor();
			
			foreach($rows as $row)
			{
				$mob[$row["MOB_ID"]] = $row["MOB_OPTION"];
			}
			
			return($mob);
		}
		catch(PDOException $er)
		{
			print "Error: ".$er;
			exit;
		}
	}
	
	/*
	 * Stores the meal into the database with it's selected options.
	 */
	public function StoreMeal($meal)
	{
		$insert = "";
		try
		{			
			$insert = "INSERT INTO MEALS VALUES(null, :meal, :price, 0);";
			
			$PStatement = $this->db->prepare($insert);
			$PStatement->bindValue(':meal', $meal->MealName);
			$PStatement->bindValue(':price', (float)$meal->Price);
			$PStatement->execute();
			$newId = $this->db->lastInsertId();
			
			if(count($meal->Mobs) > 0)
			{
				$insert = "INSERT INTO MEAL_OPTIONS VALUES";
				
				$count = 1;
				
				foreach ($meal->Mobs as $option)
				{
					$insert .= '(:mobid'.$count.', :mealid'.$count.')';
					if($count != count($meal->Mobs))
					{
						$insert .= ',';
					}
					$count++;
				}
				
				$insert.= ';';
				$PStatement = $this->db->prepare($insert);
				$count = 1;
				foreach($meal->Mobs as $option)
				{
					$PStatement->bindValue(':mobid'.$count, (int)$option);
					$PStatement->bindValue(':mealid'.$count, (int)$newId);
					$count++;
				}
				$PStatement->execute();
			}
			
			$PStatement->closeCursor();
			return;
		}
		catch(PDOException $er)
		{
			print "Error: ".$er."<br><br>";
			print "SQL Statement: ".$insert;
			exit;
		}
	}

	/*
	 * Stores the order into the database.
	 */
	public function StoreOrder($meal)
	{
		$mobQuery = "";
		try
		{
			$query = "INSERT INTO ORDERS VALUES(null, NOW(), :userid, :mealid, :riceid);";

			$PStatement = $this->db->prepare($query);
			$PStatement->bindValue(':userid', (int)$meal->USER_ID);
			$PStatement->bindValue(':mealid', (int)$meal->MEAL_ID);
			$PStatement->bindValue(':riceid', (int)$meal->RICE_ID);
			$PStatement->execute();
			$newId = $this->db->lastInsertId();

			if(count($meal->MOB_OPTION) > 0)
			{
				$mobQuery = "INSERT INTO SELECTED_MEAL_OPTIONS VALUES";

				$count = 1;

				foreach ($meal->MOB_OPTION as $option)
				{
					$mobQuery .= '(:mobid'.$count.', :orderid'.$count.')';
					if($count != count($meal->MOB_OPTION))
					{
						$mobQuery .= ',';
					}
					$count++;
				}
				$mobQuery.= ';';
				$PStatement = $this->db->prepare($mobQuery);
				$count = 1;
				foreach($meal->MOB_OPTION as $option)
				{
					$PStatement->bindValue(':mobid'.$count, (int)$option);
					$PStatement->bindValue(':orderid'.$count, (int)$newId);
					$count++;
				}
				$PStatement->execute();
			}

			$PStatement->closeCursor();
			return;
		}
		catch(PDOException $er)
		{
			print "Error: ".$er."<br><br>";
			print "SQL Statement: ".$mobQuery;
			exit;
		}
	}

	/*
	 * Pulls all the mobs in one shot.
	 */
	public function PullAllMobs()
	{
		$query = "";
		try
		{
			$mobs = array();
			$query = "select MOB.MOB_ID, MOB.MOB_OPTION from MEAL_OPTIONS_BASE MOB;";
			
			$PStatement = $this->db->prepare($query);
			$PStatement->execute();
			$rows = $PStatement->fetchAll();
			
			$PStatement->closeCursor();
			
			foreach($rows as $row)
			{
				$mobs[$row['MOB_ID']] = $row['MOB_OPTION'];
			}
			
			return $mobs;
		}
		catch(PDOException $er)
		{
			print "Error: ".$er."<br><br>";
			print "SQL Statement: ".$query;
			exit;
		}
	}
	
	/*
	 * Pull all of the rice types.
	 */
	public function PullRiceTypes()
	{
		$riceQuery ="";
		try
		{
			$rice = array();
			$riceQuery = "select r.RICE_ID as id, r.RICE_TYPE as type from RICE r";
			
			//Pull the rice information
			$PStatement = $this->db->prepare($riceQuery);
			$PStatement->execute();
			$rows = $PStatement->fetchAll();
			foreach ($rows as $row)
			{
				$rice[$row['id']] = $row['type'];
			}
			
			$PStatement->closeCursor();
			return($rice);
		}
		catch(PDOException $er)
		{
			print "Error: ".$er."<br><br>";
			print "SQL Statement: ".$riceQuery;
			exit;
		}
	}
	
	/*
	 * Pulls all users
	 */
	public function PullAllUsers()
	{
		$userQuery = "";
		$users = array();
		
		try
		{
			$userQuery = "select u.USER_ID as userid, u.USER_NAME as username from USERS u order by username;";
			$PStatement = $this->db->prepare($userQuery);
			$PStatement->execute();
			$rows = $PStatement->fetchAll();
			foreach ($rows as $row)
			{
				$users[$row['userid']] = $row['username'];
			}
			$PStatement->closeCursor();
			return $users;
		}
		catch(PDOException $er)
		{
			print "Error: ".$er."<br><br>";
			print "SQL Statement: ".$userQuery;
			exit;
		}
	}
	
	/*
	 * Deletes a user from the database.
	 */
	public function DeleteUser($userId)
	{
		$deleteStmt = "";
		try
		{
			//Delete the order references for the user.
			$deleteStmt = "delete from ORDERS where ORDER_USER_ID = :userid;";
			$PStatement = $this->db->prepare($deleteStmt);
			$PStatement->bindValue(":userid", (int)$userId);
			$PStatement->execute();
			
			//Delete the user.
			$deleteStmt = "delete from USERS where USER_ID = :userid;";
			$PStatement = $this->db->prepare($deleteStmt);
			$PStatement->bindValue(":userid", (int)$userId);
			$PStatement->execute();
			
			
			$PStatement->closeCursor();
			return;
		}
		catch(PDOException $er)
		{
			print "Error: ".$er."<br><br>";
			print "SQL Statement: ".$deleteStmt;
			exit;
		}
	}
	
	/*
	 * Deletes a user from the database.
	 */
	public function AddNewUser($name)
	{
		$insertStmt = "";
		try
		{
			$insertStmt = "insert into USERS values(null, :name);";
			$PStatement = $this->db->prepare($insertStmt);
			$PStatement->bindValue(":name", $name);
			$PStatement->execute();
			$PStatement->closeCursor();
			return;
		}
		catch(PDOException $er)
		{
			print "Error: ".$er."<br><br>";
			print "SQL Statement: ".$insertStmt;
			exit;
		}
	}
}


?>
