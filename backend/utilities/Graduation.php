<?php
namespace backend\utilities;

class Graduation
{

	public function removeAccent($str)
	{
		$unicode = array(
 
			'a'=>'á|à|ả|ã|ạ|ă|ắ|ặ|ằ|ẳ|ẵ|â|ấ|ầ|ẩ|ẫ|ậ',
			 
			'd'=>'đ',
			 
			'e'=>'é|è|ẻ|ẽ|ẹ|ê|ế|ề|ể|ễ|ệ',
			 
			'i'=>'í|ì|ỉ|ĩ|ị',
			 
			'o'=>'ó|ò|ỏ|õ|ọ|ô|ố|ồ|ổ|ỗ|ộ|ơ|ớ|ờ|ở|ỡ|ợ',
			 
			'u'=>'ú|ù|ủ|ũ|ụ|ư|ứ|ừ|ử|ữ|ự',
			 
			'y'=>'ý|ỳ|ỷ|ỹ|ỵ',
			 
			'A'=>'Á|À|Ả|Ã|Ạ|Ă|Ắ|Ặ|Ằ|Ẳ|Ẵ|Â|Ấ|Ầ|Ẩ|Ẫ|Ậ',
			 
			'D'=>'Đ',
			 
			'E'=>'É|È|Ẻ|Ẽ|Ẹ|Ê|Ế|Ề|Ể|Ễ|Ệ',
			 
			'I'=>'Í|Ì|Ỉ|Ĩ|Ị',
			 
			'O'=>'Ó|Ò|Ỏ|Õ|Ọ|Ô|Ố|Ồ|Ổ|Ỗ|Ộ|Ơ|Ớ|Ờ|Ở|Ỡ|Ợ',
			 
			'U'=>'Ú|Ù|Ủ|Ũ|Ụ|Ư|Ứ|Ừ|Ử|Ữ|Ự',
			 
			'Y'=>'Ý|Ỳ|Ỷ|Ỹ|Ỵ',
			 
		);
		
		foreach($unicode as $nonUnicode=>$uni)
		{
			$str = preg_replace("/($uni)/i", $nonUnicode, $str);
		}
		//$str = str_replace(' ','_',$str);
		 
		return $str;
	}
	
	public static function addToStudent($student, $data, $flag = true)
	{
		if($flag)
		{
			$student->mssv = $data[3];
			$student->ho = $data[4];
			$student->ho_kd = $data[21];
			$student->ten = $data[5];
			$student->ten_kd = $data[22];
			$student->ngay_sinh = $data[6];
			if ($data[8] == 'Nam')
				$student->gioi_tinh = 1;
			else
				$student->gioi_tinh = 0;
			
			try {
				$student->save();
				return true;
				
			}catch(\yii\db\Exception $exception) {
				return false;
			}
		}
		
	}
	
	public static function editStudent($student, $data)
	{
	
		$student->mssv = $data[0];
		$student->ho = $data[1];
		$student->ho_kd = Graduation::removeAccent($data[1]);
		$student->ten = $data[2];
		$student->ten_kd = Graduation::removeAccent($data[2]);
		$student->ngay_sinh = $data[3];
		if ($data[4] == 'Nam')
			$student->gioi_tinh = 1;
		else
			$student->gioi_tinh = 0;
		
		try {
			$student->save();
			return true;
			
		}catch(\yii\db\Exception $exception) {
			return false;
		}
		
		
	}
	
	public static function addToStudentRecord($student, $data, $flag = true)
	{
		if ($flag)
		{
			$student->mssv = $data[3];
			$student->ma_dan_toc = $data[26];
			$student->ma_noi_sinh = $data[25];
			$student->ma_quoc_tich = $data[27];
			$student->ma_dvlk = $data[1];
			$student->ma_nganh = $data[28];
			$student->ma_htdt = $data[29];
			
			try {
				$student->save();
				return true;
				
			}catch(\yii\db\Exception $exception) {
				return false;
			}
		}
	}
	
	public static function editStudentRecord($student, $data)
	{
		$student->mssv = $data[0];
		$student->ma_dan_toc = $data[5];
		$student->ma_noi_sinh = $data[6];
		$student->ma_quoc_tich = $data[7];
		$student->ma_dvlk = $data[8];
		$student->ma_nganh = $data[9];
		$student->ma_htdt = $data[10];
		
		try {
			$student->save();
			return true;
			
		}catch(\yii\db\Exception $exception) {
			return false;
		}
	}
	
	public static function addToSemesterStudent($student, $data)
	{
		if($flag)
		{
			$student->mssv = $data[3];
			$student->ma_hk = $data[23];
			$student->diem = $data[18];
			$student->xep_loai = $data[19];
			$student->dk_tn = $data[20];
			$student->giay_ks = $data[12];
			$student->bang_cap = $data[13];
			$student->hinh = $data[14];
			$student->phieu_dkxcb = $data[15];
			$student->ct_dt = $data[16];
			
			try {
				$student->save();
				return true;
				
			}catch(\yii\db\Exception $exception) {
				return false;
			}
		}
	}
	
	public static function editSemesterStudent($student, $data, $flag = true)
	{
		
		$student->mssv = $data[0];
		$student->ma_hk = $data[19];
		$student->diem = $data[11];
		$student->xep_loai = $data[12];
		$student->dk_tn = $data[13];
		$student->giay_ks = $data[14];
		$student->bang_cap = $data[15];
		$student->hinh = $data[16];
		$student->phieu_dkxcb = $data[17];
		$student->ct_dt = $data[18];
		
		try {
			$student->save();
			return true;
			
		}catch(\yii\db\Exception $exception) {
			return false;
		}
		
	}
}
