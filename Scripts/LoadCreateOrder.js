//Extended scripts for loading the Create Order page information.
//Author: Justin Walrath <walrathjaw@gmail.com>
//Since: 3/27/2013
// 
//Copyright 2013 Justin Walrath & Associates
// 	This program is free software: you can redistribute it and/or modify
//    it under the terms of the GNU General Public License as published by
//    the Free Software Foundation, either version 3 of the License, or
//    (at your option) any later version.
//
//    This program is distributed in the hope that it will be useful,
//    but WITHOUT ANY WARRANTY; without even the implied warranty of
//    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
//    GNU General Public License for more details.
//
//    You should have received a copy of the GNU General Public License
//    along with this program.  If not, see <http://www.gnu.org/licenses/>.

//Load as soon as the document is ready.
$(document).ready
(
	function()
	{
		//Load the user data immediately once the rest of the page loads
		$.getJSON("Controllers/ControlUserManip.php",
			{ 
				actionControl: "loadUser"
			},
			function(userList)
			{
				var userListString = "<h3>Choose User:</h3>"
				usserListString += "<select id='userSelect' name='userSelect'>";
				userListString += "<option value='nil' selected='selected'></option>";
				for(i = 0; i < userList['key'].length; i++)
				{
					userListString += "<option value='" + userList['key'][i] + "'>" + userList['val'][i] + "</option>";
				}
				userListString += "</select>";
				
				$("#userSpace").html(userListString);
			}
		);
		
		
		/*
		<!--Show Meals-->
				<h3>Choose Meal:</h3>
				<select id='mealSelect' name='mealSelect' size=25>
					<?php
					foreach ($meals->Optgroups as $optKey => $optValue)
					{
						print "<optgroup label='".$optValue."'>";
						
						foreach ($meals->Meal as $key => $value)
						{
							if($optKey == $value["group"])
							{
								print "<option value='".$key."'>".$value["name"]." - ".$value["price"]."</option>";
							}
						}
						
						print "</optgroup>";
					}
					?>
				</select>
				*/
				
		//Load the list of them meals.
		$.getJSON("Controllers/ControlCreateOrderLoading.php",
			{
				actionControl: "loadMeals"
			},
			function(mealList)
			{
				
			}
		);
		
		//Load the ricetypes for the new meal.
		$.getJSON("Controllers/ControlCreateOrderLoading.php",
			{
				actionControl: "loadRice"
			},
			function(riceList)
			{
				var riceListString = "<h3>Choose Side:</h3>";
				riceListString += "<select id='riceSelect' name='riceSelect'>";
				for(i = 0; i < riceList['key'].length; i++)
				{
					riceListString += "<option value='" + riceList['key'][i] +"'>" + riceList['val'][i] + "</option>";
				}
				riceListString += "</select>";
				
				$("#riceSpace").html(riceListString);
			}
		);
		
		//Load the cart if there is any items.
		$.getJSON("Controllers/ManageCart.php",
			{
				actionControl: "loadCart"
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
					$("#mealCartSpace").html(cartSpace);
				}
			}
		);
		
		$("#scripts").html("<script src='Scripts/CreateOrder.js'></script>");
	}
);