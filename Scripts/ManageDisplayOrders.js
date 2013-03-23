//Scripts for managing the user controls
//Author: Justin Walrath <walrathjaw@gmail.com>
//Since: 2/7/2013
// 
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
		//Detect if user is clicking delete.
		$(".delete").click
		(
			function()
			{
				var id = $(this).attr('id');
				
				//Verify that the person actually wishes to delete this user
				if(!confirm("You sure you want to delete order?"))
				{
					return false;
				}
				
				//Submit the userid and reload the users
				$.getJSON("Controllers/ControlOrderLoading.php",
					{ 
						actionControl: "deleteOrder",
						id: id
					},
					function(orderList)
					{
						var orderTable = "<table>";
						
						for(i = 0; i < orderList.length; i += 1)
						{
							orderTable += orderList[i];
						}
						
						orderTable += "</table>";
						orderTable += "<script src='Scripts/ManageDisplayOrders.js'></script>";
						
						$("#orderList").html(orderTable);
					}
				);
				
				//Display a message of success
				$("#message").text("User removed");
			}
		);
	}
);