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
				// $data = array("qwe"=>"qwe");
				foreach ($_POST as $key => $value) {
					$data["data"][$key] = $value;
				}
				echo json_encode($data);
			}
			$this->controller->view("passer/register");
			// echo json_encode($data);
		}

		public function qweqwe(){
			if(isset($_POST['email'])){
				// $data = array("qwe"=>"qwe");
				foreach ($_POST as $key => $value) {
					$data["data"][$key] = $value;
				}
				echo json_encode($data);
			}
		}

		
	}



?>

