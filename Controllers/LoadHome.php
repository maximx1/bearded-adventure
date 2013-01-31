<?php
require_once 'db/db.php';

class LoadHome
{
	function LoadDaysMeals()
	{
		$db = new DB();
		$db->ConnectDB();
		$OrderRows = $db->PullDaysMeals();
		
		//Testing output.
		foreach ($OrderRows as $row)
		{
			print "<p>".$row['USER_NAME']."&emsp;".$row['MEAL_NAME']."</p>";
		}
	}
}
?>
