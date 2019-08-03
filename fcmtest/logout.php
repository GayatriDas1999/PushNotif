<?php
//connecting to database and getting the connection object
	$conn = mysqli_connect("localhost", "root", "Gayatri1999@", "fcm_db");
		
	
	if($_SERVER['REQUEST_METHOD']=='POST')
	{
		$username =$_POST["username"];
			
		
		$sql = "DELETE FROM `users` WHERE `username`= '$username'";	
	
		if (mysqli_query($conn, $sql)) 
	 {
		echo "deleted";
	 }
	 else 
	 {
		echo "Error: " . $sql . " " . mysqli_error($conn);
	 }
	
	mysqli_close($conn);
	
		
	}

	
?>