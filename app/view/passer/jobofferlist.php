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
</body>

</html>