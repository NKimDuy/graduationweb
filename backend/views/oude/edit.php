<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\widgets\ActiveField;
use backend\models\Student;
use backend\models\StudentRecord;
use backend\models\StudentSemester;
use backend\models\EditStudent;

use yii\jui;
use backend\assets\AppAsset;

AppAsset::register($this);

$student = new Student();

$editStudent = new EditStudent();
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
	<div id="dialogEdit">
		<?php $form = ActiveForm::begin([
			'id' => 'formEdit',
		]) ?>
			<fieldset>
				<label for="mssv">Mã số sinh viên</label>
				<?= $form->field($editStudent, 'mssv')->textInput(['class' => 'form-control', 'id' => 'mssv-edit', 'name' => 'mssv'])->label(false); ?>
				<label for="ho">Họ</label>
				<?= $form->field($editStudent, 'ho')->textInput(['class' => 'form-control', 'id' => 'ho', 'name' => 'ho'])->label(false); ?>
				<label for="ten">Tên</label>
				<?= $form->field($editStudent, 'ten')->textInput(['class' => 'form-control', 'id' => 'ten', 'name' => 'ten'])->label(false); ?>
				<label for="ngaySinh">Ngày sinh</label>
				<?= $form->field($editStudent, 'ngay_sinh')->textInput(['class' => 'form-control', 'id' => 'ngaySinh', 'name' => 'ngaySinh'])->label(false); ?>
				<label for="gioiTinh">giới tính</label>
				<?= $form->field($editStudent, 'gioi_tinh')->dropdownList(['1' => 'Nam', '2' => 'Nữ'], ['name' => 'gioiTinh', 'id' => 'gioiTinh'])->label(false); ?>
				<label for="danToc">Dân tộc</label>
				<?= $form->field($editStudent, 'ma_dan_toc')->dropdownList($allNation,  ['name' => 'danToc', 'id' => 'danToc'])->label(false); ?>
				<label for="noiSinh">Nơi sinh</label>
				<?= $form->field($editStudent, 'ma_noi_sinh')->dropdownList($allProvince,  ['name' => 'noiSinh', 'id' => 'noiSinh'])->label(false); ?>
				<label for="quocTich">Quốc tịch</label>
				<?= $form->field($editStudent, 'ma_quoc_tich')->dropdownList($allCountry,  ['name' => 'quocTich', 'id' => 'quocTich'])->label(false); ?>
				<label for="dvlk">Đơn vị liên kết</label>
				<?= $form->field($editStudent, 'ma_dvlk')->dropdownList($allLinkedUnit,  ['name' => 'dvlk', 'id' => 'dvlk'])->label(false); ?>
				<label for="nganh">Ngành</label>
				<?= $form->field($editStudent, 'ma_nganh')->dropdownList($allMajor,  ['name' => 'nganh', 'id' => 'nganh'])->label(false); ?>
				<label for="htdt">Hình thức đào tạo</label>
				<?= $form->field($editStudent, 'ma_htdt')->dropdownList($allTrainingForm,  ['name' => 'htdt', 'id' => 'htdt'])->label(false); ?>
				<label for="diem">Điểm</label>
				<?= $form->field($editStudent, 'diem')->textInput(['class' => 'form-control', 'id' => 'diem', 'name' => 'diem'])->label(false); ?>
				<label for="xepLoai">Xếp loại</label>
				<?= $form->field($editStudent, 'xep_loai')->textInput(['class' => 'form-control', 'id' => 'xepLoai', 'name' => 'xepLoai'])->label(false); ?>
				<label for="dktn">Điều kiện tốt nghiệp</label>
				<?= $form->field($editStudent, 'dk_tn')->dropdownList(['ddk' => 'Đủ điều kiện', 'cddk' => 'Chưa đủ điều kiện'], ['id' => 'dktn', 'name' => 'dktn'])->label(false); ?>
				<label for="giayKs">Giấy khai sinh</label>
				<?= $form->field($editStudent, 'giay_ks')->dropdownList(['hl' => 'HƠP LỆ', 'chl' => 'CHƯA HỢP LỆ' , 'bx' => 'BỔ XUNG'], ['id' => 'giayKs', 'name' => 'giayKs'])->label(false); ?>
				<label for="bangCap">Bằng cấp</label>
				<?= $form->field($editStudent, 'bang_cap')->textInput(['class' => 'form-control', 'id' => 'bangCap', 'name' => 'bangCap'])->label(false); ?>
				<label for="hinh">Hình</label>
				<?= $form->field($editStudent, 'hinh')->dropdownList(['hl' => 'HƠP LỆ', 'chl' => 'CHƯA HỢP LỆ' , 'bx' => 'BỔ XUNG'], ['id' => 'hinh', 'name' => 'hinh'])->label(false); ?>
				<label for="phieuDkxcb">Phiếu đăng kí xét cấp bằng</label>
				<?= $form->field($editStudent, 'phieu_dkxcb')->dropdownList(['hl' => 'HƠP LỆ', 'chl' => 'CHƯA HỢP LỆ', 'bx' => 'BỔ XUNG'], ['id' => 'phieuDkxcb', 'name' => 'phieuDkxcb'])->label(false); ?>
				<label for="ctdt">Chương trình đào tạo</label>
				<?= $form->field($editStudent, 'ct_dt')->dropdownList(['hl' => 'HƠP LỆ', 'chl' => 'CHƯA HỢP LỆ', 'bx' => 'BỔ XUNG'], ['id' => 'ctdt', 'name' => 'ctdt'])->label(false); ?>
			</fieldset>
		<?php ActiveForm::end() ?>
	</div>
