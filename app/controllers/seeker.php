<?php 
	class seeker extends Controller{
		public $seekerTable = "seeker";
		public $seekerUnique = "SeekerID";
		public $seekerFacebook = "seekerFacebookId";
		public $seekDashboardPersonalDetails = array("SeekerAddress","SeekerStreet","SeekerCity","SeekerGender","SeekerCPNo","SeekerBirthdate");
		public $seekDashboardPersonalDetailsWithPhoto = array("SeekerAddress","SeekerStreet","SeekerCity","SeekerGender","SeekerCPNo","SeekerBirthdate","SeekerProfile");
		public $seekerValidate = array("SeekerID","frontID","backID","selfie","idType","idNumber","expirationDate");
		protected $seekerSession;
		public function __construct(){
			$this->controller = new Controller();
			$this->model = $this->controller->model("dbModel");
			$this->data = [];
			if($this->checkSession('seekerUser')){
		 		$this->seekerSession = $_SESSION['seekerUser'];
		 	}
		}

		public function index(){
			if(!$this->checkSession('seekerUser')){
		 		header("location:../home/login");
		 	}
			$data = [];
			$userStatus = null;
			$completeAddress = null;
			$detailsProper = null;
			$seekerStatus = null;
			$details = $this->model->selectAllFromUser($this->seekerTable,$this->seekerUnique,array($this->seekerSession));
			$detailsProper = $details[0];
			extract($detailsProper);
			if(!empty($SeekerAddress)){
				$completeAddress = $SeekerAddress;
			}
			if(!empty($SeekerStreet)){
				$completeAddress = $completeAddress." ".$SeekerStreet;
			}
			if(!empty($SeekerCity)){
				$completeAddress = $completeAddress.", ".$SeekerCity;
			}

			if($SeekerStatus == 0){
		 		$userStatus = '
		 		<div class="alert alert-danger col text-center" role="alert">
					<label>Your account is not yet verified, please complete the information needed Mate<button type="button" class="btn btn-link" data-toggle="modal" data-target="#verification">Click Here</button> to verify you account.</label>			
				</div>
		 		';
		 	}elseif($SeekerStatus == 2){
		 		$userStatus = '
		 		<div class="alert alert-primary col text-center" role="alert">
					<label>Thank you, Mate. Please wait until we validate your account. Until such time, you can browse through your dashboard and update details about yourself for future purposes.</label>
				</div>
		 		';
		 	}elseif($SeekerStatus == 1){
		 		$userStatus = '
		 		<div class="alert alert-success col text-center" role="alert">
					<label>Welcome back, Mate. You can now use the full functionality of the service.</label>
					<button type="button" class="close" data-dismiss="alert" aria-label="Close">
				    	<span aria-hidden="true">&times;</span>
				  	</button>
				</div>
		 		';
		 	}elseif($SeekerStatus == 3){
		 		$userStatus = '
		 		<div class="alert alert-danger col text-center" role="alert">
					<label>Sorry but we found inconsistency on your passed documents, Mate. But dont\' worry, you can still <button type="button" class="btn btn-link" data-toggle="modal" data-target="#verification">Click Here</button> to verify you account.</label>			
				</div>
		 		';
		 	}
		 	

			$data[] = array("userDetails"=>$details,"completeAddress"=>$completeAddress,"seekerStatus"=>$userStatus);
			$this->controller->view("seeker/dashboard",$data);
		}

		public function login(){
			$this->controller->view("seeker/login");
		}

		public function profile(){
			$this->controller->view("seeker/profile");
		}

		public function register(){
			$this->controller->view("seeker/register");
		}

		public function joboffer(){
			if(!$this->checkSession('seekerUser')){
		 		header("location:../home/login");
		 	}
		 	if(!isset($_GET['page']) || $_GET['page'] <=0 || !is_numeric($_GET['page'])){
				$page = 1;
			}else{
				$page = $this->sanitize($_GET['page']);
			}
			$dom = $builder = $return = $paginationData = null;
		 	$data = [];
			$details = $this->model->selectAllFromUser($this->seekerTable,$this->seekerUnique,array($this->seekerSession));
			$return = $this->paginationScript("offerjobform","SeekerID",$this->seekerSession,"OfferJobFormStatus",1,$page,1,2);
			$paginationData = json_decode($return,true);
				// <span class="badge badge-success font-weight-bold">Default</span>
			if(empty($paginationData['data'])){
				$dom = '

				<div class="alert alert-danger font-weight-bold" role="alert">
						 There\'s no Job Offer Form created!
					</div>
				';
			}
			foreach ($paginationData['data'] as $data) {
				$builder = '
				   	<div>
	                  <div class="card-body p-0">
	                  	<div class="pb-2  mt-2">
	                  		<div class="row">
							    <div class="col-md-6">
							      <label>Working Address: <b> '.$this->sanitize($data['WorkingAddress']).'</b></label>
							    </div>
							    <div class="col">
							    	<a href="" class="font-weight-bold text-dark" name="updateJobOfferForm" style="font-size: 15px;" data-toggle="modal" data-target="#update">
							    		<u>Edit</u></a> | 
							    	<a href="" class="font-weight-bold text-dark" name="deleteJobOfferForm" style="font-size: 15px;" data-toggle="modal" data-target="#delete">
							    		<u>Delete</u></a>
							    		<input type="hidden" name="sleepingAway" value="'.$this->sanitize($data['OfferJobFormID']).'">
							    </div>
				  			</div>
				  <div class="row">
				    <div class="col">
				      <label>Start Date: <b> '.$this->sanitize(date("F jS, Y", strtotime($data['StartDate']))).'</b></label>
				    </div>
				  </div>
				  <div class="row">
				    <div class="col">
				      <label>End Date: <b> '.$this->sanitize(date("F jS, Y", strtotime($data['EndDate']))).'</b></label>
				    </div>
				  </div>
				  <div class="row">
				    <div class="col">
				      <label>Salary: <b> Php '.$this->sanitize(($data['Salary'])).'</b></label>
				    </div>
				  </div>
				  <div class="row">
				    <div class="col">
				      <label>Payment Method: <b> Through '.$this->sanitize($data['PaymentMethod']).'</b></label>
				    </div>
				  </div>
				  <div class="row">
				    <div class="col">
				      <label>Accommodation Type: <b> '.$this->sanitize($data['AccomodationType']).'</b></label>
				    </div>
				  </div>
				  <button type="submit" class="btn btn-primary ml-1 font-weight-bold" disabled="">Set as Default</button>
                              		
                                </div>
                              </div>
                            </div>

				';
				$dom = $dom. "" .$builder;
			}
			$data[] = array("userDetails"=>$details,"paginationDom"=>$paginationData['pagination'],"jobOfferFormDom"=>$dom);
			$this->controller->view("seeker/jobOffer",$data);
		}
		
	}
?>