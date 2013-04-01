<?php
/*
 * A view class that displays a successful logging of a meal.
 * Author: Justin Walrath <walrathjaw@gmail.com>
 * Since: 2/3/2013
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
 
require_once("Controllers/StoreOrder.php");
require_once("Containers/NewOrder.php");
require_once("Tools/UUID.php");

?>
<!DOCTYPE html>
<html>
	<head>
		<title>IDI Chinese Friday</title>
		<link href="Styles/index.css" rel="stylesheet">
	</head>
	<body>
		<div class="container">
			<a href="CreateOrder.php">Make An Order</a>
			<a href="DisplayOrders.php">View Todays Orders</a>
			<a href="CreateMeal.php">Add New Meal Option</a>
			<?php
			
			//Reset the session lifetime
			$lifetime = 36000;
			session_set_cookie_params($lifetime);
			session_start();
			
			//Generate a session ID if it has expired.
			if(!isset($_SESSION['sessionId']))
			{
				$_SESSION['sessionId'] = UUID::NewUUID();
			}
			
			if(isset($_SESSION['cartList']) && isset($_GET['userid']))
			{
				foreach ($_SESSION['cartList'] as $item)
				{
					echo array_keys($item->MOB_OPTION);
					$order = new NewOrder(
								$_GET['userid'],
								$item->MEAL_ID,
								array_keys($item->MOB_OPTION),
								$item->RICE_ID,
								$_SESSION['sessionId']
							 );
					$orderer = new StoreOrder();
					$successMessage = $orderer->RecordOrder($order);
					$_SESSION['cartList'] = array();
				}
				print "<h1>".$successMessage."</h1>";
			}
			else
			{
				?>
				
				<h1>Error:</h1>
				<p>
					No meal data was found. You must enter the meal data.
				</p>
				
				<?php
			}
			?>

		</div>
	</body>
</html>