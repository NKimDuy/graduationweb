<?php
	require_once "../../db/ConnectDB.php";
	require_once "./Students.php";
	$mssv = $_GET['masv'];
	
	$tablename_array = GetTableName();
	
	$get_tablename = [];
	foreach($tablename_array as $item)
	{
		array_push($get_tablename, $item['TABLE_NAME']);
	}
	$data = FindAllStudentAjax($mssv, $get_tablename);

	//$data = FindAllStudentAjax("13160005TP", GetTableName());
	echo json_encode($data);	
 ?>