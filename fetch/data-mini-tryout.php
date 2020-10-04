<?php
    include("db.php");
    // include("../config.php");
    $dataId = $_COOKIE['id'];
    $query = "SELECT * FROM mini_tryout WHERE prodi='$_POST[tryout]' ORDER BY jenis ASC";
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
                <div class='a ml-2'><h6>Mini Tryout $row[nama]</h6></div>
            </div>

            <div class='card-body'>
                <a target='_blank' href='mini-percobaan?soal=$row[id]&jenis=$row[jenis]&nama=$row[nama]&kategori=$row[prodi]&id_user=$dataId' class='btn btn-md blue ml-1 text-white'>Coba Soal</a>
            </div>

            </div>
            </div>
            ";
        }
    }
?>