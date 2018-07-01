<?php 
	class home extends Controller{

		public function __construct(){
			$this->controller = new Controller();
			$this->model = $this->controller->model("dbModel");
			$this->data = [];
		}

		public function __destruct(){
			$this->model = null;
			$this->controller = null;
			$this->data = array();
		}

		public function index(){
			$this->controller->view("all/signup",['qwe'=>'qwe']);
		}

		public function search(){
			$data = array("title"=>"Search");
			$this->controller->view("all/search",$data);
		}
	}

?>