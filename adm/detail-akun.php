<?php
include("template.php");
include("config.php");
$dataEmail = $_SESSION['email'];
echo $header;
echo $nav;
$id_detail = $_GET['id'];
?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
    <div class="row mb-2">
        <div class="col-sm-6">
        <h1 class="m-0 text-dark">Management User</h1>
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
        <div class="alert green alert-dismissible">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
        <h5><i class="icon fas fa-info"></i> Menu Detail User</h5>
        Adalah menu yang berisi data lengkap User
        </div>
    </div>

    <div class="col-lg-12">
        <div class="card card-outline card-purple">
            <div class="card-header">
                <h3 class="card-title">Data User</h3>
            </div>
            <div class="card-body">
            <form action="crud-admin.php" method="post">
                <?php 
                    $queryAkun = "SELECT * FROM user WHERE id = '$id_detail'";
                    $stmt = $db->prepare($queryAkun);
                    $stmt->execute();
                    
                    $rowAkun = $stmt->fetch(PDO::FETCH_ASSOC);
                ?>
                <div class="row">

                    <div class="form-group col-6">
                        <label>Nama</label>
                        <input type="text" value="<?php echo $rowAkun['nama'] ?>" class="form-control" name="nama">
                    </div>

                    <div class="form-group col-6">
                        <label>Sekolah</label>
                        <input type="text" value="<?php echo $rowAkun['sekolah'] ?>" class="form-control" name="sekolah">
                    </div>

                    <div class="form-group col-12">
                        <label>Whatsapp</label>
                        <input type="text"  value="<?php echo $rowAkun['wa'] ?>" class="form-control" name="wa">
                    </div>

                    <div class="form-group col-6">
                        <label>Email</label>
                        <input type="text" value="<?php echo $rowAkun['email'] ?>" class="form-control" name="email">
                    </div>

                    <div class="form-group col-6">
                        <label>Password</label>
                        <input type="text"  value="<?php echo $rowAkun['pass'] ?>" class="form-control" name="pass">
                        <input type="text"  value="<?php echo $id_detail ?>" class="form-control" name="id" hidden>
                    </div>

                    <div class="form-group col-12">
                        <label>Status Akun</label>
                        <select class="form-control" name="status" id="status">
                            <option value="<?php echo $rowAkun['premium'] ?>"><?php  if($rowAkun['premium'] == 0){echo "Biasa";}else{echo "Premium";} ?></option>
                            <option value="1">Premium</option>
                            <option value="0">Biasa</option>
                        </select>
                    </div>

                    <div class="m-auto">
                    <button type="submit" name="simpandetail" class="btn btn-success">Simpan</button>
                    </div>

                </div>
                </form>

            </div>
        </div>
    </div>

    </div>

    </div><!-- /.container-fluid -->
</div>
<!-- /.content -->
</div>
<!-- /.content-wrapper -->

<?php
echo $footer;
?>
</body>
</html>
