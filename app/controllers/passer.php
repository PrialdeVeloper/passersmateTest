<?php 
	class passer extends Controller{
		
		public function __construct(){
			$this->controller = new Controller();
			$this->model = $this->controller->model("dbModel");
			$this->data = [];
		}

		public function index(){
			$this->controller->view("passer/dashboard");
		}

		public function register(){
			$this->controller->view("passer/register");
		}
	}

?>