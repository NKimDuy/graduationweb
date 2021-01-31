<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\widgets\ActiveField;
use backend\models\Student;
use backend\models\StudentRecord;
use backend\models\SemesterStudent;


use yii\jui;
use backend\assets\AppAsset;

AppAsset::register($this);

$student = new Student(); // tạo lớp lấy các trường tương ứng để tạo các input nhập liệu ở bảng tb_sinh_vien

$studentRecord = new StudentRecord(); // // tạo lớp lấy các trường tương ứng để tạo các input nhập liệu ở bảng tb_hoc_ki

$semesterStudent = new SemesterStudent(); // tạo lớp lấy các trường tương ứng để tạo các input nhập liệu ở bảng tb_sv_hk
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
			<div class = "col-sm-6 find_mssv">
				
			
				<div style = 'font-size:18px; background-color:#007bff' class = "full-screen font-weight-bold text-dark text-center"><span class="align-middle">TRA CỨU THÔNG TIN TÌNH TRẠNG XÉT TỐT NGHIỆP</span></div>
				<div class="row justify-content-center"><span style = "color: red; font-size: 15px; margin-bottom:5px;" class="badge badge-warning">Vui lòng chọn tra cứu bằng mã số hoặc họ tên sinh viên</span></div>
				
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
					<!-- ,
														['prompt'=>'Vui lòng chọn học kì tốt nghiệp', 'name' => 'semesterlist', 'id' => 'semesterlist'] -->
					
					<?= Html::checkbox('checkAll', false, ['id' => "checkAll", 'label' => '', 'value' => 'yes', 'style' => ['display' => 'none']]); ?>
					
					<div>
					Nếu không tìm thấy thông tin tình trạng xét tốt nghiệp của sinh viên. Xin vui lòng liên hệ:
					</div>
					<div>
						<b>
							Trung tâm Đào tạo từ xa - Trường Đại học Mở Thành phố Hồ Chí Minh
						</b>
						<br>
							Phòng 004 - 97 Võ Văn Tần, Phường 6, Quận 3, Thành phố Hồ Chí Minh
						<br>
							Điện thoại: 18006119 (bấm phím 1)
						
					</div>
					
					
				
					<?= Html::submitButton('Submit', ['class' => 'btn btn-primary btn-lg btn-block', 'id' => 'btnSubmit']) ?>
				
				<?php ActiveForm::end() ?>
				
			</div>
		</div>

		

		<!---------------------------------------------------------------------------------------------->
		
		<div id="displayStudent"></div>
		
		<!---------------------------------------------------------------------------------------------->
	</div>
	

	<div id="dialogEdit">
		<?php $form = ActiveForm::begin([
			'id' => 'formEdit',
		]) ?>
			<fieldset>
				<label for="mssv">Mã số sinh viên</label>
				<?= $form->field($student, 'mssv')->textInput(['class' => 'form-control', 'id' => 'mssv', 'name' => 'mssv'])->label(false); ?>
				<label for="ho">Họ</label>
				<?= $form->field($student, 'ho')->textInput(['class' => 'form-control', 'id' => 'ho', 'name' => 'ho'])->label(false); ?>
				<label for="ten">Tên</label>
				<?= $form->field($student, 'ten')->textInput(['class' => 'form-control', 'id' => 'ten', 'name' => 'ten'])->label(false); ?>
				<label for="ngaySinh">Ngày sinh</label>
				<?= $form->field($student, 'ngay_sinh')->textInput(['class' => 'form-control', 'id' => 'ngaySinh', 'name' => 'ngaySinh'])->label(false); ?>
				<label for="gioiTinh">giới tính</label>
				<?= $form->field($student, 'gioi_tinh')->dropdownList(['1' => 'Nam', '2' => 'Nữ'], ['name' => 'gioiTinh', 'id' => 'gioiTinh'])->label(false); ?>
				<label for="danToc">Dân tộc</label>
				<?= $form->field($studentRecord, 'ma_dan_toc')->dropdownList($,  ['name' => 'danToc', 'id' => 'danToc'])->label(false); ?>
				<label for="noiSinh">Nơi sinh</label>
				<?= $form->field($studentRecord, 'ma_noi_sinh')->dropdownList($,  ['name' => 'noiSinh', 'id' => 'noiSinh'])->label(false); ?>
				<label for="quocTich">Quốc tịch</label>
				<?= $form->field($studentRecord, 'ma_quoc_tich')->dropdownList($,  ['name' => 'quocTich', 'id' => 'quocTich'])->label(false); ?>
				<label for="dvlk">Đơn vị liên kết</label>
				<?= $form->field($studentRecord, 'ma_dvlk')->dropdownList($,  ['name' => 'dvlk', 'id' => 'dvlk'])->label(false); ?>
				<label for="nganh">Ngành</label>
				<?= $form->field($studentRecord, 'ma_nganh')->dropdownList($,  ['name' => 'nganh', 'id' => 'nganh'])->label(false); ?>
				<label for="htdt">Hình thức đào tạo</label>
				<?= $form->field($studentRecord, 'ma_htdt')->dropdownList($,  ['name' => 'htdt', 'id' => 'htdt'])->label(false); ?>
				<label for="diem">Điểm</label>
				<?= $form->field($semesterStudent, 'diem')->textInput(['class' => 'form-control', 'id' => 'diem', 'name' => 'diem'])->label(false); ?>
				<label for="xepLoai">Xếp loại</label>
				<?= $form->field($semesterStudent, 'xep_loai')->textInput(['class' => 'form-control', 'id' => 'xepLoai', 'name' => 'xepLoai'])->label(false); ?>
				<label for="dktn">Điều kiện tốt nghiệp</label>
				<?= $form->field($semesterStudent, 'dk_tn')->textInput(['class' => 'form-control', 'id' => 'dktn', 'name' => 'dktn'])->label(false); ?>
				<label for="giayKs">Giấy khai sinh</label>
				<?= $form->field($semesterStudent, 'giay_ks')->textInput(['class' => 'form-control', 'id' => 'giayKs', 'name' => 'giayKs'])->label(false); ?>
				<label for="bangCap">Bằng cấp</label>
				<?= $form->field($semesterStudent, 'bang_cap')->textInput(['class' => 'form-control', 'id' => 'bangCap', 'name' => 'bangCap'])->label(false); ?>
				<label for="hinh">Hình</label>
				<?= $form->field($semesterStudent, 'hinh')->textInput(['class' => 'form-control', 'id' => 'hinh', 'name' => 'hinh'])->label(false); ?>
				<label for="phieuDkxcb">Phiếu đăng kí xét cấp bằng</label>
				<?= $form->field($semesterStudent, 'phieu_dkxcb')->textInput(['class' => 'form-control', 'id' => 'phieuDkxcb', 'name' => 'phieuDkxcb'])->label(false); ?>
				<label for="ctdt">Chương trình đào tạo</label>
				<?= $form->field($semesterStudent, 'ct_dt')->textInput(['class' => 'form-control', 'id' => 'ctdt', 'name' => 'ctdt'])->label(false); ?>
			</fieldset>
		<?php ActiveForm::end() ?>
	</div>
