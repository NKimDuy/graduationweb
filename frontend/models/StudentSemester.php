<?php

namespace frontend\models;

use yii\db\ActiveRecord;
use frontend\models\Student;

class StudentSemester extends ActiveRecord
{
	
	public static function tableName()
    {
		return '{{tb_sv_hk}}';
    }
	
	public function getStudent()
	{
		return $this->hasOne(Student::className(), ['mssv' => 'mssv']);
	}
	
	public function getGraduation()
	{
		return $this->hasOne(GraduationSemester::className(), ['ma_hk' => 'ma_hk']);
	}
}
