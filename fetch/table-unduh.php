<?php
    include("../db.php");
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
        <th>Dokumen</th>
        <th>Tanggal Upload</th>
        <th>Action</th>
    </tr>
</thead>
<tbody>
    <?php
        $query = "SELECT * FROM unduh WHERE id_user='$dataCook' ORDER BY id DESC";
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
        <td>
            <?php
                $urlLengkap = $url.'/file/'.$row['file'];
            ?>
            <a data-toggle="modal" id="btnTinjau" onclick="setUrl('<?php echo $urlLengkap ?>')" data-target="#modalTinjau" title="Lihat SKPP" class="btn btn-sm btn-success text-white"><i class="fas fa-eye"></i></a>
            <a data-toggle="tooltip" target="_blank" data-placement="bottom" title="Download SKPP" class="btn btn-sm btn-danger text-white" href="file/<?php echo $row['file'] ?>"><i class="fas fa-cloud-download-alt"></i></a>
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
</script>