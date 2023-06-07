dfvgbnm,./;<?php

class Database{
	// protected: binnen class en subclasses
	// static omdat de connectie bewaard blijft
	protected static $conn = NULL;
	
	private  $servername = "localhost" ;
	private 	$dbname = "bas supermarkt" ;
	private 	$username = "root" ;
	private 	$password = "" ;	
	
	
	// Methods
	public function __construct(){
			
		
		if (!self::$conn) {
			try{
				 self::$conn = new PDO ("mysql:host=$this->servername;
						dbname=$this->dbname",
						$this->username,
						$this->password) ;

				 self::$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION) ;
				 self::$conn->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
				 //echo "Connectie is gelukt <br />" ;
			}

			catch(PDOException $e){
				 echo "Connectie mislukt: " . $e->getMessage() ;
			}
		} else {
			echo "Database is al geconnected<br>";
		}
	}
	
}
?>