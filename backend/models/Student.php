<?php
namespace app\models;
namespace backend\models;

use yii\base\Model;
use yii\db\ActiveRecord;

class Student extends ActiveRecord
{
	public $username;
	public $semester;
	
	const SCENARIO_FIND = 'find';
	
	public static function tableName()
	{
		return '{{tb_sinh_vien}}';
	}
	
	public function scenarios() 
	{
		$scenarios = parent::scenarios();
		$scenarios[self::SCENARIO_FIND] = ['mssv', 'username', 'semester'];
		return $scenarios;
	}
	
	public function rules()
	{
		return [
			[['semester'], 'required', 'on' => self::SCENARIO_FIND],
			['captcha', 'captcha'],
			
			[['mssv', 'username'], 'string', 'max' => 60],
			[['mssv', 'username'], 'trim'],
			[['mssv', 'username'], 'default'],
			
		];
	}
	
	public function getStudentSemester()
	{
		return $this->hasMany(StudentSemester::className(), ['mssv' => 'mssv']);
	}
	
	public function getGraduationSemesters() 
	{
		return $this->hasMany(GraduationSemester::className(), ['ma_hk' => 'ma_hk'])
				//->viaTable('tb_sv_hk', ['mssv' => 'mssv']);
				->via('studentSemester');
	}
	
	
}
