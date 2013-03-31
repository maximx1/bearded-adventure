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

/**
 * Controller that Handles loading, adding, and deleting from the cart.
 * 
 * @author Justin Walrath <walrathjaw@gmail.com>
 * @since 3/30/2013
 */

	
	$OrderLoader = new ManipulateOrderLoading();
	$prevOrder = $OrderLoader->LoadOrderById(9);
	
	echo $prevOrder->CreateHistoryString();

?>
