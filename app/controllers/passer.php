<?php 
	class passer extends Controller{

		public $passerReg = array("PasserCOCNo","PasserFN","PasserLN","PasserMname","PasserPass","PasserEmail","PasserCertificate","PasserCertificateTyPe","PasserTESDALink","PasserCOCExpiryDate");
		public $passDashboardPersonalDetails = array("PasserAddress","PasserStreet","PasserCity","PasserGender","PasserCPNo","PasserBirthdate","PasserAge");
		public $passDashboardPersonalDetailsWithPhoto = array("PasserAddress","PasserStreet","PasserCity","PasserGender","PasserCPNo","PasserBirthdate","PasserProfile","PasserAge");
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
		 	$builder = $table = $userUnique = $id =  $education = $serviceFee = null;
		 	$dom = $page = null;
		 	$errorDiv = $reviews = null;
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

			 	$workHistory = $this->model->selectDataFromOtherDB("passerworkhistory","passer","PasserID","PasserCOCNo",array($coc));
			 	if(!empty($workHistory)){
			 		foreach ($workHistory as $data) {
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
							
			 			';
			 			$dom = $dom ." ".$builder;
			 		}
			 	}else{
			 		$dom = "No Work history to show";
			 	}
			 	$serviceFeeDate = $this->model->selectSingleUser("passer","passerFee",array($coc),"PasserCOCNo");
			 	if(!empty($serviceFeeDate)){
			 	$serviceFee =
			 	'
			 		<div class="row ">
						<div class="col-sm-12 text-center pt-4 pb-3">
							<label><h3>Passer\'s Service Rate is &#8369;'.$serviceFeeDate.'</h3></label>
						</div>
					</div>
						

			 	';
			 	}else{
			 		$serviceFeeDate = 
			 		'
			 		<div class="row ">
						<div class="col-sm-12 text-center pt-4 pb-3">
							<label><h3>Passer\'s Service Rate is not yet defined</h3></label>
						</div>
					</div>
			 		';
			 	}
			 	$educationData = $this->model->selectDataFromOtherDB("passereducation","passer","PasserID","PasserCOCNo",array($coc));
			 	if(!empty($educationData)){

			 	$builder = 
			 	'
			 		<div class="row ">
						<div class="col-sm-12 text-center pt-4 pb-3">
							<label><h3>Highest Educational Attainment</h3></label>
						</div>
					</div>	
					<div class="row justify-content-center">
						<div class="card shadowDiv col-sm-10">
							<div class="card-header bg-white">
								<i class="fas fa-graduation-cap h2" style="color: darkblue;"></i>
							</div>
							<div class="card-body">
								<div class="row">
									<div class="col-sm-5">
										<label>Highest Educational Attainment</label>
									</div>
									<div class="col-sm-7">
										<label>'.$educationData[0]['educationAttainment'].'</label>
									</div>
								</div>
								<div class="row">
									<div class="col-sm-5">
										<label>School/University</label>
									</div>
									<div class="col-sm-7">
										<label>'.$educationData[0]['educationSchool'].'</label>
									</div>
								</div>
								<div class="row">
									<div class="col-sm-5">
										<label>Accomplishments or descriptions <small style="opacity: 0.5">(optional)</small></label>
									</div>
									<div class="col-sm-7">
										<label>'.$educationData[0]['educationAccomplishment'].'</label>
									</div>
								</div>									
							</div>
						</div>
					</div>
			 	';
			 	$education = $education ." ".$builder;
			 }else{
			 	$education = '<div class="container">No data to display.</div>';
			 }

			 	$reviewData = $this->model->joinRatingNoLimit("PasserID",array($PasserID,"Seeker"),"RatingsID","DESC");
			 	foreach ($reviewData as $d) {
			 		switch ($d['PunctualityRate']) {
		 				case 1:
		 					$pLabel = '<span class="badge badge-danger font-weight-bold"><small>Bad</small></span>';
		 				break;
		 				case 2:
		 					$pLabel = '<span class="badge badge-warning font-weight-bold"><small>Fair</small></span>';
		 				break;
		 				case 3:
		 					$pLabel = '<span class="badge badge-primary font-weight-bold"><small>Good</small></span>';
		 				break;
		 				case 4:
		 					$pLabel = '<span class="badge badge-info font-weight-bold"><small>Very Good</small></span>';
		 				break;
		 				case 5:
		 					$pLabel = '<span class="badge badge-success font-weight-bold"><small>Excellent</small></span>';
		 				break;
		 				
		 			}
		 			switch ($d['WorkQualityRate']) {
		 				case 1:
		 					$wLabel = '<span class="badge badge-danger font-weight-bold"><small>Bad</small></span>';
		 				break;
		 				case 2:
		 					$wLabel = '<span class="badge badge-warning font-weight-bold"><small>Fair</small></span>';
		 				break;
		 				case 3:
		 					$wLabel = '<span class="badge badge-primary font-weight-bold"><small>Good</small></span>';
		 				break;
		 				case 4:
		 					$wLabel = '<span class="badge badge-info font-weight-bold"><small>Very Good</small></span>';
		 				break;
		 				case 5:
		 					$wLabel = '<span class="badge badge-success font-weight-bold"><small>Excellent</small></span>';
		 				break;
		 				
		 			}
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

		 			$punctualityRate = $this->createStar($d['PunctualityRate']);
		 			$WorkQualityRate = $this->createStar($d['WorkQualityRate']);
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
															<img src="'.$d['SeekerProfile'].'" class="w-100 h-100 border border-info">
														</div>
														<div class="col-md-9">
															<label><h3 >'.$d['SeekerFN']." ".$d['SeekerLN'].'</h3></label>
														</div>
													</div>
													<div class="row">
														<div class="col-md-3">
																					
														</div>
														<div class="col-md-9">
															<label><strong>Personality : '.$PersonalityRate." ".$perLabel.' </strong></label>
														</div>
													</div>
													<div class="row">
														<div class="col-md-3">
																													
														</div>
														<div class="col-md-9">
															<label><strong>Punctuality : '.$punctualityRate." ".$perLabel.' </strong></label>
														</div>
													</div>
													<div class="row">
														<div class="col-md-3">
																				
														</div>
														<div class="col-md-9">
															<label><strong>Work Quality : '.$WorkQualityRate." ".$perLabel.' </strong></label>
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

			 	$data[] = array("passerDetails"=>$details,"userDetails"=>$userDetails,"passerStatus"=>$errorDiv,"workHistory"=>$dom,"seekerError"=>$seekerError,"reviews"=>$reviews,"education"=>$education,"serviceFee"=>$serviceFee);
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

		public function joboffers(){
			$data = [];
			$details = $agreements = $agreementVerify = $page = $paginationData = $builder = $dom = $joinData = $paginationDOM = $seekerData = $passerData = $subscriptionDetails = $status = $employmentAgreement = $headerColor = $cancelInitiator = $checkCommented = null;

			if(!$this->checkSession('passerUser')){
				header("location: ../home/login");
			}
			if(!isset($_GET['page']) || $_GET['page'] <=0 || !is_numeric($_GET['page'])){
				$page = 1;
			}else{
				$page = $this->sanitize($_GET['page']);
			}
			$details = $this->model->selectAllFromUser($this->passerTable,$this->passerUnique,array($_SESSION['passerUser']));
			$agreementVerify = $this->model->checkExistSingle($this->offerJobAddTable,$this->passerUnique,array($this->passerSession),"AgreementID","DESC");
			if($agreementVerify >= 1){
				$agreements = $this->paginationScriptSingle($this->offerJobAddTable,$this->passerUnique,$this->passerSession,$page,1,2,"OfferJobDateTime","DESC","");
				$paginationData = json_decode($agreements,true);
				$paginationDOM = $paginationData['pagination'];
				foreach ($paginationData['data'] as $data) {
					$joinData = $this->model->joinOfferJob(array($data['OfferJobID']))[0];
					switch ($joinData['OfferJobStatus']) {
						case 1:
							$status = '<a class="badge badge-success text-white float-right ml-5">Pending</a>';
							$employmentAgreement = 
							'<button type="button" class="btn btn-outline-primary" data-toggle="modal" name="acceptJobOffer"  data-target="#accept" title="Accept the Job offer">Accept</button>
                       		<button type="button" class="btn btn-outline-danger" name="declineJobOffer" data-toggle="modal" data-target="#decline" title="Decline the Job offer">Decline</button>';
							$headerColor = 'bg-info';
							$update = '<small class="text-left "><b class="text-white">Offered on:</b> </small>';
							break;
						case 2:
							$status = '<a class="badge badge-success text-white float-right ml-5">Updated</a>';
							$headerColor = 'bg-secondary';
							$employmentAgreement = 
							'<button type="button" class="btn btn-outline-primary" data-toggle="modal" name="acceptJobOffer" data-target="#accept" title="Accept the Job offer">Accept</button>
                       		<button type="button" class="btn btn-outline-danger" name="declineJobOffer" data-toggle="modal" data-target="#decline" title="Decline the Job offer">Decline</button>
                       		';
	                        $update = '<small class="text-left "><b class="text-success">Updated:</b> </small>';
							break;
						case 3:
							$status = '<a class="badge badge-success text-white float-right ml-5">Accepted</a>';
							$headerColor = 'bg-success';
							$employmentAgreement = 
							'
                       		<button type="button" class="btn btn-outline-danger" id="cancelJobOfferModal" data-toggle="modal" data-target="#cancel" title="Cancel the Job offer">Cancel</button>
                       		<button type="button" class="btn btn-outline-danger" name="disputeJobOffer" data-toggle="modal" data-target="#dispute" title="Dispute the Job offer">Dispute</button>
							';
							$update = '<small class="text-left "><b class="text-white">Accepted on:</b> </small>';
							break;
						case 4:
							$status = '<a class="badge badge-success text-white float-right ml-5">Declined</a>';
							$headerColor = 'bg-danger';
							$employmentAgreement = null;
							$update = '<small class="text-left "><b class="text-success">Declined on:</b> </small>';
							break;
						case 5:
							$status = '<a class="badge badge-primary text-white font-weight-bold ">Officially Hired</a>';
							$headerColor = 'bg-primary';
							$employmentAgreement = '
                       		<button type="button" class="btn btn-outline-danger" id="cancelJobOfferModal" data-toggle="modal" data-target="#cancel" title="Cancel the Job offer">Cancel</button>
							<button type="button" class="btn btn-outline-danger" name="disputeJobOffer" data-toggle="modal" data-target="#dispute" title="Dispute the Job offer">Dispute</button>
							';
							$update = '<small class="text-right "><b class="text-success text-right ">Officially Hired on:</b> </small>';
							break;
						case 6:
							$cancelInitiator = $this->model->selectAllDynamic("canceljoboffer",array("*"),array("OfferJobID",$this->passerUnique),array($joinData['OfferJobID'],$this->passerSession))[0];
							switch ($cancelInitiator['CancellationInitiator']) {
								case 'Passer':
									$status = '<a class="badge badge-warning text-black font-weight-bold float-right">Pending for cancellation</a>';
									$headerColor = 'bg-warning';
									// $employmentAgreement = 
									// '<button type="button" class="btn btn-outline-danger" name="disputeJobOffer" data-toggle="modal" data-target="#dispute" title="Dispute the Job offer">Dispute</button>
									// ';
									$employmentAgreement = null;
									$update = '<small class="text-left "><b class="text-black">Pending for cancellation started on:</b> </small>';
									break;
								
								case 'Seeker':
									$status = '<a class="badge badge-warning text-black font-weight-bold float-right">Pending for cancellation</a>';
									$headerColor = 'bg-warning';
									$employmentAgreement = 
									'
									<button type="button" id="cancelJobOfferModalMine" class="btn btn-outline-danger" data-toggle="modal" data-target="#cancelMine" name="cancelJobOfferMine">
			                          Show Details
			                        </button>
									<button type="button" class="btn btn-outline-danger" name="disputeJobOffer" data-toggle="modal" data-target="#dispute" title="Dispute the Job offer">Dispute</button>
									';
									$update = '<small class="text-left "><b class="text-black">Pending for cancellation started on:</b> </small>';
									break;
							}
							break;
						case 7:
							$status = '<a class="badge badge-danger text-white font-weight-bold float-right">Cancelled</a>';
							$headerColor = 'bg-danger';
							// $employmentAgreement = 
							// '
							// <button type="button" class="btn btn-outline-danger" name="disputeJobOffer" data-toggle="modal" data-target="#dispute" title="Dispute the Job offer">Dispute</button>
							// ';
							$employmentAgreement = null;
							$update = '<small class="text-left "><b class="text-black">Cancelled on:</b> </small>';
							break;
						case 8:
							$dispute = $this->model->selectAllDynamic("dispute",array("*"),array($this->passerUnique,"DisputeIssuer"),array($this->passerSession,"Seeker"));
							$status = '<a class="badge badge-danger text-white font-weight-bold float-right">Dispute</a>';
							$headerColor = 'bg-danger';
							$employmentAgreement = (!empty($dispute)?'<button type="button" class="btn btn-outline-danger" name="showDisputePasser" data-toggle="modal" data-target="#showDisputePasser" title="Show Dispute">Show Dispute Details</button>':'<button type="button" class="btn btn-outline-success" name="settle" title="Mark Settled">Mark as Settled</button>');
							$update = '<small class="text-left "><b class="text-black">Disputed on:</b> </small>';
							break;
						case 9:
							$status = '<a class="badge badge-success text-white font-weight-bold float-right">Completed</a>';
							$headerColor = 'bg-success';
							$checkCommented = $this->model->selectAllDynamic("ratings",array("COUNT(*)"),array("OfferJobID",$this->passerUnique,"ReviewBy"),array($data['OfferJobID'],$this->passerSession,"Passer"));
							if($checkCommented[0]["COUNT(*)"] <= 0){
								$employmentAgreement = 
								'
								<button type="button" class="btn btn-outline-danger" name="disputeJobOffer" data-toggle="modal" data-target="#dispute" title="Dispute the Job offer">Dispute</button>
								<button type="button" class="btn btn-outline-success" name="doneJobOffer" data-toggle="modal" data-target="#doneModal" title="Rate Seeker">Rate Seeker</button>
								';
							}else{
								// $employmentAgreement = 
								// '
								// <button type="button" class="btn btn-outline-success" name="disputeJobOffer" data-toggle="modal" data-target="#dispute" title="Dispute the Job offer">Dispute</button>
								// ';
								$employmentAgreement = null;
							}
							$employmentAgreement .= '<button type="button" class="btn btn-outline-success" name="generateCOE" data-toggle="modal" data-target="#viewCOE" title="Request for COE">Request for COE</button>
							<button type="button" class="btn btn-outline-success" name="generateCompletion" data-toggle="modal" data-target="#viewCOECompletion" title="Rate Seeker">Request for Completion Certificate</button>';
							
							$update = '<small class="text-left "><b class="text-black">Completed on:</b> </small>';
							break;
						case 10:
							$status = '<a class="badge badge-success text-white font-weight-bold float-right">Settled</a>';
							$headerColor = 'bg-success';
							$employmentAgreement .= '<button type="button" class="btn btn-outline-success" name="generateCOE" data-toggle="modal" data-target="#viewCOE" title="Request for COE">Request for COE</button>
							<button type="button" class="btn btn-outline-success" name="generateCompletion" data-toggle="modal" data-target="#viewCOECompletion" title="Rate Seeker">Request for Completion Certificate</button>';
							$update = '<small class="text-left "><b class="text-black">Marked as settled on:</b> </small>';
							break;
					}
					$builder = 
					'
					<div class="card-header '.$headerColor.'">
                        <h5>Job Offer from <u class="text-white">'.$joinData['SeekerFN']." ".$joinData['SeekerLN'].'</u></h5>
                        '.$update."".date("F jS, Y g:i:s A", strtotime($joinData['OfferJobDateTime'])).'
                      </div>
                      <div class="card-body">
                         <p style="font-size:13px">Working Address: 
                          <u class="font-weight-bold">'.$joinData['WorkingAddress'].'</u>
                        </p>
                         <p style="font-size:13px">Estimated Start Date of service: 
                          <u class="font-weight-bold">'.date("F jS, Y", strtotime($joinData['StartDate'])).'</u>
                        </p>
                         <p style="font-size:13px">Estimated End Date of service: 
                          <u class="font-weight-bold">'.date("F jS, Y", strtotime($joinData['EndDate'])).'</u>
                        </p>
                        <p style="font-size:13px">Service Fee: 
                          <u class="font-weight-bold"><span>&#8369;</span> '.$joinData['Salary'].'.00</u>
                        </p>
                        <p style="font-size:13px">Preferred Type of Accommodation
                          <u class="font-weight-bold">'.$joinData['AccomodationType'].'</u>
                        </p>
                        <p style="font-size:13px">Payment Method
                          <u class="font-weight-bold">'.$joinData['PaymentMethod'].'</u>
                        </p>
                        <div class="form-group">
                            <label for="exampleFormControlTextarea2">Notes</label>
                            <textarea class="form-control rounded-0 font-weight-bold" id="exampleFormControlTextarea2" rows="3" disabled style="font-size:13px">'.$joinData['Notes'].'</textarea>
                            <input type="hidden" name="offerJobID" value="'.$joinData['OfferJobID'].'">
                            <input type="hidden" name="seekerID" value="'.$joinData['SeekerID'].'">
                        </div>
                      </div>
                      <div class="card-footer">
                        '.$employmentAgreement.'
                        <button type="button" name="messageSeeker" class="btn btn-outline-success" title="Message the Seeker for updating the job">Chat</button>
                        '.$status.'
                      </div>
					';
					$dom = $dom." ".$builder;
				}
			}else{
				$dom = '
					<div class="alert alert-danger" role="alert">
					  No active agreement Forms.
					</div>
					';
			}
			$data[] = array("userDetails"=>$details,"pagination"=>$paginationDOM,"offers"=>$dom);
			$this->controller->view("passer/jobofferlist",$data);
		}

		public function searchTry(){
			$this->controller->view("passer/search");
		}	
		
	}
?>

