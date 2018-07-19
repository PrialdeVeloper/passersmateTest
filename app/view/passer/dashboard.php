<?php 
$Name = 'Marvee Franco';
$address = 'Sitio Gines (Wak Wak)';
$birthdate = 'August 01, 1522';
$contact = '126-2634-252';
$jtitle = "Asawa";
$sd = "Nov 6, 2017";
$ed = "Infinty";
$reviewer = "Pablo";
$rate = "Very Good!";
?>
<?php
	$completeAddress = null;
	if(isset($data) && !empty($data)){
		// unset($data[0]);
		extract($data[0]);
		if(isset($userDetails) && !empty($userDetails)){
			extract($userDetails[0]);
			print_r($data);
		}
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
	require "../public/header-footer/seeker/seekerHeader.marvee";
	require "../public/header-footer/jobsNav.marvee";
	require "modal/dashboardModal.html";

	// echo html_entity_decode($PasserCertificate);
?>
<!-- content -->
<div class="container-fluid mt-5">
	<!-- start of 1st row -->
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
					<div class="col-md-auto"><?=$Name;?></div>
				</div>
				<div class="row pt-2">
					<div class="col-sm-1"><i class="fas fa-map-marker-alt"></i></div>
					<div class="col-md-auto"><?=$address;?></div>
				</div>
				<div class="row pt-2">
					<div class="col-sm-1"><i class="fas fa-mobile-alt"></i></div>
					<div class="col-md-auto"><?=$contact;?></div>
				</div>
				<div class="row pt-2">
					<div class="col-sm-1"><i class="fas fa-mobile-alt"></i></div>
					<div class="col-md-auto"><?=$contact;?></div>
				</div>
				<div class="row pt-2">
					<div class="col-sm-1"><i class="fas fa-mobile-alt"></i></div>
					<div class="col-md-auto"><?=$contact;?></div>
				</div>
				<div class="row pt-2">
					<div class="col-sm-1"><i class="fas fa-mobile-alt"></i></div>
					<div class="col-md-auto"><?=$contact;?></div>
				</div>
      		</div>
      		<hr>
      		<div class="container d-flex justify-content-center blue font-weight-bold">
      			<label class="text-center"  data-toggle="modal" data-target="#personalDetails"><i class="fas fa-plus-circle"></i>&nbsp;<span>Add Personal Details</span></label>
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
				 <div class="col-md-auto"><label><a href="profile" class="text-white"> My Profile</a></label></div>
			</div>
			<div class="row pt-2 hoverAccountSeeker">
				<div class="col-sm-1 ml-3"><i class="fas fa-comments text-white"></i></div>
				<div class="col-md-auto"><label><a href="message.php" class="text-white">Messages</a></label></div>
			</div>
			<div class="row pt-2 hoverAccountSeeker">
				<div class="col-sm-1 ml-3"><i class="fas fa-briefcase text-white"></i></div>
				<div class="col-md-auto"><label><a href="messages.php" class="text-white">My Projects</a></label></div>
			</div>
			<div class="row pt-2 hoverAccountSeeker">
				<div class="col-sm-1 ml-3"><i class="fas fa-star text-white"></i></div>
				<div class="col-md-auto">
					<label class="text-white" data-toggle="modal" data-target="#reviewAndRating">My Reviews and Ratings
					</label>
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
				Skills
				</label>
      		</div>

      		<div class="container">
      			<div class="row pt-1">
					<div class="col">
						<div class="col">
							<div class="row">
								<div class="container-fluid">
									<label class="bg-dark text-white w-auto text-center">Marvee</label>
									<label class="bg-dark text-white w-auto text-center">Dakug</label>
									<label class="bg-dark text-white w-auto text-center">Nawng</label>
									<label class="bg-dark text-white w-auto text-center">Gwapa</label>
								</div>
							</div>
						</div>
					</div>
				</div>
      		</div>
      		<hr>
      		<div class="d-flex justify-content-center blue font-weight-bold">
      			<label class="text-center" data-toggle="modal" data-target="#JOFormModal"><i class="fas fa-plus-circle"></i>&nbsp;<span>Add your skills</span></label>
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
	<div class="row my-4">
		<!-- start of 1st box 4th row -->
		<div class="col-md-4 offset-sm-1 border rounded bg-white mx-5 shadowDiv h-auto">
			<div class="d-flex justify-content-center mt-4">
				<label id="ashGray" class="lead text-center">
				Miscellaneous
				</label>
      		</div>
      		<div class="container-fluid">
      			<div class="row pt-1 border-bottom">
					<div class="col-sm-1"><i class="far fa-eye"></i></div>
					<div class="col-md-auto">Preview Profile</div>
				</div>
				<div class="row pt-1 border-bottom pt-3">
					<div class="col-sm-1"><i class="fas fa-briefcase"></i></div>
					<div class="col-md-auto"><span data-toggle="modal" data-target="#myJobs">My Jobs</span></div>
				</div>
				<div class="row pt-1 border-bottom pt-3">
					<div class="col-sm-1"><i class="fas fa-hand-holding-usd"></i></div>
					<div class="col-md-auto"><span data-toggle="modal" data-target="#serviceRate">My Service Rate</span></div>
				</div>
				<div class="row pt-1 border-bottom pt-3">
					<div class="col-sm-1"><i class="fas fa-handshake"></i></div>
					<div class="col-md-auto">Employement Agreement Record</div>
				</div>
				<div class="row pt-1 border-bottom pt-3">
					<div class="col-sm-1"><i class="fas fa-file-alt"></i></div>
					<div class="col-md-auto"><span data-toggle="modal" data-target="#COE">Request for <abbr title="Certificate of Employement">COE</abbr></span></div>
				</div>
      		</div>
		</div>
		<!-- end of 1st box 4th row -->
		<!-- start of 2nd box 4th row -->
	<div class="col offset-sm-1 border rounded bg-white mx-5 shadowDiv">
		<div class="d-flex justify-content-center mt-4">
			<label id="ashGray" class="lead text-center">
			Service Accommodation
			</label>
		</div>
		<div class="d-flex justify-content-center">
			<div class="row pt-1">
				<div class="col-sm-auto">
					<label class="text-center">Add all your service criteria, Mate! </label>
				</div>
			</div>
		</div>
		<hr>
		<div class="container d-flex justify-content-center blue font-weight-bold">
			<label class="text-center"><i class="fas fa-plus-circle"></i>&nbsp;<span>Add accommodation</span></label>
		</div>
	</div>
	<!-- end of 2nd box 4th row -->
	</div>
	<!-- end of 4th row -->
</div>




<!-- content -->
<?php
	require "../public/header-footer/passer/passerFooter.marvee";
?>