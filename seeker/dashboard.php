<?php 
	require "../header-footer/seekerHeader.marvee";
?>
<?php 
$Name = 'Marvee Franco';
$address = 'Sitio Gines (Wak Wak)';
$birthdate = 'August 01, 1522';
$contact = '126-2634-252';
$jtitle = "Asawa";
$sd = "Nov 6, 2017";
$ed = "Infinty";
?>
<!-- jobs -->
<div class="mt-4 d-flex justify-content-center">
	<nav class="navbar navbar-expand-md navbar-light bg-white p-0" role="navigationWorks">
			<button type="button" class="navbar-toggler" data-target="#navWorks" data-toggle="collapse">
				<span class="navbar-toggler-icon"></span>
			</button>
			<div class="collapse navbar-collapse" id="navWorks">
				<ul class="nav navbar-nav text-center">
					<li class="navbar-item pr-5">
						<a class="navbar-link text-dark" href="#">
							Arts & Multimedia
						</a>
					</li>
					<li class="navbar-item pr-5">
						<a class="navbar-link text-dark" href="#">
							Information Technology
						</a>
					</li>
					<li class="navbar-item pr-5">
						<a class="navbar-link text-dark" href="#">
							Carpentry, Engineering & Automotive
						</a>
					</li>
					<li class="navbar-item pr-5">
						<a class="navbar-link text-dark" href="#">
							Lifestyle & Entertainment
						</a>
					</li>
					<li class="navbar-item" id="navigationWorks">
						<a class="navbar-link text-dark" href="#">
							Others
						</a>
					</li>
				</ul>	
			</div>
		</nav>
</div>

<!-- jobs -->

<!-- content -->
<div class="container-fluid mt-5">
	<!-- start of 1st row -->
	<div class="row">
		<!-- 1st box -->
		<div class="col bg-white border border rounded mx-5 shadowDiv" id="shortInfo">
			<div class="d-flex justify-content-center">
				<img class="fluid seekerProfile" src="../etc/images/user/dashboardSample.png" alt="Profile"></img>
			</div>
			<hr>
			<div class="container">
				<div class="row pt-1">
					<div class="col-sm-1"><i class="fas fa-user ashGray"></i></div>
					<div class="col-md-auto"><?=$Name;?></div>
				</div>
				<div class="row pt-2">
					<div class="col-sm-1"><i class="fas fa-home ashGray"></i></div>
					<div class="col-md-auto"><?=$address;?></div>
				</div>
				<div class="row pt-2">
					<div class="col-sm-1"><i class="fas fa-birthday-cake ashGray"></i></div>
					<div class="col-md-auto"><?=$birthdate;?></div>
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
      			<span><i class="fas fa-plus-circle"></i></span>&nbsp;<label>Add Personal Details</label>
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
				<div class="col-md-auto"><label class="text-white">Messages</label></div>
			</div>
			<div class="row pt-2 hoverAccountSeeker">
				<div class="col-sm-1 ml-3"><i class="fas fa-people-carry text-white"></i></div>
				<div class="col-md-auto"><label class="text-white">My Choosen Partners</label></div>
			</div>
			<div class="row pt-2 hoverAccountSeeker">
				<div class="col-sm-1 ml-3"><i class="fas fa-star text-white"></i></div>
				<div class="col-md-auto"><label class="text-white">My Reviews and Ratings</label></div>
			</div>
			<div class="row pt-2 hoverAccountSeeker">
				<div class="col-sm-1 ml-3"><i class="fas fa-handshake text-white"></i></div>
				<div class="col-md-auto"><label class="text-white">My Employement Agreement Records</label></div>
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
						<label">PassersMate will help your company to find a trusted and skilled passer</label>
					</div>
				</div>
      		</div>
      		<hr>
      		<div class="container d-flex justify-content-center blue font-weight-bold">
      			<span><i class="fas fa-plus-circle"></i></span>&nbsp;<label>Add Company</label>
      		</div>
		</div>
		<!-- end of 2nd box 2nd row -->
	</div>
	<!-- end of 2nd row -->
	<!-- 3rd row -->
	<div class="row my-4">
		<!-- start of 1st box 3rd row -->
		<div class="col-md-4 offset-sm-1 border rounded bg-white mx-5 shadowDiv" id="myQuickLinks">
			<div class="d-flex justify-content-center mt-4">
				<label id="ashGray" class="lead text-center">
				Job Offer Form
				</label>
      		</div>

      		<div class="d-flex justify-content-center">
      			<div class="row pt-1">
					<div class="col-sm-auto">
						<label">This will be the job form that you will offer to your chosen passer, Mate </label>
					</div>
				</div>
      		</div>
      		<hr>
      		<div class="container d-flex justify-content-center blue font-weight-bold">
      			<span><i class="fas fa-plus-circle"></i></span>&nbsp;<label>Add your <abbr title="Add Job Offer form for your compliance">JO Form(s)</abbr></label>
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
						<label">Pending Actions</label>
					</div>
				</div>
      		</div>

	      	<div class="row mt-1">
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
	      						<img class="tableImage" src="../etc/images/user/marvee.jpg">
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
	      						<div class="container-fluid">
	      							<div class="row">
	      								<button class="btn btn-outline-success">Job Done</button>
	      							</div>
	      							<div class="row">
	      								<button class="btn btn-outline-danger">Job Done</button>
	      							</div>
	      						</div>
	      					</td>
	      				</tr>
	      				<tr>
	      					<td class="pt-5">
	      						<img class="fluid tableImage" src="../etc/images/user/marvee.jpg">
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
	      						<div class="container-fluid">
	      							<div class="row">
	      								<button class="btn btn-outline-success">Job Done</button>
	      							</div>
	      							<div class="row">
	      								<button class="btn btn-outline-danger">Job Done</button>
	      							</div>
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
	require "../header-footer/seekerFooter.marvee";
?>