<?php
	require_once "config.php";
	
	function Connect()
	{
		global $conf;
		//$con = mysqli_connect("localhost", "root", "nkDuy1998", "oude"); 
		$con = mysqli_connect($conf['server'], $conf['user'], $conf['password'], $conf['database']); 
		if ($con)
		{
			mysqli_set_charset($con, "utf8");
		}
		return $con;
	}
	
	function DisConnect()
	{
		if (Connect())
		{
			mysqli_close(Connect());
		}
	}
?>