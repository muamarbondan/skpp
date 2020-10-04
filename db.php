<?php
    $db = new PDO("mysql:host=localhost;dbname=u236905158_app", 'root', '');
    $url = "http://localhost/samiskpp";
    $dataCook = $_COOKIE['id'];
    // start data akun
    $queryAkun = "SELECT * FROM user WHERE id = $dataCook";
    $stmt = $db->prepare($queryAkun);
    $stmt->execute();
    $rowAkun = $stmt->fetch(PDO::FETCH_ASSOC);
    $kodeSatker = $rowAkun['userid'];
    // end data akkun

    $queryRead = "SELECT * FROM unduh WHERE dibaca_user = 'belum' AND id_user='$dataCook'";
    $stmtRead = $db->prepare($queryRead);
    $stmtRead->execute();

    $countRead = $stmtRead->rowCount();
    $pesanRead;
    if($countRead > 0) {
        $pesanRead = "Kamu memiliki ".$countRead." unduhan SKPP";
    }else{
        $pesanRead = "Kamu tidak memiliki pesan";
    }

    $queryReadModal = "SELECT * FROM pesan WHERE terbaca='0' AND kode='$kodeSatker'";
    $stmtReadModal = $db->prepare($queryReadModal);
    $stmtReadModal->execute();
    
    $countReadModal = $stmtReadModal->rowCount();
    $pesanModal = $stmtReadModal->fetch(PDO::FETCH_ASSOC);
    
    $header = " 
    <html lang='en'>
    <head>
    <meta charset='utf-8'>
    <meta name='viewport' content='width=device-width, initial-scale=1'>
    <meta http-equiv='x-ua-compatible' content='ie=edge'>

    <title>SKPP | Best Choices</title>

    <!-- Font Awesome Icons -->
    <link rel='stylesheet' href='plugins/fontawesome-free/css/all.min.css'>
    <!-- Theme style -->
    <link rel='stylesheet' href='dist/css/adminlte.min.css'>
    <link rel='stylesheet' href='https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css'>
    <link rel='stylesheet' href='plugins/overlayScrollbars/css/OverlayScrollbars.min.css'>
    <link rel='stylesheet' href='https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap4.min.css'>
    <!-- Google Font: Source Sans Pro -->
    <link rel='shortcut icon' href='saestu.ico'>
    <link href='https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700' rel='stylesheet'>
    <!-- style.css -->
    <link rel='stylesheet' href='data.css'>
    <script src='pace/pace.js'></script>
    <link href='pace/themes/purple/pace-theme-flash.css' rel='stylesheet' />
    <style>
            #overlay{
                position: fixed;
                top: 0;
                left: 0;
                width: 100%;
                height: 100%;
                background: rgba(0, 0, 0, 0.7);
                display: table;
                transition: opacity .3s ease;
            }
            .btn{
            border-radius: 5px;
            }
    </style>
    <script src='https://cdn.jsdelivr.net/npm/sweetalert2@10'></script>
    <script>
        const Toast = Swal.mixin({
        toast: true,
        position: 'top-end',
        showConfirmButton: false,
        timer: 3000,
        timerProgressBar: true,
        didOpen: (toast) => {
            toast.addEventListener('mouseenter', Swal.stopTimer)
            toast.addEventListener('mouseleave', Swal.resumeTimer)
        }
        })
    </script>
    </head>
    ";
    
    $nav = "
    <body class='hold-transition sidebar-mini layout-fixed layout-navbar-fixed'>

    <div class='animate-bottom'>
    <!-----------------------------App--------------------------->
    <div id='app'>
    <div class='wrapper'>

    <!-- Navbar -->
    <nav class='main-header navbar navbar-expand navbar-white navbar-light'>
        <!-- Left navbar links -->
        <ul class='navbar-nav'>
        <li class='nav-item'>
            <a class='nav-link' data-widget='pushmenu' href='#'><i class='fas fa-bars'></i></a>
        </li>
        </ul>

        <!-- Right navbar links -->
        <ul class='navbar-nav ml-auto'>
        <!-- Notifications Dropdown Menu -->
        <li class='nav-item dropdown' id='sentuhBell'>
            <a class='nav-link' data-toggle='dropdown' href='#'>
            <i class='far fa-bell'></i>
            <span id='badgeJumlah' class='badge badge-warning navbar-badge'>$countRead</span>
            </a>
            <div class='dropdown-menu dropdown-menu-lg dropdown-menu-right' v-for='n in notif'>
            <span class='dropdown-header'>$countRead Notifications</span>
            <div class='dropdown-divider'></div>
            <a href='$url/landing-page' class='dropdown-item' v-for='n in notif'>
                <i class='fas fa-envelope mr-2'></i> $pesanRead
            </a>
            <div class='dropdown-divider'></div>
            <a href='$url/unduh?status2=active' class='dropdown-item dropdown-footer'>See All Notifications</a>
            </div>
        </li>
        <li class='nav-item'>
            <a class='nav-link' href='$url/keluar'>
            <i class='fas fa-sign-out-alt'></i>
            </a>
        </li>
        </ul>
    </nav>
    <!-- /.navbar -->

    <!-- Main Sidebar Container -->
    <aside class='main-sidebar sidebar-dark-primary elevation-4'>
        <!-- Brand Logo -->
        <a href='#' class='brand-link'>
        <img src='$url/saestu.png' alt='Logo Aplikasi' class='brand-image img-circle elevation-3'
            style='opacity: .8'>
        <span class='brand-text font-weight-light'>SKPP KPPN</span>
        </a>

        <!-- Sidebar -->
        <div class='sidebar'>
        <!-- Sidebar user panel (optional) -->
        <div class='user-panel mt-3 pb-3 mb-3 d-flex'>
            <div class='image'>
                <img src='$url/dist/img/customer.png' class='img-circle elevation-2' alt='User Image'>
            </div>
            <div class='info'>
                <a href='#' class='d-block'>$rowAkun[nama]</a>
            </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class='mt-2'>
            <ul class='nav nav-pills nav-sidebar flex-column' id='menu' data-widget='treeview' role='menu' data-accordion='false'>
            <!-- Add icons to the links using the .nav-icon class
                with font-awesome or any other icon font library -->
            <li class='nav-item highlight' id='nav-item'>
                <a href='$url/landing-page?status1=active' class='nav-link $_GET[status1]'>
                <i class='nav-icon fas fa-user' style='color: #3490dc'></i>
                <p>
                    Profile
                </p>
                </a>
            </li>
            <li class='nav-header'>SKPP</li>
            <li class='nav-item' id='nav-item'>
                <a href='$url/unduh?status2=active' class='nav-link $_GET[status2]'>
                <i class='nav-icon fas fa-download' style='color: #38c172'></i>
                <p>
                    Unduh SKPP
                </p>
                </a>
            </li>
            <li class='nav-item' id='nav-item'>
                <a href='$url/unggah?status3=active' class='nav-link $_GET[status3]'>
                <i class='nav-icon fas fa-upload' style='color: #f66d9b'></i>
                <p>
                    Unggah SKPP
                </p>
                </a>
            </li>
            <li class='nav-header'>TENTANG</li>
            <li class='nav-item' id='nav-item'>
                <a href='$url/keluar' class='nav-link'>
                <i class='nav-icon fas fa-sign-out-alt' style='color: #e3342f'></i>
                <p>
                    Keluar
                </p>
                </a>
            </li>
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
        </div>
        <!-- /.sidebar -->
    </aside>
    ";
    $footer = "
    <!-- Main Footer -->
    <footer class='main-footer'>
        <!-- To the right -->
        <div class='float-right d-none d-sm-inline'>
        </div>
        <!-- Default to the left -->
        Jl. Otto Iskandardinata Lantai III No.53-55 Jakarta - 13330, Telepon 085381647613, Email kppn182@gmail.com
    </footer>
    </div>
    <!-- ./wrapper -->
    </div>
    <!-----------------------------End App--------------------------->
    </div><!----ini Adalah Wrap Loader----->
    <!-- REQUIRED SCRIPTS -->

    <!-- jQuery -->
    <script src='plugins/jquery/jquery.js'></script>
    <script src='http://malsup.github.com/jquery.form.js'></script> 
    <!-- Bootstrap 4 -->
    <script src='plugins/bootstrap/js/bootstrap.bundle.min.js'></script>
    <!-- AdminLTE App -->
    <script src='dist/js/adminlte.min.js'></script>
    <script src='plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js'></script>
    <script src='data/vue.js'></script>
    <script src='data/axios.min.js'></script>
    <script src='data/vue-strap.min.js'></script>
    <script src='plugins/chart.js/Chart.min.js'></script>
    <!-- Sparkline -->
    <script src=''plugins/sparkline/jquery.sparkline.min.js'></script>
    <script src='https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js'></script>
    <script src='https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js'></script>
    ";
?>