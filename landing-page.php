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
            <h1 class="m-0 text-dark">Profile</h1>
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
            <h5><i class="icon fas fa-info"></i> Info Satker!</h5>
            Menu Profile adalah menu yang berisi data satker anda
        </div>
        </div>

        </div>

        <div class="row">

            <div class="col-md-12">

                <div class="card card-purple card-outline">
                <div class="card-header">
                    <h3 class="card-title">Data Satker Anda</h3>

                    <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
                    </button>
                    </div>
                    <!-- /.card-tools -->
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <div class="container">
                    <form action="data-process.php" id="inputProfile" method="post">
                        <div class="row">
                            <?php
                                $queryAkun = "SELECT * FROM user WHERE id = $dataId";
                                $stmt = $db->prepare($queryAkun);
                                $stmt->execute();

                                $rowAkun = $stmt->fetch(PDO::FETCH_ASSOC);
                            ?>
                            <div class="form-group col-6">
                                <label>User ID</label>
                                <input type="text" id="userid" value="<?php echo $rowAkun['userid'] ?>" name="userid" class="form-control" disabled>
                            </div>

                            <div class="form-group col-6">
                                <label>Password</label>
                                <input type="text" id="pass" value="<?php echo $rowAkun['pass'] ?>" name="pass" class="form-control" disabled>
                            </div>

                            <div class="form-group col-6">
                                <label>Nama</label>
                                <input type="text" id="nama" value="<?php echo $rowAkun['nama'] ?>" name="nama" class="form-control" disabled>
                            </div>

                            <div class="form-group col-6">
                                <label>Alamat</label>
                                <input type="text" id="alamat" value="<?php echo $rowAkun['alamat'] ?>" name="alamat" class="form-control" disabled>
                                <input type="text" value="<?php echo $rowAkun['id'] ?>" name="id" class="form-control" hidden>
                            </div>

                            <button id="editUser" type="button" class="btn btn-warning m-auto" name="simpanuser"><i class="fas fa-pencil-alt"></i> Edit</button>
                            <button id="simpanUser" type="submit" class="btn btn-success m-auto" name="simpanuser" disabled><i class="fas fa-save"></i> Simpan</button>
                        </div>
                    </form>
                    </div>
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
<!-- Modal -->
<div class="modal fade" id="modalPesan" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
<div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
    <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Pesan KPPN untuk Satkermu</h5>
        <button id="tutupModal" type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
        </button>
    </div>
        <div class="modal-body">
        <div class="alert alert-primary" role="alert">
            <?php echo ucfirst($pesanModal['pesan']) ?>
        </div>
        </div>
        <div class="modal-footer">
            <button type="button" id="tutupModal1" class="btn btn-success">OK</button>
        </div>
        </div>
</div>
</div>
<!-- end of modal -->
<?php
    echo $footer;
?>
<script>
    $(document).ready(function () {
        if(<?php echo $countReadModal > 0 ?>){
            $('#modalPesan').modal('show');
        }
    });

    $("#simpanUser").click(function (e) { 
        e.preventDefault();

        var form = $('#inputProfile').serialize();

        $.ajax({
            type: "post",
            url: "data-process.php",
            data: form,
            success: function () {
                Swal.fire({
                    type: 'success',
                    title: 'Berhasil',
                    text: 'Profile Berhasil Disimpan',
                })
            }
        });
    });

    $("#simpanUser").click(function (e) { 
        e.preventDefault();
        
        
        $("#nama").attr("disabled", "disabled");
        $("#pass").attr("disabled", "disabled");
        $("#alamat").attr("disabled", "disabled");
        $("#simpanUser").attr("disabled", "disabled");

        $("#editUser").removeAttr("disabled");
    });

    $("#editUser").click(function (e) { 
        e.preventDefault();
        
        $("#nama").removeAttr("disabled");
        $("#pass").removeAttr("disabled");
        $("#alamat").removeAttr("disabled");
        $("#simpanUser").removeAttr("disabled");

        $("#editUser").attr("disabled", "disabled");
    });

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

    $('#tutupModal').click(function(e) {
        e.preventDefault();

        var dataClick = {"terbaca": 1, "kode": <?php echo $kodeSatker ?>};

        $.ajax({
            type: "post",
            url: "data-process.php",
            data: dataClick,
            success: function() {
                $('#modalPesan').modal('hide');
            }
        });
    })

    $('#tutupModal1').click(function(e) {
        e.preventDefault();

        var dataClick = {"terbaca": 1, "kode": <?php echo $kodeSatker ?>};

        $.ajax({
            type: "post",
            url: "data-process.php",
            data: dataClick,
            success: function() {
                $('#modalPesan').modal('hide');
            }
        });
    })

</script>
</body>
</html>
