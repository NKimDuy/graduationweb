<?php

namespace frontend\models;

use yii\db\ActiveRecord;

class Major extends ActiveRecord
{
	
	public static function tableName()
    {
		return '{{tb_nganh}}';
    }
	
}
