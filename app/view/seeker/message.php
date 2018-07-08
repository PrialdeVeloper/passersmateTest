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
	// require "modal/dashboardModal.html";
	require "../header-footer/jobsNav.marvee";
?>


<!-- content -->
<!-- 1st div -->
<div class="container-fluid mt-5 border">
	<!-- 1st row -->
	<div class="row">
		<!-- 1st content -->
		<div class="col-md-4 offset-sm-1" id="shortInfo">
			<!-- 1st box -->
			<div class="container bg-white border border rounded mx-auto shadowDiv">
				<div class="d-flex justify-content-center">
					<img class="fluid seekerProfile" src="../etc/images/user/dashboardSample.png" alt="Profile">
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
			<!-- end of 1st box -->
			<!-- 2nd box -->
			<div class="container shadowDiv mt-4 bg-secondary rounded">
				<div class="row pt-2 hoverAccountSeeker">
					<div class="col-sm-1 ml-3"><i class="fas fa-user text-white"></i></div>
					<div class="col-md-auto"><label class="text-white">My Profile</label></div>
				</div>
				<div class="row pt-2 hoverAccountSeeker">
					<div class="col-sm-1 ml-3"><i class="fas fa-comments text-white"></i></div>
					<div class="col-md-auto"><label><a href="message.php" class="text-white">Messages</a></label></div>
				</div>
				<div class="row pt-2 hoverAccountSeeker">
					<div class="col-sm-1 ml-3"><i class="fas fa-people-carry text-white"></i></div>
					<div class="col-md-auto"><label><a href="messages.php" class="text-white">My Choosen Partners</a></label></div>
				</div>
				<div class="row pt-2 hoverAccountSeeker">
					<div class="col-sm-1 ml-3"><i class="fas fa-star text-white"></i></div>
					<div class="col-md-auto">
						<label class="text-white" data-toggle="modal" data-target="#reviewAndRating">My Reviews and Ratings
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
			</div>
			<!-- end of 2nd box-->
		</div>
		<!-- end of 1st content -->
	</div>
	<div class="container-fluid">
		<div class="row">
			<div class="justify-content-end">
				<div class="col-lg-auto offset-lg-5">
					Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
					tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
					quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
					consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
					cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
					proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
				</div>
		</div>
		</div>
	</div>
	<!-- end of 1st row -->
</div>
<!-- end of 1st div -->
<!-- content -->
<?php
	// require "../header-footer/seeker/seekerFooter.marvee";
?>