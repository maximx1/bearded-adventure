<!--php
 *
 * View for manipulating the users that can make an order.
 * Author: Justin Walrath <walrathjaw@gmail.com>
 * Since: 2/7/2013
 *
-->

<html>
	<head>
		<title>
			IDI - Chinese Friday
		</title>
		<link href="Styles/index.css" rel="stylesheet">
	</head>
	<body>
		<div class="container">
			<h1>User Manager</h1>
			<a href="index.php">Go Back</a><br>
			<p id='message'></p>
			<table>
				<div id="userData"></div>
			</table>
				
		</div>
			
		<!--Load scripts at the end so as to not freeze shit up.-->
		<script src="Scripts/jquery-1.9.0.min.js"></script>
		<script src="Scripts/ManageUsers.js"></script>
	</body>
</html>