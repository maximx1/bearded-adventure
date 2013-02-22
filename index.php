<!DOCTYPE html>
<html>
<head>
	<title>IDI Chinese Friday</title>
	<link href="Styles/index.css" rel="stylesheet">
</head>
<body>
	<div class="container">
		<h1 id="pageBanner">Welcome to chinese friday unstyled beta.</h1>
		<a href="CreateOrder.php">
			<div class='frontPageButtons'>
				Make An Order
			</div>
		</a>
		<a href="DisplayOrders.php">
			<div class='frontPageButtons'>
				View Todays Orders
			</div>
		</a>
		<a href="CreateMeal.php">
			<div class='frontPageButtons'>
				Add New Meal Option
			</div>
		</a>
		<a href="ManageUsers.php">
			<div class='frontPageButtons'>
				User Manage
			</div>
		</a>
		<div id="tutorialSection">
			<h2>
				How To Use:
			</h2>
			<div class="tutorial">
				<h3>How to Make an Order</h3>
				<p>
					Click on the "Make An Order" tab and select your name and meal. 
					Once your meal is selected a few options for that meal will open up.
					Select which options you would like to add to your meal.
					Select Which type of rice you would like then click Submit. 
				</p>
			</div>
			<div class="tutorial">
				<h3>How to Display the Day's Current Orders</h3>
				<p>
					Click on the "View Todays Orders" tab and just wait for all of the orders to load.
					You can select a printer friendly page by clicking on the "Printer Friendly" link.
				</p>
			</div>
			<div class="tutorial">
				<h3>How to Add a New Meal to the Database</h3>
				<p>
					Click on the "Add New Meal Option" tab and enter the following:
					<ul>
						<li>Name of the meal ## In Format: L# Meal Name</li>
						<l1>Cost of the meal ## In Format: 0.00</l1>
						<li>Which meal options are available with the meal</li>
					</ul>
					Then hit submit. There is no error checking yet so please be accurate.
				</p>
			</div>
			<div class="tutorial">
				<h3>How to Manage Users</h3>
				<p>
					Click on the "User Manage" tab and wait for all of the users to load.
					To delete a name just click on delete next to the user.
					Deleting a user will remove their meals from the database.
					To add a user just enter their unique name, and click add.
				</p>
			</div>
		</div>
	</div>
</body>
</html>
<!--
Credits:
	Background image from: 'http://images.colourbox.com/thumb_COLOURBOX1473336.jpg'
-->
