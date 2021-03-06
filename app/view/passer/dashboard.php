<?php
	$completeAddress = null;
	if(isset($data) && !empty($data)){
		extract($data[0]);
		if(isset($userDetails) && !empty($userDetails)){
			extract($userDetails[0]);
		}
	} 

	require "../public/header-footer/seeker/seekerHeader.marvee";
	require "../public/header-footer/jobsNav.marvee";
	require "modal/dashboardModal.html";

	// echo html_entity_decode($PasserCertificate);
?>
<!-- content -->
<div class="container-fluid mt-5">
	<!-- start of 1st row -->
	<div class="row px-5 ">
		<?=$userStatus;?>
	</div>
	<div class="row">
		<!-- 1st box -->
		<div class="col-md-4 bg-white border border rounded mx-5 shadowDiv">
			<div class="d-flex align-items-center justify-content-center">
				<img class="fluid seekerProfile rounded-circle" src="<?=!empty($PasserProfile)? $PasserProfile: '../../public/etc/images/user/dashboardSample.png'?>" alt="Profile"></img>
			</div>
			<hr>
			<div class="container">
				<div class="row pt-1">
					<div class="col-sm-1"><i class="fas fa-user ashGray"></i></div>
					<div class="col-md-auto"><?=$PasserFN." ". $PasserMname .". ".$PasserLN;?></div>
				</div>
				<div class="row pt-2">
					<div class="col-sm-1"><i class="fas fa-home ashGray"></i></div>
					<div class="col-md-auto"><?=!empty($completeAddress)?$completeAddress:"<span class='text-muted' data-toggle='modal' data-target='#personalDetails'>Undefined</span>"?></div>
				</div>
				<div class="row pt-2">
					<div class="col-sm-1"><i class="fas fa-birthday-cake ashGray"></i></div>
					<div class="col-md-auto"><?=!empty($PasserBirthdate)?date("F jS, Y",strtotime($PasserBirthdate)):"<span class='text-muted' data-toggle='modal' data-target='#personalDetails'>Undefined</span>"?></div>
				</div>
			</div>
		</div>
		<!-- end of firstbox -->
		<!-- second box -->
		<div class="col offset-sm-1 border rounded bg-white mx-5 shadowDiv">
			<div class="d-flex justify-content-center mt-4">
				<label id="ashGray" class="lead">
				Personal Details
				</label>
      		</div>

      		<div class="container">
      			<div class="row pt-1">
					<div class="col-sm-1"><i class="fas fa-id-card-alt"></i></div>
					<div class="col-md-auto"><?=$PasserFN." ". $PasserMname .". ".$PasserLN;?></div>
				</div>
				<div class="row pt-2">
					<div class="col-sm-1"><i class="fas fa-map-marker-alt"></i></div>
					<div class="col-md-auto"><?=!empty($completeAddress)?$completeAddress:"<span class='text-muted' data-toggle='modal' data-target='#personalDetails'>Undefined</span>"?></div>
				</div>
				<div class="row pt-2">
					<div class="col-sm-1"><i class="fas fa-at"></i></div>
					<div class="col-md-auto"><?=!empty($PasserEmail)?$PasserEmail:"<span class='text-muted' data-toggle='modal' data-target='#personalDetails'>Undefined</span>"?></div>
				</div>
				<div class="row pt-2">
					<div class="col-sm-1"><i class="fas fa-birthday-cake"></i></div>
					<div class="col-md-auto"><?=!empty($PasserBirthdate)?date("F jS, Y",strtotime($PasserBirthdate)):"<span class='text-muted' data-toggle='modal' data-target='#personalDetails'>Undefined</span>"?></div>
				</div>
				<div class="row pt-2">
					<div class="col-sm-1"><i class="fas fa-mobile-alt"></i></div>
					<div class="col-md-auto"><?=!empty($PasserCPNo)?$PasserCPNo:"<span class='text-muted' data-toggle='modal' data-target='#personalDetails'>Undefined</span>"?></div>
				</div>
      		</div>
      		<hr>
      		<div class="container d-flex justify-content-center blue font-weight-bold">
      			<label class="text-center"  data-toggle="modal" data-target="#personalDetails"><i class="fas fa-plus-circle"></i>&nbsp;<span>Update Personal Details</span></label>
      		</div>
		</div>
		<!-- end of second box -->
	</div>
	<!-- end of 1st row -->

	<!-- 2nd row -->
	<div class="row mt-4">
		<!-- start of 1st box 2nd row -->
		<div class="col-md-4 bg-secondary border border rounded mx-5 h-auto">
			<div class="row pt-2 hoverAccountSeeker">
				<div class="col-sm-1 ml-3"><i class="fas fa-user text-white"></i></div>
				 <div class="col-md-auto"><label><a href="profile?user=<?=$PasserCOCNo;?>" class="text-white"> My Profile</a></label></div>
			</div>
			<div class="row pt-2 hoverAccountSeeker">
				<div class="col-sm-1 ml-3"><i class="fas fa-comments text-white"></i></div>
				<div class="col-md-auto"><label><a href="../home/messages" class="text-white">Messages</a></label></div>
			</div>
			<div class="row pt-2 hoverAccountSeeker">
				<div class="col-sm-1 ml-3"><i class="fas fa-briefcase text-white"></i></div>
				<div class="col-md-auto"><label><a href="joboffers" class="text-white">My Job Offers</a></label></div>
			</div>
			<div class="row pt-2 hoverAccountSeeker">
				<div class="col-sm-1 ml-3"><i class="fas fa-star text-white"></i></div>
				<div class="col-md-auto">
					<a class="text-white" href="../home/reviews">My Reviews and Ratings
					</a>
				</div>
			</div>
			<div class="row pt-2 hoverAccountSeeker">
				<div class="col-sm-1 ml-3"><i class="fas fa-history text-white"></i></div>
				<div class="col-md-auto">
					<a class="text-white" href="../home/transactionhistory">Transaction History
					</a>
				</div>
			</div>
		</div>
		<!-- end of 1st box 2nd row -->
		<!-- 2nd box 2nd row -->
		<div class="col offset-sm-1 border rounded bg-white mx-5 shadowDiv">
			<div class="d-flex justify-content-center mt-4">
				<label id="ashGray" class="lead text-center">
					Work experience
				</label>
      		</div>

      		<div class="d-flex justify-content-center">
      			<div class="row pt-1">
					<div class="col-sm-auto">
						<label class="text-center">Add all your job experience. Seekers wants to know what you accomplished, Mate!</label>
					</div>

					<div class="col">
						<ul class="nav justify-content-center">
							<li class="nav-item dropdown dashedBorder text-center">								
								<button class=" btn btn-link dropdown-toggle textDecorationNone" type="button" data-toggle="dropdown" data-submenu>
						        	Click Here 
						    	</button><label class="text-center">to Edit your work experiences.</label>
								<div class="dropdown-menu scrollable-menu" role="menu">
									<button class="dropdown-item btn btn-link" data-toggle="modal" data-toggle="tab" href="#withData">Work Experience</button>
									<button class="dropdown-item btn btn-link" data-toggle="tab" href="#educational1">Educational</button>
									<button class="dropdown-item btn btn-link" data-toggle="tab" href="#accommodation1">Service Accommodation</button>
									<button class="dropdown-item btn btn-link" data-toggle="tab" href="#rate1">Service Rate</button>	

												
								</div>
							</li>	
						</ul>		
					</div>
					
				</div>
      		</div>
      		<hr>
      		<div class="container d-flex justify-content-center blue font-weight-bold">
      			<label class="text-center"  data-toggle="modal" data-target="#jobExperience"><i class="fas fa-plus-circle"></i>&nbsp;<span>Add Job Experience</span></label>
      		</div>
		</div>
		<!-- end of 2nd box 2nd row -->
	</div>
	<!-- end of 2nd row -->
	<!-- 3rd row -->
	<div class="row my-4">
		<!-- start of 1st box 3rd row -->
		<div class="col-md-4 offset-sm-1 border rounded bg-white mx-5 shadowDiv h-auto">
			<div class="d-flex justify-content-center mt-4">
				<label id="ashGray" class="lead text-center">
				Miscellaneous
				</label>
      		</div>
      		<div class="container-fluid">
				<div class="row pt-1 border-bottom pt-3">
					<div class="col-sm-1"><i class="fas fa-briefcase"></i></div>
					<div class="col-md-auto"><span data-toggle="modal" data-target="#myJobs">My Job Records in PM</span></div>
				</div>
				<div class="row pt-1 border-bottom pt-3">
					<div class="col-sm-1"><i class="fas fa-hand-holding-usd"></i></div>
					<div class="col-md-auto"><span data-toggle="modal" data-target="#serviceRate">My Service Rate</span></div>
				</div>
				<div class="row pt-1 border-bottom pt-3">
					<div class="col-sm-1"><i class="fas fa-handshake"></i></div>
					<div class="col-md-auto"><label><a href="agreementRecord?user=<?=$PasserCOCNo;?>" class="text-dark">Employment Agreement Record</a></label></div>
					<!-- <div class="col-md-auto"><span data-toggle="modal" data-target="#agreementRecord">Employement Agreement Record</span></div> -->
				</div>
				<div class="row pt-1 border-bottom pt-3">
					<div class="col-sm-1"><i class="fas fa-file-alt"></i></div>
					<div class="col-md-auto"><span data-toggle="modal" data-target="#COE">Request for <abbr title="Certificate of Employement">COE</abbr></span></div>
				</div>
      		</div>
		</div>
		<!-- end of 1st box 3rd row -->
		<!-- start of 2nd box 3rd row -->
	<div class="col offset-sm-1 border rounded bg-white mx-5 shadowDiv">
		<div class="d-flex justify-content-center mt-4">
			<label id="ashGray" class="lead text-center">
			Education
			</label>
		</div>
		<div class="d-flex justify-content-center">
			<div class="row pt-1">
				<div class="col-sm-auto">
					<label class="text-center">Add your educational attainment</label>
				</div>
			</div>
		</div>
		<hr>
		<div class="container d-flex justify-content-center blue font-weight-bold">
			<label class="text-center" data-toggle="modal" data-target="#education"><i class="fas fa-plus-circle"></i>&nbsp;<span>Add Education</span></label>
		</div>
	</div>
	<!-- end of 2nd box 3rd row -->
	</div>
	<!-- end of 3rd row -->

	<!-- 4th row -->
	
	<!-- end of 4th row -->
</div>

<!-- content -->
<?php
	require "../public/header-footer/passer/passerFooter.marvee";
?>