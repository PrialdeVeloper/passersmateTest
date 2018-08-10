<?php 
	$offerJob = '<button type="button" class="btn btn-primary btn-block" data-toggle="modal" data-target="#offer">
				 Offer Job
				</button>';
	$messageMe = '<button type="button" class="btn btn-primary btn-block">Message Me</button>';
?>

<?php
	if(isset($data) && !empty($data)){
		extract($data[0]);
		if(isset($userDetails) && !empty($userDetails)){
			extract($userDetails[0]);
		}
	} 
	if(isset($passerStatus) && !empty($passerStatus) || isset($seekerError) && !empty($seekerError)){
		$offerJob = $messageMe = null;
	}
	require "../public/header-footer/seeker/seekerHeader.marvee";
	require "../public/header-footer/jobsNav.marvee";
	require "modal/profileModal.html";
?>
<!-- TABCONTENTS -->

<?php
// project contents
$project = 
	'
		<div class="row">
			<div class="col-sm-12 text-center pt-4 pb-3">
				<label><h3>Projects</h3></label>
			</div>
		</div>
		<div class="">
			<div class="row">
				<div class="col-sm-4 cursor  p-3 form-group ">
					<div class="border">
						<img src="../../public/etc/images/system/background1.jpg" class="modalAddDetails w-100 h-25" data-toggle="modal" data-target="#project" id="">
						<div class="p-3 justify-content-center clearfix">
							<h5>Project Title</h5>
							<small class="text-center" style="opacity: 0.5">subtitle of project</small>
						</div>
					</div>
				</div>
				<div class="col-sm-4 cursor  p-3 form-group ">
					<div class="border">
						<img src="../../public/etc/images/system/background1.jpg" class="modalAddDetails w-100 h-25" data-toggle="modal" data-target="#project" id="">
						<div class="p-3 justify-content-center clearfix">
							<h5>Project Title</h5>
							<small class="text-center" style="opacity: 0.5">subtitle of project</small>
						</div>
					</div>
				</div>
				<div class="col-sm-4 cursor  p-3 form-group ">
					<div class="border">
						<img src="../../public/etc/images/system/background1.jpg" class="modalAddDetails w-100 h-25" data-toggle="modal" data-target="#project" id="">
						<div class="p-3 justify-content-center clearfix">
							<h5>Project Title</h5>
							<small class="text-center" style="opacity: 0.5">subtitle of project</small>
						</div>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-sm-4 cursor  p-3 form-group ">
					<div class="border">
						<img src="../../public/etc/images/system/background1.jpg" class="modalAddDetails w-100 h-25" data-toggle="modal" data-target="#project" id="">
						<div class="p-3 justify-content-center clearfix">
							<h5>Project Title</h5>
							<small class="text-center" style="opacity: 0.5">subtitle of project</small>
						</div>
					</div>
				</div>
				<div class="col-sm-4 cursor  p-3 form-group ">
					<div class="border">
						<img src="../../public/etc/images/system/background1.jpg" class="modalAddDetails w-100 h-25" data-toggle="modal" data-target="#project" id="">
						<div class="p-3 justify-content-center clearfix">
							<h5>Project Title</h5>
							<small class="text-center" style="opacity: 0.5">subtitle of project</small>
						</div>
					</div>
				</div>
				<div class="col-sm-4 cursor  p-3 form-group ">
					<div class="border">
						<img src="../../public/etc/images/system/background1.jpg" class="modalAddDetails w-100 h-25" data-toggle="modal" data-target="#project" id="">
						<div class="p-3 justify-content-center clearfix">
							<h5>Project Title</h5>
							<small class="text-center" style="opacity: 0.5">subtitle of project</small>
						</div>
					</div>
				</div>
			</div>
			<div class="row justify-content-center">
				<nav aria-label="Page navigation example" class="">
					<ul class="pagination">
						<li class="page-item"><a class="page-link" href="#">Previous</a></li>
						<li class="page-item"><a class="page-link" href="#">1</a></li>
						<li class="page-item"><a class="page-link" href="#">2</a></li>
						<li class="page-item"><a class="page-link" href="#">3</a></li>
						<li class="page-item"><a class="page-link" href="#">Next</a></li>
					</ul>
				</nav>
			</div>
		</div>	
	';

