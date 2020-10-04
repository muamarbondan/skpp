<?php
    include("../adm/template.php");
?>
<script>
    function setUrl(url) {
        $('#framePdf').attr('src', url);
    }
</script>
<table id="tableUser" class="table w-100 d-md-table table-bordered table-striped table-responsive text-center">
<thead class="thead-dark">
    <tr>
        <th>No</th>
        <th>User ID</th>
        <th>Dokumen</th>
        <th>Tanggal Unggah</th>
        <th>Action</th>
    </tr>
</thead>
<tbody>
    <?php
        $query = "SELECT * FROM unduh ORDER BY id DESC";
        $stmt = $db->prepare($query);
        $stmt->execute();
        $no = 0;
        while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
        $no++;
    ?>
    <tr>
        <td><?php echo $no ?></td>
        <td><?php echo $row['userid'] ?></td>
        <td><?php echo $row['nama'] ?></td>
        <td><?php echo $row['tanggal'] ?></td>
        <td>
            <form action="data-process-admin.php" method="post">
                <?php
                    $urlLengkap = '../file/'.$row['file'];
                ?>
                <input type="text" value="<?php echo $row['file'] ?>" name="fileName" hidden>
                <input type="text" value="<?php echo $row['id'] ?>" name="id" hidden>
                <a data-toggle="modal" id="btnTinjau" onclick="setUrl('<?php echo $urlLengkap ?>')" data-target="#modalTinjau" title="Lihat SKPP" class="btn btn-sm btn-primary text-white"><i class="fas fa-eye"></i></a>
                <a data-toggle="tooltip" target="_blank" data-placement="bottom" title="Download" class="btn btn-sm btn-success text-white" href="../file/<?php echo $row['file'] ?>"><i class="fas fa-cloud-download-alt"></i></a>
                <button name="hapusditerima" class="btn btn-sm btn-danger text-white"><i class="fas fa-trash-alt"></i></button>
                <!-- <button  data-toggle="modal" data-target="#modalAdd" class="btn btn-primary btn-sm"><i class="fas fa-plus"></i></button> -->
            </form>
        </td>

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
            <form action="data-process.php" enctype="multipart/form-data" method="POST">
                <div class="modal-body">
                    
                    <div class="form-group">
                        <label>Nama Dokumen</label>
                        <input type="text" name="nama" placeholder="Nama Dokumen" class="form-control">
                        <input type="text" name="id" value="<?php echo $dataId ?>" placeholder="Nama Dokumen" class="form-control" hidden>
                    </div>

                    <div class="form-group">
                        <label>Tanggal</label>
                        <input type="date" name="tanggal" placeholder="Nama Dokumen" class="form-control">
                    </div>

                    <div class="form-group">
                        <label>File PDF</label>
                        <input type="file" name="file" placeholder="Nama Dokumen" class="form-control">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Tutup</button>
                    <button type="submit" name="simpanunggah" class="btn btn-success">Simpan</button>
                </div>
                </div>
            </form>
        </div>
        </div>
        <!-- end of modal -->
    </tr>
    <?php
        }
    ?>
</tbody>
</table>
<!-- Modal -->
<div class="modal fade" id="modalTinjau" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
<div class="modal-dialog modal-dialog-centered modal-lg" role="document">
    <div class="modal-content">
    <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Pratinjau</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
        </button>
    </div>
        <div class="modal-body">
            <iframe id="framePdf" src="#" width="100%" height="500"></iframe>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-danger" data-dismiss="modal">Tutup</button>
        </div>
        </div>
</div>
</div>
<!-- end of modal -->
<script>
    $(document).ready(function () {
        $("#tableUser").DataTable();
    });

    $(selector).click(function (e) { 
        e.preventDefault();
        
    });
</script>