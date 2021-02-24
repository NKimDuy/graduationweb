<?php
	require_once("../../db/connectDB.php");
	require_once ("../../db/Config.php");
	require_once ('../htmlpurifier-4.12.0/htmlpurifier-4.12.0/library/HTMLPurifier.auto.php');
	$con = Connect();
	$config = HTMLPurifier_Config::createDefault();
	$purifier = new HTMLPurifier($config);
	$patterm = '/select|from|where|join|SELECT|FROM|WHERE|JOIN|=|\'/';
	$replacement = "";
	$tableName = $_POST["table_name"];
	$tableName = preg_replace($patterm, $replacement, $tableName);
	$data_title = $_POST["title"];
	$data = $_POST["data"];
	
	$notification = "";
	
	/*-------------kiểm tra table đã tồn tại vs tạo table ------------------*/
	
	$checkTable = " SELECT * FROM INFORMATION_SCHEMA.TABLES 
	WHERE TABLE_SCHEMA = '" . $conf["TABLE_SCHEMA"] . "' AND TABLE_NAME = '" . $tableName . "'";
	$query = mysqli_query($con, $checkTable);
	$number = mysqli_num_rows($query);
	
	if ($number <= 0)
	{
		//NVARCHAR(500)
		$sql = " CREATE TABLE " . $tableName . "(";
		for ($i = 0 ; $i < count($data_title) ; $i++)
		{
			$sql .= $data_title[$i] . " NVARCHAR(500), ";
		}
		$sql = rtrim($sql, ", ");
		$sql.= ") ENGINE = InnoDB DEFAULT CHARACTER SET = utf8 COLLATE = utf8_unicode_ci;";
		if (mysqli_query($con, $sql))
		{
			$notification = "tạo bảng thành công";
		}
		else
		{
			
			$notification = "tạo bảng thất bại";
		}
	}
	
	/*--------------------------------------------*/
	
	/*----------- thêm các dòng vào bảng ------------*/
	
	$sql_insert = "INSERT INTO " . $tableName . "(";
	for ($i = 0 ; $i < count($data_title) ; $i++)
	{
		$sql_insert .= $data_title[$i]. ", ";
	}
	$sql_insert = rtrim($sql_insert, ", ");
	$sql_insert.= ") VALUES(";
	for ($i = 0 ; $i < count($data) ; $i++)
	{
		$sql_insert.= "'" . $data[$i] . "', ";
	}
	$sql_insert = rtrim($sql_insert, ", ");
	$sql_insert.= ")";
	
	try
	{
		$query = mysqli_query($con, $sql_insert);
		echo json_encode("success");
	}
	catch(Exception $e)
	{
		//echo json_encode($e->getMessage());
		echo json_encode("fail to add " . $data[3]);
	}
	
	/*-----------------------------------------------*/
	
	DisConnect();
	
	
	
?>