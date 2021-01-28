<?php

namespace frontend\models;

use yii\db\ActiveRecord;

class Country extends ActiveRecord
{
	
	public static function tableName()
    {
		return '{{tb_quoc_tich}}';
    }
	
}
