<?php

namespace frontend\models;

use yii\db\ActiveRecord;

class Province extends ActiveRecord
{
	
	public static function tableName()
    {
		return '{{tb_tinh_thanh}}';
    }
	
}
