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
			$port = 3307;
			$username = "root";
			$password = "";
			try {
				$this->con = new PDO("mysql: host=$host; dbname=$dbname",$username,$password);
				$this->con->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
				return $this->con;
			} catch (PDOException $e) {
				try {
					$this->con = new PDO("mysql: host=$host; port=$port; dbname=$dbname",$username,$password);
					$this->con->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
					return $this->con;
				} catch (Exception $e) {
					return $e->getMessage();
				}
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
			return implode("=?,",$data)."=?";
		}

		public function selectAll($from){
			$this->stmt = $this->con->query("SELECT * FROM $from");
			return $this->stmt->fetchAll(PDO::FETCH_ASSOC);
		}

		public function selectAllFromUser($table,$field,$data){
			$return = null;
			$this->stmt = $this->con->prepare("SELECT * FROM $table WHERE $field = ?");
			$this->stmt->execute($data);
			return $return = $this->stmt->fetchAll(PDO::FETCH_ASSOC);
		}

		public function selectSingleUser($table,$field,$data,$wherClause){
			$this->stmt = $this->con->prepare("SELECT $field FROM $table WHERE $wherClause = ?");
			$this->stmt->execute($data);
			return $this->stmt->fetchColumn();
		}

		public function insertDB($table,$fields,$data){
			$fieldsQ = $this->addComma($fields);
			$dataQ = $this->qData($data);
			$this->stmt = $this->con->prepare("INSERT INTO $table($fieldsQ) VALUES($dataQ)");
			$this->stmt->execute($data);
			return $this->con->lastInsertId();
		}

		public function checkExistSingle($table,$field,$data){
			$this->stmt = $this->con->prepare("SELECT COUNT(*) FROM $table WHERE $field = ?");
			$this->stmt->execute($data);
			return $this->stmt->fetchColumn();
		}

		public function updateDB($table,$fields,$data,$wherClause,$wherClauseAnswer){
			try {
				$fieldsQ = $this->qDataUpdate($fields);
				$this->result = $this->stmt = $this->con->prepare("UPDATE $table SET $fieldsQ WHERE $wherClause = $wherClauseAnswer");
				$res = $this->stmt->execute($data);
				return true;
			} catch (Exception $e) {
				return $e->getMessage();
			}
		}

		public function desctuct(){
			$this->stmt = null;
			$this->con = null;
		}

	}

?>