<?php
 

 
 
// array for JSON response
$response = array();
 
// check for required fields
if (isset($_POST['password'])) {
 
    // Request type is Register new user
        $root = realpath($_SERVER["DOCUMENT_ROOT"]);
        require_once $_SERVER['DOCUMENT_ROOT'] . '\db_connect.php';
        
        // connecting to database
        $db = new DB_Connect();
        $conn = $db->connect();
        
		$password =$_POST['password'];
		$result = $conn->query("SELECT * FROM `healthgujarat`.`rootlogin`");
            // return user details
         
		 while ($user = $result->fetch_assoc())
			{
		    if($password==$user["password"]){
			
			$response["error_msg"] = "success";
		    echo json_encode($response);
			}
			else
			{
			   $response["error_code"] = "2";
                $response["error_msg"] = "Wrong password";
                echo json_encode($response);
			}
			break;
			}
    
}



?>