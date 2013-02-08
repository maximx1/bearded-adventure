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
				var name = $("#usernameBox").val().replace(/ /g, "%20");
				if(name == "")
				{
					return false;
				}
				$("#usernameBox").val("");
				$("#userData").load("Controllers/ControlUserManip.php?actionControl=addUser&name=" + name);
				$("#message").text("User added");
			}
		);
	}
);