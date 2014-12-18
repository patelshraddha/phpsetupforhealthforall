<?php
 
/*
 * Following code will create a new product row
 * All product details are read from HTTP Post Request
 */
 
// array for JSON response
$response = array();
 
// check for required fields
if (isset($_POST['password']) && isset($_POST['tag'])) {
 
    // Request type is Register new user
        
        $email = $_POST['email'];
        $id = $_POST['id'];
		$password =$_POST['password'];
		$tag =$_POST['tag'];
		
		
		
 
    // include db connect class
    require_once __DIR__ . '\functions.php';
 
    // connecting to db
    $db = new Functions();
	
	if ($tag == 'email')
	{
	   $user=$db->getpatientbyemail($email, $password);
	   
	
		   
	}
	else if($tag =='id')
	{
	   $users=$db->getpatientbyid($id, $password);
	   
	
	}
	if($users ==false)
	      {
		        $response["error_code"] = "1";
                $response["error_msg"] = "Absent";
                echo json_encode($response);
		  }
		
	
		else
		  {
		   while ($user = $users)
			{
		     $salt = $user["salt"];
            $encrypted_password = $user["password"];
            $hash = $db->checkhashSSHA($salt, $password);
			if(substr($hash,0,15) ==$encrypted_password)
			{
            $response["error_msg"] = "";
		    $response["pid"] = $user["pid"];
            $response["name"] = $user["name"];
            $response["email"] = $user["email"];
            $response["surname"] = $user["surname"];
            $response["phone"] = $user["phone"];
            $response["address"] = $user["address"];
            $response["created_at"] = $user["created_at"];
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

		
	 
 
    
}



?>