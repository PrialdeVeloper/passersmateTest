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
				$passer = $builder = $dom = $unstructured = null;
				if(!empty($_POST['data'])){
					$unstructured = $_POST['data'];
					foreach ($unstructured as $data) {
						$builder = '
	 					<div class="col-sm-6">
							<div class="container shadowDiv">
								<div class="row">
									<div class="col-md-4">
										<div class="container my-3 pl-3 d-flex justify-content-center">
											<img src="'.$this->sanitize($data["PasserProfile"]).'" class="profile">
										</div>
									</div>		
									<div class="col-md-7 mt-4">
										<div class="container text-center text-primary">
											<label class="georgiaFonts">'.$this->sanitize($data["PasserFN"])." ".$this->sanitize($data["PasserMname"]).". ". $this->decodeISO($this->sanitize($data["PasserLN"])).'</label>
										</div>
										<div class="container text-center text-secondary">
											<label class="trebuchet">'. $this->decodeISO($this->sanitize($data["PasserCertificate"])) .'</label>
										</div>
										<div class="container text-center">
											<span class="fa fa-star text-warning"></span>
											<span class="fa fa-star text-warning"></span>
											<span class="fa fa-star text-warning"></span>
											<span class="fa fa-star text-warning"></span>
											<span class="fa fa-star text-warning"></span>
										</div>
									</div>	
								</div>
								<div class="col-md my-3">
									<div class="container text-center text-primary">Education, Trainings & Organizations</div>
									<div class="container text-center text-secondary">'.$this->sanitize($data["PasserCertificateType"]).'</div>
								</div>
								<div class="col-md">
									<hr>
								</div>
								<div class="col-md d-flex justify-content-center">
									<a href="../passer/profile?user='.$this->sanitize($data["PasserCOCNo"]).'" class="btn btn-lg btn-primary mb-3">View Profile</a>
								</div>
							</div>
						</div>
			 			';
			 			echo $dom = $dom."".$builder;
					}
				}else{
					echo $dom = "no data found";
				}
			}
		}

		public function search(){
			if(!$this->checkSession('seekerUser')){
		 		header("location:login");
		 	}
		 	$dom = null;
		 	$builder;
		 	$data = [];
		 	$details = $this->model->selectAllFromUser($this->seekerTable,$this->seekerUnique,array($_SESSION['seekerUser']));
		 	$passerList = $this->model->selectAllFromUser($this->passerTable,"PasserStatus",array(1));
		 	if(!empty($passerList)){
		 		foreach ($passerList as $data) {
		 			$builder = '

 					<div class="col-sm-6">
						<div class="container shadowDiv">
							<div class="row">
								<div class="col-md-4">
									<div class="container my-3 pl-3 d-flex justify-content-center">
										<img src="'.$this->sanitize($data["PasserProfile"]).'" class="profile">
									</div>
								</div>		
								<div class="col-md-7 mt-4">
									<div class="container text-center text-primary">
										<label class="georgiaFonts">'.$this->sanitize($data["PasserFN"])." ".$this->sanitize($data["PasserMname"]).". ". $this->decodeISO($this->sanitize($data["PasserLN"])).'</label>
									</div>
									<div class="container text-center text-secondary">
										<label class="trebuchet">'. $this->decodeISO($this->sanitize($data["PasserCertificate"])) .'</label>
									</div>
									<div class="container text-center">
										<span class="fa fa-star text-warning"></span>
										<span class="fa fa-star text-warning"></span>
										<span class="fa fa-star text-warning"></span>
										<span class="fa fa-star text-warning"></span>
										<span class="fa fa-star text-warning"></span>
									</div>
								</div>	
							</div>
							<div class="col-md my-3">
								<div class="container text-center text-primary">Education, Trainings & Organizations</div>
								<div class="container text-center text-secondary">'.$this->sanitize($data["PasserCertificateType"]).'</div>
							</div>
							<div class="col-md">
								<hr>
							</div>
							<div class="col-md d-flex justify-content-center">
								<a href="../passer/profile?user='.$this->sanitize($data["PasserCOCNo"]).'" class="btn btn-lg btn-primary mb-3">View Profile</a>
							</div>
						</div>
					</div>

		 			';
		 			$dom = $dom."".$builder;
		 		}
		 	}
			$data[] = array("userDetails"=>$details,"passerListAll"=>$dom);
			$this->controller->view("all/search",$data);
		}

		public function subscription(){
		 	$this->controller->view("all/subscription");
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
			$details = $user = $receiver = $otherUser = $otherUserID = $id = $cocNo = $subscription = $checkValidChat = $dashboard = $messageForm = $noMessagePrompt = $MessageID = null;
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
			if(!$this->checkSession('seekerUser') && !$this->checkSession('passerUser')){
		 		header("location:login");
		 	}elseif($this->checkSession('seekerUser')){
		 		$dashboard = "../seeker/dashboard";
		 		$details = $this->model->selectAllFromUser($this->seekerTable,$this->seekerUnique,array($_SESSION['seekerUser']));
		 		$user = $this->seekerUnique;
		 		$id = $_SESSION['seekerUser'];
		 		$otherUserID = $this->passerUnique;
		 		$subscription = $this->model->checkAuthenticity($this->subscriptionDB,$user,"SubscriptionStatus",array($id,"ongoing"));
		 		if($subscription <= 0){
		 			$messageForm = 
		 			'
		 			<div class="alert alert-danger" role="alert">
					  You don\'t have ongoing subscription. Please <a href="subscription">subscribe</a> first to Continue.
					</div>
		 			';
		 		}
		 	}elseif($this->checkSession('passerUser')){
		 		$dashboard = "../passer/dashboard";
		 		$details = $this->model->selectAllFromUser($this->passerTable,$this->passerUnique,array($_SESSION['passerUser']));
		 		$user = $this->passerUnique;
		 		$id = $_SESSION['passerUser'];
		 		$otherUserID = $this->seekerUnique;
		 		if(!empty($_GET['t'])){
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
		 	}
		 	if(empty($_GET['t'])){
		 		$otherUser = $this->model->selectSort(array("*"),$this->messageTable,$user,array($id),"MessageID","DESC",1);
		 		if(!empty($otherUser)){
		 			$this->toOtherPage("messages?t=".$otherUser[0][$otherUserID]);
		 		}else{
		 			$noMessagePrompt = 
		 			'
		 			<div class="container text-center"><p class="display-4">No message</p></div>
		 			';
		 		}
		 		
		 	}else{
		 		$MessageID = $this->model->selectTwoCondition(array("*"),$this->messageTable,$user,$otherUserID,array($id,$this->sanitize($_GET['t'])));
		 		foreach ($MessageID as $dataID) {
		 			$this->model->updateDB($this->messageTable,array("MessageStatus"),array(0),"MessageID",$dataID['MessageID']);
		 		}
		 		print_r($MessageID);
		 		$checkValidChat = $this->model->checkAuthenticity($this->messageTable,$user,$otherUserID,array($id,$this->sanitize($_GET['t'])));
		 		if($checkValidChat <= 0){
		 			$otherUser = $this->model->selectSort(array("*"),$this->messageTable,$user,array($id),"MessageID","DESC",1);
		 			$this->toOtherPage("messages?t=".$otherUser[0][$otherUserID]);
		 		}
		 	}
		 	extract($details[0]);
		 	$data[] = array("userDetails"=>$details,"dashboard"=>$dashboard,"messageForm"=>$messageForm,"noMessage"=>$noMessagePrompt);
			$this->controller->view("all/chat",$data);
		}

	}

?>