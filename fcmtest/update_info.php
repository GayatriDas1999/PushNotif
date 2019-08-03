<?php

	 $conn = mysqli_connect("localhost", "root", "Gayatri1999@", "fcm_db");
	 
	 if($conn)
		echo"Connection Successfull...";
	 else
		echo"Connection Error";

     $u_name = $_POST["username"];
	 $u_deviceid = $_POST["deviceid"];	

	 if($u_name!=null && $u_deviceid!=null)
		 
	 {
     $sql = "INSERT INTO users (token,username)VALUES ('$u_deviceid','$u_name')ON DUPLICATE KEY UPDATE username='$u_name' ";
	 if (mysqli_query($conn, $sql)) 
	 {
		echo "New record created successfully !";
	 }
	 else 
	 {
		echo "Error: " . $sql . " " . mysqli_error($conn);
	 }
	 mysqli_close($conn);
	 }
	 
	 else{
		 
		echo "VALUE ERROR";
	 }
	 

?>