<?php 
	require "../public/header-footer/header.marvee";
?>
     	<div class="container-fluid my-4 col-12 col-sm-6 ">
     		<form class="shadow-lg p-3 mb-5 bg-white rounded pt-3  ">
     		<div class="row justify-content-center  my-3 ">

     			<div class="col-12 my-2">
     				<h2 class="fs-title text-center ">Create your account as a Passer</h2>
     			</div> 

				<div class=" col-sm-5 my-2">
					<input type="text" name="cocno" class="form-control" placeholder="Certificate Number">
				</div>
			    <div class=" col-sm-5 my-2">
				    <select class="form-control">
				        <option>Type of Certificate</option>
				        <option value="1">Tamil</option>
				        <option value="2">English</option>
				        <option value="3">Mathematics</option>
				        <option value="4">Science</option>
				    </select>
			    </div>
			    <div class="w-100"></div>

				<div class=" col-sm-5 my-2">
					<input type="text" name="qTitle" class="form-control" placeholder="Qualification Title">
				</div>
				<div class=" col-sm-5 my-2">
					<input id="datepicker" name="expdate" placeholder="Expiration Date" class="form-control" />
					    <script>
					        $('#datepicker').datepicker({
					            uiLibrary: 'bootstrap4'
					        });
					    </script>	
				</div>
				<div class="w-100"></div>

				<div class=" col-sm-5 my-2">
					<input type="text" name="fn" class="form-control" placeholder="First Name">
				</div>
				<div class=" col-sm-5 my-2">
					<input type="text" name="ln" class="form-control" placeholder="Last Name">
				</div>
				<div class="w-100"></div>

				<div class=" col-sm-10 my-2">
					<input type="text" name="email" class="form-control" placeholder="Email">
				</div>
				<div class="w-100"></div>

				<div class=" col-sm-10 my-2 input-group">
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
							function myFunction1(){
				      			var x = document.getElementById("myInput1");		      			
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

				<div class=" col-sm-10 my-2 input-group">
					<input type="password" name="cpass" id="myInput1" class="form-control" placeholder="Confirm Password">
					<div class="input-group-append">
							<span class="input-group-text" > <input type="checkbox"  onclick="myFunction1()"></span>							
					</div>									
				</div>
				<div class="w-100"></div>

				<div class="col-sm-10 my-2">
					<div class="col-sm-12">
						<input type="checkbox" class="form-check-input" ><h6>I have read and I agree with PasserMate's <a href="#">Terms and Conditions</a> and <a href="#" class="">Privacy Policy</a> </h6>
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