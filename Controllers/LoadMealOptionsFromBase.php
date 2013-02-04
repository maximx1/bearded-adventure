<?php
require_once('../db/db.php');

if(isset($_GET["mealId"]))
{
	$mealId = $_GET["mealId"];
	$db = new DB();
	$result = $db->PullMealOptions((int)$mealId);
	
	?><h3>Choose Meal Options:</h3><?php
	foreach($result as $id => $mob)
	{
		print '<input type="checkbox" name="mealOptionsSelect" value="'.$id.'">'.$mob.'<br>';
	}
	?><br><input type="submit" value="Submit" /><?php
}
else
{
	?>
	<html>
		<head>
			<title>IDI Chinese Friday</title>
		</head>
		<body>
			<h1>You need to have have the mealId set</h1>
		</body>
	</html>
	<?php
}
?>