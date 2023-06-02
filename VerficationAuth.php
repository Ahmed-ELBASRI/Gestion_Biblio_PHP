<?php
session_start();
if (!isset($_SESSION["email"])) {
	header("location:login-form-v1/Login_v1/formLogin.php");
	exit();
}
?>