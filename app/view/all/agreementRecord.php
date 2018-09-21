<?php
if(isset($data) && !empty($data)){
    extract($data[0]);
    if(isset($userDetails) && !empty($userDetails)){
      extract($userDetails[0]);
    }
}  
require "../public/header-footer/seeker/seekerHeader1.marvee";


?>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="../../assets/images/favicon.png">
    <title>Passersmate</title>
    <!-- Custom CSS -->
    <link href="../etc/subscription/css/style.min.css" rel="stylesheet">
    <link href="../etc/subscription/build/toastr.min.css" rel="stylesheet">

  <style type="text/css">
    .scroll{
    height:220px;
    overflow-y: scroll;
    overflow-x: ;
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
                <div class="col-md-12">
                  <div class="row">
                    <div class="col-md-11 mx-auto mt-5">
                      <a href="<?php echo $destination; ?>"><h5><u>Back to your Dashboard</u></h5></a>
                      <div class="row justify-content-center">
                        <label><h4><u> Your Employment Agreement Records </u></h4></label>
                      </div>

                      <div class="row mx-auto">
                        <?=$dom;?>
                      </div>

                    </div>
                  </div>
                 </div>
              </div>
            </div>
             <!-- End Container flsuid  -->

    <!-- ============================================================== -->
    <!-- End Wrapper -->
    <!-- ============================================================== -->
    <!-- ============================================================== -->
    <!-- All Jquery -->
    <!-- ============================================================== -->
    <!-- Bootstrap tether Core JavaScript -->
    <script src="../etc/subscription/js/custom.min.js"></script>
    <!--Custom JavaScript -->
    <!-- this page js -->
    <script src="../etc/subscription/build/toastr.min.js"></script>