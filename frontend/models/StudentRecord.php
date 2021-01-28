<?php

namespace frontend\models;

use yii\db\ActiveRecord;
use frontend\models\Student;
use frontend\models\Province;

class StudentRecord extends ActiveRecord
{
	
	
	public static function tableName()
    {
		return '{{tb_ho_so_sv}}';
    }
	
	
	public function getStudent() 
	{
		return $this->hasOne(Student::className(), ['mssv' => 'mssv']);
	}
	
	public function getProvinces()
	{
		return $this->hasOne(Province::className(), ['ma_tinh_thanh' => 'ma_noi_sinh']);
	}
	
}
