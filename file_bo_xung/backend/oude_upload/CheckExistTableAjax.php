<?php
	require_once("./connectDB.php");
	require_once ("./Config.php");
	require_once './htmlpurifier-4.12.0/htmlpurifier-4.12.0/library/HTMLPurifier.auto.php';
	$con = Connect();
	$config = HTMLPurifier_Config::createDefault();
	$purifier = new HTMLPurifier($config);
	$patterm = '/select|from|where|join|SELECT|FROM|WHERE|JOIN|=|\'/';
	$replacement = "";
	$tableName = $_POST['table_name'];
	$tableName = preg_replace($patterm, $replacement, $tableName);
	$sql = "SELECT TABLE_NAME FROM INFORMATION_SCHEMA.TABLES WHERE TABLE_SCHEMA = '" . $conf["TABLE_SCHEMA"] . "' AND TABLE_NAME = '" . $tableName . "'";
	
	$query = mysqli_query($con, $sql);
	$number = mysqli_num_rows($query);
	$row = null;
	if ($number > 0)
	{
		echo json_encode($number);
	}
	else 
	{
		echo json_encode(0);
	}
?>  