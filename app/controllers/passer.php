<?php 
	class passer extends Controller{

		public $passerReg = array("PasserCOCNo","PasserFN","PasserLN","PasserMname","PasserPass","PasserEmail","PasserCertificate","PasserCertificateTyPe","PasserTESDALink");
		public $passDashboardPersonalDetails = array("PasserAddress","PasserStreet","PasserCity","PasserGender","PasserCPNo","PasserBirthdate");
		public $passDashboardPersonalDetailsWithPhoto = array("PasserAddress","PasserStreet","PasserCity","PasserGender","PasserCPNo","PasserBirthdate","PasserProfile");
		public $passerWorkHistory = array("OfferJobID","PasserID","PasserWorkHistoryDesc","PasserWorkHistoryStartDate","PasserWorkHistoryEndDate","PasserWorkHistoryWorkDays");
		public $passerEducation = array("passerID","educationAttainment","educationSchool","educationAccomplishment");
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
			$details = null;
			if(!$this->checkSession('passerUser')){
		 		header("location:../home/login");
		 	}
		 	$details = $this->model->selectAllFromUser($this->passerTable,$this->passerUnique,array($this->passerSession));
		 	$data[] = array("userDetails"=>$details);
		 	// print_r(array_map($this->decodeISO,$details));
			$this->controller->view("passer/dashboard",$data);
		}

		public function register(){
		 	if($this->checkSession('passerUser')){
		 		header("location:index");
		 	}
			$this->controller->view("passer/register");
		}

		public function profile(){
			if(!$this->checkSession('passerUser')){
		 		header("location:register");
		 	}
		 	$details = $this->model->selectAllFromUser($this->passerTable,$this->passerUnique,array($this->passerSession));
		 	$data[] = array("userDetails"=>$details);
			$this->controller->view("passer/profile",$data);
		}
		
	}



?>

