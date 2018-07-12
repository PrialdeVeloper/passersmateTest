<?php 
	require "../public/header-footer/header.marvee";
?>
		<div class="loading hidethis">
			<span class="centerDisplayText">
				Please Wait..
			</span>
		</div>
     	<div class="container-fluid my-4 col-12 col-sm-6 ">
     		<form class="shadow-lg p-3 mb-5 bg-white rounded pt-3" id="passerRegister">
     		<div class="row justify-content-center  my-3 ">

     			<div class="col-12 my-2">
     				<h2 class="fs-title text-center ">Create your account as a Passer</h2>
     			</div>

     			<div class="container bg-info mb-1 text-center text-white hidethis">
     				<span>Please wait while we verify your account through TESDA</span>
     			</div>

				<div class=" col-sm-5 my-2">
					<input type="number" name="passerCOC" class="form-control" placeholder="Certificate Number">
				</div>

			    <div class=" col-sm-5 my-2">
				    <select name="passerCertification" class="form-control">
				        <option>Type of Certificate</option>
				        <option value="NC I">NC I</option>
				        <option value="NC II">NC II</option>
				        <option value="NC III">NC III</option>
				        <option value="COC">COC</option>
				    </select>
			    </div>

			    <div class="w-100"></div>

				<div class=" col-sm-5 my-2">
					<input type="text" name="passerFN" disabled class="form-control" placeholder="First Name">
				</div>

				<div class=" col-sm-5 my-2">
					<input type="text" name="passerLN" disabled class="form-control" placeholder="Last Name">
					<!-- <div class="container form-control" id="lname"></div> -->
				</div>

			    <div class="w-100"></div>

				<div class=" col-sm-5 my-2">
					<input type="text" name="passerTitle" class="form-control" disabled value="" placeholder="Qualification Title">
				</div>
				<div class=" col-sm-5 my-2">
					<input name="expdate" placeholder="Expiration Date" disabled class="form-control datepicker" />
				</div>
				<div class="w-100"></div>

				<div class=" col-sm-10 my-2">
					<input type="text" name="email" class="form-control" placeholder="Email">
				</div>
				<div class="w-100"></div>

				<div class=" col-sm-10 my-2 input-group">
					<input type="password" name="pass" class="form-control passwordField" placeholder="Password">
					<div class="input-group-append">
						<span class="input-group-text cursor" id="passwordShowHide"><i class="text-primary fas fa-eye"></i></span>
					</div>									
				</div>
				<div class="w-100"></div>

				<div class="col-sm-10 my-2">
					<div class="col-sm">
						<div class="container">
							<input type="checkbox" class="form-check-input" ><h6>I have read and I agree with PasserMate's <a href="#">Terms and Conditions</a> and <a href="#" class="">Privacy Policy</a> </h6>
						</div>
					</div>
				</div>
				<div class="w-100"></div>

				<div class=" col-sm-10 my-2">
					<input type="submit" class="col btn btn-success btn-block " name="submit" value="Sign Up">
				</div>
				<div class="w-100"></div>

				<div class=" col-sm-10 my-2  text-center">
					<strong class="col">You can also Signup using <a href="http://Google.com " style="color:#374356;">Google</a> or <a href="http://Facebook.com" style="color:#1f498e;">Facebook</a></strong>
				</div>
				<div class="w-100"></div>

				<div class=" col-sm-8 my-2 text-center">
					<h6>Already have an account? <a href="#">Log in</a></h6> 	
				</div>	

     		</div>
     		</form>
     	</div>
      	
  </body>
</html>

<?php 
	require "../public/header-footer/seeker/seekerFooter.marvee";
?>