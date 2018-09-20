<?php 
if(isset($data) && !empty($data)){
  extract($data[0]);
  if(isset($userDetails) && !empty($userDetails)){
    extract($userDetails[0]);
  }
} 
require "../public/header-footer/seeker/seekerHeader.marvee";
?>
<!DOCTYPE html>
<html dir="ltr" lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="../../assets/images/favicon.png">
    <title>Matrix Template - The Ultimate Multipurpose admin template</title>
    <!-- Custom CSS -->
    <link href="css/style.min.css" rel="stylesheet">
    <link href="build/toastr.min.css" rel="stylesheet">
  <style type="text/css">
    .scroll{
    height:220px;
    overflow-y: scroll;
    overflow-x: hidden;
  }

}
</style>
</head>

<body>
    <!-- ============================================================== -->
    <!-- Preloader - style you can find in spinners.css -->
    <!-- ============================================================== -->
    <div class="preloader">
        <div class="lds-ripple">
            <div class="lds-pos"></div>
            <div class="lds-pos"></div>
        </div>
    </div>
    <!-- ============================================================== -->
    <!-- Main wrapper - style you can find in pages.scss -->
    <!-- ============================================================== -->
            <!-- ============================================================== -->
            <!-- ============================================================== -->
            <!-- ============================================================== -->
            <!-- Container fluid  -->
            <!-- ============================================================== -->
            <div class="container-fluid">
          <div class="row">
            <div class="col-md-11 mx-auto">
              <h4 class="mt-5 ml-4"><a href=""><u>Back to your Dashboard</u></a></h4>
               <div class="mt-5 ml-4">
                <p class="font-weight-bold">Filter by Job Status:</p>
                <button class="btn btn-dark filter-button" data-filter="all">All</button>
                <button class="btn btn-success filter-button" data-filter="done">Done</button>
                <button class="btn btn-info filter-button" data-filter="ongoing">Ongoing</button>
                <button class="btn btn-danger filter-button" data-filter="canceled">Canceled</button>
                <button class="btn btn-warning filter-button" data-filter="pending">Pending</button>
            </div>
            <h3 class="text-center">Your Chosen Passers</h3>
              <div class="row mt-5 ml-2 mr-2">
                <?=$dom; ?>
              </div>
              <div class="row mt-2 ml-2 mr-2">
                <div class="col-md-3 filter pending">
                  <div class="card shadow">
                    <div class="card-header">
                      <small class="font-weight-bold">Hired Date: August 6, 2018</small>
                    </div>
                    <div class="card-body" style="height:345px">
                  <div class="container">
                    <img src="pablo.jpg" alt="Avatar" class="image">
                    <div class="overlay">
                      <div class="text">Passer's Name: Pablo Franco</div>
                    </div>
                  </div>
                  <p class="font-weight-bold text-center mt-3">
                    Job title: <u>Chef</u>
                      </p>
                  <p class="font-weight-bold text-center mt-3">Job Status: 
                        <span class="badge badge-warning font-weight-bold">PENDING FOR CANCELLATION</span>
                      </p>
                    </div>
                    <div class="card-footer text-center pt-2" style="height:50px" >
                      
                    </div>
                  </div>
                </div>
                <div class="col-md-3 filter pending">
                  <div class="card shadow">
                    <div class="card-header">
                      <small class="font-weight-bold">Hired Date: August 6, 2018</small>
                    </div>
                    <div class="card-body" style="height:345px">
                  <div class="container">
                    <img src="pablo.jpg" alt="Avatar" class="image">
                    <div class="overlay">
                      <div class="text">Passer's Name: Pablo Franco</div>
                    </div>
                  </div>
                  <p class="font-weight-bold text-center mt-3">
                    Job title: <u>Chef</u>
                      </p>
                  <p class="font-weight-bold text-center mt-3">Job Status: 
                        <span class="badge badge-warning font-weight-bold">PENDING FOR CANCELLATION</span>
                      </p>
                    </div>
                    <div class="card-footer text-center pt-2" style="height:50px" >
                      
                    </div>
                  </div>
                </div>
                  <div class="col-md-3 filter done">
                  <div class="card shadow">
                    <div class="card-header">
                      <small class="font-weight-bold">Hired Date: August 6, 2018</small>
                    </div>
                    <div class="card-body" style="height:345px">
                  <div class="container">
                    <img src="marvee.jpg" alt="Avatar" class="image">
                    <div class="overlay">
                      <div class="text">Passer's Name: Pablo Franco</div>
                    </div>
                  </div>
                  <p class="font-weight-bold text-center mt-3">
                    Job title: <u>Chef</u>
                      </p>
                  <p class="font-weight-bold text-center mt-3">Job Status: 
                        <span class="badge badge-success font-weight-bold">DONE</span>
                      </p>
                    </div>
                    <div class="card-footer" style="height:50px">
                      
                    </div>
                  </div>
                </div>
                <div class="col-md-3 filter done">
                  <div class="card shadow">
                    <div class="card-header">
                      <small class="font-weight-bold">Hired Date: August 6, 2018</small>
                    </div>
                    <div class="card-body" style="height:345px">
                  <div class="container">
                    <img src="marvee.jpg" alt="Avatar" class="image">
                    <div class="overlay">
                      <div class="text">Passer's Name: Pablo Franco</div>
                    </div>
                  </div>
                  <p class="font-weight-bold text-center mt-3">
                    Job title: <u>Chef</u>
                      </p>
                  <p class="font-weight-bold text-center mt-3">Job Status: 
                        <span class="badge badge-success font-weight-bold">DONE</span>
                      </p>
                    </div>
                    <div class="card-footer" style="height:50px">
                      
                    </div>
                  </div>
                </div>
              </div>
            </div>  
              <ul class="pagination mx-auto mt-3 mb-5">
            <li class="page-item disabled">
              <span class="page-link">Previous</span>
            </li>
            <li class="page-item"><a class="page-link" href="#">1</a></li>
            <li class="page-item active">
              <span class="page-link">
                2
                <span class="sr-only">(current)</span>
              </span>
            </li>
            <li class="page-item"><a class="page-link" href="#">3</a></li>
            <li class="page-item">
              <a class="page-link" href="#">Next</a>
            </li>
          </ul>
          </div>
         </div>
            <!-- ============================================================== -->
            <!-- footer -->
            <!-- ============================================================== -->
          
            <!-- ============================================================== -->
            <!-- End footer -->
            <!-- ============================================================== -->

    <!-- ============================================================== -->
    <!-- End Wrapper -->
    <!-- ============================================================== -->
    <!-- ============================================================== -->
    <!-- All Jquery -->
    <!-- ============================================================== -->
    <script src="dist/jquery.min.js"></script>
    <!-- Bootstrap tether Core JavaScript -->
    <script src="popper.js/dist/umd/popper.min.js"></script>
    <script src="bootstrap/dist/js/bootstrap.min.js"></script>
    <!--Custom JavaScript -->
    <script src="js/custom.min.js"></script>
    <!-- this page js -->
    <script src="build/toastr.min.js"></script>
        <?php
  require "../public/header-footer/seeker/seekerFooter.marvee";
