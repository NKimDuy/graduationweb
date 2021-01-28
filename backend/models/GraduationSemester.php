<?php
namespace app\models;
namespace backend\models;

use yii\base\Model;
use yii\db\ActiveRecord;

class GraduationSemester extends ActiveRecord
{
	public static function tableName()
	{
		return '{{tb_hk_tot_nghiep}}';
	}
	
}
