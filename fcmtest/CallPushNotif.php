<?php 
include "PushNotification.php";
class PHP_AES_Cipher {

    private static $OPENSSL_CIPHER_NAME = "aes-128-cbc"; //Name of OpenSSL Cipher 
    private static $CIPHER_KEY_LEN = 16; //128 bits

    /**
     * Encrypt data using AES Cipher (CBC) with 128 bit key
     * 
     * @param type $key - key to use should be 16 bytes long (128 bits)
     * @param type $iv - initialization vector
     * @param type $data - data to encrypt
     * @return encrypted data in base64 encoding with iv attached at end after a :
     */

    static function encrypt($key, $iv, $data) {
        if (strlen($key) < PHP_AES_Cipher::$CIPHER_KEY_LEN) {
            $key = str_pad("$key", PHP_AES_Cipher::$CIPHER_KEY_LEN, "0"); //0 pad to len 16
        } else if (strlen($key) > PHP_AES_Cipher::$CIPHER_KEY_LEN) {
            $key = substr($key, 0, PHP_AES_Cipher::$CIPHER_KEY_LEN); //truncate to 16 bytes
        }

        $encodedEncryptedData = base64_encode(openssl_encrypt($data, PHP_AES_Cipher::$OPENSSL_CIPHER_NAME, $key, OPENSSL_RAW_DATA, $iv));
        $encodedIV = base64_encode($iv);
        $encryptedPayload = $encodedEncryptedData.":".$encodedIV;

        return $encryptedPayload;

    }

    /**
     * Decrypt data using AES Cipher (CBC) with 128 bit key
     * 
     * @param type $key - key to use should be 16 bytes long (128 bits)
     * @param type $data - data to be decrypted in base64 encoding with iv attached at the end after a :
     * @return decrypted data
     */
    static function decrypt($key, $data) {
        if (strlen($key) < PHP_AES_Cipher::$CIPHER_KEY_LEN) {
            $key = str_pad("$key", PHP_AES_Cipher::$CIPHER_KEY_LEN, "0"); //0 pad to len 16
        } else if (strlen($key) > PHP_AES_Cipher::$CIPHER_KEY_LEN) {
            $key = substr($key, 0, PHP_AES_Cipher::$CIPHER_KEY_LEN); //truncate to 16 bytes
        }

        $parts = explode(':', $data); //Separate Encrypted data from iv.
        $decryptedData = openssl_decrypt(base64_decode($parts[0]), PHP_AES_Cipher::$OPENSSL_CIPHER_NAME, $key, OPENSSL_RAW_DATA, base64_decode($parts[1]));

        return $decryptedData;
    }

}

$key = "0123456789abcdef"; // 128 bit key
$initVector = "fedcba9876543210"; // 16 bytes IV
$object = new PHP_AES_Cipher(); 







$conn = mysqli_connect("localhost", "root", "Gayatri1999@", "fcm_db");

	$u_name = "Gayatri222";
	
	$sql = "Select token From users where username='$u_name' ";
	
	$result = mysqli_query($conn,$sql);
	$tokens = array();
	
	
	if(mysqli_num_rows($result)>0){
		while($row = mysqli_fetch_assoc($result)){
			$tokens[] = $row["token"];
			//$title=encrypt('encrypt',"Notification" );
			$title=$object->encrypt($key, $initVector, "Notification");
			
			//$message = encrypt('encrypt', "FCM PUSH NOTIFICATION TEST MESSAGE");
			$message=$object->encrypt($key, $initVector, "A new event is generated click to know more..");
	
	
//Call Function where you want to send Push Notification.
$serverObject = new SendNotification(); 
$jsonString = $serverObject->sendPushNotificationToFCMSever( $tokens,$title, $message);  
$jsonObject = json_decode($jsonString,TRUE);
print_r($jsonObject["results"][0]["error"]);
if($jsonObject["results"][0]["error"] == "InvalidRegistration")
{echo "error"."<br>";
$query = "DELETE FROM users WHERE username = '$u_name'";
	 if (mysqli_query($conn, $query)) 
	 {
		echo "record for this user is deleted successfully as device id is invalid !";
	 }
	

}
else{
	echo"notification successfull";
}



			
		}
	}
	else{
		echo"user doesn't exist";
	}
	mysqli_close($conn);
	

	
	
	

?>