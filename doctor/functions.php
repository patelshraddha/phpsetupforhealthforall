<?php
 
class Functions {
 
    private $db;
	private $conn;
 
    //put your code here
    // constructor
    function __construct() {
        
		$root = realpath($_SERVER["DOCUMENT_ROOT"]);
        require_once $_SERVER['DOCUMENT_ROOT'] . '\db_connect.php';
        
        // connecting to database
        $this->db = new DB_Connect();
        $this->conn =$this->db->connect();
    }
 
    // destructor
    function __destruct() {
         
    }
 
    /**
     * Storing new user
     * returns user details
     */
    public function storedoctor($name, $surname, $phone ,$email,$password) {
        
		
        $hash = $this->hashSSHA($password);
        $encrypted_password = $hash["encrypted"]; // encrypted password
        $salt = $hash["salt"]; // salt
		 $result = $this->conn->query("INSERT INTO `healthgujarat`.`doctorlogin` (`pid`, `password`, `salt`, `created_at`, `name`, `surname`, `phone`, `email`) VALUES (NULL, '$encrypted_password', '$salt', NOW(),'$name','$surname','$phone','$email')");
        // check for successful store
        if ($result == false) {
           return false;
        } else {
            
			 // get user details 
            $uid = $this->conn->insert_id; // last inserted id
            $result = $this->conn->query("SELECT * FROM `healthgujarat`.`doctorlogin` WHERE `pid` = '$uid'");
            // return user details
            return $result->fetch_assoc();
        }
    }
	
	
	
	public function updatedoctor($pid,$name, $surname, $phone ,$email) {
        
		
       
		 $result = $this->conn->query("UPDATE `healthgujarat`.`doctorlogin` SET  `name`='$name', `surname`='$surname', `phone`='$phone', `email`='$email' WHERE `pid`='$pid' ");
        // check for successful store
        if ($result == false) {
           return false;
        } else {
            
			
            $result = $this->conn->query("SELECT * FROM `healthgujarat`.`doctorlogin` WHERE `pid` = '$pid'");
            // return user details
            return $result->fetch_assoc();
        }
    }
	
	public function getdoctorbyid($id, $password) {
         $resulter = $this->conn->query("SELECT * FROM `healthgujarat`.`doctorlogin` WHERE `pid` ='$id'");
		$no_of_rows = $resulter->num_rows;
		
        if ($no_of_rows>0 ) {
		    
            
			return $resulter->fetch_assoc();
			
        } else {
            // user not found
            return false;
        }
    }
	
	public function getdoctorbyemail($email, $password) {
        $results = $this->conn->query("SELECT * FROM `healthgujarat`.`doctorlogin` WHERE `email` = '$email'") or die(mysql_error());
		$no_of_rows = $results->num_rows;
        if ($no_of_rows > 0) {
            $results = $results->fetch_assoc();
			while ($result = $results)
			{
            $salt = $result['salt'];
            $encrypted_password = $result['password'];
            $hash = $this->checkhashSSHA($salt, $password);
            // check for password equality
            if ($encrypted_password == $hash) {
                // user authentication details are correct
                return $result;
            }
			else
			{
			return 0;
			}
			}
        } else {
            // user not found
            return false;
        }
    }
	
	
	
	
	public function exists($email)
    {
	if($result=$this->conn->query("SELECT * FROM `healthgujarat`.`doctorlogin` WHERE `email` = '$email'"))
	     {
		       $count= $result->num_rows;
			   if($count>0)
			      return true;
				 else
				   return false;
		 }
    else
		return false;
    }	
	
	
	public function existsid($id)
    {
	if($result=$this->conn->query("SELECT * FROM `healthgujarat`.`doctorlogin` WHERE `pid` = '$id'"))
	     {
		       $count= $result->num_rows;
			   if($count>0)
			      return true;
				 else
				   return false;
		 }
    else
		return false;
    }	
	
	/**
     * Check user is existed or not
     */
   
	
	 public function isdoctorexistsbyid($id) {
        $result = $this->conn->query("SELECT `pid` from doctorlogin WHERE `pid` = '$id'");
        $no_of_rows = mysql_num_rows($result);
        if ($no_of_rows > 0) {
            // user existed 
            return true;
        } else {
            // user not existed
            return false;
        }
    }
 
    /**
     * Get user by email and password
     */
    public function getUserByEmailAndPassword($email, $password) {
        $result = $this->conn->query("SELECT * FROM users WHERE email = '$email'") or die(mysql_error());
        // check for result 
        $no_of_rows = mysql_num_rows($result);
        if ($no_of_rows > 0) {
            $result = mysql_fetch_array($result);
            $salt = $result['salt'];
            $encrypted_password = $result['encrypted_password'];
            $hash = $this->checkhashSSHA($salt, $password);
            // check for password equality
            if ($encrypted_password == $hash) {
                // user authentication details are correct
                return $result;
            }
        } else {
            // user not found
            return false;
        }
    }
 
    /**
     * Check user is existed or not
     */
    public function isUserExisted($email) {
        $result = $this->conn->query("SELECT email from users WHERE email = '$email'");
        $no_of_rows = mysql_num_rows($result);
        if ($no_of_rows > 0) {
            // user existed 
            return true;
        } else {
            // user not existed
            return false;
        }
    }
 
    /**
     * Encrypting password
     * @param password
     * returns salt and encrypted password
     */
    public function hashSSHA($password) {
 
        $salt = sha1(rand());
        $salt = substr($salt, 0, 10);
        $encrypted = base64_encode(sha1($password . $salt, true) . $salt);
        $hash = array("salt" => $salt, "encrypted" => $encrypted);
        return $hash;
    }
 
    /**
     * Decrypting password
     * @param salt, password
     * returns hash string
     */
    public function checkhashSSHA($salt, $password) {
 
        $hash = base64_encode(sha1($password . $salt, true) . $salt);
 
        return $hash;
    }
 
}
 
?>