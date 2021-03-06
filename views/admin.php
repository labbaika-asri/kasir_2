<?php
    require('../controllers/Admin.php')
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="Labbaika Asri" />

    <title>Cashier</title>

    <!-- Custom fonts for this template-->
    <link href="../assets/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css" />
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet" />

    <!-- Custom styles for this template-->
    <link href="../assets/css/sb-admin-2.min.css" rel="stylesheet" />

    <!-- Datepicker -->
    <link rel="stylesheet" href="../assets/css/bootstrap-datepicker3.min.css">

    <!-- My Style -->
    <link rel="stylesheet" href="../assets/css/style.css" />
</head>

<body id="page-top">
    <!-- Page Wrapper -->
    <div id="wrapper">
        <!-- Sidebar -->
        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">
            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="#">
                <div class="sidebar-brand-icon rotate-n-15">
                    <i class="fab fa-optin-monster"></i>
                </div>
                <div class="sidebar-brand-text mx-3">
                    Cashier
                </div>
            </a>

            <!-- Divider -->
            <hr class="sidebar-divider my-0" />

            <!-- Nav Item - Cashier -->
            <li
                class="nav-item <?= !isset($_GET['menu']) || ((isset($_GET['menu'])) && ($_GET['menu']==='cashier')) ? 'active' : '' ?>">
                <a class="nav-link" href="?menu=cashier">
                    <i class="fas fa-fw fa-cash-register"></i>
                    <span>Cashier</span></a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider" />

            <!-- Heading -->
            <div class="sidebar-heading">
                Stock Managements
            </div>

            <!-- Nav Item - Stock -->
            <li
                class="nav-item <?= (isset($_GET['menu'])) && (($_GET['menu']==='stock') || ($_GET['menu']==='input_stock')) ? 'active' : '' ?>">
                <a class="nav-link" href="?menu=stock">
                    <i class="fas fa-fw fa-table"></i>
                    <span>Stock</span></a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider" />

            <!-- Heading -->
            <div class="sidebar-heading">
                Employe Managements
            </div>

            <!-- Nav Item - Employe -->
            <li
                class="nav-item <?= (isset($_GET['menu'])) &&($_GET['menu']==='employe') ? 'active' : '' ?>">
                <a class="nav-link" href="?menu=employe">
                    <i class="fas fa-fw fa-users"></i>
                    <span>Employe</span></a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider" />

            <!-- Heading -->
            <div class="sidebar-heading">
                Utilities
            </div>

            <!-- Nav Item - Report -->
            <li
                class="nav-item <?= (isset($_GET['menu'])) && ($_GET['menu']==='report') ? 'active' : '' ?>">
                <a class="nav-link" href="?menu=report">
                    <i class="fas fa-fw fa-book"></i>
                    <span>Report</span>
                </a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider d-none d-md-block" />

            <!-- Sidebar Toggler (Sidebar) -->
            <div class="text-center d-none d-md-inline">
                <button class="rounded-circle border-0" id="sidebarToggle"></button>
            </div>
        </ul>
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">
            <!-- Main Content -->
            <div id="content">
                <!-- Topbar -->
                <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">
                    <!-- Sidebar Toggle (Topbar) -->
                    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                        <i class="fa fa-bars"></i>
                    </button>

                    <!-- Topbar Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <div class="topbar-divider d-none d-sm-block"></div>

                        <!-- Nav Item - User Information -->
                        <li class="nav-item dropdown no-arrow">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <div class="text-center user-information">
                                    <span class="mr-2 d-none d-lg-inline text-gray-600 small name"><?= $_SESSION['user']['name']; ?></span>
                                    <br />
                                    <span class="mr-2 d-none d-lg-inline text-gray-600 small"><small><?= $_SESSION['user']['role']; ?></small></span>
                                </div>
                                <img class="img-profile rounded-circle"
                                    src="../assets/img/profile/<?= $_SESSION['user']['profile']; ?>" />
                            </a>
                            <!-- Dropdown - User Information -->
                            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                                aria-labelledby="userDropdown">
                                <a class="dropdown-item" href="?menu=profile">
                                    <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Profile
                                </a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Logout
                                </a>
                            </div>
                        </li>
                    </ul>
                </nav>
                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                <div class="container-fluid">
                    <!-- Include Pages -->
                    <?php
                        if (isset($_GET['menu'])) {
                            $menu = $_GET['menu'];

                            switch ($menu) {
                                case 'cashier':
                                    include 'cashier.php';
                                    break;

                                case 'stock':
                                    include 'stock.php';
                                    break;
                                
                                case 'input_stock':
                                    include 'input_stock.php';
                                    break;

                                case 'employe':
                                    include 'employe.php';
                                    break;

                                case 'report':
                                    include 'report.php';
                                    break;
                                
                                case 'profile':
                                    include 'profile.php';
                                    break;
                                
                                default:
                                    include 'error.php';
                                    break;
                            }
                        } else {
                            include 'cashier.php';
                        }
                    ?>
                </div>
                <!-- /.container-fluid -->
            </div>
            <!-- End of Main Content -->

            <!-- Footer -->
            <footer class="sticky-footer bg-white">
                <div class="container my-auto">
                    <div class="copyright text-center my-auto">
                        <span>Copyright &copy; 2020 | Build with <i class="fas fa-heart text-danger"></i> by Labbaika
                            Asri.</span>
                    </div>
                </div>
            </footer>
            <!-- End of Footer -->
        </div>
        <!-- End of Content Wrapper -->
    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <!-- Logout Modal-->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">
                        Ready to Leave?
                    </h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    Select "Logout" below if you are ready to end your
                    current session.
                </div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">
                        Cancel
                    </button>
                    <a class="btn btn-primary" href="logout.php">Logout</a>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="../assets/vendor/jquery/jquery.min.js"></script>
    <script src="../assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="../assets/vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="../assets/js/sb-admin-2.js"></script>

    <!-- Page level plugins -->
    <script src="../assets/vendor/chart.js/Chart.min.js"></script>

    <!-- Sweatalert2 -->
    <script src="../assets/js/sweetalert2.all.min.js"></script>

    <!-- Typeahead -->
    <script src="../assets/js/typeahead.bundle.js"></script>

    <!-- Datepicker -->
    <script src="../assets/js/bootstrap-datepicker.min.js"></script>

    <!-- My Script -->
    <script src="../assets/js/script.js"></script>
</body>

</html>
