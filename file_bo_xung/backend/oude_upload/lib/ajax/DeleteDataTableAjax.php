<?php
	require_once("../../db/connectDB.php");
	require_once ("../../db/Config.php");
	$con = Connect();
	$tableName = $_POST['table_name'];
	$mssv = $_POST['mssv'];
	$sql = "DELETE FROM " . $tableName . " WHERE mssv = '" . $mssv . "'";
	
	try
	{
		$query = mysqli_query($con, $sql);
	}
	catch(Exception $e)
	{
		echo json_encode($e->getMessage());
	}
	DisConnect();
?>  