?>
    <script>
        $(function(){
            // Success Type
            $('#ts-success').on('click', function() {
                toastr.success('You have successfully sent a job offer to your choosen passer');
            });

            // Success Type
            $('#ts-info').on('click', function() {
                toastr.info('We do have the Kapua suite available.', 'Turtle Bay Resort');
            });

            // Success Type
            $('#ts-warning').on('click', function() {
                toastr.warning('My name is Inigo Montoya. You killed my father, prepare to die!');
            });

            // Success Type
            $('#ts-error').on('click', function() {
                toastr.error('I do not think that word means what you think it means.', 'Inconceivable!');
            });
        });
    </script>
    <script>
  // Example starter JavaScript for disabling form submissions if there are invalid fields
  (function() {
    'use strict';
    window.addEventListener('load', function() {
      // Fetch all the forms we want to apply custom Bootstrap validation styles to
      var forms = document.getElementsByClassName('needs-validation');
      // Loop over them and prevent submission
      var validation = Array.prototype.filter.call(forms, function(form) {
        form.addEventListener('submit', function(event) {
          if (form.checkValidity() === false) {
            event.preventDefault();
            event.stopPropagation();
          }
          form.classList.add('was-validated');
        }, false);
      });
    }, false);
  })();
  </script>
</body>

</html>