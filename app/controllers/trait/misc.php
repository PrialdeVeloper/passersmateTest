<?php
	trait misc{
		protected $model = null;
		protected $controller = null;
		protected $data = array();
		protected $trait = null;
		protected $options = ['cost' => 12,];

		public function sanitize($variable){
			return htmlentities(trim($variable));
		}

		public function decodeISO($variable){
			return html_entity_decode($variable);
		}

		public function upperFirstOnlySpecialChars($variable){
			return ucwords(mb_strtolower($variable,"UTF-8"));
		}

		public function checkSession($session){
			return isset($_SESSION[$session])?true:false;
		}

		public function hashPassword($variable){
			return password_hash($variable, PASSWORD_BCRYPT, $this->options);
		}

		public function verifyHash($password,$hashPassword){
			if(password_verify($password,$hashPassword)){
				return true;
			}
			else{
				return false;
			}
		}

		// public function checkAuthenticity(){
		// 	$return = null;
		// 	$return = $this->model->checkAuthenticity($_GET['table'],$_GET['field'],$_GET['field2'],array($_GET['data1'],$_GET['data2']));
		// }

		public function returnURLFacebook(){
			$fb = null;
			$data = [];
			$fb = new Facebook\Facebook([
				'app_id' => '170160493603540',
				'app_secret' => 'e0f71895d4a60525054f55567ccd486f',
				'default_graph_version' => 'v2.12'
			]);
			$helper = $fb->getRedirectLoginHelper();
			$redirectURL = "http://localhost/passersmate/public/home/getFacebookData";
			$permission = array("email","user_birthday");
			$loginURL = $helper->getLoginUrl($redirectURL,$permission);
			return $loginURL;
		}

		public function getFacebookData(){
			$fb = new Facebook\Facebook([
				'app_id' => '170160493603540',
				'app_secret' => 'e0f71895d4a60525054f55567ccd486f',
				'default_graph_version' => 'v2.12'
			]);

			$helper = $fb->getRedirectLoginHelper();
			try {
				$accessToken = $helper->getAccessToken();
			} catch (\Facebook\Exception\FacebookResponseException $e) {
				echo 'response sdk: ' .$e->getMessage();
			} catch(\Facebook\Exception\FacebookSDKException $e){
				echo 'SDK: '. $e->getMessage();
			}

			if(!$accessToken){
				header("location: ../seeker/dashboard");
			}

			$oauth = $fb->getOAuth2Client();
			if(!$accessToken->isLongLived())
				$accessToken = $oauth->getLongLivedAccessToken($accessToken);

			$res = $fb->get("/me?fields=id, first_name, middle_name, last_name, email, picture.type(large), cover, gender, address, link, location, birthday, age_range",$accessToken);
			$user = $res->getGraphNode()->asArray();
			$facebookIdCheck = $this->model->checkExistSingle($this->seekerTable,$this->seekerFacebook,array($this->sanitize($user['id'])));
			$seekerFacebookId = $this->sanitize($user['id']);
			if($facebookIdCheck <= 0){
				$seekerFName = $this->sanitize($user['first_name']);
				$seekerLName = $this->sanitize($user['last_name']);
				$seekerEmail = $this->sanitize($user['email']);
				$seekerGender = $this->sanitize($user['gender']);
				$seekerLink = $this->sanitize($user['link']);
				$return = $this->model->insertDB($this->seekerTable,$this->seekerFacebookAdd,array($seekerFacebookId,$seekerFName,$seekerLName,$seekerEmail,$seekerGender,$seekerLink));
				if($return){
					$_SESSION['seekerUser'] = $return;
					$fb = null;
					$accessToken = null;
					$oauth = null;
					$user = null;
					$res = null;
					$return = null;
					header("location: ../seeker/dashboard");
				}
			}else{
				$return = $this->model->selectSingleUser($this->seekerTable,$this->seekerUnique,array($seekerFacebookId),$this->seekerFacebook);
				if($return){
					$_SESSION['seekerUser'] = $return;
					$fb = null;
					$accessToken = null;
					$oauth = null;
					$user = null;
					$res = null;
					$return = null;
					header("location: ../seeker/dashboard");
				}
			}
		}

		public function showError($div,$message){
			echo '
			<script>
				$("'.$div.'").show();
				$("'.$div.'").html("'.$message.'");
			</script>
			';
		}

		public function toOtherPage($where){
			echo '
			<script>
				window.location="'.$where.'"
			</script>
			';
		}

		public function __construct(){
			
		}

		public function logout(){
			session_destroy();
			header("location:../home/login");
		}

		public function crawler(){
			$data = null;
			$lname = null;
			$fnameIndex = null;
			$fname = null;
			$mnameIndex = null;
			$mname = null;
			if(isset($_POST['dataSent'])){
				$coc = $_POST['data'];
				$curl = curl_init();
				$url = "http://www.tesda.gov.ph/Rwac/Result2?CurrentFilter=&CertFilter=".$coc."&QualFilter=";
				curl_setopt($curl, CURLOPT_URL, $url);
				curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
				curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
				$res = curl_exec($curl);
				curl_close($curl);

				$dom = new simple_html_dom();
				$dom->load($res);

				if($dom->find('table tr td',0)){
					$name = trim($dom->find('table tr td',0)->plaintext);
					$i = 0;
					while(substr($name, $i,1) != ","){
						$lname = $lname."".substr($name, $i,1);
						$i +=1;
						$fnameIndex = $i+1;
					}
					while(substr($name, $fnameIndex+1,1) != ".") {
						$fname = $fname."".substr($name, $fnameIndex,1);
						$fnameIndex +=1;
						$mnameIndex = $fnameIndex;
					}
					$fname = html_entity_decode(ucwords(mb_strtolower($fname,"UTF-8")));
					$lname = html_entity_decode(ucwords(mb_strtolower($lname,"UTF-8")));
					$mname = substr($name, $mnameIndex,1);
					$num = trim($dom->find('table tr td',1)->plaintext);
					$ncert = html_entity_decode(htmlentities(trim($dom->find('table tr td',2)->plaintext)));

					$point =  strpos($ncert, ' NC ')+1;
					$textResult = substr($ncert, $point,6);
					for ($i=6; $i > 0 ; $i--) { 
						$textResult = substr($ncert, $point,$i);

						if($textResult == "NC III"){
							$certType = "NC III";
							break;
						}elseif($textResult == "NC II"){
							$certType = "NC II";
							break;
						}elseif($textResult == "NC I"){
							$certType = "NC I";
							break;
						}else{
							$certType = "COC";
							break;
						}
					}

					$link = "http://www.tesda.gov.ph".trim($dom->find('table tr td:eq(3) a',0)->href);

					$data = array("fname"=>$fname,"lname"=>$lname,"mname"=>$mname,
						"cnum"=>$num,"cert"=>$ncert,"certType"=>$certType,
						"link",$link,"error"=>false);
					$json =  json_encode($data,JSON_UNESCAPED_UNICODE);
					echo $json;
				}
				else{
					echo json_encode(array("error"=>true),JSON_UNESCAPED_UNICODE);
				}
			}
		}

		public function checkExist(){
			if (isset($_POST['dataSend']) && !empty($_POST['dataSend'])) 
			{
				$table = $_POST['table'];
				$field = $_POST['field'];
				$dataSend = $_POST['data'];
				echo utf8_encode($this->model->checkExistSingle($table,$field,array($dataSend)));
			}
			else
			{
				return $this->model->checkExistSingle(array($table,$field,$data));
			}
		}

		public function randomize(){
			$random = time() . rand(1,10) . strtotime("now") . rand(1,6);
			return $random;
		}

		public function imageUpload($destination,$file,$id){
			$target_dir = "../public/etc/images/".$destination."/";
			$target_file = $target_dir . basename($_FILES[$file]["name"]);
			$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
			$randomFileName = $this->randomize() . $id . "." . $imageFileType;
			$fileDir = $target_dir . $randomFileName;
		    if (move_uploaded_file($_FILES[$file]["tmp_name"], $fileDir)) {
		        return "../../public/etc/images/".$destination."/" . $randomFileName;
		    } else {
		        return $_FILES[$file]["error"];
		    }
		}


		public function validatePasser(){
			if(isset($_POST['passerValidate'])){
				$frontID = $this->imageUpload("userVerify/passer","frontID",$this->passerSession);
				$backID = $this->imageUpload("userVerify/passer","backID",$this->passerSession);
				$selfie = $this->imageUpload("userVerify/passer","selfieID",$this->passerSession);
				$coc = $this->imageUpload("userVerify/passer","competencyCertificate",$this->passerSession);
				$idNumber = $this->sanitize($_POST['idNumber']);
				$idType = $this->sanitize($_POST['acceptedId']);
				$expDate = $this->sanitize(date("Y-m-d",strtotime($_POST['expiryDate'])));

				try {
					$return = $this->model->insertDB("passervalidate",$this->passerValidate,array($this->passerSession,$frontID,$backID,$selfie,$coc,$idType,$idNumber,$expDate));
					if($return){
						$updateThis = $this->model->updateDB("$this->passerTable",array("PasserStatus"),array(2),$this->passerUnique,$this->passerSession);
						if($updateThis){
							echo json_encode(array("error"=>"none"));
						}
					}
				} catch (Exception $e) {
					echo $e->getMessage();
				}
			}
		}


		public function registerPasser(){
			if(isset($_POST['registerPasser'])){
					$cocNumber = $this->sanitize($_POST['cocNumber']);
					$passerFirstname = $this->decodeISO($this->sanitize($_POST['passerFirstname']));
					$passerLastname = $this->decodeISO($this->sanitize($this->upperFirstOnlySpecialChars($_POST['passerLastname'])));
					$passerMiddlename = $this->decodeISO($this->sanitize($this->upperFirstOnlySpecialChars($_POST['passerMiddlename'])));
					$cocTitle = $this->decodeISO($this->sanitize($_POST['cocTitle']));
					$passerPassword = $this->sanitize($this->hashPassword($_POST['passerPassword']));
					$email = $this->sanitize($_POST['email']);
					$typeofCertificatePasser = $this->sanitize($_POST['typeofCertificatePasser']);
					$passerTesdaLink = $this->sanitize($_POST['passerLink']);
					try {
						$return = $this->model->insertDB('passer',$this->passerReg,array($cocNumber,$passerFirstname,$passerLastname,$passerMiddlename,$passerPassword,$email,$cocTitle,$typeofCertificatePasser,$passerTesdaLink));
						$_SESSION['passerUser'] = $return;
						echo json_encode(array("error"=>"none"));
					} catch (Exception $e) {
						echo json_encode(array("error"=>$e->getMessage()));
					}
			}
		}

		public function updatePasserPersonalDetails(){
			if(isset($_POST['passerUpdateDataNoImage'])){
				try {
				$passerAddress = $this->sanitize($this->upperFirstOnlySpecialChars($_POST['passerAddress']));
				$passerStreet = $this->sanitize($this->upperFirstOnlySpecialChars($_POST['passerStreet']));
				$passerCity = $this->sanitize($this->upperFirstOnlySpecialChars($_POST['passerCity']));
				$passerGender = $this->sanitize($_POST['passerGender']);
				$passerCPNo = $this->sanitize($_POST['PasserCPNo']);
				$passerBirthdate = $this->sanitize(date("Y-m-d",strtotime($_POST['passerBirthdate'])));
				$res = $this->model->updateDB($this->passerTable,$this->passDashboardPersonalDetails,array($passerAddress,$passerStreet,$passerCity,$passerGender,$passerCPNo,$passerBirthdate),$this->passerUnique,$this->passerSession);
				echo json_encode(array("error"=>"none"));
				} catch (Exception $e) {
					echo json_encode(array("error"=>$e->getMessage()));
				}
			}elseif(isset($_POST['passerUpdateDataWithImage'])){
				try {
				$passerProfile = $this->imageUpload("user","profileUploadPasser",$this->passerSession);
				$passerAddress = $this->sanitize($this->upperFirstOnlySpecialChars($_POST['passerAddress']));
				$passerStreet = $this->sanitize($this->upperFirstOnlySpecialChars($_POST['passerStreet']));
				$passerCity = $this->sanitize($this->upperFirstOnlySpecialChars($_POST['passerCity']));
				$passerGender = $this->sanitize($_POST['passerGender']);
				$passerCPNo = $this->sanitize($_POST['PasserCPNo']);
				$passerBirthdate = $this->sanitize(date("Y-m-d",strtotime($_POST['passerBirthdate'])));
				$res = $this->model->updateDB($this->passerTable,$this->passDashboardPersonalDetailsWithPhoto,array($passerAddress,$passerStreet,$passerCity,$passerGender,$passerCPNo,$passerBirthdate,$passerProfile),$this->passerUnique,$this->passerSession);
				echo json_encode(array("error"=>"none"));
				} catch (Exception $e) {
					print_r($e->getMessage());
				}
			}
		}

		public function addJobExperience(){
			if(isset($_POST['passerJobExperienceData'])){
				try {
				$title = $this->sanitize($this->upperFirstOnlySpecialChars($_POST['jTitle']));
				$company = $this->sanitize($this->upperFirstOnlySpecialChars($_POST['company']));
				$startDate = $this->sanitize(date("Y-m-d",strtotime($_POST['startDate'])));
				$endDate = $this->sanitize(date("Y-m-d",strtotime($_POST['endDate'])));
				$desc = !empty($_POST["passerWorkDesc"])?$this->sanitize($_POST["passerWorkDesc"]): "";
				unset($this->passerWorkHistory[0]);
				unset($this->passerWorkHistory[7]);
				$res =  $this->model->insertDB("passerworkhistory",$this->passerWorkHistory,array($this->passerSession,$title,$company,$desc,$startDate,$endDate));
				echo json_encode(array("error"=>"none"));
				} catch (Exception $e) {
					echo $e->getMessage();
				}
			}else{
				if(isset($_GET['passerJobExperienceDataUpdate'])){
					try {
					$idWorkHistory = $this->sanitize($_GET['workExperienceID']);
					$title = $this->sanitize($this->upperFirstOnlySpecialChars($_GET['jTitle']));
					$company = $this->sanitize($this->upperFirstOnlySpecialChars($_GET['company']));
					$startDate = $this->sanitize(date("Y-m-d",strtotime($_GET['startDate'])));
					$endDate = $this->sanitize(date("Y-m-d",strtotime($_GET['endDate'])));
					$desc = !empty($_GET["passerWorkDesc"])?$this->sanitize($_GET["passerWorkDesc"]): "";
					unset($this->passerWorkHistory[0]);
					unset($this->passerWorkHistory[7]);
					$res = $this->model->updateDB("passerworkhistory",$this->passerWorkHistory,array($this->passerSession,$title,$company,$desc,$startDate,$endDate),"PasserWorkHistoryID",$idWorkHistory);
					echo json_encode(array("error"=>"none"));
					} catch (Exception $e) {
						echo $e->getMessage();
					}
				}
			}
		}

		// public function updateJobExperience(){
		// 	if(isset($_GET['passerJobExperienceDataUpdate'])){
		// 		try {
		// 		$idWorkHistory = $this->sanitize($_GET['workExperienceID']);
		// 		$title = $this->sanitize($this->upperFirstOnlySpecialChars($_GET['jTitle']));
		// 		$company = $this->sanitize($this->upperFirstOnlySpecialChars($_GET['company']));
		// 		$startDate = $this->sanitize(date("Y-m-d",strtotime($_GET['startDate'])));
		// 		$endDate = $this->sanitize(date("Y-m-d",strtotime($_GET['endDate'])));
		// 		$desc = !empty($_GET["passerWorkDesc"])?$this->sanitize($_GET["passerWorkDesc"]): "";
		// 		unset($this->passerWorkHistory[0]);
		// 		unset($this->passerWorkHistory[7]);
		// 		$res = $this->model->updateDB("passerworkhistory",$this->passerWorkHistory,array($this->passerSession,$title,$company,$desc,$startDate,$endDate),"PasserWorkHistoryID",$idWorkHistory);
		// 		echo json_encode(array("error"=>"none"));
		// 		} catch (Exception $e) {
		// 			echo $e->getMessage();
		// 		}
		// 	}
		// }


		public function addEducation(){
			if(isset($_POST['passerEducation'])){
				try {
				$attainment = $this->sanitize($this->upperFirstOnlySpecialChars($_POST['educationalLevel']));
				$school = $this->sanitize($this->upperFirstOnlySpecialChars($_POST['school']));
				$res = !empty($_POST["passerDesc"])? $this->model->insertDB("passereducation",$this->passerEducation,array($this->passerSession,$attainment,$school,$this->sanitize($_POST["passerDesc"]))): $this->model->insertDB("passereducation",$this->passerEducation,array($this->passerSession,$attainment,$school,""));
				echo json_encode(array("error"=>"none"));
				} catch (Exception $e) {
					echo $e->getMessage();
				}
			}
		}
	}
?>