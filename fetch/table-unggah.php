<?php
    include("../db.php");
?>
<table id="tableUser" class="table w-100 d-md-table table-bordered table-striped table-responsive text-center">
<thead class="thead-dark">
    <tr>
        <th>No</th>
        <th>Dokumen</th>
        <th>Tanggal Unggah</th>
        <th>Status</th>
        <th>Action</th>
    </tr>
</thead>
<tbody>
    <?php
        $query = "SELECT * FROM unggah WHERE id_user='$dataCook' ORDER BY id DESC";
        $stmt = $db->prepare($query);
        $stmt->execute();
        $no = 0;
        while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
        $no++;
    ?>
    <tr>
        <td><?php echo $no ?></td>
        <td><?php echo $row['nama'] ?></td>
        <td><?php echo $row['tanggal'] ?></td>
        <td><?php if($row['status'] == 0){?> <button class="btn btn-warning btn-xs" disabled>Belum Dibalas</button> <?php }else if($row['status'] == 3){ ?> <button class="btn btn-danger btn-xs" disabled>Ditolak</button> <?php }else{ ?> <button disabled class="btn btn-success btn-xs">Sudah Dibalas</button><?php } ?></td>
        <td>
            <form action="data-process.php" method="post">
                <input type="text" value="<?php echo $row['id'] ?>" name="id" hidden>
                <input type="text" value="<?php echo $row['file'] ?>" name="fileName" hidden>
                <a data-toggle="tooltip" data-placement="bottom" title="Edit & Tinjau SKPP" class="btn btn-sm btn-warning text-white" href="edit-file.php?id=<?php echo $row['id'] ?>"><i class="fas fa-pencil-alt"></i></a>
                <a data-toggle="tooltip" target="_blank" data-placement="bottom" title="Download SKPP" class="btn btn-sm btn-success text-white" href="file/<?php echo $row['file'] ?>"><i class="fas fa-cloud-download-alt"></i></a>
                <button data-toggle="tooltip" data-placement="bottom" title="Hapus SKPP" name="hapus" class="btn btn-sm btn-danger text-white"><i class="fas fa-trash-alt"></i></button>
        <?php if($row['pesan']){ ?><a data-toggle="modal" data-target="#modalAdd<?php echo $row['id'] ?>" class="btn btn-primary btn-sm"><i class="fas fa-info-circle text-white"></i></a><?php } ?>
            </form>
        </td>
        
        <!-- Modal -->
        <div class="modal fade" id="modalAdd<?php echo $row['id'] ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Detail Penolakan</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
                <div class="modal-body">
                    <h5>Pesan Anda :</h5>
                    <p><?php echo $row['pesan'] ?></p>
                    <?php if(isset($row['gambar_tlk'])){ ?>
                    <h5>Bagian yang ditolak :</h5>
                    <p><img class="img-fluid" src="file/<?php echo $row['gambar_tlk'] ?>" alt="gambar penolakan"></p>
                    <?php } ?>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Tutup</button>
                </div>
                </div>
        </div>
        </div>
        <!-- end of modal -->
    </tr>
    <?php
        }
    ?>
</tbody>
</table>
<script>
    $(document).ready(function () {
        $("#tableUser").DataTable();
    });
</script>