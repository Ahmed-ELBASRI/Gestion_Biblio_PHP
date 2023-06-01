<?php


    require_once "VerificationAuth.php";
    if(!isset($_GET["email"])){
            header("location:index.php");
            exit;
    }

    // add to news letter

    $email=$_GET["email"];
    
    // update db
