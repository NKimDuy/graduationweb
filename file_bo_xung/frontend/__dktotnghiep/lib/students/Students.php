<?php
	//require_once "../../db/ConnectDB.php";
	
	function FindStudentsByMssv($mssv, $semester)
	{		
		$con = Connect();
		$sql = "SELECT * FROM " . $semester . " WHERE mssv LIKE '%" . $mssv . "%'";
		$query = mysqli_query($con, $sql);
		if ($query)
		{
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
		else
		{
			throw new Exception(" có lỗi khi thao tác với csdl ");
		}
		
	}
	
	/*	
	function FindAllStudentsByMssv($mssv, $tablename_array)
	{	
		$sql = "";
		$data = [];
		$con = Connect();
		
		for ($i = 0 ; $i < count($tablename_array) ; $i++)
		{
			$sql .= "SELECT mssv, ho, ten, ngay_sinh, noi_sinh, gioi_tinh FROM " . $tablename_array[$i] . " WHERE mssv LIKE '%" . $mssv . "%' UNION ";
		
		}
		$sql = rtrim($sql, " UNION ");
		$query = mysqli_query($con, $sql);
		if ($query)
		{
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
		else
		{
			throw new Exception(" có lỗi khi thao tác với csdl ");
		}
		
	}*/
	
	function FindAllStudentsByMssv($mssv, $tablename_array)
	{	
		$sql = "";
		$data = [];
		$con = Connect();
		$query = false;
		
		for ($i = 0 ; $i < count($tablename_array) ; $i++)
		{
			$sql = "SELECT mssv, ho, ten, ngay_sinh, noi_sinh, gioi_tinh FROM " . $tablename_array[$i] . " WHERE mssv LIKE '%" . $mssv . "%'";
			$query = mysqli_query($con, $sql);
			if ($query)
			{
				$number = mysqli_num_rows($query);
			
				if ($number > 0)
				{
					while($row = mysqli_fetch_assoc($query))
					{
						$data[] = $row;
					}				
				}
			}
			else
			{
				break;
			}
		}
		if ($query)
		{
			if (count($data) > 0)
			{
				return array_unique($data,0);
			}
			else
			{
				return null;
			}
			
			DisConnect();
		}
		else
		{
			throw new Exception(" có lỗi khi thao tác với csdl ");
		}
		
	}
	
	
	function FindStudentsByName($name, $semester)
	{		
		$con = Connect();
		$sql = "SELECT * FROM " . $semester . " WHERE CONCAT_WS(' ', ho, ten) LIKE '%" . $name . "%' OR temp LIKE '%" . $name . "%'";
		$query = mysqli_query($con, $sql);
		if ($query)
		{
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
		else
		{
			throw new Exception(" có lỗi khi thao tác với csdl ");
		}
		
	}
	
	
	
	
	/*
	function FindAllStudentsByName($name, $tablename_array)
	{
		$sql = "";
		$data = [];
		$con = Connect();
		for ($i = 0 ; $i < count($tablename_array) ; $i++)
		{
			
			$sql .= "SELECT mssv, ho, ten, ngay_sinh, noi_sinh, gioi_tinh FROM " . $tablename_array[$i] . " WHERE CONCAT_WS(' ', ho, ten) LIKE '%" . $name . "%' OR temp LIKE '%" . $name . "%' UNION ";
		}
		$sql = rtrim($sql, "UNION ");
		$query = mysqli_query($con, $sql);
		if ($query)
			{
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
		else
		{
			throw new Exception(" có lỗi khi thao tác với csdl ");
		}
		
	}*/
	
	
	function FindAllStudentsByName($name, $tablename_array)
	{
		$sql = "";
		$data = [];
		$con = Connect();
		$query = false;
		for ($i = 0 ; $i < count($tablename_array) ; $i++)
		{
			$sql = "SELECT mssv, ho, ten, ngay_sinh, noi_sinh, gioi_tinh FROM " . $tablename_array[$i] . " WHERE CONCAT_WS(' ', ho, ten) LIKE '%" . $name . "%' OR temp LIKE '%" . $name . "%'";
			$query = mysqli_query($con, $sql);
			if ($query)
			{
				$number = mysqli_num_rows($query);
			
				if ($number > 0)
				{
					while($row = mysqli_fetch_assoc($query))
					{
						$data[] = $row;
							
					}				
				}
			}
			else
			{
				break;
			}
		}
		if ($query)
		{
			if (count($data) > 0)
			{
				return array_unique($data,0);
			}
			else
			{
				return null;
			}
			DisConnect();
		}
		else
		{
			throw new Exception(" có lỗi khi thao tác với csdl ");
		}
		
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
		$query = false;
		
		for ($i = 0 ; $i < count($tablename_array) ; $i++)
		{
			$sql = "SELECT * FROM " . $tablename_array[$i] . " WHERE mssv = '" . $mssv . "'";
			$query = mysqli_query($con, $sql);
			if ($query)
			{
				$number = mysqli_num_rows($query);
			
				if ($number > 0)
				{
					while($row = mysqli_fetch_assoc($query))
					{
						$data[] = $row;
					}				
				}
			}
			else
			{
				break;
			}
		}		
		
		if ($query)
		{
			if (count($data) > 0)
			{
				return $data;
			}
			else
			{
				return null;
			}
			DisConnect();
		}
		else
		{
			return null;
		}
		DisConnect();
	}
	
	
	function GetTableName()
	{
		global $conf;
		$con = Connect();
		$sql = "SELECT TABLE_NAME FROM information_schema.TABLES WHERE TABLE_SCHEMA = '" . $conf['table'] . "'";
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
	
	function GetSemester()
	{
		$con = Connect();
		$semester =[];
		$row = null;
		$tablename_array = GetTableName(); // lấy các đợt tốt nghiệp
		$get_tablename = [];
		foreach($tablename_array as $item)
		{
			array_push($get_tablename, $item['TABLE_NAME']);
		}
		
		foreach($get_tablename as $item)
		{
			$sql = "SELECT DISTINCT chi_tiet_hk FROM " . $item;
			$query = mysqli_query($con, $sql);
			$number = mysqli_num_rows($query);
			if ($number > 0) 
			{
				$row = mysqli_fetch_assoc($query);
			}
			$semester[$item] = $row;
		}
		return $semester;
		DisConnect();
	}
?>