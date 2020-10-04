<?php
    if(!isset($_SESSION)){
        session_start();
        if(empty($_SESSION['userid'])){
            header("location: ../index.php");
        }
    }
?>