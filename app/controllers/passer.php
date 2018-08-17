<?php 
	class passer extends Controller{

		public $passerReg = array("PasserCOCNo","PasserFN","PasserLN","PasserMname","PasserPass","PasserEmail","PasserCertificate","PasserCertificateTyPe","PasserTESDALink","PasserCOCExpiryDate");
		public $passDashboardPersonalDetails = array("PasserAddress","PasserStreet","PasserCity","PasserGender","PasserCPNo","PasserBirthdate");
		public $passDashboardPersonalDetailsWithPhoto = array("PasserAddress","PasserStreet","PasserCity","PasserGender","PasserCPNo","PasserBirthdate","PasserProfile");
		public $passerWorkHistory = array("OfferJobID","PasserID","PasserJobTitle","PasserCompany","PasserCompanyNumber","PasserWorkHistoryDesc","PasserWorkHistoryStartDate","PasserWorkHistoryEndDate","PasserWorkHistoryWorkDays");
		public $passerEducation = array("passerID","educationAttainment","educationSchool","educationAccomplishment");
		public $passerValidate = array("passerID","frontID","backID","selfie","COC","idType","idNumber","expirationDate");
		protected $passerTable = 'passer';
		protected $passerSession;
		protected $passerUnique = 'PasserID';
		
		public function __construct(){
			$this->controller = new Controller();
			$this->model = $this->controller->model("dbModel");
			$this->data = [];
			if($this->checkSession('passerUser')){
		 		$this->passerSession = $_SESSION['passerUser'];
		 	}
		}

		public function index(){
			if(!$this->checkSession('passerUser')){
		 		header("location:../home/login");
		 	}
		 	$data = [];
			$detailsProper = null;
			$details = null;
			$userStatus = null;
			$completeAddress = null;
		 	$details = $this->model->selectAllFromUser($this->passerTable,$this->passerUnique,array($this->passerSession));
		 	$detailsProper = $details[0];
		 	$workExperience = $this->model->selectAllFromUser("passerworkhistory",$this->passerUnique,array($this->passerSession));
		 	extract($detailsProper);
		 	if($PasserStatus == 0){
		 		$userStatus = '
		 		<div class="alert alert-danger col text-center" role="alert">
					<label>Your account is not yet verified, please complete the information needed Mate<button type="button" class="btn btn-link" data-toggle="modal" data-target="#verification">Click Here</button> to verify you account.</label>			
				</div>
		 		';
		 	}elseif($PasserStatus == 2){
		 		$userStatus = '
		 		<div class="alert alert-primary col text-center" role="alert">
					<label>Thank you, Mate. Please wait until we validate your account. Until such time, you can browse through your dashboard and update details about yourself for future purposes.</label>
				</div>
		 		';
		 	}elseif($PasserStatus == 1){
		 		$userStatus = '
		 		<div class="alert alert-success col text-center" role="alert">
					<label>Welcome back, Mate. You can now use the full functionality of the service.</label>
					<button type="button" class="close" data-dismiss="alert" aria-label="Close">
				    	<span aria-hidden="true">&times;</span>
				  	</button>
				</div>
		 		';
		 	}elseif($PasserStatus == 3){
		 		$userStatus = '
		 		<div class="alert alert-danger col text-center" role="alert">
					<label>Sorry but we found inconsistency on your passed documents, Mate. But dont\' worry, you can still <button type="button" class="btn btn-link" data-toggle="modal" data-target="#verification">Click Here</button> to verify you account.</label>			
				</div>
		 		';
		 	}
		 	if(!empty($PasserAddress)){
				$completeAddress = $PasserAddress;
			}
			if(!empty($PasserStreet)){
				$completeAddress = $completeAddress." ".$PasserStreet;
			}
			if(!empty($PasserCity)){
				$completeAddress = $completeAddress.", ".$PasserCity;
			}
		 	$data[] = array("userDetails"=>$details,"workExperience"=>$workExperience,"completeAddress"=>$completeAddress,"userStatus"=>$userStatus);
			$this->controller->view("passer/dashboard",$data);
		}

		public function register(){
		 	if($this->checkSession('passerUser')){
		 		header("location:index");
		 	}
			$this->controller->view("passer/register");
		}

		public function profile(){
			if(empty($_GET['user'])){
		 		header("location:../home/login");
		 	}
		 	$builder = $table = $userUnique = $id = null;
		 	$dom = $page = null;
		 	$errorDiv = null;
		 	$seekerError = null;
		 	$coc = $this->sanitize($_GET['user']);
		 	$userDetails = null;
	 		if(!isset($_GET['page']) || $_GET['page'] <=0 || !is_numeric($_GET['page'])){
				$page = 1;
			}else{
				$page = $this->sanitize($_GET['page']);
			}
		 	$details = $this->model->selectAllFromUser($this->passerTable,"PasserCOCNo",array($coc));
		 	if($this->checkSession('passerUser') || $this->checkSession('seekerUser')){
		 		$table = (isset($_SESSION['passerUser'])?$this->passerTable:$this->seekerTable);
				$userUnique = (isset($_SESSION['passerUser'])?$this->passerUnique:$this->seekerUnique);
				$id = (isset($_SESSION['passerUser'])?$_SESSION['passerUser']:$_SESSION['seekerUser']);
				$userDetails = $this->model->selectAllFromUser($table,$userUnique,array($id));
		 	}
		 	if(!empty($details)){
			 	extract($details[0]);
			 	if($PasserStatus !=1){
			 		$errorDiv = '
			 		<div class="alert alert-danger col text-center" role="alert">
						<label>Currently, this Passer has not yet been verified so he/she cannot be hired nor messaged.</label>			
					</div>
			 		';
			 	}

			 	if(isset($_SESSION['seekerUser'])){
		 			$seekerSession = $this->sanitize($_SESSION['seekerUser']);
		 			$seekerDetails = $this->model->selectAllFromUser($this->seekerTable,$this->seekerUnique,array($seekerSession));
		 			if(!empty($seekerDetails)){
		 				extract($seekerDetails[0]);
		 				if($SeekerStatus != 1){
		 					$seekerError = '
					 		<div class="alert alert-danger col text-center" role="alert">
								<label>Currently, You cannot hire nor message any Passer. Please verify your account first on <a href=../seeker/dashboard> Here</a>.</label>			
							</div>
					 		';
		 				}
		 				else{
		 					if($this->seekerIsSubscribed() == false){
		 						$seekerError = '
						 		<div class="alert alert-danger col text-center" role="alert">
									<label>Currently, You cannot hire nor message any passer because you don\'t have any active subscription. Please subscribe <a href=../home/subscription> Here</a>.</label>			
								</div>
					 		';
		 					}
		 				}
		 			}
		 		}elseif(!$this->checkSession('seekerUser') && $PasserStatus == 1){
		 			$seekerError = '
				 		<div class="alert alert-danger col text-center" role="alert">
							<label>Please login as Seeker <a href="login">here</a> to message or hire this passer</label>			
						</div>
			 		';
		 		}

			 	$workHistory = $this->paginationScriptSingle("passerworkhistory","PasserID",$PasserID,$page,1,1,"user=".$coc);
			 	$workHistory = json_decode($workHistory,true);
			 	if(!empty($workHistory)){
			 		foreach ($workHistory['data'] as $data) {
			 			$builder = '
			 				<div class="row ">
								<div class="col-sm-12 text-center pt-4 pb-3">
									<label><h3>Work Experience</h3></label>
								</div>
							</div>	
							<div class="row justify-content-center">
								<div class="card shadowDiv col-sm-10">
									<div class="card-header bg-white">
										<i class="h2 fas fa-briefcase" style="color: darkblue;"></i>
									</div>
									<div class="card-body">
										<div class="row">
											<div class="col-sm-4">
												<label>Job Title</label>
											</div>
											<div class="col-sm-8">
												<label>'.$this->sanitize($data['PasserJobTitle']).'</label>
											</div>
										</div>
										<div class="row">
											<div class="col-sm-4">
												<label>Company</label>
											</div>
											<div class="col-sm-8">
												<label>'.$this->sanitize($data['PasserCompany']).'</label>
											</div>
										</div>
										<div class="row">
											<div class="col-sm-4">
												<label>Contact Number</label>
											</div>
											<div class="col-sm-8">
												<label>'.$this->sanitize($data['PasserCompanyNumber']).'</label>
											</div>
										</div>
										<div class="row">
											<div class="col-sm-4">
												<label>Description <small style="opacity: 0.5">(optional)</small></label>
											</div>
											<div class="col-sm-8">
												<label>'.$this->sanitize($data['PasserWorkHistoryDesc']).'</label>
											</div>
										</div>
										<div class="row">
											<div class="col-sm-4">
												<label>Date Started </label>
											</div>
											<div class="col-sm-8">
												<label>'.$this->sanitize(date("F jS, Y", strtotime($data['PasserWorkHistoryStartDate']))).'</label>
											</div>
										</div>
										<div class="row">
											<div class="col-sm-4">
												<label>Date Ended </label>
											</div>
											<div class="col-sm-8">
												<label>'.$this->sanitize(date("F jS, Y", strtotime($data['PasserWorkHistoryEndDate']))).'</label>
											</div>
										</div>
									</div>
								</div>
							</div>
							<div class="row justify-content-center pt-4">
								'.$workHistory['pagination'].'
							</div>
			 			';
			 			$dom = $dom ." ".$builder;
			 		}
			 	}
			 	$data[] = array("passerDetails"=>$details,"userDetails"=>$userDetails,"passerStatus"=>$errorDiv,"workHistory"=>$dom,"seekerError"=>$seekerError);
				$this->controller->view("passer/profile",$data);
			}
			else{
				header("location:../home/login");
			}
		}

		public function projects(){
			if(empty($_GET['user'])){
		 		header("location:../home/login");
		 	}
		 	$coc = $this->sanitize($_GET['user']);
		 	$details = $this->model->selectAllFromUser($this->passerTable,"PasserCOCNo",array($coc));
		 	$data[] = array("userDetails"=>$details);
			$this->controller->view("passer/projects",$data);
		}

		public function agreements(){
			$data = [];
			$details = $agreements = $agreementVerify = $page = $paginationData = $builder = $dom = $seekerData = $offerJobData = $paginationDOM = null;
			if(!$this->checkSession('passerUser')){
				header("location: ../home/login");
			}
			if(!isset($_GET['page']) || $_GET['page'] <=0 || !is_numeric($_GET['page'])){
				$page = 1;
			}else{
				$page = $this->sanitize($_GET['page']);
			}
			$details = $this->model->selectAllFromUser($this->passerTable,$this->passerUnique,array($_SESSION['passerUser']));
			$agreementVerify = $this->model->checkAuthenticity($this->agreementTable,$this->passerUnique,"AgreementStatus",array($this->passerSession,1),"AgreementID","DESC");
			if($agreementVerify >= 1){
				$agreements = $this->paginationScript($this->agreementTable,$this->passerUnique,$this->passerSession,"AgreementStatus",1,$page,1,2,"AgreementID","DESC","");
				$paginationData = json_decode($agreements,true);
				$paginationDOM = $paginationData['pagination'];
				foreach ($paginationData['data'] as $data) {
					$seekerData = $this->getDetailsSeeker($data[$this->seekerUnique])[0];
					$offerJobData = $this->model->selectAllFromUser($this->offerJobDB,"OfferJobFormID",array($data['OfferJobFormID']))[0];
					$builder = 
					'
					<div class="text-center">
					    <p class="display-4">'.$seekerData['SeekerFN']." ".$seekerData['SeekerLN'].'</p>
					  </div>
					  <div class="container mt-5">
					    <div class="row justify-content-center">
					      <p style="font-size: 20px;" class=" text-center">'.$offerJobData['WorkingAddress'].'</p>
					    </div>
					    <div class="container text-center">
					      <div class="row">
					        <div class="col-sm">
					          Start Date:
					          <div class="container">
					            '.$offerJobData['StartDate'].'
					          </div>
					        </div>
					        <div class="col-sm">
					          Estimated End Date:
					          <div class="container">
					            '.$offerJobData['EndDate'].'
					          </div>
					        </div>
					      </div>
					    </div>
					    <div class="container" style="font-size: 20px;">
					      <div class="text-center">Salary</div>
					    </div>
					    <div class="container">
					      <div class="text-center">
					        '.$offerJobData['Salary'].'
					      </div>
					    </div>
					  </div>
					  <div class="container mt-3">
					    <a href="agreementsDetails?id='.$data['AgreementID'].'" class="btn btn-primary btn-block">View More Details</a>
					  </div>
					';
					$dom = $dom." ".$builder;
				}
			}else{
				$dom = "No active agreement Forms";
			}
			$data[] = array("userDetails"=>$details,"paginationDOM"=>$paginationDOM,"agreementForms"=>$dom);
			$this->controller->view("passer/agreement",$data);
		}
		
	}



?>

