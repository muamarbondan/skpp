<?php
    include("db.php");
    include("../config.php");
    $dataId = $_COOKIE['id'];
    $query = "SELECT * FROM tryout WHERE prodi='$_POST[rangking]'";
    $stmt = $db->prepare($query);
    $stmt->execute();
    $count = $stmt->rowCount();
    if($count > 0){
        while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
            echo "
            <div id='cardTryout' class='col-lg-4'>
            <div class='card card-purple text-center'>
            <div class='card-header' id='judulTryout' style='line-height: 4px;'>
                <div class='a'><i class='fas fa-tv fa-2x'></i></div>
                <div class='a ml-2'><h6>Rangking Nasional $row[nama]</h6></div>
            </div>

            <div class='card-body'>
                <a href='hasil-rangking?$row[id]' class='btn btn-md pink mr-1 text-white'>Rangking</a>
            </div>

            </div>
            </div>
            ";
        }
    }
?>