<?php
    require("login-form-v1/login_v1/php/connection.php");
    $id=$_GET['position'];
    $query = "delete from favorie where ID_LIVRE=$id";
    $result = $con->exec($query);
    header('location:shoping-cart.php');
?>