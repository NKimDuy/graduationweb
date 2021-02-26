<?php
namespace app\models;
namespace backend\models;

use yii\base\Model;
use yii\db\ActiveRecord;

class EditStudent extends Model
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
	
	const SCENARIO_EDIT = 'edit';
	
	
	
	
	public function scenarios() 
	{
		$scenarios = parent::scenarios();
		$scenarios[self::SCENARIO_EDIT] = ['ho', 'ten', 'diem', 'xep_loai', 'bang_cap'];
		return $scenarios;
	}
	
	
	public function rules()
	{
		return [
			[['ho', 'ten', 'diem', 'xep_loai', 'bang_cap'], 'required'],
			[['ho', 'ten', 'diem', 'xep_loai', 'bang_cap'], 'trim'],
			[['ho', 'ten', 'diem', 'xep_loai', 'bang_cap'], 'default'],
			[['ho', 'ten'], 'validateAtributeIsString'],
			['diem', 'validateAtributeIsFloat'],
			
		];
	}
	
	public function validateAtributeIsString($attribute, $params, $validator)
	{
		if (!is_string($attribute))
			 $this->addError($attribute, 'họ và tên phải là chuỗi');
	}
	
	public function validateAtributeIsFloat($attribute, $params, $validator)
	{
		if (!is_float($attribute))
			 $this->addError($attribute, 'điểm phải là số thực');
	}
}
