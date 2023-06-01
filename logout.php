<?php


session_start();
session_destroy();

header("location:login-form-v1/Login_v1/formLogin.php");
exit;