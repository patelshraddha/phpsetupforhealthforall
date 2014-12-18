<?php
 
/*
 * Following code will create a new product row
 * All product details are read from HTTP Post Request
 */
 
// array for JSON response
$response = array();
		$name = "";
        $email = "";
        $address = "";
		$type = "";
        $phone = "";
		$password = "";
		$city = "";
		$district = ""; 
		$taluka = "";
		$state = "";
 
// check for required fields
if (isset($_POST['email'])&&isset($_POST['name'])  && isset($_POST['address'])) {
 
    // Request type is Register new user
        
        $email = $_POST['email'];
       $name = $_POST['name'];
		$address = $_POST['address'];
		$phone = $_POST['phone'];
		$pid = $_POST['pid'];
		$type = $_POST['type'];
		$city = $_POST['city'];
		$district = $_POST['district'];
		$taluka= $_POST['taluka'];
		$state = $_POST['state'];
 
    // include db connect class
    require_once __DIR__ . '\functions.php';
 
    // connecting to db
    $db = new Functions();
	
	
	
	
        $users = $db->updatehospital($name,  $address, $phone ,$email,$pid,$type,$city,$district, $taluka, $state);
		
        // check for successful store
        if ($users == false) {
            // user failed to store
                $response["error"] = 1;
                $response["error_msg"] = "Error occured in Registartion";
                echo json_encode($response);
			
			
            } 
			
			else if ($users == NULL) {
            // user failed to store
                $response["error"] = 2;
                $response["error_msg"] = "No such user found";
                echo json_encode($response);
			
			
            } 
			
			
			
			else  {
			// user stored successfully
			
			
              $response["error"] = 3;
            $response["error_msg"] = "";
            echo json_encode($response);
      
				
                
                
            }
           
		
		
 
    
}



?>