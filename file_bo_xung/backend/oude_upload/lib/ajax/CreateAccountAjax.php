<?php
	require_once ("../../db/connectDB.php");
	require_once ("../../db/Config.php");
	
	require_once ('../htmlpurifier-4.12.0/htmlpurifier-4.12.0/library/HTMLPurifier.auto.php');
	
	$con = Connect();
	
	$user = $_GET["user"];
	
	$password = $_GET["password"];
	$passwordConfirm = $_GET["passwordConfirm"];
	$firstname = $_GET["firstname"];
	$lastname = $_GET["lastname"];
	$permission = $_GET["permission"];
	
	
	
	$patterm = '/select|from|where|join|SELECT|FROM|WHERE|JOIN|=|\'/';
	$replacement = "";
	$firstname = preg_replace($patterm, $replacement, $firstname);
	$lastname = preg_replace($patterm, $replacement, $lastname);
	$user = preg_replace($patterm, $replacement, $user);
	$password = preg_replace($patterm, $replacement, $password);
	$passwordConfirm = preg_replace($patterm, $replacement, $passwordConfirm);
	
	$config = HTMLPurifier_Config::createDefault();
	$purifier = new HTMLPurifier($config);
	$firstname = $purifier->purify(trim(preg_replace('/\s+/mu', '', $firstname)));
	$lastname = $purifier->purify(trim(preg_replace('/\s+/mu', '', $lastname)));
	$user = $purifier->purify(trim(preg_replace('/\s+/mu', '', $user)));
	$password = $purifier->purify(trim(preg_replace('/\s+/mu', '', $password)));
	$passwordConfirm = $purifier->purify(trim(preg_replace('/\s+/mu', '', $passwordConfirm)));
	
	$sql = "";
	if ($permission == 'admin')
	{
		$sql = "INSERT INTO tb_user(user, password, password_backup, first_name, last_name, permission) VALUES ('" . $user . "', '" . crypt($password, "1998nk!Duy@@$") . "', '" . crypt('1TtDttx!',"1998nk!Duy@@$") . "', '" . $firstname . "', '" . $lastname ."', 'admin')";
		
	}
	elseif ($permission == 'user')
	{
		$sql = "INSERT INTO tb_user(user, password, password_backup, first_name, last_name, permission) VALUES ('" . $user . "', '" . crypt($password, "1998nk!Duy@@$") . "', '" . crypt('1TtDttx!',"1998nk!Duy@@$") . "', '" . $firstname . "', '" . $lastname ."', 'user')";
		
	}
	
	$query = mysqli_query($con, $sql);
	if($query)
	{
		echo json_encode(true);
	}
	else 
	{
		echo json_encode(false);
	}
	DisConnect();
?>