<?php


require_once "login-form-v1/Login_v1/php/connection.php";

session_start();

$ID_PERSONNE=$_SESSION["ID_PERSONNE"];
$ID_LIVRE=$_POST["ID_LIVRE"];

$query="delete  from  favorie where ID_PERSONNE=:ID_PERSONNE and ID_LIVRE=:ID_LIVRE";
$statement=$con->prepare($query);
$statement->execute(array("ID_PERSONNE"=>$ID_PERSONNE,"ID_LIVRE"=>$ID_LIVRE));