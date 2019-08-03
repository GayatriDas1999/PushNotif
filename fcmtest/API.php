<?php 

	//database constants
	define('DB_HOST', 'localhost');
	define('DB_USER', 'root');
	define('DB_PASS', 'Gayatri1999@');
	define('DB_NAME', 'fcm_db');
	
	//connecting to database and getting the connection object
	$conn = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
	
	//Checking if any error occured while connecting
	if (mysqli_connect_errno()) {
		echo "Failed to connect to MySQL: " . mysqli_connect_error();
		die();
	}
	
	
	$stmt = $conn->prepare("SELECT `DateTime`, `PeakCode`, `StationName`,`PeakFactor`,`RiseTime` FROM `data` ");
	
	//executing the query 
	$stmt->execute();
	
	//binding results to the query 
	$stmt->bind_result($s_datetime, $s_peakcode, $s_stationame,$s_peakfactor,$s_risetime);
	
	$users = array(); 
	
	//traversing through all the result 
	while($stmt->fetch()){
		$temp = array();
		
		$temp['datetime'] = $s_datetime; 
		$temp['peakcode'] = $s_peakcode; 
		$temp['stationname'] = $s_stationame; 
		$temp['peakfactor'] = $s_peakfactor; 
		$temp['risetime'] = $s_risetime;
		array_push($users, $temp);
	}
	
	//displaying the result in json format 
	echo json_encode($users);
	
	?>