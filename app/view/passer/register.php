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
              <a class="navbar-link text-dark" href="#">
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
              <a class="navbar-link text-dark" href="#">
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
         <input type="text" name="username" placeholder="Username" />
        <input type="text" name="email" placeholder="Email" />
        <input type="password" name="pass" placeholder="Password" />
        <input type="password" name="cpass" placeholder="Confirm Password" />
        <input type="button" name="next" class="next action-button" value="Next" />
        <hr>
        <br>
        <b style="font-size:18px">Or Sign up using</b>
        <br><br>
        <button id="btn-facebook">
        	<i id="i-facebook"  class="fa fa-facebook-official">
        	</i>
        	<b style="color:#1f498e"> Facebook
        	</b>
        </button>
           <button id="btn-google">
        	<i id="i-google" class="fa fa-google"></i>
        	<b style="color:#374356"> Google
        	</b>
        </button>
      </fieldset>
      <fieldset>
        <h2 class="fs-title">Tell us about yourself, Mate</h2>
        <h3 class="fs-subtitle">Please make sure that the information  contained in this form is valid and truthful</h3>
        <input type="text" name="fname" placeholder="First Name" />
        <input type="text" name="mname" placeholder="Middle Name" />
        <input type="text" name="lname" placeholder="Last Name" />
        <label>Your birthdate</label><input type="date" name="bday">
        <input type="button" name="previous" class="previous action-button" value="Previous" />
        <input type="button" name="next" class="next action-button" value="Next" />
      </fieldset>
      <fieldset>
        <h2 class="fs-title">What is your current address?Mate</h2>
        <h3 class="fs-subtitle">Please make sure that the information  contained in this form is valid and truthful</h3>
        <input type="text" name="street" placeholder="House#,/Building/Street" />
        <input type="text" name="city" placeholder="City" />
        <input type="text" name="state" placeholder="State/Province" />
        <input type="text" name="pcode" placeholder="Postal Code" />
        <input type="text" name="country" placeholder="Country" />
        <input type="button" name="previous" class="previous action-button" value="Previous" />
        <input type="button" name="next" class="next action-button" value="Next" />
      </fieldset>
       <fieldset>
        <h2 class="fs-title">Upload Government Issued ID</h2>
        <h3 class="fs-subtitle">Your information is secured</h3>
        <label>Select ID Type</label>
        <select name="governId" id="selectid">
          <option value="" selected>Government issued ID</option>
          <option value="saab">Drivers License</option>
          <option value="fiat">Police Clearance Certificate</option>
          <option value="audi">SSS ID</option>
        </select>
        <input type="text" name="city" placeholder="Expiration Date" />
        <input type="text" name="state" placeholder="ID Number" />
       <!--  <input type="file" multiple> -->
       <label id="upload"><b>Upload image of ID</b></label>
       <br>
       <br>
        <p name="drag" id="drag">Drag your image here or click in this area.</p>
      <!--   <input type="button" value="Upload" id="upload" name="upload" class="upload"/> -->
        <br>
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
            <option value="" selected>Type of Certificate</option>
            <option value="saab">NC</option>
            <option value="fiat">COC</option>
         </select>
         <br>
        <label id="label2">Select Qualification Title</label>
          <select name="governId" id="selectid">
            <option value="" selected>Qualification Title</option>
            <option value="saab">Food and Beverage Services NC II</option>
            <option value="fiat">Caregiving NC II</option>
          </select>
        <input type="text" name="fname" placeholder="Certificate Number" />
        <input type="text" name="fname" placeholder="Expiration Date" />
        <input type="button" name="previous" class="previous action-button" value="Previous" />
      <a href="file:///C:/Users/MarveeLoper/Downloads/Storyboard%20PM/creative-agency-colorlib/creative-agency/passer/dashboard.html"><input type="submit" name="submit" class="submit action-button" value="Done"/></a>
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
  ?>