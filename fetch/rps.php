<?php
    include("db.php");

    $query = "SELECT * FROM rps WHERE prodi='$_POST[rps]'";
    $stmt = $db->prepare($query);
    $stmt->execute();
    $count = $stmt->rowCount();
    if($count > 0){
        while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
            echo "<tr>";
            echo    "<td>$row[prodi]</td>";
            echo    "<td>$row[nama]</td>";
            echo    "<td><a class='btn btn-sm pink text-white' target='_blank' href='$row[url]'>Download</a></td>";
            echo "</tr>";
        }
    }
?>