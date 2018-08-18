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
              <div class="col-md-12 mt-5">
                <div class="col-md-8 mx-auto">
                  <a href="<?php echo $destination; ?>"><h4><u>Back to Dashboard</u></h4></a>
                  <hr>
                  <img src="../etc/images/system/paypal.png" class="mb-3" width="120px">
                  <div class="card shadow">
                  <div class="card-header text-white" style="background:#84b3ff">
                    <h5>MY BILLING HISTORY</h5>
                  </div>
                  <div class="card-body text-center bg-white">
                    <div class="row font-weight-bold" style="font-size: 15px">
                      <div class="col-sm-3">
                        <p>Subscription Name</p>
                      </div>
                      <div class="col-sm">
                        <p>Amount</p>
                      </div>
                      <div class="col-sm">
                        <p>Date Subscribed</p>
                      </div>
                      <div class="col-sm">
                        <p>Date End</p>
                      </div>
                      <div class="col-sm">
                        <p>Status</p>
                      </div>
                    </div>
                    <hr>
                     <?php echo $billingHistory; ?>
                    <div class="row float-right">
                      <div class="col-md-12">
                      <?php echo $pagination; ?>
                      </div>
                    </div>
                    </div>
                  </div>
                </div>
                </div>
              </div>
            </div>
</body>

</html>