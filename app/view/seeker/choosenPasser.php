<?php 
if(isset($data) && !empty($data)){
  extract($data[0]);
  if(isset($userDetails) && !empty($userDetails)){
    extract($userDetails[0]);
  }
} 
require "../public/header-footer/seeker/seekerHeader.marvee";
?>
<!DOCTYPE html>
<html dir="ltr" lang="en">

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
    <link href="css/style.min.css" rel="stylesheet">
    <link href="build/toastr.min.css" rel="stylesheet">
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
              <div class="col-md-12 mt-5">
                <div class="col-md-10 mx-auto">
                  <a href="dashboard"><h4><u>Back to Dashboard</u></h4></a>
                  <hr>
                  <div class="card shadow">
                  <div class="card-header text-white" style="background:#84b3ff">
                    <h5>MY CHOOSEN PASSERS</h5>
                  </div>
                  <div class="card-body text-center bg-white">
                    <div class="row font-weight-bold" style="font-size: 15px">
                      <div class="col-sm-3">
                        <p>Image</p>
                      </div>
                      <div class="col-sm-2">
                        <p>Passer's Name</p>
                      </div>
                      <div class="col-sm-2">
                        <p>Job Title</p>
                      </div>
                      <div class="col-sm-2">
                        <p>Date of the Job Offered</p>
                      </div>
                      <div class="col-sm-1">
                        <p>Status</p>
                      </div>
                      <div class="col-sm-2">
                        <p>Action</p>
                      </div>
                    </div>
                    <hr>
                     <div class="row" style="font-size: 15px">
                      <div class="col-sm-3">
                        <img src="h1.png" width="60px">
                      </div>
                      <div class="col-sm-2">
                        <p>Marvee Yofa Franco</p>
                      </div>
                      <div class="col-sm-2">
                        <p>Chef</p>
                      </div>
                      <div class="col-sm-2">
                        <p>11/06/2018</p>
                      </div>
                      <div class="col-sm-1">
                        <p class="text-center"><span class="badge badge-success font-weight-bold">Hired</span></p>
                      </div>
                      <div class="col-sm-2">
                       <a href="" data-toggle="modal" data-target="#update" title="Update Status"><h6><u>Update</u></h6></a>
                       <a href="" data-toggle="modal" data-target="#delete" title="Remove"><h6><u>Delete</u></h6></a>
                      </div>
                    </div>
                       <hr>
                     <div class="row" style="font-size: 15px">
                      <div class="col-sm-3">
                        <img src="h1.png" width="60px">
                      </div>
                      <div class="col-sm-2">
                        <p>Marvee Yofa Franco</p>
                      </div>
                      <div class="col-sm-2">
                        <p>Chef</p>
                      </div>
                      <div class="col-sm-2">
                        <p>11/06/2018</p>
                      </div>
                      <div class="col-sm-1">
                        <p class="text-center"><span class="badge badge-warning font-weight-bold">Pending</span></p>
                      </div>
                      <div class="col-sm-2">
                       <a href="" data-toggle="modal" data-target="#update" title="Update Status"><h6><u>Update</u></h6></a>
                       <a href="" data-toggle="modal" data-target="#delete" title="Remove"><h6><u>Delete</u></h6></a>
                      </div>
                    </div>
                    <hr>

                     <div class="row" style="font-size: 15px">
                      <div class="col-sm-3">
                        <img src="h1.png" width="60px">
                      </div>
                      <div class="col-sm-2">
                        <p>Marvee Yofa Franco</p>
                      </div>
                      <div class="col-sm-2">
                        <p>Chef</p>
                      </div>
                      <div class="col-sm-2">
                        <p>11/06/2018</p>
                      </div>
                      <div class="col-sm-1">
                        <p class="text-center"><span class="badge badge-danger font-weight-bold">Cancelled</span></p>
                      </div>
                      <div class="col-sm-2">
                       <a href="" data-toggle="modal" data-target="#update" title="Update Status"><h6><u>Update</u></h6></a>
                       <a href="" data-toggle="modal" data-target="#delete" title="Remove"><h6><u>Delete</u></h6></a>
                      </div>
                    </div>
                    <hr>
                    <div class="row" style="font-size: 15px">
                      <div class="col-md-12">
                        <div class="alert alert-danger" role="alert">
                          You haven't choose Passer at the moment.
                        </div>
                      </div>
                    </div>
                    <div class="row float-right">
                      <div class="col-md-12">
                        <ul class="pagination">
                          <li class="page-item disabled">
                            <a class="page-link" href="#" tabindex="-1">Previous</a>
                          </li>
                          <li class="page-item"><a class="page-link" href="#">1</a></li>
                          <li class="page-item active">
                            <a class="page-link" href="#">2 <span class="sr-only">(current)</span></a>
                          </li>
                          <li class="page-item"><a class="page-link" href="#">3</a></li>
                          <li class="page-item">
                            <a class="page-link" href="#">Next</a>
                          </li>
                        </ul>
                      </div>
                    </div>
                    </div>
                  </div>
                </div>
                </div>
              </div>
            </div>
             <!-- End Container flsuid  -->

            <!-- MODALS -->
        <!-- MODAL DELETE -->
        <div class="modal fade" id="delete" tabindex="-1" role="dialog" aria-labelledby="delete" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header bg-danger">
            </div>
            <div class="modal-body font-weight-bold">
              <p style="font-size:15px">Are you sure you want to remove this one?</p>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" onclick="toastr.success('You have successfully remove it');" data-dismiss="modal">Yes</button>
              <button type="button" class="btn btn-primary" data-dismiss="modal">No</button>
            </div>
          </div>
        </div>
      </div>
      <!-- END OF MODAL DELETE -->
       <!-- MODAL UPDATE -->
            <!-- Modal -->
                <div class="modal fade bd-example-modal-sm" id="update" tabindex="-1" role="dialog" aria-labelledby="update" aria-hidden="true">
                  <div class="modal-dialog modal-sm" role="document">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h4 class="modal-title">Update the Status</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div>
                      <div class="modal-body">
                        <form>
                          <div class="form-group col-md-12">
                            <label for="inputState">Status</label>
                            <select id="inputState" class="form-control">
                              <option selected>Hired</option>
                              <option>Pending</option>
                              <option>Cancelled</option>
                            </select>
                          </div>
                        </form> 
                      </div>
                      <div class="modal-footer">
                        <button type="button" class="btn btn-primary" data-dismiss="modal" onclick="toastr.success('You have successfully update the status');">Save</button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                      </div>
                    </div>
                    </div>
                  </div>
                </div>
            </div>
        </div>
            <!-- END OF MODAL UPDATE -->
             
         
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
    <script src="dist/jquery.min.js"></script>
    <!-- Bootstrap tether Core JavaScript -->
    <script src="popper.js/dist/umd/popper.min.js"></script>
    <script src="bootstrap/dist/js/bootstrap.min.js"></script>
    <!--Custom JavaScript -->
    <script src="js/custom.min.js"></script>
    <!-- this page js -->
    <script src="build/toastr.min.js"></script>
        <?php
  require "../public/header-footer/seeker/seekerFooter.marvee";
