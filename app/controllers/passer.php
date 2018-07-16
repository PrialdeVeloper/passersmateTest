<?php 
	class passer extends Controller{

		public $passerReg = array("PasserCOCNo","PasserFN","PasserLN","PasserMname","PasserPass","PasserEmail","PasserCertificate","PasserCertificateTyPe","PasserTESDALink");
		public $passDashboardPersonalDetails = array("PasserAddress","PasserStreet","PasserCity","PasserGender","PasserCPNo","PasserBirthdate");
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
		 		header("location:register");
		 	}
		 	$details = $this->model->selectAllFromUser($this->passerTable,$this->passerUnique,array($this->passerSession));
		 	$data[] = array("userDetails"=>$details);
			$this->controller->view("passer/dashboard",$data);

			if(isset($_GET['passerUpdateData'])){
				$passerAddress = $this->sanitize($_GET['passerAddress']);
				$passerStreet = $this->sanitize($_GET['passerStreet']);
				$passerCity = $this->sanitize($_GET['passerCity']);
				$passerGender = $this->sanitize($_GET['passerGender']);
				$passerCPNo = $this->sanitize($_GET['PasserCPNo']);
				$passerBirthdate = $this->sanitize($_GET['passerBirthdate']);
				$res = $this->model->updateDB($this->passerTable,$this->passDashboardPersonalDetails,array($passerAddress,$passerStreet,$passerCity,$passerGender,$passerCPNo,$passerBirthdate),$this->passerUnique,$this->passerSession);
				if($res){
					header("Refresh:1");
				}
			}
		}

		public function register(){
		 	if($this->checkSession('passerUser')){
		 		header("location:index");
		 	}
			$this->controller->view("passer/register");
		}
		
	}



?>

