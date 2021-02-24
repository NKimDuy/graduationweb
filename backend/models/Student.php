<?php
namespace app\models;
namespace backend\models;

use yii\base\Model;
use yii\db\ActiveRecord;
use backend\models\StudentSemester;

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
		$scenarios[self::SCENARIO_FIND] = ['mssv', 'username'];
		return $scenarios;
	}
	
	public function rules()
	{
		return [
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
	
	public function getStudentRecord() 
	{
		return $this->hasOne(StudentRecord::className(), ['mssv' => 'mssv']);
	}
	
	public function getProvince()
	{
		return $this->hasOne(Province::className(), ['ma_tinh_thanh' => 'ma_noi_sinh'])
					->via('studentRecord');
	}
	
	public function getCountry()
	{
		return $this->hasOne(Country::className(), ['ma_qt' => 'ma_quoc_tich'])
					->via('studentRecord');
	}
	
	public function getNation()
	{
		return $this->hasOne(nation::className(), ['ma_dt' => 'ma_dan_toc'])
					->via('studentRecord');
	}
	
	public function getLinkedUnit()
	{
		return $this->hasOne(LinkedUnit::className(), ['ma_dvlk' => 'ma_dvlk'])
					->via('studentRecord');
	}
	
	public function getMajor()
	{
		return $this->hasOne(Major::className(), ['ma_nganh' => 'ma_nganh'])
					->via('studentRecord');
	}
	
	public function getTrainingForm()
	{
		return $this->hasOne(TrainingForm::className(), ['ma_hinh_thuc' => 'ma_htdt'])
					->via('studentRecord');
	}
	
}
