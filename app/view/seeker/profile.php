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
	require "../header-footer/seeker/seekerHeader.marvee";
	require "../header-footer/jobsNav.marvee";
?>


<!-- content -->
<div class="container-fluid mt-5">
	<!-- start of 1st row -->
	<div class="row">
		<!-- 1st box -->
		<div class="col-md-4 bg-white border border rounded mx-5 shadowDiv">
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
				<hr>
				<div class="row justify-content-center pt-3">
					<div class="col-md-auto">
						<button type="button" class="btn btn-success">Message Me Now!</button>
					</div>
				</div>
			</div>
		</div>
		<!-- end of firstbox -->
		<!-- second box -->
		<div class="col offset-sm-1 bg-white mx-5 shadowDiv">
			<ul class="nav nav-tabs pt-1">
			  <li class="nav-item">
			    <a class="nav-link active" href="#"><b>Profile</b></a>
			  </li>
			  <li class="nav-item">
			    <a class="nav-link" href="#"><b>Reviews</b></a>
			  </li>
			</ul>
			<div class="container shadowDiv mt-3">
				<div class="text-center">
					<label class="profileTitle"><i class="green fas fa-briefcase"></i><span class="pl-3 lead">Company</span></label>
				</div>
				<div>
					<hr>
				</div>
				<div class="text-center">
					Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
					tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
					quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
					consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
					cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
					proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
				</div>
			</div>
		</div>
		<!-- end of second box -->
	</div>
	<!-- end of 1st row -->
</div>


<!-- content -->
<?php
	require "../header-footer/seeker/seekerFooter.marvee";
?>