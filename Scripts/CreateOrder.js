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