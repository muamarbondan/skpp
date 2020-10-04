<?php
    include("db.php");
    include("config.php");
    $dataId = $_COOKIE['id'];
    echo $header;
    echo $nav;

    $id = $_GET['id'];

    $query = "SELECT * FROM unggah WHERE id = '$id'";
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
            <h1 class="m-0 text-dark">Edit Unggah SKPP</h1>
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
            <h5><i class="icon fas fa-info"></i> Edit Data Unggah SKPP Anda!</h5>
            Menu Unggah adalah menu yang berisi data SKPP Anda
        </div>
        </div>

        </div>

        <div class="row">

            <div class="col-md-12">

                <div class="card card-purple card-outline">
                <div class="card-header">
                    <h3 class="card-title">Edit Data "<?php echo $row['nama'] ?>"</h3> <div class="text-right">
                </div>
                </div>
                <!-- /.card-header -->
                <div class="card-body">

                <form id="formEdit" enctype="multipart/form-data" method="POST">
                    <div class="form-group">
                        <label>Nama Dokumen</label>
                        <input type="text" value="<?php echo $row['nama'] ?>" name="nama" placeholder="Nama Dokumen" class="form-control">
                        <input type="text" name="id" value="<?php echo $dataId ?>" placeholder="Nama Dokumen" class="form-control" hidden>
                        <input type="text" name="iddata" value="<?php echo $_GET['id'] ?>" placeholder="Nama Dokumen" class="form-control" hidden>
                    </div>

                    <div class="form-group">
                        <label>Tanggal</label>
                        <input type="date" value="<?php echo $row['tanggal'] ?>" name="tanggal" placeholder="Nama Dokumen" class="form-control">
                    </div>

                    <div class="form-group">
                        <label>File PDF</label>
                        <input disabled type="file" name="file" placeholder="Nama Dokumen" class="form-control"><p class="text-success col-4"><?php if($row['file']){ echo "(File Sudah diupload)" ;} ?></p>
                    </div>

                    <iframe src="<?php echo $url.'/file/'.$row['file'] ?>" width="100%" height="500"></iframe>
                    
                    <div class="text-center mt-3">
                        <button type="submit" id="editUnggah" name="editunggah" class="btn btn-success">Simpan</button>
                    </div>
                </form>

                </div>
                <!-- /.card-body -->
                </div>
                <!-- /.card -->
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
    $("#editUnggah").click(function (e) { 
        e.preventDefault();

        var formEdit = $("#formEdit");

        $.ajax({
            type: "post",
            url: "data-process.php",
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
