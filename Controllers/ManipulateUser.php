<?php
require '../db/db.php';

/*
 * Controller class that manipulates the users.
 * Author: Justin Walrath
 * Since: 2/5/2013
 * 
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
 class ManipulateUser
 {
 	public $db;
	
	/*
	 * Constructor: Connects the database
	 */
	public function __construct()
	{
		$this->db = new DB();
	}
	
	/*
	 * Loads the users for display.
	 */
	public function LoadUsers()
	{
		return($this->db->PullAllUsers());
	}
	
	/*
	 * Adds new user.
	 */
	public function AddUser($name)
	{
		$this->db->AddNewUser($name);
	}
	
	/*
	 * Deletes a user.
	 */
	public function DeleteUser($userId)
	{
		$this->db->DeleteUser($userId);
	}
 }

?>