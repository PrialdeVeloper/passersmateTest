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
    
    <link href="build/toastr.min.css" rel="stylesheet">
  <style type="text/css">
    .scroll{
    height:220px;
    overflow-y: scroll;
    overflow-x: hidden;
  }
  .checked {
    color: orange;
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
	              	<h4><a href="<?=$destination;?>" class="ml-5"><u>Back to your Dashboard</u></a></h4>
	              	<h3 class="text-center mb-5 mt-5">Your Ratings and Reviews</h3>
	              	<h4 class="text-center mb-3"><?=$total;?></h4>
	              	<div class="col-md-10 mx-auto">
	              		<div class="row">
		                	<?=$dom;?>
			                </div>
	                </div>
	              </div>
              </div>
              <div class="d-flex justify-content-center">
	              	<?=$pagination;?>
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