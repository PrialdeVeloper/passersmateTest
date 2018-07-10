<?php 
	require "../public/header-footer/header.marvee";
?>
 	<div class="container-fluid my-4 col-12 col-sm-5 ">
 		<form class="shadow-lg px-3 mb-5 bg-white rounded ">
     		<div class="row justify-content-center ">
     			<div class="col-md-6 text-center  bg-primary rounded">
     				<a href="#" class="text-white" ><h4>Passer</h4></a>  
 				</div>
 				<div class="col-md-6 text-center bg-light rounded">
 					<a href="#" class="text-dark"><h4>Seeker</h4></a>  
 				</div>

     			<div class="col-12 my-3">
     				<h2 class="fs-title text-center my-4 ">Login as a Seeker</h2>
     			</div> 

     			<div class="col-sm-10">
     				<h4>Email</h4>
     			</div>
     			<div class="w-100"></div>

				<div class=" col-sm-10">
					<input type="text" name="email" class="form-control" placeholder="me@example.com">
				</div>
				<div class="w-100"></div>

				<div class="col-sm-10 mt-4">
     				<h4>Password</h4>
     			</div>
     			<div class="w-100"></div>

				<div class=" col-sm-10  input-group">
					<input type="password" name="pass" id="myInput" class="form-control" placeholder="Password">
					<div class="input-group-append">
						<span class="input-group-text" > <input type="checkbox"  onclick="myFunction()"></span>
						<script type="text/javascript">
							
				      		function myFunction(){
				      			var x = document.getElementById("myInput");		      			
							    if (x.type === "password") {
							        x.type = "text";
							    } else {
							        x.type = "password";
							    }
							}		
						</script>
					</div>									
				</div>
				<div class="w-100"></div>			

				<div class="col-md-10 mt-3 ml-4">
					<div class="row ">
						<div class="col-md-7">
							<input type="checkbox" class="form-check-input " ><h6>Remember me </h6>
						</div>
						<div class="col-md-5">
							<a href="#">Forgot Password?</a>
						</div>
					</div>
				</div>
				<div class="w-100"></div>

				<div class=" col-sm-10 my-2">
					<input type="submit" class="col btn btn-primary btn-block " name="submit" value="Login">
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
				    	<span class="input-group-text bg-light border border-right-0 "><i class="fab fa-facebook " style="color:#3B5998 ;"  ></i></span>
				  	</div>
				  	<input type="button" class="font-weight-bold col btn btn-light border rounded btn-block border border-left-0" name="submit" value="Sign up with Facebook">
				</div>

				<div class="input-group col-sm-10 my-2 ">
				  	<div class="input-group-prepend">
				    	<span class="input-group-text bg-light border border-right-0 "><i class="fab fa-google " style="color:#DD4B39 ;"  ></i></span>
				  	</div>
				  	<input type="button" class="font-weight-bold col btn btn-light border rounded btn-block border border-left-0" name="submit" value="Sign up with Google">
				</div>

				

				

				<div class="col-sm-10 mt-2 mb-4">
					<div class="row text-center">
						<div class= " col-sm-9  d-flex align-items-center"><h6 class="h-50">Don't have a PasserMate account yet?</h6></div>
						<div class= " col-sm-3" ><input type="submit" class="col btn btn-success "  style="line-height: 50%"
							 name="submit" value="Sign Up"></div>
					</div>					
				</div>
				<div class="w-100"></div>


     		</div>
 		</form>
 	</div>
  	
  </body>
</html>

<?php 
	require "../public/header-footer/seeker/seekerFooter.marvee";
?>