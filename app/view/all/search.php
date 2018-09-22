<?php
	if(isset($data) && !empty($data)){
		extract($data[0]);
		if(isset($userDetails) && !empty($userDetails)){
			extract($userDetails[0]);
		}
	} 
	if(!empty($userDetails)){
		require_once "../public/header-footer/seeker/seekerHeader.marvee";
	}else{
		require "../public/header-footer/header.marvee";
	}
	require_once "../public/header-footer/jobsNav.marvee";
?>

<style type="text/css">
		.scroll{
	  height:500px;
	  overflow-y: scroll;
	  overflow-x: hidden;
	}

	.btn-change1:hover{
    -webkit-transform: scale(1.1);
    background: #3ab0ff;
	}
	 .animated {
            -webkit-animation-duration: 10s;
            animation-duration: 10s;
            -webkit-animation-fill-mode: both;
            animation-fill-mode: both;
         }
      .animated1 {
            -webkit-animation-duration: 2s;
            animation-duration: 2s;
            -webkit-animation-fill-mode: both;
            animation-fill-mode: both;
         }
         
         @-webkit-keyframes fadeIn {
            0% {opacity: 0;}
            100% {opacity: 1;}
         }
         
         @keyframes fadeIn {
            0% {opacity: 0;}
            100% {opacity: 1;}
         }
         
         .fadeIn {
            -webkit-animation-name: fadeIn;
            animation-name: fadeIn;
         }

          @-webkit-keyframes flipInX {
            0% {
               -webkit-transform: perspective(400px) rotateX(90deg);
               opacity: 0;
            }
            40% {
               -webkit-transform: perspective(400px) rotateX(-10deg);
            }
            70% {
               -webkit-transform: perspective(400px) rotateX(10deg);
            }
            100% {
               -webkit-transform: perspective(400px) rotateX(0deg);
               opacity: 1;
            }
         }
         
         @keyframes flipInX {
            0% {
               transform: perspective(400px) rotateX(90deg); 
               opacity: 0;
            }
            40% {
               transform: perspective(400px) rotateX(-10deg);
            }
            70% {
               transform: perspective(400px) rotateX(10deg);
            }
            100% {
               transform: perspective(400px) rotateX(0deg);
               opacity: 1;
            }
         }
         
         .flipInX {
            -webkit-backface-visibility: visible !important;
            -webkit-animation-name: flipInX;
            backface-visibility: visible !important;
            animation-name: flipInX;
         }

</style>


			<div class="container pt-3" id="searchPasserBody">
				<div class="fixed-bottom w-auto">
					<button class="btn btn-lg bg-success text-white" name="sendButton">Send Job Offer</button>
				</div>
				<div class="row justify-content-center">
					<div class="col-10">
						<form method="GET" action="#">
							<div class="row">
								<div class="col-sm">
									<div class="form-group">
									  	<h5>Keywords</h5>
		           					    <div class="input-group">
							               <input  list="keywords" name="jobTitle" class="form-control border-secondary py-2 rounded" type="search" placeholder="skills, job title">
						                 	<datalist id="keywords">
											    <option value="Carpenter">
											    <option value="Chef">
											    <option value="Pastry">
											    <option value="Mechanical">
										  	</datalist>
							            </div>
									</div>
								</div>
								
								<div class="col-md-3">
	   								<h5>Gender:</h5>
	           					    <div class="input-group">
						             	<select class="custom-select border-secondary" name="Gender">
										  <option value="Any" selected>Any</option>
										  <option value="Female">Female</option>
										  <option value="Male">Male</option>
										</select>
						            </div>
           						</div>

           						

           						<div class="col-md-3">
	   								<h5>Age:</h5>
	           					    <div class="input-group">
						             	<input type="number" value="0" name="age" class="form-control border-secondary py-2 rounded">
						            </div>
           						</div>
							</div>
							<div class="row mt-4">
       							<div class="col-md-5 mx-auto">
       								<h5>Service fee between:</h5>
       								<div class="form-group">
		           					   	<label for="budget">Average Service fee (Php)</label>
		           					   	<input name="budget" class="ml-1 border-secondary rounded fee" value="0" type="text" style="width:50px" id="minimum">
	           					   	</div>
									<input type="range" name="fee" class="custom-range" value="0" min="0" max="10000" >
   								</div>
           					</div>
						</form>
					</div>
				</div>
				<div class="row mt-4">
					<div class="col-md-12 text-center">
						<a data-toggle="collapse" data-target="#show" aria-expanded="false" aria-controls="show"><h4><u>Show Advance Options</u></h4></a>
					</div>	
				</div>
				<div class="collapse" id="show">
					<div class="row mt-4pt-4 bg-light">	
						<div class="col-md-5 mt-2 mx-auto">
							<h5>Location:</h5>
						    <div class="input-group">
				             	<input list="cities" name="citySearch" class="form-control">
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
						<div class="col-md-3 mb-3 mt-2 d-none">
							<h5>Number of Passers:</h5>
							 <div class="input-group">
		               		<input  name="numberPasser" class="form-control border-secondary py-2 rounded" type="number" min="1">
		           		 </div>
						</div>
						
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