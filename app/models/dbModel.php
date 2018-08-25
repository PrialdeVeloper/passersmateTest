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
				$this->con = new PDO("mysql: host=$host; port=$port;dbname=$dbname",$username,$password);
				$this->con->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
				return $this->con;
			} catch (PDOException $e) {
				try {
					$this->con = new PDO("mysql: host=$host; dbname=$dbname",$username,$password);
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

		private function likeData($data){
			return implode($data," LIKE ? and ")." LIKE ?";
		}

		private function andData($data){
			return implode($data," = ? and ")." = ?";
		}

		private function andDataNoLastQuestionMark($data){
			return implode($data," = ? and ");
		}

		public function ownQuery($query){
			$this->stmt = $this->con->query($query);
			return $this->stmt->fetchAll(PDO::FETCH_ASSOC);
		}

		public function selectAll($from){
			$this->stmt = $this->con->query("SELECT * FROM $from");
			return $this->stmt->fetchAll(PDO::FETCH_ASSOC);
		}

		public function selectAllDynamicLikeLimit($table,$field,$where,$data,$offset,$limit){
			$select = $this->addComma($field);
			$fieldsQ = $this->likeData($where);
			$this->stmt = $this->con->prepare("SELECT $select FROM $table WHERE ($fieldsQ) LIMIT $offset,$limit");
			$this->stmt->execute($data);
			return $this->stmt->fetchAll(PDO::FETCH_ASSOC);
		}

		public function selectAllDynamicLike($table,$field,$where,$data){
			$select = $this->addComma($field);
			$fieldsQ = $this->likeData($where);
			$this->stmt = $this->con->prepare("SELECT $select FROM $table WHERE ($fieldsQ)");
			$this->stmt->execute($data);
			return $this->stmt->fetchAll(PDO::FETCH_ASSOC);
		}

		public function selectAllDynamic($table,$field,$where,$data){
			$select = $this->addComma($field);
			$fieldsQ = $this->andData($where);
			$this->stmt = $this->con->prepare("SELECT $select FROM $table WHERE ($fieldsQ)");
			$this->stmt->execute($data);
			return $this->stmt->fetchAll(PDO::FETCH_ASSOC);
		}

		public function selectAllDynamicSort($table,$field,$where,$data,$order,$sort){
			$select = $this->addComma($field);
			$fieldsQ = $this->andData($where);
			$this->stmt = $this->con->prepare("SELECT $select FROM $table WHERE ($fieldsQ) ORDER BY $order $sort");
			$this->stmt->execute($data);
			return $this->stmt->fetchAll(PDO::FETCH_ASSOC);
		}

		public function selectAllField($field,$from){
			$this->stmt = $this->con->query("SELECT $field FROM $from");
			return $this->stmt->fetchAll(PDO::FETCH_ASSOC);
		}

		public function selectAllLimit($table,$field,$field2,$offset,$count,$data){
			$this->stmt = $this->con->prepare("SELECT * FROM $table WHERE $field = ? and $field2 = ? LIMIT $offset,$count");
			$this->stmt->execute($data);
			return $this->stmt->fetchAll(PDO::FETCH_ASSOC);
		}

		public function selectAllLimitSort($table,$field,$field2,$offset,$count,$data,$order,$sort){
			$this->stmt = $this->con->prepare("SELECT * FROM $table WHERE $field = ? and $field2 = ? ORDER BY $order $sort LIMIT $offset,$count");
			$this->stmt->execute($data);
			return $this->stmt->fetchAll(PDO::FETCH_ASSOC);
		}

		public function selectAllLimitSingle($table,$field,$offset,$count,$order,$sort,$data){
			$this->stmt = $this->con->prepare("SELECT * FROM $table WHERE $field = ? ORDER BY $order $sort LIMIT $offset,$count");
			$this->stmt->execute($data);
			return $this->stmt->fetchAll(PDO::FETCH_ASSOC);
		}

		public function selectSort($select,$table,$field,$data,$order,$sort,$limit){
			$select = $this->addComma($select);
			$return = null;
			$this->stmt = $this->con->prepare("SELECT $select FROM $table WHERE $field = ? ORDER BY $order $sort LIMIT $limit");
			$this->stmt->execute($data);
			return $return = $this->stmt->fetchAll(PDO::FETCH_ASSOC);
		}

		public function selectAllFromUser($table,$field,$data){
			$return = null;
			$this->stmt = $this->con->prepare("SELECT * FROM $table WHERE $field = ?");
			$this->stmt->execute($data);
			return $return = $this->stmt->fetchAll(PDO::FETCH_ASSOC);
		}

		public function selectAllFromUserSort($select,$table,$field,$data,$order,$sort){
			$return = null;
			$select = $this->addComma($select);
			$this->stmt = $this->con->prepare("SELECT $select FROM $table WHERE $field = ? ORDER BY $order $sort");
			$this->stmt->execute($data);
			return $return = $this->stmt->fetchAll(PDO::FETCH_ASSOC);
		}

		public function selectDataFromOtherDBLike($select,$tableFirst,$whereFirst,$selectSecond,$table2,$whereSecond,$data,$order,$sort){
			$selected = $this->addComma($select);
			$fieldsQ = $this->andDataNoLastQuestionMark($whereFirst);
			$fieldsQOther = $this->likeData($whereSecond);
			$return = null;
			$this->stmt = $this->con->prepare("SELECT $selected FROM $tableFirst WHERE $fieldsQ IN (SELECT $selectSecond FROM $table2 WHERE $fieldsQOther) ORDER BY $order $sort");
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

		public function selectTwoCondition($select,$table,$field,$field2,$data){
			$select = $this->addComma($select);
			$this->stmt = $this->con->prepare("SELECT $select FROM $table WHERE $field = ? and $field2 = ?");
			$this->stmt->execute($data);
			return $this->stmt->fetchAll(PDO::FETCH_ASSOC);
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

		public function joinAgreement($data){
			try {
				$this->stmt = $this->con->prepare("SELECT * FROM `agreement` a, `offerjobform` b, `seeker` c where a.`OfferJobFormID` = b.`OfferJobFormID` and a.`SeekerID` = c.`SeekerID` and `AgreementID` = ?");
				$this->stmt->execute($data);
				return $this->stmt->fetchAll(PDO::FETCH_ASSOC);
			} catch (Exception $e) {
				return $e->getMessage();
			}

		}

		public function joinSubscription($data){
			try {
				$this->stmt = $this->con->prepare("SELECT * FROM `subscription` a, `subscriptiontype` b WHERE a.`SubscriptionTypeID` = b.`SubscriptionTypeID` and a.`SubscriptionID` = ?");
				$this->stmt->execute($data);
				return $this->stmt->fetchAll(PDO::FETCH_ASSOC);
			} catch (Exception $e) {
				return $e->getMessage();
			}
		}

		public function joinOfferJobForm($data){
			try {
				$this->stmt = $this->con->prepare("SELECT * FROM `offerjob` a, `offerjobform` b, `passer` c where a.`OfferJobFormID` = b.`OfferJobFormID` and a.`PasserID` = c.`PasserID` and a.`OfferJobID` = ?");
				$this->stmt->execute($data);
				return $this->stmt->fetchAll(PDO::FETCH_ASSOC);
			} catch (Exception $e) {
				return $e->getMessage();
			}
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

		public function updateDBDynamic($table,$fields,$data,$wherClause){
			try {
				$whereClause = $this->andData($wherClause);
				$fieldsQ = $this->qDataUpdate($fields);
				$this->result = $this->stmt = $this->con->prepare("UPDATE $table SET $fieldsQ WHERE ($whereClause)");
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