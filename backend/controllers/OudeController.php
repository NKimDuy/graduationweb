<?php
namespace backend\controllers;

use Yii;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use common\models\LoginForm;
use yii\web\UploadedFile;

use backend\models\UploadForm;

use backend\models\EditStudent;
use backend\models\StudentStatus;
use backend\models\Student;
use backend\models\Result;
use backend\models\StudentRecord;
use backend\models\StudentSemester;
use backend\models\GraduationSemester;
use backend\models\Nation;
use backend\models\Province;
use backend\models\Country;
use backend\models\LinkedUnit;
use backend\models\Major;
use backend\models\TrainingForm;
use yii\helpers\HtmlPurifier;
use yii\web\Response;
use yii\db;


use backend\utilities\Graduation;


/**
 * Site controller
 */
class OudeController extends Controller
{
	public $layout = 'demo1'; // áp dụng layout demo1 cho view
	
	public function actionIndex()
	{
		return $this->render('index', [
            'nhieuSinhVien' => 'dy'
        ]);
	}
	
	// new 
	public function actionEdit() // render view edit và gửi kèm những dữ liệu để hiện các dropdownlist
	{
		$allGraduationSemester = GraduationSemester::find()->select(['chi_tiet_hk'])->indexBy('ma_hk')->column(); // lấy tất cả học kì hiện có trong database để thêm vào dropdownlist
		
		$allNation = Nation::find()->select(['ten_dan_toc'])->indexBy('ma_dt')->column(); // lấy tất cả dân tộc
		
		$allProvince = Province::find()->select(['ten_tinh_thanh_at'])->indexBy('ma_tinh_thanh')->column(); // lấy tất cả tên tỉnh thành
		
		$allCountry = Country::find()->select(['ten_quoc_tich'])->indexBy('ma_qt')->column(); // lấy tất cả tên quốc tịch
		
		$allLinkedUnit = LinkedUnit::find()->select(['ten_dvlk'])->indexBy('ma_dvlk')->column(); // lấy tất cả tên đơn vị liên kết
		
		$allMajor = Major::find()->select(['ten_nganh'])->indexBy('ma_nganh')->column(); // lấy tất cả tên ngành
		
		$allTrainingForm = TrainingForm::find()->select(['ten_hinh_thuc_at'])->indexBy('ma_hinh_thuc')->column();
		
		return $this->render('edit', [
			'allGraduationSemester' => $allGraduationSemester,
			'allNation' => $allNation,
			'allProvince' => $allProvince,
			'allCountry' => $allCountry,
			'allLinkedUnit' => $allLinkedUnit,
			'allMajor' => $allMajor,
			'allTrainingForm' => $allTrainingForm,
		]);
	}
	
	public function actionShowDetailToEdit($mssv, $hk) // khi có kết quả tìm kiếm , khi nhấn vào 1 sinh viên sẽ hiện dialog chứa thông tin của sinh viên đó để cập nhập
	{
		if(\Yii::$app->request->isAjax)
		{
			
			\Yii::$app->response->format = Response::FORMAT_JSON;
			
			$detailStudent = StudentSemester::find()
							->where([
								'tb_sv_hk.mssv' => $mssv,
								'tb_sv_hk.ma_hk' => $hk
							])
							->limit(1)
							->one(); // trả về đúng 1 sinh viên theo kết quả tìm kiếm
			
			$detailStudentArray = [];
			
			array_push($detailStudentArray, $detailStudent->student->linkedUnit->ma_dvlk);
			array_push($detailStudentArray, $detailStudent->student->linkedUnit->ten_dvlk);
			array_push($detailStudentArray, $detailStudent->student->nation->ten_dan_toc);
			array_push($detailStudentArray, $detailStudent->student->country->ten_quoc_tich);
			array_push($detailStudentArray, $detailStudent->student->major->ten_nganh);
			array_push($detailStudentArray, $detailStudent->giay_ks);
			array_push($detailStudentArray, $detailStudent->bang_cap);
			array_push($detailStudentArray, $detailStudent->hinh);
			array_push($detailStudentArray, $detailStudent->phieu_dkxcb);
			array_push($detailStudentArray, $detailStudent->ct_dt);
			array_push($detailStudentArray, $detailStudent->student->trainingForm->ten_hinh_thuc_at);
			array_push($detailStudentArray, $detailStudent->diem);
			array_push($detailStudentArray, $detailStudent->xep_loai);
			array_push($detailStudentArray, $detailStudent->dk_tn);
			array_push($detailStudentArray, $detailStudent->student->mssv);
			array_push($detailStudentArray, $detailStudent->student->ho);
			array_push($detailStudentArray, $detailStudent->student->ten);
			array_push($detailStudentArray, $detailStudent->student->ngay_sinh);
			array_push($detailStudentArray, $detailStudent->student->gioi_tinh);
			array_push($detailStudentArray, $detailStudent->student->province->ten_tinh_thanh_at);
			
			return $detailStudentArray;
		}
	}
	
