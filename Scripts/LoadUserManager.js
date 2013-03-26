//Extended scripts for managing the user controls
//Author: Justin Walrath <walrathjaw@gmail.com>
//Since: 2/7/2013
// 
//Copyright 2013 Justin Walrath & Associates
// 	This program is free software: you can redistribute it and/or modify
//    it under the terms of the GNU General Public License as published by
//    the Free Software Foundation, either version 3 of the License, or
//    (at your option) any later version.
//
//    This program is distributed in the hope that it will be useful,
//    but WITHOUT ANY WARRANTY; without even the implied warranty of
//    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
//    GNU General Public License for more details.
//
//    You should have received a copy of the GNU General Public License
//    along with this program.  If not, see <http://www.gnu.org/licenses/>.

//Load as soon as the document is ready.
$(document).ready
(
	function()
	{
		//Load the user data immediately once the rest of the page loads
		//$("#userData").load("Controllers/ControlUserManip.php?actionControl=loadUser");
		$.getJSON("Controllers/ControlUserManip.php",
			{ 
				actionControl: "loadUser"
			},
			function(userList)
			{
				populateUserTable(userList);
			}
		);
	}
);

function populateUserTable(userList)
{
	var userTable = "<table>";
	
	//Create the user rows from the json wrapper
	for(i = 0; i < userList['key'].length; i += 1)
	{
		userTable += "<tr><td>"+ userList['val'][i] + "</td><td><input class='delete' id='" + userList['key'][i] + "' type='button' value='Delete' /></td></tr>";
	}
	userTable += "<tr><td>&nbsp;</td><td>&nbsp;</td></tr>";
	userTable += "<tr><td><input id='usernameBox' type='text'/></td>";
	userTable += "<td><input class='add' type='button' value='Add User'/></td></tr>";
	
	userTable += "</table>";
	userTable += "<script src='Scripts/ManageUsers.js'></script>";
	
	//Place the table data into the main page
	$("#userData").html(userTable);
}
