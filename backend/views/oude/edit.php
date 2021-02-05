<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\widgets\ActiveField;
use backend\models\Student;
use backend\models\StudentRecord;
use backend\models\StudentSemester;


use yii\jui;
use backend\assets\AppAsset;

AppAsset::register($this);

$student = new Student(); // tạo lớp lấy các trường tương ứng để tạo các input nhập liệu ở bảng tb_sinh_vien

$studentRecord = new StudentRecord(); // // tạo lớp lấy các trường tương ứng để tạo các input nhập liệu ở bảng tb_hoc_ki

$studentSemester = new StudentSemester(); // tạo lớp lấy các trường tương ứng để tạo các input nhập liệu ở bảng tb_sv_hk
?>



	<div class="progress" style="display:none;">
		<div class="progress-bar progress-bar-striped bg-warning progress-bar-animated" role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="width: 100%"></div>
	</div>
	<div id="dialog" style = "display:none;"></div>
	<!--display:none;-->
	
	<div class="container-fluid">
		<div>
			<img src="<?= Yii::$app->request->baseUrl . '/images/' . 'house.png' ?>" style="width:4%; display:none;" class="img-fluid" id="imgHome">  
		</div>
		<div id = "find-table" class ="row justify-content-center" >
			<div class = "col-sm-4 find_mssv">
				
				<div style = 'font-size:18px; background-color:#007bff' class = "full-screen font-weight-bold text-dark text-center"><span class="align-middle">TRA CỨU SINH VIÊN</span></div>
				
				<?php $form = ActiveForm::begin([
					'id' => 'login-form',
				]) ?>
				
					<div class="form-group">
						<label class="badge badge-info" for="" style="font-size:15px;">Mã số sinh viên</label>
						<div class="input-group">
							<?= $form->field($student, 'mssv')->textInput(['class' => 'form-control', 'id' => 'mssv', 'name' => 'mssv'])->label(false); ?>
						</div>
					</div>
					
					<div class="form-group">
						<label class="badge badge-info" for="" style="font-size:15px;">Họ và tên</label>
						<div class="input-group">
							<?= $form->field($student, 'username')->textInput(['class' => 'form-control', 'id' => 'username', 'name' => 'username', 'data-tooltip-content' => '#name_tooltip_content'])->label(false); ?>
						</div>
					</div>
					<div style="display: none;" class="tooltip_templates"><div id="name_tooltip_content">Nhập chuỗi ký tự có dấu hoặc không có dấu tiếng Việt với bảng mã UNICODE.<br /><br /><b>Ví dụ:</b><br /><ul style="color: #666666;"><li>Trần Đoàn Trung Tâm</li><li>Tran Doan Trung Tam</li></ul></div></div>
					<div class="form-group">
						<label for="">Đợt tốt nghiệp :</label>
						
						<?= $form->field($student, 'semester')->dropdownList($allGraduationSemester,  ['name' => 'semesterlist', 'id' => 'semesterlist'])->label(false); ?>
					</div>
					<!-- ,['prompt'=>'Vui lòng chọn học kì tốt nghiệp', 'name' => 'semesterlist', 'id' => 'semesterlist'] -->
					
				
					
					
				
					<?= Html::submitButton('Submit', ['class' => 'btn btn-primary btn-lg btn-block', 'id' => 'btnSubmit']) ?>
				
				<?php ActiveForm::end() ?>
				
			</div>
		</div>

		

		<!---------------------------------------------------------------------------------------------->
		
		<div id="displayStudent"></div>
		
		<!---------------------------------------------------------------------------------------------->
	</div>
	

	<!-- thêm dialog sửa thông tin sinh viên -->
