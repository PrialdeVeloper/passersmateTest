<?php  require "../public/header-footer/header.marvee"; ?>
	<style type="text/css">
		.scroll{
	  height:500px;
	  overflow-y: scroll;
	  overflow-x: hidden;
	}

	.btn-change1:hover{
    -webkit-transform: scale(1.1);
    background: #3ab0ff;
	}
	 .animated {
            -webkit-animation-duration: 10s;
            animation-duration: 10s;
            -webkit-animation-fill-mode: both;
            animation-fill-mode: both;
         }
      .animated1 {
            -webkit-animation-duration: 2s;
            animation-duration: 2s;
            -webkit-animation-fill-mode: both;
            animation-fill-mode: both;
         }
         
         @-webkit-keyframes fadeIn {
            0% {opacity: 0;}
            100% {opacity: 1;}
         }
         
         @keyframes fadeIn {
            0% {opacity: 0;}
            100% {opacity: 1;}
         }
         
         .fadeIn {
            -webkit-animation-name: fadeIn;
            animation-name: fadeIn;
         }

          @-webkit-keyframes flipInX {
            0% {
               -webkit-transform: perspective(400px) rotateX(90deg);
               opacity: 0;
            }
            40% {
               -webkit-transform: perspective(400px) rotateX(-10deg);
            }
            70% {
               -webkit-transform: perspective(400px) rotateX(10deg);
            }
            100% {
               -webkit-transform: perspective(400px) rotateX(0deg);
               opacity: 1;
            }
         }
         
         @keyframes flipInX {
            0% {
               transform: perspective(400px) rotateX(90deg); 
               opacity: 0;
            }
            40% {
               transform: perspective(400px) rotateX(-10deg);
            }
            70% {
               transform: perspective(400px) rotateX(10deg);
            }
            100% {
               transform: perspective(400px) rotateX(0deg);
               opacity: 1;
            }
         }
         
         .flipInX {
            -webkit-backface-visibility: visible !important;
            -webkit-animation-name: flipInX;
            backface-visibility: visible !important;
            animation-name: flipInX;
         }

</style>
</head>

