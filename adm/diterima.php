<?php
    include("template.php");
    include("config.php");
    $dataId = $_SESSION['userid'];
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
            <h1 class="m-0 text-dark">SKPP Diterima</h1>
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
            <h5><i class="icon fas fa-info"></i> Data SKPP Diterima!</h5>
            Menu ini adalah menu SKPP dari satker dan disini kamu dapat membalasnya
        </div>
        </div>

        </div>

        <div class="row">

            <div class="col-md-12">

                <div class="card card-purple card-outline">
                <div class="card-header">
                    <h3 class="card-title"></h3>
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
        $(".fetch-table").load("../fetch/table-diterima.php");

        $("#addUser").click(function(){
            var data = $("#submitUser").serialize();
            $.ajax({
                type: "post",
                url: "../fetch/cruduser.php",
                data: data,
                success: function () {
                    $(".fetch-table").load("../fetch/table-diterima.php");
                    Toast.fire({
                        type: 'success',
                        title: "User berhasil ditambah"
                    });
                    $("#submitUser")[0].reset();
                }
            });
        })
    });

    $("#sentuhBell").click(function (e) { 
        e.preventDefault();

        var dataClick = {"clickPesan": true};

        $.ajax({
            type: "post",
            url: "data-process-admin.php",
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
