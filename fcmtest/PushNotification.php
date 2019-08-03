<?php 
class SendNotification {    
    private static $API_SERVER_KEY ="AAAAM3miSMg:APA91bF--6_CyaZb6DrXpB0go5UoWM9Ff1gyV4ZurCn876T6cIhdE2IF43FiPGW-A3-H4_nV-ND7CV5fYD_1MEDJ1v1BYpAPSIqKOhP2jdvV9y-UgYvrReZ1fXL0mQO_zJA4W4eshdXQ";
	//private static $API_SERVER_KEY = 'AAAAM3miSMg:APA91bF--6_CyaZb6DrXpB0go5UoWM9Ff1gyV4ZurCn876T6cIhdE2IF43FiPGW-A3-H4_nV-ND7CV5fYD_1MEDJ1v1BYpAPSIqKOhP2jdvV9y-UgYvrReZ1fXL0mQO_zJA4W4eshdXQ';
    private static $is_background = "TRUE";
    public function __construct() {     
     
    }
    public function sendPushNotificationToFCMSever($token, $title,$message) {
        $path_to_firebase_cm = 'https://fcm.googleapis.com/fcm/send';
 
        $fields = array(
            'registration_ids' => $token,
            'priority' => 10,
            'data' => array('title' => $title, 'body' =>  $message ,'sound'=>'Default','image'=>'Notification Image' ),
        );
		
		
		
        $headers = array(
            'Authorization:key=' . self::$API_SERVER_KEY,
            'Content-Type:application/json'
        );  
         
        // Open connection  
        $ch = curl_init(); 
        // Set the url, number of POST vars, POST data
        curl_setopt($ch, CURLOPT_URL, $path_to_firebase_cm); 
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_IPRESOLVE, CURL_IPRESOLVE_V4 );
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fields));
        // Execute post   
        $result = curl_exec($ch); 
        // Close connection      
        curl_close($ch);
        return $result;
    }
 }
?>