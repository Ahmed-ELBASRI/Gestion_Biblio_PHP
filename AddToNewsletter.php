<?php


    require_once "VerficationAuth.php";
    if(!isset($_GET["email"])){
            header("location:index.php");
            exit;
    }

    // add to news letter

    $email=$_GET["email"];
    if($email!=$_SESSION["email"]){
        header("location:index.php");
        exit;
    }
    if($_SESSION["newsletter"]==1){
        $query="update personne set newsletter=0 where EMAIL=:email";
        $_SESSION["newsletter"]=0;

       
    }
    else{
        $query="update personne set newsletter=1 where EMAIL=:email";
        $_SESSION["newsletter"]=1;

    }
    require_once "login-form-v1/Login_v1/php/connection.php";
    $statment=$con->prepare($query);
    $statment->execute(array("email"=>$email));

    header("location:index.php");
    exit;

    
    // update db
