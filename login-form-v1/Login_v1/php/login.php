<?php
    echo"hello";
    if(!isset($_POST["email"])){
        header("location: ../formLogin.php");
        exit();
    }
    $email=$_POST["email"];
    $pass=$_POST["pass"];
    if(filter_var($email,FILTER_VALIDATE_EMAIL) && !empty($pass)){
        $pass= md5($pass);
        $query = "select * from PERSONNE where email like :email and password like :pass";
        require("connection.php");
        $stmt = $con->prepare($query);
        $stmt->execute(array(":email" => $email,":pass" => $pass));
        $stmt=$stmt->fetch();
        print_r($stmt);
        if(count($stmt)==0){
            echo "hello";
            header("location : ../formLogin.php");
            exit();
        }
        header("location: ../../../index.php");
        
    }    
?>