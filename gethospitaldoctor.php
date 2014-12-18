<?php ini_set('memory_limit', '-1'); 
/* All detail details are read from HTTP Post Request
 */
 
// array for JSON response
$response = array();
 
// check for required fields
if (isset($_POST['tag']) && isset($_POST['pid'])) {
 // Request type is Register new user
        $tag = $_POST['tag'];
        $pid = $_POST['pid'];
	
		
		$root = realpath($_SERVER["DOCUMENT_ROOT"]);
        require_once $_SERVER['DOCUMENT_ROOT'] . '\db_connect.php';
        
        // connecting to database
        $db = new DB_Connect();
        $conn =$db->connect();
        
		
		
 
   if($tag=="doctor")
       {
	     
		      $result = $conn->query("SELECT * FROM `healthgujarat`.`doctorhospital` WHERE `did` = '$pid'");
         
			  
			 
			  if ($result->num_rows<=0) {
           
                $response["error"] = 1;
                $response["error_msg"] = "No details available";
				$response["tag"] = $tag;
                $response["pid"] = $pid;
                echo json_encode($response);
			
			
            } 
			else
			{
			   $name="";
			    $response["details"] = array();
			   while($user = $result->fetch_assoc())
			   {
					$detail = array();
                    $detail["pid"] = $user["hid"];
					$detail["timings"]= $user["timings"];
					$detail["designation"]=$user["designation"];
					$name=$user["hid"];
					$p = $conn->query("SELECT * FROM `healthgujarat`.`hospitallogin` WHERE `pid` = '$name'");
                     while($users = $p->fetch_assoc())
			        {
					 if ($p->num_rows>0) {
           
					$detail["name"]= $users["name"];
					
					}
					break;
					}
					
					array_push($response["details"], $detail);
				    
			   }
			   $response["error_msg"]="";
			   echo json_encode($response);
			
             }
    
	   
   
	  }
	  else
	  {
	         $result = $conn->query("SELECT * FROM `healthgujarat`.`doctorhospital` WHERE `hid` = '$pid'");
         
			  
			 
			  if ($result->num_rows<=0) {
           
                $response["error"] = 1;
                $response["error_msg"] = "No details available";
				$response["tag"] = $tag;
                $response["pid"] = $pid;
                echo json_encode($response);
			
			
            } 
			else
			{
			    $name="";
			    $response["details"] = array();
			   while($user = $result->fetch_assoc())
			   {
					$detail = array();
                    $detail["pid"] = $user["did"];
					$detail["timings"]= $user["timings"];
					$detail["designation"]=$user["designation"];
					
					$name=$user["did"];
					$p = $conn->query("SELECT * FROM `healthgujarat`.`doctorlogin` WHERE `pid` = '$name'");
                     while($users = $p->fetch_assoc())
			        {
					 if ($p->num_rows>0) {
           
					$detail["name"]= $users["name"];
					$detail["surname"]= $users["surname"];
					
					}
					break;
					}
					
					array_push($response["details"], $detail);
				    
			   }
			   $response["error_msg"]="";
			   echo json_encode($response);
			
             }
	  }
	
	}
    
    




?>