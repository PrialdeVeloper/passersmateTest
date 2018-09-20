<?php
if(isset($data) && !empty($data)){
    extract($data[0]);
    if(isset($userDetails) && !empty($userDetails)){
      extract($userDetails[0]);
    }
}  
require "../public/header-footer/seeker/seekerHeader1.marvee";
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
                <div class="col-md-12">
                  <div class="row">
                    <div class="col-md-6 mx-auto mt-5">
                      <a href="<?php echo $dashboard; ?>"><h5><u>Back to your Dashboard</u></h5></a>
                      <div class="card shadow">
                        <div class="card-header">
                          <h5><i class="fas fa-user"></i> Account Settings</h5>
                        </div>
                        <hr>
                        <div class="card-body">
                          <div class="row">
                            <div class="col-md-12">
                              <div class="form-group row font-weight-bold" style="font-size: 15px">
                                <div class="col-md-3">
                                  <label>Name</label>
                                </div>
                                 <div class="col-md-8">
                                  <p><?php echo ucwords((isset($SeekerFN)?$SeekerFN." " . $SeekerLN:$PasserFN. " ".$PasserMname.". " . $PasserLN))?></p>
                                </div>
                              </div>
                               <div class="form-group row font-weight-bold" style="font-size: 15px">
                                <div class="col-md-3">
                                  <label>Email Address</label>
                                </div>
                                 <div class="col-md-6">
                                  <p><?php echo (isset($SeekerEmail)?$SeekerEmail:$PasserEmail); ?></p>
                                </div>
                                 <div class="col-md-3 accordion">
                                    <a role= "button" class="collapsed font-weight-bold text-success" data-toggle="collapse" data-target="#email" aria-expanded="false" aria-controls="email"  style="font-size: 16px"><u><small>Change email address</small></u></a>
                                </div>
                              </div>
                              <!-- ACCORDION CHANGE EMAIL ADDRESS -->
                              <form id="emailPersonalDetailsChange">
                                  <div class="row bg-light ">
                                    <div class="col-md-12">
                                        <div id="email" class="collapse"  data-parent="#email">
                                        <div class="form-group row ">
                                          <div class="col-md-3 mt-2">
                                            <label>New Email Address</label>
                                          </div>
                                           <div class="col-md-9 mt-2">
                                            <input type="text" name="accountSettingsEmail">
                                          </div>
                                        </div>
                                        <div class="form-group row">
                                          <div class="col-md-10 font-weight-bold" style="font-size:16px">
                                          <small class="text-danger">For your security, you must re-enter your password to continue.</small>
                                          </div>
                                        </div>
                                         <div class="form-group row">
                                          <div class="col-md-3 mt-2">
                                            <label>Password</label>
                                          </div>
                                           <div class="col-md-9 mt-2">
                                            <input type="password" name="accountSettingsEmailPassword">
                                          </div>
                                        </div>
                                         <div class="form-group row">
                                          <div class="col-md-12">
                                             <button type="submit" class="btn btn-primary" data-dismiss="modal">Change Email</button>
                                          </div>
                                        </div>
                                      </div>
                                    </div>
                                  </div>
                                </form>
                                <!-- END OF ACCORDION CHANGE EMAIL ADDRESS -->
                                <form id="cpnoPersonalDetailsChange">
                                 <div class="form-group row font-weight-bold" style="font-size: 15px">
                                  <div class="col-md-3">
                                    <label>Phone Number</label>
                                  </div>
                                   <div class="col-md-6">
                                    <p>+63 <?php echo (isset($SeekerCPNo)?$SeekerCPNo:$PasserCPNo); ?></p>
                                  </div>
                                   <div class="col-md-3">
                                       <a role= "button" class="collapsed font-weight-bold text-success" data-toggle="collapse" data-target="#number" aria-expanded="false" aria-controls="number"  style="font-size: 16px"><u><small>Change phone number</small></u></a>
                                  </div>
                                </div>
                                <!-- ACCORDION CHANGE CONTACT NUMBER-->
                                <div class="row bg-light ">
                                  <div class="col-md-12">
                                      <div id="number" class="collapse"  data-parent="#number">
                                      <div class="form-group row ">
                                        <div class="col-md-3 mt-2">
                                          <label>New Phone Number</label>
                                        </div>
                                         <div class="col-md-9 mt-2">
                                          +63 <input type="text" name="accountSettingsCPNo">
                                        </div>
                                      </div>
                                      <div class="form-group row">
                                        <div class="col-md-10 font-weight-bold" style="font-size:16px">
                                        <small class="text-danger">For your security, you must re-enter your password to continue.</small>
                                        </div>
                                      </div>
                                       <div class="form-group row">
                                        <div class="col-md-3 mt-2">
                                          <label>Password</label>
                                        </div>
                                         <div class="col-md-9 mt-2">
                                          <input type="password" name="accountSettingsCPNoPassword">
                                        </div>
                                      </div>
                                       <div class="form-group row">
                                        <div class="col-md-12">
                                           <button type="submit" class="btn btn-primary" data-dismiss="modal">Change number</button>
                                        </div>
                                      </div>
                                    </div>
                                  </div>
                                </div>
                              </form>
                              <!-- END OF ACCORDION CONTACT NUMBER -->
                              <hr>
                               <div class="form-group row font-weight-bold p-0" style="font-size: 15px">
                                <div class="col-md-12">
                                 <div class="card">
                                  <a href="" role= "button" class="collapsed font-weight-bold text-info" data-toggle="collapse" data-target="#password" aria-expanded="false" aria-controls="password">
                                   <div class="card-header">
                                     <p>Change Password <i class="fas fa-key"></i></p>
                                   </div>
                                  </a>
                                 </div>
                                </div>
                              </div>
                               <!-- ACCORDION CHANGE PASSWORD-->
                              <form id="passwordPersonalDetailsChange">
                                <div class="row bg-light ">
                                  <div class="col-md-12">
                                      <div id="password" class="collapse"  data-parent="#password">
                                         <div class="form-group row">
                                        <div class="col-md-10 font-weight-bold" style="font-size:16px">
                                        <small class="text-danger">It's a good idea to use a strong password that you're not using elsewhere.</small>
                                        </div>
                                     </div>
                                      <div class="form-group row ">
                                        <div class="col-md-3">
                                          <label>Current Password</label>
                                        </div>
                                         <div class="col-md-9">
                                          <input type="Password" name="accountSettingsCurrentPassword">
                                        </div>
                                      </div>
                                       <div class="form-group row">
                                        <div class="col-md-3 mt-2">
                                          <label>New Password</label>
                                        </div>
                                         <div class="col-md-9 mt-2">
                                          <input type="password" name="accountSettingsNewPassword">
                                        </div>
                                      </div>
                                        <div class="form-group row">
                                        <div class="col-md-3 mt-2">
                                          <label>Re-type new</label>
                                        </div>
                                         <div class="col-md-9 mt-2">
                                          <input type="password" name="accountSettingsNewPasswordAgain">
                                        </div>
                                      </div>
                                      <hr>
                                       <div class="form-group row">
                                        <div class="col-md-12">
                                           <button type="submit" class="btn btn-primary" data-dismiss="modal">Change password</button>
                                        </div>
                                      </div>
                                    </div>
                                  </div>
                                </div>
                                <hr>
                              </form>
                              <!-- END OF ACCORDION CHANGE PASSWORD -->
                               <div class="form-group row font-weight-bold p-0" style="font-size: 15px">
                                <div class="col-md-12">
                                 <div class="card">
                                  <a href="" role= "button" class="collapsed font-weight-bold text-info" data-toggle="collapse" data-target="#deact" aria-expanded="false" aria-controls="deact">
                                   <div class="card-header">
                                     <p><u>Deactivate your account</u></p>
                                   </div>
                                  </a>
                                 </div>
                                </div>
                              </div>
                                   <!-- ACCORDION STATUS-->
                              <form id="statusPersonalDetailsChange">
                                <div class="row bg-light ">
                                  <div class="col-md-12">
                                      <div id="deact" class="collapse"  data-parent="#deact">
                                         <div class="form-group row">
                                        <div class="col-md-12 font-weight-bold" style="font-size:16px">
                                        <small class="text-danger">Deactivating your account will disable your profile and remove your name and photo from the PassersMate search area. Some information may still be visible to other users, such as your name in their transaction list and messages you sent.</small>
                                        </div>
                                     </div>
                                      <div class="form-group row">
                                        <div class="col-md-3">
                                          <label>Password</label>
                                        </div>
                                         <div class="col-md-9">
                                          <input type="Password" name="accountSettingsStatusPassword"><br>
                                          <small class="text-danger">For your security, you must re-enter your password to continue.</small>
                                        </div>
                                      </div>
                                        <div class="form-group row">
                                        <div class="col-md-3">
                                          <label>Reason for leaving</label>
                                        </div>
                                         <div class="col-md-9">
                                          <select class="custom-select" name="accountSettingsStatusReason">
                                            <option selected>Click this area</option>
                                            <option value="Temporary">This is temporary, I'll be back</option>
                                            <option value="unNeeded">I don't need this anymore</option>
                                            <option value="unUseful">I don't find PassersMate useful</option>
                                            <option value="noJobs">I don't get jobs</option>
                                          </select>
                                        </div>
                                      </div>
                                      <hr>
                                       <div class="form-group row">
                                        <div class="col-md-12">
                                           <button type="submit" class="btn btn-primary font-weight-bold" data-dismiss="modal">Deactivate</button>
                                        </div>
                                      </div>
                                    </div>
                                  </div>
                                </div>
                                <hr>
                              </form>
                                <!-- END OF ACCORDION STATUS -->
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                 </div>
              </div>
            </div>
             <!-- End Container flsuid  -->

    <!-- ============================================================== -->
    <!-- End Wrapper -->
    <!-- ============================================================== -->
    <!-- ============================================================== -->
    <!-- All Jquery -->
    <!-- ============================================================== -->
    <!-- Bootstrap tether Core JavaScript -->
    <script src="../etc/subscription/js/custom.min.js"></script>
    <!--Custom JavaScript -->
    <!-- this page js -->
    <script src="../etc/subscription/build/toastr.min.js"></script>