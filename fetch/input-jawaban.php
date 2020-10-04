<?php
    include("db.php");
    if(isset($_POST['jawaban'])){
        $idsoal = $_POST['idsoal'];
        $indexsoal = $_POST['index'];
        $jawaban = $_POST['jawaban'];
        $iduser = $_POST['iduser'];
        $idto = $_POST['idto'];
        $waktuJalan = $_POST['waktusisa'];
        $jenis = $_POST['jenis'];

        $query = "UPDATE jawaban_soal SET jawaban = '$jawaban', status = '1' WHERE id_soal = '$idsoal' AND id_user = '$iduser'";
        $stmt = $db->prepare($query);
        $stmt->execute();

        if($jenis === 'tpa'){
        $queryWaktu = "UPDATE status_tryout SET waktu = '$waktuJalan' WHERE id_to = '$idto' AND id_user = '$iduser'";
        $stmtWaktu = $db->prepare($queryWaktu);
        $stmtWaktu->execute();
        }

        if($jenis === 'tbi'){
            $queryWaktu = "UPDATE status_tryout SET waktu2 = '$waktuJalan' WHERE id_to = '$idto' AND id_user = '$iduser'";
            $stmtWaktu = $db->prepare($queryWaktu);
            $stmtWaktu->execute();
        }

        if($jenis === 'tiu'){
            $queryWaktu = "UPDATE status_tryout SET waktu = '$waktuJalan' WHERE id_to = '$idto' AND id_user = '$iduser'";
            $stmtWaktu = $db->prepare($queryWaktu);
            $stmtWaktu->execute();
        }
        
    }

    if(isset($_POST['indexragu'])){
        $idsoal = $_POST['idsoal'];
        $iduser = $_POST['iduser'];

        $queryRagu = "UPDATE jawaban_soal SET status = '2' WHERE id_soal = '$idsoal' AND id_user = '$iduser'";
        $stmtRagu = $db->prepare($queryRagu);
        $stmtRagu->execute();
    }
?>