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

	.pricing .card {
	  border: none;
	  border-radius: 1rem;
	  transition: all 0.2s;
	  box-shadow: 0 0.5rem 1rem 0 rgba(0, 0, 0, 0.1);
	}

	.pricing hr {
	  margin: 1.5rem 0;
	}

	.pricing .card-title {
	  margin: 0.5rem 0;
	  font-size: 0.9rem;
	  letter-spacing: .1rem;
	  font-weight: bold;
	}

	.pricing .card-price {
	  font-size: 3rem;
	  margin: 0;
	}

	.pricing .card-price .period {
	  font-size: 0.8rem;
	}

	.pricing ul li {
	  margin-bottom: 1rem;
	}

	.pricing .text-muted {
	  opacity: 0.7;
	}

	.pricing .btn {
	  font-size: 80%;
	  border-radius: 5rem;
	  letter-spacing: .1rem;
	  font-weight: bold;
	  padding: 1rem;
	  opacity: 0.7;
	  transition: all 0.2s;
	}

	/* Hover Effects on Card */

	@media (min-width: 992px) {
	  .pricing .card:hover {
	    margin-top: -.25rem;
	    margin-bottom: .25rem;
	    box-shadow: 0 0.5rem 1rem 0 rgba(0, 0, 0, 0.3);
	  }
	  .pricing .card:hover .btn {
	    opacity: 1;
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
            <div class="container-fluid mt-5 mb-5">
                <!-- ============================================================== -->
                <div class="row">
                	<div class="col-md-12 text-center">
                		<h1>Seek it out and You shall Find</h1>
                		<h3>We make seeking workers easy just for you by providing you skilled Passers</h3>
                	</div>
                </div>
                <!-- Start Page Content -->
               <section class="pricing py-5">
				  <div class="container">
				    <div class="row">
				      <!-- Free Tier -->
				      <div class="col-lg-4">
				        <div class="card mb-5 mb-lg-0">
				          <div class="card-body">
				            <h5 class="card-title text-muted text-uppercase text-center">TATAK Basic Plan</h5>
				            <h6 class="card-price text-center">&#8369;80<span class="period">/day</span></h6>
				            <hr>
				            <ul class="fa-ul">
				              <li><span class="fa-li"><i class="fas fa-check"></i></span>Unlimited passers</li>
				              <li><span class="fa-li"><i class="fas fa-check"></i></span>Unlimited Job Offers</li>
				              <li><span class="fa-li"><i class="fas fa-check"></i></span>Instant Job Offer sent</li>
				               <li><span class="fa-li"><i class="fas fa-check"></i></span>Read Passer Reviews</li>
				               <li><span class="fa-li"><i class="fas fa-check"></i></span>Hire Passers</li>
				               <li><span class="fa-li"><i class="fas fa-check"></i></span>Chat 24/7</li>
				               
				            </ul>
				            <a href="basic" class="btn btn-block btn-primary text-uppercase">Subscribe Now</a>
				          </div>
				        </div>
				      </div>
				      <!-- Plus Tier -->
				      <div class="col-lg-4">
				        <div class="card mb-5 mb-lg-0">
				          <div class="card-body">
				            <h5 class="card-title text-muted text-uppercase text-center">TATAK Silver Plan</h5>
				            <h6 class="card-price text-center">&#8369;2500<span class="period">/month</span></h6>
				            <hr>
				            <ul class="fa-ul">
				              <li><span class="fa-li"><i class="fas fa-check"></i></span>Unlimited passers</li>
				              <li><span class="fa-li"><i class="fas fa-check"></i></span>Unlimited Job Offers</li>
				                 <li><span class="fa-li"><i class="fas fa-check"></i></span>Instant Job Offer sent</li>
				               <li><span class="fa-li"><i class="fas fa-check"></i></span>Read Passer Reviews</li>
				               <li><span class="fa-li"><i class="fas fa-check"></i></span>Hire Passers</li>
				               <li><span class="fa-li"><i class="fas fa-check"></i></span>Chat 24/7</li>
				               
				            </ul>
				            <a href="silver" class="btn btn-block btn-primary text-uppercase">Subscribe Now</a>
				          </div>
				        </div>
				      </div>
				      <!-- Pro Tier -->
				      <div class="col-lg-4">
				        <div class="card">
				          <div class="card-body">
				           <h5 class="card-title text-muted text-uppercase text-center">TATAK Gold Plan</h5>
				            <h6 class="card-price text-center">&#8369;5000<span class="period">/year</span></h6>
				            <hr>
				            <ul class="fa-ul">
				              <li><span class="fa-li"><i class="fas fa-check"></i></span>Unlimited passers</li>
				              <li><span class="fa-li"><i class="fas fa-check"></i></span>Unlimited Job Offers</li>
				                 <li><span class="fa-li"><i class="fas fa-check"></i></span>Instant Job Offer sent</li>
				               <li><span class="fa-li"><i class="fas fa-check"></i></span>Read Passer Reviews</li>
				               <li><span class="fa-li"><i class="fas fa-check"></i></span>Hire Passers</li>
				               <li><span class="fa-li"><i class="fas fa-check"></i></span>Chat 24/7</li>
				               
				            </ul>
				            <a href="gold" class="btn btn-block btn-primary text-uppercase">Subscribe Now</a>
				          </div>
				        </div>
				      </div>
				    </div>
				  </div>
				</section>
            </div>
              <!-- End Container fluid  -->
         
            <!-- ============================================================== -->
            <!-- footer -->
            <!-- ============================================================== -->
            <!-- ============================================================== -->
            <!-- End footer -->
            <!-- ============================================================== -->

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
<?php
	require "../public/header-footer/passer/passerFooter.marvee";
?>