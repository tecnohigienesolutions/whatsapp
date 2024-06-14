<?php
class Database{
	
	private $host  = 'localhost';
    private $user  = 'root';
    private $password   = '@SendupServer';
    private $database  = "sendup"; 
    
    public function getConnection(){		
		$conn = new mysqli($this->host, $this->user, $this->password, $this->database);
		if($conn->connect_error){
			die("Error no pudo conectarse a la base: " . $conn->connect_error);
		} else {
			return $conn;
		}
    }
}
?>