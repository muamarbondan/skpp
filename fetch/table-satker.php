<?php
    include("../adm/template.php");
?>
<script>
    $(document).ready(function () {
        $("#tableUser").DataTable();

        $('#kirimPesan').submit(function(e) {
            e.preventDefault();

            if($('#pesanSatker').val()) {
                $(this).ajaxSubmit({
                    beforeSubmit: function() {
                        $('#modalPesan').modal('hide');
                        Toast.fire({
                            icon: 'info',
                            title: 'Sedang Mengirim'
                        })
                    },
                    url: "data-process-admin.php",
                    success: function() {
                        Toast.fire({
                            icon: 'success',
                            title: 'Berhasil Terkirim'
                        })
                    },
                    resetForm: true
                });
                return false
            }
        })
    });
    function kodeSatker(kode) {
        $('#kodeSatker').val(kode);
        $('#modalTitlePesan').html("Kirim Pesan ke " + kode)
    }
</script>
<table id="tableUser" class="table w-100 d-md-table table-bordered table-striped table-responsive text-center">
<thead class="thead-dark">
    <tr>
        <th>No</th>
        <th>User ID</th>
        <th>Nama</th>
        <th>Alamat</th>
        <th>Password</th>
        <th>Action</th>
    </tr>
</thead>
<tbody>
    <?php
        $query = "SELECT * FROM user WHERE tingkat = '1' ORDER BY id DESC";
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
        <td><?php echo $row['alamat'] ?></td>
        <td><?php echo $row['pass'] ?></td>
        <td>
            <form action="data-process-admin.php" method="post">
                <input type="text" value="<?php echo $row['id'] ?>" name="id" hidden>
                <a class="btn btn-sm btn-warning text-white" href="edit-user.php?id=<?php echo $row['id'] ?>&nama=<?php echo $row['nama'] ?>"><i class="fas fa-pencil-alt"></i></a>
                <button name="hapussatker" class="btn btn-sm btn-danger text-white"><i class="fas fa-trash-alt"></i></button>
                <a data-toggle="modal" id="btnTinjau" onclick="kodeSatker('<?php echo $row['userid'] ?>')" data-target="#modalPesan" class="btn btn-sm btn-primary text-white"><i class="fas fa-eye"></i></a>
            </form>
        </td>
    </tr>
    <?php
        }
    ?>
</tbody>
</table>
<!-- Modal -->
<div class="modal fade" id="modalPesan" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
<div class="modal-dialog modal-dialog-centered modal-lg" role="document">
    <div class="modal-content">
    <div class="modal-header">
        <h5 class="modal-title" id="modalTitlePesan">Kirim Pesan</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
        </button>
    </div>
        <form method="post" id="kirimPesan">
            <div class="modal-body">
                <div class="form-group">
                    <input type="text" name="kodesatker" id="kodeSatker" class="form-control disabled">
                    <textarea name="pesansatker" id="pesanSatker" class="form-control mt-2" cols="30" rows="10" placeholder="Masukan Pesan"></textarea>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Tutup</button>
                <button type="submit" class="btn btn-success">Simpan</button>
            </div>
            </div>
        </form>
</div>
</div>
<!-- end of modal -->