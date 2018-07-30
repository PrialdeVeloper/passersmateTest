<?php 
if(isset($data) && !empty($data)){
	extract($data[0]);
}

require "../public/header-footer/header.marvee";
?>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="../../assets/images/favicon.png">
    <link href="../etc/subscription/css/style.min.css" rel="stylesheet">
    <link href="../etc/subscription/build/toastr.min.css" rel="stylesheet">
    <title>Passersmate</title>
    <!-- Custom CSS -->
    <link href="css/style.min.css" rel="stylesheet">
    <link href="build/toastr.min.css" rel="stylesheet">
	<style type="text/css">
		.scroll{
	  height:220px;
	  overflow-y: scroll;
	  overflow-x: hidden;
	}

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
            	<div class="row mt-5"></div>
                <!-- ============================================================== -->
                <div class="row">
                	<div class="col-md-12 mt-5">
                		<div class="col-md-8 mx-auto">
	                		<div class="card">
	                			<div class="card-body shadow">
	                				<div class="row">
		                				<div class="col-md-5">
		                					<h5>Subscribe Details</h5>
		                				</div>
		                				<div class="col-md-5">
		                					<h5>Terms</h5>
		                				</div>
		                				<div class="col-md-2">
		                					<h5>Amount</h5>
		                				</div>
	                				</div>
	                				<hr>
	                				<div class="row mb-5">
		                				<div class="col-md-5">
		                					<h6>PassersMate <?=$option;?> Plan</h6>
		                				</div>
		                				<div class="col-md-5">
		                					<p><?=$price;?> </p>
		                				</div>
		                				<div class="col-md-2">
		                					<p><?=$priceAlone;?></p>
		                				</div>
	                				</div>
	                				<hr>
	                				<div class="row mb-5">
		                				<div class="col-md-5">
		                				
		                				</div>
		                				<div class="col-md-5">
		                					
		                				</div>
		                				<div class="col-md-2">
		                					<h5>TOTAL:<u><?=$priceAlone;?></u></h5>
		                				</div>
	                				</div>

	                				  <a class="btn btn-block font-weight-bold btn-primary text-uppercase" data-toggle="modal" data-target=".bd-example-modal-sm">Check out</a>
	                				  <small class="font-weight-bold">Note: Please review your payments before clicking check out, Thank you.</small>
	                				  <div class="row float-right">
	                				  	<div class="col-md-12 mt-4">
	                				  		<small class="font-italic" style="font-size: 15px">Powered by</small>
	                				  		<img src="../etc/images/system/paypal.png" width="150px">
	                				  	</div>
	                				  </div>
	                				    <!-- MODAL CHECKOOUT -->
										<div class="modal fade bd-example-modal-sm" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
											<div class="modal-dialog modal-sm">
												<div class="modal-content">
													<div class="modal-header bg-success p-4"></div>
													<div class="modal-body text-center">
													<h4>Your payment have successfully created!
													Now you can avail your choosen Plan.
													Have a great day of choosing skilled Passers.</h4>
													</div>
													<div class="modal-footer">
														<button type="button" onclick="window.location='subscribe'" class="btn btn-primary" data-dismiss="modal">Okay</button>
													</div>
												</div>
											</div>
										</div>
									<!-- END OF MODAL CHECKOUT -->
	                			</div>
	                		</div>
                		</div>
                	</div>
                </div>
                	
            </div>
              <!-- End Container fluid  -->
         

    <!-- ============================================================== -->
    <!-- End Wrapper -->
    <!-- ============================================================== -->
    <!-- ============================================================== -->
    <!-- All Jquery -->
    <!-- ============================================================== -->
    <script src="../etc/bootstrap/js/jquery-3.3.1.js"></script>
	<script src="../etc/bootstrap/js/popper.min.js"></script>
    <script src="../etc/bootstrap/js/bootstrap.min.js"></script>
    <script src="../etc/subscription/js/custom.min.js"></script>
	<script src="../etc/subscription/build/toastr.min.js"></script>
    <script>
	// Example starter JavaScript for disabling form submissions if there are invalid fields
	(function() {
	  'use strict';
	  window.addEventListener('load', function() {
	    // Fetch all the forms we want to apply custom Bootstrap validation styles to
	    var forms = document.getElementsByClassName('needs-validation');
	    // Loop over them and prevent submission
	    var validation = Array.prototype.filter.call(forms, function(form) {
	      form.addEventListener('submit', function(event) {
	        if (form.checkValidity() === false) {
	          event.preventDefault();
	          event.stopPropagation();
	        }
	        form.classList.add('was-validated');
	      }, false);
	    });
	  }, false);
	})();
	</script>
</body>

</html>