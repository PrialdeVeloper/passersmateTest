<?php 
	$offerJob = '<button type="button" class="btn btn-primary btn-block" data-toggle="modal" data-target="#offer">
				 Offer Job
				</button>';
	$messageMe = '<button type="button" id="chatPasser" class="btn btn-primary btn-block">Message Me</button>';
?>

<?php
	if(isset($data) && !empty($data)){
		extract($data[0]);
		if(isset($passerDetails) && !empty($passerDetails)){
			extract($passerDetails[0]);
			if(isset($userDetails) && !empty($userDetails)){
				extract($userDetails[0]);
			}
		}
	} 
	if(isset($passerStatus) && !empty($passerStatus) || isset($seekerError) && !empty($seekerError)){
		$offerJob = $messageMe = null;
	}
	if(!empty($userDetails)){
		require_once "../public/header-footer/seeker/seekerHeader.marvee";
	}else{
		require "../public/header-footer/header.marvee";
	}
	require "../public/header-footer/jobsNav.marvee";
	require "modal/profileModal.html";
?>
<!-- TABCONTENTS -->

<?php
// education contents

// 

?>
<!-- End Of TABCONTENTS -->

<!-- content -->
<div class="container-fluid my-5">
	<?=$passerStatus;?>
	<?=$seekerError;?>
	<div class="alert alert-danger col text-center hidethis" id="passerProfileError" role="alert">
				
	</div>
	<!-- start of 1st row -->
	<div class="row">
		<!-- 1st box -->
		<div class="col-md-4 bg-white border border rounded mx-5 shadowDiv">
			<div class="d-flex justify-content-center">
				<img class="fluid seekerProfile rounded-circle" src="<?=$PasserProfile;?>" alt="Profile"></img>
			</div>
			<hr>
			<div class="container">
				<div class="row pt-1">
					<div class="col-sm-1"><i class="fas fa-user ashGray"></i></div>
					<div class="col-md-auto"><?=$PasserFN." ". $PasserMname .". ".$PasserLN;?></div>
				</div>
				<div class="row pt-2">
					<div class="col-sm-1"><i class="fas fa-home ashGray"></i></div>
					<div class="col-md-auto"><?=isset($PasserAddress)?$PasserAddress:"<span class='text-muted'>Undefined</span>"?></div>
				</div>
				<div class="row pt-2 pb-5">
					<div class="col-sm-1 "><i class="fas fa-birthday-cake ashGray"></i></div>
					<div class="col-md-auto "><?=isset($PasserBirthdate)?date("F jS, Y",strtotime($PasserBirthdate)):"<span class='text-muted'>Undefined</span>"?></div>
				</div>
				<div class=" row py-5">
					
				</div>
				<div class=" row py-5">
					
				</div>

				<div class="row pt-5">
					<div class="col-sm-6 ">
						<?=$offerJob?>
					</div>
					<div class="col-sm-6 ">
						<?=$messageMe?>
					</div>
				</div>
			</div>
		</div>
		<!-- end of firstbox -->

		<!-- second box -->
		<div class="col offset-sm-1 border rounded bg-white mx-5 shadowDiv">
			<nav class="navbar navbar-expand-md navbar-light bg-white p-0" role="navigationWorks">
				<button type="button" class="navbar-toggler" data-target="#navTabs" data-toggle="collapse">
					<span class="navbar-toggler-icon"></span>
				</button>
				<div class="collapse navbar-collapse" id="navTabs"">
					<ul class="nav nav-tabs justify-content-center">
						<li class="nav-item dropdown">
							<button class="btn btn-link dropdown-toggle" type="button" data-toggle="dropdown" data-submenu>
					        	Profile
					    	</button>
							<div class="dropdown-menu scrollable-menu" role="menu">
								<button class="dropdown-item btn btn-link" data-toggle="tab" href="#work1">Work Experience</button>
								<button class="dropdown-item btn btn-link" data-toggle="tab" href="#educational1">Educational</button>
								<button class="dropdown-item btn btn-link" data-toggle="tab" href="#rate1">Service Rate</button>			
							</div>
						</li>
						
						<li class="nav-item">
							<a class="nav-link" data-toggle="tab" href="#review1">Reviews</a>
						</li>
					</ul>
				</div>
			</nav>
			<!-- Tab panes -->
				<div class="tab-content">
					<!-- workExperience content -->
					<div class="tab-pane container active" id="work1">
						<?=$workHistory;?>							
					</div>
					<!-- end of workExperience content -->

					<!-- educational content -->
					<div class="tab-pane container fade scrollable-menu py-4" style="max-height: 600px;" id="educational1">
						<?=$education;?>
					</div>
					<!-- end of educational content -->

					

					<!-- rate content -->
					<div class="tab-pane container fade" id="rate1">
						<?php echo $serviceFee; ?>
					</div>
					<!-- end of rate content -->

					<!-- review content -->
					<div class="tab-pane container fade scrollable-menu py-4" style="max-height: 600px;" id="review1">
						<?php echo $reviews; ?>
					</div>
					<!-- end of review content -->
				</div>

		</div>
		<!-- end of second box -->

<?php
	require "../public/header-footer/seeker/seekerFooter.marvee";
?>