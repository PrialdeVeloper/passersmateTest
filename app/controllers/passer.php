<?php 
	class passer extends Controller{

		public $passerReg = array("PasserCOCNo","PasserFN","PasserLN","PasserMname","PasserPass","PasserEmail","PasserCertificate","PasserCertificateTyPe","PasserTESDALink");
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
			$data = [];
			$detailsProper = null;
			$details = null;
			$userStatus = null;
			$completeAddress = null;
			if(!$this->checkSession('passerUser')){
		 		header("location:../home/login");
		 	}
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
		 	$coc = $this->sanitize($_GET['user']);
		 	$details = $this->model->selectAllFromUser($this->passerTable,"PasserCOCNo",array($coc));
		 	$data[] = array("userDetails"=>$details);
			$this->controller->view("passer/profile",$data);
		}
		
	}



?>

