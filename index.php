<?php require_once("Controllers/LoadHome.php"); ?>
<!DOCTYPE html>
<html>
<head>
	<title>IDI Chinese Friday</title>
</head>
<body>
	<?php
	
	$loader = new LoadHome();
	
	$loader->LoadDaysMeals();
	
	?>
</body>
</html>

