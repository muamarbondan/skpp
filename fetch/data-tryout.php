<?php
    include("db.php");
    include("../config.php");
    $dataId = $_COOKIE['id'];
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
                <div class='a ml-2'><h6>Try Out $row[nama]</h6><p>Bonus Pembahasan</p></div>
            </div>

            <div class='card-body'>
                <a href='rangking?id=$row[id]&jenis=$row[prodi]&nama=$row[nama]' class='btn btn-md pink mr-1 text-white'>Rangking</a> | <a href='#' onClick='          Toast.fire({
                    type: 'success',
                    title: response.data.pesan
                    });' class='btn btn-md blue ml-1 text-white'>Tryout</a>
            </div>

            </div>
            </div>
            ";
        }
    }
?>
<!-- peraturan?soal=$row[id]&id_user=$dataId&jenis=$row[jenis]&nama=$row[nama]&kategori=$row[prodi] -->