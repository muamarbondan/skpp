<?php
    include("db.php");
    include("../config.php");
    $dataId = $COOKIE['id'];
    $query = "SELECT * FROM tryout WHERE prodi='$_POST[tryout]'";
    $stmt = $db->prepare($query);
    $stmt->execute();
    $count = $stmt->rowCount();
    if($count > 0){
        while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
            echo "
            <div id='cardTryout' class='col-lg-4'>
            <div class='card card-purple text-center'>
            <div class='card-header' id='judulTryout' style='line-height: 2px;'>
                <div class='a'><i class='fas fa-tv fa-2x'></i></div>
                <div class='a ml-2'><h6>Tryout $row[nama]</h6><p>Bonus Pembahasan</p></div>
            </div>

            <div class='card-body'>
                <a href='rangking?id=$row[id]&jenis=$row[prodi]&nama=$row[nama]' class='btn btn-md pink mr-1 text-white'>Statistik</a>
            </div>

            </div>
            </div>
            ";
        }
    }
?>