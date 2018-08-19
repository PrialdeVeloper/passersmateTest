<?php
if(isset($data) && !empty($data)){
    extract($data[0]);
    if(isset($userDetails) && !empty($userDetails)){
      extract($userDetails[0]);
    }
}  
require "../public/header-footer/seeker/seekerHeader.marvee";
?>
            <!-- ============================================================== -->
            <!-- Container fluid  -->
            <!-- ============================================================== -->
            <div class="container-fluid">
              <div class="row">
                <div class="col-md-12">
                  <div class="col-md-8 mx-auto mt-5">
                    <a href="<?php echo $destination; ?>">
                      <h4><u>Back to your Dashboard</u></h4>
                    </a>
                    <h4 class="text-center">Your Job Offered</h4>
                    <?php echo $offers; ?>
                  </div>
                  <div class="row justify-content-center">
                      <?php echo $pagination; ?>
                   </div>
                </div>
              </div>
             </div>

                     <!-- Update Modal -->
              <div class="modal fade" id="update" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title" id="exampleModalLabel">Update your Job Offered</h5>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>            
                    </div>
                    <div class="modal-body scroll">
                      <small class="text-info mb-3">Note: The passer will be notified after you update your Job offered.</small>
                      <form>
						  <div class="form-group">
						    <label for="exampleFormControlInput1">Working Address</label>
						    <input type="text" class="form-control" id="exampleFormControlInput1" >
						  </div>
						  <div class="form-group">
						    <label for="exampleFormControlInput1">Estimated Start date of service</label>
						    <input type="date" class="form-control" id="exampleFormControlInput1" placeholder="name@example.com">
						  </div>
						  <div class="form-group">
						    <label for="exampleFormControlInput1">Estimated End date of service</label>
						    <input type="date" class="form-control" id="exampleFormControlInput1" placeholder="name@example.com">
						  </div>
						   <div class="form-group">
						    <label for="exampleFormControlInput1">Estimated End date of service</label>
						    <input type="date" class="form-control" id="exampleFormControlInput1" placeholder="name@example.com">
						  </div>
						  <div class="form-group">
							  <label for="minimum">Estimated Service Fee between</label>
							  <br>
							  <label for="minimum">Minimum (Php)</label>
							  <input type="text">
							  <input type="range" class="custom-range" id="minimum">
							  <br>
							  <label for="maximum">Maximum (Php)</label>
							  <input type="text">
							  <input type="range" class="custom-range" id="maximum">
						  </div>
						    <div class="form-group">
						    <label for="exampleFormControlSelect1">Preferred Type of Accommodation</label>
						    <select class="form-control" id="accommodation">
						      <option value="onsite">Onsite</option>
						      <option value="offsite">Offsite</option>
						    </select>
						  </div>
						   <div class="form-group">
						    <label for="notes">Notes</label>
						    <textarea class="form-control" id="notes" rows="3"></textarea>
						  </div>
					  </form>
                    </div>
                    <div class="modal-footer">
                     
                      <button type="button" class="btn btn-primary" onclick="toastr.success('You successfully update your job offered, this will be notified to the passer');" data-dismiss="modal">Save Changes</button>
                       <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                    </div>
                  </div>
                </div>
              </div>
                <!-- End Decline Modal -->

             <!-- Agreement Modal -->
              <div class="modal fade bd-example-modal-lg" id="agreement" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg" role="document">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title" id="exampleModalLabel">Employment Agreement Form</h5>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>            
                    </div>
                    <div class="modal-body scroll">
                      <small class="text-danger">Note: This will serve as your agreement between your choosen Passer.
					<br>
					You must create and send this to your choosen Passer to continue your hiring process.
					
					  </small>
                    <div class="row">
						<div class="col-md-5 mx-auto">
							<img src="logo-black2.png" width="250px">
						</div>
					</div>
					<div class="row mt-4">
						<div class="col-md-12">
							<h5>This agreement is between</h5>
						</div>
						<div class="col-md-12">
							<p style="font-size: 15px">(1) 
								<u class="font-weight-bold">Service Seeker Name</u> who reside in <u class="font-weight-bold">Service Seeker Address</u>, ("The service seeker") and
							</p>
						</div>
						<div class="col-md-12 mt-3">
							<p style="font-size: 15px">(2) 
								<u class="font-weight-bold">Passer's Name</u> of <u class="font-weight-bold">Passer's Address</u>, ("The Passer")
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
								The Passer's position is that of <u class="font-weight-bold">Job Title.</u>
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
								<u class="font-weight-bold">Start Date.</u>
							</p>
						</div>
						<div class="col-md-12 mt-3">
							<p style="font-size: 15px" class="font-weight-bold">
								3. Place of work
							</p>
						</div>
						<div class="col-md-12 mt-3">
							<p style="font-size: 15px" >
								The Passer's normal place of work will be 
								<u class="font-weight-bold">Working Address.</u>
							</p>
						</div>
						<div class="col-md-12 mt-3">
							<p style="font-size: 15px" class="font-weight-bold">
								4. Payment
							</p>
						</div>
						<div class="col-md-12 mt-3">
							<p style="font-size: 15px" >
								Payment is at the rate of
								<u class="font-weight-bold">Salary.</u>
							</p>
						</div>
						<div class="col-md-12 mt-3">
							<p style="font-size: 15px" class="font-weight-bold">
								5. Work Materials
							</p>
						</div>
						<div class="col-md-12 mt-3">
							<p style="font-size: 15px" >
								The work material is provided by
								<u class="font-weight-bold">Who provides.</u>
							</p>
						</div>
						<div class="col-md-12 mt-3">
							<p style="font-size: 15px" class="font-weight-bold">
								6. Preferred Type of Accommodation
							</p>
						</div>
						<div class="col-md-12 mt-3">
							<p style="font-size: 15px" >
								The preferred type of accommodation is
								<u class="font-weight-bold">Type of accommodation.</u>
							</p>
						</div>
						<div class="form-group col-md-12 mt-3 form-check">
				    <input type="checkbox" class="form-check-input" id="agreement">
				    <label class="form-check-label" for="agreement"> I reviewed and accept the terms and condition of the Employment Agreement.</label>
				  </div>
					</div>
					<div class="row">
						<div class="col-md-4">
							<img src="logo-blue.png" width="150px" class="ml-3">
							<p class="border-bottom border-dark"></p>
							<p class="text-center">WITNESS</p>
						</div>
						<div class="col-md-4"></div>
						<div class="col-md-4">
							<p></p>
							<p class="text-center border-bottom border-dark font-weight-bold">CURRENT DATE</p>
							<p class="text-center">DATE</p>
						</div>
					</div>
                    </div>
                    <div class="modal-footer">
                     
                      <button type="button" class="btn btn-primary" onclick="toastr.success('You successfully hired the Passer, this will be notified to the passer');" data-dismiss="modal">Hire the Passer</button>
                       <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                    </div>
                  </div>
                </div>
              </div>
                <!-- End Decline Modal -->
           
    <!-- ============================================================== -->
    <!-- End Wrapper -->
    <!-- ============================================================== -->
    
<?php include_once "../public/etc/old/etcCompileOldIndexFoot.marvee"; ?>