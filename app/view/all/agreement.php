<?php
$sendAgreement = 
'
  <div class="card-footer">
    <div class="row">
      <div class="col-md-12" id="agreementEdit">
        <a href="" class="text-left" data-toggle="modal" data-target="#edit"><h5><u>Edit your Employment Agreement Form</u></h5></a>
      </div>
      <div class="col-md-12 text-right">
        <button type="submit" name="sendOffer" class="btn btn-success font-weight-bold">Send the Agreement</button>
        <a href="search" class="btn btn-secondary">Cancel</a>
      </div>
    </div>
  </div>
';
if(isset($data) && !empty($data)){
    extract($data[0]);
    if(isset($userDetails) && !empty($userDetails) && isset($passerDetails) && !empty($passerDetails)){
      extract($userDetails);
      extract($passerDetails);
      if(!empty($error)){
        $sendAgreement = null;
      }
    }
    if(isset($error)){
      $error = 
      '
      <div class="alert alert-danger col text-center" role="alert">
        <label>'.$error.'</label>     
      </div>
      ';
    }
}  
require "../public/header-footer/seeker/seekerHeader.marvee";
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
    <title>Matrix Template - The Ultimate Multipurpose admin template</title>
    <!-- Custom CSS -->
    <link href="../etc/subscription/css/style.min.css" rel="stylesheet">
    <link href="../etc/subscription/build/toastr.min.css" rel="stylesheet">
	<style type="text/css">
		.scroll{
	  height:500px;
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
              <div class="row">
              	<div class="col-md-12 mx-auto mt-5">
              		<div class="row">
              			<div class="col-md-6 mx-auto">
              				<a href="<?php echo $destination; ?>">
              					<h4><u>Back to your Dashboard</u></h4>
              				</a>
                      <?php echo $error; ?>
              				<div class="card shadow" id="agreementDiv">
              					<div class="card-header">
              						<h4>Employment Agreement Form</h4>
              						<small class="font-weight-bold text-danger">Note: This will serve as your agreement between your choosen Passer.
              						<br>
              						You must create and send this to your choosen Passer to continue your hiring process.
              						</small>
              					</div>
              					<!-- END OF CARD_HEADER -->
              					<div class="card-body text-dark scroll">
              						<div class="row">
              							<div class="col-md-5 mx-auto text-center">
              								<img src="../etc/images/system/PMlogo.png" width="250px">
              							</div>
              						</div>
              						<div class="row mt-4">
              							<div class="col-md-12">
              								<h5>This agreement is between</h5>
              							</div>
              							<div class="col-md-12">
              								<p style="font-size: 15px">(1) 
              									<u class="font-weight-bold"><?php echo $SeekerFN." ".$SeekerLN; ?></u> who resides in <u class="font-weight-bold"><?php echo $SeekerAddress." ".$SeekerStreet.", ".$SeekerCity ?></u>, ("The service seeker") and
              								</p>
              							</div>
              							<div class="col-md-12 mt-3">
              								<p style="font-size: 15px">(2) 
              									<u class="font-weight-bold"><?php echo ucwords($PasserFN." ".$PasserLN); ?></u> of <u class="font-weight-bold"><?php echo $PasserAddress." ".$PasserStreet.", ".$PasserCity; ?></u>, ("The Passer")
              								</p>
              							</div>
              							<div class="col-md-12 mt-3">
              								<p style="font-size: 15px">
              									IT IS AGREED that the Service Seeker will employ the Passer and the Passer will work for the Service Seeker on the following terms and conditions:
              								</p>
              							</div>
              							<div class="col-md-12 mt-3">
              								<p style="font-size: 15px" class="font-weight-bold">
              									1. Job Title
              								</p>
              							</div>
              							<div class="col-md-12 mt-3">
              								<p style="font-size: 15px" >
              									The Passer's position is that of <u class="font-weight-bold"><?php echo $PasserCertificate; ?>.</u>
              								</p>
              							</div>
              							<div class="col-md-12 mt-3">
              								<p style="font-size: 15px" class="font-weight-bold">
              									2. The start date of service
              								</p>
              							</div>
              							<div class="col-md-12 mt-3">
              								<p style="font-size: 15px" >
              									The Passer's service with the Service Seeker will start on 
              									<u class="font-weight-bold startDate">Start Date.</u>
              								</p>
              							</div>
                            <div class="col-md-12 mt-3">
                              <p style="font-size: 15px" class="font-weight-bold">
                                3. The estimated end date of service
                              </p>
                            </div>
                            <div class="col-md-12 mt-3">
                              <p style="font-size: 15px" >
                                The Passer's service with the Service Seeker will estimatedly end on 
                                <u class="font-weight-bold endDate">estimated End Date.</u>
                              </p>
                            </div>
              							<div class="col-md-12 mt-3">
              								<p style="font-size: 15px" class="font-weight-bold">
              									4. Place of work
              								</p>
              							</div>
              							<div class="col-md-12 mt-3">
              								<p style="font-size: 15px" >
              									The Passer's place of work will be 
              									<u class="font-weight-bold workingAddress">Working Address.</u>
              								</p>
              							</div>
              							<div class="col-md-12 mt-3">
              								<p style="font-size: 15px" class="font-weight-bold">
              									5. Payment
              								</p>
              							</div>
              							<div class="col-md-12 mt-3">
              								<p style="font-size: 15px" >
              									Payment is at the rate of
              									<a class="font-weight-bold">&#8369; </a><u class="font-weight-bold salary">Salary.</u>
              								</p>
              							</div>
                              <div class="col-md-12 mt-3">
                              <p style="font-size: 15px" class="font-weight-bold">
                                6. Payment Method
                              </p>
                            </div>
                            <div class="col-md-12 mt-3">
                              <p style="font-size: 15px" >
                                Payment method is
                                <u class="font-weight-bold paymentMethod">Payment Method.</u>
                              </p>
                            </div>
              							<div class="col-md-12 mt-3">
              								<p style="font-size: 15px" class="font-weight-bold">
              									7. Preferred Type of Accommodation
              								</p>
              							</div>
              							<div class="col-md-12 mt-3">
              								<p style="font-size: 15px" >
              									The preferred type of accommodation is
              									<u class="font-weight-bold accommodationType">Type of accommodation.</u>
              								</p>
              							</div>
                            <form id="agreementNotes">
                              <div class="col-md-12 mt-3">
                                <p style="font-size: 15px" class="font-weight-bold">
                                  8. Notes
                                </p>
                              </div>
                              <div class="col-md-12 mt-3">
                                <p style="font-size: 15px" >
                                  Your important notes:
                                  <div class="d-flex justify-content-center">
                                    <div class="col">
                                      <textarea name="note" class="notes w-100 h-100"></textarea>
                                    </div>
                                  </div>
                                </p>
                              </div>
              							<div class="form-group col-md-12 mt-3 form-check">
									    <input type="checkbox" class="form-check-input" id="agreementCheckbox">
									    <label class="form-check-label" for="agreementCheckbox"> I reviewed and accept the terms and condition of the Employment Agreement.</label>
									  </div>
              						</div>
              						<div class="row">
              							<div class="col-md-4">
              								<img src="../etc/images/system/PMlogo.png" width="150px" class="ml-3">
              								<p class="border-bottom border-dark"></p>
              								<p class="text-center">WITNESS</p>
              							</div>
              							<div class="col-md-4"></div>
              							<div class="col-md-4">
              								<p></p>
              								<p class="text-center border-bottom border-dark font-weight-bold"><?php echo date("F jS, Y", strtotime(date("Y-m-d"))); ?></p>
              								<p class="text-center">DATE</p>
              							</div>
              						</div>
              					</div>
              					<!-- END OF CARD BODY -->
              		          <?php echo $sendAgreement; ?>
                             </form>
              					<!-- END OF CARD_FOOTER -->
              				</div>
              				<!-- END OF CARD -->
              			</div>
              		</div>
              	</div>
              </div>
            </div>
              <!-- End Container fluid  -->
            <!-- MODAL_EDIT -->
            <!-- Modal -->
                <div class="modal fade" id="edit" tabindex="-1" role="dialog" aria-labelledby="edit" aria-hidden="true">
                  <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h4 class="modal-title">Edit Your Employment Agreement Form</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div>	
                      <form id="offerJobForm">
                      <div class="modal-body scroll">
                        <div class="card-body text-dark">
  						<div class="row">
  							<div class="col-md-12 text-center">
  							 <img src="../etc/images/system/PMlogo.png" width="250px">
  							</div>
  						</div>
  						
  						<div class="form-group row mt-4">
  							<div class="col-md-12">
  								<h5>This agreement is between</h5>
  							</div>
  							<div class="col-md-12">
  								<p style="font-size: 15px">(1) 
                    <u class="font-weight-bold"><?php echo $SeekerFN." ".$SeekerLN; ?></u> who resides in <u class="font-weight-bold"><?php echo $SeekerAddress." ".$SeekerStreet.", ".$SeekerCity ?></u>, ("The service seeker") and
                  </p>
  							</div>
  							<div class="col-md-12 mt-3">
                              <p style="font-size: 15px" class="font-weight-bold">
                                1. Job Title
                              </p>
                            </div>
                            <div class="col-md-12 mt-3">
                              <p style="font-size: 15px" >
                                The Passer's position is that of <u class="font-weight-bold"><?php echo $PasserCertificate; ?>.</u>
                              </p>
                            </div>
                            <div class="col-md-12 mt-3">
                              <p style="font-size: 15px" class="font-weight-bold">
                                2. The start date of service
                              </p>
                            </div>
                            <div class="col-md-12 mt-3">
                              <p style="font-size: 15px" >
                                The Passer's service with the Service Seeker will start on 
                                <input type="text" disabled readonly class="datepicker" name="startDateModal">
                              </p>
                            </div>
                            <div class="col-md-12 mt-3">
                              <p style="font-size: 15px" class="font-weight-bold">
                                3. The estimated end date of service
                              </p>
                            </div>
                            <div class="col-md-12 mt-3">
                              <p style="font-size: 15px" >
                                The Passer's service with the Service Seeker will estimatedly end on 
                                <input type="text" disabled readonly class="datepicker" name="endDateModal">
                              </p>
                            </div>
                            <div class="col-md-12 mt-3">
                              <p style="font-size: 15px" class="font-weight-bold">
                                4. Place of work
                              </p>
                            </div>
                            <div class="col-md-12 mt-3">
                              <p style="font-size: 15px" >
                                The Passer's place of work will be 
                                <input type="text" name="workingAddressModal">
                              </p>
                            </div>
                            <div class="col-md-12 mt-3">
                              <p style="font-size: 15px" class="font-weight-bold">
                                5. Payment
                              </p>
                            </div>
                            <div class="col-md-12 mt-3">
                              <p style="font-size: 15px" >
                                Payment is at the rate of
                               <a class="font-weight-bold">&#8369; </a><input type="text" name="salaryModal">
                              </p>
                            </div>
                              <div class="col-md-12 mt-3">
                              <p style="font-size: 15px" class="font-weight-bold">
                                6. Payment Method
                              </p>
                            </div>
                            <div class="col-md-12 mt-3">
                              <p style="font-size: 15px" >
                                Payment method is
                                 <select class="form-control" name="paymentMethodModal">
                                  <option value="Onsite">In-Onsite</option>
                                  <option value="Online">Online</option>
                                </select>
                              </p>
                            </div>
                            <div class="col-md-12 mt-3">
                              <p style="font-size: 15px" class="font-weight-bold">
                                7. Preferred Type of Accommodation
                              </p>
                            </div>
                            <div class="col-md-12 mt-3">
                              <p style="font-size: 15px" >
                                The preferred type of accommodation is
                                <select class="form-control" name="accommodationTypeModal">
                                  <option value="In-House">In-House</option>
                                  <option value="Offsite">Offsite</option>
                                </select>
                              </p>
                            </div>
  						</div>
  					
                   	 </div>
                   	 <!-- END OF CARD BODY -->
                   	</div>
                   	 <!-- END OF MODAL BODY -->
                    <div class="modal-footer">
                    	 <button type="submit" class="btn btn-success font-weight-bold">Save changes</button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                    </div>
                    </form>
                  </div>
                </div>
            </div>
        </div>
            <!-- END OF MODAL_EDIT -->
            
            <!-- NOTE: PLEASE KO BUTANG UG CONFIRMATION MESSAGE HA, IF MAHUMAN NAG SAVE CHANGES KAY BUTNGI CONFIRMATION NGA ARE YOU SURE YOU WANT TO SAVE CHANGES? YES OR NO.
            DAYUN SA SEND THE AGREEMENT KAY BUTNGI PUD NGA THIS WILL BE SEND TO YOUR PASSER, DO YOU WISH TO CONTINUE? YES OR NO. -->
         
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
    <script src="../etc/subscription/js/custom.min.js"></script>
    <script src="../etc/subscription/build/toastr.min.js"></script>
<?php require "../public/header-footer/seeker/seekerFooter.marvee"; ?>