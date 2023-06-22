<?php

if(isset($_POST["email"])){

   $email=$_POST["email"];
   session_start();
   $_SESSION["email"]=$email;
}

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
/* Exception class. */
require 'C:\PHPMailer\src\Exception.php';
/* The main PHPMailer class. */
require 'C:\PHPMailer\src\PHPMailer.php';
/* SMTP class, needed if you want to use SMTP. */
require 'C:\PHPMailer\src\SMTP.php';
$mail = new PHPMailer(TRUE);

/* Open the try/catch block. */
try {
   $mail->isSMTP();
   $mail->SMTPAuth=true;
   $mail->Host='smtp.gmail.com';
   $mail->Username='eheieheiehei049@gmail.com';
   $mail->Password='hjdevobrimccanko';
   $mail->SMTPSecure='tls';
   $mail->Port=587;
   /* Set the mail sender. */
   $mail->addAddress($email);
   /* Add a recipient. */
   $mail->setFrom('eheieheiehei049@gmail.com');
   /* Set the subject. */
   $mail->Subject = 'Password Reset';
   /* Set the mail message body. */
   $mail->Body = 'There is a great disturbance in the Force.';

   $mail->isHTML(TRUE);
   require  "file8.php";
   $htmlContent=ob_get_clean();
//mail->Body = '<html>There is a great disturbance in the <strong>Force</strong>.</html>';
$mail->Body=$htmlContent;
$mail->AltBody = 'There is a great disturbance in the Force.';
   /* Finally send the mail. */
  // $mail->SMTPDebug = 2;

   $mail->send();
}
catch (Exception $e)
{
   /* PHPMailer exception. */
   echo $e->errorMessage();
}
catch (\Exception $e)
{
   /* PHP exception (note the backslash to select the global namespace Exception class). */
   echo $e->getMessage();
}