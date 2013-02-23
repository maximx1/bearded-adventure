//Scripts for managing the user controls
//Author: Justin Walrath <walrathjaw@gmail.com>
//Since: 2/7/2013

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
				if(!confirm("You sure you want to delete user?"))
				{
					return false;
				}
				$("#userData").load("Controllers/ControlUserManip.php?actionControl=deleteUser&id=" + id);
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
	
	//Create the user rows
	for(i = 0; i < userList['key'].length; i += 1)
	{
			userTable += "<tr><td>"+ userList['val'][i] + "</td><td><input class='delete' id='" + userList['key'][i] + "' type='button' value='Delete' /></td></tr>";
	}
	//for(var key in userList)
	//{
	//	userTable += "<tr><td>"+ userList[key] + "</td><td><input class='delete' id='" + key + "' type='button' value='Delete' /></td></tr>";
	//}
	userTable += "<tr><td>&nbsp;</td><td>&nbsp;</td></tr>";
	userTable += "<tr><td><input id='usernameBox' type='text'/></td>";
	userTable += "<td><input class='add' type='button' value='Add User'/></td></tr>";
	userTable += "</table>";
	
	//Place the table data into the main page
	$("#userData").html(userTable);
}
