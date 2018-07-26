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

			if(isset($_POST['adminSubmit'])){
				$username = !empty($_POST['adminUsername'])?$this->sanitize($_POST['adminUsername']):"";
				$password = !empty($_POST['adminPass'])?$this->sanitize($_POST['adminPass']):"";
				if(!empty($username) && !empty($password)){
					$returnPassword = $this->model->selectSingleUser("admin","password",array($username),"username");
					if(empty($returnPassword)){
						$this->showError("#adminLoginError","Login unsuccessful. Please check your username or password.");
					}else{
						if($this->verifyHash($password,$returnPassword)){
							$_SESSION['adminUser'] = $this->model->selectSingleUser("admin","AdminID",array($username),"username");
							$password = null;
							$returnPassword = null;
							$username = null;
							$this->toOtherPage("dashboard");
						}
						else{
							$this->showError("#adminLoginError","Login unsuccessful. Please check your username or password.");
						}
					}
				}
			}
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

		public function logout(){
			unset($_SESSION['adminUser']);
			header("location:login");			
		}
	}

?>