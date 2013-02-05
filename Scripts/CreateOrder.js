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