<body>
    <!-- ============================================================== -->
    <!-- Preloader - style you can find in spinners.css -->
    <!-- ============================================================== -->
    <div class="preloader">
        <div class="lds-ripple">
            <div class="lds-pos"></div>
            <div class="lds-pos"></div>
        </div>
    </div>
    <!-- ============================================================== -->
    <!-- Main wrapper - style you can find in pages.scss -->
    <!-- ============================================================== -->
            <!-- ============================================================== -->
            <!-- ============================================================== -->
            <!-- ============================================================== -->
            <!-- Container fluid  -->
            <!-- ============================================================== -->
            <div class="container-fluid">
           		<div class="row">
           			<div class="col-md-9 mx-auto mt-5">
           				<div class="card shadow">
           					<div class="card-header font-weight-bold">
           						<h4>PassersMate Search Area</h4>
           					</div>

           					<div class="card-body">
           						<form>
           						<div class="row">
           							<div class="col-md-3 mt-2">
           								<h5>Keywords</h5>
		           					    <div class="input-group">
							               <input  list="keywords" name="keywords" class="form-control border-secondary py-2 rounded" type="search" placeholder="skills, job title">
							                 <datalist id="keywords">
											    <option value="Carpenter">
											    <option value="Chef">
											    <option value="Pastry">
											    <option value="Mechanical">
											  </datalist>
							            </div>
           							</div>
           							<div class="col-md-3 mt-2">
           								<h5>Gender:</h5>
		           					    <div class="input-group">
							             	<select class="custom-select border-secondary">
											  <option selected>Any</option>
											  <option value="female">Female</option>
											  <option value="male">Male</option>
											</select>
							            </div>
           							</div>		
           							<div class="col-md-4 mt-2">
           								<h5>Highest Educational Attainment:</h5>
		           					    <div class="input-group">
							             	<select class="custom-select border-secondary">
											  <option selected>Any</option>
											  <option value="kinder">Kinder</option>
											  <option value="elementary">Elementary</option>
											  <option value="hlevel">High School Level</option>
											  <option value="hgraduate">High School Graduate</option>
											  <option value="clevel">College Level</option>
											  <option value="cgraduate">College Graduate</option>
											  <option value="mdegree">Master Degree</option>
											  <option value="phd">PhD</option>
											</select>
							            </div>
           							</div>		
           							<div class="col-md-2 mt-2">
           								<h5>Age:</h5>
		           					    <div class="input-group">
					               			<input  name="age" class="form-control border-secondary py-2 rounded" type="number" min="1">
					           		 	</div>
           							</div>		
           						</div>
           						<div class="row mt-4">
           							<div class="col-md-5 mx-auto	">
	       								<h5>Service fee between:</h5>
	       								<div class="form-group">
			           					   	<label for="minimum">Minimum Fee (Php)</label>
			           					   	<input name="minimum" class="ml-1 border-secondary rounded" type="text" style="width:50px">
		           					   	</div>
										<input type="range" class="custom-range" min="1" max="10000" id="minimum">
										<div class="form-group mt-3">
			           					   	<label for="maximum">Maximum Fee (Php)</label>
			           					   	<input name="maximum" class="ml-1 border-secondary rounded" type="text" style="width:50px">
		           					   	</div>
		           					   	<input type="range" class="custom-range" min="1" max="10000" id="maximum">
       								</div>
           						</div>
           						<div class="row mt-4">
           							<div class="col-md-12 text-center">
           								<a href="" data-toggle="collapse" data-target="#show" aria-expanded="false" aria-controls="show"><h4><u>Show Advance Options</u></h4></a>
           							</div>	
           						</div>
           						  <!-- ACCORDION-->
           						<div class="collapse" id="show">
           							<div class="row mt-4pt-4 bg-light">	
           								<div class="col-md-5">
	           								<h5>Location:</h5>
			           					    <div class="input-group">
								             	<select class="custom-select border-secondary">
												  <option selected>Choose a location (City)</option>
												  <option value="female">Cebu City</option>
												  <option value="male">Pardo</option>
												</select>
								            </div>
	           							</div>
           								<div class="col-md-3 mb-3 mt-2">
		       								<h5>Number of Passers:</h5>
		       								 <div class="input-group">
							               		<input  name="numberPasser" class="form-control border-secondary py-2 rounded" type="number" min="1">
							           		 </div>
           								</div>
           								<div class="col-md-4">
		       								<h5>Sort by:</h5>
			           					    <div class="input-group">
								             	<select class="custom-select border-secondary">
												  <option selected>Relevance</option>
												  <option value="female">Date</option>
												  <option value="male">Service Fee</option>
												  <option value="male">Ratings</option>
												</select>
	       									</div>
       									</div>
           							</div>
           						</div>
           						<!-- END OF ACCORDION-->
           					</form>
           					</div>
           				</div>
           			</div>
          		</div>
          		<div class="row">
          			<div class="col-md-9 mx-auto">
          				<div class="alert alert-info" role="alert">
						      <div class="pretty p-icon p-rotate">
						        <input type="checkbox"/>
						        <div class="state p-success">
						            <i class="icon mdi mdi-check"></i>
						            <label class="font-weight-bold">Select All (4)</label>
						        </div>
						    </div>
						</div>
          			</div>
          		</div>
          		<div class="row">
          			<div id="animated-example" class="col-md-12 mx-auto mb-5 animated fadeIn">
          				<h3 class="text-center">Page 1 of 4</h3>
          			</div>
          		</div>
          		<div class="row">
          			<div class="col-md-9 mx-auto">
          				<div class="row">
          					<div class="col-md-6">
          						<div class="card shadow animated1 flipInX" style="height:95%">
          							<div class="card-header">
          								  <div class="pretty p-svg p-curve">
									        <input type="checkbox" />
									        <div class="state p-success">
									            <!-- svg path -->
									            <svg class="svg svg-icon" viewBox="0 0 20 20">
									                <path d="M7.629,14.566c0.125,0.125,0.291,0.188,0.456,0.188c0.164,0,0.329-0.062,0.456-0.188l8.219-8.221c0.252-0.252,0.252-0.659,0-0.911c-0.252-0.252-0.659-0.252-0.911,0l-7.764,7.763L4.152,9.267c-0.252-0.251-0.66-0.251-0.911,0c-0.252,0.252-0.252,0.66,0,0.911L7.629,14.566z" style="stroke: white;fill:white;"></path>
									            </svg>
									            <label class="font-weight-bold">Select this Passer</label>
									        </div>
									    </div>
          							</div>
          							<div class="card-body">
          								<div class="row">
          									<div class="col-md-5 text-center hoverable">
          										<a href="" title="Jodel Adan">
          											<img src="h3.jpg" class="rounded-circle border border-primary wow fadeInUp" width="150" height="150">
          											<br>
          											<a href="#" class="badge badge-success mt-3 font-weight-bold">
          												<i class="fas fa-check"></i> Verified Passer 
          											</a>
          									</div>
          									<div class="col-md-7 text-center" style="font-family: Georgia, Times, Times New Roman, serif;">
          										<a href="">
          											<p class="text-info" style="font-size:30px">
          											Jodel B. Adan
          											</p>
          										</a>
      											<label class="trebuchet" style="font-family: Trebuchet MS, Lucida Grande, Lucida Sans Unicode, Lucida Sans, Tahoma, sans-serif;line-height: 26.4px;font-size: 18px">
      												CNC MILLING MACHINE OPERATION NC II
      											</label>
      											<span class="fa fa-star checked text-warning"></span>
												<span class="fa fa-star checked text-warning"></span>
												<span class="fa fa-star checked text-warning"></span>
												<span class="fa fa-star text-warning"></span>
												<span class="fa fa-star text-warning"></span>
          									</div>
          								</div>
          								<div class="row">
          									<div class="col-md-12 text-center mt-3 text-primary">
          										<p style="font-size: 15px; color: blue">Education, Trainings & Organizations</p>
          										<p class="text-dark" style="font-size: 15px;">NC I</p>
          									</div>
          								</div>
          							</div>
          							<div class=" card-footer  text-center" style="height:70px">
          								<button type="button" class="btn-change1 btn btn-lg mb- 3 text-white" style="background:#0062cc">View profile</button>
          							</div>
          						</div>
          					</div>
          							<div class="col-md-6">
          						<div class="card shadow animated1 flipInX"  style="height:95%">
          							<div class="card-header">
          								<div class="pretty p-svg p-curve">
									        <input type="checkbox" />
									        <div class="state p-success">
									            <!-- svg path -->
									            <svg class="svg svg-icon" viewBox="0 0 20 20">
									                <path d="M7.629,14.566c0.125,0.125,0.291,0.188,0.456,0.188c0.164,0,0.329-0.062,0.456-0.188l8.219-8.221c0.252-0.252,0.252-0.659,0-0.911c-0.252-0.252-0.659-0.252-0.911,0l-7.764,7.763L4.152,9.267c-0.252-0.251-0.66-0.251-0.911,0c-0.252,0.252-0.252,0.66,0,0.911L7.629,14.566z" style="stroke: white;fill:white;"></path>
									            </svg>
									            <label class="font-weight-bold">Select this Passer</label>
									        </div>
									    </div>
          							</div>
          							<div class="card-body">
          								<div class="row">
          									<div class="col-md-5 text-center hoverable">
          										<a href="" title="Jodel Adan">
          											<img src="h3.jpg" class="rounded-circle border border-primary wow fadeInUp" width="150" height="150">
          											<br>
          											<a href="#" class="badge badge-success mt-3 font-weight-bold">
          												<i class="fas fa-check"></i> Verified Passer 
          											</a>
          										</a>
          									</div>
          									<div class="col-md-7 text-center" style="font-family: Georgia, Times, Times New Roman, serif;">
          										<a href="">
          											<p class="text-info" style="font-size:30px">
          											Jodel B. Adan
          											</p>
          										</a>
      											<label class="trebuchet" style="font-family: Trebuchet MS, Lucida Grande, Lucida Sans Unicode, Lucida Sans, Tahoma, sans-serif;line-height: 26.4px;font-size: 18px">
      												CNC MILLING MACHINE OPERATION NC II
      											</label>
      											<span class="fa fa-star checked text-warning"></span>
												<span class="fa fa-star checked text-warning"></span>
												<span class="fa fa-star checked text-warning"></span>
												<span class="fa fa-star text-warning"></span>
												<span class="fa fa-star text-warning"></span>
          									</div>
          								</div>
          								<div class="row">
          									<div class="col-md-12 text-center mt-3 text-primary">
          										<p style="font-size: 15px; color: blue">Education, Trainings & Organizations</p>
          										<p class="text-dark" style="font-size: 15px;">NC I</p>
          									</div>
          								</div>
          							</div>
          							<div class=" card-footer  text-center" style="height:70px">
          								<button type="button" class="btn-change1 btn btn-lg mb- 3 text-white" style="background:#0062cc">View profile</button>
          							</div>
          						</div>
          					</div>
          				</div>
          		
          				<div class="row mt-4">
          					<div class="col-md-6">
          						<div class="card shadow animated1 flipInX" style="height:95%">
          							<div class="card-header">
          								 <div class="pretty p-svg p-curve">
									        <input type="checkbox" />
									        <div class="state p-success">
									            <!-- svg path -->
									            <svg class="svg svg-icon" viewBox="0 0 20 20">
									                <path d="M7.629,14.566c0.125,0.125,0.291,0.188,0.456,0.188c0.164,0,0.329-0.062,0.456-0.188l8.219-8.221c0.252-0.252,0.252-0.659,0-0.911c-0.252-0.252-0.659-0.252-0.911,0l-7.764,7.763L4.152,9.267c-0.252-0.251-0.66-0.251-0.911,0c-0.252,0.252-0.252,0.66,0,0.911L7.629,14.566z" style="stroke: white;fill:white;"></path>
									            </svg>
									            <label class="font-weight-bold">Select this Passer</label>
									        </div>
									    </div>
          							</div>
          							<div class="card-body">
          								<div class="row">
          									<div class="col-md-5 text-center hoverable">
          										<a href="" title="Jodel Adan">
          											<img src="pablo.jpg" class="rounded-circle border border-primary wow fadeInUp" width="150" height="150">
          											<br>
          											<a href="#" class="badge badge-success mt-3 font-weight-bold">
          												<i class="fas fa-check"></i> Verified Passer 
          											</a>
          										</a>
          									</div>
          									<div class="col-md-7 text-center" style="font-family: Georgia, Times, Times New Roman, serif;">
          										<a href="">
          											<p class="text-info" style="font-size:30px">
          											Jodel B. Adan
          											</p>
          										</a>
      											<label class="trebuchet" style="font-family: Trebuchet MS, Lucida Grande, Lucida Sans Unicode, Lucida Sans, Tahoma, sans-serif;line-height: 26.4px;font-size: 18px">
      												CNC MILLING MACHINE OPERATION NC II
      											</label>
      											<span class="fa fa-star checked text-warning"></span>
												<span class="fa fa-star checked text-warning"></span>
												<span class="fa fa-star checked text-warning"></span>
												<span class="fa fa-star text-warning"></span>
												<span class="fa fa-star text-warning"></span>
          									</div>
          								</div>
          								<div class="row">
          									<div class="col-md-12 text-center mt-3 text-primary">
          										<p style="font-size: 15px; color: blue">Education, Trainings & Organizations</p>
          										<p class="text-dark" style="font-size: 15px;">NC I</p>
          									</div>
          								</div>
          							</div>
          							<div class=" card-footer  text-center" style="height:70px">
          								<button type="button" class="btn-change1 btn btn-lg mb- 3 text-white" style="background:#0062cc">View profile</button>
          							</div>
          						</div>
          					</div>
          							<div class="col-md-6">
          						<div class="card shadow animated1 flipInX" style="height:95%">
          							<div class="card-header">
          								<div class="pretty p-svg p-curve">
									        <input type="checkbox" />
									        <div class="state p-success">
									            <!-- svg path -->
									            <svg class="svg svg-icon" viewBox="0 0 20 20">
									                <path d="M7.629,14.566c0.125,0.125,0.291,0.188,0.456,0.188c0.164,0,0.329-0.062,0.456-0.188l8.219-8.221c0.252-0.252,0.252-0.659,0-0.911c-0.252-0.252-0.659-0.252-0.911,0l-7.764,7.763L4.152,9.267c-0.252-0.251-0.66-0.251-0.911,0c-0.252,0.252-0.252,0.66,0,0.911L7.629,14.566z" style="stroke: white;fill:white;"></path>
									            </svg>
									            <label class="font-weight-bold">Select this Passer</label>
									        </div>
									    </div>
          							</div>
          							<div class="card-body">
          								<div class="row">
          									<div class="col-md-5 text-center hoverable">
          										<a href="" title="Jodel Adan">
          											<img src="marvee.jpg" class="rounded-circle border border-primary wow fadeInUp" width="150" height="150">
          											<br>
          											<a href="#" class="badge badge-success mt-3 font-weight-bold">
          												<i class="fas fa-check"></i> Verified Passer 
          											</a>
          										</a>
          									</div>
          									<div class="col-md-7 text-center" style="font-family: Georgia, Times, Times New Roman, serif;">
          										<a href="">
          											<p class="text-info" style="font-size:30px">
          											Jodel B. Adan
          											</p>
          										</a>
      											<label class="trebuchet" style="font-family: Trebuchet MS, Lucida Grande, Lucida Sans Unicode, Lucida Sans, Tahoma, sans-serif;line-height: 26.4px;font-size: 18px">
      												CNC MILLING MACHINE OPERATION NC II
      											</label>
      											<span class="fa fa-star checked text-warning"></span>
												<span class="fa fa-star checked text-warning"></span>
												<span class="fa fa-star checked text-warning"></span>
												<span class="fa fa-star text-warning"></span>
												<span class="fa fa-star text-warning"></span>
          									</div>
          								</div>
          								<div class="row">
          									<div class="col-md-12 text-center mt-3 text-primary">
          										<p style="font-size: 15px; color: blue">Education, Trainings & Organizations</p>
          										<p class="text-dark" style="font-size: 15px;">NC I</p>
          									</div>
          								</div>
          							</div>
          							<div class=" card-footer  text-center" style="height:70px">
          								<button type="button" class="btn-change1 btn btn-lg mb- 3 text-white" style="background:#0062cc">View profile</button>
          							</div>
          						</div>
          					</div>
          				</div>

          			</div>
          		</div>
          	</div>

          	
            <!-- ============================================================== -->
            <!-- footer -->
            <!-- ============================================================== -->
          
            <!-- ============================================================== -->
            <!-- End footer -->
    <!-- ============================================================== -->
    <!-- End Wrapper -->
    <!-- ============================================================== -->
    <!-- ============================================================== -->
    <!-- All Jquery -->
    <!-- ============================================================== -->
    <script src="dist/jquery.min.js"></script>
    <!-- Bootstrap tether Core JavaScript -->
    <script src="popper.js/dist/umd/popper.min.js"></script>
    <script src="bootstrap/dist/js/bootstrap.min.js"></script>
    <!--Custom JavaScript -->
    <script src="js/custom.min.js"></script>
    <!-- this page js -->
    <script src="build/toastr.min.js"></script>
 	<script type="text/javascript">
 	function myFunction() {
            location.reload();
         }
 	</script>
</body>

</html>