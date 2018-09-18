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

		public function confirmPasser(){
			if(!$this->checkSession('adminUser')){
				header("location:index");
			}
			$data = [];
			$data[] = array("passerUnverified"=>$this->createPasserUnverified());
			$this->controller->view("admin/confirmPasser",$data);
		}

		public function confirmSeeker(){
			if(!$this->checkSession('adminUser')){
				header("location:index");
			}
			$data = [];
			$data[] = array("seekerUnverified"=>$this->createSeekerUnverified());
			$this->controller->view("admin/confirmSeeker",$data);
		}

		public function alluser(){
			$allUsers = $builder = $dom = $userStatus = null;
			if(!$this->checkSession('adminUser')){
				header("location:index");
			}
			$data = [];
			$allUsers = $this->model->joinPasserSeeker();
			foreach ($allUsers as $users) {
				switch ($users['PasserStatus']) {
					case 0:
						$userStatus = "Unverified";
					break;

					case 1:
						$userStatus = "Verified";
					break;

					case 2:
						$userStatus = "Pending";
					break;

					case 3:
						$userStatus = "Denied";
					break;

					case 4:
						$userStatus = "Deactivated(User Triggered)";
					break;

					case 5:
						$userStatus = "Deactivated(Admin Triggered)";
					break;
				}
				$builder = 
				'
					 <tr>
	                    <td><img src="'.$users['PasserProfile'].'" style="width:40px;"></td>
	                    <td>'.$users['fullname'].'</td>
	                    <td>'.$users['UserType'].'</td>
	                    <td>'.date("F jS, Y",strtotime($users['passerRegisterTimeDate'])).'</td>
	                    <td class="text-success">'.$userStatus.'</td>
	                </tr>
				';
				$dom = $dom."".$builder;
			}
			$data[] = array("users"=>$dom);
			$this->controller->view("admin/allUser",$data);

		}

		public function admin(){
			$allUsers = $builder = $dom = $userStatus = $pagination = null;
			$data = [];
			if(!$this->checkSession('adminUser')){
				header("location:index");
			}
			if(!isset($_GET['page']) || $_GET['page'] <=0 || !is_numeric($_GET['page'])){
				$page = 1;
			}else{
				$page = $this->sanitize($_GET['page']);
			}
			$allUsers = $this->paginationAll("admin","AdminID",$page,1,5,"AdminID","DESC","");
			$allUsers = json_decode($allUsers,true);
			print_r($allUsers);
			foreach ($allUsers['data'] as $data) {
				$builder = 
				'
				<tr>
                    <td>'.$data['AdminID'].'</td>
                    <td>'.$data['username'].'</td>
                    <td>'.$data['email'].'</td>
                </tr>
				';
				$dom = $dom."".$builder;
			}
			$pagination = $allUsers['pagination'];
			$data[] = array("dom"=>$dom,"pagination"=>$pagination);
			$this->controller->view("admin/admin",$data);

		}

		public function logout(){
			unset($_SESSION['adminUser']);
			header("location:login");			
		}
	}

?>