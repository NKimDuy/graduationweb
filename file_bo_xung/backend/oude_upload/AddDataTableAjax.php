<?php
	require_once("./connectDB.php");
	$con = Connect();
	$tableName = $_POST['table_name'];
	$data = $_POST['row'];
	$sql = "INSERT INTO " . $tableName . " VALUES(";
	for ($i = 0 ; $i < count($data) ; $i++)
	{
		$sql.= "'" . $data[$i] . "', ";
	}
	$sql = rtrim($sql, ", ");
	$sql.= ")";
	
	
	try
	{
		$query = mysqli_query($con, $sql);
		echo json_encode($sql);
	}
	catch(Exception $e)
	{
		echo json_encode($e->getMessage());
	}
	
?>  