<?php 
	class home extends Controller{

		public $seekerTable = "seeker";
		public $seekerUnique = "SeekerID";
		public $seekerFacebook = "seekerFacebookId";
		public $seekerGmail = "SeekerGmailID";
		public $seekerFacebookAdd = array("SeekerFacebookId","SeekerFN","SeekerLN","SeekerEmail","SeekerGender","SeekerFacebookLink","SeekerProfile");
		public $seekerGmailAdd = array("SeekerGmailID","SeekerFN","SeekerLN","SeekerEmail","SeekerGender","SeekerGmailLink","SeekerProfile");

		public function __construct(){
			$this->controller = new Controller();
			$this->model = $this->controller->model("dbModel");
			$this->data = [];
		}

		public function __destruct(){
			$this->model = null;
			$this->controller = null;
			$this->data = array();
		}

		public function index(){
			$table = $id = $userName = $userData = $field = $dashboardLoc =  null;
			$data = [];
			$login = 
			'
				<li><a href="signup">Sign up</a></li>
				<li><a href="login">Log in</a></li>
			';
			if($this->checkSession('passerUser') || $this->checkSession('seekerUser')){
				$dashboardLoc = (isset($_SESSION['passerUser'])?"../passer/dashboard":"../seeker/dashboard");
				$table = (isset($_SESSION['passerUser'])?$this->passerTable:$this->seekerTable);
				$field = (isset($_SESSION['passerUser'])?$this->passerUnique:$this->seekerUnique);
				$id = (isset($_SESSION['passerUser'])?$_SESSION['passerUser']:$_SESSION['seekerUser']);
				$userData = $this->model->selectAllFromUser($table,$field,array($id));
				extract($userData[0]);
				$userName = (isset($_SESSION['passerUser'])?$PasserFN:$SeekerFN);
				$login = '<li><a href="'.$dashboardLoc.'"><i class="fa fa-user-circle" aria-hidden="true"></i> '.$userName.'</a></li>';
			}
			$data[] = array("loginDynamic"=>$login);
			$this->controller->view("all/index",$data);
		}

		public function login(){
			if($this->checkSession('passerUser')){
				header("location:../passer/dashboard");
			}elseif($this->checkSession('seekerUser')){
				header("location:../seeker/dashboard");
			}
			$data[] = array("redirectURLFacebook"=>$this->returnURLFacebook(),"redirectURLGmail"=>$this->returnURLGmail());
			$this->controller->view("all/login",$data);
			
			$status = null;
			if(isset($_POST['passerSubmit'])){
				$email = !empty($_POST['passerEmail'])?$this->sanitize($_POST['passerEmail']):"";
				$password = !empty($_POST['passerPass'])?$this->sanitize($_POST['passerPass']):"";
				if(!empty($email) && !empty($password)){
					$returnPassword = $this->model->selectSingleUser("passer","PasserPass",array($email),"PasserEmail");
					if(empty($returnPassword)){
						$this->showError("#passerLoginError","Login unsuccessful. Please check your email or password.");
					}else{
						if($this->verifyHash($password,$returnPassword)){
							$status =  $this->model->selectSingleUser("passer","PasserStatus",array($email),"PasserEmail");
							print_r($status);
							if($status == 4 || $status == 5){
								$this->showError("#passerLoginError","Login unsuccessful. Your account has been deactivated. Please contact admin for assistance.");
							}
							else{
								$_SESSION['passerUser'] = $this->model->selectSingleUser("passer","PasserID",array($email),"PasserEmail");
								$password = null;
								$returnPassword = null;
								$email = null;
								$this->toOtherPage("../passer/dashboard");
							}

						}
						else{
							$this->showError("#passerLoginError","Login unsuccessful. Please check your email or password.");
						}
					}
				}
			}
			elseif(isset($_POST['seekerSubmit'])){
				$email = !empty($_POST['seekerEmail'])?$this->sanitize($_POST['seekerEmail']):"";
				$password = !empty($_POST['seekerPass'])?$this->sanitize($_POST['seekerPass']):"";
				if(!empty($email) && !empty($password)){
					$returnPassword = $this->model->selectSingleUser("seeker","seekerPass",array($email),"SeekerEmail");
					if(empty($returnPassword)){
						$this->showError("#seekerLoginError","Login unsuccessful. Please check your email or password.");
					}else{
						if($this->verifyHash($password,$returnPassword)){
							$status =  $this->model->selectSingleUser("seeker","SeekerStatus",array($email),"SeekerEmail");
							if($status == 4 || $status == 5){
								echo
								"
								<script>
								$(function(){
									$('.seekerTab').trigger('click');			
									});
								</script>
								";
								$this->showError("#seekerLoginError","Login unsuccessful. Your account has been deactivated. Please contact admin for assistance.");
							}
							else{
								$_SESSION['seekerUser'] = $this->model->selectSingleUser("seeker","seekerID",array($email),"SeekerEmail");
								$password = null;
								$returnPassword = null;
								$email = null;
								$this->toOtherPage("../seeker/dashboard");
							}
						}
						else{
							echo
							"
							<script>
							$(function(){
								$('.seekerTab').trigger('click');			
								});
							</script>
							";
							$this->showError("#seekerLoginError","Login unsuccessful. Please check your email or password.");
						}
					}
				}
			}
		}

		public function signup(){
			$this->controller->view("all/signup",['qwe'=>'qwe']);
		}

		public function searchCreateDom(){
			if(isset($_POST['domCreate'])){
				$passer = $builder = $dom = $unstructured = $userUnique = $rating = $stars = $builderStar = null;
				if(!empty($_POST['data'])){
					$unstructured = $_POST['data'];
					foreach ($unstructured as $data) {
						$rating = (int)$this->model->rating($this->passerUnique,array($data['PasserID'],"Seeker",$data['PasserID'],"Seeker"));
			 			if(!empty($rating)){
							for ($i=0; $i < $rating ; $i++) { 
								$builderStar = '<i class="fas fa-star text-warning"></i>';
								$stars = $builderStar."".$stars;
							}
							for ($j=$i; $j < 5 ; $j++) { 
								$stars = $stars.'<i class="fas fa-star"></i>';
							}
							unset($i,$j);
						}
						else{
							$stars = '<i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i>';
						}
						$builder = '
						<div class="col-md-6">
      						<div class="card shadow animated1 flipInX" style="height:95%">
      							<div class="card-header">
      								  <div class="pretty p-svg p-curve">
								        <input type="checkbox" class="hehe" value="'.$this->sanitize($data["PasserID"]).'" />
								        <div class="state p-success">
								            <!-- svg path -->
								            <svg class="svg svg-icon" viewBox="0 0 20 20">
								                <path d="M7.629,14.566c0.125,0.125,0.291,0.188,0.456,0.188c0.164,0,0.329-0.062,0.456-0.188l8.219-8.221c0.252-0.252,0.252-0.659,0-0.911c-0.252-0.252-0.659-0.252-0.911,0l-7.764,7.763L4.152,9.267c-0.252-0.251-0.66-0.251-0.911,0c-0.252,0.252-0.252,0.66,0,0.911L7.629,14.566z" style="stroke: white;fill:white;"></path>
								            </svg>
								            <label class="font-weight-bold">Select this Passer</label>
								        </div>
								    </div>
      							</div>
      							<div class="card-body">
      								<div class="row">
      									<div class="col-md-5 text-center hoverable">
      										<a title="Jodel Adan">
      											<img src="'.$this->sanitize($data["PasserProfile"]).'" class="rounded-circle border border-primary wow fadeInUp" width="150" height="150">
      											<br>
      											<a class="badge badge-success mt-3 font-weight-bold text-white">
      												<i class="fas fa-check"></i> Verified Passer 
      											</a>
      									</div>
      									<div class="col-md-7 text-center" style="font-family: Georgia, Times, Times New Roman, serif;">
      										<a href="">
      											<p class="text-info" style="font-size:30px">
      											'.$this->sanitize($data["PasserFN"])." ".$this->sanitize($data["PasserMname"]).". ". $this->decodeISO($this->sanitize($data["PasserLN"])).'
      											</p>
      										</a>
  											<label class="trebuchet" style="font-family: Trebuchet MS, Lucida Grande, Lucida Sans Unicode, Lucida Sans, Tahoma, sans-serif;line-height: 26.4px;font-size: 18px">
  												'. $this->decodeISO($this->sanitize($data["PasserCertificate"])) .'
  											</label>
  											<div class="container">
      											'.$stars.'
											</div>
      									</div>
      								</div>
      								<div class="row">
      									<div class="col-md-12 text-center mt-3 text-primary">
      										<p style="font-size: 15px; color: blue">Education, Trainings & Organizations</p>
      										<p class="text-dark" style="font-size: 15px;">'.$this->sanitize($data["PasserCertificateType"]).'</p>
      									</div>
      								</div>
      							</div>
      							<div class=" card-footer  text-center" style="height:85px">
      								<a href="../passer/profile?user='.$this->sanitize($data["PasserCOCNo"]).'" class="btn-change1 btn btn-lg text-white" style="background:#0062cc">View profile</a>
      							</div>
      						</div>
          				</div>
			 			';
			 			$dom = $dom."".$builder;
					}
					echo $dom;
				}else{
					echo $dom = '<div class="container bg-danger d-flex justify-content-center">no data found</div>';
				}
			}
		}

		public function search(){
		 	$dom = null;
		 	$builder;
		 	$data = [];
		 	$details = null;
		 	$table = null;
		 	$userUnique = $rating = $stars = $builderStar = null;
		 	$sessionActive = $checkActiveWork = null;
		 	if($this->checkSession('passerUser') || $this->checkSession('seekerUser')){
		 		$table = (isset($_SESSION['passerUser'])?$this->passerTable:$this->seekerTable);
		 		$userUnique = (isset($_SESSION['passerUser'])?$this->passerUnique:$this->seekerUnique);
		 		$sessionActive = (isset($_SESSION['passerUser'])?$_SESSION['passerUser']:$_SESSION['seekerUser']);
		 		$details = $this->model->selectAllFromUser($table,$userUnique,array($sessionActive));
			}
		 	$passerList = $this->model->selectAllFromUser($this->passerTable,"PasserStatus",array(1));
		 	if(!empty($passerList)){
		 		foreach ($passerList as $data) {
		 			$rating = (int)$this->model->rating($this->passerUnique,array($data['PasserID'],"Seeker",$data['PasserID'],"Seeker"));
		 			if(!empty($rating)){
						for ($i=0; $i < $rating ; $i++) { 
							$builderStar = '<i class="fas fa-star text-warning"></i>';
							$stars = $builderStar."".$stars;
						}
						for ($j=$i; $j < 5 ; $j++) { 
							$stars = $stars.'<i class="fas fa-star"></i>';
						}
						unset($i,$j);
					}
					else{
						$stars = '<i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i>';
					}
		 			if($this->checkExistingWorkPasser($data[$this->passerUnique]) == false){
			 			$builder = '
							<div class="col-md-6">
          						<div class="card shadow animated1 flipInX" style="height:95%">
          							<div class="card-body">
          								<div class="row">
          									<div class="col-md-5 text-center hoverable">
          										<a title="Jodel Adan">
          											<img src="'.$this->sanitize($data["PasserProfile"]).'" class="rounded-circle border border-primary wow fadeInUp" width="150" height="150">
          											<br>
          											<a class="badge badge-success mt-3 font-weight-bold text-white">
          												<i class="fas fa-check"></i> Verified Passer 
          											</a>
          									</div>
          									<div class="col-md-7 text-center" style="font-family: Georgia, Times, Times New Roman, serif;">
          										<a href="">
          											<p class="text-info" style="font-size:30px">
          											'.$this->sanitize($data["PasserFN"])." ".$this->sanitize($data["PasserMname"]).". ". $this->decodeISO($this->sanitize($data["PasserLN"])).'
          											</p>
          										</a>
      											<label class="trebuchet" style="font-family: Trebuchet MS, Lucida Grande, Lucida Sans Unicode, Lucida Sans, Tahoma, sans-serif;line-height: 26.4px;font-size: 18px">
      												'. $this->decodeISO($this->sanitize($data["PasserCertificate"])) .'
      											</label>
      											<div class="container">
	      											'.$stars.'
												</div>
          									</div>
          								</div>
          								<div class="row">
          									<div class="col-md-12 text-center mt-3 text-primary">
          										<p style="font-size: 15px; color: blue">Education, Trainings & Organizations</p>
          										<p class="text-dark" style="font-size: 15px;">'.$this->sanitize($data["PasserCertificateType"]).'</p>
          									</div>
          								</div>
          							</div>
          							<div class=" card-footer  text-center" style="height:90px">
          								<a href="../passer/profile?user='.$this->sanitize($data["PasserCOCNo"]).'" class="btn-change1 btn btn-lg text-white" style="background:#0062cc">View profile</a>
          							</div>
          						</div>
          					</div>';
			 			$dom = $dom."".$builder;
			 		}
			 		$rating = $stars = null;
		 		}
		 	}
			$data[] = array("userDetails"=>$details,"passerListAll"=>$dom);
			$this->controller->view("all/search",$data);
		}

		public function subscription(){
			$table = $userUnique = $sessionActive = null;
			$data = [];
			if($this->checkSession('passerUser') || $this->checkSession('seekerUser')){
		 		$table = (isset($_SESSION['passerUser'])?$this->passerTable:$this->seekerTable);
		 		$userUnique = (isset($_SESSION['passerUser'])?$this->passerUnique:$this->seekerUnique);
		 		$sessionActive = (isset($_SESSION['passerUser'])?$_SESSION['passerUser']:$_SESSION['seekerUser']);
		 		$details = $this->model->selectAllFromUser($table,$userUnique,array($sessionActive));
			}
			$data[] = array("userDetails"=>$details);
		 	$this->controller->view("all/subscription",$data);
		}

		public function howitworks(){
		 	$this->controller->view("all/howitworks");
		}

		public function basic(){
			if(!$this->checkSession('seekerUser')){
		 		header("location:login");
		 	}
		 	$this->controller->view("all/subBasic");
		}

		public function silver(){
			if(!$this->checkSession('seekerUser')){
		 		header("location:login");
		 	}
		 	$this->controller->view("all/subSilver");
		}

		public function gold(){
			if(!$this->checkSession('seekerUser')){
		 		header("location:login");
		 	}
		 	$this->controller->view("all/subGold");
		}

		public function checkout(){
			if(!$this->checkSession('seekerUser')){
		 		header("location:login");
		 	}
			if(isset($_SESSION['paymentID'])){
				unset($_SESSION['paymentID']);
			}
			if(isset($_SESSION['forwardLink'])){
				unset($_SESSION['forwardLink']);
			}
		 	$valid = $this->model->checkExistSingle("subscriptiontype","SubscriptionName",array($this->sanitize(strtolower($_POST['checkout']))));
		 	if(!isset($_POST['checkout']) || $valid <= 0){
		 		header("location: subscription");
		 	}
		 	$link = "search";
		 	if(isset($_GET['forwardTo'])){
		 		$_SESSION['forwardLink'] = $this->sanitize($_GET['forwardTo']);
		 	}
		 	$price = null;
		 	$priceAlone = null;
		 	$queryOption = $this->model->selectAllFromUser("subscriptiontype","SubscriptionName",array(strtolower($this->sanitize($_POST['checkout']))));
		 	extract($queryOption[0]);
		 	$_SESSION['paymentID'] = $SubscriptionTypeID;
		 	$option = ucfirst($SubscriptionName);
		 	$price = "&#8369;".$SubscriptionPrice." per ".$SubscriptionValidity;
		 	$data = [];
		 	$data[] = array("option"=>$option,"price"=>$price,"priceAlone"=>"&#8369;".$SubscriptionPrice);
		 	$this->controller->view("all/subCheckout",$data);
		}

		public function subscribe(){
			if(!$this->checkSession('seekerUser') || !isset($_SESSION['paymentID'])){
		 		header("location:subscription");
		 	}
		 	$validity = $this->model->selectSingleUser("subscriptiontype","SubscriptionValidity",array($_SESSION['paymentID']),"SubscriptionTypeID");
		 	$dateNow = date("Y-m-d");
		 	$subEnd = date("Y-m-d", strtotime("+1 ".$validity, strtotime($dateNow)));
		 	$forwardLink = (isset($_SESSION['forwardLink'])?$_SESSION['forwardLink']:"search");
		 	unset($_SESSION['forwardLink']);
		 	$insert = $this->model->insertDB("subscription",$this->subscriptionTable,array($_SESSION['paymentID'],$_SESSION['seekerUser'],$dateNow,$subEnd,"paypal"));
		 	if($insert){
		 		$this->createNotification("subscription",array("sendTo"=>"SeekerID","id"=>$_SESSION['seekerUser'],"message"=>1));
		 		unset($_SESSION['paymentID']);
		 		$this->toOtherPage($forwardLink);
		 	}
		}

		public function accountsettings(){
			$dashboard = $user = null;
			$data = [];
			if(!$this->checkSession('seekerUser') && !$this->checkSession('passerUser')){
		 		header("location:login");
		 	}elseif($this->checkSession('seekerUser')){
		 		$dashboard = "../seeker/dashboard";
		 		$details = $this->model->selectAllFromUser($this->seekerTable,$this->seekerUnique,array($_SESSION['seekerUser']));
		 	}elseif($this->checkSession('passerUser')){
		 		$dashboard = "../passer/dashboard";
		 		$details = $this->model->selectAllFromUser($this->passerTable,$this->passerUnique,array($_SESSION['passerUser']));
		 	}
		 	$data[] = array("dashboard"=>$dashboard,"userDetails"=>$details);
			$this->controller->view("all/accountSettings",$data);
		}

		public function messages(){
			$details = $user = $receiver = $otherUser = $otherUserID = $id = $cocNo = $subscription = $checkValidChat = $dashboard = $messageForm = $noMessagePrompt = $MessageID = $jobForm = $defaultJobOffer = null;
			$messageForm = 
			'
				<form id="messageSend">
                  <div class="input_msg_write">
                    <input class="form-control write_msg h-100" rows="2" cols="50" placeholder="Type a message..." style="font-size:16px;">
                    <button type="submit" class="msg_send_btn" type="button"><i class="fas fa-paper-plane" aria-hidden="true"></i></button>
                  </div>
                </form>
			';
			$data = [];

			if($this->checkSession('agreementPasser')){
				unset($_SESSION['agreementPasser']);
			}

			if(!$this->checkSession('seekerUser') && !$this->checkSession('passerUser')){
		 		header("location:login");
		 	}elseif($this->checkSession('seekerUser')){
		 		$dashboard = "../seeker/dashboard";
		 		$details = $this->model->selectAllFromUser($this->seekerTable,$this->seekerUnique,array($_SESSION['seekerUser']));
		 		$user = $this->seekerUnique;
		 		$id = $_SESSION['seekerUser'];
		 		$otherUserID = $this->passerUnique;
		 		if(!empty($_GET['t'])){
			 		if($this->getDetailsPasser($this->sanitize($_GET['t']))[0]['PasserStatus'] == 1){
				 		if($this->getDetailsSeeker($_SESSION['seekerUser'])[0]['SeekerStatus'] == 1){
					 		$subscription = $this->model->checkAuthenticity($this->subscriptionDB,$user,"SubscriptionStatus",array($id,"ongoing"));
					 		if($subscription <= 0){
					 			$messageForm = 
					 			'
					 			<div class="alert alert-danger" role="alert">
								  You don\'t have ongoing subscription. Please <a href="subscription">subscribe</a> first to Continue.
								</div>
					 			';


					 		}
					 		if(!empty($_GET['t']) && $subscription > 0){
					 			if($this->checkExistingWorkPasser($_GET['t']) == false){
							 		$jobForm = 
							 		'
							 		 <div class="srch_bar">
							            <div class="stylish-input-group">
							              <button class="text-white btn btn-info font-weight-bold" data-toggle="modal" data-target="#offer" style="height:30px;font-size:14px">
							              	Send a Job Offer form <i class="fas fa-file"></i>
							              </button>
							            </div>
							          </div>
							 		';
						 		}else{
						 			$jobForm = 'Currently, this passer has been hired';
						 		}
					 		}
				 		}else{
				 			$messageForm = 
					 			'
					 			<div class="alert alert-danger" role="alert">
								  You are currently not verified. Please <a href="../seeker/dashboard">verify your account</a> first to Continue.
								</div>
					 			';
				 		}
			 		}else{
			 			$messageForm = 
				 			'
				 			<div class="alert alert-danger" role="alert">
							  This passer is not yet verified or reported and has been disabled for your safety.
							</div>
				 			';
				 	}
				}
		 	}elseif($this->checkSession('passerUser')){
		 		$dashboard = "../passer/dashboard";
		 		$details = $this->model->selectAllFromUser($this->passerTable,$this->passerUnique,array($_SESSION['passerUser']));
		 		$user = $this->passerUnique;
		 		$id = $_SESSION['passerUser'];
		 		$otherUserID = $this->seekerUnique;
		 		if(!empty($_GET['t'])){
		 			if($this->getDetailsSeeker($this->sanitize($_GET['t']))[0]['SeekerStatus'] == 1){
		 				if($this->getDetailsPasser($_SESSION['passerUser'])[0]['PasserStatus'] == 1){
				 			$subscription = $this->model->checkAuthenticity($this->subscriptionDB,$this->seekerUnique,"SubscriptionStatus",array($this->sanitize($_GET['t']),"ongoing"));
					 		if($subscription <= 0){
					 			$messageForm = 
					 			'
					 			<div class="alert alert-danger" role="alert">
								  This seeker has no active Subscription. So he cannot send a message to you right now.
								</div>
					 			';
					 		}
				 		}
				 		else{
				 			$messageForm = 
				 			'
				 			<div class="alert alert-danger" role="alert">
							  You are currently not verified. Please <a href="../passer/dashboard">verify your account</a> first to Continue.
							</div>
				 			';
				 		}
			 		}
			 		else{
		 				$messageForm = 
				 			'
				 			<div class="alert alert-danger" role="alert">
							  This seeker is not yet verified or reported and has been disabled for your safety.
							</div>
				 			';
		 			}
		 		}
		 	}
		 	if(empty($_GET['t'])){	
		 		$otherUser = $this->model->selectSort(array("*"),$this->messageTable,$user,array($id),"MessageID","DESC",1);
		 		if(!empty($otherUser)){
		 			$this->toOtherPage("messages?t=".$otherUser[0][$otherUserID]);
		 		}else{
		 			$noMessagePrompt = 
		 			'
		 			<div class="container text-center"><p class="h4">No message</p></div>
		 			';

		 			$messageForm = 
			 			'
			 			<div class="container" role="alert">
						</div>
			 			';
		 		}
		 		
		 	}else{
		 		$MessageID = $this->model->selectTwoCondition(array("*"),$this->messageTable,$user,$otherUserID,array($id,$this->sanitize($_GET['t'])));
		 		foreach ($MessageID as $dataID) {
		 			$this->model->updateDB($this->messageTable,array("MessageStatus"),array(0),"MessageID",$dataID['MessageID']);
		 		}
		 		$checkValidChat = $this->model->checkAuthenticity($this->messageTable,$user,$otherUserID,array($id,$this->sanitize($_GET['t'])));
		 		if($checkValidChat <= 0){
		 			$otherUser = $this->model->selectSort(array("*"),$this->messageTable,$user,array($id),"MessageID","DESC",1);
		 			$this->toOtherPage("messages?t=".$otherUser[0][$otherUserID]);
		 		}
		 		$_SESSION['agreementPasser'] = $this->sanitize($_GET['t']);
		 	}
		 	extract($details[0]);
		 	$data[] = array("userDetails"=>$details,"dashboard"=>$dashboard,"messageForm"=>$messageForm,"noMessage"=>$noMessagePrompt,"jobForm"=>$jobForm,"jobOfferDefault"=>$defaultJobOffer);
			$this->controller->view("all/chat",$data);
		}

		public function agreement(){
			$passerDetails = $details = $error = $passerDetails = $seekerDetails = null;
			$data = [];
			if(!$this->checkSession('seekerUser') || !$this->checkSession('agreementPasser')){
				header("location: login");			
			}
			if($this->seekerIsSubscribed()){
				$passerDetails = $this->getDetailsPasser($_SESSION['agreementPasser']);
				if($passerDetails[0]['PasserStatus']  == 1){
					$seekerDetails = $this->getDetailsSeeker($_SESSION['seekerUser']);
					if($seekerDetails[0]['SeekerStatus'] != 1){
						$error = 'Sorry, you can\'t hire anyone at the moment. Please submit needed forms <a href="../seeker/dashboard"> Here</a>.';
					}
				}
				else{
					$error = 'Sorry, Your choosen passer cannot be hired for the moment because he/she is not validated by passersmate. You still can choose other passer <a href="search">here</a>';
				}
			}else{
				$error = 'Sorry, you have no active subscription. Please subscribe <a href="subscription">here.</a>';
			}
			$passerDetails = $this->getDetailsPasser($_SESSION['agreementPasser'])[0];
			$details = $this->getDetailsSeeker($_SESSION['seekerUser'])[0];
			$data[] = array("userDetails"=>$details,"passerDetails"=>$passerDetails,"error"=>$error);
			$this->controller->view("all/agreement",$data);
		}

		public function reviews(){
			$allUsers = $page = $builder = $dom = $punctuality = $WorkQualityRate = $PersonalityRate = $pLabel = $wLabel = $perLabel = null;
			if(!$this->checkSession('seekerUser') && !$this->checkSession('passerUser')){
		 		header("location:login");
		 	}
		 	if(!isset($_GET['page']) || $_GET['page'] <=0 || !is_numeric($_GET['page'])){
				$page = 1;
			}else{
				$page = $this->sanitize($_GET['page']);
			}
		 	if($this->checkSession('seekerUser')){
		 		$dashboard = "../seeker/dashboard";
		 		$details = $this->model->selectAllFromUser($this->seekerTable,$this->seekerUnique,array($_SESSION['seekerUser']));
		 		$allUsers = $this->paginationReviews("SeekerID",array($_SESSION['seekerUser'],"Passer"),$page,1,4,"RatingsID","DESC","");
		 		$allUsers = json_decode($allUsers,true);
		 		foreach ($allUsers['data'] as $d) {
		 			switch ($d['PunctualityRate']) {
		 				case 1:
		 					$pLabel = '<span class="badge badge-danger font-weight-bold"><small>Bad</small></span>';
		 				break;
		 				case 2:
		 					$pLabel = '<span class="badge badge-warning font-weight-bold"><small>Fair</small></span>';
		 				break;
		 				case 3:
		 					$pLabel = '<span class="badge badge-primary font-weight-bold"><small>Good</small></span>';
		 				break;
		 				case 4:
		 					$pLabel = '<span class="badge badge-info font-weight-bold"><small>Very Good</small></span>';
		 				break;
		 				case 5:
		 					$pLabel = '<span class="badge badge-success font-weight-bold"><small>Excellent</small></span>';
		 				break;
		 				
		 			}
		 			switch ($d['WorkQualityRate']) {
		 				case 1:
		 					$wLabel = '<span class="badge badge-danger font-weight-bold"><small>Bad</small></span>';
		 				break;
		 				case 2:
		 					$wLabel = '<span class="badge badge-warning font-weight-bold"><small>Fair</small></span>';
		 				break;
		 				case 3:
		 					$wLabel = '<span class="badge badge-primary font-weight-bold"><small>Good</small></span>';
		 				break;
		 				case 4:
		 					$wLabel = '<span class="badge badge-info font-weight-bold"><small>Very Good</small></span>';
		 				break;
		 				case 5:
		 					$wLabel = '<span class="badge badge-success font-weight-bold"><small>Excellent</small></span>';
		 				break;
		 				
		 			}
		 			switch ($d['PersonalityRate']) {
		 				case 1:
		 					$perLabel = '<span class="badge badge-danger font-weight-bold"><small>Bad</small></span>';
		 				break;
		 				case 2:
		 					$perLabel = '<span class="badge badge-warning font-weight-bold"><small>Fair</small></span>';
		 				break;
		 				case 3:
		 					$perLabel = '<span class="badge badge-primary font-weight-bold"><small>Good</small></span>';
		 				break;
		 				case 4:
		 					$perLabel = '<span class="badge badge-info font-weight-bold"><small>Very Good</small></span>';
		 				break;
		 				case 5:
		 					$perLabel = '<span class="badge badge-success font-weight-bold"><small>Excellent</small></span>';
		 				break;
		 				
		 			}
		 			$punctuality = $this->createStar($d['PunctualityRate']);
		 			$WorkQualityRate = $this->createStar($d['WorkQualityRate']);
		 			$PersonalityRate = $this->createStar($d['PersonalityRate']);

		 			$builder = 
			 		'
			 			<div class="col-md-5 mx-auto mt-2 mb-3">
	                		<div class="card shadow" style="height:380px">
	                			<div class="card-header">
		                			<small class="text-info font-weight-bold">Rated on: August 01, 2018</small>
		                			</div>
		                			<div class="card-body">
	                				<div class="row">
		                				<div class="col-md-3" >
		                				<img src="'.$d['PasserProfile'].'" class="border border-info rounded-circle" width="100px" height="100px" >

		                				</div>
	                				<div class="col-md-9 mt-4">
	                					<h4><a href="" class="text-dark">'.$d['PasserFN']." ".$d['PasserLN'].'</a></h4>
	                					<b class="mr-3">Personality: </b>
	                					'.$PersonalityRate.'
										'.$perLabel.'
										<br>
										<div class="mt-1"></div>
										<b class="mr-3">Punctuality: </b>
	                					'.$punctuality.'
										'.$pLabel.'
										<br>
										<div class="mt-1"></div>
										<b class="mr-1">Work Quality: </b>
	                					'.$WorkQualityRate.'
	                					'.$wLabel.'
										<br><br>
										<div class="form-group">
											<label><b>Feedbacks</b></label>
											<textarea class="form-control" rows="3" disabled="">'.$d['Feedback'].'</textarea>
										</div>
	                				</div>
                				</div>
                			</div>
                		</div>
                	</div>
			 		';
			 		$dom = $dom." ".$builder;
		 		}
			}elseif($this->checkSession('passerUser')){
		 		$dashboard = "../passer/dashboard";
		 		$details = $this->model->selectAllFromUser($this->passerTable,$this->passerUnique,array($_SESSION['passerUser']));
		 		$allUsers = $this->paginationReviews("PasserID",array($_SESSION['passerUser'],"Seeker"),$page,1,4,"RatingsID","DESC","");
		 		$allUsers = json_decode($allUsers,true);
		 		foreach ($allUsers['data'] as $d) {
		 			switch ($d['PunctualityRate']) {
		 				case 1:
		 					$pLabel = '<span class="badge badge-danger font-weight-bold"><small>Bad</small></span>';
		 				break;
		 				case 2:
		 					$pLabel = '<span class="badge badge-warning font-weight-bold"><small>Fair</small></span>';
		 				break;
		 				case 3:
		 					$pLabel = '<span class="badge badge-primary font-weight-bold"><small>Good</small></span>';
		 				break;
		 				case 4:
		 					$pLabel = '<span class="badge badge-info font-weight-bold"><small>Very Good</small></span>';
		 				break;
		 				case 5:
		 					$pLabel = '<span class="badge badge-success font-weight-bold"><small>Excellent</small></span>';
		 				break;
		 				
		 			}
		 			switch ($d['WorkQualityRate']) {
		 				case 1:
		 					$wLabel = '<span class="badge badge-danger font-weight-bold"><small>Bad</small></span>';
		 				break;
		 				case 2:
		 					$wLabel = '<span class="badge badge-warning font-weight-bold"><small>Fair</small></span>';
		 				break;
		 				case 3:
		 					$wLabel = '<span class="badge badge-primary font-weight-bold"><small>Good</small></span>';
		 				break;
		 				case 4:
		 					$wLabel = '<span class="badge badge-info font-weight-bold"><small>Very Good</small></span>';
		 				break;
		 				case 5:
		 					$wLabel = '<span class="badge badge-success font-weight-bold"><small>Excellent</small></span>';
		 				break;
		 				
		 			}
		 			switch ($d['PersonalityRate']) {
		 				case 1:
		 					$perLabel = '<span class="badge badge-danger font-weight-bold"><small>Bad</small></span>';
		 				break;
		 				case 2:
		 					$perLabel = '<span class="badge badge-warning font-weight-bold"><small>Fair</small></span>';
		 				break;
		 				case 3:
		 					$perLabel = '<span class="badge badge-primary font-weight-bold"><small>Good</small></span>';
		 				break;
		 				case 4:
		 					$perLabel = '<span class="badge badge-info font-weight-bold"><small>Very Good</small></span>';
		 				break;
		 				case 5:
		 					$perLabel = '<span class="badge badge-success font-weight-bold"><small>Excellent</small></span>';
		 				break;
		 				
		 			}
		 			$punctuality = $this->createStar($d['PunctualityRate']);
		 			$WorkQualityRate = $this->createStar($d['WorkQualityRate']);
		 			$PersonalityRate = $this->createStar($d['PersonalityRate']);

		 			$builder = 
			 		'
			 			<div class="col-md-5 mx-auto mt-2 mb-3">
	                		<div class="card shadow" style="height:380px">
	                			<div class="card-header">
		                			<small class="text-info font-weight-bold">Rated on: '.date("F jS, Y",strtotime($d['ReviewdOn'])).'</small>
		                			</div>
		                			<div class="card-body">
	                				<div class="row">
		                				<div class="col-md-3" >
		                					<img src="'.$d['SeekerProfile'].'" class="border border-info rounded-circle" width="100px" height="100px" >

		                				</div>
	                				<div class="col-md-9 mt-4">
	                					<h4><a href="" class="text-dark">'.$d['SeekerFN']." ".$d['SeekerLN'].'</a></h4>
	                					<b class="mr-3">Personality: </b>
	                					'.$PersonalityRate.'
										'.$perLabel.'
										<br>
										<div class="mt-1"></div>
										<b class="mr-3">Punctuality: </b>
	                					'.$punctuality.'
										'.$pLabel.'
										<br>
										<div class="mt-1"></div>
										<b class="mr-1">Work Quality: </b>
	                					'.$WorkQualityRate.'
	                					'.$wLabel.'
										<br><br>
										<div class="form-group">
											<label><b>Feedbacks</b></label>
											<textarea class="form-control" rows="3" disabled="">'.$d['Feedback'].'</textarea>
										</div>
	                				</div>
                				</div>
                			</div>
                		</div>
                	</div>
			 		';
			 		$dom = $dom." ".$builder;
		 		}
		 	}
		 	
		 	extract($details[0]);
			$data[] = array("userDetails"=>$details,"dom"=>$dom,"pagination"=>$allUsers['pagination'],"total"=>"Total of ".$allUsers['total']." reviews");
			$this->controller->view("all/reviews",$data);
		}


		public function transactionhistory(){
			$details = $userData = $formUsed = $builder = $dom = $badge = $message = $jobStart = $unique = $user = $table = null;
			$data = [];
			if(!$this->checkSession('seekerUser') && !$this->checkSession('passerUser')){
		 		header("location:login");
		 	}
		 	$table = (isset($_SESSION['passerUser'])?"passer":"seeker");
			$unique = (isset($_SESSION['passerUser'])?$this->passerUnique:$this->seekerUnique);
			$user = (isset($_SESSION['passerUser'])?$_SESSION['passerUser']:$_SESSION['seekerUser']);

			$userData = $this->model->joinOfferJobFormUsed($unique,array($user));
			foreach ($userData as $d) {
				if($d['OfferJobStatus'] != 2){
					$jobStart = $d['TransactionDateTime'];
					if(isset($_SESSION['seekerUser'])){
						switch ($d['NewStatus']) {
							case '1':
								$message = "Waiting for passer response";
								$badge = "success";
								break;

							case '3':
								$message = "Accepted Job Offer";
								$badge = "info";
								break;

							case '4':
								$message = "Declined Job Offer";
								$badge = "danger";
								break;

							case '5':
								$message = "Hired";
								$badge = "success";
								break;

							case '6':
								$message = "Pending for Cancellation";
								$badge = "warning";
								break;

							case '7':
								$message = "Cancelled";
								$badge = "danger";
								break;

							case '8':
								$message = "Dispute";
								$badge = "danger";
								break;
							
							case '9':
								$message = "Job is Done";
								$badge = "success";
								break;

							case '10':
								$message = "Dispute is Settled";
								$badge = "success";
								break;
						}
					}
					else{
						switch ($d['NewStatus']) {
							case '1':
								$message = "Waiting for your response";
								$badge = "success";
								break;

							case '3':
								$message = "You accepted the Job Offer";
								$badge = "info";
								break;

							case '4':
								$message = "You declined Job Offer";
								$badge = "danger";
								break;

							case '5':
								$message = "You were Hired";
								$badge = "success";
								break;

							case '6':
								$message = "Pending for Cancellation";
								$badge = "warning";
								break;

							case '7':
								$message = "Cancelled";
								$badge = "danger";
								break;

							case '8':
								$message = "Dispute";
								$badge = "danger";
								break;
							
							case '9':
								$message = "Your Job is Done";
								$badge = "success";
								break;
						}
					}
					if($d['OfferJobStatus'] >= 5){
						$formUsed = $this->model->selectAllFromUser("offerjobformused","OfferJobID",array($d['OfferJobID']))[0];
						$builder = 
						'
							<tr>
								<td>
									<h6>
										<span class="badge badge-'.$badge.'">'.$message.'</span>
									</h6>
									<small class="font-weight-bold">'.date("F jS, Y",strtotime($jobStart)).' | '.date("g:i A",strtotime($jobStart)).'</small>
								</td>
								<td>
									<button class="btn btn-primary" data-toggle="modal" name="viewDetailsWork" id='.$d['OfferJobID'].' data-target="#update">View Details</button>
								</td>
							</tr>
						';
					}
					else{
						$builder = 
						'
							<tr>
								<td>
									<h6>
										<span class="badge badge-'.$badge.'">'.$message.'</span>
									</h6>
									<small class="font-weight-bold"'.date("F jS, Y",strtotime($jobStart)).' | '.date("g:i A",strtotime($jobStart)).'</small>
								</td>
								<td>
									<button class="btn btn-primary" data-toggle="modal" name="viewDetailsWork" id='.$d['OfferJobID'].' data-target="#update">View Details</button>
								</td>
							</tr>
						';
					}
					$dom .=$builder;
				}
			}

			$details = $this->model->selectAllFromUser($table,$unique,array($user));
			$data[] = array("userDetails"=>$details,"dom"=>$dom);
			$this->controller->view("all/transactions",$data);
		}

	}

?>