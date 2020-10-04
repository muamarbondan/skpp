<?php
    $db = new PDO("mysql:host=localhost;dbname=u236905158_app", 'root', '');
    $url = "http://home.saestu";
    $header = " 
    <html lang='en'>
    <head>
    <meta charset='utf-8'>
    <meta name='viewport' content='width=device-width, initial-scale=1'>
    <meta http-equiv='x-ua-compatible' content='ie=edge'>

    <title>samiSKPP | Best Choices</title>

    <!-- Font Awesome Icons -->
    <link rel='stylesheet' href='plugins/fontawesome-free/css/all.min.css'>
    <!-- Theme style -->
    <link rel='stylesheet' href='dist/css/adminlte.min.css'>
    <link rel='stylesheet' href='https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css'>
    <link rel='stylesheet' href='plugins/overlayScrollbars/css/OverlayScrollbars.min.css'>
    <!-- Google Font: Source Sans Pro -->
    <link href='https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700' rel='stylesheet'>
    <!-- style.css -->
    <link rel='stylesheet' href='data.css'>
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
            #loader{
            position: absolute;
            left: 50%;
            top: 50%;
            z-index: 1;
            margin: -75px 0 0 -75px;
            }
            .btn{
            border-radius: 5px;
            }
    </style>
    <script src='https://cdn.jsdelivr.net/npm/sweetalert2@8'></script>
        <script>
            const Toast = Swal.mixin({
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 3000
            })
        </script>
        <script>
        var MyVar;

        function MyFunction(){
            MyVar = setTimeout(() => {
            showPage();
            }, 1000);
        }

        function showPage(){
            document.getElementById('loader').style.display = 'none';
            document.getElementById('myDiv').style.display = 'block';
        }
        </script>
    </head>
    ";
    
    $nav = "
    <body class='hold-transition sidebar-mini layout-fixed layout-navbar-fixed layout-footer-fixed' onload='MyFunction()'>
    <!------------------------loader------------------------------>
    <div id='loader'>
    <div class='spinner-grow text-primary' role='status'>
        <span class='sr-only'>Loading...</span>
    </div>
    <div class='spinner-grow text-warning' role='status'>
        <span class='sr-only'>Loading...</span>
    </div>
    <div class='spinner-grow text-success' role='status'>
        <span class='sr-only'>Loading...</span>
    </div>
    <div class='spinner-grow text-danger' role='status'>
        <span class='sr-only'>Loading...</span>
    </div>
    </div>

    <div style='display: none' id='myDiv' class='animate-bottom'>
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
        <li class='nav-item dropdown'>
            <a class='nav-link' data-toggle='dropdown' href='#'>
            <i class='far fa-bell'></i>
            </a>
            <div class='dropdown-menu dropdown-menu-lg dropdown-menu-right' v-for='n in notif'>
            <span class='dropdown-header' v-for='n in notif'>{{notif.length}} Notifications</span>
            <div class='dropdown-divider'></div>
            <a href='$url/landing-page' class='dropdown-item' v-for='n in notif'>
                <i class='fas fa-envelope mr-2'></i> {{n.judul}}
            </a>
            <div class='dropdown-divider'></div>
            <a href='#' class='dropdown-item dropdown-footer'>See All Notifications</a>
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
        <img src='$url/dist/img/brand-logo.png' alt='Logo Aplikasi' class='brand-image img-circle elevation-3'
            style='opacity: .8'>
        <span class='brand-text font-weight-light'>Cleverst Indonesia</span>
        </a>

        <!-- Sidebar -->
        <div class='sidebar'>
        <!-- Sidebar user panel (optional) -->
        <div class='user-panel mt-3 pb-3 mb-3 d-flex'>
            <div class='image'>
            <img v-for='s in user' :src='s.images' class='img-circle elevation-2' alt='User Image'>
            </div>
            <div class='info'>
            <a href='#' class='d-block' v-for='s in user'>{{s.nama}}</a>
            </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class='mt-2'>
            <ul class='nav nav-pills nav-sidebar flex-column' id='menu' data-widget='treeview' role='menu' data-accordion='false'>
            <!-- Add icons to the links using the .nav-icon class
                with font-awesome or any other icon font library -->
            <li class='nav-item highlight' id='nav-item'>
                <a href='$url/landing-page' class='nav-link'>
                <i class='nav-icon fas fa-tachometer-alt' style='color: #3490dc'></i>
                <p>
                    Dashboard
                </p>
                </a>
            </li>
            <li class='nav-header'>TRY OUT & MATERI</li>
            <li class='nav-item' id='nav-item'>
                <a href='$url/tryout' class='nav-link'>
                <i class='nav-icon fas fa-play-circle' style='color: #38c172'></i>
                <p>
                    Try Out
                    <span class='right badge badge-danger'>New</span>
                </p>
                </a>
            </li>
            <li class='nav-item' id='nav-item'>
                <a href='$url/materi' class='nav-link'>
                <i class='nav-icon fas fa-book' style='color: #f66d9b'></i>
                <p>
                    Materi
                    <span class='right badge badge-danger'>New</span>
                </p>
                </a>
            </li>
            <li class='nav-header'>MENU LAINNYA</li>
                <li class='nav-item' id='nav-item'>
                <a href='$url/rangking' class='nav-link bg'>
                <i class='nav-icon fas fa-chart-bar' style='color: #38c172'></i>
                <p>
                    Rangking Nasional
                </p>
                </a>
            </li>
            <li class='nav-item' id='nav-item'>
                <a href='$url/rangking' class='nav-link bg'>
                <i class='nav-icon fas fa-book-open' style='color: #f66d9b'></i>
                <p>
                    Pembahasan Soal
                </p>
                </a>
            </li>
            <li class='nav-item' id='nav-item'>
                <a href='$url/kritik' class='nav-link bg'>
                <i class='nav-icon fas fa-comments' style='color: #f6993f'></i>
                <p>
                    Kritik/Saran
                </p>
                </a>
            </li>
            <li class='nav-header'>PENGATURAN</li>
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
        HIMAMANKEU
        </div>
        <!-- Default to the left -->
        <strong>Copyright &copy; 2019 <a href='#'>MANAJAMEN KEUANGAN</a>.</strong> All rights reserved.
    </footer>
    </div>
    <!-- ./wrapper -->
    </div>
    <!-----------------------------End App--------------------------->
    </div><!----ini Adalah Wrap Loader----->
    <!-- REQUIRED SCRIPTS -->

    <!-- jQuery -->
    <script src='plugins/jquery/jquery.js'></script>
    <!-- Bootstrap 4 -->
    <script src='plugins/bootstrap/js/bootstrap.bundle.min.js'></script>
    <!-- AdminLTE App -->
    <script src='dist/js/adminlte.min.js'></script>
    <script src='plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js'></script>
    <script src='data/vue.js'></script>
    <script src='data/axios.min.js'></script>
    <script src='data/vue-strap.min.js'></script>
    <script src='plugins/chart.js/Chart.min.js'></script>
    ";
?>