//Extended scripts for managing the user controls
//Author: Justin Walrath <walrathjaw@gmail.com>
//Since: 2/7/2013

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
