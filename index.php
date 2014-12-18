<?php
/**
 * File to handle all API requests
 * Accepts GET and POST
 * 
 * Each request will be identified by TAG
 * Response will be JSON data
 
  /**
 * check for POST request 
 */
if (isset($_POST['tag']) && $_POST['tag'] != '') {
    // get tag
    $tag = $_POST['tag'];
 
    // include db handler
    require_once 'include/patient_login.php';
    $db = new patient_login();
 
    // response Array
    $response = array("tag" => $tag, "success" => 0, "error" => 0);
 
    // check for tag type
    if ($tag == 'loginbyemail') {
        // Request type is check Login
        $email = $_POST['email'];
        $password = $_POST['password'];
		
 
        // check for user
        $user = $db->getpatientbyemail($email, $password);
        if ($user != false) {
            // user found
            // echo json with success = 1
            $response["success"] = 1;
            $response["uid"] = $user["pid"];
            $response["user"]["name"] = $user["name"];
            $response["user"]["email"] = $user["email"];
            $response["user"]["surname"] = $user["surname"];
            $response["user"]["phone"] = $user["phone"];
            $response["user"]["address"] = $user["address"];
            $response["user"]["created_at"] = $user["created_at"];
            
            echo json_encode($response);
        } else {
            // user not found
            // echo json with error = 1
            $response["error"] = 1;
            $response["error_msg"] = "Incorrect email or password!";
            echo json_encode($response);
        }
    }
    else if ($tag == 'loginbyid') {
        // Request type is check Login
        $email = $_POST['id'];
        $password = $_POST['password'];
 
        // check for user
        $user = $db->getpatientbyid($email, $password);
        if ($user != false) {
            // user found
            // echo json with success = 1
            $response["success"] = 1;
            $response["uid"] = $user["pid"];
            $response["user"]["name"] = $user["name"];
            $response["user"]["email"] = $user["email"];
            $response["user"]["surname"] = $user["surname"];
            $response["user"]["phone"] = $user["phone"];
            $response["user"]["address"] = $user["address"];
            $response["user"]["created_at"] = $user["created_at"];
            
            echo json_encode($response);
        } else {
            // user not found
            // echo json with error = 1
            $response["error"] = 1;
            $response["error_msg"] = "Incorrect email or password!";
            echo json_encode($response);
        }
    } 	
	else if ($tag == 'registerpatient') {
        // Request type is Register new user
        $name = $_POST['name'];
        $email = $_POST['email'];
        $address = $_POST['address'];
		$surname = $_POST['surname'];
        $phone = $_POST['phone'];
        
 
        // check if user is already existed
        if ($db->ispatientexistsbyemail($email)) {
            // user is already existed - error response
            $response["error"] = 2;
            $response["error_msg"] = "User already existed";
            echo json_encode($response);
        } else {
            // store user
            $user = $db->storepatient($name, $surname, $address, $phone ,$email);
            if ($user) {
                // user stored successfully
                $response["success"] = 1;
               $response["uid"] = $user["pid"];
            $response["user"]["name"] = $user["name"];
            $response["user"]["email"] = $user["email"];
            $response["user"]["surname"] = $user["surname"];
            $response["user"]["phone"] = $user["phone"];
            $response["user"]["address"] = $user["address"];
            $response["user"]["created_at"] = $user["created_at"];
			    $response["password"] = $user["password"];
				
                echo json_encode($response);
            } else {
                // user failed to store
                $response["error"] = 1;
                $response["error_msg"] = "Error occured in Registartion";
                echo json_encode($response);
            }
        }
    } else {
        echo "Invalid Request";
    }
} else {
    echo "Access Denied";
}
?>
