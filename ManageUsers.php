<!--php
 *
 * View for manipulating the users that can make an order.
 * Author: Justin Walrath <walrathjaw@gmail.com>
 * Since: 2/7/2013
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
			<p id='message'>&nbsp;</p>
			<div id="userData"></div>
				
		</div>
			
		<!--Load scripts at the end so as to not freeze shit up.-->
		<script src="Scripts/jquery-1.9.0.min.js"></script>
		<script src="Scripts/LoadUserManager.js"></script>
	</body>
</html>
