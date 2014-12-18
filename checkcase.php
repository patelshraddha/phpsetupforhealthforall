<?php
$response = array();
 
// check for required fields

 // Request type is Register new user
       
       
		$pid = $_POST['pid'];
		$hid = $_POST['hid'];
		$did = $_POST['did'];
	    $rid = $_POST['rid'];
		
		$root = realpath($_SERVER["DOCUMENT_ROOT"]);
        require_once $_SERVER['DOCUMENT_ROOT'] . '\db_connect.php';
        
        // connecting to database
        $db = new DB_Connect();
        $conn =$db->connect();


		$patientresult = $conn->query("SELECT * FROM `healthgujarat`.`patientlogin` WHERE `pid` = '$pid'");
		$doctorresult = $conn->query("SELECT * FROM `healthgujarat`.`doctorlogin` WHERE `pid` = '$did'");
		
		$refrencedresult = $conn->query("SELECT * FROM `healthgujarat`.`doctorlogin` WHERE `pid` = '$rid'");
		$t=0;
		if($rid == "NA")
			$t=1;
		else 
		{
			if(($refrencedresult==false)||($refrencedresult->num_rows<=0))
				$t=0;
			else
			  $t=1;
		}
		
		$hospitalresult = $conn->query("SELECT * FROM `healthgujarat`.`hospitallogin` WHERE `pid` = '$hid'");
		
		if(($patientresult==false)||($patientresult->num_rows<=0))
		{
		 $response["error"] = 1;
         $response["error_msg"] = "patient";
		}
		else if(($doctorresult==false)||($doctorresult->num_rows<=0))
        {
		 $response["error"] = 1;
         $response["error_msg"] = "doctor";
		}
		else if($t==0)
        {
		 $response["error"] = 1;
         $response["error_msg"] = "refrences";
		}
		else if(($hospitalresult==false)||($hospitalresult->num_rows<=0))
		{
		$response["error"] = 1;
         $response["error_msg"] = "hospital";
		}
		else
		{
		$response["error"] = 1;
         $response["error_msg"] = "";
		 
		}
   
	   echo json_encode($response);
	
    
    




?>