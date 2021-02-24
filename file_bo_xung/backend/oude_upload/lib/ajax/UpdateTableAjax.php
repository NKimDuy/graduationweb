<?php
	require_once("../../db/connectDB.php");
	require_once ("../../db/Config.php");
	require_once ('../htmlpurifier-4.12.0/htmlpurifier-4.12.0/library/HTMLPurifier.auto.php');
	$config = HTMLPurifier_Config::createDefault();
	$purifier = new HTMLPurifier($config);
	$patterm = '/select|from|where|join|SELECT|FROM|WHERE|JOIN|=|\'/';
	$replacement = "";
	$con = Connect();
	$tableName = $_POST['table_name'];
	$data = $_POST['row'];
	
	
	
	for ($i = 0 ; $i < count($data) ; $i++)
	{
		$data[$i] = preg_replace($patterm, $replacement, $data[$i]);
		$data[$i] = $purifier->purify($data[$i]);
	}
	
	
	$column = [];
	$sql = "SELECT COLUMN_NAME FROM INFORMATION_SCHEMA.COLUMNS WHERE TABLE_NAME = '" . $tableName . "' AND TABLE_SCHEMA = '" . $conf["TABLE_SCHEMA"] . "' order by ORDINAL_POSITION";
	$query = mysqli_query($con, $sql);
	$number = mysqli_num_rows($query);
	if ($number > 0)
	{
		while($row = mysqli_fetch_assoc($query))
		{
			$column[] = $row;
		}
		$sql = "UPDATE " . $tableName . " SET ";
		
		
		for ($i = 0 ; $i < count($column) ; $i++)
		{
			$sql .= $column[$i]['COLUMN_NAME'] . " = '" . $data[$i] . "', ";
		}
		$sql = rtrim($sql, ", ");
		$sql.= " WHERE mssv = '" . $data[3] . "'";
	
		//echo json_encode($sql);
		try
		{
			$query = mysqli_query($con, $sql);
			echo json_encode($sql);
		}
		catch(Exception $e)
		{
			echo json_encode($e->getMessage());
		}
		
	}
	DisConnect();
?>   