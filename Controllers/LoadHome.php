<?php
require_once 'db/db.php';

class LoadHome
{
	function LoadDaysMeals()
	{
		$tmp = new DB();
		$OrderRows = $tmp->PullDaysMeals();
		
		//Testing output.
		foreach ($OrderRows as $row)
		{
			print "<p>".$row['USER_NAME']."&emsp;".$row['MEAL_NAME']."</p>";
		}
	}
}
?>
