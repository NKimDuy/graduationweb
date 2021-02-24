<?php
namespace app\models;
namespace backend\models;

use yii\base\Model;
use yii\db\ActiveRecord;

class EditStudent extends ActiveRecord
{
	public $mssv;
	public $ho;
	public $ten;
	public $ngay_sinh;
	public $gioi_tinh;
	public $ma_dan_toc;
	public $ma_noi_sinh;
	public $ma_quoc_tich;
	public $ma_dvlk;
	public $ma_nganh;
	public $ma_htdt;
	public $diem;
	public $xep_loai;
	public $dk_tn;
	public $giay_ks;
	public $bang_cap;
	public $hinh;
	public $phieu_dkxcb;
	public $ct_dt;
	
	const SCENARIO_FIND = 'find';
	
	
	
	/*
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
	*/
	
}
