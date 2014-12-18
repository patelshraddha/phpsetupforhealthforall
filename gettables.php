<?php ini_set('memory_limit', '-1'); 
/* All detail details are read from HTTP Post Request
 */
 
// array for JSON response
$response = array();
 
 if (isset($_POST['tag'])) 
 {
 
    // Request type is Register new user
        
        $tag = $_POST['tag'];
       
		
       

	
		
		$root = realpath($_SERVER["DOCUMENT_ROOT"]);
        require_once $_SERVER['DOCUMENT_ROOT'] . '\db_connect.php';
        
        // connecting to database
        $db = new DB_Connect();
        $conn =$db->connect();
        
		if(($tag=="state")||($tag=="hospitaltype"))
		{
		     $result = $conn->query("SELECT * FROM `healthgujarat`.`$tag`");
		
         
			  
			 
			  if ($result->num_rows<=0) {
           
                $response["error"] = 1;
                $response["error_msg"] = "No details available";
                echo json_encode($response);
			
			
            } 
			else
			{
			   $name="";
			   $response["error_msg"] = "";
			    $response["details"] = array();
			   while($user = $result->fetch_assoc())
			   {
					$detail = array();
					if($tag=="hospitaltype")
                      $detail["name"] = $user["type"];
					else
					  $detail["name"] = $user["name"];
					
					
					array_push($response["details"], $detail);
				    
			   }
			   
			   echo json_encode($response);
			}
          
         }
         else if($tag == "district")
		{
		    $state = $_POST['state'];
		    $stater = $conn->query("SELECT * FROM `healthgujarat`.`state` WHERE `name` = '$state'");
		    $stater=$stater->fetch_assoc();
		    $pid= $stater["id"];
		
		
		    $result = $conn->query("SELECT * FROM `healthgujarat`.`$tag` WHERE `sid` = '$pid'");
		
         
			  
			 
			  if ($result->num_rows<=0) {
           
                $response["error"] = 1;
                $response["error_msg"] = "No details available";
                echo json_encode($response);
			
			
            } 
			else
			{
			   $name="";
			   $response["error_msg"] = "";
			    $response["details"] = array();
			   while($user = $result->fetch_assoc())
			   {
					$detail = array();
					
					  $detail["name"] = $user["name"];
					
					
					array_push($response["details"], $detail);
				    
			   }
			   
			   echo json_encode($response);
			}
		}
		
		else if($tag == "taluka")
		{
		    $state = $_POST['district'];
		    $stater = $conn->query("SELECT * FROM `healthgujarat`.`district` WHERE `name` = '$state'");
		    $stater=$stater->fetch_assoc();
		    $pid= $stater["id"];
		
		
		    $result = $conn->query("SELECT * FROM `healthgujarat`.`taluka` WHERE `sid` = '$pid'");
		
         
			  
			 
			  if ($result->num_rows<=0) {
           
                $response["error"] = 1;
                $response["error_msg"] = "No details available";
                echo json_encode($response);
			
			
            } 
			else
			{
			   $name="";
			   $response["error_msg"] = "";
			    $response["details"] = array();
			   while($user = $result->fetch_assoc())
			   {
					$detail = array();
					
					  $detail["name"] = $user["name"];
					
					
					array_push($response["details"], $detail);
				    
			   }
			   
			   echo json_encode($response);
			}
		}

		 
}
		 
	
	
    
    




?>