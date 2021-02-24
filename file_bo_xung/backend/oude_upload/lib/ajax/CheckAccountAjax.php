<?php
	require_once ("../../db/connectDB.php");
	require_once ("../../db/Config.php");
	
	require_once ('../htmlpurifier-4.12.0/htmlpurifier-4.12.0/library/HTMLPurifier.auto.php');
	
	$con = Connect();
	
	$user = $_GET["user"];
	
	
	
	$patterm = '/select|from|where|join|SELECT|FROM|WHERE|JOIN|=|\'/';
	$replacement = "";
	$user = preg_replace($patterm, $replacement, $user);
	
	$config = HTMLPurifier_Config::createDefault();
	$purifier = new HTMLPurifier($config);
	$user = $purifier->purify(trim(preg_replace('/\s+/mu', '', $user)));
	
	
	$sql = "SELECT * FROM tb_user where user = '" . $user . "'";
	$query = mysqli_query($con, $sql);
	if($query)
	{
		$number = mysqli_num_rows($query);
		if ($number > 0)
		{
			echo json_encode(true);
		}
		else
		{
			echo json_encode(false);
		}
	}
	DisConnect();
?>