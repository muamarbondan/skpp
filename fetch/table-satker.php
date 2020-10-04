<?php
    include("../adm/template.php");
?>
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

    $(selector).click(function (e) { 
        e.preventDefault();
        
    });
</script>