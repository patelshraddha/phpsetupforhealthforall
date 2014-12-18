<?php
$response = array();
 

       
		$pid = $_POST['pid'];
	    
		
		$root = realpath($_SERVER["DOCUMENT_ROOT"]);
        require_once $_SERVER['DOCUMENT_ROOT'] . '\db_connect.php';
        
        // connecting to database
        $db = new DB_Connect();
        $conn =$db->connect();
        
		$result = $conn->query("SELECT * FROM `healthgujarat`.`casehistory` WHERE `pid` = '$pid' ORDER BY `created_at` DESC;");
		
 
          if ($result->num_rows<=0) {
           
                $response["error"] = 1;
                $response["error_msg"] = "No details available";
				
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
                    $detail["hid"] = $user["hid"];
					$detail["did"]= $user["did"];
					$detail["description"]=$user["description"];
					$detail["type"] = $user["ailment"];
					$detail["medication"]= $user["medication"];
					$detail["major"]=$user["type"];
					$detail["rid"] = $user["referred_to"];
					
					$doc=$user["did"];
					$p = $conn->query("SELECT * FROM `healthgujarat`.`doctorlogin` WHERE `pid` = '$doc'");
                    $p=$p->fetch_assoc();
					$detail["dname"]= $p["name"] . " " . $p["surname"];
					
					$doc=$user["referred_to"];
					$p = $conn->query("SELECT * FROM `healthgujarat`.`doctorlogin` WHERE `pid` = '$doc'");
                    $p=$p->fetch_assoc();
					$detail["rname"]= $p["name"] . " " . $p["surname"];
					
					$hosp= $user["hid"];
					$p = $conn->query("SELECT * FROM `healthgujarat`.`hospitallogin` WHERE `pid` = '$hosp'");
                    $p=$p->fetch_assoc();
					$detail["hname"]= $p["name"];
					
					
					$detail["dates"]= $user["created_at"];
					array_push($response["details"], $detail);
				    
			   }
			   $response["error_msg"]="";
			   echo json_encode($response);
			
             }
	
    
    




?>