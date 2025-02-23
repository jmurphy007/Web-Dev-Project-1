<?php
	class Database{
		private $host = "localhost";
		private $db = "tropical byte hotel";
		private $user = "root";
		private $password - "";
		private $pdo;
		
		public function connect(){
			if ($this->pdo==null{
				try{
					$dsn = "mysql:host=$this->host; dbname=$this->db";
					$this -> pdo = new PDO($dsn, $this->user, $this->password);
					
					$this -> pdo -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
				} catch(PDOException $e){
					echo "Connection failed: "$e->getMessage();
					echo "Please try again"
				}
			return $this->pdo;
			}
		}
?>