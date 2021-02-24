<?php
	require_once("../../db/connectDB.php");
	require_once ("../../db/Config.php");
	$con = Connect();
	$mssv = $_POST['mssv'];
	$tableName = $_POST['table_name'];
	$sql = "SELECT * FROM  " . $tableName . " WHERE mssv = '" . $mssv . "'";
	
	
	$data = [];
	
	$query = mysqli_query($con, $sql);
	$number = mysqli_num_rows($query);
	if ($number > 0)
	{
		while($row = mysqli_fetch_assoc($query))
		{
			$data[] = $row;
		}
		
		echo json_encode( $data ); 
	}
	
	DisConnect();
	
?>  
 