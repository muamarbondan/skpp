<?php
    include("db.php");

    $query = "SELECT * FROM video WHERE prodi='$_POST[video]'";
    $stmt = $db->prepare($query);
    $stmt->execute();
    $count = $stmt->rowCount();
    if($count > 0){
        while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
            echo "<div class='col-lg-4 mt-3'>";
            echo    "<div class='embed-responsive embed-responsive-16by9' style='border-radius:10px;'>";
            echo    "<iframe class='embed-responsive-item' src='$row[url]' allowfullscreen></iframe>";
            echo    "</div>";
            echo    "<div class='text-center text-bold mt-2'><b><h5>$row[nama]</h5></b></div>";
            echo "</div>";
        }
    }
?>