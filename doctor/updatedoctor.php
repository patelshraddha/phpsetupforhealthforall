<?php
 
/*
 * Following code will create a new product row
 * All product details are read from HTTP Post Request
 */
 
// array for JSON response
$response = array();
        $name = "";
        $email = "";
        $phone = "";
		$password = "";
		$city = "";
		$district = ""; 
		$taluka = "";
		$state = "";
		$surname = "";
		
 
// check for required fields
if (isset($_POST['name']) && isset($_POST['surname'])) {
 
    // Request type is Register new user
       
         $name = $_POST['name'];
		 $surname = $_POST['surname'];
        $email = $_POST['email'];
        
		
        $phone = $_POST['phone'];
		$pid=$_POST['pid'];
		
		
		
 
    // include db connect class
    require_once __DIR__ . '\functions.php';
 
    // connecting to db
    $db = new Functions();
	
	
	
	
		
        $users = $db->updatedoctor($pid,$name, $surname, $phone ,$email);
		
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