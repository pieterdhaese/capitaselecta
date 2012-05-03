<?php
require_once("connectvars.php");
//make database connection
	function get_db_connection () 
	{
		
		return mysqli_connect(DB_SERVER, DB_USER, DB_PASS, DB_NAME);
	}
	
	// returns an array with all the values of a resultset
	// parameters: $resultset: resultset from a mysqli_query
	// returns: array with values of the resultset
	function get_values ($resultset) {
		$data = array();
		for ($i=0; $i<mysqli_num_rows($resultset); $i++) {
			$row = mysqli_fetch_assoc($resultset);
			array_push($data,$row);
		}
		return $data;
	}
	
	function get_users($conn)
	{
		$query = "SELECT * FROM datalife_members";
		return mysqli_query($conn,$query);
	}
	
	function put_user_in_database($user,$conn)
	{
		$query=	"INSERT INTO user(username,first_name,last_name,password,email) VALUES('".$user['login']."','".$user['voornaam']."','".$user['achternaam']."','".$user['password']."','".$user['email']."');";
		mysqli_query($conn,$query);
	}
	
	