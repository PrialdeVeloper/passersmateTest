<?php 
	
	class dbModel extends Controller{

		protected $con = null;

		public function __construct(){
			if($this->connectDB() instanceof PDO){
				$this->con = $this->connectDB();
			}
			else{
				die($this->connectDB());
			}
		}

		public function connectDB(){
			$dbname = "Passersmate";
			$host = "127.0.0.1";
			$username = "root";
			$password = "";
			try {
				$this->con = new PDO("mysql: host=$host; dbname=$dbname",$username,$password);
				$this->con->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
				return $this->con;
			} catch (PDOException $e) {
				return $e->getMessage();
			}
			$dbname = $host = $username = $password = null;
		}


	}

?>