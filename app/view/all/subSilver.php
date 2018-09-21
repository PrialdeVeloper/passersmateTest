<?php 
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
    <title>Passersmate</title>
    <!-- Custom CSS -->
    <link href="../etc/subscription/css/style.min.css" rel="stylesheet">
    <link href="../etc/subscription/build/toastr.min.css" rel="stylesheet">
	<style type="text/css">
		.scroll{
	  height:220px;
	  overflow-y: scroll;
	  overflow-x: hidden;
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
            <div class="jumbotron text-center bg-white shadow" style="margin-bottom:0">
            	  <img src="../etc/images/system/c2.png" width="280px" class="shadow mb-3">
				  <h1>PassersMate Monthly Subscription</h1>
				  <p>No worries, Your money is safe</p> 
			</div>
            <!-- Container fluid  -->
            <!-- ============================================================== -->
            <div class="container-fluid">
                <!-- ============================================================== -->
                <div class="row">
                	<div class="col-sm-1"></div>
                	<div class="col-sm-5 mt-5">
                		<div class="card shadow">
                			<div class="card-body mt-3">
                				<form class="needs-validation" method="POST" novalidate action="checkout">
                					<input type="hidden" name="checkout" value="silver">
								  <div class="col-sm-12">
								  <button id="paynow" class="d-none btn btn-success font-weight-bold col-sm-12" type="submit">
								  	<h5>PAY NOW</h5>
								  </button>
								  </div>
								  <script src="https://www.paypalobjects.com/api/checkout.js"></script>

<style>
    
    /* Media query for mobile viewport */
    @media screen and (max-width: 400px) {
        #paypal-button-container {
            width: 100%;
        }
    }
    
    /* Media query for desktop viewport */
    @media screen and (min-width: 400px) {
        #paypal-button-container {
            width: 250px;
            display: inline-block;
        }
    }
    
</style>

<div class="container" id="paypal-button-container"></div>

<script>

    paypal.Button.render({
        
        // Set your environment

        env: 'sandbox', // sandbox | production

        // Specify the style of the button

        style: {
            label: 'checkout',  // checkout | credit | pay | buynow | generic
            size:  'responsive', // small | medium | large | responsive
            shape: 'pill',   // pill | rect
            color: 'gold'   // gold | blue | silver | black
        },

        // PayPal Client IDs - replace with your own
        // Create a PayPal app: https://developer.paypal.com/developer/applications/create

        client: {
            sandbox:    'AZDxjDScFpQtjWTOUtWKbyN_bDt4OgqaF4eYXlewfBP4-8aqX3PiV8e1GWU6liB2CUXlkA59kJXE7M6R',
            production: '<insert production client id>'
        },

        // Wait for the PayPal button to be clicked

        payment: function(data, actions) {
            return actions.payment.create({
                payment: {
                    transactions: [
                        {
                            amount: { total: '0.01', currency: 'USD' }
                        }
                    ]
                }
            });
        },

        // Wait for the payment to be authorized by the customer

        onAuthorize: function(data, actions) {
            return actions.payment.execute().then(function() {
                document.getElementById('paynow').click();
            });
        }
    
    }, '#paypal-button-container');

</script>
								  <div class="mt-4 text-center">
								  	<img src="../etc/images/system/paypal2.png" width="250px">
								  </div>
								</form>
                			</div>
                		</div>
                	</div>
                	<div class="col-sm-1"></div>
                	<div class="col-sm-4 mt-5">
                		<div class="card shadow">
                			<div class="card-header bg-warning text-center text-light">
                				<h4>WHAT YOU GET <small>(SILVER)</small></h4>
                			</div>
                			<div class="card-body mt-3" style="font-size:20px">
                			 <ul class="fa-ul">
				              <li><span class="fa-li"><i class="fas fa-check text-success"></i></span>Unlimited passers</li>
				              <li><span class="fa-li"><i class="fas fa-check text-success"></i></span>Unlimited Job Offers</li>
				                 <li><span class="fa-li"><i class="fas fa-check text-success"></i></span>Instant Job Offer sent</li>
				               <li><span class="fa-li"><i class="fas fa-check text-success"></i></span>Read Passer Reviews</li>
				               <li><span class="fa-li"><i class="fas fa-check text-success"></i></span>Hire Passers</li>
				               <li><span class="fa-li"><i class="fas fa-check text-success"></i></span>Chat 24/7</li>
				               
				            </ul>
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
    <!-- Bootstrap tether Core JavaScript -->
    <script src="../etc/bootstrap/js/popper.min.js"></script>
    <script src="../etc/bootstrap/js/bootstrap.min.js"></script>
    <script src="../etc/subscription/js/custom.min.js"></script>
    <!--Custom JavaScript -->
    <!-- this page js -->
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