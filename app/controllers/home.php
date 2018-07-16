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
			$this->controller->view("all/index",['qwe'=>'qwe']);
		}

		public function login(){
			if($this->checkSession('passerUser')){
				header("location:../passer/dashboard");
			}elseif($this->checkSession('seekerUser')){
				header("location:../seeker/dashboard");
			}
			$this->controller->view("all/login");

			if(isset($_POST['passerSubmit'])){
				$email = !empty($_POST['passerEmail'])?$this->sanitize($_POST['passerEmail']):"";
				$password = !empty($_POST['passerPass'])?$this->sanitize($_POST['passerPass']):"";
				if(!empty($email) && !empty($password)){
					$returnPassword = $this->model->selectSingleUser("passer","PasserPass",array($email),"PasserEmail");
						if(empty($returnPassword)){
							$this->showError("#passerLoginError","Login unsuccessful. Please check your email or password.");
						}else{
							if($this->verifyHash($password,$returnPassword)){
								$_SESSION['passerUser'] = $this->model->selectSingleUser("passer","PasserID",array($email),"PasserEmail");
								$password = null;
								$returnPassword = null;
								$email = null;
								$this->toOtherPage("../passer/dashboard");
							}
							else{
								$this->showError("#passerLoginError","Login unsuccessful. Please check your email or password.");
							}
						}
				}
			}elseif(isset($_POST['seekerSubmit'])){
				$email = !empty($_POST['passerEmail'])?$this->sanitize($_POST['passerEmail']):"";
				$password = !empty($_POST['passerPass'])?$this->sanitize($_POST['passerPass']):"";
				if(!empty($email) && !empty($password)){
					$returnPassword = $this->model->selectSingleUser("seeker","seekerPass",array($email),"SeekerEmail");
						if(empty($returnPassword)){
							$this->showError("#seekerLoginError","Login unsuccessful. Please check your email or password.");
						}else{
							if($this->verifyHash($password,$returnPassword)){
								$_SESSION['seekerUser'] = $this->model->selectSingleUser("seeker","seekerID",array($email),"SeekerEmail");
								$password = null;
								$returnPassword = null;
								$email = null;
								$this->toOtherPage("../seeker/dashboard");
							}
							else{
								$this->showError("#passerLoginError","Login unsuccessful. Please check your email or password.");
							}
						}
				}
			}
		}

		public function signup(){
			$this->controller->view("all/signup",['qwe'=>'qwe']);
		}

		public function search(){
			$data = array("title"=>"Search");
			$this->controller->view("all/search",$data);
		}
	}

?>