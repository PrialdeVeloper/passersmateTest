<?php 
if(isset($data) && !empty($data)){
	extract($data[0]);
	if(isset($userDetails) && !empty($userDetails)){
		extract($userDetails[0]);
	}
} 
require "../public/header-footer/seeker/seekerHeader.marvee";
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
    <title>Matrix Template - The Ultimate Multipurpose admin template</title>
    <!-- Custom CSS -->
    <!-- <link href="../etc/subscription/css/style.min.css" rel="stylesheet"> -->
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
            		<div class="col-md-3"></div>
            		<div class="col-md-6">
    				<div class="row">
        				<div class="col-md-8 mt-5">
        					<a href="dashboard">
        						<h6><u>Back to your Dashboard</u></h6>
        					</a>
        					<br>
        				</div>
        				<div class="col-md-4 mt-5">
    						<button type="button" class="btn btn-success font-weight-bold" data-toggle="modal" data-target="#create">
    						<i class="fas fa-plus"></i> Create New JO Form
    						</button>
        					<br>
        				</div>
    				</div>
    				<hr class="mt-0">
    				<div class="row">
    					<div class="col-md-12">
        				 <div class="card  border-top">
                            <div class="card-header" id="headingTwo">
                              <h5>
                              	Choose your JO Form
                              </h5>
                            </div>
                            <div>
                            	<?=$jobOfferFormDom;?>
                            </div>
                        </div>
    				</div>
    				</div>
    				<div class="d-flex justify-content-center mt-3">
    				<div class="row">
    					<div class="col-md-6">
			            	<?=$paginationDom;?>
						</div>
					</div>
					</div>
            	</div>
				</div>
            </div>
            <!-- End Container fluid  -->
                <!-- MODAL UPDATE -->
		    <!-- Modal -->
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
			</div>
			<!-- END OF MODAL UPDATE -->

			   <!-- MODAL CREATE -->
		    <!-- Modal -->
				<div class="modal fade" id="create" tabindex="-1" role="dialog" aria-labelledby="CREATE" aria-hidden="true">
				  <div class="modal-dialog" role="document">
				    <div class="modal-content">
				      <div class="modal-header">
				        <h5 class="modal-title">Your JO Form</h5>
				        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
				          <span aria-hidden="true">&times;</span>
				        </button>
				      </div>
				      <form id="joFormCreate">
					      <div class="modal-body">
					        <div class="row">
	                			<div class="col-md-12 text-white" style="background:#84b3ff;">
								    <div class="form-group row col-md-12 mt-2">
								      <label for="workAddressCreate" class="font-weight-bold">Working Address</label>
								      <input type="text" class="form-control shadow" id="workAddressCreate">
								    </div>
								    <div class="form-group row">
								   		<div class="col-md-6 mt-2">
									      <label for="workCreateDateStart" class="font-weight-bold"> Start Date</label>
									      <input type="date" class="form-control shadow" id="workCreateDateStart">
								     	 </div>
									    <div class="form-group col-md-6 mt-2">
									      <label for="workCreateDateEnd" class="font-weight-bold"> End Date</label>
									      <input type="date" class="form-control shadow" id="workCreateDateEnd">
									    </div>
									</div>
									<div class="form-group row">
								   		<div class="col-md-6 mt-2">
									      <label for="salaryCreate" class="font-weight-bold"> Salary</label>
										     <div class="input-group mb-3">
											  <div class="input-group-prepend">
											    <span class="input-group-text" id="basic-addon1">
											    	<span>&#8369;</span>
											    </span>
											  </div>
											  <input type="text" class="form-control" id="salaryCreate"  aria-describedby="basic-addon1">
											</div>
								     	 </div>
									    <div class="form-group col-md-6 mt-2">
									      <label for="jobTitle" class="font-weight-bold"> Payment Method
									      </label>
									      <select class="custom-select mr-sm-2" id="paymentMethod">
									        <option selected value="Online">Online</option>
									        <option value="Onsite">Onsite</option>
									      </select>
									    </div>
									</div>
									<div class="form-group row col-md-12 mt-2">
								      <label for="accomodationType" class="font-weight-bold">Accomodation Type</label>
								      <select class="custom-select" id="accomodationType">
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
			</div>
			<!-- END OF MODAL CREATE -->

              <!-- MODAL DELETE -->
			  <div class="modal fade" id="delete" tabindex="-1" role="dialog" aria-labelledby="delete" aria-hidden="true">
			  <div class="modal-dialog" role="document">
			    <div class="modal-content">
			      <div class="modal-header bg-danger">
			      </div>
			      <div class="modal-body font-weight-bold">
			        <p>Are you sure you want to delete this one?</p>
			      </div>
			      <div class="modal-footer">
			        <button type="button" class="btn btn-secondary" onclick="toastr.success('You have successfully deleted the JO Form');" data-dismiss="modal">Yes</button>
			        <button type="button" class="btn btn-primary" data-dismiss="modal">No</button>
			      </div>
			    </div>
			  </div>
			</div>
			<!-- END OF MODAL DELETE -->

    <!-- ============================================================== -->
    <!-- End Wrapper -->
    <!-- ============================================================== -->
    <!-- ============================================================== -->
    <!-- All Jquery -->
    <!-- ============================================================== -->
    <script src="../etc/bootstrap/js/jquery-3.3.1.js"></script>
    <!-- Bootstrap tether Core JavaScript -->
    <script src="../etc/bootstrap/js/popper.min.js"></script>
    <!--Custom JavaScript -->
    <script src="../etc/subscription/js/custom.min.js"></script>
    <!-- this page js -->
    <script src="../etc/subscription/build/toastr.min.js"></script>
    <script type="text/javascript" src="../etc/custom-js.js"></script>
<?php
	require "../public/header-footer/seeker/seekerFooter.marvee";
?>