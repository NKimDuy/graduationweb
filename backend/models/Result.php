<?php
namespace app\models;
namespace backend\models;

use yii\base\Model;
use yii\db\ActiveRecord;

class Result extends ActiveRecord
{
	public static function tableName()
	{
		return '{{tb_ket_qua}}';
	}
	
}
