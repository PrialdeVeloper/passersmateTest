<?php 
	class seeker extends Controller{
		public function __construct(){
			$this->controller = new Controller();
			$this->model = $this->controller->model("dbModel");
			$this->data = [];
		}

		public function index(){
			$this->controller->view("seeker/dashboard");
		}

		public function profile(){
			$this->controller->view("seeker/profile");
		}
	}
?>