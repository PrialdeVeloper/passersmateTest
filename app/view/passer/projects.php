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
	require "../public/header-footer/seeker/seekerHeader.marvee";
	require "modal/projectsModal.html";
?>
<!-- content -->
<div class="container-fluid my-5">
	<!-- start of 1st row -->
	<div class="row justify-content-center">
		<div class="col-md-10 bg-white border border rounded mx-5 shadowDiv">
			<div class="row ">
				<div class="col text-center skyblue text-dark py-2">
					<label ><h1 >My Projects</h1></label>
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
				<div class="col-3 cursor  p-2">
					<img src="../../public/etc/images/system/frontID.png" class="modalAddDetails w-100 h-25" data-toggle="modal" data-target="#project1" id="">
				</div>
				<div class="col-3 cursor p-2">
					<img src="../../public/etc/images/system/frontID.png" class="modalAddDetails w-100 h-25" data-toggle="modal" data-target="#project2" id="">
				</div>
				<div class="col-3 cursor p-2">
					<img src="../../public/etc/images/system/frontID.png" class="modalAddDetails w-100 h-25" data-toggle="modal" data-target="#project3" id="">
				</div>
				<div class="col-3 cursor p-2">
					<img src="../../public/etc/images/system/frontID.png" class="modalAddDetails w-100 h-25" data-toggle="modal" data-target="#project4" id="">
				</div>
			</div>
			<div class="row">
				<div class="col-3 cursor p-2">
					<img src="../../public/etc/images/system/frontID.png" class="modalAddDetails w-100 h-25" data-toggle="modal" data-target="#project1" id="">
				</div>
				<div class="col-3 cursor p-2">
					<img src="../../public/etc/images/system/frontID.png" class="modalAddDetails w-100 h-25" data-toggle="modal" data-target="#project2" id="">
				</div>
				<div class="col-3 cursor p-2">
					<img src="../../public/etc/images/system/frontID.png" class="modalAddDetails w-100 h-25" data-toggle="modal" data-target="#project3" id="">
				</div>
				<div class="col-3 cursor p-2">
					<img src="../../public/etc/images/system/frontID.png" class="modalAddDetails w-100 h-25" data-toggle="modal" data-target="#project4" id="">
				</div>
			</div>
			<div class="row">
				<div class="col-3 cursor p-2">
					<img src="../../public/etc/images/system/frontID.png" class="modalAddDetails w-100 h-25" data-toggle="modal" data-target="#project1" id="">
				</div>
				<div class="col-3 cursor p-2">
					<img src="../../public/etc/images/system/frontID.png" class="modalAddDetails w-100 h-25" data-toggle="modal" data-target="#project2" id="">
				</div>
				<div class="col-3 cursor p-2">
					<img src="../../public/etc/images/system/frontID.png" class="modalAddDetails w-100 h-25" data-toggle="modal" data-target="#project3" id="">
				</div>
				<div class="col-3 cursor p-2">
					<img src="../../public/etc/images/system/frontID.png" class="modalAddDetails w-100 h-25" data-toggle="modal" data-target="#project4" id="">
				</div>
			</div>
		</div>	
	</div>
</div>
<!-- end of content -->

<?php
	require "../public/header-footer/seeker/seekerFooter.marvee";
?>