	public function actionGetDataToEdit() // lấy những trường dữ liệu tương ứng để gửi sang Graduation để cập nhật
	{
		if(\Yii::$app->request->isAjax)
		{
			
			\Yii::$app->response->format = Response::FORMAT_JSON;
			
			$data = \Yii::$app->request->post('data');
			
			$student = Student::findOne($data[0]);
			
			$studentRecord = StudentRecord::findOne($data[0]); // $data[0] là mssv
			
			$semesterStudent = StudentSemester::find($data[0])
								->where([
									'tb_sv_hk.mssv' => $data[0],
									'tb_sv_hk.ma_hk' => $data[19] // $data[19] là học kì
								])
								->limit(1)
								->one(); // trả về đúng 1 sinh viên theo kết quả tìm kiếm
			
			$editStudent = new EditStudent();
			
			$editStudent->scenario = EditStudent::SCENARIO_EDIT;
			
			$editStudent->ho = HtmlPurifier::process($data[1]);
			
			$editStudent->ten = HtmlPurifier::process($data[2]);
			
			$editStudent->diem = HtmlPurifier::process($data[11]);
			
			$editStudent->xep_loai = HtmlPurifier::process($data[12]);
			
			$editStudent->bang_cap = HtmlPurifier::process($data[15]);
			
			if ($editStudent->validate())
			{
				$data[1] = $editStudent->ho;
				
				$data[2] = $editStudent->ten;
				
				$data[11] = $editStudent->diem;
				
				$data[12] = $editStudent->xep_loai;
				
				$data[15] = $editStudent->bang_cap;
				
				$successEditStudent = Graduation::editStudent($student, $data);
				
				$successEditStudentRecord = Graduation::editStudentRecord($studentRecord, $data);
				
				$successEditSemesterStudent = Graduation::editSemesterStudent($semesterStudent, $data);
			}
			
			
		}
	}
	
	// new
	public function actionCreate() // trả về kết quả tim kiếm
	{
		$allStudentInSemester = [];
		
		if(\Yii::$app->request->isAjax)
		{
			\Yii::$app->response->format = Response::FORMAT_JSON;
			
			$username = \Yii::$app->request->post('username');
			$semester = \Yii::$app->request->post('semester');
			$mssv = \Yii::$app->request->post('mssv');
			
			$errors = '';
		
			$data = [];
			
			$model = new Student();
			
			$model->scenario = Student::SCENARIO_FIND;
			
			$model->mssv = HtmlPurifier::process($mssv);
			
			$model->username = HtmlPurifier::process($username);
			
			$model->semester = HtmlPurifier::process($semester);
			
			if($model->validate()) 
			{
				
				if ($model->semester == 'all')
				{
					$allStudentInSemester = Student::find()
								->innerJoinWith('graduationSemesters')
								->andFilterWhere(['like', 'tb_sinh_vien.mssv', $model->mssv])
								->andFilterWhere(['or', ['like', 'CONCAT(tb_sinh_vien.ho, " ", tb_sinh_vien.ten)', $model->username], ['like', 'CONCAT(tb_sinh_vien.ho_kd, " ", tb_sinh_vien.ten_kd)' , $model->username]])
								
								->all();
					
					foreach($allStudentInSemester as $item)
					{
						$temp = [];
						
						foreach($item->graduationSemesters as $studentPerSemester)
						{
							$temp[] = $item->mssv;
							$temp[] = $item->ho;
							$temp[] = $item->ten;
							$temp[] = $studentPerSemester->chi_tiet_hk;
							$temp[] = $studentPerSemester->ma_hk;
							$data[] = $temp; 
							$temp = []; // phải đưa mảng tạm về rỗng, để tránh việc mảng đã có dữ liệu, dẫn đến bị trùng dữ liệu
						}
						
					}
					
					/*
					foreach($allStudentInSemester as $stud)
					{
						$temp = []; // khởi tạo mảng 1 chiều, để lưu từng dòng dữ liệu, sau đó lưu tất cả các dòng vào mảng chung " data "
						
						foreach($allStudentInSemester[0]->graduationSemesters as $graSemester)
						{
							$temp[] = $stud->mssv;
							$temp[] = $stud->ho;
							$temp[] = $stud->ten;
							$temp[] = $graSemester->chi_tiet_hk;
							$temp[] = $graSemester->ma_hk;
							$data[] = $temp;
							$temp = []; // phải đưa mảng tạm về rỗng, để tránh việc mảng đã có dữ liệu, dẫn đến bị trùng dữ liệu
						}
					}
					*/
					
				}
				else
				{
					$allStudentInSemester = Student::find()
								->innerJoinWith('graduationSemesters')
								->where(['tb_hk_tot_nghiep.ma_hk' => $model->semester])
								->andFilterWhere(['like', 'tb_sinh_vien.mssv', $model->mssv])
								->andFilterWhere(['or', ['like', 'CONCAT(tb_sinh_vien.ho, " ", tb_sinh_vien.ten)', $model->username], ['like', 'CONCAT(tb_sinh_vien.ho_kd, " ", tb_sinh_vien.ten_kd)' , $model->username]])
								
								->all();
									
					$detailSemester = GraduationSemester::find()
							->where(['tb_hk_tot_nghiep.ma_hk' => $model->semester])
							->one();
					
						
					foreach($allStudentInSemester as $item)
					{
						$temp = [];
						$temp[] = $item->mssv;
						$temp[] = $item->ho;
						$temp[] = $item->ten;
						
						$temp[] = $detailSemester->chi_tiet_hk;
						$temp[] = $detailSemester->ma_hk;
						$data[] = $temp;
					}
				}
				
			}
			else
			{
				$errors = $model->errors;
			}
			
			
			
			return [
				'allStudentInSemester' => $data,
				'errors' => $errors
			];
		}
	}
	
	
	public function actionUpload()
	{
		$model = new UploadForm();
		   
		if (Yii::$app->request->isPost)
		{
			$model->uploadFile = UploadedFile::getInstance($model, 'uploadFile');
			
			/*
			if($model->loadFile()) 
			{
				return $this->redirect('/oude/upload');
				// return;
			}
			*/
		}
		
		return $this->render('upload', ['model' => $model]);
	}
	
