<?php
	require_once "../../db/ConnectDB.php";
	require_once "./Students.php";
	$mssv = $_GET['masv'];
	$semester = $_GET['semester'];
	$data = FindStudentAjax($mssv, $semester);
	echo json_encode($data);
	
 ?>