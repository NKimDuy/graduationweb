<?php
	
	require_once("../../db/connectDB.php");
	require_once ("../../db/Config.php");
	$con = Connect();
	$tableName = $_POST["table_name"];
	$sql = "DROP TABLE " . $tableName;
	
	$query = mysqli_query($con, $sql);
	//$number = mysqli_num_rows($query);
	echo json_encode($tableName); 
	
	DisConnect();
	
?>  
 
 