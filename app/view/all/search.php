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
					<div class="col-sm text-center lead">Page <span id="currentPagePasser"></span> of <span id="resultCountPasser"></span></div>
					<div class="col justify-content-center d-flex mt-4">
						<nav aria-label="..." id="paginationSearchPasser">
						  
						</nav>
					</div>
					<div class="col">
						<div class="row" id="passerListContent">
							<?=$passerListAll;?>
						</div>
					</div>
				</div>
			</div>
<?php 
	require "../public/header-footer/seeker/seekerFooter.marvee";
?>