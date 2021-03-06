<?php 
$domSeekerUnverified = null;
if(isset($data) && !empty($data)){
    extract($data[0]);
    if(isset($seekerUnverified) && !empty($seekerUnverified)){
        $domSeekerUnverified = $seekerUnverified;
    }
}
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
    <link rel="icon" type="image/png" sizes="16x16" href="../etc/admin/assets/images/logo-icon.png">
    <title>PassersMate Admin</title>
    <!-- Custom CSS -->
    <link href="../etc/admin/assets/libs/fullcalendar/dist/fullcalendar.min.css" rel="stylesheet" />
    <link href="../etc/admin/assets/extra-libs/calendar/calendar.css" rel="stylesheet" />
    <link href="../etc/admin/assets/libs/magnific-popup/dist/magnific-popup.css" rel="stylesheet">
    <link href="../etc/admin/dist/css/style.min.css" rel="stylesheet">
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
<![endif]-->
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
    <div id="main-wrapper">
        <!-- ============================================================== -->
        <!-- Topbar header - style you can find in pages.scss -->
        <!-- ============================================================== -->
        <header class="topbar" data-navbarbg="skin5">
            <nav class="navbar top-navbar navbar-expand-md navbar-dark">
                <div class="navbar-header" data-logobg="skin5">
                    <!-- This is for the sidebar toggle which is visible on mobile only -->
                    <a class="nav-toggler waves-effect waves-light d-block d-md-none" href="javascript:void(0)"><i class="ti-menu ti-close"></i></a>
                    <!-- ============================================================== -->
                    <!-- Logo -->
                    <!-- ============================================================== -->
                    <a class="navbar-brand" href="index">
                        <!-- Logo icon -->
                        <b class="logo-icon p-l-10">
                            <!--You can put here icon as well // <i class="wi wi-sunset"></i> //-->
                            <!-- Dark Logo icon -->
                            <img src="../etc/admin/assets/images/logo-icon.png" alt="homepage" class="light-logo" style="width:50px" />
                           
                        </b>
                        <!--End Logo icon -->
                         <!-- Logo text -->
                        <span class="logo-text">
                             <!-- dark Logo text -->
                             <img src="../etc/admin/assets/images/logo-text.png" alt="homepage" class="light-logo" style="width:170px"/>
                            
                        </span>
                        <!-- Logo icon -->
                        <!-- <b class="logo-icon"> -->
                            <!--You can put here icon as well // <i class="wi wi-sunset"></i> //-->
                            <!-- Dark Logo icon -->
                            <!-- <img src="../etc/admin/assets/images/logo-text.png" alt="homepage" class="light-logo" /> -->
                            
                        <!-- </b> -->
                        <!--End Logo icon -->
                    </a>
                    <!-- ============================================================== -->
                    <!-- End Logo -->
                    <!-- ============================================================== -->
                    <!-- ============================================================== -->
                    <!-- Toggle which is visible on mobile only -->
                    <!-- ============================================================== -->
                    <a class="topbartoggler d-block d-md-none waves-effect waves-light" href="javascript:void(0)" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><i class="ti-more"></i></a>
                </div>
                <!-- ============================================================== -->
                <!-- End Logo -->
                <!-- ============================================================== -->
                <div class="navbar-collapse collapse" id="navbarSupportedContent" data-navbarbg="skin5">
                    <!-- ============================================================== -->
                    <!-- toggle and nav items -->
                    <!-- ============================================================== -->
                    <ul class="navbar-nav float-left mr-auto">
                        <li class="nav-item d-none d-md-block"><a class="nav-link sidebartoggler waves-effect waves-light" href="javascript:void(0)" data-sidebartype="mini-sidebar"><i class="mdi mdi-menu font-24"></i></a></li>
                        <!-- ============================================================== -->
                        <!-- create new -->
                        <!-- ============================================================== -->
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                             <span class="d-none d-md-block">Create New <i class="fa fa-angle-down"></i></span>
                             <span class="d-block d-md-none"><i class="fa fa-plus"></i></span>   
                            </a>
                            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="#">Action</a>
                                <a class="dropdown-item" href="#">Another action</a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="#">Something else here</a>
                            </div>
                        </li>
                        <!-- ============================================================== -->
                        <!-- Search -->
                        <!-- ============================================================== -->
                        <li class="nav-item search-box"> <a class="nav-link waves-effect waves-dark" href="javascript:void(0)"><i class="ti-search"></i></a>
                            <form class="app-search position-absolute">
                                <input type="text" class="form-control" placeholder="Search &amp; enter"> <a class="srh-btn"><i class="ti-close"></i></a>
                            </form>
                        </li>
                    </ul>
                    <!-- ============================================================== -->
                    <!-- Right side toggle and nav items -->
                    <!-- ============================================================== -->
                    <ul class="navbar-nav float-right">
                        <!-- ============================================================== -->
                        <!-- Comment -->
                        <!-- ============================================================== -->
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle waves-effect waves-dark" href="" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="mdi mdi-bell font-24"></i>
                            </a>
                             <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="#">Action</a>
                                <a class="dropdown-item" href="#">Another action</a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="#">Something else here</a>
                            </div>
                        </li>
                        <!-- ============================================================== -->
                        <!-- End Comment -->
                        <!-- ============================================================== -->
                        <!-- ============================================================== -->
                        <!-- Messages -->
                        <!-- ============================================================== -->
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle waves-effect waves-dark" href="" id="2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="font-24 mdi mdi-comment-processing"></i>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right mailbox animated bounceInDown" aria-labelledby="2">
                                <ul class="list-style-none">
                                    <li>
                                        <div class="">
                                             <!-- Message -->
                                            <a href="javascript:void(0)" class="link border-top">
                                                <div class="d-flex no-block align-items-center p-10">
                                                    <span class="btn btn-success btn-circle"><i class="ti-calendar"></i></span>
                                                    <div class="m-l-10">
                                                        <h5 class="m-b-0">Event today</h5> 
                                                        <span class="mail-desc">Just a reminder that event</span> 
                                                    </div>
                                                </div>
                                            </a>
                                            <!-- Message -->
                                            <a href="javascript:void(0)" class="link border-top">
                                                <div class="d-flex no-block align-items-center p-10">
                                                    <span class="btn btn-info btn-circle"><i class="ti-settings"></i></span>
                                                    <div class="m-l-10">
                                                        <h5 class="m-b-0">Settings</h5> 
                                                        <span class="mail-desc">You can customize this template</span> 
                                                    </div>
                                                </div>
                                            </a>
                                            <!-- Message -->
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        </li>
                        <!-- ============================================================== -->
                        <!-- End Messages -->
                        <!-- ============================================================== -->

                        <!-- ============================================================== -->
                        <!-- User profile and search -->
                        <!-- ============================================================== -->
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle text-muted waves-effect waves-dark pro-pic" href="" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><img src="../etc/admin/assets/images/users/1.jpg" alt="user" class="rounded-circle" width="31"></a>
                            <div class="dropdown-menu dropdown-menu-right user-dd animated">
                                <a class="dropdown-item" href="myprofile"><i class="ti-user m-r-5 m-l-5"></i> My Profile</a>
                                <a class="dropdown-item" href="inbox"><i class="ti-email m-r-5 m-l-5"></i> Inbox</a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="settings"><i class="ti-settings m-r-5 m-l-5"></i> Account Settings</a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="authentication-login"><i class="fa fa-power-off m-r-5 m-l-5"></i> Logout</a>
                                <div class="dropdown-divider"></div>
                                <div class="p-l-30 p-10"><a href="javascript:void(0)" class="btn btn-sm btn-success btn-rounded">View Profile</a></div>
                            </div>
                        </li>
                        <!-- ============================================================== -->
                        <!-- User profile and search -->
                        <!-- ============================================================== -->
                    </ul>
                </div>
            </nav>
        </header>
        <!-- ============================================================== -->
        <!-- End Topbar header -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- Left Sidebar - style you can find in sidebar.scss  -->
        <!-- ============================================================== -->
       <aside class="left-sidebar" data-sidebarbg="skin5">
            <!-- Sidebar scroll-->
            <div class="scroll-sidebar">
                <!-- Sidebar navigation-->
                <nav class="sidebar-nav">
                    <ul id="sidebarnav" class="p-t-30">
                        <li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark sidebar-link" href="index" aria-expanded="false"><i class="mdi mdi-view-dashboard"></i><span class="hide-menu">Dashboard</span></a></li>
                        
                         <li class="sidebar-item"> <a class="sidebar-link has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false"><i class="fas fa-cog"></i><span class="hide-menu">Job Title </span></a>
                            <ul aria-expanded="false" class="collapse  first-level">
                                <li class="sidebar-item"><a href="jobcategories" class="sidebar-link"><i class=" fas fa-briefcase"></i><span class="hide-menu"> Categories </span></a></li>
                                <li class="sidebar-item"><a href="jobskills" class="sidebar-link"><i class="fas fa-wrench"></i><span class="hide-menu"> Skills </span></a></li>
                            </ul>
                        </li>
                        <li class="sidebar-item"> <a class="sidebar-link has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false"><i class=" far fa-money-bill-alt"></i><span class="hide-menu">Payments</span></a>
                            <ul aria-expanded="false" class="collapse  first-level">
                                <li class="sidebar-item"><a href="package" class="sidebar-link"><i class=" fas fa-gift"></i><span class="hide-menu"> Packages </span></a></li>
                                <li class="sidebar-item"><a href="subscription" class="sidebar-link"><i class="fas fa-th-list"></i><span class="hide-menu"> Subscription </span></a></li>
                                
                            </ul>
                        </li>
                          <li class="sidebar-item"> <a class="sidebar-link has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false"><i class=" fas fa-user"></i><span class="hide-menu">Users</span></a>
                            <ul aria-expanded="false" class="collapse  first-level">
                                <li class="sidebar-item"><a href="allUser" class="sidebar-link"><i class=" fas fa-users"></i><span class="hide-menu"> All user </span></a></li>
                                <li class="sidebar-item"><a href="admin" class="sidebar-link"><i class="fas fa-user-secret"></i><span class="hide-menu"> Admins </span></a></li>
                                <li class="sidebar-item"><a href="passers" class="sidebar-link"><i class="fas fa-user-md"></i><span class="hide-menu"> Passers </span></a></li>
                                <li class="sidebar-item"><a href="seekers" class="sidebar-link"><i class=" fas fa-user-circle"></i><span class="hide-menu"> Seekers </span></a></li>
                            </ul>
                        </li>
                                                <li class="sidebar-item"> 
                            <a class="sidebar-link waves-effect waves-dark sidebar-link" href="dispute" aria-expanded="false">
                                <i class="fas fa-bullhorn"></i>
                                <span class="hide-menu mr-5">Dispute/Reports</span>
                                <span class="badge badge-danger"><b id="disputeCount"> 4</b></span>
                            </a>
                        </li>
                      	   <li class="sidebar-item"> 
                            <a class="sidebar-link has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false">
                                <i class=" fas fa-user"></i>
                                <span class="hide-menu mr-5">Confirmation</span>
                                <span class="badge badge-danger" id="confirmCount"><b> 4</b></span>
                            </a>
                            <ul aria-expanded="false" class="collapse  first-level">
                                <li class="sidebar-item"><a href="confirmPasser" class="sidebar-link">
                                    <i class=" fas fa-users"></i>
                                    <span class="hide-menu mr-5"> Passer </span>
                                    <span class="badge badge-danger"><b id="passerVerifyCount"> 4</b></span>
                                </a>
                            </li>
                                <li class="sidebar-item">
                                    <a href="confirmSeeker" class="sidebar-link">
                                        <i class="fas fa-user-secret"></i>
                                        <span class="hide-menu mr-5"> Seeker </span>
                                        <span class="badge badge-danger"><b id="seekerVerifyCount"> 4</b></span>
                                    </a>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </nav>
                <!-- End Sidebar navigation -->
            </div>
            <!-- End Sidebar scroll-->
        </aside>
        <!-- ============================================================== -->
        <!-- End Left Sidebar - style you can find in sidebar.scss  -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- Page wrapper  -->
        <!-- ============================================================== -->
        <div class="page-wrapper">
            <!-- ============================================================== -->
            <!-- Bread crumb and right sidebar toggle -->
            <!-- ============================================================== -->
            <div class="page-breadcrumb">
                <div class="row">
                    <div class="col-12 d-flex no-block align-items-center">
                        <h4 class="page-title text-danger">Confirmation</h4>
                        <div class="ml-auto text-right">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
            <!-- ============================================================== -->
            <!-- End Bread crumb and right sidebar toggle -->
            <!-- ============================================================== -->
            <!-- ============================================================== -->
            <!-- Container fluid  -->
            <!-- ============================================================== -->
            <div class="container-fluid">
                <!-- ============================================================== -->
                <!-- Start Page Content -->
                <!-- ============================================================== -->
                <div class="row">
                    <div class="col-md-12 col-sm-12">
                    <div class="card">
                            <div class="card-body">
                                <h5 class="card-title m-b-0">Confirming Users</h5>
                            </div>
                            <div class="table-responsive">
                            <table id="zero_config" class="table table-striped table-bordered">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th scope="col">Name</th>
                                        <th scope="col">Email address</th>
                                        <th scope="col">User Type</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?=$domSeekerUnverified;?>
                                </tbody>
                            </table>
                            </div>
                               <!-- Modal -->
                                <div class="modal fade" id="Modal3" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Marvee Yofa Franco</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                  <!-- Tabs -->
                        <div class="card">
                            <!-- Nav tabs -->
                            <ul class="nav nav-tabs" role="tablist">
                                <li class="nav-item"> <a class="nav-link active" data-toggle="tab" href="#home" role="tab"><span class="hidden-sm-up"></span> <span class="hidden-xs-down">Personal Details</span></a> </li>
                                <li class="nav-item"> <a class="nav-link" data-toggle="tab" href="#messages" role="tab"><span class="hidden-sm-up"></span> <span class="hidden-xs-down">Government Issued</span></a> </li>
                            </ul>
                            <!-- Tab panes -->
                            <div class="tab-content tabcontent-border">
                                <div class="tab-pane active" id="home" role="tabpanel">
                                      
                                    <div class="p-20">
                                         <div class="card-body">
                                            <div class="card border shadow">
                                                 <img name="seekerProfile" src="../etc/admin/assets/images/big/img4.jpg" alt="user" width="100%">
                                                  <div class="card-body">
                                                    <p class="card-text"><b>Profile Picture</b></p>
                                                  </div>
                                            </div>
                                            <form class="form-horizontal">
                                              <!--   <div class="card-header text-white">
                                                </div> -->
                                                <div class="form-group row">
                                                    <label for="fname" class="col-sm-3 control-label col-form-label">First Name</label>
                                                    <div class="col-sm-9">
                                                        <input type="text" class="form-control" id="fname" disabled>
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label for="lname" class="col-sm-3  control-label col-form-label">Last Name</label>
                                                    <div class="col-sm-9">
                                                        <input type="text" class="form-control" id="lname" disabled>
                                                    </div>
                                                </div>
                                                 <div class="form-group row">
                                                    <label for="address" class="col-sm-3  control-label col-form-label">Address</label>
                                                    <div class="col-sm-9">
                                                        <input type="text" class="form-control" id="address" disabled>
                                                    </div>
                                                </div>
                                                 <div class="form-group row">
                                                    <label for="gender" class="col-sm-3  control-label col-form-label">Gender</label>
                                                    <div class="col-sm-9">
                                                        <input type="text" class="form-control" id="gender" disabled>
                                                    </div>
                                                </div>
                                                 <div class="form-group row">
                                                    <label for="birthday" class="col-sm-3  control-label col-form-label">Birthday</label>
                                                    <div class="col-sm-9">
                                                        <input type="text" class="form-control" id="birthday" disabled>
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label for="age" class="col-sm-3 control-label col-form-label">Age</label>
                                                    <div class="col-sm-9">
                                                        <input type="text" class="form-control" id="age" disabled>
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label for="cnum" class="col-sm-3 control-label col-form-label">Contact #</label>
                                                    <div class="col-sm-9">
                                                        <input type="text" class="form-control" id="cnum" disabled>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane p-20" id="messages" role="tabpanel">
                                    <div class="p-20">
                                          <div class="row">
                                            <div class="col-md-12">
                                            <div class="card border shadow">
                                                <img name="governmentFront" src="../etc/admin/assets/images/big/img4.jpg" alt="user" width="100%">
                                                <div class="card-body">
                                                    <p class="card-text"><b>Front of ID</b></p>
                                                </div>
                                            </div>
                                            </div>
                                        </div>
                                          <div class="row">
                                            <div class="col-md-12">
                                            <div class="card border shadow">
                                                <img name="governmentBack" src="../etc/admin/assets/images/big/img4.jpg" alt="user" width="100%">
                                                <div class="card-body">
                                                    <p class="card-text"><b>Back of ID</b></p>
                                                </div>
                                            </div>
                                            </div>
                                        </div>
                                          <div class="row">
                                            <div class="col-md-12">
                                            <div class="card border shadow">
                                                <img name="governmentSelfie" src="../etc/admin/assets/images/big/img4.jpg" alt="user" width="100%">
                                                <div class="card-body">
                                                    <p class="card-text"><b>Selfie with ID</b></p>
                                                </div>
                                            </div>
                                            </div>
                                        </div>
                                           
                                        <div class="form-group row">
                                            <label for="idNumber" class="col-sm-3 control-label col-form-label">ID Number</label>
                                                <div class="col-sm-9">
                                                <input type="text" class="form-control" id="idNumber" disabled>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="idType" class="col-sm-3 control-label col-form-label">Type of ID</label>
                                                <div class="col-sm-9">
                                                <input type="text" class="form-control" id="idType" disabled>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="expirationDateGovernmentID" class="col-sm-3 control-label col-form-label">Expiration Date</label>
                                                <div class="col-sm-9">
                                                <input type="text" class="form-control" id="expirationDateGovernmentID" disabled>
                                            </div>
                                        </div>
                                          <div class="border-top">
                                            <div class="card-body">
                                                <button type="button" name="verifySeeker" class="btn btn-success verifySeeker">Verify</button>
                                                <button type="button" name="denySeeker" class="btn btn-dark denySeeker">Denied</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                          </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            </div>
                         </div>
                    </div>
                </div>
                <!-- END OF MODAL -->
                        </div>
                    </div>
                </div>

                <!-- ============================================================== -->
                <!-- End PAge Content -->
                <!-- ============================================================== -->
                <!-- ============================================================== -->
                <!-- Right sidebar -->
                <!-- ============================================================== -->
                <!-- .right-sidebar -->
                <!-- ============================================================== -->
                <!-- End Right sidebar -->
                <!-- ============================================================== -->
            </div>
            <!-- ============================================================== -->
            <!-- End Container fluid  -->
            <!-- ============================================================== -->
            <!-- ============================================================== -->
            <!-- footer -->
            <!-- ============================================================== -->
            <footer class="footer text-center">
                All Rights Reserved by PassersMate-admin. Designed and Developed by <a href="#">HAHAHA</a>.
            </footer>
            <!-- ============================================================== -->
            <!-- End footer -->
            <!-- ============================================================== -->
        </div>
        <!-- ============================================================== -->
        <!-- End Page wrapper  -->
        <!-- ============================================================== -->
    </div>
    <!-- ============================================================== -->
    <!-- End Wrapper -->
    <!-- ============================================================== -->
    <!-- ============================================================== -->
    <!-- All Jquery -->
    <!-- ============================================================== -->
    <script src="../etc/admin/assets/libs/jquery/dist/jquery.min.js"></script>
    <script src="../etc/admin/dist/js/jquery.ui.touch-punch-improved.js"></script>
    <script src="../etc/admin/dist/js/jquery-ui.min.js"></script>
    <!-- Bootstrap tether Core JavaScript -->
    <script src="../etc/admin/assets/libs/popper.js/dist/umd/popper.min.js"></script>
    <script src="../etc/admin/assets/libs/bootstrap/dist/js/bootstrap.min.js"></script>
    <!-- slimscrollbar scrollbar JavaScript -->
    <script src="../etc/admin/assets/libs/perfect-scrollbar/dist/perfect-scrollbar.jquery.min.js"></script>
    <script src="../etc/admin/assets/extra-libs/sparkline/sparkline.js"></script>
    <!--Wave Effects -->
    <script src="../etc/admin/dist/js/waves.js"></script>
    <!--Menu sidebar -->
    <script src="../etc/admin/dist/js/sidebarmenu.js"></script>
    <!--Custom JavaScript -->
    <script src="../etc/admin/dist/js/custom.min.js"></script>
    <!-- this page js -->
    <script src="../etc/admin/assets/libs/moment/min/moment.min.js"></script>
    <script src="../etc/admin/assets/libs/fullcalendar/dist/fullcalendar.min.js"></script>
    <script src="../etc/admin/dist/js/pages/calendar/cal-init.js"></script>
       <!-- this page js -->
    <script src="../etc/admin/assets/extra-libs/multicheck/datatable-checkbox-init.js"></script>
    <script src="../etc/admin/assets/extra-libs/multicheck/jquery.multicheck.js"></script>
    <script src="../etc/admin/assets/extra-libs/DataTables/datatables.min.js"></script>
    <script>
        /****************************************
         *       Basic Table                   *
         ****************************************/
        $('#zero_config').DataTable();
    </script>
     <!-- this page js -->
    <script src="../etc/admin/assets/libs/magnific-popup/dist/jquery.magnific-popup.min.js"></script>
    <script src="../etc/admin/assets/libs/magnific-popup/meg.init.js"></script>
    <script src="../etc/custom-js-Admin.js"></script>


</body>

</html>