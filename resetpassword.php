<?php ini_set('memory_limit', '-1'); 
/* All detail details are read from HTTP Post Request
 */
 
// array for JSON response
$response = array();
 
 //if (isset($_POST['pid'] && $_POST['password'])) 
 {
 
    // Request type is Register new user
        
        $pid = $_POST['pid'];
		$password = $_POST['password'];
		$tag= $_POST['tag'];
		
		//$tag="patient";
		//$password="1234";
		//$pid=51;
		
	    $tag=$tag."login";
		
		$salt = sha1(rand());
        $salt = substr($salt, 0, 10);
        $hash = base64_encode(sha1($password . $salt, true) . $salt);
        
        if($tag=="rootlogin")
			$hash=$password;
		
       

	
		
		$root = realpath($_SERVER["DOCUMENT_ROOT"]);
        require_once $_SERVER['DOCUMENT_ROOT'] . '\db_connect.php';
        
        // connecting to database
        $db = new DB_Connect();
        $conn =$db->connect();
        
		     
		     $result = $conn->query("UPDATE `healthgujarat`.`$tag` SET `password`='$hash' WHERE `pid`='$pid'" );
		      
         
			  
			 
			  if ($result==false) {
           
                $response["error"] = 1;
                $response["error_msg"] = "Absent";
                echo json_encode($response);
			
			
            } 
			else
			{
			   $response["error"] = 1;
                $response["error_msg"] = "";
                echo json_encode($response);
			}
           
	
	
    
    
}



?>