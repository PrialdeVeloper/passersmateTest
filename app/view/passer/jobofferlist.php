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
                     
                      <button type="button" class="btn btn-primary" onclick="toastr.success('You successfully accept the job offered, this will be notified to the seeker');" data-dismiss="modal">Okay</button>
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
                     
                      <button type="button" class="btn btn-primary" onclick="toastr.success('You successfully declined the job offered, this will be notified to the seeker');" data-dismiss="modal">Okay</button>
                       <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                    </div>
                  </div>
                </div>
              </div>
                <!-- End Decline Modal -->
</body>

</html>