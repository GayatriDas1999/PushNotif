<?php
//connecting to database and getting the connection object
		$conn = mysqli_connect("localhost", "root", "Gayatri1999@", "fcm_db");
		
	
	if($_SERVER['REQUEST_METHOD']=='POST')
	{
		$username =$_POST["username"];
		$password =$_POST["password"];
		$p=md5($password);
	

	
	

	
	
		$sql = "SELECT `username`,`password`FROM `users_db` WHERE `username`='$username' AND`password`='$p'";
	
		$result = mysqli_query($conn,$sql);
		$check=mysqli_fetch_array($result);
		
		if(isset($check)){
			echo"success";
			
		}
		else{
			echo"Wrong Username or Password";
		}
	
	
		
	}

	
?>