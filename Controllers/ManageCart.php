<?php
/*
 * Copyright 2013 Justin Walrath & Associates
 	This program is free software: you can redistribute it and/or modify
    it under the terms of the GNU General Public License as published by
    the Free Software Foundation, either version 3 of the License, or
    (at your option) any later version.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with this program.  If not, see <http://www.gnu.org/licenses/>.
 */

//The directory of this specific file so that all inclusive files can be included relatively.
$dname = dirname(__FILE__);

//Containers
require_once($dname."/../Containers/NewOrder.php");
require_once($dname."/../Containers/Order.php");

//Controllers
require_once($dname."/../Controllers/ManipulateOrderLoading.php");

//Tools
require_once($dname."/../Tools/UUID.php");

/**
 * Controller that Handles loading, adding, and deleting from the cart.
 * 
 * @author Justin Walrath <walrathjaw@gmail.com>
 * @since 3/30/2013
 */
if(isset($_GET["actionControl"]))
{
	//Reset the session lifetime
	$lifetime = 36000;
	session_set_cookie_params($lifetime);
	session_start();
	
	//This is a list of newOrders objects for the Session cart.
	$orderList = array();
	
	//Pull the cart list from the $_SESSION variable.
	if(isset($_SESSION["cartList"]))
	{
		$orderList = $_SESSION["cartList"];
	}
	
	//Load the cart upon start.
	if(strcasecmp($_GET["actionControl"], "loadCart") == 0)
	{
		CreateJSONFromCart($orderList);
	}
	else if(strcasecmp($_GET["actionControl"], "addToCart") == 0)
	{
		$OrderLoader = new ManipulateOrderLoading();
		if(isset($_GET['orderId']))
		{
			$prevOrder = $OrderLoader->LoadOrderById($_GET['orderId']);
			array_push($orderList, $prevOrder);
		}
		else if($_GET['userSelect'] && isset($_GET['mealSelect']) && isset($_GET['riceSelect']))
		{
			$mealid = $_GET['mealSelect'];
			$meal = $OrderLoader->LoadMealFromId($mealid);
			$rice = $OrderLoader->LoadSideFromId($_GET['riceSelect']);
			
			if(isset($_GET['mealOptionsSelect']))
			{
				if(empty($_GET['mealOptionsSelect']))
				{
					$moboptions = array();
				}
				else
				{
					$moboptions = $OrderLoader->LoadMobsFromIds($_GET['mealOptionsSelect']);
				}
			}
			
			$order = new Order(0, "", $meal[$mealid]["name"], $moboptions, $rice, $meal[$mealid]["price"], "");
			$order->AddIdsForDuplication($_GET['userSelect'], $_GET['mealSelect'], $_GET['riceSelect']);

			array_push($orderList, $order);
		}
		
		//Pass the updated cart to the session variable.
		$_SESSION["cartList"] = $orderList;
		CreateJSONFromCart($orderList);
	}
}

/**
 * Encodes the Json for the cart.
 * @param $cart the cart to encode.
 */
function CreateJSONFromCart($cart)
{
	$jsonwrapper = array();
	
	foreach($cart as $item)
	{
		array_push($jsonwrapper, $item->CreateCartString());
	}
	
	echo json_encode($jsonwrapper);
}

?>