?>
    <script>
        $(function(){
            // Success Type
            $('#ts-success').on('click', function() {
                toastr.success('You have successfully sent a job offer to your choosen passer');
            });

            // Success Type
            $('#ts-info').on('click', function() {
                toastr.info('We do have the Kapua suite available.', 'Turtle Bay Resort');
            });

            // Success Type
            $('#ts-warning').on('click', function() {
                toastr.warning('My name is Inigo Montoya. You killed my father, prepare to die!');
            });

            // Success Type
            $('#ts-error').on('click', function() {
                toastr.error('I do not think that word means what you think it means.', 'Inconceivable!');
            });
        });
    </script>
    <script>
  // Example starter JavaScript for disabling form submissions if there are invalid fields
  (function() {
    'use strict';
    window.addEventListener('load', function() {
      // Fetch all the forms we want to apply custom Bootstrap validation styles to
      var forms = document.getElementsByClassName('needs-validation');
      // Loop over them and prevent submission
      var validation = Array.prototype.filter.call(forms, function(form) {
        form.addEventListener('submit', function(event) {
          if (form.checkValidity() === false) {
            event.preventDefault();
            event.stopPropagation();
          }
          form.classList.add('was-validated');
        }, false);
      });
    }, false);
  })();
  </script>
</body>

</html>