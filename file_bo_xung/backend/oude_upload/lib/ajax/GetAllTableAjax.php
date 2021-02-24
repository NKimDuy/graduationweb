<?php
	require_once("../../db/connectDB.php");
	require_once ("../../db/Config.php");
	$con = Connect();
	$sql = "SELECT TABLE_NAME FROM information_schema.TABLES WHERE TABLE_SCHEMA = '" . $conf["TABLE_SCHEMA"] . "' AND TABLE_NAME NOT IN 
			(SELECT TABLE_NAME FROM information_schema.TABLES WHERE TABLE_SCHEMA = '" . $conf["TABLE_SCHEMA"] . "' and 
			(TABLE_NAME = 'tb_permission' or TABLE_NAME = 'tb_user' or TABLE_NAME = 'tb_user_group' or TABLE_NAME = 'tb_permission_function'))";
	
	$data = [];
	$query = mysqli_query($con, $sql);
	$number = mysqli_num_rows($query);
	if ($number > 0)
	{
		while($row = mysqli_fetch_assoc($query))
		{
			$data[] = $row;
		}
		
		echo json_encode($data); 
	}
	DisConnect();
	
?>  
 