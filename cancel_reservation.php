<?php
session_start();
    require("login-form-v1/login_v1/php/connection.php");
    $id=$_GET['position'];
    $query = "update reserverlivre set archive = 1, ETAT = 'canceled' where ID_LIVRE=$id";
    $result = $con->exec($query);
    $_SESSION["livreReserver"]=0;
    // $data = $result->fetchAll();
    header('location:reservation.php');
?>