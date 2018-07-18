<?php 
	require "../public/header-footer/header.marvee";
?>
		<div class="loading hidethis">
		</div>
     	<div class="container-fluid my-4 col-12 col-sm-6 ">
     		<form class="shadow-lg p-3 mb-5 bg-white rounded pt-3" id="passerRegister">
     			<div class="alert alert-danger text-center hidethis" id="passerRegError">
     			</div>
     			<div class="alert alert-success text-center" id="passerRegReminded">
     				Please enter your Cetificate number first
     			</div>
     		<div class="row justify-content-center  my-3 ">

     			<div class="col-12 my-2">
     				<h2 class="fs-title text-center ">Create your account as a Passer</h2>
     			</div>

     			<div class="container bg-info mb-1 text-center text-white hidethis">
     				<span>Please wait while we verify your account through TESDA</span>
     			</div>

				<div class=" col-sm-10 my-2">
					<input type="text" name="passerCOC" class="form-control" placeholder="Certificate Number">
				</div>

			    <div class="w-100"></div>

				<div class=" col-sm-5 my-2">
					<div class="container form-control disabledColor" name="passerFN">First Name</div>
					<!-- <input type="text" name="passerFN" disabled class="form-control" placeholder="First Name"> -->
				</div>

				<div class=" col-sm-5 my-2">
					<!-- <input type="text" name="passerLN" disabled class="form-control" placeholder="Last Name"> -->
					<div class="container form-control disabledColor" name="passerLN">Last Name</div>
					<!-- <div class="container form-control" id="lname"></div> -->
				</div>

			    <div class="w-100"></div>

				<div class=" col-sm-5 my-2">
					<!-- <input type="text" name="passerTitle" class="form-control" disabled value="" placeholder="Qualification Title"> -->
					<div class="container form-control disabledColor" name="passerTitle">Qualification Title</div>
				</div>
				<div class=" col-sm-5 my-2">
					<input name="expdate" required placeholder="Expiration Date" disabled class="form-control datepicker" />
				</div>
				<div class="w-100"></div>

				<div class=" col-sm-10 my-2 input-group">
					<input type="text" name="passerEmail" disabled class="form-control rounded-right" required placeholder="Email" id="passerEmailRegister">
					<div class="input-group-append hidethis" id="emailError">
					</div>	
				</div>
				<div class="w-100"></div>

				<div class=" col-sm-10 my-2 input-group">
					<input type="password" name="passerPassword" disabled class="form-control passwordField" required placeholder="Password" id="passerPasswordRegister">
					<div class="input-group-append">
						<span class="input-group-text cursor passwordShowHide"><i class="text-primary fas fa-eye"></i></span>
					</div>									
					
				</div>
				<small id="passwordHelpBlock" class="form-text text-muted hidethis pb-3">
				  Your password must contain minimum of 8 characters and atleast 1 number
				</small>
				<div class="w-100"></div>

				<div class="col-sm-10 my-2">
					<div class="col-sm">
						<div class="container">
							<h6>By registering you wil agree with PASSERSMATE <a href="#">Terms and condition</a></h6>
						</div>
					</div>
				</div>
				<div class="w-100"></div>

				<div class=" col-sm-10 my-2">
					<input type="submit" class="col btn btn-success btn-block " name="submit" value="Sign Up">
				</div>
				<div class="w-100"></div>

				<div class=" col-sm-8 my-2 text-center">
					<h6>Already have an account? <a href="../home/login">Log in</a></h6> 	
				</div>	

     		</div>
     		</form>
     	</div>
<?php 
	require "../public/header-footer/seeker/seekerFooter.marvee";
?>