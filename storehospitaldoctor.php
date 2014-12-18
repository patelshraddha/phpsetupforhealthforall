<?php ini_set('memory_limit', '-1'); 
/* All detail details are read from HTTP Post Request
 */
 
// array for JSON response
$response = array();
if (isset($_POST['hid']) && isset($_POST['did']) )
 {
 // Request type is Register new user
        $hid = $_POST['hid'];
        $did = $_POST['did'];
		$desig =$_POST['desig'];
		$time = $_POST['time'];
		
		
	
		
		$root = realpath($_SERVER["DOCUMENT_ROOT"]);
        require_once $_SERVER['DOCUMENT_ROOT'] . '\db_connect.php';
        
        // connecting to database
        $db = new DB_Connect();
        $conn =$db->connect();
		
		
		$check = $conn->query("SELECT * FROM `doctorhospital` WHERE `hid`= '$hid' AND `did` = '$did'");
		
		if($check->num_rows>0)
		{
		   $response["error_msg"]="Exists";
			   echo json_encode($response);
		}
		else
		{
        
		$result = $conn->query("INSERT INTO `healthgujarat`.`doctorhospital` (`hid`, `did`, `designation`, `timings`) VALUES ('$hid', '$did', '$desig','$time')");
    
		
 
       if ($result == false) {
           $response["error_msg"]="Error";
			   echo json_encode($response);
        }  
		else
		{
		$response["error_msg"]="";
			   echo json_encode($response);
		}
		}	 
			
	
	}






























?>