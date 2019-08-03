<?php
//connecting to database and getting the connection object
	$conn = mysqli_connect("localhost", "root", "Gayatri1999@", "fcm_db");
	
	$key= "0123456789abcdef";		
	
	if($_SERVER['REQUEST_METHOD']=='POST')
	{
		$username =$_POST["username"];
		$otp = $_POST["otp"];
		
	

	
	

	
	
		$sql = "SELECT `username`, `email`, `password`FROM `users_db` WHERE `username`='$username' AND`otp`='$otp' ";
		
		$result = mysqli_query($conn,$sql);
		$check=mysqli_fetch_array($result);
		
		/*if(isset($check)){
			echo"success:"+;
			
		}*/
		if(mysqli_num_rows($result)>0){
			echo $key.":"."success";
		}
		else{
			echo"failure";
		}
	
	
		
	}

	
?>



