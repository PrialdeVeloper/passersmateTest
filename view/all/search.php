<?php 
	require "../header-footer/seeker/seekerHeader.marvee";
	require "../header-footer/jobsNav.marvee";
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
									<option value="Others">Others</option>
									<option value="Rather not say">Rather Not Say</option>
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
		</div>
	</div>

	
	<div class="container mt-5">
		<div class="row">
			<div class="col-4 border h-100">
				<div id="sidebar">
					<div class="form-group">
						<label for="location">Location:</label>
						<select id="location" class="form-control" name="location">
							<option value="entirePH" selected>Entire Philippines</option>
							<option value="cebu">Cebu</option>
							<option value="davao">Davao</option>
							<option value="bohol">Bohol</option>
						</select>
					</div>
				</div>
			</div>
			<div class="border col">
				<div class="row">
					<div class="col shadowDiv border">
						<div class="row">
							<div class="col">
								<img class="img-fluid rounded" src="../etc/images/user/marvee.jpg">
							</div>
							<div class="col">
								
							</div>
						</div>
					</div>
					<div class="col offset-sm-1 shadowDiv border">
						qwe
					</div>
				</div>
			</div>
		</div>
	</div>


<?php 
	require "../header-footer/seeker/seekerFooter.marvee";
?>