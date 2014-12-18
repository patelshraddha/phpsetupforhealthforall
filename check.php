<?php
$response = array();
 
// check for required fields
if (isset($_POST['tag']) && isset($_POST['type'])) {
 // Request type is Register new user
        $tag = $_POST['tag'];
        $type = $_POST['type'];
		$pid = $_POST['pid'];
	
		
		$root = realpath($_SERVER["DOCUMENT_ROOT"]);
        require_once $_SERVER['DOCUMENT_ROOT'] . '\db_connect.php';
        
        // connecting to database
        $db = new DB_Connect();
        $conn =$db->connect();
        
		
		
 
   if($tag=="doctor")
       {
	          $result=null;
		      if($type=="email")
		      $result = $conn->query("SELECT * FROM `healthgujarat`.`doctorlogin` WHERE `email` = '$pid'");
              else
			  {
			  $pid = $_POST['pid'];
			  $result = $conn->query("SELECT * FROM `healthgujarat`.`doctorlogin` WHERE `pid` = '$pid'");
			  }
			 
			  if ($result->num_rows<=0) {
           
                $response["error"] = 1;
                $response["error_msg"] = "No details available";
                echo json_encode($response);
			
			
            } 
			else
			{
			   
                $response["error"] = 2;
                $response["error_msg"] = "";
                echo json_encode($response);
			   
			   echo json_encode($response);
			
             }
    
	   
   
	  }
	  else if($tag=="hospital")
	  {
	         $result=null;
		      if($type=="email")
		      $result = $conn->query("SELECT * FROM `healthgujarat`.`hospitallogin` WHERE `email` = '$pid'");
              else
			  {
			  $pid = $_POST['pid'];
			  $result = $conn->query("SELECT * FROM `healthgujarat`.`hospitallogin` WHERE `pid` = '$pid'");
			  }
         
			  
			 
			  if ($result->num_rows<=0) {
           
                $response["error"] = 1;
                $response["error_msg"] = "No details available";
                echo json_encode($response);
			
			
            } 
			else
			{
			   
                $response["error"] = 2;
                $response["error_msg"] = "";
                echo json_encode($response);
			   
			   echo json_encode($response);
			
             }
	  }
	
	}
    
    




?>