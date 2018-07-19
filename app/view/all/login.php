<?php 
	require "../public/header-footer/header.marvee";
	require "modal/loginModal.html";
	if(isset($data) || !empty($data)){
		extract($data[0]);
	}
?>
 	<div class="container-fluid my-4 col-12 col-sm-5" id="passerLogin">
 		<form class="shadow-lg px-3 mb-5 bg-white rounded" method="POST">
     		<div class="row justify-content-center ">
     			<ul class="nav nav-pills px-0 col-12" id="myForm">			 
		      		<li class="col-md-6 text-center active  bg-light rounded">
		      			<a class="text-dark cursor passerTab"><h4>Passer</h4></a>
		      		</li> 			     
		      		<li class="col-md-6 text-center  bg-light rounded">
		      			<a class="text-dark cursor seekerTab"><h4>Seeker</h4></a>
		      		</li>			     
			    </ul>

 				<div class="container mt-1 alert alert-danger text-center hidethis" id="passerLoginError" role="alert">
				 	
				</div>

     			<div class="col-12 my-3">
     				<h2 class="fs-title text-center my-4 ">Login as a Passer</h2>
     			</div> 

     			<div class="col-sm-10">
     				<h4>Email</h4>
     			</div>
     			<div class="w-100"></div>

				<div class=" col-sm-10">
					<input type="email" value="<?= isset($_POST['passerEmail'])?$_POST['passerEmail']:"" ?>" required name="passerEmail" class="form-control" placeholder="me@example.com">
				</div>
				<div class="w-100"></div>

				<div class="col-sm-10 mt-4">
     				<h4>Password</h4>
     			</div>
     			<div class="w-100"></div>

				<div class=" col-sm-10  input-group">
					<input type="password" required name="passerPass" id="myInput" class="form-control passwordField" placeholder="Password">
					<div class="input-group-append">
						<span class="input-group-text cursor passwordShowHide"><i class="text-primary fas fa-eye"></i></span>
					</div>									
				</div>
				<div class="w-100"></div>			

				<div class="col-md-10 mt-3 ml-4">
					<div class="row ">
						<div class="col-md-7">
							<input type="checkbox" class="form-check-input " ><h6>Remember me </h6>
						</div>
						<div class="col-md-5">
							<input value="Forgot Password?" type="button" class="btn btn-link " data-toggle="modal" data-target="#forgotPassModal">
						</div>
					</div>
				</div>
				<div class="w-100"></div>

				<div class=" col-sm-10 my-2">
					<input type="submit" class="col btn btn-primary btn-block " name="passerSubmit" value="Login">
				</div>
				<div class="w-100"><hr class="col-sm-9"></div>

				<div class="col-sm-10 mt-2 mb-4" >
					<div class="row text-center">
						<div class= "col-sm-9  d-flex align-items-center"><h6 class="h-50">Don't have a PasserMate account yet?</h6></div>
						<div class= " col-sm-3" >
							<a href="../passer/register" class="btn btn-success">Sign Up</a>
						</div>
					</div>					
				</div>
				<div class="w-100"></div>
     		</div>
 		</form>
 	</div>

 	<div class="container-fluid my-4 col-12 col-sm-5 hidethis" id="seekerLogin">
 		<form class="shadow-lg px-3 mb-5 bg-white rounded ">
     		<div class="row justify-content-center ">
     			<ul class="nav nav-pills px-0 col-12" id="myForm">			 
		      		<li class="col-md-6 text-center  bg-light rounded">
		      			<a class="text-dark cursor passerTab"><h4>Passer</h4></a>
		      		</li> 			     
		      		<li class="col-md-6 text-center active bg-light rounded">
		      			<a class="text-dark cursor seekerTab"><h4>Seeker</h4></a>
		      		</li>			     
			    </ul>

 				<div class="container mt-1 alert alert-danger text-center hidethis" id="seekerLoginError" role="alert">
 				</div>

     			<div class="col-12 my-3">
     				<h2 class="fs-title text-center my-4 ">Login as a Seeker</h2>
     			</div> 

     			<div class="col-sm-10">
     				<h4>Email</h4>
     			</div>
     			<div class="w-100"></div>

				<div class=" col-sm-10">
					<input type="email" value="<?= isset($_POST['passerEmail'])?$_POST['passerEmail']:"" ?>" required name="passerEmail" class="form-control" placeholder="me@example.com">
				</div>
				<div class="w-100"></div>

				<div class="col-sm-10 mt-4">
     				<h4>Password</h4>
     			</div>
     			<div class="w-100"></div>

				<div class=" col-sm-10  input-group">
					<input type="password" name="passerPass" id="myInput" class="form-control passwordField" placeholder="Password">
					<div class="input-group-append">
						<span class="input-group-text cursor passwordShowHide"><i class="text-primary fas fa-eye"></i></span>
					</div>									
				</div>
				<div class="w-100"></div>			

				<div class="col-md-10 mt-3 ml-4">
					<div class="row ">
						<div class="col-md-7">
							<input type="checkbox" class="form-check-input " ><h6>Remember me </h6>
						</div>
						<div class="col-md-5">
							<input value="Forgot Password?" type="button" class="btn btn-link " data-toggle="modal" data-target="#forgotPassModal">
						</div>
					</div>
				</div>
				<div class="w-100"></div>

				<div class=" col-sm-10 my-2">
					<input type="submit" class="col btn btn-primary btn-block " name="seekerSubmit" value="Login">
				</div>
				<div class="w-100"></div>

				<div class="col-sm-10">
					<div class="row text-center">
						<div class="col-sm-5"><hr></div>
						<div class="col-sm-2"><strong>or</strong></div>
						<div class="col-sm-5"><hr></div>
					</div>
				</div>
				<div class="w-100"></div>

				<div class="input-group col-sm-10 my-2">
				  	<div class="input-group-prepend">
				    	<span class="input-group-text bg-light border border-right-0 "><i class="fab fa-facebook " style="color:#3B5998 ;"></i></span>
				  	</div>
				  	<input type="button" onclick="window.location='<?=$redirectURL?>';" class="font-weight-bold col btn btn-light border rounded btn-block border border-left-0" name="submit" value="Sign up with Facebook">
				</div>

				<div class="input-group col-sm-10 my-2 ">
				  	<div class="input-group-prepend">
				    	<span class="input-group-text bg-light border border-right-0 "><i class="fab fa-google " style="color:#DD4B39 ;"  ></i></span>
				  	</div>
				  	<input type="button" class="font-weight-bold col btn btn-light border rounded btn-block border border-left-0" name="submit" value="Sign up with Google">
				</div>
				<div class="col-sm-10 mt-2 mb-4">
					<div class="row text-center">
						<div class="col-sm-9  d-flex align-items-center"><h6 class="h-50">Don't have a PasserMate account yet?</h6></div>
						<div class= " col-sm-3" >
							<a href="../seeker/register" class="btn btn-success">Sign Up</a>
						</div>
					</div>					
				</div>
				<div class="w-100"></div>


     		</div>
 		</form>
 	</div>

<?php 
	require "../public/header-footer/seeker/seekerFooter.marvee";
?>