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
                        <li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark sidebar-link" href="dispute" aria-expanded="false"><i class="fas fa-bullhorn"></i><span class="hide-menu">Dispute/Reports</span></a></li>
                           <li class="sidebar-item"> <a class="sidebar-link has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false"><i class=" fas fa-user"></i><span class="hide-menu">Confirmation</span></a>
                            <ul aria-expanded="false" class="collapse  first-level">
                                <li class="sidebar-item"><a href="confirmPasser" class="sidebar-link"><i class=" fas fa-users"></i><span class="hide-menu"> Passer </span></a></li>
                                <li class="sidebar-item"><a href="confirmSeeker" class="sidebar-link"><i class="fas fa-user-secret"></i><span class="hide-menu"> Seeker </span></a></li>
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
                        <h4 class="page-title">Job Sub Category</h4>
                        <div class="ml-auto ">
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
                    <div class="col-md-6">
                        <div class="card">
                            <form class="form-horizontal">
                                <div class="card-header bg-primary text-white">
                                    <h4 class="card-title">Add Job Skills (Sub-Category)</h4>
                                </div>
                                <div class="card-body">
                                    <div class="form-group row">
                                        <label for="fname" class="col-sm-3  control-label col-form-label">Skills Name</label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control" id="fname" placeholder="Skills Name Here">
                                        </div>
                                    </div>
                                     <div class="form-group row">
                                        <label class="col-md-3 ">Publish</label>
                                        <div class="col-md-9">
                                            <div class="custom-control custom-radio">
                                                <input type="radio" class="custom-control-input" id="customControlValidation1" name="radio-stacked" required>
                                                <label class="custom-control-label" for="customControlValidation1">Yes</label>
                                            </div>
                                             <div class="custom-control custom-radio">
                                                <input type="radio" class="custom-control-input" id="customControlValidation2" name="radio-stacked" required>
                                                <label class="custom-control-label" for="customControlValidation2">No</label>
                                            </div>
                                        </div>
                                     </div>
                                </div>
                                <div class="border-top">
                                    <div class="card-body">
                                        <button type="button" class="btn btn-primary">Submit</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                         <!--  ALERT -->
                         <div class="alert alert-success" role="alert">
                            New Skill is Added Successfully!
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                               <span aria-hidden="true ">&times;</span>
                            </button>
                        </div>
                    </div>
                    <div class="col-md-6">
                         <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">Job Skills (Sub-category)</h5>
                                <div class="table-responsive">
                                    <table id="zero_config" class="table table-striped table-bordered">
                                        <thead class="text-center">
                                            <tr>
                                                <th>Skills Name</th>
                                                <th>Status</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody class="text-center">
                                            <tr>
                                                <td>Education</td>
                                                <td>Shown</td>
                                                <td>
                                                    <a href="#" data-toggle="modal" data-target="#Modal1">
                                                    <i class="mdi mdi-check text-success"></i>
                                                     </a>
                                                    <a href="#" data-toggle="modal" data-target="#Modal2" title="Delete">
                                                    <i class="mdi mdi-close text-danger"></i>
                                                    </a>     
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Entertainment</td>
                                                <td>Shown</td>
                                                 <td>
                                                    <a href="#" data-toggle="modal" data-target="#Modal1">
                                                    <i class="mdi mdi-check text-success"></i>
                                                     </a>
                                                    <a href="#" data-toggle="modal" data-target="#Modal2" title="Delete">
                                                    <i class="mdi mdi-close text-danger"></i>
                                                    </a>     
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Education</td>
                                                <td>Shown</td>
                                                 <td>
                                                    <a href="#" data-toggle="modal" data-target="#Modal1">
                                                    <i class="mdi mdi-check text-success"></i>
                                                     </a>
                                                    <a href="#" data-toggle="modal" data-target="#Modal2" title="Delete">
                                                    <i class="mdi mdi-close text-danger"></i>
                                                    </a>     
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Education</td>
                                                <td>Shown</td>
                                                 <td>
                                                    <a href="#" data-toggle="modal" data-target="#Modal1">
                                                    <i class="mdi mdi-check text-success"></i>
                                                     </a>
                                                    <a href="#" data-toggle="modal" data-target="#Modal2" title="Delete">
                                                    <i class="mdi mdi-close text-danger"></i>
                                                    </a>     
                                                </td>
                                            </tr>

                                        </tbody>
                                    </table>
                                                             <!-- Modal 1 -->
                                <div class="modal fade" id="Modal1" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title">Update Job Skills <i class=" fas fa-pencil-alt"></i></h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                    <div class="card">
                            <form class="form-horizontal">
                                <div class="card-body">
                                    <div class="form-group row">
                                        <label for="packageName" class="col-sm-3 control-label col-form-label">Skills Name</label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control" id="skillsName" value="Basic">
                                        </div>
                                    </div>
                                  
                                     <div class="form-group row">
                                        <label class="col-md-3 ">Publish</label>
                                        <div class="col-md-9">
                                            <div class="custom-control custom-radio">
                                                <input type="radio" class="custom-control-input" id="customControlValidation1" name="radio-stacked" required checked>
                                                <label class="custom-control-label" for="customControlValidation1">Yes</label>
                                            </div>
                                             <div class="custom-control custom-radio">
                                                <input type="radio" class="custom-control-input" id="customControlValidation2" name="radio-stacked" required>
                                                <label class="custom-control-label" for="customControlValidation2">No</label>
                                            </div>
                                        </div>
                                     </div>
                                </div>
                            </form>
                        </div>
                            </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                    <button type="button" class="btn btn-primary">Save changes</button>
                                </div>
                            </div>
                        </div>
                        </div>
                        <!--End of  Modal -->
                          <!-- Modal2 -->
                                <div class="modal fade" id="Modal2" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header bg-danger">
                                                <h5 class="modal-title" id="exampleModalLabel"></h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <b>Are you sure you want to delete this?</b>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" >Yes</button>
                                                <button type="button" class="btn btn-primary" data-dismiss="modal">No</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                        <!--End of  Modal -->
                                </div>
                            </div>
                        </div>
                         <!--  ALERT -->
                         <div class="alert alert-success" role="alert">
                            New Skill is Added Successfully!
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                               <span aria-hidden="true ">&times;</span>
                            </button>
                        </div>
                    </div>

                </div>
                <!-- END MODAL -->

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
    <script src="../etc/custom-js-Admin.js"></script>


</body>

</html>