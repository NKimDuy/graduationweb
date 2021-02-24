<?php
	//require_once "../../db/ConnectDB.php";
	
	function FindStudentsByMssv($mssv, $semester)
	{		
		$con = Connect();
		$sql = "SELECT * FROM " . $semester . " WHERE mssv LIKE '%" . $mssv . "%'";
		$query = mysqli_query($con, $sql);
		$number = mysqli_num_rows($query);
		$data = [];
		if ($number > 0)
		{
			while($row = mysqli_fetch_assoc($query))
			{
				$data[] = $row;
			}
			return $data;
		}
		else
		{
			return null;
		}
		DisConnect();
	}
	
		
	function FindAllStudentsByMssv($mssv, $tablename_array)
	{	
		$sql = "";
		$data = [];
		$con = Connect();
		
		for ($i = 0 ; $i < count($tablename_array) ; $i++)
		{
			$sql .= "SELECT mssv, ho, ten, ngay_sinh, noi_sinh, gioi_tinh FROM " . $tablename_array[$i] . " WHERE mssv LIKE '%" . $mssv . "%' UNION ";
		
		}
		$sql = rtrim($sql, "UNION ");
		$query = mysqli_query($con, $sql);
		$number = mysqli_num_rows($query);
		
		if ($number > 0)
		{
			while($row = mysqli_fetch_assoc($query))
			{
				$data[] = $row;
				
			}
			return $data;
			
		}
		else
		{
			return null;
		}
	
		DisConnect();
	}
	
		
	function FindStudentsByName($name, $semester)
	{		
		$con = Connect();
		$sql = "SELECT * FROM " . $semester . " WHERE CONCAT_WS(' ', ho, ten) LIKE '%" . $name . "%' OR temp LIKE '%" . $name . "%'";
		$query = mysqli_query($con, $sql);
		$number = mysqli_num_rows($query);
		$data = [];
		if ($number > 0)
		{
			while($row = mysqli_fetch_assoc($query))
			{
				$data[] = $row;
			}
			return $data;
		}
		else
		{
			return null;
		}
		DisConnect();
	}
	
		
	function FindAllStudentsByName($name, $tablename_array)
	{		
		$sql = "";
		$data = [];
		$con = Connect();
		
		for ($i = 0 ; $i < count($tablename_array) ; $i++)
		{
			$sql .= "SELECT mssv, ho, ten, ngay_sinh, noi_sinh, gioi_tinh FROM " . $tablename_array[$i] . " WHERE CONCAT_WS(' ', ho, ten) LIKE '%" . $name . "%' OR temp LIKE '%" . $name . "%' UNION ";
			//$sql .= "SELECT * FROM " . $tablename_array[$i] . " WHERE CONCAT_WS(' ', ho, ten) LIKE '%" . $name . "%' OR temp LIKE '%" . $name . "%' UNION ALL ";
		}
		$sql = rtrim($sql, "UNION ");
		$query = mysqli_query($con, $sql);
		$number = mysqli_num_rows($query);
		
		if ($number > 0)
		{
			while($row = mysqli_fetch_assoc($query))
			{
				$data[] = $row;
				
			}
			return $data;
			
		}
		else
		{
			return null;
		}
	
		DisConnect();
	}
		
	
	function FindStudentAjax($mssv, $semester)
	{
		$con = Connect();
		$sql = "SELECT * FROM " . $semester . " WHERE mssv = '" . $mssv . "'";
		$query = mysqli_query($con, $sql);
		$number = mysqli_num_rows($query);
		$row = null;
		if ($number > 0) 
		{
			$row = mysqli_fetch_assoc($query);
		}
		return $row;
		DisConnect();
	}
	
	
	function FindAllStudentAjax($mssv, $tablename_array)
	{
		$sql = "";
		$data = [];
		$con = Connect();
		
		for ($i = 0 ; $i < count($tablename_array) ; $i++)
		{
			$sql .= "SELECT * FROM " . $tablename_array[$i] . " WHERE mssv = '" . $mssv . "' UNION ALL ";
			
		}
		
		$sql = rtrim($sql, "UNION ALL ");
		$query = mysqli_query($con, $sql);
		$number = mysqli_num_rows($query);
		
		
		if ($number > 0)
		{
			while($row = mysqli_fetch_assoc($query))
			{
				$data[] = $row;
				
			}
			return $data;
			
		}
		else
		{
			return null;
		}
		
		DisConnect();
	}
	
	
	function GetTableName()
	{
		$con = Connect();
		$sql = "SELECT TABLE_NAME FROM information_schema.TABLES WHERE TABLE_SCHEMA = 'oude'";
		$query = mysqli_query($con, $sql);
		$number = mysqli_num_rows($query);
		$data = [];
		if ($number > 0)
		{
			while($row = mysqli_fetch_assoc($query))
			{
				$data[] = $row;
			}
			return $data;
		}
		else
		{
			return null;
		}
		DisConnect();
	}
?>