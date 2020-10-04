<?php
    include("db.php");
    include("config.php");
    $dataId = $_COOKIE['id'];
    echo $header;
    echo $nav;
?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
        <div class="col-sm-6">
            <h1 class="m-0 text-dark">Unggah SKPP</h1>
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
            <h5><i class="icon fas fa-info"></i> Data Unggah SKPP Anda!</h5>
            Menu Unggah adalah menu yang berisi data SKPP Anda
        </div>
        </div>

        </div>

        <div class="row">

            <div class="col-md-12">

                <div class="card card-purple card-outline">
                <div class="card-header">
                    <h3 class="card-title"></h3> <div class="text-right"><button  data-toggle="modal" data-target="#modalAdd" class="btn btn-primary btn-sm"><i class="fas fa-plus"></i></button></div>

                    <!-- Modal -->
                    <div class="modal fade" id="modalAdd" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                        <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLongTitle">Tambah Unggahan</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <form id="formUpload" enctype="multipart/form-data" method="POST">
                            <div class="modal-body">

                                <div class="form-group">
                                    <label>Status Dokumen</label>
                                    <select class="form-control" name="status" id="status">
                                        <option value="Baru">Baru</option>
                                        <option value="Perbaikan">Perbaikan</option>
                                    </select>
                                </div>
                                
                                <div class="form-group">
                                    <label>Nama Dokumen</label>
                                    <input type="text" name="nama" placeholder="Nama Dokumen" class="form-control">
                                    <input type="text" name="id" value="<?php echo $dataId ?>" placeholder="Nama Dokumen" class="form-control" hidden>
                                    <input type="text" name="userid" value="<?php echo $rowAkun['userid'] ?>" placeholder="Nama Dokumen" class="form-control" hidden>
                                </div>

                                <div class="form-group">
                                    <label>Tanggal</label>
                                    <input type="date" name="tanggal" placeholder="Nama Dokumen" class="form-control">
                                    <input type="date" name="unggahDokumen" placeholder="Nama Dokumen" class="form-control" hidden>
                                </div>
                    
                                <div class="form-group">
                                    <label>File PDF</label>
                                    <input accept="application/pdf" type="file" name="file" id="fileData" placeholder="Nama Dokumen" class="form-control">
                                    <div class="progress mx-3 mt-2">
                                        <div class="progress-bar progress-bar-striped bg-success progress-bar-animated" role="progressbar" style="width: 0%" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                    <div id="targetLayer"></div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" id="modalCloseUnggah" class="btn btn-danger" data-dismiss="modal">Tutup</button>
                                <button type="submit" id="modalSimpanUnggah" name="simpanunggah" class="btn btn-success">Simpan</button>
                            </div>
                            </div>
                        </form>
                    </div>
                    </div>
                    <!-- end of modal -->
                </div>
                <!-- /.card-header -->
                <div class="card-body fetch-table">
                
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
    $(document).ready(function () {
        $(".fetch-table").load("fetch/table-unggah.php");

        $('#formUpload').submit(function(e) {
            e.preventDefault()
            if($('#fileData').val()) {
                $(this).ajaxSubmit({
                    url: "data-process.php",
                    target: "#targetLayer",
                    beforeSubmit: function() {
                        $('.progress-bar').width('0%');
                        $('#modalSimpanUnggah').attr('disabled', true);
                        $('#modalSimpanUnggah').html('<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Loading...');
                        Toast.fire({
                            icon: 'info',
                            title: 'Proses Upload'
                        })
                    },
                    uploadProgress: function(event, position, total, percentComplete) {
                        $('.progress-bar').css("width", percentComplete + '%');
                        $('.progress-bar').html("<div id='progress-status'>" + percentComplete + '%' + "</div>");
                    },
                    success: function() {
                        $('#modalAdd').modal('hide');
                        $(".fetch-table").load("fetch/table-unggah.php");
                        $('.progress-bar').css("width", '0%');
                        $('#modalSimpanUnggah').removeAttr('disabled');
                        $('#modalSimpanUnggah').html('Balas <i class="fas fa-pencil-alt"></i>');
                        
                        Toast.fire({
                            icon: 'success',
                            title: 'Upload Berhasil'
                        })
                    }, 
                    resetForm: true
                })
                return false
            }
        })

        $("#addUser").click(function(){
            var data = $("#submitUser").serialize();
            $.ajax({
                type: "post",
                url: "../fetch/cruduser.php",
                data: data,
                success: function () {
                    $(".fetch-table").load("fetch/table-unggah.php");
                    Toast.fire({
                        type: 'success',
                        title: "User berhasil ditambah"
                    });
                    $("#submitUser")[0].reset();
                }
            });
        })
    });

    $('#modalCloseUnggah').click(function() {
        $(".fetch-table").load("fetch/table-unggah.php");
    })

    $("#sentuhBell").click(function (e) { 
        e.preventDefault();

        var dataClick = {"clickPesan": true, "id_user": <?php echo $dataCook ?>};

        $.ajax({
            type: "post",
            url: "data-process.php",
            data: dataClick,
            success: function () {
                console.log("Berhasil");
            }
        });
        
        $("#badgeJumlah").hide();
    });
</script>
</body>
</html>
