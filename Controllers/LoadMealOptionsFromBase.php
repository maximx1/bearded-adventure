<?php
require_once('../db/db.php');

if(isset($_GET["mealId"]))
{
	$mealId = $_GET["mealId"];
	$db = new DB();
	$result = $db->PullMealOptions((int)$mealId);
	
	foreach($result as $id => $mob)
	{
		print "<h3>".$id."</h3><p>".$mob."</p>";
	}
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