<?php

namespace frontend\models;

use yii\db\ActiveRecord;
use frontend\models\Student;
use frontend\models\StudentSemester;
use frontend\models\StudentRecord;
use frontend\models\Province;

class GraduationSemester extends ActiveRecord
{
	public $semester;
	
	public static function tableName()
    {
		return '{{tb_hk_tot_nghiep}}';
    }
	
	public function rules() 
	{
		return [
			['semester', 'required'],
		];
	}
	
	
	public function getStudentSemesters()
	{
		return $this->hasMany(StudentSemester::className(), ['ma_hk' => 'ma_hk']);
	}
	
	public function getStudents()
	{
		return $this->hasMany(Student::className(), ['mssv' => 'mssv'])
					->via('studentSemesters');
	}
	
	
	/*
	public function getStudents()
	{
		return $this->hasMany(Student::className(), ['mssv' => 'mssv'])
				->viaTable('tb_sv_hk', ['ma_hk' => 'ma_hk']);
	}
	*/
	
	
	public function getStudentRecords()
	{
		return $this->hasOne(StudentRecord::className(), ['mssv' => 'mssv'])
					->via('students');
	}
	
	public function getProvinces()
	{
		return $this->hasOne(Province::className(), ['ma_tinh_thanh' => 'ma_noi_sinh'])
					->via('studentRecords');
	}
	
}
