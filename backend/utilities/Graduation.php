<?php
namespace backend\utilities;

class Graduation
{
	

	
	public static function addToStudent($student, $data)
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
	
	public static function addToStudentRecord($student, $data)
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
	/*
	public static function addToGraduationSemester($student, $data)
	{
		$student->ma_hk = $data[23];
		$student->chi_tiet_hk = $data[24];
		
		if ($student->save())
			return true;
		else
			return false;
	}
	*/
	public static function addToSemesterStudent($student, $data)
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
