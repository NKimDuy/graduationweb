<?php
	require_once("./connectDB.php");
	$con = Connect();
	$tableName = $_POST['table_name'];
	$sql = "SELECT MAX(stt) FROM " . $tableName;
	
	$query = mysqli_query($con, $sql);
	$number = mysqli_num_rows($query);
	$row = null;
	if ($number > 0)
	{
		try 
		{
			$row = mysqli_fetch_assoc($query);
			echo json_encode($row);
		}
		catch(Exception $e)
		{
			echo json_encode($e->getMessage());
		}
	}
	
?>  