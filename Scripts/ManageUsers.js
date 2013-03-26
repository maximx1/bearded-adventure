//Scripts for managing the user controls
//Author: Justin Walrath <walrathjaw@gmail.com>
//Since: 2/7/2013
// 
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
		//Detect if user is clicking delete.
		$(".delete").click
		(
			function()
			{
				var id = $(this).attr('id');
				
				//Verify that the person actually wishes to delete this user
				if(!confirm("You sure you want to delete user?"))
				{
					return false;
				}
				
				//Submit the userid and reload the users
				$.getJSON("Controllers/ControlUserManip.php",
					{ 
						actionControl: "deleteUser",
						id: id
					},
					function(userList)
					{
						populateUserTable(userList);
					}
				);
				//$("#userData").load("Controllers/ControlUserManip.php?actionControl=deleteUser&id=" + id);
				
				//Display a message of success
				$("#message").text("User removed");
			}
		);
		
		//Detects when the user presses the add button.
		$(".add").click
		(
			function()
			{
				var name = $("#usernameBox").val()
				if(name == "")
				{
					return false;
				}
				$("#usernameBox").val("");
				
				//Submit new user and retrieve updated user list
				$.getJSON("Controllers/ControlUserManip.php",
					{ 
						actionControl: "addUser",
						name: name 
					},
					function(userList)
					{
						populateUserTable(userList);
					}
				);
				
				//Display a successful load
				$("#message").text("User added");
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
	$("#userData").fadeOut("fast", function()
    {
        $(this).html(userTable).fadeIn("slow");
    });
}
