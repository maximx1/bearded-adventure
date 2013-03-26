//Scripts for importing the meal options when the user selects a meal.
//Author: Justin Walrath <walrathjaw@gmail.com>
//Since: 2/7/2013
// 
//Copyright 2013 Justin Walrath & Associates
// 	This program is free software: you can redistribute it and/or modify
//    it under the terms of the GNU General Public License as published by
//    the Free Software Foundation, either version 3 of the License, or
//    (at your option) any later version.

//    This program is distributed in the hope that it will be useful,
//    but WITHOUT ANY WARRANTY; without even the implied warranty of
//    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
//    GNU General Public License for more details.

//    You should have received a copy of the GNU General Public License
//    along with this program.  If not, see <http://www.gnu.org/licenses/>.


//Load as soon as the document is ready.

var updatingHistory = false;
var updatingMeal = false;

$(document).ready
(
	function()
	{
		$("#userSelect").change(
			function()
			{
				updatingMeal = true;
				updatingHistory = true;
				var uid = $("#userSelect option:selected").val();
				$("#mealHistorySpace").load("Controllers/LoadUserHistory.php?userId=" + uid);
				updatingMeal = false;
				updatingHistory = false;
			}
		);
		
		$("mealHistorySelect").change(
			function()
			{
				if(updatingMeal == false)
				{
					updatingHistory = true;
					var hid = $("#mealHistorySelect option:selected").val();
					$("#mealSelect option:selected").val([]);
					$("#mealOptions").load("Controllers/LoadMealOptionsFromBase.php?mealId=" + hid);
					$("#submitButton").removeAttr('disabled');
					updatingHistory = false;
				}
			}
		);
		
		$("#mealSelect").change(
			function()
			{
				if(updatingHistory == false)
				{
					updatingMeal = true;
					var id = $("#mealSelect option:selected").val();
					$("#mealHistorySelect option:selected").val([]);
					$("#mealOptions").load("Controllers/LoadMealOptionsFromBase.php?mealId=" + id);
					$("#submitButton").removeAttr('disabled');
					updatingMeal = false;
				}
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
		return false;	
	}
}
