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
        <th>Status</th>
        <th>Action</th>
    </tr>
</thead>
<tbody>
    <?php
        $query = "SELECT * FROM unggah ORDER BY id DESC";
        $stmt = $db->prepare($query);
        $stmt->execute();
        $no = 0;
        while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
        $no++;
    ?>
    <tr>
        <td><?php echo $no ?></td>
        <td><?php echo $row['userid'] ?></td>
        <td><?php echo $row['nama'] ?> <?php if($row['status_dokumen'] == 'Baru') { ?><span class="badge badge-pill badge-success right"><?php echo $row['status_dokumen'] ?></span> <?php }else{ ?> <span class="badge badge-pill badge-warning right"><?php echo $row['status_dokumen'] ?></span> <?php } ?></td>
        <td><?php echo $row['tanggal'] ?></td>
        <td><?php if($row['status'] == 0){?> <button class="btn btn-warning btn-xs" disabled>Belum Dibalas</button> <?php }else if($row['status'] == 3){ ?> <button class="btn btn-danger btn-xs" disabled>Ditolak</button> <?php }else{ ?> <button disabled class="btn btn-success btn-xs">Sudah Dibalas</button><?php } ?></td>
        <td>
            <form action="data-process-admin.php" method="post">
                <?php
                    $urlLengkap = '../file/'.$row['file'];
                ?>
                <input type="text" value="<?php echo $row['file'] ?>" name="fileName" hidden>
                <input type="text" value="<?php echo $row['id'] ?>" name="id" hidden>
                <a data-toggle="tooltip" data-placement="bottom" title="Edit Data" class="btn btn-xs btn-warning text-white" href="edit-file.php?id=<?php echo $row['id'] ?>&id_user=<?php echo $row['id_user'] ?>&nama=<?php echo $row['nama'] ?>"><i class="fas fa-share-square"></i></a>
                <a data-toggle="modal" id="btnTinjau" onclick="setUrl('<?php echo $urlLengkap ?>')" data-target="#modalTinjau" title="Lihat SKPP" class="btn btn-xs btn-primary text-white"><i class="fas fa-eye"></i></a>
                <a data-toggle="tooltip" target="_blank" data-placement="bottom" title="Download Data" class="btn btn-xs btn-success text-white" href="../file/<?php echo $row['file'] ?>"><i class="fas fa-cloud-download-alt"></i></a>
                <button data-toggle="tooltip" data-placement="bottom" title="Hapus" name="hapusdikirim" class="btn btn-xs btn-danger text-white"><i class="fas fa-trash-alt"></i></button>
            </form>
        </td>
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