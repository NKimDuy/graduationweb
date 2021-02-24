<?php
	require_once("./connectDB.php");
	$con = Connect();
	$tableName = $_GET['table_name'];
	$sql = "SELECT * FROM  " . $tableName;
	
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
	
	
?>  
 