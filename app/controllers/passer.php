<?php 
	class passer extends Controller{

		protected $passer = array('PasserSkillsID');
		protected $passerTable = 'passer';
		
		public function __construct(){
			$this->controller = new Controller();
			$this->model = $this->controller->model("dbModel");
			$this->data = [];
		}

		public function index(){
			$this->controller->view("passer/dashboard");
		}

		public function register(){
			if(isset($_SESSION['passerUser'])){
				// echo "<script>window.location='index';</script>";
			}
			$this->controller->view("passer/register");

			if(isset($_POST['registerPasser'])){
				echo "qweqe".$_POST['cocNumber'];
				echo "ye";
				$cocNumber = $this->sanitize($_POST['cocNumber']);
				$passerFirstname = $this->sanitize($_POST['passerFirstname']);
				$passerLastname = $this->sanitize($_POST['passerLastname']);
				$passerMiddlename = $this->sanitize($_POST['passerMiddlename']);
				$cocTitle = $this->sanitize($_POST['cocTitle']);
				$passerLink = $this->sanitize($_POST['passerLink']);
				$passerPassword = $this->sanitize($_POST['passerPassword']);
				$email = $this->sanitize($_POST['email']);
				$typeofCertificatePasser = $this->sanitize($_POST['typeofCertificatePasser']);
				$return = $this->model->insertDB('passer',array($cocNumber,$passerFirstname,$passerLastname,$passerPassword,$email),array("PasserCOCNo","PasserFN","PasserLN","PasserPass","PasserEmail"));
					if($return){
						$_SESSION['passerUser'] = $return;
					}
					else{
						die("cannot connect to server");
					}
			}
		}

		public function login(){
			$this->controller->view("passer/login");
		}
		
	}



?>

