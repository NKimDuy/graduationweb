<?php

namespace frontend\models;

use yii\db\ActiveRecord;
use frontend\models\Student;

class Result extends ActiveRecord
{
	
	
	public static function tableName()
    {
		return '{{tb_ket_qua}}';
    }
	
	
	public function getStudent() 
	{
		return $this->hasOne(Student::className(), ['mssv' => 'mssv']);
	}
	
	
}
