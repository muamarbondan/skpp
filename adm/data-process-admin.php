<?php
    include("template.php");

    if(isset($_POST['balasanunggah'])){
        $direct = "../file/";
        $namaFile = $_FILES['file']['name'];
        $namaTmp = $_FILES['file']['tmp_name'];

        $iduser = $_POST['iduser'];
        $iddata = $_POST['iddata'];
        $userid = $_POST['userid'];
        $nama = $_POST['nama'];
        $tanggal = $_POST['tanggal'];

        if(isset($namaFile) && !empty($namaFile)){

            $temp = explode(".", $namaFile);
            $filename = round(microtime(true)). '-' . $iduser . '.' . end($temp);

            move_uploaded_file($namaTmp, $direct.$filename);

        }

        $query = "INSERT INTO unduh(nama, tanggal, file, userid, id_user, id_unggah) VALUES ('$nama', '$tanggal', '$filename', '$userid', '$iduser', '$iddata')";
        $stmt = $db->prepare($query);
        $stmt->execute();

        $query1 = "UPDATE unggah SET status = '1' WHERE id_user = '$iduser' AND id = '$iddata'";
        $stmt1 = $db->prepare($query1);
        $stmt1->execute();
    }

    if(isset($_POST['balasanunggahtolak'])){
        $direct = "../file/";
        $namaFile = $_FILES['file']['name'];
        $namaTmp = $_FILES['file']['tmp_name'];

        $iduser = $_POST['iduser'];
        $iddata = $_POST['iddata'];
        $pesan = $_POST['pesan'];

        if(isset($namaFile) && !empty($namaFile)){

            $temp = explode(".", $namaFile);
            $filename = round(microtime(true)). '-' . $iduser . '.' . end($temp);

            move_uploaded_file($namaTmp, $direct.$filename);

        }else{
            echo "gagal disini";
        }

        $query = "UPDATE unggah SET status = '3', pesan = '$pesan', gambar_tlk = '$filename' WHERE id_user = '$iduser' AND id = '$iddata'";
        $stmt = $db->prepare($query);
        $stmt->execute();
    }

    if(isset($_POST['editAdmin'])){
        $nama = $_POST['nama'];
        $pass = $_POST['pass'];
        $alamat = $_POST['alamat'];
        $id = $_POST['iddata'];
        $userid = $_POST['userid'];

        $query = "UPDATE user SET nama = '$nama', pass = '$pass', alamat = '$alamat', userid = '$userid' WHERE id = '$id'";
        $stmt = $db->prepare($query);
        $stmt->execute();
    }

    if(isset($_POST['iduseredit'])){
        $nama = $_POST['nama'];
        $pass = $_POST['pass'];
        $alamat = $_POST['alamat'];
        $id = $_POST['iddata'];
        $userid = $_POST['userid'];

        $query = "UPDATE user SET nama = '$nama', pass = '$pass', alamat = '$alamat', userid = '$userid' WHERE id = '$id'";
        $stmt = $db->prepare($query);
        $stmt->execute();
    }

    if(isset($_POST['hapusditerima'])){
        $id = $_POST['id'];
        $file = $_POST['fileName'];

        unlink("../file/".$file);
        $query = "DELETE FROM unduh WHERE id = '$id'";
        $stmt = $db->prepare($query);
        $stmt->execute();

        header("location: dikirim?status3=active");
    }

    if(isset($_POST['hapusdikirim'])){
        $id = $_POST['id'];
        $file = $_POST['fileName'];

        unlink("../file/".$file);
        $query = "DELETE FROM unggah WHERE id = '$id'";
        $stmt = $db->prepare($query);
        $stmt->execute();

        header("location: diterima?status2=active");
    }

    if(isset($_POST['hapussatker'])){
        $id = $_POST['id'];

        $query = "DELETE FROM user WHERE id = '$id'";
        $stmt = $db->prepare($query);
        $stmt->execute();

        header("location: database?status4=active");
    }

    if(isset($_POST["importData"])) {
        $koneksi = mysqli_connect("localhost","u236905158_app","Bondangagah23","u236905158_app");
        require('spreadsheet-reader-master/php-excel-reader/excel_reader2.php');
        require('spreadsheet-reader-master/SpreadsheetReader.php');
        
        //upload data excel kedalam folder uploads
        $target_dir = "../file/".basename($_FILES['product_file']['name']);
        
        move_uploaded_file($_FILES['product_file']['tmp_name'],$target_dir);
        
        $Reader = new SpreadsheetReader($target_dir);
        
        foreach ($Reader as $Key => $Row)
        {
            // import data excel mulai baris ke-2 (karena ada header pada baris 1) 
            $query=mysqli_query($koneksi, "INSERT INTO user(userid, pass, nama, alamat) VALUES 
            ('".$Row[0]."','".$Row[1]."','".$Row[2]."', '".$Row[3]."')");
        }
        if ($query) {
            header("location: database?status4=active");
        }else{
            echo mysqli_error();
        }
    }

    if(isset($_POST['clickPesan'])){
        $query1 = "UPDATE unggah SET dibaca_admin = 'sudah'";
        $stmt1 = $db->prepare($query1);
        $stmt1->execute();
    }
?>