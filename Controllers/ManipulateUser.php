<?php
require '../db/db.php';

/*
 * Controller class that manipulates the users.
 * Author: Justin Walrath
 * Since: 2/5/2013
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