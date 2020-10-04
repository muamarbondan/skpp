<?php
    include("template.php");
    include("config.php");
    $dataId = $_SESSION['userid'];
    $id = $_GET['id'];
    echo $header;
    echo $nav;

    $query = "SELECT * FROM user WHERE id = '$id'";
    $stmt = $db->prepare($query);
    $stmt->execute();

    $row = $stmt->fetch(PDO::FETCH_ASSOC);
?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
        <div class="col-sm-6">
            <h1 class="m-0 text-dark">Balasan Unggah SKPP</h1>
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
        <div class="alert alert-success alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            <h5><i class="icon fas fa-info"></i> Balas Unggah SKPP Satker!</h5>
            Balas SKPP milik Satker yang sesuai ketentuan
        </div>
        </div>

        </div>

        <div class="row">

            <div class="col-md-12">

                <div class="card card-purple card-outline">
                <div class="card-header">
                    <h3 class="card-title">Edit Data User "<?php echo $_GET['nama'] ?>"</h3> <div class="text-right">
                </div>
                </div>
                <!-- /.card-header -->
                <div class="card-body">

                <form id="formedit" action="data-process-admin.php" method="POST">
                    <div class="form-group">
                        <label>Nama</label>
                        <input type="text" name="nama" value="<?php echo $row['nama']?>" placeholder="Nama Satker" class="form-control">
                        <input type="text" name="iduseredit" value="<?php echo $id ?>" placeholder="Nama Dokumen" class="form-control" hidden>
                        <input type="text" name="iddata" value="<?php echo $_GET['id'] ?>" placeholder="Nama Dokumen" class="form-control" hidden>
                    </div>

                    <div class="form-group">
                        <label>User ID</label>
                        <input type="text" name="userid" value="<?php echo $row['userid']?>" placeholder="User ID" class="form-control">
                    </div>

                    <div class="form-group">
                        <label>Password</label>
                        <input type="text" name="pass" value="<?php echo $row['pass']?>" placeholder="User ID" class="form-control">
                    </div>

                    <div class="form-group">
                        <label>Alamat</label>
                        <input type="text" name="alamat" value="<?php echo $row['alamat']?>" placeholder="User ID" class="form-control">
                    </div>
                    
                    <div class="text-center">
                        <button type="submit" id="simpanuser" name="simpanuser" class="btn btn-warning">Simpan <i class="fas fa-pencil-alt"></i></button>
                    </div>
                </form>

                </div>
                </div>
                <!-- /.card-body -->
                </div>
                <!-- /.card -->
            </div>

        </div>
        </div>
        <!-- /.row -->
    </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->
<?php
    echo $footer;
?>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfobject/2.1.1/pdfobject.js"></script>
<script>
    $("#simpanuser").click(function (e) { 
        e.preventDefault();

        var formEdit = $("#formedit");
        
        $.ajax({
            type: "POST",
            url: "data-process-admin.php",
            data: formEdit.serialize(),
            success: function () {
                Swal.fire({
                    type: 'success',
                    title: 'Berhasil',
                    text: 'Data Berhasil Disimpan',
                })
            }
        });
    });
</script>
</body>
</html>
