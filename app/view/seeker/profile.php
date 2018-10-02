<?php
$messageMe = '<button type="button" name="messageSeeker" class="btn btn-primary btn-block">Message Me</button>';
	if(isset($data) && !empty($data)){
		extract($data[0]);
		if(isset($seekerDetails) && !empty($seekerDetails)){
			extract($seekerDetails[0]);
			if(isset($userDetails) && !empty($userDetails)){
				extract($userDetails[0]);
			}
		}
	} 
	if(!isset($_SESSION['passerUser'])){
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

<!-- content -->
<div class="container-fluid my-5">
	<!-- <?=$passerStatus;?>
	<?=$seekerError;?> -->
	<div class="alert alert-danger col text-center hidethis" id="passerProfileError" role="alert">
				
	</div>
	<!-- start of 1st row -->
	<div class="row">
		<!-- 1st box -->
		<div class="col-md-4 bg-white border border rounded mx-5 shadowDiv">
			<div class="d-flex justify-content-center">
				<img class="fluid seekerProfile rounded-circle" src="<?=$SeekerProfile;?>" alt="Profile"></img>
			</div>
			<hr>
			<div class="container">
				<div class="row pt-1">
					<div class="col-sm-1"><i class="fas fa-user ashGray"></i></div>
					<div class="col-md-auto"> <?=$SeekerFN." ".$SeekerLN;?> </div>
				</div>
				<div class="row pt-2">
					<div class="col-sm-1"><i class="fas fa-home ashGray"></i></div>
					<div class="col-md-auto"><?=isset($SeekerAddress)?$SeekerAddress:"<span class='text-muted'>Undefined</span>"?></div>
				</div>
				<div class="row pt-2 pb-5">
					<div class="col-sm-1 "><i class="fas fa-birthday-cake ashGray"></i></div>
					<div class="col-md-auto "><?=isset($SeekerBirthdate)?date("F jS, Y",strtotime($SeekerBirthdate)):"<span class='text-muted'>Undefined</span>"?></div>
					<input type="hidden" name="seekerID" value="<?php echo !empty($_GET['user'])?$_GET['user']:""; ?>">
				</div>
				<div class=" row py-5">
				<?=$messageMe?>
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
						<li class="nav-item">
							<a class="nav-link" data-toggle="tab" href="#overview">Overview</a>
						</li>
						
						<li class="nav-item">
							<a class="nav-link" data-toggle="tab" href="#review1">Reviews</a>
						</li>
					</ul>
				</div>
			</nav>
			<!-- Tab panes -->
				<div class="tab-content">
					<!-- Overview content -->
					<div class="tab-pane container scrollable-menu py-4 active" style="max-height: 600px;" id="overview">
						<div class="row ">
							<div class="col-sm-12 text-center pt-4 pb-3">
								<label><h3>Company Overview</h3></label>
							</div>
						</div>	
						<?php echo $overview; ?>
					</div>
					<!-- end of Overview content -->

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