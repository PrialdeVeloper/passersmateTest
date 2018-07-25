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

		public function checkAuthenticity($table,$field,$field2,$data){
			$return = null;
			$return = $this->model->checkAuthenticity($table,$field,$field2,$data);
			return $return?true:false;
		}

		public function unlinkFileFromDB($imageName){
			$imageFile = str_replace("../../", "../", $this->sanitize($imageName));
			if(file_exists($imageFile)){
				unlink($imageFile);
			}
			return true;
			
		}

		public function returnURLGmail(){
			$gmail = null;
			$google = new Google_Client();
			$google->setClientID('90516234623-faht3953u559pufek8kt6ibhu4u4ie3s.apps.googleusercontent.com');
			$google->setClientSecret('zv08B6KoCTLGpTea338hagb1');
			$google->setApplicationName('PassersMate');
			$google->setRedirectUri('http://localhost/passersmate/public/home/getGmailData');
			$google->addScope("https://www.googleapis.com/auth/plus.login https://www.googleapis.com/auth/userinfo.email");
			$loginURL = $google->createAuthUrl();
			return $loginURL;
		}

		public function getGmailData(){
			$google = null;
			$token = null;
			$auth = null;
			$user = null;
			if(isset($_GET['code']) && !empty($_GET['code'])){
				$google = new Google_Client();
				$google->setClientID('90516234623-faht3953u559pufek8kt6ibhu4u4ie3s.apps.googleusercontent.com');
				$google->setClientSecret('zv08B6KoCTLGpTea338hagb1');
				$google->setApplicationName('PassersMate');
				$google->setRedirectUri('http://localhost/passersmate/public/home/getGmailData');
				$token = $google->fetchAccessTokenWithAuthCode($_GET['code']);
				$auth = new Google_Service_Oauth2($google);
				$user = $auth->userinfo_v2_me->get();
				$gmailIdCheck = $this->model->checkExistSingle($this->seekerTable,$this->seekerGmail,array($this->sanitize($user['id'])));
				$seekerGmailId = $this->sanitize($user['id']);

				if($gmailIdCheck <= 0){
				$seekerFName = $this->sanitize($user['givenName']);
				$seekerLName = $this->sanitize($user['familyName']);
				$seekerEmail = $this->sanitize($user['email']);
				$seekerGender = $this->upperFirstOnlySpecialChars($this->sanitize($user['gender']));
				$seekerLink = $this->sanitize($user['link']);
				$seekerPic = $this->sanitize($user['picture']);
				$return = $this->model->insertDB($this->seekerTable,$this->seekerGmailAdd,array($seekerGmailId,$seekerFName,$seekerLName,$seekerEmail,$seekerGender,$seekerLink,$seekerPic));
					if($return){
						$_SESSION['seekerUser'] = $return;
						$fb = null;
						$accessToken = null;
						$oauth = null;
						$user = null;
						$res = null;
						$return = null;
					}
				}else{
					$return = $this->model->selectSingleUser($this->seekerTable,$this->seekerUnique,array($seekerGmailId),$this->seekerGmail);
					if($return){
						$_SESSION['seekerUser'] = $return;
						$fb = null;
						$accessToken = null;
						$oauth = null;
						$user = null;
						$res = null;
						$return = null;
					}
				}
				$this->toOtherPage("../seeker/dashboard");
			}
		}

		public function returnURLFacebook(){
			$fb = null;
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
				$seekerGender = $this->upperFirstOnlySpecialChars($this->sanitize($user['gender']));
				$seekerLink = $this->sanitize($user['link']);
				$seekerPic = $this->sanitize($user['picture']['url']);
				$return = $this->model->insertDB($this->seekerTable,$this->seekerFacebookAdd,array($seekerFacebookId,$seekerFName,$seekerLName,$seekerEmail,$seekerGender,$seekerLink,$seekerPic));
				if($return){
					$_SESSION['seekerUser'] = $return;
					$fb = null;
					$accessToken = null;
					$oauth = null;
					$user = null;
					$res = null;
					$return = null;
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
				}
			}
			$this->toOtherPage("../seeker/dashboard");
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

		public function validateSeeker(){
			if(isset($_POST['seekerValidate'])){
				$frontID = $this->imageUpload("userVerify/seeker","frontID",$this->seekerSession);
				$backID = $this->imageUpload("userVerify/seeker","backID",$this->seekerSession);
				$selfie = $this->imageUpload("userVerify/seeker","selfieID",$this->seekerSession);
				$idNumber = $this->sanitize($_POST['idNumber']);
				$idType = $this->sanitize($_POST['acceptedId']);
				$expDate = $this->sanitize(date("Y-m-d",strtotime($_POST['expiryDate'])));

				try {
					$return = $this->model->insertDB("seekervalidate",$this->seekerValidate,array($this->seekerSession,$frontID,$backID,$selfie,$idType,$idNumber,$expDate));
					if($return){
						$updateThis = $this->model->updateDB("$this->seekerTable",array("seekerStatus"),array(2),$this->seekerUnique,$this->seekerSession);
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
				$imageFile = $this->model->selectSingleUser($this->passerTable,"PasserProfile",array($this->passerSession),$this->passerUnique);
				$this->unlinkFileFromDB($imageFile);
				$passerProfile = $this->imageUpload("user/passer","profileUploadPasser",$this->passerSession);
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

		public function updateSeekerPersonalDetails(){
			if(isset($_POST['seekerUpdateDataNoImage'])){
				try {
				$seekerAddress = $this->sanitize($this->upperFirstOnlySpecialChars($_POST['seekerAddress']));
				$seekerStreet = $this->sanitize($this->upperFirstOnlySpecialChars($_POST['seekerStreet']));
				$seekerCity = $this->sanitize($this->upperFirstOnlySpecialChars($_POST['seekerCity']));
				$seekerGender = $this->sanitize($_POST['seekerGender']);
				$seekerCPNo = $this->sanitize($_POST['SeekerCPNo']);
				$seekerBirthdate = $this->sanitize(date("Y-m-d",strtotime($_POST['seekerBirthdate'])));
				$res = $this->model->updateDB($this->seekerTable,$this->seekDashboardPersonalDetails,array($seekerAddress,$seekerStreet,$seekerCity,$seekerGender,$seekerCPNo,$seekerBirthdate),$this->seekerUnique,$this->seekerSession);
				echo json_encode(array("error"=>"none"));
				} catch (Exception $e) {
					echo json_encode(array("error"=>$e->getMessage()));
				}
			}elseif(isset($_POST['seekerUpdateDataWithImage'])){
				try {
				$imageFile = $this->model->selectSingleUser($this->seekerTable,"SeekerProfile",array($this->seekerSession),$this->seekerUnique);
				$this->unlinkFileFromDB($imageFile);
				$seekerProfile = $this->imageUpload("user/seeker","profileUploadSeeker",$this->seekerSession);
				$seekerAddress = $this->sanitize($this->upperFirstOnlySpecialChars($_POST['seekerAddress']));
				$seekerStreet = $this->sanitize($this->upperFirstOnlySpecialChars($_POST['seekerStreet']));
				$seekerCity = $this->sanitize($this->upperFirstOnlySpecialChars($_POST['seekerCity']));
				$seekerGender = $this->sanitize($_POST['seekerGender']);
				$seekerCPNo = $this->sanitize($_POST['SeekerCPNo']);
				$seekerBirthdate = $this->sanitize(date("Y-m-d",strtotime($_POST['seekerBirthdate'])));
				$res = $this->model->updateDB($this->seekerTable,$this->seekDashboardPersonalDetailsWithPhoto,array($seekerAddress,$seekerStreet,$seekerCity,$seekerGender,$seekerCPNo,$seekerBirthdate,$seekerProfile),$this->seekerUnique,$this->seekerSession);
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
				if(isset($_POST['passerJobExperienceDataUpdate'])){
					$idWorkHistory = $this->sanitize($_POST['workExperienceID']);
					if($this->checkAuthenticity("passerworkhistory","PasserWorkHistoryID","PasserID",array($idWorkHistory,$this->passerSession))){
						try {
							$title = $this->sanitize($this->upperFirstOnlySpecialChars($_POST['jTitle']));
							$company = $this->sanitize($this->upperFirstOnlySpecialChars($_POST['company']));
							$startDate = $this->sanitize(date("Y-m-d",strtotime($_POST['startDate'])));
							$endDate = $this->sanitize(date("Y-m-d",strtotime($_POST['endDate'])));
							$desc = !empty($_POST["passerWorkDesc"])?$this->sanitize($_POST["passerWorkDesc"]): "";
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
		}

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


		public function registerAdmin(){
			if(isset($_POST['registerAdmin'])){
				$username = $this->sanitize($_POST['adminUsername']);
				$email = $this->sanitize($_POST['adminEmail']);
				$password = $this->sanitize($this->hashPassword($_POST['adminPassword']));
				try {
					$return = $this->model->insertDB($this->adminTable,$this->adminReg,array($username,$email,$password));
					$_SESSION['adminUser'] = $return;
					echo json_encode(array("error"=>"none"));
				} catch (Exception $e) {
					echo json_encode(array("error"=>$e->getMessage()));
				}
			}
		}

		public function createPasserUnverified(){
			if(!$this->checkSession('adminUser')){
				header("location:index");
			}
			$dom = null;
			$tableCreate = null;
			$passerUnverified = $this->model->selectAllFromUser("passer","PasserStatus",array(2));
			foreach ($passerUnverified as $data) {
				$dom = '
				<tr>
                    <td class=""><a href="" class="passerUnverify" data-toggle="modal" data-target="#Modal3" data-passer='.$data['PasserID'].'><span badge badge-warning">'.$data['PasserID'].'</span></a></td>
                    <td class="">'.$this->sanitize($data['PasserFN']). ' '. $this->sanitize($data['PasserMname']). '. ' . $this->sanitize($data['PasserLN']).'</td>
                    <td class="">'.$this->sanitize($data['PasserEmail']).'</td>
                    <td class="">Passer</td>
                </tr>
				';
				$tableCreate = $tableCreate ."".$dom;
			}
			return $tableCreate;
		}

		public function selectCondition(){
			if(isset($_POST['getData'])){
				$data = $this->sanitize($_POST['data']);
				$return = array("passerDetails"=>$this->model->queryDataUnverifiedPasser(array($data)));
				echo json_encode($return);
			}
		}

		public function updateStatus(){
			if(isset($_POST['userStatus'])){
				$table = $this->sanitize($_POST['table']);
				$field = $this->sanitize($_POST['field']);
				$id = $this->sanitize($_POST['id']);
				$status = $this->sanitize($_POST['status']);
				try {
					$return = $this->model->updateDB($table,array($field),array($status),"PasserID",$id);
					echo json_encode(array("error"=>"none"));
				} catch (Exception $e) {
					echo $e->getMessage();
				}	
			}
		}

	}
?>