<?php
namespace app\models;
namespace backend\models;

use yii\base\Model;
use yii\db\ActiveRecord;

class UploadForm extends Model
{
	
	public $uploadFile;
	
	public function rules()
	{
		return [
			[['uploadFile'], 'file', 'skipOnEmpty' => false, 'extensions' => 'xlsx'],
		];
	}
	
	public function loadFile()
	{
		if($this->validate()) 
		{
			$this->uploadFile->saveAs('uploads/' . $this->uploadFile->baseName . '.' . $this->uploadFile->extension);
			return true;
		}
		else
		{
			return false;
		}
	}
	
}
