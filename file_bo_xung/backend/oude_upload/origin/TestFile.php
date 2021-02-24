<?php
	require_once("./connectDB.php");
	$con = Connect();
	$sql = "SELECT * FROM  test1" ;
	//echo json_encode($sql);
	
	$data = [];
	$query = mysqli_query($con, $sql);
	$number = mysqli_num_rows($query);
	if ($number > 0)
	{
		while($row = mysqli_fetch_assoc($query))
		{
			$data[] = $row;
		}
		
		
	}
	else
	{
		
	}
	var_dump($data);
	
	
?>  