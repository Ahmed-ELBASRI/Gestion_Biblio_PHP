<?php 

    
    require_once "VerficationAuth.php";
    if(!isset($_GET["id"])){
        header("location:product.php");
        exit;
    }
   // session_start();
    $idLivre=$_GET["id"];
    if(empty($idLivre)){
        header("location:product.php");
        exit;
    }

    //check is this person has a reservation 
    require_once "Login-form-v1/Login_v1/php/connection.php";

    $ID_PERSONNE=$_SESSION["ID_PERSONNE"];

    $query="select * from ReserverLivre where ID_PERSONNE=:ID_PERSONNE";
    $statement=$con->prepare($query);
    $statement->execute(array("ID_PERSONNE"=>$ID_PERSONNE));
    $data=$statement->fetch();
    if(!empty($data)){
        echo "you have a reservation already ";
        exit;
    }







    $dateReservation=date("Y-m-d H:i:s");
    //echo $dateReservation;
    // add to table ReserverLivre


    $query="insert into reserverlivre(ID_LIVRE,ID_PERSONNE,DATERESERVATION) values(:idLivre,:ID_PERSONNE,:dateReservation)";
    $statement=$con->prepare($query);
    $statement->execute(array("idLivre"=>$idLivre,"ID_PERSONNE"=>$ID_PERSONNE,"dateReservation"=>$dateReservation));

    $_SESSION["livreReserver"]=1;

    // redirection to product.php

    header("location:product.php");

    




