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
		
        $users = $db->storedoctor($name, $surname,  $phone ,$email,$password);
		
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
            $response["surname"] = $user["surname"];
            $response["phone"] = $user["phone"];
            $response["created_at"] = $user["created_at"];
		    $response["password"] = $password;
				echo json_encode($response);
				break;
			}
      
				
                
                
            }
           
		
		}
 
    
}



?>