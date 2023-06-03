<?php
require("VerficationAuth.php");
require("login-form-v1/login_v1/php/connection.php");
$ID_PERSONNE=$_SESSION["ID_PERSONNE"];
$query="select * from favorie where ID_PERSONNE=:ID_PERSONNE";
        $statement3=$con->prepare($query);
        $statement3->execute(array("ID_PERSONNE"=>$ID_PERSONNE));
        $data3=$statement3->fetchAll(PDO::FETCH_ASSOC);

        $jsonData = json_encode($data3);
        echo $jsonData;
