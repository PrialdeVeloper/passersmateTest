<?php 
	require "../public/header-footer/header.marvee";
?>
     	<div class="container-fluid my-4 col-12 col-sm-6 ">
     		<div class="alert alert-danger hidethis text-center" id="seekerError" role="alert">
			</div>
     		<form class="shadow-lg p-3 mb-5 bg-white rounded pt-3" id="seekerRegister">
     			<!-- <div class="alert alert-danger text-center hidethis" id="passerRegError">
     			</div>
     			<div class="alert alert-success text-center" id="passerRegReminded">
     				Please enter your Cetificate number first
     			</div> -->
     		<div class="row justify-content-center  my-3 ">

     			<div class="col-12 my-2">
     				<h2 class="fs-title text-center ">Create your account as a Seeker</h2>
     			</div>

     		<!-- 	<div class="container bg-info mb-1 text-center text-white hidethis">
     				<span>Please wait while we verify your account through TESDA</span>
     			</div> -->

				<div class=" col-sm-5 my-2">
					<input type="text" name="seekerFN" class="form-control" placeholder="First Name">
				</div>

				<div class=" col-sm-5 my-2">
					<input type="text" name="seekerLN" class="form-control" placeholder="Last Name">
				</div>
			    <div class="w-100"></div>



				<div class=" col-sm-5 mt-1">
					<div class="form-group">
						<label for="gender">Birthday</label>
						<input type="text" name="seekerBdate" readonly disabled class="form-control datepicker" placeholder="Birthday">
					</div>
					
				</div>

			    <div class=" col-sm-5 mt-1">
					<div class="form-group">
						<label for="gender">Gender</label>
						<select name="passerGender" id="gender" class="custom-select" >
							<option selected value="Male">Male</option>
							<option value="Female">Female</option>
						</select>
					</div>
				</div>

				<div class=" col-sm-10 mt-1 input-group">
					<input type="text" name="seekerEmail" class="form-control rounded-right" placeholder="Email" id="seekerEmailRegister">
				</div>
				<div class="w-100"></div>

				
				<div class="col-sm-10 mt-2">
					<div class="form-group">
					    <label for="address">Address</label>
					    <input type="text" class="form-control" value="" name="seekerAddress" id="email" placeholder="Region/Province/State">
					</div>
				</div>
						
				<div class="col-sm-5 mt-1">
					<div class="form-group">
					   <input type="text" value="" class="form-control" name="seekerStreet" placeholder="Street Address">
					</div>
				</div>

				<div class="col-sm-5 mt-1">
					<div class="form-group">
					   <input list="cities" class="form-control" name="seekerCity" placeholder="City">
				   		<datalist id="cities"> 
				      	 <option value="Alaminos"></option>
				         <option value="Angeles"></option>
				         <option value="Antipolo"></option>
				         <option value="Bacolod"></option>
				         <option value="Bacoor"></option>
				         <option value="Bago"></option>
				         <option value="Baguio"></option>
				         <option value="Bais"></option>
				         <option value="Balanga"></option>
				         <option value="Batac"></option>
				         <option value="Batangas City"></option>
				         <option value="Bayawan"></option>
				         <option value="Baybay"></option>
				         <option value="Bayugan"></option>
				         <option value="Biñan"></option>
				         <option value="Bislig"></option>
				         <option value="Bogo"></option>
				         <option value="Borongan"></option>
				         <option value="Butuan"></option>
				         <option value="Cabadbaran"></option>
				         <option value="Cabanatuan"></option>
				         <option value="Cabuyao"></option>
				         <option value="Cadiz"></option>
				         <option value="Cagayan de Oro"></option>
				         <option value="Calamba"></option>
				         <option value="Calapan"></option>
				         <option value="Calbayog"></option>
				         <option value="Caloocan"></option>
				         <option value="Candon"></option>
				         <option value="Canlaon"></option>
				         <option value="Carcar"></option>
				         <option value="Catbalogan"></option>
				         <option value="Cauayan"></option>
				         <option value="Cavite City"></option>
				         <option value="Cebu City"></option>
				         <option value="Cotabato City"></option>
				         <option value="Dagupan"></option>
				         <option value="Danao"></option>
				         <option value="Dapitan"></option>
				         <option value="Dasmariñas"></option>
				         <option value="Davao City"></option>
				         <option value="Digos"></option>
				         <option value="Dipolog"></option>
				         <option value="Dumaguete"></option>
				         <option value="El Salvador"></option>
				         <option value="Escalante"></option>
				         <option value="Gapan"></option>
				         <option value="General Santos"></option>
				         <option value="General Trias"></option>
				         <option value="Gingoog"></option>
				         <option value="Guihulngan"></option>
				         <option value="Himamaylan"></option>
				         <option value="Ilagan"></option>
				         <option value="Iligan"></option>
				         <option value="Iloilo City"></option>
				         <option value="Imus"></option>
				         <option value="Iriga"></option>
				         <option value="Isabela"></option>
				         <option value="Kabankalan"></option>
				         <option value="Kidapawan"></option>
				         <option value="Koronadal"></option>
				         <option value="La Carlota"></option>
				         <option value="Lamitan"></option>
				         <option value="Laoag"></option>
				         <option value="Lapu-Lapu"></option>
				         <option value="Las Piñas"></option>
				         <option value="Legazpi"></option>
				         <option value="Ligao"></option>
				         <option value="Lipa"></option>
				         <option value="Lucena"></option>
				         <option value="Maasin"></option>
				         <option value="Mabalacat"></option>
				         <option value="Makati"></option>
				         <option value="Malabon"></option>
				         <option value="Malaybalay"></option>
				         <option value="Malolos"></option>
				         <option value="Mandaluyong"></option>
				         <option value="Mandaue"></option>
				         <option value="Manila"></option>
				         <option value="Marawi"></option>
				         <option value="Marikina"></option>
				         <option value="Masbate City"></option>
				         <option value="Mati"></option>
				         <option value="Meycauayan"></option>
				         <option value="Muñoz"></option>
				         <option value="Muntinlupa"></option>
				         <option value="Naga"></option>
				         <option value="Navotas"></option>
				         <option value="Olangapo"></option>
				         <option value="Ormoc"></option>
				         <option value="Oroquieta"></option>
				         <option value="Oramiz"></option>
				         <option value="Pagadian"></option>
				         <option value="Palayan"></option>
				         <option value="Panabo"></option>
				         <option value="Parañaque"></option>
				         <option value="Pasay"></option>
				         <option value="Pasig"></option>
				         <option value="Passi"></option>
				         <option value="Puerto Princesa"></option>
				         <option value="Quezon City"></option>
				         <option value="Roxas"></option>
				         <option value="Sagay"></option>
				         <option value="Samal"></option>
				         <option value="San Carlos"></option>
				         <option value="San Carlos"></option>
				         <option value="San Fernando"></option>
				         <option value="San Fernando"></option>
				         <option value="San Jose"></option>
				         <option value="San Jose del Monte"></option>
				         <option value="San Juan"></option>
				         <option value="San Pablo"></option>
				         <option value="San Pedro"></option>
				         <option value="Santa Rosa"></option>
				         <option value="Santiago"></option>
				         <option value="Silay"></option>
				         <option value="Sipalay"></option>
				         <option value="Sorsogon City"></option>
				         <option value="Surigao City"></option>
				         <option value="Tabaco"></option>
				         <option value="Tabuk"></option>
				         <option value="Tacloban"></option>
				         <option value="Tacurong"></option>
				         <option value="Tagaytay"></option>
				         <option value="Tagbilaran"></option>
				         <option value="Taguig"></option>
				         <option value="Tagum"></option>
				         <option value="Talisay"></option>
				         <option value="Talisay"></option>
				         <option value="Tanauan"></option>
				         <option value="Tandag"></option>
				         <option value="Tangub"></option>
				         <option value="Tanjay"></option>
				         <option value="Tarlac City"></option>
				         <option value="Tayabas"></option>
				         <option value="Toledo"></option>
				         <option value="Trece Martires"></option>
				         <option value="Tuguegarao"></option>
				         <option value="Urdaneta"></option>
				         <option value="Valencia"></option>
				         <option value="Valenzuela"></option>
				         <option value="Victorias"></option>
				         <option value="Vigan"></option>
				         <option value="Zamboanga City"></option>   
						</datalist>
					</div>
				</div>
				

				<div class=" col-sm-10 mb-2">
					<label for="number">Mobile Number</label>
					<div class="input-group mb-2">
					<div class="input-group-prepend">
					<div class="input-group-text">+63</div>
					</div>
					<input type="text" class="form-control" name="seekerCPNo" id=" "  maxlength="10" placeholder="Mobile Number" value="">
					</div>
				</div>

				<div class=" col-sm-10 my-2 input-group">
					<input type="text" name="seekerUsername"  class="form-control" placeholder="Username" id="">					
				</div>

				<div class=" col-sm-10 my-2 input-group">
					<input type="password" name="seekerPassword"  class="form-control passwordField" placeholder="Password" id="seekerPasswordRegister">
					<div class="input-group-append">
						<span class="input-group-text cursor passwordShowHide"><i class="text-primary fas fa-eye"></i></span>
					</div>	
				</div>

				<small id="passwordHelpBlock" class="form-text text-muted hidethis pb-3">
				  Your password must contain minimum of 8 characters and atleast 1 number
				</small>
				<div class="w-100"></div>

				<div class="col-sm-10 my-2">
					<div class="col-sm">
						<div class="container">
							<h6>By registering you wil agree with PASSERSMATE <a href="#">Terms and condition</a></h6>
						</div>
					</div>
				</div>
				<div class="w-100"></div>

				<div class=" col-sm-10 my-2">
					<input type="submit" class="col btn btn-success btn-block " name="submit" value="Sign Up">
				</div>
				<div class="w-100"></div>

				<div class=" col-sm-8 my-2 text-center">
					<h6>Already have an account? <a href="../home/login">Log in</a></h6> 	
				</div>	

     		</div>
     		</form>
     	</div>
<?php 
	require "../public/header-footer/seeker/seekerFooter.marvee";
?>