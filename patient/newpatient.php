<?php
 
/*
 * Following code will create a new product row
 * All product details are read from HTTP Post Request
 */
 
// array for JSON response
$response = array();
 
// check for required fields
if (isset($_POST['name']) && isset($_POST['surname']) && isset($_POST['address'])) {
 
    // Request type is Register new user
        $name = $_POST['name'];
        $email = $_POST['email'];
        $address = $_POST['address'];
		$surname = $_POST['surname'];
        $phone = $_POST['phone'];
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
		
        $users = $db->storepatient($name, $surname, $address, $phone ,$email,$password);
		
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
                $response["success"] = 1;
				
				 while ($user = $users)
			{
			$response["uid"] = $user["pid"];
            $response["name"] = $user["name"];
            $response["email"] = $user["email"];
            $response["surname"] = $user["surname"];
            $response["phone"] = $user["phone"];
            $response["address"] = $user["address"];
            $response["created_at"] = $user["created_at"];
		    $response["password"] = $password;
				echo json_encode($response);
				break;
			}
      
				
                
                
            }
           
		
		}
 
    
}



?>