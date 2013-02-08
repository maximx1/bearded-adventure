//Extended scripts for managing the user controls
//Author: Justin Walrath <walrathjaw@gmail.com>
//Since: 2/7/2013

//Load as soon as the document is ready.
$(document).ready
(
	function()
	{
		//Call the load user list as soon as the page has completed loading.
		$("#userData").load("Controllers/ControlUserManip.php?actionControl=loadUser");
	}
);