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
			if(isset($_POST['email'])){
				$data[] = array("name"=>"syrel");
				echo json_encode($data);
			}
			else{
				echo "no";
			}
			$this->controller->view("passer/register");
			// echo json_encode($data);
		}

		public function qweqwe(){
			if(isset($_POST['email'])){
				$data = array("name"=>"syrel","address"=>"cebu");
				echo json_encode($data);
			}
		}
	}



?>

