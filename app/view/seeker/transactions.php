<?php 
if(isset($data) && !empty($data)){
  extract($data[0]);
  if(isset($userDetails) && !empty($userDetails)){
    extract($userDetails[0]);
  }
} 
require "../public/header-footer/seeker/seekerHeader1.marvee";
?>
<!DOCTYPE html>
<html>
<head>
</head>
<body>
	<div class="container-fluid">
		<div class="row mt-5">

			<div class="col-md-12">
				<h5 class="ml-5"><a href=""><u>Back to your Dashboard</u></a></h5>
				<h4 class="text-center">Transaction Histories</h4>
				<div class="col-md-10 mx-auto">
					<div class="row">
						<div class="col-md-9 mx-auto">
						<div class="card shadow mb-5">
							<div class="card-header">
								<div class="col-md-5"> 
									<input class="form-control" id="myInput" type="text" placeholder="Search..">
									<small class="font-weight-bold">
										Type offer a job, accept, hired, updating, cancel.
									</small>
								</div>
								
								<br>
							</div>
							<div class="card-body">
								<div class="table-container">
									<table class="table">
										<tbody id="myTable">
											<tr>
												<td>
													<h6>
														<span class="badge badge-primary">Updating Job Offer</span>
													</h6>
													<small class="font-weight-bold">August 08, 2018 | 06:06 PM</small>
												</td>
												<td>
													<button class="btn btn-primary" data-toggle="modal" data-target="#update">View Details</button>
												</td>
											</tr>
											<tr>
												<td>
													<h6>
														<span class="badge badge-dark">Offer a Job</span>
													</h6>
													<small class="font-weight-bold">August 08, 2018 | 06:06 PM</small>
												</td>
												<td>
													<button class="btn btn-primary" data-toggle="modal" data-target="#offer">View Details</button>
												</td>
											</tr>
											<tr>
												<td>
													<h6>
														<span class="badge badge-info">Accepted Job Offer</span>
													</h6>
													<small class="font-weight-bold">August 08, 2018 | 06:06 PM</small>
												</td>
												<td>
													<button class="btn btn-primary" data-toggle="modal" data-target="#accepted">View Details</button>
												</td>
											</tr>

											<tr>
												<td>
													<h6>
														<span class="badge badge-success">Hired a Passer</span>
													</h6>
													<small class="font-weight-bold">August 08, 2018 | 06:06 PM</small>
												</td>
												<td>
													<button class="btn btn-primary" data-toggle="modal" data-target="#accepted">View Details</button>
												</td>
											</tr>

											<tr>
												<td>
													<h6>
														<span class="badge badge-danger">Cancellation of Job Offer</span>
													</h6>
													<small class="font-weight-bold">August 08, 2018 | 06:06 PM</small>
												</td>
												<td>
													<button class="btn btn-primary" data-toggle="modal" data-target="#cancel">View Details</button>
												</td>
											</tr>

											<tr>
												<td>
													<h6>
														<span class="badge badge-danger">Declined Job Offer</span>
													</h6>
													<small class="font-weight-bold">August 08, 2018 | 06:06 PM</small>
												</td>
												<td>
													<button class="btn btn-primary" data-toggle="modal" data-target="#decline">View Details</button>
												</td>
											</tr>
										</tbody>
									</table>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	
	<!-- MODALS -->

	<!-- Update -->
	<div class="modal fade" id="update" tabindex="-1" role="dialog"  aria-hidden="true">
	  <div class="modal-dialog" role="document">
	    <div class="modal-content">
	      <div class="modal-header">
	        <h5 class="modal-title" id="exampleModalLabel">Updating Job Offer</h5>
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
	          <span aria-hidden="true">&times;</span>
	        </button>
	      </div>
	      <div class="modal-body">
	        <small>Passer's Name:</small>
	        <small class="font-weight-bold">Marvee Yofa Franco</small>
	        <br>
	        <small>Working Title:</small>
	        <small class="font-weight-bold">Chef</small>
			<br>
	        <b>JOB OFFER</b>
	        <br>
	        <small>Working Address:</small>
	        <small class="font-weight-bold">Marvee Yofa Franco</small>
	        <br>
	        <small>Estimated Service Rate:</small>
	        <small class="font-weight-bold">Php 2,000 to Php 3,000</small>

	      </div>
	      <div class="modal-footer">
	      
	        <button type="button" class="btn btn-secondary" data-dismiss="modal">Okay</button>
	      </div>
	    </div>
	  </div>
	</div>

	<!-- Offer -->
	<div class="modal fade" id="offer" tabindex="-1" role="dialog"  aria-hidden="true">
	  <div class="modal-dialog" role="document">
	    <div class="modal-content">
	      <div class="modal-header">
	        <h5 class="modal-title" id="exampleModalLabel">Offer a Job</h5>
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
	          <span aria-hidden="true">&times;</span>
	        </button>
	      </div>
	      <div class="modal-body">
	        <small>Passer's Name:</small>
	        <small class="font-weight-bold">Marvee Yofa Franco</small>
	        <br>
	        <small>Working Title:</small>
	        <small class="font-weight-bold">Chef</small>
			<br>
	        <b>JOB OFFER</b>
	        <br>
	        <small>Working Address:</small>
	        <small class="font-weight-bold">Marvee Yofa Franco</small>
	        <br>
	        <small>Estimated Service Rate:</small>
	        <small class="font-weight-bold">Php 2,000 to Php 3,000</small>

	      </div>
	      <div class="modal-footer">
	      
	        <button type="button" class="btn btn-secondary" data-dismiss="modal">Okay</button>
	      </div>
	    </div>
	  </div>
	</div>

	<!-- Accept -->
	<div class="modal fade" id="accepted" tabindex="-1" role="dialog"  aria-hidden="true">
	  <div class="modal-dialog" role="document">
	    <div class="modal-content">
	      <div class="modal-header">
	        <h5 class="modal-title" id="exampleModalLabel">Accepted Job Offer</h5>
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
	          <span aria-hidden="true">&times;</span>
	        </button>
	      </div>
	      <div class="modal-body">
	        <small>Passer's Name:</small>
	        <small class="font-weight-bold">Marvee Yofa Franco</small>
	        <br>
	        <small>Working Title:</small>
	        <small class="font-weight-bold">Chef</small>
			<br>
	        <b>JOB OFFER</b>
	        <br>
	        <small>Working Address:</small>
	        <small class="font-weight-bold">Marvee Yofa Franco</small>
	        <br>
	        <small>Estimated Service Rate:</small>
	        <small class="font-weight-bold">Php 2,000 to Php 3,000</small>

	      </div>
	      <div class="modal-footer">
	      
	        <button type="button" class="btn btn-secondary" data-dismiss="modal">Okay</button>
	      </div>
	    </div>
	  </div>
	</div>

	<!-- Hired -->
	<div class="modal fade" id="hired" tabindex="-1" role="dialog"  aria-hidden="true">
	  <div class="modal-dialog" role="document">
	    <div class="modal-content">
	      <div class="modal-header">
	        <h5 class="modal-title" id="exampleModalLabel">Hired a Passer</h5>
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
	          <span aria-hidden="true">&times;</span>
	        </button>
	      </div>
	      <div class="modal-body">
	        <small>Passer's Name:</small>
	        <small class="font-weight-bold">Marvee Yofa Franco</small>
	        <br>
	        <small>Working Title:</small>
	        <small class="font-weight-bold">Chef</small>
			<br>
	        <b>JOB OFFER</b>
	        <br>
	        <small>Working Address:</small>
	        <small class="font-weight-bold">Marvee Yofa Franco</small>
	        <br>
	        <small>Estimated Service Rate:</small>
	        <small class="font-weight-bold">Php 2,000 to Php 3,000</small>

	      </div>
	      <div class="modal-footer">
	      
	        <button type="button" class="btn btn-secondary" data-dismiss="modal">Okay</button>
	      </div>
	    </div>
	  </div>
	</div>

	<!-- Cancel -->
	<div class="modal fade" id="cancel" tabindex="-1" role="dialog"  aria-hidden="true">
	  <div class="modal-dialog" role="document">
	    <div class="modal-content">
	      <div class="modal-header">
	        <h5 class="modal-title" id="exampleModalLabel">Cancellation of Job</h5>
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
	          <span aria-hidden="true">&times;</span>
	        </button>
	      </div>
	      <div class="modal-body">
	        <small>Passer's Name:</small>
	        <small class="font-weight-bold">Marvee Yofa Franco</small>
	        <br>
	        <small>Working Title:</small>
	        <small class="font-weight-bold">Chef</small>
			<br>
	        <b>JOB OFFER</b>
	        <br>
	        <small>Working Address:</small>
	        <small class="font-weight-bold">Marvee Yofa Franco</small>
	        <br>
	        <small>Estimated Service Rate:</small>
	        <small class="font-weight-bold">Php 2,000 to Php 3,000</small>

	      </div>
	      <div class="modal-footer">
	      
	        <button type="button" class="btn btn-secondary" data-dismiss="modal">Okay</button>
	      </div>
	    </div>
	  </div>
	</div>

		<!-- Decline -->
	<div class="modal fade" id="decline" tabindex="-1" role="dialog"  aria-hidden="true">
	  <div class="modal-dialog" role="document">
	    <div class="modal-content">
	      <div class="modal-header">
	        <h5 class="modal-title" id="exampleModalLabel">Declined of Job Offer</h5>
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
	          <span aria-hidden="true">&times;</span>
	        </button>
	      </div>
	      <div class="modal-body">
	        <small>Passer's Name:</small>
	        <small class="font-weight-bold">Marvee Yofa Franco</small>
	        <br>
	        <small>Working Title:</small>
	        <small class="font-weight-bold">Chef</small>
			<br>
	        <b>JOB OFFER</b>
	        <br>
	        <small>Working Address:</small>
	        <small class="font-weight-bold">Marvee Yofa Franco</small>
	        <br>
	        <small>Estimated Service Rate:</small>
	        <small class="font-weight-bold">Php 2,000 to Php 3,000</small>

	      </div>
	      <div class="modal-footer">
	      
	        <button type="button" class="btn btn-secondary" data-dismiss="modal">Okay</button>
	      </div>
	    </div>
	  </div>
	</div>
<script>
$(document).ready(function(){
  $("#myInput").on("keyup", function() {
    var value = $(this).val().toLowerCase();
    $("#myTable tr").filter(function() {
      $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
    });
  });
});
</script>

<?php
  require "../public/header-footer/seeker/seekerFooter.marvee";
?>