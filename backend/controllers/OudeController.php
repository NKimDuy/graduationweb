<?php
namespace backend\controllers;

use Yii;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use common\models\LoginForm;
use yii\web\UploadedFile;

use backend\models\UploadForm;

use backend\models\StudentStatus;
use backend\models\Student;
use backend\models\Result;
use backend\models\StudentRecord;
use backend\models\StudentSemester;
use backend\models\GraduationSemester;
use yii\helpers\HtmlPurifier;
use yii\web\Response;
use yii\db;


use backend\utilities\Graduation;


/**
 * Site controller
 */
class OudeController extends Controller
{
	public $layout = 'demo1';
	
	public function actionIndex()
	{
		return $this->render('index', [
            'nhieuSinhVien' => 'dy'
        ]);
	}
	
	// new 
	public function actionEdit()
	{
		$allGraduationSemester = GraduationSemester::find()->select(['chi_tiet_hk'])->indexBy('ma_hk')->column(); // lấy tất cả học kì hiện có trong database để thêm vào dropdownlist
		return $this->render('edit', [
			'allGraduationSemester' => $allGraduationSemester,
		]);
	}
	
	// new
	public function actionCreate()
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
					/*
					foreach($allStudentInSemester[0]->graduationSemesters as $item)
					{
							$temp = [];
							
							$temp[] = $item->chi_tiet_hk;
							$temp[] = $item->ma_hk;
							$data[] = $temp; 
					}
					*/
					
					
					foreach($allStudentInSemester as $stud)
					{
						$temp = []; // khởi tạo mảng 1 chiều, để lưu từng dòng dữ liệu, sau đó lưu tất cả các dòng vào mảng chung " data "
						
						foreach($allStudentInSemester[0]->graduationSemesters as $graSemester)
						{
							$temp[] = $stud->mssv;
							//$temp[] = $stud->ho;
							//$temp[] = $stud->ten;
							$temp[] = $graSemester->chi_tiet_hk;
							//$temp[] = $graSemester->ma_hk;
							$data[] = $temp;
							$temp = []; // phải đưa mảng tạm về rỗng, để tránh việc mảng đã có dữ liệu, dẫn đến bị trùng dữ liệu
						}
						
						//$temp[] = $stud->mssv;
						//$data[] = $temp;
					}
					
					
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
		else if (!$successAddToStudent && !$successAddToStudentRecord && $successAddToSemesterStudent)
			return true;
		else // nếu 1 trong các bảng không được thêm thành công, thì sẽ trả về số thứ tự của dòng không thêm được, đồng thời xóa dữ liệu ở các bảng khác mà dòng đó không gặp lỗi
			$studentDelete = Student::findOne($data[3]); // xóa sinh viên có mã số sinh viên đã được thêm vào bảng sinh viên, nhưng không thêm thành công ở 2 bảng hồ sơ sinh viên và sinh viên học kì
			$studentDelete->delete();
			return $data[0]; // nếu thêm không thành công, sẽ trả về hàng thêm không thành công
		
	}
}
