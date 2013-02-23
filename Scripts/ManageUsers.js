//Scripts for managing the user controls
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
		
		prepDom();
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
	
	//Place the table data into the main page
	$("#userData").html(userTable);
}

function prepDom()
{	
	//Detect if user is clicking delete.
	$(".delete").on
	(
		"click",
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
			
			prepDom();
		}
	);
	
	//Detects when the user presses the add button.
	$(".add").on
	(
		"click",
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
			
			prepDom();
		}
	);
}
