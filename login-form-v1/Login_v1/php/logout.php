<?php 
    session_start();
   /* session_destroy();*/
  unset($_SESSION["email"]) ;
  unset($_SESSION["role"]) ;
  unset($_SESSION["newsletter"]) ;
  unset($_SESSION["ID_PERSONNE"]) ;
header("location: ../formLogin.php");
    exit();

    // don't destroy all session 
    // we have session called reserverlivre , we need it to check the person if he have reserver livre
?>