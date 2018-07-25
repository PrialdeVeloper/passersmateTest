<?php 
	class admin extends Controller{

		public $adminReg = array("username","email","password");
		protected $adminTable = "admin";
		protected $adminUnique = "AdminID";
		protected $adminSession;

		public function __construct(){
			$this->controller = new Controller();
			$this->model = $this->controller->model("dbModel");
			$this->data = [];
			if($this->checkSession('adminUser')){
		 		$this->adminSession = $_SESSION['adminUser'];
		 	}
		}

		public function __destruct(){
			$this->model = null;
			$this->controller = null;
			$this->data = array();
		}

		public function index(){
			if(!$this->checkSession('adminUser')){
				header("location:login");
			}
			$this->controller->view("admin/index");	
		}

		public function login(){
			if($this->checkSession('adminUser')){
				header("location:index");
			}
			$this->controller->view("admin/authentication-login");
		}

		public function register(){
			if($this->checkSession('adminUser')){
				header("location:index");
			}
			$this->controller->view("admin/authentication-register");
		}

		public function confirmation(){
			if(!$this->checkSession('adminUser')){
				header("location:index");
			}
			$data = [];
			$dom = 
			$data[] = array("passerUnverified"=>$this->createPasserUnverified());
			$this->controller->view("admin/confirmation",$data);
		}
	}

?>