<?php
require_once 'db/db.php';
$db;

function LoadDaysMeals()
{
	$db = ConnectDB();
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
		
		//Testing output.
		foreach ($OrderRows as $row)
		{
			print "<p>".$row['USER_NAME']."&emsp;".$row['MEAL_NAME']."</p>";
		}
	}
	catch(PDOException $er)
	{
		print "Error: " + $er; 
	}
	return;
}
?>
