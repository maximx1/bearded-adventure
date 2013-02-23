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
				var name = $("#usernameBox").val()//.replace(/ /g, "%20");
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
						var userTable = "<table>";
						for(var key in userList)
						{
							userTable += "<tr><td>" + userList[key] + "</td><td><input class='delete' id='" + key + "' type='button' value='Delete' /></td></tr>";
							//alert(iuserList[key]);
						;}
						userTable += "<tr><td>&nbsp;</td><td>&nbsp;</td></tr>";
						userTable += "<tr><td><input id='usernameBox' type='text'/></td>";
						userTable += "<td><input class='add' type='button' value='Add User'/></td></tr>";
						userTable += "</table>";
						$("#userData").html(userTable);
					}
				);
				//$("#userData").load("Controllers/ControlUserManip.php?actionControl=addUser&name=" + name);
				$("#message").text("User added");
			}
		);
	}
);
