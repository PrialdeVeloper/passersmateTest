<?php 
	class passer extends Controller{

		public $passerReg = array("PasserCOCNo","PasserFN","PasserLN","PasserMname","PasserPass","PasserEmail","PasserCertificate","PasserCertificateTyPe","PasserTESDALink","PasserCOCExpiryDate");
		public $passDashboardPersonalDetails = array("PasserAddress","PasserStreet","PasserCity","PasserGender","PasserCPNo","PasserBirthdate");
		public $passDashboardPersonalDetailsWithPhoto = array("PasserAddress","PasserStreet","PasserCity","PasserGender","PasserCPNo","PasserBirthdate","PasserProfile");
		public $passerWorkHistory = array("OfferJobID","PasserID","PasserJobTitle","PasserCompany","PasserWorkHistoryDesc","PasserWorkHistoryStartDate","PasserWorkHistoryEndDate","PasserWorkHistoryWorkDays");
		public $passerEducation = array("passerID","educationAttainment","educationSchool","educationAccomplishment");
		public $passerValidate = array("passerID","frontID","backID","selfie","COC","idType","idNumber","expirationDate");
		protected $passerTable = 'passer';
		protected $passerSession;
		protected $passerUnique = 'PasserID';
		
		public function __construct(){
			$this->controller = new Controller();
			$this->model = $this->controller->model("dbModel");
			$this->data = [];
			if($this->checkSession('passerUser')){
		 		$this->passerSession = $_SESSION['passerUser'];
		 	}
		}

		public function index(){
			if(!$this->checkSession('passerUser')){
		 		header("location:../home/login");
		 	}
		 	$data = [];
			$detailsProper = null;
			$details = null;
			$userStatus = null;
			$completeAddress = null;
		 	$details = $this->model->selectAllFromUser($this->passerTable,$this->passerUnique,array($this->passerSession));
		 	$detailsProper = $details[0];
		 	$workExperience = $this->model->selectAllFromUser("passerworkhistory",$this->passerUnique,array($this->passerSession));
		 	extract($detailsProper);
		 	if($PasserStatus == 0){
		 		$userStatus = '
		 		<div class="alert alert-danger col text-center" role="alert">
					<label>Your account is not yet verified, please complete the information needed Mate<button type="button" class="btn btn-link" data-toggle="modal" data-target="#verification">Click Here</button> to verify you account.</label>			
				</div>
		 		';
		 	}elseif($PasserStatus == 2){
		 		$userStatus = '
		 		<div class="alert alert-primary col text-center" role="alert">
					<label>Thank you, Mate. Please wait until we validate your account. Until such time, you can browse through your dashboard and update details about yourself for future purposes.</label>
				</div>
		 		';
		 	}elseif($PasserStatus == 1){
		 		$userStatus = '
		 		<div class="alert alert-success col text-center" role="alert">
					<label>Welcome back, Mate. You can now use the full functionality of the service.</label>
					<button type="button" class="close" data-dismiss="alert" aria-label="Close">
				    	<span aria-hidden="true">&times;</span>
				  	</button>
				</div>
		 		';
		 	}elseif($PasserStatus == 3){
		 		$userStatus = '
		 		<div class="alert alert-danger col text-center" role="alert">
					<label>Sorry but we found inconsistency on your passed documents, Mate. But dont\' worry, you can still <button type="button" class="btn btn-link" data-toggle="modal" data-target="#verification">Click Here</button> to verify you account.</label>			
				</div>
		 		';
		 	}
		 	if(!empty($PasserAddress)){
				$completeAddress = $PasserAddress;
			}
			if(!empty($PasserStreet)){
				$completeAddress = $completeAddress." ".$PasserStreet;
			}
			if(!empty($PasserCity)){
				$completeAddress = $completeAddress.", ".$PasserCity;
			}
		 	$data[] = array("userDetails"=>$details,"workExperience"=>$workExperience,"completeAddress"=>$completeAddress,"userStatus"=>$userStatus);
			$this->controller->view("passer/dashboard",$data);
		}

		public function register(){
		 	if($this->checkSession('passerUser')){
		 		header("location:index");
		 	}
			$this->controller->view("passer/register");
		}

		public function profile(){
			if(empty($_GET['user'])){
		 		header("location:../home/login");
		 	}
		 	$builder = null;
		 	$dom = null;
		 	$errorDiv = null;
		 	$seekerError = null;
		 	$coc = $this->sanitize($_GET['user']);
		 	$details = $this->model->selectAllFromUser($this->passerTable,"PasserCOCNo",array($coc));
		 	if(!empty($details)){
			 	extract($details[0]);
			 	if($PasserStatus !=1 ){
			 		$errorDiv = '
			 		<div class="alert alert-danger col text-center" role="alert">
						<label>Currently, this Passer has not yet been verified so he/she cannot be hired nor messaged.</label>			
					</div>

			 		';
			 	}

			 	if(isset($_SESSION['seekerUser'])){
		 			$seekerSession = $this->sanitize($_SESSION['seekerUser']);
		 			$seekerDetails = $this->model->selectAllFromUser($this->seekerTable,$this->seekerUnique,array($seekerSession));
		 			if(!empty($seekerDetails)){
		 				extract($seekerDetails[0]);
		 				if($SeekerStatus != 1){
		 					$seekerError = '
					 		<div class="alert alert-danger col text-center" role="alert">
								<label>Currently, You cannot hire nor message any Passer. Please verify your account first on <a href=../seeker/dashboard> Here</a>.</label>			
							</div>
					 		';
		 				}
		 			}
		 		}

			 	$workHistory = $this->model->selectDataFromOtherDB("passerworkhistory","passer","PasserID","PasserCOCNo",array($coc));
			 	if(!empty($workHistory)){
			 		foreach ($workHistory as $data) {
			 			$builder = '
			 				<div class="container text-center mt-5">
								<div class="col h3">
									'.$this->sanitize($data['PasserJobTitle']).'
								</div>
								<div class="row mt-3">
									<div class="col">
										<div class="col">
											Start Date
										</div>
										<div class="col mt-2">
											'.$this->sanitize(date("F jS, Y", strtotime($data['PasserWorkHistoryStartDate']))).'
										</div>
									</div>
									<div class="col">
										<div class="col">
											End Date
										</div>
										<div class="col mt-2">
											'.$this->sanitize(date("F jS, Y", strtotime($data['PasserWorkHistoryEndDate']))).'
										</div>
									</div>
								</div>
								<div class="container mt-3">
									<div class="col">Short Description</div>
									<div class="col text-center mt-2">
									'.$this->sanitize($data['PasserWorkHistoryDesc']).'
									</div>
								</div>
							</div>
			 			';
			 			$dom = $dom ." ".$builder;
			 		}
			 	}
			 	$data[] = array("userDetails"=>$details,"passerStatus"=>$errorDiv,"workHistory"=>$dom,"seekerError"=>$seekerError);
				$this->controller->view("passer/profile",$data);
			}
			else{
				header("location:../home/login");
			}
		}

		public function projects(){
			if(empty($_GET['user'])){
		 		header("location:../home/login");
		 	}
		 	$coc = $this->sanitize($_GET['user']);
		 	$details = $this->model->selectAllFromUser($this->passerTable,"PasserCOCNo",array($coc));
		 	$data[] = array("userDetails"=>$details);
			$this->controller->view("passer/projects",$data);
		}
		
	}



?>

