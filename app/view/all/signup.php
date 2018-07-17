<?php 
	require "../public/header-footer/header.marvee";
?>
	
			<div class="container-fluid">
				<div class="col d-flex justify-content-center">
					<div class="container text-center pt-5">
						<div class="col">
							<label class="pt-3 display-4 text-primary">We're glad you're here!</label>
						</div>
						<div class="col">
							<label class="pt-3 trebuchet text-secondary">First of all, what do you want to do?</label>
						</div>
					</div>
				</div>
			</div>

			<div class="container mt-5">
				<div class="row">
					<div class="col-sm shadowDiv">
						<div class="container mt-3">
							<div class="row">
								<div class="col d-flex justify-content-center">
									<img src="../../public/etc/images/system/tesda.png" id="tesdaLogoSignup">
								</div>
								<div class="col mt-2">
									<div class="container display-4 text-center">
										<label class="customTextSignup">I am a Passer</label>
									</div>
									<div class="container text-center">
										<label class="customSecondaryTextSignup">Create a passer account.</label>
									</div>
								</div>
							</div>
						</div>
						<div class="col my-5">
							<div class="d-flex justify-content-center">
								<a href="../passer/register" class="btn btn-primary btn-lg text-white">Showcase your skills now, Mate</a>
							</div>
						</div>
					</div>
					<div class="col-1 d-sm-none d-md-block">
						
					</div>
					<div class="col-sm shadowDiv">
						<div class="container mt-3">
							<div class="row">
								<div class="col d-flex justify-content-center">
									<img src="../../public/etc/images/system/seeker.png" id="tesdaLogoSignup">
								</div>
								<div class="col mt-2">
									<div class="container display-4 text-center">
										<label class="customTextSignup">I am a Seeker</label>
									</div>
									<div class="container text-center">
										<label class="customSecondaryTextSignup">Create a service seeker account.</label>
									</div>
								</div>
							</div>
						</div>
						<div class="col my-5">
							<div class="d-flex justify-content-center">
								<a href="../seeker/register" class="btn btn-success btn-lg text-white">Start to offer a job, Mate</a>
							</div>
						</div>
					</div>
				</div>
			</div>

			<div class="col mt-5">
				<div class="col-sm text-center">
					<label class="otherText">Already have an account? <span><a href="login" class="text-primary">Log In.</a></span></label>
				</div>
				<div class="col-sm text-center">
					<label class="lead terms">By creating an account you agree to our <span><a href="#" class="text-primary">	Terms and Conditions,and Privacy Policy. </a></span></label>
				</div>
			</div>
<?php 
	require "../public/header-footer/seeker/seekerFooter.marvee";
?>