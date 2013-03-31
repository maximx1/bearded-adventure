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
$(document).ready
(
	function()
	{
		$("#userSelect").change(
			function()
			{
				var uid = $("#userSelect option:selected").val();
				$.getJSON("Controllers/ControlCreateOrderLoading.php",
					{
						actionControl: "loadHistory",
						id: uid
					},
					function(historyList)
					{
						if(historyList.length != 0)
						{
							var historySpace = "";
							historySpace += "<h3>Recent Meals:</h3>";
							historySpace += "<div class = 'tutorial historyArea'>";
							
							for(i = 0; i < historyList.length; i++)
							{
								historySpace += "<table class='mealHistorySelect'>";
								historySpace += historyList[i];
								historySpace += "</table>";
								
								if(i < historyList.length - 1)
								{
									historySpace += "<hr>";
								}
							}
							historySpace += "</div>";
							historySpace += "<script src='Scripts/CreateOrder.js'></script>";
							$("#mealHistorySpace").html(historySpace);
						}
					}
				);
			}
		);
		
		$(".addHistoryItem").click(
			function()
			{
				var hid = $(this).attr('id');
				$("#mealSelect option:selected").val([]);
				$.getJSON("Controllers/ManageCart.php",
					{
						actionControl: "addToCart",
						orderId: hid
					},
					function(cartInformation)
					{
						if(cartInformation.length != 0)
						{
							var cartSpace = "";
							cartSpace += "<h3>Order Cart:</h3>";
							cartSpace += "<div class = 'tutorial historyArea'>";
							
							for(i = 0; i < cartInformation.length; i++)
							{
								cartSpace += "<table class='cartItem'>";
								cartSpace += cartInformation[i];
								cartSpace += "</table>";
								
								if(i < cartInformation.length - 1)
								{
									cartSpace += "<hr>";
								}
							}
							cartSpace += "<input id='SubmitOrderButton' type='button' value='Place Order' />";
							cartSpace += "</div>";
							cartSpace += "<script src='Scripts/CreateOrder.js'></script>";
							$("#mealCartSpace").html(cartSpace);
						}
					}
				);
				//$("#submitButton").removeAttr('disabled');
			}
		);
		
		$("#mealSelect").change(
			function()
			{
				var id = $("#mealSelect option:selected").val();
				$("#mealHistorySelect option:selected").val([]);
				$("#mealOptions").load("Controllers/LoadMealOptionsFromBase.php?mealId=" + id);
				$(".addNewOrder").removeAttr('disabled');
				//<input id="submitButton" type="submit" value="Submit" disabled="disabled"/>
			}
		);
		
		$(".addNewOrder").click(
			
		);
		//<input id="submitButton" type="submit" value="Submit" disabled="disabled"/>
				//<input class='addNewOrder' id='" . $this->ORDER_ID . "' type='button' value='Add' />
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