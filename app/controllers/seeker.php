<?php 
	class seeker extends Controller{
		public $seekerTable = "seeker";
		public $seekerUnique = "SeekerID";
		public $seekerFacebook = "seekerFacebookId";
		public $seekDashboardPersonalDetails = array("SeekerAddress","SeekerStreet","SeekerCity","SeekerGender","SeekerCPNo","SeekerBirthdate","SeekerAge");
		public $seekDashboardPersonalDetailsWithPhoto = array("SeekerAddress","SeekerStreet","SeekerCity","SeekerGender","SeekerCPNo","SeekerBirthdate","SeekerProfile","SeekerAge");
		public $seekerValidate = array("SeekerID","frontID","backID","selfie","idType","idNumber","expirationDate");
		public $seekerDB = array("SeekerFN","SeekerLN","SeekerBirthdate","SeekerAge","SeekerGender","SeekerStreet","SeekerCity","SeekerAddress","SeekerCPNo","SeekerEmail","SeekerUname","SeekerPass");
		protected $seekerSession;
		public function __construct(){
			$this->controller = new Controller();
			$this->model = $this->controller->model("dbModel");
			$this->data = [];
			if($this->checkSession('seekerUser')){
		 		$this->seekerSession = $_SESSION['seekerUser'];
		 	}
		 	$this->seekerCheckSubscriptionStatus();
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
			$subscription = null;
			$subscription = $this->model->selectTwoCondition(array("*"),$this->subscriptionDB,$this->seekerUnique,"SubscriptionStatus",array($_SESSION['seekerUser'],"ongoing"));
			foreach ($subscription as $data) {
				if($data['SubscriptionEnd'] < date("Y-m-d")){
					$this->createNotification("subscription",array("sendTo"=>"SeekerID","id"=>$_SESSION['seekerUser'],"message"=>1));
				}				
			}
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

		public function profile(){
			if(empty($_GET['user'])){
		 		header("location:../home/login");
		 	}
		 	$builder = $table = $userUnique = $seekerid = $overview = null;
		 	$dom = $page = null;
		 	$errorDiv = $reviews = null;
		 	$passerError = null;
		 	$seekerid = $this->sanitize($_GET['user']);
		 	$userDetails = null;
	 		if(!isset($_GET['page']) || $_GET['page'] <=0 || !is_numeric($_GET['page'])){
				$page = 1;
			}else{
				$page = $this->sanitize($_GET['page']);
			}
		 	$details = $this->model->selectAllFromUser($this->seekerTable,$this->seekerUnique,array($seekerid));
		 	if($this->checkSession('passerUser') || $this->checkSession('seekerUser')){
		 		$table = (isset($_SESSION['passerUser'])?$this->passerTable:$this->seekerTable);
				$userUnique = (isset($_SESSION['passerUser'])?$this->passerUnique:$this->seekerUnique);
				$id = (isset($_SESSION['passerUser'])?$_SESSION['passerUser']:$_SESSION['seekerUser']);
				$userDetails = $this->model->selectAllFromUser($table,$userUnique,array($id));
		 	}

		 	$overviewData = $this->model->selectAllFromUser("seekerCompany", $this->seekerUnique, array($seekerid));
		 	if(!empty($overviewData)){
			 	foreach ($overviewData as $d) {
			 	$builder = 
			 	'
			 		
					<div class="row justify-content-center py-2">
						<div class="card shadowDiv col-sm-10">
							<div class="card-header bg-white">
								<i class="fas fa-graduation-cap h2" style="color: darkblue;"></i>
							</div>
							<div class="card-body">
								<div class="row">
									<div class="col-sm-5">
										<label>Seeker Company</label>
									</div>
									<div class="col-sm-7">
										<label>'.$d['companyName'].'</label>
									</div>
								</div>
								<div class="row">
									<div class="col-sm-5">
										<label>Seeker Number</label>
									</div>
									<div class="col-sm-7">
										<label>'.$d['companyNumber'].'</label>
									</div>
								</div>
								<div class="row">
									<div class="col-sm-5">
										<label>Seeker Descriptions <small style="opacity: 0.5">(optional)</small></label>
									</div>
									<div class="col-sm-7">
										<label>'.$d['companyDesc'].'</label>
									</div>
								</div>									
							</div>
						</div>
					</div>		
			 	';

			 	$overview = $overview ." ".$builder;
			 }
			}else{
				$overview = "No company to show";
			}

		 	$reviewData = $this->model->joinRatingNoLimit("SeekerID",array($seekerid,"Passer"),"RatingsID","DESC");
			 	foreach ($reviewData as $d) {
		 			switch ($d['PersonalityRate']) {
		 				case 1:
		 					$perLabel = '<span class="badge badge-danger font-weight-bold"><small>Bad</small></span>';
		 				break;
		 				case 2:
		 					$perLabel = '<span class="badge badge-warning font-weight-bold"><small>Fair</small></span>';
		 				break;
		 				case 3:
		 					$perLabel = '<span class="badge badge-primary font-weight-bold"><small>Good</small></span>';
		 				break;
		 				case 4:
		 					$perLabel = '<span class="badge badge-info font-weight-bold"><small>Very Good</small></span>';
		 				break;
		 				case 5:
		 					$perLabel = '<span class="badge badge-success font-weight-bold"><small>Excellent</small></span>';
		 				break;
		 				
		 			}

		 			$PersonalityRate = $this->createStar($d['PersonalityRate']);

		 			$builder = 
			 		'
		 			<div class="row py-3">
						<div class="col-md-12">
							<div class="row justify-content-center">
								<div class="col-md-9">
									<div class="card shadow">
										<div class="card-header">
											<small class="text-info font-weight-bold" > Rated on: '.date("F jS, Y",strtotime($d['ReviewdOn'])).'</small>
										</div>
										<div class="card-body">
											<div class="row">
												<div class="col-md-12">
													<div class="row ">
														<div class="col-md-3">
															<img src="'.$d['PasserProfile'].'" class="w-100 h-100 border border-info">
														</div>
														<div class="col-md-9">
															<label><h3 >'.$d['PasserFN']." ".$d['PasserLN'].'</h3></label>
														</div>
													</div>
													<div class="row">
														<div class="col-md-3">
																					
														</div>
														<div class="col-md-9">
															<label><strong>Personality : '.$PersonalityRate." ".$perLabel.' </strong></label>
														</div>
													</div>
													<div class="row form-group">
														<div class="col-md-3">
																				
														</div>
														<div class="col-md-9">
															<label><b>Feedbacks</b></label>
															<textarea class="form-control" rows="3" disabled="">'.$d['Feedback'].'</textarea>
														</div>
													</div>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>	
			 		';
			 		$reviews = $reviews ." ".$builder;
	 			}
		 	$data[] = array("seekerDetails"=>$details,"userDetails"=>$userDetails,"seekerStatus"=>$errorDiv,"passerError"=>$passerError,"reviews"=>$reviews,"overview"=>$overview);
			$this->controller->view("seeker/profile",$data);
		}

		public function agreementRecord(){
			
			if(empty($_GET['user'])){
		 		header("location:../home/login");
		 	}
		 	$id = $this->sanitize($_GET['user']);
		 	$details = $this->model->selectAllFromUser($this->seekerTable,$this->seekerUnique,array($this->seekerSession));
		 	if($this->checkSession('passerUser') || $this->checkSession('seekerUser')){
		 		$table = (isset($_SESSION['passerUser'])?$this->passerTable:$this->seekerTable);
				$userUnique = (isset($_SESSION['passerUser'])?$this->passerUnique:$this->seekerUnique);
				$id = (isset($_SESSION['passerUser'])?$_SESSION['passerUser']:$_SESSION['seekerUser']);
				$userDetails = $this->model->selectAllFromUser($table,$userUnique,array($id));
		 	}

		 	$data[] = array("userDetails"=>$details);
			$this->controller->view("seeker/agreementRecord",$data);
		}

		public function register(){
			if($this->checkSession('seekerUser')){
		 		header("location:dashboard");
		 	}
			$this->controller->view("seeker/register");
		}

		public function jobofferform(){
			if(!$this->checkSession('seekerUser')){
		 		header("location:../home/login");
		 	}
		 	if(!isset($_GET['page']) || $_GET['page'] <=0 || !is_numeric($_GET['page'])){
				$page = 1;
			}else{
				$page = $this->sanitize($_GET['page']);
			}
			$dom = $builder = $return = $paginationData = $checkEditable = null;
		 	$data = [];
			$details = $this->model->selectAllFromUser($this->seekerTable,$this->seekerUnique,array($this->seekerSession));
			$return = $this->paginationScript("offerjobform","SeekerID",$this->seekerSession,"OfferJobFormStatus",1,$page,1,2,"OfferJobFormID","DESC","");
			$paginationData = json_decode($return,true);
			$badge = null;
			$defaultButton = '<button type="button" class="btn btn-primary ml-1 font-weight-bold setDefault">Set as Default</button>';				
			if(empty($paginationData['data'])){
				$dom = '

				<div class="alert alert-danger font-weight-bold" role="alert">
					There\'s no Job Offer Form created!
				</div>
				';
			}
			foreach ($paginationData['data'] as $data) {
				$checkEditable = 
				'
					<div class="col">
				    	<a href="" class="font-weight-bold text-dark" name="updateJobOfferForm" style="font-size: 15px;" data-toggle="modal" data-target="#update">
				    		<u>Edit</u></a> | 
				    	<a href="" class="font-weight-bold text-dark" name="deleteJobOfferForm" style="font-size: 15px;" data-toggle="modal" data-target="#delete">
				    		<u>Delete</u></a>
				    		<input type="hidden" name="sleepingAway" value="'.$this->sanitize($data['OfferJobFormID']).'">
				    </div>
				';
				if($data['offerjobformDefault'] == 1){
					$badge = '<span class="badge badge-success font-weight-bold">Default</span>';
					$defaultButton = null;
				}
				if($data['uneditable'] == 1 ){
					$checkEditable = null;
					$badge='<span class="badge readonly badge-success font-weight-bold">Currently in use on other form</span>';
					$defaultButton = null;
				}elseif($data['uneditable'] == 2){
					$badge='<span class="badge readonly badge-success font-weight-bold">Currently in peding mode. Cannot be deleted but can be edited</span>';
					$defaultButton = null;
					$checkEditable = 
					'
						<div class="col">
					    	<a href="" class="font-weight-bold text-dark" name="updateJobOfferForm" style="font-size: 15px;" data-toggle="modal" data-target="#update">
					    		<u>Edit</u></a>
					    		<input type="hidden" name="sleepingAway" value="'.$this->sanitize($data['OfferJobFormID']).'">
					    </div>
					';
				}
				$builder = '
					'.$badge.'
				   	<div>
	                  <div class="card-body p-0">
	                  	<div class="pb-2  mt-2">
	                  		<div class="row">
							    <div class="col-md-6">
							      <label>Working Address: <b> '.$this->sanitize($data['WorkingAddress']).'</b></label>
							    </div>
							   '.$checkEditable.'
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
				  '.$defaultButton.'
                    </div>
                  </div>
                </div>

				';
				$dom = $dom. "" .$builder;
				$badge = null;
				$defaultButton = '<button type="button" class="btn btn-primary ml-1 font-weight-bold setDefault">Set as Default</button>';
			}
			$data[] = array("userDetails"=>$details,"paginationDom"=>$paginationData['pagination'],"jobOfferFormDom"=>$dom);
			$this->controller->view("seeker/jobOffer",$data);
		}
		
		public function hiredpassers(){
			$allUsers = $flag = $builder = $dom = $element = $badge = $text = $builder = $dom = $date = null;
			$data = [];
			if(!$this->checkSession('seekerUser')){
		 		header("location:../home/login");
		 	}
		 	if(!isset($_GET['page']) || $_GET['page'] <=0 || !is_numeric($_GET['page'])){
				$page = 1;
			}else{
				$page = $this->sanitize($_GET['page']);
			}
		 	$allUsers = $this->dynamicJobOffer("offerjob","OfferJobStatus",$this->seekerUnique,array(5,$this->seekerSession),$page,1,8,"OfferJobID","DESC","");
		 	$allUsers = json_decode($allUsers,true);
		 	if(empty($allUsers['data'])){
		 		$dom = '<div class="container text-center alert alert-danger" role="alert">
                    You haven\'t choosen any Passer at the moment.
                  </div>';
		 	}
		 	else{
			 	foreach ($allUsers['data'] as $d) {
			 		if($d['OfferJobStatus'] != 8 && $d['OfferJobStatus'] !=10){
				 		switch ($d['OfferJobStatus']) {
				 			case 5:
				 				$element = "ongoing";
				 				$badge = "info";
				 				$text = "ONGOING";
				 			break;

				 			case 6:
				 				$element = "pending";
				 				$badge = "warning";
				 				$text = "PENDING FOR CANCELLATION";
				 			break;

				 			case 7:
				 				$element = "canceled";
				 				$badge = "danger";
				 				$text = "CANCELLED";
				 			break;

				 			case 9:
				 				$element = "done";
				 				$badge = "success";
				 				$text = "DONE";
				 			break;
				 		}
				 		$date = ($d['OfferJobStatus'] == 5?$d['OfferJobDateTime']:$this->model->selectTwoCondition(array("TransactionDateTime"),"transactionhistory","NewStatus","OfferJobID",array(5,$d['OfferJobID']))[0]['TransactionDateTime']);
				 		$builder = 
				 		'
				 		<div class="col-md-3 filter '.$element.'">
						  <div class="card shadow">
						    <div class="card-header">
						      <small class="font-weight-bold">Hired Date: '.date("F jS, Y",strtotime($date)).'</small>
						    </div>
						    <div class="card-body" style="height:400px">
						  <div class="container">
						    <img src="'.$d['PasserProfile'].'" alt="Avatar" class="image w-100" style="height:200px;">
						    <div class="overlay">
						      <div class="text">Passer\'s Name: '.$d['PasserFN']." ".$d['PasserLN'].'</div>
						    </div>
						  </div>
						  <p class="font-weight-bold text-center mt-3">
						    Job title: <u>'.$d['PasserCertificate'].'</u>
						      </p>
						  <p class="font-weight-bold text-center mt-3">Job Status: 
						        <span class="badge badge-'.$badge.' font-weight-bold">'.$text.'</span>
						      </p>
						    </div>
						  </div>
						</div>
				 		';
				 		$dom = $dom."".$builder;
			 		}
			 	}
		 	}
			$details = $this->model->selectAllFromUser($this->seekerTable,$this->seekerUnique,array($this->seekerSession));
			$data[] = array("userDetails"=>$details,"dom"=>$dom,"pagination"=>$allUsers['pagination']);
			$this->controller->view("seeker/hiredpassers",$data);
		}

		public function billing(){
			$details = $subscriptions = $data = $joinedData = $subscriptionData = $pagination = $page = $builder = $badge = $dom = null;
			$data = [];
			if(!$this->checkSession("seekerUser")){
				header("location:login");
			}
			if(!isset($_GET['page']) || $_GET['page'] <=0 || !is_numeric($_GET['page'])){
				$page = 1;
			}else{
				$page = $this->sanitize($_GET['page']);
			}
			$subscriptions = $this->model->checkExistSingle($this->subscriptionDB,$this->seekerUnique,array($this->seekerSession));
			if($subscriptions >=1 ){
				$subscriptionData = $this->paginationScriptSingle($this->subscriptionDB,$this->seekerUnique,$this->seekerSession,$page,1,3,"SubscriptionID","DESC","");
				$data = json_decode($subscriptionData,true);
				$pagination = $data['pagination'];
				foreach ($data['data'] as $dataSubscription) {
					$joinedData = $this->model->joinSubscription(array($dataSubscription['SubscriptionID']))[0];
					$badge = ($joinedData['SubscriptionStatus'] == "ongoing"?'<span class="badge badge-success font-weight-bold">Ongoing</span>':'<span class="badge badge-danger font-weight-bold">Ended</span>');
					$builder = 
					'
					<div class="row" style="font-size: 15px">
                      <div class="col-sm-3">
                        <p>TATAK '.$this->sanitize(ucfirst($joinedData['SubscriptionName'])).' Plan</p>
                      </div>
                      <div class="col-sm-2">
                        <p>Php '.$this->sanitize($joinedData['SubscriptionPrice']).'.00</p>
                      </div>
                      <div class="col-sm-2">
                        <p>'.date("F jS, Y",strtotime($this->sanitize($joinedData['SubscriptionStart']))).'</p>
                      </div>
                      <div class="col-sm-3">
                        <p>'.date("F jS, Y",strtotime($this->sanitize($joinedData['SubscriptionEnd']))).'</p>
                      </div>
                      <div class="col-sm-2">
                        <p>'.$badge.'</p>
                      </div>
                    </div>
                    <hr>
					';
					$dom = $dom."".$builder;
				}
			}else{
				$dom = 
				'
				    <div class="row" style="font-size: 15px">
                      <div class="col-md-12">
                        <div class="alert alert-danger" role="alert">
                          There\'s no billing records found.
                        </div>
                      </div>
                    </div>
				';
			}
			$details = $this->getDetailsSeeker($this->seekerSession);
			$data[] = array("userDetails"=>$details,"billingHistory"=>$dom,"pagination"=>$pagination);
			$this->controller->view("seeker/billing",$data);
		}

		public function joboffered(){
			$details = $jobOffers = $joinedJobOffers = $page = $builder = $dom = $pagination = $paginationData = $checkTransaction = $status = $headerColor = $employmentAgreement = $update = $cancelInitiator = $dispute = null;
			$data = [];
			if(!$this->checkSession("seekerUser")){
				header("location: ../home/login");
			}
			if(!isset($_GET['page']) || $_GET['page'] <=0 || !is_numeric($_GET['page'])){
				$page = 1;
			}else{
				$page = $this->sanitize($_GET['page']);
			}

			$checkTransaction = $this->model->selectAllFromUser($this->offerJobAddTable,$this->seekerUnique,array($_SESSION['seekerUser']));
			if(!empty($checkTransaction)){
				$jobOffers = $this->paginationScriptSingle($this->offerJobAddTable,$this->seekerUnique,$this->seekerSession,$page,1,3,"OfferJobDateTime","DESC","");
				$paginationData = json_decode($jobOffers,true);
				$pagination = $paginationData['pagination'];
				foreach ($paginationData['data'] as $data) {
					$joinedJobOffers = $this->model->joinOfferJobForm(array($data['OfferJobID']))[0];
					switch ($joinedJobOffers['OfferJobStatus']) {
						case 1:
							$status = '<a class="badge badge-warning font-weight-bold ">Pending</a>';
							$employmentAgreement = 
							'<button type="button" class="btn btn-outline-dark bg-success float-right updateButton" data-toggle="modal" data-target="#update">
	                          Update your Job Offered
	                        </button>';
							$headerColor = 'bg-info';
							$update = null;
							break;
						case 2:
							$status = '<a class="badge badge-warning font-weight-bold ">Pending</a>';
							$headerColor = 'bg-dark';
							$employmentAgreement = 
							'<button type="button" class="btn btn-outline-light float-right updateButton" data-toggle="modal" data-target="#update">
	                          Update your Job Offered
	                        </button>';
							$update = '<small class="text-left "><b class="text-primary">Updated:</b> </small>';
							break;
						case 3:
							$status = '<a class="badge badge-success text-white font-weight-bold ">Accepted</a>';
							$headerColor = 'bg-success';
							$employmentAgreement = 
							'
							<button type="button" class="btn btn-outline-light float-right" data-toggle="modal" data-target="#agreement" name="updateJobOfferForm">
	                          Make an Employment Agreement
	                        </button>
	                        <button type="button" id="cancelJobOfferModal" class="btn btn-outline-light float-right" data-toggle="modal" data-target="#cancel" name="cancelJobOffer">
	                          Cancel Job offer
	                        </button>
	                        <button type="button" class="btn btn-outline-light float-right" data-toggle="modal" data-target="#dispute" name="disputeJobOffer">
	                          Dispute
	                        </button>
							';
							$update = null;
							break;
						case 4:
							$status = '<a class="badge badge-danger text-white font-weight-bold ">Declined</a>';
							$headerColor = 'bg-danger';
							$employmentAgreement = null;
							$update = null;
							break;
						case 5:
							$status = '<a class="badge badge-primary text-white font-weight-bold ">Officially Hired</a>';
							$headerColor = 'bg-primary';
							$employmentAgreement = 
							'
							<button type="button" class="btn btn-outline-light float-right" data-toggle="modal" data-target="#doneModal" name="doneJobOffer">
	                          Mark job as done
	                        </button>
							<button type="button" id="cancelJobOfferModal" class="btn btn-outline-light float-right" data-toggle="modal" data-target="#cancel" name="cancelJobOffer">
	                          Cancel Job offer
	                        </button>
	                        <button type="button" class="btn btn-outline-light float-right" data-toggle="modal" data-target="#dispute" name="disputeJobOffer">
	                          Dispute
	                        </button>
							';
							$update = null;
							break;
						case 6:
							$cancelInitiator = $this->model->selectAllDynamic("canceljoboffer",array("*"),array("OfferJobID",$this->seekerUnique),array($joinedJobOffers['OfferJobID'],$this->seekerSession))[0];
							switch ($cancelInitiator['CancellationInitiator']) {
								case 'Passer':
									$status = '<a class="badge badge-warning text-black font-weight-bold float-right">Pending for cancellation</a>';
									$headerColor = 'bg-warning';
									$employmentAgreement = 
									'
									<button type="button" id="cancelJobOfferModalMine" class="btn btn-outline-light float-right" data-toggle="modal" data-target="#cancelMine" name="cancelJobOfferMine">
			                          Show Details
			                        </button>
			                        <button type="button" class="btn btn-outline-light float-right" data-toggle="modal" data-target="#dispute" name="disputeJobOffer">
			                          Dispute
			                        </button>
									';
									$update = '<small class="text-left "><b class="text-black">Pending for cancellation started on:</b> </small>';
									break;
								case 'Seeker':
									$status = '<a class="badge badge-warning text-black font-weight-bold float-right">Pending for cancellation</a>';
									$headerColor = 'bg-warning';
									// $employmentAgreement = 
									// '
									// <button type="button" class="btn btn-outline-light float-right" data-toggle="modal" data-target="#dispute" name="disputeJobOffer">
			      //                     Dispute
			      //                   </button>
									// ';
									$employmentAgreement = null;
									$update = '<small class="text-left "><b class="text-black">Pending for cancellation started on:</b> </small>';
									break;
							}
							break;
						case 7:
							$status = '<a class="badge badge-danger font-weight-bold ">Cancelled</a>';
							$headerColor = 'bg-danger';
							$employmentAgreement = null;
							$update = '<small class="text-left "><b class="text-black">Cancelled on:</b> </small>';
							break;
						case 8:
							$dispute = $this->model->selectAllDynamic("dispute",array("*"),array($this->seekerUnique,"DisputeIssuer"),array($this->seekerSession,"Passer"));
							$status = '<a class="badge badge-danger font-weight-bold ">dispute</a>';
							$headerColor = 'bg-danger';
							$employmentAgreement = (!empty($dispute)?'<button type="button" id="showDispute" class="btn btn-outline-light float-right" data-toggle="modal" data-target="#showDisputeSeeker" name="showDisputeSeeker">Show Dispute Details</button>':'<button type="button" class="btn btn-outline-light float-right" name="settle">Mark as Settled</button>');
							$update = '<small class="text-left "><b class="text-black">disputed on:</b> </small>';
							break;
						case 9:
							$status = '<a class="badge badge-success font-weight-bold ">Completed</a>';
							$headerColor = 'bg-success';
							$employmentAgreement = 
							'
							<button type="button" class="btn btn-outline-light float-right" data-toggle="modal" data-target="#dispute" name="disputeJobOffer">
	                          Dispute
	                        </button>
							';
							// <button type="button" class="btn btn-outline-light float-right" data-toggle="modal" data-target="#dispute" name="disputeJobOffer">
	      //                     Dispute
	      //                   </button>
							$update = '<small class="text-left "><b class="text-black">Completed on:</b> </small>';
							break;
						case 10:
							$status = '<a class="badge badge-success font-weight-bold ">Settled</a>';
							$headerColor = 'bg-success';
							$employmentAgreement = null;
							$update = '<small class="text-left "><b class="text-black">Marked as settled on:</b> </small>';
							break;
					}
					$builder = 
					'
					<div class="card shadow mb-3">
                      <div class="card-header '.$headerColor.'">
                        <h5 class="text-white">Job Offer to <u class="text-white">'.$joinedJobOffers['PasserFN']." ".$joinedJobOffers['PasserLN'].'</u></h5>
                        '.$update.'<small class="text-left text-white"> '.date("F jS, Y",strtotime($joinedJobOffers['OfferJobDateTime'])).'</small>
                        '.$employmentAgreement.'
                        <button type="button" class="btn btn-outline-light float-right" name="messagePasser">
			            	Chat
			            </button>
                      </div>
                      <div class="card-body">
                    	  <p style="font-size:13px">Working Address: 
                          <u class="font-weight-bold">'.$joinedJobOffers['WorkingAddress'].'</u>
                        </p>
                        <p style="font-size:13px">Start Date of service: 
                          <u class="font-weight-bold">'.date("F jS, Y",strtotime($joinedJobOffers['StartDate'])).'</u>
                        </p>
                        <p style="font-size:13px">Estimated End Date of service: 
                          <u class="font-weight-bold">'.date("F jS, Y",strtotime($joinedJobOffers['EndDate'])).'</u>
                        </p>
                        <p style="font-size:13px">Service Fee: 
                          <u class="font-weight-bold serviceFeeValue"><span>&#8369;</span> '.$joinedJobOffers['Salary'].'.00</u>
                          <input type="hidden" class="d-none" readonly disabled name="passer" value="'.$joinedJobOffers['PasserID'].'">
                        </p>
                        <p style="font-size:13px" class="accomodationValue">Preferred Type of Accommodation
                          <u class="font-weight-bold">'.$joinedJobOffers['AccomodationType'].'</u>
                          <input type="hidden" class="d-none" readonly disabled name="offerjobform" value="'.$joinedJobOffers['OfferJobFormID'].'">
                          <input type="hidden" class="d-none" readonly disabled name="offerjob" value="'.$joinedJobOffers['OfferJobID'].'">
                        </p>
                        <div class="form-group">
                          <label for="exampleFormControlTextarea2">Notes</label>
                          <textarea class="form-control rounded-0 font-weight-bold" id="exampleFormControlTextarea2" rows="3" disabled style="font-size:13px">'.$joinedJobOffers['Notes'].'</textarea>
                      </div>
                      </div>
                      <div class="card-footer">
                        Status: '.$status.'
                      </div>
                    </div>
					';
					$dom = $dom."".$builder;
				}
			}else{
				$dom = 
				'
				<div class="alert alert-danger" role="alert">
				  You don\'t have any job offered.
				</div>
				';
			}

			$details = $this->getDetailsSeeker($this->seekerSession);
			$data[] = array("userDetails"=>$details,"offers"=>$dom,"pagination"=>$pagination);
			$this->controller->view("seeker/jobOffered",$data);
		}

		public function transaction(){
			$details = null;
			$data = [];
			if(!$this->checkSession("seekerUser")){
				header("location: ../home/login");
			}
			$details = $this->getDetailsSeeker($this->seekerSession);
			$data[] = array("userDetails"=>$details);
			$this->controller->view("seeker/transactions",$data);
		}
		
	}
?>