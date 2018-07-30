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

		public function selectAllField($field,$from){
			$this->stmt = $this->con->query("SELECT $field FROM $from");
			return $this->stmt->fetchAll(PDO::FETCH_ASSOC);
		}

		public function selectAllFromUser($table,$field,$data){
			$return = null;
			$this->stmt = $this->con->prepare("SELECT * FROM $table WHERE $field = ?");
			$this->stmt->execute($data);
			return $return = $this->stmt->fetchAll(PDO::FETCH_ASSOC);
		}

		public function selectDataFromOtherDB($table,$table2,$field,$field2,$data){
			$return = null;
			$this->stmt = $this->con->prepare("SELECT * FROM $table WHERE $field = (SELECT $field from $table2 where $field2 = ?)");
			$this->stmt->execute($data);
			return $return = $this->stmt->fetchAll(PDO::FETCH_ASSOC);
		}

		public function queryDataUnverifiedPasser($data){
			$this->stmt = $this->con->prepare("select a.PasserID, a.PasserFN, a.PasserLN, a.PasserCOCNo, a.PasserMname, a.PasserBirthdate, a.PasserAge, a.PasserGender, a.PasserStreet, a.PasserAddress, a.PasserCOCExpiryDate, a.PasserCPNo, a.PasserEmail, a.PasserStatus, a.PasserCertificate, a.PasserProfile, a.PasserCertificateType, b.frontID, b.backID, b.selfie, b.COC, b.idType, b.idNumber,b.expirationDate from passervalidate b left join passer a  on a.PasserID = b.passerID where a.PasserStatus = 2 and a.PasserID = ?");
			$this->stmt->execute($data);
			return $this->stmt->fetchAll(PDO::FETCH_ASSOC);
		}

		public function queryDataUnverifiedSeeker($data){
			$this->stmt = $this->con->prepare("select a.SeekerID, a.SeekerFN, a.SeekerLN, a.SeekerBirthdate, a.SeekerAge, a.SeekerGender, a.SeekerStreet, a.SeekerAddress, a.SeekerCPNo, a.SeekerEmail, a.SeekerStatus, a.SeekerProfile, b.frontID, b.backID, b.selfie, b.idType, b.idNumber,b.expirationDate from seekervalidate b left join seeker a  on a.SeekerID = b.seekerID where a.SeekerStatus = 2 and a.SeekerID = ?");
			$this->stmt->execute($data);
			return $this->stmt->fetchAll(PDO::FETCH_ASSOC);
		}

		public function selectSingleUser($table,$field,$data,$wherClause){
			$this->stmt = $this->con->prepare("SELECT $field FROM $table WHERE $wherClause = ?");
			$this->stmt->execute($data);
			return $this->stmt->fetchColumn();
		}

		public function checkAuthenticity($table,$field,$field2,$data){
			$this->stmt = $this->con->prepare("SELECT COUNT(*) FROM $table WHERE $field = ? and $field2 = ?");
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