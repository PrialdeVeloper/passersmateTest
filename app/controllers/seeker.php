<?php 
	class seeker extends Controller{
		public $seekerTable = "seeker";
		public $seekerUnique = "SeekerID";
		public $seekerFacebook = "seekerFacebookId";
		public function __construct(){
			$this->controller = new Controller();
			$this->model = $this->controller->model("dbModel");
			$this->data = [];
		}

		public function index(){
			$this->controller->view("seeker/dashboard");
		}

		public function login(){
			$this->controller->view("seeker/login");
		}

		public function profile(){
			$this->controller->view("seeker/profile");
		}
	}
?>