	public function actionAdd()
	{
		if (Yii::$app->request->isAjax) 
		{
			\Yii::$app->response->format = Response::FORMAT_JSON;
			$data = \Yii::$app->request->post('data');
		}
		
		$student = new Student(); // thêm vào bảng sinh viên
		
		$studentRecord = new StudentRecord(); // thêm vào bảng hồ sơ sinh viên
		
		$semesterStudent = new StudentSemester(); // thêm vào bảng sinh viên_học kì
		
		
		$successAddToStudent = Graduation::addToStudent($student, $data); // thêm vào bảng sinh viên
		
		$successAddToStudentRecord = Graduation::addToStudentRecord($studentRecord, $data); // thêm vào bảng hồ sơ sinh viên
		
		$successAddToSemesterStudent = Graduation::addToSemesterStudent($semesterStudent, $data); // thêm vào bảng sinh viên học kì
		
		//return $successAddToStudent . ', ' . $successAddToStudentRecord . ', ' . $successAddToSemesterStudent;
		
		if ($successAddToStudent && $successAddToStudentRecord && $successAddToSemesterStudent) // nếu tất cả được thêm vào database thành công ( trong trường hợp thêm thành công 1 dòng mới)
			return true; // nếu thêm thành công sẽ trả kết quả true
		else if (!$successAddToStudent && !$successAddToStudentRecord && !$successAddToSemesterStudent) // nếu tất cà không thêm được vào database do trùng dữ liệu thì 
																										//chỉ trả về những dòng không thêm được , giữ lại các dòng đã có mà bị trùng
			return $data[0]; // nếu thêm không thành công, sẽ trả về hàng thêm không thành công
		else if (!$successAddToStudent && !$successAddToStudentRecord && $successAddToSemesterStudent) // trong trường hợp 1 sinh viên nằm trong nhiều đợt xét tốt nghiệp , thì chỉ thêm vào bảng sinh viên học kì
			return true;
		else // nếu 1 trong các bảng không được thêm thành công, thì sẽ trả về số thứ tự của dòng không thêm được, đồng thời xóa dữ liệu ở các bảng khác mà dòng đó không gặp lỗi
			$studentDelete = Student::findOne($data[3]); // xóa sinh viên có mã số sinh viên đã được thêm vào bảng sinh viên, nhưng không thêm thành công ở 2 bảng hồ sơ sinh viên và sinh viên học kì
			$studentDelete->delete();
			return $data[0]; // nếu thêm không thành công, sẽ trả về hàng thêm không thành công
			
		// chưa tính đến trường hợp 1 sinh viên có trong nhiều đợt xét tốt nghiệp , nếu xét các điều kiện ở trên thì sẽ không thêm được vào bảng sinhvien_hocki
	}
}
