<?php

namespace frontend\models;

use yii\db\ActiveRecord;

class TrainingForm extends ActiveRecord
{
	
	public static function tableName()
    {
		return '{{tb_ht_dao_tao}}';
    }
	
}
