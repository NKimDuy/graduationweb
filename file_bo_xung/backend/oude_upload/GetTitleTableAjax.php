<?php
	require_once("./connectDB.php");
	$con = Connect();
	$tableName = $_GET['table_name'];
	//$sql = "SELECT COLUMN_NAME FROM INFORMATION_SCHEMA.COLUMNS WHERE TABLE_NAME = '" . $tableName . "' AND TABLE_SCHEMA = 'duy'";
	$sql = "SELECT * FROM " . $tableName;
	$data = [];
	$query = mysqli_query($con, $sql);
	$number = mysqli_num_rows($query);
	if ($number > 0)
	{
		while ($finfo = mysqli_fetch_field($query)) 
		{
			array_push($data,$finfo->name);
		}
		
		echo json_encode( $data ); 
	}
	
	
	
?> 