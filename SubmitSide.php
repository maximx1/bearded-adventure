<?php
/*
 * View to show successful submition of the side insertions.
 * Author: Justin Walrath
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
 
require_once("Controllers/StoreSide.php");
?>

<!DOCTYPE html>
<html>
	<head>
		<title>
			IDI - Chinese Friday
		</title>
		<link href="Styles/index.css" rel="stylesheet">
	</head>
	<body>
		<div class="container">
			<a href="CreateSide.php">Make An Side</a>
			<a href="DisplaySides.php">View Todays Orders</a>
			<a href="CreateSide.php">Add Another Side</a>
			<?php
			
			if(isset($_GET['SideName']))
			{
				$sideSubmitter = new StoreSide();
				$successMessage = $sideSubmitter->RecordSide($_GET['SideName']);
				print "<h1>".$successMessage."</h1>";
			}
			else
			{
				?>
					
				<h1>Error:</h1>
				<p>
					No side data was found. You must enter the side data.
				</p>
					
				<?php
			}
			
			?>
		
		</div>
	</body>
</html>
