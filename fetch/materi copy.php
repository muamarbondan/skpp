<!DOCTYPE html>
<?php
  $dataId = 1;
?>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta http-equiv="x-ua-compatible" content="ie=edge">

  <title>ReadLearn | HIMA MANKEU</title>

  <!-- Font Awesome Icons -->
  <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/adminlte.min.css">
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <link rel="stylesheet" href="plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
  <!-- style.css -->
  <link rel="stylesheet" href="dist/css/style.css">
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
          border-radius: 20px;
        }
  </style>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@8"></script>
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
        document.getElementById("loader").style.display = "none";
        document.getElementById("myDiv").style.display = "block";
      }
    </script>
</head>
<body class="hold-transition sidebar-mini" onload="MyFunction()">
<!------------------------loader------------------------------>
<div id="loader">
  <div class="spinner-grow text-primary" role="status">
    <span class="sr-only">Loading...</span>
  </div>
  <div class="spinner-grow text-warning" role="status">
    <span class="sr-only">Loading...</span>
  </div>
  <div class="spinner-grow text-success" role="status">
    <span class="sr-only">Loading...</span>
  </div>
  <div class="spinner-grow text-danger" role="status">
    <span class="sr-only">Loading...</span>
  </div>
</div>

<div style="display: none" id="myDiv" class="animate-bottom">
<!-----------------------------App--------------------------->
<div id="app">
<div class="wrapper">

  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#"><i class="fas fa-bars"></i></a>
      </li>
    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
      <!-- Notifications Dropdown Menu -->
      <li class="nav-item dropdown">
        <a class="nav-link" data-toggle="dropdown" href="#">
          <i class="far fa-bell"></i>
        </a>
        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right" v-for="n in notif">
          <span class="dropdown-header" v-for="n in notif">{{notif.length}} Notifications</span>
          <div class="dropdown-divider"></div>
          <a href="<?php echo $url ?>/landing-page" class="dropdown-item" v-for="n in notif">
            <i class="fas fa-envelope mr-2"></i> {{n.judul}}
          </a>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item dropdown-footer">See All Notifications</a>
        </div>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="<?php echo $url ?>/keluar">
          <i class="fas fa-sign-out-alt"></i>
        </a>
      </li>
    </ul>
  </nav>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="index3.html" class="brand-link">
      <img src="dist/img/think.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3"
           style="opacity: .8">
      <span class="brand-text font-weight-light">Red Learn</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img v-for="s in user" :src="s.images" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="#" class="d-block" v-for="s in user">{{s.nama}}</a>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" id="menu" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          <li class="nav-item highlight" id="nav-item">
            <a href="<?php echo $url ?>/landing-page" class="nav-link">
              <i class="nav-icon fas fa-tachometer-alt" style="color: #3490dc"></i>
              <p>
                Dashboard
              </p>
            </a>
          </li>
          <li class="nav-header">TRY OUT & MATERI</li>
          <li class="nav-item" id="nav-item">
            <a href="<?php echo $url ?>/tryout" class="nav-link">
              <i class="nav-icon fas fa-play-circle" style="color: #38c172"></i>
              <p>
                Try Out
                <span class="right badge badge-danger">New</span>
              </p>
            </a>
          </li>
          <li class="nav-item" id="nav-item">
            <a href="<?php echo $url ?>/materi" class="nav-link">
              <i class="nav-icon fas fa-book" style="color: #f66d9b"></i>
              <p>
                Materi
                <span class="right badge badge-danger">New</span>
              </p>
            </a>
          </li>
          <li class="nav-header">MENU LAINNYA</li>
          <li class="nav-item" id="nav-item">
            <a href="<?php echo $url ?>/kritik" class="nav-link bg">
              <i class="nav-icon fas fa-comments" style="color: #38c172"></i>
              <p>
                Kritik/Saran
              </p>
            </a>
          </li>
          <li class="nav-header">PENGATURAN</li>
          <li class="nav-item" id="nav-item">
            <a href="<?php echo $url ?>/keluar" class="nav-link">
              <i class="nav-icon fas fa-sign-out-alt" style="color: #e3342f"></i>
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

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Materi</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">
      <div class="container-fluid">

        <div class="row">

        <div class="col-md-12">
          <div class="alert alert-danger alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            <h5><i class="icon fas fa-info"></i> Menu Materi</h5>
            Adalah menu yang berisi modul, video learning dan RPS yang sangat membantu dalam proses untuk belajar
          </div>
        </div>

        </div>

        <div class="row">

          <!-- /.col-md-9 -->
        <div class="col-lg-6">
              <div class="card">
              <div class="card-header">
                <h3 class="card-title">Modul Mata Kuliah</h3>

                <div class="card-tools">
                  <div class="input-group input-group-sm" style="width: 150px;">
                    <select name="pilih-data" class="form-control float-right">
                      <option value="DI KBN">DI KBN</option>
                      <option value="DIII KBN I">DIII KBN I</option>
                      <option value="DIII KBN II">DIII KBN II</option>
                      <option value="DIII KBN III">DIII KBN III</option>
                      <option value="DIII MANSET I">DIII MANSET I</option>
                      <option value="DIII MANSET II">DIII MANSET II</option>
                      <option value="DIII MANSET III">DIII MANSET III</option>
                    </select>
                  </div>
                </div>
              </div>
              <!-- /.card-header -->
              <div class="card-body table-responsive p-0" style="height: 300px;">
                <table class="table table-head-fixed text-center table-striped">
                  <thead>
                    <tr>
                      <th>No</th>
                      <th>Nama Matkul</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                      <td>183</td>
                      <td>John Doe</td>
                      <td><button class="btn btn-sm btn-danger">Download</button></td>
                    </tr>
                  </tbody>
                </table>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->

        </div>
        <!-- /.col-md-6 -->

        </div>
          

          <!----------------------------------Modal hapus Todo-------------------------->
          <div class="modal" tabindex="-1" role="dialog" id="overlay" v-if="modalDelTodo">
          <div class="modal-dialog modal-dialog-centered" role="document">
              <div class="modal-content">
              <div class="modal-header">
                  <h5 class="modal-title">Hapus To Do</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close" @click="modalDelTodo=false">
                  <span aria-hidden="true">&times;</span>
                  </button>
              </div>
              <div class="modal-body">
                  <p>Yakin ingin menghapus <strong>"{{currentUser.isi}}"</strong></p>
              </div>
              <div class="modal-footer">
                  <button type="button" class="btn btn-success" @click="modalDelTodo=false; deleteTodo()">Yakin</button>
                  <button type="button" class="btn btn-danger" data-dismiss="modal" @click="modalDelTodo=false;">Tidak</button>
              </div>
              </div>
          </div>
          </div>

          <!----------------------------------Modal Edit Todo-------------------------->
          <div class="modal" tabindex="-1" role="dialog" id="overlay" v-if="modalEdiTodo">
          <div class="modal-dialog modal-dialog-centered" role="document">
              <div class="modal-content">
              <div class="modal-header">
                  <h5 class="modal-title">Edit To Do</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close" @click="modalEdiTodo=false">
                  <span aria-hidden="true">&times;</span>
                  </button>
              </div>
              <div class="modal-body">
                  <input type="text" name="isi" v-model="currentUser.isi" class="form-control">
              </div>
              <div class="modal-footer">
                  <button type="button" class="btn btn-success" @click="modalEdiTodo=false; editTodo()">Simpan</button>
                  <button type="button" class="btn btn-danger" data-dismiss="modal" @click="modalEdiTodo=false;">Batal</button>
              </div>
              </div>
          </div>
          </div>
          
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
    <div class="p-3">
      <h5>Title</h5>
      <p>Sidebar content</p>
    </div>
  </aside>
  <!-- /.control-sidebar -->

  <!-- Main Footer -->
  <footer class="main-footer">
    <!-- To the right -->
    <div class="float-right d-none d-sm-inline">
      HIMAMANKEU
    </div>
    <!-- Default to the left -->
    <strong>Copyright &copy; 2019 <a href="#">MANAJAMEN KEUANGAN</a>.</strong> All rights reserved.
  </footer>
