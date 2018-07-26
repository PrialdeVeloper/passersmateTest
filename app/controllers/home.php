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
			$this->controller->view("all/index",['qwe'=>'qwe']);
		}

		public function login(){
			if($this->checkSession('passerUser')){
				header("location:../passer/dashboard");
			}elseif($this->checkSession('seekerUser')){
				header("location:../seeker/dashboard");
			}


			$data[] = array("redirectURLFacebook"=>$this->returnURLFacebook(),"redirectURLGmail"=>$this->returnURLGmail());
			$this->controller->view("all/login",$data);

			if(isset($_POST['passerSubmit'])){
				$email = !empty($_POST['passerEmail'])?$this->sanitize($_POST['passerEmail']):"";
				$password = !empty($_POST['passerPass'])?$this->sanitize($_POST['passerPass']):"";
				if(!empty($email) && !empty($password)){
					$returnPassword = $this->model->selectSingleUser("passer","PasserPass",array($email),"PasserEmail");
					if(empty($returnPassword)){
						$this->showError("#passerLoginError","Login unsuccessful. Please check your email or password.");
					}else{
						if($this->verifyHash($password,$returnPassword)){
							$_SESSION['passerUser'] = $this->model->selectSingleUser("passer","PasserID",array($email),"PasserEmail");
							$password = null;
							$returnPassword = null;
							$email = null;
							$this->toOtherPage("../passer/dashboard");
						}
						else{
							$this->showError("#passerLoginError","Login unsuccessful. Please check your email or password.");
						}
					}
				}
			}
			elseif(isset($_POST['seekerSubmit'])){
				$email = !empty($_POST['passerEmail'])?$this->sanitize($_POST['passerEmail']):"";
				$password = !empty($_POST['passerPass'])?$this->sanitize($_POST['passerPass']):"";
				if(!empty($email) && !empty($password)){
					$returnPassword = $this->model->selectSingleUser("seeker","seekerPass",array($email),"SeekerEmail");
					if(empty($returnPassword)){
						$this->showError("#seekerLoginError","Login unsuccessful. Please check your email or password.");
					}else{
						if($this->verifyHash($password,$returnPassword)){
							$_SESSION['seekerUser'] = $this->model->selectSingleUser("seeker","seekerID",array($email),"SeekerEmail");
							$password = null;
							$returnPassword = null;
							$email = null;
							$this->toOtherPage("../seeker/dashboard");
						}
						else{
							$this->showError("#passerLoginError","Login unsuccessful. Please check your email or password.");
						}
					}
				}
			}
		}

		public function signup(){
			$this->controller->view("all/signup",['qwe'=>'qwe']);
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
										<label class="georgiaFonts">'.$this->sanitize($data["PasserFN"])." ".$this->sanitize($data["PasserMname"]).". ". $this->sanitize($data["PasserLN"]).'</label>
									</div>
									<div class="container text-center text-secondary">
										<label class="trebuchet">'. $this->sanitize($data["PasserCertificate"]) .'</label>
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
	}

?>