// workExperience contents
$workExperience = 
	'
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
							<label>kung Unsa Iyang JobTITLE amaw man diay ko</label>
						</div>
					</div>
					<div class="row">
						<div class="col-sm-4">
							<label>Company</label>
						</div>
						<div class="col-sm-8">
							<label>kung Unsa Iyang Company amaw man diay ko</label>
						</div>
					</div>
					<div class="row">
						<div class="col-sm-4">
							<label>Contact Number</label>
						</div>
						<div class="col-sm-8">
							<label>kung Unsa Iyang ContactNumber amaw man diay ko</label>
						</div>
					</div>
					<div class="row">
						<div class="col-sm-4">
							<label>Description <small style="opacity: 0.5">(optional)</small></label>
						</div>
						<div class="col-sm-8">
							<label>kung Unsa Iyang Description amaw man diay ko</label>
						</div>
					</div>
					<div class="row">
						<div class="col-sm-4">
							<label>Date Started </label>
						</div>
						<div class="col-sm-8">
							<label>kung kanus-a Nagsugod ang tanan amaw man diay ko</label>
						</div>
					</div>
					<div class="row">
						<div class="col-sm-4">
							<label>Date Ended </label>
						</div>
						<div class="col-sm-8">
							<label>kung kanu-sa ka nagMahay amaw man diay ko</label>
						</div>
					</div>
				</div>
			</div>
		</div>	
		<div class="row justify-content-center pt-4">
			<nav aria-label="Page navigation example ">
				<ul class="pagination ">
					<li class="page-item"><a class="page-link" href="#">Previous</a></li>
					<li class="page-item"><a class="page-link" href="#">1</a></li>
					<li class="page-item"><a class="page-link" href="#">2</a></li>
					<li class="page-item"><a class="page-link" href="#">3</a></li>
					<li class="page-item"><a class="page-link" href="#">Next</a></li>
				</ul>
			</nav>
		</div>	
	';

// education contents
$education = 
	'
		<div class="row ">
			<div class="col-sm-12 text-center pt-4 pb-3">
				<label><h3>Education</h3></label>
			</div>
		</div>	
		<div class="row justify-content-center">
			<div class="card shadowDiv col-sm-10">
				<div class="card-header bg-white">
					<i class="fas fa-graduation-cap h2" style="color: darkblue;"></i>
				</div>
				<div class="card-body">
					<div class="row">
						<div class="col-sm-4">
							<label>Highest Educational Attainment</label>
						</div>
						<div class="col-sm-8">
							<label>kung Unsa Iyang Highest Education amaw man diay ko</label>
						</div>
					</div>
					<div class="row">
						<div class="col-sm-4">
							<label>School/University</label>
						</div>
						<div class="col-sm-8">
							<label>kung Unsa Iyang Skuylahan amaw man diay ko</label>
						</div>
					</div>
					<div class="row">
						<div class="col-sm-4">
							<label>Accomplishments or descriptions <small style="opacity: 0.5">(optional)</small></label>
						</div>
						<div class="col-sm-8">
							<label>kung Unsa Iyang ContactNumber amaw man diay ko</label>
						</div>
					</div>									
				</div>
			</div>
		</div>	
		<div class="row justify-content-center pt-4">
			<nav aria-label="Page navigation example ">
				<ul class="pagination ">
					<li class="page-item"><a class="page-link" href="#">Previous</a></li>
					<li class="page-item"><a class="page-link" href="#">1</a></li>
					<li class="page-item"><a class="page-link" href="#">2</a></li>
					<li class="page-item"><a class="page-link" href="#">3</a></li>
					<li class="page-item"><a class="page-link" href="#">Next</a></li>
				</ul>
			</nav>
		</div>	
	';

// 

?>
<!-- End Of TABCONTENTS -->

<!-- content -->
<div class="container-fluid my-5">
	<?=$passerStatus;?>
	<?=$seekerError;?>
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
					<div class="tab-pane container active" id="work1">
						<?=$workExperience;?>							
					</div>
					<!-- end of workExperience content -->

					<!-- educational content -->
					<div class="tab-pane container fade" id="educational1">
						<?=$education;?>
					</div>
					<!-- end of educational content -->

					<!-- accommodation content -->
					<div class="tab-pane container fade" id="accommodation1">
						<div class="row ">
							<div class="col-sm-12 text-center pt-4 pb-3">
								<label><h3>Service Accommodation</h3></label>
							</div>
						</div>
						<div class="row justify-content-center">
							<div class="card shadowDiv col-sm-10">
								<div class="card-header bg-white">
									<i class="fas fa-cog h2" style="color: darkblue;"></i>									
								</div>
								<div class="card-body">
									<div class="row">
										<div class="col-sm-4">
											<label>Onsite</label>
										</div>
										<div class="col-sm-8">
											<label>kung Unsa Iyang Onsite amaw man diay ko</label>
										</div>
									</div>
									<div class="row">
										<div class="col-sm-4">
											<label>Offsite</label>
										</div>
										<div class="col-sm-8">
											<label>kung Unsa Iyang Offsite amaw man diay ko</label>
										</div>
									</div>
																	
								</div>
							</div>
						</div>	
						<div class="row justify-content-center pt-4">
							<nav aria-label="Page navigation example ">
								<ul class="pagination ">
									<li class="page-item"><a class="page-link" href="#">Previous</a></li>
									<li class="page-item"><a class="page-link" href="#">1</a></li>
									<li class="page-item"><a class="page-link" href="#">2</a></li>
									<li class="page-item"><a class="page-link" href="#">3</a></li>
									<li class="page-item"><a class="page-link" href="#">Next</a></li>
								</ul>
							</nav>
						</div>	
					</div>
					
					<!-- end of accommodation content -->

					<!-- rate content -->
					<div class="tab-pane container fade" id="rate1">
						<div class="row ">
							<div class="col-sm-12 text-center pt-4 pb-3">
								<label><h3>Service Rate</h3></label>
							</div>
						</div>
					</div>
					<!-- end of rate content -->

					<!-- project content -->
					<div class="tab-pane container fade " id="project1">
						<?=$project;?>
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