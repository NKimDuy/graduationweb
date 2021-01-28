<?php
namespace app\models;
namespace backend\models;

use yii\base\Model;
use yii\db\ActiveRecord;

class SemesterStudent extends ActiveRecord
{
	public static function tableName()
	{
		return '{{tb_sv_hk}}';
	}
	
}
