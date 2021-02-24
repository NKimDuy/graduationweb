<?php
namespace app\models;
namespace backend\models;

use yii\base\Model;
use yii\db\ActiveRecord;

class LinkedUnit extends ActiveRecord
{
	public static function tableName()
	{
		return '{{tb_don_vi_lk}}';
	}
	
}
