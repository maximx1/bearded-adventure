<?php

/*
 * View that allows the user to create a new side.
 * Author: Justin Walrath <walrathjaw@gmail.com>
 * Since: 3/26/2013
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

require 'Controllers/LoadAllMealOptionsFromBase.php';
require 'Controllers/LoadAllOptgroups.php';

$sideLoader = new LoadAllMealOptionsFromBase();
$sides = $sideLoader->LoadRice();

?>

<!DOCTYPE html>
<html>
	<head>
		<title>IDI - Chinese Friday</title>
		<link href="Styles/index.css" rel="stylesheet">
	</head>
	<body>
		<div class="container">
			<h1>Create A New Side</h1>
			<a href="index.php">Go Back</a>
			<form action="SubmitSide.php" method="get">
				<h3>Enter Side Data</h3>
				Side name: 
				<input id="SideName" type="text" name="SideName"/><!--Need to add the .js to blur-->
				&emsp;
				<input type="submit" value="Submit" />
                <?php
                foreach($sides as $value)
                {
                    print "<p>" .$value."</p>";
                }
                ?>
			</form>
		</div>
		<script src="Scripts/jquery-1.9.0.min.js"></script>
		<script src="Scripts/CreateSide.js"></script>
	</body>
</html>
