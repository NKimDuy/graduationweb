<?php

namespace frontend\models;

use yii\db\ActiveRecord;

class LinkedUnit extends ActiveRecord
{
	
	public static function tableName()
    {
		return '{{tb_don_vi_lk}}';
    }
	
}
