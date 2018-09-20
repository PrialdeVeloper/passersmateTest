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
		extract($data[0]);
		if(isset($userDetails) && !empty($userDetails)){
			extract($userDetails[0]);
		}
	} 
	require "../public/header-footer/seeker/seekerHeader.marvee";
	require "modal/dashboardModal.html";
	require "../public/header-footer/jobsNav.marvee";
?>


<!-- content -->
<div class="container-fluid mt-5">
	<!-- status -->
	<div class="row px-5 ">
		<?=$seekerStatus;?>
	</div>
	<!-- end of status -->
	<!-- start of 1st row -->
	<div class="row">
		<!-- 1st box -->
		<div class="col-md-4 bg-white border border rounded mx-5 shadowDiv">
			<div class="d-flex justify-content-center">
				<img class="fluid seekerProfile rounded-circle" src="<?=!empty($SeekerProfile)? $SeekerProfile: '../../public/etc/images/user/dashboardSample.png'?>" alt="Profile"></img>
			</div>
			<hr>
			<div class="container">
				<div class="row pt-1">
					<div class="col-sm-1"><i class="fas fa-user ashGray"></i></div>
					<div class="col-md-auto"><?=$SeekerFN. " " .$SeekerLN;?></div>
				</div>
				<div class="row pt-2">
					<div class="col-sm-1"><i class="fas fa-home ashGray"></i></div>
					<div class="col-md-auto"><?=!empty($completeAddress)?$completeAddress:"<span class='text-muted' data-toggle='modal' data-target='#personalDetails'>Undefined</span>"?></div>
				</div>
				<div class="row pt-2">
					<div class="col-sm-1"><i class="fas fa-birthday-cake ashGray"></i></div>
					<div class="col-md-auto"><?=!empty($SeekerBirthdate)?date("F jS, Y",strtotime($SeekerBirthdate)):"<span class='text-muted' data-toggle='modal' data-target='#personalDetails'>Undefined</span>"?></div>
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
					<div class="col-md-auto"><?=$SeekerFN." ".$SeekerLN;?></div>
				</div>
				<div class="row pt-2">
					<div class="col-sm-1"><i class="fas fa-map-marker-alt"></i></div>
					<div class="col-md-auto"><?=!empty($completeAddress)?$completeAddress:"<span class='text-muted' data-toggle='modal' data-target='#personalDetails'>Undefined</span>"?></div>
				</div>
				<div class="row pt-2">
					<div class="col-sm-1"><i class="fas fa-at"></i></div>
					<div class="col-md-auto"><?=!empty($SeekerEmail)?$SeekerEmail:"<span class='text-muted' data-toggle='modal' data-target='#personalDetails'>Undefined</span>"?></div>
				</div>
				<div class="row pt-2">
					<div class="col-sm-1"><i class="fas fa-birthday-cake"></i></div>
					<div class="col-md-auto"><?=!empty($SeekerBirthdate)?date("F jS, Y",strtotime($SeekerBirthdate)):"<span class='text-muted' data-toggle='modal' data-target='#personalDetails'>Undefined</span>"?></div>
				</div>
				<div class="row pt-2">
					<div class="col-sm-1"><i class="fas fa-mobile-alt"></i></div>
					<div class="col-md-auto"><?=!empty($SeekerCPNo)?$SeekerCPNo:"<span class='text-muted' data-toggle='modal' data-target='#personalDetails'>Undefined</span>"?></div>
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
		<div class="col-md-4 bg-secondary border border rounded mx-5" id="myQuickLinks">
			<div class="row pt-2 hoverAccountSeeker">
				<div class="col-sm-1 ml-3"><i class="fas fa-user text-white"></i></div>
				<div class="col-md-auto"><label class="text-white">My Profile</label></div>
			</div>
			<div class="row pt-2 hoverAccountSeeker">
				<div class="col-sm-1 ml-3"><i class="fas fa-comments text-white"></i></div>
				<div class="col-md-auto"><label><a href="../home/messages" class="text-white">Messages</a></label></div>
			</div>
			<div class="row pt-2 hoverAccountSeeker">
				<div class="col-sm-1 ml-3"><i class="fas fa-people-carry text-white"></i></div>
				<div class="col-md-auto"><label><a href="hiredpassers" class="text-white">My Choosen Passers</a></label></div>
			</div>
			<div class="row pt-2 hoverAccountSeeker">
				<div class="col-sm-1 ml-3"><i class="fas fa-star text-white"></i></div>
				<div class="col-md-auto">
					<label class="text-white"><a href="../home/reviews" class="text-white">My Reviews and Ratings</a>
					</label>
				</div>
			</div>
			<div class="row pt-2 hoverAccountSeeker">
				<div class="col-sm-1 ml-3"><i class="fas fa-handshake text-white"></i></div>
				<div class="col-md-auto">
					<label class="text-white" id="smaller">My Agreement Records
					</label>
				</div>
			</div>
			<div class="row pt-2 hoverAccountSeeker">
				<div class="col-sm-1 ml-3"><i class="fas fa-money-bill-wave-alt text-white"></i></div>
				<div class="col-md-auto">
					<label class="text-white cursor" onclick="window.location='billing'" id="smaller">Billing
					</label>
				</div>
			</div>
		</div>
		<!-- end of 1st box 2nd row -->
		<!-- 2nd box 2nd row -->
		<div class="col offset-sm-1 border rounded bg-white mx-5 shadowDiv">
			<div class="d-flex justify-content-center mt-4">
				<label id="ashGray" class="lead text-center">
				Add your Company
				</label>
      		</div>

      		<div class="d-flex justify-content-center">
      			<div class="row pt-1">
					<div class="col-sm-auto">
						<label>PassersMate will help your company to find a trusted and skilled passer</label>
					</div>
				</div>
      		</div>
      		<hr>
      		<div class="container d-flex justify-content-center blue font-weight-bold">
      			<label class="text-center"><i class="fas fa-plus-circle"></i>&nbsp;<span>Add Company</span></label>
      		</div>
		</div>
		<!-- end of 2nd box 2nd row -->
	</div>
	<!-- end of 2nd row -->
	<!-- 3rd row -->
	<div class="row my-4 mt-5">
		<!-- start of 1st box 3rd row -->
		<div class="col-md-4 offset-sm-1 border rounded bg-white mx-5 shadowDiv" id="myQuickLinks">
			<div class="d-flex justify-content-center mt-4">
				<label id="ashGray" class="lead text-center">
				Job Offer Form
				</label>
      		</div>

      		<div class="d-flex justify-content-center">
      			<div class="row pt-1 tex">
					<div class="col">
						<label>This will be the job form that you will offer to your chosen passer, Mate </label>
					</div>
				</div>
      		</div>
      		<hr>
      		<div class="container d-flex justify-content-center blue  font-weight-bold">
      			<div class="col-md-auto"><label><a href="jobOfferform"><i class="fas fa-plus-circle"></i>&nbsp;<span>Add your <abbr title="Add Job Offer form for your compliance">JO Form(s)</abbr></span></a></label></div>
      		</div>
		</div>
		<!-- end of 1st box 3rd row -->
		<!-- start of 2nd box 3rd row -->
	<div class="col offset-sm-1 border rounded bg-white mx-5 shadowDiv">
		<div class="container mt-4 text-center">
			<label id="ashGray" class="lead text-center">
			Your Action awaits, Mate!
			</label>
  		</div>

  		<div class="d-flex justify-content-center">
  			<div class="row pt-1 ">
				<div class="col-sm-auto">
					<label>Pending Actions</label>
				</div>
			</div>
  		</div>

      	<div class="table-responsive-xl row mt-1">
      		<table class="table table-striped">
      			<thead class="skyblue text-white">
      				<tr>
      					<th>Image</th>
      					<th>Passers Name</th>
      					<th>Job Title</th>
      					<th>Start Date</th>
      					<th>End Date</th>
      					<th>Action</th>
      				</tr>
      			</thead>
      			<tbody>
      				<tr>
      					<td class="pt-5">
      						<img class="img-fluid tableImage" src="../../public/etc/images/user/marvee.jpg" alt="image">
      					</td>
      					<td class="pt-5">
      						<?=$Name;?>
      					</td>
      					<td class="pt-5">
      						<?=$jtitle;?>
      					</td>
      					<td class="pt-5">
      						<?=$sd;?>
      					</td>
      					<td class="pt-5">
      						<?=$ed;?>
      					</td>
      					<td>
  							<div class="row">
  								<button class="btn btn-outline-success" data-toggle="modal" data-target="#jobDone">Job Done</button>
  							</div>
  							<div class="row pt-1">
  								<button class="btn btn-outline-danger" data-toggle="modal" data-target="#dispute">Dispute</button>
  							</div>
      					</td>
      				</tr>
      			</tbody>
      		</table>
      	</div>
	</div>
	<!-- end of 2nd box 3rd row -->
	</div>
	<!-- end of 3rd row -->
</div>


<!-- content -->
<?php
	require "../public/header-footer/seeker/seekerFooter.marvee";
?>