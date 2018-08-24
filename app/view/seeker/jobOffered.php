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
      <!--   <div class="modal fade" id="update" tabindex="-1" role="dialog" aria-labelledby="update" aria-hidden="true">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title">Your JO Form</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <form id="updateOfferJob">
                <div class="modal-body">
                  <div class="row">
                    <div class="col-md-12 text-white" style="background:#84b3ff;">
                  <div class="form-group row col-md-12 mt-2">
                    <label for="workAddressUpdate" class="font-weight-bold">Working Address</label>
                    <input type="text" class="form-control shadow" id="workAddressUpdate">
                  </div>
                  <div class="form-group row">
                    <div class="col-md-6 mt-2">
                      <label for="startDateUpdate" class="font-weight-bold"> Start Date</label>
                      <input type="date" class="form-control shadow" id="startDateUpdate">
                     </div>
                    <div class="form-group col-md-6 mt-2">
                      <label for="endDateUpdate" class="font-weight-bold"> End Date</label>
                      <input type="date" class="form-control shadow" id="endDateUpdate">
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-md-6 mt-2">
                      <label for="salaryUpdate" class="font-weight-bold"> Salary</label>
                       <div class="input-group mb-3">
                      <div class="input-group-prepend">
                        <span class="input-group-text" id="basic-addon1">
                          <span>&#8369;</span>
                        </span>
                      </div>
                      <input type="text" class="form-control" id="salaryUpdate"  aria-describedby="basic-addon1">
                    </div>
                     </div>
                    <div class="form-group col-md-6 mt-2">
                      <label for="paymentMethodUpdate" class="font-weight-bold"> Payment Method
                      </label>
                      <select name="paymentMethodUpdate" class="custom-select mr-sm-2" id="paymentMethodUpdate">
                        <option selected value="Online">Online</option>
                        <option value="Onsite">Onsite</option>
                      </select>
                    </div>
                </div>
                <div class="form-group row col-md-12 mt-2">
                    <label for="accomodationTypeUpdate" class="font-weight-bold">Accomodation Type</label>
                    <select class="custom-select" id="accomodationTypeUpdate">
                        <option selected value="In-House">In-House</option>
                        <option value="Offsite">Offsite</option>
                    </select>
                  </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" name="submit" class="btn btn-primary">Save</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                  </div>
                </div>
              </form>
            </div>
          </div>
        </div> -->
        
                <!-- End update Modal -->

            <!-- Update Modal -->
              <div class="modal fade" id="update" tabindex="-1" role="dialog" aria-labelledby="update" aria-hidden="true">
		          <div class="modal-dialog" role="document">
		            <div class="modal-content">
		              <div class="modal-header">
		                <h5 class="modal-title">Your JO Form</h5>
		                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
		                  <span aria-hidden="true">&times;</span>
		                </button>
		              </div>
		              <form id="updateOfferJob">
                    	<div class="modal-body scroll1">
                      <small class="text-info mb-3">Note: The passer will be notified after you update your Job offered.</small>
					  <div class="form-group">
					    <label for="workAddressUpdate">Working Address</label>
					    <input type="text" class="form-control shadow" id="workAddressUpdate">
					  </div>
					  <div class="form-group">
					    <label for="startDateUpdate">Starting date of service</label>
					    <input type="date" class="form-control shadow" id="startDateUpdate">
					  </div>
					  <div class="form-group">
					    <label for="endDateUpdate">Estimated End date of service</label>
					    <input type="date" class="form-control shadow" id="endDateUpdate">
					  </div>
					  <div class="form-group">
						  <label for="range">Estimated Service Fee between</label>
						  <input type="range" name="fee" min="1" max="10000" value="5000" class="custom-range" id="range">
						  <br>
						  <input type="text" class="form-control shadow fee" id="salaryUpdate">
					  </div>
					  <div class="form-group">
					    <label for="paymentMethodUpdate">Payment Method</label>
					    <select class="form-control" id="paymentMethodUpdate" name="paymentMethodUpdate">
					      <option selected value="Online">Online</option>
                    	  <option value="Onsite">Onsite</option>
					    </select>
					  </div>
					    <div class="form-group">
					    <label for="accomodationTypeUpdate">Preferred Type of Accommodation</label>
					    <select class="form-control" id="accomodationTypeUpdate">
					      <option selected value="In-House">In-House</option>
                    	  <option value="Offsite">Offsite</option>
					    </select>
					  </div>
                    </div>
                    <div class="modal-footer">
                    <button type="submit" name="submit" class="btn btn-primary">Save</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                  </div>
                  </form>
                </div>
	            </div>
	          </div>
                <!-- End Update Modal -->

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
                    <div class="modal-body scroll1">
                      <small class="text-danger">Note: This will serve as your agreement between your choosen Passer.
					<br>
					You must create and send this to your choosen Passer to continue your hiring process.
					
					  </small>
                    <div class="row">
						<div class="col-md-5 mx-auto">
							<img src="../etc/images/system/PMlogo.png" width="250px">
						</div>
					</div>
					<div class="row mt-4">
						<div class="col-md-12">
							<h5>This agreement is between</h5>
						</div>
						<div class="col-md-12">
							<p style="font-size: 15px">(1) 
								<u class="font-weight-bold"><?php echo $SeekerFN." ".$SeekerLN; ?></u> who reside in <u class="font-weight-bold"><?php echo $SeekerAddress." ".$SeekerStreet.", ".$SeekerCity ?></u>, ("The service seeker") and
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
								<u class="font-weight-bold" id="makeAgreementStartDate">Start Date.</u>
							</p>
						</div>
						<div class="col-md-12 mt-3">
							<p style="font-size: 15px" class="font-weight-bold">
								3. The estimated end of service
							</p>
						</div>
						<div class="col-md-12 mt-3">
							<p style="font-size: 15px" >
								The Passer's service with the Service Seeker will estimatedly end on 
								<u class="font-weight-bold" id="makeAgreementEndDate">End Date.</u>
							</p>
						</div>
						<div class="col-md-12 mt-3">
							<p style="font-size: 15px" class="font-weight-bold">
								4. Place of work
							</p>
						</div>
						<div class="col-md-12 mt-3">
							<p style="font-size: 15px" >
								The Passer's normal place of work will be 
								<u class="font-weight-bold" id="makeAgreementWorkingAdress">Working Address.</u>
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
								<u class="font-weight-bold" id="makeAgreementSalary">Salary.</u>
							</p>
						</div>
						<div class="col-md-12 mt-3">
							<p style="font-size: 15px" class="font-weight-bold">
								6. Payment Method
							</p>
						</div>
						<div class="col-md-12 mt-3">
                            Payment method is
                             <select class="form-control" name="makeAgreementPaymentMethod"  disabled readonly>
                              <option value="Onsite">In-Onsite</option>
                              <option value="Online">Online</option>
                            </select>
						</div>
						<div class="col-md-12 mt-3">
							<p style="font-size: 15px" class="font-weight-bold">
								7. Preferred Type of Accommodation
							</p>
						</div>
						<div class="col-md-12 mt-3">
                            The preferred type of accommodation is
                            <select class="form-control" name="makeAgreementAccomodation" disabled readonly>
                              <option value="In-House">In-House</option>
                              <option value="Offsite">Offsite</option>
                            </select>
						</div>
						<div class="form-group col-md-12 mt-3 form-check">
				    <input type="checkbox" class="form-check-input" id="agreement">
				    <label class="form-check-label" for="agreement"> I reviewed and accept the terms and condition of the Employment Agreement.</label>
				  </div>
					</div>
					<div class="row">
						<div class="col-md-4">
							<img src="logo-blue.png" width="150" class="ml-3">
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
  </body>
  </html>