<?php 
$Name = 'Marvee Franco';
$address = 'Sitio Gines (Wak Wak)';
$birthdate = 'August 01, 1522';
$contact = '126-2634-252';
$jtitle = "Asawa";
$sd = "Nov 6, 2017";
$ed = "Infinty";
$reviewer = "Pablo";
$rate = "Very Good!";
?>
<?php
	if(isset($data) && !empty($data)){
		// unset($data[0]);
		extract($data[0]);
		if(isset($userDetails) && !empty($userDetails)){
			extract($userDetails[0]);
			print_r($data);
		}
	} 
	require "../public/header-footer/seeker/seekerHeader1.marvee";
	require "modal/projectsModal.html";
?>
<!-- content -->
<div class="container-fluid my-5 bg-white">
	<!-- start of 1st row -->
	<!-- <div class="row justify-content-center ">
		<div class="col-md-10 p-0 ">
			<a href="dashboard"><h5><u>Back to your Dashboard</u></h5></a>
		</div>		
	</div> -->

	<div class="row justify-content-center">
		
		<div class="col-md-10  ">
			<div class="row  ">
				<div class="col-sm-6 ml-3 mt-2">
					<label ><h2 >My Projects</h2></label>
				</div>	
				<div class="col-sm-auto offset-3 mt-4">
					<a href="dashboard"><h5><u>Back to your Dashboard</u></h5></a>
				</div>					
			</div>
			
			<!-- <div class="row">
				<div class="row justify-content-center">
					<input class="form-control d-none inputImage5" name="projectImagePasser" type="file" id="addDetailsPasser5" accept="image/jpeg,image/png">
					<img src="../../public/etc/images/system/frontID.png" class="modalAddDetails rounded-circle" id="previewImage5">
				</div>
				<div class="row justify-content-center pt-2">
					<button type="button" class="btn btn-primary" id="substituteButton5">Upload Photo</button>
				</div>

				<div class="col-sm-3">
					<div class="d-flex justify-content-center">
						<img src="<?=!empty($PasserProfile)?$PasserProfile: '../../public/etc/images/system/calendar.png'?>" class="modalAddDetails" id="previewImage5">
					</div>
				</div>
				<div class="offset-1 col-sm-4 pt-3" id="uploadPhotoDiv">
					<button type="button" class="btn btn-primary" id="substituteButton5">Upload Photo</button>
					<input class="form-control d-none inputImage5" name="projectImagePasser" type="file" id="addDetailsPasser5" accept="image/jpeg,image/png">
				</div>
			</div> -->
			<div class="row">
				<div class="col-sm-4 cursor  p-3 form-group ">
					<div style="height: 250px" class="border">

						<div class="row justify-content-center">
							<input class="form-control d-none inputImage5" name="projectImagePasser" type="file" id="addDetailsPasser5" accept="image/jpeg,image/png">
							<!-- <img src="../../public/etc/images/system/calendar.png" class="modalAddDetails rounded-circle" id="previewImage5"> -->
						</div>						
						<div class="row justify-content-center" style="margin-top:100px;">
							<button type="button" class="btn btn-primary w-50 h-20" id="substituteButton5">Upload Photo</button>
						</div>
					</div>										
				</div>
				<div class="col-sm-4 cursor  p-3 form-group ">
					<div class="border">
						<img src="../../public/etc/images/system/frontID.png" class="modalAddDetails w-100 h-25" data-toggle="modal" data-target="#project" id="">
						<div class="p-3 justify-content-center clearfix">
							<h5>Project Title</h5>
							<small class="text-center" style="opacity: 0.5">subtitle of project</small>
							<div class="dropdown clearfix float-right bg-white">
								<button class="btn btn-light dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
								</button>
								<div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
									<a class="dropdown-item" data-toggle="modal" data-target="#edit" >Edit</a>
									<a class="dropdown-item" data-toggle="modal" data-target="#delete" >Delete</a>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="col-sm-4 cursor  p-3 form-group ">
					<div class="border">
						<img src="../../public/etc/images/system/background1.jpg" class="modalAddDetails w-100 h-25" data-toggle="modal" data-target="#project" id="">
						<div class="p-3 justify-content-center clearfix">
							<h5>Project Title</h5>
							<small class="text-center" style="opacity: 0.5">subtitle of project</small>
							<div class="dropdown clearfix float-right bg-white">
								<button class="btn btn-light dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
								</button>
								<div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
									<a class="dropdown-item" data-toggle="modal" data-target="#edit" >Edit</a>
									<a class="dropdown-item" data-toggle="modal" data-target="#delete" >Delete</a>
								</div>
							</div>
						</div>
					</div>
				</div>
			<!-- 	<div class="col-sm-4 cursor  p-3 form-group ">
					<div class="border">
						<img src="../../public/etc/images/system/frontID.png" class="modalAddDetails w-100 h-25" data-toggle="modal" data-target="#project1" id="">
						<div class="p-3 text-center ">
							<h5>Project Title</h5>
							<small class="" style="opacity: 0.5">subtitle of project</small>
						</div>
					</div>
				</div> -->
				<!-- <div class="col-sm-3 cursor  p-3 form-group  ">
					<div class="border">
						<img src="../../public/etc/images/system/frontID.png" class="modalAddDetails w-100 h-25" data-toggle="modal" data-target="#project1" id="">
						<div class="p-3 text-center ">
							<h5>Project Title</h5>
							<small class="" style="opacity: 0.5">subtitle of project</small>
						</div>
					</div>					
				</div> -->

				
				
			</div>
			<nav aria-label="Page navigation example">
				<ul class="pagination justify-content-center">
					<li class="page-item"><a class="page-link" href="#">Previous</a></li>
					<li class="page-item"><a class="page-link" href="#">1</a></li>
					<li class="page-item"><a class="page-link" href="#">2</a></li>
					<li class="page-item"><a class="page-link" href="#">3</a></li>
					<li class="page-item"><a class="page-link" href="#">Next</a></li>
				</ul>
			</nav>
			<!-- <div class="row">
				<div class="col-sm-3 cursor  p-3 form-group ">
					<img src="../../public/etc/images/system/background1.jpg" class="modalAddDetails w-100 h-25" data-toggle="modal" data-target="#project1" id="">
					<div class="p-3 text-center border">
						<h5>Project Title</h5>
						<small class="" style="opacity: 0.5">subtitle of project</small>
					</div>
				</div>
				<div class="col-sm-3 cursor  p-3 form-group ">
					<img src="../../public/etc/images/system/background1.jpg" class="modalAddDetails w-100 h-25" data-toggle="modal" data-target="#project1" id="">
					<div class="p-3 text-center border">
						<h5>Project Title</h5>
						<small class="" style="opacity: 0.5">subtitle of project</small>
					</div>
				</div>
				<div class="col-sm-3 cursor  p-3 form-group ">
					<img src="../../public/etc/images/system/background1.jpg" class="modalAddDetails w-100 h-25" data-toggle="modal" data-target="#project1" id="">
					<div class="p-3 text-center border">
						<h5>Project Title</h5>
						<small class="" style="opacity: 0.5">subtitle of project</small>
					</div>
				</div>
				<div class="col-sm-3 cursor  p-3 form-group ">
					<img src="../../public/etc/images/system/background1.jpg" class="modalAddDetails w-100 h-25" data-toggle="modal" data-target="#project1" id="">
					<div class="p-3 text-center border">
						<h5>Project Title</h5>
						<small class="" style="opacity: 0.5">subtitle of project</small>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-sm-3 cursor  p-3 form-group ">
					<img src="../../public/etc/images/system/selfie.png" class="modalAddDetails w-100 h-25" data-toggle="modal" data-target="#project1" id="">
					<div class="p-3 text-center border">
						<h5>Project Title</h5>
						<small class="" style="opacity: 0.5">subtitle of project</small>
					</div>
				</div>
				<div class="col-sm-3 cursor  p-3 form-group ">
					<img src="../../public/etc/images/system/selfie.png" class="modalAddDetails w-100 h-25" data-toggle="modal" data-target="#project1" id="">
					<div class="p-3 text-center border">
						<h5>Project Title</h5>
						<small class="" style="opacity: 0.5">subtitle of project</small>
					</div>
				</div>
				<div class="col-sm-3 cursor  p-3 form-group ">
					<img src="../../public/etc/images/system/selfie.png" class="modalAddDetails w-100 h-25" data-toggle="modal" data-target="#project1" id="">
					<div class="p-3 text-center border">
						<h5>Project Title</h5>
						<small class="" style="opacity: 0.5">subtitle of project</small>
					</div>
				</div>
				<div class="col-sm-3 cursor  p-3 form-group ">
					<img src="../../public/etc/images/system/selfie.png" class="modalAddDetails w-100 h-25" data-toggle="modal" data-target="#project1" id="">
					<div class="p-3 text-center border">
						<h5>Project Title</h5>
						<small class="" style="opacity: 0.5">subtitle of project</small>
					</div>
				</div>
			</div> -->
			
		</div>	
	</div>
</div>
<!-- end of content -->

<?php
	require "../public/header-footer/seeker/seekerFooter.marvee";
?>