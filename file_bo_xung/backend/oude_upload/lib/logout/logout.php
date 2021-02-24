<?php
	session_start();
	require_once("../../db/Config.php");
	unset($_SESSION['user']);
	unset($_SESSION['success']);
	unset($_SESSION['permission']);
	header("Location:" . $conf["root"] ."login.php");
?>