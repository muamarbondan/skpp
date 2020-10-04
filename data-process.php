<?php
    include("db.php");
    if(isset($_POST['submitlogin'])){
        $userid = htmlentities($_POST['userid']);
        $pass = htmlentities($_POST['password']);
        
        $query = "SELECT * FROM user WHERE userid='$userid' AND pass='$pass'";
        $stmt = $db->prepare($query);
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        $count = $stmt->rowCount();
        if($count > 0){
            if($row['tingkat'] == 1){
                setcookie('id', $row['id'], time()+86400);
                header("location: landing-page?status1=active");
            }else if($row['tingkat'] == 2){
                session_start();
                $_SESSION['userid'] = $row['userid'];
                header("location: adm/landing-page?status1=active");
            }
        }else{
            header("location: index");
        }
    }

    if(isset($_POST['pass'])){
        $nama = $_POST['nama'];
        $pass = $_POST['pass'];
        $alamat = $_POST['alamat'];
        $id = $_POST['id'];

        $query = "UPDATE user SET nama = '$nama', pass = '$pass', alamat = '$alamat' WHERE id = '$id'";
        $stmt = $db->prepare($query);
        $stmt->execute();
    }

    if(isset($_POST['hapus'])){
        $id = $_POST['id'];
        $file = $_POST['fileName'];

        unlink('./file/'.$file);
        $query = "DELETE FROM unggah WHERE id = '$id'";
        $stmt = $db->prepare($query);
        $stmt->execute();

        header("location: unggah?status3=active");
    }

    if(isset($_POST['unggahDokumen'])){
        $direct = "file/";
        $namaFile = $_FILES['file']['name'];
        $namaTmp = $_FILES['file']['tmp_name'];

        $id = $_POST['id'];
        $nama = $_POST['nama'];
        $namaTemp = "SKPP a.n. ".$nama;
        $tanggal = $_POST['tanggal'];
        $userid = $_POST['userid'];
        $status = $_POST['status'];

        if(isset($namaFile) && !empty($namaFile)){

            $temp = explode(".", $namaFile);
            $filename = round(microtime(true)). '-' . $id . '.' . end($temp);

            move_uploaded_file($namaTmp, $direct.$filename);

        }

        $query = "INSERT INTO unggah(nama, tanggal, file, userid, id_user, status_dokumen) VALUES ('$namaTemp', '$tanggal', '$filename', '$userid', '$id', '$status')";
        $stmt = $db->prepare($query);
        $stmt->execute();
    }

    if(isset($_POST['iddata'])){
        $direct = "file/";

        $id = $_POST['id'];
        $dataId = $_POST['iddata'];
        $nama = $_POST['nama'];
        $tanggal = $_POST['tanggal'];


        $query = "UPDATE unggah SET nama = '$nama', tanggal = '$tanggal' WHERE id = '$dataId'";
        $stmt = $db->prepare($query);
        $stmt->execute();
    }

    if(isset($_POST['clickPesan'])){
        
        $iduser = $_POST['id_user'];
        $query1 = "UPDATE unduh SET dibaca_user = 'sudah' WHERE id_user = '$iduser'";
        $stmt1 = $db->prepare($query1);
        $stmt1->execute();
    }

    if(isset($_POST['terbaca'])){
        
        $iduser = $_POST['kode'];
        $query1 = "UPDATE pesan SET terbaca = '1' WHERE kode = '$iduser'";
        $stmt1 = $db->prepare($query1);
        $stmt1->execute();
    }
?>