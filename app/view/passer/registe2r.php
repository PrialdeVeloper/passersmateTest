<?php 
  require "../public/etc/old/etcCompileOld.marvee";
?>
<body>
      <nav class="navbar navbar-expand-md navbar-light bg-white p-0" role="navigation">
        <a class="navbar-brand" href="#">
          <img src="../../public/etc/images/dashboard/header/header-logo.png" class="img-fluid header-image">
        </a>
        <button type="button" class="navbar-toggler" data-target="#navbar-header" data-toggle="collapse">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse navbar-collapse justify-content-end" id="navbar-header">
          <ul class="nav navbar-nav text-right">
            <li class="navbar-item pr-5">
              <a class="navbar-link text-dark" href="../home/index">
                Home
              </a>
            </li>
            <li class="navbar-item pr-5">
              <a class="navbar-link text-dark" href="#">
                Passers
              </a>
            </li>
            <li class="navbar-item pr-5">
              <a class="navbar-link text-dark" href="#">
                <label>How it works</label>
              </a>
            </li>
            <li class="navbar-item pr-5">
              <a class="navbar-link text-dark" href="register">
                Sign up
              </a>
            </li>
            <li class="navbar-item pr-5">
              <a class="navbar-link text-dark" href="#">
                Login
              </a>
            </li>
          </ul> 
        </div>
      </nav>

    <!-- multistep form -->
  <form id="msform">
    <!-- progressbar -->
      <ul id="progressbar">
        <li class="active">Account Setup</li>
        <li>Personal Details</li>
        <li>Current Address</li>
        <li id="li4">ID Upload</li>
        <li id="li5">Certicate of Competency</li>
      </ul>
      <!-- fieldsets -->
      <fieldset>
        <h2 class="fs-title">Create your Passer account</h2>
        <h3 class="fs-subtitle">This is step 1</h3>
        <div class="container-fluid my-1 py-2 text-white" id="username">
        </div>
        <input type="email" name="regEmail" placeholder="Email" /> 
        <div class="container-fluid my-1 py-2 text-white" id="password">
        </div>
        <input type="password" name="regPass" placeholder="Password" />

        <div class="container-fluid my-1 py-2 text-white" id="retypePassword">
        </div>
        <input type="password" name="cpass" placeholder="Confirm Password" />

        <input type="button" name="next" class="next action-button" value="Next" />
        <hr>
      </fieldset>


      <fieldset>
        <h2 class="fs-title">Tell us about yourself, Mate</h2>
        <h3 class="fs-subtitle">Please make sure that the information  contained in this form is valid and truthful</h3>
        <div class="container-fluid my-1 py-2 text-white" id="birthdateReg">
        </div>
        <label>Your birthdate</label><input type="date" name="bday">
        <input type="button" name="previous" class="previous action-button" value="Previous" />
        <input type="button" name="next" class="next action-button" value="Next" />
      </fieldset>
      <fieldset>
        <h2 class="fs-title">What is your current address?Mate</h2>
        <h3 class="fs-subtitle">Please make sure that the information  contained in this form is valid and truthful</h3>
        <div class="container-fluid my-1 py-2 text-white" id="addressDiv">
        </div>
        <input type="text" name="street" placeholder="House#,/Building/Street" />
        <div class="container-fluid my-1 py-2 text-white" id="cityDiv">
        </div>
        <input list="cities" name="city" placeholder="City" />
        <datalist id="cities"> 
           <option value="Alaminos">
             <option value="Angeles">
             <option value="Antipolo">
             <option value="Bacolod">
             <option value="Bacoor">
             <option value="Bago">
             <option value="Baguio">
             <option value="Bais">
             <option value="Balanga">
             <option value="Batac">
             <option value="Batangas City">
             <option value="Bayawan">
             <option value="Baybay">
             <option value="Bayugan">
             <option value="Biñan">
             <option value="Bislig">
             <option value="Bogo">
             <option value="Borongan">
             <option value="Butuan">
             <option value="Cabadbaran">
             <option value="Cabanatuan">
             <option value="Cabuyao">
             <option value="Cadiz">
             <option value="Cagayan de Oro">
             <option value="Calamba">
             <option value="Calapan">
             <option value="Calbayog">
             <option value="Caloocan">
             <option value="Candon">
             <option value="Canlaon">
             <option value="Carcar">
             <option value="Catbalogan">
             <option value="Cauayan">
             <option value="Cavite City">
             <option value="Cebu City">
             <option value="Cotabato City">
             <option value="Dagupan">
             <option value="Danao">
             <option value="Dapitan">
             <option value="Dasmariñas">
             <option value="Davao City">
             <option value="Digos">
             <option value="Dipolog">
             <option value="Dumaguete">
             <option value="El Salvador">
             <option value="Escalante">
             <option value="Gapan">
             <option value="General Santos">
             <option value="General Trias">
             <option value="Gingoog">
             <option value="Guihulngan">
             <option value="Himamaylan">
             <option value="Ilagan">
             <option value="Iligan">
             <option value="Iloilo City">
             <option value="Imus">
             <option value="Iriga">
             <option value="Isabela">
             <option value="Kabankalan">
             <option value="Kidapawan">
             <option value="Koronadal">
             <option value="La Carlota">
             <option value="Lamitan">
             <option value="Laoag">
             <option value="Lapu-Lapu">
             <option value="Las Piñas">
             <option value="Legazpi">
             <option value="Ligao">
             <option value="Lipa">
             <option value="Lucena">
             <option value="Maasin">
             <option value="Mabalacat">
             <option value="Makati">
             <option value="Malabon">
             <option value="Malaybalay">
             <option value="Malolos">
             <option value="Mandaluyong">
             <option value="Mandaue">
             <option value="Manila">
             <option value="Marawi">
             <option value="Marikina">
             <option value="Masbate City">
             <option value="Mati">
             <option value="Meycauayan">
             <option value="Muñoz">
             <option value="Muntinlupa">
             <option value="Naga">
             <option value="Navotas">
             <option value="Olangapo">
             <option value="Ormoc">
             <option value="Oroquieta">
             <option value="Oramiz">
             <option value="Pagadian">
             <option value="Palayan">
             <option value="Panabo">
             <option value="Parañaque">
             <option value="Pasay">
             <option value="Pasig">
             <option value="Passi">
             <option value="Puerto Princesa">
             <option value="Quezon City">
             <option value="Roxas">
             <option value="Sagay">
             <option value="Samal">
             <option value="San Carlos">
             <option value="San Carlos">
             <option value="San Fernando">
             <option value="San Fernando">
             <option value="San Jose">
             <option value="San Jose del Monte">
             <option value="San Juan">
             <option value="San Pablo">
             <option value="San Pedro">
             <option value="Santa Rosa">
             <option value="Santiago">
             <option value="Silay">
             <option value="Sipalay">
             <option value="Sorsogon City">
             <option value="Surigao City">
             <option value="Tabaco">
             <option value="Tabuk">
             <option value="Tacloban">
             <option value="Tacurong">
             <option value="Tagaytay">
             <option value="Tagbilaran">
             <option value="Taguig">
             <option value="Tagum">
             <option value="Talisay">
             <option value="Talisay">
             <option value="Tanauan">
             <option value="Tandag">
             <option value="Tangub">
             <option value="Tanjay">
             <option value="Tarlac City">
             <option value="Tayabas">
             <option value="Toledo">
             <option value="Trece Martires">
             <option value="Tuguegarao">
             <option value="Urdaneta">
             <option value="Valencia">
             <option value="Valenzuela">
             <option value="Victorias">
             <option value="Vigan">
             <option value="Zamboanga City">   
        </datalist>
        <div class="container-fluid my-1 py-2 text-white" id="pcodeDiv">
        </div>
        <input type="text" name="pcode" placeholder="Postal Code" />
        <input type="button" name="previous" class="previous action-button" value="Previous" />
        <input type="button" name="next" class="next action-button" value="Next" />
      </fieldset>
       <fieldset>
        <h2 class="fs-title">Upload Government Issued ID</h2>
        <h3 class="fs-subtitle">Your information is secured</h3>
        <label>Select ID Type</label>
        <select name="validId" id="selectid">
          <option value="" selected>Government issued ID</option>
          <option value="saab">Drivers License</option>
          <option value="fiat">Police Clearance Certificate</option>
          <option value="audi">SSS ID</option>
        </select>

        <div class="container-fluid my-1 py-2 text-white" id="expirationDate">
        </div>
        <div class="container-fluid text-center text-dark pb-2">Expiration Date</div>
        <input type="date" name="expirationDate" placeholder="Expiration Date" />

        <div class="container-fluid my-1 py-2 text-white" id="idno">
        </div>
        <input type="text" name="state" placeholder="ID Number" />
       <!--  <input type="file" multiple> -->
        <input type="button" name="previous" class="previous action-button" value="Previous" />
        <input type="button" name="next" class="next action-button" value="Next" />
        <br>
        <label>Quick Tips:</label>
        <img src="../../public/etc/images/system/id.png" id="expire"/>
        <img src="../../public/etc/images/system/expire.png" />
      </fieldset>
      <fieldset>
        <h2 class="fs-title">TESDA Passer</h2>
        <h3 class="fs-subtitle">This is the last step, Mate</h3>
        <br>
        <label id="label2">Select Type of Certificate</label>
          <select name="governId" id="selectid">
            <option value="saab">NC</option>
            <option value="fiat">COC</option>
         </select>
         <br>
        <label id="label2">Select Qualification Title</label>
          <select name="COC" id="selectid">
            <option value="saab">Food and Beverage Services NC II</option>
            <option value="fiat">Caregiving NC II</option>
          </select>

          <div class="container-fluid my-1 py-2 text-white" id="COCno">
        </div>
        <input type="text" name="fname" placeholder="Certificate Number" />
        <input type="button" name="previous" class="previous action-button" value="Previous" />
      <input type="submit" name="submit" class="submit action-button" value="Done"/>
            <br>
        <label>Quick Tips:</label>
        <br>
        <img src="../../public/etc/images/system/calendar.png" id="calendar"/>
        <br>
        <small style="font-size:10px;color:#2C3E65;font-family: Calibri;letter-spacing:1px">Certificate of Competency Assessment <br>
        		must have at least one month <br>
       			 before expiration </small>
      </fieldset>
  </form>

  <?php 
    require "../public/etc/old/etcCompileOldScripts.marvee";
    // require "../public/header-footer/seeker/seekerFooter.marvee";
  ?>