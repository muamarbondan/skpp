<?php
    include("../adm/template.php");
?>
<table id="tableUser" class="table w-100 d-md-table table-bordered table-striped table-responsive text-center">
<thead class="thead-dark">
    <tr>
        <th>No</th>
        <th>Nama</th>
        <th>Email</th>
        <th>Password</th>
        <th>Action</th>
    </tr>
</thead>
<tbody>
    <?php
        $query = "SELECT * FROM user WHERE tingkat='1'";
        $stmt = $db->prepare($query);
        $stmt->execute();
        $no = 0;
        while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
        $no++;
    ?>
    <tr>
        <td><?php echo $no ?></td>
        <td><?php echo $row['nama'] ?></td>
        <td><?php echo $row['email'] ?></td>
        <td><?php echo $row['pass'] ?></td>
        <td>
            <form action="crud-admin.php?id_user=<?php echo $row['id'] ?>" method="post">
                <a class="btn btn-sm btn-warning text-white" href="detail-akun.php?id=<?php echo $row['id'] ?>"><i class="fas fa-pencil-alt"></i></a>
                <button name="hapus" type="submit" class="btn btn-sm btn-danger text-white"><i class="fas fa-trash-alt"></i></button>
            </form>
        </td>
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