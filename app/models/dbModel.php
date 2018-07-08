<?php 
	
	class dbModel extends Controller{

		private $con = null;
		private $stmt = null;
		private $result = null;

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

		private function addComma($data){
			return is_array($data)?implode(",", $data):false;
		}

		private function qData($data){
			$arrayData = [];
			foreach($data as $datas)$arrayData[] = "?";
			return implode(",",$arrayData);
		}

		private function qDataUpdate($data){
			return implode("=?",$arrayData)."=?";
		}

		protected function insertDB($table,$data,$fields){
			$fieldsQ = $this->addComma($fields);
			$dataQ = $this->qData($data);
			$this->stmt = $this->con->prepare("INSERT INTO $table($fieldsQ) VALUES($dataQ)");
			$this->stmt->execute($data);
			return $this->con->lastInsertId();
		}

		protected function checkExistSingle($table,$field,$data){
			$this->stmt = $this->con->prepare("SELECT COUNT(*) FROM $table WHERE $field = ?");
			$this->stmt->execute($data);
			return $this->stmt->fetchColumn();
		}

		protected function updateDB($table,$fields,$data,$wherClause,$wherClauseAnswer){
			try {
				$fieldsQ = $this->qDataUpdate($fields);
				$this->result = $this->stmt = $this->con->prepare("UPDATE $table SET $fieldsQ WHERE $wherClause = $wherClauseAnswer");
				return $this->result();
			$this->stmt->execute($data);
			} catch (Exception $e) {
				return $e->getMessage();
			}
		}

	}

?>