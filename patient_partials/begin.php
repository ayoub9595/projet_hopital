<?php session_start();?>
<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="../template/assets/vendor/bootstrap/css/bootstrap.min.css">
    <link href="../template/assets/vendor/fonts/circular-std/style.css" rel="stylesheet">
    <link rel="stylesheet" href="../template/assets/libs/css/style.css">
    <link rel="stylesheet" href="../template/assets/vendor/fonts/fontawesome/css/fontawesome-all.css">
    <link rel="stylesheet" href="../template/assets/vendor/vector-map/jqvmap.css">
    <link href="../template/assets/vendor/jvectormap/jquery-jvectormap-2.0.2.css" rel="stylesheet">
    <link rel="stylesheet" href="../template/assets/vendor/charts/chartist-bundle/chartist.css">
    <link rel="stylesheet" href="../template/assets/vendor/charts/c3charts/c3.css">
    <link rel="stylesheet" href="../template/assets/vendor/charts/morris-bundle/morris.css">
    <link rel="stylesheet" type="text/css" href="../template/assets/vendor/daterangepicker/daterangepicker.css" />
    <title>Centre Hospitalier de Marrakech</title>
</head>

<body>
<!-- ============================================================== -->
<!-- main wrapper -->
<!-- ============================================================== -->
<div class="dashboard-main-wrapper">
    <!-- ============================================================== -->
    <!-- navbar -->
    <!-- ============================================================== -->
    <div class="dashboard-header">
        <nav class="navbar navbar-expand-lg bg-white fixed-top">
            <a class="navbar-brand" href="index.php">Centre Hospitalier de Marrakech</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse " id="navbarSupportedContent">
                <ul class="navbar-nav ml-auto navbar-right-top">

                    <li class="nav-item dropdown nav-user">
                        <a class="nav-link nav-user-img" href="#" id="navbarDropdownMenuLink2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><img src="../template/assets/images/avatar-1.jpg" alt="" class="user-avatar-md rounded-circle"></a>
                        <div class="dropdown-menu dropdown-menu-right nav-user-dropdown" aria-labelledby="navbarDropdownMenuLink2">
                            <div class="nav-user-info">
                                <h5 class="mb-0 text-white nav-user-name"><?php echo $_SESSION["prenom"]." ".$_SESSION["nom"]?></h5>

                            </div>
                            <a class="dropdown-item" href="#"><i class="fas fa-user mr-2"></i>Account</a>
                            <a class="dropdown-item" href="#"><i class="fas fa-cog mr-2"></i>Setting</a>
                            <a class="dropdown-item" href="../logout.php"><i class="fas fa-power-off mr-2"></i>Logout</a>
                        </div>
                    </li>
                </ul>
            </div>
        </nav>
    </div>
    <!-- ============================================================== -->
    <!-- end navbar -->
    <!-- ============================================================== -->
    <!-- ============================================================== -->
    <!-- left sidebar -->
    <!-- ============================================================== -->
    <div class="nav-left-sidebar sidebar-dark">
        <div class="menu-list">
            <nav class="navbar navbar-expand-lg navbar-light">
                <a class="d-xl-none d-lg-none" href="#">Dashboard</a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav flex-column">
                        <li class="nav-item ">
                            <a class="nav-link active" href="#" data-toggle="collapse" aria-expanded="false" data-target="#submenu-1" aria-controls="submenu-1"><i class="fa fa-fw fa-user-circle"></i>Menu <span class="badge badge-success">6</span></a>
                            <div id="submenu-1" class="collapse submenu" style="">
                                <ul class="nav flex-column">
                                    <li class="nav-item">
                                        <a class="nav-link" href="#" data-toggle="collapse" aria-expanded="false" data-target="#submenu-1-1" aria-controls="submenu-1-1">Rendez vous</a>
                                        <div id="submenu-1-1" class="collapse submenu" style="">
                                            <ul class="nav flex-column">
                                             <!--   <li class="nav-item">
                                                    <a class="nav-link" href="../Patient/rdv_hosp_class.php">Hospitalisation Classique</a>
                                                </li>
                                                <li class="nav-item">
                                                    <a class="nav-link" href="../Patient/rdv_hosp_jour.php">Hospitalisation du jour</a>
                                                </li> -->
                                                <li class="nav-item">
                                                    <a class="nav-link" href="../Patient/rdv_consult_clinique.php">Consultation clinique</a>
                                                </li>
                                            </ul>
                                        </div>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="#" data-toggle="collapse" aria-expanded="false" data-target="#submenu-1-2" aria-controls="submenu-1-2">Admission</a>
                                        <div id="submenu-1-2" class="collapse submenu" style="">
                                            <ul class="nav flex-column">
                                              <!--  <li class="nav-item">
                                                    <a class="nav-link" href="../Patient/adm_hosp_class.php">Hospitalisation Classique</a>
                                                </li>
                                                <li class="nav-item">
                                                    <a class="nav-link" href="../Patient/adm_hosp_jour.php">Hospitalisation du jour</a>
                                                </li>  -->
                                                <li class="nav-item">
                                                    <a class="nav-link" href="../Patient/adm_consult_clinique.php">Consultation clinique</a>
                                                </li>
                                            </ul>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        </li>

                    </ul>
                </div>
            </nav>
        </div>
    </div>
    <!-- ============================================================== -->
    <!-- end left sidebar -->
    <!-- ============================================================== -->
    <!-- ============================================================== -->
    <!-- wrapper  -->
    <!-- ============================================================== -->
    <div class="dashboard-wrapper">
        <div class="dashboard-finance">
            <div class="container-fluid dashboard-content">
                <!-- ============================================================== -->


