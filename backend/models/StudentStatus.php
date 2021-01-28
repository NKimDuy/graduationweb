<?php
namespace app\models;
namespace backend\models;

use yii\base\Model;
use yii\db\ActiveRecord;

class StudentStatus extends ActiveRecord
{
	public static function tableName()
	{
		return '{{tb_tinh_trang_sv}}';
	}
	
}
