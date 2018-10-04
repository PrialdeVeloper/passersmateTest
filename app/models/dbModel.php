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
					$this->con = new PDO("mysql: host=$host;  dbname=$dbname",$username,$password);
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

		public function queryOwn($sql){
			$this->stmt = $this->con->query($sql);
			$this->stmt->execute();
			return $this->stmt->fetchAll(PDO::FETCH_ASSOC);
		}


		public function countQueryOwn($sql){
			$this->stmt = $this->con->query($sql);
			$this->stmt->execute();
			return $this->stmt->fetchColumn();
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

		public function selectAllDynamicLikeLimitSearch($table,$data,$offset,$limit){
			$this->stmt = $this->con->prepare("SELECT * from $table WHERE `PasserCertificate` LIKE ? AND `PasserGender` <> ? AND `PasserAge` >= ? AND `PasserFee` >= ? AND `PasserCity` LIKE ? AND `PasserStatus` = ? LIMIT $offset,$limit");
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

		public function lessThan($table,$field,$field1,$where,$data){
			$select = $this->addComma($field);
			$fieldsQ = $this->andData($where);
			$this->stmt = $this->con->prepare("SELECT $select FROM $table WHERE ($fieldsQ) and $field1 <= ?");
			$this->stmt->execute($data);
			return $this->stmt->fetchAll(PDO::FETCH_ASSOC);
		}

		public function greaterThan($table,$field,$field1,$where,$data){
			$select = $this->addComma($field);
			$fieldsQ = $this->andData($where);
			$this->stmt = $this->con->prepare("SELECT $select FROM $table WHERE ($fieldsQ) and $field1 >= ?");
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

		public function selectAllLimitSingleAll($table,$offset,$count,$order,$sort){
			$this->stmt = $this->con->prepare("SELECT * FROM $table ORDER BY $order $sort LIMIT $offset,$count");
			$this->stmt->execute();
			return $this->stmt->fetchAll(PDO::FETCH_ASSOC);
		}

		public function JobOffer($table,$offset,$where,$user,$data,$count,$order,$sort){
			$this->stmt = $this->con->prepare("SELECT * FROM $table a, `passer` b, `seeker` c WHERE a.`PasserID` = b.`PasserID`and a.`SeekerID` = c.`SeekerID` AND a.$where >= ? AND a.$user = ? ORDER BY $order $sort LIMIT $offset,$count");
			$this->stmt->execute($data);
			return $this->stmt->fetchAll(PDO::FETCH_ASSOC);
		}

		public function countJobOffer($table,$where,$user,$data){
			$this->stmt = $this->con->prepare("SELECT COUNT(*) FROM $table WHERE $where >= ? AND $user = ?");
			$this->stmt->execute($data);
			return $this->stmt->fetchColumn();
		}

		public function joinSubscriptionAdmin($offset,$count,$order,$sort){
			$this->stmt = $this->con->prepare("SELECT * FROM `subscription` a, `subscriptiontype` b, `seeker` c WHERE a.`SubscriptionTypeID` = b.`SubscriptionTypeID` AND a.`SeekerID` = c.`SeekerID` ORDER BY $order $sort LIMIT $offset,$count");
			$this->stmt->execute();
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

		public function checkAuthenticityOr($table,$field,$field2,$field3,$data){
			$this->stmt = $this->con->prepare("SELECT COUNT(*) FROM $table WHERE $field = ? and ($field2 = ? OR $field3 = ?)");
			$this->stmt->execute($data);
			return $this->stmt->fetchColumn();
		}

		public function selectTwoCondition($select,$table,$field,$field2,$data){
			$select = $this->addComma($select);
			$this->stmt = $this->con->prepare("SELECT $select FROM $table WHERE $field = ? and $field2 = ?");
			$this->stmt->execute($data);
			return $this->stmt->fetchAll(PDO::FETCH_ASSOC);
		}

		public function countAll($table,$field){
			$this->stmt = $this->con->prepare("SELECT COUNT(*) from $table WHERE $field IS NOT NULL");
			$this->stmt->execute();
			return $this->stmt->fetchColumn();
		}

		public function countAllUsers($table1,$table2){
			$this->stmt = $this->con->prepare("SELECT ((SELECT COUNT(*) FROM $table1) + (SELECT COUNT(*) FROM $table2)) as sum");
			$this->stmt->execute();
			return $this->stmt->fetchColumn();
		}

		public function countAllUsersUnverified(){
			$this->stmt = $this->con->prepare("SELECT ((SELECT COUNT(*) FROM `passer` WHERE `PasserStatus` = 2) + (SELECT COUNT(*) FROM `seeker` WHERE `SeekerStatus` = 2)) as sum");
			$this->stmt->execute();
			return $this->stmt->fetchColumn();
		}

		public function countAllCount($table1,$table2,$field1,$field2,$data){
			$this->stmt = $this->con->prepare("SELECT ((SELECT COUNT(*) FROM $table1 WHERE $field1 = ?) + (SELECT COUNT(*) FROM $table2 WHERE $field2 = ?)) AS sum");
			$this->stmt->execute($data);
			return $this->stmt->fetchColumn();
		}

		public function rating($userID,$data){
			$this->stmt = $this->con->prepare("SELECT (SUM(`PersonalityRate`) + SUM(`PunctualityRate`) + SUM(`WorkQualityRate`)) / (SELECT COUNT(*) FROM `ratings` WHERE $userID = ? AND `ReviewBy` = ?)/3 as rating from `ratings` WHERE $userID = ? AND `ReviewBy` = ?");
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

		public function joinOfferJob($data){
			try {
				$this->stmt = $this->con->prepare("SELECT * FROM `offerjob` a, `offerjobform` b, `seeker` c WHERE a.`OfferJobFormID` = b.`OfferJobFormID`and a.`SeekerID` = c.`SeekerID` and a.`OfferJobID` = ?");
				$this->stmt->execute($data);
				return $this->stmt->fetchAll(PDO::FETCH_ASSOC);
			} catch (Exception $e) {
				return $e->getMessage();
			}
		}

		public function joinTransactionHistory($offset,$count,$order,$sort,$data){
			try {
				$this->stmt = $this->con->prepare("SELECT * FROM `transactionhistory` a, `offerjob` b, `seeker` c, `passer` d WHERE a.`OfferJobID` = b.`OfferJobID` AND b.`SeekerID` = c.`SeekerID` AND b.`PasserID` = d.`PasserID` AND b.`OfferJobStatus` >= ?");
				$this->stmt->execute($data);
				return $this->stmt->fetchAll(PDO::FETCH_ASSOC);
			} catch (Exception $e) {
				return $e->getMessage();
			}
		}

		public function countAllTransactionHistory($data){
			$this->stmt = $this->con->prepare("SELECT COUNT(*) FROM `transactionhistory` a, `offerjob` b, `seeker` c, `passer` d WHERE a.`OfferJobID` = b.`OfferJobID` AND b.`SeekerID` = c.`SeekerID` AND b.`PasserID` = d.`PasserID` AND b.`OfferJobStatus` >= ?");
			$this->stmt->execute($data);
			return $this->stmt->fetchColumn();
		}

		// public function joinTransactionHistory($offset,$count,$order,$sort,$data){
		// 	try {
		// 		$this->stmt = $this->con->prepare("SELECT * FROM `transactionhistory` a, `offerjob` b, `seeker` c, `passer` d WHERE a.`OfferJobID` = b.`OfferJobID` AND b.`SeekerID` = c.`SeekerID` AND b.`PasserID` = d.`PasserID` AND b.`OfferJobStatus` >= ?");
		// 		$this->stmt->execute($data);
		// 		return $this->stmt->fetchAll(PDO::FETCH_ASSOC);
		// 	} catch (Exception $e) {
		// 		return $e->getMessage();
		// 	}
		// }

		// public function countAllTransactionHistory($data){
		// 	$this->stmt = $this->con->prepare("SELECT COUNT(*) FROM `transactionhistory` a, `offerjob` b, `seeker` c, `passer` d WHERE a.`OfferJobID` = b.`OfferJobID` AND b.`SeekerID` = c.`SeekerID` AND b.`PasserID` = d.`PasserID` AND b.`OfferJobStatus` >= ?");
		// 	$this->stmt->execute($data);
		// 	return $this->stmt->fetchColumn();
		// }



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

		public function joinOfferJobFormUsed($user, $data){
			$this->stmt = $this->con->prepare("SELECT * FROM `transactionhistory` a, `offerjob` b, `offerjobform` c, `seeker` d, `passer` e  WHERE a.`OfferJobID` = b.`OfferJobID` AND b.`OfferJobFormID` = c.`OfferJobFormID` AND b.`SeekerID` = d.`SeekerID` AND b.`PasserID` = e.`PasserID` AND b.$user = ? ORDER BY `TransactionDateTime` DESC");
			$this->stmt->execute($data);
			return $this->stmt->fetchAll(PDO::FETCH_ASSOC);
		}

		public function joinCancel($data){
			try {
				$this->stmt = $this->con->prepare("SELECT * FROM `canceljoboffer` a, `offerjob` b, `seeker` c, `passer` d WHERE a.`OfferJobID` = b.`OfferJobID` and a.`SeekerID` = c.`SeekerID` and a.`PasserID` = d.`PasserID` and a.`OfferJobID` = ?");
				$this->stmt->execute($data);
				return $this->stmt->fetchAll(PDO::FETCH_ASSOC);
			} catch (Exception $e) {
				return $e->getMessage();
			}
		}

		public function joinPasserSeeker(){
			try {
				$this->stmt = $this->con->prepare(
					"SELECT `PasserID`,concat(`PasserFN`,' ',`PasserLN`) as `fullname`,`PasserStatus`,`PasserProfile`,`passerRegisterTimeDate`,`UserType` FROM `Passer`
					UNION
					select `SeekerID`,concat(`SeekerFN`,' ',`SeekerLN`) as `fullname`,`SeekerStatus`,`SeekerProfile`,`SeekerRegisterDateTime`,`UserType` FROM `Seeker`"
				);
				$this->stmt->execute();	
				return $this->stmt->fetchAll(PDO::FETCH_ASSOC);
			} catch (Exception $e) {
				return $e->getMessage();
			}
		}

		public function joinAgreementCancel($unique,$data){
			try {
				$this->stmt = $this->con->prepare("SELECT * FROM `agreement` a, `offerjobformused` b WHERE a.`OfferJobFormUsedID` = b.`JobOfferFormUsedID` and $unique = ?");
				$this->stmt->execute($data);
				return $this->stmt->fetchAll(PDO::FETCH_ASSOC);
			} catch (Exception $e) {
				return $e->getMessage();
			}
		}

		public function getIDAgreement($orderjobid){
			try {
				$this->stmt = $this->con->prepare("SELECT `AgreementID` FROM `agreement`a, `offerjobformused` b WHERE a.`OfferJobFormUsedID` = b.`JobOfferFormUsedID` AND b.`OfferJobID` = ?");
				$this->stmt->execute($orderjobid);
				return $this->stmt->fetchAll(PDO::FETCH_ASSOC);
			} catch (Exception $e) {
				return $e->getMessage();
			}
		}

		public function joinAgreement($unique,$user){
				try {
				$this->stmt = $this->con->prepare("SELECT * FROM `agreement` a, `seeker` b, `passer` c, `offerjobformused` d WHERE a.`SeekerID` = b.`SeekerID` AND a.`PasserID` = c.`PasserID` AND a.`OfferJobFormUsedID` = d.`JobOfferFormUsedID` AND a.$unique = ?");
				$this->stmt->execute($user);
				return $this->stmt->fetchAll(PDO::FETCH_ASSOC);
			} catch (Exception $e) {
				return $e->getMessage();
			}
		}

		public function joinRating($unique,$data,$order,$sort,$offset,$count){
			$this->stmt = $this->con->prepare("SELECT * FROM `ratings` a, `passer` b, `seeker` c WHERE a.`PasserID` = b.`PasserID` AND a.`SeekerID` = c.`SeekerID` AND a.$unique = ? AND a.`ReviewBy` = ? ORDER BY $order $sort LIMIT $offset,$count");
			$this->stmt->execute($data);
			return $this->stmt->fetchAll(PDO::FETCH_ASSOC);
		}

		public function joinRatingNoLimit($unique,$data,$order,$sort){
			$this->stmt = $this->con->prepare("SELECT * FROM `ratings` a, `passer` b, `seeker` c WHERE a.`PasserID` = b.`PasserID` AND a.`SeekerID` = c.`SeekerID` AND a.$unique = ? AND a.`ReviewBy` = ? ORDER BY $order $sort");
			$this->stmt->execute($data);
			return $this->stmt->fetchAll(PDO::FETCH_ASSOC);
		}

		public function joinRatingCount($unique,$data){
			$this->stmt = $this->con->prepare("SELECT COUNT(*) FROM `ratings` a, `passer` b, `seeker` c WHERE a.`PasserID` = b.`PasserID` AND a.`SeekerID` = c.`SeekerID` AND a.$unique = ? AND a.`ReviewBy` = ?");
			$this->stmt->execute($data);
			return $this->stmt->fetchColumn();
		}

		public function joinDispute($unique,$user){
			$this->stmt = $this->con->prepare("SELECT * FROM `dispute` a, `passer` b, `seeker` c, `offerjob` d WHERE a.`PasserID` = b.`PasserID` AND a.`SeekerID` = c.`SeekerID` AND a.`JobOfferID` = d.`OfferJobID` AND a.$unique = ? AND a.`JobOfferID` = ?");
			$this->stmt->execute($user);
			return $this->stmt->fetchAll(PDO::FETCH_ASSOC);
		}

		public function joinDisputeAdmin(){
			$this->stmt = $this->con->prepare("SELECT * FROM `dispute` a, `passer` b, `seeker` c, `offerjob` d WHERE a.`PasserID` = b.`PasserID` AND a.`SeekerID` = c.`SeekerID` AND a.`JobOfferID`  = d.`OfferJobID` AND a.`DisputeStatus` = 1 ORDER BY `DisputeIssued` DESC");
			$this->stmt->execute();
			return $this->stmt->fetchAll(PDO::FETCH_ASSOC);
		}

		public function agreementGenerate($data){
			$this->stmt = $this->con->prepare("SELECT * FROM `agreement` a, `seeker` b, `passer` c, `offerjobformused` d WHERE a.`SeekerID` = b.`SeekerID` AND a.`PasserID` = c.`PasserID` AND a.`OfferJobFormUsedID` = d.`JobOfferFormUsedID` AND d.`OfferJobID` = ?");
			$this->stmt->execute($data);
			return $this->stmt->fetchAll(PDO::FETCH_ASSOC);
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