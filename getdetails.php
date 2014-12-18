<?php
 
/*
 * Following code will create a new product row
 * All product details are read from HTTP Post Request
 */
 
// array for JSON response
$response = array();
 
// check for required fields
if (isset($_POST['tag']) && isset($_POST['pid'])) {
 
    // Request type is Register new user
        $tag = $_POST['tag'];
        $pid = $_POST['pid'];
		$type=$_POST['type'];
		
		$root = realpath($_SERVER["DOCUMENT_ROOT"]);
        require_once $_SERVER['DOCUMENT_ROOT'] . '\db_connect.php';
        
        // connecting to database
        $db = new DB_Connect();
        $conn =$db->connect();
        
		
		
 
   if($tag=="patient")
       {
	      if($type!="email")
		      $result = $conn->query("SELECT * FROM `healthgujarat`.`patientlogin` WHERE `pid` = '$pid'");
          else
		      $result = $conn->query("SELECT * FROM `healthgujarat`.`patientlogin` WHERE `email` = '$pid'"); 
			  
			  $resulter= $result->fetch_assoc();
			  if (($resulter == false)||($result->num_rows<=0)) {
           
                $response["error"] = 1;
                $response["error_msg"] = "No user exists";
				$response["tag"] = $tag;
				$response["pid"] = $pid;
                echo json_encode($response);
			
			
            } 
			  
			   while ($user = $resulter)
			{
			$response["error_msg"] = "";
			$response["pid"] = $user["pid"];
            $response["name"] = $user["name"];
            $response["email"] = $user["email"];
            $response["surname"] = $user["surname"];
            $response["phone"] = $user["phone"];
            $response["address"] = $user["address"];
			
				echo json_encode($response);
				break;
			}
		
            		  
	   }
   else if($tag=="doctor")
       {
	      if($type!="email")
		      $result = $conn->query("SELECT * FROM `healthgujarat`.`doctorlogin` WHERE `pid` = '$pid'");
          else
		      $result = $conn->query("SELECT * FROM `healthgujarat`.`doctorlogin` WHERE `email` = '$pid'"); 
			  
		  $resulter= $result->fetch_assoc();
		    if (($resulter == false)||($result->num_rows<=0)) {
           
                $response["error"] = 1;
                $response["error_msg"] = "No user exists";
                echo json_encode($response);
			
			
            } 
			  
			   while ($user = $resulter)
			{
			$response["error_msg"] = "";
			$response["tg"] = $user["pid"];
			$response["pid"] = $user["pid"];
            $response["name"] = $user["name"];
            $response["email"] = $user["email"];
            $response["surname"] = $user["surname"];
            $response["phone"] = $user["phone"];
				echo json_encode($response);
				break;
			}
	   }
   else if($tag=="hospital")
       {
	      if($type!="email")
		      $result = $conn->query("SELECT * FROM `healthgujarat`.`hospitallogin` WHERE `pid` = '$pid'");
          else
		      $result = $conn->query("SELECT * FROM `healthgujarat`.`hospitallogin` WHERE `email` = '$pid'"); 
	      $resulter= $result->fetch_assoc();
		  if (($resulter == false)||($result->num_rows<=0)) {
           
                $response["error"] = 1;
                $response["error_msg"] = "No user exists";
                echo json_encode($response);
			
			
            } 
			  
			   while ($user = $resulter)
			{
			$response["error_msg"] = "";
		    $response["pid"] = $user["pid"];
            $response["name"] = $user["name"];
            $response["email"] = $user["email"];
            $response["type"] = $user["type"];
            $response["phone"] = $user["phone"];
            $response["address"] = $user["address"];
            $response["created_at"] = $user["created_at"];
			$response["city"] = $user["city"];
            $response["district"] = $user["district"];
            $response["taluka"] = $user["taluka"];
            $response["state"] = $user["state"];
				echo json_encode($response);
				break;
			}
       }	   
	
	
	
 
    
}



?>