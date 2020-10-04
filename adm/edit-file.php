<?php
    include("template.php");
    include("config.php");
    $dataId = $_SESSION['userid'];
    $idSatker = $_GET['id_user'];
    $idUnggah = $_GET['id'];
    echo $header;
    echo $nav;

    $id = $_GET['id'];

    $query = "SELECT * FROM unggah WHERE id_user = '$idSatker' AND id = '$idUnggah'";
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
                    <h3 class="card-title">Kirimkan balasan SKPP "<?php echo $_GET['nama'] ?>"</h3> <div class="text-right">
                </div>
                </div>
                <!-- /.card-header -->
                <div class="card-body">

                <div class="form-group">
                    <label for="">Status SKPP</label>
                    <select name="pilihan" id="pilihan" class="form-control">
                        <option value="-">--- Pilih Status ---</option>
                        <option value="diterima">Diterima</option>
                        <option value="ditolak">Ditolak</option>
                    </select>
                </div><br><br>

                <form style="display: none;" class="hasil" id="diterima" enctype="multipart/form-data" method="POST">
                    <div class="form-group">
                        <label>Nama Dokumen</label>
                        <input type="text" name="nama" placeholder="Nama Dokumen" class="form-control">
                        <input type="text" name="iduser" value="<?php echo $idSatker ?>" placeholder="Nama Dokumen" class="form-control" hidden>
                        <input type="text" name="iddata" value="<?php echo $_GET['id'] ?>" placeholder="Nama Dokumen" class="form-control" hidden>
                        <input type="text" name="userid" value="<?php echo $row['userid'] ?>" placeholder="Nama Dokumen" class="form-control" hidden>
                    </div>

                    <div class="form-group">
                        <label>Tanggal</label>
                        <input type="date" name="tanggal" placeholder="Nama Dokumen" class="form-control">
                    </div>

                    <div class="form-group">
                        <label>File PDF</label>
                        <input accept="application/pdf" type="file" name="file" id="penerimaan" placeholder="Nama Dokumen" class="form-control"><p class="text-success col-4">
                        <div class="progress mx-3 mt-2">
                            <div class="progress-bar progress-bar-striped bg-success progress-bar-animated" role="progressbar" style="width: 0%" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                        <div id="targetLayerTerima"></div>
                    </div>
                    
                    <div class="text-center">
                        <input type="text" name="balasanunggah" id="balasanunggah" hidden>
                        <button type="submit" id="balasanUnggahTerima" class="btn btn-success">Balas <i class="fas fa-pencil-alt"></i></button>
                    </div>
                </form>

                <form style="display: none;" class="hasil" id="ditolak" enctype="multipart/form-data" method="POST">
                    <div class="form-group" hidden>
                        <label>Nama Dokumen</label>
                        <input type="text" name="nama" placeholder="Nama Dokumen" class="form-control">
                        <input type="text" name="iduser" value="<?php echo $idSatker ?>" placeholder="Nama Dokumen" class="form-control">
                        <input type="text" name="iddata" value="<?php echo $_GET['id'] ?>" placeholder="Nama Dokumen" class="form-control">
                    </div>

                    <div class="form-group">
                        <label>Foto Penolakan</label>
                        <input accept="image/jpg, image/jpeg, image/png" type="file" class="form-control" name="file" id="penolakan">
                        <div class="progress mx-3 mt-2">
                            <div class="progress-bar progress-bar-striped bg-success progress-bar-animated" role="progressbar" style="width: 0%" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                        <div id="targetLayer"></div>
                    </div>

                    <div class="form-group">
                        <label>Pesan Penolakan</label>
                        <textarea name="pesan" id="pesan" class="form-control" cols="30" rows="10"></textarea>
                    </div>

                    <div class="text-center">
                        <input type="text" name="balasanunggahtolak" id="balasanunggahtolak" hidden>
                        <button type="submit" id="balasanUnggahTolak"  class="btn btn-success">Balas <i class="fas fa-pencil-alt"></i></button>
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
    $("#pilihan").change(function (e) { 
        e.preventDefault();

        $(".hasil").hide();
        $("#" + $(this).val()).show();
    });

    $('#diterima').submit(function(e) {
        e.preventDefault()
        if($('#penerimaan').val()) {
            $(this).ajaxSubmit({
                url: "data-process-admin.php",
                target: "#targetLayerTerima",
                beforeSubmit: function() {
                    $('.progress-bar').width('0%');
                    $('#balasanUnggahTerima').attr('disabled', true);
                    $('#balasanUnggahTerima').html('<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Loading...');
                    Toast.fire({
                        icon: 'info',
                        title: 'Proses Upload'
                    });
                },
                uploadProgress: function(event, position, total, percentComplete) {
                    $('.progress-bar').css("width", percentComplete + '%');
                    $('.progress-bar').html("<div id='progress-status'>" + percentComplete + '%' + "</div>");
                },
                success: function() {
                    $(".fetch-table").load("fetch/table-unggah.php");
                    $('.progress-bar').css("width", '0%');
                    $('#balasanUnggahTerima').removeAttr('disabled');
                    $('#balasanUnggahTerima').html('Balas <i class="fas fa-pencil-alt"></i>');
                    
                    Toast.fire({
                        icon: 'success',
                        title: 'Upload Berhasil'
                    })
                }, 
            })
            return false
        }
    })

    $('#ditolak').submit(function(e) {
        e.preventDefault()
        if($('#penolakan').val()) {
            $(this).ajaxSubmit({
                url: "data-process-admin.php",
                target: "#targetLayer",
                beforeSubmit: function() {
                    $('.progress-bar').width('0%');
                    Toast.fire({
                        icon: 'info',
                        title: 'Proses Upload'
                    });
                },
                uploadProgress: function(event, position, total, percentComplete) {
                    $('.progress-bar').css("width", percentComplete + '%');
                    $('.progress-bar').html("<div id='progress-status'>" + percentComplete + '%' + "</div>");
                },
                success: function() {
                    $(".fetch-table").load("fetch/table-unggah.php");
                    $('.progress-bar').css("width", '0%');
                    
                    Toast.fire({
                        icon: 'success',
                        title: 'Upload Berhasil'
                    })
                }, 
            })
            return false
        }
    })
</script>
</body>
</html>
