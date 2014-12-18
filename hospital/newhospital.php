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
if (isset($_POST['email'])) {
 
    // Request type is Register new user
        
        $email = $_POST['email'];
       
		$password = $_POST['password'];
		
		
		
		
 
    // include db connect class
    require_once __DIR__ . '\functions.php';
 
    // connecting to db
    $db = new Functions();
	
	
	
	if ($db->exists($email)==true) {
            // user is already existed - error response
            $response["error"] = 2;
            $response["error_msg"] = "User already existed";
            echo json_encode($response);
        } else {
		
        $users = $db->storehospital($name,  $address, $phone ,$email,$password,$type,$city,$district, $taluka, $state);
		
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
			
			
               $response["error_msg"] = "success";
				
				 while ($user = $users)
			{
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
		    $response["password"] = $password;
				echo json_encode($response);
				break;
			}
      
				
                
                
            }
           
		
		}
 
    
}



?>