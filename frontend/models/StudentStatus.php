<?php

namespace frontend\models;

use yii\db\ActiveRecord;
use frontend\models\Student;

class StudentStatus extends ActiveRecord
{
	
	
	public static function tableName()
    {
		return '{{tb_tinh_trang_sv}}';
    }
	
	
	public function getStudent() 
	{
		return $this->hasOne(Student::className(), ['mssv' => 'mssv']);
	}
}
