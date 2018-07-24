<?php 
	class seeker extends Controller{
		public $seekerTable = "seeker";
		public $seekerUnique = "SeekerID";
		public $seekerFacebook = "seekerFacebookId";
		public $seekDashboardPersonalDetails = array("SeekerAddress","SeekerStreet","SeekerCity","SeekerGender","SeekerCPNo","SeekerBirthdate");
		public $seekDashboardPersonalDetailsWithPhoto = array("SeekerAddress","SeekerStreet","SeekerCity","SeekerGender","SeekerCPNo","SeekerBirthdate","SeekerProfile");
		public $seekerValidate = array("SeekerID","frontID","backID","selfie","idType","idNumber","expirationDate");
		protected $seekerSession;
		public function __construct(){
			$this->controller = new Controller();
			$this->model = $this->controller->model("dbModel");
			$this->data = [];
			if($this->checkSession('seekerUser')){
		 		$this->seekerSession = $_SESSION['seekerUser'];
		 	}
		}

		public function index(){
			if(!$this->checkSession('seekerUser')){
		 		header("location:../home/login");
		 	}
			$data = [];
			$completeAddress = null;
			$detailsProper = null;
			$seekerStatus = null;
			$details = $this->model->selectAllFromUser($this->seekerTable,$this->seekerUnique,array($this->seekerSession));
			$detailsProper = $details[0];
			extract($detailsProper);
			if(!empty($SeekerAddress)){
				$completeAddress = $SeekerAddress;
			}
			if(!empty($SeekerStreet)){
				$completeAddress = $completeAddress." ".$SeekerStreet;
			}
			if(!empty($SeekerCity)){
				$completeAddress = $completeAddress.", ".$SeekerCity;
			}

			if($SeekerStatus == 0){
		 		$userStatus = '
		 		<div class="alert alert-danger col text-center" role="alert">
					<label>Your account is not yet verified, please complete the information needed Mate<button type="button" class="btn btn-link" data-toggle="modal" data-target="#verification">Click Here</button> to verify you account.</label>			
				</div>
		 		';
		 	}elseif($SeekerStatus == 2){
		 		$userStatus = '
		 		<div class="alert alert-primary col text-center" role="alert">
					<label>Thank you, Mate. Please wait until we validate your account. Until such time, you can browse through your dashboard and update details about yourself for future purposes.</label>
				</div>
		 		';
		 	}

			$data[] = array("userDetails"=>$details,"completeAddress"=>$completeAddress,"seekerStatus"=>$userStatus);
			$this->controller->view("seeker/dashboard",$data);
		}

		public function login(){
			$this->controller->view("seeker/login");
		}

		public function profile(){
			$this->controller->view("seeker/profile");
		}
	}
?>