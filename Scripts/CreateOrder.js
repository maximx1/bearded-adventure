//Scripts for importing the meal options when the user selects a meal.
//Author: Justin Walrath <walrathjaw@gmail.com>
//Since: 2/7/2013

//Load as soon as the document is ready.
$(document).ready
(
	function()
	{
		$("#mealSelect").change(
			function()
			{
				var id = $("#mealSelect option:selected").val();
				$("#mealOptions").load("Controllers/LoadMealOptionsFromBase.php?mealId=" + id);
				$("#submitButton").removeAttr('disabled');
			}
		);
	}
);

function validations()
{
	var userSelectTag = document.getElementById('userSelect');
	var userSelected = userSelectTag.options[userSelectTag.selectedIndex].value;
	if (userSelected == "nil")
	{
		alert("You must choose a user!");
	}
	
		return(false);	
	/*if($("#userSelect option:selected").val == "nil")
	{
		alert("You must choose a user!");
		return(false);
	}*/
}