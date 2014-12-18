<?php
$response = array();
 
// check for required fields

 // Request type is Register new user
       
       
		$pid = $_POST['pid'];
		$hid = $_POST['hid'];
		$did = $_POST['did'];
	    $rid = $_POST['rid'];
		$description = $_POST['ailment'];
	    $type = $_POST['major'];
		$ailment= $_POST['ailmenttype'];
	    $medication = $_POST['medication'];
		
			
		/*$pid = 1;
		$hid = 1;
		$did = 1;
	    $rid = 1;
		$description = "akakaa";
	    $type = "akakaa";
		$ailment= "akakaa";
	    $medication = "akakaa";*/
		
		$root = realpath($_SERVER["DOCUMENT_ROOT"]);
        require_once $_SERVER['DOCUMENT_ROOT'] . '\db_connect.php';
        
        // connecting to database
        $db = new DB_Connect();
        $conn =$db->connect();

         	$success = $conn->query("INSERT INTO `casehistory`(`pid`, `hid`, `did`, `ailment`, `medication`, `type`, `referred_to`, `created_at`, `description`) VALUES ('$pid', '$hid', '$did', '$ailment', '$medication', '$type', '$rid', NOW(), '$description')");
		
		
		if($success==false)
		{
		 $response["error"] = 1;
         $response["error_msg"] = "error";
		}
		else
        {
		 $response["error"] = 1;
         $response["error_msg"] = "";
		}
		
	   echo json_encode($response);
	
    
    




?>