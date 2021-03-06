<?php
if(isset($data) && !empty($data)){
    extract($data[0]);
    if(isset($userDetails) && !empty($userDetails)){
      extract($userDetails[0]);
    }
}  
require "../public/header-footer/seeker/seekerHeader.marvee";
?>
<!-- <link rel="stylesheet" href="http://netdna.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css"> -->
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

        <!-- CancelRequest Modal -->
              <div class="modal fade" id="showDisputeSeeker" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title text-danger" id="exampleModalLabel">
                         <i class="fas fa-exclamation-circle"></i> Dispute from Passer
                      </h5>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                    <div class="modal-body">
                      <u class="font-weight-bold" id="disputeCancelNames"></u> who offered you a job<u class="font-weight-bold" id="disputeJobtitleName"></u> has a complain on you. Below is his/her reason:
                       <textarea class="form-control mb-2" id="disputereasonNames" rows="3" disabled></textarea>
                      You can try contacting the mentioned passer in the chat to try to resolve your issues
                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-secondary" data-dismiss="modal">Done</button>
                    </div>
                  </div>
                </div>
              </div>
              <!-- END OF MODAL -->


        <!-- done modal -->

        <div class="modal animated tada mx-auto mt-5" id="doneModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
		  <div class="modal-dialog" role="document">
		    <div class="modal-content border border-warning shadow">
		      <div class="modal-header">
		        <h5 class="modal-title" id="exampleModalLabel"><i class="fas fa-star text-warning"></i> Ratings and Feedbacks</h5>
		        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
		          <span aria-hidden="true">&times;</span>
		        </button>
		      </div>
		      <div class="modal-body">
		        <small class="text-info font-weight-bold">Note: We encourage you to give feedbacks and rate honestly, we appreciate it Mate.</small>
		        <div class="row mt-2">
	        		<div class="col-md-3">
	        			<img id="rateImage" src="" class="rounded-circle border border-success shadow" style="height:110px;width:110px">
	        		</div>
	        		<div class="col-md-9">
	        			<h4 class="font-weight-bold" id="ratingName"></h4>
	        			 <div class="star-rating">
	        			 	<div class="row">
		        			 	<div class="col">
			        			 	<div class="d-flex justify-content-center">
			        			 		<span class="text-center lead">Personality</span>
			        			 	</div>
			        			 	 <div class="stars">
									    <input class="star star-5" id="star-5" type="radio" name="star" value="5">
									    <label class="star star-5" for="star-5"></label>
									    <input class="star star-4" id="star-4" type="radio" name="star" value="4">
									    <label class="star star-4" for="star-4"></label>
									    <input class="star star-3" id="star-3" type="radio" name="star" value="3">
									    <label class="star star-3" for="star-3"></label>
									    <input class="star star-2" id="star-2" type="radio" name="star" value="2">
									    <label class="star star-2" for="star-2"></label>
									    <input class="star star-1" id="star-1" type="radio" name="star" value="1">
									    <label class="star star-1" for="star-1"></label>
									 </div>
									  <div class="container text-center" id="rateCategory">
									  </div>
								</div>
							</div>
							<div class="row">
		        			 	<div class="col">
			        			 	<div class="d-flex justify-content-center">
			        			 		<span class="text-center lead">Punctuality</span>
			        			 	</div>
			        			 	 <div class="stars">
									    <input class="starsecond starsecond-5" id="starsecond-5" type="radio" name="starsecond" value="5">
									    <label class="starsecond starsecond-5" for="starsecond-5"></label>
									    <input class="starsecond starsecond-4" id="starsecond-4" type="radio" name="starsecond" value="4">
									    <label class="starsecond starsecond-4" for="starsecond-4"></label>
									    <input class="starsecond starsecond-3" id="starsecond-3" type="radio" name="starsecond" value="3">
									    <label class="starsecond starsecond-3" for="starsecond-3"></label>
									    <input class="starsecond starsecond-2" id="starsecond-2" type="radio" name="starsecond" value="2">
									    <label class="starsecond starsecond-2" for="starsecond-2"></label>
									    <input class="starsecond starsecond-1" id="starsecond-1" type="radio" name="starsecond" value="1">
									    <label class="starsecond starsecond-1" for="starsecond-1"></label>
									 </div>
									  <div class="container text-center" id="rateCategorysecond">
									  </div>
								</div>
							</div>
							<div class="row">
		        			 	<div class="col">
			        			 	<div class="d-flex justify-content-center">
			        			 		<span class="text-center lead">Quality of Work</span>
			        			 	</div>
			        			 	 <div class="starss">
									    <input class="starthird starthird-5" id="starthird-5" type="radio" name="starthird1" value="5">
									    <label class="starthird starthird-5" for="starthird-5"></label>
									    <input class="starthird starthird-4" id="starthird-4" type="radio" name="starthird1" value="4">
									    <label class="starthird starthird-4" for="starthird-4"></label>
									    <input class="starthird starthird-3" id="starthird-3" type="radio" name="starthird1" value="3">
									    <label class="starthird starthird-3" for="starthird-3"></label>
									    <input class="starthird starthird-2" id="starthird-2" type="radio" name="starthird1" value="2">
									    <label class="starthird starthird-2" for="starthird-2"></label>
									    <input class="starthird starthird-1" id="starthird-1" type="radio" name="starthird1" value="1">
									    <label class="starthird starthird-1" for="starthird-1"></label>
									 </div>
									  <div class="container text-center" id="rateCategorythird">
									  </div>
								</div>
							</div>
					     </div>
					       <div class="form-group mt-1">
						    <label for="rateFeedback" class="font-weight-bold">Your overall feedback</label>
						    <textarea class="form-control" id="rateFeedback" rows="3"></textarea>
						  </div>
	        		</div>

	        	</div>
	        </div>
		      <div class="modal-footer">
		        <button type="button" class="btn btn-warning text-dark rateSubmit">Submit</button>
		        <button type="button" class="btn btn-secondary rateClose">Close</button>
		      </div>
		    </div>
		  </div>
		</div>

        <!-- end of done modal -->
        
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
						<div class="col-md-5 mx-auto text-center">
							<img src="../etc/images/system/PMlogo.png" width="75px">
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
								<u class="font-weight-bold" id="passerFullname"></u> of <u class="font-weight-bold" id="passerFullAddress"></u>, ("The Passer")
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
								The Passer's position is that of <u class="font-weight-bold" id="jobtitle"></u>
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
								<span class="font-weight-bold">&#8369;</span><u class="font-weight-bold" id="makeAgreementSalary">Salary.</u>
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
				    <input type="checkbox" class="form-check-input" id="agreementCheck">
				    <label class="form-check-label" for="agreement"> I reviewed and accept the terms and condition of the Employment Agreement.</label>
				  </div>
					</div>
					<div class="row">
						<div class="col-md-4">
							<img src="../etc/images/system/PMlogo.png" width="50" class="" style="margin-left: 85px;">
							<p class="border-bottom border-dark"></p>
							<p class="text-center">WITNESS</p>
						</div>
						<div class="col-md-4"></div>
						<div class="col-md-4 mt-3">
							<p></p>
							<p class="text-center border-bottom border-dark font-weight-bold"  id="currentDate">CURRENT DATE</p>
							<p class="text-center">DATE</p>
						</div>
					</div>
                    </div>
                    <div class="modal-footer">
                     
                      <button type="button" class="btn btn-primary" id="hirePasser">Hire the Passer</button>
                       <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                    </div>
                  </div>
                </div>
              </div>
                <!-- End Decline Modal -->

		    <!-- CANCEL Modal -->
		    <div class="modal fade" id="cancel" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
		      <div class="modal-dialog modal-dialog-centered" role="document">
		        <div class="modal-content">
		          <div class="modal-header">
		            <h5 class="modal-title" id="exampleModalCenterTitle">Cancel the Job</h5>
		            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
		              <span aria-hidden="true">&times;</span>
		            </button>
		          </div>
		          <form id="cancelJobOffer">
		          <div class="modal-body">
		             <small class="font-weight-bold text-info">Note: Cancellation is approved only if the passer agreed to do so, otherwise cancellation cannot be process.</small><br>
		            Are you sure you want to cancel your job?<br><br>
		            If cancel, please tell us the reason.
		             <textarea class="form-control" id="exampleFormControlTextarea1" rows="3"></textarea>
		          </div>
		          <div class="modal-footer">
		            <button type="submit" id="yesCancel" class="btn btn-primary">Yes</button>
		            <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
		          </div>
		        </form>
		        </div>
		      </div>
		    </div>
		    <!-- END OF CANCEL MODAL -->

		    <!-- CancelRequest Modal -->
              <div class="modal fade" id="cancelMine" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title text-danger" id="exampleModalLabel">
                         <i class="fas fa-exclamation-circle"></i> Cancellation of the Job
                      </h5>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                    <div class="modal-body">
                      <u class="font-weight-bold" id="cancelName"></u> who has a job of <u class="font-weight-bold" id="jobtitleName"></u> is requesting to cancel the job for the reason of 
                       <textarea class="form-control mb-2" id="reasonName" rows="3" disabled></textarea>
                      Do you agree to the cancellation of the said job, Mate?
                      <br>
                      <small class="text-info font-weight-bold">Note: Once you agree to the cancellation, it will immediately notified to the passer.</small> <br>
                      If you don't agree, you can file a <a href=""><u class="font-weight-bold text-danger">dispute</u></a> to the said Passer.
                    </div>
                    <div class="modal-footer">
                      <button type="button" id="approveCancel" class="btn btn-primary" data-dismiss="modal">Yes</button>
                      <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
                    </div>
                  </div>
                </div>
              </div>
              <!-- END OF MODAL -->

              <!-- start of dispute form -->
	<div class="modal fade" id="dispute">
		<form id="disputeSubmit">
			<div class="modal-dialog modal-lg">
				<div class="modal-content bg-white">
					<div class="modal-header bg-danger">
						<label class="modal-title centerModalTitle">
							<span class="lead">
								<b class="pl-4 text-white">What gone wrong&quest;</b>
							</span>
						</label>
						<button class="close" data-dismiss="modal">
							<span>&times;</span>
						</button>
					</div>	
					<div class="modal-body">
						<div class="container">
							<div class="row">
								<div class="col">
									<div class="form-group">
										<label class="lead" for="disputeArea">
											<span>What Happened? Give us some insight</span>
										</label>
										<textarea class="form-control" id="disputeArea"></textarea>
									</div>
								</div>
							</div>
							<div class="row justify-content-center">
								<button class="btn btn-success">Submit</button>
							</div>
						</div>
					</div>

					<div class="modal-footer bg-light">
						<button class="btn btn-danger" data-dismiss="modal">Close</button>
					</div>
				</div>
			</div>
		</form>
	</div>
	<!-- end of dispute form -->


           
    <!-- ============================================================== -->
    <!-- End Wrapper -->
    <!-- ============================================================== -->
  </body>
  </html>