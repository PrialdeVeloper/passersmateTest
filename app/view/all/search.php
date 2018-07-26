<?php
	if(isset($data) && !empty($data)){
		extract($data[0]);
		if(isset($userDetails) && !empty($userDetails)){
			extract($userDetails[0]);
		}
	} 
	require_once "../public/header-footer/seeker/seekerHeader.marvee";
	require_once "../public/header-footer/jobsNav.marvee";
?>

			<div class="container pt-3">
				<div class="row justify-content-center">
					<div class="col-10">
						<form method="GET" action="#">
							<div class="row">
								<div class="col-sm">
									<div class="form-group">
										<label for="JOjobTitleModal">Job Title:</label>
										<input list="JOjobTitleModal" name="browser" class="form-control">
									  	<datalist id="JOjobTitleModal">
										    <option value="Carpenter">
										    <option value="BABOY">
										    <option value="MARVEE">
										    <option value="BAHO">
										    <option value="NAWNG">
									  	</datalist>
									</div>
								</div>
								<div class="col-sm">
									<div class="form-group">
										<label for="budget">Budget:</label>
										<input type="text" class="form-control" name="budget" id="budget">
									</div>
								</div>
								<div class="col-sm">
									<div class="form-group">
										<label for="gender">Gender:</label>
										<select id="gender" class="form-control" name="Gender">
											<option value="Male" selected>Male</option>
											<option value="Female">Female</option>
										</select>
									</div>
								</div>
								<div class="col-sm">
									<div class="form-group">
										<label for="sort">Sort By:</label>
										<select id="sort" class="form-control" name="sortBy">
											<option value="Relevance" selected>Relevance</option>
											<option value="Date">Date</option>
											<option value="Location Nearest">Location Nearest</option>
											<option value="Price">Price</option>
										</select>
									</div>
								</div>
							</div>
						</form>
					</div>
					<div class="col-10" id="moreOptionSearches">
						<div class="row">
							<div class="col-sm">
								<div class="form-group">
									<label for="JOjobTitleModal">Job Title:</label>
									<input list="JOjobTitleModal" name="browser" class="form-control">
								  	<datalist id="JOjobTitleModal">
									    <option value="Carpenter">
									    <option value="BABOY">
									    <option value="MARVEE">
									    <option value="BAHO">
									    <option value="NAWNG">
								  	</datalist>
								</div>
							</div>
							<div class="col-sm">
								<div class="form-group">
									<label for="budget">Budget:</label>
									<input type="text" class="form-control" name="budget" id="budget">
								</div>
							</div>
							<div class="col-sm">
								<div class="form-group">
									<label for="gender">Gender:</label>
									<select id="gender" class="form-control" name="Gender">
										<option value="Male" selected>Male</option>
										<option value="Female">Female</option>
									</select>
								</div>
							</div>
							<div class="col-sm">
								<div class="form-group">
									<label for="sort">Sort By:</label>
									<select id="sort" class="form-control" name="sortBy">
										<option value="Relevance" selected>Relevance</option>
										<option value="Date">Date</option>
										<option value="Location Nearest">Location Nearest</option>
										<option value="Price">Price</option>
									</select>
								</div>
							</div>
						</div>
					</div>
					<div class="col-10 pt-2 d-flex justify-content-center">
						<a href="passersMate#" id="otherOptions" class="text-primary border-bottom">Show Advanced Options</a>
					</div>
				</div>
			</div>
			<div class="container mt-5">
				<div class="col">
					<div class="col-sm text-center lead">Page 1 of 5</div>
					<div class="col justify-content-center d-flex mt-4">
						<nav aria-label="...">
						  <ul class="pagination">
						    <li class="page-item disabled">
						      <a class="page-link" href="#" tabindex="-1">Previous</a>
						    </li>
						    <li class="page-item active"><a class="page-link" href="#">1</a></li>
						    <li class="page-item">
						      <a class="page-link" href="#">2 <span class="sr-only">(current)</span></a>
						    </li>
						    <li class="page-item"><a class="page-link" href="#">3</a></li>
						    <li class="page-item">
						      <a class="page-link" href="#">Next</a>
						    </li>
						  </ul>
						</nav>
					</div>
					<div class="col">
						<div class="row">
							<div class="col-sm-6">
								<div class="container shadowDiv">
									<div class="row">
										<div class="col-md-4">
											<div class="container my-3 pl-3 d-flex justify-content-center">
												<img src="../../public/etc/images/user/pablo.jpg" class="profile">
											</div>
										</div>		
										<div class="col-md-7 mt-4">
											<div class="container text-center text-primary">
												<label class="georgiaFonts">Pablo Franco</label>
											</div>
											<div class="container text-center text-secondary">
												<label class="trebuchet">Carpenter from Pasil, Cebu City</label>
											</div>
											<div class="container text-center">
												<span class="fa fa-star text-warning"></span>
												<span class="fa fa-star text-warning"></span>
												<span class="fa fa-star text-warning"></span>
												<span class="fa fa-star text-warning"></span>
												<span class="fa fa-star text-warning"></span>
											</div>
										</div>	
									</div>
									<div class="col-md my-3">
										<div class="container text-center text-primary">Education, Trainings & Organizations</div>
										<div class="container text-center text-secondary">Carpentry NC II</div>
									</div>
									<div class="col-md">
										<hr>
									</div>
									<div class="col-md d-flex justify-content-center">
										<button type="button" class="btn btn-lg btn-primary mb-3">View Profile</button>
									</div>
								</div>
							</div>
							<div class="col-sm-6">
								<div class="container shadowDiv">
									<div class="row">
										<div class="col-md-4">
											<div class="container my-3 pl-3 d-flex justify-content-center">
												<img src="../../public/etc/images/user/marvee.jpg" class="profile">
											</div>
										</div>		
										<div class="col-md-7 mt-4">
											<div class="container text-center text-primary">
												<label class="georgiaFonts">Marvee Franco</label>
											</div>
											<div class="container text-center text-secondary">
												<label class="trebuchet">Analyst at QA(LOSLOS)</label>
											</div>
											<div class="container text-center">
												<span class="fa fa-star text-warning"></span>
												<span class="fa fa-star text-warning"></span>
												<span class="fa fa-star text-warning"></span>
												<span class="fa fa-star text-warning"></span>
												<span class="fa fa-star text-warning"></span>
											</div>
										</div>	
									</div>
									<div class="col-md my-3">
										<div class="container text-center text-primary">Education, Trainings & Organizations</div>
										<div class="container text-center text-secondary">Analyst NC-10000</div>
									</div>
									<div class="col-md">
										<hr>
									</div>
									<div class="col-md d-flex justify-content-center">
										<button type="button" class="btn btn-lg btn-primary mb-3">View Profile</button>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
<?php 
	require "../public/header-footer/seeker/seekerFooter.marvee";
?>