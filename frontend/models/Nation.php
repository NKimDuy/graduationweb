<?php

namespace frontend\models;

use yii\db\ActiveRecord;

class Nation extends ActiveRecord
{
	
	public static function tableName()
    {
		return '{{tb_dan_toc}}';
    }
	
}
