<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\captcha\Captcha;
use backend\models\Upload;
use yii\helpers\Url;
use backend\assets\AppAsset;
AppAsset::register($this);
?>

<?php $form = ActiveForm::begin(['id' => 'upload-form', 'options' => ['enctype' => 'multipart/form-data']]) ?>

    <?= $form->field($model, 'uploadFile')->fileInput(['id' => 'input-excel']) ?>

    <!--<button>Submit</button>-->
	<?= Html::submitButton('Submit', ['id' => 'btnAdd', 'class' => 'btn btn-primary btn-lg btn-block']) ?>
	
	
	
<?php ActiveForm::end() ?>
<div>
	<div  style='font-size:20px;display:none;' class="text-success" id="showSuccess">
		<img src="<?= Yii::$app->request->baseUrl . "/images/" . "success.png" ?>" style="width:4%; " class="img-fluid" id="imgHome">
		<span id="success-notification"></span>
	</div>
	<div style='font-size:20px;display:none;' class="text-danger"  id="showFailed">
		<img src="<?= Yii::$app->request->baseUrl . "/images/" . "cancel.png" ?>" style="width:4%; " class="img-fluid" id="imgHome">
		<span id="danger-notification"></span>
	</div>
	<div style='font-size:20px;' class="text-warning"  id="showFailed">
		<img src="<?= Yii::$app->request->baseUrl . "/images/" . "alert.png" ?>" style="width:10%; " class="img-fluid" id="imgHome">
		<span id="alert-notification">aaaa</span>
	</div>
</div>


<div id="upload" ></div>

