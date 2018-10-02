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
                <div class="col-md-12">
                  <div class="col-md-8 mx-auto mt-5">
                    <a href="<?php echo $destination; ?>">
                      <h4><u>Back to your Dashboard</u></h4>
                    </a>
                    <h3 class="text-center">Job Offers</h3>
                    
                    <div class="card shadow">
                      <?php echo $offers;?>
                    </div>
                    <div class="row justify-content-center">
                      <?php echo $pagination; ?>
                    </div>
                  </div>
                </div>
              </div>
             </div>


             <!-- CancelRequest Modal -->
              <div class="modal fade" id="showDisputePasser" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title text-danger" id="exampleModalLabel">
                         <i class="fas fa-exclamation-circle"></i> Dispute from Seeker
                      </h5>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                    <div class="modal-body">
                      <u class="font-weight-bold" id="disputeCancelName"></u> who offered you a job<u class="font-weight-bold" id="disputeJobtitleName"></u> has a complain on you. Below is his/her reason:
                       <textarea class="form-control mb-2" id="disputereasonName" rows="3" disabled></textarea>
                      You can try contacting the mentioned seeker in the chat to try to resolve your issues
                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-secondary" data-dismiss="modal">Done</button>
                    </div>
                  </div>
                </div>
              </div>
              <!-- END OF MODAL -->

               <!-- Accept Modal -->
              <div class="modal fade" id="accept" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title" id="exampleModalLabel">Accept Job Offer</h5>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                    <div class="modal-body">
                      <p>Are you sure you want to accept the job offered Mate?</p>
                      <small class="text-danger">Note: Be sure to carefully examine the job offer before accepting. Once accepted, the information provided is final.</small>
                    </div>
                    <div class="modal-footer">
                     
                      <button type="button" class="btn btn-primary" id="acceptJobOffer">Okay</button>
                       <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                    </div>
                  </div>
                </div>
              </div>
                <!-- End Accept Modal -->


              <!-- view coe Modal -->
              <div class="modal fade " id="viewCOE" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg" role="document">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title" id="exampleModalLabel">Certificate of Employment</h5>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                    <div class="modal-body">



                      <div class="container-fluid">
                        <div class="row">
                          <div class="col-md-12">
                            <div class="row">
                              <div class="col-md-12 mx-auto mt-5">
                                <div class="card">
                                  <div class="card-header" id="cardHeader">
                                     <a target="_blank" class="btn btn-success margin-5 float-right" id="print" href="">
                                        <i class="fas fa-print"></i> Download as PDF
                                    </a>
                                  </div>
                                  <form method="get" action="file.doc">
                                  <div class="card-body border border-dark" style="background-image:url('../../public/etc/images/system/coe2.png');background-repeat: no-repeat;">
                                    <div class="row">
                                      <div class="col-md-12 text-center">
                                        <img src="../../public/etc/images/system/logo-black1.png" class="" width="100">
                                        <h1 class="text-info mt-3" style="font-family: 'Junction'; "><i>Certificate of Employment</i></h1>
                                        <p class="mt-4" style="font-size: 20px">This is to certify that <span id="passerGreet"></span>.</p>
                                        <h2 class="text-primary mt-5"><u id="passerNameCOE">Pablo Franco</u></h2>
                                        <p class="mt-5" style="font-size: 20px">has been employed by <span id="seekerGreet"></span>.</p>
                                        <h2 class="text-dark mt-5"><u id="seekerNameCOE">Gemma Prialde</u></h2>
                                        <p class="mt-3" style="font-size: 20px">as a</p>
                                        <p class="mt-3 font-weight-bold" style="font-size: 25px"><u id="passerJobTitleCOE"></u></p>
                                        <p class=""> from 
                                          <b style="font-size:18px"><u id="startDateCOE">Start Date</u></b> to 
                                          <b style="font-size:18px"><u id="endDateCOE">End Date</u>.</b>
                                        </p>
                                        <p style="font-size: 13pt">This certification is being issued upon the request of the aforementioned name for whatever lawful purposes it may serve him/her best.</p>
                                        <p style="font-size: 13pt">Given this <u><?php echo date("d"); ?></u> st day of <u><?php echo date("M Y");?></u></p>
                                      </div>
                                    </div>
                                    <div class="row">
                                      <div class="col-md-12 text-center" style="background: #68a2ff">
                                      <small class="text-white font-weight-bold" style="font-size:12px; font-family: "Comic Sans MS", cursive, sans-serif">
                                        Certificate Tracking No: <u class="text-warning" id="trackingNumber">PM001</u>
                                      </small>
                                      <br>
                                        <small class="text-white font-weight-bold" style="font-size:12px; font-family: "Comic Sans MS", cursive, sans-serif">
                                        PassersMate Tel.No: 266-81-34
                                      </small>
                                      <br>
                                        <small class="text-white font-weight-bold" style="font-size:12px; font-family: "Comic Sans MS", cursive, sans-serif">
                                        Email address: <a href="" class="text-info">passersmate@gmail.com</a>
                                       </small>
                                      </div>
                                    </div>
                                  </div>
                                  </form>
                                  </div>
                                </div>
                              </div>
                            </div> 
                          </div>
                        </div>



                    </div>
                    <div class="modal-footer">
                     
                      <button type="button" class="btn btn-primary" id="acceptJobOffer">Okay</button>
                       <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                    </div>
                  </div>
                </div>
              </div>
                <!-- end of view coe Modal -->

              <!-- view coe Modal -->
              <div class="modal fade " id="viewCOECompletion" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg" role="document">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title" id="exampleModalLabel">Certificate of Completion</h5>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                    <div class="modal-body">



                      <div class="container-fluid">
                        <div class="row">
                          <div class="col-md-12">
                            <div class="row">
                              <div class="col-md-12 mx-auto mt-5">
                                <div class="card">
                                  <div class="card-header" id="cardHeader">
                                     <a target="_blank" class="btn btn-success margin-5 float-right" id="printCompletion" href="">
                                        <i class="fas fa-print"></i> Download as PDF
                                    </a>
                                  </div>
                                  <form method="get" action="file.doc">
                                  <div class="card-body border border-dark" style="background-image:url('../../public/etc/images/system/coe2.png');background-repeat: no-repeat;">
                                    <div class="row">
                                      <div class="col-md-12 text-center">
                                        <img src="../../public/etc/images/system/logo-black1.png" class="" width="100">
                                        <h1 class="text-info mt-3" style="font-family: 'Junction'; "><i>Certificate of Employment</i></h1>
                                        <p class="mt-4" style="font-size: 20px">This is to certify that <span id="passerGreetCompletion"></span>.</p>
                                        <h2 class="text-primary mt-5"><u id="passerNameCompletion">Pablo Franco</u></h2>
                                        <p class="mt-5" style="font-size: 20px">In Recognition of successful completion of job offered by <span id="seekerGreetCompletion"></span></p>
                                        <h2 class="text-dark mt-5"><u id="seekerNameConfirmation">Gemma Prialde</u></h2>
                                        <p class="mt-3" style="font-size: 20px">as a</p>
                                        <p class="mt-3 font-weight-bold" style="font-size: 25px"><u id="passerJobTitleCompletion"></u></p>
                                        <p class=""> from 
                                          <b style="font-size:18px"><u id="startDateCompletion">Start Date</u></b> to 
                                          <b style="font-size:18px"><u id="endDateCompletion">End Date</u>.</b>
                                        </p>
                                        <p style="font-size: 13pt">This certification is being issued upon the request of the aforementioned name for whatever lawful purposes it may serve him/her best.</p>
                                        <p style="font-size: 13pt">Given this <u><?php echo date("jS"); ?></u> day of <u><?php echo date("M Y");?></u></p>
                                      </div>
                                    </div>
                                    <div class="row">
                                      <div class="col-md-12 text-center" style="background: #68a2ff">
                                      <small class="text-white font-weight-bold" style="font-size:12px; font-family: "Comic Sans MS", cursive, sans-serif">
                                        Certificate Tracking No: <u class="text-warning" id="trackingNumberCompletion">PM001</u>
                                      </small>
                                      <br>
                                        <small class="text-white font-weight-bold" style="font-size:12px; font-family: "Comic Sans MS", cursive, sans-serif">
                                        PassersMate Tel.No: 266-81-34
                                      </small>
                                      <br>
                                        <small class="text-white font-weight-bold" style="font-size:12px; font-family: "Comic Sans MS", cursive, sans-serif">
                                        Email address: <a href="" class="text-info">passersmate@gmail.com</a>
                                       </small>
                                      </div>
                                    </div>
                                  </div>
                                  </form>
                                  </div>
                                </div>
                              </div>
                            </div> 
                          </div>
                        </div>



                    </div>
                    <div class="modal-footer">
                     
                      <button type="button" class="btn btn-primary" id="acceptJobOffer">Okay</button>
                       <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                    </div>
                  </div>
                </div>
              </div>
                <!-- end of view coe Modal -->

                  <!-- Decline Modal -->
              <div class="modal fade" id="decline" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title" id="exampleModalLabel">Decline Job Offer</h5>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                    <div class="modal-body">
                      <p>Are you sure you want to decline the job offered Mate?</p>
                      <small class="text-danger">Note: Once you decline, you cannot undo it.</small>
                    </div>
                    <div class="modal-footer">
                     
                      <button type="button" class="btn btn-primary yesCancel">Okay</button>
                       <button type="button" class="btn btn-secondary">Cancel</button>
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
             <small class="font-weight-bold text-info">Note: Cancellation is approved only if the seeker agreed to do so, otherwise cancellation cannot be process.</small><br>
            Are you sure you want to cancel your job?<br><br>
            If cancel, please tell us the reason.
             <textarea class="form-control" id="exampleFormControlTextarea1" rows="3"></textarea>
          </div>
          <div class="modal-footer">
            <button type="submit" class="btn btn-primary">Yes</button>
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
                      <u class="font-weight-bold" id="cancelName"></u> who offered you a job<u class="font-weight-bold" id="jobtitleName"></u> is requesting to cancel the job for the reason of 
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


</body>

</html>