</div>
<!-- ./wrapper -->
</div>
<!-----------------------------End App--------------------------->
</div><!----ini Adalah Wrap Loader----->
<!-- REQUIRED SCRIPTS -->

<!-- jQuery -->
<script src="plugins/jquery/jquery.js"></script>
<!-- Bootstrap 4 -->
<script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="dist/js/adminlte.min.js"></script>
<script src="plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
<script src="data/vue.js"></script>
<script src="data/axios.min.js"></script>
<script src="data/vue-strap.min.js"></script>
<script src="plugins/chart.js/Chart.min.js"></script>
<script>
  var app = new Vue({
    el: "#app",
    data: {
      datas: [{"nama":"Customer Man","url":"dist/img/customer.png"}, {"nama":"Female Avatar","url":"dist/img/girl.png"}, {"nama":"Male Avatar","url":"dist/img/man.png"}],
      selected: "dist/img/customer.png",
      modalEdiTodo: false,
      modalDelTodo: false,
      pesanGagal: "",
      notif: [],
      user: [],
      currentUser: {},
    },
    components: {
      modal: VueStrap.modal
    },
    mounted: function(){
      this.getData();
      this.getNotif();
    },
    methods: {
      getNotif(){
        axios.get("<?php echo $url ?>/api?action=read-notif").then(function(response){
          app.notif = response.data.notif;
        })
      },
      getData(){ //Mengambil data untuk profile user
        axios.get("<?php echo $url ?>/api?action=user").then(function(response){
          app.user = response.data.users;
        })
      },
      toFormData(obj){ // fungsinya adala melakukan subset untuk di input
        var fd = new FormData;
        for(var i in obj){
          fd.append(i, obj[i]);
        }
        return fd;
      },
      selectedUser(s){ //Agar dapat melakukan select User
        app.currentUser = s;
      }
    }
  })
</script>
</body>
</html>
