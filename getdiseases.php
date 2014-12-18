<?php
 
/*
 * Following code will create a new product row
 * All product details are read from HTTP Post Request
 */
 
// array for JSON response
$response = array();
 
// check for required fields

 
    
		
		$root = realpath($_SERVER["DOCUMENT_ROOT"]);
        require_once $_SERVER['DOCUMENT_ROOT'] . '\db_connect.php';
        
        // connecting to database
        $db = new DB_Connect();
        $conn =$db->connect();
        
		
		
 
   
		      $result = $conn->query("SELECT * FROM `healthgujarat`.`diseases`");
         
			  
			$response["error_msg"] = "";
			$response["details"] = array();
			  
		    while ($user = $result->fetch_assoc())
			{
			$detail = array();
            $detail["name"] = $user["name"];
           	
		    array_push($response["details"], $detail);
			}
	         echo json_encode($response);
	
	
 
    




?>