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
	if(isset($data) && !empty($data)){
		// unset($data[0]);
		extract($data[0]);
		if(isset($userDetails) && !empty($userDetails)){
			extract($userDetails[0]);
			print_r($data);
		}
	} 
	require "../public/header-footer/seeker/seekerHeader.marvee";
	require "../public/header-footer/jobsNav.marvee";
	require "modal/dashboardModal.html";
?>
<!-- content -->
<div class="container-fluid my-5">
	<!-- start of 1st row -->
	<div class="row">
		<!-- 1st box -->
		<div class="col-md-4 bg-white border border rounded mx-5 shadowDiv">
			<div class="d-flex justify-content-center">
				<img class="fluid seekerProfile" src="../../public/etc/images/user/dashboardSample.png" alt="Profile"></img>
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
						<button type="button" class="btn btn-primary btn-block">Offer Job</button>
					</div>
					<div class="col-sm-6 ">
						<button type="button" class="btn btn-primary btn-block">Message Me</button>
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
								<button class="dropdown-item btn btn-link" data-toggle="tab" href="#accommodation1">Service Accommodation</button>
								<button class="dropdown-item btn btn-link" data-toggle="tab" href="#rate1">Service Rate</button>			
							</div>
						</li>
						<li class="nav-item">
							<a class="nav-link" data-toggle="tab" href="#project1">Projects</a>
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
					<div class="tab-pane container active bg-white" id="work1">
						<div class="scrollable-content container py-5">
							<div class="row py-4 border">
								<h6>Work Experience</h6>
							</div>
							<div class="row py-4 border">
								<h6>Educational Attainment</h6>
							</div>
							<div class="row py-4 border">
								<h6>Service Accommodation</h6>
							</div>
							<div class="row py-4 border">
								<h6>Service Rate</h6>
							</div>
							<div class="row py-4 border">
								<h6>Work Experience</h6>
							</div>
							<div class="row py-4 border">
								<h6>Educational Attainment</h6>
							</div>
							<div class="row py-4 border">
								<h6>Service Accommodation</h6>
							</div>
							<div class="row py-4 border">
								<h6>Service Rate</h6>
							</div>
							<div class="row py-4 border">
								<h6>Work Experience</h6>
							</div>
							<div class="row py-4 border">
								<h6>Educational Attainment</h6>
							</div>
							<div class="row py-4 border">
								<h6>Service Accommodation</h6>
							</div>
							<div class="row py-4 border">
								<h6>Service Rate</h6>
							</div>
							<div class="row py-4 border">
								<h6>Work Experience</h6>
							</div>
							<div class="row py-4 border">
								<h6>Educational Attainment</h6>
							</div>
							<div class="row py-4 border">
								<h6>Service Accommodation</h6>
							</div>
							<div class="row py-4 border">
								<h6>Service Rate</h6>
							</div>
						</div>					
					</div>
					<!-- end of workExperience content -->

					<!-- educational content -->
					<div class="tab-pane container fade" id="educational1">

					</div>
					<!-- end of educational content -->

					<!-- accommodation content -->
					<div class="tab-pane container fade" id="accommodation1">

					</div>
					<!-- end of accommodation content -->

					<!-- rate content -->
					<div class="tab-pane container fade" id="rate1">

					</div>
					<!-- end of rate content -->

					<!-- project content -->
					<div class="tab-pane container fade" id="project1">

					</div>
					<!-- end of project content -->

					<!-- review content -->
					<div class="tab-pane container fade" id="review1">

					</div>
					<!-- end of review content -->
				</div>

		</div>
		<!-- end of second box -->

<?php
	require "../public/header-footer/seeker/seekerFooter.marvee";
?>