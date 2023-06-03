<?php 
    session_start();
   session_destroy();

header("location: ../formLogin.php");
    exit();

    // don't destroy all session 
    // we have session called reserverlivre , we need it to check the person if he have reserver livre
?>